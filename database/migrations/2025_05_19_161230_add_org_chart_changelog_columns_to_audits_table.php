<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrgChartChangelogColumnsToAuditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('audits', function (Blueprint $table) {
            $table->string('change_type');
            $table->string('details');
            $table->string('change_by');
            $table->string('reason')->nullable();
            $table->string('source');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('audits', function (Blueprint $table) {
            $table->dropColumn('change_type');
            $table->dropColumn('details');
            $table->dropColumn('change_by');
            $table->dropColumn('reason');
            $table->dropColumn('source');
        });
    }
}
