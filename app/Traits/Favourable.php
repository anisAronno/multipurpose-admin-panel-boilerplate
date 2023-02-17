<?php

namespace App\Traits;

use App\Models\Favourite; 

trait Favourable
{
    public function favourites()
    {
        return $this->morphMany(Favourite::class, 'favourable');
    }
}
