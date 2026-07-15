<?php

namespace App\Application\IdentityAccess\Actions;

use App\Application\IdentityAccess\DTOs\CreateUserData;
use App\Domain\IdentityAccess\Repositories\RoleRepositoryInterface;
use App\Domain\IdentityAccess\Repositories\UserRepositoryInterface;
use App\Domain\IdentityAccess\Services\PasswordHasherServiceInterface;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;
use RuntimeException;

final class CreateUserAction
{
    private const DEFAULT_STUDENT_ROLE_SLUG = 'student';

    public function __construct(
        private readonly UserRepositoryInterface $users,
        private readonly RoleRepositoryInterface $roles,
        private readonly PasswordHasherServiceInterface $passwordHasher,
    ) {}

    public function execute(User $actor, CreateUserData $data): User
    {
        Gate::forUser($actor)->authorize('create', User::class);

        if ($this->users->findByEmail($data->email) !== null) {
            throw ValidationException::withMessages([
                'email' => [trans('validation.unique', ['attribute' => 'email'])],
            ]);
        }

        return DB::transaction(function () use ($data): User {
            $attributes = [
                'first_name' => $data->firstName,
                'last_name' => $data->lastName,
                'email' => $data->email,
                'phone' => $data->phone,
                'bio' => $data->bio,
                'city' => $data->city,
                'avatar_media_id' => $data->avatarMediaId,
                'status' => $data->status->value,
                'password' => $this->passwordHasher->hash($data->password),
            ];

            if ($data->emailVerifiedAt !== null) {
                $attributes['email_verified_at'] = $data->emailVerifiedAt;
            }

            $user = $this->users->create($attributes);

            $roleIds = $data->roleIds;
            if ($roleIds === null) {
                $studentRole = $this->roles->findBySlug(self::DEFAULT_STUDENT_ROLE_SLUG);
                if ($studentRole === null) {
                    throw new RuntimeException(
                        sprintf('Default role with slug "%s" does not exist. Seed roles before creating users.', self::DEFAULT_STUDENT_ROLE_SLUG),
                    );
                }
                $roleIds = [$studentRole->id];
            } else {
                $roleIds = array_values(array_unique(array_map(intval(...), $roleIds)));
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
            }

            $this->roles->syncUserRoles($user, $roleIds);

            return $user->fresh(['roles']);
        });
    }
}
