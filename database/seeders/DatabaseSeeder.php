<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database for Carvado.
     * This focuses only on User and Role setup.
     */
    public function run(): void
    {
        // 1. Create the Roles first (admin, worker, client)
        $this->call([
            RoleSeeder::class,
        ]);

        // 2. Seed Admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@carvado.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
            ]
        );
        $admin->assignRole('admin');

        // 3. Seed Worker
        $worker = User::firstOrCreate(
            ['email' => 'worker@carvado.com'],
            [
                'name' => 'Worker One',
                'password' => Hash::make('password'),
            ]
        );
        $worker->assignRole('worker');

        // 4. Seed Client
        $client = User::firstOrCreate(
            ['email' => 'client@carvado.com'],
            [
                'name' => 'Client One',
                'password' => Hash::make('password'),
            ]
        );
        $client->assignRole('client');

        // 5. Seed Test User (also as a client)
        $testUser = User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('password'),
            ]
        );
        $testUser->assignRole('client');

        // 🎯 Note: CarSeeder is commented out to protect your existing car data.
        // $this->call([
        //     CarSeeder::class,
        // ]);
    }
}