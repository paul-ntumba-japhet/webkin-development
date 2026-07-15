<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Application\IdentityAccess\Actions\CreateRoleAction;
use App\Application\IdentityAccess\DTOs\CreateRoleData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateRoleRequest;
use App\Http\Resources\IdentityAccess\RoleResource;
use Illuminate\Http\JsonResponse;

final class CreateRoleController extends Controller
{
    public function __invoke(CreateRoleRequest $request, CreateRoleAction $action): JsonResponse
    {
        $role = $action->execute($request->user(), CreateRoleData::fromRequest($request));

        return RoleResource::make($role)
            ->response()
            ->setStatusCode(201);
    }
}
