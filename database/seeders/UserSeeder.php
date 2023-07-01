<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['id' => 1, 
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@admin.com', 
            'usertype' => 1, 
            'phone' => '085434252656', 
            'address' => 'Surakarta',
            'password' => bcrypt("admin1234"),],
            
            ['id' => 2, 
            'name' => 'User',
            'username' => 'user',
            'email' => 'user@user.com', 
            'usertype' => 0, 
            'phone' => '085434252777', 
            'address' => 'Surakarta',
            'password' => bcrypt("user1234"),],
        ];

        DB::table('users')->insert($data);
    }
}
