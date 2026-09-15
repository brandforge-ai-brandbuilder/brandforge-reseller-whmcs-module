<?php
/**
 * BrandForge Provisioning Module — Client-Facing Strings (Hebrew)
 *
 * AI-drafted first pass — needs a native Hebrew speaker's review before
 * being treated as production-ready, including whether the ← / → arrow
 * glyphs below should be mirrored for RTL reading direction (this file
 * keeps the same arrow characters as the English source rather than
 * guessing at RTL convention). See lang/english.php for the full key
 * reference and how this file is loaded. Note: this only translates
 * strings — it does not add `dir="rtl"` to the Smarty templates, which
 * would be a separate layout change.
 */

if (!defined('WHMCS')) {
    die('Access denied.');
}

return [
    'status_active'      => 'פעיל',
    'status_suspended'   => 'מושהה',
    'status_pending'     => 'ממתין',
    'status_unknown'     => 'לא ידוע',

    'label_package'         => 'חבילה',
    'label_status'          => 'סטטוס',
    'label_subscription_id' => 'מזהה מנוי',
    'label_workspace_id'    => 'מזהה סביבת עבודה',
    'label_provisioned'     => 'סופק',

    'label_ai_credits' => 'קרדיטים של AI',
    'used_of'          => '%1$d / %2$d נוצלו',
    'remaining'        => 'נותרו',
    'resets'           => 'מתאפס ב-%s',

    'label_workspaces' => 'סביבות עבודה',
    'active_of_max'    => '%1$d / %2$d נוצלו',
    'active_count'     => '%d פעילות',
    'untitled'         => 'ללא שם',
    'active'           => 'פעיל',
    'inactive'         => 'לא פעיל',
    'workspace_note'   => 'פרטי סביבת העבודה ופרויקטי המותג מנוהלים בתוך %s.',
    'open_app'         => 'פתח את האפליקציה →',

    'launch_unavailable' => 'קישור ההפעלה אינו זמין:',
    'launch'             => 'הפעל את %s',
    'upgrade_plan'       => 'שדרג תוכנית',
    'view_workspace'     => 'הצג סביבת עבודה',
    'powered_by'         => 'מופעל על ידי %s',
    'service_dashboard'  => 'לוח בקרה של השירות',
    'not_provisioned'    => 'השירות עדיין לא סופק.',
    'being_set_up'       => 'המנוי שלך ל-%s נמצא בהגדרה. זה בדרך כלל אורך פחות מדקה. אם הודעה זו ממשיכה להופיע, אנא פנה לתמיכה.',

    'launching'             => 'מפעיל את %s…',
    'sso_signing_in'        => 'אתה מחובר באופן מאובטח לסביבת העבודה שלך.',
    'sso_if_not_redirected' => 'אם לא הופנית אוטומטית:',
    'open_brand'            => 'פתח את %s →',
    'launch_failed'         => 'ההפעלה נכשלה',
    'launch_failed_body'    => 'לא הצלחנו ליצור קישור כניסה מאובטח לחשבון שלך. אנא נסה שוב או פנה לתמיכה.',
    'go_back'               => '← חזרה',
];
