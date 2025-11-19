@extends('admin.layout.app')

@section('title', 'Applicant Details')

@section('styles')

    <style>
        .top-card {
            padding: 39px 25px 0px 25px;
            border-radius: 8px;
            border: 1px solid #F1F1F4;
            box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.03);
            margin-bottom: 48px;
        }

        .top-card h1 {
            color: #071437;
            font-size: 19.5px;
            font-weight: 700;
            line-height: 29.25px;
        }

        .top-card .card-info-p,
        .card-info-p {
            color: #99A1B7;
            font-size: 13.975px;
            line-height: 20.963px;
        }

        .top-card .card-info-p .job-applied {
            color: #4B5675;
            font-size: 13.975px;
            font-style: normal;
            line-height: 20.963px;
        }

        .dark-grey {
            color: #4B5675;
        }

        .top-card .gap-16px {
            gap: 16px;
        }

        .top-card .line-vertical {
            height: 24px;
            width: 1px;
            display: block;
            background-color: #DBDFE9;
        }

        .top-card .badge,
        .job-applied {
            display: flex;
            padding: 6.4px 12.8px;
            justify-content: center;
            align-items: center;
            border-radius: 64px;
            font-size: 12px;
            line-height: 16px;
        }

        .top-card .badge.high {
            background: #DDF5E2;
            color: #196329;
        }

        .top-card .badge.moderate {
            background: #FFEBB4;
            color: #EB8100;
        }

        .top-card .badge.low {
            background-color: #ffcdd2;
            color: #d32f2f;
        }

        .top-card .badge.filled {
            background: #F2EEFD;
            color: #6652A1;
        }

        .top-card .badge.rate {
            background: #FFEBB4;
            color: #A56313;
        }

        .job-applied {
            background: #E3F7FF;
            color: #1877A0;
        }

        .top-card .mb-30px {
            margin-bottom: 30px;
        }

        .top-card .card-info-btn button,
        .job-application-section .left-side button.btn-action {
            display: flex;
            height: 32px;
            padding: 12px 18px;
            justify-content: center;
            align-items: center;
            gap: 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
            line-height: 16px;
        }

        .top-card .card-info-btn button.btn-orange {
            color: #F7941C;
            border: 1px solid #F7941C;
        }

        .job-application-section .left-side button.btn-action {
            color: #78829D;
            border: 1px solid #99A1B7;
        }

        .top-card .tabs-div .nav-pills .nav-ite,
        {
        margin: 0;
        }

        .top-card .tabs-div .nav-pills .nav-link {
            padding: 16px;
            color: #99A1B7;
            font-size: 14px;
            line-height: 18px;

        }

        .top-card .tabs-div .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            border-bottom: 1px solid #F7941C;
            color: #F7941C;
        }

        .purple,
        .purple-high,
        .cyan,
        .cyan-high,
        .orange,
        .spring,
        .yellow, .green {
            font-size: 12px;
            font-weight: 600;
            line-height: normal;
        }

        .purple span,
        .purple-high span,
        .cyan span,
        .cyan-high span,
        .orange span,
        .green span,
        .spring span,
        .yellow span {
            border-radius: 8px;
            position: relative;
            font-size: 11px;
            font-weight: 600;
            left: 6.4px;
            padding: 2px 8.6px;
            text-transform: uppercase;
        }

        .green {
            color: #2AA443;
        }

        .green span {
            color: #218336 !important;
            background: #BBECC5 !important;
        }

        .purple {
            color: #7F66CA;
        }

        .purple-high {
            color: #6652A1;
        }

        .success-green {
            color: #218336 !important;
        }

        .purple span, .purple-high span {
            color: #7F66CA;
            background: #E1D8FB;
        }

        .cyan {
            color: #108585;
        }

        .cyan span {
            background: #B2ECEC;
            color: #108585 !important;
        }

        .cyan-high {
            color: #108585;
        }

         .cyan-high span {
            background: #B2ECEC;
            color: #0C6464;
        }

        .orange {
            color: #F7941C;
        }

        .orange span {
            background: #FDE2C1;
            color: #F7941C !important;
        }

        .spring {
            color: #D4A21A;
        }

        .spring span {
            color: #F7941C;
            background: #FFEBB4 !important;
        }

        .yellow {
            color: #D4A21A !important;
        }

        .yellow span {
            color: #F7941C;
            background: #FFEBB4 !important;
        }
    </style>

    <style>
        .job-application-section {
            grid-template-columns: 65% 32.4%;
            gap: 32px;
        }

        .top-heading {
            color: #1E1E1E;
            font-size: 22.75px;
            font-weight: 500;
            line-height: 27.3px;
        }

        .job-application-section .box,
        .psychometric-section .box {
            padding: 24px;
            border-radius: 8px;
            border: 1px solid #F1F1F4;
            background: #FFF;
            box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.03);
        }

        .job-application-section .box .heading-box {
            color: #000;
            font-size: 17.55px;
            font-weight: 500;
            line-height: 21.06px;
            margin-bottom: 20px;
        }

        .skill-badge {
            padding: 8px 16px;
            border-radius: 80px;
            background: #F1F1F4;
            color: #4B5675;
            font-size: 12px;
            font-weight: 500;
            line-height: 16px;
            letter-spacing: 0.5px;
        }

        .job-application-section .left-side .table-container {
            background: white;
        }

        .job-application-section .left-side .table-container .table thead th {
            border-radius: 5px 5px 0px 0px;
            border: 1px solid #F3F3F3;
            background: #FAFAFB;
            padding: 16px;
            color: #99A1B7;
            font-size: 12px;
            font-weight: 600;
            line-height: 16px;
        }

        .job-application-section .left-side .table-container .table tbody td {
            color: #4B5675;
            padding: 24px 16px;
            border-bottom: 1px solid #F1F1F4;
            font-size: 14px;
            font-weight: 500;
            line-height: 20px;
            letter-spacing: 0.1px;
        }
    </style>

    <style>
        .psychometric-section .box {
            padding: 30px;
        }

        .psychometric-section .tweleve-inner {
            border-radius: 5.6px;
            background: #FFF;
            box-shadow: 0px 2.24px 2.24px 0px rgba(0, 0, 0, 0.25);
            padding: 20px 21px 20px 20px;
            height: fit-content;
        }

        .psychometric-section .card-info-btn .btn-orange {
            padding: 12px 20px;
            background: #fff;
            color: #F7941C;
            border: 1px solid #F7941C;
            border-radius: 4px;
        }

        .psychometric-section .top-heading {
            color: #5B5B5B;
            font-size: 32px;
            font-weight: 500;
            line-height: normal;
        }

        .psychometric-section .badge-custom {
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            padding: 3.3px 7.7px;
            border-radius: 11px;
        }

        .psychometric-section .badge-custom.individual-contributors {
            color: #F36B0A;
            background: #FEECE5;
        }

        .psychometric-section .badge-custom.managers {
            color: #FF2E2E;
            background: #FFE8E8;
        }

        .psychometric-section .badge-custom.leadership {
            color: #BF3173;
            background: #FFE4F1;
        }

        .psychometric-section .badge-custom.higly-aligned,
        .psychometric-section .advance-higly-aligned {
            color: #7F66CA !important;
            background: #E1D8FB;
        }

        .psychometric-section .badge-custom.aligned,
        .psychometric-section .Intermediate-critical {
            color: #108585 !important;
            background: #B2ECEC;
        }

        .psychometric-section .circle-content {
            width: 100.069px;
            height: 99.347px;
            display: block;
            border-radius: 50%;
            border-width: 9px;
            border-style: solid;
        }

        .psychometric-section .circle-content.circle-low {
            border-color: #FF8277;
            background: #ffcdd2;
        }

        .psychometric-section .circle-content.circle-moderate {
            border-color: #FFEBB4;
            background: #FFDC92;
        }

        .psychometric-section .circle-content.circle-high {
            border-color: #d4f0d9;
            background: #DDF5E2;
        }

        .psychometric-section .circle-content span {
            position: relative;
            top: 40%;
            left: 10%;
            font-size: 14.151px;
            line-height: 20.216px;
        }

        .psychometric-section .color-moderate {
            color: #F7941C;
        }

        .psychometric-section .color-low {
            color: #d32f2f;
        }

        .psychometric-section .color-high {
            color: #196329;
        }

        .psychometric-section h2 {
            font-size: 24px;
            line-height: normal;
        }

        .psychometric-section h5 {
            color: #5B5B5B;
            font-size: 20px;
            line-height: normal;
            margin-bottom: 8px;
        }

        .psychometric-section .overview-heading {
            color: #5B5B5B;
            font-size: 16px;
            line-height: 22px;
            margin-bottom: 6px;
        }

        .psychometric-section .overview-sub-heading {
            color: #666;
            font-size: 14px;
            line-height: 20px;
        }

        .psychometric-section .moderate-icon {
            transform: rotate(45deg);
            color: #FFCD44;
        }

        .moderate-icon {
            transform: rotate(45deg);
            color: #FFCD44; 
        }

        .psychometric-section .reset-setting-text {
            color: #99A1B7;
            font-size: 12px;
            line-height: 15px;
        }

        .psychometric-section .box-top-text {
            font-size: 24px;
        }

        .psychometric-section .view-all-text {
            color: #F7941C;
            font-size: 12px;
            font-weight: 400;
            line-height: 15px;
        }

        .psychometric-section .grid-template {
            grid-template-columns: 57% 41.5%;
            gap: 17px;
        }

        .psychometric-section .skill-table {
            display: grid;
            gap: 30px;
        }

        .psychometric-section .skill-table .table-desc {
            margin: 0;
        }

        .psychometric-section .inner-table {
            display: grid;
            grid-template-columns: 62% 32%;
            gap: 30px;
            align-items: flex-start;
        }

        .psychometric-section .orange-bg .table-desc {
            margin: 0;
        }

        .psychometric-section .table-desc {
            color: #5B5B5B;
            font-size: 12px;
            font-weight: 400;
            line-height: 15px;
        }

        .psychometric-section .left-table-head {
            color: #5B5B5B;
            font-size: 16px;
            font-weight: 500;
            line-height: normal;
            text-transform: uppercase;
        }

        .psychometric-section .left-table-head p {
            margin-bottom: 5px;
        }

        .psychometric-section .left-table-head span {
            color: #F7941C;
            font-weight: 700;
        }

        .psychometric-section .left-table-head span {
            color: #F7941C;
            font-weight: 700;
        }

        .psychometric-section .line-grey {
            background-color: #e6e6e6;
            position: relative;
            margin-top: 15px;
            width: 100%;
            height: 15px;
            background: #EBEBEB;
        }

        .psychometric-section .line-orange {
            height: 15px;
        }

        .psychometric-section .line {
            border-radius: 7.14px;
        }

        .psychometric-section .line-bottom {
            background: #E1E1E1;
            width: 100%;
            height: 1px;
        }

        .psychometric-section .line-orange {
            height: 15px;
        }

        .psychometric-section .side-line-orange {
            padding-left: 15px;
            border-left: 2px solid #FABB6E;
        }

        .psychometric-section .dark-orange {
            background: #F7941C;
        }

        .psychometric-section .light-orange {
            background: #FFC549;
        }

        .psychometric-section .orange {
            background: #F9A845;
        }

        .psychometric-section .svg-round-icon {
            position: absolute;
            top: -32%;
            display: block;
            width: 24px;
            height: 24px;
            background: #F7941C;
            border-radius: 50%;
            border: 4px solid #fff;
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
        }

        .psychometric-section .right-table .badge-content {
            font-size: 14px;
            line-height: normal;
        }

        .psychometric-section .teal {
            color: #108585;
        }

        .psychometric-section .green {
            color: #2AA443;
        }

        .psychometric-section .purple {
            color: #997BF2;
        }

        .psychometric-section .yellow {
            color: #F7941C;
        }

        .psychometric-section .badge {
            padding: 3px 7px;
            border-radius: 10px;
            font-size: 10px;
            text-transform: uppercase;
        }

        .psychometric-section .color-teal {
            background: #B2ECEC;
            color: #0C6464;
        }

        .psychometric-section .color-green {
            background: #BBECC5;
            color: #218336;
        }

        .psychometric-section .color-purple {
            background: #E1D8FB;
            color: #7F66CA;
        }

        .psychometric-section .color-cyan {
            background: #B2ECEC;
            color: #108585;
        }

        .psychometric-section .color-yellow {
            background: #FFEBB4;
            color: #F7941C;
        }

        .psychometric-section .orange-basic {
            background: #FDE2C1;
            color: #F7941C;
        }

        .psychometric-section .orange-bg {
            padding: 10px 10px 10px 15px;
            background: #FFF6EA;
            border-left: 2px solid #FABB6E;
        }

        .psychometric-section .esi-text {
            color: #F7941C;
            font-size: 36px;
            line-height: normal;
        }

        .psychometric-section .progress-container {
            width: 100%;
            margin-top: 15px;
            margin-bottom: 15px;
            height: 16px;
            background-color: #f0f0f0;
            position: relative;
            display: table;
            border-collapse: collapse;
        }

        .psychometric-section .progress-fill {
            display: table-row;
        }

        .psychometric-section .progress-segment {
            display: table-cell;
            height: 16px;
        }

        .psychometric-section .segment-yellow,
        .psychometric-section .segment-orange,
        .psychometric-section .segment-blue {
            width: 33.33%;
        }

        .psychometric-section .segment-yellow {
            background-color: #FFD76A;
        }

        .psychometric-section .segment-orange {
            background-color: #99E2A8;
        }

        .psychometric-section .segment-blue {
            background-color: #65DADA;
        }

        .psychometric-section .progress-circle {
            position: absolute;
            top: -38%;
            display: block;
            width: 28px;
            height: 28px;
            background: #14A6A6;
            border-radius: 50%;
            border: 4px solid #fff;
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
        }

        .psychometric-section .back-button {
            color: #F7941C;
            font-size: 14px;
            text-transform: capitalize;
        }

        .color-result p {
            color: #5B5B5B;
            font-size: 12px;
            font-weight: 400;
            line-height: 15px;
        }

        .small-box {
            width: 28.442px;
            height: 6.477px;
            display: block;
        }

        .small-box.wrong {
            background-color: #FFDC92;
        }

        .small-box.correct {
            background-color: #8CE3E3;
        }

        .small-box.missed {
            background-color: #BBA7F6;
        }
    </style>

    <style>
        .job-centric h4 {
            height: 34px;
            padding: 4px 10px;
            background: #FFF6EA;
            color: #5B5B5B;
            font-size: 14px;
            line-height: 18px;
            text-transform: uppercase;
        }

        .job-centric .icon-p {
            gap: 8px;
            color: #666;
            font-size: 14px;
            line-height: 20px;
        }

        .job-centric .icon-p-border {
            padding: 10px;
            border: 1px solid #EBEBEB;
        }

        .job-centric-sticky p {
            color: #5B5B5B;
            font-size: 12px;
            line-height: 16px;
            text-transform: uppercase;
            padding: 15px;
        }

        .psychometric-section .strip {
            width: 42px;
            height: 7px;
            display: block;
        }

        .psychometric-section .small-strip {
            width: 24px;
            height: 5px;
            display: block;
        }

        .psychometric-section .strip.dark-red,
        .psychometric-section .small-strip.dark-red {
            color: #FF6355;
        }

        .psychometric-section .strip.light-orange,
        .psychometric-section .small-strip.light-orange {
            background-color: #FFDC92;
        }

        .psychometric-section .strip.dark-orange,
        .psychometric-section .small-strip.dark-orange {
            background-color: #FFAE00;
        }

        .psychometric-section .strip.grey,
        .psychometric-section .small-strip.grey {
            background-color: #EBEBEB;
        }

        .light-green {
            background-color: #ddf5e2;
        }

        .medium-green {
            background-color: #99e2a8;
        }

        .dark-green {
            background-color: #2aa443;
        }

        .dark-red {
            background-color: #FF6355;
        }

        .green-icon-color {
            color: #2AA443;
        }

        .rotate-90-red {
            display: inline-block;
            width: 16px;
            height: 16px;
            color: #FF6355;
            background: #FF6355;
            clip-path: polygon(
                50% 0%,   
                100% 52%, 
                54% 52%,   
                100% 100%, 
                0% 100%,   
                46% 52%,   
                0% 52%    
            );
        }

        .rotate-90-green {
            display: inline-block;
            width: 16px;
            height: 16px;
            color: #2AA443;
            background: #2AA443;
            clip-path: polygon(
                50% 0%,   
                100% 52%, 
                54% 52%,   
                100% 100%, 
                0% 100%,   
                46% 52%,   
                0% 52%    
            );
        }

        .rotate-minus-90-red {
            display: inline-block;
            width: 16px;
            height: 16px;
            color: #FF6355;
            background: #FF6355;
            clip-path: polygon(
                0% 0%,      
                100% 0%,    
                57% 48%,   
                100% 48%,   
                50% 100%,  
                0% 48%,    
                43% 48%    
            );
        }

        .rotate-minus-90-green {
            display: inline-block;
            width: 16px;
            height: 16px;
            color: #2AA443;
            background: #2AA443;
            clip-path: polygon(
                0% 0%,      
                100% 0%,    
                57% 48%,   
                100% 48%,   
                50% 100%,  
                0% 48%,    
                43% 48%    
            );
        }

        .red-icon-color,
        .red-circle-icon {
            color: #FF6355;
        }

        .green-circle-icon {
            color: #54CF6E;
        }

        .psych-inner,
        .psych-inner-2,
        .psych-inner-3 {
            padding: 30px 40px 45px 40px;
        }
        .cognitive-orange {
            background: #FFEBB4;
            color: #F7941C; /* Darker text for contrast */
        }

        .cognitive-green {
            background: #BBECC5;
            color: #218336; /* Darker green text */
        }

        .cognitive-blue {
            background: #B2ECEC;
            color: #108585; /* Darker teal text */
        }


        
    </style>

    <style>
        .toggle-btn {
            border: 1px solid red;
            background: white;
            color: red;
            padding: 8px 16px;
            border-radius: 6px;
            cursor: pointer;
            font-family: sans-serif;
            width: fit-content;
            margin: auto
        }

        .toggle-btn.show-less {
            border: none;
            background: none;
            color: red;
            padding: 8px 0;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .hidden-content {
            display: none;
            margin-top: 10px;
            font-family: sans-serif;
            gap: 30px;
        }

        .dark-red {
            background: #FF5D5D;
        }

        .dark-green {
            width: 21px;
            background-color: #2aa443;
            display: table-cell;
        }

        .light-green {
            width: 21px;
            /* Equivalent to 21.0817 units in the SVG */
            background-color: #ddf5e2;
            display: table-cell;
        }

        .medium-green {
            width: 21px;
            background-color: #99e2a8;
            display: table-cell;
        }

        .rotate-90-red {
            display: inline-block;
            width: 16px;
            height: 16px;
            color: #FF6355;
            background: #FF6355;
            clip-path: polygon(
                50% 0%,   
                100% 52%, 
                54% 52%,   
                100% 100%, 
                0% 100%,   
                46% 52%,   
                0% 52%    
            );
        }

        .rotate-90-green {
            display: inline-block;
            width: 16px;
            height: 16px;
            color: #2AA443;
            background: #2AA443;
            clip-path: polygon(
                50% 0%,   
                100% 52%, 
                54% 52%,   
                100% 100%, 
                0% 100%,   
                46% 52%,   
                0% 52%    
            );
        }

        .rotate-minus-90-red {
            display: inline-block;
            width: 16px;
            height: 16px;
            color: #FF6355;
            background: #FF6355;
            clip-path: polygon(
                0% 0%,      
                100% 0%,    
                57% 48%,   
                100% 48%,   
                50% 100%,  
                0% 48%,    
                43% 48%    
            );
        }

        .rotate-minus-90-green {
            display: inline-block;
            width: 16px;
            height: 16px;
            color: #2AA443;
            background: #2AA443;
            clip-path: polygon(
                0% 0%,      
                100% 0%,    
                57% 48%,   
                100% 48%,   
                50% 100%,  
                0% 48%,    
                43% 48%    
            );
        }
    </style>

@endsection

@section('content')

    <div id="kt_app_content" class="app-content  flex-column-fluid position-lg-relative p-0">
        <div id="kt_app_content_container" class="app-container  container-xxl  w-100">
            @include('admin.talent-acquisition.job-advertisement.applicant-details.includes.top-card')
        </div>
    </div>

@endsection

@section('scripts')
    @if ($page == 'psychometric')
        <script>
            var options = {
                chart: {
                    type: "donut",
                    width: "280px",
                    height: "280px"
                },
                series: [{{ $totalCorrectForCognitive ?? 0 }}, {{ $totalWrongForCognitive ?? 0 }}, {{ $totalNonAttemptedForCognitive ?? 0}}],
                labels: ["Correct Answers", "Wrong Answers", "Missed Questions"],
                colors: ["#B2E6E0", "#FCE9D4", "#C5B3F3"],
                dataLabels: {
                    enabled: false,
                },
                legend: {
                    show: false,
                },
                plotOptions: {
                    pie: {
                        donut: {
                            size: "80%",
                        },
                        expandOnClick: false,
                    },
                },
            };

            var chart = new ApexCharts(document.querySelector("#result-chart"), options);
            chart.render();
        </script>
    @endif
    

<script>
    function toggleVisibility() {
        document.querySelectorAll(".show-on-click").forEach(element => {
            element.classList.toggle("d-none");
        });

        document.querySelectorAll(".hide-on-click").forEach(element => {
            element.classList.toggle("d-none");
        });
    }

    document.getElementById('job_opening').addEventListener('change', function() {
        const jobId = this.value;
        const applicantId = '{{ $jobOpeningApplication->user->id }}';
        if (jobId) {
            const route = "{{ route('admin.talent-acquisition.job-advertisement.detail.applicant-details', ['id' => ':id', 'applicant_id' => ':applicant_id']) }}";
            const url = route.replace(':id', jobId).replace(':applicant_id', applicantId);
            window.location.href = url;
        }
    });

    document.getElementById("toggleBtn").addEventListener("click", toggleVisibility);
    document.getElementById("backBtn").addEventListener("click", toggleVisibility);


</script>



@endsection
