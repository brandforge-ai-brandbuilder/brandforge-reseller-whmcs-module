<?php

namespace BrandForge;

/**
 * Builds Godmode API request payloads from WHMCS module params.
 *
 * Field names match the actual Godmode API contract (verified 2026-07-20):
 *  - create  : flat body, plan_code = slug from packages list
 *  - lifecycle: service_id (Godmode's UUID for the provisioned account)
 *  - change  : service_id + plan_code (slug of the new plan)
 */
class Mapper
{
    /**
     * POST /api/godmode/v1/provision/create
     *
     * @param array  $params          WHMCS module params
     * @param string $planCode        Godmode slug from mod_brandforge_packages.godmode_slug
     * @param int    $whmcsClientId   tblclients.id — the WHMCS customer placing this order
     * @param int    $whmcsProductId  tblproducts.id — the WHMCS catalog product being ordered
     */
    public static function createAccountPayload(
        array  $params,
        string $planCode,
        int    $whmcsClientId,
        int    $whmcsProductId
    ): array {
        $client = $params['clientsdetails'] ?? [];

        return [
            'email'             => $client['email']       ?? '',
            'first_name'        => $client['firstname']   ?? '',
            'last_name'         => $client['lastname']     ?? '',
            'company_name'      => $client['companyname']  ?? '',
            'plan_code'         => $planCode,
            // The client's WHMCS account password, passed through so Godmode
            // can provision the BrandForge account with matching credentials.
            // WHMCS decrypts and populates this for provisioning modules —
            // see $params['password'] in the module-parameters reference.
            // GodmodeClient::sanitizePayload() + the logModuleCall replacement
            // list both redact this specific value before it ever reaches the
            // WHMCS Module Log — see GodmodeClient::request().
            'password'          => (string) ($params['password'] ?? ''),
            // Round-tripped so Godmode can build a WHMCS deep link (e.g. the
            // Settings → Billing upgrade/downgrade URL) without ever needing
            // to reach into the reseller's WHMCS database itself.
            'whmcs_client_id'   => $whmcsClientId,
            'whmcs_product_id'  => $whmcsProductId,
            'whmcs_service_id'  => (int) ($params['serviceid'] ?? 0),
        ];
    }

    /**
     * POST /api/godmode/v1/provision/suspend
     * POST /api/godmode/v1/provision/unsuspend
     * POST /api/godmode/v1/provision/terminate
     */
    public static function servicePayload(string $godmodeServiceId): array
    {
        return ['service_id' => $godmodeServiceId];
    }

    /**
     * POST /api/godmode/v1/provision/change_package
     *
     * @param string $godmodeServiceId  Stored in mod_brandforge_services.godmode_service_id
     * @param string $planCode          New plan's slug from mod_brandforge_packages.godmode_slug
     */
    public static function changePackagePayload(string $godmodeServiceId, string $planCode): array
    {
        return [
            'service_id' => $godmodeServiceId,
            'plan_code'  => $planCode,
        ];
    }

    /**
     * POST /api/godmode/v1/provision/suspend_plan
     * POST /api/godmode/v1/provision/unsuspend_plan
     * POST /api/godmode/v1/provision/terminate_plan
     *
     * Deliberately minimal — these three act on a plan record Godmode
     * already has (created via createAccountPayload/addPlanPayload below,
     * both of which already carried the WHMCS identifiers), so there's
     * nothing new to (re-)send here.
     *
     * @param string $godmodeServiceId  The ACCOUNT's service_id — shared by
     *                                  every package a customer holds, not
     *                                  specific to any one WHMCS service row.
     * @param string $planCode          The one plan_code this call acts on.
     */
    public static function planPayload(string $godmodeServiceId, string $planCode): array
    {
        return [
            'service_id' => $godmodeServiceId,
            'plan_code'  => $planCode,
        ];
    }

    /**
     * POST /api/godmode/v1/provision/add_plan
     *
     * Unlike planPayload() above, this is specifically for the moment a plan
     * record is CREATED — a customer's second-or-later package (CreateAccount's
     * add-to-existing-account path), or the new plan half of a ChangePackage
     * swap. Both are genuinely new plan records on Godmode's side, so both
     * carry the same WHMCS identifiers createAccountPayload() sends for a
     * customer's first package — same reasoning as there.
     *
     * @param string $godmodeServiceId  The ACCOUNT's service_id.
     * @param string $planCode          The plan_code being attached.
     * @param int    $whmcsClientId     tblclients.id
     * @param int    $whmcsProductId    tblproducts.id — the product now backing this plan
     * @param int    $whmcsServiceId    tblhosting.id — the WHMCS service this plan is for
     */
    public static function addPlanPayload(
        string $godmodeServiceId,
        string $planCode,
        int    $whmcsClientId,
        int    $whmcsProductId,
        int    $whmcsServiceId
    ): array {
        return [
            'service_id'        => $godmodeServiceId,
            'plan_code'         => $planCode,
            'whmcs_client_id'   => $whmcsClientId,
            'whmcs_product_id'  => $whmcsProductId,
            'whmcs_service_id'  => $whmcsServiceId,
        ];
    }
}
