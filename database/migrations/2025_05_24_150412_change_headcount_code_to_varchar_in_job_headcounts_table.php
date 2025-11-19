<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeHeadcountCodeToVarcharInJobHeadcountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_headcounts', function (Blueprint $table) {
            // Change the column type from TEXT to VARCHAR with length 255
            $table->string('headcount_code', 255)->change();

            // Add the unique constraint
            $table->unique('headcount_code');
        });
    }

    public function down()
    {
        Schema::table('job_headcounts', function (Blueprint $table) {
            // Rollback changes (if you need to revert)
            $table->text('headcount_code')->change();

            // Remove the unique constraint
            $table->dropUnique(['headcount_code']);
        });
    }

}
