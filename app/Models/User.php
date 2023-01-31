<?php

namespace App\Models;

use App\Enums\UserGender;
use App\Enums\UserStatus;
use App\Helpers\FileHelpers;
use App\Helpers\UniqueSlug;
use App\Notifications\ResetPasswordNotification;
use App\Notifications\VerifyEmailQueued;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;
use Ramsey\Uuid\Uuid;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use HasRoles;
    use SoftDeletes;
    use LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'avatar',
        'status',
        'password',
        'email_verified_at',
        'gender',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at' => 'datetime',
        'status' => UserStatus::class,
        'gender' => UserGender::class,
    ];

    protected static $recordEvents = ['deleted', 'created', 'updated'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['name', 'email', 'password', 'avatar', 'status'])
        ->logOnlyDirty()
        ->dontSubmitEmptyLogs();
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmailQueued());
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    /**
     * Override the default boot method to register some extra stuff for every child model.
     */
    protected static function boot()
    {
        static::creating(function ($model) {
            $model->token = Uuid::uuid4()->toString();
            $model->username = UniqueSlug::generate($model, 'username', $model->name);
        });

        parent::boot();
    }

    /**
     * Picture
     *
     * @param [type] $uid
     * @return void
     */
    public function getAvatarAttribute($value)
    {
        if ($value !== null) {
            return  $this->attributes['avatar'] = FileHelpers::getUrl($value);
        } else {
            return  $this->attributes['avatar'] = FileHelpers::getUrl('images/defaults/avatar.png');
        }
    }

    public static function getpermissionGroups()
    {
        $permission_groups = DB::table('permissions')
            ->select('group_name as name')
            ->groupBy('group_name')
            ->get();

        return $permission_groups;
    }

    public static function getpermissionsByGroupName($group_name)
    {
        $permissions = DB::table('permissions')
            ->select('name', 'id')
            ->where('group_name', $group_name)
            ->get();

        return $permissions;
    }

    public static function roleHasPermissions($role, $permissions)
    {
        $hasPermission = true;
        foreach ($permissions as $permission) {
            if (! $role->hasPermissionTo($permission->name)) {
                $hasPermission = false;

                return $hasPermission;
            }
        }

        return $hasPermission;
    }

     protected $appends = ['isDeletable', 'isEditable'];

    public function getIsDeletableAttribute($value)
    {
        if ($this->id === 1) {
            return false;
        } else {
            return true;
        }
    }

       public function getIsEditableAttribute($value)
       {
           if ($this->id == 1) {
               return false;
           } else {
               return true;
           }
       }

     public function addresses()
     {
         return $this->hasMany(Address::class, 'user_id', 'id');
     }

     public function socialLogins()
     {
         return $this->hasMany(SocialLogin::class, 'user_id', 'id');
     }

     public function loginHistories()
     {
         return $this->hasMany(LoginHistory::class, 'user_id', 'id');
     }
     public function categories()
     {
         return $this->hasMany(Category::class, 'user_id', 'id');
     }
     public function products()
     {
         return $this->hasMany(Product::class, 'user_id', 'id');
     }
     public function blogs()
     {
         return $this->hasMany(Blog::class, 'user_id', 'id');
     }
}
