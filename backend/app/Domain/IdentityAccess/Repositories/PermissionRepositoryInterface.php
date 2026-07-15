<?php

namespace App\Domain\IdentityAccess\Repositories;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;

interface PermissionRepositoryInterface
{
    public function findById(int $id): ?Permission;

    public function findBySlug(string $slug): ?Permission;

    /**
     * @param  array<int>  $permissionIds
     */
    public function syncRolePermissions(Role $role, array $permissionIds): void;

    public function grantUserPermission(User $user, int $permissionId, bool $granted = true): void;
}
