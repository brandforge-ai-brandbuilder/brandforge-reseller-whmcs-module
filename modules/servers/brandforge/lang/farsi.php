<?php
/**
 * BrandForge Provisioning Module — Client-Facing Strings (Farsi/Persian)
 *
 * AI-drafted first pass — needs a native Farsi speaker's review before
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
    'status_active'      => 'فعال',
    'status_suspended'   => 'معلق‌شده',
    'status_pending'     => 'در انتظار',
    'status_unknown'     => 'نامشخص',

    'label_package'         => 'بسته',
    'label_status'          => 'وضعیت',
    'label_subscription_id' => 'شناسه اشتراک',
    'label_workspace_id'    => 'شناسه فضای کاری',
    'label_provisioned'     => 'راه‌اندازی‌شده',

    'label_ai_credits' => 'اعتبار هوش مصنوعی',
    'used_of'          => '%1$d از %2$d استفاده شده',
    'remaining'        => 'باقی‌مانده',
    'resets'           => 'بازنشانی در %s',

    'label_workspaces' => 'فضاهای کاری',
    'active_of_max'    => '%1$d از %2$d استفاده شده',
    'active_count'     => '%d فعال',
    'untitled'         => 'بدون عنوان',
    'active'           => 'فعال',
    'inactive'         => 'غیرفعال',
    'workspace_note'   => 'جزئیات فضای کاری و پروژه‌های برند در %s مدیریت می‌شوند.',
    'open_app'         => 'باز کردن برنامه →',

    'launch_unavailable' => 'پیوند راه‌اندازی در دسترس نیست:',
    'launch'             => 'راه‌اندازی %s',
    'upgrade_plan'       => 'ارتقاء پلن',
    'view_workspace'     => 'مشاهده فضای کاری',
    'powered_by'         => 'قدرت گرفته از %s',
    'service_dashboard'  => 'داشبورد سرویس',
    'not_provisioned'    => 'سرویس هنوز راه‌اندازی نشده است.',
    'being_set_up'       => 'اشتراک %s شما در حال راه‌اندازی است. این معمولاً کمتر از یک دقیقه طول می‌کشد. اگر این پیام ادامه یافت، لطفاً با پشتیبانی تماس بگیرید.',

    'launching'             => 'در حال راه‌اندازی %s…',
    'sso_signing_in'        => 'در حال ورود امن به فضای کاری شما هستید.',
    'sso_if_not_redirected' => 'اگر به‌طور خودکار هدایت نشدید:',
    'open_brand'            => 'باز کردن %s →',
    'launch_failed'         => 'راه‌اندازی ناموفق بود',
    'launch_failed_body'    => 'نتوانستیم پیوند ورود امنی برای حساب شما ایجاد کنیم. لطفاً دوباره تلاش کنید یا با پشتیبانی تماس بگیرید.',
    'go_back'               => '← بازگشت',
];
