<?php

$faiz = [
    "name" => "Faiz Shukri",
    "username" => "faiz",
    "email" => "faiz@example.com",
    "about_me" => "",
    "website" => "",
    "facebook_url" => "",
    "twitter_url" => "",
    "profile_image" => "",
    "email_verified" => "0",
    "activity" => serialize(['register']),
    "password" => bcrypt('password')
   ];

$user = factory('App\User')->create($faiz);

if($user->location){
    $user->location->delete();
    $user = $user->fresh();
}

$I = new AcceptanceTester($scenario);

$test = $I->grabRecord('users', array('username' => 'faiz'));
//codecept_debug($test);

$I->wantTo('Sign In and See My Profile Page');

$I->amOnPage('/');
$I->see('Login', '#main-navbar-collapse');
$I->dontSeeAuthentication();

$I->click('Login', '#main-navbar-collapse');
$I->fillField(['name' => 'email'], 'faiz@example.com');
$I->fillField(['name' => 'password'], 'password');
$I->click('input[type=submit]');

$I->click($faiz['name'], '#main-navbar-collapse');
$I->see('My Profile', '#main-navbar-collapse');
$I->click('My Profile', '#main-navbar-collapse');

$I->see($faiz['name']);

$I->wantTo("Verify progress increased");
$I->see('80', '.progress-bar');
$I->click("#btnEditAccount");

$I->fillField([ "name" => "location[street]" ], "Flat 4, Brunswick Street");
$I->fillField([ "name" => "location[postcode]" ], "S3 7XA");
$I->click([ "class" => "select2-selection" ]);
$I->fillField([ "class" => "select2-search__field" ], "Sheffield");
$I->wait(1);
$I->click(".select2-results__option--highlighted");

$I->click("input[type=submit]");
$I->see('80', '.progress-bar');
