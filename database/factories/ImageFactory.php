<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Blog;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

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
        return [
            'title' => $this->faker->name(),
            'url' => $this->faker->imageUrl(),
            'mimes' => 'images/png',
            'type' => 'images/png',
            'size' => '3 MB',
            'user_id' => User::all(['id'])->random(),
        ];
    }
}
