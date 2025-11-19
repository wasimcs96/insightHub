<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizDomainValueAnswers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_domain_value_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('answer');
            $table->string('user_id');
            // $table->unsignedInteger('quiz_domain_value_question_id');
            $table->foreignId('quiz_domain_value_question_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('quiz_domain_value_answers');
    }
}
