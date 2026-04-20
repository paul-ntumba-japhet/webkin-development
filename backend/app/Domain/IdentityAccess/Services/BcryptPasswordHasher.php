<?php

namespace App\Infrastructure\Services\IdentityAccess;

use App\Domain\IdentityAccess\Services\PasswordHasherServiceInterface;
use Illuminate\Support\Facades\Hash;

final class BcryptPasswordHasher implements PasswordHasherServiceInterface
{
    public function hash(string $plain): string
    {
        return Hash::make($plain);
    }

    public function check(string $plain, string $hashed): bool
    {
        return Hash::check($plain, $hashed);
    }

    public function needsRehash(string $hashed): bool
    {
        return Hash::needsRehash($hashed);
    }
}
