@extends('employee.layout.app')

@section('title', 'Roles')

@section('styles')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <!--begin::Toolbar container-->
    <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
        <!--begin::Page title-->
        <div data-kt-swapper="true" data-kt-swapper-mode="{default: 'prepend', lg: 'prepend'}" data-kt-swapper-parent="{default: '#kt_app_content_container', lg: '#kt_app_toolbar_container'}" class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5 mb-lg-0">
            <!--begin::Title-->
            <h1 class="page-heading capitalize d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                Performance Review - {{ $currentYear }}
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
        <div class="d-flex align-items-center gap-2">
            @if ($showPlanButton && $adminCanAddPlanningKPI)
            <a href="/performance/plan" class="btn btn-primary">Plan Performance Now</a>
            @endif

            @if ($showButtons)
            @if ($showMidYearButton)
            <a href="{{ route('performance.management.addKpi', ['type' => 'mid-year']) }}" class="btn btn-primary">Add Mid-Year KPI</a>
            @endif

            @if ($showEndYearButton)
            <a href="{{ route('performance.management.addKpi', ['type' => 'end-year']) }}" class="btn btn-primary">Add End Year KPI</a>
            @endif
            @endif
        </div>
        <!--end::Action group-->
    </div>
    <!--end::Toolbar container-->
</div>
<div id="kt_app_content" class="app-content flex-column-fluid">
    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-xxl">
        <!--begin::Card-->
        <div class="d-flex flex-column flex-lg-row mb-17">
            <div class="flex-lg-row-fluid">
                @if ($latestKPI)

                <div class="card h-full tab-pane">
                    <header class="card-header align-items-center">
                        <h4 class="card-title">KPI Skills Review</h4>
                        <div class="d-flex" style="align-items: center;"></div>
                    </header>
                    <div class="card-body p-6">
                        <table class="table table-striped">
                            @php
                            $totalKpi = 0;
                            @endphp
                            @foreach ($latestKPI->objectives as $objective)
                            <thead>
                                <tr>
                                    <td colspan="6" class="fw-bold">Objectives: {{ $objective->objectives }}</td>
                                    <td colspan="1" class="fw-bold text-end">Weightage: {{ $objective->weightage }}%</td>
                                </tr>
                                <tr>
                                    <th>Objective</th>
                                    <th>Weightage</th>
                                    <th>KPI</th>
                                    <th>Rating</th>
                                    <th>Base Target</th>
                                    <th>Stretch Target</th>
                                    <th>Manager Evaluation</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 fw-semibold">
                                @php
                                $sumKpiRatings = 0;
                                $kpiCount = count($objective->keys);
                                @endphp
                                @foreach ($objective->keys as $key)
                                @php
                                $sumKpiRatings += $key->rank;
                                @endphp
                                <tr>
                                    <td>{{ $objective->objectives }}</td>
                                    <td>{{ $objective->weightage }}</td>
                                    <td>{{ $key->kpi }}</td>
                                    <td>{{ $key->rank }}</td>
                                    <td>{{ $key->base_target }}</td>
                                    <td>{{ $key->stretch_target }}</td>
                                    <td>{{ $key->manager_evaluation ?? 'N/A' }}</td>
                                </tr>
                                @endforeach
                                @php
                                $objectiveWeightage = $objective->weightage;
                                $averageKpiRating = $kpiCount > 0 ? ($sumKpiRatings / $kpiCount) : 0;
                                $weightedKpiRating = ($averageKpiRating * $objectiveWeightage) / 100;
                                $totalKpi += $weightedKpiRating;
                                @endphp
                            </tbody>
                            @endforeach
                        </table>
                        <div class="container">
                            <div class="d-flex justify-content-end">
                                <p class="text-end me-10"><strong>Total Weighted Rating:</strong></p>
                                <p><strong>{{ number_format($totalKpi, 2) }}</strong></p>
                            </div>
                        </div>
                    </div>
                </div>

                @endif
                <div class="card h-full tab-pane">
                    <header class="card-header align-items-center">
                        <h4 class="card-title">Technical Skills Reviews</h4>
                        <div class="d-flex" style="align-items: center;"></div>
                    </header>
                    <!-- Technical Skills Table -->
                    <div class="card-body p-6">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Sr No</th>
                                    <th>Skill</th>
                                    <th>AR (Approved Rating)</th>
                                    <th>JD</th>
                                    <th>GAP</th>
                                    <th>Manager Evaluation</th>
                                    <th>Manager Remarks</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 fw-semibold">
                                @php
                                $totalTechnical = 0;
                                $countTechnical = 0;
                                @endphp
                                @foreach ($user['technical_skills'] as $index => $skill)
                                @php
                                // Initialize the variables for approved rating, remark, and review date
                                $approvedRating = null;
                                $remark = null;
                                $managerEvaluation = null;
                                // Loop through the skill reviews to find a matching skill name
                                foreach ($skillReviews as $review) {
                                foreach ($review->details as $detail) {
                                if ($detail->name == $skill['name']) {
                                $approvedRating = $detail->level;
                                $managerRemarks = $detail->remark;
                                $remark = $detail->remark;
                                $managerEvaluation = $detail->manager_evaluation;
                                break 2; // Exit both loops once a match is found
                                }
                                }
                                }
                                // Calculate the gap between approved rating and JD level
                                $gap = $approvedRating !== null && $skill['pivot']['level'] !== null ? $approvedRating - $skill['pivot']['level'] : null;
                                $jdRating = $skill['pivot']['level'] ?? 1;
                                $arRating = $skill['level'] ?? 1;
                                $percentage = $arRating < $jdRating ? ($arRating / $jdRating) * 100 : 100; $totalTechnical +=$percentage; $countTechnical++; @endphp <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $skill['name'] }}</td>
                                    <td>{{ $approvedRating }}</td>
                                    <td>{{ $jdRating }}</td>
                                    <td>{{ $gap }}</td>
                                    <td>{{ $managerEvaluation ?? 'N/A' }}</td>
                                    <td>{{ $managerRemarks ?? 'N/A' }}</td>
                                    </tr>
                                    @endforeach
                            </tbody>

                        </table>
                        <!-- <div class="container">-->
                        @php
                        $totalAverageTechnical = $countTechnical > 0 ? $totalTechnical / $countTechnical : 0;
                        $totalPointsTechnical = number_format(floatval($totalAverageTechnical / 25), 2);
                        @endphp
                        <div class="container">
                            <div class="d-flex justify-content-end">
                                <p class="text-end me-10"><strong>Total Percentage:</strong></p>
                                <p><strong>{{ number_format($totalAverageTechnical, 2) }}%</strong></p>
                            </div>
                            <div class="d-flex justify-content-end">
                                <p class="text-end me-10"><strong>Total Points::</strong></p>
                                <p><strong>{{ $totalPointsTechnical }}</strong></p>
                            </div>
                        </div>
                    </div>
                    <div class="score-section"></div>
                </div>

                <div class="card h-full tab-pane">
                    <header class="card-header align-items-center">
                        <h4 class="card-title">Soft Skills Reviews</h4>
                        <div class="d-flex" style="align-items: center;"></div>
                    </header>
                    <div class="card-body p-6">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Sr No</th>
                                    <th>Skill</th>
                                    <th>AR (Approved Rating)</th>
                                    <th>JD</th>
                                    <th>GAP</th>
                                    <th>Manager Evaluation</th>
                                    <th>Manager Remarks</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $totalSoft = 0;
                                $countSoft = 0;
                                @endphp
                                @foreach ($user['skills'] as $index => $skill)
                                @php
                                $approvedRating = null;
                                $managerEvaluation = null;
                                foreach ($skillReviews as $review) {
                                foreach ($review->details as $detail) {
                                if ($detail->name == $skill['title']) {
                                $approvedRating = $detail->level;
                                $managerRemarks = $detail->remark;
                                $managerEvaluation = $detail->manager_evaluation;
                                break 2;
                                }
                                }
                                }
                                $gap = $approvedRating !== null && $skill['level'] !== null ? $approvedRating - $skill['level'] : null;
                                $jdRating = $skill['level'] ?? 1;
                                $arRating = $skill['level'] ?? 1;
                                $percentage = $arRating < $jdRating ? ($arRating / $jdRating) * 100 : 100; $totalSoft +=$percentage; $countSoft++; @endphp <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $skill['title'] }}</td>
                                    <td>{{ $approvedRating }}</td>
                                    <td>{{ $jdRating }}</td>
                                    <td>{{ $gap }}</td>
                                    <td>{{ $managerEvaluation ?? 'N/A' }}</td>
                                    <td>{{ $managerRemarks ?? 'N/A' }}</td>
                                    </tr>
                                    @endforeach
                            </tbody>
                        </table>
                        @php
                        $totalAverageSoft = $countSoft > 0 ? $totalSoft / $countSoft : 0;
                        $totalPointsSoft = number_format(floatval($totalAverageSoft / 25), 2);
                        @endphp
                        <div class="container">
                            <div class="d-flex justify-content-end">
                                <p class="text-end me-10"><strong>Total Percentage:</strong></p>
                                <p><strong>{{ number_format($totalAverageSoft, 2) }}%</strong></p>
                            </div>
                            <div class="d-flex justify-content-end">
                                <p class="text-end me-10"><strong>Total Points::</strong></p>
                                <p><strong>{{ $totalPointsSoft }}</strong></p>
                            </div>
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