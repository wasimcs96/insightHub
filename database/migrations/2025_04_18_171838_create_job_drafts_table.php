<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobDraftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_drafts', function (Blueprint $table) {
            $table->id();  // Auto-incrementing primary key
            $table->unsignedBigInteger('job_id')->index(); // FK referencing jobs
            $table->string('position_code'); // Position Code
            $table->string('headcount_code')->nullable(); // Headcount Code
            $table->unsignedBigInteger('created_by')->nullable(); // User who created this draft (FK to users table)
            $table->timestamps(); // created_at, updated_at timestamps

            // Add foreign key constraint if job_description_id references jobs table (optional)
            $table->foreign('job_id')
                  ->references('id')
                  ->on('jobs')
                  ->onDelete('cascade');  // If the job is deleted, remove associated drafts

            $table->foreign('created_by')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null');  // If the user is deleted, set created_by to null
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_drafts');
    }
}
