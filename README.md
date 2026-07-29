# BrandForge Reseller WHMCS Module

WHMCS provisioning and addon module that connects WHMCS product lifecycle events to the [BrandForge](https://brandforge.com) Godmode API — automating workspace provisioning, suspension, termination, package upgrades, SSO login, and client area dashboards for resellers and their customers.

---

## Modules

| Module | Type | Purpose |
|---|---|---|
| `modules/servers/brandforge` | Server / Provisioning | Full service lifecycle, SSO, and client area dashboard |
| `modules/addons/brandforge` | Addon | Admin UI for One-Click Setup and Godmode package sync |

---

## Requirements

- WHMCS 8.x
- PHP 7.4+ (PHP 8.0+ recommended)
- cURL extension enabled
- A BrandForge Godmode API URL and API Key (provided by BrandForge)

---

## Installation

### Option A — One-Click Setup (recommended)

1. Copy the `modules/` folder into the root of your WHMCS installation:

```
/path/to/whmcs/
└── modules/
    ├── servers/brandforge/
    └── addons/brandforge/
```

2. **Activate the Addon module**
   `Admin → Setup → Addon Modules → BrandForge Package Sync → Activate → Configure`
   - Godmode API URL: `https://brandforge.com`
   - Godmode API Key: your bearer token
   - Access Control: tick your admin role
   - Click **Save Changes**

3. **Open the addon**
   `Admin → Addons → BrandForge Package Sync`

4. Click **One-Click Setup** — this automatically:
   - Verifies your API credentials
   - Creates a WHMCS server record
   - Syncs all packages from Godmode
   - Creates a fully-configured WHMCS product for each package

5. Set pricing on each product (`Admin → Products/Services → [Product] → Pricing`) and you are ready to sell.

---

### Option B — Manual Setup

1. Copy the `modules/` folder as above.

2. Activate and configure the Addon module (step 2 above).

3. **Add a Server record**
   `Admin → Setup → Servers → Add Server`
   - Module: `BrandForge`
   - Hostname: `https://brandforge.com`
   - Password: your Godmode API Key
   - Click **Test Connection** to verify

4. **Create products**
   `Admin → Products/Services → Create New Product`
   - Set Module to `BrandForge` and assign the server

5. **Sync packages and link products**
   `Admin → Addons → BrandForge Package Sync → Sync All`
   For each package, click **Auto Create** or use the **Link** dropdown to attach an existing product.

6. Set pricing and publish products.

---

## Configuration Options

Set per-product under `Admin → Products/Services → [Product] → Module Settings`:

| Option | Description | Default |
|---|---|---|
| Godmode API URL | Base URL for the Godmode API (no trailing slash) | `https://brandforge.com` |
| Godmode API Key | Bearer token for authentication | — |
| Debug Mode | Log all API calls to the WHMCS Module Log | Off |
| Brand Name | Label shown in the client area (white-label branding) | `BrandForge` |
| Brand Primary Color | Hex accent color for buttons and UI | `#6366f1` |
| Frontend App URL | Reseller-branded app domain (e.g. `https://app.yourdomain.com`). Leave blank to use the default BrandForge URL | — |

> **Tip:** Leaving Godmode API URL and API Key blank in Module Settings causes the product to inherit credentials from the server record, so you only need to configure them in one place.

---

## Service Lifecycle

| WHMCS Event | Godmode Endpoint | What happens |
|---|---|---|
| Order activated | `POST /provision/create` | Workspace provisioned; `service_id` stored locally |
| Service suspended | `POST /provision/suspend` | Workspace access disabled |
| Service unsuspended | `POST /provision/unsuspend` | Workspace access restored |
| Service terminated | `POST /provision/terminate` | Workspace deprovisioned |
| Package upgraded | `POST /provision/change_package` | Subscription plan updated |

---

## Client Area Dashboard

Customers see a branded dashboard on their WHMCS product page:

- Service status badge (Active / Suspended / Cancelled)
- Package name, Subscription ID, Provisioned date
- **AI Credits** — live progress bar showing used / allocated credits and reset date (requires Godmode `/provision/status` endpoint)
- **Workspaces** — workspace count and list from Godmode (requires Godmode `/provision/status` endpoint)
- **Launch BrandForge** — calls `POST /provision/sso`, receives a one-time login URL with embedded profile, and redirects the customer directly into their BrandForge workspace
- **Upgrade Plan** — links to the WHMCS package upgrade flow
- **View Workspace** — SSO redirect targeting the workspace view

Customers never manually log into BrandForge — SSO handles it entirely.

---

## SSO Flow

```
Customer clicks "Launch BrandForge"
        ↓
WHMCS calls POST /api/godmode/v1/provision/sso  {service_id}
        ↓
Godmode returns: token + login_url + user + entity + package + credits
        ↓
Plugin appends profile as ?profile=<base64url> to login_url
        ↓
Customer browser lands on /sso?token=...&profile=...
        ↓
Frontend exchanges token + profile via /api/auth/sso → session created
        ↓
Customer lands on BrandForge dashboard ✓
```

The `profile` query param carries `user`, `entity`, `package`, and `credits` from the Godmode SSO response — eliminating any extra round-trip to Godmode from the frontend.

---

## Reseller Branding

**Brand Name** and **Brand Primary Color** (Module Settings) white-label the client area for your brand. Both are injected as Smarty variables (`{$brand_name}`, `{$brand_color}`) into all templates.

**Frontend App URL** (Module Settings) replaces the Godmode host in SSO redirect URLs so customers land on your branded domain (e.g. `https://app.resellerdomain.com/sso?token=...`) instead of `brandforge.software`.

---

## Database Tables

**`mod_brandforge_packages`** — Godmode package → WHMCS product mapping

| Column | Type | Description |
|---|---|---|
| `godmode_package_id` | varchar | Godmode package identifier |
| `godmode_slug` | varchar | Package slug (plan_code sent to Godmode) |
| `godmode_name` | varchar | Display name from Godmode |
| `whmcs_product_id` | int | Linked WHMCS product ID (nullable) |

**`mod_brandforge_services`** — provisioned service records

| Column | Type | Description |
|---|---|---|
| `whmcs_client_id` | int | WHMCS client ID |
| `whmcs_service_id` | int | WHMCS service ID (unique) |
| `whmcs_product_id` | int | WHMCS product ID |
| `godmode_service_id` | varchar | UUID returned by `/provision/create` — used for all subsequent API calls |
| `godmode_workspace_id` | varchar | Godmode workspace identifier |
| `godmode_user_id` | varchar | Godmode user identifier |

---

## Project Structure

```
modules/
├── servers/brandforge/
│   ├── brandforge.php              # Module entry point — all WHMCS lifecycle hooks
│   ├── lib/
│   │   ├── GodmodeClient.php       # HTTP client (Bearer auth, timeouts, error handling)
│   │   ├── SsoHandler.php          # SSO URL generation with profile encoding
│   │   ├── ServiceRepository.php   # mod_brandforge_services CRUD + migration
│   │   ├── PackageLookup.php       # WHMCS product → Godmode plan slug resolution
│   │   ├── Mapper.php              # WHMCS params → Godmode API payloads
│   │   ├── Logger.php              # WHMCS Module Log wrapper
│   │   └── Exceptions.php          # GodmodeApiException hierarchy
│   └── templates/
│       ├── clientarea.tpl          # Customer service dashboard (credits, workspaces, SSO)
│       └── sso_redirect.tpl        # SSO auto-redirect page
│
└── addons/brandforge/
    ├── brandforge.php              # Addon entry point + admin page (One-Click Setup)
    └── lib/
        ├── PackageRepository.php   # mod_brandforge_packages CRUD
        ├── PackageSync.php         # Godmode → WHMCS package sync orchestration
        ├── WhmcsProductManager.php # WHMCS product creation and group management
        └── WhmcsServerManager.php  # WHMCS server record creation and management
```

---

## Godmode API Endpoints Used

| Method | Path | Used by |
|---|---|---|
| `GET` | `/api/godmode/v1/provision/ping` | Test Connection |
| `GET` | `/api/godmode/v1/provision/packages` | Package Sync |
| `GET` | `/api/godmode/v1/provision/status?service_id=` | Client area credits and workspace display |
| `POST` | `/api/godmode/v1/provision/create` | CreateAccount |
| `POST` | `/api/godmode/v1/provision/suspend` | SuspendAccount |
| `POST` | `/api/godmode/v1/provision/unsuspend` | UnsuspendAccount |
| `POST` | `/api/godmode/v1/provision/terminate` | TerminateAccount |
| `POST` | `/api/godmode/v1/provision/change_package` | ChangePackage |
| `POST` | `/api/godmode/v1/provision/sso` | Launch BrandForge / View Workspace |

> The `/provision/status` endpoint is optional. If unavailable, the client area dashboard degrades gracefully — credits and workspace sections are hidden but all other functionality continues normally.

---

## Addon Admin Features

`Admin → Addons → BrandForge Package Sync` provides:

- **Setup status** — colored indicator dots for: API credentials, server record, packages synced, products created
- **One-Click Setup** — fully automated wizard (server + packages + products in one click)
- **Sync All** — pull latest packages from Godmode
- **Per-package controls** — Auto Create product, Link to existing product, or Unlink
- **Reset Everything** — clears all plugin data and recreates tables (no phpMyAdmin needed)

---

## License

Proprietary — BrandForge. All rights reserved.
