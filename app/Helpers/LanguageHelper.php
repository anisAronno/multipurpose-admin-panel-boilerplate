<?php

namespace App\Helpers;

class LanguageHelper
{
    public static function getExistingLanguaseFile()
    {
        try {
            $languageFile = glob(resource_path('lang/*.json'));
            $existingLanguageFileArr = [];
            foreach ($languageFile as $file) {
                array_push($existingLanguageFileArr, pathinfo($file, PATHINFO_FILENAME));
            }
            return $existingLanguageFileArr;
        } catch (\Throwable $th) {
            return [];
        }
    }
}
