<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddChangesJsonToVersionsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('org_chart_versions', function (Blueprint $table) {
            // Add a JSON column for storing changes
            $table->json('changes_json')
                  ->nullable()
                  ->after('new_json')
                  ->comment('Diff snapshot between old and new org structure');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('org_chart_versions', function (Blueprint $table) {
            $table->dropColumn('changes_json');
        });
    }
}
