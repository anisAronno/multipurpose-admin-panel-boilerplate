<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SocialLogin extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
            'socilloginable_type',
            'socilloginable_id',
            "sso_provider", 
            "sso_id",
            "sso_token",
            "sso_refresh_token",
        ];


    public function socilloginable()
    {
        return $this->morphTo();
    }
}
