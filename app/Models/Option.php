<?php

namespace App\Models;

use App\Traits\TransformOptions;
use App\Enums\SettingsFields;
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

    protected $appends = array('isDeletable');

    public function getIsDeletableAttribute($value)
    {
        $settingFields = SettingsFields::values();

        if (! in_array($this->option_key, $settingFields)) {
            return true;
        } else {
            return false;
        }
    }

     /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'option_key';
    }
}
