<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new Role();
        $admin->role_name = 'admin';
        $admin->save();

        $teacher = new Role();
        $teacher->role_name = 'faculty';
        $teacher->save();
    }
}
