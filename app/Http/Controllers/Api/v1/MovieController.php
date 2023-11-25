<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\StoreMovieRequest;
use App\Http\Requests\UpdateMovieRequest;
use App\Http\Resources\CinemaResource;
use App\Http\Resources\MovieResource;
use App\Models\Cinema;
use App\Models\Movie;
use App\Models\Ticket;
use Illuminate\Http\Request;
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
    public function index(Request $request): JsonResponse
    {
        if ($request->max) {
            $movie = Movie::query()->withCount("tickets")
                ->orderBy("tickets_count")
                ->limit(1)
                ->get();
            return $this->successResponse([
                "movie" => MovieResource::collection($movie),
            ],
                "movie.success_max"
            );
        }
        if ($request->min) {
            $temp = Ticket::orderByMovies()->get()->first();
            $movieId = $temp->movie_id;
            $ticketCount = $temp->usage_count;
            return $this->successResponse([
                "movie" => MovieResource::make(Movie::query()->find($movieId)),
                "ticket_count" => $ticketCount
            ],
                "movie.success_min"
            );
        }

        if ($request->top_cinema) {
            $temp = Ticket::orderByCinemas()->get()->last();
            $cinemaId = $temp->cinema_id;
            $ticketCount = $temp->ticket_count;
            return $this->successResponse([
                "cinema" => CinemaResource::make(Cinema::query()->find($cinemaId)),
                "ticket_count" => $ticketCount,
            ],
                "movie.success_top_cinema"
            );
        }

        if ($request->low_cinema) {
            $temp = Ticket::orderByCinemas()->get()->first();
            $cinemaId = $temp->cinema_id;
            $ticketCount = $temp->ticket_count;
            return $this->successResponse([
                "movie" => CinemaResource::make(Cinema::query()->find($cinemaId)),
                "ticket_count" => $ticketCount,
            ],
                "movie.success_low_cinema"
            );
        }

        if ($request->top_city) {
            $temp = Cinema::orderByCities()->get()->last();
            $cityId = $temp->city_id;
            $ticketCount = $temp->ticket_count;
            return $this->successResponse([
                "city" => Cinema::query()->find($cityId),
                "ticket_count" => $ticketCount,
            ],
                "movie.success_top_city"
            );
        }

        $relations = [];
        foreach (Movie::query()->first()->getRelations() as $relation) {
            if (isset($request[$relation])) {
                $relations[] = $relation;
            }
        }
        if (!empty($relations)) {
            $movies = Movie::with($relations);
        } else {
            $movies = Movie::withCount("tickets");
        }

        return $this->successResponse(
            MovieResource::collection($movies->get()),
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
        if (isset($request->count)) {
            $movie->loadCount("tickets");
        }
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
    }
}
