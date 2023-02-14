<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\CheckStatusAndFeture;
use App\Traits\Imageable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use App\Enums\Status;
use Spatie\Activitylog\Traits\LogsActivity;

class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;
    use LogsActivity;
    use CheckStatusAndFeture;
    use Imageable;

    /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
    protected $fillable = [
        'title',
        'description',
        'status',
        'parent_id',
        'user_id',
    ];

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
    ];

    /**
     * Mapping For Sub and sub-sub comment
     */
    public static function tree()
    {
        $allComments = Comment::get();

        $rootComments = $allComments->whereNull('parent_id');

        self::formatTree($rootComments, $allComments);

        return $rootComments;
    }

    private static function formatTree($comments, $allComments)
    {
        foreach ($comments as $comment) {
            $comment->children = $allComments->where('parent_id', $comment->id)->values();

            if ($comment->children->isNotEmpty()) {
                self::formatTree($comment->children, $allComments);
            }
        }
    }

    public function blogs()
    {
        return $this->morphedByMany(Blog::class, 'commnetable');
    }
    public function products()
    {
        return $this->morphedByMany(Product::class, 'commnetable');
    }
}
