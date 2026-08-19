<?php

namespace BrandForge\Addon;

use WHMCS\Database\Capsule;

class WhmcsProductManager
{
    private const GROUP_NAME = 'BrandForge';

    /** @return \stdClass[] */
    public static function getAllProducts(): array
    {
        $rows = Capsule::table('tblproducts')
            ->select('id', 'name', 'gid')
            ->orderBy('name')
            ->get();

        return ($rows instanceof \Illuminate\Support\Collection)
            ? $rows->all()
            : (array) $rows;
    }

    public static function getProductName(int $productId): ?string
    {
        $row = Capsule::table('tblproducts')
            ->where('id', $productId)
            ->select('name')
            ->first();

        return $row ? $row->name : null;
    }

    /**
     * Create a WHMCS product bound to the BrandForge server module.
     * If a product with the same name already exists in the BrandForge group,
     * it is returned as-is (find-or-create, prevents duplicates on re-sync).
     * Returns the product ID.
     *
     * @throws \RuntimeException
     */
    public static function createProduct(string $name, string $slug): int
    {
        $gid = self::getOrCreateGroup();

        $existing = self::findProductInGroup($name, $gid);
        if ($existing !== null) {
            return $existing;
        }

        $result = localAPI('AddProduct', [
            'name'        => $name,
            'gid'         => $gid,
            'type'        => 'other',
            'paytype'     => 'recurring',
            'allowqty'    => 0,
            'servertype'  => 'brandforge',
            'autosetup'   => 'payment',
        ]);

        if (($result['result'] ?? '') !== 'success') {
            throw new \RuntimeException(
                'AddProduct failed: ' . ($result['message'] ?? 'unknown error')
            );
        }

        return (int) $result['pid'];
    }

    /**
     * Create a fully-configured product: server module, server group, and all
     * module config options set automatically. Used by One-Click Setup so the
     * reseller does not need to configure each product manually.
     *
     * If a product with the same name already exists in the BrandForge group
     * it is reused and its configoptions are refreshed (find-or-create).
     * This makes One-Click Setup / Create All Products idempotent — running it
     * after a Reset or a re-sync never creates duplicates.
     *
     * @throws \RuntimeException
     */
    public static function createProductFull(
        string $name,
        int    $serverGroupId,
        string $apiUrl,
        string $apiKey
    ): int {
        $gid = self::getOrCreateGroup();

        // Return existing product if one with this name is already in the group.
        $existing = self::findProductInGroup($name, $gid);
        if ($existing !== null) {
            // Refresh configoptions so credentials stay in sync.
            Capsule::table('tblproducts')->where('id', $existing)->update([
                'configoption1' => $apiUrl,
                'configoption2' => $apiKey,
            ]);
            return $existing;
        }

        $result = localAPI('AddProduct', [
            'name'       => $name,
            'gid'        => $gid,
            'type'       => 'other',
            'paytype'    => 'recurring',
            'allowqty'   => 0,
            'servertype' => 'brandforge',
            'autosetup'  => 'payment',
        ]);

        if (($result['result'] ?? '') !== 'success') {
            throw new \RuntimeException(
                'AddProduct failed: ' . ($result['message'] ?? 'unknown error')
            );
        }

        $pid = (int) $result['pid'];

        // AddProduct does not persist module configoptions — write directly.
        Capsule::table('tblproducts')->where('id', $pid)->update([
            'configoption1' => $apiUrl,
            'configoption2' => $apiKey,
            'configoption3' => '',
            'configoption4' => 'BrandForge',
            'configoption5' => '#6366f1',
        ]);

        return $pid;
    }

    /**
     * Find an existing product by name within the BrandForge product group.
     * Returns the product ID, or null if none exists.
     * Used to prevent duplicate products when setup is run more than once.
     */
    public static function findProductInGroup(string $name, int $gid): ?int
    {
        $row = Capsule::table('tblproducts')
            ->where('gid', $gid)
            ->where('name', $name)
            ->select('id')
            ->first();

        return $row ? (int) $row->id : null;
    }

    /**
     * Update the name of an existing WHMCS product.
     * Uses Capsule directly — WHMCS has no UpdateProduct local API function.
     *
     * @throws \RuntimeException
     */
    public static function updateProductName(int $productId, string $name): void
    {
        $updated = Capsule::table('tblproducts')
            ->where('id', $productId)
            ->update(['name' => $name]);

        if ($updated === 0) {
            // Capsule returns rows *changed*, not rows *matched*.
            // 0 can mean the product doesn't exist OR the name was already current.
            // Only throw when the product is genuinely absent.
            $exists = Capsule::table('tblproducts')->where('id', $productId)->exists();
            if (!$exists) {
                throw new \RuntimeException(
                    "UpdateProduct #{$productId} failed: product not found in tblproducts"
                );
            }
        }
    }

    // -----------------------------------------------------------------------

    /**
     * Public wrapper so PackageSync can resolve the group ID without duplicating
     * the find-or-create logic.
     */
    public static function getOrCreateGroupPublic(): int
    {
        return self::getOrCreateGroup();
    }

    private static function getOrCreateGroup(): int
    {
        $group = Capsule::table('tblproductgroups')
            ->where('name', self::GROUP_NAME)
            ->first();

        if ($group) {
            // Patch slug on groups created before this fix.
            if (empty($group->slug)) {
                Capsule::table('tblproductgroups')
                    ->where('id', $group->id)
                    ->update(['slug' => 'brandforge']);
            }
            return (int) $group->id;
        }

        return (int) Capsule::table('tblproductgroups')->insertGetId([
            'name'     => self::GROUP_NAME,
            'slug'     => 'brandforge',
            'headline' => 'BrandForge Plans',
            'tagline'  => 'AI-powered brand building platform',
            'hidden'   => 0,
        ]);
    }
}
