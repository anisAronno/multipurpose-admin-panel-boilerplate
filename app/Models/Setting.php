<?php

namespace App\Models;

use App\Helpers\FileHelpers;
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
            return  $this->attributes['fav_icon'] = FileHelpers::getUrl($value);
        } else {
            return  $this->attributes['fav_icon'] = FileHelpers::getUrl('uploads/settings/fav_icon.png');
        }
    }

    public function getLogoAttribute($value)
    {
        if ($value !== null) {
            return  $this->attributes['logo'] = FileHelpers::getUrl($value);
        } else {
            return  $this->attributes['logo'] = FileHelpers::getUrl('uploads/settings/logo.png');
        }
    }

    public function getBannerAttribute($value)
    {
        if ($value !== null) {
            return  $this->attributes['banner'] = FileHelpers::getUrl($value);
        } else {
            return  $this->attributes['banner'] = FileHelpers::getUrl('uploads/settings/banner.png');
        }
    }

    protected $casts = [
      'social' => 'array',
      'address' => 'array',
    ];

    /**
     * Summary of images
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
