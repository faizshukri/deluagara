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
        factory('App\User', 50)->create()->each(function($u) {
            factory('App\Location')->create([ 'user_id' => $u->id ]);
        });

        // Fixed credential
        $faiz = factory('App\User')->create([
            'email' => 'faiz@example.com',
            'name' => 'Faiz Shukri',
            'username' => 'faiz',
            'password' => bcrypt('password'),
        ]);

        factory('App\Location')->create([ 'user_id' => $faiz->id ]);
    }
}
