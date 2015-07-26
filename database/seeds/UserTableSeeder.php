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
        factory('Katsitu\User', 50)->create()->each(function($u) {
            factory('Katsitu\Location')->create([ 'user_id' => $u->id ]);
        });

        // Fixed credential
        $faiz = factory('Katsitu\User')->create([
            'email' => 'faiz@example.com',
            'name' => 'Faiz Shukri',
            'username' => 'faiz',
            'password' => bcrypt('password'),
        ]);

        factory('Katsitu\Location')->create([ 'user_id' => $faiz->id ]);
    }
}
