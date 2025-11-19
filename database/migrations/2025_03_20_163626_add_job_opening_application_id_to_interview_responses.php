<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddJobOpeningApplicationIdToInterviewResponses extends Migration
{
    public function up()
    {
        Schema::table('job_opening_application_interview_responses', function (Blueprint $table) {
            $table->bigInteger('job_opening_application_id')->unsigned()->after('interviewer_id');
        });
    }

    public function down()
    {
        Schema::table('job_opening_application_interview_responses', function (Blueprint $table) {
            $table->dropColumn('job_opening_application_id');
        });
    }
}
