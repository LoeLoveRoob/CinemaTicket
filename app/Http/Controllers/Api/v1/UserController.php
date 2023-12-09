<?php

namespace App\Http\Controllers\Api\v1;

use App\Actions\User\StoreUserAction;
use App\Actions\User\UpdateUserAction;
use App\Http\Controllers\Api\BaseApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends BaseApiController
{

    public function __construct()
    {
        $this->authorizeResource(User::class, "user");
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, UserRepositoryInterface $userRepository): JsonResponse
    {
        return $this->successResponse(
            UserResource::collection(
                $userRepository->paginate($request->input('page_limit'))
            ),
            "user.success_index"
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request): JsonResponse
    {
        return $this->successResponse(
            UserResource::make(
                StoreUserAction::run($request->validated())
            ),
            "user.success_store",
        );
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
        $user = UpdateUserAction::run($user, $request->validated());
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
        $user->delete();
        return $this->successResponse(
            "True",
            "user.success_destroy",
        );
    }
}
