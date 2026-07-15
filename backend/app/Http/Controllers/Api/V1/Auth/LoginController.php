<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Application\IdentityAccess\Actions\LoginUserAction;
use App\Application\IdentityAccess\DTOs\LoginData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginUserRequest;
use App\Http\Resources\IdentityAccess\UserResource;
use Illuminate\Http\JsonResponse;

final class LoginController extends Controller
{
    public function __invoke(LoginUserRequest $request, LoginUserAction $action): JsonResponse
    {
        $user = $action->execute(LoginData::fromRequest($request));
        return UserResource::make($user)->response();
    }
}
