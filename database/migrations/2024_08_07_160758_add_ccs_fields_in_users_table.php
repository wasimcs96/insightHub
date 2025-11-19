<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCcsFieldsInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->double('ccs_creative_thinking_score')->default(0);
            $table->double('ccs_sense_making_score')->default(0);
            $table->double('ccs_decision_making_score')->default(0);
            $table->double('ccs_transdisciplinary_thinking_score')->default(0);
            $table->double('ccs_problem_solving_score')->default(0);
            $table->double('ccs_collaboration_score')->default(0);
            $table->double('ccs_communication_score')->default(0);
            $table->double('ccs_influence_score')->default(0);
            $table->double('ccs_adaptability_score')->default(0);
            $table->double('ccs_digital_fluency_score')->default(0);
            $table->double('ccs_learning_agility_score')->default(0);
            $table->double('ccs_self_management_score')->default(0);
            $table->double('ccs_global_perspective_score')->default(0);
            $table->double('ccs_customer_orientation_score')->default(0);
            $table->double('ccs_developing_people_score')->default(0);
            $table->double('ccs_leadership_score')->default(0);
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
            $table->dropColumn(['ccs_creative_thinking_score', 'ccs_sense_making_score', 'ccs_decision_making_score', 'ccs_transdisciplinary_thinking_score', 'ccs_problem_solving_score', 'ccs_collaboration_score', 'ccs_communication_score', 'ccs_influence_score', 'ccs_adaptability_score', 'ccs_digital_fluency_score', 'ccs_learning_agility_score', 'ccs_self_management_score', 'ccs_global_perspective_score', 'ccs_customer_orientation_score', 'ccs_developing_people_score', 'ccs_leadership_score']);
        });
    }
}
