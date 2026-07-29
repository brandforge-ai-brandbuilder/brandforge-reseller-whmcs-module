<?php

namespace BrandForge;

use WHMCS\Database\Capsule;

/**
 * Thin query layer over mod_brandforge_packages for use inside the
 * server module without depending on the addon module's PackageRepository.
 */
class PackageLookup
{
    /**
     * Return the Godmode package ID that is mapped to a WHMCS product ID.
     * Returns null when no mapping exists or the product has not been linked.
     */
    public static function godmodePackageId(int $whmcsProductId): ?string
    {
        $row = Capsule::table('mod_brandforge_packages')
            ->where('whmcs_product_id', $whmcsProductId)
            ->select('godmode_package_id')
            ->first();

        return ($row && $row->godmode_package_id !== null)
            ? (string) $row->godmode_package_id
            : null;
    }

    /**
     * Return the Godmode plan slug (plan_code) for a WHMCS product ID.
     * This is what Godmode's create and change_package endpoints expect.
     */
    public static function packageSlug(int $whmcsProductId): ?string
    {
        $row = Capsule::table('mod_brandforge_packages')
            ->where('whmcs_product_id', $whmcsProductId)
            ->select('godmode_slug')
            ->first();

        return ($row && $row->godmode_slug !== null)
            ? (string) $row->godmode_slug
            : null;
    }

    /**
     * Return the human-readable Godmode package name for a WHMCS product ID.
     */
    public static function packageName(int $whmcsProductId): ?string
    {
        $row = Capsule::table('mod_brandforge_packages')
            ->where('whmcs_product_id', $whmcsProductId)
            ->select('godmode_name')
            ->first();

        return ($row && $row->godmode_name !== null)
            ? (string) $row->godmode_name
            : null;
    }
}
