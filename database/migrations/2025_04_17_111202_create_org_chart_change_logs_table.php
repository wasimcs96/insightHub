<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrgChartChangeLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('org_chart_change_logs', function (Blueprint $table) {
            $table->id(); // BIGINT PK
            $table->string('change_type', 50); // Type: Add, Delete, Move, etc.
            $table->text('details'); // Description of change
            $table->string('changed_by', 100); // Username/admin
            $table->string('reason', 255); // Reason or remarks

            $table->unsignedBigInteger('job_id')->nullable(); // Nullable FK
            $table->unsignedBigInteger('headcount_id')->nullable(); // Nullable FK
            $table->unsignedBigInteger('employee_id')->nullable(); // Nullable FK

            $table->text('previous_value')->nullable(); // Optional original state
            $table->text('new_value')->nullable(); // Optional updated state

            $table->dateTime('created_at'); // Timestamp
        });

        // Optionally add foreign key constraints if related tables exist
        Schema::table('org_chart_change_logs', function (Blueprint $table) {
            $table->foreign('job_id')->references('id')->on('jobs')->onDelete('set null');
            $table->foreign('headcount_id')->references('id')->on('job_headcounts')->onDelete('set null');
            $table->foreign('employee_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('org_chart_change_logs');
    }
}
