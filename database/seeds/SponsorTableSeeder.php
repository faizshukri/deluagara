<?php

use Illuminate\Database\Seeder;

class SponsorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Scholarship
        foreach(['MARA', 'JPA', 'PTPTN'] as $sponsor) {
            factory('Katsitu\Sponsor')->create([ 'title' => $sponsor ]);
        }
    }
}
