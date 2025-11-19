@extends('employee.layout.app')

@section('title', 'Roles')

@section('styles')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
        <div data-kt-swapper="true" data-kt-swapper-mode="{default: 'prepend', lg: 'prepend'}" data-kt-swapper-parent="{default: '#kt_app_content_container', lg: '#kt_app_toolbar_container'}" class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5 mb-lg-0">
            <h1 class="page-heading capitalize d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                Performance Review - {{ $currentYear }}
            </h1>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <li class="breadcrumb-item text-muted">
                    <a href="/admin/dashboard" class="text-muted text-hover-primary">
                        Performance </a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item capitalize text-muted">
                    Performance Review</li>
            </ul>
        </div>
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
    </div>
</div>
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">
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
                                    <th>Base Target</th>
                                    <th>Stretch Target</th>
                                    <th>Manager Rating</th>
                                    @if ($latestKPI->kpi_type === 'mid-year' || $latestKPI->kpi_type === 'end-year')
                                    <th>Employee Planning</th>
                                    @endif
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
                                    <td>{{ $key->base_target }}</td>
                                    <td>{{ $key->stretch_target }}</td>
                                    <td>{{ $key->rank ?? 'N/A' }}</td>
                                    @if ($latestKPI->kpi_type === 'mid-year' || $latestKPI->kpi_type === 'end-year')
                                    <td>{{ $key->employee_planning ?? 'N/A' }}</td>
                                    @endif
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
                    </div>
                </div>
                @endif
                <div class="card h-full tab-pane">
                    <header class="card-header align-items-center">
                        <h4 class="card-title">Technical Skills Reviews</h4>
                        <div class="d-flex" style="align-items: center;"></div>
                    </header>
                    <div class="card-body p-6">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Sr No</th>
                                    <th>Skill</th>
                                    <th>Manager Rating</th>

                                    <th>AR (Approved Rating)</th>
                                    <th>JD</th>
                                    <th>GAP</th>
                                    <th>Employee Planning</th>
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
                                $approvedRating = null;
                                $remark = null;
                                $managerEvaluation = null;
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
                                $gap = $approvedRating !== null && $skill['pivot']['level'] !== null ? $approvedRating - $skill['pivot']['level'] : null;
                                $jdRating = $skill['pivot']['level'] ?? 1;
                                $arRating = $skill['level'] ?? 1;
                                $percentage = $arRating < $jdRating ? ($arRating / $jdRating) * 100 : 100; $totalTechnical +=$percentage; $countTechnical++; @endphp <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $skill['name'] }}</td>
                                    <td>{{ $key->rank ?? 'N/A' }}</td>
                                    <td>{{ $approvedRating }}</td>
                                    <td>{{ $jdRating }}</td>
                                    <td>{{ $gap }}</td>
                                    <td>{{ $managerEvaluation ?? 'N/A' }}</td>
                                    <td>{{ $managerRemarks ?? 'N/A' }}</td>
                                    </tr>
                                    @endforeach
                            </tbody>
                            @php
                            $totalAverageTechnical = $countTechnical > 0 ? $totalTechnical / $countTechnical : 0;
                            $totalPointsTechnical = number_format(floatval($totalAverageTechnical / 25), 2);
                            @endphp
                        </table>
                    </div>
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
                                    <th>Manager Rating</th>
                                    <th>AR (Approved Rating)</th>
                                    <th>JD</th>
                                    <th>GAP</th>
                                
                                    <th>Employee Planning</th>
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
                                $managerRemarks = $detail->manager_evaluation;
                                $managerEvaluation = $detail->remark;
                                break 2;
                                }
                                }
                                }
                                $gap = $approvedRating !== null && $skill['level'] !== null ? $approvedRating - $skill['level'] : null;
                                $jdRating = $skill['level'] ?? 1;
                                $arRating = $skill['level'] ?? 1;
                                $percentage = $arRating < $jdRating ? ($arRating / $jdRating) * 100 : 100; $totalSoft +=$percentage; $countSoft++; @endphp 
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $skill['title'] }}</td>
                                    <td>{{ $key->rank ?? 'N/A' }}</td>
                                    <td>{{ $approvedRating }}</td>
                                    <td>{{ $jdRating }}</td>
                                    <td>{{ $gap }}</td>
                                    <td>{{ $managerEvaluation ?? 'N/A' }}</td>
                                    <td>{{ $managerRemarks ?? 'N/A' }}</td>
                                    </tr>
                                    @endforeach
                            </tbody>
                            @php
                            $totalAverageSoft = $countSoft > 0 ? $totalSoft / $countSoft : 0;
                            $totalPointsSoft = number_format(floatval($totalAverageSoft / 25), 2);
                            @endphp
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
