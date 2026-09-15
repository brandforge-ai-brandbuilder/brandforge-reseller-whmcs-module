<?php
/**
 * BrandForge Package Sync — Addon Admin Language File (Arabic)
 *
 * AI-drafted first pass — needs a native Arabic speaker's review before
 * being treated as production-ready, including RTL arrow-direction
 * convention (kept identical to the English source here). See
 * lang/english.php for the full key reference and how WHMCS loads this
 * file.
 */

if (!defined('WHMCS')) {
    die('Access denied.');
}

$_ADDONLANG['bf_page_title']           = 'BrandForge — مزامنة الباقات';
$_ADDONLANG['bf_sync_packages']        = 'مزامنة الباقات';
$_ADDONLANG['bf_syncing']              = 'جارٍ المزامنة…';
$_ADDONLANG['bf_create_all_products']  = 'إنشاء جميع المنتجات';
$_ADDONLANG['bf_creating']             = 'جارٍ الإنشاء…';
$_ADDONLANG['bf_reset_everything']     = 'إعادة تعيين كل شيء';
$_ADDONLANG['bf_reset_confirm']        = "سيؤدي هذا إلى مسح جميع بيانات ربط الباقات/الخدمات وإزالة سجل الخادم.\n\nستبقى منتجات WHMCS الخاصة بك — إعادة تشغيل الإعداد ستُعيد ربطها دون إنشاء نسخ مكررة.\n\nهل تريد المتابعة؟";

// Status bar
$_ADDONLANG['bf_status_api_credentials']  = 'بيانات اعتماد API';
$_ADDONLANG['bf_status_saved']            = 'محفوظة';
$_ADDONLANG['bf_status_not_set']          = 'غير محددة — احفظ الإعدادات أولاً';
$_ADDONLANG['bf_status_server_record']    = 'سجل الخادم';
$_ADDONLANG['bf_status_configured']       = 'تم التكوين';
$_ADDONLANG['bf_status_not_created']      = 'لم يُنشأ';
$_ADDONLANG['bf_status_packages']         = 'الباقات';
$_ADDONLANG['bf_status_not_synced']       = 'غير متزامنة';
$_ADDONLANG['bf_status_synced']           = 'متزامنة';
$_ADDONLANG['bf_status_products']         = 'المنتجات';
$_ADDONLANG['bf_status_ready']            = 'جاهزة';
$_ADDONLANG['bf_status_linked']           = 'مرتبطة';

// One-Click Setup wizard
$_ADDONLANG['bf_wizard_title']       = '🚀 الإعداد بنقرة واحدة';
$_ADDONLANG['bf_wizard_intro']       = 'بيانات اعتماد API الخاصة بك محفوظة في إعدادات الإضافة. انقر الزر أدناه لإعداد كل شيء تلقائيًا — دون أي خطوات تقنية.';
$_ADDONLANG['bf_wizard_step_server'] = 'ينشئ سجل خادم WHMCS باستخدام بيانات اعتماد API الخاصة بك';
$_ADDONLANG['bf_wizard_step_pull']   = 'يجلب جميع باقات Godmode الخاصة بك';
$_ADDONLANG['bf_wizard_step_create'] = 'ينشئ منتج WHMCS لكل باقة';
$_ADDONLANG['bf_wizard_step_link']   = 'يربط جميع المنتجات بوحدة BrandForge، مُهيّأة بالكامل';
$_ADDONLANG['bf_wizard_need_creds']  = 'يرجى حفظ <strong>رابط API الخاص بـ Godmode</strong> و<strong>مفتاح API</strong> في إعدادات الإضافة (زر التهيئة في صفحة الوحدات الإضافية) قبل تشغيل الإعداد.';
$_ADDONLANG['bf_wizard_unavailable'] = 'الإعداد غير متاح — احفظ بيانات الاعتماد أولاً';
$_ADDONLANG['bf_wizard_run']         = '🚀 تشغيل الإعداد بنقرة واحدة';
$_ADDONLANG['bf_wizard_confirm']     = 'سيؤدي هذا إلى إنشاء سجل خادم، ومزامنة الباقات، وإنشاء منتجات WHMCS تلقائيًا. هل أنت مستعد؟';

// Next steps / setup complete
$_ADDONLANG['bf_next_complete']  = '✅ اكتمل الإعداد.';
$_ADDONLANG['bf_next_body']      = 'أضف الأسعار لكل منتج ضمن <strong>المنتجات/الخدمات → المنتجات/الخدمات → [المنتج] → الأسعار</strong>، وبعدها يمكن لعملائك الطلب. عندما يضيف Godmode باقات جديدة، انقر على <strong>مزامنة الباقات</strong> ثم <strong>إنشاء جميع المنتجات</strong>.';

// Stats
$_ADDONLANG['bf_stat_total']   = 'الإجمالي';
$_ADDONLANG['bf_stat_linked']  = 'مرتبطة';
$_ADDONLANG['bf_stat_pending'] = 'معلّقة';

// Package table
$_ADDONLANG['bf_table_no_packages']   = 'لم تتم مزامنة أي باقات بعد. انقر على <strong>مزامنة الباقات</strong> للجلب من Godmode.';
$_ADDONLANG['bf_col_package_name']    = 'اسم الباقة';
$_ADDONLANG['bf_col_plan_id']         = 'معرّف الخطة';
$_ADDONLANG['bf_col_plan_id_note']    = '(لـ Godmode)';
$_ADDONLANG['bf_col_godmode_id']      = 'معرّف Godmode';
$_ADDONLANG['bf_col_product_id']      = 'معرّف المنتج';
$_ADDONLANG['bf_col_product_id_note'] = '(لـ Godmode)';
$_ADDONLANG['bf_col_whmcs_product']   = 'منتج WHMCS';
$_ADDONLANG['bf_col_status']          = 'الحالة';
$_ADDONLANG['bf_col_actions']         = 'الإجراءات';
$_ADDONLANG['bf_status_synced_label'] = 'متزامن';
$_ADDONLANG['bf_status_pending_label']= 'معلّق';
$_ADDONLANG['bf_action_sync']         = 'مزامنة';
$_ADDONLANG['bf_action_sync_title']   = 'إعادة جلب هذه الباقة من Godmode';
$_ADDONLANG['bf_action_auto_create']  = 'إنشاء تلقائي';
$_ADDONLANG['bf_action_auto_create_title'] = 'إنشاء منتج WHMCS جديد وربطه';
$_ADDONLANG['bf_action_link']         = 'ربط';
$_ADDONLANG['bf_action_link_placeholder'] = 'ربط منتج موجود…';
$_ADDONLANG['bf_action_unlink']       = 'إلغاء الربط';
$_ADDONLANG['bf_action_unlink_confirm'] = 'هل تريد إزالة ربط المنتج لـ "%s"؟';
$_ADDONLANG['bf_mapping_footer']      = '%d باقة في الربط المحلي — آخر تحديث: %s';
$_ADDONLANG['bf_never']               = 'أبدًا';

// Loading overlay
$_ADDONLANG['bf_overlay_title']  = 'جارٍ إعداد BrandForge…';
$_ADDONLANG['bf_overlay_sub']    = 'يستغرق هذا حوالي 10–30 ثانية. يرجى عدم إغلاق هذه الصفحة.';
$_ADDONLANG['bf_overlay_step1']  = 'جارٍ الاتصال بـ API الخاص بـ Godmode';
$_ADDONLANG['bf_overlay_step2']  = 'جارٍ إنشاء سجل الخادم';
$_ADDONLANG['bf_overlay_step3']  = 'جارٍ مزامنة الباقات من Godmode';
$_ADDONLANG['bf_overlay_step4']  = 'جارٍ إنشاء منتجات WHMCS';
$_ADDONLANG['bf_overlay_note']   = 'سيتم إعادة توجيهك تلقائيًا عند اكتمال الإعداد.';

// Flash / status messages
$_ADDONLANG['bf_flash_invalid_token']   = 'رمز أمان غير صالح. يرجى تحديث الصفحة والمحاولة مرة أخرى.';
$_ADDONLANG['bf_flash_need_creds']      = 'يجب حفظ رابط API الخاص بـ Godmode ومفتاح API في إعدادات الإضافة قبل تشغيل الإعداد.';
$_ADDONLANG['bf_flash_setup_complete']  = 'اكتمل الإعداد! تمت مزامنة %1$d باقة وإنشاء %2$d منتج WHMCS. أضف الأسعار لكل منتج، وستكون جاهزًا للبيع.';
$_ADDONLANG['bf_flash_errors']          = ' أخطاء: %s';
$_ADDONLANG['bf_flash_created_n']       = 'تم إنشاء %d منتج.';
$_ADDONLANG['bf_flash_reset_complete']  = 'اكتملت إعادة التعيين. تم مسح جداول الربط وإزالة سجل الخادم. تم الاحتفاظ بمنتجات WHMCS الخاصة بك — شغّل الإعداد بنقرة واحدة لإعادة ربطها (لن يتم إنشاء نسخ مكررة).';
$_ADDONLANG['bf_flash_synced_n']        = 'تمت مزامنة %d باقة من Godmode.';
$_ADDONLANG['bf_flash_package_synced']  = 'تمت مزامنة الباقة بنجاح.';
$_ADDONLANG['bf_flash_mapping_rebuilt'] = 'أُعيد بناء الربط — تمت مزامنة %d باقة';
$_ADDONLANG['bf_flash_reconnected']     = '، وأُعيد ربط %d منتج موجود';
$_ADDONLANG['bf_flash_product_linked']  = 'تم إنشاء منتج WHMCS رقم %1$d "%2$s" وربطه.';
$_ADDONLANG['bf_flash_linked_to']       = 'تم ربط الباقة بمنتج WHMCS رقم %d.';
$_ADDONLANG['bf_flash_link_removed']    = 'تمت إزالة ربط المنتج.';
$_ADDONLANG['bf_flash_unknown_action']  = 'إجراء غير معروف.';
$_ADDONLANG['bf_flash_no_package_id']   = 'لم يتم توفير معرّف الباقة.';
$_ADDONLANG['bf_flash_not_in_table']    = 'الباقة غير موجودة في الجدول المحلي. شغّل مزامنة الكل أولاً.';
$_ADDONLANG['bf_flash_already_linked']  = 'هذه الباقة مرتبطة بالفعل بمنتج WHMCS.';
$_ADDONLANG['bf_flash_select_product']  = 'يرجى اختيار منتج WHMCS للربط.';
$_ADDONLANG['bf_flash_error_prefix']    = 'خطأ: %s';

// Addon settings (Configure page) field labels
$_ADDONLANG['bf_cfg_name']            = 'BrandForge Package Sync';
$_ADDONLANG['bf_cfg_description']     = 'يزامن باقات Godmode مع منتجات WHMCS ويحافظ على جدول ربط التزويد.';
$_ADDONLANG['bf_cfg_api_url']         = 'رابط API الخاص بـ Godmode';
$_ADDONLANG['bf_cfg_api_url_desc']    = 'الرابط الأساسي لـ API الخاص بـ Godmode (بدون شرطة مائلة في النهاية)';
$_ADDONLANG['bf_cfg_api_key']         = 'مفتاح API الخاص بـ Godmode';
$_ADDONLANG['bf_cfg_api_key_desc']    = 'رمز الحامل المستخدم في جميع طلبات API الخاصة بـ Godmode';
$_ADDONLANG['bf_cfg_debug_mode']      = 'وضع التصحيح';
$_ADDONLANG['bf_cfg_debug_mode_desc'] = 'كتابة سجلات API مفصّلة في سجل وحدات WHMCS';

// Activate / Deactivate lifecycle messages
$_ADDONLANG['bf_activated']        = 'تم تفعيل BrandForge Package Sync. تم إنشاء جداول ربط الباقات والخدمات.';
$_ADDONLANG['bf_activate_failed']  = 'فشل التفعيل: %s';
$_ADDONLANG['bf_deactivated']      = 'تم إلغاء تفعيل BrandForge Package Sync. تم الاحتفاظ ببيانات الربط.';
