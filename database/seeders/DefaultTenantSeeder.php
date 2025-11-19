<?php
// filepath: /Applications/XAMPP/xamppfiles/htdocs/jc-diamond/database/seeders/DefaultTenantSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Tenant;
use Illuminate\Support\Facades\Schema;

class DefaultTenantSeeder extends Seeder
{
    public function run()
    {
        // Create default tenant for existing data
        // $defaultTenant = Tenant::create([
        //     'name' => 'EEI',
        //     'slug' => 'eei',
        //     'email' => 'eei@company.com',
        //     'status' => 'active',
        // ]);
        // $defaultTenant2 = Tenant::create([
        //     'name' => 'Eight8',
        //     'slug' => 'eight8',
        //     'email' => 'eight8@company.com',
        //     'status' => 'active',
        // ]);
        // $defaultTenant3 = Tenant::create([
        //     'name' => 'JC',
        //     'slug' => 'jc',
        //     'email' => 'jc@company.com',
        //     'status' => 'active',
        // ]);

        // // Update all existing users to belong to default tenant
        // DB::table('users')
        //     ->whereNull('tenant_id')
        //     ->update(['tenant_id' => $defaultTenant->id]);

        // Update other tenant tables
        $tenantTables = [
            'departments',
            'users',
            // 'job_openings',
            // 'teams',
            // 'user_employments',
            // 'user_it_skills',
            // 'user_documents',
            // 'user_results',
            // 'user_performance_ratings',
            // 'skill_reviews',
            // 'job_headcounts',
            // Add more tables as needed
        ];

        foreach ($tenantTables as $table) {
            if (Schema::hasTable($table) && Schema::hasColumn($table, 'tenant_id')) {
                DB::table($table)
                    ->whereNull('tenant_id')
                    ->update(['tenant_id' => 1]);
            }
        }

        $this->command->info('Default tenant created and existing data updated.');
    }
}