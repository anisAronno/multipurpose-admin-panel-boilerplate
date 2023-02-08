<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Blog;
use App\Models\Category;
use App\Models\LoginHistory;
use App\Models\Product;
use App\Models\SocialLogin;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(10)
        ->has(Blog::factory()->count(3)->has(Category::factory()->count(2), 'categories'))
        ->has(Address::factory()->count(3))
        ->has(SocialLogin::factory()->count(3))
        ->has(Product::factory()->count(3)->has(Category::factory()->count(2), 'categories'))
        ->has(LoginHistory::factory()->count(3))->create()->each(function ($user) {
            $user->assignRole('user');
        });
    }
}
