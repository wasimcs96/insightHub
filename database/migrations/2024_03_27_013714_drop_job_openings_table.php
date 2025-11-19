<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropJobOpeningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Drop foreign key constraint from 'job_opening_applications' table
        Schema::table('job_opening_applications', function (Blueprint $table) {
            $table->dropForeign(['job_opening_id']);
        });

        // Now it's safe to drop the 'job_openings' table
        Schema::dropIfExists('job_openings');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // You can add logic here to recreate the 'job_openings' table if needed
    }
}
