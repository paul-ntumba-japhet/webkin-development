<?php

namespace App\Application\IdentityAccess\DTOs;

use Illuminate\Http\Request;

final readonly class ChangePasswordData
{
    public function __construct(
        public int $userId,
        public string $currentPassword,
        public string $newPassword,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            userId: (int) $request->user()->id,
            currentPassword: $request->string('current_password')->toString(),
            newPassword: $request->string('new_password')->toString(),
        );
    }

    public function toArray(): array
    {
        return [
            'user_id' => $this->userId,
            'current_password' => $this->currentPassword,
            'new_password' => $this->newPassword,
        ];
    }
}
