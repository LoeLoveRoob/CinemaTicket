<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\UpdateCinemaRequest;
use App\Http\Resources\CinemaResource;
use App\Models\Cinema;
use Illuminate\Http\JsonResponse;

class CinemaController extends BaseApiController
{
    public function __construct()
    {
        $this->authorizeResource(Cinema::class);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return $this->successResponse(
            CinemaResource::collection(Cinema::all()),
            "cinema.success_index"
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCinemaRequest $request): JsonResponse
    {
        $cinema = Cinema::create($request->validated());
        return $this->successResponse(
            CinemaResource::make($cinema),
            "cinema.success_store"
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Cinema $cinema): JsonResponse
    {
        return $this->successResponse(
            CinemaResource::make($cinema),
            "cinema.success_show",
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCinemaRequest $request, Cinema $cinema): JsonResponse
    {
        if ($cinema->update($request->validated())) {
            return $this->successResponse(
                CinemaResource::make($cinema),
                "cinema.success_update",
                200
            );
        } else {
            return $this->errorResponse(
                "False",
                "cinema.failed_update"
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cinema $cinema): JsonResponse
    {
        $cinema->delete();
        return $this->successResponse(
            "True",
            "cinema.success_destroy"
        );
    }
}
