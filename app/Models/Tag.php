<?php

namespace App\Models;

use App\Helpers\UniqueSlug;
use App\Traits\HasAuthor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    use HasAuthor;

    /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
    protected $fillable = [
        'title',
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

    public function blogs()
    {
        return $this->morphedByMany(Blog::class, 'taggable');
    }
    public function products()
    {
        return $this->morphedByMany(Product::class, 'taggable');
    }
}
