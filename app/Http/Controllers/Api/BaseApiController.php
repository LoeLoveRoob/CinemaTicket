<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BaseApiController extends Controller
{
    public function successResponse($data, $message, $code=200): JsonResponse
    {
        return response()->json([
            "data"=> $data,
            "message"=> $message,
            "code"=> $code,
        ]);
    }

    public function errorResponse($error, $message=null, $code=400): JsonResponse
    {
        return response()->json([
            "error"=> $error,
            "message"=> $message,
            "code"=> $code
        ]);
    }
}
