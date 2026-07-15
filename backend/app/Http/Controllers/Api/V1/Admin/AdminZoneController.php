<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class AdminZoneController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        return response()->json([
            'zone' => 'admin',
            'message' => 'Admin API zone',
        ]);
    }
}
