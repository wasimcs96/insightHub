<?php
namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class QueryHelper
{
    public static function getDynamicLevelQueries()
    {
        $levelMappings = [
            'omr_level' => ['result_type' => 'overall_match_rate', 'config_key' => 'overall_match_rate_levels', 'is_position' => true],
            'bfr_level' => ['result_type' => 'soft_skill_score', 'config_key' => 'behavior_fit_rate_levels', 'is_position' => true],
            'ta_level' => ['result_type' => 'overall', 'assessment_type' => 'technical', 'config_key' => 'technical_assessment_levels', 'is_position' => true],
            'ssmr_level' => ['result_type' => 'ccs_match_rate', 'config_key' => 'soft_skill_match_rate_levels', 'is_position' => true],
            'jmr_level' => ['result_type' => 'jmr', 'config_key' => 'job_match_rate_levels', 'is_position' => true],
            'cat_level' => ['result_type' => 'overall', 'assessment_type' => 'cognitive', 'config_key' => 'cognitive_ability_levels'],
            'gp_level' => ['result_type' => 'growth_potential', 'config_key' => 'growth_potential_levels'],
            'rci_level' => ['result_type' => 'rci', 'config_key' => 'rci_levels'],
            'fr_level' => ['result_type' => 'flight_risk', 'config_key' => 'flight_risk_levels'],
            'waf_level' => ['result_type' => 'organizational_fit_forecast', 'config_key' => 'organizational_fit_forecast_levels'],
            'technical_skill_match_rate_level' => ['result_type' => 'technical_skill_match_rate', 'assessment_type' => 'cognitive', 'config_key' => 'technical_skill_match_rate_levels', 'is_position' => true],
            'leadership_potential_level' => ['result_type' => 'leadership_potential','assessment_type' => 'ocean','config_key' => 'leadership_potential_levels'],
            
        ];

        $selectStatements = [];
        $caseStatements = [];

        foreach ($levelMappings as $column => $mapping) {
            $resultType = $mapping['result_type'];
            $configKey = $mapping['config_key'];
            $assessmentTypeCondition = isset($mapping['assessment_type']) ? "AND assessment_type = '{$mapping['assessment_type']}'" : '';

            // 👇 Add job_id filter if is_position = true
            $positionCondition = '';
            if (!empty($mapping['is_position']) && $mapping['is_position'] === true) {
                // If users.position_id exists, match with job_id
                // If not, fallback to default (N/A)
                $positionCondition = "AND (
                    (job_id = (SELECT u.position_id FROM users u WHERE u.id = user_results.user_id))
                    OR (SELECT u.position_id FROM users u WHERE u.id = user_results.user_id) IS NULL
                )";
                
            }

            // SELECT clause
            $selectStatements[] = DB::raw("
                MAX(CASE WHEN result_type = '$resultType' $assessmentTypeCondition $positionCondition THEN level END) AS $column
            ");

            // CASE statement for labels
            $caseQuery = "CASE ";
            foreach (config("helpers.$configKey") as $level => $label) {
                $caseQuery .= "WHEN MAX(CASE WHEN result_type = '$resultType' $assessmentTypeCondition $positionCondition THEN level END) = $level THEN '$label' ";
            }
            // 👇 default fallback
            $caseQuery .= "ELSE 'N/A' END AS {$column}_label";

            $caseStatements[] = DB::raw($caseQuery);
        }

        return [
            'selectStatements' => $selectStatements,
            'caseStatements' => $caseStatements
        ];
    }
}
