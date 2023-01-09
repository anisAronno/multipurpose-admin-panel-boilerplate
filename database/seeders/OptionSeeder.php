<?php

namespace Database\Seeders;

use App\Models\Option;
use Illuminate\Database\Seeder;
use App\Enums\SettingsFields;

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
        
        /**
         * You can create random options field with this factory
         *  Its Insert only setting type value
         */

        // $sesttings =count(SettingsFields::array());
        // Option::factory()->count($sesttings)->create();


        /** @var mixed $option 
         * Create Settings Filed with choosing value
        */
        $option = new Option();
        $option::setOption('logo', '/uploads/settings/logo.png');
        $option::setOption('fav_icon', '/uploads/settings/fav_icon.png');
        $option::setOption('banner', '/uploads/settings/banner.png');
        $option::setOption('site_name', 'Portfolio');
        $option::setOption('site_title', 'My WebSite');
        $option::setOption('organization_name', 'My Startup');
        $option::setOption('email', 'anis904692@gmail.com');
        $option::setOption('phone', '01816366535');
        $option::setOption('user_default_role', 'user');
        $option::setOption('site_url', env('APP_URL', 'http://multipurpose-admin-panel-boilerplate.test'));
        $option::setOption('time_zone', 'Dhaka, Bangladesh');
        $option::setOption('address', 'Dhaka, Bangladesh');
        $option::setOption('ANY_ONE_CAN_REGISTER', false);
        $option::setOption('ACTIVE_SOCIAL_LOGIN', false);
        $option::setOption('PAGINATION_LIMIT', 10);
    }
}
