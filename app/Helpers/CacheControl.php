<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Cache;

class CacheControl
{
    /**
     * Cache Clear by key
     *
     * @param string $key
     * @return void
     */
    public static function clearCache(string $key)
    {
        $keys = (array) Cache::get($key, []);

        foreach ($keys as $key) {
            Cache::forget($key);
        }

        Cache::forget($key);
    }

    /**
     * Put Cache key to another key as a array
     *
     * @param string $baseCacheKey
     * @param string $newCacheKey
     * @return void
     */
    public static function updateCacheKeys(string $baseCacheKey, string $newCacheKey)
    {
        $cachedKeys = Cache::get($baseCacheKey, []);

        if (!in_array($newCacheKey, $cachedKeys)) {
            $cachedKeys[] = $newCacheKey;
            Cache::put($baseCacheKey, $cachedKeys);
        }
    }
}
