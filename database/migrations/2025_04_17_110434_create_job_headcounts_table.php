<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobHeadcountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_headcounts', function (Blueprint $table) {
            $table->id(); // BIGINT PK
            $table->unsignedBigInteger('job_id'); // FK to jobs table
            $table->integer('headcount_number'); // Number (1, 2, 3…)
            $table->text('headcount_code'); // Code (e.g., PM-001-01)
            $table->boolean('is_filled')->default(false); // True if filled

            $table->unsignedBigInteger('user_id')->nullable(); // Nullable FK
            $table->unsignedBigInteger('parent_id')->nullable(); // Self FK
            $table->unsignedBigInteger('department_id')->nullable(); // Possibly FK to departments?

            $table->string('status')->nullable(); // Status (type unspecified, using string)
            $table->timestamps(); // created_at and updated_at

            // Foreign key constraints
            $table->foreign('job_id')->references('id')->on('jobs')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('parent_id')->references('id')->on('job_headcounts')->onDelete('set null');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_headcounts');
    }
}
