<?php
/**
 * BrandForge Provisioning Module — Client-Facing Strings (Catalan)
 *
 * AI-drafted first pass — needs a native Catalan speaker's review before
 * being treated as production-ready. See lang/english.php for the full
 * key reference, placeholder rules, and how this file is loaded.
 */

if (!defined('WHMCS')) {
    die('Access denied.');
}

return [
    'status_active'      => 'Actiu',
    'status_suspended'   => 'Suspès',
    'status_pending'     => 'Pendent',
    'status_unknown'     => 'Desconegut',

    'label_package'         => 'Paquet',
    'label_status'          => 'Estat',
    'label_subscription_id' => 'ID de subscripció',
    'label_workspace_id'    => "ID de l'espai de treball",
    'label_provisioned'     => 'Aprovisionat',

    'label_ai_credits' => "Crèdits d'IA",
    'used_of'          => '%1$d / %2$d utilitzats',
    'remaining'        => 'restants',
    'resets'           => 'Es renova el %s',

    'label_workspaces' => 'Espais de treball',
    'active_of_max'    => '%1$d / %2$d utilitzats',
    'active_count'     => '%d actius',
    'untitled'         => 'Sense títol',
    'active'           => 'actiu',
    'inactive'         => 'inactiu',
    'workspace_note'   => "Els detalls de l'espai de treball i els projectes de marca es gestionen dins de %s.",
    'open_app'         => "Obre l'aplicació →",

    'launch_unavailable' => 'Enllaç de llançament no disponible:',
    'launch'             => 'Inicia %s',
    'upgrade_plan'       => 'Millora el pla',
    'view_workspace'     => "Veure l'espai de treball",
    'powered_by'         => 'Desenvolupat per %s',
    'service_dashboard'  => 'Tauler del servei',
    'not_provisioned'    => "El servei encara no s'ha aprovisionat.",
    'being_set_up'       => 'La teva subscripció a %s s\'està configurant. Normalment triga menys d\'un minut. Si aquest missatge persisteix, contacta amb el suport.',

    'launching'             => "S'està iniciant %s…",
    'sso_signing_in'        => "S'està iniciant sessió de manera segura al teu espai de treball.",
    'sso_if_not_redirected' => 'Si no ets redirigit automàticament:',
    'open_brand'            => 'Obre %s →',
    'launch_failed'         => "Ha fallat l'inici",
    'launch_failed_body'    => "No hem pogut generar un enllaç d'inici de sessió segur per al teu compte. Torna-ho a provar o contacta amb el suport.",
    'go_back'               => '← Torna',
];
