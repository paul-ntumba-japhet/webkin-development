<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Application\IdentityAccess\Actions\RemoveRolesFromUserAction;
use App\Application\IdentityAccess\DTOs\RemoveRolesFromUserData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RemoveUserRolesRequest;
use App\Http\Resources\IdentityAccess\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;

final class RemoveUserRolesController extends Controller
{
    public function __invoke(
        RemoveUserRolesRequest $request,
        User $user,
        RemoveRolesFromUserAction $action,
    ): JsonResponse {
        $updated = $action->execute($request->user(), RemoveRolesFromUserData::fromRequest($request, $user));

        return UserResource::make($updated)->response();
    }
}
