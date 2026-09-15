<?php
/**
 * BrandForge Package Sync — Addon Admin Language File (Hebrew)
 *
 * AI-drafted first pass — needs a native Hebrew speaker's review before
 * being treated as production-ready, including RTL arrow-direction
 * convention (kept identical to the English source here). See
 * lang/english.php for the full key reference and how WHMCS loads this
 * file.
 */

if (!defined('WHMCS')) {
    die('Access denied.');
}

$_ADDONLANG['bf_page_title']           = 'BrandForge — סנכרון חבילות';
$_ADDONLANG['bf_sync_packages']        = 'סנכרן חבילות';
$_ADDONLANG['bf_syncing']              = 'מסנכרן…';
$_ADDONLANG['bf_create_all_products']  = 'צור את כל המוצרים';
$_ADDONLANG['bf_creating']             = 'יוצר…';
$_ADDONLANG['bf_reset_everything']     = 'אפס הכול';
$_ADDONLANG['bf_reset_confirm']        = "פעולה זו תמחק את כל נתוני ההתאמה בין חבילות לשירותים ותסיר את רשומת השרת.\n\nמוצרי ה-WHMCS שלך יישמרו — הפעלה מחדש של ההגדרה תקשר אותם מחדש ללא יצירת כפילויות.\n\nלהמשיך?";

// Status bar
$_ADDONLANG['bf_status_api_credentials']  = 'פרטי גישה ל-API';
$_ADDONLANG['bf_status_saved']            = 'נשמרו';
$_ADDONLANG['bf_status_not_set']          = 'לא הוגדרו — שמור תחילה את ההגדרות';
$_ADDONLANG['bf_status_server_record']    = 'רשומת שרת';
$_ADDONLANG['bf_status_configured']       = 'מוגדר';
$_ADDONLANG['bf_status_not_created']      = 'לא נוצר';
$_ADDONLANG['bf_status_packages']         = 'חבילות';
$_ADDONLANG['bf_status_not_synced']       = 'לא סונכרנו';
$_ADDONLANG['bf_status_synced']           = 'סונכרנו';
$_ADDONLANG['bf_status_products']         = 'מוצרים';
$_ADDONLANG['bf_status_ready']            = 'מוכנים';
$_ADDONLANG['bf_status_linked']           = 'מקושרים';

// One-Click Setup wizard
$_ADDONLANG['bf_wizard_title']       = '🚀 הגדרה בלחיצה אחת';
$_ADDONLANG['bf_wizard_intro']       = 'פרטי הגישה שלך ל-API שמורים בהגדרות התוסף. לחץ על הכפתור למטה כדי להגדיר הכול אוטומטית — לא נדרשים שלבים טכניים.';
$_ADDONLANG['bf_wizard_step_server'] = 'יוצר רשומת שרת WHMCS באמצעות פרטי הגישה שלך ל-API';
$_ADDONLANG['bf_wizard_step_pull']   = 'מושך את כל חבילות ה-Godmode שלך';
$_ADDONLANG['bf_wizard_step_create'] = 'יוצר מוצר WHMCS עבור כל חבילה';
$_ADDONLANG['bf_wizard_step_link']   = 'מקשר את כל המוצרים למודול BrandForge, מוגדרים במלואם';
$_ADDONLANG['bf_wizard_need_creds']  = 'שמור את <strong>כתובת ה-URL של API Godmode</strong> ואת <strong>מפתח ה-API</strong> בהגדרות התוסף (כפתור הגדר בדף המודולים הנוספים) לפני הפעלת ההגדרה.';
$_ADDONLANG['bf_wizard_unavailable'] = 'ההגדרה אינה זמינה — שמור תחילה את פרטי הגישה';
$_ADDONLANG['bf_wizard_run']         = '🚀 הפעל הגדרה בלחיצה אחת';
$_ADDONLANG['bf_wizard_confirm']     = 'פעולה זו תיצור רשומת שרת, תסנכרן חבילות, ותיצור אוטומטית מוצרי WHMCS. להמשיך?';

// Next steps / setup complete
$_ADDONLANG['bf_next_complete']  = '✅ ההגדרה הושלמה.';
$_ADDONLANG['bf_next_body']      = 'הוסף תמחור לכל מוצר תחת <strong>מוצרים/שירותים → מוצרים/שירותים → [מוצר] → תמחור</strong>, ואז הלקוחות שלך יוכלו להזמין. כאשר Godmode מוסיף חבילות חדשות, לחץ על <strong>סנכרן חבילות</strong> ולאחר מכן על <strong>צור את כל המוצרים</strong>.';

// Stats
$_ADDONLANG['bf_stat_total']   = 'סה"כ';
$_ADDONLANG['bf_stat_linked']  = 'מקושרים';
$_ADDONLANG['bf_stat_pending'] = 'ממתינים';

// Package table
$_ADDONLANG['bf_table_no_packages']   = 'טרם סונכרנו חבילות. לחץ על <strong>סנכרן חבילות</strong> כדי למשוך אותן מ-Godmode.';
$_ADDONLANG['bf_col_package_name']    = 'שם החבילה';
$_ADDONLANG['bf_col_plan_id']         = 'מזהה תוכנית';
$_ADDONLANG['bf_col_plan_id_note']    = '(עבור Godmode)';
$_ADDONLANG['bf_col_godmode_id']      = 'מזהה Godmode';
$_ADDONLANG['bf_col_product_id']      = 'מזהה מוצר';
$_ADDONLANG['bf_col_product_id_note'] = '(עבור Godmode)';
$_ADDONLANG['bf_col_whmcs_product']   = 'מוצר WHMCS';
$_ADDONLANG['bf_col_status']          = 'סטטוס';
$_ADDONLANG['bf_col_actions']         = 'פעולות';
$_ADDONLANG['bf_status_synced_label'] = 'סונכרן';
$_ADDONLANG['bf_status_pending_label']= 'ממתין';
$_ADDONLANG['bf_action_sync']         = 'סנכרן';
$_ADDONLANG['bf_action_sync_title']   = 'משוך מחדש חבילה זו מ-Godmode';
$_ADDONLANG['bf_action_auto_create']  = 'צור אוטומטית';
$_ADDONLANG['bf_action_auto_create_title'] = 'צור מוצר WHMCS חדש וקשר אותו';
$_ADDONLANG['bf_action_link']         = 'קשר';
$_ADDONLANG['bf_action_link_placeholder'] = 'קשר למוצר קיים…';
$_ADDONLANG['bf_action_unlink']       = 'בטל קישור';
$_ADDONLANG['bf_action_unlink_confirm'] = 'להסיר את קישור המוצר עבור "%s"?';
$_ADDONLANG['bf_mapping_footer']      = '%d חבילות בהתאמה המקומית — עדכון אחרון: %s';
$_ADDONLANG['bf_never']               = 'אף פעם';

// Loading overlay
$_ADDONLANG['bf_overlay_title']  = 'מגדיר את BrandForge…';
$_ADDONLANG['bf_overlay_sub']    = 'הפעולה אורכת כ-10–30 שניות. אנא אל תסגור דף זה.';
$_ADDONLANG['bf_overlay_step1']  = 'מתחבר ל-API של Godmode';
$_ADDONLANG['bf_overlay_step2']  = 'יוצר רשומת שרת';
$_ADDONLANG['bf_overlay_step3']  = 'מסנכרן חבילות מ-Godmode';
$_ADDONLANG['bf_overlay_step4']  = 'יוצר מוצרי WHMCS';
$_ADDONLANG['bf_overlay_note']   = 'תועבר אוטומטית עם השלמת ההגדרה.';

// Flash / status messages
$_ADDONLANG['bf_flash_invalid_token']   = 'אסימון אבטחה לא תקין. רענן את הדף ונסה שוב.';
$_ADDONLANG['bf_flash_need_creds']      = 'יש לשמור את כתובת ה-URL של API Godmode ואת מפתח ה-API בהגדרות התוסף לפני הפעלת ההגדרה.';
$_ADDONLANG['bf_flash_setup_complete']  = 'ההגדרה הושלמה! %1$d חבילות סונכרנו ו-%2$d מוצרי WHMCS נוצרו. הוסף תמחור לכל מוצר, ותהיה מוכן למכור.';
$_ADDONLANG['bf_flash_errors']          = ' שגיאות: %s';
$_ADDONLANG['bf_flash_created_n']       = 'נוצרו %d מוצרים.';
$_ADDONLANG['bf_flash_reset_complete']  = 'האיפוס הושלם. טבלאות ההתאמה נוקו ורשומת השרת הוסרה. מוצרי ה-WHMCS שלך נשמרו — הפעל הגדרה בלחיצה אחת כדי לקשר אותם מחדש (לא ייווצרו כפילויות).';
$_ADDONLANG['bf_flash_synced_n']        = '%d חבילות סונכרנו מ-Godmode.';
$_ADDONLANG['bf_flash_package_synced']  = 'החבילה סונכרנה בהצלחה.';
$_ADDONLANG['bf_flash_mapping_rebuilt'] = 'ההתאמה נבנתה מחדש — %d חבילות סונכרנו';
$_ADDONLANG['bf_flash_reconnected']     = ', %d מוצרים קיימים קושרו מחדש';
$_ADDONLANG['bf_flash_product_linked']  = 'מוצר WHMCS מס\' %1$d "%2$s" נוצר וקושר.';
$_ADDONLANG['bf_flash_linked_to']       = 'החבילה קושרה למוצר WHMCS מס\' %d.';
$_ADDONLANG['bf_flash_link_removed']    = 'קישור המוצר הוסר.';
$_ADDONLANG['bf_flash_unknown_action']  = 'פעולה לא ידועה.';
$_ADDONLANG['bf_flash_no_package_id']   = 'לא סופק מזהה חבילה.';
$_ADDONLANG['bf_flash_not_in_table']    = 'החבילה אינה נמצאת בטבלה המקומית. הפעל תחילה סנכרן הכול.';
$_ADDONLANG['bf_flash_already_linked']  = 'לחבילה זו כבר יש מוצר WHMCS מקושר.';
$_ADDONLANG['bf_flash_select_product']  = 'בחר מוצר WHMCS לקישור.';
$_ADDONLANG['bf_flash_error_prefix']    = 'שגיאה: %s';

// Addon settings (Configure page) field labels
$_ADDONLANG['bf_cfg_name']            = 'BrandForge Package Sync';
$_ADDONLANG['bf_cfg_description']     = 'מסנכרן חבילות Godmode עם מוצרי WHMCS ושומר על טבלת ההתאמה לצורך אספקת שירותים.';
$_ADDONLANG['bf_cfg_api_url']         = 'כתובת URL של API Godmode';
$_ADDONLANG['bf_cfg_api_url_desc']    = 'כתובת URL בסיסית עבור API Godmode (ללא לוכסן בסוף)';
$_ADDONLANG['bf_cfg_api_key']         = 'מפתח API Godmode';
$_ADDONLANG['bf_cfg_api_key_desc']    = 'אסימון נשא המשמש עבור כל בקשות API Godmode';
$_ADDONLANG['bf_cfg_debug_mode']      = 'מצב איתור באגים';
$_ADDONLANG['bf_cfg_debug_mode_desc'] = 'כתוב יומני API מפורטים ליומן המודולים של WHMCS';

// Activate / Deactivate lifecycle messages
$_ADDONLANG['bf_activated']        = 'BrandForge Package Sync הופעל. טבלאות ההתאמה של חבילות ושירותים נוצרו.';
$_ADDONLANG['bf_activate_failed']  = 'ההפעלה נכשלה: %s';
$_ADDONLANG['bf_deactivated']      = 'BrandForge Package Sync הושבת. נתוני ההתאמה נשמרו.';
