<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User — {{ config('app.name') }}</title>
    <style>
        body { font-family: system-ui, sans-serif; margin: 0; padding: 2rem 1.25rem; color: #1a1a1a; background: #fafafa; line-height: 1.5; }
        main { max-width: 36rem; margin: 0 auto; }
        h1 { font-size: 1.25rem; font-weight: 600; margin: 0 0 0.5rem; }
        p { margin: 0 0 1rem; color: #444; font-size: 0.95rem; }
        .card { background: #fff; border: 1px solid #e5e5e5; border-radius: 8px; padding: 1.25rem; margin-top: 1rem; }
        code { font-size: 0.85em; background: #f0f0f0; padding: 0.15em 0.4em; border-radius: 4px; }
    </style>
</head>
<body>
    <main>
        <x-auth-menu current="user" />
        <h1>User dashboard</h1>
        <p>Signed in as <code>{{ auth()->user()->email }}</code></p>
        <div class="card">
            <p style="margin:0">Placeholder for learner-facing tools and links.</p>
        </div>
    </main>
</body>
</html>
