@extends('admin.layout.app')

@section('title', 'Compare')
@section('styles')
    <style>
        .container {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .back-button {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }

        h1 {
            margin: 0;
            font-size: 24px;
        }

        .tabs {
            display: flex;
        }

        .tab {
            border: none;
            background-color: transparent;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
        }

        .tab.active {
            border-bottom: 2px solid #007bff;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead th {
            color: #242021;
            padding: 10px;
            text-align: left;
        }

        tbody td {
            padding: 10px;
            height: 78px;
            border-bottom: 1px solid #dee2e6;
        }

        .create-comparison-button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            display: block;
            width: fit-content;
            margin: 0 auto;
        }

        .user-info {
            display: flex;
            align-items: center;
        }

        .user-info img {
            border-radius: 50%;
            width: 40px;
            height: 40px;
            margin-right: 10px;
        }

        .user-info span {
            font-size: 14px;
            font-weight: bold;
        }
    </style>
@endsection

@section('content')
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5 mb-lg-0">
                <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                    Analytical
                </h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="/admin/dashboard" class="text-muted text-hover-primary">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        Analytical
                    </li>
                </ul>
            </div>
        </div>
    </div>
    
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container">
            <div class="card">
                <div class="card-header border-0">
                    <div class="card-title">
                        <h2 class="capitalize">Comparison result</h2>
                    </div>
                    <div class="card-toolbar">
                        <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                            <a href="/admin/analytical" class="btn btn-primary d-flex align-items-center">
                                <iconify-icon icon="solar:alt-arrow-left-linear"></iconify-icon> Back
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body" style="padding: 0px;">
                    @if($isDepartment)
                    <table>
                        <thead>
                            <tr>
                                <th style="background: #ededed;border-radius: 1px; width: 310px;">Department</th>
                                @foreach ($data as $department_id => $department)
                                    <th>
                                        <div class="justify-content-center user-info">
                                            <span class="predictive-score dim_title cursor-pointer me-3" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="{{ $department['name'] ?? '' }}">{{ $department['name'] ?? '' }}</span>
                                        </div>
                                    </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $fields = [
                                    'No. of Persons in Department' => function($department) {
                                        return $department['total_users'] ?? '0';
                                    },
                                    'No. of Persons Completed Psychometric Assessment in Department' => function($department) {
                                        return $department['total_users_completed_assessment'] ?? '0';
                                    },
                                    'No. of Persons Completed All Assessment in Department' => function($department) {
                                        return $department['total_users_completed_all_assessment'] ?? '0';
                                    },
                                    'Average Overall Match Rate' => function($department) {
                                        $value = $department['overall_match_rate'] ?? 0;
                                        // $description = $value >= 70 ? "Employees are well-matched to their current roles, demonstrating high engagement, productivity, and a strong sense of job satisfaction."
                                        //      : ($value >= 30 ? "Employees are fairly compatible with their roles but might benefit from additional training or career development opportunities to enhance alignment."
                                        //      : "Employees may experience challenges fully engaging with their roles, indicating a need for reevaluation of their job alignment or consideration of different positions.");
                                        return [
                                            'value' => $value . '%',
                                            // 'description' => $description
                                        ];
                                    },
                                    'Average Behavior Fit Rate' => function($department) {
                                        $value = $department['behavior_fit_rate'] ?? 0;
                                        // $description = $value >= 70 ? "Employees are well-matched to their current roles, demonstrating high engagement, productivity, and a strong sense of job satisfaction."
                                        //      : ($value >= 30 ? "Employees are fairly compatible with their roles but might benefit from additional training or career development opportunities to enhance alignment."
                                        //      : "Employees may experience challenges fully engaging with their roles, indicating a need for reevaluation of their job alignment or consideration of different positions.");
                                        return [
                                            'value' => $value . '%',
                                            // 'description' => $description
                                        ];
                                    },
                                    'Average Soft Skill Match Rate' => function($department) {
                                        $value = $department['soft_skill_match_rate'] ?? 0;
                                        // $description = $value >= 70 ? "Employees are well-matched to their current roles, demonstrating high engagement, productivity, and a strong sense of job satisfaction."
                                        //      : ($value >= 30 ? "Employees are fairly compatible with their roles but might benefit from additional training or career development opportunities to enhance alignment."
                                        //      : "Employees may experience challenges fully engaging with their roles, indicating a need for reevaluation of their job alignment or consideration of different positions.");
                                        return [
                                            'value' => $value . '%',
                                            // 'description' => $description
                                        ];
                                    },
                                    'Average Predictive Performance Rate' => function($department) {
                                        return $department['predictive_performance_result'] . '%';
                                    },
                                    'Average Cognitive Test Result' => function($department) {
                                        return 'Level:'.$department['cognitive_ability_result'];
                                    },
                                    'Average Growth Potential' => function($department) {
                                        $value = $department['avg_growth_potential'] ?? 0;
                                        if(isset($department['growth_potential_result']) && $department['growth_potential_result'] >  80){
                                            $value ='Super High';

                                        }
                                       elseif(isset($department['growth_potential_result']) && $department['growth_potential_result'] >  60){
                                        $value ='Very High';

                                       }
                                       elseif(isset($department['growth_potential_result']) && $department['growth_potential_result'] >  50){
                                        $value ='High';

                                       }
                                       else{

                                       $value = 'Average';
                                       }
                                       
                                        return [
                                            'value' => $value,
                                            // 'description' => $description
                                        ];
                                    },
                                    'Number of High Flight Risk (%)' => function($department) {
                                        $value = $department['flight_risk_result'] ?? '0';
                                        $users = $department['high_flight_risk_users_count'] ?? '0';
                                        // $description = $value == 'High' ? "Employees identified with a high flight risk exhibit signs of decreased engagement, such as reduced productivity, lack of involvement in team activities, or open exploration of new job opportunities."
                                        //       : ($value == 'Low' ? "Employees at a low flight risk level display strong engagement and satisfaction with their roles, actively participate in organizational activities, and express a commitment to long-term career development within the company."
                                        //       : "Those with a moderate flight risk might express occasional dissatisfaction or ambivalence about their career progression, job role, or the organizational culture.");
                                        return [
                                            'value' => ucfirst($value) . ' %  (' .$users . ')',
                                            // 'description' => $description
                                        ];
                                    },

                                    'Average Workplace Alignment Forecast' => function($department) {
                                        $value = $department['organizational_fit_forecast_result'] ?? '0';
                                        // $description = $value == 'High' ? "Employees identified with a high flight risk exhibit signs of decreased engagement, such as reduced productivity, lack of involvement in team activities, or open exploration of new job opportunities."
                                        //       : ($value == 'Low' ? "Employees at a low flight risk level display strong engagement and satisfaction with their roles, actively participate in organizational activities, and express a commitment to long-term career development within the company."
                                        //       : "Those with a moderate flight risk might express occasional dissatisfaction or ambivalence about their career progression, job role, or the organizational culture.");
                                        return [
                                            'value' => ucfirst($value) . ' %',
                                            // 'description' => $description
                                        ];
                                    }
                                ];
                            @endphp

                            @foreach ($fields as $field => $config)
                                <tr>
                                    <td class="fw-bold" style="background: #ededed; border-radius: 1px;">{{ $field }}</td>
                                    @foreach ($data as $department_id => $department)
                                        @php
                                            if (is_callable($config)) {
                                                $result = $config($department);
                                                $value = is_array($result) ? $result['value'] : $result;
                                                // $description = is_array($result) ? $result['description'] : '';
                                            } else {
                                                $value = $department[$config['key']] ?? 'N/A';
                                                // $description = $config['description']($department) ?? '';
                                            }
                                        @endphp
                                        <td class="text-center" data-bs-toggle="tooltip" data-bs-placement="top" >
                                            <span class="fw-medium text-gray-800">{{ $value }}</span>
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <table>
                        <thead>
                            <tr>
                                <th style="background: #ededed;border-radius: 1px; width: 310px;"></th>
                                @foreach ($data as $user_id => $single)
                                    <th>
                                        <div class="justify-content-center user-info">
                                            <a href="/admin/employee-details/{{$user_id}}">
                                            <img src="{{ asset($single['profile_picture']) }}"
                                                onerror="this.src='{{ asset('images/default-user.svg') }}'"
                                                alt="{{ $single['name'] }}"></a>
                                                <a href="/admin/employee-details/{{$user_id}}" class="text-gray-900">
                                            <span class="predictive-score dim_title cursor-pointer me-3" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="{{ $single['name'] ?? '' }}">{{ $single['first_name'] ?? '' }}</span></a>

                                            @php
                                                $bookmarked = App\Models\SavedEmployee::where('user_id', $user_id)->where('admin_id', auth()->user()->id)->first();
                                                $isBookmarked = $bookmarked ? 1 : 0;
                                            @endphp

                                            @if ($bookmarked)
                                                <a onclick="unbookmarkUser({{ $user_id }})" id="bookmarkButton_{{ $user_id }}" class="bg-gray-300 cursor-pointer compare_bookmark bookmark-button bookmarked" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="UnBookmark Employee"><iconify-icon icon="solar:bookmark-broken"></iconify-icon></a>
                                            @else
                                                <a onclick="bookmarkUser({{ $user_id }})" id="bookmarkButton_{{ $user_id }}" class="bg-gray-300 cursor-pointer compare_bookmark bookmark-button unbookmarked" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Bookmark Employee"><iconify-icon icon="solar:bookmark-broken"></iconify-icon></a>
                                            @endif
                                        </div>
                                    </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $fields = [
                                    'Position' => [
                                        'key' => 'position',
                                        'value' => function($single) {
                                            return $single['position'];
                                        },
                                        'description' => function($single) {
                                            return "The current position held by the individual within the organization.";
                                        }
                                    ],
                                    'Overall Match Rate' => [
                                        'key' => 'match_rate',
                                        'value' => function($single) {
                                            return config('helpers.overall_match_rate_levels')[$single['match_rate']];
                                        },
                                        'description' => function($single) {
                                            $value = $single['match_rate'] ?? 0;
                                            
                                            if ($value == 0) {
                                                return "Technical Assessment not completed yet.";
                                            }
                                            // return config('helpers.overall_match_rate_levels')[$single['match_rate']];
                                            return $single['match_rate_description'] ?? '';
                                            // return $value >= 75
                                            //     ? "Employees are well-matched to their current roles, demonstrating high engagement, productivity, and a strong sense of job satisfaction." 
                                            //     : ($value >= 45
                                            //         ? "Employees are fairly compatible with their roles but might benefit from additional training or career development opportunities to enhance alignment."
                                            //         : "Employees may experience challenges fully engaging with their roles, indicating a need for reevaluation of their job alignment or consideration of different positions.");
                                        }
                                    ],

                                    'Technical Assessment Result' => [
                                        'key' => 'technical_assessment_result',
                                        'value' => function($single) {
                                            return config('helpers.technical_assessment_levels')[$single['technical_assessment_result']];
                                        },
                                        'description' => function($single) {
                                            $value = $single['technical_assessment_result'] ?? 0;
                                            // return config('helpers.technical_assessment_levels')[$single['technical_assessment_result']];
                                            return $single['technical_assessment_result_description'] ?? '';
                                            // return $value >= 70 ? "High" 
                                            //      : ($value >= 30 ? "Moderate"
                                            //      : "Low");
                                        }
                                    ],

                                    'Behavior Fit Rate' => [
                                        'key' => 'soft_skill_match_rate',
                                        'value' => function($single) {
                                            return config('helpers.soft_skill_match_rate_levels')[$single['soft_skill_match_rate']];;
                                        },
                                        'description' => function($single) {
                                            $value = $single['soft_skill_match_rate'] ?? 0;
                                            // return config('helpers.soft_skill_match_rate_levels')[$single['soft_skill_match_rate']];
                                            return $single['soft_skill_match_rate_description'] ?? '';
                                            // return $value >= 70 ? "Employees are well-matched to their current roles, demonstrating high engagement, productivity, and a strong sense of job satisfaction." 
                                            //      : ($value >= 30 ? "Employees are fairly compatible with their roles but might benefit from additional training or career development opportunities to enhance alignment."
                                            //      : "Employees may experience challenges fully engaging with their roles, indicating a need for reevaluation of their job alignment or consideration of different positions.");
                                        }
                                    ],
                                    'Job Match Rate' => [ 
                                        'key' => 'job_match_rate',
                                        'value' => function($single) {
                                            // $value = $single['job_match_rate'] ?? 'Moderate';
                                            // return is_string($value) ? ucfirst($value) : 'Moderate';
                                            return config('helpers.job_match_rate_levels')[$single['job_match_rate']];
                                        },
                                        'description' => function($single) {
                                            $value = $single['job_match_rate'] ?? 'Moderate';
                                            // return config('helpers.job_match_rate_levels')[$single['job_match_rate']];
                                            return $single['job_match_rate_description'] ?? '';
                                            // return $value == 'Low' ? "There is a significant mismatch between the employee's profile and job requirements, potentially leading to lower job satisfaction and performance without intervention."
                                            //      : ($value == 'Moderate' ? "Employees show compatibility with key job aspects but may need development or support to fully align with certain role specifics or organizational culture."
                                            //      : "Employees exhibit strong alignment with the job's core responsibilities and values, suggesting immediate engagement and satisfaction, and a likelihood of long-term success.");
                                        }
                                    ],
                                    'Soft Skill Match Rate' => [
                                        'key' => 'talent_pillar_match_rate',
                                        'value' => function($single) {
                                            // return $single['talent_pillar_match_rate'] . '%';
                                            return config('helpers.talent_pillar_match_rate_levels')[$single['talent_pillar_match_rate']];
                                        },
                                        'description' => function($single) {
                                            $value = $single['talent_pillar_match_rate'] ?? 0;
                                            // return config('helpers.talent_pillar_match_rate_levels')[$single['talent_pillar_match_rate']];
                                            return $single['talent_pillar_match_rate_description'] ?? '';
                                            // return $value >= 70 ? "Employees exhibit a high level of proficiency in competencies that are key to their current and future roles, indicating potential for success and advancement within the company." 
                                            //      : ($value >= 30 ? "Employees show adequate competencies with some areas for improvement, which can be developed through targeted training to better meet current and upcoming role demands."
                                            //      : "There is a misalignment between employees' competencies and those required by their current or expected roles, pointing to a need for role reassessment or strategic skill development.");
                                        }
                                    ],
                                    'Growth Potential' => [
                                        'key' => 'growth_potential_result',
                                        'value' => function($single) {
                                            return config('helpers.growth_potential_levels')[$single['growth_potential_result']];
                                        },
                                        'description' => function($single) {
                                            $value = $single['growth_potential_result'] ?? '';
                                            // return config('helpers.growth_potential_levels')[$single['growth_potential_result']];
                                            return $single['growth_potential_result_description'] ?? '';
                                            // return $value == 'Super High' ? "Super High-potential employees are visionaries who not only excel in their current roles but also drive innovation and strategic transformation within the organization. They are natural leaders with exceptional foresight, capable of inspiring and mobilizing teams towards ambitious goals. These individuals thrive in challenging environments and are prime candidates for top executive positions, as they consistently deliver extraordinary results and exhibit a profound impact on the company's long-term success."
                                            //      : ($value == 'Very High' ? "Very High-potential employees demonstrate remarkable performance and possess the ability to take on significant responsibilities swiftly. They exhibit strong leadership qualities, strategic thinking, and an exceptional capacity for growth and learning. These employees are ideal for advanced development programs, often transitioning into critical leadership roles and contributing to major organizational initiatives. Their proactive approach and high-level problem-solving skills make them indispensable assets in driving company progress."
                                            //      : ($value == 'High' ? "High-potential employees excel in adaptability, learning, and leadership. They respond well to accelerated development opportunities, such as cross-functional projects and leadership training, often being candidates for succession planning and strategic organizational roles. Their enthusiasm for personal and professional growth, combined with their ability to inspire peers, positions them as key contributors to the organization's future success."
                                            //      : "Employees at this level are dependable and consistent in their current roles. They benefit from focused skill enhancement and may evolve into broader roles over time with dedicated training and mentorship. They are foundational to maintaining the status quo and operational success. With the right support and development, these individuals have the potential to grow and take on more responsibilities within the organization."));
                                        }
                                    ],
                                    'Cognitive Test Result' => [
                                        'key' => 'cognitive_ability_result',
                                        'value' => function($single) {
                                            // return 'Level '.$single['cognitive_ability_result'];
                                            return config('helpers.cognitive_ability_levels')[$single['cognitive_ability_result']];
                                        },
                                        'description' => function($single) {
                                            // return config('helpers.cognitive_ability_levels')[$single['cognitive_ability_result']];
                                            return $single['cognitive_ability_result_description'] ?? '';
                                        }
                                    ],
                                    // 'Performance Predictive Rate' => [
                                    //     'key' => 'predictive_performance_result',
                                    //     'value' => function($single) {
                                    //         // return $single['predictive_performance_result'] . '%';
                                    //         return config('helpers.performance_predictive_rate_levels')[$single['predictive_performance_result']];
                                    //     },
                                    //     'description' => function($single) {
                                    //         return "Individual's capacity for consistent and reliable performance, ability to meet expectations and deliver results effectively.";
                                    //     }
                                    // ],
                                    'Workplace Alignment Forecast' => [ 
                                        'key' => 'organizational_fit_forecast_result',
                                        'value' => function($single) {
                                            // return ucfirst($single['organizational_fit_forecast_result'] ?? 'Moderate') . ' Risk';
                                            return config('helpers.organizational_fit_forecast_levels')[$single['organizational_fit_forecast_result']];
                                        },
                                        'description' => function($single) {
                                            $value = $single['organizational_fit_forecast_result'] ?? 'Moderate';
                                            // return config('helpers.organizational_fit_forecast_levels')[$single['organizational_fit_forecast_result']];
                                            return $single['organizational_fit_forecast_result_description'] ?? '';
                                            // return $value == 'high' ? "Employees at a high risk level may exhibit behaviors that can lead to discord within teams and affect the overall workplace atmosphere negatively."
                                            //       : ($value == 'low' ? "Employees at a low risk level typically exhibit behaviors that support and strengthen team unity and align well with the company's cultural values."
                                            //       : "Employees with a moderate risk level might occasionally display behaviors that could impact team dynamics, yet these issues are generally manageable with proactive strategies.");
                                        }
                                    ], 
                                    'Flight Risk' => [ 
                                        'key' => 'flight_risk_result',
                                        'value' => function($single) {
                                            // $value = $single['flight_risk_result']['flight_risk_level'] ?? 'Moderate';
                                            // return is_string($value) ? ucfirst($value) : 'Moderate';
                                            return config('helpers.flight_risk_levels')[$single['flight_risk_result']];
                                        },
                                        'description' => function($single) {
                                            $value = $single['flight_risk_result']['flight_risk_level'] ?? 'Moderate';
                                            // return config('helpers.flight_risk_levels')[$single['flight_risk_result']];
                                            return $single['flight_risk_result_description'] ?? '';
                                            // return $value == 'High' ? "Employees identified with a high flight risk exhibit signs of decreased engagement, such as reduced productivity, lack of involvement in team activities, or open exploration of new job opportunities."
                                            //       : ($value == 'Low' ? "Employees at a low flight risk level display strong engagement and satisfaction with their roles, actively participate in organizational activities, and express a commitment to long-term career development within the company.": "Those with a moderate flight risk might express occasional dissatisfaction or ambivalence about their career progression, job role, or the organizational culture.");
                                        }
                                    ],
                                    'RIASEC (Top 3)' => [
                                        'key' => 'top_3_riasec',
                                        'value' => function($single) {
                                            // return $single['top_3_riasec'];
                                            return $single['top_3_riasec'];
                                        },
                                        'description' => function($single) {
                                            // $description = DB::table('master_top_3_riasec_descriptions')
                                            //     ->where('top_3_riasec', $single['top_3_riasec'])
                                            //     ->value('description');
                                            $description = $single['top_3_riasec_description'];
                                            return $description ?? '';
                                        }
                                    ],

                                    'Response Consistency Index' => [
                                        'key' => 'rci',
                                        'value' => function($single) {
                                            // return $single['ocean_reliability_result'];
                                            return config('helpers.rci_levels')[$single['rci']];
                                        },
                                        'description' => function($single) {
                                            $value = $single['rci'] ?? '';
                                            // return config('helpers.rci_levels')[$single['rci']];
                                            return $single['rci_description'] ?? '';
                                            // return $value == 'Low' ? "Low OCEAN reliability indicates results that are generally inconsistent and less reliable."
                                            //      : ($value == 'Average' ? "Average OCEAN reliability suggests a mix of reliability and inconsistency in results."
                                            //      : "High OCEAN reliability signifies consistently reliable and dependable results.");
                                        }
                                    ],
                                    
                                    'Demographics' => function($single) {
                                        return ($single['gender'] == 1 ? 'Female' : 'Male') . ', Age: ' . ($single['age'] ?? 'N/A') . ',Education Level:'.($single['education_level'] ?? 'N/A').',Work Experience:'. ($single['work_experience'] ?? 'N/A');
                                    },
                                                               
                                ];
                            @endphp

                            @foreach ($fields as $field => $config)
                                <tr>
                                    <td class="fw-bold" style="background: #ededed; border-radius: 1px;">{{ $field }}</td>
                                    @foreach ($data as $user_id => $single)
                                        @php
                                            if (is_array($config)) {
                                                $key = $config['key'];
                                                $value = $config['value']($single) ?? $single[$key];
                                                $description = $config['description']($single);
                                            } else {
                                                $value = $config($single);
                                                $description = '';
                                            }
                                        @endphp
                                        <td class="text-center" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $description }}">
                                            <span class="fw-medium text-gray-800">{{ $value }}</span>
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.35.0"></script>
    <script>
        function bookmarkUser(userId) {
            $.ajax({
                url: '/admin/employee/add-to-bookmark',
                type: 'POST',
                data: {
                    employee_id: userId,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    alert(response.message);
                    $('#bookmarkButton_' + userId).removeClass('unbookmarked').addClass('bookmarked');
                    $('#bookmarkButton_' + userId).attr('onclick', 'unbookmarkUser(' + userId + ')');
                    $('#bookmarkButton_' + userId).attr('data-bs-original-title', 'Unbookmark Employee');
                },
                error: function(xhr) {
                    alert('Error bookmarking user: ' + xhr.statusText);
                }
            });
        }

        function unbookmarkUser(userId) {
            $.ajax({
                url: '/admin/employee/remove-bookmark',
                type: 'POST',
                data: {
                    employee_id: userId,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    alert(response.message);
                    $('#bookmarkButton_' + userId).removeClass('bookmarked').addClass('unbookmarked');
                    $('#bookmarkButton_' + userId).attr('onclick', 'bookmarkUser(' + userId + ')');
                    $('#bookmarkButton_' + userId).attr('data-bs-original-title', 'Bookmark Employee');
                },
                error: function(xhr) {
                    alert('Error unbookmarking user: ' + xhr.statusText);
                }
            });
        }
    </script>
@endsection
