<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTechnicalQuestionUserResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('technical_question_user_responses', function (Blueprint $table) {
            // $table->id();
            // $table->unsignedBigInteger('master_technical_question_id');
            // $table->unsignedBigInteger('user_id');
            // $table->unsignedBigInteger('job_id');
            // $table->string('option_selected');
            // $table->boolean('is_correct');
            // $table->integer('marks');
            // $table->string('level'); // New 'level' column
            // $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('technical_question_user_responses');
    }
}
