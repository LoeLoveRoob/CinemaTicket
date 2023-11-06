<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGenreRequest;
use App\Http\Requests\UpdateGenreRequest;
use App\Http\Resources\GenreResource;
use App\Models\Genre;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GenreController extends BaseApiController
{
    public function __construct()
    {
        $this->authorizeResource(Genre::class);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return $this->successResponse(
            GenreResource::collection(Genre::all()),
            "genre.success_index"
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGenreRequest $request): JsonResponse
    {
        $genre = Genre::create($request->validated());
        return $this->successResponse(
            GenreResource::make($genre),
            "genre.success_store"
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Genre $genre): JsonResponse
    {
        return $this->successResponse(
            GenreResource::make($genre),
            "genre.success_show",
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGenreRequest $request, Genre $genre): JsonResponse
    {
        if ($genre->update($request->validated())) {
            return $this->successResponse(
                GenreResource::make($genre),
                "genre.success_update",
                200
            );
        } else {
            return $this->errorResponse(
                "False",
                "genre.failed_update"
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Genre $genre): JsonResponse
    {
        $genre->delete();
        return $this->successResponse(
            "True",
            "genre.success_destroy"
        );
    }
}
