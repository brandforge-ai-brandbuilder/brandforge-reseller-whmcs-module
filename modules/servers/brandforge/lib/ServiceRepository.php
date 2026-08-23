<?php

namespace BrandForge;

use WHMCS\Database\Capsule;

class ServiceRepository
{
    const TABLE = 'mod_brandforge_services';

    /**
     * Create the table if it does not exist, or migrate an older install
     * that still has the deprecated godmode_subscription_id column.
     */
    public static function ensureTable(): void
    {
        $schema = Capsule::schema();

        if (!$schema->hasTable(self::TABLE)) {
            $schema->create(self::TABLE, function ($table) {
                $table->increments('id');
                $table->unsignedInteger('whmcs_client_id');
                $table->unsignedInteger('whmcs_service_id')->unique();
                $table->unsignedInteger('whmcs_product_id');
                $table->string('godmode_service_id', 255)->nullable();
                $table->string('godmode_workspace_id', 255)->nullable();
                $table->string('godmode_user_id', 255)->nullable();
                $table->timestamp('terminated_at')->nullable();
                $table->timestamp('created_at');
                $table->timestamp('updated_at');
            });
            return;
        }

        // Rename legacy column for installs created before the API contract fix.
        // Use raw SQL to avoid requiring doctrine/dbal which is not in WHMCS.
        if ($schema->hasColumn(self::TABLE, 'godmode_subscription_id')
            && !$schema->hasColumn(self::TABLE, 'godmode_service_id')
        ) {
            Capsule::statement(
                'ALTER TABLE `' . self::TABLE . '` CHANGE COLUMN `godmode_subscription_id` `godmode_service_id` VARCHAR(255) NULL'
            );
        }

        // Migrate an existing install that predates multi-package support.
        // Nullable, additive — every existing row reads as "still active",
        // which is correct: nothing has been terminated through this new
        // column yet.
        if (!$schema->hasColumn(self::TABLE, 'terminated_at')) {
            $schema->table(self::TABLE, function ($table) {
                $table->timestamp('terminated_at')->nullable()->after('godmode_user_id');
            });
        }
    }

    public static function insert(
        int    $clientId,
        int    $serviceId,
        int    $productId,
        string $godmodeServiceId,
        string $workspaceId,
        string $userId
    ): void {
        $now = date('Y-m-d H:i:s');

        Capsule::table(self::TABLE)->insert([
            'whmcs_client_id'   => $clientId,
            'whmcs_service_id'  => $serviceId,
            'whmcs_product_id'  => $productId,
            'godmode_service_id'=> $godmodeServiceId ?: null,
            'godmode_workspace_id' => $workspaceId   ?: null,
            'godmode_user_id'   => $userId           ?: null,
            'created_at'        => $now,
            'updated_at'        => $now,
        ]);
    }

    public static function findByServiceId(int $serviceId): ?\stdClass
    {
        $row = Capsule::table(self::TABLE)
            ->where('whmcs_service_id', $serviceId)
            ->first();

        return $row ?: null;
    }

    /**
     * Every currently-active (not terminated) BrandForge service this WHMCS
     * client holds, oldest first. Empty means "this is their first package"
     * — CreateAccount calls provision/create. Non-empty means every other
     * package this client orders attaches to the same Godmode account via
     * provision/add_plan, using any row here as the account reference
     * (they all share the same godmode_service_id).
     *
     * @return \stdClass[]
     */
    public static function findActiveByClientId(int $clientId): array
    {
        $rows = Capsule::table(self::TABLE)
            ->where('whmcs_client_id', $clientId)
            ->whereNull('terminated_at')
            ->orderBy('created_at', 'asc')
            ->get();

        return ($rows instanceof \Illuminate\Support\Collection) ? $rows->all() : (array) $rows;
    }

    /**
     * Marks one specific package as no longer active. The row is kept —
     * same audit-trail convention as touch() — only terminated_at changes,
     * which is what findActiveByClientId() and the Phase 1 duplicate-order
     * guardrail actually filter on.
     */
    public static function markTerminated(int $serviceId): void
    {
        Capsule::table(self::TABLE)
            ->where('whmcs_service_id', $serviceId)
            ->update([
                'terminated_at' => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ]);
    }

    /**
     * Update the linked product ID after a package change.
     */
    public static function updateProduct(int $serviceId, int $productId): void
    {
        Capsule::table(self::TABLE)
            ->where('whmcs_service_id', $serviceId)
            ->update([
                'whmcs_product_id' => $productId,
                'updated_at'       => date('Y-m-d H:i:s'),
            ]);
    }

    public static function touch(int $serviceId): void
    {
        Capsule::table(self::TABLE)
            ->where('whmcs_service_id', $serviceId)
            ->update(['updated_at' => date('Y-m-d H:i:s')]);
    }
}
