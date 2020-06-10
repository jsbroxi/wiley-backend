<?php

namespace App\Providers;

use App\Interfaces\BookingRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Interfaces\UserRepositoryInterface',
            'App\Repositories\UserRepository'
        );
        $this->app->bind(
            'App\Interfaces\HotelRepositoryInterface',
            'App\Repositories\HotelRepository'
        );
        $this->app->bind(
            'App\Interfaces\CalendarRepositoryInterface',
            'App\Repositories\CalendarRepository'
        );
        $this->app->bind(
            'App\Interfaces\BookingRepositoryInterface',
            'App\Repositories\BookingRepository'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
