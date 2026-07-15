<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Application\IdentityAccess\Actions\AssignPermissionsToRoleAction;
use App\Application\IdentityAccess\DTOs\AssignPermissionsToRoleData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AssignRolePermissionsRequest;
use App\Http\Resources\IdentityAccess\RoleResource;
use App\Models\Role;
use Illuminate\Http\JsonResponse;

final class AssignRolePermissionsController extends Controller
{
    public function __invoke(
        AssignRolePermissionsRequest $request,
        Role $role,
        AssignPermissionsToRoleAction $action,
    ): JsonResponse {
        $updated = $action->execute(AssignPermissionsToRoleData::fromRequest($request, $role));

        return RoleResource::make($updated)->response();
    }
}
