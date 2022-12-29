<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Enums\UserStatus;
use App\Notifications\VerifyEmailQueued;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use HasRoles;
    use SoftDeletes;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'status' => UserStatus::class,
    ];

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmailQueued());
    }

      /**
     * Picture
     *
     * @param [type] $uid
     * @return void
     */
    public function getPictureAttribute($value)
    {
        if ($value !== null) {
            return  $this->attributes['picture'] = url($value);
        } else {
            return  $this->attributes['picture'] = url('uploads/users/avatar.png');
        }
    }
}
