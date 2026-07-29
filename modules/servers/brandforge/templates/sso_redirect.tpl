{*
  BrandForge — SSO Redirect Page
  Vars: sso_url (string), sso_error (string), brand_name (string)
*}
{assign var="bf_name" value=$brand_name|default:'BrandForge'}

<style>
.bf-redirect-wrap {
  max-width: 480px;
  margin: 48px auto;
  text-align: center;
  font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
  padding: 0 16px;
}
.bf-redirect-icon {
  font-size: 52px;
  line-height: 1;
  margin-bottom: 18px;
  animation: bf-pulse 1.6s ease-in-out infinite;
}
@keyframes bf-pulse {
  0%, 100% { transform: scale(1);     opacity: 1;   }
  50%       { transform: scale(1.06); opacity: 0.85; }
}
.bf-redirect-title {
  font-size: 20px;
  font-weight: 700;
  color: #111827;
  margin-bottom: 8px;
}
.bf-redirect-sub {
  font-size: 14px;
  color: #6b7280;
  margin-bottom: 28px;
  line-height: 1.5;
}
.bf-redirect-link {
  display: inline-block;
  padding: 11px 28px;
  background: linear-gradient(135deg, #6366f1, #8b5cf6);
  color: #fff;
  font-size: 14px;
  font-weight: 600;
  border-radius: 8px;
  text-decoration: none;
  box-shadow: 0 4px 14px #6366f140;
  transition: opacity .15s;
}
.bf-redirect-link:hover { opacity:.88; color:#fff; text-decoration:none; }

.bf-error-wrap {
  max-width: 480px;
  margin: 48px auto;
  padding: 0 16px;
  font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
}
.bf-error-box {
  background: #fef2f2;
  border: 1px solid #fca5a5;
  border-radius: 12px;
  padding: 24px 28px;
  color: #991b1b;
}
.bf-error-box h4  { font-size:16px; font-weight:700; margin:0 0 8px; }
.bf-error-box p   { font-size:13px; margin:0 0 16px; line-height:1.5; }
.bf-error-box code{
  display:block; background:#fee2e2; border-radius:6px;
  padding:10px 14px; font-family:monospace; font-size:12.5px; word-break:break-all;
  margin-bottom:16px;
}
.bf-btn-back {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 9px 20px;
  background: #fff;
  color: #374151;
  font-size: 13.5px;
  font-weight: 600;
  border: 1.5px solid #d1d5db;
  border-radius: 8px;
  cursor: pointer;
  text-decoration: none;
  transition: border-color .15s, color .15s;
}
.bf-btn-back:hover { border-color:#6366f1; color:#6366f1; text-decoration:none; }
</style>

{if $sso_url}

  {* Auto-redirect with JS + meta fallback *}
  <script>
    (function() {
      var target = {$sso_url|json_encode};
      if (target) { window.location.href = target; }
    }());
  </script>
  <noscript>
    <meta http-equiv="refresh" content="0;url={$sso_url|escape}">
  </noscript>

  <div class="bf-redirect-wrap">
    <div class="bf-redirect-icon">🚀</div>
    <div class="bf-redirect-title">Launching {$bf_name|escape}&hellip;</div>
    <div class="bf-redirect-sub">
      You are being securely signed in to your workspace.<br>
      If you are not redirected automatically:
    </div>
    <a href="{$sso_url|escape}" target="_blank" rel="noopener noreferrer"
       class="bf-redirect-link">
      Open {$bf_name|escape} &rarr;
    </a>
  </div>

{else}

  <div class="bf-error-wrap">
    <div class="bf-error-box">
      <h4>Launch failed</h4>
      <p>We could not generate a secure login link for your account. Please try again or contact support.</p>
      {if $sso_error}
        <code>{$sso_error|escape}</code>
      {/if}
      <a href="javascript:history.back()" class="bf-btn-back">
        ← Go back
      </a>
    </div>
  </div>

{/if}
