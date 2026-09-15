<?php
/**
 * BrandForge Package Sync — Addon Admin Language File (Dutch)
 *
 * AI-drafted first pass — needs a native Dutch speaker's review before
 * being treated as production-ready. See lang/english.php for the full
 * key reference and how WHMCS loads this file.
 */

if (!defined('WHMCS')) {
    die('Access denied.');
}

$_ADDONLANG['bf_page_title']           = 'BrandForge — Pakketsynchronisatie';
$_ADDONLANG['bf_sync_packages']        = 'Pakketten synchroniseren';
$_ADDONLANG['bf_syncing']              = 'Synchroniseren…';
$_ADDONLANG['bf_create_all_products']  = 'Alle producten aanmaken';
$_ADDONLANG['bf_creating']             = 'Aanmaken…';
$_ADDONLANG['bf_reset_everything']     = 'Alles resetten';
$_ADDONLANG['bf_reset_confirm']        = "Dit wist alle pakket-/servicekoppelgegevens en verwijdert het serverrecord.\n\nJe WHMCS-producten blijven behouden — de configuratie opnieuw uitvoeren koppelt ze opnieuw zonder duplicaten te maken.\n\nDoorgaan?";

// Status bar
$_ADDONLANG['bf_status_api_credentials']  = 'API-gegevens';
$_ADDONLANG['bf_status_saved']            = 'Opgeslagen';
$_ADDONLANG['bf_status_not_set']          = 'Niet ingesteld — sla eerst de instellingen op';
$_ADDONLANG['bf_status_server_record']    = 'Serverrecord';
$_ADDONLANG['bf_status_configured']       = 'Geconfigureerd';
$_ADDONLANG['bf_status_not_created']      = 'Niet aangemaakt';
$_ADDONLANG['bf_status_packages']         = 'Pakketten';
$_ADDONLANG['bf_status_not_synced']       = 'Niet gesynchroniseerd';
$_ADDONLANG['bf_status_synced']           = 'gesynchroniseerd';
$_ADDONLANG['bf_status_products']         = 'Producten';
$_ADDONLANG['bf_status_ready']            = 'gereed';
$_ADDONLANG['bf_status_linked']           = 'gekoppeld';

// One-Click Setup wizard
$_ADDONLANG['bf_wizard_title']       = '🚀 Eenmalige installatie';
$_ADDONLANG['bf_wizard_intro']       = 'Je API-gegevens zijn opgeslagen in de module-instellingen. Klik op de onderstaande knop om alles automatisch te configureren — geen technische stappen nodig.';
$_ADDONLANG['bf_wizard_step_server'] = 'Maakt een WHMCS-serverrecord aan met je API-gegevens';
$_ADDONLANG['bf_wizard_step_pull']   = 'Haalt al je Godmode-pakketten op';
$_ADDONLANG['bf_wizard_step_create'] = 'Maakt een WHMCS-product aan voor elk pakket';
$_ADDONLANG['bf_wizard_step_link']   = 'Koppelt alle producten aan de BrandForge-module, volledig geconfigureerd';
$_ADDONLANG['bf_wizard_need_creds']  = 'Sla je <strong>Godmode API-URL</strong> en <strong>API-sleutel</strong> op in de module-instellingen (knop Configureren op de pagina Addon-modules) voordat je de installatie uitvoert.';
$_ADDONLANG['bf_wizard_unavailable'] = 'Installatie niet beschikbaar — sla eerst de gegevens op';
$_ADDONLANG['bf_wizard_run']         = '🚀 Eenmalige installatie uitvoeren';
$_ADDONLANG['bf_wizard_confirm']     = 'Dit maakt een serverrecord aan, synchroniseert pakketten en maakt automatisch WHMCS-producten aan. Doorgaan?';

// Next steps / setup complete
$_ADDONLANG['bf_next_complete']  = '✅ Installatie voltooid.';
$_ADDONLANG['bf_next_body']      = 'Voeg prijzen toe aan elk product onder <strong>Producten/Diensten → Producten/Diensten → [Product] → Prijzen</strong>, waarna je klanten kunnen bestellen. Wanneer Godmode nieuwe pakketten toevoegt, klik dan op <strong>Pakketten synchroniseren</strong> en daarna op <strong>Alle producten aanmaken</strong>.';

// Stats
$_ADDONLANG['bf_stat_total']   = 'Totaal';
$_ADDONLANG['bf_stat_linked']  = 'Gekoppeld';
$_ADDONLANG['bf_stat_pending'] = 'In behandeling';

// Package table
$_ADDONLANG['bf_table_no_packages']   = 'Nog geen pakketten gesynchroniseerd. Klik op <strong>Pakketten synchroniseren</strong> om ze op te halen uit Godmode.';
$_ADDONLANG['bf_col_package_name']    = 'Pakketnaam';
$_ADDONLANG['bf_col_plan_id']         = 'Plan-ID';
$_ADDONLANG['bf_col_plan_id_note']    = '(voor Godmode)';
$_ADDONLANG['bf_col_godmode_id']      = 'Godmode-ID';
$_ADDONLANG['bf_col_product_id']      = 'Product-ID';
$_ADDONLANG['bf_col_product_id_note'] = '(voor Godmode)';
$_ADDONLANG['bf_col_whmcs_product']   = 'WHMCS-product';
$_ADDONLANG['bf_col_status']          = 'Status';
$_ADDONLANG['bf_col_actions']         = 'Acties';
$_ADDONLANG['bf_status_synced_label'] = 'Gesynchroniseerd';
$_ADDONLANG['bf_status_pending_label']= 'In behandeling';
$_ADDONLANG['bf_action_sync']         = 'Synchroniseren';
$_ADDONLANG['bf_action_sync_title']   = 'Dit pakket opnieuw ophalen uit Godmode';
$_ADDONLANG['bf_action_auto_create']  = 'Automatisch aanmaken';
$_ADDONLANG['bf_action_auto_create_title'] = 'Een nieuw WHMCS-product aanmaken en koppelen';
$_ADDONLANG['bf_action_link']         = 'Koppelen';
$_ADDONLANG['bf_action_link_placeholder'] = 'Bestaand product koppelen…';
$_ADDONLANG['bf_action_unlink']       = 'Ontkoppelen';
$_ADDONLANG['bf_action_unlink_confirm'] = 'Productkoppeling voor \'%s\' verwijderen?';
$_ADDONLANG['bf_mapping_footer']      = '%d pakket(ten) in lokale koppeling — laatst bijgewerkt: %s';
$_ADDONLANG['bf_never']               = 'Nooit';

// Loading overlay
$_ADDONLANG['bf_overlay_title']  = 'BrandForge wordt ingesteld…';
$_ADDONLANG['bf_overlay_sub']    = 'Dit duurt ongeveer 10–30 seconden. Sluit deze pagina niet.';
$_ADDONLANG['bf_overlay_step1']  = 'Verbinden met Godmode API';
$_ADDONLANG['bf_overlay_step2']  = 'Serverrecord aanmaken';
$_ADDONLANG['bf_overlay_step3']  = 'Pakketten synchroniseren vanuit Godmode';
$_ADDONLANG['bf_overlay_step4']  = 'WHMCS-producten aanmaken';
$_ADDONLANG['bf_overlay_note']   = 'Je wordt automatisch doorgestuurd zodra de installatie is voltooid.';

// Flash / status messages
$_ADDONLANG['bf_flash_invalid_token']   = 'Ongeldig beveiligingstoken. Vernieuw de pagina en probeer het opnieuw.';
$_ADDONLANG['bf_flash_need_creds']      = 'Godmode API-URL en API-sleutel moeten worden opgeslagen in de module-instellingen voordat je de installatie uitvoert.';
$_ADDONLANG['bf_flash_setup_complete']  = 'Installatie voltooid! %1$d pakket(ten) gesynchroniseerd en %2$d WHMCS-product(en) aangemaakt. Voeg prijzen toe aan elk product, en je bent klaar om te verkopen.';
$_ADDONLANG['bf_flash_errors']          = ' Fouten: %s';
$_ADDONLANG['bf_flash_created_n']       = '%d product(en) aangemaakt.';
$_ADDONLANG['bf_flash_reset_complete']  = 'Reset voltooid. Koppeltabellen gewist en serverrecord verwijderd. Je WHMCS-producten zijn behouden — voer de eenmalige installatie opnieuw uit om ze opnieuw te koppelen (er worden geen duplicaten aangemaakt).';
$_ADDONLANG['bf_flash_synced_n']        = '%d pakket(ten) gesynchroniseerd vanuit Godmode.';
$_ADDONLANG['bf_flash_package_synced']  = 'Pakket succesvol gesynchroniseerd.';
$_ADDONLANG['bf_flash_mapping_rebuilt'] = 'Koppeling opnieuw opgebouwd — %d pakket(ten) gesynchroniseerd';
$_ADDONLANG['bf_flash_reconnected']     = ', %d bestaand(e) product(en) opnieuw gekoppeld';
$_ADDONLANG['bf_flash_product_linked']  = 'WHMCS-product #%1$d "%2$s" aangemaakt en gekoppeld.';
$_ADDONLANG['bf_flash_linked_to']       = 'Pakket gekoppeld aan WHMCS-product #%d.';
$_ADDONLANG['bf_flash_link_removed']    = 'Productkoppeling verwijderd.';
$_ADDONLANG['bf_flash_unknown_action']  = 'Onbekende actie.';
$_ADDONLANG['bf_flash_no_package_id']   = 'Geen pakket-ID opgegeven.';
$_ADDONLANG['bf_flash_not_in_table']    = 'Pakket niet aanwezig in lokale tabel. Voer eerst Alles synchroniseren uit.';
$_ADDONLANG['bf_flash_already_linked']  = 'Dit pakket heeft al een gekoppeld WHMCS-product.';
$_ADDONLANG['bf_flash_select_product']  = 'Selecteer een WHMCS-product om te koppelen.';
$_ADDONLANG['bf_flash_error_prefix']    = 'Fout: %s';

// Addon settings (Configure page) field labels
$_ADDONLANG['bf_cfg_name']            = 'BrandForge Package Sync';
$_ADDONLANG['bf_cfg_description']     = 'Synchroniseert Godmode-pakketten met WHMCS-producten en beheert de koppeltabel voor provisioning.';
$_ADDONLANG['bf_cfg_api_url']         = 'Godmode API-URL';
$_ADDONLANG['bf_cfg_api_url_desc']    = 'Basis-URL voor de Godmode API (zonder afsluitende schuine streep)';
$_ADDONLANG['bf_cfg_api_key']         = 'Godmode API-sleutel';
$_ADDONLANG['bf_cfg_api_key_desc']    = 'Bearer-token gebruikt voor alle Godmode API-verzoeken';
$_ADDONLANG['bf_cfg_debug_mode']      = 'Foutopsporingsmodus';
$_ADDONLANG['bf_cfg_debug_mode_desc'] = 'Uitgebreide API-logs wegschrijven naar het WHMCS-modulelogboek';

// Activate / Deactivate lifecycle messages
$_ADDONLANG['bf_activated']        = 'BrandForge Package Sync geactiveerd. Pakket- en servicekoppeltabellen zijn aangemaakt.';
$_ADDONLANG['bf_activate_failed']  = 'Activering mislukt: %s';
$_ADDONLANG['bf_deactivated']      = 'BrandForge Package Sync gedeactiveerd. Koppelgegevens zijn behouden.';
