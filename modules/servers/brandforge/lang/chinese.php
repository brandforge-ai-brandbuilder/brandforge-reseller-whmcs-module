<?php
/**
 * BrandForge Provisioning Module — Client-Facing Strings (Chinese, Simplified)
 *
 * AI-drafted first pass — needs a native Chinese speaker's review before
 * being treated as production-ready. See lang/english.php for the full
 * key reference, placeholder rules, and how this file is loaded.
 */

if (!defined('WHMCS')) {
    die('Access denied.');
}

return [
    'status_active'      => '已激活',
    'status_suspended'   => '已暂停',
    'status_pending'     => '待处理',
    'status_unknown'     => '未知',

    'label_package'         => '套餐',
    'label_status'          => '状态',
    'label_subscription_id' => '订阅 ID',
    'label_workspace_id'    => '工作区 ID',
    'label_provisioned'     => '已开通',

    'label_ai_credits' => 'AI 额度',
    'used_of'          => '已使用 %1$d / %2$d',
    'remaining'        => '剩余',
    'resets'           => '于 %s 重置',

    'label_workspaces' => '工作区',
    'active_of_max'    => '已使用 %1$d / %2$d',
    'active_count'     => '%d 个活跃',
    'untitled'         => '未命名',
    'active'           => '活跃',
    'inactive'         => '未激活',
    'workspace_note'   => '工作区详情和品牌项目在 %s 中管理。',
    'open_app'         => '打开应用 →',

    'launch_unavailable' => '启动链接不可用：',
    'launch'             => '启动 %s',
    'upgrade_plan'       => '升级套餐',
    'view_workspace'     => '查看工作区',
    'powered_by'         => '技术支持：%s',
    'service_dashboard'  => '服务面板',
    'not_provisioned'    => '服务尚未开通。',
    'being_set_up'       => '您的 %s 订阅正在设置中。通常不到一分钟即可完成。如果此消息持续出现，请联系支持。',

    'launching'             => '正在启动 %s…',
    'sso_signing_in'        => '正在安全登录您的工作区。',
    'sso_if_not_redirected' => '如果未自动跳转：',
    'open_brand'            => '打开 %s →',
    'launch_failed'         => '启动失败',
    'launch_failed_body'    => '我们无法为您的账户生成安全登录链接。请重试或联系支持。',
    'go_back'               => '← 返回',
];
