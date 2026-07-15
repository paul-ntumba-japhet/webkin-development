<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Application\IdentityAccess\Actions\RegisterUserAction;
use App\Application\IdentityAccess\DTOs\RegisterUserData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterUserRequest;
use App\Http\Resources\IdentityAccess\UserResource;
use Illuminate\Http\JsonResponse;

final class RegisterController extends Controller
{
    public function __invoke(RegisterUserRequest $request, RegisterUserAction $action): JsonResponse
    {
        $user = $action->execute(RegisterUserData::fromRequest($request));

        return UserResource::make($user)
            ->response()
            ->setStatusCode(201);
    }
}
