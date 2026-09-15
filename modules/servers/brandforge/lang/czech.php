<?php
/**
 * BrandForge Provisioning Module — Client-Facing Strings (Czech)
 *
 * AI-drafted first pass — needs a native Czech speaker's review before
 * being treated as production-ready. See lang/english.php for the full
 * key reference, placeholder rules, and how this file is loaded.
 */

if (!defined('WHMCS')) {
    die('Access denied.');
}

return [
    'status_active'      => 'Aktivní',
    'status_suspended'   => 'Pozastaveno',
    'status_pending'     => 'Čekající',
    'status_unknown'     => 'Neznámý',

    'label_package'         => 'Balíček',
    'label_status'          => 'Stav',
    'label_subscription_id' => 'ID předplatného',
    'label_workspace_id'    => 'ID pracovního prostoru',
    'label_provisioned'     => 'Zřízeno',

    'label_ai_credits' => 'AI kredity',
    'used_of'          => '%1$d / %2$d využito',
    'remaining'        => 'zbývá',
    'resets'           => 'Obnovení %s',

    'label_workspaces' => 'Pracovní prostory',
    'active_of_max'    => '%1$d / %2$d využito',
    'active_count'     => '%d aktivních',
    'untitled'         => 'Bez názvu',
    'active'           => 'aktivní',
    'inactive'         => 'neaktivní',
    'workspace_note'   => 'Podrobnosti pracovního prostoru a projekty značky jsou spravovány v %s.',
    'open_app'         => 'Otevřít aplikaci →',

    'launch_unavailable' => 'Odkaz pro spuštění není k dispozici:',
    'launch'             => 'Spustit %s',
    'upgrade_plan'       => 'Upgradovat plán',
    'view_workspace'     => 'Zobrazit pracovní prostor',
    'powered_by'         => 'Provozováno na %s',
    'service_dashboard'  => 'Přehled služby',
    'not_provisioned'    => 'Služba zatím nebyla zřízena.',
    'being_set_up'       => 'Vaše předplatné %s se právě nastavuje. Obvykle to trvá méně než minutu. Pokud tato zpráva přetrvává, kontaktujte podporu.',

    'launching'             => 'Spouštění %s…',
    'sso_signing_in'        => 'Probíhá bezpečné přihlášení do vašeho pracovního prostoru.',
    'sso_if_not_redirected' => 'Pokud nedojde k automatickému přesměrování:',
    'open_brand'            => 'Otevřít %s →',
    'launch_failed'         => 'Spuštění se nezdařilo',
    'launch_failed_body'    => 'Nepodařilo se vygenerovat zabezpečený přihlašovací odkaz pro váš účet. Zkuste to znovu nebo kontaktujte podporu.',
    'go_back'               => '← Zpět',
];
