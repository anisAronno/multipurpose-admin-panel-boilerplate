<?php

namespace App\Traits;

use App\Models\Image;

trait Imageable
{
    public function images()
    {
        return $this->morphToMany(Image::class, 'imageable')
        ->wherePivot('is_featured', '!=', true)
        ->withPivot('is_featured')
        ->withTimestamps();
    }

    public function image()
    {
        return $this->morphToMany(Image::class, 'imageable')
            ->wherePivot('is_featured', true)
            ->withPivot('is_featured')
            ->withTimestamps()
            ->latest()
            ->limit(1);
    }
}
