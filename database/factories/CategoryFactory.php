<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Enums\Status;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
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
            'description' => $this->faker->paragraph(2),
            'image' => $this->faker->imageUrl(),
            'is_featured' => $this->faker->numberBetween(0, 1),
            'status' => Status::ACTIVE,
            'user_id' => User::all(['id'])->random(),
        ];
    }
}
