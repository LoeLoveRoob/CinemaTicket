<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "user"=> $this->whenLoaded(
                "user",
                UserResource::make($this->resource->user)
            ),
            "cinema"=> $this->whenLoaded(
                "cinema",
                CinemaResource::make($this->resource->cinema)
            ),
            "time"=> $this->resource->time,
            "salon"=> $this->resource->salon,
        ];
    }
}
