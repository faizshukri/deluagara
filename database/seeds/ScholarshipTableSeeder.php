<?php

use Illuminate\Database\Seeder;

class ScholarshipTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Scholarship
        foreach(['MARA', 'JPA', 'PTPTN'] as $scholarship) {
            factory('App\Scholarship')->create([ 'title' => $scholarship ]);
        }
    }
}
