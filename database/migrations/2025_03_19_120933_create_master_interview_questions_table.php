<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterInterviewQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_interview_questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('job_id');
            $table->integer('question_number');
            $table->string('level');
            $table->string('title');
            $table->integer('option_1_score')->default(0);
            $table->integer('option_2_score')->default(0);
            $table->integer('option_3_score')->default(0);
            $table->integer('option_4_score')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('master_interview_questions');
    }
}
