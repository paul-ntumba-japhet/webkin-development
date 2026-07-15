<?php

namespace App\Application\IdentityAccess\Actions;

use App\Application\IdentityAccess\DTOs\AssignPermissionsToRoleData;
use App\Domain\IdentityAccess\Repositories\PermissionRepositoryInterface;
use App\Domain\IdentityAccess\Repositories\RoleRepositoryInterface;
use App\Models\Role;
use Illuminate\Validation\ValidationException;

final class AssignPermissionsToRoleAction
{
    public function __construct(
        private readonly RoleRepositoryInterface $roles,
        private readonly PermissionRepositoryInterface $permissions,
    ) {}

    public function execute(AssignPermissionsToRoleData $data): Role
    {
        $role = $this->roles->findById($data->roleId);

        if ($role === null) {
            throw ValidationException::withMessages([
                'role_id' => [trans('validation.exists', ['attribute' => 'role'])],
            ]);
        }

        $permissionIds = array_values(array_unique($data->permissionIds));

        foreach ($permissionIds as $permissionId) {
            if ($this->permissions->findById($permissionId) === null) {
                throw ValidationException::withMessages([
                    'permission_ids' => [trans('validation.exists', ['attribute' => 'permission ids'])],
                ]);
            }
        }

        $this->permissions->syncRolePermissions($role, $permissionIds);

        return $role->fresh(['permissions']);
    }
}
