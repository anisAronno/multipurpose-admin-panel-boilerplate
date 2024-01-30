<?php

namespace App\Traits;

use App\Enums\SettingsFields;
use App\Helpers\CacheControl;
use App\Helpers\CacheKey;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Artisan;

trait OptionTransform
{
    public static function getOption(string $key)
    {
        $baseCacheKey = CacheKey::getOptionsCacheKey();
        $cacheKey = $baseCacheKey . md5(serialize(['getOption', $key]));

        $option = Cache::remember($cacheKey, now()->addDay(), function () use ($key) {
            $option = self::where('option_key', $key)->first();
            return $option ? $option['option_value'] : null;
        });

        CacheControl::updateCacheKeys($baseCacheKey, $cacheKey);
        return $option;
    }

    public static function getAllOptions()
    {
        $baseCacheKey = CacheKey::getOptionsCacheKey();
        $cacheKey = $baseCacheKey . md5(serialize(['getAllOptions']));

        $options = Cache::remember($cacheKey, now()->addDay(), function () {
            return self::select('option_value', 'option_key')
                ->orderBy('option_key', 'asc')
                ->get()
                ->pluck('option_value', 'option_key')
                ->toArray();
        });

        CacheControl::updateCacheKeys($baseCacheKey, $cacheKey);
        return $options;
    }

    public static function updateOption(string $key, $value = '')
    {
        try {
            $option = self::where('option_key', $key)->first();
            if ($option) {
                $option->option_value = $value;
                $result = $option->save();
            }

            if ($key == 'language') {
                Artisan::call('cache:clear');
                Artisan::call('config:clear');
            }

            return $result ?? false;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public static function setOption(string $key, $value = '')
    {
        try {
            return self::create(['option_key' => $key, 'option_value' => $value]);
        } catch (\Throwable $th) {
            return false;
        }
    }

    public static function getSettings()
    {
        $baseCacheKey = CacheKey::getOptionsCacheKey();
        $cacheKey = $baseCacheKey . md5(serialize(['getSettings']));

        $settings = Cache::remember($cacheKey, now()->addDay(), function () {
            $settingFields = SettingsFields::values();

            return self::select('option_value', 'option_key')
                ->whereIn('option_key', $settingFields)
                ->orderBy('option_key', 'asc')
                ->get()
                ->pluck('option_value', 'option_key')
                ->toArray();
        });

        CacheControl::updateCacheKeys($baseCacheKey, $cacheKey);
        return $settings;
    } 
}
