<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "phone"=> $this->resource->phone,
            "phone_verified_at"=> $this->resource->phone_verified_at,
            "name"=> $this->resource->name,
            "family"=> $this->resource->family,
            "birth"=> $this->resource->birth,
            "roles"=> RoleResource::collection($this->whenLoaded("roles")),
            "email"=> $this->resource->email,
            "email_verified_at"=> $this->resource->email_verified_at,
            "password"=> $this->resource->password,
        ];
    }
}
