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
}
