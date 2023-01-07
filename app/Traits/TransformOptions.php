<?php

namespace App\Traits;

use Illuminate\Support\Facades\Cache;

trait TransformOptions
{
    public static function getOptions($key=null)
    {
        try {
            $result = self::select('option_value', 'option_key')->orderBy('option_key', 'asc')->get()
            ->flatMap(function ($name) {
                return [$name->option_key => $name->option_value];
            });

            $allKeys = $result->keys()->toArray();

            if (empty($key)) {
                return $result;
            } elseif (in_array($key, $allKeys)) {
                return $result[$key];
            } else {
                return 'Key is not Exists';
            }
        } catch (\Throwable $th) {
            return "Result not found";
        }
    }
}
