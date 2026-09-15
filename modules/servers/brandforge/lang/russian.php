<?php
/**
 * BrandForge Provisioning Module — Client-Facing Strings (Russian)
 *
 * AI-drafted first pass — needs a native Russian speaker's review before
 * being treated as production-ready. See lang/english.php for the full
 * key reference, placeholder rules, and how this file is loaded.
 */

if (!defined('WHMCS')) {
    die('Access denied.');
}

return [
    'status_active'      => 'Активен',
    'status_suspended'   => 'Приостановлен',
    'status_pending'     => 'Ожидание',
    'status_unknown'     => 'Неизвестно',

    'label_package'         => 'Пакет',
    'label_status'          => 'Статус',
    'label_subscription_id' => 'ID подписки',
    'label_workspace_id'    => 'ID рабочего пространства',
    'label_provisioned'     => 'Активирован',

    'label_ai_credits' => 'AI-кредиты',
    'used_of'          => '%1$d / %2$d использовано',
    'remaining'        => 'осталось',
    'resets'           => 'Обновление %s',

    'label_workspaces' => 'Рабочие пространства',
    'active_of_max'    => '%1$d / %2$d использовано',
    'active_count'     => '%d активно',
    'untitled'         => 'Без названия',
    'active'           => 'активно',
    'inactive'         => 'неактивно',
    'workspace_note'   => 'Сведения о рабочем пространстве и брендовые проекты управляются в %s.',
    'open_app'         => 'Открыть приложение →',

    'launch_unavailable' => 'Ссылка для запуска недоступна:',
    'launch'             => 'Запустить %s',
    'upgrade_plan'       => 'Улучшить тариф',
    'view_workspace'     => 'Открыть рабочее пространство',
    'powered_by'         => 'Работает на %s',
    'service_dashboard'  => 'Панель управления услугой',
    'not_provisioned'    => 'Услуга ещё не активирована.',
    'being_set_up'       => 'Ваша подписка %s настраивается. Обычно это занимает менее минуты. Если сообщение не исчезает, обратитесь в поддержку.',

    'launching'             => 'Запуск %s…',
    'sso_signing_in'        => 'Выполняется безопасный вход в ваше рабочее пространство.',
    'sso_if_not_redirected' => 'Если перенаправление не произошло автоматически:',
    'open_brand'            => 'Открыть %s →',
    'launch_failed'         => 'Не удалось запустить',
    'launch_failed_body'    => 'Не удалось создать безопасную ссылку для входа в ваш аккаунт. Повторите попытку или обратитесь в поддержку.',
    'go_back'               => '← Назад',
];
