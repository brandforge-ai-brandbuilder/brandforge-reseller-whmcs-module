<?php
/**
 * BrandForge Provisioning Module — Client-Facing Strings (Hungarian)
 *
 * AI-drafted first pass — needs a native Hungarian speaker's review before
 * being treated as production-ready. See lang/english.php for the full
 * key reference, placeholder rules, and how this file is loaded.
 */

if (!defined('WHMCS')) {
    die('Access denied.');
}

return [
    'status_active'      => 'Aktív',
    'status_suspended'   => 'Felfüggesztve',
    'status_pending'     => 'Függőben',
    'status_unknown'     => 'Ismeretlen',

    'label_package'         => 'Csomag',
    'label_status'          => 'Állapot',
    'label_subscription_id' => 'Előfizetés azonosítója',
    'label_workspace_id'    => 'Munkaterület azonosítója',
    'label_provisioned'     => 'Beállítva',

    'label_ai_credits' => 'AI kreditek',
    'used_of'          => '%1$d / %2$d felhasználva',
    'remaining'        => 'hátralévő',
    'resets'           => 'Megújul: %s',

    'label_workspaces' => 'Munkaterületek',
    'active_of_max'    => '%1$d / %2$d felhasználva',
    'active_count'     => '%d aktív',
    'untitled'         => 'Névtelen',
    'active'           => 'aktív',
    'inactive'         => 'inaktív',
    'workspace_note'   => 'A munkaterület adatait és a márkaprojekteket a(z) %s kezeli.',
    'open_app'         => 'Alkalmazás megnyitása →',

    'launch_unavailable' => 'Az indítási hivatkozás nem érhető el:',
    'launch'             => '%s indítása',
    'upgrade_plan'       => 'Csomag frissítése',
    'view_workspace'     => 'Munkaterület megtekintése',
    'powered_by'         => 'Működteti: %s',
    'service_dashboard'  => 'Szolgáltatás irányítópult',
    'not_provisioned'    => 'A szolgáltatás még nincs beállítva.',
    'being_set_up'       => 'A(z) %s előfizetésed beállítása folyamatban van. Ez általában kevesebb mint egy percet vesz igénybe. Ha az üzenet továbbra is látható, vedd fel a kapcsolatot az ügyfélszolgálattal.',

    'launching'             => '%s indítása…',
    'sso_signing_in'        => 'Biztonságos bejelentkezés folyamatban a munkaterületedre.',
    'sso_if_not_redirected' => 'Ha nem történik automatikus átirányítás:',
    'open_brand'            => '%s megnyitása →',
    'launch_failed'         => 'Sikertelen indítás',
    'launch_failed_body'    => 'Nem sikerült biztonságos bejelentkezési hivatkozást létrehozni a fiókodhoz. Próbáld újra, vagy vedd fel a kapcsolatot az ügyfélszolgálattal.',
    'go_back'               => '← Vissza',
];
