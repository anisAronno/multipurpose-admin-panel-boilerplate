<?php

namespace App\Traits;

use Illuminate\Support\Facades\Cache;

trait ClearCache
{
    /**
     * This function is responsible for clearing the cache when a specific cache key is passed.
     * It is useful for paginated Resources that are cached
     *
     * @param  int  $key The cache key index
     */
    public function clearCache($key)
    {
        Cache::tags($key)->flush();
    }
}
