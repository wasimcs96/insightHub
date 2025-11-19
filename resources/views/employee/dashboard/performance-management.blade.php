@extends('employee.layout.app')

@section('title', 'Dashboard')

@section('styles')
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <style>
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

        .table-text-bold {

            /* Label/Medium/Medium */
            font-family: 'Inter';
            font-style: normal;
            font-weight: 700;
            font-size: 12px;
            line-height: 16px;
            /* identical to box height, or 133% */

            color: #4B5675;



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
            padding: 10px;
            width: 100%;
            border-radius: 10px;
            /* border: 1px solid #F1F1F4;
        box-shadow: 0px 3px 4px rgba(0, 0, 0, 0.03);
        border-radius: 8px; */

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
            /* box-shadow: 0 0 15px rgba(0, 0, 0, 0.1); */
        }

        .small-head-total {

            font-family: 'Inter';
            font-style: normal;
            font-weight: 600;
            font-size: 12px;
            line-height: 16px;
            /* identical to box height, or 133% */

            color: #071437;

        }

        hr {
            background: #DBDFE9;
            height: 2px;
            border: none !important;
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
            /* border-bottom: 1px solid #ddd; */
            border: none;

        }

        th {
            background-color: white;
            color: black;
        }

        /* tr:hover {
            background-color: #ddd;
        } */

        td {
            color: #333;
            border: none;

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
            transition: all 0.2s ease-in-out;
        }

        .dropdown-toggle:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .dropdown-toggle-two {
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
            transition: all 0.2s ease-in-out;
        }

        .dropdown-toggle-two:hover {
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

        .table-container {
            overflow-x: auto;
        }

        .kpi-table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
        }

        .kpi-table th,
        .kpi-table td {
            /* border: 1px solid #ddd; */
            padding: 12px;
            text-align: left;
            vertical-align: top;
            border: none;

            /* Label/Medium/Medium */
            font-family: 'Inter';
            font-style: normal;
            font-weight: 500;
            font-size: 12px;
            line-height: 16px;
            /* or 133% */

            color: #4B5675;


        }

        .tabel-top-header {

            font-family: 'Inter';
            font-style: normal;
            font-weight: 600;
            font-size: 14px;
            line-height: 20px;
            /* identical to box height, or 143% */

            color: #071437;




        }

        .donut-chart-wrapper {
            margin-top: 20px;
        }

        .kpi-table th {
            background-color: #FFFFFF;
            font-weight: bold;

            font-family: 'Inter';
            font-style: normal;
            font-weight: 600;
            font-size: 12px;
            line-height: 16px;
            /* identical to box height, or 133% */

            color: #99A1B7;


        }

        .kpi-table tr {
            background-color: #FAFAFB;
        }

        .kpi-table tr:nth-child(even) {
            background-color: #FAFAFB;
        }


        .kpi-table strong {
            font-size: 1.1em;
            color: #333;
        }

        .skills-rating {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
        }

        .skills-rating th,
        .skills-rating td {
            /* border: 1px solid #ddd; */
            padding: 12px;
            text-align: left;
            vertical-align: top;
            border: none;
            /* Label/Medium/Medium */
            font-family: 'Inter';
            font-style: normal;
            font-weight: 500;
            font-size: 12px;
            line-height: 16px;
            /* or 133% */

            color: #4B5675;


        }

        .tabel-top-header {

            font-family: 'Inter';
            font-style: normal;
            font-weight: 600;
            font-size: 14px;
            line-height: 20px;
            /* identical to box height, or 143% */

            color: #071437;




        }

        .skills-rating th {
            background-color: #FFFFFF;
            font-weight: bold;

            font-family: 'Inter';
            font-style: normal;
            font-weight: 600;
            font-size: 12px;
            line-height: 16px;
            /* identical to box height, or 133% */

            color: #99A1B7;


        }

        .skills-rating tr {
            background-color: #FFFFFF;
        }

        .skills-rating tr:nth-child(odd) {
            background-color: #FAFAFB;
        }


        .skills-rating strong {
            font-size: 1.1em;
            color: #333;
        }

        .mr-top {
            margin-top: 20px;
        }

        .donut-wrapper {
            position: relative;
        }

        .donut-text-wrapper {
            top: 85px;
            left: 55px;
            position: absolute;
        }

        .donut-head-one {

            font-family: 'Inter';
            font-style: normal;
            font-weight: 600;
            font-size: 24px;
            line-height: 30px;
            /* identical to box height, or 125% */
            text-align: center;

            color: #071437;


        }

        .donut-head-two {

            font-family: 'Inter';
            font-style: normal;
            font-weight: 500;
            font-size: 14px;
            line-height: 24px;
            /* identical to box height, or 171% */
            text-align: center;

            color: #4B5675;


        }

        .total-streact-amount {
            /* Heading/H2/Bold */
            font-family: 'Inter';
            font-style: normal;
            font-weight: 700;
            font-size: 19.5px;
            line-height: 23px;
            margin-top: 20px;
            /* identical to box height, or 120% */

            color: #071437;

        }

        .semi-circle-progress {
            width: 262px;
            height: 131px;
            /* Half the height for a semi-circle */
            background: conic-gradient(#54CF6E 0deg 45deg,
                    #99E2A8 45deg 90deg,
                    #DBDFE9 90deg 135deg,
                    #2AA443 135deg 180deg);
            border-radius: 131px 131px 0 0;
            /* Make it a semi-circle */
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .semi-circle-progress::before {
            content: '';
            width: 210px;
            height: 105px;
            /* Match inner height for semi-circle */
            background: #fff;
            position: absolute;
            bottom: 0;
            border-radius: 105px 105px 0 0;
        }

        .semi-circle-idp-percentage {
            position: absolute;
            bottom: 20%;
            text-align: center;
        }

        .semi-circle-progress {
            width: 210.424px;
            /* Adjusted width */
            height: 105.212px;
            /* Half the width for a semi-circle */
            background: conic-gradient(#54CF6E 0deg 45deg,
                    /* First Segment: Green */
                    #99E2A8 45deg 90deg,
                    /* Second Segment: Light Green */
                    #DBDFE9 90deg 135deg,
                    /* Third Segment: Gray */
                    #2AA443 135deg 180deg
                    /* Fourth Segment: Dark Green */
                );
            border-radius: 105.212px 105.212px 0 0;
            /* Adjusted border-radius */
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .semi-circle-progress::before {
            content: '';
            width: 190px;
            /* Adjusted size for the inner white cover */
            height: 95px;
            background: #fff;
            border-radius: 95px 95px 0 0;
            position: absolute;
            top: 10px;
            /* Adjusted for proper centering */
            left: 10px;
            /* Adjusted for proper centering */
            z-index: 1;
        }

        .semi-circle-idp-percentage {
            position: absolute;
            bottom: 20%;
            text-align: center;
        }

        .donut-1 .kpi-circular-progress {
            background: conic-gradient(#F7941C 0% 89%,
                    /* 89% progress (2.68/3.00) */
                    #DBDFE9 89% 100%
                    /* Remaining segment */
                );
        }

        .donut-2 .kpi-circular-progress {
            background: conic-gradient(#F7941C 0% 100%,
                    /* 89% progress (2.68/3.00) */
                    #DBDFE9 0% 0%
                    /* Remaining segment */
                );
        }

        .kpi-circular-progress::before {
            content: '';
            width: 200px;
            height: 200px;
            background: #fff;
            border-radius: 50%;
            position: absolute;
        }

        .kpi-circle-content {
            text-align: center;
            position: relative;
            z-index: 10;
        }

        .kpi-circle-content h3 {
            font-size: 20px;
            font-weight: 600;
            margin: 0;
            color: #1a1f36;
        }

        .kpi-circle-content p {
            font-size: 16px;
            font-weight: 500;
            color: #808080;
            margin: 5px 0 0;
        }

        .kpi-circular-progress {
            width: 245px;
            height: 245px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .dropdown-toggle::after {
            content: none;
        }

        .dropdown-toggle-two::after {
            content: none;
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

        .kpi-side-dropdown-btn {
            display: flex;
            min-width: 210px;
            padding: 6px 0px 6px 16px;
            align-items: center;
            border-radius: 8px;
            border: 1px solid #D9D9D9;
        }

        .kpi-calender {
            color: #F7941C;
            font-size: 16px;
        }

        .kp-select {
            color: #1E1E1E;
            font-size: 14px;
            font-style: normal;
            font-weight: 400;
            border: none;
            padding: 0;
            width: 170px;
        }

        .performance table {
            width: 100%;
            border-collapse: collapse;
        }

        .performance thead th {
            color: #99A1B7;
            font-size: 12px;
            font-style: normal;
            font-weight: 600;
            line-height: 16px;
            padding: 8px;
            width: 12.5%;
        }

        .performance tbody td {
            text-align: left;
            padding: 8px;
            font-size: 12px;
            font-weight: 500;
            color: #4B5675;
            vertical-align: top;
        }

        .performance tbody tr:nth-child(odd) {
            background-color: #FAFAFB;
        }

        .kpi-inner {
            grid-template-columns: 17% 79%;
        }

        .sd-table-bot,
        .sd-table-bot-total {
            color: #071437;
            font-style: normal;
            text-align: right;
            padding: 8px;

        }

        .sd-table-bot {
            font-weight: 600;
            line-height: 16px;
            font-size: 12px;
            border-top: 1px solid #DBDFE9;
        }

        .sd-table-bot-total {
            font-size: 19.5px;
            font-weight: 700;
            line-height: 23.4px;
        }

        .sd-table-bot span,
        .sd-table-bot-total span {
            margin-left: 16px;
        }

        .kpi-table-head {
            color: #071437;
            font-size: 14px;
            font-style: normal;
            font-weight: 600;
            line-height: 20px;
            margin-bottom: 8px;
        }

        .kpi-circular-progress {
            width: 210.424px;
            height: 210.424px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .donut-1 .kpi-circular-progress {
            background: conic-gradient(#F7941C 0% 89%,
                    /* 89% progress (2.68/3.00) */
                    #DBDFE9 89% 100%
                    /* Remaining segment */
                );
        }

        .donut-2 .kpi-circular-progress {
            background: conic-gradient(#F7941C 0% 100%,
                    /* 89% progress (2.68/3.00) */
                    #DBDFE9 0% 0%
                    /* Remaining segment */
                );
        }

        .kpi-circular-progress::before {
            content: '';
            width: 175px;
            height: 175px;
            background: #fff;
            border-radius: 50%;
            position: absolute;
        }

        .kpi-circle-content {
            text-align: center;
            position: relative;
            z-index: 10;
        }

        .kpi-circle-content h3 {
            color: #5B5B5B;
text-align: center;
font-size: 20px;
font-style: normal;
font-weight: 600;
line-height: 30px;
        }

        .kpi-circle-content p {
            color: #5B5B5B;
text-align: center;
font-size: 16px;
font-style: normal;
font-weight: 500;
        }

        .text-active-primary.active {
            color: #f7941d !important;
        }

        @media only screen and (min-width: 992px) and (max-width: 1101px) {
    .app-container {
        padding: 0px !important;
        margin: 0px 10px !important;
    }
    }

    @media only screen and (min-width: 1101px) and (max-width: 1201px) {
    .app-container {
        padding: 0px !important;
        margin: 0px 50px !important;
    }
    }

    @media only screen and (min-width: 1202px) and (max-width: 1351px) {
    .app-container {
        padding: 0px !important;
        margin: 0px 70px !important;
    }
    }

    @media only screen and (min-width: 1352px) and (max-width: 1401px) {
    .app-container {
        padding: 0px !important;
        margin: 0px 120px !important;
    }
    }

    </style>
@endsection

@section('content')
    <div id="kt_app_content" class="app-content  flex-column-fluid">
        <div id="kt_app_content_container" class="app-container  ">
            <div class="row mb-5 ms-0 me-0 justify-content-center mt-0 performance">
                @include('employee.dashboard.includes.card')
                <div class="card mb-12 psych-inner mt-4" style="color: #5B5B5B;">
                    <div class="kpi-top-head d-flex justify-content-between align-items-center">
                        <p class="fw-medium fs-4 m-0">Historical Data</p>
                        <div class="kpi-side-dropdown-btn gap-2">
                            <iconify-icon icon="uil:calender" class="kpi-calender"></iconify-icon>
                            <select class="form-select kp-select" data-placeholder="Performance Rating">
                                <option value="">
                                    Performance Rating</option>
                                <option value="">
                                    KPI Skills Ratings</option>
                            </select>
                        </div>
                    </div>
                    <div id="chart"></div>
                </div>
                <div class="mb-9">
                    <div class="kpi-top-head d-flex justify-content-between align-items-center mb-4" style="color: #5B5B5B;">
                        <p class="m-0"></p>
                        <div class="kpi-side-dropdown-btn gap-2">
                            <iconify-icon icon="uil:calender" class="kpi-calender"></iconify-icon>
                            <select class="form-select kp-select" data-placeholder="Year 2022">
                                <option value="">
                                    Year 2024</option>
                                <option value="">
                                    Year 2023</option>
                                <option value="">
                                    Year 2022</option>
                                <option value="">
                                    Year 2021</option>
                            </select>
                        </div>
                    </div>
                    <div class="card psych-inner">
                        <div class="kpi-first">
                            <p class="fw-medium fs-3 m-0 mb-14" style="color: #5B5B5B">KPI Ratings (70% Weightage)
                            </p>
                            <div class="kpi-inner d-grid gap-14 align-items-start">
                                <div class="donut-1">
                                    <div class="kpi-circular-progress">
                                        <div class="kpi-circle-content">
                                            <h3 class="m-0">2.66/3.00</h3>
                                            <p class="m-0">Total Weighted</br>Ratings</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-first">
                                    <p class="kpi-table-head">Objectives: Increase Training Effectiveness
                                        (Weightage: 20%)</p>
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>KPI</th>
                                                <th>Rating</th>
                                                <th>Manager Evaluation</th>
                                                <th>Base Target</th>
                                                <th>Stretch Target</th>
                                                <th>Result</th>
                                                <th>Employee Comments</th>
                                                <th>Objective Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Increase Training Effectiveness</td>
                                                <td>2</td>
                                                <td>Demonstrated improvement in trainee performance post-training. Better alignment with organizational goals could enhance outcomes.</td>
                                                <td>75% post-training assessment score</td>
                                                <td>85% post-training assessment score</td>
                                                <td>80% stretch target achieved</td>
                                                <td>I aim to to introduce more practical assessments and collaborate with managers to ensure training directly impacts job performance.</td>
                                                <td><b>18.6%</b></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <p class="kpi-table-head mt-8">Objectives: Improve Training Program Delivery
                                         (Weightage: 30%)</p>
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>KPI</th>
                                                    <th>Rating</th>
                                                    <th>Manager Evaluation</th>
                                                    <th>Base Target</th>
                                                    <th>Stretch Target</th>
                                                    <th>Result</th>
                                                    <th>Employee Comments</th>
                                                    <th>Objective Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Improve Training Program Delivery</td>
                                                    <td>3</td>
                                                    <td>Demonstrated significant improvements in training delivery, achieving high trainee satisfaction. However, additional customization could enhance impact.</td>
                                                    <td>90% training attendance rate</td>
                                                    <td>95% training attendance rate</td>
                                                    <td>90% stretch target achieved</td>
                                                    <td>Plan to incorporate feedback from participants to fine-tune content and align with their professional growth objectives.</td>
                                                    <td><b>27.4%</b></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    <p class="kpi-table-head mt-8">Objectives: Enhance Training Module Design
                                        (Weightage: 30%)</p>
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>KPI</th>
                                                    <th>Rating</th>
                                                    <th>Manager Evaluation</th>
                                                    <th>Base Target</th>
                                                    <th>Stretch Target</th>
                                                    <th>Result</th>
                                                    <th>Employee Comments</th>
                                                    <th>Objective Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Enhance Training Module Design</td>
                                                    <td>3</td>
                                                    <td>Created innovative and engaging training modules, receiving positive feedback. Further optimization for diverse audiences is recommended.</td>
                                                    <td>3 new modules designed annually</td>
                                                    <td>5 new modules designed</td>
                                                    <td>100% stretch target achieved</td>
                                                    <td>Focus will be on creating bilingual modules to cater to multilingual teams and expanding training materials for practical application.</td>
                                                    <td><b>28%</b></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    <p class="kpi-table-head mt-8">Objectives: Promote Training Adoption Across Departments
                                        (Weightage: 20%)</p>
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>KPI</th>
                                                    <th>Rating</th>
                                                    <th>Manager Evaluation</th>
                                                    <th>Base Target</th>
                                                    <th>Stretch Target</th>
                                                    <th>Result</th>
                                                    <th>Employee Comments</th>
                                                    <th>Objective Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Promote Training Adoption Across Departments</td>
                                                    <td>2</td>
                                                    <td>Successfully promoted training participation across departments, achieving a notable increase in cross-department engagement.</td>
                                                    <td>10% increase in participation rate</td>
                                                    <td>15% increase in participation rate</td>
                                                    <td>85% stretch target achieved</td>
                                                    <td>I plan to engage department heads more effectively and showcase training benefits through case studies and testimonials.</td>
                                                    <td><b>14.7%</b></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    <p class="sd-table-bot-total mb-0">Total Stretch Target Achieved:
                                        <span>88.7%</span>
                                    </p> 
                                </div>
                            </div>
                        </div>
                        <div class="line-bottom mb-14 mt-14"></div>
                        <div class="kpi-second">
                            <p class="fw-medium fs-3 m-0 mb-14" style="color: #5B5B5B">Skill Development Ratings
                                (30% Weightage)</p>
                            <div class="kpi-inner d-grid gap-14 align-items-start">
                                <div class="donut-2">
                                    <div class="kpi-circular-progress">
                                        <div class="kpi-circle-content">
                                            <h3 class="m-0">2.93/3.00</h3>
                                            <p class="m-0">Total Points</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-first">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th style="
                                                width: 33%;
                                            ">Technical Skill (15%)</th>
                                                <th style="
                                                width: 9%;
                                            ">Rating</th>
                                                <th style="
                                                width: 14%;
                                            ">Minimal Level</th>
                                                <th style="
                                                width: 9%;
                                            ">Gap</th>
                                                <th style="
                                                width: 16%;
                                            ">Employee Planning</th>
                                                <th>Manager Evaluation</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Conduct and Behaviour Management</td>
                                                <td>2</td>
                                                <td>2</td>
                                                <td>0</td>
                                                <td>N/A</td>
                                                <td>N/A</td>
                                            </tr>
                                            <tr>
                                                <td>Data Collection and Preparation</td>
                                                <td>2</td>
                                                <td>2</td>
                                                <td>0</td>
                                                <td>N/A</td>
                                                <td>N/A</td>
                                            </tr>
                                            <tr>
                                                <td>Data Management</td>
                                                <td>2</td>
                                                <td>2</td>
                                                <td>0</td>
                                                <td>N/A</td>
                                                <td>N/A</td>
                                            </tr>
                                            <tr>
                                                <td>Employee Communication Management</td>
                                                <td>2</td>
                                                <td>2</td>
                                                <td>0</td>
                                                <td>N/A</td>
                                                <td>N/A</td>
                                            </tr>
                                            <tr>
                                                <td>Employee Relationship Management</td>
                                                <td>2</td>
                                                <td>2</td>
                                                <td>0</td>
                                                <td>N/A</td>
                                                <td>N/A</td>
                                            </tr>
                                            <tr>
                                                <td>Health and Wellness Prograamme Management</td>
                                                <td>1</td>
                                                <td>2</td>
                                                <td>1</td>
                                                <td>N/A</td>
                                                <td>N/A</td>
                                            </tr>
                                            <tr>
                                                <td>Human Resource Analytics and Insights</td>
                                                <td>0</td>
                                                <td>2</td>
                                                <td>2</td>
                                                <td>N/A</td>
                                                <td>N/A</td>
                                            </tr>
                                            <tr>
                                                <td>Human Resource Policies and Legislation Framework Management</td>
                                                <td>2</td>
                                                <td>2</td>
                                                <td>0</td>
                                                <td>N/A</td>
                                                <td>N/A</td>
                                            </tr>
                                            <tr>
                                                <td>Human Resource Practices Implementation</td>
                                                <td>2</td>
                                                <td>2</td>
                                                <td>0</td>
                                                <td>N/A</td>
                                                <td>N/A</td>
                                            </tr>
                                            <tr>
                                                <td>Human Resource Systems Management</td>
                                                <td>2</td>
                                                <td>2</td>
                                                <td>0</td>
                                                <td>N/A</td>
                                                <td>N/A</td>
                                            </tr>
                                            
                                            <tr>
                                                <td>Job Analysis and Evaluation</td>
                                                <td>1</td>
                                                <td>2</td>
                                                <td>1</td>
                                                <td>N/A</td>
                                                <td>N/A</td>
                                            </tr>
                                            <tr>
                                                <td>Operational Excellence</td>
                                                <td>1</td>
                                                <td>2</td>
                                                <td>0</td>
                                                <td>N/A</td>
                                                <td>N/A</td>
                                            </tr>
                                            <tr>
                                                <td>Organisational Event Management </td>
                                                <td>2</td>
                                                <td>2</td>
                                                <td>0</td>
                                                <td>N/A</td>
                                                <td>N/A</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <p class="sd-table-bot mb-0">Total Technical Skills Rating: <span>96.97%</span>
                                    </p>
                                    <table class="mt-14">
                                        <thead>
                                            <tr>
                                                <th style="
                                                width: 33%;
                                            ">Soft Skill (15%)</th>
                                                <th style="
                                                width: 9%;
                                            ">Rating</th>
                                                <th style="
                                                width: 14%;
                                            ">Minimal Level</th>
                                                <th style="
                                                width: 9%;
                                            ">Gap</th>
                                                <th style="
                                                width: 16%;
                                            ">Employee Planning</th>
                                                <th>Manager Evaluation</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Communication</td>
                                                <td>3</td>
                                                <td>3</td>
                                                <td>0</td>
                                                <td>N/A</td>
                                                <td>N/A</td>
                                            </tr>
                                            <tr>
                                                <td>Digital Fluency</td>
                                                <td>0</td>
                                                <td>1</td>
                                                <td>1</td>
                                                <td>N/A</td>
                                                <td>N/A</td>
                                            </tr>
                                            <tr>
                                                <td>Problem Solving</td>
                                                <td>3</td>
                                                <td>3</td>
                                                <td>0</td>
                                                <td>N/A</td>
                                                <td>N/A</td>
                                            </tr>
                                            <tr>
                                                <td>Collaboration</td>
                                                <td>2</td>
                                                <td>2</td>
                                                <td>0</td>
                                                <td>N/A</td>
                                                <td>N/A</td>
                                            </tr>
                                            <tr>
                                                <td>Creative Thinking</td>
                                                <td>2</td>
                                                <td>2</td>
                                                <td>0</td>
                                                <td>N/A</td>
                                                <td>N/A</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <p class="sd-table-bot mb-0">Total Soft Skills Rating: <span>97.6%</span>
                                    </p>
                                    <p class="sd-table-bot-total mb-0">Total Skills Rating: <span>98.49%</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="line-bottom mb-14 mt-14"></div>
                        <div class="kpi-third">
                            <p class="fw-medium fs-3 m-0 mb-14" style="color: #5B5B5B">Performance Ratings</p>
                            <div class="kpi-inner d-grid gap-14 align-items-start">
                                <div class="donut-1">
                                    <div class="semi-circle-progress">
                                        <div class="kpi-circle-content"
                                            style="
                                        top: 24%;
                                    ">
                                            <h3 class="m-0">Level 3</h3>
                                            <p class="m-0">Performance Rating</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="kp-table-third">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Category</th>
                                                <th
                                                    style="
                                            text-align: right;
                                        ">
                                                    Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>KPI Rating</td>
                                                <td
                                                    style="
                                            text-align: right;
                                        ">
                                                    <p class="m-0">(KPI Rating raw score) <span>88.7%</span>
                                                    </p>
                                                    <p class="m-0 mt-1"><b>(70% Weightage) <span>62.09%</span></b>
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Skills Development Rating</td>
                                                <td
                                                    style="
                                            text-align: right;
                                        ">
                                                    <p class="m-0">(Technical Skills raw score)
                                                        <span>96.97%</span>
                                                    </p>
                                                    <p class="m-0 mt-1">(Soft Skills raw score) <span>97.6%</span>
                                                    </p>
                                                    <p class="m-0 mt-1"><b>(30% Weightage) <span>29.55%</p>
                                                    </b></span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <p class="sd-table-bot mb-0">Total Performance Points: <span>2.76/3.00</span>
                                    <p class="sd-table-bot-total mb-0">
                                        Total Performance Score: <span>92.1%</span></p> 
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
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.35.0"></script>
    <script>
        var options = {
            series: [{
                name: "Data Points",
                data: [2, 3, 3] // Y-axis values for each point
            }],
            chart: {
                height: 350,
                type: 'line',
                toolbar: {
                    show: false
                } // Disable toolbar
            },
            stroke: {
                width: 7,
                curve: 'straight' // Line style
            },
            markers: {
                size: 7,
                colors: ['#FFA726'],
                strokeWidth: 2,
                hover: {
                    size: 6
                }
            },
            xaxis: {
                categories: ["Year 2022", "Year 2023", "Year 2024"], // X-axis labels
                labels: {
                    style: {
                        colors: '#333'
                    }
                } // X-axis label style
            },
            yaxis: {
                min: 1,
                max: 3,
                labels: {
                    style: {
                        colors: '#333'
                    },
                    formatter: function(value) {
                        return "Level " + value; // Custom Y-axis labels
                    }
                },
                tickAmount: 2 // Only display Level 1, 2, and 3
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
    </script>
    {{-- <script>
    var options = {
series: [60], // Adjust this value to control the level (60% for Level 3)
chart: {
type: 'radialBar',
height: 350,
},
plotOptions: {
radialBar: {
   startAngle: -90,
   endAngle: 90,
   track: {
       background: '#E0E0E0', // Light gray track background
       strokeWidth: '100%',
   },
   hollow: {
       margin: 15,
       size: '60%'
   },
   dataLabels: {
       name: {
           offsetY: 30,
           show: true,
           color: '#333',
           fontSize: '20px',
           fontWeight: 'bold',
           formatter: function () {
               return '';
           }
       },
       value: {
           offsetY: -20,
           show: false
       }
   }
}
},
colors: ['#2AA443'], // Color for the performance arc
fill: {
type: 'gradient',
gradient: {
   shade: 'light',
   type: 'horizontal',
   gradientToColors: ['#2e7d32'], // Darker green
   stops: [0, 100]
}
},
stroke: {
lineCap: 'butt'
},
labels: ['Performance Rating'],
responsive: [
{
breakpoint: 480,
options: {
chart: {
width: 200
},
legend: {
position: "bottom"
}
}
}
]
};

var chart = new ApexCharts(document.querySelector("#half-donut-chart"), options);
chart.render();
         </script> --}}
    {{-- <script>
            var options = {
                series: [29.25],  // Percentage calculation: (1.17 / 4.00) * 100 = 29.25
                chart: {
                    type: 'donut',
                    height: 250,
                    width:250,
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
                                    formatter: function (w) {
                                        return '1.17/4.00';  // Custom label inside the donut
                                    }
                                }
                            }
                        }
                    }
                },
                stroke: {
                    width: 0
                },
                dataLabels: { enabled: false },
                legend: { show: false },
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: { height: 300 }
                    }
                }]
            };
    
            var chart = new ApexCharts(document.querySelector("#donut-chart"), options);
            chart.render();
        </script> --}}
    {{-- <script>
            var options = {
                series: [40.89],  // Percentage calculation: (1.17 / 4.00) * 100 = 29.25
                chart: {
                    type: 'donut',
                    height: 250,
                    width:250,

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
                                    formatter: function (w) {
                                        return '1.17/4.00';  // Custom label inside the donut
                                    }
                                }
                            }
                        }
                    }
                },
                stroke: {
                    width: 0
                },
                dataLabels: { enabled: false },
                legend: { show: false },
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: { height: 300 }
                    }
                }]
            };
    
            var chart = new ApexCharts(document.querySelector("#donut-chart-2"), options);
            chart.render();
        </script> --}}
    <script>
        document.querySelector('.dropdown-toggle').addEventListener('click', function() {
            const dropdown = this.closest('.dropdown');
            dropdown.classList.toggle('active');
        });
    </script>


    <script>
        document.querySelector('.dropdown-toggle-two').addEventListener('click', function() {
            const dropdown = this.closest('.dropdown');
            dropdown.classList.toggle('active');
        });
    </script>
    <script>
        function updateDropdown(selectedOption) {
            // Get the text content of the selected option
            const selectedText = selectedOption.textContent;

            // Update the text inside the <span class="text">
            document.querySelector('.dropdown .text').textContent = selectedText;

            // Hide the dropdown menu after selection
            document.querySelector('.dropdown').classList.remove('active');
        }
    </script>
    <script>
        function updateDropdownTwo(selectedOption) {
            // Get the text content of the selected option
            const selectedText = selectedOption.textContent;

            // Update the text inside the <span class="text">
            document.querySelector('.dropdown .text-two').textContent = selectedText;

            // Hide the dropdown menu after selection
            document.querySelector('.dropdown').classList.remove('active');

        }
        document.addEventListener('click', function(event) {
            document.querySelectorAll('.dropdown').forEach(dropdown => {
                if (!dropdown.contains(event.target)) {
                    dropdown.classList.remove('active');
                }
            });
        });
        document.querySelectorAll('.dropdown-menu a').forEach(item => {
            item.addEventListener('click', function() {
                // Find the closest dropdown and update the corresponding text element
                const dropdown = this.closest('.dropdown');
                const textElement = dropdown.querySelector('.text, .text-two');
                textElement.textContent = this.textContent;

                // Close the dropdown menu
                dropdown.classList.remove('active');
            });
        });
    </script>
@endsection
