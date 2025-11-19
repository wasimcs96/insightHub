<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusFieldInJobOpeningApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_opening_applications', function (Blueprint $table) {
            $table->tinyInteger('status')->default(1); // 1 for Applied
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_opening_applications', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
