<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->title(),
            'description' => $this->faker->name(),
            'image' => $this->faker->imageUrl(),
            'price' => $this->faker->numberBetween(100, 9999),
            'user_id' => User::all(['id'])->random(),
        ];
    }
}
