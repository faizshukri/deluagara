<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@main');

// Authentication routes...
Route::get('login', [ 'as' => 'auth.login', 'uses' => 'Auth\AuthController@getLogin' ]);
Route::post('login', 'Auth\AuthController@postLogin');
Route::get('logout', [ 'as' => 'auth.logout', 'uses' => 'Auth\AuthController@getLogout']);

// Registration routes...
Route::get('register', [ 'as' => 'auth.register', 'uses' => 'Auth\AuthController@getRegister']);
Route::post('register', 'Auth\AuthController@postRegister');

Route::group(['prefix'=>'api/v1'], function(){
    Route::get('locations', 'Api\V1\LocationController@locations');
    Route::get('locations.geojson', 'Api\V1\LocationController@geolocations');

    // Get institutes list
    Route::get('institutes/{name}', 'Api\V1\InstituteController@institutes');
});
