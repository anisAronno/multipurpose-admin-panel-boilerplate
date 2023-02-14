<?php

namespace App\Helpers;

class CacheHelper
{
    public static function getRoleCacheKey(int $token = null): string
    {
        return 'role'.$token."_cache_";
    }

    public static function getUserCacheKey(int $token = null): string
    {
        return 'user'.$token."_cache_";
    }

    public static function getOptionsCacheKey(int $token = null): string
    {
        return 'option'.$token."_cache_";
    }
    public static function getProductCacheKey(int $token = null): string
    {
        return 'product'.$token."_cache_";
    }
    public static function getFeaturedProductCacheKey(int $token = null): string
    {
        return 'featured_product'.$token."_cache_";
    }
    public static function getBlogCacheKey(int $token = null): string
    {
        return 'blog'.$token."_cache_";
    }
    public static function getFeaturedBlogCacheKey(int $token = null): string
    {
        return 'featured_blog'.$token."_cache_";
    }
    public static function getCategoryCacheKey(int $token = null): string
    {
        return 'category'.$token."_cache_";
    }

    public static function getTagCacheKey(int $token = null): string
    {
        return 'tag'.$token."_cache_";
    }

     public static function getFeaturedCategoryCacheKey(int $token = null): string
     {
         return 'featured_category'.$token."_cache_";
     }


    public static function getContactCacheKey(int $token = null): string
    {
        return 'contact'.$token."_cache_";
    }


    public static function getSpecialFeatureCacheKey(int $token = null): string
    {
        return 'category'.$token."_cache_";
    }

    public static function getImageCacheKey(int $token = null): string
    {
        return 'image'.$token."_cache_";
    }
}
