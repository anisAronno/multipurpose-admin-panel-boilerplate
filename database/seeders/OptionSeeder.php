<?php

namespace Database\Seeders;

use App\Models\Option;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Option::truncate();
        Schema::enableForeignKeyConstraints();

        /********************************************************
         * -------------------------------------------------------
         * You can create random options field with this factory
         *  Its Insert only setting type value
         * If you want uncomment settings factory
         ------------------------------------------------------------
         **************************************************************/

        // $sesttings =count(SettingsFields::array());
        // Option::factory()->count($sesttings)->create();

        /***********************************************
         *  ____________________________________________
         * ------------------------------------------
         * ***********************************************/

        $option = new Option();
        $option::setOption('logo', 'images/defaults/logo.png');
        $option::setOption('fav_icon', 'images/defaults/fav_icon.png');
        $option::setOption('banner', 'images/defaults/banner.png');
        $option::setOption('site_name', 'Portfolio');
        $option::setOption('site_title', 'My WebSite');
        $option::setOption('language', env('APP_LANGUAGE', 'en'));
        $option::setOption('organization_name', 'My Startup');
        $option::setOption('email', 'anis904692@gmail.com');
        $option::setOption('phone', '01816366535');
        $option::setOption('user_default_role', 'user');
        $option::setOption('site_url', env('APP_URL', 'http://multipurpose-admin-panel-boilerplate.test'));
        $option::setOption('time_zone', 'Asia/Dhaka');
        $option::setOption('language', env('APP_LANGUAGE', 'en'));
        $option::setOption('address', 'Asia/Dhaka');
        $option::setOption('any_one_can_register', 'false');
        $option::setOption('allow_social_login', 'false');
        $option::setOption('collect_user_location', 'true');
        $option::setOption('social_login_fields', json_encode(['google', 'github']));
        $option::setOption('pagination_limit', 10);
        $option::setOption('user_default_status', 'Active');
        $option::setOption('map', 'Dhaka');
        $option::setOption('facebook_url', 'https://facebook.com');
        $option::setOption('instagram_url', 'https://instagram.com');
        $option::setOption('twitter_url', 'https://twitter.com');
        $option::setOption('youtube_channel_url', 'https://youtube.com');
        $option::setOption('linkedin_url', 'https://linkedin.com');
        $option::setOption('github_url', 'https://github.com');

        $option::setOption('model_one', 'https://tailwindui.com/img/ecommerce-images/home-page-03-category-01.jpg');
        $option::setOption('model_two', 'https://tailwindui.com/img/ecommerce-images/home-page-03-category-02.jpg');
        $option::setOption('model_three', 'https://tailwindui.com/img/ecommerce-images/home-page-03-favorite-01.jpg');
        $option::setOption('model_four', 'https://tailwindui.com/img/ecommerce-images/home-page-03-favorite-02.jpg');
        $option::setOption('about_image', 'https://tailwindui.com/img/ecommerce-images/home-page-03-favorite-02.jpg');
        $option::setOption('vission_mission_image', 'https://tailwindui.com/img/ecommerce-images/home-page-03-favorite-02.jpg');
    }
}
