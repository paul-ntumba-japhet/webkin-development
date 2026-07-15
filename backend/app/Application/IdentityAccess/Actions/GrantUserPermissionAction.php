<?php

namespace App\Application\IdentityAccess\Actions;

use App\Application\IdentityAccess\DTOs\GrantUserPermissionData;
use App\Domain\IdentityAccess\Repositories\PermissionRepositoryInterface;
use App\Domain\IdentityAccess\Repositories\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Validation\ValidationException;

final class GrantUserPermissionAction
{
    public function __construct(
        private readonly UserRepositoryInterface $users,
        private readonly PermissionRepositoryInterface $permissions,
    ) {}

    public function execute(GrantUserPermissionData $data): User
    {
        $user = $this->users->findById($data->userId);

        if ($user === null) {
            throw ValidationException::withMessages([
                'user_id' => [trans('validation.exists', ['attribute' => 'user'])],
            ]);
        }

        if ($this->permissions->findById($data->permissionId) === null) {
            throw ValidationException::withMessages([
                'permission_id' => [trans('validation.exists', ['attribute' => 'permission'])],
            ]);
        }

        $this->permissions->grantUserPermission($user, $data->permissionId, $data->granted);

        return $user->fresh(['roles', 'permissions']);
    }
}
