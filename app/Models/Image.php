<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Image extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = [
    'imageable_type',
    'imageable_id',
    'key',
    'image',
    ];

    protected static $recordEvents = ['deleted', 'created', 'updated'];
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['image', 'key'])
        ->logOnlyDirty()
        ->dontSubmitEmptyLogs();
    }

    public function imageable()
    {
        return $this->morphTo();
    }
}
