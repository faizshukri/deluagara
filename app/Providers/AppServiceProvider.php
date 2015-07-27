<?php

namespace Katsitu\Providers;

use Illuminate\Auth\Guard;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use Laracasts\Flash\Flash;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Guard $auth, Flash $flash)
    {
        view()->composer('*', function($view) use ($auth, $flash){
            $user = $auth->user();
            $view->with('currentUser', $user);

            if($user && !$user->confirmed && !Session::has('flash_notification.message')){
                flash()->warning("Your email $user->email is not verified. Please check your email. <a style='color: white; font-weight: bold;' href='".route('auth.resendverify')."'>Resend</a>");
            }
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
