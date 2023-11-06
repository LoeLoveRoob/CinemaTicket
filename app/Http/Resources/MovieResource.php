<?php

namespace App\Http\Resources;

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
            "director"=> $this->whenLoaded(
                "director",
                UserResource::make($this->resource->director)
            ),
            "category"=> $this->whenLoaded(
                "category",
                CategoryResource::make($this->resource->category)
            ),
            "name"=> $this->resource->name,
            "rating"=> $this->resource->rating,
            "about"=> $this->resource->about,
            "short_story"=> $this->resource->short_story,
        ];
    }
}
