<?php

namespace App\Application\IdentityAccess\DTOs;

use App\Models\User;
use Illuminate\Http\Request;

final readonly class RemoveRolesFromUserData
{
    /**
     * @param array<int> $roleIds
     */
    public function __construct(
        public int $userId,
        public array $roleIds,
    ) {}

    public static function fromRequest(Request $request, User $user): self
    {
        return new self(
            userId: $user->id,
            roleIds: array_values(array_unique(array_map('intval', (array) $request->input('role_ids', [])))),
        );
    }

    public function toArray(): array
    {
        return [
            'user_id' => $this->userId,
            'role_ids' => $this->roleIds,
        ];
    }
}
