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
// Localisation
// ---------------------------------------------------------------------------

/**
 * WHMCS's own addon-module localisation convention: it auto-includes
 * lang/{admin's language}.php (populating the global $_ADDONLANG array)
 * before calling brandforge_output()/_sidebar(), based on the currently
 * logged-in admin's own language preference — see lang/english.php for the
 * full key list and how to add another language.
 *
 * This always merges whatever WHMCS loaded OVER our own English baseline
 * (loaded directly, not relying on WHMCS having done so), so:
 *   - a language WHMCS didn't load for (e.g. _config()/_activate() may run
 *     before WHMCS wires $_ADDONLANG at all) still renders in English, and
 *   - a translation file that's missing a key falls back to English for
 *     just that key, instead of a blank string or a PHP notice.
 */
function brandforge_lang(): array
{
    static $english = null;
    if ($english === null) {
        $_ADDONLANG = [];
        $file       = __DIR__ . '/lang/english.php';
        if (is_file($file)) {
            include $file;
        }
        $english = $_ADDONLANG;
    }

    $loaded = $GLOBALS['_ADDONLANG'] ?? [];
    return is_array($loaded) ? array_merge($english, $loaded) : $english;
}

// ---------------------------------------------------------------------------
// Module registration
// ---------------------------------------------------------------------------

function brandforge_config(): array
{
    $t = brandforge_lang();

    return [
        'name'        => $t['bf_cfg_name'],
        'description' => $t['bf_cfg_description'],
        'version'     => '1.1.0',
        'author'      => 'BrandForge',
        'fields'      => [
            'godmode_api_url' => [
                'FriendlyName' => $t['bf_cfg_api_url'],
                'Type'         => 'text',
                'Size'         => 60,
                'Default'      => 'https://staging.brandforge.software',
                'Description'  => $t['bf_cfg_api_url_desc'],
            ],
            'godmode_api_key' => [
                'FriendlyName' => $t['bf_cfg_api_key'],
                'Type'         => 'password',
                'Size'         => 60,
                'Default'      => '',
                'Description'  => $t['bf_cfg_api_key_desc'],
            ],
            'debug_mode' => [
                'FriendlyName' => $t['bf_cfg_debug_mode'],
                'Type'         => 'yesno',
                'Default'      => 'no',
                'Description'  => $t['bf_cfg_debug_mode_desc'],
            ],
        ],
    ];
}

// ---------------------------------------------------------------------------
// Lifecycle
// ---------------------------------------------------------------------------

function brandforge_activate(): array
{
    $t = brandforge_lang();
    try {
        PackageRepository::createTable();
        ServiceRepository::ensureTable();
        return [
            'status'      => 'success',
            'description' => $t['bf_activated'],
        ];
    } catch (\Exception $e) {
        return [
            'status'      => 'error',
            'description' => sprintf($t['bf_activate_failed'], $e->getMessage()),
        ];
    }
}

function brandforge_deactivate(): array
{
    // Tables are kept on deactivation to preserve mappings across reinstalls.
    return [
        'status'      => 'success',
        'description' => brandforge_lang()['bf_deactivated'],
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
    $t = brandforge_lang();

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
            $flash     = $t['bf_flash_invalid_token'];
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
                            throw new \RuntimeException($t['bf_flash_need_creds']);
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

                        $flash = sprintf($t['bf_flash_setup_complete'], $syncResult['synced'], $created);
                        if (!empty($errors)) {
                            $flash    .= sprintf($t['bf_flash_errors'], implode('; ', $errors));
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
                        $flash     = sprintf($t['bf_flash_created_n'], $created);
                        $flashType = empty($errors) ? 'success' : 'warning';
                        if (!empty($errors)) {
                            $flash .= sprintf($t['bf_flash_errors'], implode('; ', $errors));
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
                        $flash     = $t['bf_flash_reset_complete'];
                        $flashType = 'success';
                        break;

                    // -----------------------------------------------------------
                    // Existing per-package actions
                    // -----------------------------------------------------------
                    case 'sync_all':
                        $result = $sync->syncAll();
                        $flash  = sprintf($t['bf_flash_synced_n'], $result['synced']);
                        if (!empty($result['errors'])) {
                            $flash    .= sprintf($t['bf_flash_errors'], implode('; ', $result['errors']));
                            $flashType = 'warning';
                        } else {
                            $flashType = 'success';
                        }
                        break;

                    case 'sync_single':
                        brandforge_requirePackageId($packageId, $t);
                        $sync->syncSingle($packageId);
                        $flash     = $t['bf_flash_package_synced'];
                        $flashType = 'success';
                        break;

                    case 'rebuild_mapping':
                        $result    = $sync->rebuildMapping();
                        $flash     = sprintf($t['bf_flash_mapping_rebuilt'], $result['synced']);
                        if (($result['reconnected'] ?? 0) > 0) {
                            $flash .= sprintf($t['bf_flash_reconnected'], $result['reconnected']);
                        }
                        $flash    .= '.';
                        $flashType = 'success';
                        break;

                    case 'auto_create_product':
                        brandforge_requirePackageId($packageId, $t);
                        $mapping = PackageRepository::findByGodmodeId($packageId);
                        if (!$mapping) {
                            throw new \RuntimeException($t['bf_flash_not_in_table']);
                        }
                        if (!empty($mapping->whmcs_product_id)) {
                            throw new \RuntimeException($t['bf_flash_already_linked']);
                        }
                        $newId = WhmcsProductManager::createProduct(
                            $mapping->godmode_name,
                            $mapping->godmode_slug
                        );
                        PackageRepository::setWhmcsProduct($packageId, $newId);
                        $flash     = sprintf($t['bf_flash_product_linked'], $newId, $mapping->godmode_name);
                        $flashType = 'success';
                        break;

                    case 'link_product':
                        brandforge_requirePackageId($packageId, $t);
                        $whmcsId = (int) ($_POST['whmcs_product_id'] ?? 0);
                        if ($whmcsId <= 0) {
                            throw new \RuntimeException($t['bf_flash_select_product']);
                        }
                        PackageRepository::setWhmcsProduct($packageId, $whmcsId);
                        $flash     = sprintf($t['bf_flash_linked_to'], $whmcsId);
                        $flashType = 'success';
                        break;

                    case 'unlink_product':
                        brandforge_requirePackageId($packageId, $t);
                        PackageRepository::setWhmcsProduct($packageId, null);
                        $flash     = $t['bf_flash_link_removed'];
                        $flashType = 'info';
                        break;

                    default:
                        $flash     = $t['bf_flash_unknown_action'];
                        $flashType = 'warning';
                }
            } catch (\Exception $e) {
                $flash     = sprintf($t['bf_flash_error_prefix'], $e->getMessage());
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

    $lastSync    = $t['bf_never'];
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
        $t,
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

function brandforge_requirePackageId(string $id, array $t): void
{
    if ($id === '') {
        throw new \RuntimeException($t['bf_flash_no_package_id']);
    }
}

function brandforge_renderPage(
    array    $t,
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
            <h2><?= htmlspecialchars($t['bf_page_title']) ?></h2>
            <?php if ($isFullySetUp): ?>
            <div style="display:flex;gap:8px;align-items:center">
                <form method="post" action="<?= $mlHtml ?>" style="display:inline">
                    <input type="hidden" name="token"  value="<?= $tkHtml ?>">
                    <input type="hidden" name="action" value="sync_all">
                    <button type="submit" class="btn btn-primary btn-sm bf-async-btn"
                            data-loading-text="<?= htmlspecialchars($t['bf_syncing']) ?>">
                        <i class="fas fa-sync-alt"></i>&nbsp; <?= htmlspecialchars($t['bf_sync_packages']) ?>
                    </button>
                </form>
                <?php if ($pending > 0): ?>
                <form method="post" action="<?= $mlHtml ?>" style="display:inline">
                    <input type="hidden" name="token"  value="<?= $tkHtml ?>">
                    <input type="hidden" name="action" value="setup_all_products">
                    <button type="submit" class="btn btn-success btn-sm bf-async-btn"
                            data-loading-text="<?= htmlspecialchars($t['bf_creating']) ?>">
                        <i class="fas fa-magic"></i>&nbsp; <?= htmlspecialchars($t['bf_create_all_products']) ?>
                    </button>
                </form>
                <?php endif; ?>
                <form method="post" action="<?= $mlHtml ?>" style="display:inline">
                    <input type="hidden" name="token"  value="<?= $tkHtml ?>">
                    <input type="hidden" name="action" value="reset_all">
                    <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('<?= htmlspecialchars(addslashes($t['bf_reset_confirm'])) ?>')">
                        <i class="fas fa-trash"></i>&nbsp; <?= htmlspecialchars($t['bf_reset_everything']) ?>
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
                <span><strong><?= htmlspecialchars($t['bf_status_api_credentials']) ?></strong> <?= $hasCreds ? htmlspecialchars($t['bf_status_saved']) : htmlspecialchars($t['bf_status_not_set']) ?></span>
            </div>
            <span class="bf-status-sep">|</span>
            <div class="bf-status-item">
                <span class="dot <?= $hasServer ? 'dot-ok' : 'dot-warn' ?>"></span>
                <span><strong><?= htmlspecialchars($t['bf_status_server_record']) ?></strong> <?= $hasServer ? htmlspecialchars($t['bf_status_configured']) : htmlspecialchars($t['bf_status_not_created']) ?></span>
            </div>
            <span class="bf-status-sep">|</span>
            <div class="bf-status-item">
                <span class="dot <?= $hasPkgs ? 'dot-ok' : 'dot-warn' ?>"></span>
                <span><strong><?= htmlspecialchars($t['bf_status_packages']) ?></strong> <?= $total > 0 ? $total . ' ' . htmlspecialchars($t['bf_status_synced']) : htmlspecialchars($t['bf_status_not_synced']) ?></span>
            </div>
            <span class="bf-status-sep">|</span>
            <div class="bf-status-item">
                <span class="dot <?= $allLinked ? 'dot-ok' : ($linkedCount > 0 ? 'dot-warn' : 'dot-no') ?>"></span>
                <span><strong><?= htmlspecialchars($t['bf_status_products']) ?></strong>
                    <?php if ($total === 0): ?><?= htmlspecialchars($t['bf_status_not_created']) ?>
                    <?php elseif ($allLinked): ?><?= $linkedCount ?> / <?= $total ?> <?= htmlspecialchars($t['bf_status_ready']) ?>
                    <?php else: ?><?= $linkedCount ?> / <?= $total ?> <?= htmlspecialchars($t['bf_status_linked']) ?>
                    <?php endif; ?>
                </span>
            </div>
        </div>

        <?php if (!$isFullySetUp): ?>
        <!-- One-Click Setup Wizard -->
        <div class="bf-wizard">
            <h3><?= htmlspecialchars($t['bf_wizard_title']) ?></h3>
            <p><?= htmlspecialchars($t['bf_wizard_intro']) ?></p>
            <ul>
                <li><?= htmlspecialchars($t['bf_wizard_step_server']) ?></li>
                <li><?= htmlspecialchars($t['bf_wizard_step_pull']) ?></li>
                <li><?= htmlspecialchars($t['bf_wizard_step_create']) ?></li>
                <li><?= htmlspecialchars($t['bf_wizard_step_link']) ?></li>
            </ul>
            <?php if (!$hasCreds): ?>
                <p style="background:rgba(255,255,255,.2);padding:10px 14px;border-radius:4px;margin-bottom:16px">
                    &#x26A0;&#xFE0F; <?= $t['bf_wizard_need_creds'] ?>
                </p>
                <button class="btn-setup" disabled><?= htmlspecialchars($t['bf_wizard_unavailable']) ?></button>
            <?php else: ?>
                <form id="bf-setup-form" method="post" action="<?= $mlHtml ?>" data-confirm="<?= htmlspecialchars($t['bf_wizard_confirm']) ?>">
                    <input type="hidden" name="token"  value="<?= $tkHtml ?>">
                    <input type="hidden" name="action" value="auto_setup">
                    <button type="submit" class="btn-setup">
                        <?= htmlspecialchars($t['bf_wizard_run']) ?>
                    </button>
                </form>
            <?php endif; ?>
        </div>

        <?php else: ?>
        <!-- Next Steps after full setup -->
        <?php if ($allLinked): ?>
        <div class="bf-next">
            <strong><?= htmlspecialchars($t['bf_next_complete']) ?></strong>
            <?= $t['bf_next_body'] ?>
        </div>
        <?php endif; ?>

        <!-- Stats -->
        <div class="bf-stats">
            <div class="bf-stat">
                <div class="bf-stat-val"><?= $total ?></div>
                <div class="bf-stat-lbl"><?= htmlspecialchars($t['bf_stat_total']) ?></div>
            </div>
            <div class="bf-stat linked">
                <div class="bf-stat-val"><?= $linkedCount ?></div>
                <div class="bf-stat-lbl"><?= htmlspecialchars($t['bf_stat_linked']) ?></div>
            </div>
            <div class="bf-stat pending">
                <div class="bf-stat-val"><?= $pending ?></div>
                <div class="bf-stat-lbl"><?= htmlspecialchars($t['bf_stat_pending']) ?></div>
            </div>
        </div>

        <!-- Package table -->
        <?php if (empty($mappings)): ?>
            <div class="alert alert-info">
                <?= $t['bf_table_no_packages'] ?>
            </div>
        <?php else: ?>
            <table class="table table-bordered table-striped table-hover" style="font-size:13px">
                <thead>
                    <tr>
                        <th><?= htmlspecialchars($t['bf_col_package_name']) ?></th>
                        <th><?= htmlspecialchars($t['bf_col_plan_id']) ?> <small class="text-muted"><?= htmlspecialchars($t['bf_col_plan_id_note']) ?></small></th>
                        <th><?= htmlspecialchars($t['bf_col_godmode_id']) ?></th>
                        <th><?= htmlspecialchars($t['bf_col_product_id']) ?> <small class="text-muted"><?= htmlspecialchars($t['bf_col_product_id_note']) ?></small></th>
                        <th><?= htmlspecialchars($t['bf_col_whmcs_product']) ?></th>
                        <th><?= htmlspecialchars($t['bf_col_status']) ?></th>
                        <th><?= htmlspecialchars($t['bf_col_actions']) ?></th>
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
                                <span class="label label-success"><?= htmlspecialchars($t['bf_status_synced_label']) ?></span>
                            <?php else: ?>
                                <span class="label label-warning"><?= htmlspecialchars($t['bf_status_pending_label']) ?></span>
                            <?php endif; ?>
                        </td>
                        <td class="bf-actions-cell">
                            <!-- Sync single -->
                            <form method="post" action="<?= $mlHtml ?>" style="display:inline">
                                <input type="hidden" name="token"      value="<?= $tkHtml ?>">
                                <input type="hidden" name="action"     value="sync_single">
                                <input type="hidden" name="package_id" value="<?= $gid ?>">
                                <button type="submit" class="btn btn-xs btn-info" title="<?= htmlspecialchars($t['bf_action_sync_title']) ?>">
                                    <i class="fas fa-sync"></i> <?= htmlspecialchars($t['bf_action_sync']) ?>
                                </button>
                            </form>

                            <?php if (!$isLinked): ?>
                                <!-- Auto-create WHMCS product -->
                                <form method="post" action="<?= $mlHtml ?>" style="display:inline">
                                    <input type="hidden" name="token"      value="<?= $tkHtml ?>">
                                    <input type="hidden" name="action"     value="auto_create_product">
                                    <input type="hidden" name="package_id" value="<?= $gid ?>">
                                    <button type="submit" class="btn btn-xs btn-success" title="<?= htmlspecialchars($t['bf_action_auto_create_title']) ?>">
                                        <i class="fas fa-plus-circle"></i> <?= htmlspecialchars($t['bf_action_auto_create']) ?>
                                    </button>
                                </form>

                                <!-- Link existing product -->
                                <form method="post" action="<?= $mlHtml ?>" class="bf-link-row">
                                    <input type="hidden" name="token"      value="<?= $tkHtml ?>">
                                    <input type="hidden" name="action"     value="link_product">
                                    <input type="hidden" name="package_id" value="<?= $gid ?>">
                                    <select name="whmcs_product_id" class="form-control input-sm"
                                            style="width:175px;display:inline-block">
                                        <option value=""><?= htmlspecialchars($t['bf_action_link_placeholder']) ?></option>
                                        <?php foreach ($whmcsProducts as $p): ?>
                                            <option value="<?= (int) $p->id ?>">
                                                <?= htmlspecialchars($p->name) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <button type="submit" class="btn btn-xs btn-primary"><?= htmlspecialchars($t['bf_action_link']) ?></button>
                                </form>

                            <?php else: ?>
                                <!-- Unlink -->
                                <form method="post" action="<?= $mlHtml ?>" style="display:inline">
                                    <input type="hidden" name="token"      value="<?= $tkHtml ?>">
                                    <input type="hidden" name="action"     value="unlink_product">
                                    <input type="hidden" name="package_id" value="<?= $gid ?>">
                                    <button type="submit" class="btn btn-xs btn-danger"
                                            onclick="return confirm('<?= htmlspecialchars(addslashes(sprintf($t['bf_action_unlink_confirm'], $row->godmode_name))) ?>')">
                                        <i class="fas fa-unlink"></i> <?= htmlspecialchars($t['bf_action_unlink']) ?>
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
            <?= htmlspecialchars(sprintf($t['bf_mapping_footer'], $total, $lastSync)) ?>
        </p>
        <?php endif; ?>

    </div>

    <!-- Loading overlay (One-Click Setup) -->
    <div id="bf-overlay">
        <div class="bf-overlay-box">
            <div class="bf-spinner"></div>
            <div class="bf-overlay-title"><?= htmlspecialchars($t['bf_overlay_title']) ?></div>
            <div class="bf-overlay-sub"><?= htmlspecialchars($t['bf_overlay_sub']) ?></div>
            <ul class="bf-steps">
                <li><span class="bf-step-icon"></span> <?= htmlspecialchars($t['bf_overlay_step1']) ?></li>
                <li><span class="bf-step-icon"></span> <?= htmlspecialchars($t['bf_overlay_step2']) ?></li>
                <li><span class="bf-step-icon"></span> <?= htmlspecialchars($t['bf_overlay_step3']) ?></li>
                <li><span class="bf-step-icon"></span> <?= htmlspecialchars($t['bf_overlay_step4']) ?></li>
            </ul>
            <p class="bf-overlay-note"><?= htmlspecialchars($t['bf_overlay_note']) ?></p>
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
                if (!confirm(setupForm.getAttribute('data-confirm'))) {
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
