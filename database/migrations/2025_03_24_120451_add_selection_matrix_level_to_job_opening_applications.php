<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSelectionMatrixLevelToJobOpeningApplications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_opening_applications', function (Blueprint $table) {
            $table->tinyInteger('selection_matrix_level')->default(0)->after('interview_performance');
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
            $table->dropColumn('selection_matrix_level');
        });
    }
}
