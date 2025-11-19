<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateLevelColumnAndAddDescriptionToUserResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_results', function (Blueprint $table) {
            // Change 'level' from string to integer with a default value of 0
            $table->integer('level')->default(0)->change();

            // Add a new field 'level_description'
            $table->string('level_description', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_results', function (Blueprint $table) {
            // Revert 'level' to string
            $table->string('level', 255)->nullable()->default(null)->change();

            // Drop the 'level_description' column
            $table->dropColumn('level_description');
        });
    }
}
