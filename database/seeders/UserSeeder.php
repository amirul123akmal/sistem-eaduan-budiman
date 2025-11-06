<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get roles
        $superAdminRole = Role::findByName('Super Admin', 'web');
        $adminRole = Role::findByName('Admin', 'web');

        // Create Super Admin
        $superAdmin = User::create([
            'name' => 'Super Admin',
            'phone_number' => '0123456789',
            'email' => 'superadmin@budiman.com',
            'password' => Hash::make('password'), // Change this in production
            'position' => 'Pengerusi',
        ]);
        $superAdmin->assignRole($superAdminRole);

        // Create Admin 1
        $admin1 = User::create([
            'name' => 'Admin Satu',
            'phone_number' => '0123456780',
            'email' => 'admin1@budiman.com',
            'password' => Hash::make('password'), // Change this in production
            'position' => 'Setiausaha',
        ]);
        $admin1->assignRole($adminRole);

        // Create Admin 2
        $admin2 = User::create([
            'name' => 'Admin Dua',
            'phone_number' => '0123456781',
            'email' => 'admin2@budiman.com',
            'password' => Hash::make('password'), // Change this in production
            'position' => 'AJK',
        ]);
        $admin2->assignRole($adminRole);

        $this->command->info('Users created successfully!');
        $this->command->info('Super Admin: superadmin@budiman.com / password');
        $this->command->info('Admin 1: admin1@budiman.com / password');
        $this->command->info('Admin 2: admin2@budiman.com / password');
    }
}

