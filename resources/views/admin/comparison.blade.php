@extends('admin.layout.app')

@section('title', 'Analytical')
@section('styles')
    <style>
        .emp_th {
            position: inherit !important;
            width: 45px !important;
            font-size: 19px !important;
            height: 38px !important;
            text-align: center !important;
            justify-content: center !important;
            display: flex !important;
            padding: 5px !important;
        }

        .container {
            width: 80%;
            max-width: 780px;
            margin: 20px auto;
        }

        .slider-legend_cognitive {
            width: 11%;
            text-align: center;
            font-size: 11px;
            border-radius: 28px;
            padding: 0px;
            color: white;
        }

        .slider-container {
            display: flex;
            align-items: center;
            /* margin: 17px 0px; */
        }

        .slider-label {
            width: 20%;
            text-align: center;
            font-size: 14px;
        }

        .slider-track {
            width: 80%;
            position: relative;
            height: 30px;
            background: #f1f1f1;
            border-radius: 32px;
            margin: 26px 1%;
            max-width: 523px;
        }

        .slider-bar {
            position: absolute;
            top: 50%;
            left: 10%;
            right: 10%;
            height: 4px;
            background: #aaa;
            transform: translateY(-50%);
        }

        .slider-indicator {
            position: absolute;
            top: -20px;
            background: #fff;
            color: #333;
            padding: 2px 5px;
            font-size: 12px;
            border-bottom-right-radius: 50px;
            border-bottom-left-radius: 53px;
            border: 1px solid #aaa;
        }

        .emp_a,
        .emp_b {
            position: absolute;
            top: 1px;
            width: auto;
            height: auto;
            background-color: #005daf;
            border-radius: 50%;
            font-size: smaller;
            color: white;
            padding: 7px 9px;
            /* border-left: 10px solid transparent;
              border-right: 10px solid transparent;
              border-top: 10px solid #00f; */
        }

        .emp_p {
            position: absolute;
            top: 1px;
            width: auto;
            height: auto;
            background-color: #1B84FF;
            border-radius: 50%;
            font-size: smaller;
            color: white;
            padding: 7px 12px;
            /* border-left: 10px solid transparent;
              border-right: 10px solid transparent;
              border-top: 10px solid #00f; */
        }

        .emp_a {
            background-color: #0245A3;

        }

        .emp_b {
            background-color: #1AB93B;

        }



        @media (max-width: 768px) {
            .slider-label {
                font-size: 12px;
            }

            .slider-indicator {
                font-size: 10px;
            }

            .emp_a,
            .emp_b {
                position: absolute;
                top: 1px;
                width: auto;
                height: auto;
                border-radius: 50%;
                font-size: smaller;
                color: white;
                padding: 7px 12px;
            }

            .emp_p {
                position: absolute;
                top: 1px;
                width: auto;
                height: auto;
                background-color: #1B84FF;
                border-radius: 50%;
                font-size: smaller;
                color: white;
                padding: 7px 12px;
            }

            .emp_a {
                background-color: #0245A3;

            }

            .emp_b {
                background-color: #1AB93B;

            }


        }

        .hidden_population {
            display: none;
        }

        .top_riasec {
            background: #1f5476;
            color: white;
            border-radius: 29px;
        }

        .accordion-button::after {
            margin-left: 11px;
        }



        /* new css */
        .dashboard {
            display: grid;
            grid-template-columns: max-content auto;
            gap: 20px;
            max-width: 100%;
            /* margin: 20px auto; */
            padding: 20px;
        }

        .dashboard-header {
            grid-column: 1 / -1;
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
            text-align: left;
        }

        .sidebar {
            font-size: 16px;
            font-weight: bold;
            color: #333;
            padding-right: 10px;
            text-align: right;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding-bottom: 10px;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
        }

        .cardd {
            background: #F9FAFF;
            border-radius: 36px;
            box-shadow: 0 2px 4px rgb(184 192 230 / 37%);
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 27px;
        }

        .cardd img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            margin-bottom: 10px;
        }

        .match-rate,
        .predictive-score,
        .cognitive,
        .riasec,
        .reliability,
        .retention-risk {
            text-align: center;
            margin-bottom: 10px;
        }

        .match-rate span,
        .predictive-score span {
            font-size: 22px;
            font-weight: bold;
            color: #4c51bf;
        }

        .demographics {
            font-size: 14px;
            margin-bottom: 10px;
            text-align: center;
            background: #cccbef78;
            border-radius: 30px;
            padding: 10px 6px;
            width: 161px;
        }

        .demographics div:not(:last-child) {
            margin-bottom: 4px;
        }

        .dim_title {
            font-weight: 600;
            font-size: 1.1rem;
        }
    </style>
@endsection
@section('content')

    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">

        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container  container-fluid d-flex flex-stack ">


            <!--begin::Page title-->
            <div data-kt-swapper="true" data-kt-swapper-mode="{default: 'prepend', lg: 'prepend'}"
                data-kt-swapper-parent="{default: '#kt_app_content_container', lg: '#kt_app_toolbar_container'}"
                class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5 mb-lg-0">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                    Analytical
                </h1>
                <!--end::Title-->


                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">

                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="/admin/dashboard" class="text-muted text-hover-primary">
                            Dashboard </a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->

                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        Analytical </li>
                    <!--end::Item-->

                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
            <form class="d-flex align-items-center overflow-auto" action="" method="GET">
                <span class="fs-7 fw-bold text-gray-700 flex-shrink-0 pe-4 d-none d-md-block">Select Users:</span>
                <!--end::Label-->
                <!--begin::Select-->
                <select class="form-select form-select-sm form-select-solid me-6" data-control="select2" data-close-on-select="false" data-allow-clear="true" data-placeholder="Select Users" data-hide-search="true" name="request_user_ids[]" id="user_id" multiple="multiple">

                    @foreach($users as $user)
                       <option value="{{ $user->id }}" @if(request('request_user_ids') && in_array($user->id, request('request_user_ids'))) selected @endif>{{ $user->name }}</option>
                    @endforeach
                </select>
                <!--end::Select-->

                <div class="bullet bg-secondary h-35px w-1px mx-6"></div>

                <!--begin::Actions-->
                <div class="d-flex align-items-center">
                    <button type="submit" class="btn btn-sm btn-icon btn-light-primary me-3" data-bs-toggle="tooltip"
                        data-bs-placement="top" title="Filter" >
                        <iconify-icon icon="mingcute:filter-line" class="fa-2x"></iconify-icon>
                    </button>

                    <a href="{{ url()->current() }}" class="btn btn-sm btn-icon btn-light me-3" data-bs-toggle="tooltip"
                        data-bs-placement="top" title="Reset">
                        <iconify-icon icon="bx:reset" class="fa-2x"></iconify-icon>
                    </a>

                    <a href="{{ route('admin.employee.users.manager') }}" class="btn btn-sm btn-icon btn-light me-3" data-bs-toggle="tooltip"
                        data-bs-placement="top" title="Back">
                        <iconify-icon icon="bx:arrow-back"></iconify-icon>
                    </a>
                    {{-- <button class="btn btn-sm btn-icon btn-light-success " value="export" data-bs-toggle="tooltip"
                        data-bs-placement="top" title="Reset">
                        <iconify-icon icon="clarity:export-line" class="fa-2x"> </iconify-icon>
                    </button> --}}
                </div>
                <!--end::Actions-->
            </form>
        </div>
        <!--end::Toolbar container-->
    </div>
    <!--end::Toolbar-->
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content  flex-column-fluid ">


        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container">
            <div class="card">

                @if($data)
                    <div class="dashboard">
                        <div class="dashboard-header">Compare (Analytics)</div>

                        <div class="sidebar">
                            <div style="margin-top: 167px;">Name</div>
                            <div >Soft Skills Match Rate</div>
                            
                            <div>Position</div>
                            <div style="height: 160px;display: flex;align-items: center; justify-content: flex-end;">
                                Demographics
                            </div>

                            <div>Performance Predictive Rate</div>
                            <div>Cognitive Test Result</div>
                            <div>RIASEC (Top 3)</div>
                            <div>Technical Score</div>
                            <div>Ocean Reliability</div>
                            <div>Growth Potential</div>
                            <div>Flight Risk (Based on Facets)</div>
                            <div>Workplace Alignment Forecast</div>
                        </div>
                        <div class="cards" style="margin-top: 50px;">
                            <!-- Card 1 -->
                            @foreach ($data as $user_id => $single)
                                <div class="cardd">


                                    @php
                                    $bookmarked = App\Models\SavedEmployee::where('user_id', $user_id)->where('admin_id', auth()->user()->id)->first();
                                        if ($bookmarked) {
                                            $isBookmarked = 1;
                                        } else {
                                            $isBookmarked = 0;
                                        }
                                    @endphp


                                    {{-- @if ($bookmarked)
                                    <a onclick="unbookmarkUser({{ $user_id }})" id="bookmarkButton_{{ $user_id }}" class="bg-gray-300 cursor-pointer compare_bookmark bookmark-button bookmarked" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="UnBookmark Employee"  ><iconify-icon icon="solar:bookmark-broken"></iconify-icon></a>
                                    @else

                                    <a onclick="bookmarkUser({{ $user_id }})" id="bookmarkButton_{{ $user_id }}" class="bg-gray-300 cursor-pointer compare_bookmark bookmark-button unbookmarked" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Bookmark Employee"   ><iconify-icon icon="solar:bookmark-broken"></iconify-icon></a>
                                    @endif --}}



                                    <a href="/admin/employee-details/{{$user_id}}">
                                        <img src="{{ asset($single['profile_picture']) }}"
                                            onerror="this.src='{{ asset('images/default-user.svg') }}'"
                                            alt="Talent Avatar">
                                    </a>

                                    <div class="predictive-score dim_title cursor-pointer" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="{{ $single['name'] ?? '' }}">
                                            {{ $single['first_name'] ?? '' }}
                                    </div>

                                    <div class="match-rate cursor-pointer" data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                        @if(isset($single['match_rate']) && $single['match_rate'] > 70)
                                        title="Employees are well-matched to their current roles, demonstrating high engagement, productivity, and a strong sense of job satisfaction."
                                        @elseif(isset($single['match_rate']) && $single['match_rate'] > 30 && $single['match_rate'] < 70)
                                        title="Employees are fairly compatible with their roles but might benefit from additional training or career development opportunities to enhance alignment."
                                        @else
                                    title="Employees may experience challenges fully engaging with their roles, indicating a need for reevaluation of their job alignment or consideration of different positions."
                                        @endif
                                        >
                                        <span>{{ $single['match_rate'] ?? '' }}%</span>
                                    </div>

                                    <div class="predictive-score dim_title cursor-pointer" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="{{ $single['position'] ?? '' }}">
                                            {{-- {{ App\Helpers\HelperFunctions::createShortForm($single['position']) ?? $single['position'] }} --}}
                                            {{ $single['position'] ?? '' }}
                                    </div>
                                    <div class="demographics" style="padding: 14px;">
                                        {{-- <div class="dim_title cursor-pointer" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Name of Talent">{{ $single['name'] ?? 'N/A' }}</div> --}}
                                        <div class="dim_title cursor-pointer" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Gender of Talent">{{ $single['gender'] == 1 ? 'Female' : 'Male' ?? 'N/A' }}</div>
                                        <div class="dim_title cursor-pointer" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Age of Talent">{{ $single['age'] ?? 'N/A' }}</div>
                                        <div class="dim_title cursor-pointer" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Education Level of Talent">{{ $single['education_level'] ?? 'N/A' }}</div>
                                        <div class="dim_title cursor-pointer" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Work Experience of Talent">{{ $single['work_experience'] ?? 'N/A' }}</div>
                                    </div>
                                    <div class="predictive-score cursor-pointer cursor-pointer" data-bs-toggle="tooltip"
                                    data-bs-placement="top"  title="Individual's capacity for consistent and reliable performance, ability to meet expectations and deliver results effectively.">
                                        <span>{{ $single['predictive_performance_result'] ?? '' }} %</span>
                                    </div>
                                    <div class="cognitive dim_title cursor-pointer">Level: {{ $single['cognitive_ability_result'] ?? '0' }}</div>
                                    @if(isset($single['top_3_riasec']))
                                        @php
                                        $description = DB::table('master_top_3_riasec_descriptions')
                                        ->where('top_3_riasec', $single['top_3_riasec'])
                                        ->value('description');
                                        @endphp
                                    @else
                                    @php $description = ''; @endphp
                                    @endif

                                    <div class="riasec dim_title cursor-pointer" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="{{ $description ?? '0' }}">{{ $single['top_3_riasec'] }}</div>

                                    <div class="riasec dim_title cursor-pointer" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="">{{ $single['technical_score'] }}</div>

                                    <div class="reliability dim_title cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="top"

                                    @if(isset($single['ocean_reliability_result']) && $single['ocean_reliability_result'] == 'Moderate')
                                    title="Moderate OCEAN reliability suggests a mix of reliability and inconsistency in results."
                                    @elseif (isset($single['ocean_reliability_result']) && $single['ocean_reliability_result'] == 'Low')
                                    title="Low OCEAN reliability indicates results that are generally inconsistent and less reliable."
                                    @else
                                    title="High OCEAN reliability signifies consistently reliable and dependable results."
                                    @endif
                                    >{{ $single['ocean_reliability_result'] ?? '0' }}</div>





                                <div class="growth_potential dim_title cursor-pointer" data-bs-toggle="tooltip"
                                    data-bs-placement="top" @if(isset($single['growth_potential_result']) && $single['growth_potential_result'] == 'Super High') title="Super High-potential employees are visionaries who not only excel in their current roles but also drive innovation and strategic transformation within the organization. They are natural leaders with exceptional foresight, capable of inspiring and mobilizing teams towards ambitious goals. These individuals thrive in challenging environments and are prime candidates for top executive positions, as they consistently deliver extraordinary results and exhibit a profound impact on the company's long-term success."
                                    @elseif(isset($single['growth_potential_result']) && $single['growth_potential_result'] == 'Very High') title="Very High-potential employees demonstrate remarkable performance and possess the ability to take on significant responsibilities swiftly. They exhibit strong leadership qualities, strategic thinking, and an exceptional capacity for growth and learning. These employees are ideal for advanced development programs, often transitioning into critical leadership roles and contributing to major organizational initiatives. Their proactive approach and high-level problem-solving skills make them indispensable assets in driving company progress."
                                    @elseif(isset($single['growth_potential_result']) && $single['growth_potential_result'] == 'High') title="High-potential employees excel in adaptability, learning, and leadership. They respond well to accelerated development opportunities, such as cross-functional projects and leadership training, often being candidates for succession planning and strategic organizational roles. Their enthusiasm for personal and professional growth, combined with their ability to inspire peers, positions them as key contributors to the organization's future success."
                                    @else
                                    title="Employees at this level are dependable and consistent in their current roles. They benefit from focused skill enhancement and may evolve into broader roles over time with dedicated training and mentorship. They are foundational to maintaining the status quo and operational success. With the right support and development, these individuals have the potential to grow and take on more responsibilities within the organization." @endif>
                                    {{ $single['growth_potential_result'] ?? '0' }}
                                </div>


                                    <div class="retention-risk dim_title cursor-pointer" data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    @if(isset($single['flight_risk_result']['flight_risk_level']) && $single['flight_risk_result']['flight_risk_level'] == 'High')
                                    title="Employees identified with a high flight risk exhibit signs of decreased engagement, such as reduced productivity, lack of involvement in team activities, or open exploration of new job opportunities."
                                    @elseif(isset($single['flight_risk_result']['flight_risk_level']) && $single['flight_risk_result']['flight_risk_level'] == 'Low')
                                    title="Employees at a low flight risk level display strong engagement and satisfaction with their roles, actively participate in organizational activities, and express a commitment to long-term career development within the company."
                                    @else
                                    title="Those with a moderate flight risk might express occasional dissatisfaction or ambivalence about their career progression, job role, or the organizational culture."
                                    @endif
                                        style="margin-top: 10px;margin-bottom: 0px;">
                                        {{ $single['flight_risk_result']['flight_risk_level'] ?? 'Low' }}
                                    </div>

                                    <div class="retention-risk dim_title cursor-pointer" data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    @if(isset($single['organizational_fit_forecast_result']) && $single['organizational_fit_forecast_result'] == 'high')
                                    title="Employees at a high risk level may exhibit behaviors that can lead to discord within teams and affect the overall workplace atmosphere negatively."
                                    @elseif(isset($single['organizational_fit_forecast_result']) && $single['organizational_fit_forecast_result'] == 'low')
                                    title="Employees at a low risk level typically exhibit behaviors that support and strengthen team unity and align well with the company's cultural values."
                                    @else
                                    title="Employees with a moderate risk level might occasionally display behaviors that could impact team dynamics, yet these issues are generally manageable with proactive strategies."
                                    @endif
                                        style="margin-top: 10px;margin-bottom: 0px;">
                                        {{ ucFirst($single['organizational_fit_forecast_result']) ?? 'Moderate' }} Risk
                                    </div>


                                </div>
                            @endforeach
                        </div>

                    </div>
                @else
                    <div class="dashboard">
                        <div class="dashboard-header" style="text-align: center;">Please select users</div>
                    </div>
                @endif


            </div>
        </div>

    </div>


    <!-- Repeat for more cards as needed -->


@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.35.0"></script>
    <script>
        function bookmarkUser(userId) {
            console.log('bookmark', userId);
            $.ajax({
                url: '/admin/employee/add-to-bookmark',
                type: 'POST',
                data: {
                    employee_id: userId,

                        // Add more data as needed
                    },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    alert(response.message);
                    // Update button style
                    $('#bookmarkButton_' + userId).removeClass('unbookmarked').addClass('bookmarked');
                    // Update onclick attribute
                    $('#bookmarkButton_' + userId).attr('onclick', 'unbookmarkUser(' + userId + ')');
                    $('#bookmarkButton_' + userId).attr('data-bs-original-title', 'Unbookmark Employee');

                },
                error: function(xhr) {
                    alert('Error bookmarking user: ' + xhr.statusText);
                }
            });
        }

        function unbookmarkUser(userId) {
            console.log('unbookmarkUser', userId);
            $.ajax({
                url: '/admin/employee/remove-bookmark',
                type: 'POST',
                data: {
                    employee_id: userId,
                    // Add more data as needed
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    alert(response.message);
                    // Update button style
                    $('#bookmarkButton_' + userId).removeClass('bookmarked').addClass('unbookmarked');
                    // Update onclick attribute
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
