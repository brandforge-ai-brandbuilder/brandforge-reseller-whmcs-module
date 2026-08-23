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
     * @param array  $params        WHMCS module params
     * @param string $planCode      Godmode slug from mod_brandforge_packages.godmode_slug
     */
    public static function createAccountPayload(array $params, string $planCode): array
    {
        $client = $params['clientsdetails'] ?? [];

        return [
            'email'        => $client['email']       ?? '',
            'first_name'   => $client['firstname']   ?? '',
            'last_name'    => $client['lastname']     ?? '',
            'company_name' => $client['companyname']  ?? '',
            'plan_code'    => $planCode,
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
     * POST /api/godmode/v1/provision/add_plan
     * POST /api/godmode/v1/provision/suspend_plan   (Phase 2)
     * POST /api/godmode/v1/provision/unsuspend_plan (Phase 2)
     * POST /api/godmode/v1/provision/terminate_plan (Phase 2/3)
     *
     * All four take the identical shape — one specific plan on an existing
     * account — so one builder covers every plan-scoped call the module
     * makes after a customer's first package.
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
}
