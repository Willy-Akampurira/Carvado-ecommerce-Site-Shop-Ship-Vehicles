<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role; // 🎯 Important: Import the Spatie Role model

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds for Carvado roles.
     */
    public function run(): void
    {
        // 1. Create the 'admin' role
        Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);

        // 2. Create the 'worker' role
        Role::firstOrCreate(['name' => 'worker', 'guard_name' => 'web']);

        // 3. Create the 'client' role (this will be the default for mobile users)
        Role::firstOrCreate(['name' => 'client', 'guard_name' => 'web']);
    }
}