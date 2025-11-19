<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganisationPositionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organisation_position', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('job_id')->nullable();
            $table->string('unique_code')->unique();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->unsignedBigInteger('superior_id')->nullable();
            $table->boolean('is_open')->default(true);
            $table->timestamps();

            // Add foreign key constraints if necessary
            // $table->foreign('job_id')->references('id')->on('jobs')->onDelete('set null');
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            // $table->foreign('department_id')->references('id')->on('departments')->onDelete('set null');
            // $table->foreign('parent_id')->references('id')->on('organisation_position')->onDelete('set null');
            // $table->foreign('superior_id')->references('id')->on('organisation_position')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organisation_position');
    }
}
