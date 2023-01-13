<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->randomElement(['Shipping', 'Billing']),
            'address' => $this->faker->name(),
            'district' => $this->faker->city(),
            'country' => $this->faker->country(),
            'state' => $this->faker->city(),
            'city' => $this->faker->city(),
            'zip_code' => $this->faker->postcode(),
            'user_id' => User::all(['id'])->random(),
        ];
    }
}
