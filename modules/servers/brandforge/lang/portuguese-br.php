<?php
/**
 * BrandForge Provisioning Module — Client-Facing Strings (Brazilian Portuguese)
 *
 * AI-drafted first pass — needs a native Brazilian Portuguese speaker's
 * review before being treated as production-ready. See lang/english.php
 * for the full key reference, placeholder rules, and how this file is
 * loaded. Distinct from lang/portuguese-pt.php (European Portuguese).
 */

if (!defined('WHMCS')) {
    die('Access denied.');
}

return [
    'status_active'      => 'Ativo',
    'status_suspended'   => 'Suspenso',
    'status_pending'     => 'Pendente',
    'status_unknown'     => 'Desconhecido',

    'label_package'         => 'Pacote',
    'label_status'          => 'Status',
    'label_subscription_id' => 'ID da assinatura',
    'label_workspace_id'    => 'ID do espaço de trabalho',
    'label_provisioned'     => 'Provisionado',

    'label_ai_credits' => 'Créditos de IA',
    'used_of'          => '%1$d / %2$d usados',
    'remaining'        => 'restantes',
    'resets'           => 'Renova em %s',

    'label_workspaces' => 'Espaços de trabalho',
    'active_of_max'    => '%1$d / %2$d usados',
    'active_count'     => '%d ativos',
    'untitled'         => 'Sem título',
    'active'           => 'ativo',
    'inactive'         => 'inativo',
    'workspace_note'   => 'Os detalhes do espaço de trabalho e os projetos de marca são gerenciados dentro do %s.',
    'open_app'         => 'Abrir aplicativo →',

    'launch_unavailable' => 'Link de inicialização indisponível:',
    'launch'             => 'Iniciar %s',
    'upgrade_plan'       => 'Fazer upgrade do plano',
    'view_workspace'     => 'Ver espaço de trabalho',
    'powered_by'         => 'Desenvolvido por %s',
    'service_dashboard'  => 'Painel do serviço',
    'not_provisioned'    => 'Serviço ainda não provisionado.',
    'being_set_up'       => 'Sua assinatura do %s está sendo configurada. Isso geralmente leva menos de um minuto. Se esta mensagem persistir, entre em contato com o suporte.',

    'launching'             => 'Iniciando %s…',
    'sso_signing_in'        => 'Você está sendo conectado com segurança ao seu espaço de trabalho.',
    'sso_if_not_redirected' => 'Se você não for redirecionado automaticamente:',
    'open_brand'            => 'Abrir %s →',
    'launch_failed'         => 'Falha ao iniciar',
    'launch_failed_body'    => 'Não foi possível gerar um link de login seguro para sua conta. Tente novamente ou entre em contato com o suporte.',
    'go_back'               => '← Voltar',
];
