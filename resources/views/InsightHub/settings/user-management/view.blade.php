@extends('insighthub.layout.app')

@section('title', 'View User')

@section('styles')
<style>
    .ihub-bg {
        background: #FCFCFC;
        min-height: 100vh;
        padding-bottom: 48px;
    }
    .ihub-main-wrap {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 48px;
        width: 100%;
    }
    .ihub-header-card {
        width: 1512px;
        padding: 0 124px;
        background: #fff;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .ihub-header-left {
        width: 1084px;
        display: flex;
        align-items: center;
        gap: 20px;
    }
    .ihub-logo-box {
        width: 210px;
        height: 50px;
        background: #fff;
        display: flex;
        align-items: flex-start;
        justify-content: flex-start;
        gap: 10px;
    }
    .ihub-header-tabs {
        display: flex;
        align-items: center;
        gap: 6.5px;
    }
    .ihub-header-tab,
    .ihub-header-tab-active {
        height: 74px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        padding: 9px 13px;
        font-size: 14.3px;
        font-weight: 600;
        font-family: Inter, sans-serif;
        color: #727790;
        background: none;
    }
    .ihub-header-tab-active {
        background: #F5F7F8;
        color: #F7941C;
    }
    .ihub-header-avatar {
        width: 35px;
        height: 35px;
        border-radius: 10px;
        object-fit: cover;
    }
    .ihub-section-card {
        width: 1264px;
        box-shadow: 0px 3px 4px rgba(0, 0, 0, 0.05);
        background: #fff;
        border-radius: 8px;
        margin-top: 24px;
        padding: 0;
    }
    .ihub-section-header {
        padding: 8px 32px;
        background: #fff;
        box-shadow: 0px 3px 4px rgba(0, 0, 0, 0.03);
        display: flex;
        align-items: center;
        border-radius: 8px 8px 0 0;
    }
    .ihub-section-title {
        font-size: 20px;
        font-weight: 600;
        color: #2E2F38;
        margin-bottom: 0;
    }
    .ihub-breadcrumb {
        display: flex;
        align-items: center;
        gap: 4px;
        font-size: 14px;
        color: #727790;
        font-family: Inter, sans-serif;
        font-weight: 400;
        margin-top: 4px;
    }
    .ihub-breadcrumb .active {
        font-weight: 600;
    }
    .ihub-profile-row {
        display: flex;
        align-items: center;
        gap: 24px;
        padding: 20px 32px;
        background: #fff;
        border-radius: 0 0 8px 8px;
    }
    .ihub-profile-avatar {
        width: 96px;
        height: 96px;
        background: #F5F7F8;
        border-radius: 100px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }
    .ihub-profile-avatar img {
        width: 96px;
        height: 96px;
        border-radius: 100px;
        object-fit: cover;
    }
    .ihub-profile-info {
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        align-items: flex-start;
    }
    .ihub-profile-name {
        color: #2E2F38;
        font-size: 32.5px;
        font-weight: 600;
        line-height: 39px;
    }
    .ihub-profile-job {
        color: #727790;
        font-size: 16px;
        font-weight: 400;
        line-height: 24px;
    }
    .ihub-profile-actions {
        display: flex;
        gap: 8px;
    }
    .ihub-btn-outline {
        height: 43px;
        padding: 12px 16px;
        border-radius: 4px;
        border: 1px solid #F1760F;
        color: #F1760F;
        background: #fff;
        font-weight: 600;
        display: flex;
        align-items: center;
    }
    .ihub-btn-primary {
        height: 43px;
        padding: 12px 16px;
        border-radius: 4px;
        background: #F7941C;
        color: #fff;
        font-weight: 600;
        border: none;
        display: flex;
        align-items: center;
    }
    .ihub-info-flex {
        display: flex;
        gap: 20px;
        margin: 24px 0;
    }
    .ihub-info-col {
        width: 400px;
        display: flex;
        flex-direction: column;
        gap: 20px;
    }
    .ihub-info-card {
        border-radius: 4px;
        background: #fff;
        border: 1px solid #ECF0F3;
        margin-bottom: 0;
    }
    .ihub-info-card-header {
        padding: 28px;
        border-bottom: 1px solid #ECF0F3;
        font-size: 20px;
        font-weight: 600;
        color: #2E2F38;
        background: #fff;
        border-radius: 4px 4px 0 0;
    }
    .ihub-info-card-body {
        padding: 28px;
        display: flex;
        flex-direction: column;
        gap: 16px;
        background: #fff;
        border-radius: 0 0 4px 4px;
    }
    .ihub-info-row {
        display: flex;
        gap: 16px;
        align-items: flex-start;
    }
    .ihub-info-label {
        width: 150px;
        color: #99A1B7;
        font-size: 14px;
        font-weight: 400;
    }
    .ihub-info-value {
        color: #2E2F38;
        font-size: 14px;
        font-weight: 400;
        flex: 1 1 0;
    }
    @media (max-width: 1200px) {
        .ihub-header-card, .ihub-section-card { width: 100%; padding: 0 24px; }
        .ihub-info-flex { flex-direction: column; }
        .ihub-info-col { width: 100%; }
    }
</style>
@endsection

@section('content')
<div class="ihub-bg">
    <div class="ihub-main-wrap">
        {{-- Section Header --}}
        <div class="ihub-section-card">
            <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
                <div id="kt_app_toolbar_container" class="container-xxl app-container d-flex flex-stack">
                    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5 mb-lg-0">
                        <h1 class="page-heading text-gray-900 fw-bold fs-3 my-0">
                            View Employee
                        </h1>
                        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                            <li class="breadcrumb-item text-muted">Settings</li>
                            <li class="breadcrumb-item"><span class="bullet bg-gray-500 w-5px h-2px"></span></li>
                            <li class="breadcrumb-item text-muted" id="breadcrumb-last">User Management</li>
                            <li class="breadcrumb-item"><span class="bullet bg-gray-500 w-5px h-2px"></span></li>
                            <li class="breadcrumb-item text-muted" id="breadcrumb-last">Employee</li>
                        </ul>
                    </div>
                </div>
            </div>
            {{-- Profile Row --}}
            <div class="ihub-profile-row">
                <div class="ihub-profile-avatar">
                    <img src="{{ $user->profile_picture ?? 'https://placehold.co/96x96' }}" alt="Avatar">
                </div>
                <div class="ihub-profile-info">
                    <div class="ihub-profile-name">{{ $user->name ?? 'N/A' }}</div>
                    <div class="ihub-profile-job">Job Position: {{ $user->job_title ?? 'N/A' }}</div>
                </div>
                <div style="flex:1"></div>
                <div class="ihub-profile-actions">
                    <span class="ihub-btn-outline">
                        <a href="{{ route('admin.employee.details', $user->id) }}?page=psychometric" style="color: var(--bs-primary) !important;">
                            View Assessment Result
                        </a>
                    </span>
                    <span class="ihub-btn-primary">
                        <a href="{{ route('insighthub.settings.user-management.edit', $user->id) }}" class="ihub-btn-primary">
                            Edit
                        </a>
                    </span>
                </div>
            </div>
            {{-- Info Flex --}}
            <div class="ihub-info-flex p-6">
                {{-- Left Column --}}
                <div class="ihub-info-col">
                    {{-- Basic Personal Information --}}
                    <div class="ihub-info-card">
                        <div class="ihub-info-card-header">Basic Personal Information</div>
                        <div class="ihub-info-card-body">
                            <div class="ihub-info-row">
                                <div class="ihub-info-label">Full Name</div>
                                <div class="ihub-info-value">{{ $user->name ?? 'N/A' }}</div>
                            </div>
                            <div class="ihub-info-row">
                                <div class="ihub-info-label">Gender</div>
                                <div class="ihub-info-value">
                                    @if($user->gender === 2)
                                        Male
                                    @elseif($user->gender === 1)
                                        Female
                                    @else
                                        N/A
                                    @endif
                                </div>
                            </div>
                            <div class="ihub-info-row">
                                <div class="ihub-info-label">Date of Birth</div>
                                <div class="ihub-info-value">
                                    @if($user->birth_date && $user->birth_date !== '0000-00-00')
                                        {{ \Carbon\Carbon::parse($user->birth_date)->format('d-m-Y') }}
                                    @else
                                        N/A
                                    @endif
                                </div>
                            </div>
                            <div class="ihub-info-row">
                                <div class="ihub-info-label">Civil Status</div>
                                <div class="ihub-info-value">
                                    {{ config('constants.MARITAL_STATUSES')[$user->marital_status] ?? 'N/A' }}
                                </div>
                            </div>
                            <div class="ihub-info-row">
                                <div class="ihub-info-label">Nationality</div>
                                <div class="ihub-info-value">{{ $user->country->name ?? 'N/A' }}</div>
                            </div>
                            <div class="ihub-info-row">
                                <div class="ihub-info-label">House/Building Number and Street Name</div>
                                <div class="ihub-info-value">{{ $user->home_address ?? 'N/A' }}</div>
                            </div>
                            <div class="ihub-info-row">
                                <div class="ihub-info-label">City</div>
                                <div class="ihub-info-value">{{ $user->city ?? 'N/A' }}</div>
                            </div>
                            <div class="ihub-info-row">
                                <div class="ihub-info-label">State / Province</div>
                                <div class="ihub-info-value">{{ $user->province->name ?? $user->state->name ?? 'N/A' }}</div>
                            </div>
                            <div class="ihub-info-row">
                                <div class="ihub-info-label">Postal Code</div>
                                <div class="ihub-info-value">{{ $user->postal_code ?? 'N/A' }}</div>
                            </div>
                            <div class="ihub-info-row">
                                <div class="ihub-info-label">Passport No.</div>
                                <div class="ihub-info-value">{{ $user->passport_no ?? 'N/A' }}</div>
                            </div>
                            <div class="ihub-info-row">
                                <div class="ihub-info-label">Passport expiry date</div>
                                <div class="ihub-info-value">
                                    @if($user->passport_expiry_date)
                                        {{ \Carbon\Carbon::parse($user->passport_expiry_date)->format('d-m-Y') }}
                                    @else
                                        N/A
                                    @endif
                                </div>
                            </div>
                            {{-- Government Info: Only show if Philippines --}}
                            @if(
                                (isset($user->country) && (
                                    strtolower($user->country->name) === 'philippines' ||
                                    $user->country->id == 135
                                ))
                            )
                                <div class="ihub-info-row">
                                    <div class="ihub-info-label">Tax Identification Number (TIN)</div>
                                    <div class="ihub-info-value">{{ $user->tin_number ?? 'N/A' }}</div>
                                </div>
                                <div class="ihub-info-row">
                                    <div class="ihub-info-label">Social Security System (SSS)</div>
                                    <div class="ihub-info-value">{{ $user->sss_number ?? 'N/A' }}</div>
                                </div>
                                <div class="ihub-info-row">
                                    <div class="ihub-info-label">Pag-IBIG Fund (HDMF)</div>
                                    <div class="ihub-info-value">{{ $user->hdmf_number ?? 'N/A' }}</div>
                                </div>
                                <div class="ihub-info-row">
                                    <div class="ihub-info-label">PhilHealth Number</div>
                                    <div class="ihub-info-value">{{ $user->phil_number ?? 'N/A' }}</div>
                                </div>
                            @endif
                        </div>
                    </div>
                    {{-- Contact Information --}}
                    <div class="ihub-info-card">
                        <div class="ihub-info-card-header">Contact Information</div>
                        <div class="ihub-info-card-body">
                            <div class="ihub-info-row">
                                <div class="ihub-info-label">Email address (official)</div>
                                <div class="ihub-info-value">{{ $user->email ?? 'N/A' }}</div>
                            </div>
                            <div class="ihub-info-row">
                                <div class="ihub-info-label">Mobile Number</div>
                                <div class="ihub-info-value">
                                    @if($user->country_code && $user->mobile_number)
                                        {{ $user->country_code }} {{ $user->mobile_number }}
                                    @elseif($user->mobile_number)
                                        {{ $user->mobile_number }}
                                    @else
                                        N/A
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Right Column --}}
                <div class="ihub-info-col" style="flex:1">
                    {{-- Employment Details --}}
                    <div class="ihub-info-card">
                        <div class="ihub-info-card-header">Employment Details</div>
                        <div class="ihub-info-card-body" style="display: flex; gap: 40px; flex-direction: row;">
                            {{-- Left Column --}}
                            <div style="flex:1; display: flex; flex-direction: column; gap: 16px;">
                                <div class="ihub-info-row">
                                    <div class="ihub-info-label">Employee ID</div>
                                    <div class="ihub-info-value">{{ $user->employee_code ?? 'N/A' }}</div>
                                </div>
                                <div class="ihub-info-row">
                                    <div class="ihub-info-label">Company/Division</div>
                                    <div class="ihub-info-value">{{ $user->division && $user->division->company ? $user->division->company->name : 'N/A' }}</div>
                                </div>
                                <div class="ihub-info-row">
                                    <div class="ihub-info-label">Job Position</div>
                                    <div class="ihub-info-value">{{ $user->job_position->title ?? 'N/A' }}</div>
                                </div>
                                <div class="ihub-info-row">
                                    <div class="ihub-info-label">Superior Job Position</div>
                                    <div class="ihub-info-value">-</div>
                                </div>
                                <div class="ihub-info-row">
                                    <div class="ihub-info-label">Superior Name</div>
                                    <div class="ihub-info-value">-</div>
                                </div>
                                <div class="ihub-info-row">
                                    <div class="ihub-info-label">Date of Hire</div>
                                    <div class="ihub-info-value">
                                        @if($user->date_of_hire)
                                            {{ \Carbon\Carbon::parse($user->date_of_hire)->format('d-m-Y') }}
                                        @else
                                            N/A
                                        @endif
                                    </div>
                                </div>
                                {{-- Performance Ratings --}}
                            @foreach(['2025', '2023'] as $year)
                                    <div class="ihub-info-row">
                                        <div class="ihub-info-label">{{ $year }} Performance Rating</div>
                                        <div class="ihub-info-value">
                                            @if(isset($ratings[$year]))
                                                {{ $ratings[$year]->rating ?? 'N/A' }}
                                            @else
                                                N/A
                                            @endif
                                        </div>
                                    </div>
                            @endforeach
                            </div>
                            {{-- Right Column --}}
                            <div style="flex:1; display: flex; flex-direction: column; gap: 16px;">
                                <div class="ihub-info-row">
                                    <div class="ihub-info-label">Business Unit</div>
                                    <div class="ihub-info-value">{{ $user->division && $user->division->business_unit ? $user->division->business_unit->name : 'N/A' }}</div>
                                </div>
                                <div class="ihub-info-row">
                                    <div class="ihub-info-label">Department</div>
                                    <div class="ihub-info-value">{{ $departments[$user->department_id] ?? 'N/A' }}</div>
                                </div>
                                <div class="ihub-info-row">
                                    <div class="ihub-info-label">Job Position Headcount ID</div>
                                    <div class="ihub-info-value">{{ $user->jobHeadcount->headcount_code ?? 'N/A' }}</div>
                                </div>
                                <div class="ihub-info-row">
                                    <div class="ihub-info-label">Superior Headcount ID</div>
                                    <div class="ihub-info-value">-</div>
                                </div>
                                <div class="ihub-info-row">
                                    <div class="ihub-info-label">Employment Status</div>
                                    <div class="ihub-info-value">
                                        {{ config('constants.EMPLOYMENT_STATUSES')[$user->employment_status] ?? 'N/A' }}
                                    </div>
                                </div>
                                <div class="ihub-info-row">
                                    <div class="ihub-info-label">Assign Role</div>
                                    <div class="ihub-info-value">{{ $user->role->display_name ?? 'N/A' }}</div>
                                </div>
                                {{-- 2024 Performance Ratings --}}
                                @foreach(['2024'] as $year)
                                    <div class="ihub-info-row">
                                        <div class="ihub-info-label">{{ $year }} Performance Rating</div>
                                        <div class="ihub-info-value">
                                            @if(isset($ratings[$year]))
                                                {{ $ratings[$year]->rating ?? 'N/A' }}
                                            @else
                                                N/A
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    {{-- Educational Background --}}
                    <div class="ihub-info-card">
                        <div class="ihub-info-card-header">Educational Background</div>
                        <div class="ihub-info-card-body" style="display: flex; gap: 40px; flex-direction: row;">
                            {{-- Left Column --}}
                            <div style="flex:1; display: flex; flex-direction: column; gap: 16px;">
                                <div class="ihub-info-row">
                                    <div class="ihub-info-label">Highest Educational Attainment</div>
                                    <div class="ihub-info-value">
                                        {{ config('helpers.education_level')[$user->education_level] ?? 'N/A' }}
                                    </div>
                                </div>
                                <div class="ihub-info-row">
                                    <div class="ihub-info-label">Course/Program</div>
                                    <div class="ihub-info-value">{{ $user->course_name ?: 'N/A' }}</div>
                                </div>
                            </div>
                            {{-- Right Column --}}
                            <div style="flex:1; display: flex; flex-direction: column; gap: 16px;">
                                <div class="ihub-info-row">
                                    <div class="ihub-info-label">Name of School/University</div>
                                    <div class="ihub-info-value">{{ $user->higher_learning_institution ?: 'N/A' }}</div>
                                </div>
                                <div class="ihub-info-row">
                                    <div class="ihub-info-label">Year of Graduated</div>
                                    <div class="ihub-info-value">{{ $user->graduate_year ?: 'N/A' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Work Experience --}}
                    <div class="ihub-info-card">
                        <div class="ihub-info-card-header">Work Experience</div>
                        <div class="ihub-info-card-body" style="display: flex; gap: 40px; flex-direction: row;">
                            {{-- Left Column --}}
                            <div style="flex:1; display: flex; flex-direction: column; gap: 16px;">
                                 @if($user->employments && count($user->employments))
                                    @foreach($user->employments as $employment)
                                        <div class="ihub-info-row">
                                            <div class="ihub-info-label">Company Name</div>
                                            <div class="ihub-info-value">{{ $employment->company_name ?? 'N/A' }}</div>
                                        </div>
                                        <div class="ihub-info-row">
                                            <div class="ihub-info-label">Job Title</div>
                                            <div class="ihub-info-value">{{ $employment->job_title ?? 'N/A' }}</div>
                                        </div>
                                        <div class="ihub-info-row">
                                            <div class="ihub-info-label">Start Date - End Date</div>
                                            <div class="ihub-info-value">
                                                {{ $employment->start_date ? \Carbon\Carbon::parse($employment->start_date)->format('d-m-Y') : 'N/A' }}
                                                -
                                                {{ $employment->end_date ? \Carbon\Carbon::parse($employment->end_date)->format('d-m-Y') : 'N/A' }}
                                            </div>
                                        </div>
                                        <div class="ihub-info-row">
                                            <div class="ihub-info-label">Key Responsibilities</div>
                                            <div class="ihub-info-value">{{ $employment->key_responsiblity ?? 'N/A' }}</div>
                                        </div>
                                        {{-- <div class="ihub-info-row">
                                            <div class="ihub-info-label">Years of Work</div>
                                            <div class="ihub-info-value">{{ $employment->year_of_work ?? 'N/A' }}</div>
                                        </div> --}}
                                        <hr>
                                        {{-- Right Column --}}
                                        <div style="flex:1; display: flex; flex-direction: column; gap: 16px;">
                                            <div class="ihub-info-row">
                                                <div class="ihub-info-label">Job Title</div>
                                                <div class="ihub-info-value">{{ $employment->job_title ?? 'N/A' }}</div>
                                            </div>
                                            <div class="ihub-info-row">
                                                <div class="ihub-info-label">Duration of Employment</div>
                                                <div class="ihub-info-value">{{ $employment->year_of_work ?? 'N/A' }}</div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="ihub-info-row">
                                        <div class="ihub-info-value">No work experience found.</div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    {{-- Skills and Certification --}}
                    <div class="ihub-info-card">
                        <div class="ihub-info-card-header">Skills and Certification</div>
                        <div class="ihub-info-card-body">
                            <div class="ihub-info-row">
                                <div class="ihub-info-label">Relevant Skills</div>
                                <div class="ihub-info-value">
                                    @php
                                        $skills = json_decode($user->skills, true);
                                    @endphp
                                    @if(!empty($skills))
                                        @foreach($skills as $skill)
                                            <span class="badge badge-success" style="margin-right:4px;">{{ $skill['value'] }}</span>
                                        @endforeach
                                    @else
                                        No skills acquired.
                                    @endif
                                </div>
                            </div>
                            <div class="ihub-info-row">
                                <div class="ihub-info-label">Professional Certifications</div>
                                <div class="ihub-info-value">
                                    @php
                                        $certs = json_decode($user->professional_certificate, true);
                                    @endphp
                                    @if(!empty($certs))
                                        @foreach($certs as $cert)
                                            <span class="badge badge-success" style="margin-right:4px;">{{ $cert['value'] }}</span>
                                        @endforeach
                                    @else
                                        No certifications available.
                                    @endif
                                </div>
                            </div>
                            <div class="ihub-info-row">
                                <div class="ihub-info-label">Training Program</div>
                                <div class="ihub-info-value">
                                    @php
                                        $trainings = json_decode($user->training_program, true);
                                    @endphp
                                    @if(!empty($trainings))
                                        @foreach($trainings as $training)
                                            <span class="badge badge-success" style="margin-right:4px;">{{ $training['value'] }}</span>
                                        @endforeach
                                    @else
                                        No training attended.
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Emergency Contact Information --}}
                    <div class="ihub-info-card">
                        <div class="ihub-info-card-header">Emergency Contact Information</div>
                        <div class="ihub-info-card-body" style="display: flex; gap: 40px; flex-direction: row;">
                            {{-- Left Column --}}
                            <div style="flex:1; display: flex; flex-direction: column; gap: 16px;">
                                <div class="ihub-info-row">
                                    <div class="ihub-info-label">Name of Person</div>
                                    <div class="ihub-info-value">{{ $user->ec_contact_person_name ?? 'N/A' }}</div>
                                </div>
                                <div class="ihub-info-row">
                                    <div class="ihub-info-label">Relationship</div>
                                    <div class="ihub-info-value">
                                        {{ config('constants.RELATION_EMPLOYEE')[$user->ec_relation_employee] ?? 'N/A' }}
                                    </div>
                                </div>
                            </div>
                            {{-- Right Column --}}
                            <div style="flex:1; display: flex; flex-direction: column; gap: 16px;">
                                <div class="ihub-info-row">
                                    <div class="ihub-info-label">Contact Number</div>
                                    <div class="ihub-info-value">{{ $user->ec_contact_person_number ?? 'N/A' }}</div>
                                </div>
                                <div class="ihub-info-row">
                                    <div class="ihub-info-label">Address</div>
                                    <div class="ihub-info-value">{{ $user->ec_home_address ?? 'N/A' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection