@extends('insighthub.layout.app')

@section('title', 'Create User')

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
    .form-group-container{
        flex: 1; 
        display: flex; 
        flex-direction: column; 
        gap: 8px;
    }
    .form-group-container > input{
        height: 43px;
        padding: 12px 16px;
        border-radius: 4px;
        outline: 1px solid #ECF0F3;
        background: #fff;
        font-size: 14px;
        font-weight: 400;
    }
    .employment-group{
        width: 100%; 
        padding: 20px; 
        border-radius: 4px; 
        outline: 1px solid #F1F1F4; 
        outline-offset: -1px; 
        display: flex; 
        flex-direction: column; 
        gap: 20px; 
        background: #fff;
    }
    .tagify__tag.tagify--noAnim, .tagify__tag{
        background-color: var(--Surface-Badge-Default, #F5F7F8) !important;
    }
    .tagify .tagify__tag .tagify__tag-text {
        color: var(--Text-Primary, #2E2F38) !important;
    }
</style>
@endsection

@section('content')
<div class="ihub-bg">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="container-xxl app-container d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5 mb-lg-0">
                <h1 class="page-heading text-gray-900 fw-bold fs-3 my-0">
                    Create User
                </h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">Settings</li>
                    <li class="breadcrumb-item"><span class="bullet bg-gray-500 w-5px h-2px"></span></li>
                    <li class="breadcrumb-item text-muted" id="breadcrumb-last">User Management</li>
                    <li class="breadcrumb-item"><span class="bullet bg-gray-500 w-5px h-2px"></span></li>
                    <li class="breadcrumb-item text-muted" id="breadcrumb-last">Employee</li>
                    <li class="breadcrumb-item"><span class="bullet bg-gray-500 w-5px h-2px"></span></li>
                    <li class="breadcrumb-item text-muted" id="breadcrumb-last">Create Employee</li>
                </ul>
            </div>
        </div>
    </div>
    <div id="kt_app_content" class="app-content flex-column-fluid p-0">
        <div id="kt_app_content_container" class="container-xxl app-container">
            <div class="page-header mb-15" style="
                margin-top: 180px;
            ">
                @if (session()->has('alert-success'))
                    <div id="feedbackMessage" class="justify-content-between align-items-center feedback-message mt-3">
                        <p class="text-center fw-medium m-0">
                            <b>Success!</b> {{ session('alert-success') }}
                        </p>
                        <iconify-icon icon="iconamoon:close" width="20" height="20" class="cursor-pointer" id="closeIcon"></iconify-icon>
                    </div>
                @endif
                <h4 class="top-heading m-0" style="font-size: 32px;">Add Employee Personal Details</h4>
                <p class="custom-text-muted m-0">Fill in personal information to complete the profile and ensure accurate company records.</p>
            </div>
            <form action="{{ route('insighthub.settings.user-management.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
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
                                    <span>Skills and Certifications</span>
                                    <span class="ihub-tab-badge">Optional</span>
                                </a>
                            </li>
                            {{-- <li>
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
                            </li> --}}
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
                                    <div style="width: 100%; padding: 20px; border-radius: 4px; outline: 1px solid #F1F1F4; display: flex; flex-direction: column; gap: 20px; background: #fff;">
                                        <div style="display: flex; gap: 20px;">
                                            {{-- Profile Picture --}}
                                            <div style="width: 240px; padding: 20px; border-radius: 4px; outline: 1px solid #F1F1F4; display: flex; flex-direction: column; align-items: center; gap: 10px;">
                                                <div style="color: #727790; font-size: 16px; font-weight: 500;">Profile Picture</div>
                                                <div style="display: flex; flex-direction: column; align-items: center; gap: 16px;">
                                                    <div style="width: 128px; height: 128px; background: #F5F7F8; border-radius: 100px; display: flex; align-items: center; justify-content: center;">
                                                        <img id="profilePreview" src="#" alt="Preview" style="width: 128px; height: 128px; border-radius: 100px; object-fit: cover; display: none;">
                                                        <img id="profilePlaceholder" src="{{ asset('images/default-user.svg') }}" alt="Default" style="width: 128px; height: 128px; border-radius: 100px; object-fit: cover;">
                                                    </div>
                                                    <label style="width: 100%;">
                                                        <input type="file" name="profile_picture" accept="image/png, image/jpeg" style="display:none;"
                                                            onchange="
                                                                document.getElementById('profilePreview').src = window.URL.createObjectURL(this.files[0]);
                                                                document.getElementById('profilePreview').style.display = 'block';
                                                                document.getElementById('profilePlaceholder').style.display = 'none';
                                                            ">
                                                        <div style="justify-content: center; height: 38px; padding: 6px 12px; background: #fff; border-radius: 4px; outline: 1px solid #858BA6; display: flex; align-items: center; gap: 4px; cursor:pointer;">
                                                            <iconify-icon icon="material-symbols:upload" width="16" height="16"></iconify-icon>
                                                            <span style="color: #727790; font-size: 14px; font-weight: 600;">
                                                                Upload
                                                            </span>
                                                        </div>
                                                    </label>
                                                    <div style="color: #99A1B7; font-size: 12px; font-weight: 500;">Files accepted: png, jpg, jpeg</div>
                                                    @error('profile_picture')
                                                        <div style="color: #9C2418; font-size: 14px;">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div style="display: flex; gap: 20px;">
                                            {{-- First Name --}}
                                            <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                <label class="ihub-label">First Name <span style="color: #F24130;">*</span></label>
                                                <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror"
                                                    value="{{ old('first_name') }}" required placeholder="Enter First Name">
                                                <div style="color: #99A1B7; font-size: 13px;">
                                                    @error('first_name')
                                                        <span style="color: #9C2418;">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            {{-- Last Name --}}
                                            <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                <label class="ihub-label">Last Name <span style="color: #F24130;">*</span></label>
                                                <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror"
                                                    value="{{ old('last_name') }}" required placeholder="Enter Last Name">
                                                <div style="color: #99A1B7; font-size: 13px;">
                                                    @error('last_name')
                                                        <span style="color: #9C2418;">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div style="display: flex; gap: 20px;">
                                            {{-- Email --}}
                                            <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                <label class="ihub-label">Email <span style="color: #F24130;">*</span></label>
                                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                                    value="{{ old('email') }}" required placeholder="Enter Email Address">
                                                <div style="color: #99A1B7; font-size: 13px;">
                                                    @error('email')
                                                        <span style="color: #9C2418;">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            {{-- Mobile Number --}}
                                            <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                <label class="ihub-label">Mobile Number</label>
                                                <input type="text" name="mobile_number" class="form-control"
                                                    value="{{ old('mobile_number') }}" placeholder="Enter Mobile Number">
                                            </div>
                                        </div>
                                        <div style="display: flex; gap: 20px;">
                                            {{-- Date of Birth --}}
                                            <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                <label class="ihub-label">Date of Birth <span style="color: #F24130;">*</span></label>
                                                <input type="date" name="birth_date" id="birth_date" class="form-control @error('birth_date') is-invalid @enderror"
                                                    value="{{ old('birth_date') }}" required placeholder="Select Date of Birth">
                                                <div style="color: #99A1B7; font-size: 13px;">
                                                    @error('birth_date')
                                                        <span style="color: #9C2418;">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            {{-- Age (auto-calculated, display only) --}}
                                            <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                <label class="ihub-label">Age</label>
                                                <input type="text" id="age_display" class="form-control" value="Age Number" readonly style="background: #F5F7F8;">
                                            </div>
                                        </div>
                                        <div style="display: flex; gap: 20px;">
                                            {{-- Gender --}}
                                            <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                <label class="ihub-label">Gender <span style="color: #F24130;">*</span></label>
                                                <select name="gender" class="form-control @error('gender') is-invalid @enderror" required>
                                                    <option value="">Select Gender</option>
                                                    <option value="2" @if(old('gender') == 2) selected @endif>Male</option>
                                                    <option value="1" @if(old('gender') == 1) selected @endif>Female</option>
                                                </select>
                                                <div style="color: #99A1B7; font-size: 13px;">
                                                    @error('gender')
                                                        <span style="color: #9C2418;">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            {{-- Civil Status --}}
                                            <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                <label class="ihub-label">Civil Status <span style="color: #F24130;">*</span></label>
                                                <select name="marital_status" class="form-control @error('marital_status') is-invalid @enderror" required>
                                                    <option value="">Select Civil Status</option>
                                                    @foreach(config('constants.MARITAL_STATUSES') as $key => $label)
                                                        <option value="{{ $key }}" @if(old('marital_status') == $key) selected @endif>{{ $label }}</option>
                                                    @endforeach
                                                </select>
                                                <div style="color: #99A1B7; font-size: 13px;">
                                                    @error('marital_status')
                                                        <span style="color: #9C2418;">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div style="display: flex; gap: 20px;">
                                            {{-- Nationality --}}
                                            <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                <label class="ihub-label">Nationality <span style="color: #F24130;">*</span></label>
                                                <select name="country_id" id="nationality_id" class="form-control @error('country_id') is-invalid @enderror" required>
                                                    <option value="">Select Nationality</option>
                                                    @foreach($countries as $country)
                                                        <option value="{{ $country->id }}" @if(old('country_id') == $country->id) selected @endif>
                                                            {{ $country->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <div style="color: #99A1B7; font-size: 13px;">
                                                    @error('country_id')
                                                        <span style="color: #9C2418;">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            {{-- National ID --}}
                                            <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                <label class="ihub-label">National ID</label>
                                                <input type="text" name="national_id" class="form-control @error('national_id') is-invalid @enderror"
                                                    value="{{ old('national_id') }}" placeholder="Enter National ID">
                                                <div style="color: #99A1B7; font-size: 13px;">
                                                    @error('national_id')
                                                        <span style="color: #9C2418;">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- Employment Details Tab --}}
                                <div class="tab-pane fade" id="employment" role="tabpanel">
                                    <div style="width: 100%; padding: 20px; border-radius: 4px; outline: 1px solid #F1F1F4; outline-offset: -1px; display: flex; flex-direction: column; gap: 20px; background: #fff;">
                                        {{-- Employee ID (single long input, spans two columns) --}}
                                        <div style="display: flex; gap: 20px;">
                                            {{-- Employee ID --}}
                                            <div style="flex: 2; display: flex; flex-direction: column; gap: 8px;">
                                                <label style="color: #2E2F38; font-size: 14px; font-weight: 600;">Employee ID <span style="color: #F24130;">*</span></label>
                                                <input type="text" name="employee_code" class="form-control @error('employee_code') is-invalid @enderror"
                                                    style="height: 43px; padding: 12px 16px; border-radius: 4px; outline: 1px solid #ECF0F3; background: #fff; font-size: 14px; font-weight: 400;"
                                                    value="{{ old('employee_code') }}"
                                                    placeholder="Enter Employee ID" required>
                                                @error('employee_code')
                                                    <div style="color: #9C2418; font-size: 14px; margin-top: 4px;">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- 2 columns x 5 rows for disabled fields --}}
                                        <div style="display: flex; flex-direction: column; gap: 20px;">
                                            <div style="display: flex; gap: 20px;">
                                                {{-- Business Unit --}}
                                                <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                    <label class="ihub-label">Business Unit</label>
                                                    <select name="business_unit_id" id="businessUnitSelect" class="form-control">
                                                        <option value="">Select Business Unit</option>
                                                        @foreach($businessUnits as $unit)
                                                            <option value="{{ $unit->id }}" @if(old('business_unit_id') == $unit->id) selected @endif>
                                                                {{ $unit->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                {{-- Division --}}
                                                <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                    <label class="ihub-label">Division</label>
                                                    <select name="division_id" id="divisionSelect" class="form-control" disabled>
                                                        <option value="">Select Division</option>
                                                        @foreach($divisions as $division)
                                                            <option value="{{ $division->id }}" data-business-unit="{{ $division->business_unit_id }}"
                                                                @if(old('division_id') == $division->id) selected @endif>
                                                                {{ $division->head_of_division }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div style="display: flex; gap: 20px;">
                                                {{-- Department --}}
                                                <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                    <label style="color: #99A1B7; font-size: 14px; font-weight: 600;">Department</label>
                                                    <select name="department_id" id="departmentSelect" class="form-control" disabled>
                                                        <option value="">Select Department</option>
                                                        @foreach($departments as $department)
                                                            <option value="{{ $department->id }}" data-division="{{ $department->division_id }}"
                                                                @if(old('department_id') == $department->id) selected @endif>
                                                                {{ $department->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                {{-- Job Position --}}
                                                <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                    <label style="color: #99A1B7; font-size: 14px; font-weight: 600;">Job Position</label>
                                                    <select name="job_title" id="jobPositionSelect" class="form-control">
                                                        <option value="">Select Job Position</option>
                                                        @foreach($jobs as $job)
                                                            <option value="{{ $job->title }}" data-department="{{ $job->department_id }}" data-job-id="{{ $job->id }}"
                                                                @if(old('job_title') == $job->title) selected @endif>
                                                                {{ $job->title }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div style="display: flex; gap: 20px;">
                                                {{-- Job Position Headcount ID --}}
                                                <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                    <label style="color: #99A1B7; font-size: 14px; font-weight: 600;">Job Position Headcount ID</label>
                                                    <select name="job_position_headcount_id" id="jobPositionHeadcountSelect" class="form-control" disabled>
                                                        <option value="">Select Job Position Headcount ID</option>
                                                        @foreach($jobHeadcounts as $headcount)
                                                            <option value="{{ $headcount->id }}"
                                                                data-job-id="{{ $headcount->job_id }}"
                                                                data-created-at="{{ $headcount->created_at }}">
                                                                {{ $headcount->headcount_code }} (Headcount: {{ $headcount->headcount_number }})
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                {{-- Superior Job Position --}}
                                                <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                    <label style="color: #99A1B7; font-size: 14px; font-weight: 600;">Superior Job Position</label>
                                                    <input type="text" name="superior_job_position" class="form-control"
                                                        style="height: 43px; padding: 12px 16px; border-radius: 4px; outline: 1px solid #ECF0F3; background: #DDE2E8; font-size: 14px; font-weight: 400; color: #99A1B7;"
                                                        value="N/A" readonly>
                                                </div>
                                            </div>
                                            <div style="display: flex; gap: 20px;">
                                                {{-- Superior Headcount ID --}}
                                                <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                    <label style="color: #99A1B7; font-size: 14px; font-weight: 600;">Superior Headcount ID</label>
                                                    <input type="text" name="superior_headcount_id" class="form-control"
                                                        style="height: 43px; padding: 12px 16px; border-radius: 4px; outline: 1px solid #ECF0F3; background: #DDE2E8; font-size: 14px; font-weight: 400; color: #99A1B7;"
                                                        value="N/A" readonly>
                                                </div>
                                                {{-- Superior Name --}}
                                                <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                    <label style="color: #99A1B7; font-size: 14px; font-weight: 600;">Superior Name</label>
                                                    <input type="text" name="superior_name" class="form-control"
                                                        style="height: 43px; padding: 12px 16px; border-radius: 4px; outline: 1px solid #ECF0F3; background: #DDE2E8; font-size: 14px; font-weight: 400; color: #99A1B7;"
                                                        value="N/A" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- Employment Status & Date of Hire (two columns) --}}
                                        <div style="display: flex; gap: 20px;">
                                            <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                <label style="color: #2E2F38; font-size: 14px; font-weight: 600;">Employment Status</label>
                                                <select name="employment_status" class="form-control">
                                                    <option value="">Select Employment Status</option>
                                                    @foreach(config('constants.EMPLOYMENT_STATUSES') as $key => $label)
                                                        <option value="{{ $key }}" @if(old('employment_status') == $key) selected @endif>{{ $label }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                <label style="color: #2E2F38; font-size: 14px; font-weight: 600;">Date of Hire <span style="color: #F24130;">*</span></label>
                                                <input type="date" name="date_of_hire" class="form-control @error('date_of_hire') is-invalid @enderror"
                                                    style="height: 43px; padding: 12px 16px; border-radius: 4px; outline: 1px solid #ECF0F3; background: #fff; font-size: 14px; font-weight: 400;"
                                                    value="{{ old('date_of_hire') }}">
                                                @error('date_of_hire')
                                                    <div style="color: #9C2418; font-size: 14px; margin-top: 4px;">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- Assign Role --}}
                                        <div style="flex: 2; display: flex; flex-direction: column; gap: 8px;">
                                            <label style="color: #2E2F38; font-size: 14px; font-weight: 600;">
                                                Assign Role <span style="color: #D5540A;">*</span>
                                            </label>
                                            <select name="role_id" class="form-control @error('role_id') is-invalid @enderror" required>
                                                <option value="">Select Role</option>
                                                @foreach($roles as $role)
                                                    <option value="{{ $role->id }}" @if(old('role_id') == $role->id) selected @endif>
                                                        {{ $role->display_name ?? $role->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('role_id')
                                                <div style="color: #9C2418; font-size: 14px; margin-top: 4px;">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        {{-- Performance Ratings (each spans two columns) --}}
                                        @php
                                            $currentYear = now()->year;

                                            // Generate the 3 years dynamically: current, -1, -2
                                            $years = [$currentYear, $currentYear - 1, $currentYear - 2];
                                        @endphp

                                        @foreach ($years as $year)
                                            <div style="display: flex; gap: 20px;">
                                                <div style="flex: 2; display: flex; flex-direction: column; gap: 8px;">
                                                    
                                                    <label style="color: #2E2F38; font-size: 14px; font-weight: 600;">
                                                        {{ $year }} Performance Rating
                                                    </label>

                                                    <input
                                                        type="number"
                                                        name="performance_rating_{{ $year }}"
                                                        class="form-control"
                                                        min="0" max="5" step="0.01"
                                                        value="{{ 
                                                            old('performance_rating_'.$year) 
                                                            ?? ($performanceRatings[$year] ?? '') 
                                                        }}"
                                                        style="height: 43px; padding: 12px 16px; border-radius: 4px;
                                                            outline: 1px solid #ECF0F3; background: #FEFEFE;
                                                            font-size: 14px; font-weight: 400;">
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                                <div class="tab-pane fade" id="address" role="tabpanel">
                                    <div class="m-2" style="color: #2E2F38; font-size: 20px; font-weight: 500;">Home Address</div>
                                    <div style="width: 100%; padding: 20px; border-radius: 4px; outline: 1px solid #F1F1F4; outline-offset: -1px; display: flex; flex-direction: column; gap: 20px; background: #fff;">
                                        <!-- Home Address -->
                                        <div style="display: flex; gap: 20px;">
                                            <div style="flex: 1;">
                                                <label class="ihub-label">Address Line</label>
                                                <input type="text" name="home_address" class="form-control"
                                                    value="{{ old('home_address') }}"
                                                    placeholder="Enter Address Line">
                                            </div>
                                        </div>

                                        <!-- Country and Province/State Select -->
                                        <div style="display: flex; gap: 20px;">
                                            <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                <label class="ihub-label">Country</label>
                                                <select name="country_id" id="country_id" class="form-control">
                                                    <option value="">Select Country</option>
                                                    @foreach($countries as $country)
                                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                <label class="ihub-label">Province/State</label>
                                                <select name="state_id" id="state_id" class="form-control">
                                                    <option value="">Select Province/State</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- City Select and Postal Code -->
                                        <div style="display: flex; gap: 20px;">
                                            <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                <label class="ihub-label">City</label>
                                                <select name="city_id" id="city_id" class="form-control">
                                                    <option value="">Select City</option>
                                                </select>
                                            </div>
                                            <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                <label class="ihub-label">Postal Code</label>
                                                <input type="text" name="postal_code" class="form-control"
                                                    value="{{ old('postal_code') }}"
                                                    placeholder="Enter Postal Code">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="m-2 mt-4" style="display: flex; align-items: center; gap: 20px;">
                                        <div style="color: #2E2F38; font-size: 20px; font-weight: 500;">Mailing Address</div>
                                        <label style="display: flex; align-items: center; gap: 8px; cursor:pointer;">
                                            <input type="checkbox" id="sameMailingCheckbox" style="width:16px; height:16px;">
                                            <span style="color: #2E2F38; font-size: 14px;">Mailing address is the same as home address</span>
                                        </label>
                                    </div>
                                    <div style="width: 100%; padding: 20px; border-radius: 4px; outline: 1px solid #F1F1F4; outline-offset: -1px; display: flex; flex-direction: column; gap: 20px; background: #fff;">
                                        <div style="display: flex; gap: 20px;">
                                            <div style="flex: 1;">
                                                <label class="ihub-label">Address Line</label>
                                                <input type="text" name="mailing_address" id="mailing_address" class="form-control" placeholder="Enter Address Line">
                                            </div>
                                        </div>
                                        <div style="display: flex; gap: 20px;">
                                            <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                <label class="ihub-label">Country</label>
                                                <select name="mailing_country_id" id="mailing_country_id" class="form-control">
                                                    <option value="">Select Country</option>
                                                    @foreach($countries as $country)
                                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                <label class="ihub-label">Province/State</label>
                                                <select name="mailing_province_id" id="mailing_province_id" class="form-control">
                                                    <option value="">Select Province/State</option>
                                                    {{-- @foreach($states as $state)
                                                        <option value="{{ $state->id }}">{{ $state->name }}</option>
                                                    @endforeach --}}
                                                </select>
                                            </div>
                                        </div>
                                        <div style="display: flex; gap: 20px;">
                                            <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                <label class="ihub-label">City</label>
                                                <select name="mailing_city_id" id="mailing_city_id" class="form-control">
                                                    <option value="">Select City</option>
                                                    {{-- @foreach($cities as $city)
                                                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                                                    @endforeach --}}
                                                </select>
                                            </div>
                                            <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                <label class="ihub-label">Postal Code</label>
                                                <input type="text" name="mailing_postal_code" id="mailing_postal_code" class="form-control" placeholder="Enter Postal Code">
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
                                                    value="{{ old('passport_no') }}" placeholder="Enter Passport No.">
                                            </div>
                                            <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                <label class="ihub-label">Passport expiry date</label>
                                                <input type="date" name="passport_expiry_date" class="form-control"
                                                    style="height: 43px; padding: 12px 16px; border-radius: 4px; outline: 1px solid #ECF0F3; background: #fff; font-size: 14px; font-weight: 400;"
                                                    value="{{ old('passport_expiry_date') }}" >
                                            </div>
                                        </div>
                                        <div class="d-flex" style="display: flex; gap: 20px;" id="gov-philippines-fields-1">
                                            <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                <label class="ihub-label">Tax Identification Number (TIN)</label>
                                                <input type="text" name="tin_number" class="form-control"
                                                    style="height: 43px; padding: 12px 16px; border-radius: 4px; outline: 1px solid #ECF0F3; background: #fff; font-size: 14px; font-weight: 400;"
                                                    value="{{ old('tin_number') }}" placeholder="Enter Tax Identification Number (TIN)">
                                            </div>
                                            <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                <label class="ihub-label">Social Security System (SSS)</label>
                                                <input type="text" name="sss_number" class="form-control"
                                                    style="height: 43px; padding: 12px 16px; border-radius: 4px; outline: 1px solid #ECF0F3; background: #fff; font-size: 14px; font-weight: 400;"
                                                    value="{{ old('sss_number') }}" placeholder="Enter Social Security System (SSS) Number">
                                            </div>
                                        </div>
                                        <div class="d-flex" style="display: flex; gap: 20px;" id="gov-philippines-fields-2">
                                            <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                <label class="ihub-label">Pag-IBIG Fund (HDMF)</label>
                                                <input type="text" name="hdmf_number" class="form-control"
                                                    style="height: 43px; padding: 12px 16px; border-radius: 4px; outline: 1px solid #ECF0F3; background: #fff; font-size: 14px; font-weight: 400;"
                                                    value="{{ old('hdmf_number') }}" placeholder="Enter Pag-IBIG Fund (HDMF) Number">
                                            </div>
                                            <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                <label class="ihub-label">PhilHealth Number</label>
                                                <input type="text" name="phil_number" class="form-control"
                                                    style="height: 43px; padding: 12px 16px; border-radius: 4px; outline: 1px solid #ECF0F3; background: #fff; font-size: 14px; font-weight: 400;"
                                                    value="{{ old('phil_number') }}" placeholder="Enter PhilHealth Number">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- Educational Background Tab --}}
                                <div class="tab-pane fade" id="education" role="tabpanel">
                                    <div style="width: 100%; padding: 20px; border-radius: 4px; outline: 1px solid #F1F1F4; outline-offset: -1px; display: flex; flex-direction: column; gap: 20px; background: #fff;">
                                        <div style="display: flex; gap: 20px;">
                                            <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                <label class="ihub-label">Educational Level <span style="color: #F24130;">*</span></label>
                                                <select name="education_level" class="form-control @error('education_level') is-invalid @enderror">
                                                    <option value="">Select Educational Level</option>
                                                    @foreach(config('helpers.education_level') as $key => $label)
                                                        <option value="{{ $key }}" @if(old('education_level') == $key) selected @endif>{{ $label }}</option>
                                                    @endforeach
                                                </select>
                                                @error('education_level')
                                                    <div style="color: #9C2418; font-size: 14px; margin-top: 4px;">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                <label class="ihub-label">Higher Learning Institution</label>
                                                <input type="text" name="higher_learning_institution" class="form-control"
                                                style="height: 43px; padding: 12px 16px; border-radius: 4px; outline: 1px solid #ECF0F3; background: #fff; font-size: 14px; font-weight: 400;"
                                                value="{{ old('higher_learning_institution') }}" placeholder="Enter Higher Learning Institution">
                                            </div>
                                        </div>
                                        <div style="display: flex; gap: 20px;">
                                            <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                <label class="ihub-label">Course/Program</label>
                                                <input type="text" name="course_name" class="form-control"
                                                    style="height: 43px; padding: 12px 16px; border-radius: 4px; outline: 1px solid #ECF0F3; background: #fff; font-size: 14px; font-weight: 400;"
                                                    value="{{ old('course_name') }}" placeholder="Enter Course/Program">
                                            </div>
                                            <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                <label class="ihub-label">Year of Graduation</label>
                                                <input type="text" name="graduate_year" class="form-control"
                                                    style="height: 43px; padding: 12px 16px; border-radius: 4px; outline: 1px solid #ECF0F3; background: #fff; font-size: 14px; font-weight: 400;"
                                                    value="{{ old('graduate_year') }}" placeholder="Enter Year of Graduation">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- Working Experience Tab --}}
                                <div class="tab-pane fade" id="work" role="tabpanel">
                                    <div style="width: 100%; padding: 20px; border-radius: 4px; outline: 1px solid #F1F1F4; display: flex; flex-direction: column; gap: 20px; background: #fff;">
                                        <div id="employmentRepeater">
                                            <div style="width: 100%; padding: 20px; border-radius: 4px; outline: 1px solid #F1F1F4; display: flex; flex-direction: column; gap: 20px; background: #fff;" class="employment-group">
                                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                                    <div style="display: flex; align-items: center; gap: 20px;">
                                                        <div style="color: #2E2F38; font-size: 20px; font-weight: 500;">Working Experience 1</div>
                                                        <label style="display: flex; align-items: center; gap: 8px; cursor:pointer;">
                                                            <input type="checkbox" id="noExperienceCheckbox" style="width:16px; height:16px;">
                                                            <span style="color: #2E2F38; font-size: 14px;">No working experience</span>
                                                        </label>
                                                    </div>
                                                    <button type="button" class="btn deleteEmploymentBtn" style="width:24px; height:24px; padding:0; border-radius:4px;">
                                                        <iconify-icon icon="iconamoon:trash-light" class="fa-1-5"></iconify-icon>
                                                    </button>
                                                </div>
                                                <div style="display: flex; gap: 20px;">
                                                    <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                        <label class="ihub-label">Job Title <span style="color: #F24130;">*</span></label>
                                                        <input type="text" name="employments[0][job_title]" class="form-control" placeholder="Enter Job Title">
                                                    </div>
                                                    <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                        <label class="ihub-label">Company Name <span style="color: #F24130;">*</span></label>
                                                        <input type="text" name="employments[0][company_name]" class="form-control" placeholder="Enter Company Name"d>
                                                    </div>
                                                </div>
                                                <div style="display: flex; gap: 20px;">
                                                    <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                        <label class="ihub-label">Start Date <span style="color: #F24130;">*</span></label>
                                                        <input type="date" name="employments[0][start_date]" class="form-control" placeholder="DD/MM/YYYY">
                                                    </div>
                                                    <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                        <label class="ihub-label">End Date <span style="color: #F24130;">*</span></label>
                                                        <input type="date" name="employments[0][end_date]" class="form-control" placeholder="DD/MM/YYYY">
                                                    </div>
                                                </div>
                                                <div style="display: flex; gap: 20px;">
                                                    <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                        <label class="ihub-label">Years of Work</label>
                                                        <input type="number" step="0.01" name="employments[0][year_of_work]" class="form-control year-of-work" placeholder="Years of Work" 
                                                        style="height: 43px; padding: 12px 16px; border-radius: 4px; outline: 1px solid #ECF0F3; background: #DDE2E8; font-size: 14px; font-weight: 400; color: #99A1B7;"
                                                        readonly>
                                                    </div>
                                                </div>
                                                <div style="display: flex; gap: 20px;">
                                                    <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                        <label class="ihub-label">Key Responsibilities <span style="color: #F24130;">*</span></label>
                                                        <textarea name="employments[0][key_responsibility]" class="form-control" placeholder="Enter Key Responsibilities"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div style="margin-top:-12px;">
                                            <button type="button" id="addEmploymentBtn" class="btn" style="font-size:16px; color:var(--bs-primary);">
                                                <span >&#43;</span> Add More Experience
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                {{-- Skills and Certifications Tab --}}
                                <div class="tab-pane fade" id="skills" role="tabpanel">
                                    <div style="width: 100%; padding: 20px; border-radius: 4px; outline: 1px solid #F1F1F4; outline-offset: -1px; display: flex; flex-direction: column; gap: 20px; background: #fff;">
                                        <div style="display: flex; gap: 20px;">
                                            <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                <label class="ihub-label">Relevant Skills</label>
                                                <input type="text" name="skills" class="form-control"
                                                    style="height: 43px; padding: 12px 16px; border-radius: 4px; outline: 1px solid #C8CFD9; background: #fff; font-size: 14px; font-weight: 400;"
                                                    placeholder="Enter Relevant Skills"
                                                    id="kt_tagify_1">
                                                <div style="color: #727790; font-size: 14px;">Press Enter after typing each keyword to add more</div>
                                            </div>
                                        </div>
                                        <div style="display: flex; gap: 20px;">
                                            <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                <label class="ihub-label">Professional Certifications</label>
                                                <input type="text" name="professional_certificate" class="form-control"
                                                    style="height: 43px; padding: 12px 16px; border-radius: 4px; outline: 1px solid #C8CFD9; background: #fff; font-size: 14px; font-weight: 400;"
                                                    placeholder="Enter Professional Certifications"
                                                    id="kt_tagify_2">
                                                <div style="color: #727790; font-size: 14px;">Press Enter after typing each keyword to add more</div>
                                            </div>
                                        </div>
                                        <div style="display: flex; gap: 20px;">
                                            <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                <label class="ihub-label">Training Programs Attended</label>
                                                <input type="text" name="training_program" class="form-control"
                                                    style="height: 43px; padding: 12px 16px; border-radius: 4px; outline: 1px solid #C8CFD9; background: #fff; font-size: 14px; font-weight: 400;"
                                                    placeholder="Enter Training Programs Attended"
                                                    id="kt_tagify_3">
                                                <div style="color: #727790; font-size: 14px;">Press Enter after typing each keyword to add more</div>
                                            </div>
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
                                                    value="{{ old('ec_contact_person_name') }}" placeholder="Enter Name of Person">
                                            </div>
                                            <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                <label class="ihub-label">Relationship</label>
                                                <select name="ec_relation_employee" class="form-control">
                                                    <option value="">Select Relationship</option>
                                                    @foreach(config('constants.RELATION_EMPLOYEE') as $key => $label)
                                                        <option value="{{ $key }}" @if(old('ec_relation_employee') == $key) selected @endif>{{ $label }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div style="display: flex; gap: 20px;">
                                            <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                <label class="ihub-label">Contact Number</label>
                                                <input type="text" name="ec_contact_person_number" class="form-control"
                                                    style="height: 43px; padding: 12px 16px; border-radius: 4px; outline: 1px solid #ECF0F3; background: #fff; font-size: 14px; font-weight: 400;"
                                                    value="{{ old('ec_contact_person_number') }}" placeholder="Enter Contact Number">
                                            </div>
                                            <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                                <label class="ihub-label">Address</label>
                                                <input type="text" name="ec_home_address" class="form-control"
                                                    style="height: 43px; padding: 12px 16px; border-radius: 4px; outline: 1px solid #ECF0F3; background: #fff; font-size: 14px; font-weight: 400;"
                                                    value="{{ old('ec_home_address') }}" placeholder="Enter Address">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end mt-4" style="gap:10px;">
                                <a href="{{ route('insighthub.settings.user-management.index') }}"
                                style="padding-left: 20px; padding-right: 20px; padding-top: 16px; padding-bottom: 16px; border-radius: 4px; outline: 1px #858BA6 solid; outline-offset: -1px; justify-content: center; align-items: center; gap: 8px; display: inline-flex; background: #fff; text-decoration: none;">
                                    <div style="text-align: center; justify-content: center; display: flex; flex-direction: column; color: #2E2F38; font-size: 16px; font-family: Inter; font-weight: 600; word-wrap: break-word;">
                                        Cancel
                                    </div>
                                </a>
                                <button type="submit" class="btn btn-primary">Create</button>
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
@section('scripts')
<!-- Tagify links -->
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css">
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script>
    var input1 = document.querySelector("#kt_tagify_1");
    var input2 = document.querySelector("#kt_tagify_2");
    var input3 = document.querySelector("#kt_tagify_3");

    // Initialize Tagify components on the above inputs
    new Tagify(input1);
    new Tagify(input2);
    new Tagify(input3);
</script>
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
<script>
document.addEventListener('DOMContentLoaded', function () {
    const businessUnitSelect = document.getElementById('businessUnitSelect');
    const divisionSelect = document.getElementById('divisionSelect');
    const departmentSelect = document.getElementById('departmentSelect');
    const jobPositionSelect = document.getElementById('jobPositionSelect');
    const jobPositionHeadcountSelect = document.getElementById('jobPositionHeadcountSelect');

    function resetDropdown(dropdown) {
        dropdown.value = '';
    }

    function filterDivisions() {
        const selectedBU = businessUnitSelect.value;
        let hasMatch = false;
        Array.from(divisionSelect.options).forEach(option => {
            if (!option.value) return;
            const matches = option.getAttribute('data-business-unit') === selectedBU;
            option.style.display = matches ? '' : 'none';
            if (matches) hasMatch = true;
        });
        divisionSelect.disabled = !hasMatch;
        resetDropdown(divisionSelect);
        resetDropdown(departmentSelect);
        resetDropdown(jobPositionSelect);
        resetDropdown(jobPositionHeadcountSelect);
        jobPositionHeadcountSelect.disabled = true;
        filterDepartments();
    }

    function filterDepartments() {
        const selectedDivision = divisionSelect.value;
        let hasMatch = false;
        Array.from(departmentSelect.options).forEach(option => {
            if (!option.value) return;
            const matches = option.getAttribute('data-division') === selectedDivision;
            option.style.display = matches ? '' : 'none';
            if (matches) hasMatch = true;
        });
        departmentSelect.disabled = !hasMatch;
        resetDropdown(departmentSelect);
        resetDropdown(jobPositionSelect);
        filterJobPositions();
    }

    function filterJobPositions() {
        const selectedDepartment = departmentSelect.value;
        let hasMatch = false;
        Array.from(jobPositionSelect.options).forEach(option => {
            if (!option.value) return;
            const matches = option.getAttribute('data-department') === selectedDepartment;
            option.style.display = matches ? '' : 'none';
            if (matches) hasMatch = true;
        });
        jobPositionSelect.disabled = !hasMatch;
        resetDropdown(jobPositionSelect);
    }

    function filterJobHeadcounts() {
        const selectedJobTitle = jobPositionSelect.value;
        let selectedJobId = '';
        // Find job_id for selected job_title
        @foreach($jobs as $job)
            if ("{{ $job->title }}" === selectedJobTitle) {
                selectedJobId = "{{ $job->id }}";
            }
        @endforeach

        let latestOption = null;
        let latestCreatedAt = '';
        Array.from(jobPositionHeadcountSelect.options).forEach(option => {
            if (!option.value) return;
            const matches = option.getAttribute('data-job-id') === selectedJobId;
            option.style.display = matches ? '' : 'none';
            if (matches) {
                const createdAt = option.getAttribute('data-created-at');
                if (!latestCreatedAt || createdAt > latestCreatedAt) {
                    latestCreatedAt = createdAt;
                    latestOption = option;
                }
            }
        });
        jobPositionHeadcountSelect.disabled = !latestOption;
        jobPositionHeadcountSelect.value = latestOption ? latestOption.value : '';
    }

    businessUnitSelect.addEventListener('change', filterDivisions);
    divisionSelect.addEventListener('change', filterDepartments);
    departmentSelect.addEventListener('change', filterJobPositions);
    jobPositionSelect.addEventListener('change', filterJobHeadcounts);

    // Initial filter on page load
    filterDivisions();
    filterJobHeadcounts();
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const nationalitySelect = document.getElementById('nationality_id');
    const govFields1 = document.getElementById('gov-philippines-fields-1');
    const govFields2 = document.getElementById('gov-philippines-fields-2');

    function toggleGovFields() {
        // console.log("toggleGovFields called");
        if (nationalitySelect.value == '135') { // 135 = Philippines
            govFields1.style.display = '';
            govFields2.style.display = '';
            govFields1.className = 'd-flex';
            govFields2.className = 'd-flex';
        } else {
            govFields1.style.display = 'none';
            govFields2.style.display = 'none';
            govFields1.className = '';
            govFields2.className = '';
        }
    }

    nationalitySelect.addEventListener('change', toggleGovFields);
    toggleGovFields(); // Initial check on page load
});
</script>
<script>
document.getElementById('jobPositionSelect').addEventListener('change', function() {
    var jobId = this.options[this.selectedIndex].getAttribute('data-job-id');
    if (!jobId) return;
    fetch('/insighthub/settings/user-management/get-user-by-job-position?job_id=' + jobId)
        .then(response => response.json())
        .then(data => {
            console.log(data);
            document.getElementById('jobPositionHeadcountSelect').value = data.headcount_code || '';
            document.querySelector('input[name="superior_job_position"]').value = data.superior_job_position || 'N/A';
            document.querySelector('input[name="superior_headcount_id"]').value = data.superior_headcount_code || 'N/A';
            document.querySelector('input[name="superior_name"]').value = data.superior_name || 'Vacant';
        });
});
</script>
<script>
document.addEventListener("DOMContentLoaded", function () {

    const countrySelect = document.getElementById('country_id');
    const stateSelect = document.getElementById('state_id');
    const citySelect = document.getElementById('city_id');

    // Reset dropdown helper
    function resetSelect(selectElement, placeholder = "Select option") {
        selectElement.innerHTML = "";
        const option = document.createElement("option");
        option.textContent = placeholder;
        option.value = "";
        selectElement.appendChild(option);
    }

    // Load Provinces
    countrySelect?.addEventListener('change', function () {
        const countryId = this.value;
        resetSelect(stateSelect, "Select State");
        resetSelect(citySelect, "Select City");

        if (!countryId) return;

        fetch(`/insighthub/settings/user-management/address/states/${countryId}`)
            .then(response => response.json())
            .then(data => {
                data.forEach(item => {
                    const option = document.createElement("option");
                    option.value = item.id;
                    option.textContent = item.name;
                    stateSelect.appendChild(option);
                });
            });
    });

    // Load Cities
    stateSelect?.addEventListener('change', function () {
        const stateId = this.value;
        resetSelect(citySelect, "Select City");

        if (!stateId) return;

        fetch(`/insighthub/settings/user-management/address/cities/${stateId}`)
            .then(response => response.json())
            .then(data => {
                data.forEach(item => {
                    const option = document.createElement("option");
                    option.value = item.id;
                    option.textContent = item.name;
                    citySelect.appendChild(option);
                });
            });
    });

});
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    let employmentIndex = 1;

    function updateDeleteButtons() {
        const groups = document.querySelectorAll('.employment-group');
        groups.forEach((group, idx) => {
            const btn = group.querySelector('.deleteEmploymentBtn');
            if (btn) btn.disabled = (groups.length === 1);
            // Update title for each group
            const titleDiv = group.querySelector('.employment-title');
            if (titleDiv) titleDiv.textContent = `Working Experience ${idx + 1}`;
        });
    }

    // function renumberEmploymentTitles() {
    //     document.querySelectorAll('.employment-group .employment-title').forEach((el, idx) => {
    //         el.textContent = `Working Experience ${idx + 1}`;
    //     });
    // }

    document.getElementById('addEmploymentBtn').addEventListener('click', function() {
        const container = document.getElementById('employmentRepeater');
        const groups = container.querySelectorAll('.employment-group');
        const nextIndex = groups.length + 1; // 0-based, so next is length
        const group = document.createElement('div');
        group.className = 'employment-group';
        group.innerHTML = `
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div style="display: flex; align-items: center; gap: 20px;">
                    <div class="employment-title" style="color: #2E2F38; font-size: 20px; font-weight: 500;">Working Experience ${nextIndex + 1}</div>
                </div>
                <button type="button" class="btn deleteEmploymentBtn" style="width:24px; height:24px; padding:0; border-radius:4px;">
                    <iconify-icon icon="iconamoon:trash-light" class="fa-1-5"></iconify-icon>
                </button>
            </div>
            <div style="display: flex; gap: 20px;">
                <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                    <label class="ihub-label">Job Title <span style="color: #F24130;">*</span></label>
                    <input type="text" name="employments[${nextIndex}][job_title]" class="form-control" placeholder="Enter Job Title">
                </div>
                <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                    <label class="ihub-label">Company Name <span style="color: #F24130;">*</span></label>
                    <input type="text" name="employments[${nextIndex}][company_name]" class="form-control" placeholder="Enter Company Name">
                </div>
            </div>
            <div style="display: flex; gap: 20px;">
                <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                    <label class="ihub-label">Start Date <span style="color: #F24130;">*</span></label>
                    <input type="date" name="employments[${nextIndex}][start_date]" class="form-control" placeholder="DD/MM/YYYY">
                </div>
                <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                    <label class="ihub-label">End Date <span style="color: #F24130;">*</span></label>
                    <input type="date" name="employments[${nextIndex}][end_date]" class="form-control" placeholder="DD/MM/YYYY">
                </div>
            </div>
            <div style="display: flex; gap: 20px;">
                <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                    <label class="ihub-label">Years of Work</label>
                    <input type="number" step="0.01" name="employments[${nextIndex}][year_of_work]" class="form-control year-of-work" placeholder="Years of Work" 
                    style="height: 43px; padding: 12px 16px; border-radius: 4px; outline: 1px solid #ECF0F3; background: #DDE2E8; font-size: 14px; font-weight: 400; color: #99A1B7;" readonly>
                </div>
            </div>
            <div style="display: flex; gap: 20px;">
                <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                    <label class="ihub-label">Key Responsibilities <span style="color: #F24130;">*</span></label>
                    <textarea name="employments[${nextIndex}][key_responsibility]" class="form-control" placeholder="Enter Key Responsibilities"></textarea>
                </div>
            </div>
        `;
        container.appendChild(group);
        updateDeleteButtons();
        // renumberEmploymentTitles();
    });

    document.getElementById('employmentRepeater').addEventListener('click', function(e) {
        let btn = null;
        if (e.target.classList.contains('deleteEmploymentBtn')) {
            btn = e.target;
        } else if (e.target.tagName === 'ICONIFY-ICON' && e.target.parentElement.classList.contains('deleteEmploymentBtn')) {
            btn = e.target.parentElement;
        }
        if (btn) {
            const groups = document.querySelectorAll('.employment-group');
            if (groups.length > 1) {
                btn.closest('.employment-group').remove();
                // renumberEmploymentTitles();
            }
        }
    });

    updateDeleteButtons();
    // renumberEmploymentTitles();
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const repeater = document.getElementById('employmentRepeater');
    const addBtn = document.getElementById('addEmploymentBtn');
    const noExpCheckbox = document.getElementById('noExperienceCheckbox');
    const addExpBtn = document.getElementById('addEmploymentBtn');

    function setGroupDisabled(group, disabled) {
        group.querySelectorAll('input, textarea').forEach(el => {
            if (el.type !== 'checkbox') {
                el.disabled = disabled;
                if (disabled) el.value = '';
            }
        });
    }

    function handleNoExperienceChange() {
        const groups = repeater.querySelectorAll('.employment-group');
        if (noExpCheckbox.checked) {
            // Disable and clear first group
            setGroupDisabled(groups[0], true);
            // Remove additional groups
            for (let i = groups.length - 1; i > 0; i--) {
                groups[i].remove();
            }
            addBtn.disabled = true;
            addExpBtn.style.display = 'none';
        } else {
            setGroupDisabled(groups[0], false);
            addBtn.disabled = false;
            addExpBtn.style.display = 'inline-block';
        }
    }

    if (noExpCheckbox) {
        noExpCheckbox.addEventListener('change', handleNoExperienceChange);
        handleNoExperienceChange(); // Initial check
    }
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const birthInput = document.getElementById('birth_date');
    const ageDisplay = document.getElementById('age_display');
    function calcAge() {
        const val = birthInput.value;
        if (!val) { ageDisplay.value = 'Age Number'; return; }
        const birthDate = new Date(val);
        const today = new Date();
        let age = today.getFullYear() - birthDate.getFullYear();
        const m = today.getMonth() - birthDate.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) age--;
        ageDisplay.value = age >= 0 ? age : '';
    }
    birthInput.addEventListener('change', calcAge);
    calcAge(); // initial
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const sameMailingCheckbox = document.getElementById('sameMailingCheckbox');
    const homeAddress = document.querySelector('input[name="home_address"]');
    const homeProvince = document.getElementById('state_id');
    const homeCity = document.getElementById('city_id');
    const homePostal = document.querySelector('input[name="postal_code"]');

    const mailingAddress = document.getElementById('mailing_address');
    const mailingCountry = document.getElementById('mailing_country_id');
    const mailingProvince = document.getElementById('mailing_province_id');
    const mailingCity = document.getElementById('mailing_city_id');
    const mailingPostal = document.getElementById('mailing_postal_code');

    function setMailingDisabled(disabled) {
        mailingAddress.disabled = disabled;
        mailingCountry.disabled = disabled;
        mailingProvince.disabled = disabled;
        mailingCity.disabled = disabled;
        mailingPostal.disabled = disabled;
        if (disabled) {
            mailingAddress.value = '';
            mailingCountry.value = '';
            mailingProvince.value = '';
            mailingCity.value = '';
            mailingPostal.value = '';
        }
    }

    sameMailingCheckbox.addEventListener('change', function() {
        setMailingDisabled(this.checked);
    });

    form.addEventListener('submit', function(e) {
        if (sameMailingCheckbox.checked) {
            mailingAddress.value = homeAddress.value;
            mailingCountry.value = homeCountry.value;
            mailingProvince.value = homeProvince.value;
            mailingCity.value = homeCity.value;
            mailingPostal.value = homePostal.value;
        }
    });
});
</script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const mailingCountrySelect = document.getElementById('mailing_country_id');
    const mailingProvinceSelect = document.getElementById('mailing_province_id');
    const mailingCitySelect = document.getElementById('mailing_city_id');

    function resetSelect(selectElement, placeholder = "Select option") {
        selectElement.innerHTML = "";
        const option = document.createElement("option");
        option.textContent = placeholder;
        option.value = "";
        selectElement.appendChild(option);
    }

    // Load Mailing Provinces
    mailingCountrySelect?.addEventListener('change', function () {
        const countryId = this.value;
        resetSelect(mailingProvinceSelect, "Select Province/State");
        resetSelect(mailingCitySelect, "Select City");

        if (!countryId) return;

        fetch(`/insighthub/settings/user-management/address/states/${countryId}`)
            .then(response => response.json())
            .then(data => {
                data.forEach(item => {
                    const option = document.createElement("option");
                    option.value = item.id;
                    option.textContent = item.name;
                    mailingProvinceSelect.appendChild(option);
                });
            });
    });

    // Load Mailing Cities
    mailingProvinceSelect?.addEventListener('change', function () {
        const stateId = this.value;
        resetSelect(mailingCitySelect, "Select City");

        if (!stateId) return;

        fetch(`/insighthub/settings/user-management/address/cities/${stateId}`)
            .then(response => response.json())
            .then(data => {
                data.forEach(item => {
                    const option = document.createElement("option");
                    option.value = item.id;
                    option.textContent = item.name;
                    mailingCitySelect.appendChild(option);
                });
            });
    });
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    function validateRating(input) {
        let val = input.value;
        if (val === '') return;
        val = parseFloat(val);
        if (isNaN(val) || val < 0) val = 0;
        if (val > 5) val = 5;
        // Limit to 2 decimals
        val = Math.round(val * 100) / 100;
        input.value = val;
    }
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('input[name^="performance_rating_"]').forEach(function (input) {
            input.addEventListener('input', () => validateRating(input));
            input.addEventListener('blur', () => validateRating(input));
        });
    });

});
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    function calcYearsOfWork(group) {
        const startInput = group.querySelector('input[name$="[start_date]"]');
        const endInput = group.querySelector('input[name$="[end_date]"]');
        const yearsInput = group.querySelector('.year-of-work');
        if (startInput && endInput && yearsInput) {
            const startVal = startInput.value;
            const endVal = endInput.value;
            if (startVal && endVal) {
                const startDate = new Date(startVal);
                const endDate = new Date(endVal);
                let years = (endDate - startDate) / (1000 * 60 * 60 * 24 * 365.25);
                years = years > 0 ? Math.round(years * 100) / 100 : 0;
                yearsInput.value = years;
            } else {
                yearsInput.value = '';
            }
        }
    }

    function attachYearsListeners(group) {
        const startInput = group.querySelector('input[name$="[start_date]"]');
        const endInput = group.querySelector('input[name$="[end_date]"]');
        if (startInput) startInput.addEventListener('change', function() { calcYearsOfWork(group); });
        if (endInput) endInput.addEventListener('change', function() { calcYearsOfWork(group); });
    }

    // Attach listeners to all existing groups
    document.querySelectorAll('.employment-group').forEach(group => {
        attachYearsListeners(group);
    });

    // Attach listeners to new groups after adding
    document.getElementById('addEmploymentBtn').addEventListener('click', function() {
        setTimeout(function() {
            const groups = document.querySelectorAll('.employment-group');
            attachYearsListeners(groups[groups.length - 1]);
        }, 0);
    });
});
</script>
@endsection