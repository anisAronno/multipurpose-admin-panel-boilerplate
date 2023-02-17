<?php

namespace App\Traits;

use App\Models\Rating;

trait Searchable
{
    public function searches()
    {
        return $this->morphMany(Rating::class, 'searchable');
    }
}
