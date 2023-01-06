<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LoginHistory extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        "device_name",
        "country_name",
        "country_code",
        "region_code",
        "region_name",
        "city_name",
        "zip_code",
        "latitude",
        "longitude",
        "time_zone"
    ];
}
