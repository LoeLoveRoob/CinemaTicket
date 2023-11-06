<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateRoleRequest;
use App\Http\Resources\RoleResource;
use App\Models\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RoleController extends BaseApiController
{
    public function __construct()
    {
        $this->authorizeResource(Role::class);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return $this->successResponse(
            RoleResource::collection(Role::all()),
            "role.success_index"
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request): JsonResponse
    {
        $role = Role::create($request->validated());
        return $this->successResponse(
            RoleResource::make($role),
            "role.success_store"
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role): JsonResponse
    {
        return $this->successResponse(
            RoleResource::make($role),
            "role.success_show",
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role): JsonResponse
    {
        if ($role->update($request->validated())) {
            return $this->successResponse(
                RoleResource::make($role),
                "role.success_update",
                200
            );
        } else {
            return $this->errorResponse(
                "False",
                "role.failed_update"
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role): JsonResponse
    {
        $role->delete();
        return $this->successResponse(
            "True",
            "role.success_destroy"
        );
    }
}
