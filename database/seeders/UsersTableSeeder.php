<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'id' => 2,
                'first_name' => 'Franz Ivan',
                'last_name' => 'De Villa',
                'email' => 'user@gmail.com',
                'phone' => '12345678',
                'usertype' => 'user',
                'password' => Hash::make('12345678'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'first_name' => 'Franz Ivan',
                'last_name' => 'De Villa',
                'email' => 'admin@gmail.com',
                'phone' => '+63123456',
                'usertype' => 'admin',
                'password' => Hash::make('12345678'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'first_name' => 'Franz Ivan',
                'last_name' => 'De Villa',
                'email' => 'user2@gmail.com',
                'phone' => '+6312345678',
                'usertype' => 'user',
                'password' => Hash::make('12345678'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
} 