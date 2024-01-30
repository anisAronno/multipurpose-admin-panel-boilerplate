<?php

namespace App\Observers;

use App\Helpers\CacheControl;
use App\Helpers\CacheKey;
use Spatie\Permission\Contracts\Role;

class RoleObserver
{
    protected $roleCacheKey = '';

    public $userCacheKey = '';

    public function __construct()
    {
        $this->roleCacheKey = CacheKey::getUserCacheKey();
        $this->userCacheKey = CacheKey::getRoleCacheKey();
    }

    /**
     * Handle the Role "created" event.
     *
     * @param  \Spatie\Permission\Contracts\Role  $role
     * @return void
     */
    public function created(Role $role)
    {
        CacheControl::clearCache($this->roleCacheKey);
        CacheControl::clearCache($this->userCacheKey);
    }

    /**
     * Handle the Role "updated" event.
     *
     * @param  \Spatie\Permission\Contracts\Role  $role
     * @return void
     */
    public function updated(Role $role)
    {
        CacheControl::clearCache($this->roleCacheKey);
        CacheControl::clearCache($this->userCacheKey);
    }

    /**
     * Handle the Role "deleted" event.
     *
     * @param  \Spatie\Permission\Contracts\Role  $role
     * @return void
     */
    public function deleted(Role $role)
    {
        CacheControl::clearCache($this->roleCacheKey);
        CacheControl::clearCache($this->userCacheKey);
    }

    /**
     * Handle the Role "restored" event.
     *
     * @param  \Spatie\Permission\Contracts\Role  $role
     * @return void
     */
    public function restored(Role $role)
    {
        CacheControl::clearCache($this->roleCacheKey);
        CacheControl::clearCache($this->userCacheKey);
    }

    /**
     * Handle the Role "force deleted" event.
     *
     * @param  \Spatie\Permission\Contracts\Role  $role
     * @return void
     */
    public function forceDeleted(Role $role)
    {
        CacheControl::clearCache($this->roleCacheKey);
        CacheControl::clearCache($this->userCacheKey);
    }
}
