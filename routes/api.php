<?php


use App\Http\Controllers\Frontend\ProductController;
use App\Models\LoginHistory;
use App\Services\User\LoginHistoryService;
use Illuminate\Http\Request;
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

Route::get('/test', function (Request $request) {
    $testIp = '144.48.110.34';

    $ipDetails = LoginHistoryService::getLocation('144.48.110.34');
    $ipDetails['user_id'] = 1;
    LoginHistory::insert($ipDetails);
});

Route::get('/product', [ProductController::class, 'index'])->name('productByCategory');
