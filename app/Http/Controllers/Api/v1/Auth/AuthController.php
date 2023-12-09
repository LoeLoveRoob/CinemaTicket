<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\LogoutRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\SendOtpRequest;
use App\Http\Requests\VerifyOtpRequest;
use App\Http\Resources\UserResource;
use App\Models\Otp;
use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class AuthController extends BaseApiController
{
    public function register(RegisterRequest $request): JsonResponse
    {

    }

    public function login(LoginRequest $request): JsonResponse
    {
        /*
        * TODO Check The Password!
        */
        if(Auth::attempt($request->validated()))
        {
            $user = Auth::user();
            $success["token"] = $user->createToken("CLAY")->plainTextToken;
            $success["user"] = UserResource::make($user);
            return $this->successResponse(
                $success,
                "user.success_login",
                200
            );
        } else {
            return $this->errorResponse(
                "False",
                "user.failed_login"
            );
        }
    }

    public function logout(Request $request): JsonResponse
    {
        if($request->user()->currentAccessToken()->delete())
        {
            return $this->successResponse(
                "True",
                "user.success_logout",
            );
        } else {
            return $this->errorResponse(
                "False",
                "user.failed_logout",
            );
        }

    }
}

