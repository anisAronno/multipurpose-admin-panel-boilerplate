<?php

namespace App\Models;

use App\Enums\Format;
use App\Enums\Status;
use App\Helpers\UniqueSlug;
use App\Traits\CheckStatusAndFeture;
use App\Traits\Favourable;
use App\Traits\HasAuthor;
use App\Traits\HasCategories;
use App\Traits\HasComments;
use App\Traits\HasImages;
use App\Traits\HasRatings;
use App\Traits\HasReacts;
use App\Traits\HasTags;
use App\Traits\HasVisitors; 
use App\Traits\Shareable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Blog extends Model
{
    use HasFactory;
    use SoftDeletes;
    use LogsActivity;
    use CheckStatusAndFeture;
    use HasImages;
    use HasCategories;
    use HasAuthor;
    use HasTags;
    use HasComments;
    use Favourable;
    use HasRatings;
    use HasReacts;
    use HasVisitors;
    use Shareable; 

    /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
    protected $fillable = [
        'title',
        'description',
        'short_description',
        'slug',
        'status',
        'format',
        'is_featured',
        'is_commentable',
        'is_reactable',
        'is_shareable',
        'show_ratings',
        'show_views',
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
        ->logOnly(['title', 'description', 'status'])
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
        'format' => Format::class,
    ];

}
