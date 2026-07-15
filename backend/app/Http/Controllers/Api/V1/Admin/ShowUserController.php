<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Application\IdentityAccess\Actions\GetUserAction;
use App\Application\IdentityAccess\DTOs\GetUserData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GetUserRequest;
use App\Http\Resources\IdentityAccess\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;

final class ShowUserController extends Controller
{
    public function __invoke(
        GetUserRequest $request,
        User $user,
        GetUserAction $action,
    ): JsonResponse {
        $found = $action->execute($request->user(), GetUserData::fromUser($user));

        return UserResource::make($found)->response();
    }
}
