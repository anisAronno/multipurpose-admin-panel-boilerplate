<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Enums\Status;
use App\Enums\Featured;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    protected $model = Category::class;

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
            'is_featured' => $this->faker->randomElement(Featured::values()),
            'status' => Status::PUBLISHED,
            'user_id' => User::all(['id'])->random(),            
            'parent_id' => $this->faker->randomElement(Category::pluck('id')->toArray()),

        ];
    }
}
