<?php
/**
 * BrandForge Provisioning Module — Client-Facing Strings (Danish)
 *
 * AI-drafted first pass — needs a native Danish speaker's review before
 * being treated as production-ready. See lang/english.php for the full
 * key reference, placeholder rules, and how this file is loaded.
 */

if (!defined('WHMCS')) {
    die('Access denied.');
}

return [
    'status_active'      => 'Aktiv',
    'status_suspended'   => 'Suspenderet',
    'status_pending'     => 'Afventer',
    'status_unknown'     => 'Ukendt',

    'label_package'         => 'Pakke',
    'label_status'          => 'Status',
    'label_subscription_id' => 'Abonnements-id',
    'label_workspace_id'    => 'Workspace-id',
    'label_provisioned'     => 'Oprettet',

    'label_ai_credits' => 'AI-kreditter',
    'used_of'          => '%1$d / %2$d brugt',
    'remaining'        => 'tilbage',
    'resets'           => 'Nulstilles den %s',

    'label_workspaces' => 'Workspaces',
    'active_of_max'    => '%1$d / %2$d brugt',
    'active_count'     => '%d aktive',
    'untitled'         => 'Uden titel',
    'active'           => 'aktiv',
    'inactive'         => 'inaktiv',
    'workspace_note'   => 'Workspace-detaljer og brandprojekter administreres i %s.',
    'open_app'         => 'Åbn app →',

    'launch_unavailable' => 'Startlink ikke tilgængeligt:',
    'launch'             => 'Start %s',
    'upgrade_plan'       => 'Opgrader plan',
    'view_workspace'     => 'Vis workspace',
    'powered_by'         => 'Drevet af %s',
    'service_dashboard'  => 'Servicedashboard',
    'not_provisioned'    => 'Tjenesten er endnu ikke oprettet.',
    'being_set_up'       => 'Dit %s-abonnement er ved at blive konfigureret. Dette tager normalt under et minut. Kontakt support, hvis denne besked fortsætter.',

    'launching'             => 'Starter %s…',
    'sso_signing_in'        => 'Du bliver sikkert logget ind på dit workspace.',
    'sso_if_not_redirected' => 'Hvis du ikke bliver omdirigeret automatisk:',
    'open_brand'            => 'Åbn %s →',
    'launch_failed'         => 'Start mislykkedes',
    'launch_failed_body'    => 'Vi kunne ikke generere et sikkert loginlink til din konto. Prøv igen, eller kontakt support.',
    'go_back'               => '← Tilbage',
];
