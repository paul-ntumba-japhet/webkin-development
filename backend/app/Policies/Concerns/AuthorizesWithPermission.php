<?php

namespace App\Policies\Concerns;

use App\Domain\IdentityAccess\Enums\PermissionSlug;
use App\Models\User;

trait AuthorizesWithPermission
{
    protected function allowsPermission(?User $user, PermissionSlug $permission): bool
    {
        return $user?->hasPermission($permission) ?? false;
    }
}
