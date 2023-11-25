<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CinemaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "city"=> $this->whenLoaded(
                "city",
                $this->resource->city->name,
            ),
            "name"=> $this->resource->name,
            "address"=> $this->resource->address,
            "rating"=> $this->resource->rating,
            "sans"=> json_decode($this->resource->sans),
            "salons"=> json_decode($this->resource->salons),
        ];
    }
}
