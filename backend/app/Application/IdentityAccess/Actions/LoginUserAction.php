<?php

namespace App\Application\IdentityAccess\Actions;

use App\Application\IdentityAccess\DTOs\LoginData;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

final class LoginUserAction
{
    public function execute(LoginData $data): User
    {
        if (! Auth::guard('web')->attempt($data->credentials(), $data->remember)) {
            throw ValidationException::withMessages([
                'email' => [trans('auth.failed')],
            ]);
        }

        /** @var User $user */
        $user = Auth::guard('web')->user();

        if (! $user->canAuthenticate()) {
            Auth::guard('web')->logout();
            request()->session()->invalidate();
            request()->session()->regenerateToken();

            throw ValidationException::withMessages([
                'email' => [$user->authenticationBlockedMessage()],
            ]);
        }

        request()->session()->regenerate();

        return $user->load('roles');
    }
}
