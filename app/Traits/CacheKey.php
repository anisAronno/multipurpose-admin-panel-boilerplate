<?php

namespace App\Traits;

trait CacheKey
{
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
