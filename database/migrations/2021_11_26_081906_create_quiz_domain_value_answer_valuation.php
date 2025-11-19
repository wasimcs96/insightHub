<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizDomainValueAnswerValuation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_domain_value_answer_valuations', function (Blueprint $table) {
            $table->id();
            // $table->unsignedInteger('quiz_domain_value_id');
            $table->foreignId('quiz_domain_value_id','quiz_domain_value_answer_valuations_domain_value_id')->constrained()->onDelete('cascade');
            $table->json('low');
            $table->json('moderate');
            $table->json('high');
            $table->text('lowSentence');
            $table->text('moderateSentence');
            $table->text('highSentence');
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
        Schema::dropIfExists('quiz_domain_value_answer_valuations');
    }
}
