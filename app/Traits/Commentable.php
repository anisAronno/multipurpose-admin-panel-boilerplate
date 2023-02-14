<?php

namespace App\Traits;

use App\Models\Comment;

trait Commentable
{
    public function comments()
    {
        return $this->morphToMany(Comment::class, 'commentable')->withTimestamps();
    }
}
