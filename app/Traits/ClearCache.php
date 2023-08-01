<?php

namespace App\Traits;

use App\Helpers\CacheHelpers;
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
        $allKeys = CacheHelpers::getCacheKeys($key);
        foreach ($allKeys as  $oldKey) {
            if (Cache::has($oldKey)) {
                Cache::forget($oldKey);
            }
        }
    }

}
