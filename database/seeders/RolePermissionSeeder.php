<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            // Complaints permissions
            'view complaints',
            'create complaints',
            'edit complaints',
            'delete complaints',
            'update complaint status',
            
            // Complaint Types permissions
            'view complaint types',
            'create complaint types',
            'edit complaint types',
            'delete complaint types',
            
            // Users/Admins permissions
            'view users',
            'create users',
            'edit users',
            'delete users',
            
            // Settings permissions
            'view settings',
            'edit settings',
            
            // Dashboard permissions
            'view dashboard',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'web']);
        }

        // Create Super Admin role
        $superAdmin = Role::create(['name' => 'Super Admin', 'guard_name' => 'web']);
        $superAdmin->givePermissionTo(Permission::all()); // Give all permissions

        // Create Admin role
        $admin = Role::create(['name' => 'Admin', 'guard_name' => 'web']);
        // Admin can only view and update complaints, view dashboard, view complaint types
        $admin->givePermissionTo([
            'view complaints',
            'update complaint status',
            'view complaint types',
            'view dashboard',
        ]);
    }
}

