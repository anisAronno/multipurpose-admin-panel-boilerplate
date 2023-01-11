<?php

namespace Database\Seeders;

use App\Models\Option;
use App\Services\User\LoginHistoryService;
use Illuminate\Database\Seeder;
use App\Enums\SocialLoginFields;
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

        $location = LoginHistoryService::getLocation(getenv("REMOTE_ADDR"));

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
        $option::setOption('logo', 'uploads/defaults/logo.png');
        $option::setOption('fav_icon', 'uploads/defaults/fav_icon.png');
        $option::setOption('banner', 'uploads/defaults/banner.png');
        $option::setOption('site_name', 'Portfolio');
        $option::setOption('site_title', 'My WebSite');
        $option::setOption('organization_name', 'My Startup');
        $option::setOption('email', 'anis904692@gmail.com');
        $option::setOption('phone', '01816366535');
        $option::setOption('user_default_role', 'user');
        $option::setOption('site_url', env('APP_URL', 'http://multipurpose-admin-panel-boilerplate.test'));
        $option::setOption('time_zone', 'Asia/Dhaka');
        $option::setOption('address', $location['time_zone'] ?? "Asia/Dhaka");
        $option::setOption('any_one_can_register', 'false');
        $option::setOption('allow_social_login', 'false');
        $option::setOption('collect_user_location', 'true');
        $option::setOption('social_login_fields', json_encode(SocialLoginFields::values()));
        $option::setOption('pagination_limit', 10);
        $option::setOption('user_default_status', 'Active');
    }
}
