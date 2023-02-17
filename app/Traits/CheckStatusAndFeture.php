<?php

namespace App\Traits;

use App\Enums\Status; 

trait CheckStatusAndFeture
{
    /**
     * Summary of scopeIsActive
     * @param mixed $query
     * @return mixed
     */
    public function scopeIsActive($query)
    {
        return $query->where('status', '=', Status::PUBLISHED);
    }
    /**
     * Summary of scopeIsFeatured
     * @param mixed $query
     * @return mixed
     */
    public function scopeIsFeatured($query)
    {
        return $query->where('is_featured', '=', 1);
    }
}
