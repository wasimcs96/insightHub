<?php
// filepath: /Applications/XAMPP/xamppfiles/htdocs/jc-diamond/database/seeders/BasicPermissionsSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class BasicPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Clear cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create basic permissions
        $permissions = [
            'dashboard_access',
            'user_management_read',
            'user_management_write', 
            'user_management_delete',
            'reports_access',
            'settings_access',
            'admin_access',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web'
            ]);
        }

        // Create basic roles
        $superAdmin = Role::firstOrCreate([
            'name' => 'super-admin',
            'guard_name' => 'web'
        ]);

        $admin = Role::firstOrCreate([
            'name' => 'admin', 
            'guard_name' => 'web'
        ]);

        $user = Role::firstOrCreate([
            'name' => 'user',
            'guard_name' => 'web'
        ]);

        // Assign permissions to roles
        $superAdmin->syncPermissions(Permission::all());
        
        $admin->syncPermissions([
            'dashboard_access',
            'user_management_read',
            'user_management_write',
            'reports_access',
        ]);

        $user->syncPermissions([
            'dashboard_access',
        ]);

        $this->command->info('✅ Basic permissions and roles created!');
    }
}