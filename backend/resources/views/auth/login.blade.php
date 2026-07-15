<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login (API test)</title>
    <style>
        body { font-family: system-ui, sans-serif; max-width: 28rem; margin: 2rem auto; padding: 0 1rem; }
        label { display: block; margin: 0.65rem 0 0.2rem; font-size: 0.85rem; }
        input { width: 100%; padding: 0.45rem 0.5rem; box-sizing: border-box; }
        button { margin-top: 0.85rem; margin-right: 0.5rem; padding: 0.5rem 0.85rem; cursor: pointer; }
        pre { margin-top: 1rem; background: #111; color: #eee; padding: 1rem; border-radius: 6px; font-size: 0.8rem; white-space: pre-wrap; word-break: break-word; }
        .hint { font-size: 0.85rem; color: #555; margin-bottom: 1rem; }
    </style>
</head>
<body>
    <x-auth-menu current="login" />

    <h1>Login</h1>
    <p class="hint">Calls <code>POST /api/v1/login</code> with cookies + CSRF. On success you are redirected using <code>dashboard_path</code> from the API (same host as this page so the session cookie applies).</p>

    <button type="button" id="csrf">Get CSRF cookie</button>

    <form id="f" autocomplete="off">
        @csrf
        <x-auth-input name="email" type="email" required value="" />
        <x-auth-input name="password" type="password" required value="" />
        <x-auth-checkbox name="remember" />
        <x-auth-button type="submit">Login</x-auth-button>
    </form>

    <pre id="out"></pre>

    <script>
        const out = document.getElementById('out');

        function readCookie(name) {
            const m = document.cookie.match(new RegExp('(^|; )' + name.replace(/[.*+?^${}()|[\]\\]/g, '\\$&') + '=([^;]*)'));
            return m ? decodeURIComponent(m[2]) : '';
        }

        function xsrfHeaders() {
            const raw = readCookie('XSRF-TOKEN');
            return raw ? { 'X-XSRF-TOKEN': decodeURIComponent(raw) } : {};
        }

        /** Blade @csrf hidden input — Laravel also accepts this header for JSON fetch. */
        function csrfFromForm() {
            const el = document.querySelector('#f input[name="_token"]');
            return el && el.value ? { 'X-CSRF-TOKEN': el.value } : {};
        }

        document.getElementById('csrf').addEventListener('click', async () => {
            const res = await fetch('/sanctum/csrf-cookie', {
                method: 'GET',
                credentials: 'same-origin',
                headers: { Accept: 'application/json' },
            });
            out.textContent = `csrf-cookie: ${res.status} ${res.statusText}`;
        });

        document.getElementById('f').addEventListener('submit', async (e) => {
            e.preventDefault();
            const payload = {
                email: document.getElementById('email').value,
                password: document.getElementById('password').value,
                remember: document.getElementById('remember').checked,
            };
            try {
                const res = await fetch('/api/v1/login', {
                    method: 'POST',
                    credentials: 'same-origin',
                    headers: {
                        'Content-Type': 'application/json',
                        Accept: 'application/json',
                        ...csrfFromForm(),
                        ...xsrfHeaders(),
                    },
                    body: JSON.stringify(payload),
                });
                const text = await res.text();
                if (res.ok) {
                    let path = '/user';
                    try {
                        const json = JSON.parse(text);
                        path = json?.data?.dashboard_path ?? path;
                    } catch (_) { /* keep default */ }
                    window.location.assign(path);
                    return;
                }
                out.textContent = `${res.status} ${res.statusText}\n\n${text}`;
            } catch (err) {
                out.textContent = String(err);
            }
        });
    </script>
</body>
</html>
