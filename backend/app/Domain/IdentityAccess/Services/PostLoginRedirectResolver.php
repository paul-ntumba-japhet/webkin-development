<?php

namespace App\Domain\IdentityAccess\Services;

use App\Domain\IdentityAccess\Enums\RoleSlug;
use App\Models\User;
use Symfony\Component\HttpKernel\Exception\HttpException;

final class PostLoginRedirectResolver
{
    public const STUDENT_HOME = '/user';

    public const ADMIN_HOME = '/admin';

    public function pathFor(User $user): string
    {
        if ($user->hasAnyRole(RoleSlug::adminAreaSlugs())) {
            return self::ADMIN_HOME;
        }

        if ($user->hasAnyRole(RoleSlug::editorAreaSlugs())) {
            return self::ADMIN_HOME;
        }

        if ($user->hasRole(RoleSlug::Student)) {
            return self::STUDENT_HOME;
        }

        throw new HttpException(403, 'Aucun rôle ne définit de tableau de bord.');
    }
}
