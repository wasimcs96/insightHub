@extends('layout.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('apexcharts/dist/apexcharts.css') }}" />
    <style>
        /* Main Content Styles */
        .content-container {
            width: 100vw;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 0;
            color: white;
            background-color: #f8f9fa;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .backdashboard-btn {
            background-color: #F6931D;
            border: none;
            border-radius: 5px;
            color: #fff;
            font-size: 18px;
            padding: 15px 30px;
            cursor: pointer;
            transition: background-color 0.3s;
            font-style: bold;
            width: 373px;
        }

        .backdashboard-btn:hover {
            background-color: #e57a16;
        }

        .container h1 {
            font-family: sans-serif;
            font-size: 40px;
            color: #F6931D;
            font-weight: bold;
        }

        .container p {
            font-family: sans-serif;
            font-size: 20px;
            color: #807E7E;
            font-weight: 400;
            margin-bottom: 50px;
        }

        .container h2 {
            font-family: sans-serif;
            font-size: 38px;
            color: #807E7E;
            font-weight: 500;
            margin-bottom: 10px;
        }

        .c-desc p {
            font-family: sans-serif;
            font-size: 98px;
            color: #807E7E;
            font-weight: 500;
            margin-bottom: 10px;
        }

        .slider-container {
            display: flex;
            align-items: center;
        }

        .slider-label {
            width: 25%;
            text-align: left;
            font-size: 18px;
            font-weight: bold;
            color: #7e7e7e;
        }

        .slider-track {
            width: 100%;
            position: relative;
            height: 24px;
            background: #f1f1f1;
            border-radius: 32px;
            margin: 18px 2% 18px 0%;
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
            background-color: pink;
        }

        .emp_a {
            position: absolute;
            top: -4px;
            width: auto;
            height: auto;
            background-color: #F6931D;
            border-radius: 50%;
            font-size: smaller;
            color: white;
            padding: 12px;
            border: 4px solid #fff;
        }

        .slider-legend {
            width: 10%;
            text-align: center;
            font-size: 14px;
            font-weight: 400;
            color: #F6931D;
        }

        .interest-title {
            color: #6A6A6A;
            font-size: 32px;
            font-weight: bold;
            padding-top: 30px;
            text-align: left;
        }

        .interest-item{
            color:#F6931D; 
            padding-left: 5px; 
            font-size:45px; 
            font-weight:600; 
            text-align: left;"
        }

        .interest-description{
            text-align: left;
            padding: 0;
            font-size: 18px;
        }
        
        .card {
            border-radius: 20px;
        }

        @media only screen and (min-width: 350px) and (max-width: 768px) {
            .container: {
                padding: 0;
            }

            .container p {
                margin-bottom: 20px;
            }

            .card .card-header {
                min-height: 116px;
            }

            .interest-title {
                text-align: left !important;
            }

            .backdashboard-btn {
                width: fit-content;
                padding: 10px 30px;
            }
            .container h1 {
                font-size: 32px;
            }
        }


        @media (max-width: 768px) {
            .slider-label {
                font-size: 9px;
                display: block !important;
            }

            .riasec {
                margin-top: 1.25rem !important;
            }

            .slider-indicator {
                font-size: 10px;
            }

            .emp_a {
                font-size: smaller;
                padding: 14px;
            }

            .slider-legend {
                width: 17%;
                text-align: center;
                font-size: 14px;
                font-weight: bold;
                color: #F6931D
            }
        }

        .container-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 20px;
        }
    </style>
@endsection

@section('app')
    <div class="w-100 bg-white-gradient py-5 border-radius-50 text-center p-4">
        <div class="container p-0 md-p-4" style="margin-top: 50px;">

            <!-- Well Done Text Section -->
            <h1>Well Done!</h1>
            <p>for completing your Work Interests test</p>
            <h1 class="result-gradient-text fw-500 fs-3-rem mb-5" style="color:#7e7e7e;">
                {{ __('Your RIASEC Work Interests are') }}</h1>

            <!-- Assessment Result Section -->
            <div class="container py-0 p-0 md-p-4 md-py-5 mt-4" id="results">
                <div class="d-flex flex-wrap" style="gap:10px; align-content:center; justify-content:center; height:100%;">
                    <!-- Left Column: Sliders -->
                    <div class="col-12 col-lg-7">
                        <div class="card h-full shadow-base2 riasec" style="border: 0px;">
                            <div class="card-body p-0 md-p-4">
                                <div class="">
                                    <!-- Slider: Realistic -->
                                    <div class="slider-container mb-0">
                                        <div class="slider-label">Realistic</div>
                                        <div class="slider-track">
                                            <div class="d-flex justify-content-between"
                                                style="top: -30px; position: relative;">
                                                <div class="slider-legend">Low</div>
                                                <div class="slider-legend">High</div>
                                            </div>
                                            <div class="emp_a"
                                                @if (isset($questions['domains'][0]['values'][0]['answers_sum_answer']) &&
                                                        $questions['domains'][0]['values'][0]['answers_sum_answer'] == 40) style="left: 93%;"@else
                                             style="left: {{ ($questions['domains'][0]['values'][0]['answers_sum_answer'] / 40) * 100 ?? 0 }}%;" @endif>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Slider: Investigative -->
                                    <div class="slider-container mb-0">
                                        <div class="slider-label">Investigative</div>
                                        <div class="slider-track">
                                            <div class="emp_a"
                                                @if (isset($questions['domains'][0]['values'][1]['answers_sum_answer']) &&
                                                        $questions['domains'][0]['values'][1]['answers_sum_answer'] == 40) style="left: 93%;"@else
                                             style="left: {{ ($questions['domains'][0]['values'][1]['answers_sum_answer'] / 40) * 100 ?? 0 }}%;" @endif>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Slider: Artistic -->
                                    <div class="slider-container mb-0">
                                        <div class="slider-label">Artistic</div>
                                        <div class="slider-track">
                                            <div class="emp_a"
                                                @if (isset($questions['domains'][0]['values'][2]['answers_sum_answer']) &&
                                                        $questions['domains'][0]['values'][2]['answers_sum_answer'] == 40) style="left: 93%;"@else
                                             style="left: {{ ($questions['domains'][0]['values'][2]['answers_sum_answer'] / 40) * 100 ?? 0 }}%;" @endif>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Slider: Social -->
                                    <div class="slider-container">
                                        <div class="slider-label">Social</div>
                                        <div class="slider-track">
                                            <div class="emp_a"
                                                @if (isset($questions['domains'][0]['values'][3]['answers_sum_answer']) &&
                                                        $questions['domains'][0]['values'][3]['answers_sum_answer'] == 40) style="left: 93%;"@else
                                             style="left: {{ ($questions['domains'][0]['values'][3]['answers_sum_answer'] / 40) * 100 ?? 0 }}%;" @endif>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Slider: Enterprising -->
                                    <div class="slider-container">
                                        <div class="slider-label">Enterprising</div>
                                        <div class="slider-track">
                                            <div class="emp_a"
                                                @if (isset($questions['domains'][0]['values'][4]['answers_sum_answer']) &&
                                                        $questions['domains'][0]['values'][4]['answers_sum_answer'] == 40) style="left: 93%;"@else
                                             style="left: {{ ($questions['domains'][0]['values'][4]['answers_sum_answer'] / 40) * 100 ?? 0 }}%;" @endif>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Slider: Conventional -->
                                    <div class="slider-container mb-4">
                                        <div class="slider-label">Conventional</div>
                                        <div class="slider-track">
                                            <div class="emp_a"
                                                @if (isset($questions['domains'][0]['values'][5]['answers_sum_answer']) &&
                                                        $questions['domains'][0]['values'][5]['answers_sum_answer'] == 40) style="left: 93%;"@else
                                             style="left: {{ ($questions['domains'][0]['values'][5]['answers_sum_answer'] / 40) * 100 ?? 0 }}%;" @endif>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- {{ dd($questions) }} --}}
                    <!-- Right Column: Top 3 Cards -->
                    <div class="col-lg-4" style="margin-top:20px;">
                        @php

                            $workInterestResults = \DB::table('quiz_domain_value_answers')
                                ->join(
                                    'quiz_domain_value_questions',
                                    'quiz_domain_value_answers.quiz_domain_value_question_id',
                                    '=',
                                    'quiz_domain_value_questions.id',
                                )
                                ->join(
                                    'quiz_domain_values',
                                    'quiz_domain_value_questions.quiz_domain_value_id',
                                    '=',
                                    'quiz_domain_values.id',
                                )
                                ->where('quiz_domain_value_answers.user_id', auth()->user()->id)
                                ->where('quiz_domain_values.id', '>', 18)
                                ->where('quiz_domain_values.id', '<=', 24)
                                ->select('quiz_domain_values.title as name')
                                ->selectRaw(
                                    'ROUND((SUM(quiz_domain_value_answers.answer) / 40) * 100, 2) as percentage',
                                )
                                ->groupBy('quiz_domain_values.title')
                                ->orderByDesc('percentage')
                                ->get();

                            $workInterestResult = [];
                            $workInterestResult['Realistic'] = 0;
                            $workInterestResult['Investigative'] = 0;
                            $workInterestResult['Artistic'] = 0;
                            $workInterestResult['Social'] = 0;
                            $workInterestResult['Enterprising'] = 0;
                            $workInterestResult['Conventional'] = 0;

                            $workInterestArray = $workInterestResults->toArray();

                            // Sort the data based on percentage in descending order
                            usort($workInterestArray, function ($a, $b) {
                                return $b->percentage <=> $a->percentage;
                            });

                            // Extract the first letter of the top 3 names and concatenate them
                            $top_names_first_letters = '';
                            foreach (array_slice($workInterestArray, 0, 3) as $entry) {
                                $top_names_first_letters .= substr($entry->name, 0, 1);
                            }
                            // Sorting based on letter RIASEC
                            $riasec_values = [
                                'R' => 1,
                                'I' => 2,
                                'A' => 3,
                                'S' => 4,
                                'E' => 5,
                                'C' => 6,
                            ];

                            $top_names_first_letters_array = str_split($top_names_first_letters);
                            // Sort the letters based on their RIASEC values
                            usort($top_names_first_letters_array, function ($a, $b) use ($riasec_values) {
                                return $riasec_values[$a] <=> $riasec_values[$b];
                            });

                            $top_names_first_letters = implode('', $top_names_first_letters_array);

                            $top3Riasec = DB::table('master_top_3_riasec_descriptions')
                                ->where('top_3_riasec', 'like', "%$top_names_first_letters%")
                                ->first();

                            $workInterestResult['top_3_riasec'] = $top_names_first_letters ?? '';
                            $workInterestResult['top_3_riasec_description'] = $top3Riasec->description ?? '';
                        @endphp
                        {{-- <interest-riasec-chart class="mb-5" :data='@json($questions)'></interest-riasec-chart> --}}
                        <div class="card shadow-base2" style="border-radius: 30px; box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.03); border: 1px solid #F1F1F4; height: 90%;">
                            <header class="card-header">
                                <h4 class="interest-title" style="text-align: center;">Your Top 3 RIASEC:</h4>
                            </header>
                            @if (auth()->user()->is_work_interest_completed == 1)
                                <div class="card-body px-4" style="margin-top: -25px; margin-bottom: 26px;">
                                    <div class="interest-item">
                                        <span>
                                            {{ $workInterestResult['top_3_riasec'] ?? '' }}
                                        </span>
                                    </div>
                                    <div class="interest-description px-2 mt-2" style="text-align: left;" >
                                        <span style="color: #343434;">
                                            {{ $workInterestResult['top_3_riasec_description'] ?? '' }}
                                        </span>
                                    </div>
                                </div>
                            @else
                                <div class="container text-center bg_secondary_green p-5" style="border-radius: 16px;">
                                    <iconify-icon icon="wpf:statistics" class="text-[2.23rem]"></iconify-icon>
                                    <h4>Data Not Available</h4>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <a href="/dashboard">
                <button class="backdashboard-btn" style="margin-bottom: 50px;">Back to Dashboard</button>
            </a>

            <div class="container py-0 p-0 md-p-4 md-py-4 align-items-center">
                <p style="c-desc">A useful way to look at these results is to find out more about<br> your top interest
                    areas by using the links below.</p>
                @include('quiz.interest-riasec.results.realistic')
                @include('quiz.interest-riasec.results.investigative')
                @include('quiz.interest-riasec.results.artistic')
                @include('quiz.interest-riasec.results.social')
                @include('quiz.interest-riasec.results.enterprising')
                @include('quiz.interest-riasec.results.conventional')
            </div>

            <a href="/dashboard">
                <button class="backdashboard-btn" style="margin-bottom: 100px;">Back to Dashboard</button>
            </a>
        </div>
    </div>
@endsection
