<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('987654321'), // You can change this to a secure password
            'mobile' => '1234567890',
            'address' => 'Rathi Shop',
            'role' => '1', // '1' means Admin
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
