<?php

namespace App\Models;

use App\Services\FileServices;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
            'site_name',
            'site_title',
            'logo',
            'banner',
            'fav_icon',
            'copyright_message',
            'copyright_name',
            'copyright_url',
            'design_develop_by',
            'design_develop_by_url',
            'address',
            'social'
        ];

    public function getFavIconAttribute($value)
    {
        if ($value !== null) {
            return  $this->attributes['fav_icon'] = FileServices::getUrl($value);
        } else {
            return  $this->attributes['fav_icon'] = FileServices::getUrl('uploads/settings/fav_icon.png');
        }
    }

    public function getLogoAttribute($value)
    {
        if ($value !== null) {
            return  $this->attributes['logo'] = FileServices::getUrl($value);
        } else {
            return  $this->attributes['logo'] = FileServices::getUrl('uploads/settings/logo.png');
        }
    }

    public function getBannerAttribute($value)
    {
        if ($value !== null) {
            return  $this->attributes['banner'] = FileServices::getUrl($value);
        } else {
            return  $this->attributes['banner'] = FileServices::getUrl('uploads/settings/banner.png');
        }
    }

    protected $casts = [
      'social' => 'array',
      'address' => 'array',
    ];
}
