@extends('insighthub.layout.app')

@section('title', 'Edit User')

@section('styles')
@parent
<style>
        .tab-content { 
            background: #fff; border-radius: 8px; padding: 32px; 
        }
        .nav-tabs .nav-link.active { background: #FFF8EB; border-right: 4px solid #F7941C; color: #2E2F38; }
        .nav-tabs .nav-link { color: #727790; font-weight: 500; }
        .ihub-info-row { display: flex; gap: 16px; align-items: flex-start; margin-bottom: 16px; }
        .ihub-info-label { width: 200px; color: #99A1B7; font-size: 14px; font-weight: 400; }
        .ihub-info-value { flex: 1 1 0; }

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
        /* margin-top: 24px; */
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
        /* color: #99A1B7; */
        color: #2E2F38;
        font-size: 14px;
        font-weight: 600;
    }
    .ihub-info-value {
        color: #2E2F38;
        font-size: 14px;
        font-weight: 400;
        flex: 1 1 0;
    }
    /* Tab Sidebar Styles */
    .ihub-tab-sidebar {
        list-style: none;
        margin: 0;
        padding: 0;
        width: 100%;
        display: flex;
        flex-direction: column;
        gap: 0;
    }
    .ihub-tab-link {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 16px;
        font-family: 'Inter', sans-serif;
        font-size: 12px;
        font-weight: 500;
        color: #727790;
        background: #fff;
        border: none;
        border-radius: 0;
        border-right: 0;
        text-decoration: none;
        transition: background 0.2s, color 0.2s;
    }
    .ihub-tab-link.active,
    .ihub-tab-link[aria-selected="true"] {
        background: #FFF8EB;
        border-right: 4px solid #F7941C;
        color: #2E2F38;
    }
    .ihub-tab-link:focus {
        outline: none;
    }
    .ihub-tab-badge {
        display: flex;
        align-items: center;
        height: 22px;
        padding: 4px 8px;
        border-radius: 8px;
        font-size: 12px;
        font-family: 'Inter', sans-serif;
        font-weight: 500;
        line-height: 17px;
        background: #F5F7F8;
        color: #2E2F38;
    }
    .ihub-tab-badge-required {
        background: #DDFBE2;
        color: #19622A;
    }
    @media (max-width: 1200px) {
        .ihub-header-card, .ihub-section-card { width: 100%; padding: 0 24px; }
        .ihub-info-flex { flex-direction: column; }
        .ihub-info-col { width: 100%; }
    }

    /* Add to your <style> section */
    .ihub-label {
        color: #2E2F38;
        font-size: 14px;
        font-family: Inter, sans-serif;
        font-weight: 600;
    }
    .ihub-label-light {
        color: #99A1B7;
        font-size: 14px;
        font-family: Inter, sans-serif;
        font-weight: 600;
    }
    .ihub-label .required {
        color: #F24130;
    }
    .ihub-edit-employee-container{
        background:#fff;
        border: 1px solid var(--bs-border-color)

    }
</style>
@endsection

@section('content')
<div class="ihub-bg">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="container-xxl app-container d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5 mb-lg-0">
                <h1 class="page-heading text-gray-900 fw-bold fs-3 my-0">
                    Edit User
                </h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">Settings</li>
                    <li class="breadcrumb-item"><span class="bullet bg-gray-500 w-5px h-2px"></span></li>
                    <li class="breadcrumb-item text-muted" id="breadcrumb-last">User Management</li>
                    <li class="breadcrumb-item"><span class="bullet bg-gray-500 w-5px h-2px"></span></li>
                    <li class="breadcrumb-item text-muted" id="breadcrumb-last">Employee</li>
                    <li class="breadcrumb-item"><span class="bullet bg-gray-500 w-5px h-2px"></span></li>
                    <li class="breadcrumb-item text-muted" id="breadcrumb-last">Edit Employee</li>
                </ul>
            </div>
        </div>
    </div>
    <div id="kt_app_content" class="app-content flex-column-fluid p-0">
        <div id="kt_app_content_container" class="container-xxl app-container">
            <div class="page-header my-15">
                @if (session()->has('alert-success'))
                    <div id="feedbackMessage" class="justify-content-between align-items-center feedback-message mt-3">
                        <p class="text-center fw-medium m-0">
                            <b>Success!</b> {{ session('alert-success') }}
                        </p>
                        <iconify-icon icon="iconamoon:close" width="20" height="20" class="cursor-pointer" id="closeIcon"></iconify-icon>
                    </div>
                @endif
                <h4 class="top-heading m-0" style="font-size: 32px;">Edit Employee Personal Details</h4>
                <p class="custom-text-muted m-0">Update personal information to complete the profile and ensure accurate company records.</p>
            </div>
            <form action="{{ route('insighthub.settings.user-management.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row ihub-edit-employee-container p-6">
                    <div class="col-3" style="background: #fff; border-radius: 8px 0 0 8px; padding: 0; border-right: 1px solid #ECF0F3;">
                        <ul class="ihub-tab-sidebar" id="editUserTab" role="tablist">
                            <li>
                                <a class="ihub-tab-link active" id="personal-tab" data-bs-toggle="tab" href="#personal" role="tab">
                                    <span>Personal Details</span>
                                    <span class="ihub-tab-badge ihub-tab-badge-required">Required</span>
                                </a>
                            </li>
                            <li>
                                <a class="ihub-tab-link" id="employment-tab" data-bs-toggle="tab" href="#employment" role="tab">
                                    <span>Employment Details</span>
                                    <span class="ihub-tab-badge ihub-tab-badge-required">Required</span>
                                </a>
                            </li>
                            <li>
                                <a class="ihub-tab-link" id="address-tab" data-bs-toggle="tab" href="#address" role="tab">
                                    <span>Address Information</span>
                                    <span class="ihub-tab-badge">Optional</span>
                                </a>
                            </li>
                            <li>
                                <a class="ihub-tab-link" id="government-tab" data-bs-toggle="tab" href="#government" role="tab">
                                    <span>Government Information</span>
                                    <span class="ihub-tab-badge">Optional</span>
                                </a>
                            </li>
                            <li>
                                <a class="ihub-tab-link" id="education-tab" data-bs-toggle="tab" href="#education" role="tab">
                                    <span>Educational Background</span>
                                    <span class="ihub-tab-badge">Optional</span>
                                </a>
                            </li>
                            <li>
                                <a class="ihub-tab-link" id="work-tab" data-bs-toggle="tab" href="#work" role="tab">
                                    <span>Working Experience</span>
                                    <span class="ihub-tab-badge">Optional</span>
                                </a>
                            </li>
                            <li>
                                <a class="ihub-tab-link" id="skills-tab" data-bs-toggle="tab" href="#skills" role="tab">
                                    <span>Skills</span>
                                    <span class="ihub-tab-badge">Optional</span>
                                </a>
                            </li>
                            <li>
                                <a class="ihub-tab-link" id="cert-tab" data-bs-toggle="tab" href="#cert" role="tab">
                                    <span>Professional Certifications</span>
                                    <span class="ihub-tab-badge">Optional</span>
                                </a>
                            </li>
                            <li>
                                <a class="ihub-tab-link" id="training-tab" data-bs-toggle="tab" href="#training" role="tab">
                                    <span>Training Program Attended</span>
                                    <span class="ihub-tab-badge">Optional</span>
                                </a>
                            </li>
                            <li>
                                <a class="ihub-tab-link" id="emergency-tab" data-bs-toggle="tab" href="#emergency" role="tab">
                                    <span>Emergency Contact</span>
                                    <span class="ihub-tab-badge">Optional</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                        <div class="col-9" style="padding:0;">
                            <div class="" id="sectionTitleBar" style="padding: 10px 20px; background: #fff; border-top-right-radius: 4px; justify-content: center; align-items: center; gap: 10px; display: flex;">
                                <div id="sectionTitleText" style="flex: 1 1 0; color: #2E2F38; font-size: 20px; font-family: Inter, sans-serif; font-weight: 500; line-height: 24px;">
                                    Personal Details
                                </div>
                            </div>
                            <div class="tab-content" id="editUserTabContent">
                                {{-- Personal Details Tab --}}
                                <div class="tab-pane fade show active" id="personal" role="tabpanel">
                                    <div style="width: 100%; padding: 20px; border-radius: 4px; outline: 1px solid #F1F1F4; outline-offset: -1px; display: flex; flex-direction: column; gap: 20px; background: #fff;">
                                        <div style="display: flex; gap: 20px;">
                                            <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                <label class="ihub-label">Full Name <span style="color: #F24130;">*</span></label>
                                                <input type="text" name="name" class="form-control"
                                                    style="height: 43px; padding: 12px 16px; border-radius: 4px; outline: 1px solid #ECF0F3; background: #fff; font-size: 14px; font-weight: 400;"
                                                    value="{{ old('name', $user->name ?? '') }}" required>
                                            </div>
                                            <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                <label class="ihub-label">Gender</label>
                                                <select name="gender" class="form-control"
                                                    style="height: 43px; padding: 12px 16px; border-radius: 4px; outline: 1px solid #ECF0F3; background: #fff; font-size: 14px; font-weight: 400;">
                                                    <option value="">Select</option>
                                                    <option value="2" @if($user->gender == 2) selected @endif>Male</option>
                                                    <option value="1" @if($user->gender == 1) selected @endif>Female</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div style="display: flex; gap: 20px;">
                                            <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                <label class="ihub-label">Date of Birth</label>
                                                <input type="date" name="birth_date" class="form-control"
                                                    style="height: 43px; padding: 12px 16px; border-radius: 4px; outline: 1px solid #ECF0F3; background: #fff; font-size: 14px; font-weight: 400;"
                                                    value="{{ old('birth_date', $user->birth_date && $user->birth_date !== '0000-00-00' ? $user->birth_date : '') }}">
                                            </div>
                                            <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                <label class="ihub-label">Civil Status</label>
                                                <select name="marital_status" class="form-control">
                                                    <option value="">Select</option>
                                                    @foreach(config('constants.MARITAL_STATUSES') as $key => $label)
                                                        <option value="{{ $key }}" @if($user->marital_status == $key) selected @endif>{{ $label }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div style="display: flex; gap: 20px;">
                                            <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                <label class="ihub-label">Nationality</label>
                                                <select name="country_id" class="form-control"
                                                    style="height: 43px; padding: 12px 16px; border-radius: 4px; outline: 1px solid #ECF0F3; background: #fff; font-size: 14px; font-weight: 400;">
                                                    <option value="">Select</option>
                                                    @foreach($countries as $country)
                                                        <option value="{{ $country->id }}" @if($user->country_id == $country->id) selected @endif>
                                                            {{ $country->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                <label class="ihub-label">Email address (official) <span style="color: #F24130;">*</span></label>
                                                <input type="email" name="email" class="form-control"
                                                    style="height: 43px; padding: 12px 16px; border-radius: 4px; outline: 1px solid #ECF0F3; background: #fff; font-size: 14px; font-weight: 400;"
                                                    value="{{ old('email', $user->email ?? '') }}" required>
                                            </div>
                                        </div>
                                        <div style="display: flex; gap: 20px;">
                                            <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                <label class="ihub-label">Mobile Number</label>
                                                <input type="text" name="mobile_number" class="form-control"
                                                    style="height: 43px; padding: 12px 16px; border-radius: 4px; outline: 1px solid #ECF0F3; background: #fff; font-size: 14px; font-weight: 400;"
                                                    value="{{ old('mobile_number', $user->mobile_number ?? '') }}">
                                            </div>
                                            <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                <label class="ihub-label">Country Code</label>
                                                <select name="country_code" class="form-control">
                                                    <option value="">Select</option>
                                                    @foreach(config('helpers.country_code') as $code => $label)
                                                        <option value="{{ $code }}" @if($user->country_code == $code) selected @endif>{{ $label }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- Employment Details Tab --}}
                                <div class="tab-pane fade" id="employment" role="tabpanel">
                                    <div style="width: 100%; padding: 20px; border-radius: 4px; outline: 1px solid #F1F1F4; outline-offset: -1px; display: flex; flex-direction: column; gap: 20px; background: #fff;">
                                        {{-- Employee ID (single long input, spans two columns) --}}
                                        <div style="display: flex; gap: 20px;">
                                            <div style="flex: 2; display: flex; flex-direction: column; gap: 8px;">
                                                <label style="color: #2E2F38; font-size: 14px; font-weight: 600;">Employee ID <span style="color: #F24130;">*</span></label>
                                                <input type="text" name="employee_code" class="form-control"
                                                    style="height: 43px; padding: 12px 16px; border-radius: 4px; outline: 1px solid #ECF0F3; background: #fff; font-size: 14px; font-weight: 400;"
                                                    value="{{ old('employee_code', $user->employee_code ?? '') }}">
                                            </div>
                                        </div>
                                        {{-- 2 columns x 5 rows for disabled fields --}}
                                        <div style="display: flex; flex-direction: column; gap: 20px;">
                                            <div style="display: flex; gap: 20px;">
                                                {{-- Business Unit --}}
                                                <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                    <label style="color: #99A1B7; font-size: 14px; font-weight: 600;">Business Unit</label>
                                                    <input type="text" class="form-control"
                                                        style="height: 43px; padding: 12px 16px; border-radius: 4px; outline: 1px solid #ECF0F3; background: #DDE2E8; font-size: 14px; font-weight: 400; color: #99A1B7;"
                                                        value="{{ $user->division && $user->division->business_unit && $user->division->business_unit->name ? $user->division->business_unit->name : '' }}" disabled>
                                                </div>
                                                {{-- Company/Division --}}
                                                <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                    <label style="color: #99A1B7; font-size: 14px; font-weight: 600;">Company/Division</label>
                                                    <input type="text" class="form-control"
                                                        style="height: 43px; padding: 12px 16px; border-radius: 4px; outline: 1px solid #ECF0F3; background: #DDE2E8; font-size: 14px; font-weight: 400; color: #99A1B7;"
                                                        value="{{ $user->division && $user->division->company && $user->division->company->name ? $user->division->company->name : '' }}" disabled>
                                                </div>
                                            </div>
                                            <div style="display: flex; gap: 20px;">
                                                {{-- Department --}}
                                                <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                    <label style="color: #99A1B7; font-size: 14px; font-weight: 600;">Department</label>
                                                    <input type="text" class="form-control"
                                                        style="height: 43px; padding: 12px 16px; border-radius: 4px; outline: 1px solid #ECF0F3; background: #DDE2E8; font-size: 14px; font-weight: 400; color: #99A1B7;"
                                                        value="{{ isset($departments[$user->department_id]) && $departments[$user->department_id] ? $departments[$user->department_id] : 'N/A' }}">
                                                    <input type="hidden" name="department_id" value="{{ $user->department_id }}">

                                                    </div>
                                                {{-- Job Position --}}
                                                <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                    <label style="color: #99A1B7; font-size: 14px; font-weight: 600;">Job Position</label>
                                                    <input type="text" class="form-control"
                                                        style="height: 43px; padding: 12px 16px; border-radius: 4px; outline: 1px solid #ECF0F3; background: #DDE2E8; font-size: 14px; font-weight: 400; color: #99A1B7;"
                                                        value="{{ $user->position->name ?? 'N/A' }}" disabled>
                                                    <input type="hidden" name="position_id" value="{{ $user->position_id }}">
                                                </div>
                                            </div>
                                            <div style="display: flex; gap: 20px;">
                                                {{-- Job Position Headcount ID --}}
                                                <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                    <label style="color: #99A1B7; font-size: 14px; font-weight: 600;">Job Position Headcount ID</label>
                                                    <input type="text" class="form-control"
                                                        style="height: 43px; padding: 12px 16px; border-radius: 4px; outline: 1px solid #ECF0F3; background: #DDE2E8; font-size: 14px; font-weight: 400; color: #99A1B7;"
                                                        value="N/A" disabled>
                                                </div>
                                                {{-- Superior Job Position --}}
                                                <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                    <label style="color: #99A1B7; font-size: 14px; font-weight: 600;">Superior Job Position</label>
                                                    <input type="text" class="form-control"
                                                        style="height: 43px; padding: 12px 16px; border-radius: 4px; outline: 1px solid #ECF0F3; background: #DDE2E8; font-size: 14px; font-weight: 400; color: #99A1B7;"
                                                        value="N/A" disabled>
                                                </div>
                                            </div>
                                            <div style="display: flex; gap: 20px;">
                                                {{-- Superior Headcount ID --}}
                                                <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                    <label style="color: #99A1B7; font-size: 14px; font-weight: 600;">Superior Headcount ID</label>
                                                    <input type="text" class="form-control"
                                                        style="height: 43px; padding: 12px 16px; border-radius: 4px; outline: 1px solid #ECF0F3; background: #DDE2E8; font-size: 14px; font-weight: 400; color: #99A1B7;"
                                                        value="N/A" disabled>
                                                </div>
                                                {{-- Superior Name --}}
                                                <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                    <label style="color: #99A1B7; font-size: 14px; font-weight: 600;">Superior Name</label>
                                                    <input type="text" class="form-control"
                                                        style="height: 43px; padding: 12px 16px; border-radius: 4px; outline: 1px solid #ECF0F3; background: #DDE2E8; font-size: 14px; font-weight: 400; color: #99A1B7;"
                                                        value="N/A" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- Employment Status & Date of Hire (two columns) --}}
                                        <div style="display: flex; gap: 20px;">
                                            <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                <label style="color: #2E2F38; font-size: 14px; font-weight: 600;">Employment Status</label>
                                                <select name="employment_status" class="form-control">
                                                    <option value="">Select</option>
                                                    @foreach(config('constants.EMPLOYMENT_STATUSES') as $key => $label)
                                                        <option value="{{ $key }}" @if($user->employment_status == $key) selected @endif>{{ $label }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                <label style="color: #2E2F38; font-size: 14px; font-weight: 600;">Date of Hire <span style="color: #F24130;">*</span></label>
                                                <input type="date" name="date_of_hire" class="form-control"
                                                    style="height: 43px; padding: 12px 16px; border-radius: 4px; outline: 1px solid #ECF0F3; background: #fff; font-size: 14px; font-weight: 400;"
                                                    value="{{ old('date_of_hire', $user->date_of_hire ?? '') }}">
                                            </div>
                                        </div>
                                        {{-- Assign Role (dropdown, spans two columns) --}}
                                        <div style="display: flex; gap: 20px;">
                                            <div style="flex: 2; display: flex; flex-direction: column; gap: 8px;">
                                                <label style="color: #2E2F38; font-size: 14px; font-weight: 600;">
                                                    Assign Role <span style="color: #D5540A;">*</span>
                                                </label>
                                                <select name="role_id" class="form-control" required>
                                                    <option value="">Select</option>
                                                    @foreach($roles as $role)
                                                        <option value="{{ $role->id }}" @if(old('role_id', $user->role_id) == $role->id) selected @endif>
                                                            {{ $role->display_name ?? $role->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        {{-- Performance Ratings (each spans two columns) --}}
                                        <div style="display: flex; gap: 20px;">
                                            <div style="flex: 2; display: flex; flex-direction: column; gap: 8px;">
                                                <label style="color: #2E2F38; font-size: 14px; font-weight: 600;">2025 Performance Rating <span style="color: #D5540A;">*</span></label>
                                                <input type="text" class="form-control"
                                                    style="height: 43px; padding: 12px 16px; border-radius: 4px; outline: 1px solid #ECF0F3; background: #FEFEFE; font-size: 14px; font-weight: 400;"
                                                    value="N/A" disabled>
                                            </div>
                                        </div>
                                        <div style="display: flex; gap: 20px;">
                                            <div style="flex: 2; display: flex; flex-direction: column; gap: 8px;">
                                                <label style="color: #2E2F38; font-size: 14px; font-weight: 600;">2024 Performance Rating <span style="color: #D5540A;">*</span></label>
                                                <input type="text" class="form-control"
                                                    style="height: 43px; padding: 12px 16px; border-radius: 4px; outline: 1px solid #ECF0F3; background: #FEFEFE; font-size: 14px; font-weight: 400;"
                                                    value="N/A" disabled>
                                            </div>
                                        </div>
                                        <div style="display: flex; gap: 20px;">
                                            <div style="flex: 2; display: flex; flex-direction: column; gap: 8px;">
                                                <label style="color: #2E2F38; font-size: 14px; font-weight: 600;">2023 Performance Rating <span style="color: #D5540A;">*</span></label>
                                                <input type="text" class="form-control"
                                                    style="height: 43px; padding: 12px 16px; border-radius: 4px; outline: 1px solid #ECF0F3; background: #FEFEFE; font-size: 14px; font-weight: 400;"
                                                    value="N/A" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- Address Information Tab --}}
                                <div class="tab-pane fade" id="address" role="tabpanel">
                                    <div style="width: 100%; padding: 20px; border-radius: 4px; outline: 1px solid #F1F1F4; outline-offset: -1px; display: flex; flex-direction: column; gap: 20px; background: #fff;">
                                        <div style="display: flex; gap: 20px;">
                                            <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                <label class="ihub-label">House/Building Number and Street Name</label>
                                                <input type="text" name="home_address" class="form-control"
                                                    style="height: 43px; padding: 12px 16px; border-radius: 4px; outline: 1px solid #ECF0F3; background: #fff; font-size: 14px; font-weight: 400;"
                                                    value="{{ old('home_address', $user->home_address ?? '') }}">
                                            </div>
                                            <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                <label class="ihub-label">City</label>
                                                <input type="text" name="city" class="form-control"
                                                    style="height: 43px; padding: 12px 16px; border-radius: 4px; outline: 1px solid #ECF0F3; background: #fff; font-size: 14px; font-weight: 400;"
                                                    value="{{ old('city', $user->city ?? '') }}">
                                            </div>
                                        </div>
                                        <div style="display: flex; gap: 20px;">
                                            <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                <label class="ihub-label">State</label>
                                                <input type="text" name="state_id" class="form-control"
                                                    style="height: 43px; padding: 12px 16px; border-radius: 4px; outline: 1px solid #ECF0F3; background: #fff; font-size: 14px; font-weight: 400;"
                                                    value="{{ old('state_id', $user->state_id ?? '') }}">
                                            </div>
                                            <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                <label class="ihub-label">Postal Code</label>
                                                <input type="text" name="postal_code" class="form-control"
                                                    style="height: 43px; padding: 12px 16px; border-radius: 4px; outline: 1px solid #ECF0F3; background: #fff; font-size: 14px; font-weight: 400;"
                                                    value="{{ old('postal_code', $user->postal_code ?? '') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- Government Information Tab --}}
                                <div class="tab-pane fade" id="government" role="tabpanel">
                                    <div style="width: 100%; padding: 20px; border-radius: 4px; outline: 1px solid #F1F1F4; outline-offset: -1px; display: flex; flex-direction: column; gap: 20px; background: #fff;">
                                        <div style="display: flex; gap: 20px;">
                                            <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                <label class="ihub-label">Passport No.</label>
                                                <input type="text" name="passport_no" class="form-control"
                                                    style="height: 43px; padding: 12px 16px; border-radius: 4px; outline: 1px solid #ECF0F3; background: #fff; font-size: 14px; font-weight: 400;"
                                                    value="{{ old('passport_no', $user->passport_no ?? '') }}">
                                            </div>
                                            <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                <label class="ihub-label">Passport expiry date</label>
                                                <input type="date" name="passport_expiry_date" class="form-control"
                                                    style="height: 43px; padding: 12px 16px; border-radius: 4px; outline: 1px solid #ECF0F3; background: #fff; font-size: 14px; font-weight: 400;"
                                                    value="{{ old('passport_expiry_date', $user->passport_expiry_date ?? '') }}">
                                            </div>
                                        </div>
                                        <div style="display: flex; gap: 20px;">
                                            <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                <label class="ihub-label">Tax Identification Number (TIN)</label>
                                                <input type="text" name="tin_number" class="form-control"
                                                    style="height: 43px; padding: 12px 16px; border-radius: 4px; outline: 1px solid #ECF0F3; background: #fff; font-size: 14px; font-weight: 400;"
                                                    value="{{ old('tin_number', $user->tin_number ?? '') }}">
                                            </div>
                                            <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                <label class="ihub-label">Social Security System (SSS)</label>
                                                <input type="text" name="sss_number" class="form-control"
                                                    style="height: 43px; padding: 12px 16px; border-radius: 4px; outline: 1px solid #ECF0F3; background: #fff; font-size: 14px; font-weight: 400;"
                                                    value="{{ old('sss_number', $user->sss_number ?? '') }}">
                                            </div>
                                        </div>
                                        <div style="display: flex; gap: 20px;">
                                            <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                <label class="ihub-label">Pag-IBIG Fund (HDMF)</label>
                                                <input type="text" name="hdmf_number" class="form-control"
                                                    style="height: 43px; padding: 12px 16px; border-radius: 4px; outline: 1px solid #ECF0F3; background: #fff; font-size: 14px; font-weight: 400;"
                                                    value="{{ old('hdmf_number', $user->hdmf_number ?? '') }}">
                                            </div>
                                            <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                <label class="ihub-label">PhilHealth Number</label>
                                                <input type="text" name="phil_number" class="form-control"
                                                    style="height: 43px; padding: 12px 16px; border-radius: 4px; outline: 1px solid #ECF0F3; background: #fff; font-size: 14px; font-weight: 400;"
                                                    value="{{ old('phil_number', $user->phil_number ?? '') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- Educational Background Tab --}}
                                <div class="tab-pane fade" id="education" role="tabpanel">
                                    <div style="width: 100%; padding: 20px; border-radius: 4px; outline: 1px solid #F1F1F4; outline-offset: -1px; display: flex; flex-direction: column; gap: 20px; background: #fff;">
                                        <div style="display: flex; gap: 20px;">
                                            <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                <label class="ihub-label">Highest Educational Attainment</label>
                                                <select name="education_level" class="form-control">
                                                    <option value="">Select</option>
                                                    @foreach(config('helpers.education_level') as $key => $label)
                                                        <option value="{{ $key }}" @if($user->education_level == $key) selected @endif>{{ $label }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                <label class="ihub-label">Course/Program</label>
                                                <input type="text" name="course_name" class="form-control"
                                                    style="height: 43px; padding: 12px 16px; border-radius: 4px; outline: 1px solid #ECF0F3; background: #fff; font-size: 14px; font-weight: 400;"
                                                    value="{{ old('course_name', $user->course_name ?? '') }}">
                                            </div>
                                        </div>
                                        <div style="display: flex; gap: 20px;">
                                            <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                <label class="ihub-label">Name of School/University</label>
                                                <input type="text" name="higher_learning_institution" class="form-control"
                                                    style="height: 43px; padding: 12px 16px; border-radius: 4px; outline: 1px solid #ECF0F3; background: #fff; font-size: 14px; font-weight: 400;"
                                                    value="{{ old('higher_learning_institution', $user->higher_learning_institution ?? '') }}">
                                            </div>
                                            <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                <label class="ihub-label">Year of Graduated</label>
                                                <input type="text" name="graduate_year" class="form-control"
                                                    style="height: 43px; padding: 12px 16px; border-radius: 4px; outline: 1px solid #ECF0F3; background: #fff; font-size: 14px; font-weight: 400;"
                                                    value="{{ old('graduate_year', $user->graduate_year ?? '') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- Working Experience Tab --}}
                                <div class="tab-pane fade" id="work" role="tabpanel">
                                    <div style="width: 100%; padding: 20px; border-radius: 4px; outline: 1px solid #F1F1F4; outline-offset: -1px; display: flex; flex-direction: column; gap: 20px; background: #fff;">
                                        <div style="display: flex; gap: 20px;">
                                            <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                <label class="ihub-label">Previous Employers</label>
                                                <input type="text" name="previous_employers" class="form-control"
                                                    style="height: 43px; padding: 12px 16px; border-radius: 4px; outline: 1px solid #ECF0F3; background: #fff; font-size: 14px; font-weight: 400;"
                                                    value="{{ old('previous_employers', $user->previous_employers ?? '') }}">
                                            </div>
                                            <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                <label class="ihub-label">Start Date-End Date</label>
                                                <input type="text" name="employment_dates" class="form-control"
                                                    style="height: 43px; padding: 12px 16px; border-radius: 4px; outline: 1px solid #ECF0F3; background: #fff; font-size: 14px; font-weight: 400;"
                                                    value="{{ old('employment_dates', $user->employment_dates ?? '') }}">
                                            </div>
                                        </div>
                                        <div style="display: flex; gap: 20px;">
                                            <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                <label class="ihub-label">Key Responsibilities</label>
                                                <input type="text" name="key_responsibilities" class="form-control"
                                                    style="height: 43px; padding: 12px 16px; border-radius: 4px; outline: 1px solid #ECF0F3; background: #fff; font-size: 14px; font-weight: 400;"
                                                    value="{{ old('key_responsibilities', $user->key_responsibilities ?? '') }}">
                                            </div>
                                            <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                <label class="ihub-label">Job Title</label>
                                                <input type="text" name="work_job_title" class="form-control"
                                                    style="height: 43px; padding: 12px 16px; border-radius: 4px; outline: 1px solid #ECF0F3; background: #fff; font-size: 14px; font-weight: 400;"
                                                    value="{{ old('work_job_title', $user->work_job_title ?? '') }}">
                                            </div>
                                        </div>
                                        <div style="display: flex; gap: 20px;">
                                            <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                <label class="ihub-label">Duration of Employment</label>
                                                <input type="text" name="employment_duration" class="form-control"
                                                    style="height: 43px; padding: 12px 16px; border-radius: 4px; outline: 1px solid #ECF0F3; background: #fff; font-size: 14px; font-weight: 400;"
                                                    value="{{ old('employment_duration', $user->employment_duration ?? '') }}">
                                            </div>
                                            <div style="flex: 1;"></div>
                                        </div>
                                    </div>
                                </div>
                                {{-- Skills Tab --}}
                                <div class="tab-pane fade" id="skills" role="tabpanel">
                                    <div style="width: 100%; padding: 20px; border-radius: 4px; outline: 1px solid #F1F1F4; outline-offset: -1px; display: flex; flex-direction: column; gap: 20px; background: #fff;">
                                        <div style="display: flex; gap: 20px;">
                                            <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                <label class="ihub-label">Relevant Skills</label>
                                                <input type="text" name="skills" class="form-control"
                                                    style="height: 43px; padding: 12px 16px; border-radius: 4px; outline: 1px solid #ECF0F3; background: #fff; font-size: 14px; font-weight: 400;"
                                                    value="{{ old('skills', $user->skills ?? '') }}">
                                            </div>
                                            <div style="flex: 1;"></div>
                                        </div>
                                    </div>
                                </div>
                                {{-- Professional Certifications Tab --}}
                                <div class="tab-pane fade" id="cert" role="tabpanel">
                                    <div style="width: 100%; padding: 20px; border-radius: 4px; outline: 1px solid #F1F1F4; outline-offset: -1px; display: flex; flex-direction: column; gap: 20px; background: #fff;">
                                        <div style="display: flex; gap: 20px;">
                                            <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                <label class="ihub-label">Professional Certifications</label>
                                                <input type="text" name="professional_certificate" class="form-control"
                                                    style="height: 43px; padding: 12px 16px; border-radius: 4px; outline: 1px solid #ECF0F3; background: #fff; font-size: 14px; font-weight: 400;"
                                                    value="{{ old('professional_certificate', $user->professional_certificate ?? '') }}">
                                            </div>
                                            <div style="flex: 1;"></div>
                                        </div>
                                    </div>
                                </div>
                                {{-- Training Program Attended Tab --}}
                                <div class="tab-pane fade" id="training" role="tabpanel">
                                    <div style="width: 100%; padding: 20px; border-radius: 4px; outline: 1px solid #F1F1F4; outline-offset: -1px; display: flex; flex-direction: column; gap: 20px; background: #fff;">
                                        <div style="display: flex; gap: 20px;">
                                            <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                <label class="ihub-label">Training Program</label>
                                                <input type="text" name="training_program" class="form-control"
                                                    style="height: 43px; padding: 12px 16px; border-radius: 4px; outline: 1px solid #ECF0F3; background: #fff; font-size: 14px; font-weight: 400;"
                                                    value="{{ old('training_program', $user->training_program ?? '') }}">
                                            </div>
                                            <div style="flex: 1;"></div>
                                        </div>
                                    </div>
                                </div>
                                {{-- Emergency Contact Tab --}}
                                <div class="tab-pane fade" id="emergency" role="tabpanel">
                                    <div style="width: 100%; padding: 20px; border-radius: 4px; outline: 1px solid #F1F1F4; outline-offset: -1px; display: flex; flex-direction: column; gap: 20px; background: #fff;">
                                        <div style="display: flex; gap: 20px;">
                                            <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                <label class="ihub-label">Name of Person</label>
                                                <input type="text" name="ec_contact_person_name" class="form-control"
                                                    style="height: 43px; padding: 12px 16px; border-radius: 4px; outline: 1px solid #ECF0F3; background: #fff; font-size: 14px; font-weight: 400;"
                                                    value="{{ old('ec_contact_person_name', $user->ec_contact_person_name ?? '') }}">
                                            </div>
                                            <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                <label class="ihub-label">Relationship</label>
                                                <select name="ec_relation_employee" class="form-control">
                                                    <option value="">Select</option>
                                                    @foreach(config('constants.RELATION_EMPLOYEE') as $key => $label)
                                                        <option value="{{ $key }}" @if($user->ec_relation_employee == $key) selected @endif>{{ $label }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div style="display: flex; gap: 20px;">
                                            <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                <label class="ihub-label">Contact Number</label>
                                                <input type="text" name="ec_contact_person_number" class="form-control"
                                                    style="height: 43px; padding: 12px 16px; border-radius: 4px; outline: 1px solid #ECF0F3; background: #fff; font-size: 14px; font-weight: 400;"
                                                    value="{{ old('ec_contact_person_number', $user->ec_contact_person_number ?? '') }}">
                                            </div>
                                            <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                <label class="ihub-label">Address</label>
                                                <input type="text" name="ec_home_address" class="form-control"
                                                    style="height: 43px; padding: 12px 16px; border-radius: 4px; outline: 1px solid #ECF0F3; background: #fff; font-size: 14px; font-weight: 400;"
                                                    value="{{ old('ec_home_address', $user->ec_home_address ?? '') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end mt-4" style="gap:10px;">
                                <a href="{{ route('insighthub.settings.user-management.show', $user->id) }}"
                                style="padding-left: 20px; padding-right: 20px; padding-top: 16px; padding-bottom: 16px; border-radius: 4px; outline: 1px #858BA6 solid; outline-offset: -1px; justify-content: center; align-items: center; gap: 8px; display: inline-flex; background: #fff; text-decoration: none;">
                                    <div style="text-align: center; justify-content: center; display: flex; flex-direction: column; color: #2E2F38; font-size: 16px; font-family: Inter; font-weight: 600; word-wrap: break-word;">
                                        Cancel
                                    </div>
                                </a>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                </div>

                <div class="ihub-section-card" style="padding: 0;">
                    <div class="row" style="margin:0;">


                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    function updateSectionTitle() {
        var activeTab = document.querySelector('.ihub-tab-link.active, .ihub-tab-link[aria-selected="true"]');
        var title = activeTab ? activeTab.querySelector('span').textContent : '';
        document.getElementById('sectionTitleText').textContent = title;
    }

    // Initial set
    updateSectionTitle();

    // Listen for tab changes (Bootstrap 5 event)
    document.querySelectorAll('.ihub-tab-link').forEach(function(tab) {
        tab.addEventListener('shown.bs.tab', function() {
            updateSectionTitle();
        });
    });
});
</script>
@endsection