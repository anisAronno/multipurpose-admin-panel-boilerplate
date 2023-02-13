<?php

namespace App\Traits;

use App\Models\User;

trait SuperAdminPolicy
{
    /**
    * Perform pre-authorization checks.
    *
    * @param  \App\Models\User  $user
    * @param  string  $ability
    * @return void|bool
    */
    public function before(User $user, $ability)
    {
        if ($user->isSuperAdmin()) {
            return true;
        }
    }
}
