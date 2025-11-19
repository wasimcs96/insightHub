@extends('admin.layout.app')

@section('title', 'Roles')

@section('styles')
<style>
    .displayNone {
        display: none;
    }

    .report-message-container {
        text-align: center;
        padding: 50px;
        color: #6c757d;
        font-family: Arial, sans-serif;
    }

    .report-message-container h2 {
        margin-bottom: 16px;
        font-size: 24px;
    }

    .report-message-container p {
        margin-bottom: 24px;
        font-size: 16px;
    }

    .report-link-button {
        display: inline-block;
        padding: 10px 20px;
        font-size: 16px;
        color: #f7941d;
        border: 1px solid #f7941d;
        border-radius: 22px;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }

    .step-bar-wrapper {
        font-size: 0;
        background: #fff;
        text-align: center;
        padding: 50px 0 0;
        width: 100%;
        margin: 30px auto 0;
        position: relative;
        z-index: 10;
        border-radius: 10px;
    }

    a {
        color: #5c399e;
    }

    .step-wrapper {
        padding: 0;
        margin: 0;
        font-size: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        counter-reset: step;
    }

    .step-wrapper li {
        width: 120px;
    }

    .step-wrapper li>a:before {
        content: '';
        width: 36px;
        height: 36px;
        display: block;
        font-size: 16px;
        font-weight: 700;
        background-color: transparent;
        border-radius: 100%;
        z-index: 1;
        position: absolute;
        text-align: center;
    }

    .step-wrapper li>a:after {
        content: counter(step);
        counter-increment: step;
        width: 36px;
        line-height: 36px;
        display: block;
        font-size: 16px;
        color: #bbb;
        font-weight: 700;
        background-color: transparent;
        border-radius: 100%;
        z-index: 1;
        position: absolute;
        text-align: center;
    }

    .step-wrapper li.completed>a:after {
        content: '\2713';
        color: currentColor;
    }

    .step-wrapper li:first-of-type a:before,
    .step-wrapper li:first-of-type a:after {
        margin-left: -42px;
    }

    .step-wrapper li:last-of-type>a:before,
    .step-wrapper li:last-of-type>a:after {
        margin-left: 39px;
    }

    .step-wrapper li.completed>a:before {
        background: #fff;
        color: #c4c4c4;
        box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.15);
    }

    .step-wrapper li.active>a:before {
        background-color: #f7941d;
        box-shadow: 0px 0px 9px 0px #f7941d;
        background-image: linear-gradient(top, rgba(247, 247, 247, 0.5), rgba(231, 231, 231, .01));
    }

    .step-wrapper li.active>a:after {
        color: #fff;
    }

    .step-wrapper li span {
        display: block;
        width: 100%;
        text-align: center;
        margin-bottom: 15px;
    }

    .step-wrapper li span a {
        font-size: 14px;
        font-weight: 700;
    }

    .step-wrapper li:not(.active):not(.completed) span a {
        color: #bbb;
    }

    .step-wrapper li>a {
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: hidden;
        height: 48px;
    }

    .step-wrapper li:first-of-type>a {
        padding-left: 40px;
    }

    .step-wrapper li:last-of-type>a {
        padding-right: 40px;
    }

    .step-wrapper li>a svg {
        height: 48px;
        min-height: 48px;
        width: auto;
        position: absolute;
        display: inline-block;
        stroke-width: 0;
        transition: all 300ms ease-in-out;
    }

    .step-wrapper li>a svg {
        filter: url(#inset-shadow);
    }

    a.button {
        margin: 50px 15px;
        display: inline-block;
        border-radius: 4px;
        width: 100px;
        height: 50px;
        text-align: center;
        line-height: 50px;
        background-color: currentColor;
        box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.15), inset 0px 0px 0px 2px rgba(0, 0, 0, 0.15), 0px 0px 21px 0px currentColor;
        background-image: linear-gradient(top, rgba(247, 247, 247, 0.5), rgba(231, 231, 231, .01));
    }

    a.button span {
        color: #fff;
        font-size: 16px;
    }

    .skill-container {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }

    .skill-row {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }

    .rating {
        display: flex;
    }

    .rating label {
        width: 22px;
        height: 22px;
        border-radius: 50%;
        background-color: #eee;
        display: inline-block;
        padding: 0px 6px;
        position: relative;
    }

    .rating input[type="radio"]:checked+label {
        background-color: #ffa500;
    }

    .remarks {
        border: 1px solid #ccc;
        border-radius: 4px;
        padding: 5px 10px;
        flex: 1;
    }

    .checkbox_tech:checked {
        background-color: #f7941d;
    }

    .badge {
        background-color: #f7941d;
        color: white;
        padding: 5px 10px;
        border-radius: 12px;
        font-size: 12px;
        display: inline-block;
        margin-left: 5px;
    }

    .technical-skill {
        margin-bottom: 10px;
    }

    .dropdown-container {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }
</style>
@endsection

@section('content')
<div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">
    <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                Dashboard
            </h1>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <li class="breadcrumb-item text-muted">
                    <a href="/admin/dashboard" class="text-muted text-hover-primary">
                        Admin </a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">
                    Skill Review </li>
            </ul>
        </div>
    </div>
</div>
<div id="kt_app_content" class="app-content  flex-column-fluid ">
    <div id="kt_app_content_container" class="app-container ">
        @include('admin/skill-competency.topnav')
        <div class="  mb-17">
            <div class="flex-lg-row-auto w-100  me-0 me-lg-10">
                <div class="card mb-10 ">
                    <div class="card-header">
                        <div class="card-toolbar">
                            <div class="my-1 me-4">
                                <select class="form-select form-select-sm form-select-solid w-125px" data-control="select2" data-placeholder="Select Year" data-hide-search="true" disabled>
                                    <option value="{{ $reviewYear }}" selected>{{ $reviewYear }}</option>
                                </select>
                            </div>
                            <div class="fs-5 text-gray-700 me-4">Compare with (Optional)</div>
                            <div class="my-1 me-4">
                                <form id="reviewYearForm" action="{{ route('admin.skill-competencies.getDataByYear', $userId) }}" method="post">
                                    @csrf
                                    <select id="reviewYearSelect" class="form-select form-select-sm form-select-solid w-125px" data-control="select2" data-placeholder="Select Review Year" data-hide-search="true">
                                        <option value="" selected disabled>Select Review Year</option>
                                        @foreach ($reviewYears as $year)
                                        @if ($year != $reviewYear)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-8 d-flex">
                            <h5 class="fs-4 text-gray-800 w-bolder mb-6">
                                Employee details
                            </h5>
                            <div class="my-2 d-flex align-items-center m-auto">
                                @if (isset($data['users']) && count($data['users']) > 0)
                                @foreach ($data['users'] as $userData)
                                <div class="   me-20">
                                    <div class="text-dark-600 color-dark fw-semibold fs-4">Name</div>
                                    <div class="text-gray-600 fw-semibold fs-3">{{ $userData['name'] }}</div>
                                </div>
                                @endforeach
                                @endif
                                <div class=" align-items-center mb-3 pt-4">
                                    <div class="text-dark-600 color-dark fw-semibold fs-4">Department</div>
                                    <div class="text-gray-600 fw-semibold fs-3">{{ $department->name }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion mb-5" id="accordionSkills">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingSoftSkills">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSoftSkills" aria-expanded="true" aria-controls="collapseSoftSkills">
                        <div
                                                            class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                                            <iconify-icon icon="ion:chevron-collapse" width="1.2em"
                                                                height="1.2em"></iconify-icon>
                                                        </div>
                          <h2>  Soft Skills </h2>
                        </button>
                    </h2>
                    <div id="collapseSoftSkills" class="accordion-collapse collapse show" aria-labelledby="headingSoftSkills" data-bs-parent="#accordionSkills">
                        <div class="accordion-body">
                            @foreach ($data['users'][0]['skills'] as $index => $skill)
                            <div class="skill-row justify-content-between mb-8 mt-8">
                                <label class="text-gray-800 fw-bold fs-3">{{ $skill['title'] }}</label>
                                <div class="rating col-lg-8">
                                    <div class="d-flex flex-column w-100">
                                        <div class="d-flex justify-content-around w-100 fs-4 fw-bold mb-3">
                                            <span>Level 0</span>
                                            <span>Level 1</span>
                                            <span>Level 2</span>
                                            <span>Level 3</span>
                                        </div>
                                        <div class="row align-items-center">
                                            @php
                                            $competencyLevel = $competencyLevels[$index] ?? 1;
                                            $progressWidth = $competencyLevel == 3 ? 100 : ($competencyLevel == 2 ? 65 : 35);
                                            @endphp
                                            <div class="fw-bold" style="width:10%">Minimal</div>
                                            <div class="h-20px bg-light-active p-0 rounded" style="width:80%">
                                                <div class="bg-success rounded h-20px" role="progressbar" style="width: {{ $progressWidth }}%; background-color: #667085 !important;" aria-valuenow="{{ $progressWidth }}" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <div class="fs-5 fw-bold" style="width: 9%;border-radius: 16px;color: #B54708;background-color: #FFFAEB !important;text-align: center;margin-left: 5px;">Level {{ $competencyLevel }}</div>
                                        </div>
                                        <div class="row mt-5">
                                            @php
                                            $competencyResult = App\Helpers\AssessmentHelper::getWorkCompetencySixteenResultFull($userId);
                                            if ($competencyResult[$skill['title']] <= 33) {
                                            $competencyLevel = 1;
                                            $progressWidth = 35;
                                            } elseif ($competencyResult[$skill['title']] <= 67) {
                                            $competencyLevel = 2;
                                            $progressWidth = 65;
                                            } else {
                                            $competencyLevel = 3;
                                            $progressWidth = 100;
                                            }
                                            @endphp
                                            <div class="fw-bold" style="width:10%">{{ $data['users'][0]['initials'] }}</div>
                                            <div class="h-20px bg-light-active p-0 rounded" style="width:80%">
                                                <div class="bg-success rounded h-20px" role="progressbar" style="width: {{ $progressWidth }}%; background-color: #0086c9 !important;" aria-valuenow="{{ $progressWidth }}" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <div class="fs-5 fw-bold" style="width: 9%;border-radius: 16px;color: #B54708;background-color: #FFFAEB !important;text-align: center;margin-left: 5px;">Level {{ $competencyLevel }}</div>
                                        </div>
                                        @if (isset($data['users'][0]['soft_skills']))
                                        @php
                                        $latestReviewYear = null;
                                        $latestReviewSkills = null;
                                        $reviewRemark = '';
                                        $selectedRemark = '';
                                        $skillChange = '';
                                        $latestReview = null;
                                        $skillLevel = 1;
                                        foreach ($data['users'][0]['soft_skills'] as $review) {
                                        if ($review['year'] == $reviewYear) {
                                        $latestReview = $review;
                                        break;
                                        }
                                        }
                                        if ($latestReview) {
                                        foreach ($latestReview['skills'] as $softSkill) {
                                        if ($softSkill['title'] == $skill['title']) {
                                        $skillLevel = $softSkill['level'];
                                        $progressWidth = $skillLevel == 3 ? 100 : ($skillLevel == 1 ? 35 : 65);
                                        $reviewRemark = $softSkill['remarks'];
                                        break;
                                        }
                                        }
                                        }
                                        @endphp
                                        @if ($latestReview)
                                        @php
                                        if (isset($selectedYear)){
                                        $selectedSkill = collect($selectedYear[0]['skills'])->firstWhere('title', $skill['title']);
                                        $selectedSkillLevel = $selectedSkill['level'];
                                        $levelDifference = $skillLevel - $selectedSkillLevel;
                                        $skillChange = $levelDifference > 0 ? 'up' : ($levelDifference < 0 ? 'down' : 'no change');
                                        $calculatedLevel = max($skillLevel, $selectedSkillLevel);
                                        $iconColor = $skillChange == 'down' ? '#dd6903' : ($skillChange == 'up' ? '#28a745' : '#B54708');
                                        $backgroundColor = $skillChange == 'up' ? '#d4edda' : '#FFFAEB';
                                        $textColor = $skillChange == 'up' ? '#155724' : '#B54708';
                                        $progressBarColor = $skillChange == 'up' ? '#28a745' : ($skillChange == 'down' ? '#dd6903' : '#dc6902');
                                        } else {
                                        $textColor = '#B54708';
                                        $progressBarColor = '#dc6902';
                                        $backgroundColor = '#FFFAEB';
                                        $iconColor = '#B54708';
                                        }
                                        @endphp
                                        <div class="row mt-5">
                                            <div class="fw-bold" style="width:10%">Review</div>
                                            <div class="h-20px bg-light-active p-0 rounded" style="width:80%">
                                                <div class="bg-success rounded h-20px" role="progressbar" style="width: {{ $progressWidth }}%; background-color: {{ $progressBarColor }} !important;" aria-valuenow="{{ $progressWidth }}" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <div class="fs-6 fw-bold" style="width: 9%; border-radius: 16px; color: {{ $textColor }}; background-color: {{ $backgroundColor }} !important; text-align: center; margin-left: 5px;">
                                                @if(isset($selectedYear))
                                                <iconify-icon icon="mdi:arrow-{{ $skillChange == 'up' ? 'up' : 'down' }}-thin" style="color: {{ $iconColor }}"></iconify-icon>
                                                @endif
                                                Level {{ $skillLevel }}
                                            </div>
                                            <p id="reviewYear" class="mt-2 fw-bold text-muted" data-year="{{ $latestReview['year'] }}">
                                                Review Date: {{ $latestReview['year'] }}
                                            </p>
                                        </div>
                                        @endif
                                        @endif
                                        @if (isset($selectedYear))
                                        @foreach ($selectedYear[0]['skills'] as $selectedSkill)
                                        @if ($selectedSkill['title'] == $skill['title'])
                                        @php
                                        $selectedSkillLevel = $selectedSkill['level'];
                                        $selectedProgressWidth = $selectedSkillLevel == 2 ? 100 : ($selectedSkillLevel == 1 ? 65 : 35);
                                        $selectedRemark = $selectedSkill['remarks'];
                                        @endphp
                                        <div class="row">
                                            <div class="fw-bold" style="width:10%">Review 2</div>
                                            <div class="h-20px bg-light-active p-0 rounded" style="width:80%">
                                                <div class="bg-success rounded h-20px" role="progressbar" style="width: {{ $selectedProgressWidth }}%; background-color: #673AB7 !important;" aria-valuenow="{{ $selectedProgressWidth }}" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <div class="fs-5 fw-bold" style="width: 9%; border-radius: 16px; color: #B54708; background-color: #FFFAEB !important; text-align: center; margin-left: 5px;">
                                                Level {{ $selectedSkillLevel }}
                                            </div>
                                            <p id="selectedReviewYear" class="mt-2 fw-bold text-muted" data-year="{{ $selectedYear[0]['year'] }}">
                                                Review Date: {{ $selectedYear[0]['year'] }}
                                            </p>
                                        </div>
                                        @endif
                                        @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div>
                                    <button type="button" class="remarks btn-sm btn btn-primary d-flex align-items-center position-relative" data-review-remark="{{ $reviewRemark }}" data-selected-remark="{{ $selectedRemark }}">
                                        <iconify-icon icon="lucide:view" class="me-1 fa-1-5"></iconify-icon> Remarks
                                        @if ($reviewRemark || $selectedRemark)
                                        <span class="badge position-absolute top-0 start-100 translate-middle">1</span>
                                        @endif
                                    </button>
                                </div>
                            </div>
                            <div class="separator separator-dashed"></div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTechnicalSkills">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTechnicalSkills" aria-expanded="false" aria-controls="collapseTechnicalSkills">
                        <div
                                                            class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                                            <iconify-icon icon="ion:chevron-collapse" width="1.2em"
                                                                height="1.2em"></iconify-icon>
                                                        </div>
                         <h2>   Technical Skills </h2>
                        </button>
                    </h2>
                    <div id="collapseTechnicalSkills" class="accordion-collapse collapse" aria-labelledby="headingTechnicalSkills" data-bs-parent="#accordionSkills">
                        <div class="accordion-body">
                            @foreach ($data['users'][0]['technical_skills'] as $index => $techSkill)
                            <div class="skill-row justify-content-between mb-8 mt-8">
                                <div class="col-lg-2">
                                    <label class="text-gray-800 fw-bold fs-3">{{ $techSkill['title'] }}</label>
                                </div>
                                <div class="rating col-lg-8">
                                    <div class="d-flex flex-column w-100">
                                        <div class="d-flex justify-content-around w-100 fs-4 fw-bold mb-3">
                                            <span>Level 0</span>
                                            <span>Level 1</span>
                                            <span>Level 2</span>
                                            <span>Level 3</span>
                                            <span>Level 4</span>
                                            <span>Level 5</span>
                                            <span>Level 6</span>
                                        </div>
                                        <div class="row align-items-center">
                                            @php
                                            $techCompetencyLevel = $techSkill['pivot']['level'] ?? 1;
                                            $techProgressWidth = ($techCompetencyLevel / 6) * 100;
                                            @endphp
                                            <div class="fw-bold" style="width:10%">Minimal</div>
                                            <div class="h-20px bg-light-active p-0 rounded" style="width:80%">
                                                <div class="bg-success rounded h-20px" role="progressbar" style="width: {{ $techProgressWidth }}%; background-color: #667085 !important;" aria-valuenow="{{ $techProgressWidth }}" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <div class="fs-5 fw-bold" style="width: 9%;border-radius: 16px;color: #B54708;background-color: #FFFAEB !important;text-align: center;margin-left: 5px;">Level {{ $techCompetencyLevel }}</div>
                                        </div>
                                        @if (isset($data['users'][0]['techskills']))
                                        @php
                                        $latestReviewYear = null;
                                        $latestReviewSkills = null;
                                        $reviewRemark = '';
                                        $selectedRemark = '';
                                        $skillChange = '';
                                        $latestReview = null;
                                        $skillLevel = 1;
                                        foreach ($data['users'][0]['techskills'] as $review) {
                                        if ($review['year'] == $reviewYear) {
                                        $latestReview = $review;
                                        break;
                                        }
                                        }
                                        if ($latestReview) {
                                        foreach ($latestReview['skills'] as $techReviewSkill) {
                                        if ($techReviewSkill['title'] == $techSkill['title']) {
                                        $skillLevel = $techReviewSkill['level'];
                                        $progressWidth = ($skillLevel / 6) * 100;
                                        $reviewRemark = $techReviewSkill['remarks'];
                                        break;
                                        }
                                        }
                                        }
                                        @endphp
                                        @if ($latestReview)
                                        @php
                                        if (isset($selectedYear)){
                                        $selectedSkill = collect($selectedYear[0]['skills'])->firstWhere('title', $techSkill['title']);
                                        $selectedSkillLevel = $selectedSkill['level'];
                                        $levelDifference = $skillLevel - $selectedSkillLevel;
                                        $skillChange = $levelDifference > 0 ? 'up' : ($levelDifference < 0 ? 'down' : 'no change');
                                        $calculatedLevel = max($skillLevel, $selectedSkillLevel);
                                        $iconColor = $skillChange == 'down' ? '#dd6903' : ($skillChange == 'up' ? '#28a745' : '#B54708');
                                        $backgroundColor = $skillChange == 'up' ? '#d4edda' : '#FFFAEB';
                                        $textColor = $skillChange == 'up' ? '#155724' : '#B54708';
                                        $progressBarColor = $skillChange == 'up' ? '#28a745' : ($skillChange == 'down' ? '#dd6903' : '#dc6902');
                                        } else {
                                        $textColor = '#B54708';
                                        $progressBarColor = '#dc6902';
                                        $backgroundColor = '#FFFAEB';
                                        $iconColor = '#B54708';
                                        }
                                        @endphp
                                        <div class="row mt-5">
                                            <div class="fw-bold" style="width:10%">Review</div>
                                            <div class="h-20px bg-light-active p-0 rounded" style="width:80%">
                                                <div class="bg-success rounded h-20px" role="progressbar" style="width: {{ $progressWidth }}%; background-color: {{ $progressBarColor }} !important;" aria-valuenow="{{ $progressWidth }}" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <div class="fs-6 fw-bold" style="width: 9%; border-radius: 16px; color: {{ $textColor }}; background-color: {{ $backgroundColor }} !important; text-align: center; margin-left: 5px;">
                                                @if(isset($selectedYear))
                                                <iconify-icon icon="mdi:arrow-{{ $skillChange == 'up' ? 'up' : 'down' }}-thin" style="color: {{ $iconColor }}"></iconify-icon>
                                                @endif
                                                Level {{ $skillLevel }}
                                            </div>
                                            <p id="reviewYear" class="mt-2 fw-bold text-muted" data-year="{{ $latestReview['year'] }}">
                                                Review Date: {{ $latestReview['year'] }}
                                            </p>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div>
                                    <button type="button" class="remarks btn-sm btn btn-primary d-flex align-items-center position-relative" data-review-remark="{{ $reviewRemark }}" data-selected-remark="{{ $selectedRemark }}">
                                        <iconify-icon icon="lucide:view" class="me-1 fa-1-5"></iconify-icon> Remarks
                                        @if ($reviewRemark || $selectedRemark)
                                        <span class="badge position-absolute top-0 start-100 translate-middle">1</span>
                                        @endif
                                    </button>
                                </div>
                                <div class="separator separator-dashed"></div>
                            </div>
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div id="remarksModal" class="modal">
                <div class="card bg-light shadow-sm modal-content">
                    <div class="card-header">
                        <h3 class="card-title">Remark | &nbsp;<span class="fs-5 fw-bold"> Selected Year:</span><span id="selected_year" class="fw-medium text-gray-800"></span></h3>
                        <div class="card-toolbar">
                            <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                <span class="close text-end"><iconify-icon icon="bytesize:close" class="fa-2xs"></iconify-icon></span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body card-scroll h-200px">
                        <p><span class="fs-5 fw-bold">Selected Year Remarks:</span> <span id="selectedYearRemarks" class="fw-medium text-gray-800"></span></p>
                        <div class="separator separator-dashed"></div>
                        <p><span class="fs-5 fw-bold">Remarks:</span> <span id="reviewRemarks" class="fw-medium text-gray-800"> </span> </p>
                    </div>
                </div>
            </div>
            @endsection

            @section('scripts')
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const reviewYearSelect = document.getElementById('reviewYearSelect');
                    reviewYearSelect.addEventListener('change', function() {
                        document.getElementById('reviewYearForm').submit();
                    });

                    // Initialize select2 for the technical skills dropdown
                    $('#technicalSkillsDropdown').select2({
                        placeholder: "Select Technical Skills",
                        allowClear: true
                    });
                });
            </script>
            <script>
                $(document).ready(function() {
                    var modal = document.getElementById("remarksModal");
                    var span = document.getElementsByClassName("close")[0];
                    var body = document.getElementById("kt_app_body");

                    $('.remarks').click(function() {
                        var reviewRemark = $(this).data('review-remark');
                        var selectedRemark = $(this).data('selected-remark');

                        var reviewYear = $('#reviewYear').data('year');
                        var selectedYear = $('#selectedReviewYear').data('year');
                        $('#reviewRemarks').text(reviewRemark);
                        $('#selectedYearRemarks').text(selectedRemark);

                        modal.style.display = "block";
                        body.style.overflow = "hidden";
                    });

                    span.onclick = function() {
                        modal.style.display = "none";
                        body.style.overflow = "scroll";
                    }

                    window.onclick = function(event) {
                        if (event.target == modal) {
                            modal.style.display = "none";
                            body.style.overflow = "scroll";
                        }
                    }
                });
            </script>
            <script>
                $(document).ready(function() {
                    $('#reviewYearSelect').change(function() {
                        var selectedYear = $(this).val();
                        var userId = "{{ $userId }}";

                        if (selectedYear) {
                            var redirectUrl =
                                "{{ route('admin.skill-competencies.getDataByYear', ['id' => ':userId']) }}"
                                .replace(':userId', userId) + "?year=" + selectedYear + "&selectedYear=1";

                            window.location.href = redirectUrl;
                        }
                    });
                });

                $(document).ready(function() {
                    $('#employees').select2({
                        maximumSelectionLength: 5,
                        placeholder: "Select Employees",
                        allowClear: true
                    });
                });

                $(document).ready(function() {
                    $('#departments').select2({
                        maximumSelectionLength: 2,
                        placeholder: "Select Department",
                        allowClear: true
                    });
                });

                document.getElementById("pool").addEventListener("change", function() {
                    var value = this.value;
                    var departmentsDiv = document.getElementById("departmentsDiv");
                    var employeesDiv = document.getElementById("employeesDiv");

                    if (value == "departments") {
                        employeesDiv.classList.add("displayNone");
                        departmentsDiv.classList.remove("displayNone");
                    } else if (value == "employees") {
                        departmentsDiv.classList.add("displayNone");
                        employeesDiv.classList.remove("displayNone");
                    } else {
                        departmentsDiv.classList.add("displayNone");
                        employeesDiv.classList.remove("displayNone");
                    }
                });

                document.addEventListener("DOMContentLoaded", function() {
                    history.pushState(null, null, location.href);

                    window.addEventListener('popstate', function(event) {
                        history.pushState(null, null, location.href);
                    });

                    var modal = document.getElementById("remarksModal");
                    var span = document.getElementsByClassName("close")[0];

                    $('.remarks').click(function() {
                        var reviewRemark = $(this).data('review-remark');
                        var selectedRemark = $(this).data('selected-remark');
                        $('#reviewRemarks').text("Review Remarks: " + reviewRemark);
                        $('#selectedYearRemarks').text("Selected Year Remarks: " + selectedRemark);

                        modal.style.display = "block";
                    });

                    span.onclick = function() {
                        modal.style.display = "none";
                    }

                    window.onclick = function(event) {
                        if (event.target == modal) {
                            modal.style.display = "none";
                        }
                    }
                });
            </script>
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    history.pushState(null, null, location.href);

                    window.addEventListener('popstate', function(event) {
                        history.pushState(null, null, location.href);
                        alert("Back navigation is disabled on this page.");
                    });

                    var modal = document.getElementById("remarksModal");
                    var span = document.getElementsByClassName("close")[0];

                    $('.remarks').click(function() {
                        var reviewRemark = $(this).data('review-remark');
                        var selectedRemark = $(this).data('selected-remark');
                        $('#reviewRemarks').text("Review Remarks: " + reviewRemark);
                        $('#selectedYearRemarks').text("Selected Year Remarks: " + selectedRemark);

                        modal.style.display = "block";
                    });

                    span.onclick = function() {
                        modal.style.display = "none";
                    }

                    window.onclick = function(event) {
                        if (event.target == modal) {
                            modal.style.display = "none";
                        }
                    }
                });
            </script>
            @endsection
