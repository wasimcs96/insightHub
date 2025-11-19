<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeFieldTypeOfTpAndCcsFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->decimal('ccs_creative_thinking_score', 10, 2)->default(0)->change();
            $table->decimal('ccs_sense_making_score', 10, 2)->default(0)->change();
            $table->decimal('ccs_decision_making_score', 10, 2)->default(0)->change();
            $table->decimal('ccs_transdisciplinary_thinking_score', 10, 2)->default(0)->change();
            $table->decimal('ccs_problem_solving_score', 10, 2)->default(0)->change();
            $table->decimal('ccs_collaboration_score', 10, 2)->default(0)->change();
            $table->decimal('ccs_communication_score', 10, 2)->default(0)->change();
            $table->decimal('ccs_influence_score', 10, 2)->default(0)->change();
            $table->decimal('ccs_adaptability_score', 10, 2)->default(0)->change();
            $table->decimal('ccs_digital_fluency_score', 10, 2)->default(0)->change();
            $table->decimal('ccs_learning_agility_score', 10, 2)->default(0)->change();
            $table->decimal('ccs_self_management_score', 10, 2)->default(0)->change();
            $table->decimal('ccs_global_perspective_score', 10, 2)->default(0)->change();
            $table->decimal('ccs_customer_orientation_score', 10, 2)->default(0)->change();
            $table->decimal('ccs_developing_people_score', 10, 2)->default(0)->change();
            $table->decimal('ccs_leadership_score', 10, 2)->default(0)->change();
            $table->decimal('tp_critical_thinking_score', 10, 2)->default(0)->change();
            $table->decimal('tp_creativity_score', 10, 2)->default(0)->change();
            $table->decimal('tp_communication_score', 10, 2)->default(0)->change();
            $table->decimal('tp_leadership_score', 10, 2)->default(0)->change();
            $table->decimal('tp_teamwork_score', 10, 2)->default(0)->change();
            $table->decimal('tp_adaptability_score', 10, 2)->default(0)->change();
            $table->decimal('tp_systematic_planning_score', 10, 2)->default(0)->change();
            $table->decimal('tp_achievement_orientation_score', 10, 2)->default(0)->change();
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
            $table->double('ccs_creative_thinking_score')->default(0)->change();
            $table->double('ccs_sense_making_score')->default(0)->change();
            $table->double('ccs_decision_making_score')->default(0)->change();
            $table->double('ccs_transdisciplinary_thinking_score')->default(0)->change();
            $table->double('ccs_problem_solving_score')->default(0)->change();
            $table->double('ccs_collaboration_score')->default(0)->change();
            $table->double('ccs_communication_score')->default(0)->change();
            $table->double('ccs_influence_score')->default(0)->change();
            $table->double('ccs_adaptability_score')->default(0)->change();
            $table->double('ccs_digital_fluency_score')->default(0)->change();
            $table->double('ccs_learning_agility_score')->default(0)->change();
            $table->double('ccs_self_management_score')->default(0)->change();
            $table->double('ccs_global_perspective_score')->default(0)->change();
            $table->double('ccs_customer_orientation_score')->default(0)->change();
            $table->double('ccs_developing_people_score')->default(0)->change();
            $table->double('ccs_leadership_score')->default(0)->change();
            $table->double('tp_critical_thinking_score')->default(0)->change();
            $table->double('tp_creativity_score')->default(0)->change();
            $table->double('tp_communication_score')->default(0)->change();
            $table->double('tp_leadership_score')->default(0)->change();
            $table->double('tp_teamwork_score')->default(0)->change();
            $table->double('tp_adaptability_score')->default(0)->change();
            $table->double('tp_systematic_planning_score')->default(0)->change();
            $table->double('tp_achievement_orientation_score')->default(0)->change();
        });
    }
}
