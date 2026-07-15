@props([
    'current' => null,
])

<nav class="auth-menu" aria-label="Authentication">
    <style>
        .auth-menu {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem 1rem;
            align-items: center;
            margin-bottom: 1.25rem;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid #ddd;
            font-size: 0.95rem;
        }
        .auth-menu a,
        .auth-menu__logout-link {
            color: #0969da;
            text-decoration: none;
            cursor: pointer;
        }
        .auth-menu a:hover,
        .auth-menu a[aria-current="page"],
        .auth-menu__logout-link:hover {
            text-decoration: underline;
        }
    </style>
    @if (Route::has('register'))
        <a href="{{ route('register') }}" @if ($current === 'register') aria-current="page" @endif>Register</a>
    @endif
    @if (Route::has('login'))
        <a href="{{ route('login') }}" @if ($current === 'login') aria-current="page" @endif>Login</a>
    @endif
    @auth
        @if (Route::has('user.dashboard') && auth()->user()->isStudent())
            <a href="{{ route('user.dashboard') }}" @if ($current === 'user') aria-current="page" @endif>Apprenant</a>
        @endif
        @if (Route::has('admin.dashboard') && (auth()->user()->isAdminAreaUser() || auth()->user()->isEditor()))
            <a href="{{ route('admin.dashboard') }}" @if ($current === 'admin') aria-current="page" @endif>Admin</a>
        @endif
        @if (Route::has('logout'))
            <form method="POST" action="{{ route('logout') }}" style="display: inline; margin: 0">
                @csrf
                <a href="#" class="auth-menu__logout-link" role="button"
                   onclick="event.preventDefault(); this.closest('form').requestSubmit();">Logout</a>
            </form>
        @endif
    @endauth
</nav>
