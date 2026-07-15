<?php

namespace App\Application\IdentityAccess\Actions;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

final class IssuePersonalAccessTokenAction
{
    /**
     * @return array{user: User, plain_text_token: string}
     */
    public function execute(string $email, string $password, string $deviceName): array
    {
        $user = User::query()->where('email', $email)->first();

        if ($user === null || ! Hash::check($password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => [trans('auth.failed')],
            ]);
        }

        if (! $user->canAuthenticate()) {
            throw ValidationException::withMessages([
                'email' => [$user->authenticationBlockedMessage()],
            ]);
        }

        $token = $user->createToken($deviceName);

        return [
            'user' => $user->load('roles'),
            'plain_text_token' => $token->plainTextToken,
        ];
    }
}
