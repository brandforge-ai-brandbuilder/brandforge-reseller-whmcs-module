<?php
/**
 * BrandForge Provisioning Module — Client-Facing Strings (English)
 *
 * Unlike the addon module, WHMCS has NO built-in localisation mechanism for
 * provisioning/server modules — confirmed against WHMCS's own official
 * sample provisioning module, which ships no lang/ folder at all. This file
 * (and its sibling lang/{language}.php files) are loaded ourselves, by
 * lib/Translator.php, based on the product's own "Client Area Language"
 * config option — a setting this module adds, not something WHMCS exposes.
 *
 * To add another language: copy this file to lang/{language}.php and
 * translate the values only, never the array keys. Any key missing from
 * another language automatically falls back to this English value — see
 * Translator::strings().
 *
 * %s / %1$d etc. placeholders are filled in via sprintf() before the string
 * reaches the template — see brandforge_ClientArea() / brandforge_doSso()
 * in ../brandforge.php.
 */

if (!defined('WHMCS')) {
    die('Access denied.');
}

return [
    // Status
    'status_active'      => 'Active',
    'status_suspended'   => 'Suspended',
    'status_pending'     => 'Pending',
    'status_unknown'     => 'Unknown',

    // Info grid labels
    'label_package'         => 'Package',
    'label_status'          => 'Status',
    'label_subscription_id' => 'Subscription ID',
    'label_workspace_id'    => 'Workspace ID',
    'label_provisioned'     => 'Provisioned',

    // Usage: credits
    'label_ai_credits' => 'AI Credits',
    'used_of'          => '%1$d / %2$d used',
    'remaining'        => 'remaining',
    'resets'           => 'Resets %s',

    // Usage: workspaces
    'label_workspaces' => 'Workspaces',
    'active_of_max'    => '%1$d / %2$d used',
    'active_count'     => '%d active',
    'untitled'         => 'Untitled',
    'active'           => 'active',
    'inactive'         => 'inactive',
    'workspace_note'   => 'Workspace details and brand projects are managed inside %s.',
    'open_app'         => 'Open app →',

    // Errors / CTAs
    'launch_unavailable' => 'Launch link unavailable:',
    'launch'             => 'Launch %s',
    'upgrade_plan'       => 'Upgrade Plan',
    'view_workspace'     => 'View Workspace',
    'powered_by'         => 'Powered by %s',
    'service_dashboard'  => 'Service Dashboard',
    'not_provisioned'    => 'Service not yet provisioned.',
    'being_set_up'       => 'Your %s subscription is being set up. This usually takes less than a minute. If this message persists, please contact support.',

    // SSO redirect page
    'launching'             => 'Launching %s…',
    'sso_signing_in'        => 'You are being securely signed in to your workspace.',
    'sso_if_not_redirected' => 'If you are not redirected automatically:',
    'open_brand'            => 'Open %s →',
    'launch_failed'         => 'Launch failed',
    'launch_failed_body'    => 'We could not generate a secure login link for your account. Please try again or contact support.',
    'go_back'               => '← Go back',
];
