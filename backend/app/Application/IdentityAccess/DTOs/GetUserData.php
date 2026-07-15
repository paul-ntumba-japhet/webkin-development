<?php

namespace App\Application\IdentityAccess\DTOs;

use App\Models\User;

final readonly class GetUserData
{
    public function __construct(
        public int $userId,
    ) {}

    public static function fromUser(User $user): self
    {
        return new self(userId: $user->id);
    }
}
