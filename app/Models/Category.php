<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use App\Emums\Status;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
    protected $fillable = [
        'title',
        'description',
        'image',
        'status',
        'user_id',
    ];

    protected static $recordEvents = ['deleted', 'created', 'updated'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['title', 'description', 'image', 'status'])
        ->logOnlyDirty()
        ->dontSubmitEmptyLogs();
    }


    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'status' => Status::class,
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'category_product')->withTimestamps();
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
