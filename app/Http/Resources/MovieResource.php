<?php

namespace App\Http\Resources;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MovieResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "director"=> UserResource::make($this->whenLoaded("director")),
            "category"=> CategoryResource::make($this->whenLoaded("category")),
            "cinemas"=> CinemaResource::collection($this->whenLoaded("cinemas")),
            "artists"=> UserResource::collection($this->whenLoaded("artists")),
            "tickets"=> TicketResource::collection($this->whenLoaded("tickets")),
            "name"=> $this->resource->name,
            "rating"=> $this->resource->rating,
            "about"=> $this->resource->about,
            "short_story"=> $this->resource->short_story,
            "ticket_count"=> $this->whenCounted("tickets"),
        ];
    }
}
