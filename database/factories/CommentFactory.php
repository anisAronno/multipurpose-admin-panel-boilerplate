<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Enums\Status;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    protected $model = Comment::class;

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
             'status' => Status::PUBLISHED,
             'user_id' => User::all(['id'])->random(),
            'parent_id' => $this->faker->randomElement(Comment::pluck('id')->toArray()),
        ];
    }
}
