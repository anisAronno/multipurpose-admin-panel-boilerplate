<?php

namespace App\Http\Resources;

use App\Helpers\FileHelpers;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class SpecialFeatureResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'slug' => $this->slug,
            'status' => $this->status,
            'images' => ImageResources::collection($this->whenLoaded('images')),
            'created_at' => Carbon::parse($this->created_at)->diffForHumans(),
        ];
    }
}
