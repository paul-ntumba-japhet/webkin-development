<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Application\IdentityAccess\Actions\LogoutUserAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class LogoutController extends Controller
{
    public function __invoke(Request $request, LogoutUserAction $action): JsonResponse
    {
        $action->execute($request);

        return response()->json(null, 204);
    }
}
