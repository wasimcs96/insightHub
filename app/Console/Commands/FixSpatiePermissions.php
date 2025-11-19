<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class FixSpatiePermissions extends Command
{
    protected $signature = 'permission:fix {--check : Only check tables without creating} {--force : Force creation without confirmation}';
    protected $description = 'Check and create missing Spatie Permission tables';

    protected $requiredTables = [
        'permissions',
        'roles', 
        'model_has_permissions',
        'model_has_roles',
        'role_has_permissions'
    ];

    public function handle()
    {
        $this->info('🔍 Checking Spatie Permission setup...');

        // 1. Check if permission config exists
        if (!File::exists(config_path('permission.php'))) {
            $this->warn('⚠️  Permission config file missing. Creating...');
            $this->createPermissionConfig();
        }

        // 2. Check tables
        $missingTables = $this->checkTables();
        
        if (empty($missingTables)) {
            $this->info('✅ All Spatie Permission tables exist!');
            return 0;
        }

        if ($this->option('check')) {
            $this->error('❌ Missing tables: ' . implode(', ', $missingTables));
            return 1;
        }

        // 3. Create missing tables
        if (!$this->option('force')) {
            if (!$this->confirm("Found " . count($missingTables) . " missing table(s). Create them?")) {
                return 0;
            }
        }

        $this->info('🔨 Creating missing Spatie Permission tables...');
        
        try {
            Artisan::call('migrate', [
                '--path' => 'database/migrations/2025_10_07_233547_update_at_add_column_in_tabel.php',
                '--force' => true
            ]);

            $this->info('✅ Migration completed successfully!');

            // 4. Clear caches
            Artisan::call('cache:clear');
            Artisan::call('config:clear');
            
            $this->info('✅ Caches cleared');

            // 5. Verify tables were created
            $stillMissing = $this->checkTables();
            if (empty($stillMissing)) {
                $this->info('🎉 All Spatie Permission tables are now available!');
                return 0;
            } else {
                $this->error('❌ Some tables are still missing: ' . implode(', ', $stillMissing));
                return 1;
            }

        } catch (\Exception $e) {
            $this->error('❌ Failed to create tables: ' . $e->getMessage());
            return 1;
        }
    }

    protected function checkTables(): array
    {
        $missing = [];
        
        foreach ($this->requiredTables as $table) {
            if (!Schema::hasTable($table)) {
                $missing[] = $table;
                $this->warn("❌ Missing: {$table}");
            } else {
                $this->info("✅ Exists: {$table}");
            }
        }

        return $missing;
    }

    protected function createPermissionConfig()
    {
        $configContent = '<?php
        return [
            "models" => [
                "permission" => Spatie\Permission\Models\Permission::class,
                "role" => Spatie\Permission\Models\Role::class,
            ],

            "table_names" => [
                "roles" => "roles",
                "permissions" => "permissions", 
                "model_has_permissions" => "model_has_permissions",
                "model_has_roles" => "model_has_roles",
                "role_has_permissions" => "role_has_permissions",
            ],

            "column_names" => [
                "role_pivot_key" => null,
                "permission_pivot_key" => null,
                "model_morph_key" => "model_id",
                "team_foreign_key" => "team_id",
            ],

            "register_permission_check_method" => true,
            "teams" => false,
            "display_permission_in_exception" => false,
            "display_role_in_exception" => false,
            "enable_wildcard_permission" => false,

            "cache" => [
                "expiration_time" => \DateInterval::createFromDateString("24 hours"),
                "key" => "spatie.permission.cache",
                "store" => "default",
            ],
        ];';
        File::put(config_path('permission.php'), $configContent);
        $this->info('✅ Permission config created');
    }
}
