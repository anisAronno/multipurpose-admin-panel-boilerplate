<?php

namespace App\Models;

use App\Enums\Status;
use App\Traits\HasImages;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;
    use LogsActivity;
    use HasImages;

    /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
    protected $fillable = [
        'description',
        'commentable_id',
        'commentable_type',
        'parent_id',
        'status',
        'user_id',
    ];

    protected static $recordEvents = ['deleted', 'updated'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['status'])
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

    public function scopeIsActive($query)
    {
        return $query->where('status', '=', Status::PUBLISHED);
    }
    public function commentable()
    {
        return $this->morphTo();
    }
}
