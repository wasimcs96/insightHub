<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizDomainValueQuestions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_domain_value_questions', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            // $table->unsignedInteger('quiz_domain_value_id');
            $table->foreignId('quiz_domain_value_id')->constrained()->onDelete('cascade');
            $table->unsignedInteger('minPoints');
            $table->unsignedInteger('maxPoints');
            $table->json('options')->nullable();
            $table->unsignedInteger('order');
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
        Schema::dropIfExists('quiz_domain_value_questions');
    }
}
