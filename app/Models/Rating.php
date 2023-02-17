<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = [
     'star',
     'ratingable_id',
     'ratingable_type',
     'user_id',
    ];


    public function ratingable()
    {
        return $this->morphTo();
    }
}
