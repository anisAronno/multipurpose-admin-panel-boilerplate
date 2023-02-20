<?php

namespace App\Http\Resources;

use App\Helpers\FileHelpers;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class ImageResources extends JsonResource
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
            'url' =>  $this->url,
            'mimes' => $this->mimes,
            'type' => $this->type,
            'size' => $this->size,
            'created_at' => Carbon::parse($this->created_at)->diffForHumans(),
        ];
    }
}
