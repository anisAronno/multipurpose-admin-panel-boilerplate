<?php

namespace AnisAronno\MediaHelper\Traits;

use AnisAronno\MediaHelper\Models\Image;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait HasMedia
{
    public function images(): MorphToMany
    {
        return $this->morphToMany(Image::class, 'imageable')
            ->wherePivot('is_featured', '!=', true)
            ->withPivot('is_featured')
            ->withTimestamps();
    }

    public function image()
    {
        return $this->morphToMany(Image::class, 'imageable')
            ->wherePivot('is_featured', true)
            ->withPivot('is_featured')
            ->withTimestamps()
            ->latest()
            ->limit(1);
    }

    /**
     * Media Attach/Store with DB
     *
     * @param array $ids
     * @param boolean $isFeatured
     * @return void
     */
    public function attachImages(array $ids, $isFeatured = false): void
    {
        if ($isFeatured) {
            static::images()->attach($ids, ['is_featured' => 1]);
        } else {
            static::images()->attach($ids);
        }
    }
    /**
     * Media Sync with DB
     *
     * @param array $ids
     * @param boolean $isFeatured
     * @return void
     */
    public function syncImages(array $ids, $isFeatured = false): void
    {

        if ($isFeatured) {
            static::images()->sync($ids, ['is_featured' => 1]);
        } else {
            static::images()->sync($ids);
        }
    }
    /**
     * Detach Images wiht DB
     *
     * @param array $ids
     * @return void
     */
    public function detachImages(array $ids): void
    {
        static::images()->detach($ids);
    }
}
