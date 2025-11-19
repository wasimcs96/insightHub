<?php

namespace App\Services\TalentAcquisition;

use App\Helpers\AssessmentHelper;
use App\Helpers\NewAssessmentHelper;
use App\Models\ActivityLog;
use App\Models\Job;
use App\Models\JobOpening;
use App\Models\JobOpeningApplication;
use App\Models\QuizDomainValueAnswer;
use App\Models\User;
use App\Models\UserResult;
use Illuminate\Support\Facades\DB;

class ApplicantDetailsService
{
    public function getApplicantDetails($jobOpeningId, $applicantId, $page)
    {
        $responseData = [];
        $jobOpeningApplication = JobOpeningApplication::where('job_opening_id', $jobOpeningId)
            ->where('user_id', $applicantId)
            ->first();

        $jobOpeningApplicationId = $jobOpeningApplication->id;

        // Handle the logic for each page
        switch ($page) {
            case 'job-application':
                $responseData = $this->getJobApplication($jobOpeningId, $applicantId, $jobOpeningApplicationId);
                break;
            case 'documents':
                $responseData = $this->getDocuments($jobOpeningId, $applicantId, $jobOpeningApplicationId);
                break;
            case 'psychometric':
                $responseData = $this->getPsychometric($jobOpeningId, $applicantId, $jobOpeningApplicationId);
                break;
            case 'job-centric-report':
                $responseData = $this->getJobCentricReport($jobOpeningId, $applicantId, $jobOpeningApplicationId);
                break;
            default:
                $responseData = $this->getJobApplication($jobOpeningId, $applicantId, $jobOpeningApplicationId);
        }

        // Add additional information
        $responseData['jobOpeningApplication'] = $jobOpeningApplication;
        $responseData['page'] = $page;
        // Fetch Overall Match Rate (OMR)
        $omrResult = UserResult::where('job_id', $jobOpeningApplication->jobOpening->job_id)
        ->where('user_id', $applicantId)
        ->where('result_type', 'overall_match_rate')
        ->first();
    
       $responseData['omr'] = $omrResult->level ?? 0;

        $jobOpeningApplications = JobOpeningApplication::where('id', '!=', $jobOpeningApplication->id)->where('user_id', $applicantId)->get();
        $isMultipleJobOpeningApplicationsExists = 0;
        if ($jobOpeningApplications->count() > 0) {
            $isMultipleJobOpeningApplicationsExists = 1;
        }

        $responseData['isMultipleJobOpeningApplicationsExists'] = $isMultipleJobOpeningApplicationsExists;
        $responseData['jobOpeningApplications'] = $jobOpeningApplications;

        // Suitability Rate Logic
        $suitabilityRateLevel = $this->getSuitabilityRateLevel($jobOpeningApplication->suitability_rate);
        $responseData['suitabilityRateLevel'] = $suitabilityRateLevel;

        return $responseData;
    }

    private function getJobApplication($jobOpeningId, $applicantId, $jobOpeningApplicationId)
    {
        $responseData = [];
        $activityLogs = ActivityLog::where('user_id', $applicantId)
            ->where('job_application_id', $jobOpeningApplicationId)
            ->get();
        $responseData['activityLogs'] = $activityLogs;

        return $responseData;
    }

    private function getDocuments($jobOpeningId, $applicantId, $jobOpeningApplicationId)
    {
        $responseData = [];
        $activityLogs = ActivityLog::where('user_id', $applicantId)
            ->where('job_application_id', $jobOpeningApplicationId)
            ->get();
        $responseData['activityLogs'] = $activityLogs;

        return $responseData;
    }

    private function getPsychometric($jobOpeningId, $applicantId, $jobOpeningApplicationId)
    {
        $responseData = [];
        $candidate = User::find($applicantId);
        $user_id = $applicantId;
        $results = UserResult::where('user_id', $user_id)->get();
        if (! $results->isEmpty()) {
            $isUserResultExists = 1;
        } else {
            $isUserResultExists = 0;
        }
        $responseData = array_merge($responseData, ['isUserResultExists' => $isUserResultExists]);
        $responseData['candidate'] = $candidate;

        $jobId = JobOpening::where('id', $jobOpeningId)->first()->job_id;
        $descriptors = DB::table('master_descriptors')->where('user_type', 'candidate')->get();
        
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

        $cognitiveOverallResult = NewAssessmentHelper::getFormattedUserResults($results, 'cognitive', 'overall', 'candidate', $descriptors);
        $responseData = array_merge($responseData, ['cognitiveOverallResult' => $cognitiveOverallResult]);

        $totalMarksForCognitive = $cognitiveOverallResult['cognitive']['score'] ?? 0;
        $responseData = array_merge($responseData, ['totalMarksForCognitive' => $totalMarksForCognitive]);

        $cognitiveDomainResult = NewAssessmentHelper::getFormattedUserResults($results, 'cognitive', 'domains', 'candidate', $descriptors);
        $responseData = array_merge($responseData, ['cognitiveDomainResult' => $cognitiveDomainResult]);

        $oceanDomainResults = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'domains');
        $responseData = array_merge($responseData, ['oceanDomainResult' => $oceanDomainResults]);

        $oceanAllFacetsResult = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'all_facets', 'candidate', $descriptors);
        $responseData = array_merge($responseData, ['oceanAllFacetsResult' => $oceanAllFacetsResult]);

        $riasecDomainResult = NewAssessmentHelper::getFormattedUserResults($results, 'riasec', 'domains', 'candidate', $descriptors);
        $responseData = array_merge($responseData, ['riasecDomainResult' => $riasecDomainResult]);

        $riasecTop3Results = NewAssessmentHelper::getFormattedUserResults($results, 'riasec', 'top_3_riasec');

        $riasecTop3Result['string'] = $riasecTop3Results['top-3-riasec']['level_description'] ?? '';
        $riasecTop3Result['array'] = str_split($riasecTop3Result['string']) ?? [];
        $riasecTop3Result['job_top_3_riasec'] = $user->position->top3riasec ?? '';
        $riasecTop3Result['job_top_3_riasec_array'] = str_split($riasecTop3Result['job_top_3_riasec']) ?? [];
        $riasecTop3Result['description'] = $riasecTop3Results['top-3-riasec']['description'] ?? '';
        $responseData = array_merge($responseData, ['riasecTop3Result' => $riasecTop3Result]);

        $ccsResult = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'ccs', 'candidate', $descriptors);

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
        $ccsResult = $ccsResult->filter(function ($result) use ($jobSkillsArray, $jobSkillsLevelArray, &$jobCcsResult, $descriptors) {
            // $result['is_job_required_skill'] = in_array($result['name'], $jobSkillsArray) ? 1 : 0;
            if (in_array($result['name'], $jobSkillsArray)) {
                // Add the current result to $jobCcsResult
                if($jobSkillsLevelArray[$result['name']] < $result['level']) {
                    $result['alignment_level'] = 2;
                } elseif ($jobSkillsLevelArray[$result['name']] == $result['level']) {
                    $result['alignment_level'] = 1;
                } else {
                    $result['alignment_level'] = 0;
                }
                $description = $descriptors->where('slug',$result['slug'])->where('user_type', 'candidate')->whereNotNull('job_requirement_level')->where('job_requirement_level', $jobSkillsLevelArray[$result['name']])->where('user_score_level', $result['level'])->first()->analysis ?? '';
                
                $result['required_level'] = $jobSkillsLevelArray[$result['name']];
                $result['description'] = $description;
                $jobCcsResult[$result['slug']] = $result;
                
                return false; // Remove it from $ccsResult
            }
        
            return true; // Keep it in $ccsResult
        });

        $responseData = array_merge($responseData, ['ccsResult' => $ccsResult]);
        $responseData = array_merge($responseData, ['jobCcsResult' => $jobCcsResult]);

        $allStarResult = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'all_star', 'candidate', $descriptors);
        $responseData = array_merge($responseData, ['allStarResult' => $allStarResult]);
        
        $personalityTypeResult = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'personality_type', 'candidate', $descriptors);
        $personalityTypeResponseResult = [];
        foreach ($personalityTypeResult as $name => $result) {
            $personalityTypeResponseResult['name'] = $result['name'] ?? '';
            $personalityTypeResponseResult['description'] = $result['level_description'] ?? '';
            break;
        }

        $responseData = array_merge($responseData, ['personalityTypeResult' => $personalityTypeResponseResult]);

        $flightRiskResult = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'flight_risk', 'candidate', $descriptors);
        $responseData = array_merge($responseData, ['flightRiskResult' => $flightRiskResult]);

        $organizationalFitForecastResult = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'organizational_fit_forecast', 'candidate', $descriptors);
        $responseData = array_merge($responseData, ['organizationalFitForecastResult' => $organizationalFitForecastResult]);

        $growthPotentialResult = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'growth_potential', 'candidate', $descriptors);
        $responseData = array_merge($responseData, ['growthPotentialResult' => $growthPotentialResult]);

        $rciResult = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'rci', 'candidate', $descriptors);
        $responseData = array_merge($responseData, ['rciResult' => $rciResult]);

        $oceanSelfResult = [];

        $oceanSelfResult['Openness to Experience'] = $oceanDomainResults['openness-to-experience']['score'] ?? 0;
        $oceanSelfResult['Conscientiousness'] = $oceanDomainResults['conscientiousness']['score'] ?? 0;
        $oceanSelfResult['Extraversion'] = $oceanDomainResults['extraversion']['score'] ?? 0;
        $oceanSelfResult['Agreeableness'] = $oceanDomainResults['agreeableness']['score'] ?? 0;
        $oceanSelfResult['Emotional Stability'] = $oceanDomainResults['emotional-stability']['score'] ?? 0;

        $learningStyle = AssessmentHelper::getLearningStyle($user_id, $oceanSelfResult);
        $responseData = array_merge($responseData, ['learningStyle' => $learningStyle]);

        $overAllMatchRateResult = NewAssessmentHelper::getFormattedUserResults($results, 'all', 'overall_match_rate', 'candidate', $descriptors, $jobId);
        $responseData = array_merge($responseData, ['overAllMatchRateResult' => $overAllMatchRateResult]);

        $behaviorFitRateResult = NewAssessmentHelper::getFormattedUserResults($results, 'all', 'soft_skill_score', 'candidate', $descriptors, $jobId);
        $responseData = array_merge($responseData, ['behaviorFitRateResult' => $behaviorFitRateResult]);

        $technicalResult = NewAssessmentHelper::getFormattedUserResults($results, 'technical', 'overall', 'candidate', $descriptors, $jobId);
        $responseData = array_merge($responseData, ['technicalResult' => $technicalResult]);

        $softSkillMatchRateResult = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'ccs_match_rate', 'candidate', $descriptors, $jobId);
        $responseData = array_merge($responseData, ['softSkillMatchRateResult' => $softSkillMatchRateResult]);

        $jobMatchRateResult = NewAssessmentHelper::getFormattedUserResults($results, 'riasec', 'jmr', 'candidate', $descriptors, $jobId);
        $responseData = array_merge($responseData, ['jobMatchRateResult' => $jobMatchRateResult]);

        $oceanDomainDescriptors = DB::table('master_descriptors')->where('assessment_type', 'ocean')->where('result_type', 'domains')->where('user_type', 'candidate')->take(20)->get();
        $responseData = array_merge($responseData, ['oceanDomainDescriptors' => $oceanDomainDescriptors]);

        $oceanAllFacetsDescriptors = DB::table('master_descriptors')->where('assessment_type', 'ocean')->where('result_type', 'all_facets')->where('user_type', 'candidate')->get();
        $responseData = array_merge($responseData, ['oceanAllFacetsDescriptors' => $oceanAllFacetsDescriptors]);

        $riasecDomainDescriptors = DB::table('master_descriptors')->where('assessment_type', 'riasec')->where('result_type', 'domains')->where('user_type', 'candidate')->get();
        $responseData = array_merge($responseData, ['riasecDomainDescriptors' => $riasecDomainDescriptors]);

        $ccsDomainDescriptors = DB::table('master_descriptors')->where('assessment_type', 'ocean')->where('result_type', 'ccs')->where('user_type', 'candidate')->get();
        $responseData = array_merge($responseData, ['ccsDomainDescriptors' => $ccsDomainDescriptors]);

        $learningAndDevelopmentPlanDescriptors = DB::table('master_descriptors')->where('assessment_type', 'ocean')->where('result_type', 'learning_and_development_plan')->where('user_type', 'candidate')->get();
        $responseData = array_merge($responseData, ['learningAndDevelopmentPlanDescriptors' => $learningAndDevelopmentPlanDescriptors]);

        $allStarDomainDescriptors = DB::table('master_descriptors')->where('assessment_type', 'ocean')->where('result_type', 'all_star')->where('user_type', 'candidate')->get();
        $responseData = array_merge($responseData, ['allStarDomainDescriptors' => $allStarDomainDescriptors]);

        // OCEAN Summary
        $oceanSummary = NewAssessmentHelper::getOceanSummary($oceanDomainResults, 'admin');
        $responseData = array_merge($responseData, ['oceanSummary' => $oceanSummary]);

        return $responseData;
    }

    private function getJobCentricReport($jobOpeningId, $applicantId, $jobOpeningApplicationId)
    {
        return $this->getPsychometric($jobOpeningId, $applicantId, $jobOpeningApplicationId);
    }

    private function getSuitabilityRateLevel($score)
    {
        if ($score >= 0 && $score <= 19) {
            return 1; // Low
        } elseif ($score >= 20 && $score <= 39) {
            return 2; // Moderate
        } elseif ($score >= 40 && $score <= 59) {
            return 3; // High
        } elseif ($score >= 60 && $score <= 79) {
            return 4; // Very High
        } elseif ($score >= 80 && $score <= 100) {
            return 5; // Excellent
        }

        return 0; // Invalid score or out of range
    }
}
