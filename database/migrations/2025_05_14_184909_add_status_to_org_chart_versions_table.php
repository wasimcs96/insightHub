<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToOrgChartVersionsTable extends Migration
{
    public function up(): void
    {
        Schema::table('org_chart_versions', function (Blueprint $table) {
            // Add a tiny integer "status" (0 or 1) defaulting to 0
            $table->unsignedTinyInteger('status')
                  ->default(0)
                  ->after('changes_json')
                  ->comment('0 = inactive, 1 = active');
        });
    }

    public function down(): void
    {
        Schema::table('org_chart_versions', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
