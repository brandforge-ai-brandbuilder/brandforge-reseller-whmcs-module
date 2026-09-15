<?php
/**
 * BrandForge Provisioning Module — Client-Facing Strings (French)
 *
 * AI-drafted first pass — needs a native French speaker's review before
 * being treated as production-ready. See lang/english.php for the full
 * key reference, placeholder rules, and how this file is loaded.
 */

if (!defined('WHMCS')) {
    die('Access denied.');
}

return [
    'status_active'      => 'Actif',
    'status_suspended'   => 'Suspendu',
    'status_pending'     => 'En attente',
    'status_unknown'     => 'Inconnu',

    'label_package'         => 'Forfait',
    'label_status'          => 'Statut',
    'label_subscription_id' => "ID d'abonnement",
    'label_workspace_id'    => "ID de l'espace de travail",
    'label_provisioned'     => 'Provisionné',

    'label_ai_credits' => 'Crédits IA',
    'used_of'          => '%1$d / %2$d utilisés',
    'remaining'        => 'restants',
    'resets'           => 'Réinitialisation le %s',

    'label_workspaces' => 'Espaces de travail',
    'active_of_max'    => '%1$d / %2$d utilisés',
    'active_count'     => '%d actifs',
    'untitled'         => 'Sans titre',
    'active'           => 'actif',
    'inactive'         => 'inactif',
    'workspace_note'   => "Les détails de l'espace de travail et les projets de marque sont gérés dans %s.",
    'open_app'         => "Ouvrir l'application →",

    'launch_unavailable' => 'Lien de lancement indisponible :',
    'launch'             => 'Lancer %s',
    'upgrade_plan'       => 'Améliorer le forfait',
    'view_workspace'     => "Voir l'espace de travail",
    'powered_by'         => 'Propulsé par %s',
    'service_dashboard'  => 'Tableau de bord du service',
    'not_provisioned'    => 'Service pas encore provisionné.',
    'being_set_up'       => "Votre abonnement %s est en cours de configuration. Cela prend généralement moins d'une minute. Si ce message persiste, veuillez contacter le support.",

    'launching'             => 'Lancement de %s…',
    'sso_signing_in'        => 'Vous êtes en cours de connexion sécurisée à votre espace de travail.',
    'sso_if_not_redirected' => "Si vous n'êtes pas redirigé automatiquement :",
    'open_brand'            => 'Ouvrir %s →',
    'launch_failed'         => 'Échec du lancement',
    'launch_failed_body'    => "Nous n'avons pas pu générer de lien de connexion sécurisé pour votre compte. Veuillez réessayer ou contacter le support.",
    'go_back'               => '← Retour',
];
