<?php

namespace App\Application\IdentityAccess\Actions;

use App\Application\IdentityAccess\DTOs\RegisterUserData;
use App\Domain\IdentityAccess\Repositories\UserRepositoryInterface;
use App\Domain\IdentityAccess\Services\PasswordHasherServiceInterface;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

final class RegisterUserAction
{
    public function __construct(
        private readonly UserRepositoryInterface $users,
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

            return $this->users->create($attributes);
        });
    }
}
