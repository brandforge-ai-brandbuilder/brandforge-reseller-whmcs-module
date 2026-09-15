<?php
/**
 * BrandForge Package Sync — Addon Admin Language File (Farsi/Persian)
 *
 * AI-drafted first pass — needs a native Farsi speaker's review before
 * being treated as production-ready, including RTL arrow-direction
 * convention (kept identical to the English source here). See
 * lang/english.php for the full key reference and how WHMCS loads this
 * file.
 */

if (!defined('WHMCS')) {
    die('Access denied.');
}

$_ADDONLANG['bf_page_title']           = 'BrandForge — همگام‌سازی بسته‌ها';
$_ADDONLANG['bf_sync_packages']        = 'همگام‌سازی بسته‌ها';
$_ADDONLANG['bf_syncing']              = 'در حال همگام‌سازی…';
$_ADDONLANG['bf_create_all_products']  = 'ایجاد همه محصولات';
$_ADDONLANG['bf_creating']             = 'در حال ایجاد…';
$_ADDONLANG['bf_reset_everything']     = 'بازنشانی همه چیز';
$_ADDONLANG['bf_reset_confirm']        = "این کار تمام داده‌های تطبیق بسته/سرویس را پاک می‌کند و رکورد سرور را حذف می‌کند.\n\nمحصولات WHMCS شما حفظ می‌شوند — اجرای دوباره راه‌اندازی آن‌ها را بدون ایجاد نسخه تکراری دوباره پیوند می‌دهد.\n\nادامه می‌دهید؟";

// Status bar
$_ADDONLANG['bf_status_api_credentials']  = 'اطلاعات ورود API';
$_ADDONLANG['bf_status_saved']            = 'ذخیره شد';
$_ADDONLANG['bf_status_not_set']          = 'تنظیم نشده — ابتدا تنظیمات را ذخیره کنید';
$_ADDONLANG['bf_status_server_record']    = 'رکورد سرور';
$_ADDONLANG['bf_status_configured']       = 'پیکربندی شده';
$_ADDONLANG['bf_status_not_created']      = 'ایجاد نشده';
$_ADDONLANG['bf_status_packages']         = 'بسته‌ها';
$_ADDONLANG['bf_status_not_synced']       = 'همگام‌سازی نشده';
$_ADDONLANG['bf_status_synced']           = 'همگام‌سازی شده';
$_ADDONLANG['bf_status_products']         = 'محصولات';
$_ADDONLANG['bf_status_ready']            = 'آماده';
$_ADDONLANG['bf_status_linked']           = 'پیوند شده';

// One-Click Setup wizard
$_ADDONLANG['bf_wizard_title']       = '🚀 راه‌اندازی با یک کلیک';
$_ADDONLANG['bf_wizard_intro']       = 'اطلاعات ورود API شما در تنظیمات افزونه ذخیره شده است. برای پیکربندی خودکار همه چیز روی دکمه زیر کلیک کنید — نیازی به مراحل فنی نیست.';
$_ADDONLANG['bf_wizard_step_server'] = 'با استفاده از اطلاعات ورود API شما یک رکورد سرور WHMCS ایجاد می‌کند';
$_ADDONLANG['bf_wizard_step_pull']   = 'همه بسته‌های Godmode شما را دریافت می‌کند';
$_ADDONLANG['bf_wizard_step_create'] = 'برای هر بسته یک محصول WHMCS ایجاد می‌کند';
$_ADDONLANG['bf_wizard_step_link']   = 'همه محصولات را به‌طور کامل پیکربندی‌شده به ماژول BrandForge پیوند می‌دهد';
$_ADDONLANG['bf_wizard_need_creds']  = 'لطفاً <strong>URL API گادمود</strong> و <strong>کلید API</strong> خود را قبل از اجرای راه‌اندازی در تنظیمات افزونه (دکمه پیکربندی در صفحه ماژول‌های افزودنی) ذخیره کنید.';
$_ADDONLANG['bf_wizard_unavailable'] = 'راه‌اندازی در دسترس نیست — ابتدا اطلاعات ورود را ذخیره کنید';
$_ADDONLANG['bf_wizard_run']         = '🚀 اجرای راه‌اندازی با یک کلیک';
$_ADDONLANG['bf_wizard_confirm']     = 'این کار یک رکورد سرور ایجاد می‌کند، بسته‌ها را همگام‌سازی می‌کند و به‌طور خودکار محصولات WHMCS ایجاد می‌کند. آماده‌اید؟';

// Next steps / setup complete
$_ADDONLANG['bf_next_complete']  = '✅ راه‌اندازی کامل شد.';
$_ADDONLANG['bf_next_body']      = 'قیمت‌ها را برای هر محصول در بخش <strong>محصولات/خدمات → محصولات/خدمات → [محصول] → قیمت‌گذاری</strong> اضافه کنید، سپس مشتریان شما می‌توانند سفارش دهند. هنگامی که Godmode بسته‌های جدید اضافه می‌کند، روی <strong>همگام‌سازی بسته‌ها</strong> و سپس <strong>ایجاد همه محصولات</strong> کلیک کنید.';

// Stats
$_ADDONLANG['bf_stat_total']   = 'مجموع';
$_ADDONLANG['bf_stat_linked']  = 'پیوند شده';
$_ADDONLANG['bf_stat_pending'] = 'در انتظار';

// Package table
$_ADDONLANG['bf_table_no_packages']   = 'هنوز هیچ بسته‌ای همگام‌سازی نشده است. برای دریافت از Godmode روی <strong>همگام‌سازی بسته‌ها</strong> کلیک کنید.';
$_ADDONLANG['bf_col_package_name']    = 'نام بسته';
$_ADDONLANG['bf_col_plan_id']         = 'شناسه پلن';
$_ADDONLANG['bf_col_plan_id_note']    = '(برای Godmode)';
$_ADDONLANG['bf_col_godmode_id']      = 'شناسه Godmode';
$_ADDONLANG['bf_col_product_id']      = 'شناسه محصول';
$_ADDONLANG['bf_col_product_id_note'] = '(برای Godmode)';
$_ADDONLANG['bf_col_whmcs_product']   = 'محصول WHMCS';
$_ADDONLANG['bf_col_status']          = 'وضعیت';
$_ADDONLANG['bf_col_actions']         = 'عملیات';
$_ADDONLANG['bf_status_synced_label'] = 'همگام‌سازی شده';
$_ADDONLANG['bf_status_pending_label']= 'در انتظار';
$_ADDONLANG['bf_action_sync']         = 'همگام‌سازی';
$_ADDONLANG['bf_action_sync_title']   = 'دریافت دوباره این بسته از Godmode';
$_ADDONLANG['bf_action_auto_create']  = 'ایجاد خودکار';
$_ADDONLANG['bf_action_auto_create_title'] = 'ایجاد یک محصول WHMCS جدید و پیوند آن';
$_ADDONLANG['bf_action_link']         = 'پیوند';
$_ADDONLANG['bf_action_link_placeholder'] = 'پیوند به محصول موجود…';
$_ADDONLANG['bf_action_unlink']       = 'لغو پیوند';
$_ADDONLANG['bf_action_unlink_confirm'] = 'پیوند محصول برای «%s» حذف شود؟';
$_ADDONLANG['bf_mapping_footer']      = '%d بسته در تطبیق محلی — آخرین به‌روزرسانی: %s';
$_ADDONLANG['bf_never']               = 'هرگز';

// Loading overlay
$_ADDONLANG['bf_overlay_title']  = 'در حال راه‌اندازی BrandForge…';
$_ADDONLANG['bf_overlay_sub']    = 'این کار حدود ۱۰ تا ۳۰ ثانیه طول می‌کشد. لطفاً این صفحه را نبندید.';
$_ADDONLANG['bf_overlay_step1']  = 'در حال اتصال به API گادمود';
$_ADDONLANG['bf_overlay_step2']  = 'در حال ایجاد رکورد سرور';
$_ADDONLANG['bf_overlay_step3']  = 'در حال همگام‌سازی بسته‌ها از Godmode';
$_ADDONLANG['bf_overlay_step4']  = 'در حال ایجاد محصولات WHMCS';
$_ADDONLANG['bf_overlay_note']   = 'پس از اتمام راه‌اندازی به‌طور خودکار هدایت خواهید شد.';

// Flash / status messages
$_ADDONLANG['bf_flash_invalid_token']   = 'توکن امنیتی نامعتبر است. لطفاً صفحه را تازه‌سازی کرده و دوباره تلاش کنید.';
$_ADDONLANG['bf_flash_need_creds']      = 'قبل از اجرای راه‌اندازی، URL API گادمود و کلید API باید در تنظیمات افزونه ذخیره شوند.';
$_ADDONLANG['bf_flash_setup_complete']  = 'راه‌اندازی کامل شد! %1$d بسته همگام‌سازی و %2$d محصول WHMCS ایجاد شد. قیمت‌ها را به هر محصول اضافه کنید تا آماده فروش شوید.';
$_ADDONLANG['bf_flash_errors']          = ' خطاها: %s';
$_ADDONLANG['bf_flash_created_n']       = '%d محصول ایجاد شد.';
$_ADDONLANG['bf_flash_reset_complete']  = 'بازنشانی کامل شد. جداول تطبیق پاک شدند و رکورد سرور حذف شد. محصولات WHMCS شما حفظ شدند — راه‌اندازی با یک کلیک را دوباره اجرا کنید تا آن‌ها دوباره پیوند داده شوند (نسخه تکراری ایجاد نخواهد شد).';
$_ADDONLANG['bf_flash_synced_n']        = '%d بسته از Godmode همگام‌سازی شد.';
$_ADDONLANG['bf_flash_package_synced']  = 'بسته با موفقیت همگام‌سازی شد.';
$_ADDONLANG['bf_flash_mapping_rebuilt'] = 'تطبیق بازسازی شد — %d بسته همگام‌سازی شد';
$_ADDONLANG['bf_flash_reconnected']     = '، %d محصول موجود دوباره پیوند داده شد';
$_ADDONLANG['bf_flash_product_linked']  = 'محصول WHMCS شماره %1$d «%2$s» ایجاد و پیوند داده شد.';
$_ADDONLANG['bf_flash_linked_to']       = 'بسته به محصول WHMCS شماره %d پیوند داده شد.';
$_ADDONLANG['bf_flash_link_removed']    = 'پیوند محصول حذف شد.';
$_ADDONLANG['bf_flash_unknown_action']  = 'عملیات ناشناخته.';
$_ADDONLANG['bf_flash_no_package_id']   = 'شناسه بسته ارائه نشد.';
$_ADDONLANG['bf_flash_not_in_table']    = 'بسته در جدول محلی موجود نیست. ابتدا همگام‌سازی همه را اجرا کنید.';
$_ADDONLANG['bf_flash_already_linked']  = 'این بسته قبلاً به یک محصول WHMCS پیوند داده شده است.';
$_ADDONLANG['bf_flash_select_product']  = 'لطفاً یک محصول WHMCS برای پیوند انتخاب کنید.';
$_ADDONLANG['bf_flash_error_prefix']    = 'خطا: %s';

// Addon settings (Configure page) field labels
$_ADDONLANG['bf_cfg_name']            = 'BrandForge Package Sync';
$_ADDONLANG['bf_cfg_description']     = 'بسته‌های Godmode را با محصولات WHMCS همگام‌سازی می‌کند و جدول تطبیق تدارکات را نگه می‌دارد.';
$_ADDONLANG['bf_cfg_api_url']         = 'URL API گادمود';
$_ADDONLANG['bf_cfg_api_url_desc']    = 'URL پایه برای API گادمود (بدون اسلش پایانی)';
$_ADDONLANG['bf_cfg_api_key']         = 'کلید API گادمود';
$_ADDONLANG['bf_cfg_api_key_desc']    = 'توکن حامل استفاده‌شده برای همه درخواست‌های API گادمود';
$_ADDONLANG['bf_cfg_debug_mode']      = 'حالت اشکال‌زدایی';
$_ADDONLANG['bf_cfg_debug_mode_desc'] = 'نوشتن گزارش‌های دقیق API در گزارش ماژول WHMCS';

// Activate / Deactivate lifecycle messages
$_ADDONLANG['bf_activated']        = 'BrandForge Package Sync فعال شد. جداول تطبیق بسته و سرویس ایجاد شدند.';
$_ADDONLANG['bf_activate_failed']  = 'فعال‌سازی ناموفق بود: %s';
$_ADDONLANG['bf_deactivated']      = 'BrandForge Package Sync غیرفعال شد. داده‌های تطبیق حفظ شدند.';
