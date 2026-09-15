<?php
/**
 * BrandForge Package Sync — Addon Admin Language File (Spanish)
 *
 * AI-drafted first pass — needs a native Spanish speaker's review before
 * being treated as production-ready. See lang/english.php for the full
 * key reference and how WHMCS loads this file.
 */

if (!defined('WHMCS')) {
    die('Access denied.');
}

$_ADDONLANG['bf_page_title']           = 'BrandForge — Sincronización de paquetes';
$_ADDONLANG['bf_sync_packages']        = 'Sincronizar paquetes';
$_ADDONLANG['bf_syncing']              = 'Sincronizando…';
$_ADDONLANG['bf_create_all_products']  = 'Crear todos los productos';
$_ADDONLANG['bf_creating']             = 'Creando…';
$_ADDONLANG['bf_reset_everything']     = 'Restablecer todo';
$_ADDONLANG['bf_reset_confirm']        = "Esto borra todos los datos de correspondencia entre paquetes y servicios y elimina el registro del servidor.\n\nTus productos de WHMCS se conservan — volver a ejecutar la configuración los volverá a vincular sin crear duplicados.\n\n¿Continuar?";

// Status bar
$_ADDONLANG['bf_status_api_credentials']  = 'Credenciales de API';
$_ADDONLANG['bf_status_saved']            = 'Guardadas';
$_ADDONLANG['bf_status_not_set']          = 'No configuradas — guarda primero la configuración';
$_ADDONLANG['bf_status_server_record']    = 'Registro de servidor';
$_ADDONLANG['bf_status_configured']       = 'Configurado';
$_ADDONLANG['bf_status_not_created']      = 'No creado';
$_ADDONLANG['bf_status_packages']         = 'Paquetes';
$_ADDONLANG['bf_status_not_synced']       = 'No sincronizados';
$_ADDONLANG['bf_status_synced']           = 'sincronizados';
$_ADDONLANG['bf_status_products']         = 'Productos';
$_ADDONLANG['bf_status_ready']            = 'listos';
$_ADDONLANG['bf_status_linked']           = 'vinculados';

// One-Click Setup wizard
$_ADDONLANG['bf_wizard_title']       = '🚀 Configuración en un clic';
$_ADDONLANG['bf_wizard_intro']       = 'Tus credenciales de API están guardadas en la configuración del módulo. Haz clic en el botón de abajo para configurarlo todo automáticamente — no se requieren pasos técnicos.';
$_ADDONLANG['bf_wizard_step_server'] = 'Crea un registro de servidor de WHMCS usando tus credenciales de API';
$_ADDONLANG['bf_wizard_step_pull']   = 'Obtiene todos tus paquetes de Godmode';
$_ADDONLANG['bf_wizard_step_create'] = 'Crea un producto de WHMCS para cada paquete';
$_ADDONLANG['bf_wizard_step_link']   = 'Vincula todos los productos al módulo BrandForge, totalmente configurados';
$_ADDONLANG['bf_wizard_need_creds']  = 'Guarda tu <strong>URL de la API de Godmode</strong> y tu <strong>clave de API</strong> en la configuración del módulo (botón Configurar en la página de Módulos adicionales) antes de ejecutar la configuración.';
$_ADDONLANG['bf_wizard_unavailable'] = 'Configuración no disponible — guarda primero las credenciales';
$_ADDONLANG['bf_wizard_run']         = '🚀 Ejecutar configuración en un clic';
$_ADDONLANG['bf_wizard_confirm']     = 'Esto creará un registro de servidor, sincronizará los paquetes y creará automáticamente productos de WHMCS. ¿Listo para continuar?';

// Next steps / setup complete
$_ADDONLANG['bf_next_complete']  = '✅ Configuración completada.';
$_ADDONLANG['bf_next_body']      = 'Añade precios a cada producto en <strong>Productos/Servicios → Productos/Servicios → [Producto] → Precios</strong>, y tus clientes podrán realizar pedidos. Cuando Godmode añada nuevos paquetes, haz clic en <strong>Sincronizar paquetes</strong> y luego en <strong>Crear todos los productos</strong>.';

// Stats
$_ADDONLANG['bf_stat_total']   = 'Total';
$_ADDONLANG['bf_stat_linked']  = 'Vinculados';
$_ADDONLANG['bf_stat_pending'] = 'Pendientes';

// Package table
$_ADDONLANG['bf_table_no_packages']   = 'Todavía no se ha sincronizado ningún paquete. Haz clic en <strong>Sincronizar paquetes</strong> para obtenerlos de Godmode.';
$_ADDONLANG['bf_col_package_name']    = 'Nombre del paquete';
$_ADDONLANG['bf_col_plan_id']         = 'ID del plan';
$_ADDONLANG['bf_col_plan_id_note']    = '(para Godmode)';
$_ADDONLANG['bf_col_godmode_id']      = 'ID de Godmode';
$_ADDONLANG['bf_col_product_id']      = 'ID del producto';
$_ADDONLANG['bf_col_product_id_note'] = '(para Godmode)';
$_ADDONLANG['bf_col_whmcs_product']   = 'Producto de WHMCS';
$_ADDONLANG['bf_col_status']          = 'Estado';
$_ADDONLANG['bf_col_actions']         = 'Acciones';
$_ADDONLANG['bf_status_synced_label'] = 'Sincronizado';
$_ADDONLANG['bf_status_pending_label']= 'Pendiente';
$_ADDONLANG['bf_action_sync']         = 'Sincronizar';
$_ADDONLANG['bf_action_sync_title']   = 'Volver a obtener este paquete desde Godmode';
$_ADDONLANG['bf_action_auto_create']  = 'Crear automáticamente';
$_ADDONLANG['bf_action_auto_create_title'] = 'Crear un nuevo producto de WHMCS y vincularlo';
$_ADDONLANG['bf_action_link']         = 'Vincular';
$_ADDONLANG['bf_action_link_placeholder'] = 'Vincular producto existente…';
$_ADDONLANG['bf_action_unlink']       = 'Desvincular';
$_ADDONLANG['bf_action_unlink_confirm'] = "¿Eliminar el vínculo del producto para «%s»?";
$_ADDONLANG['bf_mapping_footer']      = '%d paquete(s) en la correspondencia local — última actualización: %s';
$_ADDONLANG['bf_never']               = 'Nunca';

// Loading overlay
$_ADDONLANG['bf_overlay_title']  = 'Configurando BrandForge…';
$_ADDONLANG['bf_overlay_sub']    = 'Esto tarda entre 10 y 30 segundos. No cierres esta página.';
$_ADDONLANG['bf_overlay_step1']  = 'Conectando con la API de Godmode';
$_ADDONLANG['bf_overlay_step2']  = 'Creando registro de servidor';
$_ADDONLANG['bf_overlay_step3']  = 'Sincronizando paquetes desde Godmode';
$_ADDONLANG['bf_overlay_step4']  = 'Creando productos de WHMCS';
$_ADDONLANG['bf_overlay_note']   = 'Serás redirigido automáticamente cuando finalice la configuración.';

// Flash / status messages
$_ADDONLANG['bf_flash_invalid_token']   = 'Token de seguridad no válido. Actualiza la página e inténtalo de nuevo.';
$_ADDONLANG['bf_flash_need_creds']      = 'La URL de la API de Godmode y la clave de API deben guardarse en la configuración del módulo antes de ejecutar la configuración.';
$_ADDONLANG['bf_flash_setup_complete']  = '¡Configuración completada! Se sincronizaron %1$d paquete(s) y se crearon %2$d producto(s) de WHMCS. Añade precios a cada producto y estarás listo para vender.';
$_ADDONLANG['bf_flash_errors']          = ' Errores: %s';
$_ADDONLANG['bf_flash_created_n']       = '%d producto(s) creado(s).';
$_ADDONLANG['bf_flash_reset_complete']  = 'Restablecimiento completado. Se borraron las tablas de correspondencia y se eliminó el registro del servidor. Tus productos de WHMCS se conservaron — ejecuta la configuración en un clic para volver a vincularlos (no se crearán duplicados).';
$_ADDONLANG['bf_flash_synced_n']        = '%d paquete(s) sincronizado(s) desde Godmode.';
$_ADDONLANG['bf_flash_package_synced']  = 'Paquete sincronizado correctamente.';
$_ADDONLANG['bf_flash_mapping_rebuilt'] = 'Correspondencia reconstruida — %d paquete(s) sincronizado(s)';
$_ADDONLANG['bf_flash_reconnected']     = ', %d producto(s) existente(s) revinculado(s)';
$_ADDONLANG['bf_flash_product_linked']  = 'Producto de WHMCS #%1$d «%2$s» creado y vinculado.';
$_ADDONLANG['bf_flash_linked_to']       = 'Paquete vinculado al producto de WHMCS #%d.';
$_ADDONLANG['bf_flash_link_removed']    = 'Vínculo del producto eliminado.';
$_ADDONLANG['bf_flash_unknown_action']  = 'Acción desconocida.';
$_ADDONLANG['bf_flash_no_package_id']   = 'No se proporcionó ningún ID de paquete.';
$_ADDONLANG['bf_flash_not_in_table']    = 'El paquete no está en la tabla local. Ejecuta primero Sincronizar todo.';
$_ADDONLANG['bf_flash_already_linked']  = 'Este paquete ya tiene un producto de WHMCS vinculado.';
$_ADDONLANG['bf_flash_select_product']  = 'Selecciona un producto de WHMCS para vincular.';
$_ADDONLANG['bf_flash_error_prefix']    = 'Error: %s';

// Addon settings (Configure page) field labels
$_ADDONLANG['bf_cfg_name']            = 'BrandForge Package Sync';
$_ADDONLANG['bf_cfg_description']     = 'Sincroniza los paquetes de Godmode con los productos de WHMCS y mantiene la tabla de correspondencia de aprovisionamiento.';
$_ADDONLANG['bf_cfg_api_url']         = 'URL de la API de Godmode';
$_ADDONLANG['bf_cfg_api_url_desc']    = 'URL base de la API de Godmode (sin barra final)';
$_ADDONLANG['bf_cfg_api_key']         = 'Clave de API de Godmode';
$_ADDONLANG['bf_cfg_api_key_desc']    = 'Token de portador usado para todas las solicitudes a la API de Godmode';
$_ADDONLANG['bf_cfg_debug_mode']      = 'Modo de depuración';
$_ADDONLANG['bf_cfg_debug_mode_desc'] = 'Escribir registros detallados de la API en el registro de módulos de WHMCS';

// Activate / Deactivate lifecycle messages
$_ADDONLANG['bf_activated']        = 'BrandForge Package Sync activado. Se crearon las tablas de correspondencia de paquetes y servicios.';
$_ADDONLANG['bf_activate_failed']  = 'Error en la activación: %s';
$_ADDONLANG['bf_deactivated']      = 'BrandForge Package Sync desactivado. Los datos de correspondencia se conservan.';
