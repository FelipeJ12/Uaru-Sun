<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::updateOrCreate(
            ['email' => 'admin@unah.com'],
            [
                'role' => 'admin',
                'name' => 'Admin',
                'password' => bcrypt('12345678'),
                'email_verified_at' => now()
            ]
        );
    }
}
