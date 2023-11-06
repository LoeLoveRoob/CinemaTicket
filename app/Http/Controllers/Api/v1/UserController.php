<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends BaseApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return $this->successResponse(
            UserResource::collection(User::with("roles")->get()),
            "user.success_index"
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request): JsonResponse
    {
        if ($request->user()->cannot("create", User::class)){
            abort(403);
        }
        $user = User::create($request->validated());
        if ($user){
            return $this->successResponse(
                UserResource::make($user),
                "user.success_store"
            );
        } else {
            return $this->errorResponse(
                "False",
                "user.failed_store"
            );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): JsonResponse
    {
        return $this->successResponse(
            UserResource::make($user),
            "user.success_show",
            200
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user): JsonResponse
    {
        $user->update($request->validated());
        return $this->successResponse(
            UserResource::make($user),
            "user.success_update",
            200
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): JsonResponse
    {
        if ($user->delete()){
            return $this->successResponse(
                "True",
                "user.success_destroy",
            );
        } else {
            return $this->errorResponse(
                "False",
                "user.failed_destroy"
            );
        }
    }
}
