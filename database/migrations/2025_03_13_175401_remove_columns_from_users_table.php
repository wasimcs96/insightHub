<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveColumnsFromUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'personality_type_id',
                'flight_risk_score',
                'flight_risk_level',
                'flight_risk_percentage',
                'riasec_code_one',
                'riasec_code_two',
                'riasec_code_three',
                'riasec_code',
                'riasec_code_one_score',
                'riasec_code_two_score',
                'riasec_code_three_score',
                'organizational_fit_forecast',
                'organizational_fit_forecast_dark_triad_percentage',
                'interview_score',
                'interview_performance',
                'application_status',
                'interviewer_name',
                'interview_date',
                'interview_mode',
                'interview_completion',
                'riasec_job_match_rate',
                'talent_pillar_match_rate',
                'cognitive_test_percentage',
                'tp_critical_thinking_score',
                'tp_creativity_score',
                'tp_communication_score',
                'tp_leadership_score',
                'tp_teamwork_score',
                'tp_adaptability_score',
                'tp_systematic_planning_score',
                'tp_achievement_orientation_score',
                'ccs_creative_thinking_score',
                'ccs_sense_making_score',
                'ccs_decision_making_score',
                'ccs_transdisciplinary_thinking_score',
                'ccs_problem_solving_score',
                'ccs_collaboration_score',
                'ccs_communication_score',
                'ccs_influence_score',
                'ccs_adaptability_score',
                'ccs_digital_fluency_score',
                'ccs_learning_agility_score',
                'ccs_self_management_score',
                'ccs_global_perspective_score',
                'ccs_customer_orientation_score',
                'ccs_developing_people_score',
                'ccs_leadership_score',
            ]);
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
            $table->integer('personality_type_id')->nullable();
            $table->decimal('flight_risk_score', 8, 2)->nullable();
            $table->string('flight_risk_level')->nullable();
            $table->decimal('flight_risk_percentage', 5, 2)->nullable();
            $table->string('riasec_code_one')->nullable();
            $table->string('riasec_code_two')->nullable();
            $table->string('riasec_code_three')->nullable();
            $table->string('riasec_code')->nullable();
            $table->decimal('riasec_code_one_score', 5, 2)->nullable();
            $table->decimal('riasec_code_two_score', 5, 2)->nullable();
            $table->decimal('riasec_code_three_score', 5, 2)->nullable();
            $table->decimal('organizational_fit_forecast', 5, 2)->nullable();
            $table->decimal('organizational_fit_forecast_dark_triad_percentage', 5, 2)->nullable();
            $table->decimal('interview_score', 5, 2)->nullable();
            $table->string('interview_performance')->nullable();
            $table->string('application_status')->nullable();
            $table->string('interviewer_name')->nullable();
            $table->date('interview_date')->nullable();
            $table->string('interview_mode')->nullable();
            $table->boolean('interview_completion')->nullable();
            $table->decimal('riasec_job_match_rate', 5, 2)->nullable();
            $table->decimal('talent_pillar_match_rate', 5, 2)->nullable();
            $table->decimal('cognitive_test_percentage', 5, 2)->nullable();
            $table->decimal('tp_critical_thinking_score', 5, 2)->nullable();
            $table->decimal('tp_creativity_score', 5, 2)->nullable();
            $table->decimal('tp_communication_score', 5, 2)->nullable();
            $table->decimal('tp_leadership_score', 5, 2)->nullable();
            $table->decimal('tp_teamwork_score', 5, 2)->nullable();
            $table->decimal('tp_adaptability_score', 5, 2)->nullable();
            $table->decimal('tp_systematic_planning_score', 5, 2)->nullable();
            $table->decimal('tp_achievement_orientation_score', 5, 2)->nullable();
            $table->decimal('ccs_creative_thinking_score', 5, 2)->nullable();
            $table->decimal('ccs_sense_making_score', 5, 2)->nullable();
            $table->decimal('ccs_decision_making_score', 5, 2)->nullable();
            $table->decimal('ccs_transdisciplinary_thinking_score', 5, 2)->nullable();
            $table->decimal('ccs_problem_solving_score', 5, 2)->nullable();
            $table->decimal('ccs_collaboration_score', 5, 2)->nullable();
            $table->decimal('ccs_communication_score', 5, 2)->nullable();
            $table->decimal('ccs_influence_score', 5, 2)->nullable();
            $table->decimal('ccs_adaptability_score', 5, 2)->nullable();
            $table->decimal('ccs_digital_fluency_score', 5, 2)->nullable();
            $table->decimal('ccs_learning_agility_score', 5, 2)->nullable();
            $table->decimal('ccs_self_management_score', 5, 2)->nullable();
            $table->decimal('ccs_global_perspective_score', 5, 2)->nullable();
            $table->decimal('ccs_customer_orientation_score', 5, 2)->nullable();
            $table->decimal('ccs_developing_people_score', 5, 2)->nullable();
            $table->decimal('ccs_leadership_score', 5, 2)->nullable();
        });
    }
}
