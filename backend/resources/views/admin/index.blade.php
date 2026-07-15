<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin — {{ config('app.name') }}</title>
    <style>
        body { font-family: system-ui, sans-serif; margin: 0; padding: 2rem 1.25rem; color: #1a1a1a; background: #f5f5f5; line-height: 1.5; }
        main { max-width: 36rem; margin: 0 auto; }
        h1 { font-size: 1.25rem; font-weight: 600; margin: 0 0 0.5rem; }
        p { margin: 0 0 1rem; color: #444; font-size: 0.95rem; }
        .card { background: #fff; border: 1px solid #e0e0e0; border-radius: 8px; padding: 1.25rem; margin-top: 1rem; }
        code { font-size: 0.85em; background: #eee; padding: 0.15em 0.4em; border-radius: 4px; }
        .badge { display: inline-block; font-size: 0.7rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.04em; color: #666; margin-left: 0.35rem; }
    </style>
</head>
<body>
    <main>
        <x-auth-menu current="admin" />
        <h1>Admin dashboard <span class="badge">local</span></h1>
        <p>Signed in as <code>{{ auth()->user()->email }}</code></p>
        <div class="card">
            <p style="margin:0">Placeholder for back-office screens and management links.</p>
        </div>
    </main>
</body>
</html>
