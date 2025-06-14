<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
{
    // Only create if not already exists
    User::firstOrCreate(
        ['email' => 'admin168@gmail.com'],
        [
            'name' => 'Admin',
            'password' => Hash::make('admin168'),
        ]
    );
}

}