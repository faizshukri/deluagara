<?php

namespace App\Providers;

use App\User;
use App\Contracts\HashID;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Jenssegers\Optimus\Optimus;

class HashIDServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Router $router, HashID $hashID)
    {
        $router->bind('user', function($user) use ($hashID) {
           return User::find($hashID->decode($user));
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Contracts\HashID::class, \App\Services\OptimusHashID::class);
    }
}
