<?php

namespace App\Application\IdentityAccess\DTOs;

use App\Models\Role;
use Illuminate\Http\Request;

final readonly class AssignPermissionsToRoleData
{
    /**
     * @param  array<int>  $permissionIds
     */
    public function __construct(
        public int $roleId,
        public array $permissionIds,
    ) {}

    public static function fromRequest(Request $request, Role $role): self
    {
        return new self(
            roleId: $role->id,
            permissionIds: array_values(array_unique(array_map('intval', (array) $request->input('permission_ids', [])))),
        );
    }
}
