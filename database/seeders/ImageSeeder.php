<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class ImageSeeder extends Seeder
{
    protected $model = Image::class;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Image::truncate();
        Setting::truncate();
        Schema::enableForeignKeyConstraints();

        Image::factory()->count(10)->for(
            Setting::factory(),
            'imageable'
        )->create();
    }
}
