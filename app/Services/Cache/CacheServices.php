<?php

namespace App\Services\Cache;

class CacheServices
{
    public static function getRoleCacheKey(int $token = null): string
    {
        return 'role'.$token;
    }

    public static function getUserCacheKey(int $token = null): string
    {
        return 'user'.$token;
    }

    public static function getOptionsCacheKey(int $token = null): string
    {
        return 'option'.$token;
    }
    public static function getProductCacheKey(int $token = null): string
    {
        return 'product'.$token;
    }
    public static function getFeatureProductCacheKey(int $token = null): string
    {
        return 'feature_product'.$token;
    }
    public static function getBlogCacheKey(int $token = null): string
    {
        return 'blog'.$token;
    }
    public static function getCategoryCacheKey(int $token = null): string
    {
        return 'category'.$token;
    }

     public static function getFeatureCategoryCacheKey(int $token = null): string
    {
        return 'feature_category'.$token;
    }
}
