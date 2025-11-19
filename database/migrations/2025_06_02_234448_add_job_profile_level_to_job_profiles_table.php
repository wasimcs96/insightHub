<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddJobProfileLevelToJobProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_profiles', function (Blueprint $table) {
            $table->string('job_profile_level', 50)->nullable();
        });
    }

    public function down()
    {
        Schema::table('job_profiles', function (Blueprint $table) {
            $table->dropColumn('job_profile_level');
        });
    }

}
