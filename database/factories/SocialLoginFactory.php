<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SocialLogin>
 */
class SocialLoginFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'sso_provider' => $this->faker->randomElement(['github', 'google', 'facebook', 'linkedin', 'twitter', 'instagram']),
            'sso_id' => $this->faker->name(),
            'sso_token' => $this->faker->name(),
            'sso_refresh_token' => $this->faker->name(),
            'user_id' => User::all(['id'])->random(),
        ];
    }
}
