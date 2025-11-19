<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\QuizDomainValueAnswer;
use App\Models\SavedEmployee;
// use Illuminate\Database\Eloquent\Builder;
// use Illuminate\Database\Query\Expression;
use App\Helpers\AssessmentHelper;
use App\Helpers\NewAssessmentHelper;
use App\Models\Position;
use App\Models\Department;
use App\Models\Job;
use App\Models\JobOpening;
use App\Models\JobOpeningApplication;
use App\Models\UserResult;

class AnalyticalController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function compareForm(Request $request)
    {
        // dd($request->all());
        $responseData = [];
        $data = [];
        $request_user_ids = $request->employees ?? [];
        $pool = $request->pool;
        $isDepartment = 0;
        if ($pool == 'departments') {
            $isDepartment = 1;
        }

        if($isDepartment) {
           $request_department_ids = $request->departments ?? [];

            if(auth()->user()->company_id) {
                $company_id = auth()->user()->company_id;
            } else {
                $company_id = 3;
            }

           $data[0]['name'] = 'Overall Company';
           $data[0]['total_users'] = User::where('company_id', $company_id)->where('is_admin', 0)->count();
           $data[0]['total_users_completed_assessment'] = User::where('company_id', $company_id)->where('is_admin', 0)->where('is_cognitive_ability_completed', '=', 1)
           ->where('is_work_interest_completed', '=', 1)
           ->where('is_personality_motivation_completed', '=', 1)->count();
           $data[0]['total_users_completed_all_assessment'] = User::where('company_id', $company_id)->where('is_admin', 0)->where('is_cognitive_ability_completed', '=', 1)
                                                            ->where('is_work_interest_completed', '=', 1)
                                                            ->where('is_personality_motivation_completed', '=', 1)
                                                            ->where('technical_assessment_completed', '=', 1)->count();

            $company_average_soft_skill_match_rate = DB::table('user_results')
            ->join('users', 'user_results.user_id', '=', 'users.id')
            ->where('users.company_id', $company_id)
            ->where('users.is_cognitive_ability_completed', '=', 1)
            ->where('users.is_work_interest_completed', '=', 1)
            ->where('users.is_personality_motivation_completed', '=', 1)
            ->where('user_results.result_type', '=', 'ccs_match_rate')
            ->avg('user_results.percentage'); 
                                                        
           $data[0]['soft_skill_match_rate'] = round($company_average_soft_skill_match_rate, 2);

           $company_average_behavior_rate = DB::table('user_results')
            ->join('users', 'user_results.user_id', '=', 'users.id')
            ->where('users.company_id', $company_id)
            ->where('users.is_cognitive_ability_completed', '=', 1)
            ->where('users.is_work_interest_completed', '=', 1)
            ->where('users.is_personality_motivation_completed', '=', 1)
            ->where('user_results.result_type', '=', 'soft_skill_score') 
            ->avg('user_results.percentage'); 

           $data[0]['behavior_fit_rate'] = round($company_average_behavior_rate, 2);

           $company_average_overall_match_rate = DB::table('user_results')
            ->join('users', 'user_results.user_id', '=', 'users.id')
            ->where('users.company_id', $company_id)
            ->where('users.is_cognitive_ability_completed', '=', 1)
            ->where('users.is_work_interest_completed', '=', 1)
            ->where('users.is_personality_motivation_completed', '=', 1)
            ->where('users.technical_assessment_completed', '=', 1)
            ->where('user_results.result_type', '=', 'overall_match_rate') // Filter for overall_match_rate
            ->avg('user_results.percentage'); // Averaging the percentage column

           $data[0]['overall_match_rate'] = round($company_average_overall_match_rate, 2);

           
           $average_ocean_result = AssessmentHelper::getOCEANResultFull(0,1);
                
           $data[0]['predictive_performance_result'] = ($average_ocean_result['Conscientiousness'] / 5)*100 ?? '0';

           $cognitive_ability_result = DB::table('user_results')
           ->join('users', 'user_results.user_id', '=', 'users.id')
           ->where('users.company_id', $company_id)
           ->where('users.is_cognitive_ability_completed', '=', 1)
           ->where('users.is_work_interest_completed', '=', 1)
           ->where('users.is_personality_motivation_completed', '=', 1)
           ->where('user_results.assessment_type', '=', 'cognitive')
           ->where('user_results.result_type', '=', 'overall')
           ->avg('user_results.percentage'); 
           if ($cognitive_ability_result >= 28.13) {
             $cognitive_level = 3;
           } elseif ($cognitive_ability_result < 11.45) {
             $cognitive_level = 1;
           } else {
             $cognitive_level = 2;
           }
           $data[0]['cognitive_ability_result'] = $cognitive_level;

           $flightRisk = DB::table('user_results')
                    ->join('users', 'user_results.user_id', '=', 'users.id')
                    ->select(
                        DB::raw("SUM(CASE WHEN user_results.result_type = 'flight_risk' AND user_results.level > 3 THEN 1 ELSE 0 END) as highFlightRiskUsers")
                    )
                    ->where('users.company_id', $company_id)
                    ->where('users.is_admin', 0)
                    ->where('users.is_cognitive_ability_completed', 1)
                    ->where('users.is_work_interest_completed', 1)
                    ->where('users.is_personality_motivation_completed', 1)
                    ->first();


            $data[0]['high_flight_risk_users_count'] = $flightRisk->highFlightRiskUsers ?? 0;
           
            if($flightRisk->highFlightRiskUsers) {
                $data[0]['flight_risk_result'] = number_format(($flightRisk->highFlightRiskUsers / $data[0]['total_users_completed_assessment']) * 100, 2, '.', '');
            } else {
                $data[0]['flight_risk_result'] = 0;
            }

           // Calculate the average GP percentage (growth_potential)
           $averageGpPercentage = DB::table('user_results')
           ->join('users', 'user_results.user_id', '=', 'users.id')
           ->where('users.company_id', $company_id)
           ->where('users.is_personality_motivation_completed', 1)
           ->where('users.is_work_interest_completed', 1)
           ->where('users.is_cognitive_ability_completed', 1)
           ->where('user_results.result_type', '=', 'growth_potential') // Adjusted result_type to 'growth_potential'
           ->avg('user_results.percentage'); // Assuming 'percentage' holds the growth potential value

           // If the average GP percentage is null, set it to 0
           if ($averageGpPercentage === null) {
              $averageGpPercentage = 0;
           }

           // Count users with a GP percentage higher than the average (growth_potential)
           $userWhichHaveHighGpPercentageThanAverage = DB::table('user_results')
           ->join('users', 'user_results.user_id', '=', 'users.id')
           ->where('users.company_id', $company_id)
           ->where('users.is_personality_motivation_completed', 1)
           ->where('users.is_work_interest_completed', 1)
           ->where('users.is_cognitive_ability_completed', 1)
           ->where('user_results.result_type', '=', 'growth_potential')
           ->where('user_results.percentage', '>', $averageGpPercentage)
           ->count();
           $data[0]['growth_potential_result'] = $averageGpPercentage;
            // if($flightRisk->totalUsersGivenAssessment != 0) {
            //     $data[0]['growth_potential_result'] = number_format(($userWhichHaveHighGpPercentageThanAverage / $flightRisk->totalUsersGivenAssessment) * 100, 2, '.', '');
            // } else {
            //     $data[0]['growth_potential_result'] = 0;
            // }

            $company_average_organizational_fit_forecast = DB::table('user_results')
                ->join('users', 'user_results.user_id', '=', 'users.id')
                ->where('users.company_id', $company_id)
                ->where('users.is_cognitive_ability_completed', 1)
                ->where('users.is_work_interest_completed', 1)
                ->where('users.is_personality_motivation_completed', 1)
                ->where('user_results.result_type', '=', 'organizational_fit_forecast')
                ->avg('user_results.percentage'); 

            $data[0]['organizational_fit_forecast_result'] = round($company_average_organizational_fit_forecast, 2);

           
           if ($request_department_ids) {
            foreach($request_department_ids as $key => $department_id) {
                $department = Department::find($department_id);
                $totalUsers = User::where('department_id', $department_id)->count();
                $data[$department_id]['name'] = $department->head_of_department ?? 'N/A';
                $data[$department_id]['total_users'] = $totalUsers ?? 0;
                $data[$department_id]['total_users_completed_assessment'] = User::where('department_id', $department_id)->where('is_admin', 0)->where('is_cognitive_ability_completed', '=', 1)
                                                            ->where('is_work_interest_completed', '=', 1)
                                                            ->where('is_personality_motivation_completed', '=', 1)->count();
                $data[$department_id]['total_users_completed_all_assessment'] = User::where('department_id', $department_id)->where('is_admin', 0)->where('is_cognitive_ability_completed', '=', 1)
                                                            ->where('is_work_interest_completed', '=', 1)
                                                            ->where('is_personality_motivation_completed', '=', 1)
                                                            ->where('technical_assessment_completed', '=', 1)->count();                                            
                $department_average_match_rate = DB::table('user_results')
                                                            ->join('users', 'user_results.user_id', '=', 'users.id')
                                                            ->where('users.department_id', $department_id)
                                                            ->where('users.is_cognitive_ability_completed', 1)
                                                            ->where('users.is_work_interest_completed', 1)
                                                            ->where('users.is_personality_motivation_completed', 1)
                                                            ->where('user_results.result_type', '=', 'soft_skill_score') 
                                                            ->avg('user_results.percentage');
                                                        
                $data[$department_id]['match_rate'] = round($department_average_match_rate,2);

                $department_average_soft_skill_match_rate = DB::table('user_results')
                        ->join('users', 'user_results.user_id', '=', 'users.id')
                        ->where('users.department_id', $department_id)
                        ->where('users.is_cognitive_ability_completed', 1)
                        ->where('users.is_work_interest_completed', 1)
                        ->where('users.is_personality_motivation_completed', 1)
                        ->where('user_results.result_type', '=', 'ccs_match_rate') // Adjusted result_type
                        ->avg('user_results.percentage'); // Averaging the percentage column

                $data[$department_id]['soft_skill_match_rate'] = round($department_average_soft_skill_match_rate, 2);

                $department_average_behavior_rate = DB::table('user_results')
                        ->join('users', 'user_results.user_id', '=', 'users.id')
                        ->where('users.department_id', $department_id)
                        ->where('users.is_cognitive_ability_completed', 1)
                        ->where('users.is_work_interest_completed', 1)
                        ->where('users.is_personality_motivation_completed', 1)
                        ->where('user_results.result_type', '=', 'soft_skill_score')
                        ->avg('user_results.percentage');

                $data[$department_id]['behavior_fit_rate'] = round($department_average_behavior_rate, 2);

                $department_average_overall_match_rate = DB::table('user_results')
                ->join('users', 'user_results.user_id', '=', 'users.id')
                ->where('users.department_id', $department_id)
                ->where('users.is_cognitive_ability_completed', 1)
                ->where('users.is_work_interest_completed', 1)
                ->where('users.is_personality_motivation_completed', 1)
                ->where('users.technical_assessment_completed', 1)
                ->where('user_results.result_type', '=', 'overall_match_rate') // Adjusted result_type
                ->avg('user_results.percentage'); // Averaging the percentage column
            
                $data[$department_id]['overall_match_rate'] = round($department_average_overall_match_rate, 2);

                $average_ocean_result = AssessmentHelper::getOCEANResultFullByDepartment($department_id);
                
                $data[$department_id]['predictive_performance_result'] = ($average_ocean_result['Conscientiousness'] / 5)*100 ?? '0';
                // $cognitive_ability_result = AssessmentHelper::getCognitiveResultFullByDepartment($department_id);
                // $data[$department_id]['cognitive_ability_result'] = (int) (($cognitive_ability_result['Quantitative Knowledge'] + $cognitive_ability_result['Comprehension Knowledge'] + $cognitive_ability_result['Visual Reasoning'] + $cognitive_ability_result['Fluid Reasoning']) / 4);
                $cognitive_ability_result = DB::table('user_results')
                    ->join('users', 'user_results.user_id', '=', 'users.id')
                    ->where('users.department_id', $department_id)
                    ->where('users.is_cognitive_ability_completed', '=', 1)
                    ->where('users.is_work_interest_completed', '=', 1)
                    ->where('users.is_personality_motivation_completed', '=', 1)
                    ->where('user_results.assessment_type', '=', 'cognitive')
                    ->where('user_results.result_type', '=', 'overall')
                    ->avg('user_results.percentage'); 

                    if ($cognitive_ability_result >= 28.13) {
                        $cognitive_level = 3;
                    } elseif ($cognitive_ability_result < 11.45) {
                        $cognitive_level = 1;
                    } else {
                        $cognitive_level = 2;
                    }
                    $data[$department_id]['cognitive_ability_result'] = $cognitive_level;

                // $totalUsersGivenAssessment = User::where('is_admin','=',0)->where('department_id', $department_id)->where('is_cognitive_ability_completed', '=', 1)->where('is_work_interest_completed', '=', 1)->where('is_personality_motivation_completed', '=', 1)->count();

                // $highFlightRiskUsers = User::where('department_id', $department_id)->where('flight_risk_level', 'high')->count();

                $flightRisk = DB::table('user_results')
                            ->join('users', 'user_results.user_id', '=', 'users.id')
                            ->select(
                                DB::raw("COUNT(DISTINCT users.id) as totalUsersGivenAssessment"),
                                DB::raw("SUM(CASE WHEN user_results.result_type = 'flight_risk' AND user_results.level > 3 THEN 1 ELSE 0 END) as highFlightRiskUsers")
                            )
                            ->where('users.department_id', $department_id)
                            ->where('users.is_admin', 0)
                            ->where('users.is_cognitive_ability_completed', 1)
                            ->where('users.is_work_interest_completed', 1)
                            ->where('users.is_personality_motivation_completed', 1)
                            ->first();

                
                $data[$department_id]['high_flight_risk_users_count'] = $flightRisk->highFlightRiskUsers ?? 0;

                if($flightRisk->highFlightRiskUsers) {
                    $data[$department_id]['flight_risk_result'] = number_format(($flightRisk->highFlightRiskUsers / $data[$department_id]['total_users_completed_assessment']) * 100, 2, '.', '');
                } else {
                    $data[$department_id]['flight_risk_result'] = 0;
                }
                

               // Calculate the average GP percentage (growth_potential)
                $averageGpPercentage = DB::table('user_results')
                ->join('users', 'user_results.user_id', '=', 'users.id')
                ->where('users.department_id', $department_id)
                ->where('users.is_personality_motivation_completed', 1)
                ->where('users.is_work_interest_completed', 1)
                ->where('users.is_cognitive_ability_completed', 1)
                ->where('user_results.result_type', '=', 'growth_potential') // Adjusted result_type to 'growth_potential'
                ->avg('user_results.percentage'); // Assuming 'percentage' holds the growth potential value

                // If the average GP percentage is null, set it to 0
                if ($averageGpPercentage === null) {
                   $averageGpPercentage = 0;
                }

                // Count users with a GP percentage higher than the average (growth_potential)
                $userWhichHaveHighGpPercentageThanAverage = DB::table('user_results')
                ->join('users', 'user_results.user_id', '=', 'users.id')
                ->where('users.department_id', $department_id)
                ->where('users.is_personality_motivation_completed', 1)
                ->where('users.is_work_interest_completed', 1)
                ->where('users.is_cognitive_ability_completed', 1)
                ->where('user_results.result_type', '=', 'growth_potential') // Adjusted result_type to 'growth_potential'
                ->where('user_results.percentage', '>', $averageGpPercentage)
                ->count();

                // Store the result in the $data array
                $data[$department_id]['growth_potential_result'] = $averageGpPercentage;

                
                // if($flightRisk->totalUsersGivenAssessment != 0) {
                //     $data[$department_id]['growth_potential_result'] = number_format(($userWhichHaveHighGpPercentageThanAverage / $flightRisk->totalUsersGivenAssessment) * 100, 2, '.', '');
                // } else {
                //     $data[$department_id]['growth_potential_result'] = 0;
                // }
                
                $department_average_organizational_fit_forecast = DB::table('user_results')
                ->join('users', 'user_results.user_id', '=', 'users.id')
                ->where('users.department_id', $department_id)
                ->where('users.is_cognitive_ability_completed', 1)
                ->where('users.is_work_interest_completed', 1)
                ->where('users.is_personality_motivation_completed', 1)
                ->where('user_results.result_type', '=', 'organizational_fit_forecast') 
                ->avg('user_results.percentage');
            
                $data[$department_id]['organizational_fit_forecast_result'] = round($department_average_organizational_fit_forecast, 2);
            }
           }
          
        } else {
            if ($request_user_ids) {
                 $descriptors = DB::table('master_descriptors')->where('user_type', 'employee')->get();
                foreach($request_user_ids as $key => $user_id) {
                    $user = User::find($user_id);
                    $userResults = UserResult::where('user_id', $user_id)->get();

                    $data[$user_id]['first_name'] = $user->first_name ?? 'N/A';
                    $data[$user_id]['name'] = $user->first_name.''.$user->middle_name. ''.$user->last_name  ?? 'N/A';
                    $data[$user_id]['gender'] = $user->gender ?? 'N/A';
                    $data[$user_id]['age'] = $user->age ?? 'N/A';
                    $data[$user_id]['education_level'] = $user->education_level_check->name ?? 'N/A';
                    $data[$user_id]['higher_learning_institution'] = $user->higher_learning->name ?? 'N/A';
                    $data[$user_id]['work_experience'] = $user->year_of_experience_in_it_sector ?? 'N/A';
                    $data[$user_id]['profile_picture'] = $user->profile_picture ?? '';

                    // OCEAN Result
                    $ppr_result =  NewAssessmentHelper::getFormattedUserResults($userResults, 'all', 'ppr', $user->role_name, $descriptors);
                    $predictive_performance_result = $ppr_result['performance-predictive-rate']['percentage'] ?? 0;
                    // Determine the performance level based on the percentage
                    if ($predictive_performance_result > 98) {
                        $ppr_level = 5;
                    } elseif ($predictive_performance_result > 84 && $predictive_performance_result <= 98) {
                        $ppr_level = 4;
                    } elseif ($predictive_performance_result >= 16 && $predictive_performance_result <= 84) {
                        $ppr_level = 3;
                    } elseif ($predictive_performance_result >= 2 && $predictive_performance_result < 16) {
                        $ppr_level = 2;
                    } else {
                        $ppr_level = 1;
                    }
                    $data[$user_id]['predictive_performance_result'] = $ppr_level ?? 0;
                    $data[$user_id]['predictive_performance_result_description'] = $ppr_result['performance-predictive-rate']['description'] ?? $ppr_level;

                    // Cognitive
                    // Single
                    $cognitive_ability_result =  NewAssessmentHelper::getFormattedUserResults($userResults, 'cognitive', 'overall', $user->role_name, $descriptors);

                    // $data[$user_id]['cognitive_ability_result'] = (int) $cognitive_ability_result['cognitive']['level'] ?? 0;
                    $data[$user_id]['cognitive_ability_result'] = isset($cognitive_ability_result['cognitive']) && isset($cognitive_ability_result['cognitive']['level']) 
                    ? (int) $cognitive_ability_result['cognitive']['level'] 
                    : 0;

                    $data[$user_id]['cognitive_ability_result_description'] = isset($cognitive_ability_result['cognitive']) && isset($cognitive_ability_result['cognitive']['description']) 
                    ?  $cognitive_ability_result['cognitive']['description'] : 0;
                
                    // Top 3 RIASEC
                    $top_3_riasec =  NewAssessmentHelper::getFormattedUserResults($userResults, 'riasec', 'top_3_riasec');
                   
                    $data[$user_id]['top_3_riasec'] = $top_3_riasec['top-3-riasec']['level_description'] ?? '';
                    $data[$user_id]['top_3_riasec_description'] = $top_3_riasec['top-3-riasec']['description'] ?? '';

                    // Flight Risk
                    $flight_risk = NewAssessmentHelper::getFormattedUserResults($userResults, 'ocean', 'flight_risk', $user->role_name, $descriptors);
                    $data[$user_id]['flight_risk_result'] = $flight_risk['flight-risk']['level'] ?? 0;
                    $data[$user_id]['flight_risk_result_description'] = $flight_risk['flight-risk']['description'] ?? '';

                    // Match Rate
                    // $position = Job::find($user->position_id);
                    // if($position) {
                    //     $positions = str_split($position->top3riasec);
                    // } else {
                    //     $positions = ["S","E","C"];
                    // }

                    // $score = 0;
                    // if (in_array($user->riasec_code_one, $positions)) {
                    //     $score = $score + (($user->riasec_code_one_score) * 0.6);
                    // } elseif (in_array($user->riasec_code_two, $positions)) {
                    //     $score = $score + (($user->riasec_code_two_score) * 0.3);
                    // } elseif (in_array('C', $positions)) {
                    //     $score = $score + (($user->riasec_code_three_score) * 0.1);
                    // }
                    
                    // Soft Skill Match Rate
                    $ccs_match_rate = NewAssessmentHelper::getFormattedUserResults($userResults, 'ocean', 'ccs_match_rate', $user->role_name, $descriptors);
                    $data[$user_id]['talent_pillar_match_rate'] = $ccs_match_rate['ccs-match-rate']['level'] ?? 0;
                    $data[$user_id]['talent_pillar_match_rate_description'] = $ccs_match_rate['ccs-match-rate']['description'] ?? '';

                    // Behaviour Fit Rate
                    $soft_skill_score = NewAssessmentHelper::getFormattedUserResults($userResults, 'all', 'soft_skill_score', $user->role_name, $descriptors);
                    $data[$user_id]['soft_skill_match_rate'] = $soft_skill_score['soft-skill-score']['level'] ?? 0;
                    $data[$user_id]['soft_skill_match_rate_description'] = $soft_skill_score['soft-skill-score']['description'] ?? '';

                    // Overall Match Rate
                    if($user->technical_assessment_completed == 0) {
                        $data[$user_id]['match_rate'] = 0;
                        $data[$user_id]['match_rate_description'] = 'Technical Assessment Not Completed';
                    } else {
                        $overall_match_rate = NewAssessmentHelper::getFormattedUserResults($userResults, 'all', 'overall_match_rate', $user->role_name, $descriptors);
                        $data[$user_id]['match_rate'] = $overall_match_rate['overall-match-rate']['level'] ?? 0;
                        $data[$user_id]['match_rate_description'] = $overall_match_rate['overall-match-rate']['description'] ?? '';
                    }

                    // Technical Assessment Result
                    $tech_skill_score = $user->tech_skill_score ?? 0;
                    if ($tech_skill_score == 0) {
                        $data[$user_id]['technical_assessment_result'] = 0;
                        $data[$user_id]['technical_assessmnent_result_description'] = 'Technical Assessment Not Completed';
                    } else {
                        // Determine the performance level based on the percentage
                        if ($tech_skill_score >= 90) {
                            $technical_level = 5;
                        } elseif ($tech_skill_score >= 70 && $tech_skill_score < 90) {
                            $technical_level = 4;
                        } elseif ($tech_skill_score >= 60 && $tech_skill_score < 70) {
                            $technical_level = 3;
                        } elseif ($tech_skill_score >= 45 && $tech_skill_score < 60) {
                            $technical_level = 2;
                        } else {
                            $technical_level = 1;
                        }
                        $technical_assessment_result = NewAssessmentHelper::getFormattedUserResults($userResults, 'technical', 'overall', $user->role_name, $descriptors);
                        $data[$user_id]['technical_assessment_result'] = $technical_level ?? 0;
                        $data[$user_id]['technical_assessment_result_description'] = $technical_assessment_result['technical']['description'] ?? '';
                    }
                    // Job Match Rate (RIASEC Match Rate)
                    // if($user->riasec_job_match_rate >= 70) {
                    //     $riasec_job_match_rate = 'High';
                    // } elseif ($user->riasec_job_match_rate <= 40) {
                    //     $riasec_job_match_rate = 'Low';
                    // } else {
                    //     $riasec_job_match_rate = 'Moderate';
                    // }
                   
                    $riasec_job_match_rate = NewAssessmentHelper::getFormattedUserResults($userResults, 'riasec', 'jmr', $user->role_name, $descriptors);
                    // dd($riasec_job_match_rate);
                    $data[$user_id]['job_match_rate'] = $riasec_job_match_rate['job-match-rate']['level'] ?? 0;
                    $data[$user_id]['job_match_rate_description'] = $riasec_job_match_rate['job-match-rate']['description'] ?? '';
                    // OCEAN Reliability
                    $rci = NewAssessmentHelper::getFormattedUserResults($userResults, 'ocean', 'rci', $user->role_name, $descriptors);

                    // $data[$user_id]['ocean_reliability_result'] = AssessmentHelper::getOCEANReliability($user_id) ?? 'Average';
                    $data[$user_id]['rci'] = $rci['rci']['level'] ?? 1;
                    $data[$user_id]['rci_description'] = $rci['rci']['description'] ?? '';

                    // Position
                    $data[$user_id]['position'] = $user->job_position->title ?? 'N/A';

                    // Growth Potential
                    // $averageGpPercentage = User::where('company_id', auth()->user()->hasRole('company') ? auth()->user()->id : auth()->user()->company_id)->where('is_personality_motivation_completed', '=', 1)->where('is_work_interest_completed', '=', 1)->where('is_cognitive_ability_completed', '=', 1)->avg('gp_percentage');
                    // $growth_potential = 'Average';

                    // if(isset($user->gp_percentage) && ($user->gp_percentage > $averageGpPercentage)) {
                    //     $growth_potential = 'High';
                    // }

                    $growth_potential = NewAssessmentHelper::getFormattedUserResults($userResults, 'ocean', 'growth_potential', $user->role_name, $descriptors);
                    $data[$user_id]['growth_potential_result'] = $growth_potential['growth-potential']['level'] ?? 0;
                    $data[$user_id]['growth_potential_result_description'] = $growth_potential['growth-potential']['description'] ?? '';

                    // Dark Triads (Organization Fit Forecast)
                    // $organizational_fit_forecast_result = AssessmentHelper::getOrganizationalFitForecast($all_facets);
                    $organizational_fit_forecast_result = NewAssessmentHelper::getFormattedUserResults($userResults, 'ocean', 'organizational_fit_forecast', $user->role_name, $descriptors);
                    $data[$user_id]['organizational_fit_forecast_result'] = $organizational_fit_forecast_result['organizational-fit-forecast']['level'] ?? 0;
                    $data[$user_id]['organizational_fit_forecast_result_description'] = $organizational_fit_forecast_result['organizational-fit-forecast']['description'] ?? '';

                   
                }
            }
        }
        // $responseData = array_merge($responseData, ['teamDynamicsEmployeeAResult' => $teamDynamicsResultA]);
        return view('admin.compare', compact('data','isDepartment'));
    }

    public function analytics(){
        $departments = Department::where('company_id', auth()->user()->isCompany() ? auth()->user()->id : auth()->user()->company_id)->get();
        if (auth()->user()->isDepartment()){
            $departments = Department::where('company_id', auth()->user()->isCompany() ? auth()->user()->id : auth()->user()->company_id)->where('id',auth()->user()->department_id)->get();
        }
        $employees = User::where('company_id', auth()->user()->isCompany() ? auth()->user()->id : auth()->user()->company_id)->where('role_name', 'employee')->where('is_personality_motivation_completed', 1)->where('is_work_interest_completed', 1)->where('is_work_interest_completed', 1)->where('is_cognitive_ability_completed', 1)->where('department_id', 63)->get();
        return view('admin.compare_filter',compact('departments','employees'));
    }

    public function getEmployeesByDepartment(Request $request)
    {
        $departmentId = $request->department;
       
        $employees = User::join('jobs', 'users.position_id', '=', 'jobs.id')->where('company_id', auth()->user()->isCompany() ? auth()->user()->id : auth()->user()->company_id)->where('role_name', 'employee')->where('is_personality_motivation_completed', 1)->where('is_work_interest_completed', 1)->where('is_work_interest_completed', 1)->where('is_cognitive_ability_completed', 1)->where('users.department_id', $departmentId)->select('users.id','users.first_name','users.last_name','users.name')->get();
// dd($employees);
        return response()->json(['employees' => $employees]);
    }

    public function advanceCompare(Request $request) {

        $responseData = [];

        if ($request->job_opening_id) {
            $job_opening_id = $request->job_opening_id;
        } else {
            $job_opening_id = 33;
        }

        $jobOpening = Job::find($job_opening_id);

        if ($jobOpening) {
            $department_id = $jobOpening->department_id;
        } else {
            $department_id = 68;
        }

        if(auth()->user()->company_id) {
            $company_id = auth()->user()->company_id;
        } else {
            $company_id = 3;
        }

        
        $responseData['job_opening_id'] = $job_opening_id;
        $responseData['company_id'] = $company_id;
        $responseData['department_id'] = $department_id;


        // Department 
        $department = Department::find($department_id);
        $departments = Department::where('company_id', $company_id)->get();
        if (auth()->user()->isDepartment()) {
            $departments = Department::where('company_id', $company_id)->where('id', auth()->user()->department_id)->get();
        } 
        $responseData = array_merge($responseData, ['departments' => $departments]); 
        
        // Job Positions
        $departmentIds = Department::where('company_id', $company_id)->pluck('id');
        if (auth()->user()->isDepartment()) {
            $departmentIds = Department::where('company_id', $company_id)->where('id', auth()->user()->department_id)->pluck('id');
        } 
        $jobOpenings = JobOpening::whereIn('department_id', $departmentIds)->get();
        $responseData = array_merge($responseData, ['jobOpenings' => $jobOpenings]);

        // Candidates
        // Dynamic Based on Position

        // Employees
        // Dynamic Based on Position

        
        $responseData = array_merge($responseData, ['superior' => "superior"]);

        if($request->candidate_id) {
            $responseData = array_merge($responseData, ['candidate_id' => $request->candidate_id]);
        } else {
            $responseData = array_merge($responseData, ['candidate_id' => ""]);
        }

        if ($request->candidate_id && $request->report) {

            if($request->pool_type == 'candidate_vs_candidate') {
                $superior_id = $request->superior_id;
                $employee_id = $request->second_candidate_id;
                $candidate_id = $request->candidate_id;
                $assessment = $request->report;

                $responseData['first_title'] = 'C1';
                $responseData['second_title'] = 'C2';
                $responseData['company_title'] = 'C';
                $responseData['department_title'] = 'D';
            } else {
                $superior_id = $request->superior_id;
                $employee_id = $request->employee_id;
                $candidate_id = $request->candidate_id;
                $assessment = $request->report;

                $responseData['first_title'] = 'C';
                $responseData['second_title'] = 'E';
                $responseData['company_title'] = 'C';
                $responseData['department_title'] = 'D';
            }
            
                
            // Big Five
            if ($assessment == 'ocean') {
                $superior = AssessmentHelper::getOceanResultFull($superior_id,0);
                $employee = AssessmentHelper::getOceanResultFull($employee_id,0);
                $candidate = AssessmentHelper::getOceanResultFull($candidate_id,0);
                $overall = AssessmentHelper::getOceanResultFull($employee_id,1);
                $department = AssessmentHelper::getOceanResultFullByDepartment(68);

                $responseData = array_merge($responseData, ['oceanSuperiorResult' => $superior]);
                $responseData = array_merge($responseData, ['oceanEmployeeResult' => $employee]);
                $responseData = array_merge($responseData, ['oceanCandidateResult' => $candidate]);
                $responseData = array_merge($responseData, ['oceanOverallResult' => $overall]);
                $responseData = array_merge($responseData, ['oceanDepartmentResult' => $department]);
                         
            }

            # Work Interest
            if ($assessment == 'work_interest') {
                $superior = AssessmentHelper::getWorkInterestResultFull($superior_id,0);
                $employee = AssessmentHelper::getWorkInterestResultFull($employee_id,0);
                $candidate = AssessmentHelper::getWorkInterestResultFull($candidate_id,0);
                $overall = AssessmentHelper::getWorkInterestResultFull($employee_id,1);
                $department = AssessmentHelper::getWorkInterestResultFullByDepartment(68);

                $responseData = array_merge($responseData, ['workInterestSuperiorResult' => $superior]);
                $responseData = array_merge($responseData, ['workInterestEmployeeResult' => $employee]);
                $responseData = array_merge($responseData, ['workInterestCandidateResult' => $candidate]);
                $responseData = array_merge($responseData, ['workInterestOverallResult' => $overall]);
                $responseData = array_merge($responseData, ['workInterestDepartmentResult' => $department]);
                
            }

            # Talent Pillars (Work Competency)
            if ($assessment == 'talent_pillar') {

                $superior = AssessmentHelper::getWorkCompetencyResultFull($superior_id,0);
                $employee = AssessmentHelper::getWorkCompetencyResultFull($employee_id,0);
                $candidate = AssessmentHelper::getWorkCompetencyResultFull($candidate_id,0);
                $overall = AssessmentHelper::getWorkCompetencyResultFull($employee,1);
                $department = AssessmentHelper::getWorkCompetencyResultFullByDepartment(68);

                $responseData = array_merge($responseData, ['workCompetencySuperiorResult' => $superior]);
                $responseData = array_merge($responseData, ['workCompetencyEmployeeResult' => $employee]);
                $responseData = array_merge($responseData, ['workCompetencyCandidateResult' => $candidate]);
                $responseData = array_merge($responseData, ['workCompetencyOverallResult' => $overall]);
                $responseData = array_merge($responseData, ['workCompetencyDepartmentResult' => $department]);
                
            }

            # Cognitive Ability
            if ($assessment == 'cognitive_ability') {

                $superior = AssessmentHelper::getCognitiveResultFull($superior_id,0);
                $employee = AssessmentHelper::getCognitiveResultFull($employee_id,0);
                $candidate = AssessmentHelper::getCognitiveResultFull($candidate_id,0);
                // $overall = AssessmentHelper::getCognitiveResultFull($employee,1);
                // $department = AssessmentHelper::getCognitiveResultFullByDepartment(68);

                $responseData = array_merge($responseData, ['cognitiveSuperiorResult' => $superior]);
                $responseData = array_merge($responseData, ['cognitiveEmployeeResult' => $employee]);
                $responseData = array_merge($responseData, ['cognitiveCandidateResult' => $candidate]);
                // $responseData = array_merge($responseData, ['workCompetencyOverallResult' => $overall]);
                // $responseData = array_merge($responseData, ['workCompetencyDepartmentResult' => $department]);

                $totalMarksSuperior = QuizDomainValueAnswer::where('user_id', $superior)->where('quiz_domain_value_question_id', '>', 376)->sum('answer');
                $totalMarksEmployee = QuizDomainValueAnswer::where('user_id', $employee)->where('quiz_domain_value_question_id', '>', 376)->sum('answer');
                $totalMarksCandidate = QuizDomainValueAnswer::where('user_id', $candidate)->where('quiz_domain_value_question_id', '>', 376)->sum('answer');

                $cognitiveLevelForSuperior = 'Low';
                $cognitiveLevelForEmployee = 'Low';
                $cognitiveLevelForCandidate = 'Low';
                if ($totalMarksSuperior > 24) {
                    $cognitiveLevelForSuperior = 'High';
                } elseif ($totalMarksSuperior > 15 && $totalMarksSuperior <= 24) {
                    $cognitiveLevelForSuperior = 'Medium';
                } else {
                    $cognitiveLevelForSuperior = 'Low';
                }

                if ($totalMarksEmployee > 24) {
                    $cognitiveLevelForEmployee = 'High';
                } elseif ($totalMarksEmployee > 15 && $totalMarksEmployee <= 24) {
                    $cognitiveLevelForEmployee = 'Medium';
                } else {
                    $cognitiveLevelForEmployee = 'Low';
                }

                if ($totalMarksCandidate > 24) {
                    $cognitiveLevelForCandidate = 'High';
                } elseif ($totalMarksCandidate > 15 && $totalMarksCandidate <= 24) {
                    $cognitiveLevelForCandidate = 'Medium';
                } else {
                    $cognitiveLevelForCandidate = 'Low';
                }

                $responseData = array_merge($responseData, ['cognitiveLevelForSuperior' => $cognitiveLevelForSuperior]);
                $responseData = array_merge($responseData, ['cognitiveLevelForEmployee' => $cognitiveLevelForEmployee]);
                $responseData = array_merge($responseData, ['cognitiveLevelForCandidate' => $cognitiveLevelForCandidate]);

               
            }

            # OCEAN All Facets
            if ($assessment == 'all_facets') {

                // Calculate averages for each domain using aggregate
                // $superior = AssessmentHelper::getOCEANAllFacetsResultFull($superior_id, 0);
                $employee = AssessmentHelper::getOCEANAllFacetsResultFull($employee_id, 0);
                $candidate = AssessmentHelper::getOCEANAllFacetsResultFull($candidate_id, 0);
                $overall = AssessmentHelper::getOCEANAllFacetsResultFull($employee_id,1);
                $department = AssessmentHelper::getOCEANAllFacetsResultFull(68,1);

                $responseData = array_merge($responseData, ['oceanAllFacetsSuperiorResult' => []]);
                $responseData = array_merge($responseData, ['oceanAllFacetsEmployeeResult' => $employee]);
                $responseData = array_merge($responseData, ['oceanAllFacetsCandidateResult' => $candidate]);
                $responseData = array_merge($responseData, ['oceanAllFacetsOverallResult' => $overall]);
                $responseData = array_merge($responseData, ['oceanAllFacetsDepartmentResult' => $department]);

            }

            # Team Dynamics
            if ($assessment == 'team_dynamics') {
                

                // Calculate averages for each domain using aggregate
                $superior = AssessmentHelper::getTeamDynamicsResult($superior_id, 0);
                $employee = AssessmentHelper::getTeamDynamicsResult($employee_id, 0);
                $candidate = AssessmentHelper::getTeamDynamicsResult($candidate_id, 0);

                $responseData = array_merge($responseData, ['teamDynamicsSuperiorResult' => $superior]);
                $responseData = array_merge($responseData, ['teamDynamicsEmployeeResult' => $employee]);
                $responseData = array_merge($responseData, ['teamDynamicsCandidateResult' => $candidate]);
            }
        } 
        

        return view('admin.advance-compare', $responseData);
    }

    public function comparison(Request $request) {
        $request_user_ids = $request->request_user_ids ?? [];
        $data = [];
        if ($request_user_ids) {
            foreach($request_user_ids as $key => $user_id) {
                $user = User::find($user_id);
                $data[$user_id]['first_name'] = $user->first_name ?? 'N/A';
                $data[$user_id]['name'] = $user->first_name.''.$user->middle_name. ''.$user->last_name  ?? 'N/A';
                $data[$user_id]['gender'] = $user->gender ?? 'N/A';
                $data[$user_id]['age'] = $user->age ?? 'N/A';
                $data[$user_id]['education_level'] = $user->education_level_check->name ?? 'N/A';
                $data[$user_id]['higher_learning_institution'] = $user->higher_learning->name ?? 'N/A';
                $data[$user_id]['work_experience'] = $user->year_of_experience_in_it_sector ?? 'N/A';
                $data[$user_id]['profile_picture'] = $user->profile_picture ?? '';
                $data[$user_id]['technical_score'] = $user->tech_skill_score ?? '';
                // OCEAN Result
                $ocean_result = AssessmentHelper::getOCEANResultFull($user_id,0);
                $data[$user_id]['predictive_performance_result'] = ($ocean_result['Conscientiousness'] / 5)*100 ?? '0';

                // Cognitive
                // Single
                $cognitive_ability_result = AssessmentHelper::getCognitiveResultFull($user_id,0);
                $data[$user_id]['cognitive_ability_result'] = (int) (($cognitive_ability_result['Quantitative Knowledge'] + $cognitive_ability_result['Comprehension Knowledge'] + $cognitive_ability_result['Visual Reasoning'] + $cognitive_ability_result['Fluid Reasoning']) / 4);

                // Top 3 RIASEC
                $work_interest_result = AssessmentHelper::getWorkInterestResultFull($user_id,0);
                $top_3_riasec = $work_interest_result['top_3_riasec'];
                $data[$user_id]['top_3_riasec'] = $top_3_riasec;
                

                // Flight Risk
                $all_facets = AssessmentHelper::getOCEANAllFacetsResultFull($user_id,0);
                $flight_risk = AssessmentHelper::getFlightRiskFull($all_facets);

                $data[$user_id]['flight_risk_result'] = $flight_risk;

                $data[$user_id]['match_rate'] = $user->soft_skill_score;
                // OCEAN Reliability
                $data[$user_id]['ocean_reliability_result'] = AssessmentHelper::getOCEANReliability($user_id) ?? 'Low';

                // Position
                $data[$user_id]['position'] = $user->job_position->title ?? 'N/A';

                $growth_potential = AssessmentHelper::getGrowthPotential(auth()->user()->id,$user->gp_percentage,$user->cognitive_test_percentage);
                $data[$user_id]['growth_potential_result'] = $growth_potential;

                // Dark Triads (Organization Fit Forecast)
                $organizational_fit_forecast_result = AssessmentHelper::getOrganizationalFitForecast($all_facets);
                $data[$user_id]['organizational_fit_forecast_result'] = $organizational_fit_forecast_result ?? 'Low';
            }
        }
        $users = User::where('is_cognitive_ability_completed', '=', 1)
                        ->where('is_work_interest_completed', '=', 1)
                        ->where('is_personality_motivation_completed', '=', 1)
                        ->where('is_technical_assessment_completed', '=', 1)
                        ->where('is_pm_cm', '=', 1)
                        ->get();
        return view('admin.comparison', compact('data','users'));
    }
}
