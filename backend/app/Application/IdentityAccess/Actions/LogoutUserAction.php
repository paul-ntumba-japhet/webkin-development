<?php

namespace App\Application\IdentityAccess\Actions;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

final class LogoutUserAction
{
    public function execute(Request $request): void
    {
        $user = $request->user();

        if ($user !== null && $user->currentAccessToken() !== null) {
            $user->currentAccessToken()->delete();
        }

        Auth::guard('web')->logout();

        if ($request->hasSession()) {
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }
    }
}
