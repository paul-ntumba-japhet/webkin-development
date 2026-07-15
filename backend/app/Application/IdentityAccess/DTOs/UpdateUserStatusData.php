<?php

namespace App\Application\IdentityAccess\DTOs;

use App\Domain\Users\Enums\UserStatus;
use App\Models\User;
use Illuminate\Http\Request;

final readonly class UpdateUserStatusData
{
    public function __construct(
        public int $userId,
        public UserStatus $status,
    ) {}

    public static function fromRequest(Request $request, User $user): self
    {
        return new self(
            userId: $user->id,
            status: UserStatus::from($request->input('status')),
        );
    }

    public function toArray(): array
    {
        return [
            'user_id' => $this->userId,
            'status' => $this->status->value,
        ];
    }

    public function userAttributes(): array
    {
        return [
            'status' => $this->status->value,
        ];
    }
}
