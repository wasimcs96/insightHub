<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;

class AddTenantIdToTables extends Command
{
    protected $signature = 'tenant:add-columns {--dry-run : Show what would be changed without making changes}';
    protected $description = 'Add tenant_id columns to existing tables';

    // Tables that should have tenant_id
    protected $tenantTables = [
        'activitylogs',
        'business_units',
        'company_details',
        'contracts',
        'departments',
        'divisions',
        'feedback',
        'job_openings',
        'jobs',
        'master_descriptors',
        'master_general_settings',
        'master_interview_questions',
        'master_technical_skills',
        'permissions',
        'job_technical_skills',
        'department_technical_skills',
        'saved_candidates',
        'saved_employees',
        'survey_questions',
        // 'roles', // need to discuss
        'users',
        'templates',
        'contract_templates',
        'job_headcounts',
        'user_results',
        'settings',
        'master_technical_questions',
        'job_profiles',
    ];

    // Tables that should NOT have tenant_id (global/master data)
    protected $globalTables = [
        'tenants',
        'master_countries',
        'master_cities',
        'master_states',
        'master_provinces',
        'master_barangays',
        'master_education_levels',
        'master_scope_of_studies',
        'master_higher_learning_institutions',
        'master_sectors',
        'master_it_skills',
        'personality_types',
        'master_education_programs',
        'migrations',
        'password_resets',
        'failed_jobs',
        'personal_access_tokens',
    ];

    public function handle()
    {
        $dryRun = $this->option('dry-run');

        if ($dryRun) {
            $this->info('DRY RUN MODE - No changes will be made');
        }

        foreach ($this->tenantTables as $table) {
            if (!Schema::hasTable($table)) {
                $this->warn("Table {$table} does not exist, skipping...");
                continue;
            }

            if (Schema::hasColumn($table, 'tenant_id')) {
                $this->info("Table {$table} already has tenant_id column, skipping...");
                continue;
            }

            $this->info("Processing table: {$table}");

            if (!$dryRun) {
                $this->addTenantIdToTable($table);
            } else {
                $this->line("  - Would add tenant_id column to {$table}");
            }
        }

        if (!$dryRun) {
            $this->info('Tenant ID columns added successfully!');
            $this->warn('Remember to:');
            $this->warn('1. Set default tenant_id values for existing data');
            $this->warn('2. Make tenant_id NOT NULL after setting defaults');
            $this->warn('3. Test all functionality thoroughly');
        }
    }

    protected function addTenantIdToTable($table)
    {
        try {
            Schema::table($table, function (Blueprint $table) {
                $table->unsignedBigInteger('tenant_id')->nullable()->after('id');
                $table->foreign('tenant_id')->references('id')->on('tenants')->onDelete('cascade');
                $table->index('tenant_id');
            });
            $this->info("✓ Added tenant_id to {$table}");
        } catch (\Exception $e) {
            $this->error("✗ Failed to add tenant_id to {$table}: " . $e->getMessage());
        }
    }
}
