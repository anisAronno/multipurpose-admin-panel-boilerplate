<?php

namespace App\Models;

use App\Helpers\FileHelpers;
use App\Traits\HasAuthor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Image extends Model
{
    use HasFactory;
    use LogsActivity;
    use HasAuthor;

    protected $fillable = [
        'title',
        'url',
        'mimes',
        'type',
        'size',
        'user_id',
    ];

    protected static $recordEvents = ['deleted', 'created', 'updated'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['url', 'title'])
        ->logOnlyDirty()
        ->dontSubmitEmptyLogs();
    }



    public function getUrlAttribute($value)
    {
        return  $this->attributes['url'] = FileHelpers::getUrl($value);
    }
}
