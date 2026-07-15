<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register (API test)</title>
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
    <x-auth-menu current="register" />

    <h1>Register</h1>
    <p class="hint">Calls <code>POST /api/v1/register</code> with cookies + CSRF. Use the same host as the app (e.g. <code>http://127.0.0.1:8000/register</code>).</p>

    <button type="button" id="csrf">Get CSRF cookie</button>

    <form id="f" autocomplete="off">
        <label for="first_name">first_name</label>
        <input id="first_name" name="first_name" required value="Test">

        <label for="last_name">last_name</label>
        <input id="last_name" name="last_name" required value="User">

        <label for="email">email</label>
        <input id="email" name="email" type="email" required value="">

        <label for="phone">phone <span style="font-weight:400;color:#666">(optional)</span></label>
        <input id="phone" name="phone" type="tel" maxlength="50" value="" placeholder="+1 555 0100">

        <label for="password">password</label>
        <input id="password" name="password" type="password" required minlength="8" value="">

        <label for="password_confirmation">password_confirmation</label>
        <input id="password_confirmation" name="password_confirmation" type="password" required minlength="8" value="">

        <button type="submit">Register</button>
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
                first_name: document.getElementById('first_name').value,
                last_name: document.getElementById('last_name').value,
                email: document.getElementById('email').value,
                password: document.getElementById('password').value,
                password_confirmation: document.getElementById('password_confirmation').value,
            };
            const phone = document.getElementById('phone').value.trim();
            if (phone) {
                payload.phone = phone;
            }
            const res = await fetch('/api/v1/register', {
                method: 'POST',
                credentials: 'same-origin',
                headers: {
                    'Content-Type': 'application/json',
                    Accept: 'application/json',
                    ...xsrfHeaders(),
                },
                body: JSON.stringify(payload),
            });
            const text = await res.text();
            out.textContent = `${res.status} ${res.statusText}\n\n${text}`;
        });
    </script>
</body>
</html>
