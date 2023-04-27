<?php

namespace App\Traits;
 
use App\Models\ShareHistory;

trait Shareable
{
    public function shares()
    {
        return $this->morphMany(ShareHistory::class, 'shareable');
    }
}
