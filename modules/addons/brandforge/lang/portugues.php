<?php
/**
 * BrandForge Package Sync — Addon Admin Language File (European Portuguese)
 *
 * Filename intentionally matches WHMCS's own admin-side spelling,
 * "portugues.php" (no final "e", no "-pt" suffix) — confirmed against the
 * actual /admin/lang/ directory listing on a live WHMCS install. Note this
 * differs from the CLIENT-area filename for the same language,
 * "portuguese-pt.php" (see ../../../servers/brandforge/lang/) — WHMCS uses
 * two different naming conventions for the two areas, not a typo here.
 *
 * AI-drafted first pass — needs a native (European) Portuguese speaker's
 * review before being treated as production-ready. See lang/english.php
 * for the full key reference and how WHMCS loads this file.
 */

if (!defined('WHMCS')) {
    die('Access denied.');
}

$_ADDONLANG['bf_page_title']           = 'BrandForge — Sincronização de pacotes';
$_ADDONLANG['bf_sync_packages']        = 'Sincronizar pacotes';
$_ADDONLANG['bf_syncing']              = 'A sincronizar…';
$_ADDONLANG['bf_create_all_products']  = 'Criar todos os produtos';
$_ADDONLANG['bf_creating']             = 'A criar…';
$_ADDONLANG['bf_reset_everything']     = 'Repor tudo';
$_ADDONLANG['bf_reset_confirm']        = "Isto apaga todos os dados de correspondência entre pacotes/serviços e remove o registo do servidor.\n\nOs seus produtos WHMCS são mantidos — executar novamente a configuração irá voltar a associá-los sem criar duplicados.\n\nContinuar?";

// Status bar
$_ADDONLANG['bf_status_api_credentials']  = 'Credenciais de API';
$_ADDONLANG['bf_status_saved']            = 'Guardadas';
$_ADDONLANG['bf_status_not_set']          = 'Não definidas — guarde primeiro as definições';
$_ADDONLANG['bf_status_server_record']    = 'Registo do servidor';
$_ADDONLANG['bf_status_configured']       = 'Configurado';
$_ADDONLANG['bf_status_not_created']      = 'Não criado';
$_ADDONLANG['bf_status_packages']         = 'Pacotes';
$_ADDONLANG['bf_status_not_synced']       = 'Não sincronizados';
$_ADDONLANG['bf_status_synced']           = 'sincronizados';
$_ADDONLANG['bf_status_products']         = 'Produtos';
$_ADDONLANG['bf_status_ready']            = 'prontos';
$_ADDONLANG['bf_status_linked']           = 'associados';

// One-Click Setup wizard
$_ADDONLANG['bf_wizard_title']       = '🚀 Configuração num clique';
$_ADDONLANG['bf_wizard_intro']       = 'As suas credenciais de API estão guardadas nas definições do módulo. Clique no botão abaixo para configurar tudo automaticamente — não são necessários passos técnicos.';
$_ADDONLANG['bf_wizard_step_server'] = 'Cria um registo de servidor WHMCS com as suas credenciais de API';
$_ADDONLANG['bf_wizard_step_pull']   = 'Obtém todos os seus pacotes Godmode';
$_ADDONLANG['bf_wizard_step_create'] = 'Cria um produto WHMCS para cada pacote';
$_ADDONLANG['bf_wizard_step_link']   = 'Associa todos os produtos ao módulo BrandForge, totalmente configurados';
$_ADDONLANG['bf_wizard_need_creds']  = 'Guarde o seu <strong>URL da API Godmode</strong> e a sua <strong>chave de API</strong> nas definições do módulo (botão Configurar na página Módulos complementares) antes de executar a configuração.';
$_ADDONLANG['bf_wizard_unavailable'] = 'Configuração indisponível — guarde primeiro as credenciais';
$_ADDONLANG['bf_wizard_run']         = '🚀 Executar configuração num clique';
$_ADDONLANG['bf_wizard_confirm']     = 'Isto irá criar um registo de servidor, sincronizar os pacotes e criar automaticamente produtos WHMCS. Continuar?';

// Next steps / setup complete
$_ADDONLANG['bf_next_complete']  = '✅ Configuração concluída.';
$_ADDONLANG['bf_next_body']      = 'Adicione preços a cada produto em <strong>Produtos/Serviços → Produtos/Serviços → [Produto] → Preços</strong>, e os seus clientes poderão encomendar. Quando o Godmode adicionar novos pacotes, clique em <strong>Sincronizar pacotes</strong> e depois em <strong>Criar todos os produtos</strong>.';

// Stats
$_ADDONLANG['bf_stat_total']   = 'Total';
$_ADDONLANG['bf_stat_linked']  = 'Associados';
$_ADDONLANG['bf_stat_pending'] = 'Pendentes';

// Package table
$_ADDONLANG['bf_table_no_packages']   = 'Ainda não há pacotes sincronizados. Clique em <strong>Sincronizar pacotes</strong> para os obter do Godmode.';
$_ADDONLANG['bf_col_package_name']    = 'Nome do pacote';
$_ADDONLANG['bf_col_plan_id']         = 'ID do plano';
$_ADDONLANG['bf_col_plan_id_note']    = '(para o Godmode)';
$_ADDONLANG['bf_col_godmode_id']      = 'ID do Godmode';
$_ADDONLANG['bf_col_product_id']      = 'ID do produto';
$_ADDONLANG['bf_col_product_id_note'] = '(para o Godmode)';
$_ADDONLANG['bf_col_whmcs_product']   = 'Produto WHMCS';
$_ADDONLANG['bf_col_status']          = 'Estado';
$_ADDONLANG['bf_col_actions']         = 'Ações';
$_ADDONLANG['bf_status_synced_label'] = 'Sincronizado';
$_ADDONLANG['bf_status_pending_label']= 'Pendente';
$_ADDONLANG['bf_action_sync']         = 'Sincronizar';
$_ADDONLANG['bf_action_sync_title']   = 'Obter novamente este pacote do Godmode';
$_ADDONLANG['bf_action_auto_create']  = 'Criar automaticamente';
$_ADDONLANG['bf_action_auto_create_title'] = 'Criar um novo produto WHMCS e associá-lo';
$_ADDONLANG['bf_action_link']         = 'Associar';
$_ADDONLANG['bf_action_link_placeholder'] = 'Associar produto existente…';
$_ADDONLANG['bf_action_unlink']       = 'Desassociar';
$_ADDONLANG['bf_action_unlink_confirm'] = 'Remover a associação do produto para «%s»?';
$_ADDONLANG['bf_mapping_footer']      = '%d pacote(s) na correspondência local — última atualização: %s';
$_ADDONLANG['bf_never']               = 'Nunca';

// Loading overlay
$_ADDONLANG['bf_overlay_title']  = 'A configurar o BrandForge…';
$_ADDONLANG['bf_overlay_sub']    = 'Isto demora cerca de 10 a 30 segundos. Não feche esta página.';
$_ADDONLANG['bf_overlay_step1']  = 'A ligar à API Godmode';
$_ADDONLANG['bf_overlay_step2']  = 'A criar o registo do servidor';
$_ADDONLANG['bf_overlay_step3']  = 'A sincronizar pacotes do Godmode';
$_ADDONLANG['bf_overlay_step4']  = 'A criar produtos WHMCS';
$_ADDONLANG['bf_overlay_note']   = 'Será redirecionado automaticamente quando a configuração terminar.';

// Flash / status messages
$_ADDONLANG['bf_flash_invalid_token']   = 'Token de segurança inválido. Atualize a página e tente novamente.';
$_ADDONLANG['bf_flash_need_creds']      = 'O URL da API Godmode e a chave de API têm de estar guardados nas definições do módulo antes de executar a configuração.';
$_ADDONLANG['bf_flash_setup_complete']  = 'Configuração concluída! %1$d pacote(s) sincronizado(s) e %2$d produto(s) WHMCS criado(s). Adicione preços a cada produto e estará pronto para vender.';
$_ADDONLANG['bf_flash_errors']          = ' Erros: %s';
$_ADDONLANG['bf_flash_created_n']       = '%d produto(s) criado(s).';
$_ADDONLANG['bf_flash_reset_complete']  = 'Reposição concluída. As tabelas de correspondência foram limpas e o registo do servidor removido. Os seus produtos WHMCS foram mantidos — execute a configuração num clique para os voltar a associar (não serão criados duplicados).';
$_ADDONLANG['bf_flash_synced_n']        = '%d pacote(s) sincronizado(s) do Godmode.';
$_ADDONLANG['bf_flash_package_synced']  = 'Pacote sincronizado com sucesso.';
$_ADDONLANG['bf_flash_mapping_rebuilt'] = 'Correspondência reconstruída — %d pacote(s) sincronizado(s)';
$_ADDONLANG['bf_flash_reconnected']     = ', %d produto(s) existente(s) voltado(s) a associar';
$_ADDONLANG['bf_flash_product_linked']  = 'Produto WHMCS #%1$d «%2$s» criado e associado.';
$_ADDONLANG['bf_flash_linked_to']       = 'Pacote associado ao produto WHMCS #%d.';
$_ADDONLANG['bf_flash_link_removed']    = 'Associação do produto removida.';
$_ADDONLANG['bf_flash_unknown_action']  = 'Ação desconhecida.';
$_ADDONLANG['bf_flash_no_package_id']   = 'Não foi fornecido nenhum ID de pacote.';
$_ADDONLANG['bf_flash_not_in_table']    = 'O pacote não está na tabela local. Execute primeiro Sincronizar tudo.';
$_ADDONLANG['bf_flash_already_linked']  = 'Este pacote já tem um produto WHMCS associado.';
$_ADDONLANG['bf_flash_select_product']  = 'Selecione um produto WHMCS para associar.';
$_ADDONLANG['bf_flash_error_prefix']    = 'Erro: %s';

// Addon settings (Configure page) field labels
$_ADDONLANG['bf_cfg_name']            = 'BrandForge Package Sync';
$_ADDONLANG['bf_cfg_description']     = 'Sincroniza os pacotes Godmode com os produtos WHMCS e mantém a tabela de correspondência de aprovisionamento.';
$_ADDONLANG['bf_cfg_api_url']         = 'URL da API Godmode';
$_ADDONLANG['bf_cfg_api_url_desc']    = 'URL base para a API Godmode (sem barra final)';
$_ADDONLANG['bf_cfg_api_key']         = 'Chave de API Godmode';
$_ADDONLANG['bf_cfg_api_key_desc']    = 'Token de portador utilizado em todos os pedidos à API Godmode';
$_ADDONLANG['bf_cfg_debug_mode']      = 'Modo de depuração';
$_ADDONLANG['bf_cfg_debug_mode_desc'] = 'Escrever registos detalhados da API no registo de módulos do WHMCS';

// Activate / Deactivate lifecycle messages
$_ADDONLANG['bf_activated']        = 'BrandForge Package Sync ativado. As tabelas de correspondência de pacotes e serviços foram criadas.';
$_ADDONLANG['bf_activate_failed']  = 'Falha na ativação: %s';
$_ADDONLANG['bf_deactivated']      = 'BrandForge Package Sync desativado. Os dados de correspondência foram mantidos.';
