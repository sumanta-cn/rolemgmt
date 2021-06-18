<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mnguser = new Permission();
        $mnguser->permission_name = 'add-user';
        $mnguser->save();

        $crtexmppr = new Permission();
        $crtexmppr->permission_name = 'create-exampaper';
        $crtexmppr->save();
    }
}
