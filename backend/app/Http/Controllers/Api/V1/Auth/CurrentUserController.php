<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Application\IdentityAccess\Actions\GetAuthenticatedUserAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\IdentityAccess\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class CurrentUserController extends Controller
{
    public function __invoke(Request $request, GetAuthenticatedUserAction $action): JsonResponse
    {
        $user = $action->execute($request->user());

        return UserResource::make($user)->response();
    }
}
