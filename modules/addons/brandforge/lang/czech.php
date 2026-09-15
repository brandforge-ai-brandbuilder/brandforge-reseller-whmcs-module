<?php
/**
 * BrandForge Package Sync — Addon Admin Language File (Czech)
 *
 * AI-drafted first pass — needs a native Czech speaker's review before
 * being treated as production-ready. See lang/english.php for the full
 * key reference and how WHMCS loads this file.
 */

if (!defined('WHMCS')) {
    die('Access denied.');
}

$_ADDONLANG['bf_page_title']           = 'BrandForge — Synchronizace balíčků';
$_ADDONLANG['bf_sync_packages']        = 'Synchronizovat balíčky';
$_ADDONLANG['bf_syncing']              = 'Synchronizace…';
$_ADDONLANG['bf_create_all_products']  = 'Vytvořit všechny produkty';
$_ADDONLANG['bf_creating']             = 'Vytváření…';
$_ADDONLANG['bf_reset_everything']     = 'Resetovat vše';
$_ADDONLANG['bf_reset_confirm']        = "Tímto se vymažou veškerá data mapování balíčků a služeb a odstraní se záznam serveru.\n\nVaše produkty WHMCS zůstanou zachovány — opětovné spuštění nastavení je znovu propojí bez vytváření duplicit.\n\nPokračovat?";

// Status bar
$_ADDONLANG['bf_status_api_credentials']  = 'Přihlašovací údaje API';
$_ADDONLANG['bf_status_saved']            = 'Uloženy';
$_ADDONLANG['bf_status_not_set']          = 'Nenastaveny — nejprve uložte nastavení';
$_ADDONLANG['bf_status_server_record']    = 'Záznam serveru';
$_ADDONLANG['bf_status_configured']       = 'Nakonfigurováno';
$_ADDONLANG['bf_status_not_created']      = 'Nevytvořeno';
$_ADDONLANG['bf_status_packages']         = 'Balíčky';
$_ADDONLANG['bf_status_not_synced']       = 'Nesynchronizováno';
$_ADDONLANG['bf_status_synced']           = 'synchronizováno';
$_ADDONLANG['bf_status_products']         = 'Produkty';
$_ADDONLANG['bf_status_ready']            = 'připraveno';
$_ADDONLANG['bf_status_linked']           = 'propojeno';

// One-Click Setup wizard
$_ADDONLANG['bf_wizard_title']       = '🚀 Nastavení na jedno kliknutí';
$_ADDONLANG['bf_wizard_intro']       = 'Vaše přihlašovací údaje API jsou uloženy v nastavení modulu. Kliknutím na tlačítko níže vše automaticky nakonfigurujete — nejsou nutné žádné technické kroky.';
$_ADDONLANG['bf_wizard_step_server'] = 'Vytvoří záznam serveru WHMCS pomocí vašich přihlašovacích údajů API';
$_ADDONLANG['bf_wizard_step_pull']   = 'Stáhne všechny vaše balíčky Godmode';
$_ADDONLANG['bf_wizard_step_create'] = 'Vytvoří produkt WHMCS pro každý balíček';
$_ADDONLANG['bf_wizard_step_link']   = 'Propojí všechny produkty s modulem BrandForge, plně nakonfigurované';
$_ADDONLANG['bf_wizard_need_creds']  = 'Před spuštěním nastavení uložte svou <strong>URL adresu API Godmode</strong> a <strong>klíč API</strong> v nastavení modulu (tlačítko Konfigurovat na stránce Doplňkové moduly).';
$_ADDONLANG['bf_wizard_unavailable'] = 'Nastavení není k dispozici — nejprve uložte přihlašovací údaje';
$_ADDONLANG['bf_wizard_run']         = '🚀 Spustit nastavení na jedno kliknutí';
$_ADDONLANG['bf_wizard_confirm']     = 'Tímto se vytvoří záznam serveru, synchronizují balíčky a automaticky vytvoří produkty WHMCS. Pokračovat?';

// Next steps / setup complete
$_ADDONLANG['bf_next_complete']  = '✅ Nastavení dokončeno.';
$_ADDONLANG['bf_next_body']      = 'Přidejte ceny ke každému produktu v části <strong>Produkty/Služby → Produkty/Služby → [Produkt] → Ceny</strong>, poté mohou vaši zákazníci objednávat. Když Godmode přidá nové balíčky, klikněte na <strong>Synchronizovat balíčky</strong> a poté na <strong>Vytvořit všechny produkty</strong>.';

// Stats
$_ADDONLANG['bf_stat_total']   = 'Celkem';
$_ADDONLANG['bf_stat_linked']  = 'Propojeno';
$_ADDONLANG['bf_stat_pending'] = 'Čeká';

// Package table
$_ADDONLANG['bf_table_no_packages']   = 'Zatím nebyly synchronizovány žádné balíčky. Kliknutím na <strong>Synchronizovat balíčky</strong> je stáhnete z Godmode.';
$_ADDONLANG['bf_col_package_name']    = 'Název balíčku';
$_ADDONLANG['bf_col_plan_id']         = 'ID plánu';
$_ADDONLANG['bf_col_plan_id_note']    = '(pro Godmode)';
$_ADDONLANG['bf_col_godmode_id']      = 'ID Godmode';
$_ADDONLANG['bf_col_product_id']      = 'ID produktu';
$_ADDONLANG['bf_col_product_id_note'] = '(pro Godmode)';
$_ADDONLANG['bf_col_whmcs_product']   = 'Produkt WHMCS';
$_ADDONLANG['bf_col_status']          = 'Stav';
$_ADDONLANG['bf_col_actions']         = 'Akce';
$_ADDONLANG['bf_status_synced_label'] = 'Synchronizováno';
$_ADDONLANG['bf_status_pending_label']= 'Čeká';
$_ADDONLANG['bf_action_sync']         = 'Synchronizovat';
$_ADDONLANG['bf_action_sync_title']   = 'Znovu stáhnout tento balíček z Godmode';
$_ADDONLANG['bf_action_auto_create']  = 'Vytvořit automaticky';
$_ADDONLANG['bf_action_auto_create_title'] = 'Vytvořit nový produkt WHMCS a propojit jej';
$_ADDONLANG['bf_action_link']         = 'Propojit';
$_ADDONLANG['bf_action_link_placeholder'] = 'Propojit existující produkt…';
$_ADDONLANG['bf_action_unlink']       = 'Zrušit propojení';
$_ADDONLANG['bf_action_unlink_confirm'] = 'Odstranit propojení produktu pro „%s“?';
$_ADDONLANG['bf_mapping_footer']      = '%d balíček(ů) v lokálním mapování — naposledy aktualizováno: %s';
$_ADDONLANG['bf_never']               = 'Nikdy';

// Loading overlay
$_ADDONLANG['bf_overlay_title']  = 'Nastavování BrandForge…';
$_ADDONLANG['bf_overlay_sub']    = 'Trvá to přibližně 10–30 sekund. Nezavírejte prosím tuto stránku.';
$_ADDONLANG['bf_overlay_step1']  = 'Připojování k API Godmode';
$_ADDONLANG['bf_overlay_step2']  = 'Vytváření záznamu serveru';
$_ADDONLANG['bf_overlay_step3']  = 'Synchronizace balíčků z Godmode';
$_ADDONLANG['bf_overlay_step4']  = 'Vytváření produktů WHMCS';
$_ADDONLANG['bf_overlay_note']   = 'Po dokončení nastavení budete automaticky přesměrováni.';

// Flash / status messages
$_ADDONLANG['bf_flash_invalid_token']   = 'Neplatný bezpečnostní token. Obnovte prosím stránku a zkuste to znovu.';
$_ADDONLANG['bf_flash_need_creds']      = 'Před spuštěním nastavení musí být v nastavení modulu uloženy URL adresa API Godmode a klíč API.';
$_ADDONLANG['bf_flash_setup_complete']  = 'Nastavení dokončeno! Synchronizováno %1$d balíček(ů) a vytvořeno %2$d produkt(ů) WHMCS. Přidejte ceny ke každému produktu a budete připraveni prodávat.';
$_ADDONLANG['bf_flash_errors']          = ' Chyby: %s';
$_ADDONLANG['bf_flash_created_n']       = 'Vytvořeno %d produkt(ů).';
$_ADDONLANG['bf_flash_reset_complete']  = 'Resetování dokončeno. Mapovací tabulky byly vymazány a záznam serveru odstraněn. Vaše produkty WHMCS zůstaly zachovány — spusťte nastavení na jedno kliknutí a znovu je propojte (nebudou vytvořeny žádné duplicity).';
$_ADDONLANG['bf_flash_synced_n']        = 'Synchronizováno %d balíček(ů) z Godmode.';
$_ADDONLANG['bf_flash_package_synced']  = 'Balíček byl úspěšně synchronizován.';
$_ADDONLANG['bf_flash_mapping_rebuilt'] = 'Mapování bylo obnoveno — synchronizováno %d balíček(ů)';
$_ADDONLANG['bf_flash_reconnected']     = ', znovu propojeno %d existující(ch) produkt(ů)';
$_ADDONLANG['bf_flash_product_linked']  = 'Produkt WHMCS #%1$d „%2$s“ byl vytvořen a propojen.';
$_ADDONLANG['bf_flash_linked_to']       = 'Balíček propojen s produktem WHMCS #%d.';
$_ADDONLANG['bf_flash_link_removed']    = 'Propojení produktu bylo odstraněno.';
$_ADDONLANG['bf_flash_unknown_action']  = 'Neznámá akce.';
$_ADDONLANG['bf_flash_no_package_id']   = 'Nebylo zadáno žádné ID balíčku.';
$_ADDONLANG['bf_flash_not_in_table']    = 'Balíček není v lokální tabulce. Nejprve spusťte Synchronizovat vše.';
$_ADDONLANG['bf_flash_already_linked']  = 'Tento balíček je již propojen s produktem WHMCS.';
$_ADDONLANG['bf_flash_select_product']  = 'Vyberte prosím produkt WHMCS k propojení.';
$_ADDONLANG['bf_flash_error_prefix']    = 'Chyba: %s';

// Addon settings (Configure page) field labels
$_ADDONLANG['bf_cfg_name']            = 'BrandForge Package Sync';
$_ADDONLANG['bf_cfg_description']     = 'Synchronizuje balíčky Godmode s produkty WHMCS a udržuje mapovací tabulku pro provisioning.';
$_ADDONLANG['bf_cfg_api_url']         = 'URL adresa API Godmode';
$_ADDONLANG['bf_cfg_api_url_desc']    = 'Základní URL adresa pro API Godmode (bez koncového lomítka)';
$_ADDONLANG['bf_cfg_api_key']         = 'Klíč API Godmode';
$_ADDONLANG['bf_cfg_api_key_desc']    = 'Bearer token používaný pro všechny požadavky na API Godmode';
$_ADDONLANG['bf_cfg_debug_mode']      = 'Režim ladění';
$_ADDONLANG['bf_cfg_debug_mode_desc'] = 'Zapisovat podrobné protokoly API do protokolu modulů WHMCS';

// Activate / Deactivate lifecycle messages
$_ADDONLANG['bf_activated']        = 'BrandForge Package Sync byl aktivován. Mapovací tabulky balíčků a služeb byly vytvořeny.';
$_ADDONLANG['bf_activate_failed']  = 'Aktivace se nezdařila: %s';
$_ADDONLANG['bf_deactivated']      = 'BrandForge Package Sync byl deaktivován. Mapovací data byla zachována.';
