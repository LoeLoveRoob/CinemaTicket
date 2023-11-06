<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\StoreMovieRequest;
use App\Http\Requests\UpdateMovieRequest;
use App\Http\Resources\MovieResource;
use App\Models\Movie;
use Illuminate\Http\JsonResponse;


class MovieController extends BaseApiController
{
    public function __construct()
    {
        $this->authorizeResource(Movie::class);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return $this->successResponse(
            MovieResource::collection(Movie::with(["director", "category"])->get()),
            "movie.success_index"
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMovieRequest $request): JsonResponse
    {
        $movie = Movie::create($request->validated());
        return $this->successResponse(
            MovieResource::make($movie),
            "movie.success_store"
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Movie $movie): JsonResponse
    {
        return $this->successResponse(
            MovieResource::make($movie),
            "movie.success_show",
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMovieRequest $request, Movie $movie): JsonResponse
    {
        if ($movie->update($request->validated())) {
            return $this->successResponse(
                MovieResource::make($movie),
                "movie.success_update",
                200
            );
        } else {
            return $this->errorResponse(
                "False",
                "movie.failed_update"
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie): JsonResponse
    {
        $movie->delete();
        return $this->successResponse(
            "True",
            "movie.success_destroy"
        );
    }}
