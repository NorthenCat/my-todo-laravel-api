<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create test users
        \App\Models\User::create([
            'username' => 'testuser',
            'email' => 'test@example.com',
            'password' => bcrypt('password123'),
            'avatar_index' => 1,
        ]);

        \App\Models\User::create([
            'username' => 'johndoe',
            'email' => 'john@example.com',
            'password' => bcrypt('password123'),
            'avatar_index' => 2,
        ]);
    }
}
