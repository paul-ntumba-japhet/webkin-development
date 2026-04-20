<?php

namespace App\Domain\IdentityAccess\Services;



interface PasswordHasherServiceInterface
{
    public function hash(string $plain): string;
    public function check(string $plain, string $hashed): bool;
    public function needsRehash(string $hashed): bool;
}
