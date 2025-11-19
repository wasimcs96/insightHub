@extends('admin.layout.app')

@section('title', 'Setting - Job Create')
@section('styles')
<style>
    .select2-container--disabled .select2-selection {
        background-color: #e4e7ec !important;
    }
     .select2-container--disabled.select2-selection--single {
        background-color: #e4e7ec !important;
        color: #6c757d;
        cursor: not-allowed;
        opacity: 1; /* fix weird transparency */
    }

    .select2-container--default.select2-container--disabled .select2-selection__arrow {
        display: none; /* optional: hide dropdown arrow */
    }
    .custom-toggle-wrapper {
        display: flex;
        align-items: center;
        gap: 2rem;
    }

    .custom-toggle {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        position: relative;
    }

    .custom-toggle input[type="checkbox"] {
        width: 42px;
        height: 22px;
        -webkit-appearance: none;
        appearance: none;
        background-color: #ddd;
        outline: none;
        border-radius: 30px;
        position: relative;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .custom-toggle input[type="checkbox"]::before {
        content: '';
        width: 18px;
        height: 18px;
        background-color: #fff;
        border-radius: 50%;
        position: absolute;
        top: 2px;
        left: 2px;
        transition: 0.3s ease;
    }

    .custom-toggle input[type="checkbox"]:checked {
        background-color: #f6a623;
    }

    .custom-toggle input[type="checkbox"]:checked::before {
        transform: translateX(20px);
    }

    .custom-toggle label {
        font-weight: 500;
        font-size: 14px;
        color: #333;
    }

    .divider {
        width: 1px;
        height: 24px;
        background-color: #ccc;
    }
    .form-check-input:checked {
    background-color: #f6a623;
    border-color: #f6a623;
    }

    .navtab-btn {
        border: 1px solid #f7941d;
        border-radius: 6px;
    }

    a.bg-primary:hover {
        background-color: #000000 !important;
        color: white;
    }

    .trimmed-description {
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }

    .select2-selection__choice {
        background-color: #FFF6EA !important;
        color: #7C4A0E !important;
        /* margin-right: 2rem !important; */
    }

    .form-check-input:checked,
    .form-check-input {
        display: none;
    }

    .card-checked-orange {
        border: 1px solid #F7941D;
    }

    .header-checked-orange {
        background: #F7941D;
        color: #fff;
    }

    .card-title-orange {
        color: #FFF;
        font-size: 16.575px;
        font-weight: 700;
        line-height: 24px;
        letter-spacing: 0.15px;
    }

    .orange-check {
        color: #F7941D;
        font-size: 22px;
    }

    /* .select2-selection__choice__remove {
                                                left: 80%;
                                                margin-left: 8px;
                                            } */
    .select2-selection__choice__display {
        /* margin-left: 0px !important; */
        /* margin-right: 15px !important; */
    }

    .select2-container .select2-selection--multiple .select2-selection__rendered {
        white-space: normal;
    }

    /* textarea.form-control {
                                 height: 150px !important;
                                 } */
    .btn-outline-primary {
        border: 2px solid orange !important;
        border: 2px solid #f7931e;
        color: #f7931e;
        background: white;
    }

    .btn-outline-primary:hover {
        background: #f7931e;
        color: white !important;
    }

    .app-content {
        padding: 45px 94px 225px 94px !important;
    }

    .card .card-header {
        padding: 24px;
    }

    .card .card-header .card-title {
        margin: 0;
    }

    .card-title {
        font-size: 17.55px;
        font-weight: 500;
        line-height: 21.06px;
    }

    .card-body .col-lg-4 {
        padding-right: 0;
        padding-left: 16px !important;
    }

    .padding-card {
        padding: 24px !important;
    }

    .technical-skills-card,
    .general-skills-card {
        padding: 24px 24px 8px 24px !important;
    }

    .card-body h6,
    .card-body h5 {
        color: #071437;
        font-size: 14px;
        font-style: normal;
        font-weight: 600;
        line-height: 20px;
        margin-bottom: 4px;
    }

    .card-body h6 {
        color: #3E3E3E;
        font-size: 12px;
        font-weight: 600;
        line-height: 16px;
    }

    /* .card-body div:last-child {
                        margin: 0 !important;
                    } */

    .col-lg-4 {
        padding-left: 0 !important;
    }

    .select2-container--bootstrap5 .select2-selection--multiple {
        float: right;
    }

    .select2-container .select2-selection--multiple .select2-selection__rendered {
        white-space: normal;
    }

    .form-control {
        border-radius: 4px;
    }

    .submit-job-bot button,
    .submit-job-bot a,
    .add-function {
        display: flex;
        padding: 14px 20px;
        justify-content: center;
        align-items: center;
        gap: 8px;
        border-radius: 4px;
        border: none;
        color: #FFF;
        font-size: 14px;
        font-weight: 600;
        line-height: 20px;
    }

    .submit-job-bot button {
        background: #F7941C;
    }

    .submit-job-bot a {
        background: #F24130;
    }

    .btn-vl-container {
        display: flex;
        align-items: center;
    }

    .btn-vl-container select {
        border-radius: 4px 0px 0px 4px;
        border-top: 1px solid #DBDFE9;
        border-bottom: 1px solid #DBDFE9;
        border-left: 1px solid #DBDFE9;
        border-right: 0px;
        color: #071437;
        height: 100%;
        font-size: 12px;
        font-weight: 400;
        line-height: 16px;
        display: flex;
        padding: 0px 12px;
        align-items: center;
        flex: 1 0 0;
        align-self: stretch;
    }

    .btn-vl-container button {
        border-radius: 0px 4px 4px 0px;
        border: 1.5px solid #F7941C;
        display: flex;
        padding: 8px 16px;
        justify-content: center;
        align-items: center;
        align-self: stretch;
        color: #F7941D;
        font-size: 12px;
        font-weight: 600;
        line-height: 16px;
        background: #fff;
    }

    @media (max-width: 1281px) {
        .app-content {
            padding: 45px 70px 50px 70px !important;
        }
    }

    .error {
        color: red;
        font-weight: 500;

    }

    .form-check-input-custom {
        width: 1em;
        height: 1em;
        margin-top: 0.25em;
        vertical-align: top;
        background-color: #fff;
        background-repeat: no-repeat;
        background-position: center;
        background-size: contain;
        border: 1px solid rgba(0, 0, 0, 0.25);
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        border-radius: 0.25em;
        transition: background-color 0.15s ease-in-out,
                    border-color 0.15s ease-in-out,
                    box-shadow 0.15s ease-in-out;
        cursor: pointer;
    }

    .form-check-input-custom:checked {
        background-color: #0d6efd; /* Bootstrap primary color */
        border-color: #0d6efd;
        background-image: url("data:image/svg+xml,..."); /* checkmark icon SVG */
        }

    .form-check-input-custom:focus {
        border-color: #86b7fe;
        outline: 0;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25); /* blue shadow */
        }

        .form-check-input-custom:disabled {
  pointer-events: none;
  opacity: 0.5;
}

.red-text {
  color: red;
}


</style>
@endsection

@section('content')
    <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">

        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container  container-fluid d-flex flex-stack container">


            <!--begin::Page title-->
            <div data-kt-swapper="true" data-kt-swapper-mode="{default: 'prepend', lg: 'prepend'}"
                data-kt-swapper-parent="{default: '#kt_app_content_container', lg: '#kt_app_toolbar_container'}"
                class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5 mb-lg-0">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                    Job Create
                </h1>
                <!--end::Title-->


                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">

                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="/admin/dashboard" class="text-muted text-hover-primary">
                            Dashboard </a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->

                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        Settings </li>
                    <!--end::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->

                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        Job Descriptions </li>
                    <!--end::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->

                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        Job Create </li>
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

    <div id="kt_app_content" class="app-content  flex-column-fluid ">

        <div id="kt_app_content_container" class="app-container  w-100 ">
            <form class="space-y-4 w-96" action="{{ route('jobs.store') }}" method="POST" id="job_description_form">
                @csrf
                <div class="card shadow-sm mb-4">
                    <div class="card-header">
                        <h3 class="card-title">
                            Create Job
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                <label for="toggle_select" class="fw-semibold fs-6 mb-2">Job Type</label>
                                <select id="toggle_select" name="jd_from" class="form-control mb-3 mb-lg-0" required>
                                    <option value="" class="dark:bg-slate-700">Select Option</option>
                                    <option value="1" class="dark:bg-slate-700">Custom JD</option>
                                    <option value="2" class="dark:bg-slate-700">Master JD</option>
                                    <option value="3" class="dark:bg-slate-700">Saved JD</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">

                        <div class="fv-row mb-7 fv-plugins-icon-container existing_selects_sector_department col-lg-6">
                            <label for="job_desc" class="fw-semibold fs-6 mb-2">Business Unit<span class="red-text">*</span></label>
                            <select id="business_unit" name="business_unit_id" class="form-control" required>
                                <option value="">Select Business Unit</option>
                                @foreach($businessUnits as $unit)
                                    <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                @endforeach
                            </select>
                        </div>    
                        <div class="fv-row mb-7 fv-plugins-icon-container existing_selects_sector_department col-lg-6">
                            <label for="job_desc" class="fw-semibold fs-6 mb-2">Company/Division</label>
                            <select id="division" name="division_id" class="form-control" disabled required>
                                <option value="">Select Company/Division</option>
                            </select>
                        </div>    
                        <div class="fv-row mb-7 fv-plugins-icon-container existing_selects_sector_department col-lg-12">
                            <label for="job_desc" class="fw-semibold fs-6 mb-2">Department</label>    
                            <select id="department_id" name="org_department" class="form-control" disabled required>
                                <option value="">Select Department</option>
                            </select>
                        </div>
                            


                            <div class="fv-row mb-7 fv-plugins-icon-container existing_selects_sector col-lg-12">
                                <label for="job_desc" class="fw-semibold fs-6 mb-2">Sector</label>
                                <select id="department" class="form-control mb-3 mb-lg-0 select-department" name="sector_id"
                                    required>
                                    <option value="" class="dark:bg-slate-700">Select Sector</option>
                                    @foreach ($data as $key1 => $value1)
                                        <option value="{{ $value1 }}" class="dark:bg-slate-700">{{ $key1 ?? '-' }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
        
                                {{-- <div class="fv-row mb-7 fv-plugins-icon-container col-lg-12">
                                    <label for="job_desc" class="fw-semibold fs-6 mb-2">Department</label>
                                    <select id="org_department_filter" class="form-control mb-3 mb-lg-0"
                                        name="org_department_filter" required>
                                        <option value="" class="dark:bg-slate-700">Select Department
                                        </option>
                                        @foreach ($orgDepartments as $key2 => $value2)
                                            <option value="{{ $value2->id }}" class="dark:bg-slate-700">
                                                {{ $value2->name ?? '-' }}</option>
                                        @endforeach
                                    </select>
                                </div> --}}
        
                                
        
                            <div class="fv-row mb-7 fv-plugins-icon-container col-lg-12 existing_selects">
                                <label for="job_desc" class="fw-semibold fs-6 mb-2">Job Description</label>
                                <select id="job_desc" class="form-control select-job mb-3 mb-lg-0"
                                    name="job_type">
                                    <option value="" class="dark:bg-slate-700">Select Job Description</option>
        
                                </select>
                            </div>
        
        
        
        
                            <div class="fv-row mb-7 fv-plugins-icon-container col-lg-12">
                                <label for="job_role" class="fw-semibold fs-6 mb-2">Job Position<span class="red-text">*</span></label>
                                <input id="job_role" type="text" class="form-control mb-3 mb-lg-0" name="title"
                                    placeholder="Job Role">

                                    <div class="custom-toggle-wrapper">
                                        <div class="custom-toggle">
                                            <input type="checkbox" id="is_top_position" name="is_top">
                                            <label for="is_top_position">Set as Top Position in Org Chart</label>
                                        </div>
                                    
                                        <div class="divider"></div>
                                    
                                        <div class="custom-toggle">
                                            <input type="checkbox" id="is_critical_position" name="is_critical">
                                            <label for="is_critical_position">Mark as Critical Job Position</label>
                                        </div>
                                    </div>
                                        
        
                            </div>
                            
                            
        
        
                        </div>
        
                        <div class="row" id="riasec-block">
                            <div class="fv-row mb-7 fv-plugins-icon-container col-lg-8">
                                <label for="riasec" class="fw-semibold fs-6 mb-2">Select Riasec</label>
                                <select id="riasec" class="form-select mb-3 mb-lg-0" data-control="select2"
                                    data-close-on-select="false" name="riasec[]" data-placeholder="Select Riasec" multiple
                                    required>
                                    <option value="" class="dark:bg-slate-700">Select Riasec</option>
                                    @foreach (config('constants.RIASEC_CODES') as $key24 => $value24)
                                        <option value="{{ $value24 }}" class="dark:bg-slate-700">
                                            {{ $key24 . '(' . $value24 . ')' ?? '-' }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="fv-row mb-7 fv-plugins-icon-container col-lg-4">
                                <label for="riasec" class="fw-semibold fs-6 mb-2 text-white">Select Riasec</label>
                                <button id="generate-riasec" type="button" class="btn btn-primary">Generate Riasec Using Job
                                    Role</button>
                            </div>
                        </div>


                        <div class="row">
                        
                            <div class="fv-row mb-7 fv-plugins-icon-container col-lg-12">
                                <label for="superior" class="fw-semibold fs-6 mb-2">Select Superior</label>
                                <select id="superior" name="superior" class="form-control" >
                                    <!-- Leave options empty to be loaded via AJAX -->
                                </select>
                            </div> 
                    
                        </div>
        
        
                        <div class="row">
        
                                <div class="fv-row mb-3 fv-plugins-icon-container col-lg-6">
                                    <label for="heads" class="fw-semibold fs-6 mb-2">Select Position Level<span class="red-text">*</span></label>
                                    <select id="level-job" class="form-control mb-3" name="level" onchange="updatePositionCode()">
                                        @foreach(config('constants.LEVELS') as $value => $label)
                                        <option 
                                            value="{{ $value }}" 
                                            class="dark:bg-slate-700">
                                            {{ $label }}
                                        </option>
                                        @endForeach
                                    </select>
                                </div>
                                <div class="fv-row mb-7 fv-plugins-icon-container col-lg-6">
                                    <label for="position_code" class="fw-semibold fs-6 mb-2">Position Code<span class="red-text">*</span></label>
                                    <input id="position_code" type="text" min="1" class="form-control mb-3 mb-lg-0"
                                        name="position_code" placeholder="Position Code" required>
            
                                    <input type="hidden" id="job_draft_id" name="job_draft_id" value="">    
                                </div>
        
                        </div>
        
        
                        <div class="fv-row mb-7 fv-plugins-icon-container col-lg-12 p-0">
                            <label for="job_role_desc" class="fw-semibold fs-6 mb-2">Job Role Description</label>
                            <textarea id="job_role_desc" rows="5" name="description" class="form-control mb-3 mb-lg-0"
                                placeholder="Type Here"></textarea>
        
                        </div>
                    </div>
                </div>


               
                <div class="card card-bordered shadow-sm mb-4" id="headcount-card">
                    <div class="card-header">
                        <h3 class="card-title">Headcount Management (<span id="headcount-count">1</span>)</h3>
                    </div>
                
                    <div class="card-body" id="headcount-container">
                        {{-- Auto-generated Headcount Row --}}
                        <div class="row headcount-item mb-3 align-items-center" data-index="0" data-default="true">
                            <div class="col-lg-2">
                                <label class="form-label">Headcount Number</label>
                                <span class="form-control-plaintext">1</span>
                            </div>
                            <div class="col-lg-3">
                                <label class="form-label">Headcount ID</label>
                                <input type="text" class="form-control" name="headcounts[0][id]" placeholder="Enter a position code." required disabled />
                            </div>
                            <div class="col-lg-3">
                                <label class="form-label">Employee</label>
                                <input type="text" class="form-control" name="headcounts[0][employee]" placeholder="Enter a position code." required disabled />
                            </div>
                            <div class="col-lg-3">
                                <label class="form-label">Superior Headcount ID <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="headcounts[0][superior]" placeholder="Enter a position code." required disabled />
                            </div>
                            <div class="col-lg-1 d-flex align-items-end justify-content-end">
                                <button type="button" class="btn btn-icon btn-sm btn-light-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Auto-generated headcount. Remove the JD to delete it." disabled>
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                
                    <div class="card-footer pt-2">
                        <button type="button" class="btn btn-light-primary" id="add-headcount-btn">
                            + Add Headcount
                        </button>
                    </div>
                </div>
                
                
                

                <div class="card shadow-sm mb-4">
                    <div class="card-header">
                        <h3 class="card-title">Job Qualifications</h3>
                    </div>
                    <div class="card-body">
                        <div class="fv-row mb-7 row fv-plugins-icon-container col-lg-12 p-0">
                            @php
                                $education_levels = \App\Models\MasterEducationLevel::all();
                                $higher_learning_institutions = \App\Models\MasterHigherLearningInstitution::all();
                                $edu_program = \App\Models\MasterScopeOfStudy::all();
                            @endphp
                            <div class="input-area col-xl-4">
                                <label for="select" class="form-label">Select Education Level</label>
                                <select id="education_level" class="form-control" name="education_level">
                                    @foreach ($education_levels as $education_level)
                                        <option value="{{ $education_level->id }}" class="dark:bg-slate-700">
                                            {{ $education_level->name ?? '' }}</option>
                                    @endforeach
                                </select>
                                @error('education_level')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="input-area col-xl-4">
                                <label for="select" class="form-label">Select Scope of Study</label>
                                <select id="scope_of_study" class="form-control" name="scope_of_study">
                                    @foreach ($edu_program as $scope_of_study)
                                        <option value="{{ $scope_of_study->id }}" class="dark:bg-slate-700">
                                            {{ $scope_of_study->name ?? '' }}</option>
                                    @endforeach
                                </select>
                                @error('scope_of_study')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="input-area col-xl-4">
                                <label for="secondary_scope_of_study" class="fw-semibold fs-6 mb-2">Secondary Scope of
                                    Study</label>
                                <select id="secondary_scope_of_study" class="form-select mb-3 mb-lg-0"
                                    data-control="select2" data-close-on-select="false" name="secondary_scope_of_study[]"
                                    data-placeholder="Enter Secondary Scope of Study" multiple>
                                    <option value="" class="dark:bg-slate-700">Enter Secondary Scope of Study</option>

                                </select>
                                @error('secondary_scope_of_study')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>



                            <div class="input-area col-lg-4 m">
                                <div class="mt-5">
                                    <label class="form-label">Relevant Professional Certificates</label>
                                    <input class="form-control" type="text" value=""
                                        id="kt_tagify_1" name="professional_certificate" id="kt_tagify_1" />
                                </div>
                            </div>

                            <div class="input-area col-lg-4">
                                <div class="mt-5">
                                    <label class="form-label">Relevant Training Programs</label>
                                    <input class="form-control" value=""
                                        name="relevant_training" type="text" id="kt_tagify_2" />
                                </div>
                            </div>

                            <div class="input-area col-xl-4 mt-5">
                                <label class="form-label" for="work_experience">Experience in Relevant Sector</label>
                                <select class="form-control" id="work_experience"
                                    name="work_experience">
                                    <option value="0-1">0-1 years</option>
                                    <option value="1-3">1-3 years</option>
                                    <option value="3-5">3-5 years</option>
                                    <option value="5-7">5-7 years</option>
                                    <option value="7-10">7-10 years</option>
                                    <option value="10+">10+ years</option>
                                </select>

                                @error('work_experience')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card shadow-sm mb-4">
                    <div class="card-header">
                        <h3 class="card-title">
                            Critical Work Functions
                        </h3>
                    </div>
                    <div class="card-body padding-card">
                        <div class="row">
                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                <div class="critical-functions-container">
                                    <!-- Dynamic content will be inserted here -->
                                </div>
                                <button type="button" id="add_new_function" class="btn btn-primary mt-2">Add New
                                    Function</button>
                                <div id="validationMessage" style="color: red; display: none;">Atlest one Critical Work
                                    Function
                                    is required.</div>
                                <!-- Add more fields for critical functions here -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card shadow-sm mb-4">
                    <div class="card-header">
                        <h3 class="card-title">
                            Performance Expectation (For legislated / regulated
                            occupations)
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                        </div>
                        <div class="fv-row mb-7 fv-plugins-icon-container">
                            <select id="perfomance_expectation" class="form-select mb-3 mb-lg-0 select2-hidden-accessible"
                                data-control="select2" data-close-on-select="false" name="perfomance_expectation[]"
                                data-placeholder="Enter perfomance expectation" multiple>
                                <option value="" class="dark:bg-slate-700">Enter Performance Expectation</option>

                            </select>
                        </div>
                    </div>
                </div>
                <div class="card shadow-sm mb-4">
                    <div class="card-header">
                        <h3 class="card-title">Technical Skills</h3>
                    </div>
                    <div class="card-body">
                        <div id="skills-container" class="row mb-3"></div>
                        <button type="button" id="add_new_skill" class="btn btn-primary">Add New Skill</button>
                        <div id="techvalidationmessage" style="color: red; display: none;">Atlest One Technical Skill is
                            required.</div>
                    </div>
                </div>
                <div class="card shadow-sm mb-4">
                    <div class="card-header">
                        <h3 class="card-title">Generic Skills & Competencies</h3>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="fv-row mb-5 fv-plugins-icon-container col-lg-5">
                                <select id="skill[0]" class="form-control mb-3" onchange="skillChanged(0, this.value)"
                                    name="skills[0][title]">
                                    <option value="">Select Generic Skill</option>
                                    @foreach ($masterSkills as $key => $value)
                                        <option value="{{ $value->name }}" class="dark:bg-slate-700">
                                            {{ $value->name }}
                                        </option>
                                    @endforeach
                                </select>


                            </div>
                            <div class="fv-row mb-5 fv-plugins-icon-container col-lg-5">

                                <select id="level[0]" class="form-control mb-3" name="skills[0][level]">
                                    <option value="3" class="dark:bg-slate-700">Level 3</option>
                                    <option value="2" class="dark:bg-slate-700">Level 2</option>
                                    <option value="1" class="dark:bg-slate-700">Level 1</option>
                                </select>
                            </div>
                            <div class="fv-row mb-3 fv-plugins-icon-container col-lg-2">

                                <button type="button" id="selectLevelButton0" class="btn btn-primary"
                                    data-bs-toggle="modal" data-bs-target="#kt_modal_2"
                                    onclick="populateModal('0', '1', 'title', 'level_1', 'level_2', 'level_3', 'selectedlevel')">
                                    Select Level
                                </button>
                            </div>

                        </div>

                        <div class="row mb-3">
                            <div class="fv-row mb-5 fv-plugins-icon-container col-lg-5">

                                <select id="skill[1]" class="form-control mb-3" onchange="skillChanged(1, this.value)"
                                    name="skills[1][title]">
                                    <option value="">Select Generic Skill</option>
                                    @foreach ($masterSkills as $key => $value)
                                        <option value="{{ $value->name }}" class="dark:bg-slate-700">
                                            {{ $value->name }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="fv-row mb-5 fv-plugins-icon-container col-lg-5">

                                <select id="level[1]" class="form-control mb-3" name="skills[1][level]">


                                    <option value="3" class="dark:bg-slate-700">Level 3</option>
                                    <option value="2" class="dark:bg-slate-700">Level 2</option>
                                    <option value="1" class="dark:bg-slate-700">Level 1</option>
                                </select>
                            </div>

                            <div class="fv-row mb-3 fv-plugins-icon-container col-lg-2">

                                <button type="button" id="selectLevelButton1" class="btn btn-primary"
                                    data-bs-toggle="modal" data-bs-target="#kt_modal_2"
                                    onclick="populateModal('1', '1', 'title', 'level_1', 'level_2', 'level_3', 'selectedlevel')">
                                    Select Level
                                </button>
                            </div>

                        </div>

                        <div class="row mb-3">
                            <div class="fv-row mb-5 fv-plugins-icon-container col-lg-5">

                                <select id="skill[2]" onchange="skillChanged(2, this.value)" class="form-control mb-3"
                                    name="skills[2][title]">

                                    <option value="">Select Generic Skill</option>
                                    @foreach ($masterSkills as $key => $value)
                                        <option value="{{ $value->name }}" class="dark:bg-slate-700">
                                            {{ $value->name }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="fv-row mb-5 fv-plugins-icon-container col-lg-5">

                                <select id="level[2]" class="form-control mb-3" name="skills[2][level]">


                                    <option value="3" class="dark:bg-slate-700">Level 3</option>
                                    <option value="2" class="dark:bg-slate-700">Level 2</option>
                                    <option value="1" class="dark:bg-slate-700">Level 1</option>
                                </select>
                            </div>
                            <div class="fv-row mb-3 fv-plugins-icon-container col-lg-2">

                                <button type="button" id="selectLevelButton2" class="btn btn-primary"
                                    data-bs-toggle="modal" data-bs-target="#kt_modal_2"
                                    onclick="populateModal('2', '1', 'title', 'level_1', 'level_2', 'level_3', 'selectedlevel')">
                                    Select Level
                                </button>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="fv-row mb-5 fv-plugins-icon-container col-lg-5">

                                <select id="skill[3]" onchange="skillChanged(3, this.value)" class="form-control mb-3"
                                    name="skills[3][title]">

                                    <option value="">Select Generic Skill</option>
                                    @foreach ($masterSkills as $key => $value)
                                        <option value="{{ $value->name }}" class="dark:bg-slate-700">
                                            {{ $value->name }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="fv-row mb-5 fv-plugins-icon-container col-lg-5">

                                <select id="level[3]" class="form-control mb-3" name="skills[3][level]">


                                    <option value="3" class="dark:bg-slate-700">Level 3</option>
                                    <option value="2" class="dark:bg-slate-700">Level 2</option>
                                    <option value="1" class="dark:bg-slate-700">Level 1</option>
                                </select>
                            </div>
                            <div class="fv-row mb-3 fv-plugins-icon-container col-lg-2">

                                <button type="button" id="selectLevelButton3" class="btn btn-primary"
                                    data-bs-toggle="modal" data-bs-target="#kt_modal_2"
                                    onclick="populateModal('3', '1', 'title', 'level_1', 'level_2', 'level_3', 'selectedlevel')">
                                    Select Level
                                </button>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="fv-row mb-5 fv-plugins-icon-container col-lg-5">

                                <select id="skill[4]" onchange="skillChanged(4, this.value)" class="form-control mb-3"
                                    name="skills[4][title]">

                                    <option value="">Select Generic Skill</option>
                                    @foreach ($masterSkills as $key => $value)
                                        <option value="{{ $value->name }}" class="dark:bg-slate-700">
                                            {{ $value->name }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="fv-row mb-5 fv-plugins-icon-container col-lg-5">

                                <select id="level[4]" class="form-control mb-3" name="skills[4][level]">


                                    <option value="3" class="dark:bg-slate-700">Level 3</option>
                                    <option value="2" class="dark:bg-slate-700">Level 2</option>
                                    <option value="1" class="dark:bg-slate-700">Level 1</option>
                                </select>
                            </div>
                            <div class="fv-row mb-3 fv-plugins-icon-container col-lg-2">

                                <button type="button" id="selectLevelButton4" class="btn btn-primary"
                                    data-bs-toggle="modal" data-bs-target="#kt_modal_2"
                                    onclick="populateModal('4', '1', 'title', 'level_1', 'level_2', 'level_3', 'selectedlevel')">
                                    Select Level
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card  shadow-sm mb-4">
                    <div class="card-header">
                        <h3 class="card-title">Review Status</h3>
                    </div>
                    <div class="card-body">
                        <div class="col-lg-4">
                            <label for="job_role_desc" class="fw-semibold fs-6 mb-2">Select Status</label>
                            <select id="status" name="status" class="form-control mb-3 mb-lg-0" required
                                data-control="select2" data-placeholder="Select the Sector">
                                <option></option>
                                <option value="2" class="dark:bg-slate-700" selected>Approved</option>
                                <option value="1" class="dark:bg-slate-700">Pending</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="card shadow-sm mb-4">
                    <div class="card-header">
                        <h3 class="card-title"> Submit Job Create?</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-8 col-lg-4 d-flex">
                            <button type="submit" id="validateButton"
                                class="align-items-center btn btn-primary d-flex justify-content-center">Submit</button>
                            <a href="{{ route('jobs.index') }}"
                                class="align-items-center btn btn-danger ml-3 d-flex justify-content-center">
                                <iconify-icon icon="gg:trash"></iconify-icon>
                                Discard
                            </a>
                        </div>
                    </div>
                </div>
                <div id="other_fields">
                </div>
            </form>
        </div>

    </div>



    {{-- Generic Skill Modal Start --}}
    <div class="modal bg-body fade" tabindex="-1" id="kt_modal_2">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content shadow-none">
                <div class="modal-header">
                    <h5 class="modal-title">Communication</h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">

                        <iconify-icon icon="line-md:close" class=" fs-2x"></iconify-icon>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body">
                    <div class="row g-5 modalbody">
                        <div class="col-lg-4">
                            <div class="card card-stretch card-bordered mb-5">
                                <div class="card-header">
                                    <h3 class="card-title">Level 1</h3>
                                </div>
                                <div class="card-body">
                                    Description Not Found
                                </div>
                                {{-- <div class="card-footer">
                                Footer
                            </div> --}}
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="card card-stretch card-bordered mb-5">
                                <div class="card-header">
                                    <h3 class="card-title">Level 2</h3>
                                </div>
                                <div class="card-body">
                                    Description Not Found
                                </div>
                                {{-- <div class="card-footer">
                                Footer
                            </div> --}}
                            </div>

                        </div>

                        <div class="col-lg-4">
                            <div class="card card-stretch card-bordered mb-5">
                                <div class="card-header">
                                    <h3 class="card-title">Level 3</h3>
                                </div>
                                <div class="card-body">
                                    Description Not Found
                                </div>
                                {{-- <div class="card-footer">
                                Footer
                            </div> --}}
                            </div>

                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                    <button type="button" class="btn btn-primary save-btn" data-bs-dismiss="modal"
                        onclick="updateSkillLevel(this)">Save changes</button>

                </div>
            </div>
        </div>
    </div>
    {{-- Generic Skill Modal End --}}

    {{-- Technical Skill Modal Start --}}
    <div class="modal bg-body fade" tabindex="-1" id="techskillmodal">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content shadow-none">
                <div class="modal-header">
                    <h5 class="modal-title">Communication</h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">

                        <iconify-icon icon="line-md:close" class=" fs-2x"></iconify-icon>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body">
                    <div class="row g-5 modalbody">
                        <div class="col-lg-4">
                            <div class="card card-stretch card-bordered mb-5">
                                <div class="card-header">
                                    <h3 class="card-title">Level 1</h3>
                                </div>
                                <div class="card-body">
                                    Description Not Found
                                </div>
                                {{-- <div class="card-footer">
                                Footer
                            </div> --}}
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="card card-stretch card-bordered mb-5">
                                <div class="card-header">
                                    <h3 class="card-title">Level 2</h3>
                                </div>
                                <div class="card-body">
                                    Description Not Found
                                </div>
                                {{-- <div class="card-footer">
                                Footer
                            </div> --}}
                            </div>

                        </div>

                        <div class="col-lg-4">
                            <div class="card card-stretch card-bordered mb-5">
                                <div class="card-header">
                                    <h3 class="card-title">Level 3</h3>
                                </div>
                                <div class="card-body">
                                    Description Not Found
                                </div>
                                {{-- <div class="card-footer">
                                Footer
                            </div> --}}
                            </div>

                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                    <button type="button" class="btn btn-primary save-btn" data-bs-dismiss="modal"
                        onclick="updateTechSkillLevel(this)">Save changes</button>

                </div>
            </div>
        </div>
    </div>
    {{-- Technical Skill Modal End --}}

@endsection



@section('scripts')
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script> --}}

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script> --}}
    <script>
        // The DOM elements you wish to replace with Tagify
        var input1 = document.querySelector("#kt_tagify_1");
        var input2 = document.querySelector("#kt_tagify_2");

        var input3 = document.querySelector("#kt_tagify_3");

        // Initialize Tagify components on the above inputs
        new Tagify(input1);
        new Tagify(input2);
        new Tagify(input3);
    </script>

    <script>
        $(document).ready(function() {
            $('#technicalSkills').select2();
            // $('#superior').select2();


            $('#job_description_form').submit(function(event) {
                var job_desc = $('#job_desc').val();
                var heads = $('#heads').val();
                var position_code = $('#position_code').val();
                var job_role = $('#job_role').val();
                var job_role_desc = $('#job_role_desc').val();
                var isValid = true;



                // Simple validation checks
                if (job_role_desc === '') {
                    $('#job_role_desc').next('.error').remove();
                    $('#job_role_desc').after(
                        '<span class="error">Job Role Description is required</span>');
                    isValid = false;
                } else {
                    $('#job_role_desc').next('.error').remove();
                }

                if (job_role === '') {
                    $('#job_role').next('.error').remove();
                    $('#job_role').after('<span class="error">Job Role is required</span>');
                    isValid = false;
                } else {
                    $('#job_role').next('.error').remove();
                }

                if (heads === '') {
                    $('#heads').next('.error').remove();
                    $('#heads').after('<span class="error">Job Role is required</span>');
                    isValid = false;
                } else {
                    $('#heads').next('.error').remove();
                }


                if ($('.critical-functions-container').find('.critical-function').length === 0) {
                    $('#validationMessage').show();
                    isValid = false;
                } else {
                    $('#validationMessage').hide();
                }

                if ($('#skills-container').find('.technical-skill').length === 0) {
                    $('#techvalidationmessage').show();
                    isValid = false;
                } else {
                    $('#techvalidationmessage').hide();
                }

                if (position_code === '') {
                    $('#position_code').next('.error').remove();
                    $('#position_code').after('<span class="error">Position Code is required</span>');
                    isValid = false;
                } else {
                    $('#position_code').next('.error').remove();
                }


                // Check uniqueness of position code
                if (isValid) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('check-position-code') }}",
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            position_code: position_code
                        },
                        async: false,
                        success: function(response) {
                            if (!response.isUnique) {
                                $('#position_code').next('.error').remove();
                                $('#position_code').after(
                                    '<span class="error">Position Code must be unique</span>'
                                );
                                isValid = false;
                            } else {
                                $('#position_code').next('.error').remove();
                            }
                        }
                    });
                }

                // Validate generic skills
                var selectedSkills = [];
                var skillsValid = true;
                var firstInvalidSkillElement = null;

                $('select[name^="skills["][name$="[title]"]').each(function() {
                    var skillValue = $(this).val();
                    if (skillValue !== "") {
                        if (selectedSkills.includes(skillValue)) {
                            $(this).next('.error').remove();
                            $(this).after('<span class="error">Duplicate Skill Selected</span>');
                            skillsValid = false;
                            if (!firstInvalidSkillElement) {
                                firstInvalidSkillElement = $(this);
                            }
                        } else {
                            selectedSkills.push(skillValue);
                            $(this).next('.error').remove();
                        }
                    }
                });

                if (selectedSkills.length === 0) {
                    $('select[name^="skills["][name$="[title]"]').first().next('.error').remove();
                    $('select[name^="skills["][name$="[title]"]').first().after(
                        '<span class="error">At least one skill must be selected</span>');
                    skillsValid = false;
                    firstInvalidSkillElement = $('select[name^="skills["][name$="[title]"]').first();
                }

                if (!skillsValid) {
                    isValid = false;
                }



                // Validate technical skills
                var selectedTechnicalSkills = [];
                var technicalSkillsValid = true;
                var firstInvalidTechnicalSkillElement = null;

                $('select[name^="technicalSkills["][name$="[id]"]').each(function() {
                    var techSkillValue = $(this).val();
                    if (techSkillValue !== "") {
                        if (selectedTechnicalSkills.includes(techSkillValue)) {
                            $(this).next('.error').remove();
                            $(this).after(
                                '<span class="error">Duplicate Technical Skill Selected</span>');
                            technicalSkillsValid = false;
                            if (!firstInvalidTechnicalSkillElement) {
                                firstInvalidTechnicalSkillElement = $(this);
                            }
                        } else {
                            selectedTechnicalSkills.push(techSkillValue);
                            $(this).next('.error').remove();
                        }
                    }
                });

                if (selectedTechnicalSkills.length === 0) {
                    $('select[name^="technicalSkills["][name$="[id]"]').first().next('.error').remove();
                    $('select[name^="technicalSkills["][name$="[id]"]').first().after(
                        '<span class="error">At least one technical skill must be selected</span>');
                    technicalSkillsValid = false;
                    firstInvalidTechnicalSkillElement = $('select[name^="technicalSkills["][name$="[id]"]')
                        .first();
                }

                if (!technicalSkillsValid) {
                    isValid = false;
                }



                // Prevent the form submission if validation fails
                if (!isValid) {
                    event.preventDefault();
                    scrollToFirstErrorField();
                }
            });

            function scrollToFirstErrorField() {
                var firstErrorField = $(
                    '.error:visible, #validationMessage:visible, #techvalidationmessage:visible').first().prev(
                    'input, textarea, select, button');
                if (firstErrorField.length) {
                    $('html, body').animate({
                        scrollTop: firstErrorField.offset().top - 100 // Adjust the offset as needed
                    }, 500);
                    firstErrorField.focus();
                }
            }

            function scrollToElement(element) {
                $('html, body').animate({
                    scrollTop: element.offset().top - 100 // Adjust the offset to scroll more up
                }, 500);
                element.focus();
            }
        });

        $(document).ready(function() {
            var technicalSkills = [];
            var index1 = 0;
            // Handler when a job is selected
            $('.select-job').on('change', function() {
                var savedJob = $('#toggle_select').val();

                if (this.value) {
                    var ajaxUrl = "primary/job/select";
                    var formData = {
                        "_token": "{{ csrf_token() }}",
                        "id": this.value,
                        "savedJob": savedJob
                    };

                    $.ajax({
                        url: ajaxUrl,
                        data: formData,
                        method: "POST",
                        success: function(data) {
                            console.log(data);
                            $('#job_role').val(data.job.title);
                            $('#job_role_desc').val(data.job.description);

                            // Populate existing skills
                            $.each(data.job.skills, function(index, skill) {

                                console.log('data response', data);

                                $('select[name="skills[' + index + '][title]"]').val(
                                    skill.title);
                                $('select[name="skills[' + index + '][level]"]').val(
                                    skill.level);
                                let selectLevelButton = $(`#selectLevelButton${index}`);
                                if (skill.level_1 && skill.level_1.length > 0) {

                                    selectLevelButton.show();

                                    // Update the onclick event with new data
                                    // selectLevelButton.attr("onclick", `populateModal('${index}', '${data}', '${skill.title}','${skill.level}')`);
                                    selectLevelButton.attr("onclick",
                                        `populateModal('${index}', '${escapeSpecialCharacters(JSON.stringify(skill))}', '${skill.title}','${skill.level}')`
                                    );
                                } else {
                                    selectLevelButton.hide();
                                }

                            });

                            // Handle technical skills
                            var skills = data.technicalSkills;

                            technicalSkills = data.technicalSkills;
                            // $('#technicalSkills').empty();


                            $('#skills-container').empty();
                            var skillId = [];
                            // $.each(skills, function(key, value) {
                            //     $('#technicalSkills').append($('<option>', {
                            //         value: value['id'],
                            //         text: value['name'],
                            //         class: 'inline-block font-Inter font-normal text-sm text-slate-600'
                            //     }));
                            //     skillId.push(value['id']);
                            // });

                            // $('#technicalSkills').select2(); // Reinitialize Select2
                            // $('#technicalSkills').val(Object.values(skillId)).trigger('change');

                            // setTimeout(function() {
                            //     var select2Instance = $('#technicalSkills').data('select2');
                            //     if (select2Instance) {
                            //         select2Instance.$container.addClass('force-redraw').removeClass('force-redraw');
                            //     }
                            // }, 100);

                            // Populate critical functions
                            $('.critical-functions-container').empty();
                            $.each(data.job.critical_functions, function(index, func) {
                                addCriticalFunction(index,
                                    func); // Add each critical function
                            });

                            //$.each(data.technicalSkills, function(index, func) {
                            //addTechnicalSkill(index, technicalSkills); // Add each critical function
                            //});

                            data.job.technical_skills.forEach(function(skill, index) {
                                index1++;



                                // Create a skill select element
                                var skillSelect = $('<select>', {
                                    id: 'skill[' + index + ']',
                                    name: 'technicalSkills[' + index + '][id]',
                                    class: 'form-control mb-3 mb-lg-0 select-skill'

                                });

                                // Add an option for the skill
                                skillSelect.append($('<option>', {
                                    value: skill.id,
                                    text: skill.name
                                }));

                                // Create a level select element
                                var levelSelect = $('<select>', {
                                    id: 'level[' + index + ']',
                                    name: 'technicalSkills[' + index +
                                        '][level]',
                                    class: 'form-control mb-3 mb-lg-0'
                                });



                                // Add options for levels (1 to 6)
                                for (var level = 1; level <= 6; level++) {
                                    levelSelect.append($('<option>', {
                                        value: level,
                                        text: 'Level ' + (level),
                                        selected: skill.pivot.level == level
                                    }));
                                }

                                var removeButton = $('<button>', {
                                    type: 'button',
                                    class: 'btn btn-danger remove-skill',
                                    text: 'Remove'
                                });

                                // var removeCol = $('<div>', {
                                //     class: 'col-lg-1'
                                // }).append(removeButton);


                                let technicalskill = [];
                                data.mastertechnicalskill.forEach(function(mst, index) {
                                    if (mst.id === skill.id) {
                                        technicalskill = mst
                                    }
                                })

                                console.log('mastertechnical', technicalskill)
                                var popupButton = $('<button>', {
                                    type: 'button',
                                    id: `selectTechLevelButton${index}`, // Replace `index` with the appropriate variable
                                    class: 'btn btn-primary me-5',
                                    'data-bs-toggle': 'modal',
                                    'data-bs-target': '#techskillmodal',
                                    text: 'Select Level',
                                    onclick: `technicalpopulateModal('${index}','${escapeSpecialCharacters(JSON.stringify(skill))}','${skill.name}','${skill.pivot.level}')`
                                });


                                var popupbuttoncol = $('<div>', {
                                    class: 'col-lg-3'
                                }).append(popupButton).append(removeButton);

                                // Append the selects to a new row in the container
                                var skillRow = $('<div>', {
                                    class: 'technical-skill row mb-3'
                                });

                                $('#skills-container').append(skillRow.append(
                                    $('<div>', {
                                        class: 'fv-row mb-5 fv-plugins-icon-container col-lg-5'
                                    }).append(skillSelect), $('<div>', {
                                        class: 'fv-row mb-5 fv-plugins-icon-container col-lg-4'
                                    }).append(levelSelect), popupbuttoncol
                                ));

                                $('.select-skill').on('change', function() {
                                    updateSkillSelections();
                                });
                                updateSkillSelections();

                                // Create a new hidden input element



                            });


                            // Create a new hidden input element
                            var hiddenInput1 = document.createElement("input");
                            hiddenInput1.type = "hidden";
                            hiddenInput1.name =
                                "top3riasec"; // Set the name attribute (adjust as needed)
                            hiddenInput1.value = data.job
                                .top3riasec; // Set the value attribute (adjust as needed)

                            // var hiddenInput2 = document.createElement("input");
                            // hiddenInput2.type = "hidden";
                            // hiddenInput2.name = "level"; // Set the name attribute (adjust as needed)
                            // hiddenInput2.value = data.job.level; // Set the value attribute (adjust as needed)

                            // Select the div with ID 'other_fields'
                            var targetDiv = document.getElementById("other_fields");

                            // Clear the existing contents of the div
                            targetDiv.innerHTML = '';

                            // Append the new hidden input to the div
                            targetDiv.appendChild(hiddenInput1);
                            // targetDiv.appendChild(hiddenInput2);
                        },
                        error: function(data) {
                            console.error("Error loading job data: ", data);
                        }
                    });
                }
            });

            // Function to add a critical function dynamically
            function addCriticalFunction(index, func) {
                var functionHtml = `
                <div class="critical-function row mb-3">
                    <div class="accordion accordion-icon-collapse col-lg-10" id="kt_accordion_3">
                        <div class="mb-5">
                            <div class="accordion-header collapsed py-3 d-flex" data-bs-toggle="collapse" data-bs-target="#kt_accordion_3_item_${index}">
                                <span class="accordion-icon">
                                    <iconify-icon icon="noto-v1:plus" class="accordion-icon-off fs-3 me-3"></iconify-icon>
                                    <iconify-icon icon="noto-v1:minus" class="accordion-icon-on fs-3 me-3"></iconify-icon>
                                </span>
                                <input type="hidden" name="functions[${index}][id]" value="${func ? func.id : ''}">
                                <input type="text" class="form-control mb-3 mb-lg-0" name="functions[${index}][title]" placeholder="Critical Work Functions" value="${func ? func.description : ''}" required>
                            </div>
                            <div id="kt_accordion_3_item_${index}" class="fs-6 collapse ps-10" data-bs-parent="#kt_accordion_3">
                                <select id="function_keys_${index}" class="function-keys form-control mb-3" name="functions[${index}][keys][]" multiple="multiple"></select>
                            </div>
                        </div>
                    </div>
                    <div class="fv-row mb-5 fv-plugins-icon-container col-lg-2" style="margin-top: 8px;">
                        <button type="button" class="btn btn-danger remove-function" title="Remove function">Remove</button>
                    </div>
                </div>
            `;

                $('.critical-functions-container').append(functionHtml);

                var select = $(`#function_keys_${index}`);
                if (func && func.cwf_keys) {
                    $.each(func.cwf_keys, function(keyIndex, key) {
                        select.append($('<option>', {
                            value: key.name,
                            text: key.name,
                            selected: true
                        }));
                    });
                }

                select.select2({
                    tags: true

                        ,
                    createTag: function(params) {
                        if (params.term.trim() === "") {
                            return null; // Prevent blank tags
                        }
                        return {
                            id: params.term,
                            text: params.term,
                            newOption: true
                        };
                    }
                });
            }

            // Add new function dynamically with an empty form
            $('#add_new_function').click(function() {
                var newIndex = $('.critical-functions-container .critical-function')
                    .length; // Find the next index
                addCriticalFunction(newIndex); // Add function without passing any specific function data
            });

            // Remove function on button click
            $('.critical-functions-container').on('click', '.remove-function', function() {
                $(this).closest('.critical-function').remove();
            });

            function initSelect2(selector) {
                $(selector).select2({

                    ajax: {
                        url: '{{ route('admin.technical-skill.search') }}', // Change to your actual API endpoint
                        dataType: 'json',
                        delay: 250,
                        data: function(params) {
                            return {
                                q: params.term // search term
                            };
                        },
                        processResults: function(data) {
                            return {
                                results: data.results,
                                pagination: {
                                    more: data.pagination.more
                                }
                            };
                        },
                        cache: true
                    },
                    placeholder: 'Search for a skill',
                    minimumInputLength: 1
                });
            }


            function addTechnicalSkill(index, technicalSkills) {
                var skillSelect = $('<select>', {
                    id: 'skill[' + index + ']',
                    name: 'technicalSkills[' + index + '][id]',
                    class: 'form-control mb-3 mb-lg-0 select-skill',
                    onchange: `TechSkillChanged('${index}',this.value)`,
                    'data-control': 'select2',
                    'data-hide-search': 'false',
                    'required': true
                });

                skillSelect.append($('<option>', {
                    value: '',
                    text: "Select Skill"
                }));

                // Populate the skill dropdown
                $.each(technicalSkills, function(key, skill) {
                    skillSelect.append($('<option>', {
                        value: skill.id,
                        text: skill.name
                    }));
                });

                var levelSelect = $('<select>', {
                    id: 'level[' + index + ']',
                    name: 'technicalSkills[' + index + '][level]',
                    class: 'form-control mb-3 mb-lg-0'
                });

                // Options for levels
                for (var level = 1; level <= 6; level++) {
                    levelSelect.append($('<option>', {
                        value: level,
                        text: 'Level ' + (level)
                    }));
                }

                var skillRow = $('<div>', {
                    class: 'technical-skill row mb-3'
                });

                var skillCol = $('<div>', {
                    class: 'fv-row mb-5 fv-plugins-icon-container col-lg-5'
                }).append(skillSelect);

                var levelCol = $('<div>', {
                    class: 'fv-row mb-5 fv-plugins-icon-container col-lg-4'
                }).append(levelSelect);

                var removeButton = $('<button>', {
                    type: 'button',
                    class: 'btn btn-danger remove-skill',
                    text: 'Remove'
                });

                // var removeCol = $('<div>', {
                //     class: 'col-lg-1'
                // }).append(removeButton);


                var popupButton = $('<button>', {
                    type: 'button',
                    id: `selectTechLevelButton${index}`, // Replace `index` with the appropriate variable
                    class: 'btn btn-primary me-5',
                    'data-bs-toggle': 'modal',
                    'data-bs-target': '#techskillmodal',
                    text: 'Select Level',
                    onclick: `technicalpopulateModal('${index}')`
                });

                var popupbuttoncol = $('<div>', {
                    class: 'col-lg-3'
                }).append(popupButton).append(removeButton);



                skillRow.append(skillCol, levelCol, popupbuttoncol);
                $('#skills-container').append(skillRow);

                initSelect2(skillSelect);

                $('.select-skill').on('change', function() {
                    updateSkillSelections();
                });
                updateSkillSelections();



            }



            // Handler when adding new skills
            $('#add_new_skill').click(function() {
                var newIndex = $('.technical-skill').length; // Calculate the new index
                // Assuming you have stored your skills data in some variable `technicalSkills` from an AJAX call
                addTechnicalSkill(newIndex,
                    technicalSkills); // You would need to make sure `technicalSkills` is up to date
            });

            // Removing a skill entry
            $('#skills-container').on('click', '.remove-skill', function() {

                $(this).closest('.technical-skill').remove();
            });


            function updateSkillSelections() {
                var selectedSkills = {};
                $('.select-skill').each(function() {
                    var selected = $(this).val();
                    if (selected) {
                        selectedSkills[selected] = true;
                    }
                });

                $('.select-skill option').each(function() {
                    var optionValue = $(this).val();
                    if (selectedSkills[optionValue]) {
                        if ($(this).parent().val() !== optionValue) {
                            $(this).attr('disabled', 'disabled');
                        } else {
                            $(this).removeAttr('disabled');
                        }
                    } else {
                        $(this).removeAttr('disabled');
                    }
                });
            }

            $('.select-skill').on('change', function() {
                updateSkillSelections();
            });

            var technicalSkills = [];

            // AJAX call and other functionalities
            $('.select-job').on('change', function() {

                // AJAX call to fetch job details and populate dropdowns
                updateSkillSelections
                    (); // Call this function after repopulating the dropdowns to reset the disabled options
            });

            // Other existing functionalities and functions like addCriticalFunction, etc.

            // Initialize updateSkillSelections once to set up the initial state
            updateSkillSelections();



        });



        $(document).ready(function() {
            $('.select-department').on('change', function() {
                var departmentId = $(this).val();

                var ajaxUrl = "by_department";

                if (departmentId) {
                    $.ajax({
                        url: ajaxUrl,
                        method: 'GET',
                        data: {
                            department_id: departmentId
                        },
                        success: function(response) {
                            // Update job descriptions dropdown options based on response
                            var options = '<option value="">Select Job Description</option>';
                            $.each(response, function(key, value) {
                                options += '<option value="' + key + '">' + value +
                                    '</option>';
                            });
                            $('#job_desc').html(options);
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                } else {
                    formReset();
                }
            });
        });
        $(document).ready(function() {
            $('#department_id').on('change', function() {
                const jdType = $('#toggle_select').val(); // 1 = Custom, 2 = Master, 3 = Saved

        // Only trigger AJAX if JD Type is "Saved JD" (value = "3")
                if (jdType !== "3") {
                    return;
                }
                var departmentId = $(this).val();


                var ajaxUrl = "allJobsByOrgDepartmentForJD";

                if (departmentId) {
                    $.ajax({
                        url: ajaxUrl,
                        method: 'GET',
                        data: {
                            department_id: departmentId
                        },
                        success: function(response) {
                            // Update job descriptions dropdown options based on response
                            var options = '<option value="">Select Job Description</option>';
                            $.each(response, function(key, value) {
                                options += '<option value="' + key + '">' + value +
                                    '</option>';
                            });
                            $('#job_desc').html(options);
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                } else {
                    formReset();
                }
            });
        });



        function test() {

        }
    </script>

    <script>
        // function showLevelDescriptors(skillId, skillTitle) {
        //     $.ajax({
        //         url: '/api/skills/' + skillId + '/levels', // API endpoint to fetch levels
        //         type: 'GET',
        //         success: function(data) {
        //             populateModal(skillId, skillTitle, data);
        //         },
        //         error: function(error) {
        //             console.error("Error fetching level descriptors: ", error);
        //         }
        //     });
        // }

        function TechSkillChanged(index, skillName) {
            console.log('technicalskill', skillName)
            $.ajax({
                url: '/admin/get-techskill-levels/' + skillName, // Adjust this URL as necessary
                type: 'GET',
                success: function(data) {
                    console.log('ajaz data', data);

                    let selectLevelButton = $(`#selectTechLevelButton${index}`);
                    if (data) {
                        // Find the "Select Level" button for this skill

                        selectLevelButton.show();


                        let TechSkillName = data[0].name;

                        // Update the onclick event with new data
                        // selectLevelButton.attr("onclick", `populateModal('${index}', '${data.skill_id}', '${skillName}', '${data.level_1}', '${data.level_2}', '${data.level_3}', '1')`);
                        selectLevelButton.attr("onclick",
                            `technicalpopulateModal('${index}', '${escapeSpecialCharacters(JSON.stringify(data[0]))}', '${TechSkillName}','1')`
                        );
                        // Assuming default to level 1 or use current selected level
                    } else {
                        selectLevelButton.hide();

                    }
                },
                error: function(error) {
                    console.error("Error fetching level descriptors for skill:", skillName, error);
                }
            });
        }



        function technicalpopulateModal(index, data, skillTitle, selected_level) {
            console.log('technicalpoopupmodal', data);

            data = JSON.parse(data);

            let modalBody = $('#techskillmodal .modalbody');
            // console.log(selected_level);
            // console.log(level_2);
            modalBody.empty(); // Clear existing modal content


            $('#techskillmodal .modal-title').text(skillTitle);
            // levels.forEach(level => {
            // let selectedLevel = 1 + parseInt(selected_level, 10); 
            let selectedLevel = parseInt(selected_level, 10);
            console.log('updateed selected', selectedLevel);
            for (let i = 1; i <= 6; i++) {
                console.log('descriptor', data['level_' + i + '_description']);

                let knowledge = data['level_' + i + '_knowledge'] || '';

                let ability = data['level_' + i + '_ability'] || '';

                if (data['level_' + i + '_description']) {
                    console.log('in the condition')
                    modalBody.append(`
                <div class="form-check col-lg-2">
                
            
                        <label class="form-check-label h-100 w-100" for="level_1">
                            <div class="col-lg-12 h-100">
                                    <div class="  card card-stretch card-bordered mb-5 h-100">
                                        <div class="card-header align-items-center">
                                            <h3 class="card-title">Level ${i}</h3>
                                            <input class="form-check-input border-dark" type="radio" value="${i}" id="level_${i}" name="level" ${selectedLevel == i ? 'checked' : ''}>

                                        </div>
                                        <div class="card-body">
                                            <h5 class="fs-6">${data['level_' + i + '_description']}</h5>
                                            <div class="p-3">
                                                <h4 class="fs-6">Knowledge</h4>
                                                <div class="d-flex flex-column">
                                            
                                                ${createListFromString(knowledge)}
                                                </div>
                                            
                                            </div>
                                            <div class="p-3">
                                                <h4 class="fs-6">Ability</h4>
                                                <div class="d-flex flex-column">
                                                ${createListFromString(ability)}

                                                </div>
                                            </div>
                                        </div>
                                    
                                    </div>
                            </div>
                        </label>
                    </div>
                `);
                } else {
                    modalBody.append(`
                <div class="form-check col-lg-2">
                
            
                        <label class="form-check-label h-100 w-100" for="level_1 ">
                            <div class="col-lg-12 h-100">
                                    <div class="bg-gray-100  card card-stretch card-bordered mb-5 h-100">
                                        <div class="card-header align-items-center">
                                            <h3 class="card-title">Level ${i}</h3>
                                            <input class="form-check-input border-dark" type="radio" value="${i}" id="level_${i}" name="level" ${selectedLevel == i ? 'checked' : ''}>

                                        </div>
                                        <div class="card-body">
                                            <h5></h5>
                                            <div class="p-3">
                                             
                                            
                                            </div>
                                            <div class="p-3">
                                               
                                            </div>
                                        </div>
                                    
                                    </div>
                            </div>
                        </label>
                    </div>
                `);
                }

            }


            // modalBody.append(`
        //      <div class="form-check col-lg-4">


        //     <label class="form-check-label" for="level_2">
        //     <div class="col-lg-12">
        //             <div class="card card-stretch card-bordered mb-5">
        //                 <div class="card-header align-items-center">
        //                     <h3 class="card-title">Level 2</h3>
        //                 <input class="form-check-input border-dark" type="radio" value="2" id="level_2" name="level" ${selected_level == 2 ? 'checked' : ''}>


        //                 </div>
        //                 <div class="card-body">
        //                     <h5>${data.level_2}</h5>
        //                     <div class="p-3">
        //                         <h4>Knowledge</h4>
        //                         <div class="d-flex flex-column">
        //                         ${createListFromString(data.level_2_knowledge)}

        //                         </div>

        //                     </div>
        //                     <div class="p-3">
        //                         <h4>Ability</h4>
        //                         <div class="d-flex flex-column">
        //                         ${createListFromString(data.level_2_ability)}
        //                         </div>
        //                     </div>
        //                 </div>

        //             </div>
        //     </div>
        //     </label>
        // </div>
        // `);

            // modalBody.append(`
        //     <div class="form-check col-lg-4">


        //     <label class="form-check-label" for="level_3">
        //         <div class="col-lg-12">
        //                 <div class="card card-stretch card-bordered mb-5">
        //                     <div class="card-header align-items-center">
        //                         <h3 class="card-title">Level 3</h3>
        //     <input class="form-check-input border-dark" type="radio" value="3" name="level" id="level_3" ${selected_level == 3 ? 'checked' : ''}>

        //                     </div>
        //                     <div class="card-body">
        //                         <h5>${data.level_3}</h5>
        //                         <div class="p-3">
        //                             <h4>Knowledge</h4>
        //                             <div class="d-flex flex-column">
        //                                 ${createListFromString(data.level_3_knowledge)}

        //                             </div>

        //                         </div>
        //                         <div class="p-3">
        //                             <h4>Ability</h4>
        //                             <div class="d-flex flex-column">
        //                             ${createListFromString(data.level_3_ability)}
        //                             </div>
        //                         </div>
        //                     </div>

        //                 </div>
        //         </div>
        //     </label>
        //     </div>
        // `);

            $('#techskillmodal .save-btn').data('skill-id', index); // Set skill ID on save button for later
        }



        function skillChanged(index, skillName) {
            $.ajax({
                url: '/admin/get-skill-levels/' + skillName, // Adjust this URL as necessary
                type: 'GET',
                success: function(data) {

                    if (data && data.level_1 && data.level_2 && data.level_3) {
                        // Find the "Select Level" button for this skill
                        let selectLevelButton = $(`#selectLevelButton${index}`);
                        selectLevelButton.show();
                        console.log('populatedskillmodal', data);
                        // Update the onclick event with new data
                        // selectLevelButton.attr("onclick", `populateModal('${index}', '${data.skill_id}', '${skillName}', '${data.level_1}', '${data.level_2}', '${data.level_3}', '1')`);
                        selectLevelButton.attr("onclick",
                            `populateModal('${index}', '${escapeSpecialCharacters(JSON.stringify(data))}', '${skillName}','1')`
                        );
                        // Assuming default to level 1 or use current selected level
                    } else {
                        selectLevelButton.hide();

                    }
                },
                error: function(error) {
                    console.error("Error fetching level descriptors for skill:", skillName, error);
                }
            });
        }



        // function populateModal(index,skillId, skillTitle, level_1,level_2,level_3,selected_level) {
        function populateModal(index, data, skillTitle, selected_level) {
            console.log('populatedskillmodal', data);

            data = JSON.parse(data);
            console.log(data.level_1_knowledge);
            let modalBody = $('#kt_modal_2 .modalbody');
            // console.log(selected_level);
            // console.log(level_2);
            modalBody.empty(); // Clear existing modal content

            $('#kt_modal_2 .modal-title').text(skillTitle);
            // levels.forEach(level => {
            modalBody.append(`
                <div class="form-check col-lg-4">
                 
                
                    <label class="form-check-label" for="level_1">
                        <div class="col-lg-12">
                                <div class="card card-stretch card-bordered mb-5">
                                    <div class="card-header align-items-center">
                                        <h3 class="card-title">Level 1</h3>
                                        <input class="form-check-input border-dark" type="radio" value="1" id="level_1" name="level" ${selected_level == 1 ? 'checked' : ''}>

                                    </div>
                                    <div class="card-body">
                                        <h5>${data.level_1}</h5>
                                        <div class="p-3">
                                            <h4>Knowledge</h4>
                                            <div class="d-flex flex-column">
                                            ${createListFromString(data.level_1_knowledge)}
                                           
                                            </div>
                                        
                                        </div>
                                        <div class="p-3">
                                            <h4>Ability</h4>
                                            <div class="d-flex flex-column">
                                                ${createListFromString(data.level_1_ability)}
                                            </div>
                                        </div>
                                    </div>
                                
                                </div>
                        </div>
                    </label>
                </div>
            `);

            modalBody.append(`
            <div class="form-check col-lg-4">
                 
                
                    <label class="form-check-label" for="level_2">
                        <div class="col-lg-12">
                                <div class="card card-stretch card-bordered mb-5">
                                    <div class="card-header align-items-center">
                                        <h3 class="card-title">Level 2</h3>
                                       <input class="form-check-input border-dark" type="radio" value="2" id="level_2" name="level" ${selected_level == 2 ? 'checked' : ''}>


                                    </div>
                                     <div class="card-body">
                                        <h5>${data.level_2}</h5>
                                        <div class="p-3">
                                            <h4>Knowledge</h4>
                                            <div class="d-flex flex-column">
                                             ${createListFromString(data.level_2_knowledge)}

                                            </div>
                                        
                                        </div>
                                        <div class="p-3">
                                            <h4>Ability</h4>
                                            <div class="d-flex flex-column">
                                               ${createListFromString(data.level_2_ability)}
                                            </div>
                                        </div>
                                    </div>
                                
                                </div>
                        </div>
                    </label>
                </div>
        `);

            modalBody.append(`
            <div class="form-check col-lg-4">
                 
                
                    <label class="form-check-label" for="level_3">
                        <div class="col-lg-12">
                                <div class="card card-stretch card-bordered mb-5">
                                    <div class="card-header align-items-center">
                                        <h3 class="card-title">Level 3</h3>
                    <input class="form-check-input border-dark" type="radio" value="3" name="level" id="level_3" ${selected_level == 3 ? 'checked' : ''}>

                                    </div>
                                     <div class="card-body">
                                        <h5>${data.level_3}</h5>
                                        <div class="p-3">
                                            <h4>Knowledge</h4>
                                            <div class="d-flex flex-column">
                                                ${createListFromString(data.level_3_knowledge)}

                                            </div>
                                        
                                        </div>
                                        <div class="p-3">
                                            <h4>Ability</h4>
                                            <div class="d-flex flex-column">
                                               ${createListFromString(data.level_3_ability)}
                                            </div>
                                        </div>
                                    </div>
                                
                                </div>
                        </div>
                    </label>
                </div>
        `);

            $('#kt_modal_2 .save-btn').data('skill-id', index); // Set skill ID on save button for later
        }

        function escapeSpecialCharacters(string) {
            return string.replace(/\\/g, '\\\\') // Escaping backslashes
                .replace(/'/g, "\\'") // Escaping single quotes
                .replace(/"/g, '\\"') // Escaping double quotes
                .replace(/\n/g, '\\n') // Escaping newlines
                .replace(/\r/g, '\\r') // Escaping carriage returns
                .replace(/\t/g, '\\t'); // Escaping tabs
        }

        function createListFromString(str) {
            return str.split(';').filter(item => item.trim() !== '').map(item =>
                `<li class="d-flex align-items-center py-2 fs-xxl-9"><span class="bullet me-5"></span>${item.trim()}</li>`
            ).join('');
        }

        function updateSkillLevel(button) {

            let skillId = $(button).data('skill-id');
            let selectedLevel = $('#kt_modal_2 .modal-body input:checked').val();

            // Debugging output
            console.log("Skill ID:", skillId);
            console.log("Selected Level:", selectedLevel);

            // Ensure the selector targets the correct select element
            let selectSelector = `select[name="skills[${skillId}][level]"]`;
            let selectElement = $(selectSelector);

            if (selectElement.length) {
                selectElement.val(selectedLevel);
                console.log("Select element found and value updated.");
            } else {
                console.error("Select element not found with selector:", selectSelector);
            }
        }

        function updateTechSkillLevel(button) {

            let skillId = $(button).data('skill-id');
            let selectedLevel = $('#techskillmodal .modal-body input:checked').val();

            // Debugging output
            console.log("Skill ID:", skillId);
            console.log("Selected Level:", selectedLevel);

            // Ensure the selector targets the correct select element
            let selectSelector = `select[name="technicalSkills[${skillId}][level]"]`;
            let selectElement = $(selectSelector);

            if (selectElement.length) {
                selectElement.val(selectedLevel);
                console.log("Select element found and value updated.");
            } else {
                console.error("Select element not found with selector:", selectSelector);
            }
        }
    </script>

    <script>
        $(document).ready(function() {
            var select4 = $('#perfomance_expectation');
            select4.select2({
                tags: true,
                createTag: function(params) {
                    if (params.term.trim() === "") {
                        return null; // Prevent blank tags
                    }
                    return {
                        id: params.term,
                        text: params.term,
                        newOption: true
                    };
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            var select4 = $('#secondary_scope_of_study');
            select4.select2({
                tags: true,
                createTag: function(params) {
                    if (params.term.trim() === "") {
                        return null; // Prevent blank tags
                    }
                    return {
                        id: params.term,
                        text: params.term,
                        newOption: true
                    };
                }
            });
        });
    </script>

    <script>
        $('.existing_selects').hide();
        $('#riasec-block').hide();
        $('#riasec').prop('required', false);
        $('.existing_selects').prop('required', false);
        $('.existing_selects_sector').hide();
        $('.existing_selects_sector_department').hide();
        $('.select-department').prop('required', false);
        $('.existing_dept').hide();
        $('#org_department_filter').prop('required', false);

        $('#toggle_select').on('change', function() {
            var selectedValue = $(this).val();

            if (selectedValue == '1') {
                $('#riasec-block').show();
                $('#riasec').prop('required', true);
                $('.existing_selects').hide();
                $('.existing_selects').prop('required', false);
                $('.existing_selects_sector').show();
                $('.existing_selects_sector_department').show();
                $('.select-department').prop('required', true);
                formReset();
                $('.existing_dept').hide();
                $('#org_department_filter').prop('required', false);
            } else if (selectedValue == '2') {
                $('.existing_dept').hide();
                $('#riasec-block').hide();
                $('#riasec').prop('required', false);
                $('#org_department_filter').prop('required', false);

                $('.existing_selects_sector_department').show();
                $('.existing_selects').show();
                $('.existing_selects').prop('required', true);
                $('.existing_selects_sector').show();
                $('.select-department').prop('required', true);

            } else if (selectedValue == '3') {
                formReset();
                $('.existing_selects_sector').hide();
                $('#riasec').prop('required', false);
                $('#riasec-block').hide();
                $('.select-department').prop('required', false);
                var options = '<option value="">Please Select Department First</option>';
                $('#job_desc').html(options);

                $('.existing_dept').show();
                $('#org_department_filter').prop('required', true);

                $('.existing_selects_sector_department').show();

                $('.existing_selects').show();
                $('.existing_selects').prop('required', true);
            } else {
                $('.existing_selects_sector_department').hide();
                $('.existing_selects').hide();
                $('#riasec').prop('required', false);
                $('#riasec-block').hide();
                $('.existing_selects').prop('required', false);
                $('.existing_selects_sector').hide();
                $('.select-department').prop('required', false);
                $('.existing_dept').hide();
                $('#org_department_filter').prop('required', false);
                formReset();
            }
        });

        function formReset() {
            $('.select-department').prop('selectedIndex', 0);
            $('.select-job').prop('selectedIndex', 0);
            var options = '<option value="">Select Job Description</option>';
            $('#job_desc').html(options);
            $('.critical-function').remove();
            $('.technical-skill').remove();
            $('#job_role').val('');
            $('#job_role_desc').val('');
        }
    </script>
    <script>
        $(document).ready(function() {
            $('#riasec').select2({
                closeOnSelect: false
            });

            $('#generate-riasec').on('click', function() {
                // Example response, replace this with your actual AJAX call
                const jobRole = $('#job_role').val().trim();

                // Check if job role is empty
                if (!jobRole) {
                    alert('Please enter a job role.');
                    return;
                }



                // Perform the AJAX call
                $.ajax({
                    url: '{{ route('jobs.generateRiasecCode') }}', // Replace with your actual endpoint
                    type: 'GET',
                    data: {
                        job_role: jobRole
                    },
                    success: function(response) {
                        // Example response: 'RIA'
                        // Clear existing selections
                        $('#riasec').val([]).trigger('change');

                        // Convert the response string to an array of single characters
                        const riasecArray = response.riasec_codes[0].split('');

                        // Select the options that match the response
                        riasecArray.forEach(function(code) {
                            $('#riasec option').each(function() {
                                if ($(this).val() === code) {
                                    $(this).prop('selected', true).trigger(
                                        'change');
                                }
                            });
                        });
                    },
                    error: function() {
                        alert('Failed to retrieve RIASEC codes.');
                    }
                });
            });

            $('#riasec').on('change', function() {
                if ($(this).val().length > 3) {
                    alert('You can only select a maximum of 3 options.');
                    // Deselect the last selected option
                    let selectedValues = $(this).val();
                    selectedValues.pop(); // Remove the last selected value
                    $(this).val(selectedValues).trigger('change'); // Update select2 with new values
                }
            });
        });
    </script>
    {{-- <script>
    $(document).ready(function() {
        ('#job_description_form').submit(function(event) {
            let isValid = true;
            if ($('.critical-functions-container').find('.critical-function').length === 0) {
                $('#validationMessage').show();
                isValid = false;
            } else {
                $('#validationMessage').hide();
            }

            if ($('.skills-container').find('.technical-skill').length === 0) {
                $('#techvalidationmessage').show();
                isValid = false;
            } else {
                $('#techvalidationmessage').hide();
            }
            if (!isValid) {
                    event.preventDefault(); // Prevent form submission
                }
        });
    });
</script> --}}

    <script>
        const positionCodes = {
            1: 'STAFF 1, R&F DAILY',
            2: 'STAFF 2, R&F MONTHLY',
            3: 'STAFF 3',
            4: 'SUPV',
            5: 'GRP SUPV',
            6: 'MGR',
            7: 'SR MGR, PROJ MGR',
            8: 'GRP MGR',
            9: 'AVP',
            10: 'VP',
            11: 'SVP',
            12: 'EVP',
            13: 'PRES'
        };

        function updatePositionCode() {
            const levelJob = document.getElementById('level-job');
            const positionCodeInput = document.getElementById('position_code');
            const selectedLevel = levelJob.value;

            // positionCodeInput.value = positionCodes[selectedLevel];
        }
    </script>

<script>
    $(document).ready(function () {
        $('#business_unit').on('change', function () {
            let businessUnitId = $(this).val();
            $('#division').prop('disabled', true).html('<option value="">Loading...</option>');
            $('#department_id').prop('disabled', true).html('<option value="">Select Department</option>');
    
            if (businessUnitId) {
                $.get(`/admin/ajax/divisions/${businessUnitId}`, function (data) {
                    let options = '<option value="">Select Company/Division</option>';
                    data.forEach(function (item) {
                        options += `<option value="${item.id}">${item.head_of_division}</option>`;
                    });
                    $('#division').html(options).prop('disabled', false);
                });
            }
        });
    
        $('#division').on('change', function () {
            let divisionId = $(this).val();
            $('#department_id').prop('disabled', true).html('<option value="">Loading...</option>');
    
            if (divisionId) {
                $.get(`/admin/ajax/departments/${divisionId}`, function (data) {
                    let options = '<option value="">Select Department</option>';
                    data.forEach(function (item) {
                        options += `<option value="${item.id}">${item.name}</option>`;
                    });
                    $('#department_id').html(options).prop('disabled', false);
                });
            }
        });
    });
    </script>
    <script>
        var superiorHeadcounts = [];

        function updateSuperiorSelects(previousSelection = []) {

                previousSelection = previousSelection || [];

                if (previousSelection.length > 0) {
                    document.querySelectorAll('.headcount-item').forEach((row, idx) => {
                        const sel = row.querySelector('select[name="headcounts['+idx+'][superior]"]');
                        if (!sel) return;
                        const prev = previousSelection[idx] ?? '';
                        let html = '<option value="">Select Superior Headcount ID</option>';
                        superiorHeadcounts.forEach(code => {
                        if (code !== codes[idx]) {
                            html += `<option value="${code}" ${previousSelection[idx] == code ? 'selected':''}>${code}</option>`;
                        }
                        });
                        sel.innerHTML = html;
                        if (superiorHeadcounts.includes(prev)) sel.value = prev;
                    });
                } else {
                
                    document.querySelectorAll('.headcount-item').forEach((row, idx) => {
                        const sel = row.querySelector('select[name="headcounts['+idx+'][superior]"]');
                        if (!sel) return;
                        const prev = sel.value;
                        let html = '<option value="">Select Superior Headcount ID</option>';
                        superiorHeadcounts.forEach(code => {
                        if (code !== codes[idx]) {
                            html += `<option value="${code}">${code}</option>`;
                        }
                        });
                        sel.innerHTML = html;
                        if (superiorHeadcounts.includes(prev)) sel.value = prev;
                    });
                    
                }
                
            }

        $(document).ready(function () {
            let codes = [];

            // … your debounce + AJAX code to populate `codes` …

            // ←―――――――――――――――――――――――――――――――――→
            // Insert the missing function here:
            

            function initSuperiorSelect(level) {
                $('#superior').select2({
                    placeholder: 'Select Superior Job Position',
                    minimumInputLength: 1,
                    allowClear: true,
                    ajax: {
                        url: '/admin/ajax/get-superior-jobs',
                        dataType: 'json',
                        delay: 250,
                        data: function (params) {
                            return {
                                q: params.term      // search text
                                // level: level         // selected level value
                            };
                        },
                        processResults: function (data) {
                            return {
                                results: data
                            };
                        },
                        cache: true
                    }
                });
            }

            $('#superior')
            .on('select2:select', function(e) {
                const jobId = e.params.data.id;
                loadSuperiorHeadcounts(jobId);
                loadAllowedLevels();
            })
            .on('select2:clear', function() {
                // empty out the Superior‐Headcount dropdowns
                superiorHeadcounts = [];
                updateSuperiorSelects();
            });

            // 3) Your AJAX loader from earlier:
            function loadSuperiorHeadcounts(jobId) {
                showOverlay();
                fetch(`/admin/ajax/job-headcounts/${jobId}`)
                    .then(r => r.json())
                    .then(json => {
                        superiorHeadcounts = Array.isArray(json.headcount_codes)
                            ? json.headcount_codes
                            : [];
                        updateSuperiorSelects(); 
                        hideOverlay();
                    })
                    .catch(console.error);
            }


            function loadAllowedLevels() {

                console.log('loadAllowedLevels');
                
                const superiorSelect  = $('#superior');
                const isTopCheckbox   = $('#is_top_position');
                const levelSelect     = $('#level-job');

                const data = {
                is_top:     isTopCheckbox.prop('checked'),
                superior_id: superiorSelect.val()
                };

                $.getJSON('/admin/ajax/allowed-levels', data, levels => {
                levelSelect
                    .empty()
                    .append('<option value="">Select Level</option>')
                    .prop('disabled', levels.length === 0);

                levels.forEach(l => {
                    levelSelect.append(`<option value="${l.value}">${l.text}</option>`);
                });
                
                // Re-apply previous selection if any:
                const old = levelSelect.data('old') || '';
                if (old) levelSelect.val(old);
                });
            }



            // Example: initialize based on a default level or dropdown
            let currentLevel = $('#level-job').val() || 1;
            initSuperiorSelect(currentLevel);

            // Optional: reinitialize when level changes
            $('#level-job').on('change', function () {
                currentLevel = $(this).val();
                // $('#superior').val(null).trigger('change');     // Clear previous selection
                // $('#superior').select2('destroy');              // Destroy current
                // initSuperiorSelect(currentLevel);                 // Reinit with new level
            });

            // document.addEventListener('DOMContentLoaded', function () {
                const topPositionCheckbox = document.getElementById('is_top_position');
                const $superiorSelect = $('#superior');

                function toggleSuperiorField() {
                    const isDisabled = topPositionCheckbox.checked;

                    if (isDisabled) {
                        $('#is_top_position').prop('checked', false);
                        $('#is_top_position').trigger('change');
                        // showModalDynamic('set_top_position');
                        ModalManager.open({
                            module: 'jobs',
                            key: "{{ $isTopExists == true ? 'set_top_position_existing' : 'set_top_position' }}",
                            data: { job_id: 4870,
                                job_title: "{{ $isTopExists == true ? $topJobTitle : '-' }}",
                                level: 1,
                                superior: 0,
                                is_top_position: "1",
                                type:"{{ $isTopExists == false ? 1 : 0 }}"
                            },
                            onSubmit(modalEl) {
                                // handle submission logic here
                                // const form = modalEl.querySelector('form');
                                // if (form) form.submit(); // or AJAX post
                                const bsModal = bootstrap.Modal.getInstance(modalEl);
                                        if (bsModal) bsModal.hide();

                                ModalManager.open({
                                    module: 'jobs',
                                    key: "clear_existing_input",
                                    data: { job_id: 4870,
                                        job_title: "{{ $isTopExists == true ? $topJobTitle : '-' }}",
                                        level: 1,
                                        superior: 0,
                                        is_top_position: "1",
                                        type:"{{ $isTopExists == false ? 1 : 0 }}"
                                    },
                                    onSubmit(modalEl1) {

                                        showOverlay();
                                        $('#is_top_position').prop('checked', true);
                                        $('#is_top_position').trigger('change');
                                        const bsModal = bootstrap.Modal.getInstance(modalEl1);
                                        if (bsModal) bsModal.hide();
                                        if ($superiorSelect.hasClass("select2-hidden-accessible")) {
                                            $superiorSelect.select2('destroy');
                                            $superiorSelect.val(null).trigger('change'); // Clear previous selection
                                            renderHeadcountRows();
                                        }

                                        // Enable/disable the native select
                                        $superiorSelect.prop('disabled', isDisabled);

                                        // Set required only if not disabled
                                        $superiorSelect.prop('required', !isDisabled);

                                        // Reinitialize Select2
                                        initSuperiorSelect(currentLevel);

                                        loadAllowedLevels();

                                        setTimeout(() => {
                                            hideOverlay();
                                        }, 1000);
                                        

                                    }    
                                })
                            },
                            onShown(modalEl) {
                                const checkbox = modalEl.querySelector('.modal-body input[type="checkbox"]');
                                const confirmBtn = modalEl.querySelector('[data-modal-submit]');

                                // Ensure button starts disabled
                                confirmBtn.disabled = true;

                                // Toggle enable/disable on checkbox change
                                checkbox.addEventListener('change', () => {
                                    confirmBtn.disabled = !checkbox.checked;
                                });
                                
                            }
                        });
                        

                    }else{
                        if ($superiorSelect.hasClass("select2-hidden-accessible")) {
                            $superiorSelect.select2('destroy');
                            $superiorSelect.val(null).trigger('change'); // Clear previous selection
                        }

                        // Enable/disable the native select
                        $superiorSelect.prop('disabled', isDisabled);

                        // Set required only if not disabled
                        $superiorSelect.prop('required', !isDisabled);

                        // Reinitialize Select2
                        initSuperiorSelect(currentLevel);

                        renderHeadcountRows();
                        loadAllowedLevels();

                    }
                    
                    // Destroy existing Select2
                }

                // Initial check on page load
                toggleSuperiorField();

                // Rebind when checkbox changes
                topPositionCheckbox.addEventListener('change', toggleSuperiorField);

            // });
        });




    </script>


    <script>
        // Your existing codes[] array
        let codes = [];
    
        // AbortController & debounce for position_code AJAX
        let debounceTimer, abortController = new AbortController();
        const debounceDelay = 400;
    
        // Shortcut to grab elements
        const positionInput    = document.getElementById('position_code');
        const draftIdInput     = document.getElementById('job_draft_id');
        const addBtn           = document.getElementById('add-headcount-btn');
        var topToggle        = document.getElementById('is_top_position');
        const container        = document.getElementById('headcount-container');
        const countBadge       = document.getElementById('headcount-count');
    
        // Whenever the “top position” toggle changes, re-render
        topToggle.addEventListener('change', () => {
        // disable/enable the add button
        addBtn.disabled = topToggle.checked;
        // re-render rows (will clamp to 1 and show static superior)
        // renderHeadcountRows();
        });
    
        // Debounced AJAX on position_code input
        positionInput.addEventListener('input', function () {
            showOverlay();
            const positionCode = this.value.trim();
            const jobDraftId   = draftIdInput.value;
        
            clearTimeout(debounceTimer);
            abortController.abort();
            abortController = new AbortController();
        
            debounceTimer = setTimeout(() => {
                if (!positionCode) {
                codes = [];
                renderHeadcountRows();
                return;
                }
        
                fetch(
                `/admin/ajax/generate-headcounts-code`
                    + `?position_code=${encodeURIComponent(positionCode)}`
                    + `&job_draft_id=${encodeURIComponent(jobDraftId)}`,
                { signal: abortController.signal }
                )
                .then(r => r.json())
                .then(data => {
                    if (Array.isArray(data.headcount_codes)) {
                        codes = data.headcount_codes;
                    } else {
                        codes = [];
                    }
                    // keep the draft id up to date
                    if (data.job_draft_id) draftIdInput.value = data.job_draft_id;
                    renderHeadcountRows();
                    hideOverlay();
                })
                .catch(err => {
                if (err.name !== 'AbortError') console.error(err);
                });
            }, debounceDelay);
            
        });
    
        // Add‐headcount button
        addBtn.addEventListener('click', () => {
            if (!codes.length) {
                alert("Please enter a Position Code first.");
                return;
            }
            // never allow extra rows in top mode
            if (topToggle.checked) return;
        
            // Compute next sequence from last code
            const last = codes[codes.length - 1];
            const parts = last.split('-');
            let seq = parseInt(parts.pop(), 10) + 1;
            seq = String(seq).padStart(2, '0');
            const nextCode = [...parts, seq].join('-');
        
            codes.push(nextCode);
            renderHeadcountRows();
        });
    
        // Delegate remove‐row clicks
        document.addEventListener('click', e => {
            const btn = e.target.closest('.remove-headcount');
            if (!btn) return;
            const row = btn.closest('.headcount-item');
            if (row.dataset.default === "true") {
                alert("This row cannot be removed. Delete the JD to remove it.");
                return;
            }
            // remove from codes[]
            const idx = [...document.querySelectorAll('.headcount-item')].indexOf(row);
            codes.splice(idx, 1);
            row.remove();
            renderHeadcountRows();
        });
    
        function generateSuperiorOptions(selectedValue) {
            if (!Array.isArray(superiorHeadcounts)) return '';

            return superiorHeadcounts.map(option => {
                const selected = option.id === selectedValue ? 'selected' : '';
                return `<option value="${option.id}" ${selected}>${option.id}</option>`;
            }).join('');
        }

        // Render function
        function renderHeadcountRows() {
            console.log(superiorHeadcounts, 'superiorHeadcounts');
                
            const isTop = topToggle.checked;
            const previousSelections = [];
            const existingRows = container.querySelectorAll('.headcount-item');
            existingRows.forEach((row, idx) => {
                const select = row.querySelector('select[name^="headcounts"]');
                if (select) previousSelections[idx] = select.value;
            });

            console.log('previousSelections', previousSelections);
            console.log('codes',codes);
            
            



            container.innerHTML = '';

        
            // clamp to 1 row if top, otherwise at least 1 or codes.length
            const count = isTop ? 1 : Math.max(codes.length, 1);
        
            for (let i = 0; i < count; i++) {
                const code   = codes[i] || 'Please enter a Position Code first.';
                const isFirst= (i === 0);
        
                container.insertAdjacentHTML('beforeend', `
                <div class="row headcount-item mb-3 align-items-center" data-default="${isFirst}">
                    <div class="col-lg-2">
                    
                    <span class="form-control-plaintext headcount-number">${i+1}</span>
                    </div>
                    <div class="col-lg-3">
                    ${i+1 == 1 ? '<label class="form-label">Headcount ID</label>':''}
                    <input type="text"
                            class="form-control"
                            name="headcounts[${i}][id]"
                            value="${code}"
                            readonly />
                    </div>
                    <div class="col-lg-3">
                        ${i+1 == 1 ? '<label class="form-label">Employee</label>':''}
                    
                    <input type="text"
                            class="form-control"
                            name="headcounts[${i}][employee]"
                            value="Vacant"
                            readonly />
                    </div>
                    <div class="col-lg-3">
                        ${i+1 == 1 ? '<label class="form-label">Superior Headcount ID <span class="text-danger">*</span></label>':''}
                    ${
                        isTop
                        ? `<span class="form-control-plaintext">This role is at the top of the org chart.</span>`
                        : `<select class="form-select" name="headcounts[${i}][superior]" required>
                            <option value="">Select Superior</option>
                            </select>`
                    }
                    </div>
                    <div class="col-lg-1 d-flex align-items-end justify-content-end">
                    <button type="button"
                            class="btn btn-icon btn-sm btn-${isFirst?'light-secondary':'light-danger'} remove-headcount"
                            ${isFirst?'disabled':''}>
                        <i class="fas fa-trash-alt"></i>
                    </button>
                    </div>
                </div>
                `);
            }
        
            // update count badge
            countBadge.textContent = count;
        
            // ensure add-button reflects top state
            addBtn.disabled = topToggle.checked;
            updateSuperiorSelects(previousSelections);
        }
    
        // on‐load: initial render
        renderHeadcountRows();
    </script>
    

   
      

  
    
@endsection
