<?php

namespace Database\Seeders;
use DB;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'AdminUser',
            'username' => 'adminuser',
            'email' => 'admin@email.com',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
            'avatar' => '',
            'registered_at' => date('Y-m-d H:i:s'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('users')->insert([
            'name' => 'user',
            'username' => 'normaluser',
            'email' => 'user@email.com',
            'password' => bcrypt('user123'),
            'role' => 'user',
            'avatar' => '',
            'registered_at' => date('Y-m-d H:i:s'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
