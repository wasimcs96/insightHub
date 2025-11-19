<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeAaJobProfileIdToVarcharInJobProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_profiles', function (Blueprint $table) {
            // Change the column type to varchar
            $table->string('aa_job_profile_id', 255)->change();  // Adjust length if necessary
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_profiles', function (Blueprint $table) {
            // Revert to original type if needed, adjust this if you want a different type
            $table->integer('aa_job_profile_id')->change();
        });
    }
}
