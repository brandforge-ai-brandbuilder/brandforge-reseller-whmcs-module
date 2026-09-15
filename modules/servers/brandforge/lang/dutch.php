<?php
/**
 * BrandForge Provisioning Module — Client-Facing Strings (Dutch)
 *
 * AI-drafted first pass — needs a native Dutch speaker's review before
 * being treated as production-ready. See lang/english.php for the full
 * key reference, placeholder rules, and how this file is loaded.
 */

if (!defined('WHMCS')) {
    die('Access denied.');
}

return [
    'status_active'      => 'Actief',
    'status_suspended'   => 'Opgeschort',
    'status_pending'     => 'In behandeling',
    'status_unknown'     => 'Onbekend',

    'label_package'         => 'Pakket',
    'label_status'          => 'Status',
    'label_subscription_id' => 'Abonnements-ID',
    'label_workspace_id'    => 'Workspace-ID',
    'label_provisioned'     => 'Geconfigureerd',

    'label_ai_credits' => 'AI-credits',
    'used_of'          => '%1$d / %2$d gebruikt',
    'remaining'        => 'resterend',
    'resets'           => 'Wordt gereset op %s',

    'label_workspaces' => 'Workspaces',
    'active_of_max'    => '%1$d / %2$d gebruikt',
    'active_count'     => '%d actief',
    'untitled'         => 'Naamloos',
    'active'           => 'actief',
    'inactive'         => 'inactief',
    'workspace_note'   => 'Workspace-details en merkprojecten worden beheerd binnen %s.',
    'open_app'         => 'App openen →',

    'launch_unavailable' => 'Startlink niet beschikbaar:',
    'launch'             => '%s starten',
    'upgrade_plan'       => 'Abonnement upgraden',
    'view_workspace'     => 'Workspace bekijken',
    'powered_by'         => 'Mogelijk gemaakt door %s',
    'service_dashboard'  => 'Servicedashboard',
    'not_provisioned'    => 'Service nog niet geconfigureerd.',
    'being_set_up'       => 'Je %s-abonnement wordt ingesteld. Dit duurt meestal minder dan een minuut. Neem contact op met support als dit bericht blijft staan.',

    'launching'             => '%s wordt gestart…',
    'sso_signing_in'        => 'Je wordt veilig aangemeld bij je workspace.',
    'sso_if_not_redirected' => 'Als je niet automatisch wordt doorgestuurd:',
    'open_brand'            => '%s openen →',
    'launch_failed'         => 'Starten mislukt',
    'launch_failed_body'    => 'We konden geen beveiligde inloglink voor je account genereren. Probeer het opnieuw of neem contact op met support.',
    'go_back'               => '← Terug',
];
