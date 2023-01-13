<?php

namespace App\Providers;

use App\Models\Option;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Opcodes\LogViewer\Facades\LogViewer;
use Illuminate\Support\Facades\Schema;

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

        if (! app()->runningInConsole()) {
            $option = Option::getOption('time_zone');

            if ($option) {
                date_default_timezone_set($option);
            }
        }

        LogViewer::auth(function ($request) {
            return $request->user()->hasRole(['superadmin', 'admin']);
        });
    }
}
