<?php

namespace Database\Seeders;

use App\Models\Setting; 
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Setting::truncate();
        Schema::enableForeignKeyConstraints();
        $setting = new Setting();
        $setting->site_name = "Website Name";
        $setting->site_title = "Website Title";
        $setting->logo = "uploads/settings/logo.jpeg";
        $setting->banner = "uploads/settings/banner.jpeg";
        $setting->fav_icon = "uploads/settings/fav_icon.jpeg";
        $setting->copyright_message = "© 2020 All rights reserved";
        $setting->copyright_name = "Anis";
        $setting->copyright_url = "https://anichur.com";
        $setting->design_develop_by = "Anis";
        $setting->design_develop_by_url = "https://anichur.com";
        $setting->save();
    }
}
