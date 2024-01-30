<?php

namespace App\Observers;

use App\Helpers\CacheControl;
use App\Helpers\CacheKey;
use App\Models\Option;

class OptionObserver
{
    protected $optionsCacheKey = '';

    public function __construct()
    {
        $this->optionsCacheKey = CacheKey::getOptionsCacheKey();
    }

    /**
     * Handle the Option "created" event.
     *
     * @param  \App\Models\Option  $option
     * @return void
     */
    public function created(Option $option)
    {
        CacheControl::clearCache($this->optionsCacheKey);
    }

    /**
     * Handle the Option "updated" event.
     *
     * @param  \App\Models\Option  $option
     * @return void
     */
    public function updated(Option $option)
    {
        CacheControl::clearCache($this->optionsCacheKey);
    }

    /**
     * Handle the Option "deleted" event.
     *
     * @param  \App\Models\Option  $option
     * @return void
     */
    public function deleted(Option $option)
    {
        CacheControl::clearCache($this->optionsCacheKey);
    }

    /**
     * Handle the Option "restored" event.
     *
     * @param  \App\Models\Option  $option
     * @return void
     */
    public function restored(Option $option)
    {
        CacheControl::clearCache($this->optionsCacheKey);
    }

    /**
     * Handle the Option "force deleted" event.
     *
     * @param  \App\Models\Option  $option
     * @return void
     */
    public function forceDeleted(Option $option)
    {
        CacheControl::clearCache($this->optionsCacheKey);

    }
}
