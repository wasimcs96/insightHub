<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTpFieldsToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->double('tp_critical_thinking_score')->default(0);
            $table->double('tp_creativity_score')->default(0);
            $table->double('tp_communication_score')->default(0);
            $table->double('tp_leadership_score')->default(0);
            $table->double('tp_teamwork_score')->default(0);
            $table->double('tp_adaptability_score')->default(0);
            $table->double('tp_systematic_planning_score')->default(0);
            $table->double('tp_achievement_orientation_score')->default(0);

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
            $table->dropColumn(['tp_critical_thinking_score', 'tp_creativity_score', 'tp_communication_score', 'tp_leadership_score', 'tp_teamwork_score', 'tp_adaptability_score', 'tp_systematic_planning_score', 'tp_achievement_orientation_score']);
        });
    }
}
