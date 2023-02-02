<?php

namespace Database\Seeders;

use App\Models\SpecialFeature;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpecialFeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        SpecialFeature::factory()->count(4)->create();

    }
}
