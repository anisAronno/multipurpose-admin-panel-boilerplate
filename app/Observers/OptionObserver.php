<?php

namespace App\Observers;

use App\Helpers\CacheHelper;
use App\Models\Option;

class OptionObserver
{
    protected $optionsCacheKey = '';

    public function __construct()
    {
        $this->optionsCacheKey = CacheHelper::getOptionsCacheKey();
    }

    /**
     * Handle the Option "created" event.
     *
     * @param  \App\Models\Option  $option
     * @return void
     */
    public function created(Option $option)
    {
        CacheHelper::forgetCache($this->optionsCacheKey);
    }

    /**
     * Handle the Option "updated" event.
     *
     * @param  \App\Models\Option  $option
     * @return void
     */
    public function updated(Option $option)
    {
        CacheHelper::forgetCache($this->optionsCacheKey);
    }

    /**
     * Handle the Option "deleted" event.
     *
     * @param  \App\Models\Option  $option
     * @return void
     */
    public function deleted(Option $option)
    {
        CacheHelper::forgetCache($this->optionsCacheKey);
    }

    /**
     * Handle the Option "restored" event.
     *
     * @param  \App\Models\Option  $option
     * @return void
     */
    public function restored(Option $option)
    {
        CacheHelper::forgetCache($this->optionsCacheKey);
    }

    /**
     * Handle the Option "force deleted" event.
     *
     * @param  \App\Models\Option  $option
     * @return void
     */
    public function forceDeleted(Option $option)
    {
        CacheHelper::forgetCache($this->optionsCacheKey);

    }
}
