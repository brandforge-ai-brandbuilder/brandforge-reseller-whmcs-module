<?php
/**
 * BrandForge Provisioning Module — Client-Facing Strings (Swedish)
 *
 * AI-drafted first pass — needs a native Swedish speaker's review before
 * being treated as production-ready. See lang/english.php for the full
 * key reference, placeholder rules, and how this file is loaded.
 */

if (!defined('WHMCS')) {
    die('Access denied.');
}

return [
    'status_active'      => 'Aktiv',
    'status_suspended'   => 'Avstängd',
    'status_pending'     => 'Väntar',
    'status_unknown'     => 'Okänd',

    'label_package'         => 'Paket',
    'label_status'          => 'Status',
    'label_subscription_id' => 'Prenumerations-ID',
    'label_workspace_id'    => 'Arbetsyte-ID',
    'label_provisioned'     => 'Etablerad',

    'label_ai_credits' => 'AI-krediter',
    'used_of'          => '%1$d / %2$d använda',
    'remaining'        => 'kvar',
    'resets'           => 'Återställs %s',

    'label_workspaces' => 'Arbetsytor',
    'active_of_max'    => '%1$d / %2$d använda',
    'active_count'     => '%d aktiva',
    'untitled'         => 'Namnlös',
    'active'           => 'aktiv',
    'inactive'         => 'inaktiv',
    'workspace_note'   => 'Information om arbetsytan och varumärkesprojekt hanteras i %s.',
    'open_app'         => 'Öppna appen →',

    'launch_unavailable' => 'Startlänk ej tillgänglig:',
    'launch'             => 'Starta %s',
    'upgrade_plan'       => 'Uppgradera plan',
    'view_workspace'     => 'Visa arbetsyta',
    'powered_by'         => 'Drivs av %s',
    'service_dashboard'  => 'Tjänstepanel',
    'not_provisioned'    => 'Tjänsten är ännu inte etablerad.',
    'being_set_up'       => 'Din %s-prenumeration håller på att konfigureras. Detta tar vanligtvis mindre än en minut. Kontakta supporten om detta meddelande kvarstår.',

    'launching'             => 'Startar %s…',
    'sso_signing_in'        => 'Du loggas in säkert på din arbetsyta.',
    'sso_if_not_redirected' => 'Om du inte omdirigeras automatiskt:',
    'open_brand'            => 'Öppna %s →',
    'launch_failed'         => 'Start misslyckades',
    'launch_failed_body'    => 'Vi kunde inte skapa en säker inloggningslänk för ditt konto. Försök igen eller kontakta supporten.',
    'go_back'               => '← Tillbaka',
];
