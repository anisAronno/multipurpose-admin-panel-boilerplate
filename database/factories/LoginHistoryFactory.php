<?php

namespace Database\Factories;

use App\Models\LoginHistory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LoginHistory>
 */
class LoginHistoryFactory extends Factory
{
    protected $model = LoginHistory::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'ip'=>$this->faker->localIpv4(),
            'auth_source' =>'own',
            'device_name'=>$this->faker->name(),
            'os_name'=>$this->faker->name(),
            'browser_name'=>$this->faker->name(),
            'country_name'=>$this->faker->country(),
            'country_code'=>$this->faker->countryCode(),
            'region_code'=>$this->faker->postcode(),
            'region_name'=>$this->faker->city(),
            'city_name'=>$this->faker->city(),
            'zip_code'=>$this->faker->postcode(),
            'latitude'=>$this->faker->latitude($min = -90, $max = 90) ,
            'longitude'=>$this->faker->longitude($min = -180, $max = 180),
            'time_zone'=>$this->faker->city(),
            'area_code'=>$this->faker->city(),
            'metro_code'=>$this->faker->city(),
            'iso_code'=>$this->faker->postcode(),
            'postal_code'=>$this->faker->postcode(),
            'user_id'=>User::all(['id'])->random(),
        ];
    }
}
