<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameApplicationPeriodCreatedAtToApplicationPeriodStartDateInJobOpenings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_openings', function (Blueprint $table) {
            //
            $table->renameColumn('application_period_created_at', 'application_period_start_date');
            $table->renameColumn('application_period_end_at', 'application_period_end_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_openings', function (Blueprint $table) {
            //
            $table->renameColumn('application_period_start_date', 'application_period_created_at');
            $table->renameColumn('application_period_end_date', 'application_period_end_at');
        });
    }
}
