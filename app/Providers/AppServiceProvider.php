<?php

namespace App\Providers;

use Illuminate\Auth\Guard;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Guard $auth)
    {
        view()->composer('*', function($view) use ($auth){
            $view->with('currentUser', $auth->user());
        });

        view()->share('hideNavbar', false);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Contracts\GeoIP::class, \App\Services\FaizGeoIP::class);
        $this->app->bind(\App\Contracts\Progress::class, \App\Services\FaizProgress::class);
    }
}
