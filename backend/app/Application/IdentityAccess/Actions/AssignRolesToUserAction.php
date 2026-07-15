<?php

namespace App\Application\IdentityAccess\Actions;

use App\Application\IdentityAccess\DTOs\AssignRolesToUserData;
use App\Domain\IdentityAccess\Repositories\RoleRepositoryInterface;
use App\Domain\IdentityAccess\Repositories\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;

final class AssignRolesToUserAction
{
    public function __construct(
        private readonly UserRepositoryInterface $users,
        private readonly RoleRepositoryInterface $roles,
    ) {}

    public function execute(User $actor, AssignRolesToUserData $data): User
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

        foreach ($roleIds as $roleId) {
            if ($this->roles->findById($roleId) === null) {
                throw ValidationException::withMessages([
                    'role_ids' => [trans('validation.exists', ['attribute' => 'role ids'])],
                ]);
            }
        }

        $this->roles->syncUserRoles($user, $roleIds);

        return $user->fresh(['roles']);
    }
}
