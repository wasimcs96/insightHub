<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInterviewCompletionFieldInJobOpeningApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_opening_applications', function (Blueprint $table) {
            $table->tinyInteger('interview_completion')->comment('1 for Physical, 2 for Online')->default(0);
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
            $table->dropColumn([
                'interview_completion'
            ]);
        });
    }
}
