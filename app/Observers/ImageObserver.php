<?php

namespace App\Observers;

use App\Models\Image;
use App\Services\Cache\CacheServices;
use App\Traits\ClearCache;

class ImageObserver
{
    use ClearCache;

    protected $imageCacheKey = '';

    public function __construct()
    {
        $this->imageCacheKey = CacheServices::getImageCacheKey();
    }

    /**
     * Handle the Image "created" event.
     *
     * @param  \App\Models\Image  $image
     * @return void
     */
    public function created(Image $image)
    {
        $this->clearCache($this->imageCacheKey);
    }

    /**
     * Handle the Image "updated" event.
     *
     * @param  \App\Models\Image  $image
     * @return void
     */
    public function updated(Image $image)
    {
        $this->clearCache($this->imageCacheKey);
    }

    /**
     * Handle the Image "deleted" event.
     *
     * @param  \App\Models\Image  $image
     * @return void
     */
    public function deleted(Image $image)
    {
        $this->clearCache($this->imageCacheKey);
    }

    /**
     * Handle the Image "restored" event.
     *
     * @param  \App\Models\Image  $image
     * @return void
     */
    public function restored(Image $image)
    {
        $this->clearCache($this->imageCacheKey);
    }

    /**
     * Handle the Image "force deleted" event.
     *
     * @param  \App\Models\Image  $image
     * @return void
     */
    public function forceDeleted(Image $image)
    {
        $this->clearCache($this->imageCacheKey);
    }
}
