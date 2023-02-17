<?php

namespace App\Traits;

use App\Models\React;

trait Reactable
{
    public function reacts()
    {
        return $this->morphToMany(React::class, 'reactable')->withTimestamps();
    }
}
