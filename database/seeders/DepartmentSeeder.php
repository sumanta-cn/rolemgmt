<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Department::create([
            'dept_name' => 'ECE'
        ]);

        Department::create([
            'dept_name' => 'EE'
        ]);

        Department::create([
            'dept_name' => 'CSE'
        ]);

        Department::create([
            'dept_name' => 'ME'
        ]);

        Department::create([
            'dept_name' => 'AEIE'
        ]);
    }
}
