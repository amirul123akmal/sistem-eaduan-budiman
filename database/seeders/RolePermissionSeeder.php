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

        // Existing permission set (granular permissions can be appended here later)
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

        // Create permissions idempotently
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        // Create roles idempotently
        $superAdmin = Role::firstOrCreate(['name' => 'Super Admin', 'guard_name' => 'web']);
        $admin = Role::firstOrCreate(['name' => 'Admin', 'guard_name' => 'web']);

        // Map roles to permissions (extend here to add more roles or granular sets)
        $roleToPermissions = [
            'Super Admin' => Permission::all()->pluck('name')->all(), // all permissions
            'Admin' => [
                'view complaints',
                'update complaint status',
                'view complaint types',
                'view dashboard',
            ],
        ];

        // Sync permissions to roles
        foreach ($roleToPermissions as $roleName => $permissionNames) {
            $role = Role::findByName($roleName, 'web');
            $role->syncPermissions($permissionNames);
        }

        // Refresh cache
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
    }
}

