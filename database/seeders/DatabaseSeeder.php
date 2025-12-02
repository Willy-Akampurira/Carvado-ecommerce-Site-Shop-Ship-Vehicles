<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed Admin
        User::firstOrCreate(
            ['email' => 'admin@carvado.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        // Seed Worker
        User::firstOrCreate(
            ['email' => 'worker@carvado.com'],
            [
                'name' => 'Worker One',
                'password' => Hash::make('password'),
                'role' => 'worker',
            ]
        );

        // Seed Client
        User::firstOrCreate(
            ['email' => 'client@carvado.com'],
            [
                'name' => 'Client One',
                'password' => Hash::make('password'),
                'role' => 'client',
            ]
        );

        // Seed Test User
        User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('password'),
                'role' => 'client', // or leave null if role wasn't set before
            ]
        );

        // Seed vehicles
        $this->call([
            CarSeeder::class,
        ]);
    }
}
