<?php

namespace App\Traits;

use App\Models\Category;

trait Categoryable
{
    public function categories()
    {
        return $this->morphToMany(Category::class, 'categoryable')->withTimestamps();
    }
}
