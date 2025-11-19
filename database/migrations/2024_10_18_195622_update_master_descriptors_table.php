<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateMasterDescriptorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('master_descriptors', function (Blueprint $table) {
            // Change columns from string to integer
            $table->integer('job_requirement_level')->nullable()->change();
            $table->integer('population_score_level')->nullable()->change();
            $table->integer('user_score_level')->nullable()->change();

            // Add new columns for descriptions
            $table->string('job_requirement_level_description', 25)->nullable();
            $table->string('population_score_level_description', 25)->nullable();
            $table->string('user_score_level_description', 25)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('master_descriptors', function (Blueprint $table) {
            // Revert the columns back to string
            $table->string('job_requirement_level', 25)->nullable()->change();
            $table->string('population_score_level', 25)->nullable()->change();
            $table->string('user_score_level', 25)->nullable()->change();

            // Drop the newly added description columns
            $table->dropColumn('job_requirement_level_description');
            $table->dropColumn('population_score_level_description');
            $table->dropColumn('user_score_level_description');
        });

    }
}
