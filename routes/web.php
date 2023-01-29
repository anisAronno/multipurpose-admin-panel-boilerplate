<?php

use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProductController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/about', function () {
    return Inertia::render('Frontend/About/Index');
})->name('about');


Route::get('/contact', function () {
    return Inertia::render('Frontend/Contact/Index');
})->name('contact');


Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/blog/{blog:slug}', [BlogController::class, 'show'])->name('blog.show');

Route::get('/category', [CategoryController::class, 'index'])->name('category');
Route::get('/category/{category:slug}', [CategoryController::class, 'show'])->name('category.show');

Route::get('/products', [ProductController::class, 'index'])->name('product');
Route::get('/products/{product:slug}', [ProductController::class, 'show'])->name('product.show');
Route::get('/blog', [BlogController::class, 'index'])->name('blog');

require __DIR__.'/admin.php';
require __DIR__.'/auth.php';
