<?php

namespace App\Http\Requests\Concerns;

use App\Domain\IdentityAccess\Enums\PermissionSlug;

trait AuthorizesWithPermission
{
    protected function userHasPermission(PermissionSlug $permission): bool
    {
        return $this->user()?->hasPermission($permission) ?? false;
    }
}
