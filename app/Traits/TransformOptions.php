<?php

namespace App\Traits;

use Illuminate\Support\Facades\Cache;

trait TransformOptions
{
    public static function getAllOptions()
    {
        try {
            $options = self::select('option_value', 'option_key')->orderBy('option_key', 'asc')->get()
            ->flatMap(function ($name) {
                return [$name->option_key => $name->option_value];
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

    public static function setOption(string $key, $value='')
    {
        try {
            $option = self::where('option_key', $key)->first();
            $option->option_value = $value;
            return $option->save();
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
}
