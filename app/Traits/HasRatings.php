<?php

namespace App\Traits;

use App\Models\Rating;

trait HasRatings
{
    public function ratings()
    {
        return $this->morphMany(Rating::class, 'ratingable');
    }
}
