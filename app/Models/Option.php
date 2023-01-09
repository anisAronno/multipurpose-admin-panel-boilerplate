<?php

namespace App\Models;

use App\Helpers\FileHelpers;
use App\Traits\OptionTransform;
use App\Enums\SettingsFields;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;
    use OptionTransform;

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


    public function getOptionValueAttribute($value)
    {
        $isFile = FileHelpers::isAllowFileType($value);

        if ($isFile) {
            $value =  FileHelpers::getUrl($value);
        }

        return $value;
    }
}
