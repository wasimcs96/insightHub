<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropJobIdFromOrgChartVersionsTable extends Migration
{
    public function up(): void
    {
        Schema::table('org_chart_versions', function (Blueprint $table) {
            // drop FK first
            $table->dropForeign(['job_id']);
            // then drop the column
            $table->dropColumn('job_id');
        });
    }

    public function down(): void
    {
        Schema::table('org_chart_versions', function (Blueprint $table) {
            // re-add job_id
            $table->unsignedBigInteger('job_id')->nullable()->after('id');
            // re-create the FK
            $table->foreign('job_id')
                  ->references('id')
                  ->on('jobs')
                  ->onDelete('set null');
        });
    }
}
