<?php

namespace Database\Factories;

use App\Models\Option;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Option>
 */
class OptionFactory extends Factory
{
    protected $model = Option::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'option_key'=>$this->faker->name(),
            'option_value'=>$this->faker->paragraph(3),
            'option_meta'=>json_encode([$this->faker->randomElement(["house","flat","apartment","room", "shop","lot", "garage"])]),
        ];
    }
}
