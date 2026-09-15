<?php
/**
 * BrandForge Package Sync — Addon Admin Language File (Italian)
 *
 * AI-drafted first pass — needs a native Italian speaker's review before
 * being treated as production-ready. See lang/english.php for the full
 * key reference and how WHMCS loads this file.
 */

if (!defined('WHMCS')) {
    die('Access denied.');
}

$_ADDONLANG['bf_page_title']           = 'BrandForge — Sincronizzazione pacchetti';
$_ADDONLANG['bf_sync_packages']        = 'Sincronizza pacchetti';
$_ADDONLANG['bf_syncing']              = 'Sincronizzazione…';
$_ADDONLANG['bf_create_all_products']  = 'Crea tutti i prodotti';
$_ADDONLANG['bf_creating']             = 'Creazione…';
$_ADDONLANG['bf_reset_everything']     = 'Ripristina tutto';
$_ADDONLANG['bf_reset_confirm']        = "Questo cancella tutti i dati di corrispondenza pacchetto/servizio e rimuove il record del server.\n\nI tuoi prodotti WHMCS vengono mantenuti — rieseguire la configurazione li ricollegherà senza creare duplicati.\n\nContinuare?";

// Status bar
$_ADDONLANG['bf_status_api_credentials']  = 'Credenziali API';
$_ADDONLANG['bf_status_saved']            = 'Salvate';
$_ADDONLANG['bf_status_not_set']          = 'Non impostate — salva prima le impostazioni';
$_ADDONLANG['bf_status_server_record']    = 'Record del server';
$_ADDONLANG['bf_status_configured']       = 'Configurato';
$_ADDONLANG['bf_status_not_created']      = 'Non creato';
$_ADDONLANG['bf_status_packages']         = 'Pacchetti';
$_ADDONLANG['bf_status_not_synced']       = 'Non sincronizzati';
$_ADDONLANG['bf_status_synced']           = 'sincronizzati';
$_ADDONLANG['bf_status_products']         = 'Prodotti';
$_ADDONLANG['bf_status_ready']            = 'pronti';
$_ADDONLANG['bf_status_linked']           = 'collegati';

// One-Click Setup wizard
$_ADDONLANG['bf_wizard_title']       = '🚀 Configurazione con un clic';
$_ADDONLANG['bf_wizard_intro']       = "Le tue credenziali API sono salvate nelle impostazioni del modulo. Fai clic sul pulsante qui sotto per configurare tutto automaticamente — nessun passaggio tecnico richiesto.";
$_ADDONLANG['bf_wizard_step_server'] = 'Crea un record server WHMCS usando le tue credenziali API';
$_ADDONLANG['bf_wizard_step_pull']   = 'Recupera tutti i tuoi pacchetti Godmode';
$_ADDONLANG['bf_wizard_step_create'] = 'Crea un prodotto WHMCS per ogni pacchetto';
$_ADDONLANG['bf_wizard_step_link']   = 'Collega tutti i prodotti al modulo BrandForge, completamente configurati';
$_ADDONLANG['bf_wizard_need_creds']  = "Salva il tuo <strong>URL API Godmode</strong> e la tua <strong>chiave API</strong> nelle impostazioni del modulo (pulsante Configura nella pagina Moduli aggiuntivi) prima di eseguire la configurazione.";
$_ADDONLANG['bf_wizard_unavailable'] = 'Configurazione non disponibile — salva prima le credenziali';
$_ADDONLANG['bf_wizard_run']         = '🚀 Esegui configurazione con un clic';
$_ADDONLANG['bf_wizard_confirm']     = 'Questo creerà un record server, sincronizzerà i pacchetti e creerà automaticamente i prodotti WHMCS. Procedere?';

// Next steps / setup complete
$_ADDONLANG['bf_next_complete']  = '✅ Configurazione completata.';
$_ADDONLANG['bf_next_body']      = 'Aggiungi i prezzi a ogni prodotto in <strong>Prodotti/Servizi → Prodotti/Servizi → [Prodotto] → Prezzi</strong>, dopodiché i tuoi clienti potranno ordinare. Quando Godmode aggiunge nuovi pacchetti, fai clic su <strong>Sincronizza pacchetti</strong> e poi su <strong>Crea tutti i prodotti</strong>.';

// Stats
$_ADDONLANG['bf_stat_total']   = 'Totale';
$_ADDONLANG['bf_stat_linked']  = 'Collegati';
$_ADDONLANG['bf_stat_pending'] = 'In sospeso';

// Package table
$_ADDONLANG['bf_table_no_packages']   = 'Nessun pacchetto ancora sincronizzato. Fai clic su <strong>Sincronizza pacchetti</strong> per recuperarli da Godmode.';
$_ADDONLANG['bf_col_package_name']    = 'Nome pacchetto';
$_ADDONLANG['bf_col_plan_id']         = 'ID piano';
$_ADDONLANG['bf_col_plan_id_note']    = '(per Godmode)';
$_ADDONLANG['bf_col_godmode_id']      = 'ID Godmode';
$_ADDONLANG['bf_col_product_id']      = 'ID prodotto';
$_ADDONLANG['bf_col_product_id_note'] = '(per Godmode)';
$_ADDONLANG['bf_col_whmcs_product']   = 'Prodotto WHMCS';
$_ADDONLANG['bf_col_status']          = 'Stato';
$_ADDONLANG['bf_col_actions']         = 'Azioni';
$_ADDONLANG['bf_status_synced_label'] = 'Sincronizzato';
$_ADDONLANG['bf_status_pending_label']= 'In sospeso';
$_ADDONLANG['bf_action_sync']         = 'Sincronizza';
$_ADDONLANG['bf_action_sync_title']   = 'Recupera di nuovo questo pacchetto da Godmode';
$_ADDONLANG['bf_action_auto_create']  = 'Crea automaticamente';
$_ADDONLANG['bf_action_auto_create_title'] = 'Crea un nuovo prodotto WHMCS e collegalo';
$_ADDONLANG['bf_action_link']         = 'Collega';
$_ADDONLANG['bf_action_link_placeholder'] = 'Collega un prodotto esistente…';
$_ADDONLANG['bf_action_unlink']       = 'Scollega';
$_ADDONLANG['bf_action_unlink_confirm'] = "Rimuovere il collegamento del prodotto per «%s»?";
$_ADDONLANG['bf_mapping_footer']      = '%d pacchetto/i nella corrispondenza locale — ultimo aggiornamento: %s';
$_ADDONLANG['bf_never']               = 'Mai';

// Loading overlay
$_ADDONLANG['bf_overlay_title']  = 'Configurazione di BrandForge…';
$_ADDONLANG['bf_overlay_sub']    = 'L\'operazione richiede circa 10-30 secondi. Non chiudere questa pagina.';
$_ADDONLANG['bf_overlay_step1']  = 'Connessione all\'API Godmode';
$_ADDONLANG['bf_overlay_step2']  = 'Creazione del record server';
$_ADDONLANG['bf_overlay_step3']  = 'Sincronizzazione dei pacchetti da Godmode';
$_ADDONLANG['bf_overlay_step4']  = 'Creazione dei prodotti WHMCS';
$_ADDONLANG['bf_overlay_note']   = 'Verrai reindirizzato automaticamente al termine della configurazione.';

// Flash / status messages
$_ADDONLANG['bf_flash_invalid_token']   = 'Token di sicurezza non valido. Aggiorna la pagina e riprova.';
$_ADDONLANG['bf_flash_need_creds']      = 'URL API Godmode e chiave API devono essere salvati nelle impostazioni del modulo prima di eseguire la configurazione.';
$_ADDONLANG['bf_flash_setup_complete']  = 'Configurazione completata! Sincronizzato/i %1$d pacchetto/i e creato/i %2$d prodotto/i WHMCS. Aggiungi i prezzi a ogni prodotto e sarai pronto per vendere.';
$_ADDONLANG['bf_flash_errors']          = ' Errori: %s';
$_ADDONLANG['bf_flash_created_n']       = '%d prodotto/i creato/i.';
$_ADDONLANG['bf_flash_reset_complete']  = 'Ripristino completato. Le tabelle di corrispondenza sono state cancellate e il record del server rimosso. I tuoi prodotti WHMCS sono stati mantenuti — esegui la configurazione con un clic per ricollegarli (non verranno creati duplicati).';
$_ADDONLANG['bf_flash_synced_n']        = '%d pacchetto/i sincronizzato/i da Godmode.';
$_ADDONLANG['bf_flash_package_synced']  = 'Pacchetto sincronizzato correttamente.';
$_ADDONLANG['bf_flash_mapping_rebuilt'] = 'Corrispondenza ricostruita — %d pacchetto/i sincronizzato/i';
$_ADDONLANG['bf_flash_reconnected']     = ', %d prodotto/i esistente/i ricollegato/i';
$_ADDONLANG['bf_flash_product_linked']  = 'Prodotto WHMCS #%1$d «%2$s» creato e collegato.';
$_ADDONLANG['bf_flash_linked_to']       = 'Pacchetto collegato al prodotto WHMCS #%d.';
$_ADDONLANG['bf_flash_link_removed']    = 'Collegamento del prodotto rimosso.';
$_ADDONLANG['bf_flash_unknown_action']  = 'Azione sconosciuta.';
$_ADDONLANG['bf_flash_no_package_id']   = 'Nessun ID pacchetto fornito.';
$_ADDONLANG['bf_flash_not_in_table']    = 'Pacchetto non presente nella tabella locale. Esegui prima Sincronizza tutto.';
$_ADDONLANG['bf_flash_already_linked']  = 'Questo pacchetto ha già un prodotto WHMCS collegato.';
$_ADDONLANG['bf_flash_select_product']  = 'Seleziona un prodotto WHMCS da collegare.';
$_ADDONLANG['bf_flash_error_prefix']    = 'Errore: %s';

// Addon settings (Configure page) field labels
$_ADDONLANG['bf_cfg_name']            = 'BrandForge Package Sync';
$_ADDONLANG['bf_cfg_description']     = 'Sincronizza i pacchetti Godmode con i prodotti WHMCS e mantiene la tabella di corrispondenza per il provisioning.';
$_ADDONLANG['bf_cfg_api_url']         = 'URL API Godmode';
$_ADDONLANG['bf_cfg_api_url_desc']    = 'URL di base per l\'API Godmode (senza barra finale)';
$_ADDONLANG['bf_cfg_api_key']         = 'Chiave API Godmode';
$_ADDONLANG['bf_cfg_api_key_desc']    = 'Token bearer usato per tutte le richieste all\'API Godmode';
$_ADDONLANG['bf_cfg_debug_mode']      = 'Modalità debug';
$_ADDONLANG['bf_cfg_debug_mode_desc'] = 'Scrivi log API dettagliati nel log dei moduli WHMCS';

// Activate / Deactivate lifecycle messages
$_ADDONLANG['bf_activated']        = 'BrandForge Package Sync attivato. Le tabelle di corrispondenza di pacchetti e servizi sono state create.';
$_ADDONLANG['bf_activate_failed']  = 'Attivazione non riuscita: %s';
$_ADDONLANG['bf_deactivated']      = 'BrandForge Package Sync disattivato. I dati di corrispondenza sono stati conservati.';
