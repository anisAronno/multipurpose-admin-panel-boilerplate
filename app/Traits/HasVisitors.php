<?php

namespace App\Traits;
 
use App\Models\Visitor;

trait HasVisitors
{
    public function visitors()
    {
        return $this->morphMany(Visitor::class, 'visitorable');
    }
}
