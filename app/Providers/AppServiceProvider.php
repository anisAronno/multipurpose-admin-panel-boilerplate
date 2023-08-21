<?php

namespace App\Providers;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Opcodes\LogViewer\Facades\LogViewer;
use Illuminate\Http\Resources\Json\JsonResource;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        LogViewer::auth(function ($request) {
            return $request->user()->haveAdministrativeRole();
        });

        JsonResource::withoutWrapping();

        Str::macro('stringToInteger', function (...$strings) {
            $concatenatedString = implode('', $strings);
            $hashValue = hash('sha256', $concatenatedString);
            $integerValue = intval($hashValue, 16);
            return $integerValue ;
        });
    }
}
