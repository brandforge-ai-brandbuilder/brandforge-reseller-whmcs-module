<?php
/**
 * BrandForge Provisioning Module — Client-Facing Strings (Croatian)
 *
 * AI-drafted first pass — needs a native Croatian speaker's review before
 * being treated as production-ready. See lang/english.php for the full
 * key reference, placeholder rules, and how this file is loaded.
 */

if (!defined('WHMCS')) {
    die('Access denied.');
}

return [
    'status_active'      => 'Aktivno',
    'status_suspended'   => 'Suspendirano',
    'status_pending'     => 'Na čekanju',
    'status_unknown'     => 'Nepoznato',

    'label_package'         => 'Paket',
    'label_status'          => 'Status',
    'label_subscription_id' => 'ID pretplate',
    'label_workspace_id'    => 'ID radnog prostora',
    'label_provisioned'     => 'Postavljeno',

    'label_ai_credits' => 'AI krediti',
    'used_of'          => '%1$d / %2$d iskorišteno',
    'remaining'        => 'preostalo',
    'resets'           => 'Obnavlja se %s',

    'label_workspaces' => 'Radni prostori',
    'active_of_max'    => '%1$d / %2$d iskorišteno',
    'active_count'     => '%d aktivno',
    'untitled'         => 'Bez naziva',
    'active'           => 'aktivno',
    'inactive'         => 'neaktivno',
    'workspace_note'   => 'Pojedinosti o radnom prostoru i projektima brenda upravljaju se unutar %s.',
    'open_app'         => 'Otvori aplikaciju →',

    'launch_unavailable' => 'Poveznica za pokretanje nije dostupna:',
    'launch'             => 'Pokreni %s',
    'upgrade_plan'       => 'Nadogradi plan',
    'view_workspace'     => 'Prikaži radni prostor',
    'powered_by'         => 'Pokreće %s',
    'service_dashboard'  => 'Nadzorna ploča usluge',
    'not_provisioned'    => 'Usluga još nije postavljena.',
    'being_set_up'       => 'Vaša pretplata na %s se postavlja. To obično traje manje od minute. Ako se ova poruka nastavi prikazivati, obratite se podršci.',

    'launching'             => 'Pokretanje %s…',
    'sso_signing_in'        => 'Sigurno se prijavljujete u svoj radni prostor.',
    'sso_if_not_redirected' => 'Ako niste automatski preusmjereni:',
    'open_brand'            => 'Otvori %s →',
    'launch_failed'         => 'Pokretanje nije uspjelo',
    'launch_failed_body'    => 'Nismo mogli generirati sigurnu poveznicu za prijavu za vaš račun. Pokušajte ponovno ili se obratite podršci.',
    'go_back'               => '← Natrag',
];
