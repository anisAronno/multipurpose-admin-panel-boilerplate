<?php

namespace Database\Factories;

use AnisAronno\MediaHelper\Models\Image;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\AnisAronno\MediaHelper\Models\Image>
 */
class ImageFactory extends Factory
{
    protected $model = Image::class;

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
            'user_id' => User::all(['id'])->random() ?? null,
        ];
    }
}
