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
$statuses = false;
$scholarship = false;
$cities = false;

$factory->define(App\User::class, function ($faker) use (&$statuses, &$scholarship) {

    if(!$statuses) $statuses = App\UserStatus::all()->lists('id')->toArray();
    if(!$scholarship) $scholarship = App\Scholarship::all()->lists('id')->toArray();

    return [
        'name' => $faker->name,
        'username' => $faker->userName,
        'email' => $faker->email,
        'password' => str_random(10),
        'remember_token' => str_random(10),
        'gender' => $faker->randomElement(['male', 'female']),
        'user_status_id' => $faker->randomElement($statuses),
        'scholarship_id' => $faker->randomElement($scholarship),
    ];
});

$factory->define(App\UserStatus::class, function($faker){
    return [
        'title' => $faker->sentence(2),
    ];
});

$factory->define(App\Scholarship::class, function($faker){
    return [
        'title' => $faker->sentence(2),
    ];
});

$factory->define(App\Location::class, function($faker) use (&$cities) {

    if(!$cities) $cities = App\City::all()->lists('id')->toArray();

    $faker->addProvider(new Faker\Provider\en_GB\Address($faker));

    return [
        'address' => $faker->address,
        'postcode' => $faker->postcode,
        'latitude' => $faker->randomFloat(NULL, 53.424331,53.356356),
        'longitude' => $faker->randomFloat(NULL, -1.561901,-1.366207),
        'lastDate' => $faker->dateTimeBetween('+1 year', '+3 years')->format('Y-m-d'),
        'user_id' => 1,
        'city_id' => $faker->randomElement($cities)
    ];
});

$factory->define(App\Institute::class, function($faker){
    return [
        'name' => $faker->company
    ];
});

$factory->define(App\City::class, function($faker){
    return [
        'name' => $faker->city
    ];
});