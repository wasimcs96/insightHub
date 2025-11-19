<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Dynamically detect and drop any index that contains "tenant"
        $indexes = DB::select('SHOW INDEX FROM permissions');
        $tenantIndexes = collect($indexes)
            ->pluck('Key_name')
            ->filter(fn($name) => str_contains($name, 'tenant'))
            ->unique();

        foreach ($tenantIndexes as $indexName) {
            try {
                Schema::table('permissions', function (Blueprint $table) use ($indexName) {
                    $table->dropUnique($indexName);
                });
            } catch (\Exception $e1) {
                try {
                    Schema::table('permissions', function (Blueprint $table) use ($indexName) {
                        $table->dropIndex($indexName);
                    });
                } catch (\Exception $e2) {
                    // ignore non-droppable indexes
                }
            }
        }

        // Drop any foreign key referencing tenant_id safely
        try {
            Schema::table('permissions', function (Blueprint $table) {
                $table->dropForeign(['tenant_id']);
            });
        } catch (\Exception $e) {
            // ignore if doesn't exist
        }

        // Drop tenant_id column if it exists
        if (Schema::hasColumn('permissions', 'tenant_id')) {
            Schema::table('permissions', function (Blueprint $table) {
                $table->dropColumn('tenant_id');
            });
        }

        // Add new clean unique index (without tenant_id)
        Schema::table('permissions', function (Blueprint $table) {
            $table->unique(['name', 'guard_name'], 'permissions_name_guard_unique');
        });
    }

    public function down(): void
    {
        Schema::table('permissions', function (Blueprint $table) {
            // Remove new unique key safely
            try {
                $table->dropUnique('permissions_name_guard_unique');
            } catch (\Exception $e) {
                // ignore if missing
            }

            // Re-add tenant_id and old constraint
            $table->foreignId('tenant_id')->nullable()->constrained('tenants')->onDelete('cascade');
            $table->unique(['name', 'guard_name', 'tenant_id'], 'permissions_name_guard_tenant_unique');
        });
    }
};
