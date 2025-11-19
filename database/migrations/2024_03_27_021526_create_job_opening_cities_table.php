<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobOpeningCitiesTable extends Migration
{
    public function up()
    {
        Schema::create('job_opening_cities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_opening_id')->constrained('job_openings')->onDelete('cascade');
            
            // Ensure this matches the data type and attributes of the `id` column in `master_cities`
            $table->unsignedBigInteger('city_id'); // Assuming `master_cities.id` is `BIGINT UNSIGNED`
            $table->foreign('city_id')->references('id')->on('master_cities')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('job_opening_cities');
    }
}
