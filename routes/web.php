<?php

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

Route::get('/', function () {
    return Inertia::render('Frontend/Home/Index');
})->name('home');

Route::get('/about', function () {
    return Inertia::render('Frontend/About/Index');
})->name('about');

Route::get('/product', function () {
    return Inertia::render('Frontend/Products/Index');
})->name('products');

Route::get('/contact', function () {
    return Inertia::render('Frontend/Contact/Index');
})->name('contact');



require __DIR__.'/admin.php';
require __DIR__.'/auth.php';
