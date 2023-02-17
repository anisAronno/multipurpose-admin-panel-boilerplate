<?php

namespace App\Traits;

use App\Models\Rating;

trait Visitorable
{
    public function visitors()
    {
        return $this->morphMany(Rating::class, 'visitorable');
    }
}
