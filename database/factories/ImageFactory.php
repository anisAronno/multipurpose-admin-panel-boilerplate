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
        $settings = SettingsFields::values();

        return [
            'title' => $this->faker->randomElement($settings),
            'image' => $this->faker->imageUrl(),
        ];
    }
}
