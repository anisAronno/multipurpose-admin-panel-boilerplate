<?php

namespace Database\Factories;

use App\Enums\SettingsFields;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $sesttings = SettingsFields::values();
        return [
            'key'=>$this->faker->randomElement($sesttings) ,
            'path'=>$this->faker->imageUrl(),
        ];
    }
}
