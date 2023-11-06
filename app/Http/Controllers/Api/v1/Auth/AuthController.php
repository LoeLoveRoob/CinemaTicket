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
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class AuthController extends BaseApiController
{
    public function sendOtp(SendOtpRequest $request)
    {
        $user = User::query()->where("phone", $request->phone)->first();
        $user ?? $user = User::create(["phone"=> $request->phone]);
        $lastOtp = $user->otps->last();
        if ($lastOtp && $lastOtp->isValid()){
            $lastOtp->update(["used"=> true]);
        }
        $otp = Otp::create([
            "user_id"=> $user->id,
            "code"=> rand(11111, 99999),
            "secret"=> Str::random("30"),
            "used"=> false,
        ]);

        return $this->successResponse(
            $otp,
            "code has been send!"
        );
    }

    public function confirmOtp(VerifyOtpRequest $request): JsonResponse
    {
        $user = User::query()->where("phone", $request->phone)->first();
        $otp = $user->otps->where('used', false)->first();
        if (!$otp | $otp->isExpired()) {
            return $this->errorResponse(
                "Expired! Or Doesn't Exists!",
                "the code has been expired",
            );
        }

        if ($otp->code == $request->code and $otp->secret == $request->secret){
            $user->update([
                "phone_verified_at"=> time(),
            ]);
            $otp->update([
                "used"=> true
            ]);
            return $this->successResponse(
                $user,
                "otp was currect! go to login page for sign in!"
            );
        } else {
            return $this->errorResponse(
                "an error accused",
                "otp or secret code not currect!"
            );
        }
    }


    public function register(RegisterRequest $request): JsonResponse
    {
        /*
         * TODO Check The Verification Code!
         */
        $user = User::query()->where("phone", $request->phone)->first();
        if ($user && $user->phone_verified_at)
        {
            $user->update($request->validated());
            $user->roles()->sync([4]);
            return $this->successResponse(
                UserResource::make($user),
                "user.success_verify",
            );
        } else {
            return $this->errorResponse(
                "code",
                "user.failed_verify",
            );
        }
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

