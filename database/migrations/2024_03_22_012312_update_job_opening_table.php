<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateJobOpeningTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_openings', function (Blueprint $table) {
            $table->id();
            $table->string('position_title');
            $table->string('department'); // Assuming department names are stored as strings; consider a foreign key if departments are stored in a separate table
            $table->string('expected_salary'); // Use string if you want to include ranges or formats, otherwise consider decimal for exact amounts
            $table->text('job_overview');
            $table->text('roles_responsibilities'); // Large text for HTML content
            $table->text('additional_job_requirement'); // Large text for HTML content
            $table->text('benefits'); // Large text for HTML content
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
        Schema::dropIfExists('job_openings');
    }
}
