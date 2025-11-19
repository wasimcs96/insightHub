<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameMatchingPercentageToSuitabilityRateInJobOpeningApplications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_opening_applications', function (Blueprint $table) {
            $table->renameColumn('matching_percentage', 'suitability_rate');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_opening_applications', function (Blueprint $table) {
            $table->renameColumn('suitability_rate', 'matching_percentage');
        });
    }
}
