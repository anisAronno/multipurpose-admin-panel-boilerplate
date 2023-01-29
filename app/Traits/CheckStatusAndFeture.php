<?php

namespace App\Traits;

use App\Enums\Status;
use App\Enums\Featured;

trait CheckStatusAndFeture
{
    /**
     * Summary of scopeIsActive
     * @param mixed $query
     * @return mixed
     */
    public function scopeIsActive($query)
    {
        return $query->where('status', '=', Status::ACTIVE);
    }
    /**
     * Summary of scopeIsFeatured
     * @param mixed $query
     * @return mixed
     */
    public function scopeIsFeatured($query)
    {
        return $query->where('is_featured', '=', Featured::OK);
    }
    
}
