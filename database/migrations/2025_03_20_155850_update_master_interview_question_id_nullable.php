<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateMasterInterviewQuestionIdNullable extends Migration
{
    
    public function up()
    {
        Schema::table('job_opening_application_interview_responses', function (Blueprint $table) {
            $table->bigInteger('master_interview_question_id')->unsigned()->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('job_opening_application_interview_responses', function (Blueprint $table) {
            $table->bigInteger('master_interview_question_id')->unsigned()->change();
        });
    }
}
