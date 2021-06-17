<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Semester;

class SemesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Semester::create([
            'semester_no' => '1st'
        ]);

        Semester::create([
            'semester_no' => '2nd'
        ]);

        Semester::create([
            'semester_no' => '3rd'
        ]);

        Semester::create([
            'semester_no' => '4th'
        ]);

        Semester::create([
            'semester_no' => '5th'
        ]);

        Semester::create([
            'semester_no' => '6th'
        ]);

        Semester::create([
            'semester_no' => '7th'
        ]);

        Semester::create([
            'semester_no' => '8th'
        ]);
    }
}
