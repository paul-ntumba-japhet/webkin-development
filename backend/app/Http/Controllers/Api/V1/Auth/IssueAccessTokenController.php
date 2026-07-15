<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Application\IdentityAccess\Actions\IssuePersonalAccessTokenAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\IssueAccessTokenRequest;
use App\Http\Resources\IdentityAccess\UserResource;
use Illuminate\Http\JsonResponse;

final class IssueAccessTokenController extends Controller
{
    public function __invoke(IssueAccessTokenRequest $request, IssuePersonalAccessTokenAction $action): JsonResponse
    {
        $result = $action->execute(
            $request->string('email')->toString(),
            $request->string('password')->toString(),
            $request->string('device_name')->toString(),
        );

        return response()->json([
            'token' => $result['plain_text_token'],
            'token_type' => 'Bearer',
            'user' => UserResource::make($result['user'])->resolve(),
        ]);
    }
}
