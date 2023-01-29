<?php

namespace App\Observers;

use App\Services\Cache\CacheServices;
use App\Traits\ClearCache;
use Spatie\Permission\Contracts\Role;

class RoleObserver
{
    use ClearCache;

    protected $roleCacheKey = '';

    protected $userCacheKey = '';

    public function __construct()
    {
        $this->roleCacheKey = CacheServices::getUserCacheKey();
        $this->userCacheKey = CacheServices::getRoleCacheKey();
    }

    /**
     * Handle the Role "created" event.
     *
     * @param  \Spatie\Permission\Contracts\Role  $role
     * @return void
     */
    public function created(Role $role)
    {
        $this->clearCache($this->roleCacheKey);
        $this->clearCache($this->userCacheKey);
    }

    /**
     * Handle the Role "updated" event.
     *
     * @param  \Spatie\Permission\Contracts\Role  $role
     * @return void
     */
    public function updated(Role $role)
    {
        $this->clearCache($this->roleCacheKey);
        $this->clearCache($this->userCacheKey);
    }

    /**
     * Handle the Role "deleted" event.
     *
     * @param  \Spatie\Permission\Contracts\Role  $role
     * @return void
     */
    public function deleted(Role $role)
    {
        $this->clearCache($this->roleCacheKey);
        $this->clearCache($this->userCacheKey);
    }

    /**
     * Handle the Role "restored" event.
     *
     * @param  \Spatie\Permission\Contracts\Role  $role
     * @return void
     */
    public function restored(Role $role)
    {
        $this->clearCache($this->roleCacheKey);
        $this->clearCache($this->userCacheKey);
    }

    /**
     * Handle the Role "force deleted" event.
     *
     * @param  \Spatie\Permission\Contracts\Role  $role
     * @return void
     */
    public function forceDeleted(Role $role)
    {
        $this->clearCache($this->roleCacheKey);
        $this->clearCache($this->userCacheKey);
    }
}
