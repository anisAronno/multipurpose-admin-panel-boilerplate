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
        $option::setOption('map', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14602.680845745981!2d90.39695083037563!3d23.79475530307877!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c70514d09a15%3A0x5070158fbfaf01bd!2sBanani%20Graveyard!5e0!3m2!1sen!2sbd!4v1675110550083!5m2!1sen!2sbd
');
    }
}
