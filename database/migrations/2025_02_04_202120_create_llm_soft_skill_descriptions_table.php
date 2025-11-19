<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLlmSoftSkillDescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('llm_soft_skill_descriptions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('job_id');
            $table->bigInteger('soft_skill_id');
            $table->string('soft_skill_title');
            $table->longText('description');
            $table->longText('tp_details');
            $table->text('level_1');
            $table->text('level_1_ability');
            $table->text('level_1_knowledge');
            $table->text('level_2');
            $table->text('level_2_ability');
            $table->text('level_2_knowledge');
            $table->text('level_3');
            $table->text('level_3_ability');
            $table->text('level_3_knowledge');
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
        Schema::dropIfExists('llm_soft_skill_descriptions');
    }
}
