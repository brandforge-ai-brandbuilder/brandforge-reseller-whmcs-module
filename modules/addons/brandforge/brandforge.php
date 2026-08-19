<?php
/**
 * BrandForge WHMCS Addon Module — Package Sync
 *
 * Exposes an admin page under Setup → Addon Modules → BrandForge Package Sync
 * that fetches package definitions from the Godmode API, maintains a local
 * mapping table, and auto-creates or links WHMCS products.
 */

if (!defined('WHMCS')) {
    die('Access denied.');
}

// Shared lib (server module)
$_serverLib = __DIR__ . '/../../servers/brandforge/lib/';
require_once $_serverLib . 'Exceptions.php';
require_once $_serverLib . 'Logger.php';
require_once $_serverLib . 'GodmodeClient.php';
require_once $_serverLib . 'ServiceRepository.php';

// Addon lib
$_addonLib = __DIR__ . '/lib/';
require_once $_addonLib . 'PackageRepository.php';
require_once $_addonLib . 'PackageSync.php';
require_once $_addonLib . 'WhmcsProductManager.php';
require_once $_addonLib . 'WhmcsServerManager.php';

use BrandForge\GodmodeClient;
use BrandForge\Logger;
use BrandForge\ServiceRepository;
use BrandForge\Addon\PackageRepository;
use BrandForge\Addon\PackageSync;
use BrandForge\Addon\WhmcsProductManager;
use BrandForge\Addon\WhmcsServerManager;
use WHMCS\Database\Capsule;

// ---------------------------------------------------------------------------
// Module registration
// ---------------------------------------------------------------------------

function brandforge_config(): array
{
    return [
        'name'        => 'BrandForge Package Sync',
        'description' => 'Synchronise Godmode packages with WHMCS products and maintain the provisioning mapping table.',
        'version'     => '1.1.0',
        'author'      => 'BrandForge',
        'fields'      => [
            'godmode_api_url' => [
                'FriendlyName' => 'Godmode API URL',
                'Type'         => 'text',
                'Size'         => 60,
                'Default'      => 'https://staging.brandforge.software',
                'Description'  => 'Base URL for the Godmode API (no trailing slash)',
            ],
            'godmode_api_key' => [
                'FriendlyName' => 'Godmode API Key',
                'Type'         => 'password',
                'Size'         => 60,
                'Default'      => '',
                'Description'  => 'Bearer token used for all Godmode API requests',
            ],
            'debug_mode' => [
                'FriendlyName' => 'Debug Mode',
                'Type'         => 'yesno',
                'Default'      => 'no',
                'Description'  => 'Write verbose API logs to the WHMCS Module Log',
            ],
        ],
    ];
}

// ---------------------------------------------------------------------------
// Lifecycle
// ---------------------------------------------------------------------------

function brandforge_activate(): array
{
    try {
        PackageRepository::createTable();
        ServiceRepository::ensureTable();
        return [
            'status'      => 'success',
            'description' => 'BrandForge Package Sync activated. Package and service mapping tables created.',
        ];
    } catch (\Exception $e) {
        return [
            'status'      => 'error',
            'description' => 'Activation failed: ' . $e->getMessage(),
        ];
    }
}

function brandforge_deactivate(): array
{
    // Tables are kept on deactivation to preserve mappings across reinstalls.
    return [
        'status'      => 'success',
        'description' => 'BrandForge Package Sync deactivated. Mapping data preserved.',
    ];
}

function brandforge_upgrade(array $vars): void
{
    // Reserved for future schema migrations.
}

// ---------------------------------------------------------------------------
// Admin output
// ---------------------------------------------------------------------------

function brandforge_output(array $vars): void
{
    $moduleLink = $vars['modulelink'];
    $apiUrl     = rtrim((string) ($vars['godmode_api_url'] ?? ''), '/');
    $apiKey     = (string) ($vars['godmode_api_key'] ?? '');
    $debugMode  = ($vars['debug_mode'] ?? 'no') === 'on';

    $client = new GodmodeClient($apiUrl, $apiKey, new Logger($debugMode));
    $sync   = new PackageSync($client);

    $token = $_SESSION['token'] ?? '';

    // -----------------------------------------------------------------------
    // Handle POST actions
    // -----------------------------------------------------------------------
    $flash     = '';
    $flashType = 'info';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['token']) && $token && $_POST['token'] !== $token) {
            $flash     = 'Invalid security token. Please refresh the page and try again.';
            $flashType = 'danger';
        } else {
            $action    = $_POST['action']    ?? '';
            $packageId = $_POST['package_id'] ?? '';

            try {
                switch ($action) {

                    // -----------------------------------------------------------
                    // One-Click Setup
                    // -----------------------------------------------------------
                    case 'auto_setup':
                        if ($apiUrl === '' || $apiKey === '') {
                            throw new \RuntimeException(
                                'Godmode API URL and API Key must be saved in the addon settings before running setup.'
                            );
                        }

                        // 1. Verify the API key works before touching anything
                        $client->testConnection();

                        // 2. Server group + server record
                        $groupId = WhmcsServerManager::findOrCreateServerGroup();
                        if (WhmcsServerManager::getServer() === null) {
                            WhmcsServerManager::createServer($apiUrl, $apiKey, $groupId);
                        }

                        // 3. Sync all packages from Godmode
                        $syncResult = $sync->syncAll();

                        // 4. Create a WHMCS product for every unlinked package
                        $mappings = PackageRepository::all();
                        $created  = 0;
                        $errors   = [];
                        foreach ($mappings as $m) {
                            if (!empty($m->whmcs_product_id)) {
                                continue;
                            }
                            try {
                                $newId = WhmcsProductManager::createProductFull(
                                    $m->godmode_name,
                                    $groupId,
                                    $apiUrl,
                                    $apiKey
                                );
                                PackageRepository::setWhmcsProduct($m->godmode_package_id, $newId);
                                $created++;
                            } catch (\Exception $e) {
                                $errors[] = '"' . $m->godmode_name . '": ' . $e->getMessage();
                            }
                        }

                        $flash = 'Setup complete! '
                            . "Synced {$syncResult['synced']} package(s) and created {$created} WHMCS product(s). "
                            . 'Add pricing to each product, then you are ready to sell.';
                        if (!empty($errors)) {
                            $flash    .= ' Errors: ' . implode('; ', $errors);
                            $flashType = 'warning';
                        } else {
                            $flashType = 'success';
                        }
                        break;

                    // -----------------------------------------------------------
                    // Create WHMCS products for any remaining unlinked packages
                    // -----------------------------------------------------------
                    case 'setup_all_products':
                        $groupId  = WhmcsServerManager::findOrCreateServerGroup();
                        $mappings = PackageRepository::all();
                        $created  = 0;
                        $errors   = [];
                        foreach ($mappings as $m) {
                            if (!empty($m->whmcs_product_id)) {
                                continue;
                            }
                            try {
                                $newId = WhmcsProductManager::createProductFull(
                                    $m->godmode_name,
                                    $groupId,
                                    $apiUrl,
                                    $apiKey
                                );
                                PackageRepository::setWhmcsProduct($m->godmode_package_id, $newId);
                                $created++;
                            } catch (\Exception $e) {
                                $errors[] = '"' . $m->godmode_name . '": ' . $e->getMessage();
                            }
                        }
                        $flash     = "Created {$created} product(s).";
                        $flashType = empty($errors) ? 'success' : 'warning';
                        if (!empty($errors)) {
                            $flash .= ' Errors: ' . implode('; ', $errors);
                        }
                        break;

                    // -----------------------------------------------------------
                    // Reset everything — no phpMyAdmin needed
                    // -----------------------------------------------------------
                    case 'reset_all':
                        // Drop and immediately recreate tables so subsequent queries
                        // never hit a missing-table error even if deleteAll() throws.
                        Capsule::schema()->dropIfExists('mod_brandforge_services');
                        Capsule::schema()->dropIfExists('mod_brandforge_packages');
                        PackageRepository::createTable();
                        ServiceRepository::ensureTable();
                        // Server records are separate — delete after tables are safe.
                        WhmcsServerManager::deleteAll();
                        $flash     = 'Reset complete. Mapping tables cleared and server record removed. '
                                   . 'Your WHMCS products were kept — run One-Click Setup to re-link them '
                                   . '(no duplicates will be created).';
                        $flashType = 'success';
                        break;

                    // -----------------------------------------------------------
                    // Existing per-package actions
                    // -----------------------------------------------------------
                    case 'sync_all':
                        $result = $sync->syncAll();
                        $flash  = "Synced {$result['synced']} package(s) from Godmode.";
                        if (!empty($result['errors'])) {
                            $flash    .= ' Errors: ' . implode('; ', $result['errors']);
                            $flashType = 'warning';
                        } else {
                            $flashType = 'success';
                        }
                        break;

                    case 'sync_single':
                        brandforge_requirePackageId($packageId);
                        $sync->syncSingle($packageId);
                        $flash     = 'Package synced successfully.';
                        $flashType = 'success';
                        break;

                    case 'rebuild_mapping':
                        $result    = $sync->rebuildMapping();
                        $flash     = "Mapping rebuilt — {$result['synced']} package(s) synced";
                        if (($result['reconnected'] ?? 0) > 0) {
                            $flash .= ", {$result['reconnected']} existing product(s) re-linked";
                        }
                        $flash    .= '.';
                        $flashType = 'success';
                        break;

                    case 'auto_create_product':
                        brandforge_requirePackageId($packageId);
                        $mapping = PackageRepository::findByGodmodeId($packageId);
                        if (!$mapping) {
                            throw new \RuntimeException('Package not in local table. Run Sync All first.');
                        }
                        if (!empty($mapping->whmcs_product_id)) {
                            throw new \RuntimeException('Package already has a linked WHMCS product.');
                        }
                        $newId = WhmcsProductManager::createProduct(
                            $mapping->godmode_name,
                            $mapping->godmode_slug
                        );
                        PackageRepository::setWhmcsProduct($packageId, $newId);
                        $flash     = 'WHMCS product #' . $newId . ' "' . $mapping->godmode_name . '" created and linked.';
                        $flashType = 'success';
                        break;

                    case 'link_product':
                        brandforge_requirePackageId($packageId);
                        $whmcsId = (int) ($_POST['whmcs_product_id'] ?? 0);
                        if ($whmcsId <= 0) {
                            throw new \RuntimeException('Please select a WHMCS product to link.');
                        }
                        PackageRepository::setWhmcsProduct($packageId, $whmcsId);
                        $flash     = "Package linked to WHMCS product #{$whmcsId}.";
                        $flashType = 'success';
                        break;

                    case 'unlink_product':
                        brandforge_requirePackageId($packageId);
                        PackageRepository::setWhmcsProduct($packageId, null);
                        $flash     = 'Product link removed.';
                        $flashType = 'info';
                        break;

                    default:
                        $flash     = 'Unknown action.';
                        $flashType = 'warning';
                }
            } catch (\Exception $e) {
                $flash     = 'Error: ' . $e->getMessage();
                $flashType = 'danger';
            }
        }
    }

    // -----------------------------------------------------------------------
    // Gather data for rendering
    // -----------------------------------------------------------------------
    $mappings      = PackageRepository::all();
    $whmcsProducts = WhmcsProductManager::getAllProducts();
    $server        = WhmcsServerManager::getServer();

    $whmcsProductMap = [];
    foreach ($whmcsProducts as $p) {
        $whmcsProductMap[(int) $p->id] = $p->name;
    }

    $lastSync    = 'Never';
    $linkedCount = 0;
    if (!empty($mappings)) {
        $dates    = array_map(fn ($r) => $r->updated_at, $mappings);
        $lastSync = max($dates);
        foreach ($mappings as $r) {
            if (!empty($r->whmcs_product_id)) {
                $linkedCount++;
            }
        }
    }

    $isFullySetUp = $server !== null && count($mappings) > 0;

    brandforge_renderPage(
        $moduleLink,
        $token,
        $flash,
        $flashType,
        $mappings,
        $whmcsProducts,
        $whmcsProductMap,
        $lastSync,
        $linkedCount,
        $server,
        $isFullySetUp,
        $apiUrl,
        $apiKey
    );
}

// ---------------------------------------------------------------------------
// Render helpers
// ---------------------------------------------------------------------------

function brandforge_requirePackageId(string $id): void
{
    if ($id === '') {
        throw new \RuntimeException('No package ID supplied.');
    }
}

function brandforge_renderPage(
    string   $moduleLink,
    string   $token,
    string   $flash,
    string   $flashType,
    array    $mappings,
    array    $whmcsProducts,
    array    $whmcsProductMap,
    string   $lastSync,
    int      $linkedCount,
    ?\stdClass $server,
    bool     $isFullySetUp,
    string   $apiUrl,
    string   $apiKey
): void {
    $total   = count($mappings);
    $pending = $total - $linkedCount;
    $mlHtml  = htmlspecialchars($moduleLink);
    $tkHtml  = htmlspecialchars($token);

    $hasCreds   = $apiUrl !== '' && $apiKey !== '';
    $hasServer  = $server !== null;
    $hasPkgs    = $total > 0;
    $allLinked  = $total > 0 && $pending === 0;
    ?>
    <style>
        /* ---- layout ---- */
        .bf-header   { display:flex; align-items:center; justify-content:space-between; margin-bottom:18px; }
        .bf-header h2{ margin:0; font-size:20px; }

        /* ---- status bar ---- */
        .bf-status   { display:flex; align-items:center; gap:10px; flex-wrap:wrap;
                       background:#fff; border:1px solid #ddd; border-radius:4px;
                       padding:10px 16px; margin-bottom:18px; font-size:13px; }
        .bf-status-item { display:flex; align-items:center; gap:5px; }
        .bf-status-item .dot { width:10px; height:10px; border-radius:50%; display:inline-block; }
        .dot-ok   { background:#5cb85c; }
        .dot-warn { background:#f0ad4e; }
        .dot-no   { background:#d9534f; }
        .bf-status-sep { color:#ccc; }

        /* ---- wizard ---- */
        .bf-wizard   { background:linear-gradient(135deg,#6366f1 0%,#4f46e5 100%);
                       color:#fff; border-radius:6px; padding:28px 32px; margin-bottom:24px; }
        .bf-wizard h3{ margin:0 0 8px; font-size:18px; color:#fff; }
        .bf-wizard p { margin:0 0 20px; opacity:.9; font-size:14px; }
        .bf-wizard ul{ margin:0 0 24px; padding-left:20px; opacity:.9; font-size:14px; line-height:1.8; }
        .bf-wizard .btn-setup { background:#fff; color:#4f46e5; border:none; font-weight:700;
                                font-size:15px; padding:10px 28px; border-radius:4px; cursor:pointer; }
        .bf-wizard .btn-setup:hover { background:#f0f0ff; }
        .bf-wizard .btn-setup:disabled { opacity:.5; cursor:not-allowed; }

        /* ---- stats ---- */
        .bf-stats    { display:flex; gap:16px; margin-bottom:20px; }
        .bf-stat     { background:#f5f5f5; border:1px solid #ddd; border-radius:4px;
                       padding:12px 20px; text-align:center; min-width:110px; }
        .bf-stat-val { font-size:26px; font-weight:700; line-height:1; }
        .bf-stat-lbl { font-size:11px; color:#777; margin-top:4px; text-transform:uppercase; }
        .bf-stat.linked .bf-stat-val   { color:#5cb85c; }
        .bf-stat.pending .bf-stat-val  { color:#f0ad4e; }

        /* ---- table ---- */
        .bf-actions-cell { white-space:nowrap; }
        .bf-actions-cell .btn + .btn,
        .bf-actions-cell form + form   { margin-left:4px; }
        .bf-link-row { display:flex; align-items:center; gap:4px; margin-top:6px; }
        code         { font-size:12px; background:#f0f0f0; padding:1px 5px; border-radius:3px; }

        /* ---- next steps ---- */
        .bf-next     { background:#f0fdf4; border:1px solid #bbf7d0; border-radius:4px;
                       padding:14px 18px; margin-bottom:20px; font-size:13px; }
        .bf-next strong { color:#15803d; }

        /* ---- loading overlay ---- */
        #bf-overlay {
            display:none; position:fixed; inset:0; z-index:99999;
            background:rgba(15,15,35,.72); backdrop-filter:blur(3px);
            align-items:center; justify-content:center;
        }
        .bf-overlay-box {
            background:#fff; border-radius:10px; padding:36px 44px;
            max-width:420px; width:90%; text-align:center;
            box-shadow:0 20px 60px rgba(0,0,0,.35);
        }
        .bf-spinner {
            width:52px; height:52px; border-radius:50%;
            border:4px solid #e0e0f0; border-top-color:#6366f1;
            animation:bf-spin .8s linear infinite; margin:0 auto 20px;
        }
        @keyframes bf-spin { to { transform:rotate(360deg); } }
        .bf-overlay-title {
            font-size:17px; font-weight:700; color:#111; margin-bottom:6px;
        }
        .bf-overlay-sub {
            font-size:13px; color:#6b7280; margin-bottom:22px; line-height:1.5;
        }
        .bf-steps { list-style:none; margin:0; padding:0; text-align:left; }
        .bf-steps li {
            font-size:13px; color:#6b7280; padding:5px 0;
            display:flex; align-items:center; gap:9px;
            opacity:0; transform:translateY(6px);
            animation:bf-fadein .4s ease forwards;
        }
        .bf-steps li:nth-child(1) { animation-delay:.3s; }
        .bf-steps li:nth-child(2) { animation-delay:1.2s; }
        .bf-steps li:nth-child(3) { animation-delay:2.4s; }
        .bf-steps li:nth-child(4) { animation-delay:3.8s; }
        @keyframes bf-fadein {
            to { opacity:1; transform:translateY(0); }
        }
        .bf-step-icon {
            width:20px; height:20px; border-radius:50%; flex-shrink:0;
            border:2px solid #c7d2fe; border-top-color:#6366f1;
            animation:bf-spin .9s linear infinite;
        }
        .bf-overlay-note {
            margin-top:20px; font-size:11.5px; color:#9ca3af;
        }
        /* simple spinner for other buttons */
        .bf-btn-loading { position:relative; pointer-events:none; opacity:.75; }
        .bf-btn-loading::after {
            content:''; position:absolute; right:-22px; top:50%;
            transform:translateY(-50%);
            width:14px; height:14px; border-radius:50%;
            border:2px solid rgba(255,255,255,.4); border-top-color:#fff;
            animation:bf-spin .7s linear infinite;
        }
    </style>

    <div class="bf-wrap">

        <!-- Header -->
        <div class="bf-header">
            <h2>BrandForge &mdash; Package Sync</h2>
            <?php if ($isFullySetUp): ?>
            <div style="display:flex;gap:8px;align-items:center">
                <form method="post" action="<?= $mlHtml ?>" style="display:inline">
                    <input type="hidden" name="token"  value="<?= $tkHtml ?>">
                    <input type="hidden" name="action" value="sync_all">
                    <button type="submit" class="btn btn-primary btn-sm bf-async-btn"
                            data-loading-text="Syncing&hellip;">
                        <i class="fas fa-sync-alt"></i>&nbsp; Sync Packages
                    </button>
                </form>
                <?php if ($pending > 0): ?>
                <form method="post" action="<?= $mlHtml ?>" style="display:inline">
                    <input type="hidden" name="token"  value="<?= $tkHtml ?>">
                    <input type="hidden" name="action" value="setup_all_products">
                    <button type="submit" class="btn btn-success btn-sm bf-async-btn"
                            data-loading-text="Creating&hellip;">
                        <i class="fas fa-magic"></i>&nbsp; Create All Products
                    </button>
                </form>
                <?php endif; ?>
                <form method="post" action="<?= $mlHtml ?>" style="display:inline">
                    <input type="hidden" name="token"  value="<?= $tkHtml ?>">
                    <input type="hidden" name="action" value="reset_all">
                    <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('This clears all package/service mapping data and removes the server record.\n\nYour WHMCS products are kept — re-running setup will re-link them without creating duplicates.\n\nContinue?')">
                        <i class="fas fa-trash"></i>&nbsp; Reset Everything
                    </button>
                </form>
            </div>
            <?php endif; ?>
        </div>

        <!-- Flash message -->
        <?php if ($flash !== ''): ?>
            <div class="alert alert-<?= htmlspecialchars($flashType) ?> alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <?= htmlspecialchars($flash) ?>
            </div>
        <?php endif; ?>

        <!-- Status Bar -->
        <div class="bf-status">
            <div class="bf-status-item">
                <span class="dot <?= $hasCreds ? 'dot-ok' : 'dot-no' ?>"></span>
                <span><strong>API Credentials</strong> <?= $hasCreds ? 'Saved' : 'Not set &mdash; save settings first' ?></span>
            </div>
            <span class="bf-status-sep">|</span>
            <div class="bf-status-item">
                <span class="dot <?= $hasServer ? 'dot-ok' : 'dot-warn' ?>"></span>
                <span><strong>Server Record</strong> <?= $hasServer ? 'Configured' : 'Not created' ?></span>
            </div>
            <span class="bf-status-sep">|</span>
            <div class="bf-status-item">
                <span class="dot <?= $hasPkgs ? 'dot-ok' : 'dot-warn' ?>"></span>
                <span><strong>Packages</strong> <?= $total > 0 ? "{$total} synced" : 'Not synced' ?></span>
            </div>
            <span class="bf-status-sep">|</span>
            <div class="bf-status-item">
                <span class="dot <?= $allLinked ? 'dot-ok' : ($linkedCount > 0 ? 'dot-warn' : 'dot-no') ?>"></span>
                <span><strong>Products</strong>
                    <?php if ($total === 0): ?>Not created
                    <?php elseif ($allLinked): ?><?= $linkedCount ?> / <?= $total ?> ready
                    <?php else: ?><?= $linkedCount ?> / <?= $total ?> linked
                    <?php endif; ?>
                </span>
            </div>
        </div>

        <?php if (!$isFullySetUp): ?>
        <!-- One-Click Setup Wizard -->
        <div class="bf-wizard">
            <h3>&#x1F680; One-Click Setup</h3>
            <p>Your API credentials are saved in the addon settings. Click the button below to configure everything automatically &mdash; no technical steps required.</p>
            <ul>
                <li>Creates a WHMCS server record using your API credentials</li>
                <li>Pulls all your Godmode packages</li>
                <li>Creates a WHMCS product for each package</li>
                <li>Links all products to the BrandForge module, fully configured</li>
            </ul>
            <?php if (!$hasCreds): ?>
                <p style="background:rgba(255,255,255,.2);padding:10px 14px;border-radius:4px;margin-bottom:16px">
                    &#x26A0;&#xFE0F; Please save your <strong>Godmode API URL</strong> and <strong>API Key</strong>
                    in the addon settings (Configure button on the Addon Modules page) before running setup.
                </p>
                <button class="btn-setup" disabled>Setup Unavailable &mdash; Save Credentials First</button>
            <?php else: ?>
                <form id="bf-setup-form" method="post" action="<?= $mlHtml ?>">
                    <input type="hidden" name="token"  value="<?= $tkHtml ?>">
                    <input type="hidden" name="action" value="auto_setup">
                    <button type="submit" class="btn-setup">
                        &#x1F680; Run One-Click Setup
                    </button>
                </form>
            <?php endif; ?>
        </div>

        <?php else: ?>
        <!-- Next Steps after full setup -->
        <?php if ($allLinked): ?>
        <div class="bf-next">
            <strong>&#x2705; Setup complete.</strong>
            Add pricing to each product under
            <strong>Products/Services &rarr; Products/Services &rarr; [Product] &rarr; Pricing</strong>,
            then your customers can order.
            When Godmode adds new packages, click <strong>Sync Packages</strong> then
            <strong>Create All Products</strong>.
        </div>
        <?php endif; ?>

        <!-- Stats -->
        <div class="bf-stats">
            <div class="bf-stat">
                <div class="bf-stat-val"><?= $total ?></div>
                <div class="bf-stat-lbl">Total</div>
            </div>
            <div class="bf-stat linked">
                <div class="bf-stat-val"><?= $linkedCount ?></div>
                <div class="bf-stat-lbl">Linked</div>
            </div>
            <div class="bf-stat pending">
                <div class="bf-stat-val"><?= $pending ?></div>
                <div class="bf-stat-lbl">Pending</div>
            </div>
        </div>

        <!-- Package table -->
        <?php if (empty($mappings)): ?>
            <div class="alert alert-info">
                No packages synced yet. Click <strong>Sync Packages</strong> to pull from Godmode.
            </div>
        <?php else: ?>
            <table class="table table-bordered table-striped table-hover" style="font-size:13px">
                <thead>
                    <tr>
                        <th>Package Name</th>
                        <th>Plan ID <small class="text-muted">(for Godmode)</small></th>
                        <th>Godmode ID</th>
                        <th>Product ID <small class="text-muted">(for Godmode)</small></th>
                        <th>WHMCS Product</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($mappings as $row):
                    $gid        = htmlspecialchars($row->godmode_package_id);
                    $isLinked   = !empty($row->whmcs_product_id);
                    $productLabel = $isLinked
                        ? htmlspecialchars($whmcsProductMap[(int)$row->whmcs_product_id]
                            ?? "Product #{$row->whmcs_product_id}")
                        : '';
                ?>
                    <tr>
                        <td><strong><?= htmlspecialchars($row->godmode_name) ?></strong></td>
                        <td><code><?= htmlspecialchars($row->godmode_slug) ?></code></td>
                        <td><small class="text-muted"><?= $gid ?></small></td>
                        <td>
                            <?php if ($isLinked): ?>
                                <code><?= (int) $row->whmcs_product_id ?></code>
                            <?php else: ?>
                                <span class="text-muted">&mdash;</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($isLinked): ?>
                                <span class="label label-success"><?= $productLabel ?></span>
                            <?php else: ?>
                                <span class="text-muted">&mdash;</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($isLinked): ?>
                                <span class="label label-success">Synced</span>
                            <?php else: ?>
                                <span class="label label-warning">Pending</span>
                            <?php endif; ?>
                        </td>
                        <td class="bf-actions-cell">
                            <!-- Sync single -->
                            <form method="post" action="<?= $mlHtml ?>" style="display:inline">
                                <input type="hidden" name="token"      value="<?= $tkHtml ?>">
                                <input type="hidden" name="action"     value="sync_single">
                                <input type="hidden" name="package_id" value="<?= $gid ?>">
                                <button type="submit" class="btn btn-xs btn-info" title="Re-pull this package from Godmode">
                                    <i class="fas fa-sync"></i> Sync
                                </button>
                            </form>

                            <?php if (!$isLinked): ?>
                                <!-- Auto-create WHMCS product -->
                                <form method="post" action="<?= $mlHtml ?>" style="display:inline">
                                    <input type="hidden" name="token"      value="<?= $tkHtml ?>">
                                    <input type="hidden" name="action"     value="auto_create_product">
                                    <input type="hidden" name="package_id" value="<?= $gid ?>">
                                    <button type="submit" class="btn btn-xs btn-success" title="Create a new WHMCS product and link it">
                                        <i class="fas fa-plus-circle"></i> Auto Create
                                    </button>
                                </form>

                                <!-- Link existing product -->
                                <form method="post" action="<?= $mlHtml ?>" class="bf-link-row">
                                    <input type="hidden" name="token"      value="<?= $tkHtml ?>">
                                    <input type="hidden" name="action"     value="link_product">
                                    <input type="hidden" name="package_id" value="<?= $gid ?>">
                                    <select name="whmcs_product_id" class="form-control input-sm"
                                            style="width:175px;display:inline-block">
                                        <option value="">Link existing&hellip;</option>
                                        <?php foreach ($whmcsProducts as $p): ?>
                                            <option value="<?= (int) $p->id ?>">
                                                <?= htmlspecialchars($p->name) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <button type="submit" class="btn btn-xs btn-primary">Link</button>
                                </form>

                            <?php else: ?>
                                <!-- Unlink -->
                                <form method="post" action="<?= $mlHtml ?>" style="display:inline">
                                    <input type="hidden" name="token"      value="<?= $tkHtml ?>">
                                    <input type="hidden" name="action"     value="unlink_product">
                                    <input type="hidden" name="package_id" value="<?= $gid ?>">
                                    <button type="submit" class="btn btn-xs btn-danger"
                                            onclick="return confirm('Remove product link for \'<?= htmlspecialchars(addslashes($row->godmode_name)) ?>\'?')">
                                        <i class="fas fa-unlink"></i> Unlink
                                    </button>
                                </form>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

        <hr>
        <p class="text-muted" style="font-size:11px">
            <?= $total ?> package(s) in local mapping &mdash;
            last updated: <?= htmlspecialchars($lastSync) ?>
        </p>
        <?php endif; ?>

    </div>

    <!-- Loading overlay (One-Click Setup) -->
    <div id="bf-overlay">
        <div class="bf-overlay-box">
            <div class="bf-spinner"></div>
            <div class="bf-overlay-title">Setting up BrandForge&hellip;</div>
            <div class="bf-overlay-sub">This takes about 10&ndash;30 seconds. Please do not close this page.</div>
            <ul class="bf-steps">
                <li><span class="bf-step-icon"></span> Connecting to Godmode API</li>
                <li><span class="bf-step-icon"></span> Creating server record</li>
                <li><span class="bf-step-icon"></span> Syncing packages from Godmode</li>
                <li><span class="bf-step-icon"></span> Creating WHMCS products</li>
            </ul>
            <p class="bf-overlay-note">You will be redirected automatically when setup completes.</p>
        </div>
    </div>

    <script>
    (function () {
        var overlay = document.getElementById('bf-overlay');

        // One-Click Setup: show full overlay with steps
        var setupForm = document.getElementById('bf-setup-form');
        if (setupForm) {
            setupForm.addEventListener('submit', function (e) {
                e.preventDefault();
                if (!confirm('This will create a server record, sync packages, and auto-create WHMCS products. Ready to go?')) {
                    return;
                }
                overlay.style.display = 'flex';
                setupForm.submit();
            });
        }

        // Sync Packages / Create All Products: simple button spinner
        document.querySelectorAll('.bf-async-btn').forEach(function (btn) {
            btn.closest('form').addEventListener('submit', function () {
                btn.classList.add('bf-btn-loading');
                btn.disabled = true;
                btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>&nbsp; ' + btn.getAttribute('data-loading-text');
            });
        });
    }());
    </script>
    <?php
}
