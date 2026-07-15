<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

final class EnsureUserAccountIsActive
{
    /**
     * @param  \Closure(Request): Response  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user === null || $user->canAuthenticate()) {
            return $next($request);
        }

        if ($user->currentAccessToken() !== null) {
            $user->currentAccessToken()->delete();
        }

        Auth::guard('web')->logout();

        if ($request->hasSession()) {
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        $message = $user->authenticationBlockedMessage();

        if ($request->expectsJson()) {
            return response()->json([
                'message' => $message,
            ], 403);
        }

        abort(403, $message);
    }
}
