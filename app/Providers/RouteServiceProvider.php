<?php

namespace Katsitu\Providers;

use Katsitu\PasswordReset;
use Katsitu\User;
use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'Katsitu\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function boot(Router $router)
    {
        //

        parent::boot($router);

        $router->bind('username', function($username){
            $user = User::where('username', $username)->first();
            if(!$user) abort(404);
            return $user;
        });

        $router->bind('reset_token', function($reset_token){
            $passwordReset = PasswordReset::where('token', $reset_token)->first();
            if(!$passwordReset) abort(404);
            return $passwordReset;
        });

        $router->model('user', 'Katsitu\User');
    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function map(Router $router)
    {
        $router->group(['namespace' => $this->namespace], function ($router) {
            require app_path('Http/routes.php');
        });
    }
}
