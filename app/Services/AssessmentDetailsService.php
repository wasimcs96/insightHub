<?php

namespace App\Services;

use App\Models\{ActivityLog, Job, JobOpening, JobOpeningApplication, QuizDomainValueAnswer, User, UserResult};
use App\Helpers\{AssessmentHelper, NewAssessmentHelper};
use Illuminate\Support\Facades\DB;

class AssessmentDetailsService
{
    public function getPsychometricInsights($userId) {
        $responseData = [];
        $user = User::find($userId);
        $user_id = $userId;
        $results = UserResult::where('user_id', $user_id)->get();
        if (! $results->isEmpty()) {
            $isUserResultExists = 1;
        } else {
            $isUserResultExists = 0;
        }
        $responseData = array_merge($responseData, ['isUserResultExists' => $isUserResultExists]);
        $responseData['user'] = $user;
        $userType = $user->role_name ?? '';
        $descriptors = DB::table('master_descriptors')->where('user_type', $userType)->get();

        $allStarResult = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'all_star', 'candidate', $descriptors);
        $allStarDescriptions = config('helpers.all_star_descriptors');
        $allStarJobRoles = config('helpers.all_star_job_roles');

        $allStarResult = $allStarResult->transform(function(array $allStar) use ($allStarDescriptions, $allStarJobRoles) {
            $score = $allStar['z_score'];
            $domainDescription = $allStarDescriptions[$allStar['slug']];
            $desc = $domainDescription[$allStar['level']]['description'];
            $bt = $domainDescription[$allStar['level']]['behavioural_trait'];
            $btdesc = $domainDescription[$allStar['level']]['behavioural_trait_description'];
            $jobRole = $allStarJobRoles[$allStar['level']]['title'];
            $jobRoleClass = $allStarJobRoles[$allStar['level']]['class'];
            
            $description = '<p class="right-top-heading" style="margin-top: 20px;">
                               <span class="badge-custom '. $jobRoleClass .'">
                                    '. $jobRole .'
                                </span>
                            </p>
                            <p class="table-desc">
                               '. $desc .'
                            </p>
                            </br>
                            <p class="table-desc"><b> '. $bt .'</b></br>
                                '. $btdesc .'
                            </p>';
            $allStar['level_description'] = $description;
        
            return $allStar;
        });
        
        $responseData = array_merge($responseData, ['allStarResult' => $allStarResult]);

        $allStarDomainDescriptors = DB::table('master_descriptors')->where('assessment_type', 'ocean')->where('result_type', 'all_star')->where('user_type', $userType)->get();
        $responseData = array_merge($responseData, ['allStarDomainDescriptors' => $allStarDomainDescriptors]);

        return $responseData;
    }

    public function getPsychometric($userId)  {
        $responseData = [];
        $user = User::find($userId);
        $user_id = $userId;
        $results = UserResult::where('user_id', $user_id)->get();
        if (! $results->isEmpty()) {
            $isUserResultExists = 1;
        } else {
            $isUserResultExists = 0;
        }
        $responseData = array_merge($responseData, ['isUserResultExists' => $isUserResultExists]);
        $responseData['user'] = $user;
        $userType = $user->role_name ?? '';
        $descriptors = DB::table('master_descriptors')->where('user_type', $userType)->get();
        
        $total_correct = QuizDomainValueAnswer::where('user_id', $user_id)->where('quiz_domain_value_question_id', '>', 376)->where('is_correct', 1)->count();
        $responseData = array_merge($responseData, ['totalCorrectForCognitive' => $total_correct]);

        $total_not_attempted = QuizDomainValueAnswer::where('user_id', $user_id)->where('quiz_domain_value_question_id', '>', 376)->where('time_taken', 0)->where('option_selected', 0)->count();
        $responseData = array_merge($responseData, ['totalNonAttemptedForCognitive' => $total_not_attempted]);
        if ($total_correct == 0 && $total_not_attempted == 0) {
            $total_wrong = 0;
        } else {
            $total_wrong = 50 - $total_correct - $total_not_attempted;
        }
        $responseData = array_merge($responseData, ['totalWrongForCognitive' => $total_wrong]);

        $cognitiveOverallResult = NewAssessmentHelper::getFormattedUserResults($results, 'cognitive', 'overall', $userType, $descriptors);
        $responseData = array_merge($responseData, ['cognitiveOverallResult' => $cognitiveOverallResult]);

        $totalMarksForCognitive = $cognitiveOverallResult['cognitive']['score'] ?? 0;
        $responseData = array_merge($responseData, ['totalMarksForCognitive' => $totalMarksForCognitive]);

        $cognitiveDomainResult = NewAssessmentHelper::getFormattedUserResults($results, 'cognitive', 'domains', $userType, $descriptors);
        $responseData = array_merge($responseData, ['cognitiveDomainResult' => $cognitiveDomainResult]);

        $oceanDomainResults = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'domains', $userType, $descriptors);
        $responseData = array_merge($responseData, ['oceanDomainResult' => $oceanDomainResults]);

        $oceanAllFacetsResult = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'all_facets', $userType, $descriptors);
        $responseData = array_merge($responseData, ['oceanAllFacetsResult' => $oceanAllFacetsResult]);

        $riasecDomainResult = NewAssessmentHelper::getFormattedUserResults($results, 'riasec', 'domains', $userType, $descriptors);
        $responseData = array_merge($responseData, ['riasecDomainResult' => $riasecDomainResult]);

        $riasecTop3Results = NewAssessmentHelper::getFormattedUserResults($results, 'riasec', 'top_3_riasec');

        $riasecTop3Result['string'] = $riasecTop3Results['top-3-riasec']['level_description'] ?? '';
        $riasecTop3Result['array'] = str_split($riasecTop3Result['string']) ?? [];
        $riasecTop3Result['job_top_3_riasec'] = $user->position->top3riasec ?? '';
        $riasecTop3Result['job_top_3_riasec_array'] = str_split($riasecTop3Result['job_top_3_riasec']) ?? [];
        $riasecTop3Result['description'] = $riasecTop3Results['top-3-riasec']['description'] ?? '';
        $responseData = array_merge($responseData, ['riasecTop3Result' => $riasecTop3Result]);

        $ccsResult = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'ccs', $userType, $descriptors);
        // Sort by score descending
        $ccsResult = $ccsResult->sortByDesc('score')->values();
        $responseData = array_merge($responseData, ['ccsResult' => $ccsResult]);

        // $allStarResult = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'all_star', $userType, $descriptors);
        // $responseData = array_merge($responseData, ['allStarResult' => $allStarResult]);
        
        $personalityTypeResult = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'personality_type', $userType, $descriptors);
        $personalityTypeResponseResult = [];
        foreach ($personalityTypeResult as $name => $result) {
            $personalityTypeResponseResult['name'] = $result['name'] ?? '';
            $personalityTypeResponseResult['description'] = $result['level_description'] ?? '';
            break;
        }

        $responseData = array_merge($responseData, ['personalityTypeResult' => $personalityTypeResponseResult]);

        $flightRiskResult = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'flight_risk', $userType, $descriptors);
        $responseData = array_merge($responseData, ['flightRiskResult' => $flightRiskResult]);

        $organizationalFitForecastResult = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'organizational_fit_forecast', $userType, $descriptors);
        $responseData = array_merge($responseData, ['organizationalFitForecastResult' => $organizationalFitForecastResult]);

        $growthPotentialResult = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'growth_potential', $userType, $descriptors);
        $responseData = array_merge($responseData, ['growthPotentialResult' => $growthPotentialResult]);

        $rciResult = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'rci', $userType, $descriptors);
        $responseData = array_merge($responseData, ['rciResult' => $rciResult]);

        $oceanSelfResult = [];

        $oceanSelfResult['Openness to Experience'] = $oceanDomainResults['openness-to-experience']['score'] ?? 0;
        $oceanSelfResult['Conscientiousness'] = $oceanDomainResults['conscientiousness']['score'] ?? 0;
        $oceanSelfResult['Extraversion'] = $oceanDomainResults['extraversion']['score'] ?? 0;
        $oceanSelfResult['Agreeableness'] = $oceanDomainResults['agreeableness']['score'] ?? 0;
        $oceanSelfResult['Emotional Stability'] = $oceanDomainResults['emotional-stability']['score'] ?? 0;

        $learningStyle = AssessmentHelper::getLearningStyle($user_id, $oceanSelfResult);
        $responseData = array_merge($responseData, ['learningStyle' => $learningStyle]);

        $behaviorFitRateResult = NewAssessmentHelper::getFormattedUserResults($results, 'all', 'soft_skill_score', $userType, $descriptors, $user->position_id);
        $responseData = array_merge($responseData, ['behaviorFitRateResult' => $behaviorFitRateResult]);

        $oceanDomainDescriptors = DB::table('master_descriptors')->where('assessment_type', 'ocean')->where('result_type', 'domains')->where('user_type', $userType)->get();
        $responseData = array_merge($responseData, ['oceanDomainDescriptors' => $oceanDomainDescriptors]);

        $oceanAllFacetsDescriptors = DB::table('master_descriptors')->where('assessment_type', 'ocean')->where('result_type', 'all_facets')->where('user_type', $userType)->get();
        $responseData = array_merge($responseData, ['oceanAllFacetsDescriptors' => $oceanAllFacetsDescriptors]);

        $riasecDomainDescriptors = DB::table('master_descriptors')->where('assessment_type', 'riasec')->where('result_type', 'domains')->where('user_type', $userType)->get();
        $responseData = array_merge($responseData, ['riasecDomainDescriptors' => $riasecDomainDescriptors]);

        $ccsDomainDescriptors = DB::table('master_descriptors')->where('assessment_type', 'ocean')->where('result_type', 'ccs')->where('user_type', $userType)->get();
        $responseData = array_merge($responseData, ['ccsDomainDescriptors' => $ccsDomainDescriptors]);

        $learningAndDevelopmentPlanDescriptors = DB::table('master_descriptors')->where('assessment_type', 'ocean')->where('result_type', 'learning_and_development_plan')->where('user_type', $userType)->get();
        $responseData = array_merge($responseData, ['learningAndDevelopmentPlanDescriptors' => $learningAndDevelopmentPlanDescriptors]);

        // OCEAN Summary
        $oceanSummary = NewAssessmentHelper::getOceanSummary($oceanDomainResults, 'admin');
        $responseData = array_merge($responseData, ['oceanSummary' => $oceanSummary]);

        return $responseData;
    }

    public function getJobCentricReport($userId, $jobId)  {
        $responseData = [];
        $user = User::find($userId);
        $user_id = $userId;
        $results = UserResult::where('user_id', $user_id)->get();
        if (! $results->isEmpty()) {
            $isUserResultExists = 1;
        } else {
            $isUserResultExists = 0;
        }
        $responseData = array_merge($responseData, ['isUserResultExists' => $isUserResultExists]);
        $responseData['user'] = $user;
        $userType = $user->role_name ?? '';
        $descriptors = DB::table('master_descriptors')->where('user_type', $userType)->get();
        
        $total_correct = QuizDomainValueAnswer::where('user_id', $user_id)->where('quiz_domain_value_question_id', '>', 376)->where('is_correct', 1)->count();
        $responseData = array_merge($responseData, ['totalCorrectForCognitive' => $total_correct]);

        $total_not_attempted = QuizDomainValueAnswer::where('user_id', $user_id)->where('quiz_domain_value_question_id', '>', 376)->where('time_taken', 0)->where('option_selected', 0)->count();
        $responseData = array_merge($responseData, ['totalNonAttemptedForCognitive' => $total_not_attempted]);
        if ($total_correct == 0 && $total_not_attempted == 0) {
            $total_wrong = 0;
        } else {
            $total_wrong = 50 - $total_correct - $total_not_attempted;
        }
        $responseData = array_merge($responseData, ['totalWrongForCognitive' => $total_wrong]);

        $cognitiveOverallResult = NewAssessmentHelper::getFormattedUserResults($results, 'cognitive', 'overall', $userType, $descriptors);
        $responseData = array_merge($responseData, ['cognitiveOverallResult' => $cognitiveOverallResult]);

        $totalMarksForCognitive = $cognitiveOverallResult['cognitive']['score'] ?? 0;
        $responseData = array_merge($responseData, ['totalMarksForCognitive' => $totalMarksForCognitive]);

        $cognitiveDomainResult = NewAssessmentHelper::getFormattedUserResults($results, 'cognitive', 'domains', $userType, $descriptors);
        $responseData = array_merge($responseData, ['cognitiveDomainResult' => $cognitiveDomainResult]);

        $riasecTop3Results = NewAssessmentHelper::getFormattedUserResults($results, 'riasec', 'top_3_riasec');

        $riasecTop3Result['string'] = $riasecTop3Results['top-3-riasec']['level_description'] ?? '';
        $riasecTop3Result['array'] = str_split($riasecTop3Result['string']) ?? [];
        $riasecTop3Result['job_top_3_riasec'] = $user->position->top3riasec ?? '';
        $riasecTop3Result['job_top_3_riasec_array'] = str_split($riasecTop3Result['job_top_3_riasec']) ?? [];
        $riasecTop3Result['description'] = $riasecTop3Results['top-3-riasec']['description'] ?? '';
        $responseData = array_merge($responseData, ['riasecTop3Result' => $riasecTop3Result]);

        $ccsResult = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'ccs', $userType, $descriptors);

        // $jobSkills = $candidate->position->skills ?? [];
        $job = Job::find($jobId);
        $jobSkills = $job->skills ?? [];

        $jobSkillsArray = [];
        $jobSkillsLevelArray = [];
        foreach ($jobSkills as $skill) {
            $jobSkillsArray[] = $skill->title;
            $jobSkillsLevelArray[$skill->title] = $skill->level;
        }

        $jobCcsResult = [];
        $ccsResult = $ccsResult->filter(function ($result) use ($jobSkillsArray, $jobSkillsLevelArray, &$jobCcsResult, $descriptors, $userType) {
            // $result['is_job_required_skill'] = in_array($result['name'], $jobSkillsArray) ? 1 : 0;
            if (in_array($result['name'], $jobSkillsArray)) {
                // Add the current result to $jobCcsResult
                if($jobSkillsLevelArray[$result['name']] < $result['level']) {
                    $result['alignment_level'] = 3;
                } elseif ($jobSkillsLevelArray[$result['name']] == $result['level']) {
                    $result['alignment_level'] = 2;
                } elseif($jobSkillsLevelArray[$result['name']] > $result['level']) {
                    $result['alignment_level'] = 1;
                }
                else {
                    $result['alignment_level'] = 0;
                }
                $description = $descriptors->where('slug',$result['slug'])->where('user_type', $userType)->whereNotNull('job_requirement_level')->where('job_requirement_level', $jobSkillsLevelArray[$result['name']])->where('user_score_level', $result['level'])->first()->analysis ?? '';
                
                $result['required_level'] = $jobSkillsLevelArray[$result['name']];
                $result['description'] = $description;
                $jobCcsResult[$result['slug']] = $result;
                
                return false; // Remove it from $ccsResult
            }
        
            return true; // Keep it in $ccsResult
        });
        
        // Sort by score descending
       // Convert array to collection
        $jobCcsResult = collect($jobCcsResult);

        // Now you can sort the collection by 'score'
        $jobCcsResult = $jobCcsResult->sortByDesc('score')->values();
        $responseData = array_merge($responseData, ['jobCcsResult' => $jobCcsResult]);
        
        $personalityTypeResult = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'personality_type', $userType, $descriptors);
        $personalityTypeResponseResult = [];
        foreach ($personalityTypeResult as $name => $result) {
            $personalityTypeResponseResult['name'] = $result['name'] ?? '';
            $personalityTypeResponseResult['description'] = $result['level_description'] ?? '';
            break;
        }

        $responseData = array_merge($responseData, ['personalityTypeResult' => $personalityTypeResponseResult]);

        $flightRiskResult = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'flight_risk', $userType, $descriptors);
        $responseData = array_merge($responseData, ['flightRiskResult' => $flightRiskResult]);

        $organizationalFitForecastResult = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'organizational_fit_forecast', $userType, $descriptors);
        $responseData = array_merge($responseData, ['organizationalFitForecastResult' => $organizationalFitForecastResult]);

        $growthPotentialResult = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'growth_potential', $userType, $descriptors);
        $responseData = array_merge($responseData, ['growthPotentialResult' => $growthPotentialResult]);

        $rciResult = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'rci', $userType, $descriptors);
        $responseData = array_merge($responseData, ['rciResult' => $rciResult]);


        $overAllMatchRateResult = NewAssessmentHelper::getFormattedUserResults($results, 'all', 'overall_match_rate', $userType, $descriptors, $jobId);
        $responseData = array_merge($responseData, ['overAllMatchRateResult' => $overAllMatchRateResult]);

        $behaviorFitRateResult = NewAssessmentHelper::getFormattedUserResults($results, 'all', 'soft_skill_score', $userType, $descriptors, $jobId);
        $responseData = array_merge($responseData, ['behaviorFitRateResult' => $behaviorFitRateResult]);

        $technicalResult = NewAssessmentHelper::getFormattedUserResults($results, 'technical', 'overall', $userType, $descriptors, $jobId);
        $responseData = array_merge($responseData, ['technicalResult' => $technicalResult]);

        $softSkillMatchRateResult = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'ccs_match_rate', $userType, $descriptors, $jobId);
        $responseData = array_merge($responseData, ['softSkillMatchRateResult' => $softSkillMatchRateResult]);

        $jobMatchRateResult = NewAssessmentHelper::getFormattedUserResults($results, 'riasec', 'jmr', $userType, $descriptors, $jobId);
        $responseData = array_merge($responseData, ['jobMatchRateResult' => $jobMatchRateResult]);

        $technicalSkillMatchRateResult = NewAssessmentHelper::getFormattedUserResults($results, 'cognitive', 'technical_skill_match_rate', $userType, $descriptors, $jobId);
        $responseData = array_merge($responseData, ['technicalSkillMatchRateResult' => $technicalSkillMatchRateResult]);

        $leadershipPotentialResult = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'leadership_potential', $userType, $descriptors);
        $responseData = array_merge($responseData, ['leadershipPotentialResult' => $leadershipPotentialResult]);
       
        $ccsDomainDescriptors = DB::table('master_descriptors')->where('assessment_type', 'ocean')->where('result_type', 'ccs')->where('user_type', $userType)->get();
        $responseData = array_merge($responseData, ['ccsDomainDescriptors' => $ccsDomainDescriptors]);
  
        return $responseData;
    }

    public function getStrategicInsight($userId) {
        $results = UserResult::where('user_id', $userId)->whereIn('result_type', ['growth_potential', 'overall', 'flight_risk', 'organizational_fit_forecast'])->get();

        $gp = $results->where('result_type', 'growth_potential')->first()->level ?? 0;
        $cat = $results->where('assessment_type', 'cognitive')->where('result_type', 'overall')->first()->level ?? 0;
        $fr = $results->where('result_type', 'flight_risk')->first()->level ?? 0;
        $waf = $results->where('result_type', 'organizational_fit_forecast')->first()->level ?? 0;

        $si['potential_value'] = 0;
        $si['potential_title'] = 'N/A';

        if (($gp) && ($cat)) {
            if (($gp > 3) || ($cat > 2)) {
                $si['potential_value'] = 3;
                $si['potential_title'] = 'High Potential Talent';
            } elseif (($gp < 3) || ($cat < 2)) {
                $si['potential_value'] = 1;
                $si['potential_title'] = 'Low Potential Talent';
            } elseif (($gp == 3) || ($cat == 2)) {
                $si['potential_value'] = 2;
                $si['potential_title'] = 'Stable Potential Talent';
            } 
        }

        $si['alignment_value'] = 0;
        $si['alignment_title'] = 'N/A';

        if (($fr) && ($waf)) {
            if (($fr > 3) || ($waf >= 3)) {
                $si['alignment_value'] = 1;
                $si['alignment_title'] = 'Critical Risk Talent';
            } elseif (($fr <= 3) || ($waf < 3)) {
                $si['alignment_value'] = 2;
                $si['alignment_title'] = 'Stable Alignment Talent';
            }
        }

        return $si;
    }
}