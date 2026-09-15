<?php
/**
 * BrandForge Package Sync — Addon Admin Language File (French)
 *
 * AI-drafted first pass — needs a native French speaker's review before
 * being treated as production-ready. See lang/english.php for the full
 * key reference and how WHMCS loads this file.
 */

if (!defined('WHMCS')) {
    die('Access denied.');
}

$_ADDONLANG['bf_page_title']           = 'BrandForge — Synchronisation des forfaits';
$_ADDONLANG['bf_sync_packages']        = 'Synchroniser les forfaits';
$_ADDONLANG['bf_syncing']              = 'Synchronisation…';
$_ADDONLANG['bf_create_all_products']  = 'Créer tous les produits';
$_ADDONLANG['bf_creating']             = 'Création…';
$_ADDONLANG['bf_reset_everything']     = 'Tout réinitialiser';
$_ADDONLANG['bf_reset_confirm']        = "Cela efface toutes les données de correspondance forfait/service et supprime l'enregistrement du serveur.\n\nVos produits WHMCS sont conservés — relancer la configuration les relira sans créer de doublons.\n\nContinuer ?";

// Status bar
$_ADDONLANG['bf_status_api_credentials']  = 'Identifiants API';
$_ADDONLANG['bf_status_saved']            = 'Enregistrés';
$_ADDONLANG['bf_status_not_set']          = "Non définis — enregistrez d'abord les paramètres";
$_ADDONLANG['bf_status_server_record']    = 'Enregistrement serveur';
$_ADDONLANG['bf_status_configured']       = 'Configuré';
$_ADDONLANG['bf_status_not_created']      = 'Non créé';
$_ADDONLANG['bf_status_packages']         = 'Forfaits';
$_ADDONLANG['bf_status_not_synced']       = 'Non synchronisés';
$_ADDONLANG['bf_status_synced']           = 'synchronisés';
$_ADDONLANG['bf_status_products']         = 'Produits';
$_ADDONLANG['bf_status_ready']            = 'prêts';
$_ADDONLANG['bf_status_linked']           = 'liés';

// One-Click Setup wizard
$_ADDONLANG['bf_wizard_title']       = '🚀 Configuration en un clic';
$_ADDONLANG['bf_wizard_intro']       = "Vos identifiants API sont enregistrés dans les paramètres du module. Cliquez sur le bouton ci-dessous pour tout configurer automatiquement — aucune étape technique requise.";
$_ADDONLANG['bf_wizard_step_server'] = 'Crée un enregistrement serveur WHMCS avec vos identifiants API';
$_ADDONLANG['bf_wizard_step_pull']   = 'Récupère tous vos forfaits Godmode';
$_ADDONLANG['bf_wizard_step_create'] = 'Crée un produit WHMCS pour chaque forfait';
$_ADDONLANG['bf_wizard_step_link']   = 'Lie tous les produits au module BrandForge, entièrement configurés';
$_ADDONLANG['bf_wizard_need_creds']  = "Veuillez enregistrer votre <strong>URL de l'API Godmode</strong> et votre <strong>clé API</strong> dans les paramètres du module (bouton Configurer sur la page Modules complémentaires) avant de lancer la configuration.";
$_ADDONLANG['bf_wizard_unavailable'] = "Configuration indisponible — enregistrez d'abord les identifiants";
$_ADDONLANG['bf_wizard_run']         = '🚀 Lancer la configuration en un clic';
$_ADDONLANG['bf_wizard_confirm']     = 'Cela va créer un enregistrement serveur, synchroniser les forfaits et créer automatiquement des produits WHMCS. Prêt ?';

// Next steps / setup complete
$_ADDONLANG['bf_next_complete']  = '✅ Configuration terminée.';
$_ADDONLANG['bf_next_body']      = 'Ajoutez une tarification à chaque produit sous <strong>Produits/Services → Produits/Services → [Produit] → Tarification</strong>, puis vos clients pourront commander. Lorsque Godmode ajoute de nouveaux forfaits, cliquez sur <strong>Synchroniser les forfaits</strong> puis <strong>Créer tous les produits</strong>.';

// Stats
$_ADDONLANG['bf_stat_total']   = 'Total';
$_ADDONLANG['bf_stat_linked']  = 'Liés';
$_ADDONLANG['bf_stat_pending'] = 'En attente';

// Package table
$_ADDONLANG['bf_table_no_packages']   = 'Aucun forfait synchronisé pour le moment. Cliquez sur <strong>Synchroniser les forfaits</strong> pour récupérer depuis Godmode.';
$_ADDONLANG['bf_col_package_name']    = 'Nom du forfait';
$_ADDONLANG['bf_col_plan_id']         = 'ID du plan';
$_ADDONLANG['bf_col_plan_id_note']    = '(pour Godmode)';
$_ADDONLANG['bf_col_godmode_id']      = 'ID Godmode';
$_ADDONLANG['bf_col_product_id']      = 'ID du produit';
$_ADDONLANG['bf_col_product_id_note'] = '(pour Godmode)';
$_ADDONLANG['bf_col_whmcs_product']   = 'Produit WHMCS';
$_ADDONLANG['bf_col_status']          = 'Statut';
$_ADDONLANG['bf_col_actions']         = 'Actions';
$_ADDONLANG['bf_status_synced_label'] = 'Synchronisé';
$_ADDONLANG['bf_status_pending_label']= 'En attente';
$_ADDONLANG['bf_action_sync']         = 'Synchroniser';
$_ADDONLANG['bf_action_sync_title']   = 'Récupérer à nouveau ce forfait depuis Godmode';
$_ADDONLANG['bf_action_auto_create']  = 'Créer automatiquement';
$_ADDONLANG['bf_action_auto_create_title'] = 'Créer un nouveau produit WHMCS et le lier';
$_ADDONLANG['bf_action_link']         = 'Lier';
$_ADDONLANG['bf_action_link_placeholder'] = 'Lier un produit existant…';
$_ADDONLANG['bf_action_unlink']       = 'Délier';
$_ADDONLANG['bf_action_unlink_confirm'] = 'Supprimer le lien du produit pour « %s » ?';
$_ADDONLANG['bf_mapping_footer']      = '%d forfait(s) dans la correspondance locale — dernière mise à jour : %s';
$_ADDONLANG['bf_never']               = 'Jamais';

// Loading overlay
$_ADDONLANG['bf_overlay_title']  = 'Configuration de BrandForge…';
$_ADDONLANG['bf_overlay_sub']    = 'Cela prend environ 10 à 30 secondes. Merci de ne pas fermer cette page.';
$_ADDONLANG['bf_overlay_step1']  = "Connexion à l'API Godmode";
$_ADDONLANG['bf_overlay_step2']  = "Création de l'enregistrement serveur";
$_ADDONLANG['bf_overlay_step3']  = 'Synchronisation des forfaits depuis Godmode';
$_ADDONLANG['bf_overlay_step4']  = 'Création des produits WHMCS';
$_ADDONLANG['bf_overlay_note']   = 'Vous serez redirigé automatiquement une fois la configuration terminée.';

// Flash / status messages
$_ADDONLANG['bf_flash_invalid_token']   = 'Jeton de sécurité invalide. Veuillez actualiser la page et réessayer.';
$_ADDONLANG['bf_flash_need_creds']      = "L'URL de l'API Godmode et la clé API doivent être enregistrées dans les paramètres du module avant de lancer la configuration.";
$_ADDONLANG['bf_flash_setup_complete']  = 'Configuration terminée ! %1$d forfait(s) synchronisé(s) et %2$d produit(s) WHMCS créé(s). Ajoutez une tarification à chaque produit, puis vous serez prêt à vendre.';
$_ADDONLANG['bf_flash_errors']          = ' Erreurs : %s';
$_ADDONLANG['bf_flash_created_n']       = '%d produit(s) créé(s).';
$_ADDONLANG['bf_flash_reset_complete']  = "Réinitialisation terminée. Les tables de correspondance ont été effacées et l'enregistrement serveur supprimé. Vos produits WHMCS ont été conservés — lancez la configuration en un clic pour les relier (aucun doublon ne sera créé).";
$_ADDONLANG['bf_flash_synced_n']        = '%d forfait(s) synchronisé(s) depuis Godmode.';
$_ADDONLANG['bf_flash_package_synced']  = 'Forfait synchronisé avec succès.';
$_ADDONLANG['bf_flash_mapping_rebuilt'] = 'Correspondance reconstruite — %d forfait(s) synchronisé(s)';
$_ADDONLANG['bf_flash_reconnected']     = ', %d produit(s) existant(s) relié(s)';
$_ADDONLANG['bf_flash_product_linked']  = 'Produit WHMCS #%1$d « %2$s » créé et lié.';
$_ADDONLANG['bf_flash_linked_to']       = 'Forfait lié au produit WHMCS #%d.';
$_ADDONLANG['bf_flash_link_removed']    = 'Lien du produit supprimé.';
$_ADDONLANG['bf_flash_unknown_action']  = 'Action inconnue.';
$_ADDONLANG['bf_flash_no_package_id']   = 'Aucun ID de forfait fourni.';
$_ADDONLANG['bf_flash_not_in_table']    = "Forfait absent de la table locale. Lancez d'abord Synchroniser tout.";
$_ADDONLANG['bf_flash_already_linked']  = 'Ce forfait est déjà lié à un produit WHMCS.';
$_ADDONLANG['bf_flash_select_product']  = 'Veuillez sélectionner un produit WHMCS à lier.';
$_ADDONLANG['bf_flash_error_prefix']    = 'Erreur : %s';

// Addon settings (Configure page) field labels
$_ADDONLANG['bf_cfg_name']            = 'BrandForge Package Sync';
$_ADDONLANG['bf_cfg_description']     = 'Synchronise les forfaits Godmode avec les produits WHMCS et maintient la table de correspondance de provisionnement.';
$_ADDONLANG['bf_cfg_api_url']         = "URL de l'API Godmode";
$_ADDONLANG['bf_cfg_api_url_desc']    = "URL de base pour l'API Godmode (sans barre oblique finale)";
$_ADDONLANG['bf_cfg_api_key']         = 'Clé API Godmode';
$_ADDONLANG['bf_cfg_api_key_desc']    = "Jeton porteur utilisé pour toutes les requêtes vers l'API Godmode";
$_ADDONLANG['bf_cfg_debug_mode']      = 'Mode débogage';
$_ADDONLANG['bf_cfg_debug_mode_desc'] = 'Écrire des journaux API détaillés dans le journal des modules WHMCS';

// Activate / Deactivate lifecycle messages
$_ADDONLANG['bf_activated']        = 'BrandForge Package Sync activé. Les tables de correspondance des forfaits et services ont été créées.';
$_ADDONLANG['bf_activate_failed']  = "Échec de l'activation : %s";
$_ADDONLANG['bf_deactivated']      = 'BrandForge Package Sync désactivé. Les données de correspondance sont conservées.';
