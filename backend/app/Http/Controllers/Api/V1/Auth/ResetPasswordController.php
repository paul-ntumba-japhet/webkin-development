<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Application\IdentityAccess\Actions\ResetPasswordAction;
use App\Application\IdentityAccess\DTOs\ResetPasswordData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ResetPasswordRequest;
use Illuminate\Http\JsonResponse;

final class ResetPasswordController extends Controller
{
    public function __invoke(ResetPasswordRequest $request, ResetPasswordAction $action): JsonResponse
    {
        $action->execute(ResetPasswordData::fromRequest($request));

        return response()->json([
            'message' => __('passwords.reset'),
        ]);
    }
}
