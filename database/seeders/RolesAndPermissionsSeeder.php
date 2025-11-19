<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            'view dashboard',
            'view user',
            'create user',
            'edit user',
            'delete user',
            'dashboard',
            'create company',
            'edit company',
            'delete company',
            'talent report',
            'talent acquisition',
            'department create',
            'department view',
            'department delete',
            'view department',
            // more permissions
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles and assign existing permissions
        //Super Admin
        $superAdmin = Role::firstOrCreate(['name' => 'super admin']);
        $superAdmin->givePermissionTo(Permission::all());

        // create other roles and give them permissions
        // Subsidiary Admin
        $subsidiaryAdmin = Role::firstOrCreate(['name' => 'subsidiary admin']);
        $subsidiaryAdmin->givePermissionTo(['view dashboard']);
        $subsidiaryAdmin->givePermissionTo(['view department']);


        // Department
        $department = Role::firstOrCreate(['name'=>'department']);
        $department->givePermissionTo(['view dashboard']);
        $department->givePermissionTo(['view user']);


        // Employee
        $employee = Role::firstOrCreate(['name'=>'employee']);
        $employee->givePermissionTo(['view dashboard']);
        // create more roles and assign permissions as necessary
    }
}
