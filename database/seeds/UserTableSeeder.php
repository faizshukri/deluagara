<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $statuses = App\UserStatus::all()->lists('id')->toArray();
        $scholarship = App\Scholarship::all()->lists('id')->toArray();

        factory('App\User', 50)->create([
            'user_status_id' => $faker->randomElement($statuses),
            'scholarship_id' =>  $faker->randomElement($scholarship),
        ])->each(function($u){
            factory('App\Location')->create([ 'user_id' => $u->id ]);
        });

        // Fixed credential
        factory('App\User')->create([
            'email' => 'faiz@example.com',
            'name' => 'Faiz Shukri',
            'username' => 'faiz',
            'password' => bcrypt('password'),
            'user_status_id' => $faker->randomElement($statuses),
            'scholarship_id' =>  $faker->randomElement($scholarship),
        ]);
    }
}
