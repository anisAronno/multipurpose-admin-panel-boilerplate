<?php

namespace App\Observers\User;

use AnisAronno\LaravelCacheMaster\CacheControl;
use AnisAronno\MediaHelper\Facades\Media;
use App\Helpers\CacheKey;
use App\Models\User;

class UserObserver
{
    public $key = '';

    public function __construct()
    {
        $this->key = CacheKey::getUserCacheKey();
    }

    /**
     * Handle the User "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function created(User $user)
    {
        CacheControl::forgetCache($this->key);
    }

    /**
     * Handle the User "updated" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        CacheControl::forgetCache($this->key);
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        CacheControl::forgetCache($this->key);

        Media::delete($user->avatar);
    }

    /**
     * Handle the User "restored" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        CacheControl::forgetCache($this->key);
    }

    /**
     * Handle the User "force deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        CacheControl::forgetCache($this->key);

        Media::delete($user->avatar);
    }
}
