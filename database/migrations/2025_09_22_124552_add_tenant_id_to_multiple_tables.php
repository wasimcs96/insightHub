<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $tables = [
            'business_units',
            'company_details',
            'departments',
            'divisions',
            'jobs',
            'job_profiles',
            'master_technical_skills',
        ];

        foreach ($tables as $tableName) {
            Schema::table($tableName, function (Blueprint $table) {
                if (!Schema::hasColumn($table->getTable(), 'tenant_id')) {
                    $table->unsignedBigInteger('tenant_id')->nullable()->after('id');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $tables = [
            'business_units',
            'company_details',
            'departments',
            'divisions',
            'jobs',
            'job_profiles',
            'master_technical_skills',
        ];

        foreach ($tables as $tableName) {
            Schema::table($tableName, function (Blueprint $table) {
                if (Schema::hasColumn($table->getTable(), 'tenant_id')) {
                    $table->dropColumn('tenant_id');
                }
            });
        }
    }
};
