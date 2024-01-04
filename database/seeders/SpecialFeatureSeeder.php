<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\SpecialFeature;
use Database\Factories\MediaFactory;
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
        ->hasAttached(
            MediaFactory::new()->count(5)
        )
        ->afterCreating(function (SpecialFeature $specialFeature) {
            $featuredMedia                     = $specialFeature->media()->first();
            $featuredMedia->pivot->is_featured = true;
            $featuredMedia->pivot->save();
        })
        ->create();
    }
}
