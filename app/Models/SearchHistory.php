<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SearchHistory extends Model
{
    use HasFactory;
    protected $fillable = [
        'key',
        'shareable_id',
        'shareable_type',
        'user_id'
    ];

    public function shareable()
    {
        return $this->morphTo();
    }
}
