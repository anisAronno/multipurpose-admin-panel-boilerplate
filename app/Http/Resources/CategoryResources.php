<?php

namespace App\Http\Resources;

use AnisAronno\MediaGallery\Http\Resources\MediaResources;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class CategoryResources extends JsonResource
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
            'slug' => $this->slug,
            'description' => $this->description,
            'status' => $this->status,
            'is_featured' => $this->is_featured == 1 ? 'Featured' : 'N/A',
            'user' => new UserResources($this->user),
            'categories' => $this->whenLoaded('categories'),
            'featuredMedia' => MediaResources::collection($this->whenLoaded('featuredMedia')),
            'media' => MediaResources::collection($this->whenLoaded('media')),
            'products' => ProductResource::collection($this->whenLoaded('products')),
            'blogs' => BlogResources::collection($this->whenLoaded('blogs')),
            'created_at' => Carbon::parse($this->created_at)->diffForHumans(),
        ];
    }
}
