<?php

namespace BrandForge\Addon;

use WHMCS\Database\Capsule;

class PackageRepository
{
    const TABLE = 'mod_brandforge_packages';

    public static function createTable(): void
    {
        if (Capsule::schema()->hasTable(self::TABLE)) {
            return;
        }

        Capsule::schema()->create(self::TABLE, function ($table) {
            $table->increments('id');
            $table->string('godmode_package_id', 255)->unique();
            $table->string('godmode_slug', 255)->unique();
            $table->string('godmode_name', 255);
            $table->unsignedInteger('whmcs_product_id')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    public static function dropTable(): void
    {
        Capsule::schema()->dropIfExists(self::TABLE);
    }

    /** @return \stdClass[] */
    public static function all(): array
    {
        if (!Capsule::schema()->hasTable(self::TABLE)) {
            return [];
        }

        $rows = Capsule::table(self::TABLE)->orderBy('godmode_name')->get();

        return ($rows instanceof \Illuminate\Support\Collection)
            ? $rows->all()
            : (array) $rows;
    }

    public static function findByGodmodeId(string $godmodePackageId): ?\stdClass
    {
        $row = Capsule::table(self::TABLE)
            ->where('godmode_package_id', $godmodePackageId)
            ->first();

        return $row ?: null;
    }

    /**
     * Insert or update a package row, preserving an existing whmcs_product_id.
     */
    public static function upsert(
        string $godmodePackageId,
        string $godmodeSlug,
        string $godmodeName
    ): void {
        $now      = date('Y-m-d H:i:s');
        $existing = self::findByGodmodeId($godmodePackageId);

        if ($existing) {
            Capsule::table(self::TABLE)
                ->where('godmode_package_id', $godmodePackageId)
                ->update([
                    'godmode_slug' => $godmodeSlug,
                    'godmode_name' => $godmodeName,
                    'updated_at'   => $now,
                ]);
        } else {
            Capsule::table(self::TABLE)->insert([
                'godmode_package_id' => $godmodePackageId,
                'godmode_slug'       => $godmodeSlug,
                'godmode_name'       => $godmodeName,
                'whmcs_product_id'   => null,
                'created_at'         => $now,
                'updated_at'         => $now,
            ]);
        }
    }

    public static function setWhmcsProduct(string $godmodePackageId, ?int $whmcsProductId): void
    {
        Capsule::table(self::TABLE)
            ->where('godmode_package_id', $godmodePackageId)
            ->update([
                'whmcs_product_id' => $whmcsProductId,
                'updated_at'       => date('Y-m-d H:i:s'),
            ]);
    }
}
