<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSectorIdToJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jobs', function (Blueprint $table) {
            // Add a nullable sector_id column
            // Change 'department_id' to any existing column you want to place it after, or remove ->after() to append
            $table->unsignedBigInteger('sector_id')->nullable()->after('department_id');
            
            // If you later want a foreign key:
            // $table->foreign('sector_id')->references('id')->on('sectors')->onDelete('set null');
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
            // If you added a foreign key uncomment this:
            // $table->dropForeign(['sector_id']);

            $table->dropColumn('sector_id');
        });
    }
}
