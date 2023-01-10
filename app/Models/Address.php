<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Address extends Model
{
    use HasFactory;
    use LogsActivity;
    use SoftDeletes;


    protected $fillable = [
     'addressable_type',
     'addressable_id',
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


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
