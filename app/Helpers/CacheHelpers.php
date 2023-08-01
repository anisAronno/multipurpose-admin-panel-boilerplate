<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class CacheHelpers
{
    public static function getCacheDriver($key= null)
    {
        return Cache::getDefaultDriver();

    }
    public static function getCacheKeys($key= null)
    {

        switch (self::getCacheDriver()) {
            case 'file':
                return self::getFileCacheKeys();
            case 'redis':
                return self::getRedisCacheKeys($key);
            case 'memcached':
                return self::getMemcachedCacheKeys($key);
            default:
                return [];
        }
    }

    /**
     * Get File Cache path
     *
     * @return array
     */
    protected static function getFileCacheKeys()
    {
        $storage = Cache::getStore();
        $filesystem = $storage->getFilesystem();

        $cachePath = $storage->getDirectory();

        $keys = [];
        $files = $filesystem->allFiles($cachePath);

        foreach ($files as $file) {
            $cacheKey = str_replace([$cachePath, DIRECTORY_SEPARATOR, '.php'], '', $file);
            $keys[] = $cacheKey;
        }

        return $keys;
    }

    /**
     * Get Redis cache key
     *
     * @param [type] $key
     * @return array
     */
    protected static function getRedisCacheKeys($key = null)
    {
        try {
            $cacheKeys = Redis::connection('cache')->keys('*');

            $modifiedKeys = [];

            foreach ($cacheKeys as $element) {
                if ($key === null) {
                    if (preg_match('/^.*:(.*)$/', $element, $matches)) {
                        $modifiedKeys[] = $matches[1];
                    }
                } else {
                    if (preg_match('/^.*:' . preg_quote($key) . '(.*)$/', $element, $matches)) {
                        $modifiedKeys[] = $key . $matches[1];
                    }
                }
            }

            return $modifiedKeys;
        } catch (\Throwable $e) {
            return [];
        }
    }

    /**
     * get memcache key
     *
     * @param [type] $key
     * @return array
     */
    protected static function getMemcachedCacheKeys($key = null)
    {
        try {
            $cacheKeys = [];
            $memcached = app('cache')->getStore()->getMemcached();
            $allKeys = $memcached->getAllKeys();

            foreach ($allKeys as $element) {
                if ($key === null) {
                    if (preg_match('/^.*:(.*)$/', $element, $matches)) {
                        $cacheKeys[] = $matches[1];
                    }
                } else {
                    if (preg_match('/^.*:' . preg_quote($key) . '(.*)$/', $element, $matches)) {
                        $cacheKeys[] = $key . $matches[1];
                    }
                }
            }

            return $cacheKeys;
        } catch (\Throwable $e) {
            return [];
        }
    }


}
