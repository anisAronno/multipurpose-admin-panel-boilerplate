<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Contact extends Model
{
    use HasFactory;
    use SoftDeletes;
    use LogsActivity;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'ip',
    ];

    protected static $recordEvents = ['deleted', 'updated'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly([
                    'name',
                    'email',
                    'phone',
                    'subject',
                    'message',
                    'ip'
                ])
        ->logOnlyDirty()
        ->dontSubmitEmptyLogs();
    }
}
