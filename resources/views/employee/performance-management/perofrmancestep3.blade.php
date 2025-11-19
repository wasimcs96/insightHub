@extends('employee.layout.app')

@section('title', 'Roles')

@section('content')
<div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">

    <!--begin::Toolbar container-->
    <div id="kt_app_toolbar_container" class="app-container  container-fluid d-flex flex-stack ">


        <!--begin::Page title-->
        <div data-kt-swapper="true" data-kt-swapper-mode="{default: 'prepend', lg: 'prepend'}" data-kt-swapper-parent="{default: '#kt_app_content_container', lg: '#kt_app_toolbar_container'}" class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5 mb-lg-0">
            <!--begin::Title-->
            <h1 class="page-heading capitalize d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                Performance Review
            </h1>
            <!--end::Title-->


            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">

                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">
                    <a href="/admin/dashboard" class="text-muted text-hover-primary">
                        Performance </a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <!--end::Item-->

                <!--begin::Item-->
                <li class="breadcrumb-item capitalize text-muted">
                    Performance Review</li>
                <!--end::Item-->

            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
        <!--begin::Action group-->
        <!--begin::Toolbar end-->

        <!--end::Toolbar end-->
        <!--end::Action group-->
    </div>
    <!--end::Toolbar container-->
</div>
<div id="kt_app_content" class="app-content flex-column-fluid">
    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container">
        <!--begin::Card-->
        <div class="d-flex flex-column flex-lg-row mb-17">
        <div class="flex-lg-row-fluid">
        <div class="card">
            <!--begin::Card header-->

            <!--end::Card header-->

            <!--begin::Card body-->
                <!-- KPI Skills Table -->
                 @foreach($kpiSkills as $skill)
                 <h3>{{ $skill['kpi_type'] == 'mid_year' ? 'Mid Year Review' : 'End Year Review' }} {{ \Carbon\Carbon::parse($skill['review_date'])->year }}</h3>

                @break
                @endforeach
                <div class="flex-lg-row-fluid card card-body">
                <h3>KPI Skills Reviews</h3>
                <table class="table align-middle table-row-dashed fs-6 gy-5">
                    <thead>
                        <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0" style="background-color: #f7941d;color: white !important;border-radius: 44px;">
                            <th class="min-w-115px">Sr No</th>
                            <th class="min-w-125px">KPI Object</th>
                            <th class="min-w-100px">Review</th>
                            <th class="min-w-100px">Achievement</th>
                            <th class="min-w-100px">Review Date</th>
                            <th class="min-w-100px">KPI Type</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 fw-semibold">
                        @foreach ($kpiSkills as $index => $skill)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $skill['name'] }}</td>
                                <td>{{ $skill['level'] }}</td>
                                <td>{{ $skill['remark'] }}</td>
                                <td>{{ $skill['review_date'] }}</td>
                                <td>{{ $skill['kpi_type'] == 'mid_year' ? 'Mid Year' : 'End Year' }}</td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="score-section">
            <span class="label"><h5> Total Score: {{$kpiScore}} %</h5></span>
        </div>

                </div>
            <div class="flex-lg-row-fluid card card-body mt-3">
                <!-- Technical Skills Table -->
                <h3>Technical Skills Reviews</h3>
                <table class="table align-middle table-row-dashed fs-6 gy-5">
                    <thead>
                        <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0" style="background-color: #f7941d;color: white !important;border-radius: 44px;">
                            <th class="min-w-115px">Sr No</th>
                            <th class="min-w-125px">Skill</th>
                            <th class="min-w-100px">Review</th>
                            <th class="min-w-100px">Remark</th>
                            <th class="min-w-100px">Review Date</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 fw-semibold">
                        @foreach ($technicalSkills as $index => $skill)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $skill['name'] }}</td>
                                <td>{{ $skill['level'] }}</td>
                                <td>{{ $skill['remark'] }}</td>
                                <td>{{ $skill['review_date'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="score-section">
            <span class="label"><h5>Total Score: {{$technicalScore}} %</h5></span>
        </div>
                </div>
            
                <!-- Soft Skills Table -->
                <div class="flex-lg-row-fluid card card-body mt-3">
                <h3>Soft Skills Reviews</h3>
                <table class="table align-middle table-row-dashed fs-6 gy-5">
                    <thead>
                        <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0" style="background-color: #f7941d;color: white !important;border-radius: 44px;">
                            <th class="min-w-115px">Sr No</th>
                            <th class="min-w-125px">Skill</th>
                            <th class="min-w-100px">Review</th>
                            <th class="min-w-100px">Remark</th>
                            <th class="min-w-100px">Review Date</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 fw-semibold">
                        @foreach ($softSkills as $index => $skill)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $skill['name'] }}</td>
                                <td>{{ $skill['level'] }}</td>
                                <td>{{ $skill['remark'] }}</td>
                                <td>{{ $skill['review_date'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="score-section">
            <span class="label"><h5>Total Score: {{$softScore}} %</h5></span>
        </div>
                <div class="score-section">Soft SKill And Technical SKill
            <span class="label"><h5>Total Score: {{$overallScore}} %</h5></span>
        </div>
                <div class="score-section">KPI And Soft, Technical Skill Total
            <span class="label"><h5>Total Score: {{$finalScore}} %</h5></span>
        </div>
            </div>
        </div>
            <!--end::Card body-->
        
        <!--end::Card-->
        </div>
    </div>
    </div>
    <!--end::Content container-->
</div>

@endsection