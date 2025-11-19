<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToQuizDomainValueAnswers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quiz_domain_value_answers', function (Blueprint $table) {
            $table->integer('time_taken')->default(0);
            $table->integer('option_selected')->default(0);
            $table->boolean('is_correct')->nullable();
            $table->string('level_of_difficulty')->nullable();
        });

        Schema::table('quiz_domain_value_questions', function (Blueprint $table) {
            $table->integer('correct_answer')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quiz_domain_value_answers', function (Blueprint $table) {
            $table->dropColumn(['time_taken','option_selected','is_correct', 'level_of_difficulty']);
        });

        Schema::table('quiz_domain_value_questions', function (Blueprint $table) {
            $table->dropColumn(['correct_answer']);
       });
    }
}
