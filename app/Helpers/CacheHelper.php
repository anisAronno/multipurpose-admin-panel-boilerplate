<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class CacheHelper
{
    public static function init($key)
    {
        if (CacheHelper::supportTag()) {
            return Cache::tags($key);
        } else {
            return cache();
        }
    }


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


    public static function supportTag()
    {
        if (! in_array(self::getCacheDriver(), ['file', 'dynamodb', 'database'])) {
            return true;
        } else {
            return false;
        }

    }

    public static function forgetCache($key)
    {
        if (self::supportTag()) {
            return self::forgetCacheByTag($key);
        } else {
            return self::forgetCacheByKey($key);
        }

    }

    /**
     * Get File Cache path
     *
     * @return array
     */
    private static function getFileCacheKeys(): array
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
    private static function getRedisCacheKeys($key = null): array
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
    private static function getMemcachedCacheKeys($key = null): array
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


    /**
     * forget cache key by Tag
     *
     * @param [type] $key
     * @return void
     */
    private static function forgetCacheByTag($key)
    {
        Cache::tags($key)->flush();
    }

    /**
     * Forget Cache key by tag
     *
     * @param [type] $key
     * @return void
     */
    private static function forgetCacheByKey($key)
    {
        try {
            $allKeys = CacheHelper::getCacheKeys($key);
            foreach ($allKeys as  $oldKey) {
                if (Cache::has($oldKey)) {
                    Cache::forget($oldKey);
                } else {
                    Artisan::call('cache:clear');
                    break;
                }
            }
        } catch (\Throwable $th) {
            logger()->info($th->getMessage());
        }
    }


    public static function getRoleCacheKey(): string
    {
        return 'role_';
    }

    public static function getUserCacheKey(): string
    {
        return 'user_';
    }

    public static function getOptionsCacheKey(): string
    {
        return 'option_';
    }
    public static function getProductCacheKey(): string
    {
        return 'product_';
    }
    public static function getFeaturedProductCacheKey(): string
    {
        return 'featured_product_';
    }
    public static function getBlogCacheKey(): string
    {
        return 'blog_';
    }
    public static function getFeaturedBlogCacheKey(): string
    {
        return 'featured_blog_';
    }
    public static function getCategoryCacheKey(): string
    {
        return 'category_';
    }

    public static function getFeaturedCategoryCacheKey(): string
    {
        return 'featured_category_';
    }


    public static function getContactCacheKey(): string
    {
        return 'contact_';
    }


    public static function getSpecialFeatureCacheKey(): string
    {
        return 'category_';
    }

}
