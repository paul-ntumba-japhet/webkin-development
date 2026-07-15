<?php

namespace App\Application\IdentityAccess\Actions;

use App\Application\IdentityAccess\DTOs\RemoveRolesFromUserData;
use App\Domain\IdentityAccess\Repositories\RoleRepositoryInterface;
use App\Domain\IdentityAccess\Repositories\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;

final class RemoveRolesFromUserAction
{
    public function __construct(
        private readonly UserRepositoryInterface $users,
        private readonly RoleRepositoryInterface $roles,
    ) {}

    public function execute(User $actor, RemoveRolesFromUserData $data): User
    {
        $user = $this->users->findById($data->userId);

        if ($user === null) {
            throw ValidationException::withMessages([
                'user_id' => [trans('validation.exists', ['attribute' => 'user'])],
            ]);
        }

        Gate::forUser($actor)->authorize('update', $user);

        $roleIds = $data->roleIds;

        if ($roleIds === []) {
            throw ValidationException::withMessages([
                'role_ids' => [trans('validation.min.array', ['attribute' => 'roles', 'min' => 1])],
            ]);
        }

        $user->loadMissing('roles');
        $currentRoleIds = $user->roles->pluck('id')->all();

        foreach ($roleIds as $roleId) {
            if ($this->roles->findById($roleId) === null) {
                throw ValidationException::withMessages([
                    'role_ids' => [trans('validation.exists', ['attribute' => 'role ids'])],
                ]);
            }

            if (! in_array($roleId, $currentRoleIds, true)) {
                throw ValidationException::withMessages([
                    'role_ids' => [__('users.role_not_assigned')],
                ]);
            }
        }

        $remainingRoleIds = array_values(array_diff($currentRoleIds, $roleIds));

        if ($remainingRoleIds === []) {
            throw ValidationException::withMessages([
                'role_ids' => [__('users.role_cannot_remove_all')],
            ]);
        }

        $this->roles->detachUserRoles($user, $roleIds);

        return $user->fresh(['roles']);
    }
}
