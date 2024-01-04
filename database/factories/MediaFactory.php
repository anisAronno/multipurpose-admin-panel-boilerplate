<?php

namespace Database\Factories;

use AnisAronno\MediaGallery\Models\Media;
use Illuminate\Database\Eloquent\Factories\Factory;

// use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\AnisAronno\MediaGallery\Models\Media>
 */
class MediaFactory extends Factory
{
    protected $model = Media::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title'     => $this->faker->name(),
            'url'       => $this->faker->imageUrl(),
            'mimes'     => 'media/png',
            'type'      => 'media/png',
            'size'      => '3 MB',
            'directory' => 'media',
            // 'owner_id' => User::factory(),
            // 'owner_type' =>  User::class
        ];
    }
}
