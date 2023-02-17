<?php

namespace Database\Factories;

use App\Enums\Type;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Enums\Status;

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
            'short_description' => $this->faker->paragraph(5),
            'description' => $this->faker->paragraph(2),
            'is_featured' => $this->faker->numberBetween(0, 1),
            'is_commentable' => $this->faker->numberBetween(0, 1),
            'is_reactable' => $this->faker->numberBetween(0, 1),
            'is_shareable' => $this->faker->numberBetween(0, 1),
            'show_ratings' => $this->faker->numberBetween(0, 1),
            'show_views' => $this->faker->numberBetween(0, 1),
            'status' => Status::PUBLISHED,
            'type' => $this->faker->randomElement(Type::values()),
            'user_id' => User::all(['id'])->random(),
        ];
    }
}
