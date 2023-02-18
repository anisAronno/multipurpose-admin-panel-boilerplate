<?php

namespace Database\Seeders;

use App\Models\SpecialFeature;
use App\Models\Image;
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
        SpecialFeature::factory()->count(4)
        ->has(Image::factory()->count(1), 'images')
        ->afterCreating(function ($specialFeature) {
            $specialFeature->images->first()->pivot->is_featured = 1;
            $specialFeature->images->first()->pivot->save();
        })
        ->create();
    }
}
