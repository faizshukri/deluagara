<?php

namespace Katsitu\Providers;

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
        $this->app->bind(\Katsitu\Contracts\GeoIP::class, \Katsitu\Services\FaizGeoIP::class);
        $this->app->bind(\Katsitu\Contracts\Progress::class, \Katsitu\Services\FaizProgress::class);
        $this->app->bind(\Katsitu\Contracts\ImageHandler::class, \Katsitu\Services\InterventionImageHandler::class);

        // Development service provider
        if($this->app->environment('local'))
        {
            $this->app->register('Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider');
        }
    }
}
