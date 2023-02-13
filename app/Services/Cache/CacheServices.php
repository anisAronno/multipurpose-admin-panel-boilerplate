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
    public static function getFeaturedProductCacheKey(int $token = null): string
    {
        return 'featured_product'.$token;
    }
    public static function getBlogCacheKey(int $token = null): string
    {
        return 'blog'.$token;
    }
    public static function getFeaturedBlogCacheKey(int $token = null): string
    {
        return 'featured_blog'.$token;
    }
    public static function getCategoryCacheKey(int $token = null): string
    {
        return 'category'.$token;
    }

    public static function getTagCacheKey(int $token = null): string
    {
        return 'tag'.$token;
    }

     public static function getFeaturedCategoryCacheKey(int $token = null): string
     {
         return 'featured_category'.$token;
     }


    public static function getContactCacheKey(int $token = null): string
    {
        return 'contact'.$token;
    }


    public static function getSpecialFeatureCacheKey(int $token = null): string
    {
        return 'category'.$token;
    }

    public static function getImageCacheKey(int $token = null): string
    {
        return 'image'.$token;
    }
}
