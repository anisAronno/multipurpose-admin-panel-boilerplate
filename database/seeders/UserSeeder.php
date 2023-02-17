<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Favourite;
use App\Models\LoginHistory;
use App\Models\Product;
use App\Models\Rating;
use App\Models\React; 
use App\Models\SearchHistory;
use App\Models\ShareHistory;
use App\Models\SocialLogin;
use App\Models\Tag;
use App\Models\User;
use App\Models\Image;
use App\Models\Visitor;
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
        ->has(
            Blog::factory()->count(3)
            ->has(Category::factory()->count(2), 'categories')
            ->has(Image::factory()->count(2), 'images')
            ->has(Tag::factory()->count(2), 'tags')
            ->has(Comment::factory()->count(2), 'comments')
            ->has(Favourite::factory()->count(2), 'favourites')
            ->has(Rating::factory()->count(2), 'ratings')
            ->has(React::factory()->count(2), 'reacts') 
            ->has(Visitor::factory()->count(2), 'visitors')
            ->has(ShareHistory::factory()->count(2), 'shares')
            ->has(SearchHistory::factory()->count(2), 'searches')
        )
        ->has(Address::factory()->count(3))
        ->has(SocialLogin::factory()->count(3))
        ->has(
            Product::factory()->count(3)
            ->has(Category::factory()->count(2), 'categories')
            ->has(Image::factory()->count(2), 'images')
            ->has(Tag::factory()->count(2), 'tags')
            ->has(Comment::factory()->count(2), 'comments')
            ->has(Favourite::factory()->count(2), 'favourites')
            ->has(Rating::factory()->count(2), 'ratings')
            ->has(React::factory()->count(2), 'reacts') 
            ->has(Visitor::factory()->count(2), 'visitors')
            ->has(ShareHistory::factory()->count(2), 'shares')
            ->has(SearchHistory::factory()->count(2), 'searches')
        )
        ->has(LoginHistory::factory()->count(3))->create()->each(function ($user) {
            $user->assignRole('user');
        });
    }
}
