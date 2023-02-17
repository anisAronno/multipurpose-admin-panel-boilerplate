<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    protected $fillable = [
            'ip',
            'device_name',
            'os_name',
            'browser_name',
            'country_name',
            'country_code',
            'region_code',
            'region_name',
            'city_name',
            'zip_code',
            'latitude',
            'longitude',
            'time_zone',
            'area_code',
            'metro_code',
            'iso_code',
            'postal_code',
            'visitorable_id',
            'visitorable_type',
            'user_id',
    ];

    public function visitorable()
    {
        return $this->morphTo();
    }
}
