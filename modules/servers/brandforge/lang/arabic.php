<?php
/**
 * BrandForge Provisioning Module — Client-Facing Strings (Arabic)
 *
 * AI-drafted first pass — needs a native Arabic speaker's review before
 * being treated as production-ready, including whether the → / ← arrow
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
    'status_active'      => 'نشط',
    'status_suspended'   => 'معلّق',
    'status_pending'     => 'قيد الانتظار',
    'status_unknown'     => 'غير معروف',

    'label_package'         => 'الباقة',
    'label_status'          => 'الحالة',
    'label_subscription_id' => 'معرّف الاشتراك',
    'label_workspace_id'    => 'معرّف مساحة العمل',
    'label_provisioned'     => 'تم التزويد',

    'label_ai_credits' => 'أرصدة الذكاء الاصطناعي',
    'used_of'          => 'تم استخدام %1$d من %2$d',
    'remaining'        => 'متبقٍ',
    'resets'           => 'يُجدَّد في %s',

    'label_workspaces' => 'مساحات العمل',
    'active_of_max'    => 'تم استخدام %1$d من %2$d',
    'active_count'     => '%d نشطة',
    'untitled'         => 'بلا عنوان',
    'active'           => 'نشط',
    'inactive'         => 'غير نشط',
    'workspace_note'   => 'تُدار تفاصيل مساحة العمل ومشاريع العلامة التجارية داخل %s.',
    'open_app'         => 'فتح التطبيق →',

    'launch_unavailable' => 'رابط التشغيل غير متاح:',
    'launch'             => 'تشغيل %s',
    'upgrade_plan'       => 'ترقية الباقة',
    'view_workspace'     => 'عرض مساحة العمل',
    'powered_by'         => 'بدعم من %s',
    'service_dashboard'  => 'لوحة تحكم الخدمة',
    'not_provisioned'    => 'لم يتم تزويد الخدمة بعد.',
    'being_set_up'       => 'جارٍ إعداد اشتراكك في %s. يستغرق هذا عادةً أقل من دقيقة. إذا استمرت هذه الرسالة، يرجى التواصل مع الدعم.',

    'launching'             => 'جارٍ تشغيل %s…',
    'sso_signing_in'        => 'يتم تسجيل دخولك بأمان إلى مساحة العمل الخاصة بك.',
    'sso_if_not_redirected' => 'إذا لم تتم إعادة توجيهك تلقائيًا:',
    'open_brand'            => 'فتح %s →',
    'launch_failed'         => 'فشل التشغيل',
    'launch_failed_body'    => 'تعذّر إنشاء رابط تسجيل دخول آمن لحسابك. يرجى المحاولة مرة أخرى أو التواصل مع الدعم.',
    'go_back'               => '← رجوع',
];
