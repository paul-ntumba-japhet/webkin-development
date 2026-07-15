<?php

namespace App\Http\Controllers\Api\V1\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class StudentZoneController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        return response()->json([
            'zone' => 'student',
            'message' => 'Student API zone',
        ]);
    }
}
