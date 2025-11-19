<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveIndustryFieldFromJobOpeningTable extends Migration
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
            $table->dropForeign(['industry_id']);

            // Then, drop the column
            $table->dropColumn('industry_id');
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
            $table->unsignedBigInteger('industry_id'); // Adjust column type and position as necessary

            // Then, re-add the foreign key constraint
            $table->foreign('industry_id')->references('id')->on('master_industries');
        });
    }

}
