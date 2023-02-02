<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Enums\Status;
use App\Enums\Featured;


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
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(3),
            'image' => $this->faker->imageUrl(),
            'is_featured' => $this->faker->randomElement(Featured::values()),
            'price' => $this->faker->numberBetween(100, 9999),
            'status' => Status::ACTIVE,
            'user_id' => User::all(['id'])->random(),
        ];
    }
}
