<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolePermissionSeeder::class);
        $this->call(LoginHistorySeeder::class);
        $this->call(PageSeeder::class);
        $this->call(OptionSeeder::class);
        $this->call(AddressSeeder::class);
        $this->call(ImageSeeder::class);
    }
}
