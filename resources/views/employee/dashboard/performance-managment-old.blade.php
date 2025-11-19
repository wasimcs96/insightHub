@extends('employee.layout.app')

@section('title', 'Roles')

@section('styles')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        h1 {
            color: aquamarine;
        }

        body {
            background-color: #FCFCFC !important;
            margin: 0px;
        }

        .row-div {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .icon_wrapper {
            height: 20px;
        }

        .technical-skill-container {
            /* Select */

            /* Auto layout */
            display: flex;
            flex-direction: row;
            align-items: center;
            padding: 12px 12px 12px 16px;
            gap: 12px;
            background: #FFFFFF;
            border: 1px solid #D9D9D9;
            border-radius: 8px;

            /* Inside auto layout */
        }

        .technical-skill-text {

            font-family: 'Inter';
            font-style: normal;
            font-weight: 400;
            font-size: 16px;
            line-height: 100%;

            color: #1E1E1E;


        }

        .col-div {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .upper-wrapper {
            margin: 1rem 2rem;
            padding: 0;
        }

        .historical-text {
            /* Historical Data */
            font-family: 'Inter';
            font-style: normal;
            font-weight: 500;
            font-size: 20px;
            line-height: 24px;

            /* Dark Grey */
            color: #5B5B5B;


        }

        .card-wrapper {
            /* Frame 436 */

            /* Auto layout */

            padding: 30px 30px 30px;

            margin: 0 auto;
            width: 100%;
            /* height: 534px; */

            background: #FFFFFF;
            /* Drop Shadow (XS) */
            box-shadow: 0px 3px 4px rgba(0, 0, 0, 0.03);
            border-radius: 8px;

            /* Inside auto layout */
            flex: none;
            order: 0;
            flex-grow: 0;

        }

        .upper-table-wrapper {
            width: 100%;

        }

        .table-heading-text {
            /* Historical Data */

            /* H3 */
            font-family: 'Inter';
            font-style: normal;
            font-weight: 700;
            font-size: 18px;
            line-height: 24px;
            padding: 20px;
            /* Dark Grey */
            color: #142441;


            /* Inside auto layout */
            flex: none;
            order: 0;
            flex-grow: 0;

        }

        .table-container {
            width: 100%;
            /* margin: 20px; */
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        caption {
            font-size: 1.5em;
            margin: 10px;
            font-weight: bold;
        }

        th,
        td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: white;
            color: black;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        td {
            color: #333;
        }

        .dropdown {
            position: relative;
            display: inline-block;
            font-family: Arial, sans-serif;

        }

        .dropdown::after {
            display: none;
        }

        /* Button styling */
        .dropdown-toggle {
            /* width: 300px; */
            padding: 10px 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #fff;
            cursor: pointer;
            font-size: 16px;
            color: #000;
            text-align: left;
            font-weight: 500;
            display: flex;
            gap: 8px;
            align-items: center;
            transition: all 0.2s ease-in-out;
        }

        .dropdown-toggle:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Dropdown menu styling */
        .dropdown-menu {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            z-index: 10;
        }


        .dropdown-menu a {
            display: block;
            padding: 10px 15px;
            text-decoration: none;
            color: #333;
            font-size: 14px;
            transition: background-color 0.2s ease-in-out;
        }

        .dropdown-menu a:hover {
            background-color: #f5f5f5;
        }

        /* Show dropdown on toggle */
        .dropdown.active .dropdown-menu {
            display: block;
        }

        @media (max-width: 576px) {
            body {
                width: 100vh;
            }


        }
    </style>
    <style>
        .app-wrapper {
            margin-top: 74px !important;
        }

        .app-content {
            padding-top: 15px !important;
        }

        .app-container {
            padding: 0px !important;
            margin: 0px 186px !important;
        }

        .nav-link {
            padding: 16px !important;
            margin: 0px !important;
        }

        .profile-card {
            padding: 39px 24px 0px !important
        }

        .mb-11 {
            margin-bottom: 36px !important;
        }

        .gap-7 {
            gap: 24px !important;
        }

        .gap-4 {
            gap: 16px !important;
        }

        .psych-inner {
            padding: 30px 40px 45px 40px;
        }

        .table-desc {
            color: #5B5B5B;
            font-size: 12px;
            font-weight: 400;
        }

        .left-table-head {
            color: #5B5B5B;
            font-size: 16px;
            font-weight: 500;
            line-height: normal;
            text-transform: uppercase;
            display: flex;
            align-items: center;
            gap: 5px;
            margin-bottom: 4px;
        }

        .left-table-head p {
            margin-bottom: 5px;
        }

        .left-table-head span {
            color: #F7941C;
            font-weight: 700;
        }

        .line-grey {
            background-color: #e6e6e6;
            position: relative;
            margin-top: 15px;
            width: 100%;
            height: 15px;
            background: #EBEBEB;
        }

        .ocean-grey {
            margin-top: 14.4px;
            height: 21.28px;

        }

        .ocean-orange {
            height: 21.28px !important;
        }

        .line-orange {
            height: 15px;
        }

        .fade-orange {
            background: #FABB6E;
        }

        .dark-orange {
            background: #F7941C;
        }

        .svg-round-icon {
            position: absolute;
            bottom: -0.701px;
            top: 13%;
            transform: translateY(-50%);
        }

        .line {
            border-radius: 7.14px;
        }

        .line-bottom {
            background: #E1E1E1;
            width: 100%;
            height: 1px;
        }

        .tweleve-head {
            color: #5B5B5B;
            font-size: 18px;
            font-weight: 500;
            line-height: normal;
            margin-bottom: 15px;
        }

        .tweleve-desc {
            color: #5B5B5B;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 8.4px;
        }

        .tweleve-desc img {
            margin-right: 5px;
            position: relative;
            top: 2px;
        }

        .skill-table {
            display: grid;
            gap: 30px;
        }

        .skill-table .table-desc {
            margin: 0;
        }

        .orange-bg {
            padding: 10px 10px 10px 15px;
            background: #FFF6EA;
            border-left: 2px solid #FABB6E;
        }

        .orange-bg .table-desc {
            margin: 0;
        }

        .work-right-head {
            color: #5B5B5B;
            font-size: 18px;
            font-weight: 500;
            line-height: 22px;
        }

        .work-orange {
            color: #F7941C;
            font-size: 36px;
            font-weight: 500;
            line-height: normal;
            margin: 12.8px 0px 6.4px 0px;
        }

        .bg-white {
            border-radius: 8px;
            background: #F1F1F4;
            border: 1px solid #F1F1F4;
            box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.03);
        }

        .inner-table {
            display: grid;
            grid-template-columns: 47% 47%;
            gap: 70px;
        }

        .left-table-head span {
            color: #F7941C;
            font-weight: 700;
        }

        .table-desc {
            color: #5B5B5B;
            font-size: 12px;
            font-weight: 400;
        }

        .right-bot {
            color: #5B5B5B;
            font-size: 12px;
            font-weight: 500;
            line-height: 16px;
            display: table;
            margin: 7px 0px;

        }

        .right-bot span {
            padding: 2.626px 6.795px;
            position: relative;
            left: 7px;
            border-radius: 5.421px;
            background: #F7941C;
            color: #FFF;
            font-size: 9px;
            line-height: 14px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .purple,
        .cyan,
        .orange,
        .spring {
            font-size: 12px;
            font-weight: 600;
            line-height: normal;
        }

        .purple span,
        .cyan span,
        .orange span,
        .green span,
        .spring span {
            border-radius: 8px;
            position: relative;
            font-size: 11px;
            font-weight: 600;
            left: 6.4px;
            padding: 2px 8.6px;
            text-transform: uppercase;
        }

        .purple span {
            background: #E1D8FB;
            color: #7F66CA;
        }

        .cyan span {
            background: #B2ECEC;
            color: #108585;
        }

        .orange span {
            background: #FDE2C1;
            color: #F7941C;
        }

        .spring span {
            color: #F7941C;
            background: #FFEBB4;
        }

        .green span {
            color: #218336;
            background: #BBECC5 !important;
        }
    </style>

    <style>
        .circle {
            width: 160px;
            height: 160px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            position: relative;
        }

        .circle-completed {
            border: 10px solid #f7931e;

        }

        .circle-incompleted {
            border: 10px solid #a5a5a5;

        }

        .circle span {
            font-size: 18px;
            color: #f7931e;
            font-weight: 700;
        }

        .circle p {
            font-size: 12px;
            color: #666;
            position: absolute;
            bottom: -20px;
            width: 100%;
            text-align: center;
        }

        .circle.completed span {
            font-size: 36px;
        }

        .circle.completed p {
            font-size: 16px;
            color: #333;
        }

        .assessment-card .circle.completed span {
            color: #f7931e;
        }

        .card-body-riasec {
            box-shadow: none !important;
            border: none !important;
            padding: 0;
            margin: 0;
        }

        @media (max-width: 360px) {
            .circle {
                width: 90px;
                height: 90px;
            }

            .emp_a {
                width: 15px;
                height: 15px;
            }

            .emp_b {
                width: 15px;
                height: 15px;
            }
        }

        .text-active-primary.active {
            color: #f7941d !important;
        }
    </style>
@endsection

@section('content')
    <div id="kt_app_content" class="app-content  flex-column-fluid">
        <div id="kt_app_content_container" class="app-container  ">
            <div class="row mb-5 ms-0 me-0 justify-content-center mt-0">
                @include('employee.dashboard.includes.card')
                <div class="upper-wrapper">
                    <div class="card-wrapper">
                        <div class="row-div" style="justify-content: space-between;">
                            <div class="historical-text">
                                Historical Text
                            </div>
                            <div class="dropdown">
                                <button class="dropdown-toggle">
                                    <div class="row-div" style="gap: 10px;">
                                        <img class="icon_wrapper" src="{{ asset('images/chart/calendar_icon.png') }}"
                                            alt="Icon">
                                        <span class="text" id="selected-option">Technical Skills Ratings</span>
                                        {{-- <img style="height: 10px;" class="icon_wrapper" src="{{ asset('images/chart/arrow_down.png') }}" alt="Arrow"> --}}
                                    </div>
                                </button>
                                <div class="dropdown-menu">
                                    <a href="#" class="dropdown-item" data-skill="technical">Technical Skills
                                        Ratings</a>
                                    <!-- <a href="#" class="dropdown-item" data-skill="kpi">KPI Skills Ratings</a> -->
                                    <a href="#" class="dropdown-item" data-skill="general">Skills Ratings</a>
                                </div>
                            </div>

                            <!-- <div class="technical-skill-container">
            <img class="icon_wrapper" src="images/icons/calendar_icon.png"  alt="Flowers in Chania">
            <div class="technical-skill-text">Technical Skills Ratings</div>
            <img style="height: 10px;" class="icon_wrapper" src="images/icons/arrow_down.png"  alt="Flowers in Chania">

        </div> -->
                        </div>
                        <div id="chart"></div>


                    </div>
                    <div class="row-div" style="justify-content: end; margin: 10px 0px;">
                        <div class="dropdown">
                            <button class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <div class="row-div" style="gap: 10px;">
                                    <img class="icon_wrapper" src="{{ asset('images/chart/calendar_icon.png') }}"
                                        alt="Calendar Icon">
                                    <span class="text" id="selected-review-type">Select Review Type</span>
                                    {{-- <img style="height: 10px;" class="icon_wrapper" src="{{ asset('images/chart/arrow_down.png') }}" alt="Arrow Icon"> --}}
                                </div>
                            </button>
                            <div class="dropdown-menu" id="review-type-dropdown">
                                <a class="dropdown-item" href="#" data-review-type="type1">End-Year 2024</a>
                                <a class="dropdown-item" href="#" data-review-type="type2">Mid-Year 20224</a>
                                <a class="dropdown-item" href="#" data-review-type="type3">End-Year 2023</a>
                            </div>

                        </div>
                    </div>




                    <div class="card-wrapper">
                        <div class="row-div" style="justify-content: start">
                            <div class="historical-text">
                                Technical Skills Ratings
                            </div>
                        </div>
                        <div class="row-div mt-12" style="justify-content: start; gap: 20px;align-items: flex-start;">
                            <div class="donut-chart-wrapper">
                                <div id="donut-chart"></div>


                            </div>
                            <div class="upper-table-wrapper">
                                <div class="table-heading-text">
                                    Technical Skills Ratings
                                </div>
                                <hr style="color: #bbbbce; height: 1px;">
                                <div class="table-container">
                                    <table>
                                        <thead style="background-color: transparent;">
                                            <tr>
                                                <th>Skill</th>
                                                <th>Rating</th>
                                                <th>Minimal Level</th>
                                                <th>Gap</th>
                                                <th>Employee Planning</th>
                                                <th>Manager Evaluation</th>
                                            </tr>
                                        </thead>
                                        @foreach ($user['technical_skills'] as $index => $skill)
                                            @php
                                                $totalTechnical = 0;
                                                $countTechnical = 0;
                                                foreach ($skillReviews as $review) {
                                                    foreach ($review->details as $detail) {
                                                        if ($detail->name == $skill['name']) {
                                                            $approvedRating = $detail->level;
                                                            $managerRemarks = $detail->manager_evaluation;
                                                            $managerEvaluation = $detail->remark;
                                                            break 2;
                                                        }
                                                    }
                                                }
                                                $gap =
                                                    $approvedRating !== null && $skill['pivot']['level'] !== null
                                                        ? $approvedRating - $skill['pivot']['level']
                                                        : null;
                                                $jdRating = $skill['pivot']['level'] ?? 1;
                                                $arRating = $skill['level'] ?? 1;
                                                $percentage =
                                                    $arRating < $jdRating ? ($arRating / $jdRating) * 100 : 100;
                                                $totalTechnical += $percentage;
                                                $countTechnical++;
                                            @endphp
                                            <tbody id="technical-skills-table-body">
                                                <tr>
                                                    <td>{{ $skill['name'] }}</td>
                                                    <td>{{ $approvedRating ?? 'N/A' }}</td>
                                                    <td>{{ $jdRating }}</td>
                                                    <td>{{ $gap }}</td>
                                                    <td>I think I need to improve this skill</td>
                                                    <td>{{ $managerRemarks ?? 'N/A' }}</td>
                                                </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                        @if ($latestKPI)
                            <hr>
                            <div class="row-div" style="justify-content: start">
                                <div class="historical-text">
                                    KPI Skills Ratings
                                </div>
                            </div>
                            <div class="row-div" style="justify-content: start; margin: 1rem 0px; gap: 20px;">
                                <div class="donut-chart-wrapper">
                                    <div id="donut-chart-2"></div>


                                </div>
                                <div class="upper-table-wrapper">
                                    <div class="table-heading-text">
                                        KPI Skills Ratings
                                    </div>
                                    <hr style="color: #bbbbce; height: 1px;">
                                    <div class="table-container">
                                        <table style="background-color: transparent;">
                                            @php
                                                $totalKpi = 0;
                                            @endphp
                                            @foreach ($latestKPI->objectives as $objective)
                                                <thead>
                                                    <tr>
                                                        <td>Objectives: {{ $objective->objectives }}</td>
                                                        <td>Weightage: {{ $objective->weightage }}%</td>
                                                    </tr>
                                                    <tr>
                                                        <th>KPI</th>
                                                        <th>Base Target</th>
                                                        <th>Stretch Target</th>
                                                        <th>Manager Rating</th>
                                                        <th>Employee Planning</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $sumKpiRatings = 0;
                                                        $kpiCount = count($objective->keys);
                                                    @endphp
                                                    @foreach ($objective->keys as $key)
                                                        @php
                                                            $sumKpiRatings += $key->rank;
                                                        @endphp
                                                        <tr>
                                                            <td>{{ $key->kpi }}</td>
                                                            <td>{{ $key->base_target }}</td>
                                                            <td>{{ $key->stretch_target }}</td>
                                                            <td>{{ $key->rank ?? 'N/A' }}</td>
                                                            <td>{{ $key->employee_planning ?? 'N/A' }}</td>
                                                        </tr>
                                                    @endforeach
                                                    @php
                                                        $objectiveWeightage = $objective->weightage;
                                                        $averageKpiRating =
                                                            $kpiCount > 0 ? $sumKpiRatings / $kpiCount : 0;
                                                        $weightedKpiRating =
                                                            ($averageKpiRating * $objectiveWeightage) / 100;
                                                        $totalKpi += $weightedKpiRating;
                                                    @endphp
                                                </tbody>
                                            @endforeach
                                        </table>
                                        <!-- <table>
                                    <thead style="background-color: transparent;">
                                        <tr>
                                            <th>Objective: test objective 1 (to work)</th>
                                            <th>Weightage: 40%</th>
                                        
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Business Acumen</td>
                                            <td>3</td>
                                            <td>5</td>
                                            <td>-2</td>
                                            <td>I think I need to improve this skill</td>
                                            <td>manager evaluate test technical'1</td>
                                        </tr>
                                        <tr>
                                            <td>Conduct and Behaviour Management</td>
                                            <td>3</td>
                                            <td>5</td>
                                            <td>-2</td>
                                            <td>I think I need to retain</td>
                                            <td></td>
                                        </tr>
                                        
                                    
                                    </tbody>
                                    <thead style="background-color: transparent;">
                                        <tr>
                                            <th>Objective: test objective 1 (to work)</th>
                                            <th>Weightage: 40%</th>
                                        
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Business Acumen</td>
                                            <td>3</td>
                                            <td>5</td>
                                            <td>-2</td>
                                            <td>I think I need to improve this skill</td>
                                            <td>manager evaluate test technical'1</td>
                                        </tr>
                                        <tr>
                                            <td>Conduct and Behaviour Management</td>
                                            <td>3</td>
                                            <td>5</td>
                                            <td>-2</td>
                                            <td>I think I need to retain</td>
                                            <td></td>
                                        </tr>
                                        
                                    
                                    </tbody>
                                </table> -->
                                    </div>
                                </div>

                            </div>
                        @endif
                        <hr>
                        <div class="row-div" style="justify-content: start">
                            <div class="historical-text">
                                Skills Ratings
                            </div>
                        </div>
                        <div class="row-div" style="justify-content: start; margin: 1rem 0px; gap: 20px;">
                            <div class="donut-chart-wrapper">
                                <div id="donut-chart-3"></div>


                            </div>
                            <div class="upper-table-wrapper">
                                <div class="table-heading-text">
                                    Skills Ratings
                                </div>
                                <hr style="color: #bbbbce; height: 1px;">
                                <div class="table-container">
                                    <table>
                                        <!-- <thead style="background-color: transparent;">
                                      <tr>
                                          <th class="head-text">Skill</th>
                                          <th class="head-text" style="text-align: end;">Rating</th>
                                    
                                      </tr>
                                  </thead> -->
                                        <tbody>
                                            <tr>
                                                <td>Category</td>
                                                <td style="text-align: end;">Total Points</td>

                                            </tr>
                                            <tr>
                                                <td>Technical Skills</td>
                                                <td style="text-align: end;">1.17</td>

                                            </tr>
                                            <tr>
                                                <td>Soft Skills</td>
                                                <td style="text-align: end;">3.20</td>

                                            </tr>
                                            <tr>
                                                <th class="head-text"></th>
                                                <th class="head-text" style="text-align: end;">
                                                    <div class="row-div" style="justify-content: end; gap: 20px;">
                                                        <div>Skills Rating: </div>
                                                        <div>1.78 </div>
                                                    </div>

                                                </th>

                                            </tr>
                                            <tr>
                                                <td>Category</td>
                                                <td style="text-align: end;">Total Points</td>

                                            </tr>
                                            <tr>
                                                <td>Technical Skills</td>
                                                <td style="text-align: end;">1.17</td>

                                            </tr>
                                            <tr>
                                                <td>Soft Skills</td>
                                                <td style="text-align: end;">3.20</td>

                                            </tr>
                                            <tr>
                                                <th class="head-text"></th>
                                                <th class="head-text" style="text-align: end;">
                                                    <div class="row-div" style="justify-content: end; gap: 20px;">
                                                        <div>Final Skills Rating: </div>
                                                        <div>1.78 </div>
                                                    </div>

                                                </th>

                                            </tr>


                                        </tbody>
                                    </table>
                                </div>
                            </div>


                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        document.querySelector('.dropdown-toggle').addEventListener('click', function() {
            const dropdown = this.closest('.dropdown');
            dropdown.classList.toggle('active');
        });
    </script>
    <script>
        $(document).ready(function() {
            // Open the dropdown when the button is clicked
            $('.dropdown-toggle').click(function() {
                $(this).next('.dropdown-menu').toggleClass('show');
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Function to make the AJAX call for 'technical' skill data
            function fetchTechnicalSkillData() {
                $.ajax({
                    url: '/get-skill-data', // Backend endpoint
                    method: 'GET',
                    data: {
                        skill: 'technical'
                    }, // Send the 'technical' skill type
                    success: function(response) {
                        // Update the chart with the new data
                        updateChart(response);
                    },
                    error: function(error) {
                        console.error('Error fetching skill data:', error);
                    }
                });
            }

            // Fetch 'technical' skill data when the page loads
            fetchTechnicalSkillData();

            // When a dropdown item is clicked
            $('.dropdown-item').on('click', function(e) {
                e.preventDefault(); // Prevent default link behavior

                var selectedSkill = $(this).data(
                'skill'); // Get the selected skill type from the data attribute
                var selectedText = $(this).text(); // Get the text of the selected item

                // Update the dropdown button text
                $('#selected-option').text(selectedText);

                // Make the AJAX call to fetch the skill data
                $.ajax({
                    url: '/get-skill-data', // Backend endpoint
                    method: 'GET',
                    data: {
                        skill: selectedSkill
                    }, // Send the selected skill type
                    success: function(response) {
                        // Update the chart with the new data
                        updateChart(response);
                    },
                    error: function(error) {
                        console.error('Error fetching skill data:', error);
                    }
                });
            });

            // Function to update the chart
            function updateChart(data) {
                var options = {
                    series: [{
                        name: "Data Points",
                        data: data.map(item => item.percentage) // Y-axis values from the response
                    }],
                    chart: {
                        height: 350,
                        type: 'line',
                        toolbar: {
                            show: false
                        }
                    },
                    stroke: {
                        width: 2,
                        curve: 'smooth'
                    },
                    markers: {
                        size: 5,
                        colors: ['#FFA726'],
                        strokeWidth: 2,
                        hover: {
                            size: 6
                        }
                    },
                    xaxis: {
                        categories: data.map(item => item.year + ' - ' + item
                        .type), // X-axis labels from the response
                        labels: {
                            style: {
                                colors: '#333'
                            }
                        }
                    },
                    yaxis: {
                        min: 1,
                        max: 4,
                        labels: {
                            style: {
                                colors: '#333'
                            }
                        }
                    },
                    colors: ['#FFA726'],
                    dataLabels: {
                        enabled: false
                    },
                    grid: {
                        borderColor: '#ccc'
                    }
                };

                var chart = new ApexCharts(document.querySelector("#chart"), options);
                chart.render();
            }
        });
    </script>
    <!-- <script>
        var options = {
            series: [29.25], // Percentage calculation: (1.17 / 4.00) * 100 = 29.25
            chart: {
                type: 'donut',
                height: 350
            },
            labels: ['Total Points'],
            colors: ['#FFA726'],
            plotOptions: {
                pie: {
                    donut: {
                        size: '70%',
                        labels: {
                            show: true,
                            total: {
                                show: true,
                                label: 'Total Points',
                                fontSize: '16px',
                                color: '#777',
                                formatter: function(w) {
                                    return '1.17/4.00'; // Custom label inside the donut
                                }
                            }
                        }
                    }
                }
            },
            stroke: {
                width: 0
            },
            dataLabels: {
                enabled: false
            },
            legend: {
                show: false
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        height: 300
                    }
                }
            }]
        };

        var chart = new ApexCharts(document.querySelector("#donut-chart"), options);
        chart.render();
    </script> -->
    <script>
        var options = {
            series: [40.89], // Percentage calculation: (1.17 / 4.00) * 100 = 29.25
            chart: {
                type: 'donut',
                height: 350
            },
            labels: ['Total Points'],
            colors: ['#FFA726'],
            plotOptions: {
                pie: {
                    donut: {
                        size: '70%',
                        labels: {
                            show: true,
                            total: {
                                show: true,
                                label: 'Total Points',
                                fontSize: '16px',
                                color: '#777',
                                formatter: function(w) {
                                    return '1.17/4.00'; // Custom label inside the donut
                                }
                            }
                        }
                    }
                }
            },
            stroke: {
                width: 0
            },
            dataLabels: {
                enabled: false
            },
            legend: {
                show: false
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        height: 300
                    }
                }
            }]
        };

        var chart = new ApexCharts(document.querySelector("#donut-chart-2"), options);
        chart.render();
    </script>
    <script>
        // Initialize the donut chart globally
        // var donutChart;

        // var options = {
        //     series: [29.25], // Default percentage (can be updated later)
        //     chart: {
        //         type: 'donut',
        //         height: 350
        //     },
        //     labels: ['Total Points'],
        //     colors: ['#FFA726'],
        //     plotOptions: {
        //         pie: {
        //             donut: {
        //                 size: '70%',
        //                 labels: {
        //                     show: true,
        //                     total: {
        //                         show: true,
        //                         label: 'Total Points',
        //                         fontSize: '16px',
        //                         color: '#777',
        //                         formatter: function(w) {
        //                             return '1.17/4.00'; // Custom label inside the donut
        //                         }
        //                     }
        //                 }
        //             }
        //         }
        //     },
        //     stroke: {
        //         width: 0
        //     },
        //     dataLabels: {
        //         enabled: false
        //     },
        //     legend: {
        //         show: false
        //     },
        //     responsive: [{
        //         breakpoint: 480,
        //         options: {
        //             chart: {
        //                 height: 300
        //             }
        //         }
        //     }]
        // };


        // On page load, initialize the donut chart
        //     $(document).ready(function() {
        //         // Initialize the donut chart

        //         // Fetch skill review types and update the dropdown
        //         $.ajax({
        //             url: '/get-skill-review-types', // Backend endpoint to fetch review types
        //             method: 'GET',
        //             success: function(response) {
        //                 updateDropdown(response); // Update dropdown when data is fetched
        //             },
        //             error: function(error) {
        //                 console.error('Error fetching skill review types:', error);
        //             }
        //         });

        //         // Function to update the dropdown with options
        //         function updateDropdown(data) {
        //             // Sort the data by review_date in descending order (backend handles sorting)
        //             var latestReviewType = data[0]; // The first item is the latest

        //             // Empty the existing dropdown menu
        //             $('#review-type-dropdown').empty();

        //             // Populate the dropdown with options
        //             data.forEach(function(item) {
        //                 var year = new Date(item.review_date).getFullYear(); // Extract year from review_date
        //                 var displayText = item.type + ' - ' + year;
        //                 $('#review-type-dropdown').append(
        //                     '<a class="dropdown-item" href="#" data-type="' + item.type + '" data-year="' + year + '">' + displayText + '</a>'
        //                 );
        //             });

        //             // Set the latest review type and year as the selected option
        //             $('#selected-review-type').text(latestReviewType.type + ' - ' + new Date(latestReviewType.review_date).getFullYear());

        //             // Fetch filtered data based on the latest review type and year
        //             fetchFilteredData(latestReviewType.type, new Date(latestReviewType.review_date).getFullYear());

        //             // When a user selects an option, update the displayed review type and fetch filtered data
        //             $('.dropdown-item').on('click', function() {
        //                 var selectedType = $(this).data('type');
        //                 var selectedYear = $(this).data('year');
        //                 var selectedText = $(this).text();

        //                 // Update the selected text in the button
        //                 $('#selected-review-type').text(selectedText);

        //                 // Fetch filtered data based on the selected review type and year
        //                 fetchFilteredData(selectedType, selectedYear);
        //             });
        //         }

        //         // Function to fetch filtered data based on selected review type and year
        //         function fetchFilteredData(reviewType, year) {
        //     $.ajax({
        //         url: '/get-skill-filter-data', // Backend endpoint to fetch filtered data
        //         method: 'GET',
        //         data: {
        //             review_type: reviewType, // Send selected review type as a parameter
        //             year: year // Send the selected year as a parameter
        //         },
        //         success: function(response) {
        //             // Update the UI with the filtered data
        //             updateUIWithFilteredData(response);
        //         },
        //         error: function(error) {
        //             console.error('Error fetching filtered data:', error);
        //         }
        //     });
        // }

        // function updateUIWithFilteredData(data) {
        //     // Clear the existing content of both tables first
        //     let technicalSkillsHtml = '';
        //     let kpiHtml = '';

        //     // Ensure data is an array and contains the necessary properties
        //     if (data && Array.isArray(data)) {
        //         data.forEach(function(skill) {
        //             // Build the technical skills table
        //             technicalSkillsHtml += `
    //                 <tr>
    //                     <td>${skill.skill_name ?? 'N/A'}</td>
    //                     <td>${skill.level ?? 'N/A'}</td>
    //                     <td>${skill.jd_rating ?? 'N/A'}</td>
    //                     <td>${skill.gap ?? 'N/A'}</td>
    //                     <td>${skill.employee_planning ?? 'N/A'}</td>
    //                     <td>${skill.manager_evaluation ?? 'N/A'}</td>
    //                 </tr>
    //             `;

        //             // Build the KPI table from the kpi_data
        //             if (skill.kpi_data && Array.isArray(skill.kpi_data)) {
        //                 skill.kpi_data.forEach(function(kpi) {
        //                     kpi.kpi_objective_keys.forEach(function(kpiItem) {
        //                         kpiHtml += `
    //                             <tr>
    //                                 <td>${kpiItem.kpi ?? 'N/A'}</td>
    //                                 <td>${kpiItem.base_target ?? 'N/A'}</td>
    //                                 <td>${kpiItem.stretch_target ?? 'N/A'}</td>
    //                                 <td>${kpiItem.rank ?? 'N/A'}</td>
    //                                 <td>${kpiItem.employee_planning ?? 'N/A'}</td>
    //                             </tr>
    //                         `;
        //                     });
        //                 });
        //             }
        //         });
        //     } else {
        //         // If data is not an array or empty, show a message
        //         technicalSkillsHtml = `<tr><td colspan="6">No technical skills data available</td></tr>`;
        //         kpiHtml = `<tr><td colspan="5">No KPI data available</td></tr>`;
        //     }

        //     // Insert the constructed HTML into the table body
        //     $('#technical-skills-table-body').html(technicalSkillsHtml);
        //     $('#kpi-table-body').html(kpiHtml);
        // }

        //     });
    </script>

    <script>
        var options = {
            series: [29.25], // Percentage calculation: (1.17 / 4.00) * 100 = 29.25
            chart: {
                type: 'donut',
                height: 350
            },
            labels: ['Total Points'],
            colors: ['#FFA726'],
            plotOptions: {
                pie: {
                    donut: {
                        size: '70%',
                        labels: {
                            show: true,
                            total: {
                                show: true,
                                label: 'Total Points',
                                fontSize: '16px',
                                color: '#777',
                                formatter: function(w) {
                                    return '1.17/4.00'; // Custom label inside the donut
                                }
                            }
                        }
                    }
                }
            },
            stroke: {
                width: 0
            },
            dataLabels: {
                enabled: false
            },
            legend: {
                show: false
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        height: 300
                    }
                }
            }]
        };

        var chart = new ApexCharts(document.querySelector("#donut-chart"), options);
        chart.render();
    </script>
@endsection
