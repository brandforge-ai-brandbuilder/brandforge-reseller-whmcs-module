<?php

namespace BrandForge\Addon;

use BrandForge\GodmodeClient;
use BrandForge\Exceptions\GodmodeApiException;

class PackageSync
{
    private GodmodeClient $client;

    public function __construct(GodmodeClient $client)
    {
        $this->client = $client;
    }

    // -----------------------------------------------------------------------
    // Public sync operations
    // -----------------------------------------------------------------------

    /**
     * Fetch all packages from Godmode and upsert into the local mapping table.
     * Also updates the name on any already-linked WHMCS products.
     *
     * Returns ['synced' => int, 'errors' => string[]]
     */
    public function syncAll(): array
    {
        $packages = $this->fetchRemotePackages();
        $results  = ['synced' => 0, 'errors' => []];

        foreach ($packages as $pkg) {
            try {
                $this->upsertOne($pkg);
                $results['synced']++;
            } catch (\Exception $e) {
                $label            = $pkg['name'] ?? $pkg['slug'] ?? $pkg['id'] ?? 'unknown';
                $results['errors'][] = "{$label}: " . $e->getMessage();
            }
        }

        return $results;
    }

    /**
     * Sync a single package by its Godmode package ID.
     *
     * @throws \RuntimeException if the package ID is not found in the remote list
     */
    public function syncSingle(string $godmodePackageId): void
    {
        $packages = $this->fetchRemotePackages();

        foreach ($packages as $pkg) {
            if (self::extractId($pkg) === $godmodePackageId) {
                $this->upsertOne($pkg);
                return;
            }
        }

        throw new \RuntimeException('Package ID "' . $godmodePackageId . '" not found in Godmode.');
    }

    /**
     * Full rebuild: equivalent to syncAll() but semantically signals intent
     * to reconcile the entire mapping table from scratch.
     */
    public function rebuildMapping(): array
    {
        return $this->syncAll();
    }

    // -----------------------------------------------------------------------
    // Internals
    // -----------------------------------------------------------------------

    /**
     * @return array[]  Normalised package array from the API response.
     * @throws GodmodeApiException
     * @throws \RuntimeException
     */
    public function fetchRemotePackages(): array
    {
        $response = $this->client->getPackages();

        // Accept both a wrapped {"data":[...]} envelope and a bare array.
        if (isset($response['data']) && is_array($response['data'])) {
            return $response['data'];
        }

        // Some endpoints return {"packages":[...]}
        if (isset($response['packages']) && is_array($response['packages'])) {
            return $response['packages'];
        }

        // If the root is an indexed array of objects, use it directly.
        if (isset($response[0])) {
            return $response;
        }

        throw new \RuntimeException('Unexpected packages response shape from Godmode API.');
    }

    private function upsertOne(array $pkg): void
    {
        $id   = self::extractId($pkg);
        $slug = self::extractSlug($pkg);
        $name = self::extractName($pkg);

        if ($id === '' || $slug === '') {
            throw new \RuntimeException('Package is missing id or slug.');
        }

        PackageRepository::upsert($id, $slug, $name);

        // Propagate name changes to the linked WHMCS product (re-sync criterion).
        $mapping = PackageRepository::findByGodmodeId($id);
        if ($mapping && !empty($mapping->whmcs_product_id)) {
            WhmcsProductManager::updateProductName((int) $mapping->whmcs_product_id, $name);
        }
    }

    // -----------------------------------------------------------------------
    // Field extraction helpers (tolerates varying API field names)
    // -----------------------------------------------------------------------

    private static function extractId(array $pkg): string
    {
        return (string) ($pkg['id'] ?? $pkg['package_id'] ?? $pkg['_id'] ?? '');
    }

    private static function extractSlug(array $pkg): string
    {
        return (string) ($pkg['slug'] ?? $pkg['identifier'] ?? $pkg['key'] ?? '');
    }

    private static function extractName(array $pkg): string
    {
        return (string) ($pkg['name'] ?? $pkg['title'] ?? $pkg['display_name'] ?? self::extractSlug($pkg));
    }
}
