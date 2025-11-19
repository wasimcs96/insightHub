<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBusinessUnitIdToJobsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('jobs', function (Blueprint $table) {
            // add the column after whichever makes sense; here we put it after 'id'
            $table->unsignedBigInteger('business_unit_id')
                  ->nullable()
                  ->after('id');

            // optional index + foreign key constraint
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jobs', function (Blueprint $table) {
            // then drop the column
            $table->dropColumn('business_unit_id');
        });
    }
}
