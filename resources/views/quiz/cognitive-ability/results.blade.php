@extends('layout.app')

@section('app')

<div class="content-container container-1">
    <h1>Thank you</h1>
    <h2>Your Cognitive Ability Assessment Submitted</h2>
    <a href="/dashboard?first_time_redirect=true">
        <button class="backdashboard-btn">Back to Dashboard</button>
    </a>
</div>
                     <!-- <div class="col-12 col-lg-12 mb-4 mb-lg-0 text-center text-lg-start">
                        
                  
                        <h1 class="">
                            'Thank you') </h1>

                        <h2 class="color-white fs-3-rem fw-700 text-center">
                             __('Your Cognitive Ability Assessment Submitted') }}</h2> -->

                        
                        <!-- <p class="color-white fs-1-1">Find out your level of Cognitive Ability and how to improve it to maximise your career options.</p> -->
                        <!--<div class=" d-flex align-items-center fw-500 mb-5 justify-content-center
    
                        "> -->
                        <!--<a href="/dashboard" class="btn btn-white shadow rounded-custom px-5 fs-2-rem mb-3 fw-600 mt-3">Go
                            To Dashboard</a>
                        </div>
                    </div>-->

                    <!-- <div class="col-12 col-lg-6">

                  <img src="/images/english-main.svg" class="intro-header-image mx-auto ms-lg-auto me-lg-0 d-block">

                </div> -->

                </div>





                {{-- <div style="float: right;margin-top: 18px;">
          <a href="/logout/talent" class="btn btn-white shadow rounded-custom px-5 fs-1-rem mb-3 fw-600">{{
            __("Logout")}} </a>
        </div> --}}

            </div>

        </div>


    </div>
@endsection
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
        .text-left {
            text-align: left !important;
        }

        .question-bar {
            display: flex;
            align-items: center;
            width: 100%;
            height: 30px;
            /* border: 1px solid #ccc; */
            position: relative;
            margin: 20px;
        }

        /*  body {
            background-image: linear-gradient(to right, #CE9E20, #1AB93B, #0245A3, #1F5476);

        } */

        .attempted-bar-anchor {
            background-color: #7ab78a;
            height: 100%;
            width: var(--attempted-width-anchor, 50%);
            border-radius: 7px 0px 0px 7px;
        }

        .missed-bar-anchor {
            background-color: #FF474C;
            height: 100%;
            width: var(--missed-width-anchor, 50%);
            border-radius: 0px 7px 7px 0px;
        }

        .correct-bar-quantitative {
            background-color: #7ab78a;
            height: 100%;
            width: var(--correct-width-quantitative, 50%);
            border-radius: 7px 0px 0px 7px;
        }

        .wrong-bar-quantitative {
            background-color: #FF474C;
            height: 100%;
            width: var(--wrong-width-quantitative, 50%);
            /* border-radius: 7px 0px 0px 7px; */
        }

        .missed-bar-quantitative {
            background-color: #0074c7;
            height: 100%;
            width: var(--missed-width-quantitative, 50%);
            border-radius: 0px 7px 7px 0px;
        }

        .correct-bar-comprehension {
            background-color: #7ab78a;
            height: 100%;
            width: var(--correct-width-comprehension, 50%);
            border-radius: 7px 0px 0px 7px;
        }

        .wrong-bar-comprehension {
            background-color: #FF474C;
            height: 100%;
            width: var(--wrong-width-comprehension, 50%);
            /* border-radius: 7px 0px 0px 7px; */
        }

        .missed-bar-comprehension {
            background-color: #0074c7;
            height: 100%;
            width: var(--missed-width-comprehension, 50%);
            border-radius: 0px 7px 7px 0px;
        }

        .correct-bar-visual {
            background-color: #7ab78a;
            height: 100%;
            width: var(--correct-width-visual, 50%);
            border-radius: 7px 0px 0px 7px;
        }

        .wrong-bar-visual {
            background-color: #FF474C;
            height: 100%;
            width: var(--wrong-width-visual, 50%);
            /* border-radius: 7px 0px 0px 7px; */
        }

        .missed-bar-visual {
            background-color: #0074c7;
            height: 100%;
            width: var(--missed-width-visual, 50%);
            border-radius: 0px 7px 7px 0px;
        }

        .correct-bar-fluid {
            background-color: #7ab78a;
            height: 100%;
            width: var(--correct-width-fluid, 50%);
            border-radius: 7px 0px 0px 7px;
        }

        .wrong-bar-fluid {
            background-color: #FF474C;
            height: 100%;
            width: var(--wrong-width-fluid, 50%);
            /* border-radius: 7px 0px 0px 7px; */
        }

        .missed-bar-fluid {
            background-color: #0074c7;
            height: 100%;
            width: var(--missed-width-fluid, 50%);
            border-radius: 0px 7px 7px 0px;
        }

        .percentage-text {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
        }

        .attempted-percentage {
            left: 5px;
            color: #fff;
        }

        .correct-percentage {
            left: 5px;
            color: #fff;
        }

        .wrong-percentage {
            left: 5px;
            color: #fff;
        }

        .missed-percentage {
            right: 5px;
            color: #fff;
        }
        .backdashboard-btn{
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
        .backdashboard-btn button:hover {
            background-color: #F6931D;
        }
        .content-container h41{
            font-family: sans-serif;
            font-size: 48px;
            color: #F6931D;
            font-weight: bold;
        }
        .content-container h42{
            font-family: sans-serif;
            font-size: 28px;
            color: #807E7E;
            font-weight: 400;
            margin-bottom: 50px;
        }
    </style>
@endsection

@push('script')
    <script src="{{ asset('apexcharts/dist/apexcharts.min.js') }}"></script>
    <script>
        var options = {
            chart: {
                type: 'donut',
                width: 400, // Set the width of the chart
                height: 300, // Set the height of the chart
            },
            series: [{{ $total_correct }}, {{ $total_wrong }}, {{ $total_not_attempted }}],
            labels: ['Corrrect', 'Wrong', 'Missed'],
            colors: ['#7ab78a', '#FF474C', '#0074c7'],
            xaxis: {
                categories: [1991, 1992, 1993, 1994, 1995, 1996, 1997, 1998, 1999]
            },

            legend: {
                position: 'bottom', // Set the position of the legend to 'bottom'
            },
        }

        var chart = new ApexCharts(document.querySelector("#chart"), options);

        chart.render();
    </script>

    <script>
        // Anchor Questions
        // Sample data (replace this with your actual data)
        const attemptedQuestions = {{ $total_is_anchor_correct }};
        const missedQuestions = {{ $total_is_anchor_wrong }};
        // const attemptedQuestions = 80;
        // const missedQuestions = 20;

        // Calculate percentages
        const attemptedPercentage = (attemptedQuestions / (attemptedQuestions + missedQuestions)) * 100;
        const missedPercentage = (missedQuestions / (attemptedQuestions + missedQuestions)) * 100;

        // Set widths for attempted and missed bars
        document.documentElement.style.setProperty('--attempted-width-anchor', `${attemptedPercentage}%`);
        document.documentElement.style.setProperty('--missed-width-anchor', `${missedPercentage}%`);

        // Display percentages
        if (attemptedPercentage != 0) {
            document.querySelector('.attempted-percentage-anchor').textContent = `${attemptedPercentage.toFixed(1)}%`;
        }
        if (missedPercentage != 0) {
            document.querySelector('.missed-percentage-anchor').textContent = `${missedPercentage.toFixed(1)}%`;
        }

        // Quantitative Questions
        const correctQuestionsq = {{ $domain_results[70]['correct'] }};
        const wrongQuestionsq = {{ $domain_results[70]['wrong'] }};
        const missedQuestionsq = {{ $domain_results[70]['non_attempted'] }};

        // Calculate percentages
        const correctPercentageq = (correctQuestionsq / (correctQuestionsq + wrongQuestionsq + missedQuestionsq)) * 100;
        const wrongPercentageq = (wrongQuestionsq / (correctQuestionsq + wrongQuestionsq + missedQuestionsq)) * 100;
        const missedPercentageq = (missedQuestionsq / (correctQuestionsq + wrongQuestionsq + missedQuestionsq)) * 100;

        // Set widths for correct, wrong and missed bars
        document.documentElement.style.setProperty('--correct-width-quantitative', `${correctPercentageq}%`);
        document.documentElement.style.setProperty('--wrong-width-quantitative', `${wrongPercentageq}%`);
        document.documentElement.style.setProperty('--missed-width-quantitative', `${missedPercentageq}%`);

        // Display percentages
        if (correctPercentageq != 0) {
            document.querySelector('.correct-percentage-quantitative').textContent = `${correctPercentageq.toFixed(1)}%`;
        }

        if (wrongPercentageq != 0) {
            document.querySelector('.wrong-percentage-quantitative').textContent = `${wrongPercentageq.toFixed(1)}%`;
        }

        if (missedPercentageq != 0) {
            document.querySelector('.missed-percentage-quantitative').textContent = `${missedPercentageq.toFixed(1)}%`;
        }

        // Comprehension Questions
        const correctQuestionsc = {{ $domain_results[71]['correct'] }};
        const wrongQuestionsc = {{ $domain_results[71]['wrong'] }};
        const missedQuestionsc = {{ $domain_results[71]['non_attempted'] }};

        // Calculate percentages
        const correctPercentagec = (correctQuestionsc / (correctQuestionsc + wrongQuestionsc + missedQuestionsc)) * 100;
        const wrongPercentagec = (wrongQuestionsc / (correctQuestionsc + wrongQuestionsc + missedQuestionsc)) * 100;
        const missedPercentagec = (missedQuestionsc / (correctQuestionsc + wrongQuestionsc + missedQuestionsc)) * 100;

        // Set widths for correct, wrong and missed bars
        document.documentElement.style.setProperty('--correct-width-comprehension', `${correctPercentagec}%`);
        document.documentElement.style.setProperty('--wrong-width-comprehension', `${wrongPercentagec}%`);
        document.documentElement.style.setProperty('--missed-width-comprehension', `${missedPercentagec}%`);

        // Display percentages
        if (correctPercentagec != 0) {
            document.querySelector('.correct-percentage-comprehension').textContent = `${correctPercentagec.toFixed(1)}%`;
        }

        if (wrongPercentagec != 0) {
            document.querySelector('.wrong-percentage-comprehension').textContent = `${wrongPercentagec.toFixed(1)}%`;
        }

        if (missedPercentagec != 0) {
            document.querySelector('.missed-percentage-comprehension').textContent = `${missedPercentagec.toFixed(1)}%`;
        }

        // Visual Questions
        const correctQuestionsv = {{ $domain_results[72]['correct'] }};
        const wrongQuestionsv = {{ $domain_results[72]['wrong'] }};
        const missedQuestionsv = {{ $domain_results[72]['non_attempted'] }};

        // Calculate percentages
        const correctPercentagev = (correctQuestionsv / (correctQuestionsv + wrongQuestionsv + missedQuestionsv)) * 100;
        const wrongPercentagev = (wrongQuestionsv / (correctQuestionsv + wrongQuestionsv + missedQuestionsv)) * 100;
        const missedPercentagev = (missedQuestionsv / (correctQuestionsv + wrongQuestionsv + missedQuestionsv)) * 100;

        // Set widths for correct, wrong and missed bars
        document.documentElement.style.setProperty('--correct-width-visual', `${correctPercentagev}%`);
        document.documentElement.style.setProperty('--wrong-width-visual', `${wrongPercentagev}%`);
        document.documentElement.style.setProperty('--missed-width-visual', `${missedPercentagev}%`);

        // Display percentages
        if (correctPercentagev != 0) {
            document.querySelector('.correct-percentage-visual').textContent = `${correctPercentagev.toFixed(1)}%`;
        }

        if (wrongPercentagev != 0) {
            document.querySelector('.wrong-percentage-visual').textContent = `${wrongPercentagev.toFixed(1)}%`;
        }

        if (missedPercentagev != 0) {
            document.querySelector('.missed-percentage-visual').textContent = `${missedPercentagev.toFixed(1)}%`;
        }

        // Fluid Questions
        const correctQuestionsf = {{ $domain_results[73]['correct'] }};
        const wrongQuestionsf = {{ $domain_results[73]['wrong'] }};
        const missedQuestionsf = {{ $domain_results[73]['non_attempted'] }};

        // Calculate percentages
        const correctPercentagef = (correctQuestionsf / (correctQuestionsf + wrongQuestionsf + missedQuestionsf)) * 100;
        const wrongPercentagef = (wrongQuestionsf / (correctQuestionsf + wrongQuestionsf + missedQuestionsf)) * 100;
        const missedPercentagef = (missedQuestionsf / (correctQuestionsf + wrongQuestionsf + missedQuestionsf)) * 100;

        // Set widths for correct, wrong and missed bars
        document.documentElement.style.setProperty('--correct-width-fluid', `${correctPercentagef}%`);
        document.documentElement.style.setProperty('--wrong-width-fluid', `${wrongPercentagef}%`);
        document.documentElement.style.setProperty('--missed-width-fluid', `${missedPercentagef}%`);

        // Display percentages
        if (correctPercentagef != 0) {
            document.querySelector('.correct-percentage-fluid').textContent = `${correctPercentagef.toFixed(1)}%`;
        }

        if (wrongPercentagef != 0) {
            document.querySelector('.wrong-percentage-fluid').textContent = `${wrongPercentagef.toFixed(1)}%`;
        }

        if (missedPercentagef != 0) {
            document.querySelector('.missed-percentage-fluid').textContent = `${missedPercentagef.toFixed(1)}%`;
        }
    </script>
@endpush
