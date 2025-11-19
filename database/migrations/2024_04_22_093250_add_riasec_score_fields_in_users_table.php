<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRiasecScoreFieldsInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('riasec_code_one_score')->default(0);
            $table->integer('riasec_code_two_score')->default(0);
            $table->integer('riasec_code_three_score')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('riasec_code_one_score');
            $table->dropColumn('riasec_code_two_score');
            $table->dropColumn('riasec_code_three_score');
        });
    }
}
