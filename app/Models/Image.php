<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Image extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = [
        'imageable_type',
        'imageable_id',
        'title',
        'url',
        'mimes',
        'type',
        'size',
    ];

    protected static $recordEvents = ['deleted', 'created', 'updated'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['url', 'title'])
        ->logOnlyDirty()
        ->dontSubmitEmptyLogs();
    }

    public function imageable()
    {
        return $this->morphTo();
    }
}
