# BrandForge WHMCS Plugin

WHMCS provisioning and addon module that connects WHMCS product lifecycle events to the [BrandForge](https://brandforge.software) Godmode API — automating workspace creation, suspension, termination, package changes, and SSO login for customers.

---

## Modules

| Module | Type | Purpose |
|---|---|---|
| `modules/servers/brandforge` | Server/Provisioning | Handles the full service lifecycle and client area dashboard |
| `modules/addons/brandforge` | Addon | Admin UI for syncing Godmode packages with WHMCS products |

---

## Requirements

- WHMCS 8.x
- PHP 8.0+
- cURL extension
- A BrandForge Godmode API key

---

## Installation

1. Copy the `modules/` folder into the root of your WHMCS installation:

```
/path/to/whmcs/
└── modules/
    ├── servers/brandforge/
    └── addons/brandforge/
```

2. **Activate the Addon module**
   `Admin → Setup → Addon Modules → BrandForge Package Sync → Activate`
   - Godmode API URL: `https://brandforge.software`
   - Godmode API Key: your bearer token

   This creates two database tables: `mod_brandforge_packages` and `mod_brandforge_services`.

3. **Add a Server record**
   `Admin → Setup → Servers → Add Server`
   - Module: `BrandForge`
   - Hostname: `https://brandforge.software`
   - Password: your Godmode API key
   - Click **Test Connection** to verify

4. **Sync packages**
   `Admin → Addons → BrandForge Package Sync → Sync All`

   Fetches all packages from the Godmode API and lists them. For each package, either click **Auto Create** to generate a new WHMCS product automatically, or use the **Link** dropdown to attach an existing product.

5. **Assign server to product**
   `Admin → Products/Services → [Product] → Module Settings`
   - Set Module Name to `BrandForge`
   - Assign the server record created in step 3

---

## Configuration Options

Set per-product under **Module Settings**:

| Option | Description | Default |
|---|---|---|
| Godmode API URL | Base URL for the Godmode API | `https://brandforge.software` |
| Godmode API Key | Bearer token for authentication | — |
| Debug Mode | Log all API calls to the WHMCS Module Log | Off |
| Brand Name | Label shown in the client area (reseller branding) | `BrandForge` |
| Brand Primary Color | Hex accent color for buttons | `#6366f1` |

---

## Service Lifecycle

| WHMCS Event | Godmode Endpoint | What happens |
|---|---|---|
| Order activated | `POST /provision/create` | Workspace provisioned; `service_id` stored |
| Service suspended | `POST /provision/suspend` | Workspace access disabled |
| Service unsuspended | `POST /provision/unsuspend` | Workspace access restored |
| Service terminated | `POST /provision/terminate` | Workspace deprovisioned |
| Package upgraded | `POST /provision/change_package` | Package updated on the subscription |

---

## Client Area

Customers see a branded dashboard on their service page:

- Subscription status, package name, subscription ID, workspace ID
- **Launch BrandForge** — triggers an SSO call (`POST /provision/sso`), receives a one-time login URL, and redirects the customer directly into their workspace
- **Upgrade Plan** — links to the WHMCS upgrade flow
- **View Workspace** — SSO redirect targeted to the workspace view

Customers never manually log into BrandForge.

---

## Database Tables

**`mod_brandforge_packages`** — package mapping

| Column | Type | Description |
|---|---|---|
| `id` | int | Primary key |
| `godmode_package_id` | varchar | Godmode's package identifier |
| `godmode_slug` | varchar | Package slug |
| `godmode_name` | varchar | Display name from Godmode |
| `whmcs_product_id` | int | Linked WHMCS product (nullable) |
| `created_at` | timestamp | |
| `updated_at` | timestamp | |

**`mod_brandforge_services`** — provisioned service records

| Column | Type | Description |
|---|---|---|
| `id` | int | Primary key |
| `whmcs_client_id` | int | WHMCS client ID |
| `whmcs_service_id` | int | WHMCS service ID (unique) |
| `whmcs_product_id` | int | WHMCS product ID |
| `godmode_service_id` | varchar | Godmode service identifier (UUID returned by /provision/create) |
| `godmode_workspace_id` | varchar | Godmode workspace identifier |
| `godmode_user_id` | varchar | Godmode user identifier |
| `created_at` | timestamp | |
| `updated_at` | timestamp | |

---

## Project Structure

```
modules/
├── servers/brandforge/
│   ├── brandforge.php           # Module entry point — all WHMCS hooks
│   ├── lib/
│   │   ├── GodmodeClient.php    # HTTP client (Bearer auth, timeout, error handling)
│   │   ├── SsoHandler.php       # SSO login URL generation
│   │   ├── ServiceRepository.php# mod_brandforge_services CRUD
│   │   ├── PackageLookup.php    # Product → package ID resolution
│   │   ├── Mapper.php           # WHMCS params → API payloads
│   │   ├── Logger.php           # logModuleCall() wrapper
│   │   └── Exceptions.php       # GodmodeApiException hierarchy
│   └── templates/
│       ├── clientarea.tpl       # Customer service dashboard
│       └── sso_redirect.tpl     # SSO auto-redirect page
│
└── addons/brandforge/
    ├── brandforge.php           # Addon entry point + admin page
    └── lib/
        ├── PackageRepository.php# mod_brandforge_packages CRUD
        ├── PackageSync.php      # Sync orchestration
        └── WhmcsProductManager.php # WHMCS product creation/update
```

---

## Reseller Branding

Set **Brand Name** and **Brand Primary Color** in the product's Module Settings to white-label the client area dashboard for your brand. Both values are passed as Smarty variables (`{$brand_name}`, `{$brand_color}`) into the templates.

---

## Godmode API Endpoints Used

| Method | Path | Used by |
|---|---|---|
| `GET` | `/api/godmode/v1/provision/ping` | Test Connection |
| `GET` | `/api/godmode/v1/provision/packages` | Package Sync |
| `POST` | `/api/godmode/v1/provision/create` | CreateAccount |
| `POST` | `/api/godmode/v1/provision/suspend` | SuspendAccount |
| `POST` | `/api/godmode/v1/provision/unsuspend` | UnsuspendAccount |
| `POST` | `/api/godmode/v1/provision/terminate` | TerminateAccount |
| `POST` | `/api/godmode/v1/provision/change_package` | ChangePackage |
| `POST` | `/api/godmode/v1/provision/sso` | Launch BrandForge / View Workspace |

---

## License

Proprietary — BrandForge. All rights reserved.
