<?php
/**
 * BrandForge Package Sync — Addon Admin Language File (Russian)
 *
 * AI-drafted first pass — needs a native Russian speaker's review before
 * being treated as production-ready. See lang/english.php for the full
 * key reference and how WHMCS loads this file.
 */

if (!defined('WHMCS')) {
    die('Access denied.');
}

$_ADDONLANG['bf_page_title']           = 'BrandForge — Синхронизация пакетов';
$_ADDONLANG['bf_sync_packages']        = 'Синхронизировать пакеты';
$_ADDONLANG['bf_syncing']              = 'Синхронизация…';
$_ADDONLANG['bf_create_all_products']  = 'Создать все продукты';
$_ADDONLANG['bf_creating']             = 'Создание…';
$_ADDONLANG['bf_reset_everything']     = 'Сбросить всё';
$_ADDONLANG['bf_reset_confirm']        = "Это очистит все данные сопоставления пакетов/услуг и удалит запись сервера.\n\nВаши продукты WHMCS сохранятся — повторный запуск настройки заново свяжет их без создания дубликатов.\n\nПродолжить?";

// Status bar
$_ADDONLANG['bf_status_api_credentials']  = 'Учётные данные API';
$_ADDONLANG['bf_status_saved']            = 'Сохранены';
$_ADDONLANG['bf_status_not_set']          = 'Не заданы — сначала сохраните настройки';
$_ADDONLANG['bf_status_server_record']    = 'Запись сервера';
$_ADDONLANG['bf_status_configured']       = 'Настроено';
$_ADDONLANG['bf_status_not_created']      = 'Не создано';
$_ADDONLANG['bf_status_packages']         = 'Пакеты';
$_ADDONLANG['bf_status_not_synced']       = 'Не синхронизированы';
$_ADDONLANG['bf_status_synced']           = 'синхронизировано';
$_ADDONLANG['bf_status_products']         = 'Продукты';
$_ADDONLANG['bf_status_ready']            = 'готово';
$_ADDONLANG['bf_status_linked']           = 'связано';

// One-Click Setup wizard
$_ADDONLANG['bf_wizard_title']       = '🚀 Настройка в один клик';
$_ADDONLANG['bf_wizard_intro']       = 'Ваши учётные данные API сохранены в настройках модуля. Нажмите кнопку ниже, чтобы настроить всё автоматически — технические шаги не требуются.';
$_ADDONLANG['bf_wizard_step_server'] = 'Создаёт запись сервера WHMCS, используя ваши учётные данные API';
$_ADDONLANG['bf_wizard_step_pull']   = 'Получает все ваши пакеты Godmode';
$_ADDONLANG['bf_wizard_step_create'] = 'Создаёт продукт WHMCS для каждого пакета';
$_ADDONLANG['bf_wizard_step_link']   = 'Связывает все продукты с модулем BrandForge, полностью настроенные';
$_ADDONLANG['bf_wizard_need_creds']  = 'Сохраните <strong>URL API Godmode</strong> и <strong>ключ API</strong> в настройках модуля (кнопка «Настроить» на странице дополнительных модулей), прежде чем запускать настройку.';
$_ADDONLANG['bf_wizard_unavailable'] = 'Настройка недоступна — сначала сохраните учётные данные';
$_ADDONLANG['bf_wizard_run']         = '🚀 Запустить настройку в один клик';
$_ADDONLANG['bf_wizard_confirm']     = 'Это создаст запись сервера, синхронизирует пакеты и автоматически создаст продукты WHMCS. Продолжить?';

// Next steps / setup complete
$_ADDONLANG['bf_next_complete']  = '✅ Настройка завершена.';
$_ADDONLANG['bf_next_body']      = 'Добавьте цены к каждому продукту в разделе <strong>Продукты/Услуги → Продукты/Услуги → [Продукт] → Цены</strong>, после чего ваши клиенты смогут оформлять заказы. Когда Godmode добавит новые пакеты, нажмите <strong>Синхронизировать пакеты</strong>, а затем <strong>Создать все продукты</strong>.';

// Stats
$_ADDONLANG['bf_stat_total']   = 'Всего';
$_ADDONLANG['bf_stat_linked']  = 'Связано';
$_ADDONLANG['bf_stat_pending'] = 'Ожидает';

// Package table
$_ADDONLANG['bf_table_no_packages']   = 'Пакеты ещё не синхронизированы. Нажмите <strong>Синхронизировать пакеты</strong>, чтобы получить их из Godmode.';
$_ADDONLANG['bf_col_package_name']    = 'Название пакета';
$_ADDONLANG['bf_col_plan_id']         = 'ID тарифа';
$_ADDONLANG['bf_col_plan_id_note']    = '(для Godmode)';
$_ADDONLANG['bf_col_godmode_id']      = 'ID Godmode';
$_ADDONLANG['bf_col_product_id']      = 'ID продукта';
$_ADDONLANG['bf_col_product_id_note'] = '(для Godmode)';
$_ADDONLANG['bf_col_whmcs_product']   = 'Продукт WHMCS';
$_ADDONLANG['bf_col_status']          = 'Статус';
$_ADDONLANG['bf_col_actions']         = 'Действия';
$_ADDONLANG['bf_status_synced_label'] = 'Синхронизировано';
$_ADDONLANG['bf_status_pending_label']= 'Ожидает';
$_ADDONLANG['bf_action_sync']         = 'Синхронизировать';
$_ADDONLANG['bf_action_sync_title']   = 'Повторно получить этот пакет из Godmode';
$_ADDONLANG['bf_action_auto_create']  = 'Создать автоматически';
$_ADDONLANG['bf_action_auto_create_title'] = 'Создать новый продукт WHMCS и связать его';
$_ADDONLANG['bf_action_link']         = 'Связать';
$_ADDONLANG['bf_action_link_placeholder'] = 'Связать с существующим продуктом…';
$_ADDONLANG['bf_action_unlink']       = 'Отвязать';
$_ADDONLANG['bf_action_unlink_confirm'] = 'Удалить связь продукта для «%s»?';
$_ADDONLANG['bf_mapping_footer']      = 'Пакетов в локальном сопоставлении: %d — последнее обновление: %s';
$_ADDONLANG['bf_never']               = 'Никогда';

// Loading overlay
$_ADDONLANG['bf_overlay_title']  = 'Настройка BrandForge…';
$_ADDONLANG['bf_overlay_sub']    = 'Это занимает примерно 10–30 секунд. Пожалуйста, не закрывайте эту страницу.';
$_ADDONLANG['bf_overlay_step1']  = 'Подключение к API Godmode';
$_ADDONLANG['bf_overlay_step2']  = 'Создание записи сервера';
$_ADDONLANG['bf_overlay_step3']  = 'Синхронизация пакетов из Godmode';
$_ADDONLANG['bf_overlay_step4']  = 'Создание продуктов WHMCS';
$_ADDONLANG['bf_overlay_note']   = 'После завершения настройки вы будете автоматически перенаправлены.';

// Flash / status messages
$_ADDONLANG['bf_flash_invalid_token']   = 'Недействительный токен безопасности. Обновите страницу и повторите попытку.';
$_ADDONLANG['bf_flash_need_creds']      = 'Перед запуском настройки необходимо сохранить URL API Godmode и ключ API в настройках модуля.';
$_ADDONLANG['bf_flash_setup_complete']  = 'Настройка завершена! Синхронизировано пакетов: %1$d, создано продуктов WHMCS: %2$d. Добавьте цены к каждому продукту — и вы готовы продавать.';
$_ADDONLANG['bf_flash_errors']          = ' Ошибки: %s';
$_ADDONLANG['bf_flash_created_n']       = 'Создано продуктов: %d.';
$_ADDONLANG['bf_flash_reset_complete']  = 'Сброс завершён. Таблицы сопоставления очищены, запись сервера удалена. Ваши продукты WHMCS сохранены — запустите настройку в один клик, чтобы связать их снова (дубликаты не будут созданы).';
$_ADDONLANG['bf_flash_synced_n']        = 'Синхронизировано пакетов из Godmode: %d.';
$_ADDONLANG['bf_flash_package_synced']  = 'Пакет успешно синхронизирован.';
$_ADDONLANG['bf_flash_mapping_rebuilt'] = 'Сопоставление перестроено — синхронизировано пакетов: %d';
$_ADDONLANG['bf_flash_reconnected']     = ', повторно связано существующих продуктов: %d';
$_ADDONLANG['bf_flash_product_linked']  = 'Продукт WHMCS №%1$d «%2$s» создан и связан.';
$_ADDONLANG['bf_flash_linked_to']       = 'Пакет связан с продуктом WHMCS №%d.';
$_ADDONLANG['bf_flash_link_removed']    = 'Связь продукта удалена.';
$_ADDONLANG['bf_flash_unknown_action']  = 'Неизвестное действие.';
$_ADDONLANG['bf_flash_no_package_id']   = 'Не указан ID пакета.';
$_ADDONLANG['bf_flash_not_in_table']    = 'Пакет отсутствует в локальной таблице. Сначала выполните «Синхронизировать всё».';
$_ADDONLANG['bf_flash_already_linked']  = 'Этот пакет уже связан с продуктом WHMCS.';
$_ADDONLANG['bf_flash_select_product']  = 'Выберите продукт WHMCS для связывания.';
$_ADDONLANG['bf_flash_error_prefix']    = 'Ошибка: %s';

// Addon settings (Configure page) field labels
$_ADDONLANG['bf_cfg_name']            = 'BrandForge Package Sync';
$_ADDONLANG['bf_cfg_description']     = 'Синхронизирует пакеты Godmode с продуктами WHMCS и поддерживает таблицу сопоставления для провижининга.';
$_ADDONLANG['bf_cfg_api_url']         = 'URL API Godmode';
$_ADDONLANG['bf_cfg_api_url_desc']    = 'Базовый URL для API Godmode (без завершающей косой черты)';
$_ADDONLANG['bf_cfg_api_key']         = 'Ключ API Godmode';
$_ADDONLANG['bf_cfg_api_key_desc']    = 'Bearer-токен, используемый для всех запросов к API Godmode';
$_ADDONLANG['bf_cfg_debug_mode']      = 'Режим отладки';
$_ADDONLANG['bf_cfg_debug_mode_desc'] = 'Записывать подробные журналы API в журнал модулей WHMCS';

// Activate / Deactivate lifecycle messages
$_ADDONLANG['bf_activated']        = 'BrandForge Package Sync активирован. Таблицы сопоставления пакетов и услуг созданы.';
$_ADDONLANG['bf_activate_failed']  = 'Ошибка активации: %s';
$_ADDONLANG['bf_deactivated']      = 'BrandForge Package Sync деактивирован. Данные сопоставления сохранены.';
