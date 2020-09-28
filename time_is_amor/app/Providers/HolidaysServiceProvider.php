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
        $this->app->singleton('holidays', 'app\Components\Holidays');
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
