<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveEducationYearIdFromJobOpeningTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_openings', function (Blueprint $table) {
            // First, drop the foreign key constraint
            $table->dropForeign(['education_year_id']);

            // Then, drop the column
            $table->dropColumn('education_year_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_openings', function (Blueprint $table) {
            // First, add the column back
            $table->unsignedBigInteger('education_year_id'); // Adjust column type and position as necessary

            // Then, re-add the foreign key constraint
            $table->foreign('education_year_id')->references('id')->on('master_industries');
        });
    }
}
