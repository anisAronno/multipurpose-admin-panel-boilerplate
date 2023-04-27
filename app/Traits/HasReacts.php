<?php

namespace App\Traits;

use App\Models\React;

trait HasReacts
{
    public function reacts()
    {
        return $this->morphToMany(React::class, 'reactable')->withTimestamps();
    }
}
