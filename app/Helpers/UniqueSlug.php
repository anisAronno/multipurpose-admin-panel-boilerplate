<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class UniqueSlug
{
    /**
     * Generate a Unique Slug.
     * @param mixed $model
     * @param mixed $field
     * @param mixed $value
     * @param mixed $separator
     * @return string
     */
    public static function generate($model, $field, $value, $separator = '-'): string
    {
        try {
            $slug = Str::slug($value, $separator);

            $allSlugs = self::getRelatedSlugs($model, $field, $slug);

            if (!$allSlugs->contains("$field", $slug)) {
                return $slug;
            }

            for ($i = 2; ; $i++) {
                $newSlug = $slug . $separator . $i;
                if (!$allSlugs->contains("$field", $newSlug)) {
                    return $newSlug;
                }
            }
        } catch (\Throwable $th) {
            return $th->getMessage() ;
        }
    }

    /**
     * Get All Releated slug from db
     * @param mixed $model
     * @param mixed $field
     * @param mixed $slug
     * @return mixed
     */
    private static function getRelatedSlugs($model, $field, $slug)
    {
        return $model::select("$field")
            ->where("$field", 'like', $slug . '%')
            ->get();
    }
}
