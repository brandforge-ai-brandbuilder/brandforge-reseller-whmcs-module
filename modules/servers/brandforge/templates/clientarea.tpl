{*
  BrandForge — Client Area Dashboard
  Vars injected by brandforge_ClientArea():
    has_service         bool
    service_status      string  (e.g. Active / Suspended)
    service_id          int
    package_name        string
    subscription_id     string
    workspace_id        string
    sso_url             string  (pre-generated; empty on failure)
    sso_error           string
    brand_name          string  (reseller-overridable)
    brand_color         string  (reseller-overridable, e.g. #6366f1)
    created_at          string
    has_usage_data      bool    (false when Godmode status endpoint unavailable)
    credits_allocated   int
    credits_used        int
    credits_remaining   int
    credits_period_end  string  (YYYY-MM-DD)
    credits_over_limit  bool
    workspaces_max      int     (0 = unknown; from package plan via Godmode)
*}

{assign var="bf_primary"   value=$brand_color|default:'#6366f1'}
{assign var="bf_secondary" value=$brand_color_secondary|default:'#8b5cf6'}
{assign var="bf_name"      value=$brand_name|default:'BrandForge'}

<style>
/* ── Reset scoped to .bf-wrap ─────────────────────────── */
.bf-wrap *,
.bf-wrap *::before,
.bf-wrap *::after { box-sizing:border-box; }
.bf-wrap a { text-decoration:none; }

/* ── Layout ───────────────────────────────────────────── */
.bf-wrap {
  max-width: 680px;
  margin: 0 auto;
  font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto,
               'Helvetica Neue', Arial, sans-serif;
  font-size: 14px;
  color: #111827;
}

/* ── Header card ──────────────────────────────────────── */
.bf-header {
  background: linear-gradient(135deg, {$bf_primary} 0%, {$bf_secondary} 100%);
  border-radius: 14px;
  padding: 26px 28px;
  color: #fff;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 16px;
  flex-wrap: wrap;
}
.bf-header-left   { display:flex; align-items:center; gap:14px; }
.bf-header-icon   { width:44px; height:44px; flex-shrink:0; }
.bf-header-title  { font-size:20px; font-weight:700; letter-spacing:-0.3px; line-height:1.2; }
.bf-header-sub    { font-size:13px; opacity:.75; margin-top:3px; }

/* ── Status badge ─────────────────────────────────────── */
.bf-badge {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 5px 13px;
  border-radius: 20px;
  font-size: 12px;
  font-weight: 600;
  letter-spacing: .3px;
  white-space: nowrap;
}
.bf-badge-dot { width:7px; height:7px; border-radius:50%; background:currentColor; }
.bf-badge--active    { background:rgba(255,255,255,.22); color:#fff; }
.bf-badge--suspended { background:rgba(251,191,36,.25);  color:#fde68a; }
.bf-badge--cancelled,
.bf-badge--terminated { background:rgba(239,68,68,.25); color:#fca5a5; }
.bf-badge--unknown   { background:rgba(255,255,255,.15); color:#e5e7eb; }

/* ── Info grid ────────────────────────────────────────── */
.bf-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 12px;
  margin-bottom: 16px;
}
@media (max-width: 520px) { .bf-grid { grid-template-columns: 1fr; } }

.bf-card {
  background: #fff;
  border: 1px solid #e5e7eb;
  border-radius: 10px;
  padding: 16px 18px;
  transition: box-shadow .15s, border-color .15s;
}
.bf-card:hover { border-color:{$bf_primary}40; box-shadow:0 3px 12px {$bf_primary}18; }
.bf-card-label {
  display: block;
  font-size: 10.5px;
  font-weight: 700;
  letter-spacing: .7px;
  text-transform: uppercase;
  color: #9ca3af;
  margin-bottom: 7px;
}
.bf-card-value {
  display: block;
  font-size: 14.5px;
  font-weight: 600;
  color: #111827;
  word-break: break-all;
}
.bf-card-value--mono {
  font-family: 'SFMono-Regular', 'SF Mono', Consolas, 'Liberation Mono',
               Menlo, monospace;
  font-size: 12.5px;
  font-weight: 500;
  color: #374151;
}
.bf-card-value--date { font-size:13px; font-weight:500; color:#6b7280; }

/* Status dot inside card */
.bf-status-dot {
  display: inline-block;
  width: 8px; height: 8px;
  border-radius: 50%;
  margin-right: 6px;
  vertical-align: middle;
}
.bf-status-dot--active    { background:#10b981; box-shadow:0 0 0 3px #10b98125; }
.bf-status-dot--suspended { background:#f59e0b; box-shadow:0 0 0 3px #f59e0b25; }
.bf-status-dot--other     { background:#ef4444; box-shadow:0 0 0 3px #ef444425; }

/* ── Primary launch button ────────────────────────────── */
.bf-launch-wrap { margin-bottom: 12px; }

.bf-btn-launch {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 10px;
  width: 100%;
  padding: 15px 24px;
  background: linear-gradient(135deg, {$bf_primary} 0%, {$bf_secondary} 100%);
  color: #fff;
  font-size: 15.5px;
  font-weight: 700;
  border-radius: 10px;
  border: none;
  cursor: pointer;
  box-shadow: 0 4px 16px {$bf_primary}45;
  transition: transform .15s, box-shadow .15s, opacity .15s;
  letter-spacing: .1px;
}
.bf-btn-launch:hover  { transform:translateY(-1px); box-shadow:0 6px 22px {$bf_primary}55;
                        color:#fff; text-decoration:none; }
.bf-btn-launch:active { transform:translateY(0); opacity:.9; }
.bf-btn-launch--disabled { opacity:.5; cursor:not-allowed; pointer-events:none; }
.bf-launch-icon { font-size:18px; line-height:1; }

/* ── Secondary action row ─────────────────────────────── */
.bf-actions {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 10px;
  margin-bottom: 16px;
}
@media (max-width: 420px) { .bf-actions { grid-template-columns: 1fr; } }

.bf-btn-secondary {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 7px;
  padding: 11px 16px;
  background: #fff;
  color: #374151;
  font-size: 13.5px;
  font-weight: 600;
  border: 1.5px solid #d1d5db;
  border-radius: 9px;
  cursor: pointer;
  transition: border-color .15s, color .15s, background .15s;
  white-space: nowrap;
}
.bf-btn-secondary:hover {
  border-color: {$bf_primary};
  color: {$bf_primary};
  background: {$bf_primary}0a;
  text-decoration: none;
}
.bf-btn-secondary--form { width:100%; }

/* ── Usage section ────────────────────────────────────── */
.bf-usage { margin-bottom: 16px; }

.bf-usage-block {
  background: #fff;
  border: 1px solid #e5e7eb;
  border-radius: 10px;
  padding: 16px 18px;
  margin-bottom: 10px;
  transition: box-shadow .15s, border-color .15s;
}
.bf-usage-block:last-child { margin-bottom: 0; }
.bf-usage-block:hover { border-color:{$bf_primary}40; box-shadow:0 3px 12px {$bf_primary}18; }

.bf-usage-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 10px;
}
.bf-usage-title {
  font-size: 10.5px;
  font-weight: 700;
  letter-spacing: .7px;
  text-transform: uppercase;
  color: #9ca3af;
}
.bf-usage-count {
  font-size: 13px;
  font-weight: 600;
  color: #111827;
}
.bf-usage-count--warn { color: #f59e0b; }
.bf-usage-count--over { color: #ef4444; }

/* Progress bar */
.bf-progress-track {
  height: 7px;
  background: #f3f4f6;
  border-radius: 99px;
  overflow: hidden;
  margin-bottom: 8px;
}
.bf-progress-fill {
  height: 100%;
  border-radius: 99px;
  background: linear-gradient(90deg, {$bf_primary}, {$bf_secondary});
  transition: width .4s ease;
}
.bf-progress-fill--warn  { background: linear-gradient(90deg, #f59e0b, #fbbf24); }
.bf-progress-fill--over  { background: linear-gradient(90deg, #ef4444, #f87171); }

.bf-usage-meta {
  display: flex;
  justify-content: space-between;
  font-size: 11.5px;
  color: #6b7280;
}
.bf-usage-meta strong { color: #374151; font-weight: 600; }


/* ── Alert / error states ─────────────────────────────── */
.bf-alert {
  display: flex;
  gap: 12px;
  align-items: flex-start;
  padding: 14px 18px;
  border-radius: 10px;
  margin-bottom: 14px;
  font-size: 13px;
  line-height: 1.5;
}
.bf-alert-icon { font-size:18px; flex-shrink:0; margin-top:1px; }
.bf-alert--warn  { background:#fffbeb; border:1px solid #fcd34d; color:#92400e; }
.bf-alert--error { background:#fef2f2; border:1px solid #fca5a5; color:#991b1b; }
.bf-alert code   { font-family:monospace; padding:1px 5px; border-radius:4px;
                   background:rgba(0,0,0,.07); font-size:12px; }

/* ── Divider / footer ─────────────────────────────────── */
.bf-footer {
  font-size: 11.5px;
  color: #9ca3af;
  text-align: center;
  padding-top: 10px;
  border-top: 1px solid #f3f4f6;
}
</style>

<div class="bf-wrap">
{if $has_service}

  {* ── Header ──────────────────────────────────────────── *}
  <div class="bf-header">
    <div class="bf-header-left">
      <svg class="bf-header-icon" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
        <rect width="44" height="44" rx="10" fill="rgba(255,255,255,0.18)"/>
        <path d="M12 32L22 10l10 22H12z" fill="white" opacity="0.85"/>
        <circle cx="22" cy="17" r="4.5" fill="white"/>
        <path d="M17 32h10" stroke="white" stroke-width="2" stroke-linecap="round" opacity="0.5"/>
      </svg>
      <div>
        <div class="bf-header-title">{$bf_name|escape}</div>
        <div class="bf-header-sub">{$package_name|escape}</div>
      </div>
    </div>

    {assign var="sl" value=$service_status|lower}
    {if $sl eq 'active'}
      <span class="bf-badge bf-badge--active">
        <span class="bf-badge-dot"></span>Active
      </span>
    {elseif $sl eq 'suspended'}
      <span class="bf-badge bf-badge--suspended">
        <span class="bf-badge-dot"></span>Suspended
      </span>
    {elseif $sl eq 'cancelled' or $sl eq 'terminated'}
      <span class="bf-badge bf-badge--cancelled">
        <span class="bf-badge-dot"></span>{$service_status|escape}
      </span>
    {else}
      <span class="bf-badge bf-badge--unknown">
        <span class="bf-badge-dot"></span>{$service_status|escape}
      </span>
    {/if}
  </div>

  {* ── Info grid ────────────────────────────────────────── *}
  <div class="bf-grid">

    <div class="bf-card">
      <span class="bf-card-label">Package</span>
      <span class="bf-card-value">{$package_name|escape}</span>
    </div>

    <div class="bf-card">
      <span class="bf-card-label">Status</span>
      <span class="bf-card-value">
        {if $sl eq 'active'}
          <span class="bf-status-dot bf-status-dot--active"></span>Active
        {elseif $sl eq 'suspended'}
          <span class="bf-status-dot bf-status-dot--suspended"></span>Suspended
        {else}
          <span class="bf-status-dot bf-status-dot--other"></span>{$service_status|escape}
        {/if}
      </span>
    </div>

    <div class="bf-card">
      <span class="bf-card-label">Subscription ID</span>
      <span class="bf-card-value bf-card-value--mono">{$subscription_id|escape}</span>
    </div>

    {if $workspace_id}
    <div class="bf-card">
      <span class="bf-card-label">Workspace ID</span>
      <span class="bf-card-value bf-card-value--mono">{$workspace_id|escape}</span>
    </div>
    {elseif $created_at}
    <div class="bf-card">
      <span class="bf-card-label">Provisioned</span>
      <span class="bf-card-value bf-card-value--date">{$created_at|escape}</span>
    </div>
    {/if}

  </div>

  {* ── Usage: credits & workspaces ─────────────────────────── *}
  {if $has_usage_data}
  <div class="bf-usage">

    {* Credits block *}
    {if $credits_allocated gt 0}
    {assign var="pct_raw" value=$credits_used/$credits_allocated*100}
    {if $pct_raw gt 100}{assign var="pct" value=100}{else}{assign var="pct" value=$pct_raw|round}{/if}
    {assign var="bar_class" value=""}
    {if $credits_over_limit}
      {assign var="bar_class" value=" bf-progress-fill--over"}
    {elseif $pct gt 80}
      {assign var="bar_class" value=" bf-progress-fill--warn"}
    {/if}
    <div class="bf-usage-block">
      <div class="bf-usage-header">
        <span class="bf-usage-title">AI Credits</span>
        <span class="bf-usage-count{if $credits_over_limit} bf-usage-count--over{elseif $pct gt 80} bf-usage-count--warn{/if}">
          {$credits_used} / {$credits_allocated} used
        </span>
      </div>
      <div class="bf-progress-track">
        <div class="bf-progress-fill{$bar_class}" style="width:{$pct}%"></div>
      </div>
      <div class="bf-usage-meta">
        <span><strong>{$credits_remaining}</strong> remaining</span>
        {if $credits_period_end}<span>Resets {$credits_period_end|escape}</span>{/if}
      </div>
    </div>
    {/if}

    {* Workspaces block — count from package plan; full list is inside the app *}
    <div class="bf-usage-block">
      <div class="bf-usage-header">
        <span class="bf-usage-title">Workspaces</span>
        {if $workspaces_max gt 0}
          <span class="bf-usage-count">Up to {$workspaces_max} included</span>
        {/if}
      </div>
      <div style="font-size:12.5px;color:#6b7280;line-height:1.55;">
        Workspace details and brand projects are managed inside {$bf_name|escape}.
        {if $sso_url}
          <a href="{$sso_url|escape}" target="_blank" rel="noopener noreferrer"
             style="color:{$bf_primary};font-weight:600;text-decoration:none;">
            Open app →
          </a>
        {/if}
      </div>
    </div>

  </div>
  {/if}

  {* ── SSO error notice ─────────────────────────────────── *}
  {if $sso_error}
  <div class="bf-alert bf-alert--error">
    <span class="bf-alert-icon">⚠️</span>
    <div>
      <strong>Launch link unavailable:</strong><br>
      <code>{$sso_error|escape}</code>
    </div>
  </div>
  {/if}

  {* ── Primary CTA ──────────────────────────────────────── *}
  {assign var="sl" value=$service_status|lower}
  <div class="bf-launch-wrap">
    {if $sso_url}
      <a href="{$sso_url|escape}" target="_blank" rel="noopener noreferrer"
         class="bf-btn-launch{if $sl neq 'active'} bf-btn-launch--disabled{/if}">
        <span class="bf-launch-icon">🚀</span>
        Launch {$bf_name|escape}
      </a>
    {else}
      <form method="post" action="clientarea.php" style="margin:0">
        <input type="hidden" name="action"      value="productdetails">
        <input type="hidden" name="id"          value="{$service_id|intval}">
        <input type="hidden" name="modop"       value="custom">
        <input type="hidden" name="a"           value="LaunchBrandForge">
        <input type="hidden" name="token"       value="{$token|default:''|escape}">
        <button type="submit"
                class="bf-btn-launch{if $sl neq 'active'} bf-btn-launch--disabled{/if}"
                {if $sl neq 'active'}disabled{/if}>
          <span class="bf-launch-icon">🚀</span>
          Launch {$bf_name|escape}
        </button>
      </form>
    {/if}
  </div>

  {* ── Secondary actions ─────────────────────────────────── *}
  <div class="bf-actions">

    <a href="upgrade.php?type=package&id={$service_id|intval}"
       class="bf-btn-secondary">
      ↑&nbsp; Upgrade Plan
    </a>

    {if $sso_url}
      <a href="{$sso_url|escape}" target="_blank" rel="noopener noreferrer"
         class="bf-btn-secondary">
        🏢&nbsp; View Workspace
      </a>
    {else}
      <form method="post" action="clientarea.php" style="margin:0">
        <input type="hidden" name="action" value="productdetails">
        <input type="hidden" name="id"     value="{$service_id|intval}">
        <input type="hidden" name="modop"  value="custom">
        <input type="hidden" name="a"      value="ViewWorkspace">
        <input type="hidden" name="token"  value="{$token|default:''|escape}">
        <button type="submit" class="bf-btn-secondary bf-btn-secondary--form">
          🏢&nbsp; View Workspace
        </button>
      </form>
    {/if}

  </div>

  <div class="bf-footer">
    Powered by {$bf_name|escape}
    {if $subscription_id} &mdash; <span style="font-family:monospace">{$subscription_id|truncate:20:'…':true|escape}</span>{/if}
  </div>

{else}

  {* ── Not yet provisioned ─────────────────────────────── *}
  <div class="bf-header" style="background:linear-gradient(135deg,#6b7280,#4b5563)">
    <div class="bf-header-left">
      <div>
        <div class="bf-header-title">{$bf_name|escape}</div>
        <div class="bf-header-sub">Service Dashboard</div>
      </div>
    </div>
    <span class="bf-badge bf-badge--unknown">
      <span class="bf-badge-dot"></span>{$service_status|default:'Pending'|escape}
    </span>
  </div>

  <div class="bf-alert bf-alert--warn">
    <span class="bf-alert-icon">⏳</span>
    <div>
      <strong>Service not yet provisioned.</strong><br>
      Your {$bf_name|escape} subscription is being set up. This usually takes less than a minute.
      If this message persists, please contact support.
    </div>
  </div>

{/if}
</div>
