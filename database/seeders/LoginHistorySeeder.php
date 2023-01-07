<?php

namespace Database\Seeders;

use App\Models\LoginHistory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class LoginHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        LoginHistory::truncate();
        Schema::enableForeignKeyConstraints();

        LoginHistory::factory()->count(100)->create();
    }
}
