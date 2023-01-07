<?php

namespace Database\Factories;

use App\Models\Setting;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Setting>
 */
class SettingFactory extends Factory
{
    protected $model = Setting::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "site_name"=>"Blog",
            "site_title"=>"My blog",
            "logo"=>"uploads/settings/logo.png",
            "banner"=> "uploads/settings/banner.png",
            "fav_icon"=>'"uploads/settings/fav_icon.png"',
            "copyright_message"=>'© 2020 All rights reserved',
            "copyright_name"=>'Anis',
            "copyright_url"=>'https://anichur.com',
            "design_develop_by"=>'Anis',
            "design_develop_by_url"=>'https://anichur.com',
        ];
    }
}
