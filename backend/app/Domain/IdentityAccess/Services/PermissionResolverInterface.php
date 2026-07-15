<?php

namespace App\Domain\IdentityAccess\Services;

use App\Domain\IdentityAccess\Enums\PermissionSlug;
use App\Models\User;

interface PermissionResolverInterface
{
    public function hasPermission(User $user, PermissionSlug|string $permission): bool;

    /** @return list<string> */
    public function permissionSlugsFor(User $user): array;
}
