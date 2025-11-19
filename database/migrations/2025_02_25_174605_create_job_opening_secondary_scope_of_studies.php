<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobOpeningSecondaryScopeOfStudies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_opening_secondary_scope_of_studies', function (Blueprint $table) {
            $table->id();
            $table->integer('job_opening_id');
            $table->integer('job_secondary_scope_of_study_id');
            $table->string('name')->nullable();
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
        Schema::dropIfExists('job_opening_secondary_scope_of_studies');
    }
}
