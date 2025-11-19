<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnDependOnJobMasterLeaves extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('master_leaves', function (Blueprint $table) {
            $table->integer('depend_on_job')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('master_leaves', function (Blueprint $table) {
            $table->dropColumn('depend_on_job');
            $table->dropColumn('salary_lower_bound');
            $table->dropColumn('salary_upper_bound');
        });
    }
}
