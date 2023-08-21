<?php

namespace App\Observers;

use App\Helpers\CacheHelper;

use Spatie\Permission\Contracts\Role;

class RoleObserver
{
    protected $roleCacheKey = '';

    public $userCacheKey = '';

    public function __construct()
    {
        $this->roleCacheKey = CacheHelper::getUserCacheKey();
        $this->userCacheKey = CacheHelper::getRoleCacheKey();
    }

    /**
     * Handle the Role "created" event.
     *
     * @param  \Spatie\Permission\Contracts\Role  $role
     * @return void
     */
    public function created(Role $role)
    {
        CacheHelper::forgetCache($this->roleCacheKey);
        CacheHelper::forgetCache($this->userCacheKey);
    }

    /**
     * Handle the Role "updated" event.
     *
     * @param  \Spatie\Permission\Contracts\Role  $role
     * @return void
     */
    public function updated(Role $role)
    {
        CacheHelper::forgetCache($this->roleCacheKey);
        CacheHelper::forgetCache($this->userCacheKey);
    }

    /**
     * Handle the Role "deleted" event.
     *
     * @param  \Spatie\Permission\Contracts\Role  $role
     * @return void
     */
    public function deleted(Role $role)
    {
        CacheHelper::forgetCache($this->roleCacheKey);
        CacheHelper::forgetCache($this->userCacheKey);
    }

    /**
     * Handle the Role "restored" event.
     *
     * @param  \Spatie\Permission\Contracts\Role  $role
     * @return void
     */
    public function restored(Role $role)
    {
        CacheHelper::forgetCache($this->roleCacheKey);
        CacheHelper::forgetCache($this->userCacheKey);
    }

    /**
     * Handle the Role "force deleted" event.
     *
     * @param  \Spatie\Permission\Contracts\Role  $role
     * @return void
     */
    public function forceDeleted(Role $role)
    {
        CacheHelper::forgetCache($this->roleCacheKey);
        CacheHelper::forgetCache($this->userCacheKey);
    }
}
