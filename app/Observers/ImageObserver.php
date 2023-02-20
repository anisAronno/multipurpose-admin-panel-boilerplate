<?php

namespace App\Observers;

use App\Models\Image;
use App\Helpers\CacheHelper;

class ImageObserver
{
    protected $imageCacheKey = '';

    public function __construct()
    {
        $this->imageCacheKey = CacheHelper::getImageCacheKey();
    }

    /**
     * Handle the Image "created" event.
     *
     * @param  \App\Models\Image  $image
     * @return void
     */
    public function created(Image $image)
    {
        CacheHelper::forgetCache($this->imageCacheKey);
    }

    /**
     * Handle the Image "updated" event.
     *
     * @param  \App\Models\Image  $image
     * @return void
     */
    public function updated(Image $image)
    {
        CacheHelper::forgetCache($this->imageCacheKey);
    }

    /**
     * Handle the Image "deleted" event.
     *
     * @param  \App\Models\Image  $image
     * @return void
     */
    public function deleted(Image $image)
    {
        CacheHelper::forgetCache($this->imageCacheKey);
    }

    /**
     * Handle the Image "restored" event.
     *
     * @param  \App\Models\Image  $image
     * @return void
     */
    public function restored(Image $image)
    {
        CacheHelper::forgetCache($this->imageCacheKey);
    }

    /**
     * Handle the Image "force deleted" event.
     *
     * @param  \App\Models\Image  $image
     * @return void
     */
    public function forceDeleted(Image $image)
    {
        CacheHelper::forgetCache($this->imageCacheKey);
    }
}
