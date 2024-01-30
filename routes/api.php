<?php

use AnisAronno\MediaHelper\Facades\Media;
use App\Models\LoginHistory;
use App\Services\User\LoginHistoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/test', function (Request $request) {
    $testIp = '144.48.110.34';

    $ipDetails = LoginHistoryService::getLocation('144.48.110.34');
    $ipDetails['user_id'] = 1;
    LoginHistory::insert($ipDetails);
});


Route::get('/image', function (Request $request) {
    try {
        return  Media::setStorageDisk('local')->getURL($request->image);
    } catch (\Throwable $th) {
        return $th->getMessage();
    }
});


Route::get('/default', function (Request $request) {
    try {
        return  Media::getAllDefaultFiles(true, 'avatar');
    } catch (\Throwable $th) {
        return $th->getMessage();
    }
});

Route::post('/image', function (Request $request) {
    try {
        return  Media::upload($request, 'image', 'blog');
    } catch (\Throwable $th) {
        return $th->getMessage();
    }
});
Route::delete('/image', function (Request $request) {
    try {
        return  Media::setStorageDisk('local')->delete($request->image);
    } catch (\Throwable $th) {
        return $th->getMessage();
    }
});
