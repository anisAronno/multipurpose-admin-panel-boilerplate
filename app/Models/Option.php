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

    protected $primaryKey = 'option_key';

    public $incrementing = false;

    protected $keyType = 'string';

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
}
