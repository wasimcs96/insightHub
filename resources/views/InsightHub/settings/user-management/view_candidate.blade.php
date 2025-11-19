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
        --bs-card-box-shadow: var(--bs-root-card-box-shadow);
        --bs-card-border-color: var(--bs-root-card-border-color);
        border: 1px solid var(--bs-card-border-color);
        box-shadow: 0px 3px 4px rgba(0, 0, 0, 0.03);
        margin: 20px;
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
        margin: auto;
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
                            <li class="breadcrumb-item text-muted" id="breadcrumb-last">Candidate</li>
                            <li class="breadcrumb-item"><span class="bullet bg-gray-500 w-5px h-2px"></span></li>
                            <li class="breadcrumb-item text-muted" id="breadcrumb-last">View Candidate</li>
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
                    <div class="ihub-profile-job">
                        Job Position:
                        {{
                            optional(
                                $user->jobOpeningApplication
                                    ->sortByDesc('created_at')
                                    ->first()
                                    ?->jobOpening
                            )->job_title ?? 'N/A'
                        }}
                    </div>
                </div>
                <div style="flex:1"></div>
                <div class="ihub-profile-actions">
                    <span class="ihub-btn-outline">View Assessment Result</span>
                </div>
            </div>
            <div style="padding-left: 30px; width: 100%; color: var(--Text-Default-Default, #1E1E1E); font-size: 22.75px; font-family: Inter; font-weight: 500; line-height: 27.30px; word-wrap: break-word">
                Applicant's Details
            </div>
            {{-- Info Flex --}}
            <div class="ihub-info-flex p-6">
    {{-- Left Column: Working Experience --}}
    <div style="flex: 1 1 0; min-width: 0; display: flex; flex-direction: column; gap: 24px;">
        {{-- Working Experience 1 --}}
        <div style="width: 100%; height: 100%; padding: 24px; background: #fff; box-shadow: 0px 3px 4px rgba(0, 0, 0, 0.03); border-radius: 8px; outline: 1px #F1F1F4 solid; outline-offset: -1px; justify-content: flex-start; align-items: flex-start; gap: 10px; display: inline-flex">
            <div style="flex: 1 1 0; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 20px; display: inline-flex">
                <div style="align-self: stretch; justify-content: flex-start; align-items: center; gap: 8px; display: inline-flex">
                    <div style="color: black; font-size: 17.55px; font-family: Inter; font-weight: 500; line-height: 21.06px;">Working Experience 1</div>
                    <div style="padding-left: 16px; padding-right: 16px; padding-top: 8px; padding-bottom: 8px; background: #E3F7FF; border-radius: 80px; justify-content: flex-start; align-items: center; gap: 8px; display: flex">
                        <div style="color: #1877A0; font-size: 12px; font-family: Roboto; font-weight: 500; line-height: 16px; letter-spacing: 0.50px;">Current Workplace</div>
                    </div>
                    <div style="flex: 1 1 0; height: 20px"></div>
                </div>
                <div style="align-self: stretch; flex-direction: column; gap: 16px; display: flex">
                    <div style="align-self: stretch; justify-content: flex-start; align-items: flex-start; gap: 8px; display: inline-flex">
                        <div style="flex: 1 1 0; flex-direction: column; gap: 4px; display: inline-flex">
                            <div style="color: #99A1B7; font-size: 14px;">Job Title</div>
                            <div style="color: #071437; font-size: 14px; font-weight: 500;">Junior Software Developer (Example)</div>
                        </div>
                        <div style="flex: 1 1 0; flex-direction: column; gap: 4px; display: inline-flex">
                            <div style="color: #99A1B7; font-size: 14px;">Company Name</div>
                            <div style="color: #071437; font-size: 14px; font-weight: 500;">TechSolutions Sdn Bhd (Example)</div>
                        </div>
                    </div>
                    <div style="align-self: stretch; justify-content: flex-start; align-items: flex-start; gap: 8px; display: inline-flex">
                        <div style="flex: 1 1 0; flex-direction: column; gap: 4px; display: inline-flex">
                            <div style="color: #99A1B7; font-size: 14px;">Company Location</div>
                            <div style="color: #071437; font-size: 14px; font-weight: 500;">Kuala Lumpur, Malaysia (Example)</div>
                        </div>
                        <div style="width: 382px; flex-direction: column; gap: 4px; display: inline-flex">
                            <div style="color: #99A1B7; font-size: 14px;">Years of Work</div>
                            <div style="color: #071437; font-size: 14px; font-weight: 500;">2 (Example)</div>
                        </div>
                    </div>
                    <div style="align-self: stretch; justify-content: flex-start; align-items: flex-start; gap: 8px; display: inline-flex">
                        <div style="flex: 1 1 0; flex-direction: column; gap: 4px; display: inline-flex">
                            <div style="color: #99A1B7; font-size: 14px;">Start Date</div>
                            <div style="color: #071437; font-size: 14px; font-weight: 500;">January 2018 (Example)</div>
                        </div>
                        <div style="flex: 1 1 0; flex-direction: column; gap: 4px; display: inline-flex">
                            <div style="color: #99A1B7; font-size: 14px;">End Date</div>
                            <div style="color: #071437; font-size: 14px; font-weight: 500;">December 2020 (Example)</div>
                        </div>
                    </div>
                    <div style="width: 773px; flex-direction: column; gap: 8px; display: flex">
                        <div style="color: #99A1B7; font-size: 14px;">Soft skills involved</div>
                        <div style="display: flex; gap: 8px;">
                            <div style="padding: 8px 16px; background: #F1F1F4; border-radius: 80px; color: #4B5675; font-size: 12px; font-family: Roboto; font-weight: 500;">Teamwork (Example)</div>
                            <div style="padding: 8px 16px; background: #F1F1F4; border-radius: 80px; color: #4B5675; font-size: 12px; font-family: Roboto; font-weight: 500;">Problem-Solving (Example)</div>
                            <div style="padding: 8px 16px; background: #F1F1F4; border-radius: 80px; color: #4B5675; font-size: 12px; font-family: Roboto; font-weight: 500;">Communication (Example)</div>
                        </div>
                    </div>
                    <div style="width: 773px; flex-direction: column; gap: 8px; display: flex">
                        <div style="color: #99A1B7; font-size: 14px;">Technical skills involved</div>
                        <div style="display: flex; gap: 8px;">
                            <div style="padding: 8px 16px; background: #F1F1F4; border-radius: 80px; color: #4B5675; font-size: 12px; font-family: Roboto; font-weight: 500;">Java (Example)</div>
                            <div style="padding: 8px 16px; background: #F1F1F4; border-radius: 80px; color: #4B5675; font-size: 12px; font-family: Roboto; font-weight: 500;">HTML/CSS (Example)</div>
                            <div style="padding: 8px 16px; background: #F1F1F4; border-radius: 80px; color: #4B5675; font-size: 12px; font-family: Roboto; font-weight: 500;">MySQL (Example)</div>
                            <div style="padding: 8px 16px; background: #F1F1F4; border-radius: 80px; color: #4B5675; font-size: 12px; font-family: Roboto; font-weight: 500;">Git (Example)</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Working Experience 2 --}}
        <div style="width: 100%; height: 100%; padding: 24px; background: #fff; box-shadow: 0px 3px 4px rgba(0, 0, 0, 0.03); border-radius: 8px; outline: 1px #F1F1F4 solid; outline-offset: -1px; justify-content: flex-start; align-items: flex-start; gap: 10px; display: inline-flex">
            <div style="flex: 1 1 0; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 20px; display: inline-flex">
                <div style="align-self: stretch; justify-content: flex-start; align-items: center; gap: 8px; display: inline-flex">
                    <div style="color: black; font-size: 17.55px; font-family: Inter; font-weight: 500; line-height: 21.06px;">Working Experience 2</div>
                    <div style="flex: 1 1 0; height: 20px"></div>
                </div>
                <div style="align-self: stretch; flex-direction: column; gap: 16px; display: flex">
                    <div style="align-self: stretch; justify-content: flex-start; align-items: flex-start; gap: 8px; display: inline-flex">
                        <div style="flex: 1 1 0; flex-direction: column; gap: 4px; display: inline-flex">
                            <div style="color: #99A1B7; font-size: 14px;">Job Title</div>
                            <div style="color: #071437; font-size: 14px; font-weight: 500;">Software Development Intern (Example)</div>
                        </div>
                        <div style="flex: 1 1 0; flex-direction: column; gap: 4px; display: inline-flex">
                            <div style="color: #99A1B7; font-size: 14px;">Company Name</div>
                            <div style="color: #071437; font-size: 14px; font-weight: 500;">InnovateTech Systems (Example)</div>
                        </div>
                    </div>
                    <div style="align-self: stretch; justify-content: flex-start; align-items: flex-start; gap: 8px; display: inline-flex">
                        <div style="flex: 1 1 0; flex-direction: column; gap: 4px; display: inline-flex">
                            <div style="color: #99A1B7; font-size: 14px;">Company Location</div>
                            <div style="color: #071437; font-size: 14px; font-weight: 500;">Kuala Lumpur, Malaysia (Example)</div>
                        </div>
                        <div style="width: 382px; flex-direction: column; gap: 4px; display: inline-flex">
                            <div style="color: #99A1B7; font-size: 14px;">Years of Work</div>
                            <div style="color: #071437; font-size: 14px; font-weight: 500;">6 months (Example)</div>
                        </div>
                    </div>
                    <div style="align-self: stretch; justify-content: flex-start; align-items: flex-start; gap: 8px; display: inline-flex">
                        <div style="flex: 1 1 0; flex-direction: column; gap: 4px; display: inline-flex">
                            <div style="color: #99A1B7; font-size: 14px;">Start Date</div>
                            <div style="color: #071437; font-size: 14px; font-weight: 500;">December 2017 (Example)</div>
                        </div>
                        <div style="flex: 1 1 0; flex-direction: column; gap: 4px; display: inline-flex">
                            <div style="color: #99A1B7; font-size: 14px;">End Date</div>
                            <div style="color: #071437; font-size: 14px; font-weight: 500;">March 2018 (Example)</div>
                        </div>
                    </div>
                    <div style="width: 773px; flex-direction: column; gap: 8px; display: flex">
                        <div style="color: #99A1B7; font-size: 14px;">Soft skills involved</div>
                        <div style="display: flex; gap: 8px;">
                            <div style="padding: 8px 16px; background: #F1F1F4; border-radius: 80px; color: #4B5675; font-size: 12px; font-family: Roboto; font-weight: 500;">Teamwork (Example)</div>
                            <div style="padding: 8px 16px; background: #F1F1F4; border-radius: 80px; color: #4B5675; font-size: 12px; font-family: Roboto; font-weight: 500;">Problem-Solving (Example)</div>
                            <div style="padding: 8px 16px; background: #F1F1F4; border-radius: 80px; color: #4B5675; font-size: 12px; font-family: Roboto; font-weight: 500;">Communication (Example)</div>
                        </div>
                    </div>
                    <div style="width: 773px; flex-direction: column; gap: 8px; display: flex">
                        <div style="color: #99A1B7; font-size: 14px;">Technical skills involved</div>
                        <div style="display: flex; gap: 8px;">
                            <div style="padding: 8px 16px; background: #F1F1F4; border-radius: 80px; color: #4B5675; font-size: 12px; font-family: Roboto; font-weight: 500;">Java (Example)</div>
                            <div style="padding: 8px 16px; background: #F1F1F4; border-radius: 80px; color: #4B5675; font-size: 12px; font-family: Roboto; font-weight: 500;">HTML/CSS (Example)</div>
                            <div style="padding: 8px 16px; background: #F1F1F4; border-radius: 80px; color: #4B5675; font-size: 12px; font-family: Roboto; font-weight: 500;">MySQL (Example)</div>
                            <div style="padding: 8px 16px; background: #F1F1F4; border-radius: 80px; color: #4B5675; font-size: 12px; font-family: Roboto; font-weight: 500;">Git (Example)</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Right Column: Personal, Education, Job Preference --}}
    <div style="width: 407px; display: flex; flex-direction: column; gap: 24px;">
        {{-- Personal Information --}}
        <div style="padding: 24px; background: #fff; box-shadow: 0px 3px 4px rgba(0, 0, 0, 0.03); border-radius: 8px; outline: 1px #F1F1F4 solid;">
            <div class="pb-2" style="color: #1E1E1E; font-size: 19.5px; font-weight: 500;">Personal Information</div>
            <div style="display: flex; flex-direction: column; gap: 8px;">
                <div style="display: flex; gap: 8px;">
                    <div style="color: #99A1B7; font-size: 14px; min-width: 120px;">Email</div>
                    <div style="color: #4B5675; font-size: 14px;">{{ $user->email ?? 'N/A' }}</div>
                </div>
                <div style="display: flex; gap: 8px;">
                    <div style="color: #99A1B7; font-size: 14px; min-width: 120px;">Phone Number</div>
                    <div style="color: #4B5675; font-size: 14px;">{{ $user->mobile_number ?? 'N/A' }}</div>
                </div>
                <div style="display: flex; gap: 8px;">
                    <div style="color: #99A1B7; font-size: 14px; min-width: 120px;">Current Location</div>
                    <div style="color: #4B5675; font-size: 14px;">{{ $user->cityName->name ?? 'N/A' }}</div>
                </div>
                <div style="display: flex; gap: 8px;">
                    <div style="color: #99A1B7; font-size: 14px; min-width: 120px;">Nationality</div>
                    <div style="color: #4B5675; font-size: 14px;">{{ $user->country->name ?? 'N/A' }}</div>
                </div>
                <div style="display: flex; gap: 8px;">
                    <div style="color: #99A1B7; font-size: 14px; min-width: 120px;">Address</div>
                    <div style="color: #4B5675; font-size: 14px;">{{ $user->full_address ?? 'N/A' }}</div>
                </div>
            </div>
        </div>
        {{-- Education Information --}}
        <div style="padding: 24px; background: #fff; box-shadow: 0px 3px 4px rgba(0, 0, 0, 0.03); border-radius: 8px; outline: 1px #F1F1F4 solid;">
            <div class="pb-2" style="color: #1E1E1E; font-size: 19.5px; font-weight: 500;">Education Information</div>
            <div style="display: flex; flex-direction: column; gap: 8px;">
                <div style="display: flex; gap: 8px;">
                    <div style="color: #99A1B7; font-size: 14px; min-width: 140px;">Education Level</div>
                    <div style="color: #4B5675; font-size: 14px;">{{ $user->educationLevel->name ?? 'N/A' }}</div>
                </div>
                <div style="display: flex; gap: 8px;">
                    <div style="color: #99A1B7; font-size: 14px; min-width: 140px;">Year Graduation</div>
                    <div style="color: #4B5675; font-size: 14px;">{{ $user->graduate_year ?? 'N/A' }}</div>
                </div>
                <div style="display: flex; gap: 8px;">
                    <div style="color: #99A1B7; font-size: 14px; min-width: 140px;">Education Institution</div>
                    <div style="color: #4B5675; font-size: 14px;">{{ $user->higherLearning->name ?? 'N/A' }}</div>
                </div>
                <div style="display: flex; gap: 8px;">
                    <div style="color: #99A1B7; font-size: 14px; min-width: 140px;">Education Program</div>
                    <div style="color: #4B5675; font-size: 14px;">{{ $user->educationProgram->name ?? 'N/A' }}</div>
                </div>
            </div>
        </div>
        {{-- Job Preference --}}
        <div style="padding: 24px; background: #fff; box-shadow: 0px 3px 4px rgba(0, 0, 0, 0.03); border-radius: 8px; outline: 1px #F1F1F4 solid;">
            <div class="pb-2" style="color: #1E1E1E; font-size: 19.5px; font-weight: 500;">Job Preference</div>
            <div style="display: flex; flex-direction: column; gap: 8px;">
                <div style="display: flex; gap: 8px;">
                    <div style="color: #99A1B7; font-size: 14px; width: 140px;">Work Experience</div>
                    <div style="color: #4B5675; font-size: 14px;">{{ $user->year_of_experience_in_it_sector ?? 'N/A' }}</div>
                </div>
                <div style="display: flex; gap: 8px;">
                    <div style="color: #99A1B7; font-size: 14px; width: 140px;">Work Authorisation</div>
                    <div style="color: #4B5675; font-size: 14px;">{{ $user->work_authorisation ? 'Yes' : 'No' }}</div>
                </div>
                <div style="display: flex; gap: 8px;">
                    <div style="color: #99A1B7; font-size: 14px; width: 140px;">Preferred Working Locations</div>
                    <div style="color: #4B5675; font-size: 14px;">-</div>
                </div>
                <div style="display: flex; gap: 8px;">
                    <div style="color: #99A1B7; font-size: 14px; width: 140px;">Preferred Job</div>
                    <div style="color: #4B5675; font-size: 14px;">
                        {{ $user->preferredJobOpening->job_title ?? 'N/A' }}
                    </div>
                </div>
                <div style="display: flex; gap: 8px;">
                    <div style="color: #99A1B7; font-size: 14px; width: 140px;">Expected Salary (MYR)</div>
                    <div style="color: #4B5675; font-size: 14px;">
                        {{
                            $user->job_expected_salary
                            ?? (
                                isset($user->jobOpeningApplication) && $user->jobOpeningApplication->count()
                                ? $user->jobOpeningApplication->sortByDesc('created_at')->first()->expected_salary
                                : 'N/A'
                            )
                        }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection