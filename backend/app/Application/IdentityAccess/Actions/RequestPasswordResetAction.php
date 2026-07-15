<?php

namespace App\Application\IdentityAccess\Actions;

use App\Application\IdentityAccess\DTOs\RequestPasswordResetData;
use App\Domain\IdentityAccess\Repositories\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Password;

final class RequestPasswordResetAction
{
    public function __construct(
        private readonly UserRepositoryInterface $users,
    ) {}

    public function execute(RequestPasswordResetData $data): void
    {
        $user = $this->users->findByEmail($data->email);

        if (! $user instanceof User) {
            return;
        }

        $token = Password::broker('users')->createToken($user);

        $user->sendPasswordResetNotification($token);
    }
}
