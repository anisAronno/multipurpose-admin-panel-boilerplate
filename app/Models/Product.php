<?php

namespace App\Models;

use App\Helpers\FileHelpers;
use App\Helpers\UniqueSlug;
use App\Traits\CheckStatusAndFeture;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Enums\Status;
use App\Enums\Featured;
use Illuminate\Support\Carbon;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    use LogsActivity;
    use CheckStatusAndFeture;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'image',
        'price',
        'status',
        'is_featured',
        'slug',
        'user_id',
    ];
    /**
        * Override the default boot method to register some extra stuff for every child model.
        */
    protected static function boot()
    {
        static::creating(function ($model) {
            $model->slug = UniqueSlug::generate($model, 'slug', $model->title);
        });

        parent::boot();
    }
    protected static $recordEvents = ['deleted', 'created', 'updated'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['title', 'description', 'image', 'price', 'status'])
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
        'is_featured' => Featured::class,
    ];
    public function getCreatedAtAttribute($value)
    {
        if ($value !== null) {
            return  $this->attributes['created_at'] = Carbon::parse($value)->diffForHumans();
        }
    }
     /**
    * Summary of getImageAttribute
    * @param mixed $value
    * @return \Illuminate\Contracts\Routing\UrlGenerator|string
    */
     public function getImageAttribute($value)
     {
         return  $this->attributes['image'] = FileHelpers::getUrl($value);
     }

     public function categories()
     {
         return $this->belongsToMany(Category::class, 'category_product')->withTimestamps();
     }

       public function user()
       {
           return $this->belongsTo(User::class, 'user_id', 'id');
       }
}
