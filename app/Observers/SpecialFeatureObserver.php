<?php

namespace App\Observers;

use App\Models\SpecialFeature;
use App\Helpers\CacheHelper; 

class SpecialFeatureObserver
{ 
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
        CacheHelper::forgetCache($this->key);
    }

    /**
     * Handle the SpecialFeature "updated" event.
     *
     * @param  \App\Models\SpecialFeature  $specialFeature
     * @return void
     */
    public function updated(SpecialFeature $specialFeature)
    {
        CacheHelper::forgetCache($this->key);
    }

    /**
     * Handle the SpecialFeature "deleted" event.
     *
     * @param  \App\Models\SpecialFeature  $specialFeature
     * @return void
     */
    public function deleted(SpecialFeature $specialFeature)
    {
        CacheHelper::forgetCache($this->key);
    }

    /**
     * Handle the SpecialFeature "restored" event.
     *
     * @param  \App\Models\SpecialFeature  $specialFeature
     * @return void
     */
    public function restored(SpecialFeature $specialFeature)
    {
        CacheHelper::forgetCache($this->key);
    }

    /**
     * Handle the SpecialFeature "force deleted" event.
     *
     * @param  \App\Models\SpecialFeature  $specialFeature
     * @return void
     */
    public function forceDeleted(SpecialFeature $specialFeature)
    {
        CacheHelper::forgetCache($this->key);
    }
}
