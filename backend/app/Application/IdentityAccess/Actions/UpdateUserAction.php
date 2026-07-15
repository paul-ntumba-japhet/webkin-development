<?php

namespace App\Application\IdentityAccess\Actions;

use App\Application\IdentityAccess\DTOs\UpdateUserData;
use App\Domain\IdentityAccess\Repositories\RoleRepositoryInterface;
use App\Domain\IdentityAccess\Repositories\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;

final class UpdateUserAction
{
    public function __construct(
        private readonly UserRepositoryInterface $users,
        private readonly RoleRepositoryInterface $roles,
    ) {}

    public function execute(User $actor, UpdateUserData $data): User
    {
        $user = $this->users->findById($data->userId);

        if ($user === null) {
            throw ValidationException::withMessages([
                'user_id' => [trans('validation.exists', ['attribute' => 'user'])],
            ]);
        }

        Gate::forUser($actor)->authorize('update', $user);

        if ($data->email !== null) {
            $existing = $this->users->findByEmail($data->email);
            if ($existing !== null && $existing->id !== $user->id) {
                throw ValidationException::withMessages([
                    'email' => [trans('validation.unique', ['attribute' => 'email'])],
                ]);
            }
        }

        return DB::transaction(function () use ($data, $user): User {
            $attributes = $data->userAttributes();

            if ($attributes !== []) {
                $user = $this->users->update($user, $attributes);
            }

            if (! $user->canAuthenticate()) {
                $user->revokeAllAccessTokens();
            }

            if ($data->roleIds !== null) {
                $roleIds = array_values(array_unique(array_map(intval(...), $data->roleIds)));

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
            }

            return $user->fresh(['roles']);
        });
    }
}
