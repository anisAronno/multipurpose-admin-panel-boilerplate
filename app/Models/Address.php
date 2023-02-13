<?php

namespace App\Models;

use App\Traits\HasAuthor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Address extends Model
{
    use HasFactory;
    use LogsActivity;
    use SoftDeletes;
    use HasAuthor;

    protected $fillable = [
        'title',
        'address',
        'city',
        'state',
        'district',
        'zip_code',
        'country',
        'user_id',
    ];

    protected static $recordEvents = ['deleted', 'created', 'updated'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['country', 'district', 'city', 'address'])
        ->logOnlyDirty()
        ->dontSubmitEmptyLogs();
    }
 
}
