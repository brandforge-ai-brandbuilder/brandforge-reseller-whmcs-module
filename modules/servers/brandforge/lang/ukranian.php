<?php
/**
 * BrandForge Provisioning Module — Client-Facing Strings (Ukrainian)
 *
 * Filename intentionally matches WHMCS's own (non-standard) spelling,
 * "ukranian.php" — confirmed against the actual /lang/ directory listing
 * on a live WHMCS install, not a typo introduced here.
 *
 * AI-drafted first pass — needs a native Ukrainian speaker's review before
 * being treated as production-ready. See lang/english.php for the full
 * key reference, placeholder rules, and how this file is loaded.
 */

if (!defined('WHMCS')) {
    die('Access denied.');
}

return [
    'status_active'      => 'Активний',
    'status_suspended'   => 'Призупинено',
    'status_pending'     => 'Очікується',
    'status_unknown'     => 'Невідомо',

    'label_package'         => 'Пакет',
    'label_status'          => 'Статус',
    'label_subscription_id' => 'ID підписки',
    'label_workspace_id'    => 'ID робочого простору',
    'label_provisioned'     => 'Активовано',

    'label_ai_credits' => 'AI-кредити',
    'used_of'          => '%1$d / %2$d використано',
    'remaining'        => 'залишилось',
    'resets'           => 'Оновлення %s',

    'label_workspaces' => 'Робочі простори',
    'active_of_max'    => '%1$d / %2$d використано',
    'active_count'     => '%d активних',
    'untitled'         => 'Без назви',
    'active'           => 'активний',
    'inactive'         => 'неактивний',
    'workspace_note'   => 'Деталі робочого простору та брендові проєкти керуються в %s.',
    'open_app'         => 'Відкрити застосунок →',

    'launch_unavailable' => 'Посилання для запуску недоступне:',
    'launch'             => 'Запустити %s',
    'upgrade_plan'       => 'Покращити план',
    'view_workspace'     => 'Переглянути робочий простір',
    'powered_by'         => 'Працює на %s',
    'service_dashboard'  => 'Панель керування послугою',
    'not_provisioned'    => 'Послугу ще не активовано.',
    'being_set_up'       => 'Вашу підписку %s налаштовується. Зазвичай це триває менше хвилини. Якщо це повідомлення не зникає, зверніться до підтримки.',

    'launching'             => 'Запуск %s…',
    'sso_signing_in'        => 'Виконується безпечний вхід у ваш робочий простір.',
    'sso_if_not_redirected' => 'Якщо вас не перенаправлено автоматично:',
    'open_brand'            => 'Відкрити %s →',
    'launch_failed'         => 'Не вдалося запустити',
    'launch_failed_body'    => 'Не вдалося створити безпечне посилання для входу у ваш обліковий запис. Спробуйте ще раз або зверніться до підтримки.',
    'go_back'               => '← Назад',
];
