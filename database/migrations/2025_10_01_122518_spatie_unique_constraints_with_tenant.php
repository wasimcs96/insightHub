<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // For MySQL
        if (DB::getDriverName() === 'mysql') {
            // Drop old constraint from roles table
            try {
                DB::statement('ALTER TABLE `roles` DROP INDEX `roles_name_guard_name_unique`');
            } catch (\Exception $e) {
                // Constraint might not exist, ignore
            }

            // Drop old constraint from permissions table
            try {
                DB::statement('ALTER TABLE `permissions` DROP INDEX `permissions_name_guard_name_unique`');
            } catch (\Exception $e) {
                // Constraint might not exist, ignore
            }

            // Add new constraint to roles table with tenant_id
            try {
                DB::statement('ALTER TABLE `roles` ADD UNIQUE INDEX `roles_name_guard_tenant_unique` (`name`, `guard_name`, `tenant_id`)');
            } catch (\Exception $e) {
                // Constraint might already exist, ignore
            }

            // Add new constraint to permissions table with tenant_id
            try {
                DB::statement('ALTER TABLE `permissions` ADD UNIQUE INDEX `permissions_name_guard_tenant_unique` (`name`, `guard_name`, `tenant_id`)');
            } catch (\Exception $e) {
                // Constraint might already exist, ignore
            }
        }
        
        // For PostgreSQL
        if (DB::getDriverName() === 'pgsql') {
            try {
                DB::statement('DROP INDEX IF EXISTS roles_name_guard_name_unique');
                DB::statement('CREATE UNIQUE INDEX roles_name_guard_tenant_unique ON roles (name, guard_name, tenant_id)');
            } catch (\Exception $e) {
                // Ignore if already exists
            }
            
            try {
                DB::statement('DROP INDEX IF EXISTS permissions_name_guard_name_unique');
                DB::statement('CREATE UNIQUE INDEX permissions_name_guard_tenant_unique ON permissions (name, guard_name, tenant_id)');
            } catch (\Exception $e) {
                // Ignore if already exists
            }
        }
    }

    public function down(): void
    {
        if (DB::getDriverName() === 'mysql') {
            // Drop new constraints
            try {
                DB::statement('ALTER TABLE `roles` DROP INDEX `roles_name_guard_tenant_unique`');
            } catch (\Exception $e) {
                // Ignore
            }

            try {
                DB::statement('ALTER TABLE `permissions` DROP INDEX `permissions_name_guard_tenant_unique`');
            } catch (\Exception $e) {
                // Ignore
            }

            // Restore old constraints
            try {
                DB::statement('ALTER TABLE `roles` ADD UNIQUE INDEX `roles_name_guard_name_unique` (`name`, `guard_name`)');
            } catch (\Exception $e) {
                // Ignore
            }

            try {
                DB::statement('ALTER TABLE `permissions` ADD UNIQUE INDEX `permissions_name_guard_name_unique` (`name`, `guard_name`)');
            } catch (\Exception $e) {
                // Ignore
            }
        }

        if (DB::getDriverName() === 'pgsql') {
            try {
                DB::statement('DROP INDEX IF EXISTS roles_name_guard_tenant_unique');
                DB::statement('CREATE UNIQUE INDEX roles_name_guard_name_unique ON roles (name, guard_name)');
            } catch (\Exception $e) {
                // Ignore
            }

            try {
                DB::statement('DROP INDEX IF EXISTS permissions_name_guard_tenant_unique');
                DB::statement('CREATE UNIQUE INDEX permissions_name_guard_name_unique ON permissions (name, guard_name)');
            } catch (\Exception $e) {
                // Ignore
            }
        }
    }
};