<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobOpeningApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_opening_applications', function (Blueprint $table) {
            $table->id();
            // Adding the job_opening_id as a foreign key
            $table->unsignedBigInteger('job_opening_id');
            $table->foreign('job_opening_id')->references('id')->on('job_openings')->onDelete('cascade');
            
            // Adding the user_id as a foreign key
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
            // Adding the external_user_id
            $table->string('external_user_id')->nullable();

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
        Schema::dropIfExists('job_opening_applications');
    }
}
