<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Application\IdentityAccess\Actions\UpdateRoleAction;
use App\Application\IdentityAccess\DTOs\UpdateRoleData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateRoleRequest;
use App\Http\Resources\IdentityAccess\RoleResource;
use App\Models\Role;
use Illuminate\Http\JsonResponse;

final class UpdateRoleController extends Controller
{
    public function __invoke(
        UpdateRoleRequest $request,
        Role $role,
        UpdateRoleAction $action,
    ): JsonResponse {
        $updated = $action->execute($request->user(), UpdateRoleData::fromRequest($request, $role));

        return RoleResource::make($updated)->response();
    }
}
