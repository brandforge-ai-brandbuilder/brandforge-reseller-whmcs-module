<?php
/**
 * BrandForge Provisioning Module — Client-Facing Strings (German)
 *
 * AI-drafted first pass — needs a native German speaker's review before
 * being treated as production-ready. See lang/english.php for the full
 * key reference, placeholder rules, and how this file is loaded.
 */

if (!defined('WHMCS')) {
    die('Access denied.');
}

return [
    'status_active'      => 'Aktiv',
    'status_suspended'   => 'Gesperrt',
    'status_pending'     => 'Ausstehend',
    'status_unknown'     => 'Unbekannt',

    'label_package'         => 'Paket',
    'label_status'          => 'Status',
    'label_subscription_id' => 'Abonnement-ID',
    'label_workspace_id'    => 'Workspace-ID',
    'label_provisioned'     => 'Bereitgestellt',

    'label_ai_credits' => 'KI-Credits',
    'used_of'          => '%1$d / %2$d verwendet',
    'remaining'        => 'verbleibend',
    'resets'           => 'Zurücksetzung am %s',

    'label_workspaces' => 'Workspaces',
    'active_of_max'    => '%1$d / %2$d verwendet',
    'active_count'     => '%d aktiv',
    'untitled'         => 'Unbenannt',
    'active'           => 'aktiv',
    'inactive'         => 'inaktiv',
    'workspace_note'   => 'Workspace-Details und Markenprojekte werden in %s verwaltet.',
    'open_app'         => 'App öffnen →',

    'launch_unavailable' => 'Start-Link nicht verfügbar:',
    'launch'             => '%s starten',
    'upgrade_plan'       => 'Plan upgraden',
    'view_workspace'     => 'Workspace anzeigen',
    'powered_by'         => 'Bereitgestellt von %s',
    'service_dashboard'  => 'Service-Dashboard',
    'not_provisioned'    => 'Dienst noch nicht bereitgestellt.',
    'being_set_up'       => 'Ihr %s-Abonnement wird gerade eingerichtet. Dies dauert in der Regel weniger als eine Minute. Wenn diese Meldung weiterhin angezeigt wird, wenden Sie sich bitte an den Support.',

    'launching'             => '%s wird gestartet…',
    'sso_signing_in'        => 'Sie werden sicher in Ihren Workspace angemeldet.',
    'sso_if_not_redirected' => 'Falls Sie nicht automatisch weitergeleitet werden:',
    'open_brand'            => '%s öffnen →',
    'launch_failed'         => 'Start fehlgeschlagen',
    'launch_failed_body'    => 'Wir konnten keinen sicheren Anmeldelink für Ihr Konto erstellen. Bitte versuchen Sie es erneut oder wenden Sie sich an den Support.',
    'go_back'               => '← Zurück',
];
