<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Check if admin already exists to avoid duplicate error
        User::firstOrCreate(
            ['email' => 'admin168@gmail.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('admin168'),
            ]
        );

        // Call ShelterApplicationSeeder
        $this->call(ShelterApplicationSeeder::class);
    }
}
