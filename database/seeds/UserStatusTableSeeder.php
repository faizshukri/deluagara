<?php

use Illuminate\Database\Seeder;

class UserStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Statuses
        foreach(['Undergraduate', 'Postgraduate', 'Work'] as $status) {
            factory('App\UserStatus')->create([ 'title' => $status ]);
        }
    }
}
