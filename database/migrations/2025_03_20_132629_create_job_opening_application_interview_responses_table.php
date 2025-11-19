<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobOpeningApplicationInterviewResponsesTable extends Migration
{
    public function up()
    {
        Schema::create('job_opening_application_interview_responses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('interviewer_id');
            $table->unsignedBigInteger('master_interview_question_id');
            $table->decimal('marks', 5, 2)->default(0); // Allows values like 99.99
            $table->timestamps();

            // Add foreign key constraints if needed
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // $table->foreign('interviewer_id')->references('id')->on('users')->onDelete('cascade');
            // $table->foreign('master_interview_question_id')->references('id')->on('master_interview_questions')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('job_opening_application_interview_responses');
    }
}
