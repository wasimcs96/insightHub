<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlagQuestionsCombinationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flag_questions_combinations', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('domain_name')->nullable();
            $table->integer('positive_question_id')->nullable();
            $table->integer('negative_question_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('flag_questions_combinations');
    }
}
