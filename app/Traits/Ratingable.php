<?php

namespace App\Traits;

use App\Models\Rating;

trait Ratingable
{
    public function ratings()
    {
        return $this->morphMany(Rating::class, 'ratingable');
    }
}
