<?php

namespace App\Services;

use App\Models\Setting;

class SettingsServices
{
    private static $instance = null;
    private $settings = null;

    private function __construct()
    {
        $this->settings = Setting::first();
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new SettingsServices();
        }

        return self::$instance;
    }

     public function getSettings()
     {
         $this->settings->logo = FileServices::getUrl($this->settings->logo);
         $this->settings->banner = FileServices::getUrl($this->settings->banner);
         $this->settings->fav_icon = FileServices::getUrl($this->settings->fav_icon);
         return $this->settings;
     }
}
