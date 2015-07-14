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
$sponsors = false;
$cities = false;

$factory->define(App\User::class, function ($faker) use (&$statuses, &$sponsors) {

    if(!$statuses) $statuses = App\UserStatus::all()->lists('id')->toArray();
    if(!$sponsors) $sponsors = App\Sponsor::all()->lists('id')->toArray();

    $faker->addProvider(new Faker\Provider\en_GB\PhoneNumber($faker));

    return [
        'name' => $faker->name,
        'username' => $faker->userName,
        'email' => $faker->email,
        'password' => str_random(10),
        'remember_token' => str_random(10),
        'gender' => $faker->randomElement(['male', 'female']),
        'phone' => $faker->phoneNumber(),
        'user_status_id' => $faker->randomElement($statuses),
        'sponsor_id' => $faker->randomElement($sponsors),
        'about_me' => $faker->realText($maxNbChars = 200, $indexSize = 2),
        'website' => $faker->url(),
        'facebook_url' => $faker->userName(),
        'twitter_url' => $faker->userName(),
        'profile_image' => $faker->imageUrl(225, 300, 'people')
    ];
});

$factory->define(App\UserStatus::class, function($faker){
    return [
        'title' => $faker->sentence(2),
    ];
});

$factory->define(App\Sponsor::class, function($faker){
    return [
        'title' => $faker->sentence(2),
    ];
});

$factory->define(App\Location::class, function($faker) use (&$cities) {

    if(!$cities) $cities = App\City::all()->lists('id')->toArray();

    $faker->addProvider(new Faker\Provider\en_GB\Address($faker));

    return [
        'street' => $faker->streetAddress,
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