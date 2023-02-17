<?php

namespace App\Traits;

use App\Models\Rating;

trait Shareable
{
    public function shares()
    {
        return $this->morphMany(Rating::class, 'shareable');
    }
}
