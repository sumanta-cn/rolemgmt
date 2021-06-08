<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin_details')->insert([
            'full_name' => 'Super Admin',
            'email' => 'suadmin@gmail.com',
            'password' => Hash::make('admin123'),
            'created_at' => date('d-m-Y H:i:s'),
            'updated_at' => date('d-m-Y H:i:s'),
        ]);
    }
}
