<?php

namespace App\Application\IdentityAccess\Actions;

use App\Application\IdentityAccess\DTOs\ResetPasswordData;
use App\Domain\IdentityAccess\Repositories\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

final class ResetPasswordAction
{
    public function __construct(
        private readonly UserRepositoryInterface $users,
    ) {}

    public function execute(ResetPasswordData $data): void
    {
        $status = Password::broker('users')->reset(
            [
                'email' => $data->email,
                'password' => $data->password,
                'password_confirmation' => $data->passwordConfirmation,
                'token' => $data->token,
            ],
            function (User $user, string $password): void {
                $this->users->update($user, ['password' => $password]);
            },
        );

        if ($status !== Password::PASSWORD_RESET) {
            throw ValidationException::withMessages([
                'email' => [__($status)],
            ]);
        }
    }
}
