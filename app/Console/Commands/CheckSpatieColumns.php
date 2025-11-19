<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CheckSpatieColumns extends Command
{
    protected $signature = 'permission:check-columns {--fix : Fix missing columns}';
    protected $description = 'Check Spatie Permission table columns and optionally fix them';

    protected $expectedStructure = [
        'permissions' => ['id', 'name', 'guard_name', 'created_at', 'updated_at'],
        'roles' => ['id', 'name', 'guard_name', 'created_at', 'updated_at'],
        'model_has_permissions' => ['permission_id', 'model_type', 'model_id'],
        'model_has_roles' => ['role_id', 'model_type', 'model_id'], 
        'role_has_permissions' => ['permission_id', 'role_id'],
    ];

    public function handle()
    {
        $this->info('🔍 Checking Spatie Permission table structures...');

        $issues = [];

        foreach ($this->expectedStructure as $table => $expectedColumns) {
            if (!Schema::hasTable($table)) {
                $issues[] = "❌ Table '{$table}' does not exist";
                continue;
            }

            $this->info("✅ Checking table: {$table}");
            
            $existingColumns = $this->getTableColumns($table);
            $missingColumns = array_diff($expectedColumns, $existingColumns);
            $extraColumns = array_diff($existingColumns, $expectedColumns);

            if (!empty($missingColumns)) {
                $issues[] = "❌ Table '{$table}' missing columns: " . implode(', ', $missingColumns);
                $this->warn("  Missing columns: " . implode(', ', $missingColumns));
            }

            if (!empty($extraColumns)) {
                $this->info("  Extra columns: " . implode(', ', $extraColumns));
            }

            if (empty($missingColumns) && empty($extraColumns)) {
                $this->info("  ✅ All columns present");
            }
        }

        if (empty($issues)) {
            $this->info('🎉 All Spatie Permission tables have correct structure!');
            return 0;
        }

        $this->error('Issues found:');
        foreach ($issues as $issue) {
            $this->line($issue);
        }

        if ($this->option('fix')) {
            $this->info('🔨 Attempting to fix issues...');
            $this->call('migrate', [
                '--path' => 'database/migrations/2025_10_07_233547_update_at_add_column_in_tabel.php'
            ]);
        } else {
            $this->info('💡 Run with --fix to attempt automatic repair');
        }

        return empty($issues) ? 0 : 1;
    }

    protected function getTableColumns($table)
    {
        return Schema::getColumnListing($table);
    }
}
