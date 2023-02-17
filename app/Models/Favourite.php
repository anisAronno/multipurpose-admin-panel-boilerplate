<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{
    use HasFactory;

    protected $fillable = [
     'favourable_id',
     'favourable_type',
     'user_id',
    ];

    public function favourable()
    {
        return $this->morphTo();
    }
}
