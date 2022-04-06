<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        /*interface binding*/
        $this->app->bind('App\Repositories\Interfaces\UserInterface', 'App\Repositories\UserRepository');

        $this->app->bind('App\Repositories\Interfaces\UserBusinessInterface', 'App\Repositories\UserBusinessRepository');

        $this->app->bind('App\Repositories\Interfaces\BookingInterface', 'App\Repositories\BookingRepository');

    }
}
