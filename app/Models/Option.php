<?php

namespace App\Models;

use App\Enums\SettingsFields;
use AnisAronno\MediaHelper\Facades\Media;
use App\Traits\OptionTransform;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Option extends Model
{
    use HasFactory;
    use OptionTransform;
    use LogsActivity;

    protected $fillable = [
        'option_key',
        'option_value',
    ];

    protected $primaryKey = 'option_key';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $appends = ['isDeletable'];

    protected static $recordEvents = ['deleted', 'created', 'updated'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['option_meta', 'option_value'])
        ->logOnlyDirty()
        ->dontSubmitEmptyLogs();
    }

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
        $isFile = Media::isAllowedFileType($value);

        if ($isFile) {
            $value = Media::getURL($value);
            return $value;
        }

        return $value;
    }
}
