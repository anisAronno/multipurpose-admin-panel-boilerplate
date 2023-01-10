<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LoginHistory extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = true;
    protected $fillable = [
        "ip.
        auth_source,
        device_name,
        os_name,
        browser_name,
        country_name,
        country_code,
        region_code,
        region_name,
        city_name,
        zip_code,
        latitude,
        longitude,
        time_zone,
        area_code,
        metro_code,
        iso_code,
        postal_code,
        user_id"
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
