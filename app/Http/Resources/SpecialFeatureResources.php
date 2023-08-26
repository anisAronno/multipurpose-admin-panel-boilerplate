<?php

namespace App\Http\Resources;

use AnisAronno\MediaHelper\Facades\Media;
use App\Models\Image;
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
        $image = $this->whenLoaded('image', function () {
            if ($this->image->isNotEmpty()) {
                return new ImageResources($this->image->first());
            }
            return new ImageResources(new Image(['url' => Media::getPlaceholderImage()]));
        });

        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'slug' => $this->slug,
            'status' => $this->status,
            'image' => $image,
            'images' => ImageResources::collection($this->whenLoaded('images')),
            'created_at' => Carbon::parse($this->created_at)->diffForHumans(),
        ];
    }
}
