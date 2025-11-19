<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Modify users table
        Schema::table('users', function (Blueprint $table) {
            // Drop old column if exists
            if (Schema::hasColumn('users', 'portal_user_id')) {
                $table->dropColumn('portal_user_id');
            }

            // Add new column after id
            if (!Schema::hasColumn('users', 'central_portal_user_id')) {
                $table->unsignedBigInteger('central_portal_user_id')->nullable()->after('id');
            }

        });

        // Add tenant_id to roles
        Schema::table('roles', function (Blueprint $table) {
            if (!Schema::hasColumn('roles', 'tenant_id')) {
                $table->unsignedBigInteger('tenant_id')->nullable()->after('id');
            }
        });

        // Add tenant_id to permissions
        Schema::table('permissions', function (Blueprint $table) {
            if (!Schema::hasColumn('permissions', 'tenant_id')) {
                $table->unsignedBigInteger('tenant_id')->nullable()->after('id');
            }
        });
    }

    public function down(): void
    {
        // Rollback for users table
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'central_portal_user_id')) {
                $table->dropColumn('central_portal_user_id');
            }

            // Re-add portal_user_id
            if (!Schema::hasColumn('users', 'portal_user_id')) {
                $table->unsignedBigInteger('portal_user_id')->nullable()->after('id');
            }
        });

        // Rollback for roles
        Schema::table('roles', function (Blueprint $table) {
            if (Schema::hasColumn('roles', 'tenant_id')) {
                $table->dropColumn('tenant_id');
            }
        });

        // Rollback for permissions
        Schema::table('permissions', function (Blueprint $table) {
            if (Schema::hasColumn('permissions', 'tenant_id')) {
                $table->dropColumn('tenant_id');
            }
        });
    }
};
