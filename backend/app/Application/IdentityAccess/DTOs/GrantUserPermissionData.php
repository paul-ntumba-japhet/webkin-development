<?php

namespace App\Application\IdentityAccess\DTOs;

use App\Models\User;
use Illuminate\Http\Request;

final readonly class GrantUserPermissionData
{
    public function __construct(
        public int $userId,
        public int $permissionId,
        public bool $granted,
    ) {}

    public static function fromRequest(Request $request, User $user): self
    {
        return new self(
            userId: $user->id,
            permissionId: (int) $request->input('permission_id'),
            granted: $request->boolean('granted', true),
        );
    }
}
