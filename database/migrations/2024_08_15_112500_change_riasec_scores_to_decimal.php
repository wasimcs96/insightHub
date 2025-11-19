<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeRiasecScoresToDecimal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->decimal('riasec_code_one_score', 8, 2)->change();
            $table->decimal('riasec_code_two_score', 8, 2)->change();
            $table->decimal('riasec_code_three_score', 8, 2)->change();
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
            $table->integer('riasec_code_one_score')->change();
            $table->integer('riasec_code_two_score')->change();
            $table->integer('riasec_code_three_score')->change();
        });
    }
}
