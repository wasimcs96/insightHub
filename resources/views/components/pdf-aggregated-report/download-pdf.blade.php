<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Aggregated Department Report</title>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" />
    <style>
        @page {
            size: legal;
            orientation: landscape;
            margin: 0;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        a,
        a:hover {
            text-decoration: none;
            color: inherit;
        }

        #chart {
            max-width: 222px;
            margin: auto;
        }

        #chartPositionLevel {
            margin-left: -10px;
            max-height: 100px;
        }

        .custom-label {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .apexcharts-bar-series path {
            rx: 4px;
            ry: 4px;
        }

        .apexcharts-bar-series path:first-child {
            rx: 0px 4px 4px 0px;
        }

        .container {
            display: flex;
            width: 100vw;
            height: 100vh;
            page-break-after: always;
        }

        .sidebar {
            background: #3e3e3e;
            padding: 60px 24px 126px 24px;
            color: white;
            width: 290px;
            height: 100vh;
        }

        .sidebar h3 {
            color: #fff;
            font-size: 20px;
            font-weight: 600;
            padding: 14px;
            margin: 0;
            margin-bottom: 14px;
        }

        .sidebar h3.active,
        .sidebar li.active {
            border-radius: 4px;
            background: #f7941c;
        }

        .sidebar a {
            display: block;
        }


        .sidebar ul,
        .second-content ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar li {
            color: #fff;
            font-size: 18px;
            font-weight: 500;
            margin-left: 10px;
            padding: 14px;
        }

        .main-content {
            display: flex;
        }

        .main-content .middle-img {
            height: 102.5%;
            width: 580px;
        }

        .second-content {
            width: 434px;
            padding: 51px 58px 0px 58px;
        }

        .first-right {
            background-image: url("/images/pdf-images/first-right-bg.png");
            background-position: bottom;
            background-size: contain;
            background-repeat: no-repeat;
            padding: 100px 61px 0px 61px;
            width: 330px;
        }

        .second-right .second-right-bg {
            width: 462px;
            height: 99.51%;
            position: relative;
            top: 2px;
        }

        .first-right h1 {
            color: #5b5b5b;
            font-size: 54px;
            font-weight: 500;
            margin: 60px 0px;
        }

        .first-sub-content .heading {
            color: #949495;
            font-size: 14.4px;
            font-weight: 600;
            line-height: 19.2px;
            text-transform: uppercase;
            margin: 0;
        }

        .first-sub-content .sub-heading {
            color: #5b5b5b;
            font-size: 22.08px;
            font-weight: 500;
            line-height: 36px;
            margin: 0;
            margin-bottom: 12px;
        }

        .second-content h2 {
            color: #5b5b5b;
            font-size: 40px;
            font-weight: 500;
            margin: 0;
            margin-bottom: 30px;
        }

        .second-content p {
            color: #5b5b5b;
            font-size: 18px;
            font-weight: 500;
            margin-bottom: 44px;
        }

        .second-content h6 {
            color: #5b5b5b;
            font-size: 18px;
            font-weight: 600;
            text-transform: capitalize;
            margin: 0;
            margin-bottom: 10px;
            display: flex;
            gap: 9px;
            align-items: flex-end;
        }

        .second-content ul {
            margin-bottom: 36px;
        }

        .second-content li {
            color: #5b5b5b;
            font-size: 16px;
            font-weight: 400;
        }

        .sidebar .home-icon-sidebar {
            position: relative;
            top: 40px;
            margin-left: 20px;
            font-size: 40px;
        }

        .third-content {
            display: flex;
            gap: 30px;
            padding: 51px 58px 20px;
        }

        .third-content .third-first,
        .third-content .third-second {
            width: 428px;
        }

        .third-first h4,
        .third-second h4 {
            color: #5b5b5b;
            font-size: 40px;
            font-weight: 500;
            margin: 0;
            margin-bottom: 30px;
        }

        .third-first .level-heading h4 {
            margin-bottom: 10px;
        }

        .level-heading {
            margin-bottom: 30px;
        }

        .third-first h6 {
            color: #5B5B5B;
            font-size: 26px;
            font-weight: 500;
            margin: 0px;
        }

        .third-first h6 span {
            color: #F7941C;
        }

        .level-spacer {
            height: 70px;
        }

        .grey-bg {
            padding: 22px;
            border-radius: 4px;
            background: #fafafb;
            margin-bottom: 12px;
        }

        .grey-bg:last-child {
            margin-bottom: 0;
        }

        .grey-bg .heading {
            color: #5b5b5b;
            font-size: 20px;
            font-weight: 500;
            margin: 0;
        }

        .total-employees p {
            color: #5b5b5b;
            font-size: 34px;
            font-weight: 600;
            margin: 0;
        }

        .total-employees span {
            color: #5b5b5b;
            font-size: 16px;
            font-weight: 500;
        }

        .third-body .footer {
            padding: 15px 58px;
            display: flex;
            justify-content: space-between;
            width: 886px;
            border-top: 1px solid #c8c8c9;
        }

        .footer p {
            color: #666;
            font-size: 12px;
            font-weight: 500;
            margin: 0;
        }

        .footer .left-side,
        .footer .right-side p {
            display: flex;
            align-items: center;
        }

        .footer .left-side {
            gap: 12px;
        }

        .footer .right-side p {
            gap: 24px;
        }

        .footer .right-side span {
            color: #666;
            font-size: 16px;
            font-weight: 700;
        }

        .footer .line {
            background-color: #666;
            height: 70%;
            width: 1px;
            display: block;
        }

        .status {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 18px 0px;
            gap: 14px;
        }

        .status span {
            color: #a0a0a0;
            text-align: center;
            font-size: 20px;
            font-weight: 500;
        }

        .count {
            color: #a0a0a0;
            font-size: 14px;
            font-weight: 500;
            display: flex;
            gap: 5px;
            align-items: center;
            justify-content: center;
        }

        .progress-bar {
            width: 100%;
            height: 16px;
            background: #f8f8f8;
            border-radius: 4px;
            overflow: hidden;
            display: flex;
        }

        .completed {
            width: var(--completed-width, 0%);
            background: #3fd0d0;
        }

        .not-completed {
            width: var(--not-completed-width, 0%);
            background: #ffdc92;
        }

        .legend {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 10px;
        }

        .legend div {
            display: flex;
            align-items: center;
            gap: 5px;
            color: #5b5b5b;
            font-size: 12px;
            font-weight: 400;
        }

        .legend span {
            width: 30px;
            height: 8px;
            display: inline-block;
        }

        .completed-color, .high {
            background-color: #1AC2C2 !important;
        }

        .not-completed-color {
            background-color: #ffdc92 !important;
        }

        .very-low {
            background-color: #FFC549 !important;
        }

        .green-moderate {
            background-color: #54CF6E !important;
        }

        .low {
            background-color: #FFDC92 !important;
        }

        .moderate {
            background-color: #8CE3E3 !important;
        }

        .very-high {
            background-color: #108585 !important;
        }



        .age-bar-container {
            display: flex;
            align-items: center;
            margin: 22px 0px 0px;
        }

        .age-bar-container .number {
            color: #5b5b5b;
            font-size: 16px;
            font-weight: 500;
            width: 45px;
        }

        .bar {
            height: 14px;
            border-radius: 8px;
            transition: width 0.3s ease-in-out;
            margin: 0px 8px 0px 16px;
        }

        .blue {
            background-color: #24b3f0;
        }

        .yellow {
            background-color: #ffc549;
        }

        .purple {
            background-color: #bba7f6;
        }

        .cyan,
        .cyan-high {
            background-color: #3fd0d0;
        }

        .grey {
            background-color: #c8c8c9;
        }

        .text-white {
            color: #fff !important;
        }

        .very-low-risk {
            background-color: #7F66CA !important;
        }

        .low-risk {
            background-color: #AA91F4 !important;
        }

        .moderate-risk {
            background-color: #FCCF98 !important;

        }

        .high-risk {
            background-color: #FFC1BB !important;
        }

        .very-high-risk {
            background-color: #FF8277 !important;

        }

        .gender-content {
            display: flex;
            align-items: center;
            gap: 20px;
            justify-content: center;
        }

        .gender-content p,
        .gender .bottom-content p {
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            color: #a0a0a0;
            font-size: 14px;
            font-weight: 500;
            gap: 5px;
        }

        .gender .bottom-content p {
            flex-direction: row;
        }

        .gender .bottom-content {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 50px;
            margin-top: 14px;
        }

        .gender-content span {
            color: #a0a0a0;
            font-size: 20px;
            font-weight: 500;
        }

        .gender-content .svg-icon svg {
            height: 120px;
            width: auto;
        }

        .status .count {
            margin-top: 6px;
        }

        .insight-box {
            position: relative;
            padding: 20px 22px 20px 20px;
            border-radius: 11.2px;
            background: #FFF;
            margin-bottom: 40px;
        }

        .insight-box::before {
            content: "";
            position: absolute;
            top: 0px;
            left: -1.48px;
            right: -1.48px;
            bottom: -4.48px;
            background: rgb(0 0 0 / 10%);
            border-radius: inherit;
            z-index: -1;
        }

        .insight-box .heading p {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #5B5B5B;
            font-size: 19.6px;
            font-style: normal;
            font-weight: 600;
            line-height: normal;
            text-transform: capitalize;
            margin-bottom: 12px;
        }

        .insight-box .desc {
            color: #5B5B5B;
            font-size: 15.8px;
            font-weight: 400;
            line-height: 23.8px;
            margin: 0;
        }

        .insight-box-height-non-level {
            height: 72vh;
        }

        .insight-box-height-level {
            height: 58vh;
        }

        .insight-box-height-level-three {
            height: 76vh;
        }

        .overall-bar {
            margin-top: 15px;
            margin-left: 30px;
            width: 100%;
        }

        .overall-bar .level {
            display: flex;
            align-items: center;
            margin-bottom: 14px;
        }

        .overall-bar .level-label {
            width: 70px;
            color: #5B5B5B;
            font-size: 13px;
            font-weight: 500;
            margin-right: 20px;
        }

        .overall-bar .bar-container {
            display: flex;
            align-items: center;
            height: 18px;
            position: relative;
        }

        .overall-bar .bar {
            height: 100%;
            background-color: #8CE3E3;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #5B5B5B;
            text-align: center;
            font-size: 12px;
            font-weight: 500;
            transition: width 0.5s ease-in-out;
            margin: 0;
            border-radius: 0;
        }

        .overall-bar .small-bar {
            background-color: #1AC2C2;
            color: #5B5B5B;
            text-align: center;
            font-size: 12px;
            font-weight: 500;
            height: 100%;
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .overall-bar .yellow-bar {
            background-color: #FFE4AA;
            color: #5B5B5B;
            text-align: center;
            font-size: 12px;
            font-weight: 500;
            text-align: center;
            height: 100%;
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .overall-bar .count {
            margin-left: 10px;
            color: #A0A0A0;
            font-size: 14px;
            font-weight: 500;
            display: flex;
            align-items: center;
        }

        .overall-bottom {
            padding: 0px;
        }

        .levels-container {
            text-align: right;
        }

        .levels-container p {
            color: #AEAEAE;
            font-size: 14px;
            font-weight: 500;
            text-transform: uppercase;
            margin-right: 100px;
        }

        .levels-buttons {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
        }

        .levels-button {
            background-color: #FCCF98;
            border: none;
            padding: 10px 20px;
            color: #FFF;
            font-size: 12px;
            font-weight: 600;
            text-transform: capitalize;
            cursor: pointer;
            width: 120px;
        }

        .levels-button:nth-child(2),
        .vertical-level-sidebar .level.active-two {
            background-color: #FABB6E;
        }

        .levels-button:nth-child(3),
        .vertical-level-sidebar .level.active-three {
            background-color: #F9A845;
        }

        .levels-button:nth-child(4),
        .vertical-level-sidebar .level.active-four {
            background-color: #F7941C;
        }

        .levels-button:hover {
            opacity: 0.8;
            cursor: pointer;
        }

        .chart-position {
            position: relative;
            top: 100px;
            left: 0px;
        }

       .vertical-level-sidebar {
            position: absolute;
            right: 21px;
            display: flex;
            flex-direction: column;
            gap: 80px;
            width: fit-content;
            transform: translateY(-169%) rotate(180deg);
        }
 
        .vertical-level-sidebar .level {
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            transform: rotate(90deg);
            transform-origin: left center;
            background: #C8C8C9;
            color: #FFF;
            font-size: 18px;
            font-weight: 600;
            text-transform: capitalize;
            padding:0px 18px;
            cursor: pointer;
        }
 

        @php
            $highlightColor = '#FABB6E';
            $levelWords = ['one','two','three','four','five','six','seven','eight','nine','ten'];
        @endphp

        @foreach ($selectedLevels as $level)
            @php
                /* $class = 'active-' . strtolower($levelWords[$level - 1] ?? $level); */
                if (is_numeric($level)) {
                    $class = 'active-' . strtolower($levelWords[$level - 1] ?? $level);
                } else {
                    $class = 'active-' . strtolower($level); // directly use the string level if it's not numeric
                }
            @endphp

            .vertical-level-sidebar .level.{{ $class }} {
                background: {{ $highlightColor }};
            }
        @endforeach

        .level-bottom .overall-bar {
            width: 100%;
            margin-top: 168px;
            margin-left: 0px;
        }

        .level-bottom .overall-bar .level:last-child {
            margin-bottom: 0px;

        }

        .level-bottom .overall-bar .bar {
            border-radius: 4px;
        }

        .level-bottom .overall-bar .level-label {
            color: #5B5B5B;
            font-size: 16px;
            font-weight: 500;
            min-width: 70px;
            white-space: nowrap;

        }

        .all-vertical-line {
            display: block;
            width: 1px;
            background-color: #EBEBEB;
            margin: 100px 0px 20px 0px;
        }

        .all-star-heading {
            color: #5B5B5B;
            font-size: 22px;
            font-weight: 500;
            margin: 32px 0;
            text-align: center
        }

        .all-star h4 {
            margin-bottom: 0;
        }

        .all-star .sub-content {
            color: #AEAEAE;
            font-size: 18px;
            font-weight: 500;
            text-transform: uppercase;
            margin: 0px;
        }

        .all-star-bottom {
            margin-top: 60px;
            margin-bottom: 20px;
        }

        .all-star-bottom .line-content {
            margin-top: 16px;
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .all-star .line-content p {
            color: #5B5B5B;
            font-size: 14px;
            font-weight: 500;
            margin: 0;
            min-width: 120px;
        }

        .all-star .line-content .bar {
            height: 14px;
            border-radius: 8.1px;
            margin: 0;
        }

        .all-star .line-content .bar.highly-aligned {
            background: #AA91F4;
        }

        .all-star .line-content .bar.aligned {
            background: #3FD0D0;
        }

        .all-star .line-content .bar.need-development {
            background: #FFC549;
        }

        .overall-content {
            padding: 0px 58px 40px;
        }

        .overall-content .inner-content {
            display: grid;
            grid-template-columns: 54.7% 26%;
            gap: 50px;
            align-items: flex-end;
            margin-bottom: 14px;
        }

        .overall-content h5 {
            color: #5B5B5B;
            font-size: 22px;
            line-height: 44px;
            margin: 0;
            font-weight: 500;
            margin-bottom: 10px;
        }

        .percentage-container {
            display: flex;
        }

        .overall-content .percentage-container .count {
            justify-content: left;
        }

        .overall-content .percentage {
            font-size: 16px;
            font-weight: 600;
        }

        .overall-content .text-yellow {
            color: #FFC549;
        }

        .overall-content .text-green {
            color: #2AA443;
        }

        .overall-content .text-blue {
            color: #14A6A6;
        }

        .overall-content .progress-bar {
            display: flex;
            background-color: #e0e0e0;
        }

        .overall-content .bar {
            height: 15px;
            width: 100%;
            overflow: hidden;
            margin: 0;
            border-radius: 0;
            margin-top: 6px;
        }

        .overall-content .bar-yellow {
            background-color: #FFC549;
        }

        .overall-content .bar-green {
            background-color: #54CF6E;
        }

        .overall-content .bar-blue {
            background-color: #3FD0D0;
        }

        .overall-content .chart-overall {
            position: relative;
            top: 10px;
        }

        .overall-content .right-content {
            display: flex;
            gap: 20px;
            align-items: flex-end;
        }

        .overall-content .right-content .legend {
            justify-content: left;
            gap: 5px;
        }

        .overall-content .right-content .legend span {
            width: 24px;
            height: 6px;
        }

        .contact-us {
            background-image: url("/images/pdf-images/contact-slide.png");
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
            width: 100%;
            height: 100vh;
            /* margin-top: 23px; */
        }

        .contact-us .content {
            padding: 100px;
        }

        .contact-us .content h2 {
            color: #5B5B5B;
            font-size: 48px;
            font-weight: 500;
            margin-top: 100px;
        }

        .contact-us .content p {
            display: flex;
            align-items: center;
            gap: 20px;
            color: #5B5B5B;
            font-size: 20px;
            font-weight: 500;
            width: 48%;
        }

        .contact-us .content .bottom-content {
            position: relative;
            top: 250px;
            left: -50px;
            font-size: 16px !important;
        }

        .contact-us .content .orange {
            font-size: 24px;
            color: #F7941C;
        }

        /* Spinner Styling */
        .spinner {
            width: 50px;
            height: 50px;
            border: 6px solid #fff;
            border-top: 6px solid transparent;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        a {
            pointer-events: none;
            text-decoration: none;
        }

        .height-side-container {
            height: 96vh;
        }

        /* .height-fixed-bottom {
            height: 55vh;
        } */

        body.no-scroll {
  overflow: hidden;
}

        
    </style>
    @php
        $highlightColor = '#FABB6E';
        $levelWords = ['one','two','three','four','five','six','seven','eight','nine','ten','eleven','twelve','thirteen','fourteen','fifteen'];


        $classes = [];
       
        if (!empty($selectedLevels)) {
            /* foreach ($selectedLevels as $level) {
                $classes[] = '.vertical-level-sidebar .level.active-' . strtolower($levelWords[$level - 1] ?? $level);
            } */
             foreach ($selectedLevels as $level) {
                if (is_numeric($level)) {
                    $index = (int)$level - 1;
                    $label = $levelWords[$index] ?? $level;
                } else {
                    $label = $levelWords[$level] ?? $level;
                }
                $classes[] = '.vertical-level-sidebar .level.active-' . strtolower($label);
            }
        }
    @endphp

    @if (!empty($classes))
        <style>
            {{ implode(', ', $classes) }} {
                background: {{ $highlightColor }};
            }
        </style>
    @endif

</head>

<body>
    {{-- Cover --}}
     @php
    // Are there ANY levels with non-zero data?
        $hasLevelData = !empty($selectedLevels) && collect($selectedLevels)->contains(function ($lvl) use ($chartPositionLevelGroup) {
            $lvl = trim($lvl);
            $bucket = $chartPositionLevelGroup[$lvl] ?? [];
            // Sum every numeric value inside all sub-keys for that level
            return collect($bucket)->flatMap(fn($arr) => is_array($arr) ? $arr : [])->sum() > 0;
        });
    @endphp
    <div class="container">
        <div class="sidebar">
            <a href="#demographics">
                <h3>Demographics</h3>
            </a>
            @if (!in_array(env('DB_DATABASE'), config('client.omr_ta_not_required')))
                <a href="#overall">
                    <h3>Overall Match Rate</h3>
                </a>
                <a href="#technical">
                    <h3>Technical Assessment</h3>
                </a>
            @endif
            <a href="#behavioralFitRate">
                <h3 style="margin-bottom: 6px">Behavioral Fit Rate</h3>
            </a>
            <ul>
                <li><a href="#JobMatchRate">Job Match Rate</a></li>
                <li><a href="#SoftSkillsMatchRate">Soft Skills Match Rate</a></li>
                <li><a href="#GrowthPotential">Growth Potential</a></li>
                <li><a href="#WorkplaceAlignmentForecast">Workplace Alignment Forecast</a></li>
                <li><a href="#FlightRisk">Flight Risk</a></li>
                <li><a href="#OverallCognitiveAbility">Cognitive Ability</a></li>
            </ul>
            <i class="bi bi-house-door home-icon-sidebar" style="color: #3e3e3e"></i>
        </div>
        <div class="main-content">
            <img src="/images/pdf-images/first-bg.png" alt="first-bg" class="middle-img" />
            <div class="first-right">
                <img src="/images/pdf-images/insightaccessLogo.png" alt="Logo" />
                <h1>Aggregated Department Report</h1>
                <div class="first-sub-content">
                    <p class="heading">Report Prepared for:</p>
                    <p class="sub-heading">{{ $title }}</p>
                </div>
                <div class="first-sub-content">
                    <p class="heading">REPORT DATE:</p>
                    <p class="sub-heading">{{ $date }}</p>                
                </div>
            </div>
        </div>
    </div>
    {{-- How to Navigate --}}
    {{-- <div class="container">
        <div class="sidebar">
            <a href="#demographics">
                <h3>Demographics</h3>
            </a>
           @if (!in_array(env('DB_DATABASE'), config('client.omr_ta_not_required')))
                <a href="#overall">
                    <h3>Overall Match Rate</h3>
                </a>
                <a href="#technical">
                    <h3>Technical Assessment</h3>
                </a>
            @endif
            <a href="#behavioralFitRate">
                <h3 style="margin-bottom: 6px">Behavioral Fit Rate</h3>
            </a>
            <ul>
                <li><a href="#JobMatchRate">Job Match Rate</a></li>
                <li><a href="#SoftSkillsMatchRate">Soft Skills Match Rate</a></li>
                <li><a href="#GrowthPotential">Growth Potential</a></li>
                <li><a href="#WorkplaceAlignmentForecast">Workplace Alignment Forecast</a></li>
                <li><a href="#FlightRisk">Flight Risk</a></li>
                <li><a href="#OverallCognitiveAbility">Cognitive Ability</a></li>
            </ul>
            <i class="bi bi-house-door home-icon-sidebar"></i>
        </div>
        <div class="main-content">
            <div class="second-content">
                <h2>How to Navigate</h2>
                <p>
                    Welcome! Here's a quick guide to help you navigate through the
                    document efficiently:
                </p>
                <h6>Sidebar Menu</h6>
                <ul>
                    <li>
                        On the left-hand side, you'll find a sidebar menu that lists all
                        the key sections of the report.
                    </li>
                    <li>
                        Simply click on any section title to jump directly to that part of
                        the report.
                    </li>
                </ul>
                <h6>
                    Home Icon
                    <i class="bi bi-house-door home-icon"></i>
                </h6>
                <ul>
                    <li>At the bottom of the sidebar, you'll see a home icon.</li>
                    <li>
                        Click the home icon at any time to return to the main page or the
                        first page of the report.
                    </li>
                </ul>
                <h6>Scroll and Search</h6>
                <ul>
                    <li>
                        If you prefer to scroll through the document manually, you can
                        still use traditional navigation.
                    </li>
                    <li>
                        Use the search function <b>(Ctrl+F or Cmd+F)</b> to find specific
                        keywords or topics.
                    </li>
                </ul>
            </div>
            <div class="second-right">
                <img src="/images/pdf-images/second-right-bg.png" alt="first-bg" class="second-right-bg" />
            </div>
        </div>
    </div> --}}
    {{-- Demographics  --}}
    <div class="container" id="demographics">
        <div class="sidebar">
            <a href="#demographics">
                <h3 class="active">Demographics</h3>
            </a>
           @if (!in_array(env('DB_DATABASE'), config('client.omr_ta_not_required')))
                <a href="#overall">
                    <h3>Overall Match Rate</h3>
                </a>
                <a href="#technical">
                    <h3>Technical Assessment</h3>
                </a>
            @endif
            <a href="#behavioralFitRate">
                <h3 style="margin-bottom: 6px">Behavioral Fit Rate</h3>
            </a>
            <ul>
                <li><a href="#JobMatchRate">Job Match Rate</a></li>
                <li><a href="#SoftSkillsMatchRate">Soft Skills Match Rate</a></li>
                <li><a href="#GrowthPotential">Growth Potential</a></li>
                <li><a href="#WorkplaceAlignmentForecast">Workplace Alignment Forecast</a></li>
                <li><a href="#FlightRisk">Flight Risk</a></li>
                <li><a href="#OverallCognitiveAbility">Cognitive Ability</a></li>
            </ul>
            {{-- <i class="bi bi-house-door home-icon-sidebar"></i> --}}
        </div>
        <div class="third-body">
            <div class="third-content">
                <div class="third-first">
                    <h4>Demographics</h4>
                    <div class="grey-bg total-employees">
                        <p>{{$numEmployee}} <span>total employees</span></p>
                    </div>
                    <div class="grey-bg gender">
                        <h4 class="heading">Gender</h4>
                        <div class="gender-content">
                            <p>Male <span>{{ $genderData['Male']['percentage']}}%</span></p>
                            <div class="svg-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="77" height="187"
                                    viewBox="0 0 77 187" fill="none">
                                    <path
                                        d="M38.1214 32.001C46.957 32.001 54.1221 24.8376 54.1221 16.001C54.1221 7.16571 46.957 0.000976562 38.1214 0.000976562C29.2844 0.000976562 22.1221 7.16571 22.1221 16.001C22.1221 24.8376 29.2844 32.001 38.1214 32.001Z"
                                        fill="#D9D9D9" />
                                    <mask id="mask0_5601_11903" style="mask-type: luminance" maskUnits="userSpaceOnUse"
                                        x="0" y="36" width="77" height="151">
                                        <path d="M0.257812 36.7432H76.8778V186.27H0.257812V36.7432Z" fill="white" />
                                    </mask>
                                    <g mask="url(#mask0_5601_11903)">
                                        <path
                                            d="M21.1508 36.8037C9.56994 36.8037 0.257812 45.5663 0.257812 56.4946V103.08C0.257812 112.136 14.5435 112.136 14.5435 103.08V60.4859H17.9242V177.118C17.9242 189.226 36.9477 188.87 36.9477 177.118V109.414H40.2234V177.118C40.2234 188.87 59.3505 189.226 59.3505 177.118V60.4859H62.6534V103.08C62.6534 112.206 76.8642 112.206 76.8383 103.08V56.7778C76.8383 46.6991 68.4037 36.8277 55.6891 36.8277L21.1508 36.8062V36.8037Z"
                                            fill="#D9D9D9" />
                                    </g>
                                    <mask id="mask1_5601_11903" style="mask-type: luminance" maskUnits="userSpaceOnUse"
                                        x="0" y="85" width="77" height="102">
                                        <path d="M0.12207 85.001H76.7421V186.541H0.12207V85.001Z" fill="white" />
                                    </mask>
                                    <g mask="url(#mask1_5601_11903)">
                                        <path
                                            d="M21.0151 40.4229C9.4342 40.4229 0.12207 48.9892 0.12207 59.6726V105.215C0.12207 114.068 14.4078 114.068 14.4078 105.215V63.5745H17.7884V177.594C17.7884 189.43 36.8119 189.083 36.8119 177.594V111.407H40.0877V177.594C40.0877 189.083 59.2147 189.43 59.2147 177.594V63.5745H62.5177V105.215C62.5177 114.136 76.7284 114.136 76.7026 105.215V59.9495C76.7026 50.0966 68.268 40.4463 55.5534 40.4463L21.0151 40.4253V40.4229Z"
                                            fill="#6DCCF5" />
                                    </g>
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" width="96" height="187"
                                    viewBox="0 0 96 187" fill="none">
                                    <mask id="mask0_5601_11916" style="mask-type: luminance"
                                        maskUnits="userSpaceOnUse" x="1" y="37" width="95" height="150">
                                        <path d="M1.1748 37.7314H95.2248V186.54H1.1748V37.7314Z" fill="white" />
                                    </mask>
                                    <g mask="url(#mask0_5601_11916)">
                                        <path
                                            d="M94.4767 90.4257L68.1715 42.9566C68.1167 42.8594 68.0483 42.7764 67.9675 42.709C64.7776 37.9664 60.6472 37.8082 60.6472 37.8082C60.6472 37.8082 39.9068 37.9975 35.4617 37.8082C31.9583 37.6592 28.7995 42.2268 27.6189 44.1685C27.5841 44.21 27.553 44.254 27.5243 44.3033L27.3054 44.696C27.1897 44.9034 27.1262 45.0214 27.1262 45.0214L1.88848 90.5631C0.291057 93.4444 1.46673 97.2966 4.50233 99.1229L4.9502 99.3925C7.98331 101.216 11.7741 100.353 13.3715 97.4703L29.4129 71.0974L18.5532 126.674H30.3124V178.302C30.3124 182.818 33.9128 186.514 38.2472 186.514C42.5817 186.514 46.1808 182.818 46.1808 178.302V126.674H50.2117V178.302C50.2117 182.818 53.7686 186.541 58.103 186.541H58.1254C62.4611 186.541 66.0802 182.818 66.0802 178.302V126.674H77.7386L66.9423 70.8822L82.9949 97.329C84.6346 100.288 88.4577 101.215 91.4921 99.3912L91.9387 99.1216C94.9743 97.2966 96.1152 93.3835 94.4767 90.4257Z"
                                            fill="#D9D9D9" />
                                    </g>
                                    <mask id="mask1_5601_11916" style="mask-type: luminance"
                                        maskUnits="userSpaceOnUse" x="32" y="0" width="32" height="32">
                                        <path d="M32 0H64V32H32V0Z" fill="white" />
                                    </mask>
                                    <g mask="url(#mask1_5601_11916)">
                                        <path
                                            d="M47.9594 31.9656C56.7349 31.9656 63.8477 24.8302 63.8477 16.0241C63.8477 7.22043 56.7349 0.0849609 47.9594 0.0849609C39.1851 0.0849609 32.0723 7.22043 32.0723 16.0241C32.0723 24.8302 39.1851 31.9656 47.9594 31.9656Z"
                                            fill="#D9D9D9" />
                                    </g>
                                    <mask id="mask2_5601_11916" style="mask-type: luminance"
                                        maskUnits="userSpaceOnUse" x="0" y="64" width="96" height="123">
                                        <path d="M0.87793 64.541H95.8779V186.541H0.87793V64.541Z" fill="white" />
                                    </mask>
                                    <g mask="url(#mask2_5601_11916)">
                                        <path
                                            d="M95.1222 90.7915L68.5513 43.5025C68.496 43.4056 68.4269 43.323 68.3452 43.2558C65.1232 38.5312 60.951 38.3737 60.951 38.3737C60.951 38.3737 40.0012 38.5622 35.5111 38.3737C31.9724 38.2252 28.7817 42.7755 27.5891 44.7098C27.5539 44.7511 27.5225 44.795 27.4936 44.8441L27.2725 45.2353C27.1556 45.4419 27.0915 45.5594 27.0915 45.5594L1.59881 90.9283C-0.0147443 93.7988 1.1728 97.6363 4.23906 99.4557L4.69146 99.7242C7.75521 101.541 11.5843 100.681 13.1978 97.8093L29.4012 71.5365L18.4318 126.902H30.3098V178.335C30.3098 182.833 33.9466 186.515 38.3248 186.515C42.703 186.515 46.3386 182.833 46.3386 178.335V126.902H50.4101V178.335C50.4101 182.833 54.0029 186.542 58.3812 186.542H58.4038C62.7833 186.542 66.4389 182.833 66.4389 178.335V126.902H78.2151L67.3098 71.3222L83.5245 97.6686C85.1808 100.616 89.0425 101.54 92.1075 99.7229L92.5586 99.4544C95.6249 97.6363 96.7773 93.7381 95.1222 90.7915Z"
                                            fill="#FF8277" />
                                    </g>
                                </svg>
                            </div>
                            <p>Female <span>{{ $genderData['Female']['percentage']}}%</span></p>
                        </div>
                        <div class="bottom-content">
                            <p>
                                {{ $genderData['Male']['count']}} <span><i class="bi bi-person"></i></span>
                            </p>
                            <p>
                                {{ $genderData['Female']['count']}} <span><i class="bi bi-person"></i></span>
                            </p>
                        </div>
                    </div>
                    <div class="grey-bg position-level">
                        <h4 class="heading">Position Levels</h4>
                        <div id="chartPositionLevel"></div>
                    </div>
                </div>
                <div class="third-second">
                    <h4 style="color: #fff">Demographics</h4>
                    <div class="grey-bg assessment-status">
                        <h4 class="heading">Assessment Status</h4>
                        <div class="status">
                            <div>
                                <span>{{$assessmentCompletionStatus['Fully Percentage']}}%</span>
                                <div class="count">{{$assessmentCompletionStatus['Fully Completed']}}<i class="bi bi-person"></i></div>
                            </div>
                            <div class="progress-bar" style="--completed-width: {{ $assessmentCompletionStatus['Fully Percentage'] }}%; --not-completed-width: {{ $assessmentCompletionStatus['Not Fully Percentage'] }}%;">
                                <div class="completed"></div>
                                <div class="not-completed"></div>
                            </div>
                            <div>
                                <span>{{$assessmentCompletionStatus['Not Fully Percentage']}}%</span>
                                <div class="count">{{$assessmentCompletionStatus['Not Fully Completed']}}<i class="bi bi-person"></i></div>
                            </div>
                        </div>

                        <div class="legend">
                            <div><span class="completed-color"></span> Completed</div>
                            <div>
                                <span class="not-completed-color"></span> Not Completed
                            </div>
                        </div>
                    </div>
                    

                    <div class="grey-bg age">
                        <h4 class="heading">Age</h4>
                        <div id="chartAge"></div>
                        <div class="age-chart-container">
                            @php
                                $total = array_sum($ageData);
                                $colors = [
                                    '20-30' => 'blue',
                                    '31-40' => 'yellow',
                                    '41-50' => 'purple',
                                    '50+' => 'cyan'
                                ];
                            @endphp
                     
                            @foreach($ageData as $ageGroup => $count)
                            @if($count > 0)
                                @php
                                    $percentage = max(5, ($count / $total) * 100);
                                @endphp
                                
                                <div class="age-bar-container">
                                    <span class="number">{{ $ageGroup }}</span>
                                    <div class="bar {{ $colors[$ageGroup] }}" style="width: {{ $percentage }}%"></div>
                                    <span class="count">{{ $count }} <i class="bi bi-person"></i></span>
                                </div>
                                @endif

                            @endforeach
                        </div>
                    </div>
                 

                </div>
            </div>
            <div class="footer">
                <div class="left-side">
                    <p>Report Prepared for: {{ $title }}</p>
                    <div class="line"></div>
                    <p>{{ $date }}</p>
                </div>
                <div class="right-side">
                    <p>© CXS Analytics 
                        {{-- /* <span>3</span> */ --}}
                    </p>
                </div>
            </div>
        </div>
    </div>
    {{-- Overall Match Rate --}}
    @if (!in_array(env('DB_DATABASE'), config('client.omr_ta_not_required')))
        <div class="container" id="overall">
            <div class="sidebar">
                <a href="#demographics">
                    <h3>Demographics</h3>
                </a>
                
                <a href="#overall">
                    <h3 class="active">Overall Match Rate</h3>
                </a>
                <a href="#technical">
                    <h3>Technical Assessment</h3>
                </a>
                <a href="#behavioralFitRate">
                    <h3 style="margin-bottom: 6px">Behavioral Fit Rate</h3>
                </a>
                <ul>
                    <li><a href="#JobMatchRate">Job Match Rate</a></li>
                    <li><a href="#SoftSkillsMatchRate">Soft Skills Match Rate</a></li>
                    <li><a href="#GrowthPotential">Growth Potential</a></li>
                    <li><a href="#WorkplaceAlignmentForecast">Workplace Alignment Forecast</a></li>
                    <li><a href="#FlightRisk">Flight Risk</a></li>
                    <li><a href="#OverallCognitiveAbility">Cognitive Ability</a></li>
                </ul>
                {{-- <i class="bi bi-house-door home-icon-sidebar"></i> --}}
            </div>
            <div class="third-body">
                <div class="height-side-container">
                <div class="third-content">
                    <div class="third-first">
                        <h4>Overall Match Rate</h4>
                        <div class="insight-box-height-non-level">
                        <div class="insight-box">
                            <div class="heading">
                                <p><i class="bi bi-lightbulb" style="color: #f7941c"></i> Key Insights</p>
                            </div>
                            <p class="desc">
                                Overall, the department exhibits a moderate alignment with role expectations. The team
                                generally meets the majority of requirements but could benefit from further development and
                                support. Low groups shows significant gaps exist across team capabilities, necessitating
                                comprehensive training and structured development plans. High performers effectively meet
                                responsibilities and contribute meaningfully to departmental success.
                            </p>
                        </div>
                        </div>
                        <div class="legend" style="justify-content: left;  margin: 0px 100px 0px 0px;">
                            <div>
                                <span class="yellow"></span> Very Low
                            </div>
                            <div>
                                <span class="low"></span> Low
                            </div>
                            <div>
                                <span class="moderate"></span> Moderate
                            </div>
                            <div><span class="completed-color"></span> High</div>
                            <div>
                                <span class="very-high"></span> Very High
                            </div>
                        </div>
                    </div>
                   <div class="third-second level-bottom">
                        <div id="chartOverallMatchRate" class="chart-position"></div>
                  

@php
    $omrLevelCounts = $omrLevelCounts ?? []; // Get omrLevelCounts data passed from controller
    $levelLabels = ['Very Low', 'Low', 'Moderate', 'High', 'Very High'];
    $labelColors = [
        'Very Low' => '#FFC549',
        'Low' => '#FFDC92',
        'Moderate' => '#8CE3E3',
        'High' => '#1AC2C2',
        'Very High' => '#108585'
    ];
    $levelLabelsMap = [
        'Very Low' => 'VeryLow',
        'Low' => 'Low',
        'Moderate' => 'Moderate',
        'High' => 'High',
        'Very High' => 'VeryHigh'
    ];
@endphp

<div class="overall-bottom">
    <div class="overall-bar">
        @foreach ($levelLabels as $label)
            @php
                $key = $levelLabelsMap[$label]; // Map the label to the correct key in the omrLevelCounts array
                $totalCount = $omrLevelCounts[$key] ?? 0; // Get the total count for the current label
                $width = $totalCount > 0 ? min(3 * strlen((string) $totalCount), 10) . 'vw' : '0px'; // Bar width logic
                $barClass = strtolower(str_replace(' ', '-', $label)); // Class name for styling
            @endphp

            <div class="level">
                <div class="level-label">{{ $label }}</div>
                <div class="bar-container">
                    <div class="bar {{ $barClass }}" style="width: {{ $width }}; background-color: {{ $labelColors[$label] ?? '#ccc' }};"></div>
                </div>
                <div class="count">{{ $totalCount }} <i class="bi bi-person"></i></div>
            </div>
        @endforeach
    </div>
</div>



{{-- @endif --}}
                    </div>
                </div>
                {{-- <div class="levels-container" style="margin-top: 83px !important;">
                    <p>Explore more in depth by navigating position level</p>
                    @php
                        $levelWords = ['One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine', 'Ten', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen'];
                    @endphp

                    <div class="levels-buttons">
                        @foreach ($selectedLevels as $level)
                            @php
                                $level = trim($level);
                                $word = $levelWords[$level - 1] ?? $level;
                                $anchorId = 'overallLevel' . $word;
                            @endphp
                            <button class="levels-button" onclick="location.href='#{{ $anchorId }}'">
                                Level {{ $level }}
                            </button>
                        @endforeach
                    </div>
                </div> --}}
                <div class="footer">
                    <div class="left-side">
                        <p>Report Prepared for: {{ $title }}</p>
                        <div class="line"></div>
                        <p>{{ $date }}</p>
                    </div>
                    <div class="right-side">
                        <p>© CXS Analytics 
                        {{-- /* <span>4</span> */ --}}
                    </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

        @php
            $levelLabels = ['Very Low', 'Low', 'Moderate', 'High', 'Very High'];
            $labelColors = [
                'Very Low' => '#FFC549',
                'Low' => '#FFDC92',
                'Moderate' => '#8CE3E3',
                'High' => '#1AC2C2',
                'Very High' => '#108585'
            ];
            $levelWords = ['One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine', 'Ten', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen'];
        @endphp
        @if($hasLevelData)
        @foreach ($selectedLevels as $i => $level)
            @php
                $level = trim($level);
                $word = $levelWords[$level - 1] ?? $level;
                $levelKey = 'overallLevel' . $word;
                $chartId = 'chartOverallMatchRateLevel' . $word;
                $data = $chartPositionLevelGroup[$level]['omr'] ?? [];
                $total = array_sum($data);
                $activeClass = 'active-' . strtolower($word);
            @endphp

            @php
                $filteredData = array_filter($data, function ($value, $key) {
                    return $key !== 'Technical Assessment Not Completed';
                }, ARRAY_FILTER_USE_BOTH);

                $omrCharts[] = [
                    'id' => $chartId,
                    'labels' => array_keys($filteredData),
                    'values' => array_values($filteredData),
                    'colors' => collect(array_keys($filteredData))
                                    ->map(fn($label) => $labelColors[$label] ?? '#ccc')
                                    ->toArray(),
                    'total' => array_sum($filteredData),
                ];
            @endphp

            <div class="container" id="{{ $levelKey }}">
                <div class="sidebar">
                    <a href="#demographics"><h3>Demographics</h3></a>
                    <a href="#overall"><h3 class="active">Overall Match Rate</h3></a>
                    <a href="#technical"><h3>Technical Assessment</h3></a>
                    <a href="#behavioralFitRate"><h3 style="margin-bottom: 6px">Behavioral Fit Rate</h3></a>
                    <ul>
                        <li><a href="#JobMatchRate">Job Match Rate</a></li>
                        <li><a href="#SoftSkillsMatchRate">Soft Skills Match Rate</a></li>
                        <li><a href="#GrowthPotential">Growth Potential</a></li>
                        <li><a href="#WorkplaceAlignmentForecast">Workplace Alignment Forecast</a></li>
                        <li><a href="#FlightRisk">Flight Risk</a></li>
                        <li><a href="#OverallCognitiveAbility">Cognitive Ability</a></li>
                    </ul>
                    {{-- <i class="bi bi-house-door home-icon-sidebar"></i> --}}
                </div>

                <div class="third-body">
                    <div class="third-content">
                        <div class="third-first">
                            <div class="level-heading">
                                <h4>Overall Match Rate</h4>
                                <h6>Job Position: <span>Level {{ $level }}</span></h6>
                            </div>
                         <div class="insight-box-height-level">
                            <div class="insight-box">
                                <div class="heading">
                                    <p><i class="bi bi-lightbulb" style="color: #f7941c"></i> Key Insights</p>
                                </div>
                                <p class="desc">
                                    Moderate category suggests that while the team meets the majority of requirements, there is
                                    significant potential for growth. Employees are generally capable but may need further skill
                                    development to fully align with organizational goals. Targeted initiatives such as
                                    specialized training, mentorship, and role enrichment could enhance competencies and prevent
                                    stagnation, ensuring the team is better prepared for evolving demands.
                                </p>
                            </div>
                        </div>

                            <div class="level-spacer"></div>

                            <div class="legend" style="justify-content: left;  margin: 0px 100px 0px 0px;">
                                <div><span class="yellow"></span> Very Low</div>
                                <div><span class="low"></span> Low</div>
                                <div><span class="moderate"></span> Moderate</div>
                                <div><span class="completed-color"></span> High</div>
                                <div><span class="very-high"></span> Very High</div>
                            </div>
                        </div>

                        <div class="third-second level-bottom">
                            <div id="{{ $chartId }}" class="chart-position"></div>

                            <div class="overall-bottom">
                                <div class="overall-bar">
                                    @foreach ($levelLabels as $label)
                                        @php
                                            $count = $data[$label] ?? 0;
                                            $width = $count > 0 ? min(3 * strlen((string)$count), 10) . 'vw' : '0px';
                                            $barClass = strtolower(str_replace(' ', '-', $label));
                                        @endphp

                                        <div class="level">
                                            <div class="level-label">{{ $label }}</div>
                                            <div class="bar-container">
                                                <div class="bar {{ $barClass }}" style="width: {{ $width }};"></div>
                                            </div>
                                            <div class="count">{{ $count }} <i class="bi bi-person"></i></div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="vertical-level-sidebar">
                        @foreach (array_reverse($selectedLevels) as $sideLevel)
                            @php
                                $sideWord = $levelWords[$sideLevel - 1] ?? $sideLevel;
                                $sideId = 'overallLevel' . $sideWord;
                                $sideClass = $sideLevel == $level ? 'active-' . strtolower($sideWord) : '';
                            @endphp
                            <div class="level {{ $sideClass }}" onclick="location.href='#{{ $sideId }}'">
                                Level {{ $sideLevel }}
                            </div>
                        @endforeach
                    </div>

                    <div class="footer">
                        <div class="left-side">
                            <p>Report Prepared for: {{ $title }}</p>
                            <div class="line"></div>
                            <p>{{ $date }}</p>
                        </div>
                        <div class="right-side">
                            <p>© CXS Analytics 
                                {{-- /* <span>{{ $loop->iteration + 4 }}</span> */ --}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        @endif
    @endif

    {{-- Technical Assessment --}}
    @if (!in_array(env('DB_DATABASE'), config('client.omr_ta_not_required')))
        <div class="container" id="technical">
            <div class="sidebar">
                <a href="#demographics">
                    <h3>Demographics</h3>
                </a>
                <a href="#overall">
                    <h3>Overall Match Rate</h3>
                </a>
                <a href="#technical">
                    <h3 class="active">Technical Assessment</h3>
                </a>
                <a href="#behavioralFitRate">
                    <h3 style="margin-bottom: 6px">Behavioral Fit Rate</h3>
                </a>
                <ul>
                    <li><a href="#JobMatchRate">Job Match Rate</a></li>
                    <li><a href="#SoftSkillsMatchRate">Soft Skills Match Rate</a></li>
                    <li><a href="#GrowthPotential">Growth Potential</a></li>
                    <li><a href="#WorkplaceAlignmentForecast">Workplace Alignment Forecast</a></li>
                    <li><a href="#FlightRisk">Flight Risk</a></li>
                    <li><a href="#OverallCognitiveAbility">Cognitive Ability</a></li>
                </ul>
                {{-- <i class="bi bi-house-door home-icon-sidebar"></i> --}}
            </div>
            <div class="third-body">
                <div class="third-content">
                    <div class="third-first">
                        <h4>Technical Assessment</h4>
                        <div class="insight-box-height-non-level">
                            <div class="insight-box">
                                <div class="heading">
                                    <p><i class="bi bi-lightbulb" style="color: #f7941c"></i> Key Insights</p>
                                </div>
                                <p class="desc">
                                    ​Overall, the department demonstrates an adequate understanding of technical concepts, some
                                    areas may lack depth or specialization. Low and very low categories needs focused training
                                    and development programs that are necessary to bring the department’s skill set in line with
                                    job requirements and ensure improved performance in technical tasks. High and very high
                                    performers can serve as valuable mentors to help elevate the skills of their peers
                                </p>
                            </div>
                        </div>
                        <div class="legend" style="justify-content: left;  margin: 0px 100px 0px 0px;">
                            <div>
                                <span class="yellow"></span> Very Low
                            </div>
                            <div>
                                <span class="low"></span> Low
                            </div>
                            <div>
                                <span class="moderate"></span> Moderate
                            </div>
                            <div><span class="completed-color"></span> High</div>
                            <div>
                                <span class="very-high"></span> Very High
                            </div>
                        </div>
                    </div>
                    <div class="third-second level-bottom">
                        <div id="chartTechnicalAssessment" class="chart-position"></div>
                        {{-- @if($hasLevelData)
                        <div class="overall-bottom">
                    <div class="overall-bar">
                        @foreach ($selectedLevels as $level)
                            @php
                                $level = trim($level);
                                $levelData = $chartPositionLevelGroup[$level]['ta'] ?? [];
                                $total = array_sum($levelData);
                            @endphp
                        
                        <div class="level">
                            <div class="level-label">Level {{ $level }}</div>
                        
                            @php
                                $labelColors = [
                                    'Very Low' => '#FFC549',
                                    'Low' => '#FFDC92',
                                    'Moderate' => '#8CE3E3',
                                    'High' => '#1AC2C2',
                                    'Very High' => '#108585',
                                ];
                        
                                $maxBarWidthVW = 10;
                            @endphp
                        
                            @foreach (['Very Low', 'Low', 'Moderate', 'High', 'Very High'] as $label)
                                @php
                                    $count = $levelData[$label] ?? 0;
                                @endphp
                        
                                @if ($count > 0)
                                    @php

                                        $digitCount = strlen((string) $count);
                        
                                        $widthFactor = [
                                            1 => 3, 
                                            2 => 6,  
                                            3 => 10, 
                                        ];
                        
                                        $barWidth = ($widthFactor[$digitCount] ?? $maxBarWidthVW) . 'vw';
                        
                                        $id = \Illuminate\Support\Str::camel($label) . 'Ta';
                                        $color = $labelColors[$label] ?? '#ccc';
                                    @endphp
                        
                                    <div class="bar-container">
                                        <div class="bar" id="{{ $id }}" style="width: {{ $barWidth }}; background-color: {{ $color }};">
                                            {{ $count }}
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        
                            <div class="count">{{ $total }} <i class="bi bi-person"></i></div>
                        </div>
                        
                        
                        @endforeach
                    </div>
                </div>
                @endif --}}
               
@php
    $taLevelCounts = $taLevelCounts ?? []; // Get taLevelCounts data passed from controller
    $levelLabels = ['Very Low', 'Low', 'Moderate', 'High', 'Very High'];
    $labelColors = [
        'Very Low' => '#FFC549',
        'Low' => '#FFDC92',
        'Moderate' => '#8CE3E3',
        'High' => '#1AC2C2',
        'Very High' => '#108585'
    ];
    $levelLabelsMap = [
        'Very Low' => 'VeryLow',
        'Low' => 'Low',
        'Moderate' => 'Moderate',
        'High' => 'High',
        'Very High' => 'VeryHigh'
    ];
@endphp

<div class="overall-bottom">
    <div class="overall-bar">
        @foreach ($levelLabels as $label)
            @php
                // Map the label to the corresponding key in taLevelCounts
                $key = $levelLabelsMap[$label];
                // Get the total count for the current level, default to 0 if not available
                $totalCount = $taLevelCounts[$key] ?? 0;
                // Calculate the width of the bar based on the count
                $width = $totalCount > 0 ? min(3 * strlen((string) $totalCount), 10) . 'vw' : '0px';
                // Convert label into a class name for the bar
                $barClass = strtolower(str_replace(' ', '-', $label));
            @endphp

            <div class="level">
                <div class="level-label">{{ $label }}</div>
                <div class="bar-container">
                    <div class="bar {{ $barClass }}" style="width: {{ $width }}; background-color: {{ $labelColors[$label] ?? '#ccc' }};"></div>
                </div>
                <div class="count">{{ $totalCount }} <i class="bi bi-person"></i></div>
            </div>
        @endforeach
    </div>
</div>


                    </div>
                </div>
                {{-- <div class="levels-container" style="margin-top: 83px !important;">
                    <p>Explore more in depth by navigating position level</p>
                    @php
                        $levelWords = ['One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine', 'Ten', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen'];
                    @endphp

                    <div class="levels-buttons">
                        @foreach ($selectedLevels as $level)
                            @php
                                $level = trim($level);
                                $word = $levelWords[$level - 1] ?? $level; // fallback just in case
                                $anchorId = 'technical' . $word;
                            @endphp
                            <button class="levels-button" onclick="location.href='#{{ $anchorId }}'">
                                Level {{ $level }}
                            </button>
                        @endforeach
                    </div>
                </div> --}}
                <div class="footer">
                    <div class="left-side">
                        <p>Report Prepared for: {{ $title }}</p>
                        <div class="line"></div>
                        <p>{{ $date }}</p>
                    </div>
                    <div class="right-side">
                        <p>© CXS Analytics 
                        {{-- /* <span>13</span> */ --}}
                    </p>
                    </div>
                </div>
            </div>
        </div>

        @php
            $levelLabels = ['Very Low', 'Low', 'Moderate', 'High', 'Very High'];
            $labelColors = [
                'Very Low' => '#FFC549',
                'Low' => '#FFDC92',
                'Moderate' => '#8CE3E3',
                'High' => '#1AC2C2',
                'Very High' => '#108585'
            ];
            $levelWords = ['One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine', 'Ten', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen'];
        @endphp
        @if($hasLevelData)
        @foreach ($selectedLevels as $i => $level)
            @php
                $level = trim($level);
                $word = $levelWords[$level - 1] ?? $level;
                $levelKey = 'technical' . $word;
                $chartId = 'chartTechnicalAssessment' . $word;
                $data = $chartPositionLevelGroup[$level]['ta'] ?? [];
                $total = array_sum($data);
                $activeClass = 'active-' . strtolower($word);
            @endphp

            @php

                $filteredData = array_filter($data, function ($value, $key) {
                    return $key !== 'Technical Assessment Not Completed';
                }, ARRAY_FILTER_USE_BOTH);

                $taCharts[] = [
                    'id' => $chartId,
                    'labels' => array_keys(array_filter($filteredData)),
                    'values' => array_values(array_filter($filteredData)),
                    'colors' => collect(array_keys(array_filter($filteredData)))
                                    ->map(fn($label) => $labelColors[$label] ?? '#ccc')
                                    ->toArray(),
                    'total' => array_sum($filteredData),
                ];
            @endphp

            <div class="container" id="{{ $levelKey }}">
                <div class="sidebar">
                    <a href="#demographics"><h3>Demographics</h3></a>
                    <a href="#overall"><h3>Overall Match Rate</h3></a>
                    <a href="#technical"><h3 class="active">Technical Assessment</h3></a>
                    <a href="#behavioralFitRate"><h3 style="margin-bottom: 6px">Behavioral Fit Rate</h3></a>
                    <ul>
                        <li><a href="#JobMatchRate">Job Match Rate</a></li>
                        <li><a href="#SoftSkillsMatchRate">Soft Skills Match Rate</a></li>
                        <li><a href="#GrowthPotential">Growth Potential</a></li>
                        <li><a href="#WorkplaceAlignmentForecast">Workplace Alignment Forecast</a></li>
                        <li><a href="#FlightRisk">Flight Risk</a></li>
                        <li><a href="#OverallCognitiveAbility">Cognitive Ability</a></li>
                    </ul>
                    {{-- <i class="bi bi-house-door home-icon-sidebar"></i> --}}
                </div>

                <div class="third-body">
                    <div class="third-content">
                        <div class="third-first">
                            <div class="level-heading">
                                <h4>Technical Assessment</h4>
                                <h6>Job Position: <span>Level {{ $level }}</span></h6>
                            </div>
                        <div class="insight-box-height-level">
                            <div class="insight-box">
                                <div class="heading">
                                    <p><i class="bi bi-lightbulb" style="color: #f7941c"></i> Key Insights</p>
                                </div>
                                <p class="desc">
                                    ​The department shows a generally adequate understanding of technical concepts. While the
                                    majority meet the basic technical requirements of their roles, there is an opportunity to
                                    deepen and specialize their knowledge through targeted training and mentoring. High
                                    performers can serve as valuable mentors to help elevate the skills of their peers, while
                                    the low and very low ranges may require additional support to meet role expectations.
                                </p>
                            </div>
                            </div>

                            <div class="level-spacer"></div>

                            <div class="legend" style="justify-content: left;  margin: 0px 100px 0px 0px;">
                                <div><span class="yellow"></span> Very Low</div>
                                <div><span class="low"></span> Low</div>
                                <div><span class="moderate"></span> Moderate</div>
                                <div><span class="completed-color"></span> High</div>
                                <div><span class="very-high"></span> Very High</div>
                            </div>
                        </div>

                        <div class="third-second level-bottom">
                            <div id="{{ $chartId }}" class="chart-position"></div>

                            <div class="overall-bottom">
                                <div class="overall-bar">
                                    @foreach ($levelLabels as $label)
                                        @php
                                            $count = $data[$label] ?? 0;
                                            $width = $count > 0 ? min(3 * strlen((string)$count), 10) . 'vw' : '0px';
                                            $barClass = strtolower(str_replace(' ', '-', $label));
                                        @endphp

                                        <div class="level">
                                            <div class="level-label">{{ $label }}</div>
                                            <div class="bar-container">
                                                <div class="bar {{ $barClass }}" style="width: {{ $width }};"></div>
                                            </div>
                                            <div class="count">{{ $count }} <i class="bi bi-person"></i></div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="vertical-level-sidebar">
                        @foreach (array_reverse($selectedLevels) as $sideLevel)
                            @php
                                $sideWord = $levelWords[$sideLevel - 1] ?? $sideLevel;
                                $sideId = 'technical' . $sideWord;
                                $sideClass = $sideLevel == $level ? 'active-' . strtolower($sideWord) : '';
                            @endphp
                            <div class="level {{ $sideClass }}" onclick="location.href='#{{ $sideId }}'">
                                Level {{ $sideLevel }}
                            </div>
                        @endforeach
                    </div>

                    <div class="footer">
                        <div class="left-side">
                            <p>Report Prepared for: {{ $title }}</p>
                            <div class="line"></div>
                            <p>{{ $date }}</p>
                        </div>
                        <div class="right-side">
                            <p>© CXS Analytics 
                                {{-- /* <span><span>{{ $loop->iteration + 4 }}</span></span> */ --}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        @endif
        
    @endif

    {{-- Behavioral Fit Rate --}}
    <div class="container" id="behavioralFitRate">
        <div class="sidebar">
            <a href="#demographics">
                <h3>Demographics</h3>
            </a>
           @if (!in_array(env('DB_DATABASE'), config('client.omr_ta_not_required')))
                <a href="#overall">
                    <h3>Overall Match Rate</h3>
                </a>
                <a href="#technical">
                    <h3>Technical Assessment</h3>
                </a>
            @endif
            <a href="#behavioralFitRate">
                <h3 class="active" style="margin-bottom: 6px">Behavioral Fit Rate</h3>
            </a>
            <ul>
                <li><a href="#JobMatchRate">Job Match Rate</a></li>
                <li><a href="#SoftSkillsMatchRate">Soft Skills Match Rate</a></li>
                <li><a href="#GrowthPotential">Growth Potential</a></li>
                <li><a href="#WorkplaceAlignmentForecast">Workplace Alignment Forecast</a></li>
                <li><a href="#FlightRisk">Flight Risk</a></li>
                <li><a href="#OverallCognitiveAbility">Cognitive Ability</a></li>
            </ul>
            {{-- <i class="bi bi-house-door home-icon-sidebar"></i> --}}
        </div>
        <div class="third-body">
            <div class="third-content">
                <div class="third-first">
                    <h4>Behavioral Fit Rate</h4>
                    <div class="insight-box-height-non-level">
                    <div class="insight-box">
                        <div class="heading">
                            <p><i class="bi bi-lightbulb" style="color: #f7941c"></i> Key Insights</p>
                        </div>
                        <p class="desc">
                            Overall, the department's collective behavioral traits demonstrates a moderate alignment in
                            behavioral traits, meeting many role expectations and adapting reasonably well to team
                            dynamics but there is small segment that may needs development to adapt to team dynamics or
                            meet behavioral standards. Focused coaching and structured training initiatives will be
                            essential to improve team dynamics and ensure better alignment with organizational goals
                            over time.
                        </p>
                    </div>
                    </div>
                    <div class="legend" style="justify-content: left;  margin: 0px 100px 0px 0px;">
                        <div>
                            <span class="yellow"></span> Very Low
                        </div>
                        <div>
                            <span class="low"></span> Low
                        </div>
                        <div>
                            <span class="moderate"></span> Moderate
                        </div>
                        <div><span class="completed-color"></span> High</div>
                        <div>
                            <span class="very-high"></span> Very High
                        </div>
                    </div>
                </div>
                <div class="third-second level-bottom">
                    <div id="chartBehavioralFitRate" class="chart-position"></div>
                    {{-- @if($hasLevelData)
                    <div class="overall-bottom">
                <div class="overall-bar">
                    @foreach ($selectedLevels as $level)
                        @php
                            $level = trim($level);
                            $levelData = $chartPositionLevelGroup[$level]['bfr'] ?? [];
                            $total = array_sum($levelData);
                        @endphp
                    
                    <div class="level">
                        <div class="level-label">Level {{ $level }}</div>
                    
                        @php
                            $labelColors = [
                                'Very Low' => '#FFC549',
                                'Low' => '#FFDC92',
                                'Moderate' => '#8CE3E3',
                                'High' => '#1AC2C2',
                                'Very High' => '#108585',
                            ];
                    
                            $maxBarWidthVW = 10;
                        @endphp
                    
                        @foreach (['Very Low', 'Low', 'Moderate', 'High', 'Very High'] as $label)
                            @php
                                $count = $levelData[$label] ?? 0;
                            @endphp
                    
                            @if ($count > 0)
                                @php

                                    $digitCount = strlen((string) $count);
                    
                                    $widthFactor = [
                                        1 => 3, 
                                        2 => 6,  
                                        3 => 10, 
                                    ];
                    
                                    $barWidth = ($widthFactor[$digitCount] ?? $maxBarWidthVW) . 'vw';
                    
                                    $id = \Illuminate\Support\Str::camel($label) . 'Bfr';
                                    $color = $labelColors[$label] ?? '#ccc';
                                @endphp
                    
                                <div class="bar-container">
                                    <div class="bar" id="{{ $id }}" style="width: {{ $barWidth }}; background-color: {{ $color }};">
                                        {{ $count }}
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    
                        <div class="count">{{ $total }} <i class="bi bi-person"></i></div>
                    </div>
                    
                    
                    @endforeach
                </div>
            </div>
            @endif --}}

@php
    $bfrLevelCounts = $bfrLevelCounts ?? []; // Get bfrLevelCounts data passed from controller
    $levelLabels = ['Very Low', 'Low', 'Moderate', 'High', 'Very High'];
    $labelColors = [
        'Very Low' => '#FFC549',
        'Low' => '#FFDC92',
        'Moderate' => '#8CE3E3',
        'High' => '#1AC2C2',
        'Very High' => '#108585'
    ];
    $levelLabelsMap = [
        'Very Low' => 'VeryLow',
        'Low' => 'Low',
        'Moderate' => 'Moderate',
        'High' => 'High',
        'Very High' => 'VeryHigh'
    ];
@endphp

<div class="overall-bottom">
    <div class="overall-bar">
        @foreach ($levelLabels as $label)
            @php
                // Map label to the corresponding key in the bfrLevelCounts array
                $key = $levelLabelsMap[$label];
                // Get the total count for the current level, default to 0 if not available
                $totalCount = $bfrLevelCounts[$key] ?? 0;
                // Calculate the width of the bar based on the count
                $width = $totalCount > 0 ? min(3 * strlen((string) $totalCount), 10) . 'vw' : '0px';
                // Convert label into a class name for the bar
                $barClass = strtolower(str_replace(' ', '-', $label));
            @endphp

            <div class="level">
                <div class="level-label">{{ $label }}</div> <!-- Showing "Very High ka Very High" -->
                <div class="bar-container">
                    <div class="bar {{ $barClass }}" style="width: {{ $width }}; background-color: {{ $labelColors[$label] ?? '#ccc' }};"></div>
                </div>
                <div class="count">{{ $totalCount }} <i class="bi bi-person"></i></div>
            </div>
        @endforeach
    </div>
</div>



                </div>
            </div>
            
            {{-- <div class="levels-container" style="margin-top: 83px !important;">
                <p>Explore more in depth by navigating position level</p>
                @php
                    $levelWords = ['One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine', 'Ten', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen'];
                @endphp

                <div class="levels-buttons">
                    @foreach ($selectedLevels as $level)
                        @php
                            $level = trim($level);
                            $word = $levelWords[$level - 1] ?? $level; // fallback just in case
                            $anchorId = 'behavioralFitRate' . $word;
                        @endphp
                        <button class="levels-button" onclick="location.href='#{{ $anchorId }}'">
                            Level {{ $level }}
                        </button>
                    @endforeach
                </div>
            </div> --}}
            <div class="footer">
                <div class="left-side">
                    <p>Report Prepared for: {{ $title }}</p>
                    <div class="line"></div>
                    <p>{{ $date }}</p>
                </div>
                <div class="right-side">
                    <p>© CXS Analytics 
                        {{-- /* <span>18</span> */ --}}
                    </p>
                </div>
            </div>
        </div>
    </div>
    
    @php
        $levelLabels = ['Very Low', 'Low', 'Moderate', 'High', 'Very High'];
        $labelColors = [
            'Very Low' => '#FFC549',
            'Low' => '#FFDC92',
            'Moderate' => '#8CE3E3',
            'High' => '#1AC2C2',
            'Very High' => '#108585'
        ];
        $levelWords = ['One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine', 'Ten', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen'];
    @endphp
    @if($hasLevelData)
    @foreach ($selectedLevels as $i => $level)
        @php
            $level = trim($level);
            $word = $levelWords[$level - 1] ?? $level;
            $levelKey = 'behavioralFitRate' . $word;
            $chartId = 'chartBehavioralFitRate' . $word;
            $data = $chartPositionLevelGroup[$level]['bfr'] ?? [];
            $total = array_sum($data);
            $activeClass = 'active-' . strtolower($word);
        @endphp

        @php

            $filteredData = array_filter($data, function ($value, $key) {
                return $key !== 'Data Not Available';
            }, ARRAY_FILTER_USE_BOTH);

            $bfrCharts[] = [
                'id' => $chartId,
                'labels' => array_keys(array_filter($filteredData)),
                'values' => array_values(array_filter($filteredData)),
                'colors' => collect(array_keys(array_filter($filteredData)))
                                ->map(fn($label) => $labelColors[$label] ?? '#ccc')
                                ->toArray(),
                'total' => array_sum($filteredData),
            ];
        @endphp

        <div class="container" id="{{ $levelKey }}">
            <div class="sidebar">
                <a href="#demographics"><h3>Demographics</h3></a>
                <a href="#overall"><h3>Overall Match Rate</h3></a>
                <a href="#technical"><h3>Technical Assessment</h3></a>
                <a href="#behavioralFitRate"><h3 class="active" style="margin-bottom: 6px">Behavioral Fit Rate</h3></a>
                <ul>
                    <li><a href="#JobMatchRate">Job Match Rate</a></li>
                    <li><a href="#SoftSkillsMatchRate">Soft Skills Match Rate</a></li>
                    <li><a href="#GrowthPotential">Growth Potential</a></li>
                    <li><a href="#WorkplaceAlignmentForecast">Workplace Alignment Forecast</a></li>
                    <li><a href="#FlightRisk">Flight Risk</a></li>
                    <li><a href="#OverallCognitiveAbility">Cognitive Ability</a></li>
                </ul>
                {{-- <i class="bi bi-house-door home-icon-sidebar"></i> --}}
            </div>

            <div class="third-body">
                <div class="third-content">
                    <div class="third-first">
                        <div class="level-heading">
                            <h4>Behavioral Fit Rate</h4>
                            <h6>Job Position: <span>Level {{ $level }}</span></h6>
                        </div>
                    <div class="insight-box-height-level">
                        <div class="insight-box">
                            <div class="heading">
                                <p><i class="bi bi-lightbulb" style="color: #f7941c"></i> Key Insights</p>
                            </div>
                            <p class="desc">
                                ​Employees meet many behavioural requirements and adapt reasonably well to team dynamics, there is an opportunity to improve collaboration, communication, and alignment with organizational values. Focusing on enhancing interpersonal skills, emotional intelligence, and teamwork can strengthen relationships within the department and foster a more cohesive, high-performing team.
                            </p>
                        </div>
                        </div>

                        <div class="level-spacer"></div>

                        <div class="legend" style="justify-content: left;  margin: 0px 100px 0px 0px;">
                            <div><span class="yellow"></span> Very Low</div>
                            <div><span class="low"></span> Low</div>
                            <div><span class="moderate"></span> Moderate</div>
                            <div><span class="completed-color"></span> High</div>
                            <div><span class="very-high"></span> Very High</div>
                        </div>
                    </div>

                    <div class="third-second level-bottom">
                        <div id="{{ $chartId }}" class="chart-position"></div>

                        <div class="overall-bottom">
                            <div class="overall-bar">
                                @foreach ($levelLabels as $label)
                                    @php
                                        $count = $data[$label] ?? 0;
                                        $width = $count > 0 ? min(3 * strlen((string)$count), 10) . 'vw' : '0px';
                                        $barClass = strtolower(str_replace(' ', '-', $label));
                                    @endphp

                                    <div class="level">
                                        <div class="level-label">{{ $label }}</div>
                                        <div class="bar-container">
                                            <div class="bar {{ $barClass }}" style="width: {{ $width }};"></div>
                                        </div>
                                        <div class="count">{{ $count }} <i class="bi bi-person"></i></div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="vertical-level-sidebar">
                    @foreach (array_reverse($selectedLevels) as $sideLevel)
                        @php
                            $sideWord = $levelWords[$sideLevel - 1] ?? $sideLevel;
                            $sideId = 'behavioralFitRate' . $sideWord;
                            $sideClass = $sideLevel == $level ? 'active-' . strtolower($sideWord) : '';
                        @endphp
                        <div class="level {{ $sideClass }}" onclick="location.href='#{{ $sideId }}'">
                            Level {{ $sideLevel }}
                        </div>
                    @endforeach
                </div>

                <div class="footer">
                    <div class="left-side">
                        <p>Report Prepared for: {{ $title }}</p>
                        <div class="line"></div>
                        <p>{{ $date }}</p>
                    </div>
                    <div class="right-side">
                        <p>© CXS Analytics 
                            {{-- /* <span>{{ $loop->iteration + 4 }}</span> */ --}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    @endif

    {{-- Job Match Rate --}}
    <div class="container" id="JobMatchRate">
        <div class="sidebar">
            <a href="#demographics">
                <h3>Demographics</h3>
            </a>
           @if (!in_array(env('DB_DATABASE'), config('client.omr_ta_not_required')))
                <a href="#overall">
                    <h3>Overall Match Rate</h3>
                </a>
                <a href="#technical">
                    <h3>Technical Assessment</h3>
                </a>
            @endif
            <a href="#behavioralFitRate">
                <h3 style="margin-bottom: 6px">Behavioral Fit Rate</h3>
            </a>
            <ul>
                <a href="#JobMatchRate">
                    <li class="active">Job Match Rate</li>
                </a>
                <a href="#SoftSkillsMatchRate">
                    <li>Soft Skills Match Rate</li>
                </a>
                <a href="#GrowthPotential">
                    <li>Growth Potential</li>
                </a>
                <a href="#WorkplaceAlignmentForecast">
                    <li>Workplace Alignment Forecast</li>
                </a>
                <a href="#FlightRisk">
                    <li>Flight Risk</li>
                </a>
                <a href="#OverallCognitiveAbility">
                    <li>Cognitive Ability</li>
                </a>
            </ul>
            {{-- <i class="bi bi-house-door home-icon-sidebar"></i> --}}
        </div>
        <div class="third-body">
            <div class="third-content">
                <div class="third-first">
                    <h4>Job Match Rate</h4>
                    <div class="insight-box-height-non-level">
                    <div class="insight-box">
                        <div class="heading">
                            <p><i class="bi bi-lightbulb" style="color: #f7941c"></i> Key Insights</p>
                        </div>
                        <p class="desc">
                            Overall, The department exhibits a moderate match between employee interests and their
                            roles. Many employees’ interests align with key aspects of their responsibilities, though
                            some areas may require additional development. Those with very low and low needs targeted
                            interventions such as role adjustments, additional training, mentorship, and more
                            personalized development plans. High performers can be leveraged as mentors or role models
                            to support others.
                        </p>
                    </div>
                    </div>
                    <div class="legend" style="justify-content: left;  margin: 0px 100px 0px 0px;">
                        <div>
                            <span class="yellow"></span> Very Low
                        </div>
                        <div>
                            <span class="low"></span> Low
                        </div>
                        <div>
                            <span class="moderate"></span> Moderate
                        </div>
                        <div><span class="completed-color"></span> High</div>
                        <div>
                            <span class="very-high"></span> Very High
                        </div>
                    </div>
                </div>
                <div class="third-second level-bottom">
                    <div id="chartJobMatchRate" class="chart-position"></div>
                    {{-- @if($hasLevelData)
                    <div class="overall-bottom">
                <div class="overall-bar">
                    @foreach ($selectedLevels as $level)
                        @php
                            $level = trim($level);
                            $levelData = $chartPositionLevelGroup[$level]['jmr'] ?? [];
                            $total = array_sum($levelData);
                        @endphp
                    
                    <div class="level">
                        <div class="level-label">Level {{ $level }}</div>
                    
                        @php
                            $labelColors = [
                                'Very Low' => '#FFC549',
                                'Low' => '#FFDC92',
                                'Moderate' => '#8CE3E3',
                                'High' => '#1AC2C2',
                                'Very High' => '#108585',
                            ];
                    
                            $maxBarWidthVW = 10;
                        @endphp
                    
                        @foreach (['Very Low', 'Low', 'Moderate', 'High', 'Very High'] as $label)
                            @php
                                $count = $levelData[$label] ?? 0;
                            @endphp
                    
                            @if ($count > 0)
                                @php

                                    $digitCount = strlen((string) $count);
                    
                                    $widthFactor = [
                                        1 => 3, 
                                        2 => 6,  
                                        3 => 10, 
                                    ];
                    
                                    $barWidth = ($widthFactor[$digitCount] ?? $maxBarWidthVW) . 'vw';
                    
                                    $id = \Illuminate\Support\Str::camel($label) . 'Jmr';
                                    $color = $labelColors[$label] ?? '#ccc';
                                @endphp
                    
                                <div class="bar-container">
                                    <div class="bar" id="{{ $id }}" style="width: {{ $barWidth }}; background-color: {{ $color }};">
                                        {{ $count }}
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    
                        <div class="count">{{ $total }} <i class="bi bi-person"></i></div>
                    </div>
                    
                    
                    @endforeach
                </div>
            </div>
            @endif --}}
         @php
    $jmrLevelCounts = $jmrLevelCounts ?? []; // Get jmrLevelCounts data passed from controller
    $levelLabels = ['Very Low', 'Low', 'Moderate', 'High', 'Very High'];
    $labelColors = [
        'Very Low' => '#FFC549',
        'Low' => '#FFDC92',
        'Moderate' => '#8CE3E3',
        'High' => '#1AC2C2',
        'Very High' => '#108585'
    ];
    $levelLabelsMap = [
        'Very Low' => 'VeryLow',
        'Low' => 'Low',
        'Moderate' => 'Moderate',
        'High' => 'High',
        'Very High' => 'VeryHigh'
    ];
@endphp

<div class="overall-bottom">
    <div class="overall-bar">
        @foreach ($levelLabels as $label)
            @php
                // Map the level label to the corresponding key in the jmrLevelCounts array
                $key = $levelLabelsMap[$label];
                // Get the total count for the current level, default to 0 if not available
                $totalCount = $jmrLevelCounts[$key] ?? 0;
                // Calculate the width of the bar based on the count
                $width = $totalCount > 0 ? min(3 * strlen((string) $totalCount), 10) . 'vw' : '0px';
                // Convert label into a class name for the bar
                $barClass = strtolower(str_replace(' ', '-', $label));
            @endphp

            <div class="level">
                <div class="level-label">{{ $label }}</div> <!-- Showing "Very High ka Very High" -->
                <div class="bar-container">
                    <div class="bar {{ $barClass }}" style="width: {{ $width }}; background-color: {{ $labelColors[$label] ?? '#ccc' }};"></div>
                </div>
                <div class="count">{{ $totalCount }} <i class="bi bi-person"></i></div>
            </div>
        @endforeach
    </div>
</div>


                </div>
            </div>
            {{-- <div class="levels-container" style="margin-top: 83px !important;">
                <p>Explore more in depth by navigating position level</p>
                @php
                    $levelWords = ['One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine', 'Ten', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen'];
                @endphp

                <div class="levels-buttons">
                    @foreach ($selectedLevels as $level)
                        @php
                            $level = trim($level);
                            $word = $levelWords[$level - 1] ?? $level; // fallback just in case
                            $anchorId = 'JobMatchRate' . $word;
                        @endphp
                        <button class="levels-button" onclick="location.href='#{{ $anchorId }}'">
                            Level {{ $level }}
                        </button>
                    @endforeach
                </div>
            </div> --}}
            <div class="footer">
                <div class="left-side">
                    <p>Report Prepared for: {{ $title }}</p>
                    <div class="line"></div>
                    <p>{{ $date }}</p>
                </div>
                <div class="right-side">
                    <p>© CXS Analytics 
                        {{-- /* <span>23</span> */ --}}
                    </p>
                </div>
            </div>
        </div>
    </div>

    @php
        $levelLabels = ['Very Low', 'Low', 'Moderate', 'High', 'Very High'];
        $labelColors = [
            'Very Low' => '#FFC549',
            'Low' => '#FFDC92',
            'Moderate' => '#8CE3E3',
            'High' => '#1AC2C2',
            'Very High' => '#108585'
        ];
        $levelWords = ['One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine', 'Ten', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen'];
    @endphp
    @if($hasLevelData)
    @foreach ($selectedLevels as $i => $level)
        @php
            $level = trim($level);
            $word = $levelWords[$level - 1] ?? $level;
            $levelKey = 'JobMatchRate' . $word;
            $chartId = 'chartJobMatchRate' . $word;
            $data = $chartPositionLevelGroup[$level]['jmr'] ?? [];
            $total = array_sum($data);
            $activeClass = 'active-' . strtolower($word);
        @endphp

        @php

            $filteredData = array_filter($data, function ($value, $key) {
                return $key !== 'Data Not Available';
            }, ARRAY_FILTER_USE_BOTH);

            $jmrCharts[] = [
                'id' => $chartId,
                'labels' => array_keys(array_filter($filteredData)),
                'values' => array_values(array_filter($filteredData)),
                'colors' => collect(array_keys(array_filter($filteredData)))
                                ->map(fn($label) => $labelColors[$label] ?? '#ccc')
                                ->toArray(),
                'total' => array_sum($filteredData),
            ];
        @endphp

        <div class="container" id="{{ $levelKey }}">
            <div class="sidebar">
                <a href="#demographics"><h3>Demographics</h3></a>
                <a href="#overall"><h3>Overall Match Rate</h3></a>
                <a href="#technical"><h3>Technical Assessment</h3></a>
                <a href="#behavioralFitRate"><h3 style="margin-bottom: 6px">Behavioral Fit Rate</h3></a>
                <ul>
                    <li class="active"><a href="#JobMatchRate">Job Match Rate</a></li>
                    <li><a href="#SoftSkillsMatchRate">Soft Skills Match Rate</a></li>
                    <li><a href="#GrowthPotential">Growth Potential</a></li>
                    <li><a href="#WorkplaceAlignmentForecast">Workplace Alignment Forecast</a></li>
                    <li><a href="#FlightRisk">Flight Risk</a></li>
                    <li><a href="#OverallCognitiveAbility">Cognitive Ability</a></li>
                </ul>
                {{-- <i class="bi bi-house-door home-icon-sidebar"></i> --}}
            </div>

            <div class="third-body">
                <div class="third-content">
                    <div class="third-first">
                        <div class="level-heading">
                            <h4>Job Match Rate</h4>
                            <h6>Job Position: <span>Level {{ $level }}</span></h6>
                        </div>
                        <div class="insight-box-height-level">
                        <div class="insight-box">
                            <div class="heading">
                                <p><i class="bi bi-lightbulb" style="color: #f7941c"></i> Key Insights</p>
                            </div>
                            <p class="desc">
                                Employees are reasonably engaged and aligned with their responsibilities, but there is an
                                opportunity to further enhance job satisfaction and performance by addressing the gaps for
                                those in the low and very low alignment categories. Targeted interventions such as role
                                adjustments, additional training, mentorship, and more personalized development plans will
                                be crucial for improving alignment and engagement. High performers can be leveraged as
                                mentors or role models to support others.                            
                            </p>
                        </div>
                        </div>

                        <div class="level-spacer"></div>

                        <div class="legend" style="justify-content: left;  margin: 0px 100px 0px 0px;">
                            <div><span class="yellow"></span> Very Low</div>
                            <div><span class="low"></span> Low</div>
                            <div><span class="moderate"></span> Moderate</div>
                            <div><span class="completed-color"></span> High</div>
                            <div><span class="very-high"></span> Very High</div>
                        </div>
                    </div>

                    <div class="third-second level-bottom">
                        <div id="{{ $chartId }}" class="chart-position"></div>

                        <div class="overall-bottom">
                            <div class="overall-bar">
                                @foreach ($levelLabels as $label)
                                    @php
                                        $count = $data[$label] ?? 0;
                                        $width = $count > 0 ? min(3 * strlen((string)$count), 10) . 'vw' : '0px';
                                        $barClass = strtolower(str_replace(' ', '-', $label));
                                    @endphp

                                    <div class="level">
                                        <div class="level-label">{{ $label }}</div>
                                        <div class="bar-container">
                                            <div class="bar {{ $barClass }}" style="width: {{ $width }};"></div>
                                        </div>
                                        <div class="count">{{ $count }} <i class="bi bi-person"></i></div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="vertical-level-sidebar">
                    @foreach (array_reverse($selectedLevels) as $sideLevel)
                        @php
                            $sideWord = $levelWords[$sideLevel - 1] ?? $sideLevel;
                            $sideId = 'JobMatchRate' . $sideWord;
                            $sideClass = $sideLevel == $level ? 'active-' . strtolower($sideWord) : '';
                        @endphp
                        <div class="level {{ $sideClass }}" onclick="location.href='#{{ $sideId }}'">
                            Level {{ $sideLevel }}
                        </div>
                    @endforeach
                </div>

                <div class="footer">
                    <div class="left-side">
                        <p>Report Prepared for: {{ $title }}</p>
                        <div class="line"></div>
                        <p>{{ $date }}</p>
                    </div>
                    <div class="right-side">
                        <p>© CXS Analytics 
                            {{-- /* <span>{{ $loop->iteration + 4 }}</span> */ --}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    @endif

    {{-- Soft Skills Match Rate --}}
    <div class="container" id="SoftSkillsMatchRate">
        <div class="sidebar">
            <a href="#demographics">
                <h3>Demographics</h3>
            </a>
           @if (!in_array(env('DB_DATABASE'), config('client.omr_ta_not_required')))
                <a href="#overall">
                    <h3>Overall Match Rate</h3>
                </a>
                <a href="#technical">
                    <h3>Technical Assessment</h3>
                </a>
            @endif
            <a href="#behavioralFitRate">
                <h3 style="margin-bottom: 6px">Behavioral Fit Rate</h3>
            </a>
            <ul>
                <a href="#JobMatchRate">
                    <li>Job Match Rate</li>
                </a>
                <a href="#SoftSkillsMatchRate">
                    <li class="active">Soft Skills Match Rate</li>
                </a>
                <a href="#GrowthPotential">
                    <li>Growth Potential</li>
                </a>
                <a href="#WorkplaceAlignmentForecast">
                    <li>Workplace Alignment Forecast</li>
                </a>
                <a href="#FlightRisk">
                    <li>Flight Risk</li>
                </a>
                <a href="#OverallCognitiveAbility">
                    <li>Cognitive Ability</li>
                </a>
            </ul>
            {{-- <i class="bi bi-house-door home-icon-sidebar"></i> --}}
        </div>
        <div class="third-body">
            <div class="third-content">
                <div class="third-first">
                    <h4>Soft Skills Match Rate</h4>
                    <div class="insight-box-height-level-three">
                    <div class="insight-box">
                        <div class="heading">
                            <p><i class="bi bi-lightbulb" style="color: #f7941c"></i> Key Insights</p>
                        </div>
                        <p class="desc">
                            Overall, the department's critical core skills reflect a well-rounded skill set that aligns
                            with many organizational needs. The team is well-prepared to contribute effectively, with
                            the ability to refine and expand these skills to achieve higher levels of performance. With
                            focused development efforts, the low category can enhance these skills to more closely meet
                            expectations and improve performance. Employees with high behavioral alignment can serve as
                            role models or mentors, helping to elevate overall team dynamics.
                        </p>
                    </div>
                    </div>
                    <div class="legend" style="justify-content: left; margin: 0px 100px 0px 10px;">
                        <div>
                            <span class="low"></span> Low
                        </div>
                        <div>
                            <span class="moderate"></span> Moderate
                        </div>
                        <div><span class="completed-color"></span> High</div>
                    </div>
                </div>
                <div class="third-second level-bottom">
                    <div id="chartSoftSkillsMatchRate" class="chart-position"></div>
                    {{-- @if($hasLevelData)
                    <div class="overall-bottom">
                <div class="overall-bar">
                    @foreach ($selectedLevels as $level)
                        @php
                            $level = trim($level);
                            $levelData = $chartPositionLevelGroup[$level]['mr'] ?? [];
                            $total = array_sum($levelData);
                        @endphp
                    
                    <div class="level">
                        <div class="level-label">Level {{ $level }}</div>
                    
                        @php
                            $labelColors = [
                                'Very Low' => '#FFC549',
                                'Low' => '#FFDC92',
                                'Moderate' => '#8CE3E3',
                                'High' => '#1AC2C2',
                                'Very High' => '#108585',
                            ];
                    
                            $maxBarWidthVW = 10;
                        @endphp
                    
                        @foreach (['Very Low', 'Low', 'Moderate', 'High', 'Very High'] as $label)
                            @php
                                $count = $levelData[$label] ?? 0;
                            @endphp
                    
                            @if ($count > 0)
                                @php

                                    $digitCount = strlen((string) $count);
                    
                                    $widthFactor = [
                                        1 => 3, 
                                        2 => 6,  
                                        3 => 10, 
                                    ];
                    
                                    $barWidth = ($widthFactor[$digitCount] ?? $maxBarWidthVW) . 'vw';
                    
                                    $id = \Illuminate\Support\Str::camel($label) . 'Mr';
                                    $color = $labelColors[$label] ?? '#ccc';
                                @endphp
                    
                                <div class="bar-container">
                                    <div class="bar" id="{{ $id }}" style="width: {{ $barWidth }}; background-color: {{ $color }};">
                                        {{ $count }}
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    
                        <div class="count">{{ $total }} <i class="bi bi-person"></i></div>
                    </div>
                    
                    
                    @endforeach
                </div>
            </div>
            @endif --}}
           @php
    $matchRateCounts = $matchRateCounts ?? []; // Get matchRateCounts data passed from controller
    $levelLabels = ['Very Low', 'Low', 'Moderate', 'High', 'Very High'];
    $labelColors = [
        'Very Low' => '#FFC549',
        'Low' => '#FFDC92',
        'Moderate' => '#8CE3E3',
        'High' => '#1AC2C2',
        'Very High' => '#108585'
    ];
    $levelLabelsMap = [
        'Very Low' => 'VeryLow',
        'Low' => 'Low',
        'Moderate' => 'Moderate',
        'High' => 'High',
        'Very High' => 'VeryHigh'
    ];
@endphp

<div class="overall-bottom">
    <div class="overall-bar">
        @foreach ($levelLabels as $label)
            @php
                // Map the level label to the corresponding key in the matchRateCounts array
                $key = $levelLabelsMap[$label];
                // Get the total count for the current level, default to 0 if not available
                $totalCount = $matchRateCounts[$key] ?? 0;
                // Calculate the width of the bar based on the count
                $width = $totalCount > 0 ? min(3 * strlen((string) $totalCount), 10) . 'vw' : '0px';
                // Convert label into a class name for the bar
                $barClass = strtolower(str_replace(' ', '-', $label));
            @endphp

            <div class="level">
                <div class="level-label">{{ $label }}</div> <!-- Showing "Very High ka Very High" -->
                <div class="bar-container">
                    <div class="bar {{ $barClass }}" style="width: {{ $width }}; background-color: {{ $labelColors[$label] ?? '#ccc' }};"></div>
                </div>
                <div class="count">{{ $totalCount }} <i class="bi bi-person"></i></div>
            </div>
        @endforeach
    </div>
</div>


                </div>
            </div>
            
            {{-- <div class="levels-container" style="margin-top: 80px !important;">
                <p>Explore more in depth by navigating position level</p>
                @php
                    $levelWords = ['One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine', 'Ten', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen'];
                @endphp

                <div class="levels-buttons">
                    @foreach ($selectedLevels as $level)
                        @php
                            $level = trim($level);
                            $word = $levelWords[$level - 1] ?? $level; // fallback just in case
                            $anchorId = 'SoftSkillsMatchRate' . $word;
                        @endphp
                        <button class="levels-button" onclick="location.href='#{{ $anchorId }}'">
                            Level {{ $level }}
                        </button>
                    @endforeach
                </div>
            </div> --}}
            <div class="footer">
                <div class="left-side">
                    <p>Report Prepared for: {{ $title }}</p>
                    <div class="line"></div>
                    <p>{{ $date }}</p>
                </div>
                <div class="right-side">
                    <p>© CXS Analytics 
                        {{-- /* <span>28</span> */ --}}
                    </p>
                </div>
            </div>
        </div>
    </div>

    @php
        $levelLabels = ['Very Low', 'Low', 'Moderate', 'High', 'Very High'];
        $labelColors = [
            'Very Low' => '#FFC549',
            'Low' => '#FFDC92',
            'Moderate' => '#8CE3E3',
            'High' => '#1AC2C2',
            'Very High' => '#108585'
        ];
        $levelWords = ['One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine', 'Ten', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen'];
    @endphp
    @if($hasLevelData)
    @foreach ($selectedLevels as $i => $level)
        @php
            $level = trim($level);
            $word = $levelWords[$level - 1] ?? $level;
            $levelKey = 'SoftSkillsMatchRate' . $word;
            $chartId = 'chartSoftSkillsMatchRate' . $word;
            $data = $chartPositionLevelGroup[$level]['mr'] ?? [];
            $total = array_sum($data);
            $activeClass = 'active-' . strtolower($word);
        @endphp

        @php

            $filteredData = array_filter($data, function ($value, $key) {
                return $key !== 'Data Not Available';
            }, ARRAY_FILTER_USE_BOTH);

            $mrCharts[] = [
                'id' => $chartId,
                'labels' => array_keys(array_filter($filteredData)),
                'values' => array_values(array_filter($filteredData)),
                'colors' => collect(array_keys(array_filter($filteredData)))
                                ->map(fn($label) => $labelColors[$label] ?? '#ccc')
                                ->toArray(),
                'total' => array_sum($filteredData),
            ];
        @endphp

        <div class="container" id="{{ $levelKey }}">
            <div class="sidebar">
                <a href="#demographics"><h3>Demographics</h3></a>
                <a href="#overall"><h3>Overall Match Rate</h3></a>
                <a href="#technical"><h3>Technical Assessment</h3></a>
                <a href="#behavioralFitRate"><h3 style="margin-bottom: 6px">Behavioral Fit Rate</h3></a>
                <ul>
                    <li><a href="#JobMatchRate">Job Match Rate</a></li>
                    <li class="active"><a href="#SoftSkillsMatchRate">Soft Skills Match Rate</a></li>
                    <li><a href="#GrowthPotential">Growth Potential</a></li>
                    <li><a href="#WorkplaceAlignmentForecast">Workplace Alignment Forecast</a></li>
                    <li><a href="#FlightRisk">Flight Risk</a></li>
                    <li><a href="#OverallCognitiveAbility">Cognitive Ability</a></li>
                </ul>
                {{-- <i class="bi bi-house-door home-icon-sidebar"></i> --}}
            </div>

            <div class="third-body">
                <div class="third-content">
                    <div class="third-first">
                        <div class="level-heading">
                            <h4>Soft Skills Match</h4>
                            <h6>Job Position: <span>Level {{ $level }}</span></h6>
                        </div>
                        <div class="insight-box-height-level">
                        <div class="insight-box">
                            <div class="heading">
                                <p><i class="bi bi-lightbulb" style="color: #f7941c"></i> Key Insights</p>
                            </div>
                            <p class="desc">
                                Employees are reasonably engaged and aligned with their responsibilities, but there is an
                                opportunity to further enhance job satisfaction and performance by addressing the gaps for
                                those in the low alignment categories. Targeted interventions such as role adjustments,
                                additional training, mentorship, and more personalized development plans will be crucial for
                                improving alignment and engagement. Employees with high behavioural alignment represents a
                                valuable asset to the department, as these individuals can serve as role models or mentors,
                                helping to elevate overall team dynamics.                           
                            </p>
                        </div>
                        </div>

                        <div class="level-spacer"></div>

                        <div class="legend" style="justify-content: left;  margin: 0px 100px 0px 0px;">
                            <div><span class="yellow"></span> Very Low</div>
                            <div><span class="low"></span> Low</div>
                            <div><span class="moderate"></span> Moderate</div>
                            <div><span class="completed-color"></span> High</div>
                            <div><span class="very-high"></span> Very High</div>
                        </div>
                    </div>

                    <div class="third-second level-bottom">
                        <div id="{{ $chartId }}" class="chart-position"></div>

                        <div class="overall-bottom">
                            <div class="overall-bar">
                                @foreach ($levelLabels as $label)
                                    @php
                                        $count = $data[$label] ?? 0;
                                        $width = $count > 0 ? min(3 * strlen((string)$count), 10) . 'vw' : '0px';
                                        $barClass = strtolower(str_replace(' ', '-', $label));
                                    @endphp

                                    <div class="level">
                                        <div class="level-label">{{ $label }}</div>
                                        <div class="bar-container">
                                            <div class="bar {{ $barClass }}" style="width: {{ $width }};"></div>
                                        </div>
                                        <div class="count">{{ $count }} <i class="bi bi-person"></i></div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="vertical-level-sidebar">
                    @foreach (array_reverse($selectedLevels) as $sideLevel)
                        @php
                            $sideWord = $levelWords[$sideLevel - 1] ?? $sideLevel;
                            $sideId = 'SoftSkillsMatchRate' . $sideWord;
                            $sideClass = $sideLevel == $level ? 'active-' . strtolower($sideWord) : '';
                        @endphp
                        <div class="level {{ $sideClass }}" onclick="location.href='#{{ $sideId }}'">
                            Level {{ $sideLevel }}
                        </div>
                    @endforeach
                </div>

                <div class="footer">
                    <div class="left-side">
                        <p>Report Prepared for: {{ $title }}</p>
                        <div class="line"></div>
                        <p>{{ $date }}</p>
                    </div>
                    <div class="right-side">
                        <p>© CXS Analytics 
                            {{-- /* <span>{{ $loop->iteration + 4 }}</span> */ --}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    @endif

    {{-- Growth Potential --}}
    <div class="container" id="GrowthPotential">
        <div class="sidebar">
            <a href="#demographics">
                <h3>Demographics</h3>
            </a>
           @if (!in_array(env('DB_DATABASE'), config('client.omr_ta_not_required')))
                <a href="#overall">
                    <h3>Overall Match Rate</h3>
                </a>
                <a href="#technical">
                    <h3>Technical Assessment</h3>
                </a>
            @endif
            <a href="#behavioralFitRate">
                <h3 style="margin-bottom: 6px">Behavioral Fit Rate</h3>
            </a>
            <ul>
                <a href="#JobMatchRate">
                    <li>Job Match Rate</li>
                </a>
                <a href="#SoftSkillsMatchRate">
                    <li>Soft Skills Match Rate</li>
                </a>
                <a href="#GrowthPotential">
                    <li class="active">Growth Potential</li>
                </a>
                <a href="#WorkplaceAlignmentForecast">
                    <li>Workplace Alignment Forecast</li>
                </a>
                <a href="#FlightRisk">
                    <li>Flight Risk</li>
                </a>
                <a href="#OverallCognitiveAbility">
                    <li>Cognitive Ability</li>
                </a>
            </ul>
            {{-- <i class="bi bi-house-door home-icon-sidebar"></i> --}}
        </div>
        <div class="third-body">
            <div class="third-content">
                <div class="third-first">
                    <h4>Growth Potential</h4>
                    <div class="insight-box-height-non-level">
                    <div class="insight-box">
                        <div class="heading">
                            <p><i class="bi bi-lightbulb" style="color: #f7941c"></i> Key Insights</p>
                        </div>
                        <p class="desc">
                            Overall, the department signifies great potential for foundational skill-building and
                            thrives with structured support. With continuous coaching and guidance, the team is
                            well-positioned to enhance adaptability and steadily prepare for taking on greater
                            responsibilities. Moderate team is adaptable and capable of managing changes effectively.
                            High and very high performers are strong candidates for succession planning and are
                            well-suited for strategic and high-impact initiatives.
                        </p>
                    </div>
                    </div>
                    <div class="legend" style="justify-content: left;  margin: 0px 100px 0px 0px;">
                        <div>
                            <span class="yellow"></span> Very Low
                        </div>
                        <div>
                            <span class="low"></span> Low
                        </div>
                        <div>
                            <span class="moderate"></span> Moderate
                        </div>
                        <div><span class="completed-color"></span> High</div>
                        <div>
                            <span class="very-high"></span> Very High
                        </div>
                    </div>
                </div>
                <div class="third-second level-bottom">
                    <div id="chartGrowthPotential" class="chart-position"></div>
                    {{-- @if($hasLevelData)
                    <div class="overall-bottom">
                <div class="overall-bar">
                    @foreach ($selectedLevels as $level)
                        @php
                            $level = trim($level);
                            $levelData = $chartPositionLevelGroup[$level]['gp'] ?? [];
                            $total = array_sum($levelData);
                        @endphp
                    
                    <div class="level">
                        <div class="level-label">Level {{ $level }}</div>
                    
                        @php
                            $labelColors = [
                                'Very Low' => '#FFC549',
                                'Low' => '#FFDC92',
                                'Moderate' => '#8CE3E3',
                                'High' => '#1AC2C2',
                                'Very High' => '#108585',
                            ];
                    
                            $maxBarWidthVW = 10;
                        @endphp
                    
                        @foreach (['Very Low', 'Low', 'Moderate', 'High', 'Very High'] as $label)
                            @php
                                $count = $levelData[$label] ?? 0;
                            @endphp
                    
                            @if ($count > 0)
                                @php

                                    $digitCount = strlen((string) $count);
                    
                                    $widthFactor = [
                                        1 => 3, 
                                        2 => 6,  
                                        3 => 10, 
                                    ];
                    
                                    $barWidth = ($widthFactor[$digitCount] ?? $maxBarWidthVW) . 'vw';
                    
                                    $id = \Illuminate\Support\Str::camel($label) . 'Gp';
                                    $color = $labelColors[$label] ?? '#ccc';
                                @endphp
                    
                                <div class="bar-container">
                                    <div class="bar" id="{{ $id }}" style="width: {{ $barWidth }}; background-color: {{ $color }};">
                                        {{ $count }}
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    
                        <div class="count">{{ $total }} <i class="bi bi-person"></i></div>
                    </div>
                    
                    
                    @endforeach
                </div>
            </div>
            @endif --}}

           @php
    $growthPotentialCounts = $growthPotentialCounts ?? []; // Get growthPotentialCounts data passed from controller
    $levelLabels = ['Very Low', 'Low', 'Moderate', 'High', 'Very High'];
    $labelColors = [
        'Very Low' => '#FFC549',
        'Low' => '#FFDC92',
        'Moderate' => '#8CE3E3',
        'High' => '#1AC2C2',
        'Very High' => '#108585'
    ];
    $levelLabelsMap = [
        'Very Low' => 'VeryLow',
        'Low' => 'Low',
        'Moderate' => 'Moderate',
        'High' => 'High',
        'Very High' => 'VeryHigh'
    ];
@endphp

<div class="overall-bottom">
    <div class="overall-bar">
        @foreach ($levelLabels as $label)
            @php
                // Map the label to the corresponding key in the growthPotentialCounts array
                $key = $levelLabelsMap[$label];
                // Get the total count for the current level, default to 0 if not available
                $totalCount = $growthPotentialCounts[$key] ?? 0;
                // Calculate the width of the bar based on the count
                $width = $totalCount > 0 ? min(3 * strlen((string) $totalCount), 10) . 'vw' : '0px';
                // Convert label into a class name for the bar
                $barClass = strtolower(str_replace(' ', '-', $label));
            @endphp

            <div class="level">
                <div class="level-label">{{ $label }}</div> <!-- Showing "Very High ka Very High" -->
                <div class="bar-container">
                    <div class="bar {{ $barClass }}" style="width: {{ $width }}; background-color: {{ $labelColors[$label] ?? '#ccc' }};"></div>
                </div>
                <div class="count">{{ $totalCount }} <i class="bi bi-person"></i></div>
            </div>
        @endforeach
    </div>
</div>



                </div>
            </div>
            {{-- <div class="levels-container" style="margin-top: 83px !important;">
                <p>Explore more in depth by navigating position level</p>
                @php
                    $levelWords = ['One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine', 'Ten', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen'];
                @endphp

                <div class="levels-buttons">
                    @foreach ($selectedLevels as $level)
                        @php
                            $level = trim($level);
                            $word = $levelWords[$level - 1] ?? $level; // fallback just in case
                            $anchorId = 'GrowthPotential' . $word;
                        @endphp
                        <button class="levels-button" onclick="location.href='#{{ $anchorId }}'">
                            Level {{ $level }}
                        </button>
                    @endforeach
                </div>
            </div> --}}
            <div class="footer">
                <div class="left-side">
                    <p>Report Prepared for: {{ $title }}</p>
                    <div class="line"></div>
                    <p>{{ $date }}</p>
                </div>
                <div class="right-side">
                    <p>© CXS Analytics
                         {{-- /* <span>33</span> */ --}}
                        </p>
                </div>
            </div>
        </div>
    </div>

    @php
        $levelLabels = ['Very Low', 'Low', 'Moderate', 'High', 'Very High'];
        $labelColors = [
            'Very Low' => '#FFC549',
            'Low' => '#FFDC92',
            'Moderate' => '#8CE3E3',
            'High' => '#1AC2C2',
            'Very High' => '#108585'
        ];
        $levelWords = ['One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine', 'Ten', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen'];
    @endphp
    @if($hasLevelData)
    @foreach ($selectedLevels as $i => $level)
        @php
            $level = trim($level);
            $word = $levelWords[$level - 1] ?? $level;
            $levelKey = 'GrowthPotential' . $word;
            $chartId = 'chartGrowthPotential' . $word;
            $data = $chartPositionLevelGroup[$level]['gp'] ?? [];
            $total = array_sum($data);
            $activeClass = 'active-' . strtolower($word);
        @endphp

        @php

            $filteredData = array_filter($data, function ($value, $key) {
                return $key !== 'Technical Assessment Not Completed';
            }, ARRAY_FILTER_USE_BOTH);

            $gpCharts[] = [
                'id' => $chartId,
                'labels' => array_keys(array_filter($filteredData)),
                'values' => array_values(array_filter($filteredData)),
                'colors' => collect(array_keys(array_filter($filteredData)))
                                ->map(fn($label) => $labelColors[$label] ?? '#ccc')
                                ->toArray(),
                'total' => array_sum($filteredData),
            ];
        @endphp

        <div class="container" id="{{ $levelKey }}">
            <div class="sidebar">
                <a href="#demographics"><h3>Demographics</h3></a>
                <a href="#overall"><h3>Overall Match Rate</h3></a>
                <a href="#technical"><h3>Technical Assessment</h3></a>
                <a href="#behavioralFitRate"><h3 style="margin-bottom: 6px">Behavioral Fit Rate</h3></a>
                <ul>
                    <li><a href="#JobMatchRate">Job Match Rate</a></li>
                    <li><a href="#SoftSkillsMatchRate">Soft Skills Match Rate</a></li>
                    <li class="active"><a href="#GrowthPotential">Growth Potential</a></li>
                    <li><a href="#WorkplaceAlignmentForecast">Workplace Alignment Forecast</a></li>
                    <li><a href="#FlightRisk">Flight Risk</a></li>
                    <li><a href="#OverallCognitiveAbility">Cognitive Ability</a></li>
                </ul>
                {{-- <i class="bi bi-house-door home-icon-sidebar"></i> --}}
            </div>

            <div class="third-body">
                <div class="third-content">
                    <div class="third-first">
                        <div class="level-heading">
                            <h4>Growth Potential</h4>
                            <h6>Job Position: <span>Level {{ $level }}</span></h6>
                        </div>
                        <div class="insight-box-height-level">
                        <div class="insight-box">
                            <div class="heading">
                                <p><i class="bi bi-lightbulb" style="color: #f7941c"></i> Key Insights</p>
                            </div>
                            <p class="desc">
                                The department faces significant challenges in foundational skill-building. Majority of
                            employees need intensive support to address skill gaps, requiring structured training
                            programs and targeted mentorship to improve their proficiency. While the moderate performers
                            can benefit from additional development to advance their skills, the high and very high
                            performers should be leveraged as mentors to guide their peers.                          
                            </p>
                        </div>
                        </div>

                        <div class="level-spacer"></div>

                        <div class="legend" style="justify-content: left;  margin: 0px 100px 0px 0px;">
                            <div><span class="yellow"></span> Very Low</div>
                            <div><span class="low"></span> Low</div>
                            <div><span class="moderate"></span> Moderate</div>
                            <div><span class="completed-color"></span> High</div>
                            <div><span class="very-high"></span> Very High</div>
                        </div>
                    </div>

                    <div class="third-second level-bottom">
                        <div id="{{ $chartId }}" class="chart-position"></div>

                        <div class="overall-bottom">
                            <div class="overall-bar">
                                @foreach ($levelLabels as $label)
                                    @php
                                        $count = $data[$label] ?? 0;
                                        $width = $count > 0 ? min(3 * strlen((string)$count), 10) . 'vw' : '0px';
                                        $barClass = strtolower(str_replace(' ', '-', $label));
                                    @endphp

                                    <div class="level">
                                        <div class="level-label">{{ $label }}</div>
                                        <div class="bar-container">
                                            <div class="bar {{ $barClass }}" style="width: {{ $width }};"></div>
                                        </div>
                                        <div class="count">{{ $count }} <i class="bi bi-person"></i></div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="vertical-level-sidebar">
                    @foreach (array_reverse($selectedLevels) as $sideLevel)
                        @php
                            $sideWord = $levelWords[$sideLevel - 1] ?? $sideLevel;
                            $sideId = 'GrowthPotential' . $sideWord;
                            $sideClass = $sideLevel == $level ? 'active-' . strtolower($sideWord) : '';
                        @endphp
                        <div class="level {{ $sideClass }}" onclick="location.href='#{{ $sideId }}'">
                            Level {{ $sideLevel }}
                        </div>
                    @endforeach
                </div>

                <div class="footer">
                    <div class="left-side">
                        <p>Report Prepared for: {{ $title }}</p>
                        <div class="line"></div>
                        <p>{{ $date }}</p>
                    </div>
                    <div class="right-side">
                        <p>© CXS Analytics 
                            {{-- /* <span>{{ $loop->iteration + 4 }}</span> */ --}}
                            </p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    @endif

    {{-- Workplace Alignment Forecast --}}
    <div class="container" id="WorkplaceAlignmentForecast">
        <div class="sidebar">
            <a href="#demographics">
                <h3>Demographics</h3>
            </a>
           @if (!in_array(env('DB_DATABASE'), config('client.omr_ta_not_required')))
                <a href="#overall">
                    <h3>Overall Match Rate</h3>
                </a>
                <a href="#technical">
                    <h3>Technical Assessment</h3>
                </a>
            @endif
            <a href="#behavioralFitRate">
                <h3 style="margin-bottom: 6px">Behavioral Fit Rate</h3>
            </a>
            <ul>
                <a href="#JobMatchRate">
                    <li>Job Match Rate</li>
                </a>
                <a href="#SoftSkillsMatchRate">
                    <li>Soft Skills Match Rate</li>
                </a>
                <a href="#GrowthPotential">
                    <li>Growth Potential</li>
                </a>
                <a href="#WorkplaceAlignmentForecast">
                    <li class="active">Workplace Alignment Forecast</li>
                </a>
                <a href="#FlightRisk">
                    <li>Flight Risk</li>
                </a>
                <a href="#OverallCognitiveAbility">
                    <li>Cognitive Ability</li>
                </a>
            </ul>
            {{-- <i class="bi bi-house-door home-icon-sidebar"></i> --}}
        </div>
        <div class="third-body">
            <div class="third-content">
                <div class="third-first">
                    <h4 style="width: 560px">Workplace Alignment Forecast</h4>
                    <div class="insight-box-height-non-level">
                    <div class="insight-box">
                        <div class="heading">
                            <p><i class="bi bi-lightbulb" style="color: #f7941c"></i> Key Insights</p>
                        </div>
                        <p class="desc">
                            Overall, the department is at very low and low groups demonstrates behaviors that
                            consistently strengthen team unity and align excellently with the company’s cultural values.
                            Moderate risk level may occasionally exhibit behaviors that could affect team dynamics, but
                            these are generally manageable. High and very high risk level may disrupt team harmony and
                            require more intensive interventions, including open conversations, conflict resolution, and
                            potential role adjustments.
                        </p>
                    </div>
                    </div>
                    <div class="legend" style="justify-content: left; margin: 0px;">
                        <div>
                            <span class="very-low-risk"></span> Very Low Risk
                        </div>
                        <div>
                            <span class="low-risk"></span> Low Risk
                        </div>
                        <div>
                            <span class="moderate-risk"></span> Moderate Risk
                        </div>
                        <div><span class="high-risk"></span> High Risk</div>
                        <div>
                            <span class="very-high-risk"></span> Very High Risk
                        </div>
                    </div>
                </div>
                <div class="third-second level-bottom">
                    <div id="chartWorkplaceAlignmentForecast" class="chart-position"></div>
                    {{-- @if($hasLevelData)
                    <div class="overall-bottom">
                <div class="overall-bar">
                    @foreach ($selectedLevels as $level)
                        @php
                            $level = trim($level);
                            $levelData = $chartPositionLevelGroup[$level]['waf'] ?? [];
                            $total = array_sum($levelData);
                        @endphp
                    
                    <div class="level">
                        <div class="level-label">Level {{ $level }}</div>
                        @php
                            $labelColors = [
                                'Very Low Risk' => '#7F66CA',
                                'Low Risk' => '#AA91F4',
                                'Moderate Risk' => '#FFE4AA',
                                'High Risk' => '#FFC1BB',
                                'Very High Risk' => '#FF6355',
                            ];
                    
                            $maxBarWidthVW = 10;
                        @endphp
                    
                        @foreach (['Very Low Risk', 'Low Risk', 'Moderate Risk', 'High Risk', 'Very High Risk'] as $label)
                            @php
                                $count = $levelData[$label] ?? 0;
                            @endphp
                    
                            @if ($count > 0)
                                @php

                                    $digitCount = strlen((string) $count);
                    
                                    $widthFactor = [
                                        1 => 3, 
                                        2 => 6,  
                                        3 => 10, 
                                    ];
                    
                                    $barWidth = ($widthFactor[$digitCount] ?? $maxBarWidthVW) . 'vw';
                    
                                    $id = \Illuminate\Support\Str::camel($label) . 'Gp';
                                    $color = $labelColors[$label] ?? '#ccc';
                                @endphp
                    
                                <div class="bar-container">
                                    <div class="bar" id="{{ $id }}" style="width: {{ $barWidth }}; background-color: {{ $color }};">
                                        {{ $count }}
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    
                        <div class="count">{{ $total }} <i class="bi bi-person"></i></div>
                    </div>
                    
                    
                    @endforeach
                </div>
            </div>
            @endif --}}
        {{-- @php
    $workplaceAlignmentForecast = $workplaceAlignmentForecast ?? []; // Get workplaceAlignmentForecast data passed from controller
    $levelLabels = ['Very Low', 'Low', 'Moderate', 'High', 'Very High'];
    $labelColors = [
        'Very Low' => '#7F66CA',
        'Low' => '#AA91F4',
        'Moderate' => '#FFE4AA',
        'High' => '#FFC1BB',
        'Very High' => '#FF6355'
    ];
    $levelLabelsMap = [
        'Very Low' => 'VeryLow',
        'Low' => 'Low',
        'Moderate' => 'Moderate',
        'High' => 'High',
        'Very High' => 'VeryHigh'
    ];
@endphp

<div class="overall-bottom">
    <div class="overall-bar">
        @foreach ($levelLabels as $label)
            @php
                // Map the level label to the corresponding key in the workplaceAlignmentForecast array
                $key = $levelLabelsMap[$label]; 
                // Get the total count for the current level, default to 0 if not available
                $totalCount = $workplaceAlignmentForecast[$key] ?? 0; 
                // Calculate the width of the bar based on the count
                $width = $totalCount > 0 ? min(3 * strlen((string) $totalCount), 10) . 'vw' : '0px'; 
                // Convert label into a class name for styling
                $barClass = strtolower(str_replace(' ', '-', $label)); 
            @endphp

            <div class="level">
                <div class="level-label">{{ $label }}</div> <!-- Display "Very High ka Very High" -->
                <div class="bar-container">
                    <div class="bar {{ $barClass }}" style="width: {{ $width }}; background-color: {{ $labelColors[$label] ?? '#ccc' }};">
                        
                    </div>
                </div>
                <div class="count">{{ $totalCount }} <i class="bi bi-person"></i></div> <!-- Show the count with an icon -->
            </div>
        @endforeach
    </div>
</div> --}}

@php
    $workplaceAlignmentForecast = $workplaceAlignmentForecast ?? []; // Get workplaceAlignmentForecast data passed from controller
    // Updated level labels with "Risk"
    $levelLabels = ['Very Low Risk', 'Low Risk', 'Moderate Risk', 'High Risk', 'Very High Risk'];
    // Updated label colors based on new labels
    $labelColors = [
        'Very Low Risk' => '#7F66CA',
        'Low Risk' => '#AA91F4',
        'Moderate Risk' => '#FFE4AA',
        'High Risk' => '#FFC1BB',
        'Very High Risk' => '#FF6355'
    ];
    // Updated mapping for the new level labels
    $levelLabelsMap = [
        'Very Low Risk' => 'VeryLow',
        'Low Risk' => 'Low',
        'Moderate Risk' => 'Moderate',
        'High Risk' => 'High',
        'Very High Risk' => 'VeryHigh'
    ];
@endphp

<div class="overall-bottom">
    <div class="overall-bar">
        @foreach ($levelLabels as $label)
            @php
                // Map the level label to the corresponding key in the workplaceAlignmentForecast array
                $key = $levelLabelsMap[$label]; 
                // Get the total count for the current level, default to 0 if not available
                $totalCount = $workplaceAlignmentForecast[$key] ?? 0; 
                // Calculate the width of the bar based on the count
                $width = $totalCount > 0 ? min(3 * strlen((string) $totalCount), 10) . 'vw' : '0px'; 
                // Convert label into a class name for styling
                $barClass = strtolower(str_replace(' ', '-', $label)); 
            @endphp

            <div class="level">
                <div class="level-label" style="min-width: 110px;">{{ $label }}</div> <!-- Display "Very High Risk" -->
                <div class="bar-container">
                    <div class="bar {{ $barClass }}" style="width: {{ $width }}; background-color: {{ $labelColors[$label] ?? '#ccc' }};">
                        {{-- Optional: Display the count in the bar --}}
                    </div>
                </div>
                <div class="count">{{ $totalCount }} <i class="bi bi-person"></i></div> <!-- Show the count with an icon -->
            </div>
        @endforeach
    </div>
</div>




                </div>
            </div>
            
            {{-- <div class="levels-container" style="margin-top: 83px !important;">
                <p>Explore more in depth by navigating position level</p>
                @php
                    $levelWords = ['One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine', 'Ten', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen'];
                @endphp

                <div class="levels-buttons">
                    @foreach ($selectedLevels as $level)
                        @php
                            $level = trim($level);
                            $word = $levelWords[$level - 1] ?? $level; // fallback just in case
                            $anchorId = 'WorkplaceAlignmentForecast' . $word;
                        @endphp
                        <button class="levels-button" onclick="location.href='#{{ $anchorId }}'">
                            Level {{ $level }}
                        </button>
                    @endforeach
                </div>
            </div> --}}
            <div class="footer">
                <div class="left-side">
                    <p>Report Prepared for: {{ $title }}</p>
                    <div class="line"></div>
                    <p>{{ $date }}</p>
                </div>
                <div class="right-side">
                    <p>© CXS Analytics
                         {{-- /* <span>38</span> */ --}}
                         </p>
                </div>
            </div>
        </div>
    </div>

    @php
        $levelLabels = ['Very Low Risk', 'Low Risk', 'Moderate Risk', 'High Risk', 'Very High Risk'];
        $labelColors = [
            'Very Low Risk' => '#7F66CA',
            'Low Risk' => '#AA91F4',
            'Moderate Risk' => '#FFE4AA',
            'High Risk' => '#FFC1BB',
            'Very High Risk' => '#FF6355'
        ];
        $levelWords = ['One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine', 'Ten', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen'];
    @endphp
    @if($hasLevelData)
    @foreach ($selectedLevels as $i => $level)
        @php
            $level = trim($level);
            $word = $levelWords[$level - 1] ?? $level;
            $levelKey = 'WorkplaceAlignmentForecast' . $word;
            $chartId = 'chartWorkplaceAlignmentForecast' . $word;
            $data = $chartPositionLevelGroup[$level]['waf'] ?? [];
            $total = array_sum($data);
            $activeClass = 'active-' . strtolower($word);
        @endphp

        @php

            $filteredData = array_filter($data, function ($value, $key) {
                return $key !== 'Data Not Available';
            }, ARRAY_FILTER_USE_BOTH);

            $wafCharts[] = [
                'id' => $chartId,
                'labels' => array_keys(array_filter($filteredData)),
                'values' => array_values(array_filter($filteredData)),
                'colors' => collect(array_keys(array_filter($filteredData)))
                                ->map(fn($label) => $labelColors[$label] ?? '#ccc')
                                ->toArray(),
                'total' => array_sum($filteredData),
            ];
        @endphp

        <div class="container" id="{{ $levelKey }}">
            <div class="sidebar">
                <a href="#demographics"><h3>Demographics</h3></a>
                <a href="#overall"><h3>Overall Match Rate</h3></a>
                <a href="#technical"><h3>Technical Assessment</h3></a>
                <a href="#behavioralFitRate"><h3 style="margin-bottom: 6px">Behavioral Fit Rate</h3></a>
                <ul>
                    <li><a href="#JobMatchRate">Job Match Rate</a></li>
                    <li><a href="#SoftSkillsMatchRate">Soft Skills Match Rate</a></li>
                    <li><a href="#GrowthPotential">Growth Potential</a></li>
                    <li class="active"><a href="#WorkplaceAlignmentForecast">Workplace Alignment Forecast</a></li>
                    <li><a href="#FlightRisk">Flight Risk</a></li>
                    <li><a href="#OverallCognitiveAbility">Cognitive Ability</a></li>
                </ul>
                {{-- <i class="bi bi-house-door home-icon-sidebar"></i> --}}
            </div>

            <div class="third-body">
                <div class="third-content">
                    <div class="third-first">
                        <div class="level-heading">
                            <h4 style="width: 560px">Workplace Alignment Forecast</h4>
                            <h6>Job Position: <span>Level {{ $level }}</span></h6>
                        </div>
                        <div class="insight-box-height-level">
                        <div class="insight-box">
                            <div class="heading">
                                <p><i class="bi bi-lightbulb" style="color: #f7941c"></i> Key Insights</p>
                            </div>
                            <p class="desc">
                                ​Employees are well-aligned with team dynamics, actively contributing to a positive work
                                environment, and can further benefit from leadership and skill development opportunities.                          
                            </p>
                        </div>
                        </div>

                        <div class="level-spacer"></div>

                        <div class="legend" style="justify-content: left; margin: 0px;">
                            <div>
                                <span class="very-low-risk"></span> Very Low Risk Risk
                            </div>
                            <div>
                                <span class="low-risk"></span> Low Risk
                            </div>
                            <div>
                                <span class="moderate-risk"></span> Moderate Risk
                            </div>
                            <div><span class="high-risk"></span> High Risk</div>
                            <div>
                                <span class="very-high-risk"></span> Very High Risk
                            </div>
                        </div>
                    </div>

                    <div class="third-second level-bottom">
                        <div id="{{ $chartId }}" class="chart-position"></div>

                        <div class="overall-bottom">
                            <div class="overall-bar">
                                @foreach ($levelLabels as $label)
                                    @php
                                        $count = $data[$label] ?? 0;
                                        $width = $count > 0 ? min(3 * strlen((string)$count), 10) . 'vw' : '0px';
                                        $barClass = strtolower(str_replace(' ', '-', $label));
                                    @endphp

                                    <div class="level">
                                        <div class="level-label" style="min-width: 110px;">{{ $label }}</div>
                                        <div class="bar-container">
                                            <div class="bar {{ $barClass }}" style="width: {{ $width }};"></div>
                                        </div>
                                        <div class="count">{{ $count }} <i class="bi bi-person"></i></div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="vertical-level-sidebar">
                    @foreach (array_reverse($selectedLevels) as $sideLevel)
                        @php
                            $sideWord = $levelWords[$sideLevel - 1] ?? $sideLevel;
                            $sideId = 'WorkplaceAlignmentForecast' . $sideWord;
                            $sideClass = $sideLevel == $level ? 'active-' . strtolower($sideWord) : '';
                        @endphp
                        <div class="level {{ $sideClass }}" onclick="location.href='#{{ $sideId }}'">
                            Level {{ $sideLevel }}
                        </div>
                    @endforeach
                </div>

                <div class="footer">
                    <div class="left-side">
                        <p>Report Prepared for: {{ $title }}</p>
                        <div class="line"></div>
                        <p>{{ $date }}</p>
                    </div>
                    <div class="right-side">
                        <p>© CXS Analytics 
                            {{-- /* <span>{{ $loop->iteration + 4 }}</span> */ --}}
                            </p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    @endif

    {{-- Flight Risk --}}
    <div class="container" id="FlightRisk">
        <div class="sidebar">
            <a href="#demographics">
                <h3>Demographics</h3>
            </a>
           @if (!in_array(env('DB_DATABASE'), config('client.omr_ta_not_required')))
                <a href="#overall">
                    <h3>Overall Match Rate</h3>
                </a>
                <a href="#technical">
                    <h3>Technical Assessment</h3>
                </a>
            @endif
            <a href="#behavioralFitRate">
                <h3 style="margin-bottom: 6px">Behavioral Fit Rate</h3>
            </a>
            <ul>
                <a href="#JobMatchRate">
                    <li>Job Match Rate</li>
                </a>
                <a href="#SoftSkillsMatchRate">
                    <li>Soft Skills Match Rate</li>
                </a>
                <a href="#GrowthPotential">
                    <li>Growth Potential</li>
                </a>
                <a href="#WorkplaceAlignmentForecast">
                    <li>Workplace Alignment Forecast</li>
                </a>
                <a href="#FlightRisk">
                    <li class="active">Flight Risk</li>
                </a>
                <a href="#OverallCognitiveAbility">
                    <li>Cognitive Ability</li>
                </a>
            </ul>
            {{-- <i class="bi bi-house-door home-icon-sidebar"></i> --}}
        </div>
        <div class="third-body">
            <div class="third-content">
                <div class="third-first">
                    <h4 style="width: 560px">Flight Risk</h4>
                    <div class="insight-box-height-non-level">
                    <div class="insight-box">
                        <div class="heading">
                            <p><i class="bi bi-lightbulb" style="color: #f7941c"></i> Key Insights</p>
                        </div>
                        <p class="desc">
                            Overall, the department is at very low Risk and low risk groups demonstrate strong
                            engagement and a high level of commitment. While moderate employees are somewhat aligned
                            with company goals, they may consider leaving if their expectations or career needs are not
                            met. High and very high flight risk groups require immediate action is necessary. These
                            employees may require targeted support such as professional development, role adjustments,
                            recognition, and open discussion
                        </p>
                    </div>
                    </div>
                    <div class="legend" style="justify-content: left; margin: 0px;">
                        <div>
                            <span class="very-low-risk"></span> Very Low Risk Risk
                        </div>
                        <div>
                            <span class="low-risk"></span> Low Risk
                        </div>
                        <div>
                            <span class="moderate-risk"></span> Moderate Risk
                        </div>
                        <div><span class="high-risk"></span> High Risk</div>
                        <div>
                            <span class="very-high-risk"></span> Very High Risk
                        </div>
                    </div>
                </div>
                <div class="third-second level-bottom">
                    <div id="chartFlightRisk" class="chart-position"></div>
                    {{-- @if($hasLevelData)
                    <div class="overall-bottom">
                <div class="overall-bar">
                    @foreach ($selectedLevels as $level)
                        @php
                            $level = trim($level);
                            $levelData = $chartPositionLevelGroup[$level]['fr'] ?? [];
                            $total = array_sum($levelData);
                        @endphp
                    
                    <div class="level">
                        <div class="level-label">Level {{ $level }}</div>
                        @php
                            $labelColors = [
                                'Very Low Risk' => '#7F66CA',
                                'Low Risk' => '#AA91F4',
                                'Moderate Risk' => '#FFE4AA',
                                'High Risk' => '#FFC1BB',
                                'Very High Risk' => '#FF6355',
                            ];
                    
                            $maxBarWidthVW = 10;
                        @endphp
                    
                        @foreach (['Very Low Risk', 'Low Risk', 'Moderate Risk', 'High Risk', 'Very High Risk'] as $label)
                            @php
                                $count = $levelData[$label] ?? 0;
                            @endphp
                    
                            @if ($count > 0)
                                @php

                                    $digitCount = strlen((string) $count);
                    
                                    $widthFactor = [
                                        1 => 3, 
                                        2 => 6,  
                                        3 => 10, 
                                    ];
                    
                                    $barWidth = ($widthFactor[$digitCount] ?? $maxBarWidthVW) . 'vw';
                    
                                    $id = \Illuminate\Support\Str::camel($label) . 'Fr';
                                    $color = $labelColors[$label] ?? '#ccc';
                                @endphp
                    
                                <div class="bar-container">
                                    <div class="bar" id="{{ $id }}" style="width: {{ $barWidth }}; background-color: {{ $color }};">
                                        {{ $count }}
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    
                        <div class="count">{{ $total }} <i class="bi bi-person"></i></div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif --}}
            {{-- @php
    // Define level labels and their colors
    $levelLabels = ['Very Low', 'Low', 'Moderate', 'High', 'Very High'];
    $labelColors = [
        'Very Low' => '#FFC549',
        'Low' => '#FFDC92',
        'Moderate' => '#8CE3E3',
        'High' => '#1AC2C2',
        'Very High' => '#108585'
    ];
    $levelWords = ['One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine', 'Ten', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen'];

    // Initialize cumulative counts to zero for aggregated data
    $cumulativeCounts = [
        'Very Low' => 0,
        'Low' => 0,
        'Moderate' => 0,
        'High' => 0,
        'Very High' => 0,
    ];

    // If levels are selected, aggregate the data for each level
     if ($hasLevelData && !empty($selectedLevels)) {
        foreach ($selectedLevels as $i => $level) {
            $level = trim($level);
            $level = (int)$level;  // Convert to integer
            $word = $levelWords[$level - 1] ?? $level;
            $levelKey = 'FlightRisk' . $word;
            $chartId = 'chartFlightRisk' . $word;
            $data = $chartPositionLevelGroup[$level]['ta'] ?? [];

            // Filter out 'Technical Assessment Not Completed'
            $filteredData = array_filter($data, function ($value, $key) {
                return $key !== 'Technical Assessment Not Completed';
            }, ARRAY_FILTER_USE_BOTH);

            // Aggregate counts for each label and add to cumulative counts
            foreach ($levelLabels as $label) {
                $count = $filteredData[$label] ?? 0;
                $cumulativeCounts[$label] += $count;  // Add to cumulative counts
            }
        }
    } else {
        // If no levels are selected, aggregate the data from all levels
        foreach ($chartPositionLevelGroup as $levelData) {
            $filteredData = array_filter($levelData['ta'] ?? [], function ($value, $key) {
                return $key !== 'Technical Assessment Not Completed';
            }, ARRAY_FILTER_USE_BOTH);

            foreach ($levelLabels as $label) {
                $count = $filteredData[$label] ?? 0;
                $cumulativeCounts[$label] += $count;  // Aggregate from all levels
            }
        }
    }
@endphp

<div class="overall-bottom">
    <div class="overall-bar">
        @foreach ($levelLabels as $label)
            @php
                // Get the cumulative count for each label
                $totalCount = $cumulativeCounts[$label];  
                // Calculate width for the bar
                $width = $totalCount > 0 ? min(3 * strlen((string) $totalCount), 10) . 'vw' : '0px';  
                // Format class name for the bar
                $barClass = strtolower(str_replace(' ', '-', $label));  
            @endphp

            <div class="level">
                <div class="level-label">{{ $label }}</div>
                <div class="bar-container">
                    <div class="bar {{ $barClass }}" style="width: {{ $width }}; background-color: {{ $labelColors[$label] ?? '#ccc' }};">
                    </div>
                </div>
                <div class="count">{{ $totalCount }} <i class="bi bi-person"></i></div>
            </div>
        @endforeach
    </div>
</div> --}}

{{-- @php
    $flightRiskCounts = $flightRiskCounts ?? []; // Get flightRiskCounts data passed from controller
    $levelLabels = ['Very Low', 'Low', 'Moderate', 'High', 'Very High'];
    $labelColors = [
        'Very Low' => '#7F66CA',
        'Low' => '#AA91F4',
        'Moderate' => '#FFE4AA',
        'High' => '#FFC1BB',
        'Very High' => '#FF6355'
    ];
    $levelLabelsMap = [
        'Very Low' => 'VeryLow',
        'Low' => 'Low',
        'Moderate' => 'Moderate',
        'High' => 'High',
        'Very High' => 'VeryHigh'
    ];
@endphp

<div class="overall-bottom">
    <div class="overall-bar">
        @foreach ($levelLabels as $label)
            @php
                // Map the label to the corresponding key in the flightRiskCounts array
                $key = $levelLabelsMap[$label];
                // Get the total count for the current level, default to 0 if not available
                $totalCount = $flightRiskCounts[$key] ?? 0;
                // Calculate the width of the bar based on the count
                $width = $totalCount > 0 ? min(3 * strlen((string) $totalCount), 10) . 'vw' : '0px';
                // Convert label into a class name for styling
                $barClass = strtolower(str_replace(' ', '-', $label));
            @endphp

            <div class="level">
                <div class="level-label">{{ $label }}</div> <!-- Showing "Very High ka Very High" -->
                <div class="bar-container">
                    <div class="bar {{ $barClass }}" style="width: {{ $width }}; background-color: {{ $labelColors[$label] ?? '#ccc' }};">
                        
                    </div>
                </div>
                <div class="count">{{ $totalCount }} <i class="bi bi-person"></i></div> <!-- Show the count with an icon -->
            </div>
        @endforeach
    </div>
</div> --}}

@php
    $flightRiskCounts = $flightRiskCounts ?? []; // Get flightRiskCounts data passed from controller
    $levelLabels = ['Very Low Risk', 'Low Risk', 'Moderate Risk', 'High Risk', 'Very High Risk'];
    $labelColors = [
        'Very Low Risk' => '#7F66CA',
        'Low Risk' => '#AA91F4',
        'Moderate Risk' => '#FFE4AA',
        'High Risk' => '#FFC1BB',
        'Very High Risk' => '#FF6355'
    ];
    $levelLabelsMap = [
        'Very Low Risk' => 'VeryLow',
        'Low Risk' => 'Low',
        'Moderate Risk' => 'Moderate',
        'High Risk' => 'High',
        'Very High Risk' => 'VeryHigh'
    ];
@endphp

<div class="overall-bottom">
    <div class="overall-bar">
        @foreach ($levelLabels as $label)
            @php
                // Map the label to the corresponding key in the flightRiskCounts array
                $key = $levelLabelsMap[$label];
                // Get the total count for the current level, default to 0 if not available
                $totalCount = $flightRiskCounts[$key] ?? 0;
                // Calculate the width of the bar based on the count
                $width = $totalCount > 0 ? min(3 * strlen((string) $totalCount), 10) . 'vw' : '0px';
                // Convert label into a class name for styling
                $barClass = strtolower(str_replace(' ', '-', $label));
            @endphp

            <div class="level">
                <div class="level-label" style="min-width: 110px;">{{ $label }}</div> <!-- Showing "Very High Risk" as per the new label -->
                <div class="bar-container">
                    <div class="bar {{ $barClass }}" style="width: {{ $width }}; background-color: {{ $labelColors[$label] ?? '#ccc' }};">
                        {{-- Optional: Display the count in the bar --}}
                    </div>
                </div>
                <div class="count">{{ $totalCount }} <i class="bi bi-person"></i></div> <!-- Show the count with an icon -->
            </div>
        @endforeach
    </div>
</div>




                </div>
            </div>
            
            {{-- <div class="levels-container" style="margin-top: 70px !important;">
                <p>Explore more in depth by navigating position level</p>
                @php
                    $levelWords = ['One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine', 'Ten', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen'];
                @endphp

                <div class="levels-buttons">
                    @foreach ($selectedLevels as $level)
                        @php
                            $level = trim($level);
                            $word = $levelWords[$level - 1] ?? $level; // fallback just in case
                            $anchorId = 'FlightRisk' . $word;
                        @endphp
                        <button class="levels-button" onclick="location.href='#{{ $anchorId }}'">
                            Level {{ $level }}
                        </button>
                    @endforeach
                </div>
            </div> --}}
            <div class="footer">
                <div class="left-side">
                    <p>Report Prepared for: {{ $title }}</p>
                    <div class="line"></div>
                    <p>{{ $date }}</p>
                </div>
                <div class="right-side">
                    <p>© CXS Analytics 
                        {{-- /* <span>43</span> */ --}}
                        </p>
                </div>
            </div>
        </div>
    </div>

    @php
        $levelLabels = ['Very Low Risk', 'Low Risk', 'Moderate Risk', 'High Risk', 'Very High Risk'];
        $labelColors = [
            'Very Low Risk' => '#7F66CA',
            'Low Risk' => '#AA91F4',
            'Moderate Risk' => '#FFE4AA',
            'High Risk' => '#FFC1BB',
            'Very High Risk' => '#FF6355'
        ];
        $levelWords = ['One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine', 'Ten', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen'];
    @endphp
    @if($hasLevelData)
    @foreach ($selectedLevels as $i => $level)
        @php
            $level = trim($level);
            $word = $levelWords[$level - 1] ?? $level;
            $levelKey = 'FlightRisk' . $word;
            $chartId = 'chartFlightRisk' . $word;
            $data = $chartPositionLevelGroup[$level]['fr'] ?? [];
            $total = array_sum($data);
            $activeClass = 'active-' . strtolower($word);
        @endphp

        @php

            $filteredData = array_filter($data, function ($value, $key) {
                return $key !== 'Data Not Available';
            }, ARRAY_FILTER_USE_BOTH);

            $frCharts[] = [
                'id' => $chartId,
                'labels' => array_keys(array_filter($filteredData)),
                'values' => array_values(array_filter($filteredData)),
                'colors' => collect(array_keys(array_filter($filteredData)))
                                ->map(fn($label) => $labelColors[$label] ?? '#ccc')
                                ->toArray(),
                'total' => array_sum($filteredData),
            ];
        @endphp

        <div class="container" id="{{ $levelKey }}">
            <div class="sidebar">
                <a href="#demographics"><h3>Demographics</h3></a>
                <a href="#overall"><h3>Overall Match Rate</h3></a>
                <a href="#technical"><h3>Technical Assessment</h3></a>
                <a href="#behavioralFitRate"><h3 style="margin-bottom: 6px">Behavioral Fit Rate</h3></a>
                <ul>
                    <li><a href="#JobMatchRate">Job Match Rate</a></li>
                    <li><a href="#SoftSkillsMatchRate">Soft Skills Match Rate</a></li>
                    <li><a href="#GrowthPotential">Growth Potential</a></li>
                    <li><a href="#WorkplaceAlignmentForecast">Workplace Alignment Forecast</a></li>
                    <li class="active"><a href="#FlightRisk">Flight Risk</a></li>
                    <li><a href="#OverallCognitiveAbility">Cognitive Ability</a></li>
                </ul>
                {{-- <i class="bi bi-house-door home-icon-sidebar"></i> --}}
            </div>

            <div class="third-body">
                <div class="third-content">
                    <div class="third-first">
                        <div class="level-heading">
                            <h4>Flight Risk</h4>
                            <h6>Job Position: <span>Level {{ $level }}</span></h6>
                        </div>
                        <div class="insight-box-height-level">
                        <div class="insight-box">
                            <div class="heading">
                                <p><i class="bi bi-lightbulb" style="color: #f7941c"></i> Key Insights</p>
                            </div>
                            <p class="desc">
                                The majority of employees demonstrating strong engagement, commitment, and alignment with
                                company goals, requiring minimal intervention to maintain their satisfaction and loyalty.
                                However,moderate risk categories, indicating potential disengagement and a higher likelihood
                                of considering departure. High and very high flight risk groups require immediate action is
                                necessary. These employees may require targeted support such as professional development,
                                role adjustments, recognition, and open discussions to address concerns and increase
                                satisfaction.                          
                            </p>
                        </div>
                        </div>

                        <div class="level-spacer"></div>

                        <div class="legend" style="justify-content: left; margin: 0px;">
                            <div>
                                <span class="very-low-risk"></span> Very Low Risk Risk
                            </div>
                            <div>
                                <span class="low-risk"></span> Low Risk
                            </div>
                            <div>
                                <span class="moderate-risk"></span> Moderate Risk
                            </div>
                            <div><span class="high-risk"></span> High Risk</div>
                            <div>
                                <span class="very-high-risk"></span> Very High Risk
                            </div>
                        </div>
                    </div>

                    <div class="third-second level-bottom">
                        <div id="{{ $chartId }}" class="chart-position"></div>

                        <div class="overall-bottom">
                            <div class="overall-bar">
                                @foreach ($levelLabels as $label)
                                    @php
                                        $count = $data[$label] ?? 0;
                                        $width = $count > 0 ? min(3 * strlen((string)$count), 10) . 'vw' : '0px';
                                        $barClass = strtolower(str_replace(' ', '-', $label));
                                    @endphp

                                    <div class="level">
                                        <div class="level-label" style="min-width: 110px;">{{ $label }}</div>
                                        <div class="bar-container">
                                            <div class="bar {{ $barClass }}" style="width: {{ $width }};"></div>
                                        </div>
                                        <div class="count">{{ $count }} <i class="bi bi-person"></i></div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="vertical-level-sidebar">
                    @foreach (array_reverse($selectedLevels) as $sideLevel)
                        @php
                            $sideWord = $levelWords[$sideLevel - 1] ?? $sideLevel;
                            $sideId = 'FlightRisk' . $sideWord;
                            $sideClass = $sideLevel == $level ? 'active-' . strtolower($sideWord) : '';
                        @endphp
                        <div class="level {{ $sideClass }}" onclick="location.href='#{{ $sideId }}'">
                            Level {{ $sideLevel }}
                        </div>
                    @endforeach
                </div>

                <div class="footer">
                    <div class="left-side">
                        <p>Report Prepared for: {{ $title }}</p>
                        <div class="line"></div>
                        <p>{{ $date }}</p>
                    </div>
                    <div class="right-side">
                        <p>© CXS Analytics 
                            {{-- /* <span>{{ $loop->iteration + 4 }}</span> */ --}}
                            </p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    @endif


    {{-- Overall Cognitive Ability --}}
    <div class="container" id="OverallCognitiveAbility">
        <div class="sidebar">
            <a href="#demographics">
                <h3>Demographics</h3>
            </a>
           @if (!in_array(env('DB_DATABASE'), config('client.omr_ta_not_required')))
                <a href="#overall">
                    <h3>Overall Match Rate</h3>
                </a>
                <a href="#technical">
                    <h3>Technical Assessment</h3>
                </a>
            @endif
            <a href="#behavioralFitRate">
                <h3 style="margin-bottom: 6px">Behavioral Fit Rate</h3>
            </a>
            <ul>
                <a href="#JobMatchRate">
                    <li>Job Match Rate</li>
                </a>
                <a href="#SoftSkillsMatchRate">
                    <li>Soft Skills Match Rate</li>
                </a>
                <a href="#GrowthPotential">
                    <li>Growth Potential</li>
                </a>
                <a href="#WorkplaceAlignmentForecast">
                    <li>Workplace Alignment Forecast</li>
                </a>
                <a href="#FlightRisk">
                    <li>Flight Risk</li>
                </a>
                <a href="#OverallCognitiveAbility">
                    <li class="active">Cognitive Ability</li>
                </a>
            </ul>
            {{-- <i class="bi bi-house-door home-icon-sidebar"></i> --}}
        </div>
        <div class="third-body">
            <div class="third-content">
                <div class="third-first">
                    <h4 style="width: 560px">Overall Cognitive Ability</h4>
                    <div class="insight-box-height-level-three">
                    <div class="insight-box">
                        <div class="heading">
                            <p><i class="bi bi-lightbulb" style="color: #f7941c"></i> Key Insights</p>
                        </div>
                        <p class="desc">
                            Overall Low CA Scores - The department exhibits generally low scores in cognitive abilities
                            across various domains.​
                            Potential Influencing Factors - Age, educational background, and limited cognitive skill
                            development opportunities may be contributing factors.
                        </p>
                    </div>
                    </div>
                    <div class="legend" style="justify-content: left; margin: 0px 100px 0px 0px;">
                        <div>
                            <span class="very-low"></span> Low
                        </div>
                        <div>
                            <span class="green-moderate"></span> Moderate
                        </div>
                        <div><span class="cyan-high"></span> High</div>
                    </div>
                </div>
                <div class="third-second level-bottom">
                    <div id="chartOverallCognitiveAbility" class="chart-position"></div>
                    {{-- @if($hasLevelData)
                    <div class="overall-bottom">
                <div class="overall-bar">
                    @foreach ($selectedLevels as $level)
                            @php
                                $level = trim($level);
                                $levelData = $chartPositionLevelGroup[$level]['cat'] ?? [];
                                $total = array_sum($levelData);
                            @endphp
                        
                        <div class="level">
                            <div class="level-label">Level {{ $level }}</div>
                            @php
                                $labelColors = [
                                    'High' => '#1AC2C2',
                                    'Moderate' => '#54CF6E',
                                    'Low' => '#FFC549',
                                ];
                        
                                $maxBarWidthVW = 10;
                            @endphp
                        
                            @foreach (['Low', 'Moderate', 'High'] as $label)
                                @php
                                    $count = $levelData[$label] ?? 0;
                                @endphp
                        
                                @if ($count > 0)
                                    @php

                                        $digitCount = strlen((string) $count);
                        
                                        $widthFactor = [
                                            1 => 3, 
                                            2 => 6,  
                                            3 => 10, 
                                        ];
                        
                                        $barWidth = ($widthFactor[$digitCount] ?? $maxBarWidthVW) . 'vw';
                        
                                        $id = \Illuminate\Support\Str::camel($label) . 'Cat';
                                        $color = $labelColors[$label] ?? '#ccc';
                                    @endphp
                        
                                    <div class="bar-container">
                                        <div class="bar {{ strtolower($label) }}-text-white" id="{{ $id }}" style="width: {{ $barWidth }}; background-color: {{ $color }};">
                                            {{ $count }}
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        
                            <div class="count">{{ $total }} <i class="bi bi-person"></i></div>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif --}}
        {{-- @php
    $catLevelCounts = $catLevelCounts ?? []; // Get catLevelCounts data passed from controller
    $levelLabels = ['Very Low', 'Low', 'Moderate', 'High', 'Very High'];
    $labelColors = [
        'Very Low' => '#FFC549',
        'Low' => '#FFDC92',
        'Moderate' => '#8CE3E3',
        'High' => '#1AC2C2',
        'Very High' => '#108585'
    ];
    $levelLabelsMap = [
        'Very Low' => 'VeryLow',
        'Low' => 'Low',
        'Moderate' => 'Moderate',
        'High' => 'High',
        'Very High' => 'VeryHigh'
    ];
@endphp

<div class="overall-bottom">
    <div class="overall-bar">
        @foreach ($levelLabels as $label)
            @php
                // Map the label to the corresponding key in the catLevelCounts array
                $key = $levelLabelsMap[$label];
                // Get the total count for the current level, default to 0 if not available
                $totalCount = $catLevelCounts[$key] ?? 0;
                // Calculate the width of the bar based on the count
                $width = $totalCount > 0 ? min(3 * strlen((string) $totalCount), 10) . 'vw' : '0px';
                // Convert label into a class name for styling
                $barClass = strtolower(str_replace(' ', '-', $label));
            @endphp

            <div class="level">
                <div class="level-label">{{ $label }}</div> <!-- Showing "Very High ka Very High" -->
                <div class="bar-container">
                    <div class="bar {{ $barClass }}" style="width: {{ $width }}; background-color: {{ $labelColors[$label] ?? '#ccc' }};">
                        
                    </div>
                </div>
                <div class="count">{{ $totalCount }} <i class="bi bi-person"></i></div> <!-- Show the count with an icon -->
            </div>
        @endforeach
    </div>
</div> --}}

{{-- @php
    $catLevelCounts = $catLevelCounts ?? []; // Get catLevelCounts data passed from controller
    $levelLabels = ['Low', 'Moderate', 'High']; // Only include 'Low', 'Moderate', and 'High'
    $labelColors = [
        'Low' => '#FFC549',
        'Moderate' => '#54CF6E',
        'High' => '#3fd0d0',
    ];
    $levelLabelsMap = [
        'Low' => 'Low',
        'Moderate' => 'Moderate',
        'High' => 'High',
    ];
    // Define the classes for each level
    $classes = [
        'High' => ['text-blue', 'bar-blue'],
        'Moderate' => ['text-green', 'bar-green'],
        'Low' => ['text-yellow', 'bar-yellow']
    ];
@endphp

<div class="overall-bottom">
    <div class="overall-bar">
        @foreach ($levelLabels as $label)
            @php
                // Map the label to the corresponding key in the catLevelCounts array
                $key = $levelLabelsMap[$label];
                // Get the total count for the current level, default to 0 if not available
                $totalCount = $catLevelCounts[$key] ?? 0;
                // Calculate the width of the bar based on the count
                $width = $totalCount > 0 ? min(3 * strlen((string) $totalCount), 10) . 'vw' : '0px';
                // Convert label into a class name for styling
                $barClass = strtolower(str_replace(' ', '-', $label));
                // Apply the color classes for the selected level
                $barTextClass = $classes[$label][0]; // Text class
                $barBgClass = $classes[$label][1]; // Background class
            @endphp

            <div class="level">
                <div class="level-label {{ $barTextClass }}">{{ $label }}</div> <!-- Showing "Low", "Moderate", "High" with appropriate text color -->
                <div class="bar-container">
                    <div class="bar {{ $barClass }} {{ $barBgClass }}" style="width: {{ $width }};">
                        
                    </div>
                </div>
                <div class="count">{{ $totalCount }} <i class="bi bi-person"></i></div> <!-- Show the count with an icon -->
            </div>
        @endforeach
    </div>
</div> --}}

@php
    $catLevelCounts = $catLevelCounts ?? []; // Get catLevelCounts data passed from controller
    $levelLabels = ['Low', 'Moderate', 'High']; // Only include 'Low', 'Moderate', and 'High'
    $labelColors = [
        'Low' => '#FFC549', // Low - Yellow
        'Moderate' => '#54CF6E', // Moderate - Green
        'High' => '#3fd0d0', // High - Teal
    ];
    $levelLabelsMap = [
        'Low' => 'Low',
        'Moderate' => 'Moderate',
        'High' => 'High',
    ];
    // Define the classes for each level
    $classes = [
        'High' => ['bar-teal'],
        'Moderate' => ['bar-green'],
        'Low' => ['bar-yellow'] // The yellow class for 'Low' as required
    ];
@endphp

<div class="overall-bottom">
    <div class="overall-bar">
        @foreach ($levelLabels as $label)
            @php
                // Map the label to the corresponding key in the catLevelCounts array
                $key = $levelLabelsMap[$label];
                // Get the total count for the current level, default to 0 if not available
                $totalCount = $catLevelCounts[$key] ?? 0;
                // Calculate the width of the bar based on the count
                $width = $totalCount > 0 ? min(3 * $totalCount, 10) . 'vw' : '0px'; // Adjust width dynamically
                // Apply the color classes for the selected level
                $barBgClass = $classes[$label][0]; // Background color class
                // Get the color from labelColors directly for the bar background
                $barColor = $labelColors[$label];
            @endphp

            <div class="level">
                <div class="level-label">{{ $label }}</div> <!-- Showing "Low", "Moderate", "High" -->
                <div class="bar-container">
                    <div class="bar {{ $barBgClass }}" style="width: {{ $width }}; background-color: {{ $barColor }};">
                        {{-- Optional: Display the count in the bar --}}
                    </div>
                </div>
                <div class="count">{{ $totalCount }} <i class="bi bi-person"></i></div> <!-- Show the count with an icon -->
            </div>
        @endforeach
    </div>
</div>




                </div>
            </div>
            
            {{-- <div class="levels-container" style="margin-top: 210px !important;">
                <p>Explore more in depth by navigating position level</p>
                @php
                    $levelWords = ['One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine', 'Ten', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen'];
                @endphp

                <div class="levels-buttons">
                    @foreach ($selectedLevels as $level)
                        @php
                            $level = trim($level);
                            $word = $levelWords[$level - 1] ?? $level; // fallback just in case
                            $anchorId = 'OverallCognitiveAbility' . $word;
                        @endphp
                        <button class="levels-button" onclick="location.href='#{{ $anchorId }}'">
                            Level {{ $level }}
                        </button>
                    @endforeach
                </div>
            </div> --}}
            <div class="footer">
                <div class="left-side">
                    <p>Report Prepared for: {{ $title }}</p>
                    <div class="line"></div>
                    <p>{{ $date }}</p>
                </div>
                <div class="right-side">
                    <p>© CXS Analytics 
                        {{-- /* <span>48</span> */ --}}
                        </p>
                </div>
            </div>
        </div>
    </div>

    @php
        $levelWords = ['One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine', 'Ten', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen'];
        $chartData = [];

        if (!function_exists('renderCognitiveSection')) {
            function renderCognitiveSection($title, $data, $chartId) {
                $total = array_sum($data);
                $getPercent = fn($count) => $total > 0 ? round(($count / $total) * 100) : 0;
                return '
                <div class="inner-content">
                    <div class="left-side-bar">
                        <h5>' . $title . '</h5>
                        <div class="percentage-container">'
                            . collect(['Low', 'Moderate', 'High'])->map(function($type) use ($data, $getPercent) {
                                $classes = [
                                    'High' => ['text-blue', 'bar-blue'],
                                    'Moderate' => ['text-green', 'bar-green'],
                                    'Low' => ['text-yellow', 'bar-yellow']
                                ];
                                $percent = $getPercent($data[$type]);
                                [$textClass, $barClass] = $classes[$type];
                                
                                if ($data[$type] > 0) {
                                    return '
                                        <div style="width: ' . $percent . '%">
                                            <div class="percentage ' . $textClass . '">' . $percent . '%</div>
                                            <div class="count">' . $data[$type] . ' <i class="bi bi-person"></i></div>
                                            <div class="bar ' . $barClass . '"></div>
                                        </div>';
                                } else {
                                    return '
                                        <div style="width: 0%"></div>';
                                }
                            })->implode('') .
                        '</div>
                    </div>
                    <div class="right-content">
                        <div id="' . $chartId . '" class="chart-overall"></div>
                        <div class="legend">
                            <div><span class="cyan-high"></span> High <b>' . $getPercent($data['High']) . '%</b></div>
                            <div><span class="green-moderate"></span> Moderate <b>' . $getPercent($data['Moderate']) . '%</b></div>
                            <div><span class="very-low"></span> Low <b>' . $getPercent($data['Low']) . '%</b></div>
                        </div>
                    </div>
                </div>';
            }
        }
    @endphp
    @if($hasLevelData)
    @foreach ($selectedLevels as $selectedLevel)
        @php
            $level = (int) $selectedLevel;
            $word = $levelWords[$level - 1] ?? $level;

            $cognitive = $resultCognitiveAbility->firstWhere('level', (string) $level);

            if (!$cognitive) {
                continue;
            }

            $quantitative = [
                'High' => (int) $cognitive->High_quantitative_knowledge,
                'Moderate' => (int) $cognitive->Moderate_quantitative_knowledge,
                'Low' => (int) $cognitive->Low_quantitative_knowledge
            ];
            $comprehension = [
                'High' => (int) $cognitive->High_comprehension_knowledge,
                'Moderate' => (int) $cognitive->Moderate_comprehension_knowledge,
                'Low' => (int) $cognitive->Low_comprehension_knowledge
            ];
            $visual = [
                'High' => (int) $cognitive->High_visual_reasoning,
                'Moderate' => (int) $cognitive->Moderate_visual_reasoning,
                'Low' => (int) $cognitive->Low_visual_reasoning
            ];
            $fluid = [
                'High' => (int) $cognitive->High_fluid_reasoning,
                'Moderate' => (int) $cognitive->Moderate_fluid_reasoning,
                'Low' => (int) $cognitive->Low_fluid_reasoning
            ];

            $chartData[] = [
                'word' => $word,
                'quant' => array_values($quantitative),
                'comp' => array_values($comprehension),
                'visual' => array_values($visual),
                'fluid' => array_values($fluid),
            ];
        @endphp

        <div class="container" id="OverallCognitiveAbility{{ $word }}">
            <div class="sidebar">
                <a href="#demographics"><h3>Demographics</h3></a>
                <a href="#overall"><h3>Overall Match Rate</h3></a>
                <a href="#technical"><h3>Technical Assessment</h3></a>
                <a href="#behavioralFitRate"><h3 style="margin-bottom: 6px">Behavioral Fit Rate</h3></a>
                <ul>
                    <li><a href="#JobMatchRate">Job Match Rate</a></li>
                    <li><a href="#SoftSkillsMatchRate">Soft Skills Match Rate</a></li>
                    <li><a href="#GrowthPotential">Growth Potential</a></li>
                    <li><a href="#WorkplaceAlignmentForecast">Workplace Alignment Forecast</a></li>
                    <li><a href="#FlightRisk">Flight Risk</a></li>
                    <li class="active"><a href="#OverallCognitiveAbility">Cognitive Ability</a></li>
                </ul>
                {{-- <i class="bi bi-house-door home-icon-sidebar"></i> --}}
            </div>

            <div class="third-body">
                <div class="third-content" style="padding-bottom: 0px !important">
                    <div class="third-first">
                        <div class="level-heading">
                            <h4 style="width: 560px">Overall Cognitive Ability</h4>
                            <h6>Job Position: <span>Level {{ $level }}</span></h6>
                        </div>
                    </div>
                </div>

                <div class="overall-content">
                    {!! renderCognitiveSection('Quantitative Knowledge', $quantitative, 'quantitativeKnowledge' . $word) !!}
                    {!! renderCognitiveSection('Comprehensive Knowledge', $comprehension, 'comprehensiveKnowledge' . $word) !!}
                    {!! renderCognitiveSection('Visual Reasoning', $visual, 'visualReasoning' . $word) !!}
                    {!! renderCognitiveSection('Fluid Reasoning', $fluid, 'fluidReasoning' . $word) !!}
                </div>

                <div class="vertical-level-sidebar" style="transform: translateY(-163%) rotate(180deg);">
                    @foreach (array_reverse($selectedLevels) as $sideLevel)
                        @php
                            $sideWord = $levelWords[$sideLevel - 1] ?? $sideLevel;
                            $sideId = 'OverallCognitiveAbility' . $sideWord;
                            $sideClass = $sideLevel == $level ? 'active-' . strtolower($sideWord) : '';
                        @endphp
                        <div class="level {{ $sideClass }}" onclick="location.href='#{{ $sideId }}'">
                            Level {{ $sideLevel }}
                        </div>
                    @endforeach
                </div>

                <div class="footer" style="margin-top: 25px;">
                    <div class="left-side">
                        <p>Report Prepared for: {{ $title }}</p>
                        <div class="line"></div>
                        <p>{{ $date }}</p>
                    </div>
                    <div class="right-side">
                        <p>© CXS Analytics 
                             {{-- <span>{{ $loop->iteration + 30 }}</span>  --}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    @endif

    {{-- Contact Us --}}
    <div class="container">
        <div class="contact-us">
            <div class="content">
                <img src="/images/pdf-images/insightaccessLogo.png" alt="Logo" />
                <h2>Contact Us</h2>
                <p><i class="bi bi-geo-alt-fill orange"></i> A-37-7 & 8, Menara UOA Bangsar, No.5, Jalan Bangsar Utama
                    1,
                    59000 Kuala Lumpur.</p>
                <p><i class="bi bi-telephone orange"></i> +03-50324926</p>
                <p><i class="bi bi-envelope orange"></i> info@cxsanalytics.com</p>
                <p class="bottom-content">© CXS Analytics. All Rights Reserved</p>
            </div>
        </div>
    </div>

    {{-- Loader --}}
    <div id="pdf-loader"
        style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); display: flex; align-items: center; justify-content: center; z-index: 9999;">
        <div class="spinner"></div>
        <p style="margin-left: 10px; color: white; font-size: 20px;">Generating PDF... Please wait</p>
    </div>

    <script>
        const chartData = @json($chartData);

        function createDonutChart(selector, series, labels, colors) {
            var options = {
                series: series,
                chart: {
                    type: 'donut',
                    width: 117,
                    height: 117
                },
                colors: colors,
                labels: labels,
                legend: {
                    show: false
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: false
                },
                plotOptions: {
                    pie: {
                        donut: {
                            size: '70%'
                        }
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector(selector), options);
            chart.render();
        }

        chartData.forEach(entry => {
            createDonutChart(`#quantitativeKnowledge${entry.word}`, entry.quant, ["High", "Moderate", "Low"], ['#1AC2C2', '#54CF6E', '#FFC549']);
            createDonutChart(`#comprehensiveKnowledge${entry.word}`, entry.comp, ["High", "Moderate", "Low"], ['#1AC2C2', '#54CF6E', '#FFC549']);
            createDonutChart(`#visualReasoning${entry.word}`, entry.visual, ["High", "Moderate", "Low"], ['#1AC2C2', '#54CF6E', '#FFC549']);
            createDonutChart(`#fluidReasoning${entry.word}`, entry.fluid, ["High", "Moderate", "Low"], ['#1AC2C2', '#54CF6E', '#FFC549']);
        });
    </script>

    {{-- <script>            
        document.addEventListener("DOMContentLoaded", function() {
            const omrLevelCounts = @json($omrLevelCounts);
            const omrCharts = @json($omrCharts ?? '');

            const taLevelCounts = @json($taLevelCounts);
            const taCharts = @json($taCharts ?? '');

            const bfrLevelCounts = @json($bfrLevelCounts);
            const bfrCharts = @json($bfrCharts);

            const jmrLevelCounts =  @json($jmrLevelCounts);
            const jmrCharts = @json($jmrCharts);
            
            const matchRateCounts =  @json($matchRateCounts);
            const mrCharts = @json($mrCharts);

            const growthPotentialCounts = @json($growthPotentialCounts);
            const gpCharts = @json($gpCharts);

            const workplaceAlignmentForecast = @json($workplaceAlignmentForecast);
            const wafCharts = @json($wafCharts);

            const flightRiskCounts = @json($flightRiskCounts);
            const frCharts = @json($frCharts);

            const catLevelCounts = @json($catLevelCounts);


            function createDonutChart(selector, series, labels, colors, totalCount, totalLabel, totalFontSize) {
                var options = {
                    series: series,
                    labels: labels,
                    chart: {
                        type: 'donut',
                        width: 450
                    },
                    colors: colors,
                    dataLabels: {
                        enabled: true,
                        formatter: function(val, opts) {
                            let label = opts.w.globals.labels[opts.seriesIndex];
                            let value = opts.w.globals.series[opts.seriesIndex];
                            return `${label} (${val.toFixed(0)}%) - ${value}`;
                        }
                    },
                    legend: {
                        show: false
                    },
                    stroke: {
                        show: false
                    },
                    plotOptions: {
                        pie: {
                            donut: {
                                size: '80%',
                                labels: {
                                    show: true,
                                    value: {
                                        show: true,
                                        color: '#5B5B5B',
                                        fontSize: totalFontSize || '28px',
                                        fontWeight: 500

                                    },
                                    total: {
                                        show: true,
                                        label: totalLabel || "Employees",
                                        color: '#5B5B5B',
                                        fontSize: totalFontSize || "28px",
                                        fontWeight: 500,
                                        formatter: function() {
                                            let totalStr = String(totalCount).trim();
                                            return totalStr.includes("%") ? totalStr : Number(totalStr)
                                                .toLocaleString();
                                        }
                                    }
                                }
                            }
                        }
                    }
                };

                new ApexCharts(document.querySelector(selector), options).render();
            }

            const totalOmr = omrLevelCounts.VeryHigh + 
                        omrLevelCounts.High + 
                        omrLevelCounts.Moderate + 
                        omrLevelCounts.Low + 
                        omrLevelCounts.VeryLow;

            if (totalOmr === 0) {
                createDonutChart("#chartOverallMatchRate", [0], [], ['#808080'], "0");
            } else {
                createDonutChart("#chartOverallMatchRate", 
                                [omrLevelCounts.VeryHigh, omrLevelCounts.High, omrLevelCounts.Moderate, omrLevelCounts.Low, omrLevelCounts.VeryLow], 
                                ["Very High", "High", "Moderate", "Low", " Very Low"], 
                                ['#108585', '#1AC2C2', '#8CE3E3', '#FFDC92', '#FFC549'], 
                                totalOmr);
            }

            omrCharts.forEach(chart => {
                const chartTotal = chart.values.reduce((acc, value) => acc + value, 0);
                if (chartTotal === 0) {
                    createDonutChart(`#${chart.id}`, [0], [], ['#808080'], "0");
                } else {
                    createDonutChart(
                        `#${chart.id}`,
                        chart.values,
                        chart.labels,
                        chart.colors,
                        chart.total.toString()
                    );
                }
            });

            const totalTa = taLevelCounts.VeryHigh + 
                            taLevelCounts.High + 
                            taLevelCounts.Moderate + 
                            taLevelCounts.Low + 
                            taLevelCounts.VeryLow;

            if (totalTa === 0) {
                createDonutChart("#chartTechnicalAssessment", [0], [], ['#808080'], "0");
            } else {
                createDonutChart("#chartTechnicalAssessment", 
                                [taLevelCounts.VeryHigh, taLevelCounts.High, taLevelCounts.Moderate, taLevelCounts.Low, taLevelCounts.VeryLow], 
                                ["Very High", "High", "Moderate", "Low", " Very Low"], 
                                ['#108585', '#1AC2C2', '#8CE3E3', '#FFDC92', '#FFC549'], 
                                totalTa);
            }

            taCharts.forEach(chart => {
                const chartTotal = chart.values.reduce((acc, value) => acc + value, 0);
                if (chartTotal === 0) {
                    createDonutChart(`#${chart.id}`, [0], [], ['#808080'], "0");
                } else {
                    createDonutChart(
                        `#${chart.id}`,
                        chart.values,
                        chart.labels,
                        chart.colors,
                        chart.total.toString()
                    );
                }
            });

            const totalBfr = bfrLevelCounts.VeryHigh + 
                                bfrLevelCounts.High + 
                                bfrLevelCounts.Moderate + 
                                bfrLevelCounts.Low + 
                                bfrLevelCounts.VeryLow;

            if (totalBfr === 0) {
                createDonutChart("#chartBehavioralFitRate", [0], [], ['#808080'], "0");
            } else {
                createDonutChart("#chartBehavioralFitRate", 
                                [bfrLevelCounts.VeryHigh, bfrLevelCounts.High, bfrLevelCounts.Moderate, bfrLevelCounts.Low, bfrLevelCounts.VeryLow], 
                                ["Very High", "High", "Moderate", "Low", " Very Low"], 
                                ['#108585', '#1AC2C2', '#8CE3E3', '#FFDC92', '#FFC549'], 
                                totalBfr);
            }

            bfrCharts.forEach(chart => {
                const chartTotal = chart.values.reduce((acc, value) => acc + value, 0);
                if (chartTotal === 0) {
                    createDonutChart(`#${chart.id}`, [0], [], ['#808080'], "0");
                } else {
                    createDonutChart(
                        `#${chart.id}`,
                        chart.values,
                        chart.labels,
                        chart.colors,
                        chart.total.toString()
                    );
                }
            });

            const totalJmr = jmrLevelCounts.VeryHigh + 
                            jmrLevelCounts.High + 
                            jmrLevelCounts.Moderate + 
                            jmrLevelCounts.Low + 
                            jmrLevelCounts.VeryLow;

            if (totalJmr === 0) {
                createDonutChart("#chartJobMatchRate", [0], [], ['#808080'], "0");
            } else {
                createDonutChart("#chartJobMatchRate", 
                                [jmrLevelCounts.VeryHigh, jmrLevelCounts.High, jmrLevelCounts.Moderate, jmrLevelCounts.Low, jmrLevelCounts.VeryLow], 
                                ["Very High", "High", "Moderate", "Low", " Very Low"], 
                                ['#108585', '#1AC2C2', '#8CE3E3', '#FFDC92', '#FFC549'], 
                                totalJmr);
            }

            jmrCharts.forEach(chart => {
                const chartTotal = chart.values.reduce((acc, value) => acc + value, 0);
                if (chartTotal === 0) {
                    createDonutChart(`#${chart.id}`, [0], [], ['#808080'], "0");
                } else {
                    createDonutChart(
                        `#${chart.id}`,
                        chart.values,
                        chart.labels,
                        chart.colors,
                        chart.total.toString()
                    );
                }
            });

            const totalMr = matchRateCounts.VeryHigh + 
                    matchRateCounts.High + 
                    matchRateCounts.Moderate + 
                    matchRateCounts.Low + 
                    matchRateCounts.VeryLow;

            if (totalMr === 0) {
                createDonutChart("#chartSoftSkillsMatchRate", [0], [], ['#808080'], "0");
            } else {
                createDonutChart("#chartSoftSkillsMatchRate", 
                                [matchRateCounts.VeryHigh, matchRateCounts.High, matchRateCounts.Moderate, matchRateCounts.Low, matchRateCounts.VeryLow], 
                                ["Very High", "High", "Moderate", "Low", " Very Low"], 
                                ['#108585', '#1AC2C2', '#8CE3E3', '#FFDC92', '#FFC549'], 
                                totalMr);
            }

            mrCharts.forEach(chart => {
                const chartTotal = chart.values.reduce((acc, value) => acc + value, 0);
                if (chartTotal === 0) {
                    createDonutChart(`#${chart.id}`, [0], [], ['#808080'], "0");
                } else {
                    createDonutChart(
                        `#${chart.id}`,
                        chart.values,
                        chart.labels,
                        chart.colors,
                        chart.total.toString()
                    );
                }
            });

            const totalGp = growthPotentialCounts.VeryHigh + 
                            growthPotentialCounts.High + 
                            growthPotentialCounts.Moderate + 
                            growthPotentialCounts.Low + 
                            growthPotentialCounts.VeryLow;

            if (totalGp === 0) {
                createDonutChart("#chartGrowthPotential", [0], [], ['#808080'], "0");
            } else {
                createDonutChart("#chartGrowthPotential", 
                                [growthPotentialCounts.VeryHigh, growthPotentialCounts.High, growthPotentialCounts.Moderate, growthPotentialCounts.Low, growthPotentialCounts.VeryLow], 
                                ["Very High", "High", "Moderate", "Low", " Very Low"], 
                                ['#108585', '#1AC2C2', '#8CE3E3', '#FFDC92', '#FFC549'], 
                                totalGp);
            }

            gpCharts.forEach(chart => {
                const chartTotal = chart.values.reduce((acc, value) => acc + value, 0);
                if (chartTotal === 0) {
                    createDonutChart(`#${chart.id}`, [0], [], ['#808080'], "0");
                } else {
                    createDonutChart(
                        `#${chart.id}`,
                        chart.values,
                        chart.labels,
                        chart.colors,
                        chart.total.toString()
                    );
                }
            });

            const totalWaf = workplaceAlignmentForecast.VeryHigh + 
                                workplaceAlignmentForecast.High + 
                                workplaceAlignmentForecast.Moderate + 
                                workplaceAlignmentForecast.Low + 
                                workplaceAlignmentForecast.VeryLow;

            if (totalWaf === 0) {
                createDonutChart("#chartWorkplaceAlignmentForecast", [0], [], ['#808080'], "0");
            } else {
                createDonutChart("#chartWorkplaceAlignmentForecast", 
                                [workplaceAlignmentForecast.VeryHigh, workplaceAlignmentForecast.High, workplaceAlignmentForecast.Moderate, workplaceAlignmentForecast.Low, workplaceAlignmentForecast.VeryLow], 
                                ["Very High Risk", "High Risk", "Moderate Risk", "Low Risk", " Very Low Risk"], 
                                ['#FF6355', '#FFC1BB', '#FFE4AA', '#AA91F4', '#7F66CA'],                                
                                totalWaf);
            }

            wafCharts.forEach(chart => {
                const chartTotal = chart.values.reduce((acc, value) => acc + value, 0);
                if (chartTotal === 0) {
                    createDonutChart(`#${chart.id}`, [0], [], ['#808080'], "0");
                } else {
                    createDonutChart(
                        `#${chart.id}`,
                        chart.values,
                        chart.labels,
                        chart.colors,
                        chart.total.toString()
                    );
                }
            });

            const totalFr = flightRiskCounts.VeryHigh + 
                            flightRiskCounts.High + 
                            flightRiskCounts.Moderate + 
                            flightRiskCounts.Low + 
                            flightRiskCounts.VeryLow;

            if (totalFr === 0) {
                createDonutChart("#chartFlightRisk", [0], [], ['#808080'], "0");
            } else {
                createDonutChart("#chartFlightRisk", 
                                [flightRiskCounts.VeryHigh, flightRiskCounts.High, flightRiskCounts.Moderate, flightRiskCounts.Low, flightRiskCounts.VeryLow], 
                                ["Very High Risk", "High Risk", "Moderate Risk", "Low Risk", " Very Low Risk"], 
                                ['#FF6355', '#FFC1BB', '#FFE4AA', '#AA91F4', '#7F66CA'],                                
                                totalFr);
            }

            frCharts.forEach(chart => {
                const chartTotal = chart.values.reduce((acc, value) => acc + value, 0);
                if (chartTotal === 0) {
                    createDonutChart(`#${chart.id}`, [0], [], ['#808080'], "0");
                } else {
                    createDonutChart(
                        `#${chart.id}`,
                        chart.values,
                        chart.labels,
                        chart.colors,
                        chart.total.toString()
                    );
                }
            });

            const totalCat = catLevelCounts.High + 
                            catLevelCounts.Moderate + 
                            catLevelCounts.Low;

            if (totalCat === 0) {
                createDonutChart("#chartOverallCognitiveAbility", [0], [], ['#808080'], "0");
            } else {
                createDonutChart("#chartOverallCognitiveAbility", 
                                [catLevelCounts.High, catLevelCounts.Moderate, catLevelCounts.Low], 
                                ["High", "Moderate", "Low"], 
                                ['#3FD0D0', '#54CF6E', '#FFC549'],                                
                                totalCat);
            }

            createDonutChart("#chartSafetyOne", [59, 30, 13], ["Highly Aligned", "Aligned", "Need Development"], [
                    '#AA91F4', '#3FD0D0', '#FFC549'
                ],
                "87%", "highly aligned & aligned", "22px");
            createDonutChart("#chartCelebrateAllIndividuals​", [55, 28, 19], ["Highly Aligned", "Aligned",
                    "Need Development"
                ], ['#AA91F4', '#3FD0D0', '#FFC549'],
                "81%", "highly aligned & aligned", "22px");
            createDonutChart("#chartBeTransparent",
                [42, 38, 22],
                ["Highly Aligned", "Aligned", "Need Development"],
                ['#AA91F4', '#3FD0D0', '#FFC549'],
                "78%",
                "highly aligned & aligned",
                "22px"
            );
            createDonutChart("#chartMakeDifference​", [41, 37, 24], ["Highly Aligned", "Aligned",
                    "Need Development"
                ], [
                    '#AA91F4', '#3FD0D0', '#FFC549'
                ],
                "76%", "highly aligned & aligned", "22px");
            createDonutChart("#chartKeepItSimple", [35, 35, 32], ["Highly Aligned", "Aligned", "Need Development"],
                [
                    '#AA91F4', '#3FD0D0', '#FFC549'
                ],
                "68%", "highly aligned & aligned", "22px");
            createDonutChart("#chartAllForOne​", [30, 39, 33], ["Highly Aligned", "Aligned", "Need Development"], [
                    '#AA91F4', '#3FD0D0', '#FFC549'
                ],
                "68%", "highly aligned & aligned", "22px");
            createDonutChart("#chartHaveEmpathyRespect", [29, 39, 34], ["Highly Aligned", "Aligned",
                    "Need Development"
                ], [
                    '#AA91F4', '#3FD0D0', '#FFC549'
                ],
                "67%", "highly aligned & aligned", "22px");
            createDonutChart("#chartDareToDream​", [21, 46, 35], ["Highly Aligned", "Aligned", "Need Development"],
                [
                    '#AA91F4', '#3FD0D0', '#FFC549'
                ],
                "66%", "highly aligned & aligned", "22px");
        });
    </script> --}}

    <script>
document.addEventListener("DOMContentLoaded", function () {
  // ---- JSON from blade; always default arrays to [] ----
  const omrLevelCounts = @json($omrLevelCounts);
  const omrCharts = @json($omrCharts ?? []);

  const taLevelCounts = @json($taLevelCounts);
  const taCharts = @json($taCharts ?? []);

  const bfrLevelCounts = @json($bfrLevelCounts);
  const bfrCharts = @json($bfrCharts ?? []);

  const jmrLevelCounts = @json($jmrLevelCounts);
  const jmrCharts = @json($jmrCharts ?? []);

  const matchRateCounts = @json($matchRateCounts);
  const mrCharts = @json($mrCharts ?? []);

  const growthPotentialCounts = @json($growthPotentialCounts);
  const gpCharts = @json($gpCharts ?? []);

  const workplaceAlignmentForecast = @json($workplaceAlignmentForecast);
  const wafCharts = @json($wafCharts ?? []);

  const flightRiskCounts = @json($flightRiskCounts);
  const frCharts = @json($frCharts ?? []);

  const catLevelCounts = @json($catLevelCounts);

  // ---- helpers ----
  const nz = (v) => (Number.isFinite(+v) ? +v : 0); // numeric-or-zero
  function safeSum(obj, keys) {
    return keys.reduce((s, k) => s + nz(obj?.[k]), 0);
  }
  function forEachChart(list, cb) {
    if (Array.isArray(list) && list.length) list.forEach(cb);
  }

  function createDonutChart(selector, series, labels, colors, totalCount, totalLabel, totalFontSize) {
    const el = document.querySelector(selector);
    if (!el) return;

    const options = {
      series,
      labels,
      chart: { type: "donut", width: 450 },
      colors,
      dataLabels: {
        enabled: true,
        formatter: function (val, opts) {
          const label = opts?.w?.globals?.labels?.[opts.seriesIndex] || "";
          const value = opts?.w?.globals?.series?.[opts.seriesIndex] ?? 0;
          return label ? `${label} (${val.toFixed(0)}%) - ${value}` : `${val.toFixed(0)}% - ${value}`;
        },
      },
      legend: { show: false },
      stroke: { show: false },
      plotOptions: {
        pie: {
            donut: {
            size: "80%",
            labels: {
                show: true,
                value: {
                show: true,
                color: "#5B5B5B",
                fontSize: totalFontSize || "28px",
                fontWeight: 500,
                },
                total: {
                show: true,
                label: String(totalCount ?? "0"),
                color: "#5B5B5B",
                fontSize: totalFontSize || "28px",
                fontWeight: 500,
                formatter: function () {
                    return totalLabel || "Employees";
                },
                },
            },
            },
        },
    },
    };

    new ApexCharts(el, options).render();
  }

  // ===================== OVERALL DONUTS =====================

  // Overall Match Rate
  const totalOmr = safeSum(omrLevelCounts, ["VeryHigh", "High", "Moderate", "Low", "VeryLow"]);
  if (totalOmr === 0) {
    createDonutChart(
        "#chartOverallMatchRate",
        [1],
        ["No Data"],
        ['#EBEBEB'],
        "0",
        "Employees",
    );
} else {
    createDonutChart(
      "#chartOverallMatchRate",
      [nz(omrLevelCounts.VeryHigh), nz(omrLevelCounts.High), nz(omrLevelCounts.Moderate), nz(omrLevelCounts.Low), nz(omrLevelCounts.VeryLow)],
      ["Very High", "High", "Moderate", "Low", "Very Low"],
      ["#108585", "#1AC2C2", "#8CE3E3", "#FFDC92", "#FFC549"],
      totalOmr
    );
  }

  // Technical Assessment
  const totalTa = safeSum(taLevelCounts, ["VeryHigh", "High", "Moderate", "Low", "VeryLow"]);
  if (totalTa === 0) {
     createDonutChart(
        "#chartTechnicalAssessment",
        [1],
        ["No Data"],
        ['#EBEBEB'],
        "0",
        "Employees",
    );
  } else {
    createDonutChart(
      "#chartTechnicalAssessment",
      [nz(taLevelCounts.VeryHigh), nz(taLevelCounts.High), nz(taLevelCounts.Moderate), nz(taLevelCounts.Low), nz(taLevelCounts.VeryLow)],
      ["Very High", "High", "Moderate", "Low", "Very Low"],
      ["#108585", "#1AC2C2", "#8CE3E3", "#FFDC92", "#FFC549"],
      totalTa
    );
  }

  // Behavioral Fit Rate
  const totalBfr = safeSum(bfrLevelCounts, ["VeryHigh", "High", "Moderate", "Low", "VeryLow"]);
  if (totalBfr === 0) {
     createDonutChart(
        "#chartBehavioralFitRate",
        [1],
        ["No Data"],
        ['#EBEBEB'],
        "0",
        "Employees",
    );
  } else {
    createDonutChart(
      "#chartBehavioralFitRate",
      [nz(bfrLevelCounts.VeryHigh), nz(bfrLevelCounts.High), nz(bfrLevelCounts.Moderate), nz(bfrLevelCounts.Low), nz(bfrLevelCounts.VeryLow)],
      ["Very High", "High", "Moderate", "Low", "Very Low"],
      ["#108585", "#1AC2C2", "#8CE3E3", "#FFDC92", "#FFC549"],
      totalBfr
    );
  }

  // Job Match Rate
  const totalJmr = safeSum(jmrLevelCounts, ["VeryHigh", "High", "Moderate", "Low", "VeryLow"]);
  if (totalJmr === 0) {
     createDonutChart(
        "#chartJobMatchRate",
        [1],
        ["No Data"],
        ['#EBEBEB'],
        "0",
        "Employees",
    );
  } else {
    createDonutChart(
      "#chartJobMatchRate",
      [nz(jmrLevelCounts.VeryHigh), nz(jmrLevelCounts.High), nz(jmrLevelCounts.Moderate), nz(jmrLevelCounts.Low), nz(jmrLevelCounts.VeryLow)],
      ["Very High", "High", "Moderate", "Low", "Very Low"],
      ["#108585", "#1AC2C2", "#8CE3E3", "#FFDC92", "#FFC549"],
      totalJmr
    );
  }

  // Soft Skills Match Rate (MR)
  const totalMr = safeSum(matchRateCounts, ["VeryHigh", "High", "Moderate", "Low", "VeryLow"]);
  if (totalMr === 0) {
     createDonutChart(
        "#chartSoftSkillsMatchRate",
        [1],
        ["No Data"],
        ['#EBEBEB'],
        "0",
        "Employees",
    );
  } else {
    createDonutChart(
      "#chartSoftSkillsMatchRate",
      [nz(matchRateCounts.VeryHigh), nz(matchRateCounts.High), nz(matchRateCounts.Moderate), nz(matchRateCounts.Low), nz(matchRateCounts.VeryLow)],
      ["Very High", "High", "Moderate", "Low", "Very Low"],
      ["#108585", "#1AC2C2", "#8CE3E3", "#FFDC92", "#FFC549"],
      totalMr
    );
  }

  // Growth Potential
  const totalGp = safeSum(growthPotentialCounts, ["VeryHigh", "High", "Moderate", "Low", "VeryLow"]);
  if (totalGp === 0) {
     createDonutChart(
        "#chartGrowthPotential",
        [1],
        ["No Data"],
        ['#EBEBEB'],
        "0",
        "Employees",
    );
  } else {
    createDonutChart(
      "#chartGrowthPotential",
      [nz(growthPotentialCounts.VeryHigh), nz(growthPotentialCounts.High), nz(growthPotentialCounts.Moderate), nz(growthPotentialCounts.Low), nz(growthPotentialCounts.VeryLow)],
      ["Very High", "High", "Moderate", "Low", "Very Low"],
      ["#108585", "#1AC2C2", "#8CE3E3", "#FFDC92", "#FFC549"],
      totalGp
    );
  }

  // Workplace Alignment Forecast (Risk)
  const totalWaf = safeSum(workplaceAlignmentForecast, ["VeryHigh", "High", "Moderate", "Low", "VeryLow"]);
  if (totalWaf === 0) {
     createDonutChart(
        "#chartWorkplaceAlignmentForecast",
        [1],
        ["No Data"],
        ['#EBEBEB'],
        "0",
        "Employees",
    );
  } else {
    createDonutChart(
      "#chartWorkplaceAlignmentForecast",
      [nz(workplaceAlignmentForecast.VeryHigh), nz(workplaceAlignmentForecast.High), nz(workplaceAlignmentForecast.Moderate), nz(workplaceAlignmentForecast.Low), nz(workplaceAlignmentForecast.VeryLow)],
      ["Very High Risk", "High Risk", "Moderate Risk", "Low Risk", "Very Low Risk"],
      ["#FF6355", "#FFC1BB", "#FCCF98", "#AA91F4", "#7F66CA"],
      totalWaf
    );
  }

  // Flight Risk
  const totalFr = safeSum(flightRiskCounts, ["VeryHigh", "High", "Moderate", "Low", "VeryLow"]);
  if (totalFr === 0) {
     createDonutChart(
        "#chartFlightRisk",
        [1],
        ["No Data"],
        ['#EBEBEB'],
        "0",
        "Employees",
    );
  } else {
    createDonutChart(
      "#chartFlightRisk",
      [nz(flightRiskCounts.VeryHigh), nz(flightRiskCounts.High), nz(flightRiskCounts.Moderate), nz(flightRiskCounts.Low), nz(flightRiskCounts.VeryLow)],
      ["Very High Risk", "High Risk", "Moderate Risk", "Low Risk", "Very Low Risk"],
      ["#FF6355", "#FFC1BB", "#FCCF98", "#AA91F4", "#7F66CA"],
      totalFr
    );
  }

  // Overall Cognitive Ability
  const totalCat = safeSum(catLevelCounts, ["High", "Moderate", "Low"]);
  if (totalCat === 0) {
     createDonutChart(
        "#chartOverallCognitiveAbility",
        [1],
        ["No Data"],
        ['#EBEBEB'],
        "0",
        "Employees",
    );
  } else {
    createDonutChart(
      "#chartOverallCognitiveAbility",
      [nz(catLevelCounts.High), nz(catLevelCounts.Moderate), nz(catLevelCounts.Low)],
      ["High", "Moderate", "Low"],
      ["#3FD0D0", "#54CF6E", "#FFC549"],
      totalCat
    );
  }

  // ===================== PER-LEVEL DONUTS (SAFE LOOPS) =====================
  forEachChart(omrCharts, (chart) => {
    const total = (chart?.values || []).reduce((a, v) => a + nz(v), 0);
    if (total === 0) createDonutChart(`#${chart.id}`,[1],["No Data"],['#EBEBEB'],"0","Employees");
    else createDonutChart(`#${chart.id}`, chart.values, chart.labels, chart.colors, String(chart.total ?? total));
  });

  forEachChart(taCharts, (chart) => {
    const total = (chart?.values || []).reduce((a, v) => a + nz(v), 0);
    if (total === 0) createDonutChart(`#${chart.id}`,[1],["No Data"],['#EBEBEB'],"0","Employees");
    else createDonutChart(`#${chart.id}`, chart.values, chart.labels, chart.colors, String(chart.total ?? total));
  });

  forEachChart(bfrCharts, (chart) => {
    const total = (chart?.values || []).reduce((a, v) => a + nz(v), 0);
    if (total === 0) createDonutChart(`#${chart.id}`,[1],["No Data"],['#EBEBEB'],"0","Employees");
    else createDonutChart(`#${chart.id}`, chart.values, chart.labels, chart.colors, String(chart.total ?? total));
  });

  forEachChart(jmrCharts, (chart) => {
    const total = (chart?.values || []).reduce((a, v) => a + nz(v), 0);
    if (total === 0) createDonutChart(`#${chart.id}`,[1],["No Data"],['#EBEBEB'],"0","Employees");
    else createDonutChart(`#${chart.id}`, chart.values, chart.labels, chart.colors, String(chart.total ?? total));
  });

  forEachChart(mrCharts, (chart) => {
    const total = (chart?.values || []).reduce((a, v) => a + nz(v), 0);
    if (total === 0) createDonutChart(`#${chart.id}`,[1],["No Data"],['#EBEBEB'],"0","Employees");
    else createDonutChart(`#${chart.id}`, chart.values, chart.labels, chart.colors, String(chart.total ?? total));
  });

  forEachChart(gpCharts, (chart) => {
    const total = (chart?.values || []).reduce((a, v) => a + nz(v), 0);
    if (total === 0) createDonutChart(`#${chart.id}`,[1],["No Data"],['#EBEBEB'],"0","Employees");
    else createDonutChart(`#${chart.id}`, chart.values, chart.labels, chart.colors, String(chart.total ?? total));
  });

  forEachChart(wafCharts, (chart) => {
    const total = (chart?.values || []).reduce((a, v) => a + nz(v), 0);
    if (total === 0) createDonutChart(`#${chart.id}`,[1],["No Data"],['#EBEBEB'],"0","Employees");
    else createDonutChart(`#${chart.id}`, chart.values, chart.labels, chart.colors, String(chart.total ?? total));
  });

  forEachChart(frCharts, (chart) => {
    const total = (chart?.values || []).reduce((a, v) => a + nz(v), 0);
    if (total === 0) createDonutChart(`#${chart.id}`,[1],["No Data"],['#EBEBEB'],"0","Employees");
    else createDonutChart(`#${chart.id}`, chart.values, chart.labels, chart.colors, String(chart.total ?? total));
  });

  // ===================== CULTURE/CUSTOM DONUTS (unchanged) =====================
  createDonutChart("#chartSafetyOne", [59, 30, 13], ["Highly Aligned", "Aligned", "Need Development"], ["#AA91F4", "#3FD0D0", "#FFC549"], "87%", "highly aligned & aligned", "22px");
  createDonutChart("#chartCelebrateAllIndividuals​", [55, 28, 19], ["Highly Aligned", "Aligned", "Need Development"], ["#AA91F4", "#3FD0D0", "#FFC549"], "81%", "highly aligned & aligned", "22px");
  createDonutChart("#chartBeTransparent", [42, 38, 22], ["Highly Aligned", "Aligned", "Need Development"], ["#AA91F4", "#3FD0D0", "#FFC549"], "78%", "highly aligned & aligned", "22px");
  createDonutChart("#chartMakeDifference​", [41, 37, 24], ["Highly Aligned", "Aligned", "Need Development"], ["#AA91F4", "#3FD0D0", "#FFC549"], "76%", "highly aligned & aligned", "22px");
  createDonutChart("#chartKeepItSimple", [35, 35, 32], ["Highly Aligned", "Aligned", "Need Development"], ["#AA91F4", "#3FD0D0", "#FFC549"], "68%", "highly aligned & aligned", "22px");
  createDonutChart("#chartAllForOne​", [30, 39, 33], ["Highly Aligned", "Aligned", "Need Development"], ["#AA91F4", "#3FD0D0", "#FFC549"], "68%", "highly aligned & aligned", "22px");
  createDonutChart("#chartHaveEmpathyRespect", [29, 39, 34], ["Highly Aligned", "Aligned", "Need Development"], ["#AA91F4", "#3FD0D0", "#FFC549"], "67%", "highly aligned & aligned", "22px");
  createDonutChart("#chartDareToDream​", [21, 46, 35], ["Highly Aligned", "Aligned", "Need Development"], ["#AA91F4", "#3FD0D0", "#FFC549"], "66%", "highly aligned & aligned", "22px");
});
</script>

    <script>

        const positionLevelData = @json($positionLevelData);
        
        const categories = positionLevelData.map(item => item.level.toString());
        const seriesData = positionLevelData.map(item => item.user_count);
        
        var options = {
            series: [{
                data: seriesData, 
            }],
            chart: {
                type: "bar",
                toolbar: { show: false },
                height: 210,
            },
            plotOptions: {
                bar: {
                    horizontal: true,
                    distributed: true,
                    barHeight: '80%', 
                    borderRadius: 2,
                    borderRadiusApplication: "end",
                    dataLabels: {
                        position: 'top' 
                    }
                }
            },
            colors: ["#FCCF98", "#FABB6E", "#F9A845", "#F7941C", "#D97B16", "#C26612", "#AB520E", "#943D0A", "#7D2906"],
            dataLabels: {
                enabled: true,
                offsetX: 10,  
                formatter: function(val) {
                    return val + "";
                },
                style: {
                    fontSize: "12px",
                    fontWeight: "medium",
                    colors: ["#A0A0A0"],
                },
            },
            xaxis: {
                categories: categories, 
                labels: {
                    style: {
                        fontSize: "14px",
                        fontWeight: 500,
                        color: "#5B5B5B",
                    },
                },
                axisBorder: {
                    show: true,
                    color: "#F2F2F2",
                },
                axisTicks: {
                    show: true,
                    color: "#fafafb",
                },
                min: 0,
            },
            grid: {
                borderColor: "#F2F2F2",
                padding: {
                    top: 20,    
                    bottom: 20 
                }
            },
            
            yaxis: {
                labels: {
                    style: {
                        fontSize: "10.5px",
                    },
                    offsetY: 5 
                },
                axisBorder: {
                    show: true,
                    color: '#F2F2F2',
                    offsetX: 0,
                    offsetY: 10 
                }
            },
            legend: {
                show: false
            },
        };

        var chart = new ApexCharts(
            document.querySelector("#chartPositionLevel"),
            options
        );
        chart.render();
    </script>

<script>
    const ageData = @json($ageData);

    var options = {
        series: Object.values(ageData), 
        chart: {
            type: "donut",
            height: 210,
        },
        labels: Object.keys(ageData), 
        colors: ["#24B3F0", "#FFC549", "#BBA7F6", "#3FD0D0"],
        stroke: {
            width: 0,
        },
        plotOptions: {
            pie: {
                donut: {
                    size: "77%",
                },
            },
        },
        dataLabels: {
            enabled: true,
            formatter: function (val, opts) {
                const seriesIndex = opts.seriesIndex;
                const value = opts.w.config.series[seriesIndex];
                const total = opts.w.globals.seriesTotals.reduce((a, b) => a + b, 0);
                const percentage = ((value / total) * 100).toFixed(1);
                return `${value} (${percentage}%)`;
            },
            style: {
                fontSize: "11px",
                fontWeight: "bold",
                colors: ["#fff"]
            }
        },
        tooltip: {
            enabled: true,
        },
        legend: {
            show: false,
        },
    };

    var chart = new ApexCharts(document.querySelector("#chartAge"), options);
    chart.render();
</script>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>

    <script>
window.onload = function () {
    var checkChartLoaded = setInterval(function () {
        var charts = document.querySelectorAll('.apexcharts-canvas');
        if (charts.length > 0 && charts[0].clientHeight > 0) {
            clearInterval(checkChartLoaded);

            document.getElementById('pdf-loader').style.display = 'flex';
            document.body.classList.add('no-scroll'); // ✅ Disable scroll

            setTimeout(function () {
                let loader = document.getElementById('pdf-loader');
                loader.style.display = 'flex';

                let clonedBody = document.body.cloneNode(true);

                let loaderClone = clonedBody.querySelector('#pdf-loader');
                if (loaderClone) loaderClone.remove();

                clonedBody.querySelectorAll("a").forEach(link => {
                    link.setAttribute("data-href", link.getAttribute("href"));
                    link.removeAttribute("href");
                    link.style.pointerEvents = "none";
                });

                html2pdf()
    .from(clonedBody)
    .set({
        jsPDF: {
            format: 'Legal',
            orientation: 'landscape'
        },
        html2canvas: {
            scale: 1.5,
            scrollX: 0,
            scrollY: -window.scrollY,
            onclone: (doc) => {
                doc.querySelectorAll('line.apexcharts-ycrosshairs').forEach(line => {
                    line.remove();
                });
            }
        },
    })
    .toPdf()
    .get('pdf')
    .then(function (pdf) {
        const totalPages = pdf.internal.getNumberOfPages();
        const pageWidth = pdf.internal.pageSize.getWidth();
        const pageHeight = pdf.internal.pageSize.getHeight();

        for (let i = 1; i <= totalPages; i++) {
            pdf.setPage(i);
            pdf.setFontSize(10);
            pdf.setTextColor(100);

            // ✅ Page numbers only (bottom-right)
            pdf.text(
                `${i} of ${totalPages}`,
                pageWidth - 14,  // adjust X position
                pageHeight - 5.7  // adjust Y position
            );
        }

        loader.style.display = 'none';
        document.body.classList.remove('no-scroll');
        pdf.save("downloaded-file.pdf");

        // Restore links
        document.querySelectorAll("a").forEach(link => {
            if (link.hasAttribute("data-href")) {
                link.setAttribute("href", link.getAttribute("data-href"));
                link.removeAttribute("data-href");
                link.style.pointerEvents = "auto";
            }
        });
        window.history.back();
    });

    
    
    // .then(function () {
    //     window.history.back();
    // });

            }, 3000);
        }
    }, 500);
};
</script>
</body>

</html>
