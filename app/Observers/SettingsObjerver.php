<?php

namespace App\Observers;

use App\Models\Setting;
use App\Services\Cache\CacheServices;
use App\Services\FileServices;
use App\Traits\ClearCache;

class SettingsObjerver
{
    use ClearCache;

    public $settingsCacheKey = '';

    public function __construct()
    {
        $this->settingsCacheKey = CacheServices::getUserCacheKey();
    }
    /**
     * Handle the Setting "created" event.
     *
     * @param  \App\Models\Setting  $setting
     * @return void
     */
    public function created(Setting $setting)
    {
        $this->clearCache($this->settingsCacheKey);
    }

    /**
     * Handle the Setting "updated" event.
     *
     * @param  \App\Models\Setting  $setting
     * @return void
     */
    public function updated(Setting $setting)
    {
        $this->clearCache($this->settingsCacheKey);
    }

    /**
     * Handle the Setting "deleted" event.
     *
     * @param  \App\Models\Setting  $setting
     * @return void
     */
    public function deleted(Setting $setting)
    {
        $this->clearCache($this->settingsCacheKey);
        FileServices::deleteFile($setting->logo);
        FileServices::deleteFile($setting->banner);
        FileServices::deleteFile($setting->fav_icon);
    }

    /**
     * Handle the Setting "restored" event.
     *
     * @param  \App\Models\Setting  $setting
     * @return void
     */
    public function restored(Setting $setting)
    {
        $this->clearCache($this->settingsCacheKey);
    }

    /**
     * Handle the Setting "force deleted" event.
     *
     * @param  \App\Models\Setting  $setting
     * @return void
     */
    public function forceDeleted(Setting $setting)
    {
        $this->clearCache($this->settingsCacheKey);

        FileServices::deleteFile($setting->logo);
        FileServices::deleteFile($setting->banner);
        FileServices::deleteFile($setting->fav_icon);
    }
}
