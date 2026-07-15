<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Application\IdentityAccess\Actions\UpdateUserAction;
use App\Application\IdentityAccess\DTOs\UpdateUserData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Http\Resources\IdentityAccess\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;

final class UpdateUserController extends Controller
{
    public function __invoke(
        UpdateUserRequest $request,
        User $user,
        UpdateUserAction $action,
    ): JsonResponse {
        $updated = $action->execute($request->user(), UpdateUserData::fromRequest($request, $user));

        return UserResource::make($updated)->response();
    }
}
