<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::where('role_name','admin')->first();
        $teacher = Role::where('role_name', 'faculty')->first();
        $mnguser = Permission::where('permission_name','add-user')->first();
        $crtexmppr = Permission::where('permission_name','create-exampaper')->first();

        $user1 = new User();
        $user1->name = 'John Deo';
        $user1->email = 'john@deo.com';
        $user1->password = Hash::make('admin123');
        $user1->save();
        $user1->roles()->attach($admin);
        $user1->permissions()->attach($mnguser);


        $user2 = new User();
        $user2->name = 'Mike Thomas';
        $user2->email = 'mike@thomas.com';
        $user2->password = Hash::make('user123');
        $user2->save();
        $user2->roles()->attach($teacher);
        $user2->permissions()->attach($crtexmppr);
    }
}
