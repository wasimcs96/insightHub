@extends('insighthub.layout.app')

@section('title', $title ?? 'InsightHub Analytics Dashboard')

@section('styles')
    <style>
        .top-heading {
            color: #2E2F38;
            font-size: 32.5px;
            font-weight: 600;
            line-height: 39px;
        }

        .custom-text-muted {
            color: #727790;
            font-size: 16px;
            font-weight: 400;
            line-height: 24px;
        }

        .filter-row {
            display: flex;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .filter-group {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .filter-label {
            color: #727790;
            font-size: 16px;
            font-weight: 400;
            line-height: 21px;
            margin: 0;
        }

        .form-select {
            border: 1px solid #C8CFD9;
            background: #FEFEFE;
            padding: 12px 16px;
            color: #2E2F38;
            font-size: 14px;
            font-weight: 400;
            line-height: 19px;
            background-image: url('data:image/svg+xml;utf8,<svg fill="none" stroke="%236b7280" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>');
            background-repeat: no-repeat;
            background-position: right 10px center;
            background-size: 18px;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            transition: all 0.2s ease;
            width: 208px;
        }

        .main-div {
            padding: 24px;
            background: #F5F7F8;
        }

        .custom-badge {
            display: flex;
            padding: 6px 12px;
            justify-content: center;
            align-items: center;
            border-radius: 8px;
            background: #EEEAFD;
            color: #5D29AE;
            font-size: 14px;
            font-weight: 600;
        }

        .custom-badge.purple {
            background: #EEEAFD;
            color: #5D29AE;
        }

        .dashboard-card {
            text-align: left;
            display: flex;
            padding: 30px;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
            flex: 1 0 0;
            align-self: stretch;
            border-radius: 8px;
            background: #fff;
            box-shadow: 0 1px 4px 0 rgba(12, 12, 13, 0.05);
        }

        .dashboard-card h2 {
            color: #071437;
            font-size: 45.5px;
            font-weight: 600;
            line-height: 54.6px;
            margin: 0;
        }

        .dashboard-card p {
            color: #4B5675;
            font-size: 15.25px;
            font-weight: 400;
            line-height: 24.375px;
            margin: 0;
        }

        .chart-title {
            color: #071437;
            font-size: 17.55px;
            font-weight: 500;
            line-height: 21.06px;
        }

        .chart-title.extra-margin {
            margin: 6px auto 16px auto;
        }

        .custom-round {
            width: 12px;
            height: 12px;
            border-radius: 50%;
        }

        .custom-round.red {
            background-color: #FF6355;
        }

        .custom-round.yellow {
            background-color: #FFC31F;
        }

        .custom-round.cyan {
            background-color: #1AC2C2;
        }

        .custom-round.purple {
            background-color: #997BF2;
        }

        .custom-round.green {
            background-color: #32C551;
        }

        .custom-round.blue {
            background-color: #0095FF;
        }

        .custom-round.orange {
            background-color: #D5540A;
        }

        .custom-round.teal {
            background-color: #009689;
        }

        .custom-round.teal-light {
            background-color: #00D5BE;
        }

        .custom-round.orange-primary {
            background-color: #F7941C;
        }

        .custom-round.green-approved {
            background-color: #54CF6E;
        }

        .progress-container {
            width: 100%;
            height: 14px;
            background-color: #e9ecef;
            border-radius: 50px;
            overflow: hidden;
            display: flex;
        }

        .progress-segment {
            height: 100%;
        }

        #JobVacanciesvsJobAdsCreatedChart,
        #FinancialControllerSecondChart,
        #PeoplePerformanceCultureHeadChart,
        #TotalJobPositionsChart,
        #FinancialControllerChart {
            min-width: 100%;
        }

        .icon-color {
            color: #99A1B7;
        }

        .table-heading {
            color: #2E2F38;
            font-size: 20px;
            font-weight: 600;
        }

        .metric-table {
            border-collapse: collapse;
            width: 100%;
            overflow-x: auto;
        }

        .metric-table td {
            padding: 10px 12px;
            color: #727790;
            text-align: center;
            font-size: 12px;
            font-weight: 500;
            line-height: 16px;
            background: #ECF0F3;
        }

        .metric-table thead th {
            color: #FFF;
            font-size: 12px;
            font-weight: 500;
            line-height: 16px;
            background: #5e6375;
            text-align: center;
            vertical-align: middle;
            position: sticky;
            top: 0;
            z-index: 2;
            padding: 10px 12px 10px 16px;
            height: 48px;
        }

        .metric-table tbody th {
            text-align: left;
            background: #fff;
        }

        .bsc-table table thead th:nth-child(1) {
            min-width: 253px;
            width: 253px;
        }

        .bsc-table table thead th:nth-child(2),
        .bsc-table table thead th:nth-child(3) {
            min-width: 90px;
            width: 90px;
        }

        .bsc-table table thead th:nth-child(1),
        .bsc-table table thead th:nth-child(2),
        .bsc-table table thead th:nth-child(3) {
            border-top: 1px solid #DDE2E8;
            border-left: 1px solid #DDE2E8;
            background: #858ba6;
        }

        .bsc-table table thead th:not(:nth-child(1)):not(:nth-child(2)):not(:nth-child(3)) {
            min-width: 130px;
            width: 130px;
        }

        .bsc-table table tbody td[rowspan="2"] {
            width: 260px;
            padding: 0px;
            background: #fff;
        }

        .custom-border-row {
            padding: 10px 10px 10px 16px;
            height: 74px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .custom-border-row .metric-text {
            color: #2E2F38;
            font-size: 12px;
            font-weight: 600;
            line-height: 16px;
            text-align: left;
        }

        .custom-border-row .badge {
            display: flex;
            padding: 4px 8px;
            justify-content: center;
            align-items: center;
            border-radius: 100px;
            font-size: 10px;
            font-weight: 600;
            line-height: 14px;
        }

        .custom-border-row .badge.percent,
        .tag-grey {
            background: #F5F7F8;
            color: #2E2F38;
        }

        .financial-row {
            border-left: 4px solid #8E64EE;
        }

        .financial-row .badge.financial {
            background: #EEEAFD;
            color: #5D29AE;
        }

        .customer-row {
            border-left: 4px solid #00BBA7;
        }

        .customer-row .badge.customer {
            background: #CBFBF1;
            color: #005F5A;
        }

        .process-row {
            border-left: 4px solid #00A6F4;
        }

        .process-row .badge.process {
            background: #DFF2FE;
            color: #024A70;
        }

        .people-row {
            border-left: 4px solid #F6339A;
        }

        .people-row .badge.people {
            background: #FCE7F3;
            color: #A3004C;
        }

        .bg-custom-red {
            background: #F24130 !important;
        }

        .bg-custom-green {
            background: #1C9D38 !important;
        }

        .bg-custom-teal {
            background: #00BBA7 !important;
        }

        .bg-custom-Purple {
            background: #7E43E4 !important;
        }

        .bg-custom-dark-teal {
            background: #00786F !important;
        }

        .bg-custom-dark-orange {
            background: #F7941C !important;
        }

        .bg-custom-orange {
            background: #D5540A !important;
        }

        .bg-custom-yellow {
            background: #FFC31F !important;
            font-weight: 700 !important;
            color: #523109 !important;
        }

        .score-text {
            color: #2E2F38 !important;
            font-weight: 700 !important;
        }

        .table-footer td {
            font-weight: 700;
            background: #fde68a;
            text-align: center;
        }

        .nav-btn {
            cursor: pointer;
            transition: background 0.2s ease;
            display: flex;
            width: 38px;
            height: 38px;
            padding: 6px 12px;
            justify-content: center;
            align-items: center;
            gap: 4px;
            border-radius: 4px;
            border: 1px solid #858BA6;
            background: #FFF;
        }

        .nav-btn:hover {
            background: #f3f4f6;
        }

        .table-wrapper {
            position: relative;
            overflow-x: auto;
            white-space: nowrap;
        }

        .table-nav {
            display: flex;
            gap: 8px;
        }

        .ds-performance {
            gap: 10px;
        }

        .ds-performance .box {
            padding: 8px 20px;
            gap: 20px;
        }

        .ds-performance .box.green {
            border-bottom: 1px solid #1A7B2F;
            background: #F1FCF2;
        }

        .ds-performance .box.yellow {
            border-bottom: 1px solid #FFC31F;
            background: #FFFBEB;
        }

        .ds-performance .box .title {
            color: #000;
            font-size: 14px;
            font-weight: 500;
            line-height: 20px;
        }

        .ds-performance .box .values {
            color: #727790;
            font-size: 12px;
            font-weight: 500;
            line-height: 16px;
        }

        .ds-performance .box .custom-tag {
            padding: 6px 10px;
            border-radius: 100px;
            font-size: 12px;
            font-weight: 600;
            line-height: 16px;
        }

        .ds-performance .box .custom-tag.tag-green,
        .tag-green {
            background: #DDFBE2;
            color: #1A7B2F;
        }

        .ds-performance .box .custom-tag.tag-yellow {
            background: #FFF5C6;
            color: #94410C;
        }

        .pb-text {
            color: #2E2F38;
            font-size: 14px;
            font-weight: 600;
            line-height: 20px;
            margin-bottom: 0px;
        }

        .metric-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .metric-value {
            color: #2E2F38;
            font-size: 20px;
            font-weight: 600;
            margin-right: 4px;
        }

        .metric-label {
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 1;
            overflow: hidden;
            color: #2E2F38;
            text-overflow: ellipsis;
            font-size: 12px;
            font-weight: 400;
            line-height: 16px;
        }

        .metric-count {
            color: #727790;
            text-align: right;
            font-size: 12px;
            font-weight: 400;
            line-height: 16px;
        }

        .progress {
            height: 8px;
            background-color: #DBDFE9;
            border-radius: 100px;
            overflow: hidden;
            width: 100%;
        }

        .progress-bar {
            border-radius: 5px;
        }

        .bg-success {
            background-color: #2AA443 !important;
        }

        .bg-warning {
            background-color: #FFC31F !important;
        }

        .bg-danger {
            background-color: #F24130 !important;
        }

        .bg-gray {
            background-color: #DBDFE9 !important;
        }

        .top-sub-heading {
            color: #2E2F38;
            font-size: 24px;
            font-weight: 600;
        }

        .card {
            border-radius: 10px;
        }

        .btn-group .btn.active {
            background-color: #fbbf24;
            border-color: #fbbf24;
        }

        .legend-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            display: inline-block;
        }

        .custom-btn-group {
            display: flex;
            padding: 4px;
            gap: 8px;
            border-radius: 8px;
            border: 1px solid #ECF0F3;
            background: #FFF;
        }

        .custom-btn-group button,
        .nav-pills .nav-link {
            padding: 4px 12px;
            border-radius: 8px;
            background: #FFF;
            color: #99A1B7;
            font-size: 14px;
            font-weight: 600;
        }

        .custom-btn-group button.active,
        .nav-pills .nav-link.active {
            background: #F7941C;
            color: #fff;
        }

        .nav-tabs .nav-link:focus,
        .nav-tabs .nav-link:hover {
            border-color: #fff;
        }

        .nav-pills .nav-item {
            margin: 0;
        }

        .center-label {
            position: absolute;
            z-index: 1;
        }

        .center-label h2,
        .center-label p {
            position: relative;
        }

        .center-label h2 {
            top: 175px;
            left: 111px;
        }

        .center-label.response h2 {
            top: 124px;
            left: 64px;
            color: #262527;
            font-size: 25.6px;
            font-weight: 400;
            line-height: 32px;
        }

        .center-label p {
            top: 180px;
            left: 111px;
        }

        .center-label.response p {
            top: 128px;
            left: 59px;
            color: #5A5D6C;
            font-size: 9.6px;
            font-weight: 500;
            line-height: 13.6px;
        }

        .center-label.response-internal h2,
        .center-label.response-external h2 {
            color: #262527;
            font-size: 20.48px;
            font-weight: 400;
            line-height: 25.6px;
            top: 47px;
            left: 60px;
        }

        .center-label.response-internal p,
        .center-label.response-external p {
            color: #5A5D6C;
            font-size: 7.68px;
            font-weight: 500;
            line-height: 10.88px;
            top: 50px;
            left: 57px;
        }

        .succession-section .tab-pane {
            display: none;
        }

        .succession-section .tab-pane.active {
            display: block;
        }

        .assign-btn {
            color: #F1760F;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
        }

        .table-container {
            overflow-x: auto;
        }

        .view-all {
            color: #F1760F;
            font-size: 14px;
            font-weight: 600;
        }

        .vacancies-table {
            border-radius: 4px;
            border: 1px solid #ECF0F3;
        }

        .vacancies-table thead tr th {
            width: 250px;
            height: 52px;
            max-height: 52px;
            padding: 16px;
            background: #F5F7F8;
        }

        .vacancies-table tbody tr td {
            padding: 16px;
            color: #2E2F38;
            font-size: 14px;
            font-weight: 400;
            line-height: 19px;
        }

        .vacancies-table thead tr th:nth-last-child(-n + 3),
        .vacancies-table tbody tr td:nth-last-child(-n + 3) {
            text-align: center;
        }

        .succession-table thead th {
            color: #fff;
            padding: 10px 12px 10px 16px;
            font-size: 12px;
            font-weight: 500;
            line-height: 16px;
            vertical-align: middle;
        }

        .succession-table thead th:nth-child(1) {
            min-width: 250px;
            width: 250px;
            background: #858ba6;
        }

        .succession-table thead th:nth-child(2),
        .succession-table thead th:nth-child(3) {
            min-width: 120px;
            width: 120px;
        }

        .succession-table thead th:nth-child(2),
        .succession-table thead th:nth-child(3) {
            background: #5e6375;
        }

        .succession-table tbody td:nth-child(2),
        .succession-table tbody td:nth-child(3) {
            color: #fff;
        }

        .succession-table tbody td:nth-child(4) {
            color: #9C2418;
            background: #FFE4E1;
        }

        .succession-table tbody td:nth-child(5),
        .succession-table tbody td:nth-child(7) {
            color: #D5540A;
            background: #FDE9C8;
        }

        .succession-table tbody td:nth-child(6),
        .succession-table tbody td:nth-child(8),
        .succession-table tbody td:nth-child(10) {
            color: #94410C;
            background: #FFF5C6;
        }

        .succession-table tbody td:nth-child(9),
        .succession-table tbody td:nth-child(11) {
            color: #19622A;
            background: #DDFBE2;
        }

        .succession-table tbody td:nth-child(12) {
            color: #005F5A;
            background: #CBFBF1;
        }

        .succession-table thead th:not(:nth-child(1)):not(:nth-child(2)):not(:nth-child(3)) {
            min-width: 80px;
            width: 80px;
        }

        .succession-table thead th:not(:nth-child(1)),
        .succession-table tbody td:not(:nth-child(1)) {
            text-align: center;
        }

        .succession-table tbody td {
            height: 64px;
            padding: 10px 10px 10px 16px;
            color: #2E2F38;
            font-size: 12px;
            font-weight: 600;
            line-height: 16px;
        }

        .text-custom {
            color: #2E2F38 !important;
            font-size: 16px !important;
            font-weight: 600 !important;
        }

        .custom-tag {
            display: flex;
            height: 22px;
            padding: 4px 8px;
            justify-content: center;
            align-items: center;
            gap: 4px;
            border-radius: 8px;
            width: max-content;
            margin: auto;
            overflow: hidden;
            font-size: 12px;
            font-weight: 500;
            line-height: 17px;
        }

        .sign-warning {
            display: flex;
            width: 18px;
            height: 18px;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }

        .sign-warning .yellow {
            padding: 2px;
            background: #FFF5C6;
            color: #B75506;
            border-radius: 100px;
        }

        .sign-warning .red {
            padding: 2px;
            background: #FFE4E1;
            color: #BD2618;
            border-radius: 100px;
        }

        .custom-border-bottom {
            border-bottom: 1px solid #ECF0F3;
            padding-bottom: 10px;
            margin-bottom: 10px;
        }
    </style>

@endsection

@section('content')

    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="container-xxl app-container d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5 mb-lg-0">
                <h1 class="page-heading text-gray-900 fw-bold fs-3 my-0">
                    Dashboard
                </h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">Analytics</li>
                    <li class="breadcrumb-item"><span class="bullet bg-gray-500 w-5px h-2px"></span></li>
                    <li class="breadcrumb-item text-muted" id="breadcrumb-last">Dashboard</li>
                </ul>
            </div>
        </div>
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid p-0">
        <div id="kt_app_content_container" class="container-xxl app-container">
            <div class="d-flex align-items-center justify-content-between">
                <div class="page-header my-15">
                    <h4 class="top-heading m-0">Dashboard</h4>
                    <p class="custom-text-muted m-0">View key metrics and insights across all modules.</p>
                </div>
                <div class="filter-row">
                    <div class="filter-group">
                        <label for="module" class="filter-label">Module</label>
                        <select id="module" class="form-select">
                            <option selected>TalentCore</option>
                            <option>Balance Score Card</option>
                            <option>Overall</option>
                            <option>Succession Planning</option>
                            <option>Survey Management</option>
                        </select>
                    </div>

                    <div class="filter-group">
                        <label for="subsidiaries" class="filter-label">Subsidiaries</label>
                        <select id="subsidiaries" class="form-select">
                            <option selected>Subsidiaries 1</option>
                            <option>Subsidiaries 2</option>
                            <option>Subsidiaries 3</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="main-div">
                <div id="TalentCore">
                    @include('InsightHub.Analytic.dashboard.talentcore-dashboard')
                </div>
                <div id="BalanceScoreCard">
                    @include('InsightHub.Analytic.dashboard.balance-score-card')
                </div>

                <div id="Overall">
                    @include('InsightHub.Analytic.dashboard.overall')
                </div>

                <div id="SuccessionPlanning">
                    @include('InsightHub.Analytic.dashboard.succession-planning')
                </div>

                <div id="SurveyManagement">
                    @include('InsightHub.Analytic.dashboard.survey-management')
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

    <script>
        const section = document.querySelector('.succession-section');
        const tabButtons = section.querySelectorAll('#customTabs button');
        const tabPanes = section.querySelectorAll('.tab-pane');

        tabButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                tabButtons.forEach(b => b.classList.remove('active'));
                tabPanes.forEach(p => p.classList.remove('active'));

                btn.classList.add('active');
                const target = btn.getAttribute('data-target');
                section.querySelector(target).classList.add('active');
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const select = document.getElementById("module");
            const sections = document.querySelectorAll(".main-div > div");

            function showSelectedSection() {
                const selected = select.value.replace(/\s+/g, '');
                sections.forEach(div => {
                    if (div.id === selected) {
                        div.style.display = "block";
                    } else {
                        div.style.display = "none";
                    }
                });
            }

            showSelectedSection();

            select.addEventListener("change", showSelectedSection);
        });
    </script>

    <script>
        const tableWrapper = document.querySelector(".table-wrapper");
        const nextBtn = document.getElementById("nextBtn");
        const prevBtn = document.getElementById("prevBtn");

        nextBtn.addEventListener("click", () => {
            tableWrapper.scrollBy({
                left: 200,
                behavior: "smooth"
            });
        });
        prevBtn.addEventListener("click", () => {
            tableWrapper.scrollBy({
                left: -200,
                behavior: "smooth"
            });
        });
    </script>

    <script>
        var genderOptions = {
            chart: {
                type: 'donut',
                height: 250
            },
            series: [80, 20],
            labels: ['Male', 'Female'],
            colors: ['#FF6355', '#FFC31F'],
            legend: {
                position: 'bottom',
                show: false
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                width: 0
            },
            plotOptions: {
                pie: {
                    donut: {
                        size: '70%'
                    }
                }
            }
        };

        var genderChart = new ApexCharts(document.querySelector("#genderChart"), genderOptions);
        genderChart.render();
    </script>

    <script>
        var options = {
            series: [22, 11, 21, 23, 20],
            chart: {
                type: 'donut',
                height: 250,
            },
            labels: ['21 - 24', '25 - 29', '30 - 34', '35 - 39', '40+'],
            colors: ['#1AC2C2', '#32C551', '#997BF2', '#FF6355', '#FFCD44'],
            dataLabels: {
                enabled: false
            },
            legend: {
                position: 'bottom',
                fontSize: '14px',
                markers: {
                    width: 14,
                    height: 14,
                    radius: 50
                },
                itemMargin: {
                    horizontal: 10,
                    vertical: 5
                },
                show: false
            },
            stroke: {
                width: 0
            },
            plotOptions: {
                pie: {
                    donut: {
                        size: '70%'
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#ageChart"), options);
        chart.render();
    </script>

    <script>
        var options1 = {
            series: [{
                    name: '2024',
                    data: [140, 90, 200, 330, 420, 100, 80, 220, 320, 360, 210, 70]
                },
                {
                    name: '2025',
                    data: [270, 200, 295, 390, 490, 265, 150, 300, 400, 480, 310, 210]
                }
            ],
            chart: {
                type: 'bar',
                height: 672,
                width: '100%',
                toolbar: {
                    show: false
                },
                animations: {
                    enabled: true,
                    easing: 'easeinout',
                    speed: 800
                }
            },
            colors: ['#FFC31F', '#0095FF'],
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '66%',
                    borderRadius: 8,
                    borderRadiusApplication: 'end',
                    borderRadiusWhenStacked: 'last',
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: false
            },
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                labels: {
                    style: {
                        colors: '#4B5675',
                        fontSize: '13.975px'
                    }
                }
            },
            yaxis: {
                min: 0,
                max: 500,
                tickAmount: 10,
                labels: {
                    style: {
                        colors: '#4B5675',
                        fontSize: '13.975px'
                    }
                }
            },
            grid: {
                borderColor: '#e5e7eb'
            },
            legend: {
                show: false
            },
            tooltip: {
                theme: 'light'
            },
            responsive: [{
                breakpoint: 768,
                options: {
                    chart: {
                        height: 300
                    },
                    plotOptions: {
                        bar: {
                            columnWidth: '50%'
                        }
                    }
                }
            }]
        };

        var chart1 = new ApexCharts(
            document.querySelector("#JobVacanciesvsJobAdsCreatedChart"),
            options1
        );
        chart1.render();

        var options2 = {
            chart: {
                type: 'bar',
                height: 672,
                width: '100%',
                toolbar: {
                    show: false
                },
            },
            series: [{
                name: 'Values',
                data: [140, 200, 295, 395, 485, 265, 140, 305, 395, 470, 335, 205, 210],
            }],
            plotOptions: {
                bar: {
                    borderRadius: 8,
                    borderRadiusApplication: 'end',
                    borderRadiusWhenStacked: 'last',
                    columnWidth: '36%',
                }
            },
            colors: ['#FFC31F'],
            dataLabels: {
                enabled: false
            },
            xaxis: {
                categories: [
                    'Level 1', 'Level 2', 'Level 3', 'Level 4', 'Level 5',
                    'Level 6', 'Level 7', 'Level 8', 'Level 9', 'Level 10',
                    'Level 11', 'Level 12', 'Level 13'
                ],
                labels: {
                    style: {
                        fontSize: '13.975px',
                        colors: '#4B5675'
                    }
                }
            },
            yaxis: {
                min: 0,
                max: 500,
                tickAmount: 10,
                labels: {
                    style: {
                        colors: '#4B5675',
                        fontSize: '13.975px'
                    }
                }
            },
            grid: {
                borderColor: '#f0f0f0',
                strokeDashArray: 3
            },
            tooltip: {
                theme: 'light'
            },
        };

        var chart2 = new ApexCharts(
            document.querySelector("#TotalJobPositionsChart"),
            options2
        );
        chart2.render();
    </script>

    <script>
        var financialOptions = {
            chart: {
                type: 'bar',
                height: 350,
                toolbar: {
                    show: false
                }
            },
            plotOptions: {
                bar: {
                    horizontal: true,
                    borderRadius: 4,
                    barHeight: '30%',
                    borderRadiusApplication: 'end',
                    borderRadiusWhenStacked: 'last',
                    dataLabels: {
                        position: 'center'
                    }
                }
            },
            dataLabels: {
                enabled: true,
                style: {
                    colors: ['#262527'],
                    fontSize: '14px'
                }
            },
            series: [{
                    name: 'Actual',
                    data: [31, 71]
                },
                {
                    name: 'Target',
                    data: [39, 87]
                }
            ],
            xaxis: {
                categories: ['Net Profit Margin', 'Reduce\nFinancial\nDisparity'],
                labels: {
                    style: {
                        fontSize: '12px',
                        colors: '#444'
                    }
                }
            },
            colors: [
                ({
                    seriesIndex,
                    dataPointIndex,
                    w
                }) => {
                    const category = w.globals.labels[dataPointIndex];
                    if (category === 'Net Profit Margin') return seriesIndex === 0 ? '#f7ddce' : '#fdead2';
                    if (category === 'Reduce\nFinancial\nDisparity') return seriesIndex === 0 ? '#b1360c' :
                        '#f17610';
                    return '#008FFB';
                }
            ],
            legend: {
                show: false
            },
            tooltip: {
                shared: false,
                intersect: true,
                y: {
                    formatter: val => val
                }
            }
        };
        new ApexCharts(document.querySelector("#FinancialControllerChart"), financialOptions).render();

        var operationalOptions = {
            ...financialOptions,
            series: [{
                    name: 'Actual',
                    data: [31, 71]
                },
                {
                    name: 'Target',
                    data: [39, 87]
                }
            ],
            xaxis: {
                categories: ['Net Profit Margin', 'Reduce\nFinancial\nDisparity'],
                labels: {
                    style: {
                        fontSize: '12px',
                        colors: '#444'
                    }
                }
            },
            colors: [
                ({
                    seriesIndex,
                    dataPointIndex,
                    w
                }) => {
                    const category = w.globals.labels[dataPointIndex];
                    if (category === 'Net Profit Margin') return seriesIndex === 0 ? '#f7ddce' : '#fdead2';
                    if (category === 'Reduce\nFinancial\nDisparity') return seriesIndex === 0 ? '#b1360c' :
                        '#f17610';
                    return '#008FFB';
                }
            ]
        };
        new ApexCharts(document.querySelector("#PeoplePerformanceCultureHeadChart"), operationalOptions).render();

        var customerOptions = {
            ...financialOptions,
            series: [{
                    name: 'Actual',
                    data: [31, 71]
                },
                {
                    name: 'Target',
                    data: [39, 87]
                }
            ],
            xaxis: {
                categories: ['Net Profit Margin', 'Reduce\nFinancial\nDisparity'],
                labels: {
                    style: {
                        fontSize: '12px',
                        colors: '#444'
                    }
                }
            },
            colors: [
                ({
                    seriesIndex,
                    dataPointIndex,
                    w
                }) => {
                    const category = w.globals.labels[dataPointIndex];
                    if (category === 'Net Profit Margin') return seriesIndex === 0 ? '#f7ddce' : '#fdead2';
                    if (category === 'Reduce\nFinancial\nDisparity') return seriesIndex === 0 ? '#b1360c' :
                        '#f17610';
                    return '#008FFB';
                }
            ]
        };
        new ApexCharts(document.querySelector("#FinancialControllerSecondChart"), customerOptions).render();
    </script>

    <script>
        var barOptions = {
            chart: {
                type: 'bar',
                height: 440,
                toolbar: {
                    show: false
                }
            },
            plotOptions: {
                bar: {
                    borderRadius: 4,
                    borderRadiusApplication: 'end',
                    borderRadiusWhenStacked: 'last',
                    horizontal: false,
                    columnWidth: '25%',
                    endingShape: 'rounded'
                }
            },
            dataLabels: {
                enabled: true,
                offsetY: -20,
                style: {
                    fontSize: '12px',
                    colors: ['#333']
                }
            },
            series: [{
                    name: 'Total Job Position',
                    data: [43, 37, 31, 21, 9]
                },
                {
                    name: 'Positions With Succession',
                    data: [36, 29, 19, 17, 7]
                }
            ],
            xaxis: {
                categories: ['Operations', 'Finance', 'Sales', 'Human Resources', 'Marketing'],
                labels: {
                    style: {
                        fontSize: '12px',
                        colors: '#262527'
                    }
                }
            },
            colors: ['#D5540A', '#F7941C'],
            legend: {
                position: 'top',
                horizontalAlign: 'left',
                fontSize: '13px',
                show: false
            },
            grid: {
                borderColor: '#e5e7eb',
                strokeDashArray: 4
            }
        };

        var barChart = new ApexCharts(document.querySelector("#successionBarChart"), barOptions);
        barChart.render();
    </script>

    <script>
        var barOptions = {
            chart: {
                type: 'bar',
                height: 440,
                toolbar: {
                    show: false
                }
            },
            plotOptions: {
                bar: {
                    borderRadius: 4,
                    borderRadiusApplication: 'end',
                    borderRadiusWhenStacked: 'last',
                    horizontal: false,
                    columnWidth: '25%',
                    endingShape: 'rounded'
                }
            },
            dataLabels: {
                enabled: true,
                offsetY: -20,
                style: {
                    fontSize: '12px',
                    colors: ['#333']
                }
            },
            series: [{
                    name: 'Total Job Position',
                    data: [43, 37, 31, 21, 9]
                },
                {
                    name: 'Positions With Succession',
                    data: [36, 29, 19, 17, 7]
                }
            ],
            xaxis: {
                categories: ['Operations', 'Finance', 'Sales', 'Human Resources', 'Marketing'],
                labels: {
                    style: {
                        fontSize: '12px',
                        colors: '#262527'
                    }
                }
            },
            colors: ['#D5540A', '#F7941C'],
            legend: {
                position: 'top',
                horizontalAlign: 'left',
                fontSize: '13px',
                show: false
            },
            grid: {
                borderColor: '#e5e7eb',
                strokeDashArray: 4
            }
        };

        var barChart = new ApexCharts(document.querySelector("#criticalBarChart"), barOptions);
        barChart.render();
    </script>

    <script>
        var donutOptions = {
            chart: {
                type: 'donut',
                height: 280
            },
            series: [43, 35],
            labels: ['Critical Job Position', 'Non-Critical Job Position'],
            colors: ['#217574', '#6fc9b8', '#e5e7eb'],
            dataLabels: {
                enabled: false
            },
            legend: {
                show: false
            },
            plotOptions: {
                pie: {
                    donut: {
                        size: '75%',
                        labels: {
                            show: true,
                            name: {
                                show: false
                            },
                            value: {
                                fontSize: '24px',
                                fontWeight: 600,
                                color: '#333',
                                formatter: () => "78%"
                            },
                            total: {
                                show: true,
                                label: 'Successor Set',
                                fontSize: '13px',
                                color: '#262527',
                                formatter: () => ''
                            }
                        }
                    }
                }
            }
        };

        var donutChart = new ApexCharts(document.querySelector("#successionDonutChart"), donutOptions);
        donutChart.render();
    </script>

    <script>
        var options = {
            chart: {
                type: 'donut',
                height: 340
            },
            series: [43, 35, 22],
            labels: ['Critical', 'Non-Critical', 'Remaining'],
            colors: ['#2a8277', '#4dd1bb', '#e5e7eb'],
            stroke: {
                width: 2,
                colors: ['#fff']
            },
            legend: {
                show: false
            },
            dataLabels: {
                enabled: false
            },
            plotOptions: {
                pie: {
                    donut: {
                        size: '60%',
                        labels: {
                            show: false
                        }
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#successionChart"), options);
        chart.render();
    </script>

    <script>
        var options = {
            chart: {
                type: 'donut',
                height: 200
            },
            series: [40, 25, 35],
            labels: ['Internal', 'External', 'Remaining'],
            colors: ['#7E43E4', '#00BBA7', '#F6F6F6'],
            stroke: {
                width: 2,
                colors: ['#fff']
            },
            legend: {
                show: false
            },
            dataLabels: {
                enabled: false
            },
            plotOptions: {
                pie: {
                    donut: {
                        size: '60%',
                        labels: {
                            show: false
                        }
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#responseRateChart"), options);
        chart.render();
    </script>

    <script>
        var options = {
            chart: {
                type: 'donut',
                height: 160
            },
            series: [40, 25],
            labels: ['Internal', 'Remaining'],
            colors: ['#7E43E4', '#F6F6F6'],
            stroke: {
                width: 2,
                colors: ['#fff']
            },
            legend: {
                show: false
            },
            dataLabels: {
                enabled: false
            },
            plotOptions: {
                pie: {
                    donut: {
                        size: '70%',
                        labels: {
                            show: false
                        }
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#internalResponseRateChart"), options);
        chart.render();
    </script>

    <script>
        var options = {
            chart: {
                type: 'donut',
                height: 160
            },
            series: [25, 35],
            labels: ['External', 'Remaining'],
            colors: ['#00BBA7', '#F6F6F6'],
            stroke: {
                width: 2,
                colors: ['#fff']
            },
            legend: {
                show: false
            },
            dataLabels: {
                enabled: false
            },
            plotOptions: {
                pie: {
                    donut: {
                        size: '70%',
                        labels: {
                            show: false
                        }
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#externalResponseRateChart"), options);
        chart.render();
    </script>

    <script>
        var options = {
            chart: {
                type: "line",
                height: 350,
                toolbar: {
                    show: false
                }
            },

            stroke: {
                width: 4,
                curve: "smooth"
            },

            series: [{
                name: "Data",
                data: [50, 85, 72, 158, 140, 170, 160, 210, 195, 210, 185, 115]
            }],

            colors: ["#F7941C"], // same orange color

            xaxis: {
                categories: [
                    "2 Oct",
                    "3 Oct",
                    "3 Oct",
                    "4 Oct",
                    "4 Oct",
                    "5 Oct",
                    "5 Oct",
                    "6 Oct",
                    "6 Oct",
                    "7 Oct",
                    "7 Oct",
                    "8 Oct"
                ],
                labels: {
                    style: {
                        colors: "#262527"
                    }
                }
            },

            yaxis: {
                min: 0,
                max: 300,
                tickAmount: 6,
                labels: {
                    style: {
                        colors: "#262527"
                    }
                }
            },

            markers: {
                size: 0,
                strokeWidth: 2,
                strokeColors: "#e58b21",
                hover: {
                    size: 6
                },
            },

            grid: {
                borderColor: "#eee",
                strokeDashArray: 4
            },

            dataLabels: {
                enabled: false
            }
        };

        var chart = new ApexCharts(document.querySelector("#AllResponses"), options);
        chart.render();
    </script>
@endsection
