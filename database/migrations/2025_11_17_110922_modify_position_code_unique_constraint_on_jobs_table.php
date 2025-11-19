<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyPositionCodeUniqueConstraintOnJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jobs', function (Blueprint $table) {
            // Drop the existing unique constraint on position_code
            $table->dropUnique('unique_position_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('jobs', function (Blueprint $table) {
            // Restore the original unique constraint on position_code
            $table->unique('position_code', 'unique_position_code');
        });
    }
}
