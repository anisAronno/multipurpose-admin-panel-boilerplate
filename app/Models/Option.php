<?php

namespace App\Models;

use App\Traits\TransformOptions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;
    use TransformOptions;

    protected $fillable = [
        'option_key',
        'option_value'
    ];

}
