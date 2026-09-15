<?php
/**
 * BrandForge Provisioning Module — Client-Facing Strings (Spanish)
 *
 * AI-drafted first pass — needs a native Spanish speaker's review before
 * being treated as production-ready. See lang/english.php for the full
 * key reference, placeholder rules, and how this file is loaded.
 */

if (!defined('WHMCS')) {
    die('Access denied.');
}

return [
    'status_active'      => 'Activo',
    'status_suspended'   => 'Suspendido',
    'status_pending'     => 'Pendiente',
    'status_unknown'     => 'Desconocido',

    'label_package'         => 'Paquete',
    'label_status'          => 'Estado',
    'label_subscription_id' => 'ID de suscripción',
    'label_workspace_id'    => 'ID del espacio de trabajo',
    'label_provisioned'     => 'Aprovisionado',

    'label_ai_credits' => 'Créditos de IA',
    'used_of'          => '%1$d / %2$d usados',
    'remaining'        => 'restantes',
    'resets'           => 'Se reinicia el %s',

    'label_workspaces' => 'Espacios de trabajo',
    'active_of_max'    => '%1$d / %2$d usados',
    'active_count'     => '%d activos',
    'untitled'         => 'Sin título',
    'active'           => 'activo',
    'inactive'         => 'inactivo',
    'workspace_note'   => 'Los detalles del espacio de trabajo y los proyectos de marca se gestionan dentro de %s.',
    'open_app'         => 'Abrir la app →',

    'launch_unavailable' => 'Enlace de lanzamiento no disponible:',
    'launch'             => 'Iniciar %s',
    'upgrade_plan'       => 'Mejorar plan',
    'view_workspace'     => 'Ver espacio de trabajo',
    'powered_by'         => 'Desarrollado por %s',
    'service_dashboard'  => 'Panel del servicio',
    'not_provisioned'    => 'El servicio aún no se ha aprovisionado.',
    'being_set_up'       => 'Tu suscripción de %s se está configurando. Esto normalmente tarda menos de un minuto. Si este mensaje persiste, contacta con soporte.',

    'launching'             => 'Iniciando %s…',
    'sso_signing_in'        => 'Se te está iniciando sesión de forma segura en tu espacio de trabajo.',
    'sso_if_not_redirected' => 'Si no eres redirigido automáticamente:',
    'open_brand'            => 'Abrir %s →',
    'launch_failed'         => 'Error al iniciar',
    'launch_failed_body'    => 'No pudimos generar un enlace de inicio de sesión seguro para tu cuenta. Vuelve a intentarlo o contacta con soporte.',
    'go_back'               => '← Volver',
];
