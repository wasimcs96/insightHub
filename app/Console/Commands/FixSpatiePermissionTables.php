<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;

class FixSpatiePermissionTables extends Command
{
    protected $signature = 'permission:fix-tables {--force : Force creation without confirmation}';
    protected $description = 'Create missing Spatie permission tables and fix configuration';

    public function handle()
    {
        $this->info('Checking Spatie Permission tables...');

        // Check if config exists
        if (!config('permission.table_names')) {
            $this->error('Permission config not found. Publishing config...');
            Artisan::call('vendor:publish', [
                '--provider' => 'Spatie\Permission\PermissionServiceProvider',
                '--tag' => 'permission-config'
            ]);
            $this->info('Config published. Please run the command again.');
            return;
        }

        $tableNames = config('permission.table_names');
        $missingTables = [];

        // Check each required table
        foreach ($tableNames as $configKey => $tableName) {
            if (!Schema::hasTable($tableName)) {
                $missingTables[] = $tableName;
                $this->warn("Missing table: {$tableName}");
            } else {
                $this->info("✓ Table exists: {$tableName}");
            }
        }

        if (empty($missingTables)) {
            $this->info('All Spatie permission tables exist!');
            return;
        }

        if (!$this->option('force')) {
            if (!$this->confirm("Create {count($missingTables)} missing table(s)?")) {
                return;
            }
        }

        // Run our custom migration
        $this->info('Creating missing Spatie permission tables...');
        
        try {
            Artisan::call('migrate', [
                '--path' => 'database/migrations/2025_10_07_000001_ensure_spatie_permission_tables_exist.php'
            ]);
            
            $this->info('✓ Spatie permission tables created successfully!');
            
            // Clear cache
            Artisan::call('cache:clear');
            Artisan::call('config:clear');
            
            $this->info('✓ Cache cleared');
            
        } catch (\Exception $e) {
            $this->error('Failed to create tables: ' . $e->getMessage());
            return 1;
        }

        return 0;
    }
}
