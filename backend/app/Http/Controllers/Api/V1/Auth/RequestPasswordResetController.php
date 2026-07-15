<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Application\IdentityAccess\Actions\RequestPasswordResetAction;
use App\Application\IdentityAccess\DTOs\RequestPasswordResetData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RequestPasswordResetRequest;
use Illuminate\Http\JsonResponse;

final class RequestPasswordResetController extends Controller
{
    public function __invoke(
        RequestPasswordResetRequest $request,
        RequestPasswordResetAction $action,
    ): JsonResponse {
        $action->execute(RequestPasswordResetData::fromRequest($request));

        return response()->json([
            'message' => __('passwords.sent'),
        ]);
    }
}
