# Register and login with Sanctum (this project)

Purpose: align the **first-party SPA** pattern (Vue later, vanilla JavaScript now) with how this backend is already wired. Target stack: **Laravel API** (`routes/api.php`, prefix `/api`) + **`statefulApi()`** in `bootstrap/app.php` + **Sanctum**.

---

## What you have today

| Piece | Location / note |
|--------|------------------|
| Sanctum package | `composer.json` → `laravel/sanctum` |
| Stateful API (session + CSRF on “first-party” API requests) | `bootstrap/app.php` → `$middleware->statefulApi()` |
| CSRF cookie route | `GET /sanctum/csrf-cookie` (registered by Sanctum) |
| CORS for API + CSRF | `config/cors.php` — `paths` include `api/*` and `sanctum/csrf-cookie`; `supports_credentials` is `true` |
| `User` + API tokens | `app/Models/User.php` → `HasApiTokens` |
| Register | `POST /api/v1/register` → `RegisterController` → `RegisterUserAction` → `UserResource` (201) |
| Login (session) | `POST /api/v1/login` (with `web` middleware) → session cookie for SPAs. |
| PAT (Postman) | `POST /api/v1/access-token` → `IssueAccessTokenController` → JSON `{ token, token_type, user }` — **no cookies / no CSRF**. |
| Me | `GET /api/v1/me` → `auth:sanctum` (session **or** Bearer). |
| Logout (API) | `POST /api/v1/logout` → `auth:sanctum` only; revokes current PAT; clears session if one exists. |
| Logout (Blade) | `POST /logout` (`routes/web.php`) → same `LogoutUserAction` + redirect `/`. |

Register validation (for contract tests): `RegisterUserRequest` — `first_name`, `last_name`, `email`, `password` + `password_confirmation`, optional `phone`, `bio`, `city`, `avatar_media_id`; `status` is **prohibited** on public register.

---

## Recommended strategy: **one primary flow (cookies) + optional PAT for tooling**

### A. First-party SPA (cookies) — use for Vue and for **browser** JS tests

Sanctum treats requests from **stateful domains** as using the **`web`** session guard (`config/sanctum.php` → `'guard' => ['web']`). The browser stores the session cookie; the **XSRF-TOKEN** cookie is exposed (not HTTP-only) so JavaScript can send **`X-XSRF-TOKEN`** on mutating requests.

**Order of operations**

1. **Register** (optional first step) — `POST /api/v1/register` with JSON. Session is *not* required for this route as implemented today.
2. **CSRF** — `GET /sanctum/csrf-cookie` with `credentials: 'include'` so Laravel sets **encryption key / CSRF** cookies used on subsequent writes.
3. **Login** (to add) — e.g. `POST /api/v1/login` with `email`, `password`. Handler should call `Auth::guard('web')->attempt(...)` (or session login in the same spirit). Respond with **`UserResource`** (or minimal JSON). Success should establish a **session cookie** on the API host.
4. **Authenticated APIs** — e.g. `GET /api/v1/me` behind `middleware('auth:sanctum')`. From the browser, call with **`credentials: 'include'`** and **CSRF header** on non-GET requests.
5. **Logout** (to add) — e.g. `POST /api/v1/logout` — `Auth::guard('web')->logout()` + session invalidation, `UserResource` or 204.

**Vanilla JavaScript sketch** (run from a page whose **origin** is listed in `SANCTUM_STATEFUL_DOMAINS`, e.g. Vite `http://localhost:5173`; for quick tests you can also serve a static `public/test-auth.html` **same host as the API** so origin matches `127.0.0.1:8000`):

```javascript
const base = 'http://127.0.0.1:8000'; // same host as API when testing without Vite
const api = `${base}/api/v1`;

function xsrfHeader() {
  const m = document.cookie.match(/XSRF-TOKEN=([^;]+)/);
  if (!m) return {};
  return { 'X-XSRF-TOKEN': decodeURIComponent(m[1]) };
}

await fetch(`${base}/sanctum/csrf-cookie`, { method: 'GET', credentials: 'include' });

const reg = await fetch(`${api}/register`, {
  method: 'POST',
  credentials: 'include',
  headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', ...xsrfHeader() },
  body: JSON.stringify({
    first_name: 'A',
    last_name: 'B',
    email: 'a+b@example.com',
    password: 'password1',
    password_confirmation: 'password1',
  }),
});

await fetch(`${api}/login`, {
  method: 'POST',
  credentials: 'include',
  headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', ...xsrfHeader() },
  body: JSON.stringify({ email: 'a+b@example.com', password: 'password1' }),
});

const me = await fetch(`${api}/me`, { credentials: 'include', headers: { Accept: 'application/json' } });
```

**Environment**

- Set **`SANCTUM_STATEFUL_DOMAINS`** in `.env` to every host:port your **frontend** uses (comma-separated, no scheme), e.g. `localhost,localhost:5173,127.0.0.1,127.0.0.1:8000`.  
  Defaults in `config/sanctum.php` include `localhost:3000` but **not** `localhost:5173` unless you add it.

- **`SESSION_DOMAIN`**: keep `null` for local single-host tests; for production subdomains, set the shared cookie domain per Laravel docs.

- **CORS + credentials**: when the SPA origin is not the same as the API, **`Access-Control-Allow-Origin` cannot be `*`** with credentials. Prefer an explicit allowlist (your real Vite / staging origins) in `config/cors.php` once you leave “open dev” mode.

---

### B. Personal access tokens (Bearer) — **Postman / scripts** without cookies

**1. Mint a token** (no `sanctum/csrf-cookie`, no `X-XSRF-TOKEN`):

```http
POST /api/v1/access-token
Content-Type: application/json
Accept: application/json

{
  "email": "you@example.com",
  "password": "your-password",
  "device_name": "postman"
}
```

**200** body shape:

```json
{
  "token": "1|xxxxxxxx…",
  "token_type": "Bearer",
  "user": { … }
}
```

Copy `token` (the whole string including any `n|` prefix).

**2. Call protected routes** with only the header (no cookie jar required):

```http
GET /api/v1/me
Authorization: Bearer 1|xxxxxxxx…
Accept: application/json
```

**3. Logout** (optional — revokes that PAT when authenticated via Bearer):

```http
POST /api/v1/logout
Authorization: Bearer 1|xxxxxxxx…
Accept: application/json
```

`POST /api/v1/logout` uses only `auth:sanctum` (no `web` stack), so **Bearer-only Postman calls work** without CSRF. The Blade **Logout** link still posts to **`POST /logout`** on the web stack (`routes/web.php`).

**Security:** treat PATs like passwords; use HTTPS in non-local environments. Prefer **session login** for your own first-party SPA in the browser.

---

## Backend pieces to add (minimal contract)

**Done:** `POST /api/v1/login`, `POST /api/v1/access-token`, `GET /api/v1/me`, `POST /api/v1/logout` (see `routes/api.php` and `App\Http\Controllers\Api\V1\Auth\`).

**Optional next steps**

1. Rate limit `login` / `register` more tightly if needed.
2. Restrict `access-token` (IP allowlist, `APP_ENV`, or separate guard) if you expose non-local APIs.

Mount under the same `Route::prefix('v1')` group in `routes/api.php`. Do **not** put CSRF-only logic in `RegisterUserAction`; keep session login in a dedicated action or small controller if you prefer.

---

## Testing matrix (before Vue)

| Goal | How |
|------|-----|
| Register API shape | `curl` / Bruno → `POST /api/v1/register` + `Accept: application/json` |
| Cookie login + CSRF | Small HTML page or inline script on a **stateful** origin + `fetch(..., { credentials: 'include' })` |
| Signed-in API | After login, `GET /api/v1/me` with credentials |
| No browser cookies | Tinker: `$user->createToken('cli')` → Bearer on `/api/v1/me` |
| Regression | Pest feature test: `Sanctum::actingAs($user)` or real login + assert JSON |

---

## Same-origin vs cross-origin

- **Same origin** (e.g. static file under `public/` on `http://127.0.0.1:8000`): simplest cookie behavior; small friction for quick JS checks.
- **Cross origin** (Vite `5173`, API `8000`): requires correct **`SANCTUM_STATEFUL_DOMAINS`**, CORS allowlist, and **`credentials: 'include'`** everywhere — same rules apply when you move to Vue.

---

## Relationship to Vue (later)

Vue (Axios or `fetch`) will mirror the same sequence: **`/sanctum/csrf-cookie`** → **login** → store nothing sensitive in `localStorage` if you rely on **httpOnly session cookies**; read **XSRF-TOKEN** for the header on POST/PUT/PATCH/DELETE. Bearer tokens are optional (e.g. mobile or third-party clients).

This document is descriptive; implement logout/me when you are ready to wire the first protected screen or JS test harness.
