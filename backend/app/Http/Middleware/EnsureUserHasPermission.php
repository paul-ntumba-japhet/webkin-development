<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final class EnsureUserHasPermission
{
    /**
     * @param  \Closure(Request): Response  $next
     * @param  string  ...$permissions  Permission slugs, e.g. programs.publish
     */
    public function handle(Request $request, Closure $next, string ...$permissions): Response
    {
        $user = $request->user();

        if ($user === null) {
            abort(403);
        }

        foreach ($permissions as $permission) {
            if (! $user->hasPermission($permission)) {
                abort(403);
            }
        }

        return $next($request);
    }
}
