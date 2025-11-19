<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Job;
use DB;

class PipelineToUpdateUsersTP extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pipeline:update-users-tp';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command is used to update the users TP score directly in users table';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Your logic here
        $users = User::where('is_cognitive_ability_completed', '=', 1)
                    ->where('is_work_interest_completed', '=', 1)
                    ->where('is_personality_motivation_completed', '=', 1)
                    ->where('company_id', '=', 3)
                    // ->where('department_id', '=', 63)
                    ->get();
         
        foreach($users as $key => $value) {
            
            $workCompetencyResults = DB::select(DB::raw("
                        WITH bartram AS (
                            SELECT
                                user_id,
                                (O5+A4+O3)/3 AS BARTRAM1,
                                (O4+O2+O6)/3 AS BARTRAM2,
                                (E2+E1+E6)/3 AS BARTRAM3,
                                (E3+A5+C1)/3 AS BARTRAM4,
                                (A3+A6+A1)/3 AS BARTRAM5,
                                (N6+N1+N3)/3 AS BARTRAM6,
                                (C2+C6+C3)/3 AS BARTRAM7,
                                (C4+C5+E4)/3 AS BARTRAM8
                            FROM (
                                SELECT
                                    SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (115,145,175,205) THEN answer ELSE 0 END)*5 AS N1,
                                    SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (120,150,180,210) THEN answer ELSE 0 END)*5 AS N2,
                                    SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (125,155,185,215) THEN answer ELSE 0 END)*5 AS N3,
                                    SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (130,160,190,220) THEN answer ELSE 0 END)*5 AS N4,
                                    SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (135,165,195,225) THEN answer ELSE 0 END)*5 AS N5,
                                    SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (140,170,200,230) THEN answer ELSE 0 END)*5 AS N6,
                                    SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (116,146,176,206) THEN answer ELSE 0 END)*5 AS E1,
                                    SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (121,151,181,211) THEN answer ELSE 0 END)*5 AS E2,
                                    SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (126,156,186,216) THEN answer ELSE 0 END)*5 AS E3,
                                    SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (131,161,191,221) THEN answer ELSE 0 END)*5 AS E4,
                                    SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (136,166,196,226) THEN answer ELSE 0 END)*5 AS E5,
                                    SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (141,171,201,231) THEN answer ELSE 0 END)*5 AS E6,
                                    SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (117,147,177,207) THEN answer ELSE 0 END)*5 AS O1,
                                    SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (122,152,182,212) THEN answer ELSE 0 END)*5 AS O2,
                                    SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (127,157,187,217) THEN answer ELSE 0 END)*5 AS O3,
                                    SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (132,162,192,222) THEN answer ELSE 0 END)*5 AS O4,
                                    SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (137,167,197,227) THEN answer ELSE 0 END)*5 AS O5,
                                    SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (142,172,202,232) THEN answer ELSE 0 END)*5 AS O6,
                                    SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (118,148,178,208) THEN answer ELSE 0 END)*5 AS A1,
                                    SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (123,153,183,213) THEN answer ELSE 0 END)*5 AS A2,
                                    SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (158,128,188,218) THEN answer ELSE 0 END)*5 AS A3,
                                    SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (133,163,193,223) THEN answer ELSE 0 END)*5 AS A4,
                                    SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (138,168,198,228) THEN answer ELSE 0 END)*5 AS A5,
                                    SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (143,173,203,233) THEN answer ELSE 0 END)*5 AS A6,
                                    SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (119,149,179,209) THEN answer ELSE 0 END)*5 AS C1,
                                    SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (124,154,184,214) THEN answer ELSE 0 END)*5 AS C2,
                                    SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (129,159,189,219) THEN answer ELSE 0 END)*5 AS C3,
                                    SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (164,134,224,194) THEN answer ELSE 0 END)*5 AS C4,
                                    SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (139,169,199,229) THEN answer ELSE 0 END)*5 AS C5,
                                    SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (144,174,204,234) THEN answer ELSE 0 END)*5 AS C6,
                                    user_id
                                FROM (
                                    SELECT
                                        answer,
                                        quiz_domain_value_question_id,
                                        user_id
                                    FROM quiz_domain_value_answers
                                    WHERE user_id=?
                                ) AS qdva
                                GROUP BY user_id
                            ) AS ocean
                        )
                        SELECT
                            user_id,
                            'tp_critical_thinking_score' AS aspect,
                            BARTRAM1 AS value
                        FROM bartram
                        UNION ALL
                        SELECT
                            user_id,
                            'tp_creativity_score' AS aspect,
                            BARTRAM2 AS value
                        FROM bartram
                        UNION ALL
                        SELECT
                            user_id,
                            'tp_communication_score' AS aspect,
                            BARTRAM3 AS value
                        FROM bartram
                        UNION ALL
                        SELECT
                            user_id,
                            'tp_leadership_score' AS aspect,
                            BARTRAM4 AS value
                        FROM bartram
                        UNION ALL
                        SELECT
                            user_id,
                            'tp_teamwork_score' AS aspect,
                            BARTRAM5 AS value
                        FROM bartram
                        UNION ALL
                        SELECT
                            user_id,
                            'tp_adaptability_score' AS aspect,
                            BARTRAM6 AS value
                        FROM bartram
                        UNION ALL
                        SELECT
                            user_id,
                            'tp_systematic_planning_score' AS aspect,
                            BARTRAM7 AS value
                        FROM bartram
                        UNION ALL
                        SELECT
                            user_id,
                            'tp_achievement_orientation_score' AS aspect,
                            BARTRAM8 AS value
                        FROM bartram;
                    "), [$value->id]);
            
            foreach ($workCompetencyResults as $result) {
                $field = $result->aspect; // The dynamic field name
                $valueToUpdate = $result->value;  // The value to update
                
                // Update the dynamic field
                $value->update([
                    $field => $valueToUpdate
                ]);
            }

            $value->ccs_creative_thinking_score = $value->tp_creativity_score;
            $value->ccs_sense_making_score = $value->tp_critical_thinking_score;
            $value->ccs_decision_making_score = ($value->tp_systematic_planning_score + $value->tp_achievement_orientation_score) / 2;
            $value->ccs_transdisciplinary_thinking_score = ($value->tp_critical_thinking_score + $value->tp_creativity_score) / 2;
            $value->ccs_problem_solving_score = ($value->tp_critical_thinking_score + $value->tp_creativity_score + $value->tp_adaptability_score) / 3;
            $value->ccs_collaboration_score = ($value->tp_teamwork_score + $value->tp_communication_score) / 2;
            $value->ccs_communication_score = $value->tp_communication_score;
            $value->ccs_influence_score = ($value->tp_leadership_score + $value->tp_communication_score) / 2;
            $value->ccs_adaptability_score =$value->tp_adaptability_score;
            $value->ccs_digital_fluency_score = ($value->tp_systematic_planning_score + $value->tp_critical_thinking_score) / 2;
            $value->ccs_learning_agility_score = ($value->tp_adaptability_score + $value->tp_achievement_orientation_score) / 2;
            $value->ccs_self_management_score = ($value->tp_leadership_score + $value->tp_adaptability_score) / 2;
            $value->ccs_global_perspective_score = ($value->tp_leadership_score + $value->tp_communication_score) / 2;
            $value->ccs_customer_orientation_score = ($value->tp_systematic_planning_score + $value->tp_communication_score) / 2;
            $value->ccs_developing_people_score = ($value->tp_leadership_score + $value->tp_teamwork_score + $value->tp_achievement_orientation_score) / 3;
            $value->ccs_leadership_score = $value->tp_leadership_score;

            $value->save();

       }

        $averages = DB::table('users')->select([
            DB::raw('AVG(ccs_creative_thinking_score) as avg_ccs_creative_thinking_score'),
            DB::raw('AVG(ccs_sense_making_score) as avg_ccs_sense_making_score'),
            DB::raw('AVG(ccs_decision_making_score) as avg_ccs_decision_making_score'),
            DB::raw('AVG(ccs_transdisciplinary_thinking_score) as avg_ccs_transdisciplinary_thinking_score'),
            DB::raw('AVG(ccs_problem_solving_score) as avg_ccs_problem_solving_score'),
            DB::raw('AVG(ccs_collaboration_score) as avg_ccs_collaboration_score'),
            DB::raw('AVG(ccs_communication_score) as avg_ccs_communication_score'),
            DB::raw('AVG(ccs_influence_score) as avg_ccs_influence_score'),
            DB::raw('AVG(ccs_adaptability_score) as avg_ccs_adaptability_score'),
            DB::raw('AVG(ccs_digital_fluency_score) as avg_ccs_digital_fluency_score'),
            DB::raw('AVG(ccs_learning_agility_score) as avg_ccs_learning_agility_score'),
            DB::raw('AVG(ccs_self_management_score) as avg_ccs_self_management_score'),
            DB::raw('AVG(ccs_global_perspective_score) as avg_ccs_global_perspective_score'),
            DB::raw('AVG(ccs_customer_orientation_score) as avg_ccs_customer_orientation_score'),
            DB::raw('AVG(ccs_developing_people_score) as avg_ccs_developing_people_score'),
            DB::raw('AVG(ccs_leadership_score) as avg_ccs_leadership_score'),
        ])->where('is_cognitive_ability_completed', '=', 1)
        ->where('is_work_interest_completed', '=', 1)
        ->where('is_personality_motivation_completed', '=', 1)
        ->where('company_id', '=', 3)->first();
        
        // Calculate the mean of the average scores
        $averageScores = [
            $averages->avg_ccs_creative_thinking_score,
            $averages->avg_ccs_sense_making_score,
            $averages->avg_ccs_decision_making_score,
            $averages->avg_ccs_transdisciplinary_thinking_score,
            $averages->avg_ccs_problem_solving_score,
            $averages->avg_ccs_collaboration_score,
            $averages->avg_ccs_communication_score,
            $averages->avg_ccs_influence_score,
            $averages->avg_ccs_adaptability_score,
            $averages->avg_ccs_digital_fluency_score,
            $averages->avg_ccs_learning_agility_score,
            $averages->avg_ccs_self_management_score,
            $averages->avg_ccs_global_perspective_score,
            $averages->avg_ccs_customer_orientation_score,
            $averages->avg_ccs_developing_people_score,
            $averages->avg_ccs_leadership_score,
        ];
        
        $mean = array_sum($averageScores) / count($averageScores);
        
        // Calculate the variance
        $variance = array_sum(array_map(function($score) use ($mean) {
            return pow($score - $mean, 2);
        }, $averageScores)) / count($averageScores);
        
        // Calculate the standard deviation
        $sd = sqrt($variance);

        // Level ranges
        $level_ranges = [
            1 => [0, $mean],
            2 => [$mean, $mean + $sd],
            3 => [$mean+$sd, 100],
        ];

        $resulted_user_ids = [];

        foreach ($users as $value) {
            $job = Job::find($value->position_id);

            if($job) {
                $jobSkills = [];
                $final_ccs_scores = [];
                foreach($job->skills as $jobSkill) {                
                   $jobSkills[$this->convertTitleToFieldName($jobSkill->title)] = $jobSkill->level;
                }

                foreach ($jobSkills as $ccs => $required_level) {
                        $user_level = $this->getLevel($value->$ccs, $level_ranges);
                        $level_difference = $required_level - $user_level;
                        
                        if ($level_difference == 2) {
                            $adjusted_score = $value->$ccs / 4;
                        } elseif ($level_difference == 1) {
                            $adjusted_score = $value->$ccs / 2;
                        } else {
                            $adjusted_score = $value->$ccs;
                        }
    
                        // Only include CCS scores that are in job requirements
                        $final_ccs_scores[$ccs] = $adjusted_score;
                }
                $tp_match_rate = array_sum($final_ccs_scores) / count($final_ccs_scores);
                $value->talent_pillar_match_rate = $tp_match_rate;
                $value->soft_skill_score = 0.3*($value->riasec_job_match_rate) + 0.25*($value->talent_pillar_match_rate) + 0.25*($value->cognitive_test_percentage) + 0.20*($value->gp_percentage) - 0.025*($value->flight_risk_percentage) - 0.025*($value->organizational_fit_forecast_dark_triad_percentage);

                $final_match_rate = 0.7*($value->tech_skill_score) + 0.3*($value->soft_skill_score);
                if($final_match_rate > 70) {
                     $match_rank = 1;
                } elseif ($final_match_rate < 40) {
                     $match_rank = 3;
                } else {
                     $match_rank = 2;
                }

                $value->match_rate = $final_match_rate;

                $value->match_rank = $match_rank;
                
                $value->save();
                $resulted_user_ids[] = $value->id;
            }
        }
        
        return $resulted_user_ids;
    }

    // Function to get level from score
    function getLevel($score, $ranges) {
        foreach ($ranges as $level => $range) {
            if ($score > $range[0] && $score <= $range[1]) {
                return $level;
            }
        }
        return 1;
    }

    function convertTitleToFieldName($title) {
        // Define the mapping of titles to field names
        $titleToFieldMap = [
            "Creative Thinking" => "ccs_creative_thinking_score",
            "Sense Making" => "ccs_sense_making_score",
            "Decision Making" => "ccs_decision_making_score",
            "Transdisciplinary Thinking" => "ccs_transdisciplinary_thinking_score",
            "Problem Solving" => "ccs_problem_solving_score",
            "Collaboration" => "ccs_collaboration_score",
            "Communication" => "ccs_communication_score",
            "Influence" => "ccs_influence_score",
            "Adaptability" => "ccs_adaptability_score",
            "Digital Fluency" => "ccs_digital_fluency_score",
            "Learning Agility" => "ccs_learning_agility_score",
            "Self Management" => "ccs_self_management_score",
            "Global Perspective" => "ccs_global_perspective_score",
            "Customer Orientation" => "ccs_customer_orientation_score",
            "Developing People" => "ccs_developing_people_score",
            "Leadership" => "ccs_leadership_score",
        ];
    
        // Convert the title to field name
        return $titleToFieldMap[$title] ?? null;
    }
}