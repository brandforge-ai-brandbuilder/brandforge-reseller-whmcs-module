<?php
/**
 * BrandForge Package Sync — Addon Admin Language File (Hungarian)
 *
 * AI-drafted first pass — needs a native Hungarian speaker's review before
 * being treated as production-ready. See lang/english.php for the full
 * key reference and how WHMCS loads this file.
 */

if (!defined('WHMCS')) {
    die('Access denied.');
}

$_ADDONLANG['bf_page_title']           = 'BrandForge — Csomagszinkronizálás';
$_ADDONLANG['bf_sync_packages']        = 'Csomagok szinkronizálása';
$_ADDONLANG['bf_syncing']              = 'Szinkronizálás…';
$_ADDONLANG['bf_create_all_products']  = 'Összes termék létrehozása';
$_ADDONLANG['bf_creating']             = 'Létrehozás…';
$_ADDONLANG['bf_reset_everything']     = 'Minden visszaállítása';
$_ADDONLANG['bf_reset_confirm']        = "Ez törli az összes csomag/szolgáltatás hozzárendelési adatot, és eltávolítja a szerverrekordot.\n\nA WHMCS-termékeid megmaradnak — a beállítás újbóli futtatása duplikátumok létrehozása nélkül újra összekapcsolja őket.\n\nFolytatod?";

// Status bar
$_ADDONLANG['bf_status_api_credentials']  = 'API-hitelesítő adatok';
$_ADDONLANG['bf_status_saved']            = 'Elmentve';
$_ADDONLANG['bf_status_not_set']          = 'Nincs beállítva — először mentsd el a beállításokat';
$_ADDONLANG['bf_status_server_record']    = 'Szerverrekord';
$_ADDONLANG['bf_status_configured']       = 'Konfigurálva';
$_ADDONLANG['bf_status_not_created']      = 'Nincs létrehozva';
$_ADDONLANG['bf_status_packages']         = 'Csomagok';
$_ADDONLANG['bf_status_not_synced']       = 'Nincs szinkronizálva';
$_ADDONLANG['bf_status_synced']           = 'szinkronizálva';
$_ADDONLANG['bf_status_products']         = 'Termékek';
$_ADDONLANG['bf_status_ready']            = 'kész';
$_ADDONLANG['bf_status_linked']           = 'összekapcsolva';

// One-Click Setup wizard
$_ADDONLANG['bf_wizard_title']       = '🚀 Egykattintásos beállítás';
$_ADDONLANG['bf_wizard_intro']       = 'Az API-hitelesítő adataid el vannak mentve a modul beállításaiban. Kattints az alábbi gombra, hogy mindent automatikusan beállíts — nincs szükség technikai lépésekre.';
$_ADDONLANG['bf_wizard_step_server'] = 'Létrehoz egy WHMCS szerverrekordot az API-hitelesítő adataid felhasználásával';
$_ADDONLANG['bf_wizard_step_pull']   = 'Lekéri az összes Godmode csomagodat';
$_ADDONLANG['bf_wizard_step_create'] = 'Létrehoz egy WHMCS terméket minden csomaghoz';
$_ADDONLANG['bf_wizard_step_link']   = 'Összekapcsolja az összes terméket a BrandForge modullal, teljesen beállítva';
$_ADDONLANG['bf_wizard_need_creds']  = 'Mentsd el a <strong>Godmode API URL-t</strong> és az <strong>API-kulcsot</strong> a modul beállításaiban (Konfigurálás gomb a Kiegészítő modulok oldalon), mielőtt futtatnád a beállítást.';
$_ADDONLANG['bf_wizard_unavailable'] = 'A beállítás nem érhető el — először mentsd el a hitelesítő adatokat';
$_ADDONLANG['bf_wizard_run']         = '🚀 Egykattintásos beállítás futtatása';
$_ADDONLANG['bf_wizard_confirm']     = 'Ez létrehoz egy szerverrekordot, szinkronizálja a csomagokat, és automatikusan létrehozza a WHMCS-termékeket. Kezdjük?';

// Next steps / setup complete
$_ADDONLANG['bf_next_complete']  = '✅ A beállítás befejeződött.';
$_ADDONLANG['bf_next_body']      = 'Adj árakat minden termékhez a <strong>Termékek/Szolgáltatások → Termékek/Szolgáltatások → [Termék] → Árazás</strong> menüben, majd az ügyfeleid rendelhetnek. Amikor a Godmode új csomagokat ad hozzá, kattints a <strong>Csomagok szinkronizálása</strong>, majd az <strong>Összes termék létrehozása</strong> gombra.';

// Stats
$_ADDONLANG['bf_stat_total']   = 'Összesen';
$_ADDONLANG['bf_stat_linked']  = 'Összekapcsolva';
$_ADDONLANG['bf_stat_pending'] = 'Függőben';

// Package table
$_ADDONLANG['bf_table_no_packages']   = 'Még nincs szinkronizált csomag. Kattints a <strong>Csomagok szinkronizálása</strong> gombra, hogy lekérd őket a Godmode-ból.';
$_ADDONLANG['bf_col_package_name']    = 'Csomag neve';
$_ADDONLANG['bf_col_plan_id']         = 'Csomagazonosító';
$_ADDONLANG['bf_col_plan_id_note']    = '(Godmode-hoz)';
$_ADDONLANG['bf_col_godmode_id']      = 'Godmode-azonosító';
$_ADDONLANG['bf_col_product_id']      = 'Termékazonosító';
$_ADDONLANG['bf_col_product_id_note'] = '(Godmode-hoz)';
$_ADDONLANG['bf_col_whmcs_product']   = 'WHMCS-termék';
$_ADDONLANG['bf_col_status']          = 'Állapot';
$_ADDONLANG['bf_col_actions']         = 'Műveletek';
$_ADDONLANG['bf_status_synced_label'] = 'Szinkronizálva';
$_ADDONLANG['bf_status_pending_label']= 'Függőben';
$_ADDONLANG['bf_action_sync']         = 'Szinkronizálás';
$_ADDONLANG['bf_action_sync_title']   = 'Ezen csomag újbóli lekérése a Godmode-ból';
$_ADDONLANG['bf_action_auto_create']  = 'Automatikus létrehozás';
$_ADDONLANG['bf_action_auto_create_title'] = 'Új WHMCS-termék létrehozása és összekapcsolása';
$_ADDONLANG['bf_action_link']         = 'Összekapcsolás';
$_ADDONLANG['bf_action_link_placeholder'] = 'Meglévő termék összekapcsolása…';
$_ADDONLANG['bf_action_unlink']       = 'Szétkapcsolás';
$_ADDONLANG['bf_action_unlink_confirm'] = 'Eltávolítod a termékkapcsolatot ehhez: „%s”?';
$_ADDONLANG['bf_mapping_footer']      = '%d csomag a helyi hozzárendelésben — legutóbb frissítve: %s';
$_ADDONLANG['bf_never']               = 'Soha';

// Loading overlay
$_ADDONLANG['bf_overlay_title']  = 'BrandForge beállítása…';
$_ADDONLANG['bf_overlay_sub']    = 'Ez körülbelül 10–30 másodpercig tart. Kérjük, ne zárd be ezt az oldalt.';
$_ADDONLANG['bf_overlay_step1']  = 'Kapcsolódás a Godmode API-hoz';
$_ADDONLANG['bf_overlay_step2']  = 'Szerverrekord létrehozása';
$_ADDONLANG['bf_overlay_step3']  = 'Csomagok szinkronizálása a Godmode-ból';
$_ADDONLANG['bf_overlay_step4']  = 'WHMCS-termékek létrehozása';
$_ADDONLANG['bf_overlay_note']   = 'A beállítás befejezése után automatikusan átirányítunk.';

// Flash / status messages
$_ADDONLANG['bf_flash_invalid_token']   = 'Érvénytelen biztonsági token. Frissítsd az oldalt, és próbáld újra.';
$_ADDONLANG['bf_flash_need_creds']      = 'A Godmode API URL-nek és API-kulcsnak a modul beállításaiban kell lennie elmentve, mielőtt futtatnád a beállítást.';
$_ADDONLANG['bf_flash_setup_complete']  = 'A beállítás befejeződött! %1$d csomag szinkronizálva, %2$d WHMCS-termék létrehozva. Adj árakat minden termékhez, és készen állsz az értékesítésre.';
$_ADDONLANG['bf_flash_errors']          = ' Hibák: %s';
$_ADDONLANG['bf_flash_created_n']       = '%d termék létrehozva.';
$_ADDONLANG['bf_flash_reset_complete']  = 'A visszaállítás befejeződött. A hozzárendelési táblák törölve, a szerverrekord eltávolítva. A WHMCS-termékeid megmaradtak — futtasd újra az egykattintásos beállítást az újbóli összekapcsoláshoz (nem jönnek létre duplikátumok).';
$_ADDONLANG['bf_flash_synced_n']        = '%d csomag szinkronizálva a Godmode-ból.';
$_ADDONLANG['bf_flash_package_synced']  = 'A csomag sikeresen szinkronizálva.';
$_ADDONLANG['bf_flash_mapping_rebuilt'] = 'A hozzárendelés újraépítve — %d csomag szinkronizálva';
$_ADDONLANG['bf_flash_reconnected']     = ', %d meglévő termék újra összekapcsolva';
$_ADDONLANG['bf_flash_product_linked']  = 'A(z) %1$d számú WHMCS-termék („%2$s”) létrehozva és összekapcsolva.';
$_ADDONLANG['bf_flash_linked_to']       = 'A csomag összekapcsolva a(z) %d számú WHMCS-termékkel.';
$_ADDONLANG['bf_flash_link_removed']    = 'A termékkapcsolat eltávolítva.';
$_ADDONLANG['bf_flash_unknown_action']  = 'Ismeretlen művelet.';
$_ADDONLANG['bf_flash_no_package_id']   = 'Nincs megadva csomagazonosító.';
$_ADDONLANG['bf_flash_not_in_table']    = 'A csomag nincs a helyi táblában. Előbb futtasd az Összes szinkronizálását.';
$_ADDONLANG['bf_flash_already_linked']  = 'Ehhez a csomaghoz már tartozik összekapcsolt WHMCS-termék.';
$_ADDONLANG['bf_flash_select_product']  = 'Válassz ki egy WHMCS-terméket az összekapcsoláshoz.';
$_ADDONLANG['bf_flash_error_prefix']    = 'Hiba: %s';

// Addon settings (Configure page) field labels
$_ADDONLANG['bf_cfg_name']            = 'BrandForge Package Sync';
$_ADDONLANG['bf_cfg_description']     = 'Szinkronizálja a Godmode csomagokat a WHMCS termékekkel, és karbantartja a provisioning hozzárendelési táblát.';
$_ADDONLANG['bf_cfg_api_url']         = 'Godmode API URL';
$_ADDONLANG['bf_cfg_api_url_desc']    = 'A Godmode API alap URL-je (záró perjel nélkül)';
$_ADDONLANG['bf_cfg_api_key']         = 'Godmode API-kulcs';
$_ADDONLANG['bf_cfg_api_key_desc']    = 'Az összes Godmode API-kéréshez használt bearer token';
$_ADDONLANG['bf_cfg_debug_mode']      = 'Hibakeresési mód';
$_ADDONLANG['bf_cfg_debug_mode_desc'] = 'Részletes API-naplók írása a WHMCS modulnaplóba';

// Activate / Deactivate lifecycle messages
$_ADDONLANG['bf_activated']        = 'A BrandForge Package Sync aktiválva. A csomag- és szolgáltatás-hozzárendelési táblák létrejöttek.';
$_ADDONLANG['bf_activate_failed']  = 'Az aktiválás sikertelen: %s';
$_ADDONLANG['bf_deactivated']      = 'A BrandForge Package Sync deaktiválva. A hozzárendelési adatok megmaradtak.';
