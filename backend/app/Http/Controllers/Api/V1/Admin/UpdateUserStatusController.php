<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Application\IdentityAccess\Actions\UpdateUserStatusAction;
use App\Application\IdentityAccess\DTOs\UpdateUserStatusData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateUserStatusRequest;
use App\Http\Resources\IdentityAccess\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;

final class UpdateUserStatusController extends Controller
{
    public function __invoke(
        UpdateUserStatusRequest $request,
        User $user,
        UpdateUserStatusAction $action,
    ): JsonResponse {
        $updated = $action->execute($request->user(), UpdateUserStatusData::fromRequest($request, $user));

        return UserResource::make($updated)->response();
    }
}
