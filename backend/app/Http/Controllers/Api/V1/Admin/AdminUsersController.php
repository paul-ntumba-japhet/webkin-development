<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Application\IdentityAccess\Actions\ListUsersAction;
use App\Application\IdentityAccess\DTOs\ListUsersData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ManageUsersRequest;
use App\Http\Resources\IdentityAccess\UserResource;
use Illuminate\Http\JsonResponse;

final class AdminUsersController extends Controller
{
    public function __invoke(ManageUsersRequest $request, ListUsersAction $action): JsonResponse
    {
        $users = $action->execute($request->user(), ListUsersData::fromRequest($request));

        return UserResource::collection($users)->response();
    }
}
