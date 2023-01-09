<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Address extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = [
     'addressable_type',
     'addressable_id',
     'address',
     'city',
     'state',
     'district',
     'zip_code',
     'country',
    ];

    protected static $recordEvents = ['deleted', 'created', 'updated'];
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['country', 'district', 'city', 'address'])
        ->logOnlyDirty()
        ->dontSubmitEmptyLogs();
    }


    public function addressable()
    {
        return $this->morphTo();
    }
}
