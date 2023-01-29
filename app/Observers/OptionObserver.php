<?php

namespace App\Observers;

use App\Models\Option;
use App\Services\Cache\CacheServices;
use App\Traits\ClearCache;

class OptionObserver
{
    use ClearCache;

    protected $optionsCacheKey = '';

    public function __construct()
    {
        $this->optionsCacheKey = CacheServices::getOptionsCacheKey();
    }

    /**
     * Handle the Option "created" event.
     *
     * @param  \App\Models\Option  $option
     * @return void
     */
    public function created(Option $option)
    {
        $this->clearCache($this->optionsCacheKey);
    }

    /**
     * Handle the Option "updated" event.
     *
     * @param  \App\Models\Option  $option
     * @return void
     */
    public function updated(Option $option)
    {
        $this->clearCache($this->optionsCacheKey);
    }

    /**
     * Handle the Option "deleted" event.
     *
     * @param  \App\Models\Option  $option
     * @return void
     */
    public function deleted(Option $option)
    {
        $this->clearCache($this->optionsCacheKey);
    }

    /**
     * Handle the Option "restored" event.
     *
     * @param  \App\Models\Option  $option
     * @return void
     */
    public function restored(Option $option)
    {
        $this->clearCache($this->optionsCacheKey);
    }

    /**
     * Handle the Option "force deleted" event.
     *
     * @param  \App\Models\Option  $option
     * @return void
     */
    public function forceDeleted(Option $option)
    {
        $this->clearCache($this->optionsCacheKey);

    }
}
