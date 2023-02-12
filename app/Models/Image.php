<?php

namespace App\Models;

use App\Helpers\FileHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Image extends Model
{
    use HasFactory;
    use LogsActivity;

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


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
