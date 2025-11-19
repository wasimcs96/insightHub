<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobOpeningSuitabilityRateSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_opening_suitability_rate_settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('job_opening_id');
            $table->unsignedBigInteger('criteria_id')->nullable();
            $table->string('criteria_name');
            $table->integer('weightage');
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
        Schema::dropIfExists('job_opening_suitability_rate_settings');
    }
}
