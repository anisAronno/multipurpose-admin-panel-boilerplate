<?php

namespace App\Policies;

use App\Models\Option;
use App\Models\User;
use App\Traits\SuperAdminPolicy;
use Illuminate\Auth\Access\HandlesAuthorization;

class OptionPolicy
{
    use HandlesAuthorization;
    use SuperAdminPolicy;


    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Option $option)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Option $option)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Option $option)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Option $option)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Option $option)
    {
        return false;
    }
}
