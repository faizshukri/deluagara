<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function ($faker) {
    return [
        'name' => $faker->name,
        'username' => $faker->userName,
        'email' => $faker->email,
        'password' => str_random(10),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Location::class, function($faker) {
    return [
        'address' => $faker->address,
        'postcode' => $faker->postcode,
        'latitude' => $faker->randomFloat(NULL, 53.424331,53.356356),
        'longitude' => $faker->randomFloat(NULL, -1.561901,-1.366207),
        'lastDate' => $faker->dateTimeBetween('+1 year', '+3 years')->format('Y-m-d')
    ];
});

$factory->define(App\Institute::class, function($faker){
    return [
        'name' => $faker->company
    ];
});