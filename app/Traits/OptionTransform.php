<?php

namespace App\Traits;

use App\Enums\SettingsFields;
use App\Helpers\LanguageHelper;
use App\Services\Cache\CacheServices;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;

trait OptionTransform
{
    public static function getAllOptions()
    {
        $key = CacheServices::getOptionsCacheKey(1);

        try {
            $options = Cache::remember($key, 10, function () {
                $response = self::select('option_value', 'option_key')->orderBy('option_key', 'asc')->get()->flatMap(function ($name) {
                    return array_merge([$name->option_key => $name->option_value], ['existing_language_file'=> LanguageHelper::getExistingLanguaseFile()]);
                });

                return $response;
            });

            if ($options) {
                return $options;
            } else {
                return [];
            }
        } catch (\Throwable $th) {
            return [];
        }
    }

    public static function updateOption(string $key, $value = '')
    {
        try {
            $option = self::where('option_key', $key)->first();
            $option->option_value = $value;

            return $option->save();
        } catch (\Throwable $th) {
            return false;
        }
    }

    public static function setOption(string $key, $value = '')
    {
        $data = ['option_key' => $key, 'option_value' => $value];

        try {
            return self::create($data);
        } catch (\Throwable $th) {
            return false;
        }
    }

    public static function getOption(string $key)
    {
        try {
            $option = self::where('option_key', $key)->first();

            return $option['option_value'];
        } catch (\Throwable $th) {
            return false;
        }
    }

    public static function getSettings()
    {
        $settingFields = SettingsFields::values();

        $key = CacheServices::getOptionsCacheKey(2);

        try {
            $options = Cache::remember($key, 10, function () use ($settingFields) {
                $response = self::select('option_value', 'option_key')->whereIn('option_key', $settingFields)->orderBy('option_key', 'asc')->get()->flatMap(function ($name) {
                    return array_merge([$name->option_key => $name->option_value], ['existing_language_file'=> LanguageHelper::getExistingLanguaseFile()]);
                });

                return $response;
            });

            if ($options) {
                return $options;
            } else {
                return [];
            }
        } catch (\Throwable $th) {
            return [];
        }
    }

    /**
     * Summary of getAllWithoutSettings
     * @return TCacheValue|array
     */
    public static function getAllWithoutSettings()
    {
        $settingFields = SettingsFields::values();

        $key = CacheServices::getOptionsCacheKey(3);

        try {
            $options = Cache::remember($key, 10, function () use ($settingFields) {
                $response = self::select('option_value', 'option_key')->whereNotIn('option_key', $settingFields)->orderBy('option_key', 'asc')->get()->flatMap(function ($name) {
                    return array_merge([$name->option_key => $name->option_value], ['existing_language_file'=> LanguageHelper::getExistingLanguaseFile()]);
                });

                return $response;
            });

            if ($options) {
                return $options;
            } else {
                return [];
            }
        } catch (\Throwable $th) {
            return [];
        }
    }
}
