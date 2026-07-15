<?php

namespace App\Policies;

use App\Domain\IdentityAccess\Enums\PermissionSlug;
use App\Models\User;
use App\Policies\Concerns\AuthorizesWithPermission;

final class UserPolicy
{
    use AuthorizesWithPermission;

    public function before(User $user, string $ability): ?bool
    {
        if ($this->allowsPermission($user, PermissionSlug::UsersManage)) {
            return true;
        }

        return null;
    }

    public function viewAny(User $user): bool
    {
        return $this->allowsPermission($user, PermissionSlug::UsersView);
    }

    public function view(User $user, User $model): bool
    {
        return $this->allowsPermission($user, PermissionSlug::UsersView);
    }

    public function create(User $user): bool
    {
        return $this->allowsPermission($user, PermissionSlug::UsersCreate);
    }

    public function update(User $user, User $model): bool
    {
        return $this->allowsPermission($user, PermissionSlug::UsersUpdate);
    }

    public function delete(User $user, User $model): bool
    {
        return $this->allowsPermission($user, PermissionSlug::UsersDelete);
    }
}
