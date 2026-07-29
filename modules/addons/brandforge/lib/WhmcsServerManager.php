<?php

namespace BrandForge\Addon;

use WHMCS\Database\Capsule;

/**
 * Manages the WHMCS server record and server group for the BrandForge module.
 * All operations use direct DB queries so they work across all WHMCS versions.
 */
class WhmcsServerManager
{
    const MODULE     = 'brandforge';
    const GROUP_NAME = 'BrandForge Servers';

    /** Return the first BrandForge server record, or null if none exists. */
    public static function getServer(): ?\stdClass
    {
        return Capsule::table('tblservers')
            ->where('type', self::MODULE)
            ->first() ?: null;
    }

    /** Return or create the "BrandForge Servers" server group. */
    public static function findOrCreateServerGroup(): int
    {
        $group = Capsule::table('tblservergroups')
            ->where('name', self::GROUP_NAME)
            ->first();

        if ($group) {
            return (int) $group->id;
        }

        return (int) Capsule::table('tblservergroups')->insertGetId([
            'name'     => self::GROUP_NAME,
            'filltype' => 0, // sequential
        ]);
    }

    /**
     * Insert a server record into tblservers and link it to the given group.
     * The API key is encrypted using WHMCS's global encrypt() function.
     */
    public static function createServer(string $apiUrl, string $apiKey, int $groupId): int
    {
        $serverId = (int) Capsule::table('tblservers')->insertGetId([
            'name'        => 'BrandForge',
            'ipaddress'   => $apiUrl,
            'hostname'    => '',
            'username'    => '',
            'password'    => encrypt($apiKey),
            'accesshash'  => '',
            'type'        => self::MODULE,
            'maxaccounts' => 0,
            'active'      => 1,
            'nameserver1' => '',
            'nameserver2' => '',
            'nameserver3' => '',
            'nameserver4' => '',
        ]);

        if (Capsule::schema()->hasTable('tblserversgroups')) {
            Capsule::table('tblserversgroups')->insert([
                'serverid' => $serverId,
                'groupid'  => $groupId,
            ]);
        }

        return $serverId;
    }

    /** Delete all BrandForge server records and their group memberships. */
    public static function deleteAll(): void
    {
        $ids = Capsule::table('tblservers')
            ->where('type', self::MODULE)
            ->pluck('id')
            ->toArray();

        if (!empty($ids)) {
            Capsule::table('tblserversgroups')
                ->whereIn('serverid', $ids)
                ->delete();

            Capsule::table('tblservers')
                ->whereIn('id', $ids)
                ->delete();
        }
    }
}
