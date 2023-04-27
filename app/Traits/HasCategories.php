<?php

namespace App\Traits;

use App\Models\Category;

trait HasCategories
{
    public function categories()
    {
        return $this->morphToMany(Category::class, 'categoryable')->withTimestamps();
    }
}
