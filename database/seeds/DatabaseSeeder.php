<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call(UserTableSeeder::class);
        factory('App\User', 50)->create()->each(function($u){
            factory('App\Location')->create([ 'user_id' => $u->id ]);
        });

        factory('App\User')->create(['email' => 'faiz@example.com', 'name' => 'Faiz Shukri', 'username' => 'faiz', 'password' => bcrypt('password')]);

        $this->call(InstituteSeeder::class);

        Model::reguard();
    }
}
