<?php

namespace Database\Factories;

use App\Models\Option;
use App\Enums\SettingsFields;
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
        /** @var mixed $sesttings */
        $sesttings = SettingsFields::values();

        return [
            'option_key'   => $this->faker->unique()->randomElement($sesttings),
            'option_value' => $this->faker->imageUrl(),
            'option_meta'  => json_encode([$this->faker->randomElement(["house","flat","apartment","room", "shop","lot", "garage"])]),
        ];
    }
}
