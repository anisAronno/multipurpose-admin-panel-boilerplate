<?php

namespace App\Models;

use App\Enums\Format;
use App\Helpers\UniqueSlug;
use App\Traits\Categoryable;
use App\Traits\CheckStatusAndFeture;
use App\Traits\Commentable;
use App\Traits\Favourable;
use App\Traits\HasAuthor;
use App\Traits\Imageable;
use App\Traits\Ratingable;
use App\Traits\Reactable; 
use App\Traits\Searchable;
use App\Traits\Shareable;
use App\Traits\Taggable;
use App\Traits\Visitorable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Enums\Status;

class Blog extends Model
{
    use HasFactory;
    use SoftDeletes;
    use LogsActivity;
    use CheckStatusAndFeture;
    use Imageable;
    use Categoryable;
    use HasAuthor;
    use Taggable;
    use Commentable;
    use Favourable;
    use Ratingable;
    use Reactable; 
    use Visitorable;
    use Shareable;
    use Searchable;

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
