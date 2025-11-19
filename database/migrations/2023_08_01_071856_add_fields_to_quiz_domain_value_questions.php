<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToQuizDomainValueQuestions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quiz_domain_value_questions', function (Blueprint $table) {
                // Add the new columns here
                $table->string('is_anchor_question')->default(0);
                $table->string('do_question_have_image')->default(0);
                $table->string('question_image_url')->nullable();
                $table->integer('set_no')->nullable();
                $table->boolean('do_options_have_image')->default(0);
                $table->string('level_of_difficulty')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quiz_domain_value_questions', function (Blueprint $table) {
             // Reverse the changes if needed (optional)
             $table->dropColumn(['is_anchor_question','do_question_have_image','question_image_url', 'set_no', 'do_options_have_image', 'level_of_difficulty']);
        });
    }
}
