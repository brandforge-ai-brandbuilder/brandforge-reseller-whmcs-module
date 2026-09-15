<?php
/**
 * BrandForge Package Sync — Addon Admin Language File (Brazilian Portuguese)
 *
 * Filename intentionally matches WHMCS's own admin-side spelling,
 * "portugues-br.php" (no final "e") — confirmed against the actual
 * /admin/lang/ directory listing on a live WHMCS install. Distinct from
 * lang/portugues.php (European Portuguese) and from the CLIENT-area
 * filename for this same language, "portuguese-br.php" (see
 * ../../../servers/brandforge/lang/) — WHMCS uses two different naming
 * conventions for the two areas, not a typo here.
 *
 * AI-drafted first pass — needs a native Brazilian Portuguese speaker's
 * review before being treated as production-ready. See lang/english.php
 * for the full key reference and how WHMCS loads this file.
 */

if (!defined('WHMCS')) {
    die('Access denied.');
}

$_ADDONLANG['bf_page_title']           = 'BrandForge — Sincronização de Pacotes';
$_ADDONLANG['bf_sync_packages']        = 'Sincronizar Pacotes';
$_ADDONLANG['bf_syncing']              = 'Sincronizando…';
$_ADDONLANG['bf_create_all_products']  = 'Criar Todos os Produtos';
$_ADDONLANG['bf_creating']             = 'Criando…';
$_ADDONLANG['bf_reset_everything']     = 'Redefinir Tudo';
$_ADDONLANG['bf_reset_confirm']        = "Isso apaga todos os dados de correspondência entre pacotes e serviços e remove o registro do servidor.\n\nSeus produtos do WHMCS são mantidos — executar a configuração novamente irá religá-los sem criar duplicatas.\n\nContinuar?";

// Status bar
$_ADDONLANG['bf_status_api_credentials']  = 'Credenciais de API';
$_ADDONLANG['bf_status_saved']            = 'Salvas';
$_ADDONLANG['bf_status_not_set']          = 'Não definidas — salve as configurações primeiro';
$_ADDONLANG['bf_status_server_record']    = 'Registro do Servidor';
$_ADDONLANG['bf_status_configured']       = 'Configurado';
$_ADDONLANG['bf_status_not_created']      = 'Não criado';
$_ADDONLANG['bf_status_packages']         = 'Pacotes';
$_ADDONLANG['bf_status_not_synced']       = 'Não sincronizados';
$_ADDONLANG['bf_status_synced']           = 'sincronizados';
$_ADDONLANG['bf_status_products']         = 'Produtos';
$_ADDONLANG['bf_status_ready']            = 'prontos';
$_ADDONLANG['bf_status_linked']           = 'vinculados';

// One-Click Setup wizard
$_ADDONLANG['bf_wizard_title']       = '🚀 Configuração em Um Clique';
$_ADDONLANG['bf_wizard_intro']       = 'Suas credenciais de API estão salvas nas configurações do módulo. Clique no botão abaixo para configurar tudo automaticamente — nenhuma etapa técnica é necessária.';
$_ADDONLANG['bf_wizard_step_server'] = 'Cria um registro de servidor WHMCS usando suas credenciais de API';
$_ADDONLANG['bf_wizard_step_pull']   = 'Busca todos os seus pacotes do Godmode';
$_ADDONLANG['bf_wizard_step_create'] = 'Cria um produto WHMCS para cada pacote';
$_ADDONLANG['bf_wizard_step_link']   = 'Vincula todos os produtos ao módulo BrandForge, totalmente configurados';
$_ADDONLANG['bf_wizard_need_creds']  = 'Salve seu <strong>URL da API do Godmode</strong> e sua <strong>Chave de API</strong> nas configurações do módulo (botão Configurar na página de Módulos Adicionais) antes de executar a configuração.';
$_ADDONLANG['bf_wizard_unavailable'] = 'Configuração Indisponível — Salve as Credenciais Primeiro';
$_ADDONLANG['bf_wizard_run']         = '🚀 Executar Configuração em Um Clique';
$_ADDONLANG['bf_wizard_confirm']     = 'Isso criará um registro de servidor, sincronizará os pacotes e criará produtos WHMCS automaticamente. Vamos lá?';

// Next steps / setup complete
$_ADDONLANG['bf_next_complete']  = '✅ Configuração concluída.';
$_ADDONLANG['bf_next_body']      = 'Adicione preços a cada produto em <strong>Produtos/Serviços → Produtos/Serviços → [Produto] → Preços</strong>, e seus clientes poderão fazer pedidos. Quando o Godmode adicionar novos pacotes, clique em <strong>Sincronizar Pacotes</strong> e depois em <strong>Criar Todos os Produtos</strong>.';

// Stats
$_ADDONLANG['bf_stat_total']   = 'Total';
$_ADDONLANG['bf_stat_linked']  = 'Vinculados';
$_ADDONLANG['bf_stat_pending'] = 'Pendentes';

// Package table
$_ADDONLANG['bf_table_no_packages']   = 'Nenhum pacote sincronizado ainda. Clique em <strong>Sincronizar Pacotes</strong> para buscar do Godmode.';
$_ADDONLANG['bf_col_package_name']    = 'Nome do Pacote';
$_ADDONLANG['bf_col_plan_id']         = 'ID do Plano';
$_ADDONLANG['bf_col_plan_id_note']    = '(para o Godmode)';
$_ADDONLANG['bf_col_godmode_id']      = 'ID do Godmode';
$_ADDONLANG['bf_col_product_id']      = 'ID do Produto';
$_ADDONLANG['bf_col_product_id_note'] = '(para o Godmode)';
$_ADDONLANG['bf_col_whmcs_product']   = 'Produto WHMCS';
$_ADDONLANG['bf_col_status']          = 'Status';
$_ADDONLANG['bf_col_actions']         = 'Ações';
$_ADDONLANG['bf_status_synced_label'] = 'Sincronizado';
$_ADDONLANG['bf_status_pending_label']= 'Pendente';
$_ADDONLANG['bf_action_sync']         = 'Sincronizar';
$_ADDONLANG['bf_action_sync_title']   = 'Buscar este pacote novamente do Godmode';
$_ADDONLANG['bf_action_auto_create']  = 'Criar Automaticamente';
$_ADDONLANG['bf_action_auto_create_title'] = 'Criar um novo produto WHMCS e vinculá-lo';
$_ADDONLANG['bf_action_link']         = 'Vincular';
$_ADDONLANG['bf_action_link_placeholder'] = 'Vincular produto existente…';
$_ADDONLANG['bf_action_unlink']       = 'Desvincular';
$_ADDONLANG['bf_action_unlink_confirm'] = 'Remover o vínculo do produto para "%s"?';
$_ADDONLANG['bf_mapping_footer']      = '%d pacote(s) na correspondência local — última atualização: %s';
$_ADDONLANG['bf_never']               = 'Nunca';

// Loading overlay
$_ADDONLANG['bf_overlay_title']  = 'Configurando o BrandForge…';
$_ADDONLANG['bf_overlay_sub']    = 'Isso leva cerca de 10 a 30 segundos. Por favor, não feche esta página.';
$_ADDONLANG['bf_overlay_step1']  = 'Conectando à API do Godmode';
$_ADDONLANG['bf_overlay_step2']  = 'Criando registro do servidor';
$_ADDONLANG['bf_overlay_step3']  = 'Sincronizando pacotes do Godmode';
$_ADDONLANG['bf_overlay_step4']  = 'Criando produtos WHMCS';
$_ADDONLANG['bf_overlay_note']   = 'Você será redirecionado automaticamente quando a configuração for concluída.';

// Flash / status messages
$_ADDONLANG['bf_flash_invalid_token']   = 'Token de segurança inválido. Atualize a página e tente novamente.';
$_ADDONLANG['bf_flash_need_creds']      = 'O URL da API do Godmode e a Chave de API devem ser salvos nas configurações do módulo antes de executar a configuração.';
$_ADDONLANG['bf_flash_setup_complete']  = 'Configuração concluída! %1$d pacote(s) sincronizado(s) e %2$d produto(s) WHMCS criado(s). Adicione preços a cada produto e você estará pronto para vender.';
$_ADDONLANG['bf_flash_errors']          = ' Erros: %s';
$_ADDONLANG['bf_flash_created_n']       = '%d produto(s) criado(s).';
$_ADDONLANG['bf_flash_reset_complete']  = 'Redefinição concluída. As tabelas de correspondência foram apagadas e o registro do servidor removido. Seus produtos WHMCS foram mantidos — execute a Configuração em Um Clique para religá-los (nenhuma duplicata será criada).';
$_ADDONLANG['bf_flash_synced_n']        = '%d pacote(s) sincronizado(s) do Godmode.';
$_ADDONLANG['bf_flash_package_synced']  = 'Pacote sincronizado com sucesso.';
$_ADDONLANG['bf_flash_mapping_rebuilt'] = 'Correspondência reconstruída — %d pacote(s) sincronizado(s)';
$_ADDONLANG['bf_flash_reconnected']     = ', %d produto(s) existente(s) religado(s)';
$_ADDONLANG['bf_flash_product_linked']  = 'Produto WHMCS #%1$d "%2$s" criado e vinculado.';
$_ADDONLANG['bf_flash_linked_to']       = 'Pacote vinculado ao produto WHMCS #%d.';
$_ADDONLANG['bf_flash_link_removed']    = 'Vínculo do produto removido.';
$_ADDONLANG['bf_flash_unknown_action']  = 'Ação desconhecida.';
$_ADDONLANG['bf_flash_no_package_id']   = 'Nenhum ID de pacote fornecido.';
$_ADDONLANG['bf_flash_not_in_table']    = 'Pacote não está na tabela local. Execute Sincronizar Tudo primeiro.';
$_ADDONLANG['bf_flash_already_linked']  = 'Este pacote já possui um produto WHMCS vinculado.';
$_ADDONLANG['bf_flash_select_product']  = 'Selecione um produto WHMCS para vincular.';
$_ADDONLANG['bf_flash_error_prefix']    = 'Erro: %s';

// Addon settings (Configure page) field labels
$_ADDONLANG['bf_cfg_name']            = 'BrandForge Package Sync';
$_ADDONLANG['bf_cfg_description']     = 'Sincroniza os pacotes do Godmode com os produtos do WHMCS e mantém a tabela de correspondência de provisionamento.';
$_ADDONLANG['bf_cfg_api_url']         = 'URL da API do Godmode';
$_ADDONLANG['bf_cfg_api_url_desc']    = 'URL base para a API do Godmode (sem barra final)';
$_ADDONLANG['bf_cfg_api_key']         = 'Chave de API do Godmode';
$_ADDONLANG['bf_cfg_api_key_desc']    = 'Token de portador usado para todas as solicitações à API do Godmode';
$_ADDONLANG['bf_cfg_debug_mode']      = 'Modo de Depuração';
$_ADDONLANG['bf_cfg_debug_mode_desc'] = 'Gravar logs detalhados de API no log de módulos do WHMCS';

// Activate / Deactivate lifecycle messages
$_ADDONLANG['bf_activated']        = 'BrandForge Package Sync ativado. As tabelas de correspondência de pacotes e serviços foram criadas.';
$_ADDONLANG['bf_activate_failed']  = 'Falha na ativação: %s';
$_ADDONLANG['bf_deactivated']      = 'BrandForge Package Sync desativado. Os dados de correspondência foram mantidos.';
