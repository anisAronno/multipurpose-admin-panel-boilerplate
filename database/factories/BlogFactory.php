<?php

namespace Database\Factories;

use App\Enums\Format;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Enums\Status;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
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
            'is_premium' => $this->faker->numberBetween(0, 1),
            'is_commentable' => $this->faker->numberBetween(0, 1),
            'is_reactable' => $this->faker->numberBetween(0, 1),
            'is_shareable' => $this->faker->numberBetween(0, 1),
            'show_ratings' => $this->faker->numberBetween(0, 1),
            'show_views' => $this->faker->numberBetween(0, 1),
            'status' => Status::PUBLISHED,
            'format' => $this->faker->randomElement(Format::values()),
            'user_id' => User::all(['id'])->random(),
        ];
    }
}
