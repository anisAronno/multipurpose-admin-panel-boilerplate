<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Cache;

class CacheHelper
{
    public static function getRoleCacheKey(): string
    {
        return '_role_';
    }

    public static function getUserCacheKey(): string
    {
        return '_user_';
    }

    public static function getOptionsCacheKey(): string
    {
        return '_option_';
    }
    public static function getProductCacheKey(): string
    {
        return '_product_';
    }
    public static function getFeaturedProductCacheKey(): string
    {
        return '_featured_product_';
    }
    public static function getBlogCacheKey(): string
    {
        return '_blog_';
    }
    public static function getFeaturedBlogCacheKey(): string
    {
        return '_featured_blog_';
    }
    public static function getCategoryCacheKey(): string
    {
        return '_category_';
    }

    public static function getTagCacheKey(): string
    {
        return '_tag_';
    }

     public static function getFeaturedCategoryCacheKey(): string
     {
         return '_featured_category_';
     }


    public static function getContactCacheKey(): string
    {
        return '_contact_';
    }


    public static function getSpecialFeatureCacheKey(): string
    {
        return '_category_';
    }

    public static function getImageCacheKey(): string
    {
        return '_image_';
    }

    public static function forgetCache($key)
    {
        logger()->debug($key);
        Cache::tags($key)->flush();
    }
}
