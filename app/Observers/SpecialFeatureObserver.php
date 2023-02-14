<?php

namespace App\Observers;

use App\Models\SpecialFeature;
use App\Helpers\CacheHelper;
use App\Traits\ClearCache;

class SpecialFeatureObserver
{
    use ClearCache;

    protected $key = '';
    public function __construct()
    {
        $this->key = CacheHelper::getSpecialFeatureCacheKey();
    }
    /**
     * Handle the SpecialFeature "created" event.
     *
     * @param  \App\Models\SpecialFeature  $specialFeature
     * @return void
     */
    public function created(SpecialFeature $specialFeature)
    {
        $this->clearCache($this->key);
    }

    /**
     * Handle the SpecialFeature "updated" event.
     *
     * @param  \App\Models\SpecialFeature  $specialFeature
     * @return void
     */
    public function updated(SpecialFeature $specialFeature)
    {
        $this->clearCache($this->key);
    }

    /**
     * Handle the SpecialFeature "deleted" event.
     *
     * @param  \App\Models\SpecialFeature  $specialFeature
     * @return void
     */
    public function deleted(SpecialFeature $specialFeature)
    {
        $this->clearCache($this->key);
    }

    /**
     * Handle the SpecialFeature "restored" event.
     *
     * @param  \App\Models\SpecialFeature  $specialFeature
     * @return void
     */
    public function restored(SpecialFeature $specialFeature)
    {
        $this->clearCache($this->key);
    }

    /**
     * Handle the SpecialFeature "force deleted" event.
     *
     * @param  \App\Models\SpecialFeature  $specialFeature
     * @return void
     */
    public function forceDeleted(SpecialFeature $specialFeature)
    {
        $this->clearCache($this->key);
    }
}
