<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final class EnsureUserHasRole
{
    /**
     * @param  \Closure(Request): Response  $next
     * @param  string  ...$roles  Role slugs, e.g. admin,editor,super-admin
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        if ($user === null || ! $user->hasAnyRole($roles)) {
            abort(403);
        }

        return $next($request);
    }
}
