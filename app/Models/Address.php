<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
       protected $fillable = [
        'addressable_type',
        'addressable_id',
        'address',
        'city',
        'state',
        'district',
        'zip_code',
        'country',
    ];

    public function addressable()
    {
        return $this->morphTo();
    }
}
