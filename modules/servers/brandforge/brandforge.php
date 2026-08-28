<?php
/**
 * BrandForge WHMCS Provisioning Module
 *
 * Connects WHMCS product lifecycle events to the Godmode API so that
 * creating, suspending, and terminating a service automatically provisions
 * or deprovisions the corresponding BrandForge workspace.
 */

if (!defined('WHMCS')) {
    die('Access denied.');
}

// ---------------------------------------------------------------------------
// Autoload lib classes
// ---------------------------------------------------------------------------

$libDir = __DIR__ . '/lib/';
require_once $libDir . 'Exceptions.php';
require_once $libDir . 'Logger.php';
require_once $libDir . 'GodmodeClient.php';
require_once $libDir . 'Mapper.php';
require_once $libDir . 'PackageLookup.php';
require_once $libDir . 'ServiceRepository.php';
require_once $libDir . 'SsoHandler.php';

use BrandForge\GodmodeClient;
use BrandForge\Logger;
use BrandForge\Mapper;
use BrandForge\PackageLookup;
use BrandForge\ServiceRepository;
use BrandForge\SsoHandler;
use BrandForge\Exceptions\GodmodeApiException;

// ---------------------------------------------------------------------------
// Internal helpers
// ---------------------------------------------------------------------------

/**
 * Build a GodmodeClient from the module params.
 *
 * Config options (product-level) take precedence over server record fields
 * so that TestConnection (which only receives server fields) also works.
 */
function brandforge_buildClient(array $params): GodmodeClient
{
    // ?: falls back on empty string too, unlike ?? which only catches null.
    // This means leaving Module Settings blank will auto-use the server record credentials.
    $apiUrl    = trim((string) ($params['configoption1'] ?? '')) ?: trim((string) ($params['serverhostname'] ?? ''));
    $apiKey    = trim((string) ($params['configoption2'] ?? '')) ?: trim((string) ($params['serverpassword']  ?? ''));
    $debugMode = ($params['configoption3'] ?? 'no') === 'on';

    // Server record stores bare hostname (e.g. brandforge.software); prepend https:// if missing.
    if ($apiUrl !== '' && !preg_match('#^https?://#i', $apiUrl)) {
        $apiUrl = 'https://' . $apiUrl;
    }

    return new GodmodeClient($apiUrl, $apiKey, new Logger($debugMode));
}

/**
 * Resolve the Godmode plan slug (plan_code) for a WHMCS product ID.
 * Returns null and populates $error when no mapping exists.
 */
function brandforge_resolvePlanCode(int $whmcsProductId, string &$error): ?string
{
    $planCode = PackageLookup::packageSlug($whmcsProductId);

    if ($planCode === null) {
        $error = 'WHMCS product #' . $whmcsProductId . ' is not linked to a Godmode package. '
               . 'Open BrandForge Package Sync, link or auto-create the product, then retry.';
    }

    return $planCode;
}

/**
 * Shared error text for "this service's plan_code can't be resolved
 * anymore" — happens if a product gets unlinked in Package Sync after a
 * customer already has an active service on it.
 */
function brandforge_unlinkedProductError(int $whmcsProductId): string
{
    return 'Cannot resolve the Godmode plan for WHMCS product #' . $whmcsProductId . '. '
         . 'It may have been unlinked in Package Sync since this service was provisioned.';
}

/**
 * Load the service record for a WHMCS service ID.
 * Returns null and populates $error when no record exists.
 */
function brandforge_loadService(int $serviceId, string &$error): ?\stdClass
{
    $service = ServiceRepository::findByServiceId($serviceId);

    if ($service === null) {
        $error = 'No Godmode provisioning record found for service #' . $serviceId . '. '
               . 'The service may need to be re-provisioned.';
    }

    return $service;
}

// ---------------------------------------------------------------------------
// Module metadata
// ---------------------------------------------------------------------------

function brandforge_MetaData(): array
{
    return [
        'DisplayName'              => 'BrandForge',
        'APIVersion'               => '1.1',
        'RequiresServer'           => true,
        'DefaultNonSSLPort'        => '80',
        'DefaultSSLPort'           => '443',
        'ServiceSingleSignOnLabel' => 'Login to BrandForge',
    ];
}

// ---------------------------------------------------------------------------
// Server config options  (shown in WHMCS Product → Module Settings)
// ---------------------------------------------------------------------------

function brandforge_ConfigOptions(): array
{
    return [
        'Godmode API URL' => [
            'Type'        => 'text',
            'Size'        => 60,
            'Default'     => 'https://brandforge.software',
            'Description' => 'Base URL for the Godmode API (no trailing slash)',
        ],
        'Godmode API Key' => [
            'Type'        => 'password',
            'Size'        => 60,
            'Default'     => '',
            'Description' => 'Bearer token for Godmode API authentication',
        ],
        'Debug Mode' => [
            'Type'        => 'yesno',
            'Default'     => 'no',
            'Description' => 'Enable verbose logging to the WHMCS Module Log',
        ],
        'Brand Name' => [
            'Type'        => 'text',
            'Size'        => 40,
            'Default'     => 'BrandForge',
            'Description' => 'Displayed name in the client area (reseller branding)',
        ],
        'Brand Primary Color' => [
            'Type'        => 'text',
            'Size'        => 10,
            'Default'     => '#6366f1',
            'Description' => 'Hex colour for buttons and accents (e.g. #6366f1)',
        ],
        'Frontend App URL' => [
            'Type'        => 'text',
            'Size'        => 60,
            'Default'     => '',
            'Description' => 'Reseller branded app URL (e.g. https://app.yourdomain.com). '
                           . 'Leave blank to use the default BrandForge URL.',
        ],
        'Brand Accent Color' => [
            'Type'        => 'text',
            'Size'        => 10,
            'Default'     => '',
            'Description' => 'Gradient end color for buttons and header (hex, e.g. #8b5cf6). '
                           . 'Leave blank to use Brand Primary Color as a solid (no gradient).',
        ],
    ];
}

// ---------------------------------------------------------------------------
// Test Connection
// ---------------------------------------------------------------------------

function brandforge_TestConnection(array $params): array
{
    try {
        $client = brandforge_buildClient($params);
        $client->testConnection();
        return ['success' => true];
    } catch (GodmodeApiException $e) {
        return ['success' => false, 'error' => $e->getMessage()];
    } catch (\Exception $e) {
        return ['success' => false, 'error' => 'Unexpected error: ' . $e->getMessage()];
    }
}

// ---------------------------------------------------------------------------
// CreateAccount
// ---------------------------------------------------------------------------

function brandforge_CreateAccount(array $params): string
{
    try {
        ServiceRepository::ensureTable();

        $whmcsProductId = (int) ($params['pid'] ?? 0);
        $error          = '';
        $planCode       = brandforge_resolvePlanCode($whmcsProductId, $error);

        if ($planCode === null) {
            return $error;
        }

        $clientId = (int) (
            $params['clientsdetails']['id']
            ?? $params['clientsdetails']['userid']
            ?? $params['userid']
            ?? 0
        );
        $client = brandforge_buildClient($params);

        // Every package after this client's first attaches to the account
        // that already exists, instead of trying (and silently failing) to
        // create a second one. No per-product "is this an add-on" setting —
        // every package behaves the same way; which Godmode call fires is
        // decided entirely by whether this client already has one.
        $active = ServiceRepository::findActiveByClientId($clientId);

        if (!empty($active)) {
            return brandforge_addPlanToExistingAccount(
                $params,
                $client,
                $clientId,
                $whmcsProductId,
                $planCode,
                $active
            );
        }

        $payload = Mapper::createAccountPayload($params, $planCode, $clientId, $whmcsProductId);

        $response = $client->createAccount($payload);

        // Accept both a flat response and a {"data":{...}} envelope
        $data = $response['data'] ?? $response;

        $godmodeServiceId = (string) ($data['service_id']    ?? '');
        $workspaceId      = (string) ($data['workspace_id']  ?? '');
        $userId           = (string) ($data['user_id']       ?? '');

        if ($godmodeServiceId === '') {
            return 'Account provisioned but Godmode returned no service_id. Check the module log.';
        }

        ServiceRepository::insert(
            $clientId,
            (int) ($params['serviceid'] ?? 0),
            $whmcsProductId,
            $godmodeServiceId,
            $workspaceId,
            $userId
        );

        return 'success';

    } catch (GodmodeApiException $e) {
        return $e->getMessage();
    } catch (\Exception $e) {
        return 'Unexpected error: ' . $e->getMessage();
    }
}

/**
 * Attaches $planCode to the account this client already holds, via
 * provision/add_plan — the "every package after the first" path.
 *
 * Guardrail: refuses to attach a plan_code the client already has active.
 * add_plan has no dedup check on Godmode's side — without this, ordering
 * the same package twice would grant its credits twice.
 *
 * @param \stdClass[] $activeSiblings  This client's current active packages,
 *                                     from ServiceRepository::findActiveByClientId().
 */
function brandforge_addPlanToExistingAccount(
    array         $params,
    GodmodeClient $client,
    int           $clientId,
    int           $whmcsProductId,
    string        $planCode,
    array         $activeSiblings
): string {
    foreach ($activeSiblings as $sibling) {
        $siblingPlanCode = PackageLookup::packageSlug((int) $sibling->whmcs_product_id);
        if ($siblingPlanCode !== null && $siblingPlanCode === $planCode) {
            return 'This client already has an active package for this plan. '
                 . 'Ordering it again would grant duplicate credits — cancel the existing one first '
                 . 'if the intent was to replace it.';
        }
    }

    // Any sibling row identifies the same Godmode account — they all share
    // one godmode_service_id. add_plan's response has no workspace_id/user_id
    // (only provision/create returns those), so this reuses the account's
    // existing values rather than leaving them blank.
    $account = $activeSiblings[0];

    $response = $client->addPlan(
        Mapper::addPlanPayload(
            (string) $account->godmode_service_id,
            $planCode,
            $clientId,
            $whmcsProductId,
            (int) ($params['serviceid'] ?? 0)
        )
    );

    // Accept both a flat response and a {"data":{...}} envelope
    $data             = $response['data'] ?? $response;
    $godmodeServiceId = (string) ($data['service_id'] ?? $account->godmode_service_id ?? '');

    if ($godmodeServiceId === '') {
        return 'Plan add request sent but Godmode returned no service_id. Check the module log.';
    }

    ServiceRepository::insert(
        $clientId,
        (int) ($params['serviceid'] ?? 0),
        $whmcsProductId,
        $godmodeServiceId,
        (string) ($account->godmode_workspace_id ?? ''),
        (string) ($account->godmode_user_id ?? '')
    );

    return 'success';
}

// ---------------------------------------------------------------------------
// SuspendAccount
// ---------------------------------------------------------------------------

function brandforge_SuspendAccount(array $params): string
{
    try {
        $serviceId = (int) ($params['serviceid'] ?? 0);
        $error     = '';
        $service   = brandforge_loadService($serviceId, $error);

        if ($service === null) {
            return $error;
        }

        // Always plan-scoped — this WHMCS service is always exactly one
        // specific package, whether or not the client holds others.
        $planCode = PackageLookup::packageSlug((int) $service->whmcs_product_id);
        if ($planCode === null) {
            return brandforge_unlinkedProductError((int) $service->whmcs_product_id);
        }

        $client = brandforge_buildClient($params);
        $client->suspendPlan(
            Mapper::planPayload((string) $service->godmode_service_id, $planCode)
        );

        ServiceRepository::touch($serviceId);
        return 'success';

    } catch (GodmodeApiException $e) {
        return $e->getMessage();
    } catch (\Exception $e) {
        return 'Unexpected error: ' . $e->getMessage();
    }
}

// ---------------------------------------------------------------------------
// UnsuspendAccount
// ---------------------------------------------------------------------------

function brandforge_UnsuspendAccount(array $params): string
{
    try {
        $serviceId = (int) ($params['serviceid'] ?? 0);
        $error     = '';
        $service   = brandforge_loadService($serviceId, $error);

        if ($service === null) {
            return $error;
        }

        $planCode = PackageLookup::packageSlug((int) $service->whmcs_product_id);
        if ($planCode === null) {
            return brandforge_unlinkedProductError((int) $service->whmcs_product_id);
        }

        // Deliberately NEVER falls back to the account-level unsuspend, not
        // even when this is the client's only package. Account-level
        // unsuspend reactivates every currently-suspended plan on the
        // account — if a client has two overdue packages and pays off just
        // one, that call would silently reactivate the other, still-unpaid
        // one too. Plan-scoped, always, no exceptions.
        $client = brandforge_buildClient($params);
        $client->unsuspendPlan(
            Mapper::planPayload((string) $service->godmode_service_id, $planCode)
        );

        ServiceRepository::touch($serviceId);
        return 'success';

    } catch (GodmodeApiException $e) {
        return $e->getMessage();
    } catch (\Exception $e) {
        return 'Unexpected error: ' . $e->getMessage();
    }
}

// ---------------------------------------------------------------------------
// TerminateAccount
// ---------------------------------------------------------------------------

function brandforge_TerminateAccount(array $params): string
{
    try {
        $serviceId = (int) ($params['serviceid'] ?? 0);
        $error     = '';
        $service   = brandforge_loadService($serviceId, $error);

        if ($service === null) {
            return $error;
        }

        $planCode = PackageLookup::packageSlug((int) $service->whmcs_product_id);
        if ($planCode === null) {
            return brandforge_unlinkedProductError((int) $service->whmcs_product_id);
        }

        $client = brandforge_buildClient($params);
        $client->terminatePlan(
            Mapper::planPayload((string) $service->godmode_service_id, $planCode)
        );

        // Record is kept as an audit trail — terminated_at marks it done,
        // the row itself is never deleted.
        ServiceRepository::markTerminated($serviceId);

        // Belt-and-suspenders, terminate only: if this was this client's
        // last remaining package, also confirm the whole account closes out
        // — this call is safe here specifically because nothing else is
        // still active for it to affect, and it removes any dependency on
        // trusting that terminate_plan alone fully derives account-level
        // status. Deliberately best-effort: the plan itself is already
        // correctly terminated above, so a failure here must not report
        // this whole hook as failed. GodmodeClient logs every call itself,
        // success or failure, so nothing is silently lost even if it errors.
        $remaining = ServiceRepository::findActiveByClientId((int) $service->whmcs_client_id);
        if (empty($remaining)) {
            try {
                $client->terminateAccount(Mapper::servicePayload((string) $service->godmode_service_id));
            } catch (\Exception $e) {
                // Intentionally swallowed — see comment above.
            }
        }

        return 'success';

    } catch (GodmodeApiException $e) {
        return $e->getMessage();
    } catch (\Exception $e) {
        return 'Unexpected error: ' . $e->getMessage();
    }
}

// ---------------------------------------------------------------------------
// ChangePackage
// ---------------------------------------------------------------------------

function brandforge_ChangePackage(array $params): string
{
    try {
        $serviceId = (int) ($params['serviceid'] ?? 0);
        $error     = '';
        $service   = brandforge_loadService($serviceId, $error);

        if ($service === null) {
            return $error;
        }

        $oldPlanCode = PackageLookup::packageSlug((int) $service->whmcs_product_id);
        if ($oldPlanCode === null) {
            return brandforge_unlinkedProductError((int) $service->whmcs_product_id);
        }

        $newProductId = (int) ($params['pid'] ?? 0);
        $newPlanCode  = brandforge_resolvePlanCode($newProductId, $error);

        if ($newPlanCode === null) {
            return $error;
        }

        if ($newPlanCode === $oldPlanCode) {
            // Two WHMCS products (e.g. monthly vs. annual billing of the
            // same tier) mapped to the same Godmode plan — nothing to swap
            // on Godmode's side, just re-point the local mapping. Skipping
            // this check would call addPlan on a plan_code already active
            // (Godmode has no dedup guard for that) and then immediately
            // terminate one copy of it, an unnecessary and risky no-op.
            ServiceRepository::updateProduct($serviceId, $newProductId);
            return 'success';
        }

        $clientId = (int) (
            $params['clientsdetails']['id']
            ?? $params['clientsdetails']['userid']
            ?? $params['userid']
            ?? 0
        );
        $client            = brandforge_buildClient($params);
        $godmodeServiceId  = (string) $service->godmode_service_id;

        // Grant the new plan BEFORE removing the old one — deliberately in
        // this order, not using provision/change_package (it currently
        // deactivates every active plan on the account, not just this one).
        // If this call fails, the exception propagates below and the
        // customer simply keeps what they had — nothing lost.
        // Same WHMCS service — it's the one product changing, not the
        // service record — so whmcs_service_id here is $serviceId itself,
        // now representing $newProductId instead of the old product.
        $client->addPlan(Mapper::addPlanPayload(
            $godmodeServiceId,
            $newPlanCode,
            $clientId,
            $newProductId,
            $serviceId
        ));

        // Only remove the old plan once the new one is confirmed active. If
        // THIS call fails, the customer temporarily holds both plans and
        // the local product mapping below is deliberately left unchanged —
        // still pointing at the plan that's actually still fully paid up —
        // rather than silently drifting out of sync with what succeeded.
        $client->terminatePlan(Mapper::planPayload($godmodeServiceId, $oldPlanCode));

        ServiceRepository::updateProduct($serviceId, $newProductId);
        return 'success';

    } catch (GodmodeApiException $e) {
        return $e->getMessage();
    } catch (\Exception $e) {
        return 'Unexpected error: ' . $e->getMessage();
    }
}

// ---------------------------------------------------------------------------
// Client Area
// ---------------------------------------------------------------------------

function brandforge_ClientArea(array $params): array
{
    $serviceId = (int) ($params['serviceid'] ?? 0);
    $service   = ServiceRepository::findByServiceId($serviceId);

    // Base vars available to both provisioned and unprovisioned states.
    $vars = [
        'has_service'    => false,
        'service_status' => $params['status'] ?? 'Unknown',
        'service_id'     => $serviceId,
        'brand_name'            => $params['configoption4'] ?? 'BrandForge',
        'brand_color'           => $params['configoption5'] ?? '#6366f1',
        'brand_color_secondary' => trim((string) ($params['configoption7'] ?? ''))
                                   ?: ($params['configoption5'] ?? '#6366f1'),
    ];

    if ($service === null) {
        return ['templatefile' => 'clientarea', 'vars' => $vars];
    }

    $packageName = PackageLookup::packageName((int) $service->whmcs_product_id)
                  ?? ($params['product']['name'] ?? 'BrandForge Plan');

    // Pre-generate SSO URL so the Launch button is a direct link in the template.
    $ssoUrl      = '';
    $ssoError    = '';
    $frontendUrl = trim((string) ($params['configoption6'] ?? ''));
    $client      = brandforge_buildClient($params);
    try {
        $handler = new SsoHandler($client);
        $ssoUrl  = $handler->getLoginUrl((string) $service->godmode_service_id, '', $frontendUrl);
    } catch (\Exception $e) {
        $ssoError = $e->getMessage();
    }

    // Fetch live usage data from Godmode.
    // Godmode returns: { package, credits, workspaces: { total, active, list: [...] } }
    $serviceInfo      = null;
    $creditsData      = [];
    $workspacesMax    = 0;
    $workspacesActive = 0;
    $workspacesList   = [];
    try {
        $raw            = $client->getServiceInfo((string) $service->godmode_service_id);
        $serviceInfo    = $raw['data'] ?? $raw;
        $creditsData    = $serviceInfo['credits']  ?? [];
        $workspacesMax  = (int) (($serviceInfo['package'] ?? [])['max_workspaces'] ?? 0);
        $wsData         = $serviceInfo['workspaces'] ?? [];
        // Godmode returns workspaces as an object: { total, active, list: [...] }
        $workspacesList   = $wsData['list']   ?? (array_values(array_filter($wsData, 'is_array')) ?: []);
        // Use list count as fallback — Godmode may return active:0 while list is non-empty
        $workspacesActive = (int) ($wsData['active'] ?: count($workspacesList));
    } catch (\Exception $e) {
        // Silently degrade — dashboard shows without live usage data.
    }

    $creditsAllocated = (int) ($creditsData['allocated'] ?? 0);
    $creditsUsed      = (int) ($creditsData['used']      ?? 0);
    $creditsRemaining = (int) ($creditsData['remaining'] ?? max(0, $creditsAllocated - $creditsUsed));
    $creditsPeriodEnd = (string) ($creditsData['period_end'] ?? '');
    $creditsOverLimit = !empty($creditsData['over_limit']);

    $vars = array_merge($vars, [
        'has_service'        => true,
        'package_name'       => $packageName,
        'subscription_id'    => (string) ($service->godmode_service_id   ?? ''),
        'workspace_id'       => (string) ($service->godmode_workspace_id  ?? ''),
        'sso_url'            => $ssoUrl,
        'sso_error'          => $ssoError,
        'created_at'         => (string) ($service->created_at ?? ''),
        'has_usage_data'     => ($serviceInfo !== null),
        'credits_allocated'  => $creditsAllocated,
        'credits_used'       => $creditsUsed,
        'credits_remaining'  => $creditsRemaining,
        'credits_period_end' => $creditsPeriodEnd,
        'credits_over_limit' => $creditsOverLimit,
        'workspaces_max'     => $workspacesMax,
        'workspaces_active'  => $workspacesActive,
        'workspaces'         => $workspacesList,
    ]);

    return ['templatefile' => 'clientarea', 'vars' => $vars];
}

// ---------------------------------------------------------------------------
// Custom button registry
// ---------------------------------------------------------------------------

function brandforge_ClientAreaCustomButtonArray(array $params): array
{
    $brandName = trim((string) ($params['configoption4'] ?? '')) ?: 'BrandForge';
    return [
        'Launch ' . $brandName => 'LaunchBrandForge',
        'View Workspace'       => 'ViewWorkspace',
    ];
}

// ---------------------------------------------------------------------------
// SSO button handlers
// ---------------------------------------------------------------------------

/**
 * Shared SSO helper used by both LaunchBrandForge and ViewWorkspace.
 */
function brandforge_doSso(array $params, string $returnPath = ''): array
{
    $serviceId = (int) ($params['serviceid'] ?? 0);
    $error     = '';
    $service   = brandforge_loadService($serviceId, $error);

    $brandName  = trim((string) ($params['configoption4'] ?? '')) ?: 'BrandForge';
    $brandColor = trim((string) ($params['configoption5'] ?? '')) ?: '#6366f1';
    $brandAccent = trim((string) ($params['configoption7'] ?? '')) ?: $brandColor;

    $baseVars = ['brand_name' => $brandName, 'brand_color' => $brandColor, 'brand_accent' => $brandAccent];

    if ($service === null) {
        return [
            'templatefile' => 'sso_redirect',
            'vars'         => array_merge($baseVars, ['sso_url' => '', 'sso_error' => $error]),
        ];
    }

    $frontendUrl = trim((string) ($params['configoption6'] ?? ''));
    try {
        $handler = new SsoHandler(brandforge_buildClient($params));
        $url     = $handler->getLoginUrl(
            (string) $service->godmode_service_id,
            $returnPath,
            $frontendUrl
        );

        return [
            'templatefile' => 'sso_redirect',
            'vars'         => array_merge($baseVars, ['sso_url' => $url, 'sso_error' => '']),
        ];
    } catch (\Exception $e) {
        return [
            'templatefile' => 'sso_redirect',
            'vars'         => array_merge($baseVars, ['sso_url' => '', 'sso_error' => $e->getMessage()]),
        ];
    }
}

function brandforge_LaunchBrandForge(array $params): array
{
    return brandforge_doSso($params);
}

function brandforge_ViewWorkspace(array $params): array
{
    return brandforge_doSso($params, '/workspace');
}
