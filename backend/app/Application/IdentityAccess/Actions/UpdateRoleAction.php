<?php

namespace App\Application\IdentityAccess\Actions;

use App\Application\IdentityAccess\DTOs\UpdateRoleData;
use App\Domain\IdentityAccess\Enums\PermissionSlug;
use App\Domain\IdentityAccess\Repositories\RoleRepositoryInterface;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Validation\ValidationException;

final class UpdateRoleAction
{
    public function __construct(
        private readonly RoleRepositoryInterface $roles,
    ) {}

    public function execute(User $actor, UpdateRoleData $data): Role
    {
        if (! $actor->hasPermission(PermissionSlug::UsersManage)) {
            throw new AuthorizationException;
        }

        $role = $this->roles->findById($data->roleId);

        if ($role === null) {
            throw ValidationException::withMessages([
                'role_id' => [trans('validation.exists', ['attribute' => 'role'])],
            ]);
        }

        if ($data->slug !== null) {
            $existing = $this->roles->findBySlug($data->slug);
            if ($existing !== null && $existing->id !== $role->id) {
                throw ValidationException::withMessages([
                    'slug' => [trans('validation.unique', ['attribute' => 'slug'])],
                ]);
            }
        }

        $attributes = $data->toArray();

        if ($attributes === []) {
            return $role;
        }

        return $this->roles->update($role, $attributes);
    }
}
