<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::updateOrCreate([
            'email' => 'admin@gmail.com',
            'phone' => '9812345678'
        ], [
            'name' => 'Admin',
            'role' => 'admin',
            'password' => bcrypt('password')
        ]);
        
        User::updateOrCreate([
            'email' => 'user@gmail.com',
            'phone' => '9898765432'
        ], [
            'name' => 'User',
            'role' => 'user',
            'password' => bcrypt('password')
        ]);
        
    }
}
