<?php
/**
 * BrandForge Package Sync — Addon Admin Language File (English)
 *
 * WHMCS loads this automatically, based on the CURRENTLY LOGGED-IN ADMIN's
 * own language preference, before brandforge_output() runs — this is the
 * official WHMCS addon-module localisation convention (lang/{language}.php
 * -> $_ADDONLANG). To add another language, copy this file to
 * lang/{language}.php (filename must match WHMCS's own /admin/lang/
 * filename for that language exactly) and translate the values only —
 * never the array keys.
 *
 * brandforge_lang() in brandforge.php always merges whatever WHMCS loaded
 * on top of this file, so a partial translation never renders a blank
 * string — any key missing from another language falls back to English.
 */

if (!defined('WHMCS')) {
    die('Access denied.');
}

$_ADDONLANG['bf_page_title']           = 'BrandForge — Package Sync';
$_ADDONLANG['bf_sync_packages']        = 'Sync Packages';
$_ADDONLANG['bf_syncing']              = 'Syncing…';
$_ADDONLANG['bf_create_all_products']  = 'Create All Products';
$_ADDONLANG['bf_creating']             = 'Creating…';
$_ADDONLANG['bf_reset_everything']     = 'Reset Everything';
$_ADDONLANG['bf_reset_confirm']        = "This clears all package/service mapping data and removes the server record.\n\nYour WHMCS products are kept — re-running setup will re-link them without creating duplicates.\n\nContinue?";

// Status bar
$_ADDONLANG['bf_status_api_credentials']  = 'API Credentials';
$_ADDONLANG['bf_status_saved']            = 'Saved';
$_ADDONLANG['bf_status_not_set']          = 'Not set — save settings first';
$_ADDONLANG['bf_status_server_record']    = 'Server Record';
$_ADDONLANG['bf_status_configured']       = 'Configured';
$_ADDONLANG['bf_status_not_created']      = 'Not created';
$_ADDONLANG['bf_status_packages']         = 'Packages';
$_ADDONLANG['bf_status_not_synced']       = 'Not synced';
$_ADDONLANG['bf_status_synced']           = 'synced';
$_ADDONLANG['bf_status_products']         = 'Products';
$_ADDONLANG['bf_status_ready']            = 'ready';
$_ADDONLANG['bf_status_linked']           = 'linked';

// One-Click Setup wizard
$_ADDONLANG['bf_wizard_title']       = '🚀 One-Click Setup';
$_ADDONLANG['bf_wizard_intro']       = 'Your API credentials are saved in the addon settings. Click the button below to configure everything automatically — no technical steps required.';
$_ADDONLANG['bf_wizard_step_server'] = 'Creates a WHMCS server record using your API credentials';
$_ADDONLANG['bf_wizard_step_pull']   = 'Pulls all your Godmode packages';
$_ADDONLANG['bf_wizard_step_create'] = 'Creates a WHMCS product for each package';
$_ADDONLANG['bf_wizard_step_link']   = 'Links all products to the BrandForge module, fully configured';
$_ADDONLANG['bf_wizard_need_creds']  = 'Please save your <strong>Godmode API URL</strong> and <strong>API Key</strong> in the addon settings (Configure button on the Addon Modules page) before running setup.';
$_ADDONLANG['bf_wizard_unavailable'] = 'Setup Unavailable — Save Credentials First';
$_ADDONLANG['bf_wizard_run']         = '🚀 Run One-Click Setup';
$_ADDONLANG['bf_wizard_confirm']     = 'This will create a server record, sync packages, and auto-create WHMCS products. Ready to go?';

// Next steps / setup complete
$_ADDONLANG['bf_next_complete']  = '✅ Setup complete.';
$_ADDONLANG['bf_next_body']      = 'Add pricing to each product under <strong>Products/Services → Products/Services → [Product] → Pricing</strong>, then your customers can order. When Godmode adds new packages, click <strong>Sync Packages</strong> then <strong>Create All Products</strong>.';

// Stats
$_ADDONLANG['bf_stat_total']   = 'Total';
$_ADDONLANG['bf_stat_linked']  = 'Linked';
$_ADDONLANG['bf_stat_pending'] = 'Pending';

// Package table
$_ADDONLANG['bf_table_no_packages']   = 'No packages synced yet. Click <strong>Sync Packages</strong> to pull from Godmode.';
$_ADDONLANG['bf_col_package_name']    = 'Package Name';
$_ADDONLANG['bf_col_plan_id']         = 'Plan ID';
$_ADDONLANG['bf_col_plan_id_note']    = '(for Godmode)';
$_ADDONLANG['bf_col_godmode_id']      = 'Godmode ID';
$_ADDONLANG['bf_col_product_id']      = 'Product ID';
$_ADDONLANG['bf_col_product_id_note'] = '(for Godmode)';
$_ADDONLANG['bf_col_whmcs_product']   = 'WHMCS Product';
$_ADDONLANG['bf_col_status']          = 'Status';
$_ADDONLANG['bf_col_actions']         = 'Actions';
$_ADDONLANG['bf_status_synced_label'] = 'Synced';
$_ADDONLANG['bf_status_pending_label']= 'Pending';
$_ADDONLANG['bf_action_sync']         = 'Sync';
$_ADDONLANG['bf_action_sync_title']   = 'Re-pull this package from Godmode';
$_ADDONLANG['bf_action_auto_create']  = 'Auto Create';
$_ADDONLANG['bf_action_auto_create_title'] = 'Create a new WHMCS product and link it';
$_ADDONLANG['bf_action_link']         = 'Link';
$_ADDONLANG['bf_action_link_placeholder'] = 'Link existing…';
$_ADDONLANG['bf_action_unlink']       = 'Unlink';
$_ADDONLANG['bf_action_unlink_confirm'] = "Remove product link for '%s'?";
$_ADDONLANG['bf_mapping_footer']      = '%d package(s) in local mapping — last updated: %s';
$_ADDONLANG['bf_never']               = 'Never';

// Loading overlay
$_ADDONLANG['bf_overlay_title']  = 'Setting up BrandForge…';
$_ADDONLANG['bf_overlay_sub']    = 'This takes about 10–30 seconds. Please do not close this page.';
$_ADDONLANG['bf_overlay_step1']  = 'Connecting to Godmode API';
$_ADDONLANG['bf_overlay_step2']  = 'Creating server record';
$_ADDONLANG['bf_overlay_step3']  = 'Syncing packages from Godmode';
$_ADDONLANG['bf_overlay_step4']  = 'Creating WHMCS products';
$_ADDONLANG['bf_overlay_note']   = 'You will be redirected automatically when setup completes.';

// Flash / status messages
$_ADDONLANG['bf_flash_invalid_token']   = 'Invalid security token. Please refresh the page and try again.';
$_ADDONLANG['bf_flash_need_creds']      = 'Godmode API URL and API Key must be saved in the addon settings before running setup.';
$_ADDONLANG['bf_flash_setup_complete']  = 'Setup complete! Synced %1$d package(s) and created %2$d WHMCS product(s). Add pricing to each product, then you are ready to sell.';
$_ADDONLANG['bf_flash_errors']          = ' Errors: %s';
$_ADDONLANG['bf_flash_created_n']       = 'Created %d product(s).';
$_ADDONLANG['bf_flash_reset_complete']  = 'Reset complete. Mapping tables cleared and server record removed. Your WHMCS products were kept — run One-Click Setup to re-link them (no duplicates will be created).';
$_ADDONLANG['bf_flash_synced_n']        = 'Synced %d package(s) from Godmode.';
$_ADDONLANG['bf_flash_package_synced']  = 'Package synced successfully.';
$_ADDONLANG['bf_flash_mapping_rebuilt'] = 'Mapping rebuilt — %d package(s) synced';
$_ADDONLANG['bf_flash_reconnected']     = ', %d existing product(s) re-linked';
$_ADDONLANG['bf_flash_product_linked']  = 'WHMCS product #%1$d "%2$s" created and linked.';
$_ADDONLANG['bf_flash_linked_to']       = 'Package linked to WHMCS product #%d.';
$_ADDONLANG['bf_flash_link_removed']    = 'Product link removed.';
$_ADDONLANG['bf_flash_unknown_action']  = 'Unknown action.';
$_ADDONLANG['bf_flash_no_package_id']   = 'No package ID supplied.';
$_ADDONLANG['bf_flash_not_in_table']    = 'Package not in local table. Run Sync All first.';
$_ADDONLANG['bf_flash_already_linked']  = 'Package already has a linked WHMCS product.';
$_ADDONLANG['bf_flash_select_product']  = 'Please select a WHMCS product to link.';
$_ADDONLANG['bf_flash_error_prefix']    = 'Error: %s';

// Addon settings (Configure page) field labels
$_ADDONLANG['bf_cfg_name']            = 'BrandForge Package Sync';
$_ADDONLANG['bf_cfg_description']     = 'Synchronise Godmode packages with WHMCS products and maintain the provisioning mapping table.';
$_ADDONLANG['bf_cfg_api_url']         = 'Godmode API URL';
$_ADDONLANG['bf_cfg_api_url_desc']    = 'Base URL for the Godmode API (no trailing slash)';
$_ADDONLANG['bf_cfg_api_key']         = 'Godmode API Key';
$_ADDONLANG['bf_cfg_api_key_desc']    = 'Bearer token used for all Godmode API requests';
$_ADDONLANG['bf_cfg_debug_mode']      = 'Debug Mode';
$_ADDONLANG['bf_cfg_debug_mode_desc'] = 'Write verbose API logs to the WHMCS Module Log';

// Activate / Deactivate lifecycle messages
$_ADDONLANG['bf_activated']        = 'BrandForge Package Sync activated. Package and service mapping tables created.';
$_ADDONLANG['bf_activate_failed']  = 'Activation failed: %s';
$_ADDONLANG['bf_deactivated']      = 'BrandForge Package Sync deactivated. Mapping data preserved.';
