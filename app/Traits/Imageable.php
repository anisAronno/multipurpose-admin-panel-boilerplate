<?php

namespace App\Traits;

use App\Models\Image;

trait Imageable
{
    public function images()
    {
        return $this->morphToMany(Image::class, 'imageable')->withTimestamps();
    }
}
