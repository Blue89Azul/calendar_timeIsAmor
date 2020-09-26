<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Components\Holidays;

class HolidaysServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('Holidays', Holidays::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
