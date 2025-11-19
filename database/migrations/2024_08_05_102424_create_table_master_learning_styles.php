<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableMasterLearningStyles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_learning_styles', function (Blueprint $table) {
            $table->id();
            $table->string('name', 510);
            $table->string('slug', 510);
            $table->text('description');
            $table->text('examples');
            $table->text('preference_summary');
            $table->text('no_preference_summary');
            $table->text('training_recommendations');
            $table->text('enhanced_development_insights_role_suitability');
            $table->text('enhanced_development_insights_action_steps');
            $table->timestamps(); // Adds created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_learning_styles');
    }
}
