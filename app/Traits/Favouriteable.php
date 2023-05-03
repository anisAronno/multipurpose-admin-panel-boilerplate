<?php

namespace App\Traits;

use App\Models\Favorite;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait Favouriteable
{
    public function favorites()
    {
        return $this->morphMany(Favorite::class, 'favouriteable');
    }
}
