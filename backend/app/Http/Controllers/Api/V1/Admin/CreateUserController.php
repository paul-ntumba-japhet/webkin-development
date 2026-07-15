<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Application\IdentityAccess\Actions\CreateUserAction;
use App\Application\IdentityAccess\DTOs\CreateUserData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateUserRequest;
use App\Http\Resources\IdentityAccess\UserResource;
use Illuminate\Http\JsonResponse;

final class CreateUserController extends Controller
{
    public function __invoke(CreateUserRequest $request, CreateUserAction $action): JsonResponse
    {
        $user = $action->execute($request->user(), CreateUserData::fromRequest($request));

        return UserResource::make($user)
            ->response()
            ->setStatusCode(201);
    }
}
