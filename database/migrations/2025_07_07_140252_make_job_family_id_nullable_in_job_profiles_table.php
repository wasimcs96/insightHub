<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeJobFamilyIdNullableInJobProfilesTable extends Migration
{
    public function up()
    {
        Schema::table('job_profiles', function (Blueprint $table) {
            $table->unsignedBigInteger('job_family_id')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('job_profiles', function (Blueprint $table) {
            $table->unsignedBigInteger('job_family_id')->nullable(false)->change();
        });
    }
}
