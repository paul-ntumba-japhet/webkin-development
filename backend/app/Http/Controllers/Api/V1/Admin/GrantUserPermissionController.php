<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Application\IdentityAccess\Actions\GrantUserPermissionAction;
use App\Application\IdentityAccess\DTOs\GrantUserPermissionData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GrantUserPermissionRequest;
use App\Http\Resources\IdentityAccess\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;

final class GrantUserPermissionController extends Controller
{
    public function __invoke(
        GrantUserPermissionRequest $request,
        User $user,
        GrantUserPermissionAction $action,
    ): JsonResponse {
        $updated = $action->execute(GrantUserPermissionData::fromRequest($request, $user));

        return UserResource::make($updated)->response();
    }
}
