<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Application\IdentityAccess\Actions\AssignRolesToUserAction;
use App\Application\IdentityAccess\DTOs\AssignRolesToUserData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AssignUserRolesRequest;
use App\Http\Resources\IdentityAccess\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;

final class AssignUserRolesController extends Controller
{
    public function __invoke(
        AssignUserRolesRequest $request,
        User $user,
        AssignRolesToUserAction $action,
    ): JsonResponse {
        $updated = $action->execute($request->user(), AssignRolesToUserData::fromRequest($request, $user));

        return UserResource::make($updated)->response();
    }
}
