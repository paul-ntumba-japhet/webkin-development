<?php

namespace App\Infrastructure\Persistence\Repositories\IdentityAccess;

use App\Domain\IdentityAccess\Repositories\PermissionRepositoryInterface;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;

final class EloquentPermissionRepository implements PermissionRepositoryInterface
{
    public function findById(int $id): ?Permission
    {
        return Permission::query()->find($id);
    }

    public function findBySlug(string $slug): ?Permission
    {
        return Permission::query()->where('slug', $slug)->first();
    }

    public function syncRolePermissions(Role $role, array $permissionIds): void
    {
        $role->permissions()->sync($permissionIds);
    }

    public function grantUserPermission(User $user, int $permissionId, bool $granted = true): void
    {
        $pivot = [
            'granted' => $granted,
            'assigned_at' => now(),
        ];

        if ($user->permissions()->where('permissions.id', $permissionId)->exists()) {
            $user->permissions()->updateExistingPivot($permissionId, $pivot);

            return;
        }

        $user->permissions()->attach($permissionId, $pivot);
    }
}
