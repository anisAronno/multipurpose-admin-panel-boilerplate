<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Enums\Status;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SpecialFeature>
 */
class SpecialFeatureFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' =>$this->faker->name(),
            'description' =>$this->faker->sentence(2),
            'image' =>$this->faker->imageUrl(),
            'status' => Status::ACTIVE,
        ];
    }
}
