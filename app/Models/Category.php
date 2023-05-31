<?php

namespace App\Models;

use App\Enums\Featured;
use App\Enums\Status;
use App\Helpers\FileHelpers;
use App\Helpers\UniqueSlug;
use App\Traits\CheckStatusAndFeture;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Category extends Model
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
        'status',
        'is_featured',
        'slug',
        'user_id',
        'parent_id'
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
        'is_featured' => Featured::class,
    ];

    /**
     * Summary of getImageAttribute
     * @param mixed $value
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public function getImageAttribute($value)
    {
        return  $this->attributes['image'] = FileHelpers::getUrl($value);
    }

    public function getCreatedAtAttribute($value)
    {
        if ($value !== null) {
            return  $this->attributes['created_at'] = Carbon::parse($value)->diffForHumans();
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }

    public function blogs()
    {
        return $this->morphedByMany(Blog::class, 'categoryable');
    }
    public function products()
    {
        return $this->morphedByMany(Product::class, 'categoryable');
    }



    public static function tree($nested = true)
    {
        $query = Category::select('id as value', 'title as label', 'parent_id', 'slug');

        return self::buildTree($query, $nested);
    }

    public static function productTree($nested = true)
    {
        $query = Category::select('id as value', 'title as label', 'parent_id', 'slug')
            ->isActive()
            ->has('products', '>=', 1)
            ->withCount('products')
            ->orderByDesc('products_count');

        return self::buildTree($query, $nested);
    }

    public static function blogTree($nested = true)
    {
        $query = Category::select('id as value', 'title as label', 'parent_id', 'slug')
            ->isActive()
            ->has('blogs', '>=', 1)
            ->withCount('blogs')
            ->orderByDesc('blogs_count');

        return self::buildTree($query, $nested);
    }

    private static function buildTree($query, $nested)
    {
        $allCategories = $query->get();
        $rootCategories = $allCategories->whereNull('parent_id');

        if ($nested) {
            self::buildNestedTree($rootCategories, $allCategories);
            return $rootCategories;
        } else {
            $formattedCategories = [];
            self::buildFlatTree($rootCategories, $allCategories, $formattedCategories);
            return $formattedCategories;
        }
    }

    private static function buildNestedTree(&$categories, $allCategories)
    {
        foreach ($categories as $category) {
            $children = $allCategories->where('parent_id', $category->value)->values();
            if ($children->isNotEmpty()) {
                $category->children = $children;
                self::buildNestedTree($category->children, $allCategories);
            }
        }
    }

    private static function buildFlatTree($categories, $allCategories, &$result, $prefix = '', $depth = 0)
    {
        foreach ($categories as $category) {
            $categoryData = [
                'value' => $category->value,
                'label' => $prefix . $category->label,
                'parent_id' => $category->parent_id,
            ];

            $result[] = $categoryData;

            $children = $allCategories->where('parent_id', $category->value);
            self::buildFlatTree($children, $allCategories, $result, $prefix . '-', $depth + 1);
        }
    }

}
