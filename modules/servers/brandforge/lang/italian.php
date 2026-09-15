<?php
/**
 * BrandForge Provisioning Module — Client-Facing Strings (Italian)
 *
 * AI-drafted first pass — needs a native Italian speaker's review before
 * being treated as production-ready. See lang/english.php for the full
 * key reference, placeholder rules, and how this file is loaded.
 */

if (!defined('WHMCS')) {
    die('Access denied.');
}

return [
    'status_active'      => 'Attivo',
    'status_suspended'   => 'Sospeso',
    'status_pending'     => 'In sospeso',
    'status_unknown'     => 'Sconosciuto',

    'label_package'         => 'Pacchetto',
    'label_status'          => 'Stato',
    'label_subscription_id' => 'ID abbonamento',
    'label_workspace_id'    => 'ID workspace',
    'label_provisioned'     => 'Provisionato',

    'label_ai_credits' => 'Crediti IA',
    'used_of'          => '%1$d / %2$d utilizzati',
    'remaining'        => 'rimanenti',
    'resets'           => 'Si rinnova il %s',

    'label_workspaces' => 'Workspace',
    'active_of_max'    => '%1$d / %2$d utilizzati',
    'active_count'     => '%d attivi',
    'untitled'         => 'Senza titolo',
    'active'           => 'attivo',
    'inactive'         => 'inattivo',
    'workspace_note'   => 'I dettagli del workspace e i progetti del brand sono gestiti in %s.',
    'open_app'         => "Apri l'app →",

    'launch_unavailable' => 'Link di avvio non disponibile:',
    'launch'             => 'Avvia %s',
    'upgrade_plan'       => 'Aggiorna piano',
    'view_workspace'     => 'Visualizza workspace',
    'powered_by'         => 'Offerto da %s',
    'service_dashboard'  => 'Dashboard del servizio',
    'not_provisioned'    => 'Servizio non ancora provisionato.',
    'being_set_up'       => 'Il tuo abbonamento a %s è in fase di configurazione. Di solito richiede meno di un minuto. Se il messaggio persiste, contatta l\'assistenza.',

    'launching'             => 'Avvio di %s…',
    'sso_signing_in'        => 'Stai per accedere in modo sicuro al tuo workspace.',
    'sso_if_not_redirected' => 'Se non vieni reindirizzato automaticamente:',
    'open_brand'            => 'Apri %s →',
    'launch_failed'         => 'Avvio non riuscito',
    'launch_failed_body'    => 'Non è stato possibile generare un link di accesso sicuro per il tuo account. Riprova o contatta l\'assistenza.',
    'go_back'               => '← Indietro',
];
