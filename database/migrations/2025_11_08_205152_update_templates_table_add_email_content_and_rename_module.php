<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('templates', function (Blueprint $table) {
            // Rename column 'module' to 'module_id' if it exists
            if (Schema::hasColumn('templates', 'module')) {
                $table->renameColumn('module', 'module_id');
            }

            // Add new column 'email_content' if it doesn't exist
            if (!Schema::hasColumn('templates', 'email_content')) {
                $table->text('email_content')->nullable()->after('description');
            }
        });
    }

    public function down(): void
    {
        Schema::table('templates', function (Blueprint $table) {
            // Revert column name change
            if (Schema::hasColumn('templates', 'module_id')) {
                $table->renameColumn('module_id', 'module');
            }

            // Drop the added column
            if (Schema::hasColumn('templates', 'email_content')) {
                $table->dropColumn('email_content');
            }
        });
    }
};
