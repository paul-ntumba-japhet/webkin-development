<?php

namespace App\Application\IdentityAccess\Actions;

use App\Application\IdentityAccess\DTOs\RegisterUserData;
use App\Domain\IdentityAccess\Repositories\RoleRepositoryInterface;
use App\Domain\IdentityAccess\Repositories\UserRepositoryInterface;
use App\Domain\IdentityAccess\Services\PasswordHasherServiceInterface;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use RuntimeException;

final class RegisterUserAction
{
    private const DEFAULT_STUDENT_ROLE_SLUG = 'student';

    public function __construct(
        private readonly UserRepositoryInterface $users,
        private readonly RoleRepositoryInterface $roles,
        private readonly PasswordHasherServiceInterface $passwordHasher,
    ) {}

    public function execute(RegisterUserData $data): User
    {
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

            $user = $this->users->create($attributes);

            $studentRole = $this->roles->findBySlug(self::DEFAULT_STUDENT_ROLE_SLUG);
            if ($studentRole === null) {
                throw new RuntimeException(
                    sprintf('Default role with slug "%s" does not exist. Seed roles before registration.', self::DEFAULT_STUDENT_ROLE_SLUG),
                );
            }

            $this->roles->syncUserRoles($user, [$studentRole->id]);

            return $user->fresh(['roles']);
        });
    }
}
