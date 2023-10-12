<?php

namespace App\Http\Resources;

use AnisAronno\MediaHelper\Facades\Media;
use App\Models\Image;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class BlogResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $image = $this->whenLoaded('image', function () {
            if ($this->image->isNotEmpty()) {
                return new ImageResources($this->image->first());
            }
            return new ImageResources(new Image(['url' => Media::getDefaultPlaceholder()]));
        });

        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'short_description' => $this->short_description,
            'description' => $this->description,
            'status' => $this->status,
            'format' => $this->format,
            'is_featured' => $this->is_featured == 1 ? "Featured" : "N/A",
            'is_commentable' => $this->is_commentable,
            'is_reactable' => $this->is_reactable,
            'is_shareable' => $this->is_shareable,
            'show_ratings' => $this->show_ratings,
            'show_views' => $this->show_views,
            'user' => new UserResources($this->whenLoaded('user')),
            'categories' => $this->whenLoaded('categories'),
            'image' => $image,
            'images' => ImageResources::collection($this->whenLoaded('images')),
            'created_at' => Carbon::parse($this->created_at)->diffForHumans(),
        ];
    }
}
