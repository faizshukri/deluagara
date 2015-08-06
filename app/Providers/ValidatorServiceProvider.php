<?php

namespace Katsitu\Providers;

use Illuminate\Support\Facades\Hash;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class ValidatorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Request $request)
    {
        //
        Validator::extend('current_password', function($attribute, $value, $parameters) use($request){
            return Hash::check($value, $request->user()->password);
        }, "Your old password didn't match");
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //

    }
}
