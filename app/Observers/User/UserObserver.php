<?php

namespace App\Observers\User;

use App\Helpers\FileHelpers;
use App\Models\User;
use App\Helpers\CacheHelper;
use App\Traits\ClearCache;

class UserObserver
{
    use ClearCache;

    public $key = '';

    public function __construct()
    {
        $this->key = CacheHelper::getUserCacheKey();
    }

    /**
     * Handle the User "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function created(User $user)
    {
        $this->clearCache($this->key);
    }

    /**
     * Handle the User "updated" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        $this->clearCache($this->key);
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        $this->clearCache($this->key);

        FileHelpers::deleteFile($user->avatar);
    }

    /**
     * Handle the User "restored" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        $this->clearCache($this->key);
    }

    /**
     * Handle the User "force deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        $this->clearCache($this->key);

        FileHelpers::deleteFile($user->avatar);
    }
}
