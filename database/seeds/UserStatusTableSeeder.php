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
        foreach(['Undergraduate', 'Postgraduate', 'Working'] as $status) {
            factory('Katsitu\UserStatus')->create([ 'title' => $status ]);
        }
    }
}
