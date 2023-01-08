<?php

use App\Http\Controllers\OptionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::resource('options', OptionController::class, ['except' => ['update']]);
Route::post('/options/update/{option:option_key}', [OptionController::class, 'update'])->name('options.update');
Route::patch('/options/update', [OptionController::class, 'bulkUpdate'])->name('options.bulk.update');
