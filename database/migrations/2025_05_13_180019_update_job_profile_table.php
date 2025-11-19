<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateJobProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_profiles', function (Blueprint $table) {
            $table->text('description')->after('name')->nullable();
            $table->text('management_level')->after('description')->nullable();
            $table->unsignedBigInteger('aa_job_profile_id')->after('job_family_id')->nullable();

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
            $table->dropColumn('description');
            $table->dropColumn('aa_job_profile_id');

            });
    }
}
