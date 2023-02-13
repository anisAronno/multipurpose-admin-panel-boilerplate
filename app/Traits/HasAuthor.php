<?php

namespace App\Traits;

use App\Models\User;

trait HasAuthor
{
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
