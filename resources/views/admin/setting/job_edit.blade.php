@extends('admin.layout.app')

@section('title', 'Edit Job Description')
@section('styles')
    <style>

.select2-selection__clear{
    display: none !important;
}


        .select2-container {
            width: 100% !important;
        }
        .error {
        color: red;
        margin: 3px;
        }

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
    </style>
@endsection
@section('content')
    <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">

        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container  container-fluid d-flex flex-stack ">


            <!--begin::Page title-->
            <div data-kt-swapper="true" data-kt-swapper-mode="{default: 'prepend', lg: 'prepend'}"
                data-kt-swapper-parent="{default: '#kt_app_content_container', lg: '#kt_app_toolbar_container'}"
                class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5 mb-lg-0">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                    Job Update
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
                    @if (auth()->user()->role_id != 7)
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
                            Job Edit </li>
                    @endif

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
            <form class="space-y-4 w-96" action="{{ route('jobs.update', $job->id) }}" method="POST"
                id="job_description_form">
                @csrf
                            @method('PUT')
            <div class="card mb-5 mb-xl-8">
                <!--begin::Header-->
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold fs-3 mb-1">General Info</span>

                        {{-- <span class="text-muted mt-1 fw-semibold fs-7">Over 500 new products</span> --}}
                    </h3>
                </div>
                <!--end::Header-->

                <!--begin::Body-->
                <div class="card-body py-3">
                    <!--begin::Table container-->
                    <div class="card-text h-full">
                        {{-- <form class="space-y-4 w-96" action="{{ route('jobs.update', $job->id) }}" method="POST"
                            id="job_description_form"> --}}
                            
                            <div class="row">

                                <div class="fv-row mb-7 fv-plugins-icon-container col-lg-12">
                                    <label for="job_role" class="fw-semibold fs-6 mb-2">Job Role*</label>
                                    <input id="job_role" type="text"
                                        class="form-control form-control-solid mb-3 mb-lg-0" name="title"
                                        placeholder="Job Role" value="{{ $job->title }}">

                                        <div class="custom-toggle-wrapper">
                                            <div class="custom-toggle">
                                                <input type="checkbox" id="is_critical_position" name="is_critical" {{ $job->is_critical == 1 ? 'checked' : '' }}>
                                                <label for="is_critical_position">Mark as Critical Job Position</label>
                                            </div>
                                        </div>   
                                </div>
                            </div>

                            @if ($job->job_type == 'custom')
                            <div class="row" id="riasec-block">
                                <div class="fv-row mb-7 fv-plugins-icon-container col-lg-9">
                                    <label for="riasec" class="fw-semibold fs-6 mb-2">Select Riasec</label>
                                    <select id="riasec" class="form-select form-select-solid mb-3 mb-lg-0" data-control="select2" data-close-on-select="false" name="riasec[]" data-placeholder="Select Riasec" multiple required>
                                        <option value="" class="dark:bg-slate-700">Select Riasec</option>
                                        @foreach(config('constants.RIASEC_CODES') as $key24 => $value24)
                                        <option value="{{ $value24 }}" class="dark:bg-slate-700" {{ in_array($value24,str_split($job->top3riasec)) == true ? 'selected':'' }}>{{ $key24.'('.$value24.')' ?? '-'
                                            }}</option>
        
                                        @endforeach
                                    </select>
                                </div>
                                <div class="fv-row mb-7 fv-plugins-icon-container col-lg-3 py-5">
                                   <button id="generate-riasec" type="button" class="btn btn-success">Generate Riasec Using Job Role</button>
                                </div>
                            </div>
                            @endif



                            <div class="row">
                                <div class="fv-row mb-7 fv-plugins-icon-container col-lg-6">
                                  <label for="business_unit" class="fw-semibold fs-6 mb-2">Business Unit</label>
                                  <select id="business_unit" name="business_unit_id" class="form-control" required>
                                    <option value="">Select Business Unit</option>
                                    @foreach($businessUnits as $unit)
                                      <option value="{{ $unit->id }}"
                                        {{ old('business_unit_id', $job->business_unit_id) == $unit->id ? 'selected' : '' }}>
                                        {{ $unit->name }}
                                      </option>
                                    @endforeach
                                  </select>
                                </div>
                              
                                <div class="fv-row mb-7 fv-plugins-icon-container col-lg-6">
                                  <label for="division" class="fw-semibold fs-6 mb-2">Company/Division</label>
                                  <select id="division" name="division_id" class="form-control" disabled required>
                                    <option value="">Select Company/Division</option>
                                  </select>
                                </div>
                              
                                <div class="fv-row mb-7 fv-plugins-icon-container col-lg-12">
                                  <label for="department_id" class="fw-semibold fs-6 mb-2">Department</label>
                                  <select id="department_id" name="department_id" class="form-control" disabled required>
                                    <option value="">Select Department</option>
                                  </select>
                                </div>
                              </div>




                              @if ($job->is_top != 1)
                                <div class="row">
                                    <div class="fv-row mb-7 fv-plugins-icon-container col-lg-12">
                                        <label for="superior" class="fw-semibold fs-6 mb-2">Select Superior</label>
                                        <select id="superior" name="superior" class="form-control" required>
                                        @if(old('superior', $job->superior_id))
                                            {{-- Pre‑seed the current value so Select2 can pick it up --}}
                                            <option value="{{ old('superior', $job->superior_id) }}" selected>
                                            {{ $job->superior->job_full_title }}
                                            </option>
                                        @endif
                                        </select>
                                        @error('superior')
                                        <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            @endif  

                            <div class="row">

                                <div class="fv-row mb-3 fv-plugins-icon-container col-lg-6">
                                    <label for="heads" class="fw-semibold fs-6 mb-2">Select Position Level*</label>
                                    <select id="level-job" class="form-control form-control-solid mb-3 mb-lg-0" onchange="updatePositionCode()"  name="level_job">

                                        @foreach(config('constants.LEVELS') as $value => $label)
                                        <option 
                                            value="{{ $value }}" 
                                            class="dark:bg-slate-700" {{ isset($job->level) && $job->level == $value ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                        @endForeach
                                            
                                    </select>
                                </div>

                                <div class="fv-row mb-7 fv-plugins-icon-container col-lg-6">
                                    <label for="position_code" class="fw-semibold fs-6 mb-2">Position Code*</label>
                                    <input id="position_code" type="text" value="{{ $job->code }}"
                                        class="form-control form-control-solid mb-3 mb-lg-0" name=""
                                        placeholder="Position Code" disabled>

                                </div>

                            </div>

                            
                           
                            

                            <div class="row">
                                <div class="fv-row mb-7 fv-plugins-icon-container col-lg-12">
                                    <label for="job_role_desc" class="fw-semibold fs-6 mb-2">Job Role Description</label>
                                    <textarea id="job_role_desc" rows="5" name="description" class="form-control form-control-solid mb-3 mb-lg-0"
                                        placeholder="Type Here"> {{ $job->description }}</textarea>

                                </div>
                            </div>
                    </div> 
                </div>        
            </div> 


            <div class="card shadow-sm mb-4">
                <div class="card-header">
                  <h3 class="card-title">
                    Headcount Management (<span id="headcount-count">{{ count(old('headcounts', $job->headcounts->pluck('headcount_code')->toArray())) ?: 1 }}</span>)
                  </h3>
                </div>
                <div class="card-body" id="headcount-container">
                  @php
                    // merge old input (on validation error) or existing headcounts
                    $hc_list = old('headcounts',
                      $job->headcounts->map(fn($h) => [
                        'id'       => $h->headcount_code,
                        'superior' => optional($h->parent)->headcount_code
                      ])->toArray()
                    );
                  @endphp
                

              
                  @foreach($hc_list as $i => $hc)
                        <div class="row headcount-item mb-3 align-items-center" data-default="{{ $i === 0 ? 'true' : 'false' }}">
                            <div class="col-lg-2">
                                <label class="form-label">No</label>
                                <span class="form-control-plaintext headcount-number">{{ $i + 1 }}</span>
                            </div>
                            <div class="col-lg-3">
                                <label class="form-label">Headcount ID</label>
                                <input type="text" class="form-control" name="headcounts[{{ $i }}][id]"
                                    value="{{ $hc['id'] }}" readonly>
                            </div>
                            <div class="col-lg-3">
                                <label class="form-label">Employee</label>
                                <input type="text" class="form-control" name="headcounts[{{ $i }}][employee]"
                                    value="Vacant" readonly>
                            </div>
                            <div class="col-lg-3">
                                <label class="form-label">Superior Headcount ID</label>
                                <select class="form-control superior-hc-select" name="headcounts[{{ $i }}][superior]" superiorCode="{{ $hc['superior']  }}" {{ $job->is_top == 1 ? "disabled":"" }}>
                                    <option value="">Select Superior</option>
                                    @foreach($superiorHeadcounts ?? [] as $sup)
                                        @if ($sup->headcount_code !== $hc['id']) {{-- prevent self-selection --}}
                                            <option value="{{ $sup->headcount_code }}" {{ $sup->headcount_code == $hc['superior'] ? 'selected' : '' }}>
                                                {{ $sup->headcount_code }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-1 d-flex align-items-end justify-content-end">
                                <button type="button"
                                        class="btn btn-icon btn-sm btn-{{ $i === 0 ? 'light-secondary' : 'light-danger' }} remove-headcount"
                                        {{ $i === 0 ? 'disabled' : '' }}>
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </div>
                  @endforeach

                </div>
              
                <div class="card-footer pt-2">
                  <button type="button" class="btn btn-light-primary" id="add-headcount-btn" {{ $job->is_top == 1 ? "disabled":"" }}>
                    + Add Headcount
                  </button>
                </div>
              </div>


            <div class="card mb-5 mb-xl-8">
            
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold fs-3 mb-1">Job Qualifications</span>

                        {{-- <span class="text-muted mt-1 fw-semibold fs-7">Over 500 new products</span> --}}
                    </h3>
                </div>

                <div class="card-body py-3">

                    <div class="fv-row mb-7 row fv-plugins-icon-container col-lg-12 py-4">
                        {{-- <h5 for="select" class=" mb-5"></h5> --}}
                        @php 
                         $education_levels = \App\Models\MasterEducationLevel::all();
                        $higher_learning_institutions = \App\Models\MasterHigherLearningInstitution::all();
                        $edu_program = \App\Models\MasterScopeOfStudy::all();
                        @endphp
                        <div class="input-area col-xl-4">
                            <label for="select" class="form-label">Select Education Level*</label>
                            <select id="education_level" class="form-control form-control-solid" name="education_level">
                                @foreach ($education_levels as $education_level)
                                    <option value="{{ $education_level->id }}" class="dark:bg-slate-700"
                                        {{ $job->education_level == $education_level->id ? 'selected' : '' }}>
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
                            <select id="scope_of_study" class="form-control form-control-solid" name="scope_of_study">
                                <option value="">Select Scope of Study</option>
                                @foreach ($edu_program as $scope_of_study)
                                    <option value="{{ $scope_of_study->id }}" class="dark:bg-slate-700"
                                        {{ $job->scope_of_study == $scope_of_study->id ? 'selected' : '' }}>
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
                            <label for="secondary_scope_of_study" class="fw-semibold fs-6 mb-2">Secondary Scope of Study</label>
                            <select id="secondary_scope_of_study" class="form-select form-select-solid mb-3 mb-lg-0" data-control="select2" data-close-on-select="false" name="secondary_scope_of_study[]" data-placeholder="Enter Secondary Scope of Study" multiple>
                                <option value="" class="dark:bg-slate-700">Enter Secondary Scope of Study</option>
                                @foreach ($job->jobSecondaryScopeOfStudies as $item)
                                <option value="{{ $item->title }}" class="dark:bg-slate-700" selected>{{ $item->title }}</option>
                                @endforeach
                            </select>
                            @error('secondary_scope_of_study')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="input-area col-lg-4 mt-5">
                            <div >
                                <label class="form-label">Relevant Professional Certificates</label>
                                <input class="form-control form-control-solid" type="text" id="kt_tagify_1"
                                    value="{{ $job->professional_certificate ?? '' }}"
                                    name="professional_certificate"  />
                            </div>
                            {{-- <div id="message" style="display: none; color: red;">You can only select up to 5
                                options.</div> --}}
                        </div>

                        <div class="input-area col-lg-4 mt-5">
                            <div >
                                <label class="form-label">Relevant Training Programs</label>
                                <input class="form-control form-control-solid"
                                    value="{{ $job->relevant_training ?? '' }}"
                                    name="relevant_training" type="text"  id="kt_tagify_2"/>
                            </div>
                            {{-- <div id="message" style="display: none; color: red;">You can only select up to 5
                                options.</div> --}}
                        </div>


                        <div class="input-area col-xl-4 mt-5">
                                <label class="form-label" for="work_experience">Experience in Relevant Sector</label>
                                <select class="form-control form-control-solid" id="work_experience" name="work_experience">
                                    <option {{ $job->work_experience == '0-1' ? 'selected':'' }} value="0-1">0-1 years</option>
                                    <option {{ $job->work_experience == '1-3' ? 'selected':'' }} value="1-3">1-3 years</option>
                                    <option {{ $job->work_experience == '3-5' ? 'selected':'' }} value="3-5">3-5 years</option>
                                    <option {{ $job->work_experience == '5-7' ? 'selected':'' }} value="5-7">5-7 years</option>
                                    <option {{ $job->work_experience == '7-10' ? 'selected':'' }} value="7-10">7-10 years</option>
                                    <option {{ $job->work_experience == '10+' ? 'selected':'' }} value="10+">10+ years</option>
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
                        

            <div class="card mb-5 mb-xl-8">
            
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold fs-3 mb-1">Critical Work Functions</span>

                        {{-- <span class="text-muted mt-1 fw-semibold fs-7">Over 500 new products</span> --}}
                    </h3>
                </div>

                <div class="card-body py-3">
                    <div class="fv-row mb-7 fv-plugins-icon-container col-lg-12">
                        {{-- <h5 for="name" class="mb-2"></h5> --}}
                        <div class="critical-functions-container">
                            @foreach ($job->criticalFunctions as $index => $function)
                                {{-- <div class="critical-function row mb-3">
                            <input type="hidden" name="functions[{{ $index }}][id]" value="{{ $function->id }}">
                            <div class="fv-row mb-5 fv-plugins-icon-container col-lg-10">
                                <input id="name" type="text" class="form-control form-control-solid mb-3 mb-lg-0" name="functions[{{ $index }}][title]" placeholder="Critical Work Functions" value="{{ $function->description }}">
                                <select class="form-control function-keys" name="functions[{{ $index }}][keys][]" multiple="multiple">


                                    @foreach ($function->cwfKeys as $key)

                                    <option value="{{ $key->name }}" selected>{{ $key->name }}</option>

                                    @endforeach
                                </select>
                            </div>
                            <div class="fv-row mb-5 fv-plugins-icon-container col-lg-2">
                                <button type="button" class="btn btn-danger remove-function" title="Remove function">Remove</button>
                            </div>
                        </div> --}}

                                <!--begin::Accordion-->
                                <div class="critical-function row mb-3">
                                    <div class="accordion accordion-icon-collapse col-lg-10" id="kt_accordion_3">
                                        <!--begin::Item-->
                                        <div class="mb-5">
                                            <!--begin::Header-->
                                            <div class="accordion-header collapsed py-3 d-flex"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#kt_accordion_3_item_{{ $index }}">
                                                <span class="accordion-icon">

                                                    <iconify-icon icon="noto-v1:plus"
                                                        class="accordion-icon-off fs-3 me-3"></iconify-icon>

                                                    <iconify-icon icon="noto-v1:minus"
                                                        class="accordion-icon-on fs-3 me-3"></iconify-icon>


                                                </span>
                                                <input type="hidden" name="functions[{{ $index }}][id]"
                                                    value="{{ $function->id }}">
                                                <input id="name" type="text"
                                                    class="form-control form-control-solid mb-3 mb-lg-0"
                                                    name="functions[{{ $index }}][title]"
                                                    placeholder="Critical Work Functions"
                                                    value="{{ $function->description }}">
                                            </div>
                                            <!--end::Header-->

                                            <!--begin::Body-->
                                            <div id="kt_accordion_3_item_{{ $index }}"
                                                class="fs-6 collapse  ps-10" data-bs-parent="#kt_accordion_3">
                                                <select class="form-control function-keys"
                                                    name="functions[{{ $index }}][keys][]"
                                                    multiple="multiple">


                                                    @foreach ($function->cwfKeys as $key)
                                                        <option value="{{ $key->name }}" selected>
                                                            {{ $key->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <!--end::Body-->
                                        </div>

                                    </div>
                                    <div class="fv-row mb-5 fv-plugins-icon-container col-lg-2"
                                        style="
                                    margin-top: 8px;
                                    ">
                                        <button type="button" class="btn btn-danger remove-function"
                                            title="Remove function">Remove</button>
                                    </div>
                                </div>

                                <!--end::Accordion-->
                            @endforeach
                        </div>
                        <button type="button" id="add_new_function" class="btn btn-primary">Add New
                            Function</button>
                            <div id="validationMessage" style="color: red; display: none;">Atlest one Critical Work Function is required.</div>

                    </div>
                </div>   

            </div>    
                            


            <div class="card mb-5 mb-xl-8">
            
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold fs-3 mb-1">Performance Expectation (For legislated / regulated occupations)</span>

                        {{-- <span class="text-muted mt-1 fw-semibold fs-7">Over 500 new products</span> --}}
                    </h3>
                </div>

                <div class="card-body py-3">
                    <div class="fv-row mb-7 fv-plugins-icon-container col-lg-12">
                        {{-- <label for="perfomance_expectation" class="fw-semibold fs-6 mb-2">Performance Expectation (For legislated / regulated occupations) </label> --}}
                        <select id="perfomance_expectation" class="form-select form-select-solid mb-3 mb-lg-0" data-control="select2" data-close-on-select="false" name="perfomance_expectation[]" data-placeholder="Enter perfomance expectation" multiple>
                            <option value="" class="dark:bg-slate-700">Enter Performance Expectation</option>
                            @foreach ($job->jobExpectations as $item)
                            <option value="{{ $item->title }}" class="dark:bg-slate-700" selected>{{ $item->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>   

            </div>                  
                          

            <div class="card mb-5 mb-xl-8">
            
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold fs-3 mb-1">Technical Skills</span>

                        {{-- <span class="text-muted mt-1 fw-semibold fs-7">Over 500 new products</span> --}}
                    </h3>
                </div>

                <div class="card-body py-3">
                    <div class="fv-row mb-7 fv-plugins-icon-container col-lg-12 skills-container">

                        {{-- <h5 for="select" class=" mb-2"></h5> --}}


                        @foreach ($job->technicalSkills as $index => $skill)
                       
                            <div class="row mb-3 technical-skill">
                                {{-- <input type="hidden" name="technicalSkills[{{ $index }}][id]"
                                    value="{{ $skill->id }}">
                                <input type="hidden" name="technicalSkills[{{ $index }}][title]"
                                    value="{{ $skill->title }}"> --}}

                                <label class="fw-semibold fs-6 mb-2">{{ $skill->title }}</label>
                                <div class="fv-row mb-3 fv-plugins-icon-container col-lg-5">
                                    <select id="skill[{{ $index }}]]"
                                        class="form-control form-control-solid mb-3 mb-lg-0 col-lg-12"
                                        name="technicalSkills[{{ $index }}][id]">

                                        <option value="{{ $skill->id }}" class="dark:bg-slate-700">
                                            {{ $skill->name.'('.$skill->sector_name.'-'.$skill->sub_sector_name.')' }}</option>
                                    </select>
                                </div>
                                <div class="fv-row mb-3 fv-plugins-icon-container col-lg-4">

                                    <select id="level[{{ $index + 1 }}]"
                                        class="form-control form-control-solid mb-3 mb-lg-0 col-lg-12"
                                        name="technicalSkills[{{ $index }}][level]">
                                        <option value="6" {{ $skill->pivot->level == 6 ? 'selected' : '' }}
                                            class="dark:bg-slate-700">Level 6</option>
                                        <option value="5" {{ $skill->pivot->level == 5 ? 'selected' : '' }}
                                            class="dark:bg-slate-700">Level 5</option>
                                        <option value="4" {{ $skill->pivot->level == 4 ? 'selected' : '' }}
                                            class="dark:bg-slate-700">Level 4</option>
                                        <option value="3" {{ $skill->pivot->level == 3 ? 'selected' : '' }}
                                            class="dark:bg-slate-700">Level 3</option>
                                        <option value="2" {{ $skill->pivot->level == 2 ? 'selected' : '' }}
                                            class="dark:bg-slate-700">Level 2</option>
                                        <option value="1" {{ $skill->pivot->level == 1 ? 'selected' : '' }}
                                            class="dark:bg-slate-700">Level 1</option>
                                    </select>
                                </div>
                          
                                <div class="col-lg-3" bis_skin_checked="1">
                                    <button type="button" id="selectTechLevelButton{{ $index }}"
                                        class="btn btn-primary me-5" data-bs-toggle="modal"
                                        data-bs-target="#techskillmodal"
                                        onclick="technicalpopulateModal('{{ $index }}', '{{ App\Helpers\MainHelper::escapeSpecialCharacters(json_encode($skill)) }}', '{{ $skill->name }}', '{{ $skill->pivot->level }}')">
                                        Select Level
                                    </button>
                                    <button type="button"
                                    class="btn btn-danger remove-skill">Remove</button>
                                </div>
                              
                               
                            </div>
                        @endforeach
                    </div>
                    <button type="button" id="add_new_skill" class="btn btn-primary">Add New Skill</button>
                    <div id="techvalidationmessage" style="color: red; display: none;">Atlest One Technical Skill is required.</div>
                </div>   

            </div>    

                            


            <div class="card mb-5 mb-xl-8">
            
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold fs-3 mb-1">Generic Skills & Competencies</span>

                        {{-- <span class="text-muted mt-1 fw-semibold fs-7">Over 500 new products</span> --}}
                    </h3>
                </div>

                <div class="card-body py-3">
                    <div class="fv-row fv-plugins-icon-container col-lg-12 ">
                        {{-- <h5 for="select" class=" mb-2"></h5> --}}
                        @foreach ($job->skills as $index => $skill)
                            @php $master_skill = App\Models\MasterSkill::where('name',$skill->title)->first(); @endphp

                            <div class="row mb-3">
                                <input type="hidden" name="skills[{{ $index }}][id]"
                                    value="{{ $skill->id }}">
                                {{-- <input type="hidden" name="skills[{{ $index }}][title]"
                                    value="{{ $skill->title }}"> --}}
                                {{-- <label class="fw-semibold fs-6 mb-2">{{ $skill->title }}</label> --}}
                                <div class="fv-row mb-3 fv-plugins-icon-container col-lg-5">
                                    <select id="skill[0]"
                                        class="form-control form-control-solid mb-3 mb-lg-0 col-lg-12"
                                        name="skills[{{ $index }}][title]"
                                        onchange="skillChanged({{ $index }}, this.value)">
                                        <option value="">Select Generic Skill</option>
                                        @foreach ($masterSkills as $key => $value)
                                            <option value="{{ $value->name }}"
                                                {{ $skill->title == $value->name ? 'selected' : '' }}
                                                class="dark:bg-slate-700">{{ $value->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="fv-row mb-3 fv-plugins-icon-container col-lg-5">

                                    <select id="level[{{ $index + 1 }}]"
                                        class="form-control form-control-solid mb-3 mb-lg-0 col-lg-12"
                                        name="skills[{{ $index }}][level]">
                                        <option value="3" {{ $skill->level == 3 ? 'selected' : '' }}
                                            class="dark:bg-slate-700">Level 3</option>
                                        <option value="2" {{ $skill->level == 2 ? 'selected' : '' }}
                                            class="dark:bg-slate-700">Level 2</option>
                                        <option value="1" {{ $skill->level == 1 ? 'selected' : '' }}
                                            class="dark:bg-slate-700">Level 1</option>
                                    </select>
                                </div>
                                <div class="fv-row mb-3 fv-plugins-icon-container col-lg-2">

                                    {{-- <button type="button" id="selectLevelButton{{ $index }}" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_2"
                                        onclick="populateModal('{{ $index }}', '{{ $skill->id }}', '{{ $skill->title }}', '{{ $master_skill->level_1 }}', '{{ $master_skill->level_2 }}', '{{ $master_skill->level_3 }}', '{{ $skill->level }}')">
                                        Select Level
                                    </button> --}}

                                    <button type="button" id="selectLevelButton{{ $index }}"
                                        class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#kt_modal_2"
                                        onclick="populateModal('{{ $index }}', '{{ App\Helpers\MainHelper::escapeSpecialCharacters(json_encode($master_skill)) }}', '{{ $master_skill->name ?? '' }}', '{{ $skill->level }}')">
                                        Select Level
                                    </button>
                                </div>

                            </div>
                        @endforeach
                    
                        @if ($job->skills->count() < 5)

                            @for ($i = $index+1; $i < 5; $i++)
                                <div class="row mb-3">
                                    <div class="fv-row mb-5 fv-plugins-icon-container col-lg-5">
    
                                        <select id="skill[{{ $i }}]"  onchange="skillChanged({{ $i }}, this.value)" class="form-control form-control-solid mb-3 mb-lg-0 col-lg-6" name="skills[{{ $i }}][title]">
                                            <option value="">Select Generic Skill</option>
                                            @foreach($masterSkills as $key => $value)
                                            <option value="{{$value->name}}" class="dark:bg-slate-700">{{$value->name}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="fv-row mb-5 fv-plugins-icon-container col-lg-5">
                                        <select id="level[{{ $i }}]" class="form-control form-control-solid mb-3 mb-lg-0 col-lg-6" name="skills[{{ $i }}][level]">
                                            <option value="3" class="dark:bg-slate-700">Level 3</option>
                                            <option value="2" class="dark:bg-slate-700">Level 2</option>
                                            <option value="1" class="dark:bg-slate-700">Level 1</option>
                                        </select>
                                    </div>
                                    <div class="fv-row mb-3 fv-plugins-icon-container col-lg-2">
                                            
                                        <button type="button" id="selectLevelButton4" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_2"
                                        onclick="populateModal('4', '1', 'title', 'level_1', 'level_2', 'level_3', 'selectedlevel')">
                                        Select Level
                                        </button>
                                    </div>
                                </div>
                            @endfor
                        
                        @endif
                    </div>
                </div>   

            </div>    
                           

            <div class="card mb-5 mb-xl-8">
            
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold fs-3 mb-1">Select Status</span>

                        {{-- <span class="text-muted mt-1 fw-semibold fs-7">Over 500 new products</span> --}}
                    </h3>
                </div>

                <div class="card-body py-3">
                    <div class="fv-row mb-7 fv-plugins-icon-container col-lg-6">
                        {{-- <label for="status" class="fw-semibold fs-6 mb-2"></label> --}}
                        <select id="status" name="status" class="form-control form-control-solid mb-3 mb-lg-0" required>
                            <option value="2" class="dark:bg-slate-700" {{ $job->status == 2 ? 'selected' : '' }}>Approved</option>
                            <option value="1" class="dark:bg-slate-700" {{ $job->status == 1 ? 'selected' : '' }}>Pending</option>
                            
                        </select>
                    </div>
                </div>   

            </div>    


                            
                            
                            

                            <div class="mt-3 float-right" style="display:flex; justify-content:end">
                                <button type="submit" class="btn btn-success mx-2">Submit</button>
                                <a href="{{ route('jobs.index') }}" class="btn btn-danger">Discard</a>
                            </div>
                        {{-- </form> --}}
                    
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

@section('styles')
    <style>
        .error {
            color: red;
            margin: 3px;
        }
    </style>
@endsection

@section('scripts')

    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script> --}}

    <script>
        const originalState = {
            departmentId:   $('#department_id').val(),
            departmentName: "{{ $job->department->name }}",
            level:          $('#level-job').val(),
        };
    
        // This will always hold our pending diffs
        let pendingChanges = [];
    
        // Universal helper: remove any existing entry, then add if needed
        function toggleChange({ key, title, detailHtml, description, old_value, new_value, job_title }) {
            // 1) remove old entry if it exists
            pendingChanges = pendingChanges.filter(c => c.key !== key);
    
            // 2) if it truly changed, add it
            if (old_value !== new_value) {
                pendingChanges.push({ 
                    key, title, detailHtml, description, old_value, new_value, job_title 
                });
            }
        }
    
        // Department watcher
        $('#department_id').on('change', function() {
            const newId   = this.value;
            const newName = $('#department_id option:selected').text();
    
            toggleChange({
                key:          'change_department',
                title:        'Change Department?',
                detailHtml:   `This job will move from <b>${originalState.departmentName}</b> to <b>${newName}</b>.`,
                description:  'The job position will be moved to a new department, which may affect cross-department reporting lines.',
                old_value:    originalState.departmentName,
                new_value:    newName,
                job_title:    "{{ $job->title }}"
            });
    
            console.log('Pending Changes:', pendingChanges);
        });
    
        // Level watcher
        $('#level-job').on('change', function() {
            const newLvl = this.value;
    
            toggleChange({
                key:          'change_level',
                title:        'Change Position Level?',
                detailHtml:   `You’re about to change from <b>Level ${originalState.level}</b> to <b>Level ${newLvl}</b>.`,
                description:  `Level change may affect the job position's responsibilities and reporting structure.`,
                old_value:    originalState.level,
                new_value:    newLvl,
                job_title:    "{{ $job->title }}"
            });
    
            console.log('Pending Changes:', pendingChanges);
        });
    </script>
    

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
            var technicalSkills = @json($technicalSkills);

            $('#technicalSkills').select2();
            $('#job_description_form').submit(function(event) {
                
                var job_desc = $('#job_desc').val();
                var job_role = $('#job_role').val();
                var job_role_desc = $('#job_role_desc').val();
                var isValid = true;
                var position_code = $('#position_code').val();

                // Simple validation checks
                if (job_role_desc === '') {
                    $('#job_role_desc').next('.error').remove();
                    $('#job_role_desc').after(
                        '<span class="error">Job Role Description is required</span>');
                    isValid = false;
                } else {
                    $('#job_role_desc').next('.error').remove();
                }

                console.log(isValid,"==============ISVALIDCHEDCK-1");

                if (job_role === '') {
                    $('#job_role').next('.error').remove();
                    $('#job_role').after('<span class="error">Job Role is required</span>');
                    isValid = false;
                } else {
                    $('#job_role').next('.error').remove();
                }

                console.log(isValid,"==============ISVALIDCHEDCK-2");

                if (job_desc === '') {
                    $('#job_desc').next('.error').remove();
                    $('#job_desc').after('<span class="error">Job Description is required</span>');
                    isValid = false;
                } else {
                    $('#job_desc').next('.error').remove();
                }

                console.log(isValid,"==============ISVALIDCHEDCK-3");


                                // Check uniqueness of position code
                if (isValid) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('check-position-code') }}",
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            position_code: position_code,
                            position_update:"1",
                            job_id:"{{ $job->id }}"
                        },
                        async: false,
                        success: function(response) {
                            console.log(!response.isUnique,"=============");
                            if (!response.isUnique) {
                                $('#position_code').next('.error').remove();
                                $('#position_code').after('<span class="error">Position Code must be unique</span>');
                                isValid = false;
                            } else {
                                $('#position_code').next('.error').remove();
                            }
                        }
                    });
                }

                console.log(isValid,"==============ISVALIDCHEDCK-4");


                if ($('.critical-functions-container').find('.critical-function').length === 0) {
                $('#validationMessage').show();
                isValid = false;
                } else {
                    $('#validationMessage').hide();
                }

                console.log(isValid,"==============ISVALIDCHEDCK-5");

                if ($('.skills-container').find('.technical-skill').length === 0) {
                    $('#techvalidationmessage').show();
                    isValid = false;
                } else {
                    $('#techvalidationmessage').hide();
                }

                console.log(isValid,"==============ISVALIDCHEDCK-6");

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
                        $('select[name^="skills["][name$="[title]"]').first().after('<span class="error">At least one skill must be selected</span>');
                        skillsValid = false;
                        firstInvalidSkillElement = $('select[name^="skills["][name$="[title]"]').first();
                    }

                    if (!skillsValid) {
                        isValid = false;
                    }

                console.log(isValid,"==============ISVALIDCHEDCK-7");


                // Validate technical skills
                var selectedTechnicalSkills = [];
                var technicalSkillsValid = true;
                var firstInvalidTechnicalSkillElement = null;

                $('select[name^="technicalSkills["][name$="[id]"]').each(function() {
                    var techSkillValue = $(this).val();
                    if (techSkillValue !== "") {
                        if (selectedTechnicalSkills.includes(techSkillValue)) {
                            $(this).next('.error').remove();
                            $(this).after('<span class="error">Duplicate Technical Skill Selected</span>');
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
                    $('select[name^="technicalSkills["][name$="[id]"]').first().after('<span class="error">At least one technical skill must be selected</span>');
                    technicalSkillsValid = false;
                    firstInvalidTechnicalSkillElement = $('select[name^="technicalSkills["][name$="[id]"]').first();
                }

                if (!technicalSkillsValid) {
                    isValid = false;
                }

                console.log(isValid,"==============ISVALIDCHEDCK-8",technicalSkillsValid,selectedTechnicalSkills.length);
                
                var departmentId = $('#department_id').val();  // Make sure this matches your form's input ID
                var departmentText = $('#department_id option:selected').text();
                var currentDepartmentId = "{{ $job->department_id }}";  // Blade variable for the original department_id



                if (pendingChanges.length) {
                    event.preventDefault();

                    // build a list of <li>…</li>
                    const items = pendingChanges
                    .map(c => `<li>${c.detailHtml}</li>`)
                    .join('');

                    const descriptions = pendingChanges
                    .map(c => `<li>${c.description}</li>`)
                    .join('');

                    if (pendingChanges.length > 1) {
                            ModalManager.open({
                                module: 'jobs',
                                key:    'generic_confirm',
                                data:   { title: 'Please Confirm Changes', bodyHtml: `<ul>${items}</ul>`,descriptions:descriptions },
                                onSubmit(modalEl) {
                                    // finally let the form go through
                                    this.$('#job_description_form')[0].submit();
                                }
                            });
                    }else{
                        ModalManager.open({
                            module: 'jobs',
                            key:    pendingChanges[0].key,
                            data: {
                                        "old_value": pendingChanges[0].old_value,
                                        "new_value": pendingChanges[0].new_value,
                                        "job_title": pendingChanges[0].title,
                                    },
                            onSubmit(modalEl) {
                                // finally let the form go through
                                this.$('#job_description_form')[0].submit();
                            }
                        });
                    }
                    // Hand off to your global ModalManager
                    
                }


                // Prevent the form submission if validation fails
                if (!isValid) {
                    event.preventDefault();
                    scrollToFirstErrorField();
                }
            });
            function scrollToFirstErrorField() {
                var firstErrorField = $('.error:visible, #validationMessage:visible, #techvalidationmessage:visible').first().prev('input, textarea, select, button');
                if (firstErrorField.length) {
                    $('html, body').animate({
                        scrollTop: firstErrorField.offset().top - 100 // Adjust the offset as needed
                    }, 500);
                    firstErrorField.focus();
                }
            }
            // Removing a skill entry
            $('.skills-container').on('click', '.remove-skill', function() {

                $(this).closest('.technical-skill').remove();
            });

            $('#add_new_skill').click(function() {
                var newIndex = $('.technical-skill').length; // Calculate the new index
                // Assuming you have stored your skills data in some variable `technicalSkills` from an AJAX call

                addTechnicalSkill(newIndex,
                    technicalSkills); // You would need to make sure `technicalSkills` is up to date
            });

        function initSelect2(selector) {
            $(selector).select2({
                
                ajax: {
                    url: '{{ route("admin.technical-skill.search") }}', // Change to your actual API endpoint
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
                    class: 'form-control form-control-solid mb-3 mb-lg-0 select-skill',
                    onchange: `TechSkillChanged('${index}',this.value)`,
                    'data-control': 'select2',
                    'data-hide-search': 'false',
                    'required':true
                });

                // Populate the skill dropdown
                // $.each(technicalSkills, function(key, skill) {
                //     skillSelect.append($('<option>', {
                //         value: skill.id,
                //         text: skill.name
                //     }));
                // });

                var levelSelect = $('<select>', {
                    id: 'level[' + index + ']',
                    name: 'technicalSkills[' + index + '][level]',
                    class: 'form-control form-control-solid mb-3 mb-lg-0'
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



                skillRow.append(skillCol, levelCol,popupbuttoncol);

                $('.skills-container').append(skillRow);

                initSelect2(skillSelect);
            }




        });

        $(document).ready(function() {
            // Initialize Select2 for existing function keys
            $('.function-keys').select2({
                tags: true,
               
                createTag: function(params) {
                    if (params.term.trim() === "") {
                        return null;
                    }
                    return {
                        id: params.term,
                        text: params.term,
                        newOption: true
                    };
                }
            });

            $('#add_new_function').click(function() {
                var newIndex = $('.critical-functions-container .critical-function').length;
                // var newFunctionHtml = `
            //     <div class="critical-function row mb-3">
            //         <input type="hidden" name="functions[${newIndex}][id]" value="new">
            //         <div class="fv-row mb-5 fv-plugins-icon-container col-lg-10">
            //             <input id="name" type="text" class="form-control form-control-solid mb-3 mb-lg-0" name="functions[${newIndex}][title]" placeholder="Enter new critical work function">
            //             <select class="form-control function-keys" name="functions[${newIndex}][keys][]" multiple="multiple"></select>
            //         </div>
            //         <div class="fv-row mb-5 fv-plugins-icon-container col-lg-2">
            //             <button type="button" class="btn btn-danger remove-function" title="Remove function">Remove</button>
            //         </div>
            //     </div>`;

                var newFunctionHtml = `
                <div class="critical-function row mb-3">
                    <div class="accordion accordion-icon-collapse col-lg-10" id="kt_accordion_3">
                        <div class="mb-5">
                            <div class="accordion-header collapsed py-3 d-flex" data-bs-toggle="collapse" data-bs-target="#kt_accordion_3_item_${newIndex}">
                                <span class="accordion-icon">
                                    <iconify-icon icon="noto-v1:plus" class="accordion-icon-off fs-3 me-3"></iconify-icon>
                                    <iconify-icon icon="noto-v1:minus" class="accordion-icon-on fs-3 me-3"></iconify-icon>
                                </span>
                                <input type="hidden" name="functions[${newIndex}][id]" value="new">
                                <input type="text" class="form-control form-control-solid mb-3 mb-lg-0" name="functions[${newIndex}][title]" placeholder="Enter new critical work function" value="" required>
                            </div>
                            <div id="kt_accordion_3_item_${newIndex}" class="fs-6 collapse ps-10" data-bs-parent="#kt_accordion_3">
                                <select id="function_keys_${newIndex}" class="function-keys form-control form-control-solid mb-3" name="functions[${newIndex}][keys][]" multiple="multiple"></select>
                            </div>
                        </div>
                    </div>
                    <div class="fv-row mb-5 fv-plugins-icon-container col-lg-2" style="margin-top: 8px;">
                        <button type="button" class="btn btn-danger remove-function" title="Remove function">Remove</button>
                    </div>
                </div>
            `;

                $('.critical-functions-container').append(newFunctionHtml);

                // Initialize Select2 for the new keys field
                $('select[name="functions[' + newIndex + '][keys][]"]').select2({
                    tags: true,
                    
                    createTag: function(params) {
                        if (params.term.trim() === "") {
                            return null;
                        }
                        return {
                            id: params.term,
                            text: params.term,
                            newOption: true
                        };
                    }
                });

                
                

            });

            // Handle removal of critical functions
            $('.critical-functions-container').on('click', '.remove-function', function() {
                $(this).closest('.critical-function').remove();
            });
        });
    </script>


    <script>
        function TechSkillChanged(index, skillName) {
            console.log('technicalskill',skillName)
            $.ajax({
                url: '/admin/get-techskill-levels/' + skillName, // Adjust this URL as necessary
                type: 'GET',
                success: function(data) {
                    console.log('ajaz data',data);
                
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
            console.log(data.level_4_knowledge);
            let modalBody = $('#techskillmodal .modalbody');
            // console.log(selected_level);
            // console.log(level_2);
            modalBody.empty(); // Clear existing modal content
            console.log(modalBody);

            $('#techskillmodal .modal-title').text(skillTitle);
            // levels.forEach(level => {
                let selectedLevel = parseInt(selected_level, 10); 
                console.log('updateed selected',selectedLevel);
            for (let i = 1; i <= 6; i++) {
                console.log('descriptor',data['level_' + i + '_description']);

                let knowledge = data['level_' + i + '_knowledge'] || '';

                let ability = data['level_' + i + '_ability'] || '';

                if(data['level_' + i + '_description']){
                    console.log('in the condition')
                    modalBody.append(`
                    <div class="form-check col-lg-2">
                    
                
                            <label class="form-check-label h-100 w-100" for="level_1">
                                <div class="col-lg-12 h-100">
                                        <div class="card  card-stretch card-bordered mb-5 h-100">
                                            <div class="card-header align-items-center">
                                                <h3 class="card-title">Level ${i}</h3>
                                                <input class="form-check-input border-dark" type="radio" value="${i-1}" id="level_${i}" name="level" ${selectedLevel == i ? 'checked' : ''}>

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
                }else{
                modalBody.append(`
                <div class="form-check col-lg-2">
                
            
                        <label class="form-check-label h-100 w-100" for="level_1 ">
                            <div class="col-lg-12 h-100">
                                    <div class="card bg-gray-100  card-stretch card-bordered mb-5 h-100">
                                        <div class="card-header align-items-center">
                                            <h3 class="card-title">Level ${i}</h3>
                                            <input class="form-check-input border-dark" type="radio" value="${i-1}" id="level_${i}" name="level" ${selectedLevel == i ? 'checked' : ''}>

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

        // Generic Skills
        function skillChanged(index, skillName) {

            $.ajax({
                url: '/admin/get-skill-levels/' + skillName, // Adjust this URL as necessary
                type: 'GET',
                success: function(data) {

                    let selectLevelButton = $(`#selectLevelButton${index}`);
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

        // Generic Skills End


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
                `<li class="d-flex fs-xxl-9 align-items-center py-2"><span class="bullet me-5"></span>${item.trim()}</li>`).join(
                '');
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
                tags: true
                , createTag: function(params) {
                    if (params.term.trim() === "") {
                        return null; // Prevent blank tags
                    }
                    return {
                        id: params.term
                        , text: params.term
                        , newOption: true
                    };
                }
        });
    });
</script>

<script>
    $(document).ready(function() {
        var select4 = $('#secondary_scope_of_study');
        select4.select2({
                tags: true
                , createTag: function(params) {
                    if (params.term.trim() === "") {
                        return null; // Prevent blank tags
                    }
                    return {
                        id: params.term
                        , text: params.term
                        , newOption: true
                    };
                }
        });
    });
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
                url: '{{ route("jobs.generateRiasecCode") }}', // Replace with your actual endpoint
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
                                $(this).prop('selected', true).trigger('change');
                            }
                        });
                    });
                },
                error: function() {
                    alert('Failed to retrieve RIASEC codes.');
                }
            });
            

            // Convert the response string to an array of single characters
            const riasecArray = response.split('');

            // Select the options that match the response
            riasecArray.forEach(function(code) {
                $('#riasec option').each(function() {
                    if ($(this).val() === code) {
                        $(this).prop('selected', true).trigger('change');
                    }
                });
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
    // ==================== Business Unit > Division > Department ====================
    $(function() {
        const initBU  = "{{ old('business_unit_id', $job->business_unit_id) }}";
        const initDiv = "{{ old('division_id', $job->division_id) }}";
        const initDep = "{{ old('department_id', $job->department_id) }}";

        // Load divisions based on the selected Business Unit (BU)
        function loadDivisions(buId, selectedDiv = null) {
            $('#division').prop('disabled', true).html('<option>Loading…</option>');
            $.get(`/admin/ajax/divisions/${buId}`, data => {
                let opts = '<option value="">Select Company/Division</option>';
                data.forEach(d => {
                    opts += `<option value="${d.id}" ${d.id == selectedDiv ? 'selected' : ''}>${d.head_of_division}</option>`;
                });
                $('#division').html(opts).prop('disabled', false);
                if (selectedDiv) loadDepartments(selectedDiv, initDep);
            });
        }

        // Load departments based on the selected division
        function loadDepartments(divId, selectedDep = null) {
            $('#department_id').prop('disabled', true).html('<option>Loading…</option>');
            $.get(`/admin/ajax/departments/${divId}`, data => {
                let opts = '<option value="">Select Department</option>';
                data.forEach(d => {
                    opts += `<option value="${d.id}" ${d.id == selectedDep ? 'selected' : ''}>${d.name}</option>`;
                });
                $('#department_id').html(opts).prop('disabled', false);
            });
        }

        // On Business Unit change, reload divisions
        $('#business_unit').on('change', function() {
            const buId = $(this).val();
            $('#department_id').html('<option value="">Select Department</option>').prop('disabled', true);
            if (buId) loadDivisions(buId);
            else $('#division').html('<option value="">Select Company/Division</option>').prop('disabled', true);
        });

        // On Division change, reload departments
        $('#division').on('change', function() {
            const divId = $(this).val();
            if (divId) loadDepartments(divId);
            else $('#department_id').html('<option value="">Select Department</option>').prop('disabled', true);
        });

        if (initBU) loadDivisions(initBU, initDiv);
    });

    // ==================== Headcount Management Script ====================
    document.addEventListener('DOMContentLoaded', () => {
        const container = document.getElementById('headcount-container');
        const countBadge = document.getElementById('headcount-count');
        const superiorSelect = document.getElementById('superior');
        let superiorCodes = @json($superiorHeadcountCodes); // Initialize with backend data
        let headcountIndex = container.querySelectorAll('.headcount-item').length || 1;
        let maxSequence = Math.max(
            0,
            ...Array.from(container.querySelectorAll('input[name$="[id]"]'))
                .map(input => {
                    const parts = input.value.split('-');
                    return parseInt(parts.at(-1)); // Extract the sequence number
                }).filter(n => !isNaN(n))
        ) + 1;

        const jobId = '{{ $job->id }}';
        const positionCode = '{{ $job->code }}'; // Set the job's position code dynamically here.

        // Update superior headcount codes based on job selection
        $(superiorSelect).on('change', function() {
            const jobId = this.value;
            const selects = container.querySelectorAll('.superior-hc-select');
            if (!jobId) {
                selects.forEach(s => {
                    s.innerHTML = '<option value="">Select Superior</option>';
                    s.disabled = true;
                });
                return;
            }
            $.getJSON(`/admin/ajax/job-headcounts/${jobId}`, data => {
                const codes = data.headcount_codes || [];
                superiorCodes = codes;
                selects.forEach(s => {
                    const current = s.value || s.getAttribute('superiorCode');
                    let html = '<option value="">Select Superior Headcount ID</option>';
                    codes.forEach(c => {
                        html += `<option value="${c}"${c === current ? ' selected' : ''}>${c}</option>`;
                    });
                    s.innerHTML = html;
                    s.disabled  = false;
                });
            });
        });

        // Renumber headcount rows and fix input/select names
        function renumberHeadcounts() {
            const rows = container.querySelectorAll('.headcount-item');
            countBadge.textContent = rows.length;
            rows.forEach((row, idx) => {
                row.querySelector('.headcount-number').textContent = idx + 1;
                row.querySelectorAll('input, select').forEach(el => {
                    const suffix = el.name.replace(/^headcounts\[\d+\]/, '');
                    el.name = `headcounts[${idx}]${suffix}`;
                });
            });
        }

        // Add new headcount row
        document.getElementById('add-headcount-btn').addEventListener('click', () => {
            const idx = headcountIndex++;

            const nextSeq = (maxSequence++).toString().padStart(2, '0'); // Increment sequence number
            const newCode = `${positionCode}-${jobId}-${nextSeq}`; // Generate new Headcount Code

            const row = document.createElement('div');
            row.className = 'row headcount-item mb-3 align-items-center';
            row.dataset.default = 'false';
            row.innerHTML = `
                <div class="col-lg-2">
                    <label class="form-label">No</label>
                    <span class="form-control-plaintext headcount-number">${idx + 1}</span>
                </div>
                <div class="col-lg-3">
                    <label class="form-label">Headcount ID</label>
                    <input type="text" readonly class="form-control" name="headcounts[${headcountIndex}][id]" value="${newCode}">
                </div>
                <div class="col-lg-3">
                    <label class="form-label">Employee</label>
                    <input type="text" readonly class="form-control" name="headcounts[${idx}][employee]" value="Vacant">
                </div>
                <div class="col-lg-3">
                    <label class="form-label">Superior Headcount ID</label>
                    <select class="form-control superior-hc-select" name="headcounts[${idx}][superior]" required>
                        <option value="">Select Superior</option>
                        ${superiorCodes.map(c => `<option value="${c}">${c}</option>`).join('')}
                    </select>
                </div>
                <div class="col-lg-1 d-flex align-items-end justify-content-end">
                    <button type="button" class="btn btn-icon btn-sm btn-light-danger remove-headcount">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </div>`;
            container.appendChild(row);
            renumberHeadcounts();

            toggleChange({
                                            key:          'add_new_headcount',
                                            title:        'Confirm Superior JD Change?',
                                            detailHtml:   `You are about to <b>add a new headcount</b> to this job position.`,
                                            description:  `The headcount will be added to the org chart.`,
                                            old_value:    '',
                                            new_value:    newCode,
                                            job_title:    "{{ $job->title }}"
                                        });


            console.log(pendingChanges,"========");
                                        
        });

        // Remove headcount row
        container.addEventListener('click', e => {
            const btn = e.target.closest('.remove-headcount');
            if (!btn) return;
            const row = btn.closest('.headcount-item');
            if (row.dataset.default === 'true') return;
            row.remove();
            renumberHeadcounts();
        });

        renumberHeadcounts();
        if (superiorSelect && !superiorSelect?.value) {
            container.querySelectorAll('.superior-hc-select').forEach(s => s.disabled = true);
        }
    });



    let previousSuperiorValue = $('#superior').val(); // store initial value
    const previousSuperiorText = $('#superior option:selected').text() 
    // ==================== Superior Job Position (Select2) ====================
    $(function() {
        const currentLevel = {{ $job->level }};
        const $superior = $('#superior');
        const currentJobId = "{{ $job->id }}";

        $superior.select2({
            placeholder: 'Select Superior',
            allowClear: true,
            minimumInputLength: 1,
            ajax: {
                url: '/admin/ajax/get-superior-jobs',
                dataType: 'json',
                delay: 250,
                data: params => ({
                    q: params.term,
                    level: currentLevel,
                    job_id:currentJobId
                }),
                processResults: data => ({ results: data }),
                cache: true
            }
        });

       
    });

    // $('#superior').on('change', () => {
    //     const data = {
    //         job_id:      '{{ $job->id ?? "" }}',            // empty in create
    //         superior_id: $('#superior').val()
    //     };

    //     const jobSuperiror = "{{ $job->superior_id ?? "" }}"

    //     if (data.superior_id == jobSuperiror) {
        
    //         window.CURRENT_JOB_LEVEL = "{{ old('level', $job->level) }}";
    
    //         $.getJSON('/admin/ajax/allowed-levels', data, levels => {
    //         const $lvl = $('#level-job').empty();
    //         $lvl.append('<option value="">Select Level</option>');

    //         levels.forEach(l => {
    //             // mark selected if it matches the job's stored level
    //             const selected = (l.value == window.CURRENT_JOB_LEVEL) ? ' selected' : '';
    //             $lvl.append(`<option value="${l.value}"${selected}>${l.text}</option>`);
    //         });

    //         $lvl.prop('disabled', levels.length === 0);
    //         });
    //     }else{

    //         $.getJSON('/admin/ajax/allowed-levels', data, levels => {
    //             const $lvl = $('#level-job').empty();
    //             $lvl.append('<option value="">Select Level</option>');
    //             levels.forEach(l => $lvl.append(`<option value="${l.value}">${l.text}</option>`));
    //             $lvl.prop('disabled', levels.length === 0);
    //         });

    //     }
    
    // });

    // // On page load, trigger once to fill initial options
    // $('#superior').trigger('change');
</script>

<script>
    window.IS_EDIT        = true;
    window.IS_TOP         = {{ $job->is_top ? 'true' : 'false' }};
    window.EDIT_JOB_ID    = "{{ $job->id }}";
    window.EDIT_JOB_LEVEL = "{{ $job->level }}";
    window.EDIT_SUP_ID    = "{{ old('superior', $job->superior_id) }}";


    document.addEventListener('DOMContentLoaded', () => {
  const isEdit     = window.IS_EDIT;
  const isTopEdit  = window.IS_TOP;
  const editLevel  = Number(window.EDIT_JOB_LEVEL);
  const editSupId  = window.EDIT_SUP_ID || null;

  const superiorSelect = document.getElementById('superior');
  const levelSelect    = document.getElementById('level-job');

  /**
   * Fetch allowed levels for **edit** or **create**.
   */
  function fetchAllowedLevels(isTop = false, supId = null) {
    const params = {
      job_id:      isEdit ? window.EDIT_JOB_ID : '',
      is_top:      isTop,
      superior_id: supId
    };

    $.getJSON('/admin/ajax/allowed-levels', params, levels => {
      levelSelect.innerHTML = '<option value="">Select Level</option>';
      levels.forEach(l => {
        const sel = (l.value == String(editLevel)) ? ' selected' : '';
        levelSelect.insertAdjacentHTML(
          'beforeend',
          `<option value="${l.value}"${sel}>${l.text}</option>`
        );
      });
      levelSelect.disabled = levels.length === 0;
    });
  }

  /**
   * Initialization logic:
   * - If editing a Top-job → ignore events, fetch levels ≥ current.
   * - Else if editing non-top → bind superior change and fetch for stored sup.
   * - Else (create) → bind both checkbox & superior.
   */
  if (isEdit && isTopEdit) {
    // Top-job edit: show only levels ≥ editLevel
    fetchAllowedLevels(true, null);
  }
  else if (isEdit) {
    // Non-top edit: watch superior select
    // superiorSelect.addEventListener('change', () => {
    //   fetchAllowedLevels(false, superiorSelect.value);
    // });

    $('#superior').on('select2:opening', function(e) {
    // Save the current value *before* opening
    previousSuperiorValue = $(this).val();
});
    $('#superior')
            .on('select2:select', function(e) {            
                e.preventDefault(); // prevent selection for now

                const selectedElement = this;
                const newSelectedValue = $(this).val();
                const text1 = $('#superior option:selected').text() 

                            ModalManager.open({
                                module: 'jobs',
                                key:    'change_superior',
                                data: {
                                    
                                        },
                                onSubmit(modalEl) {
                                    // finally let the form go through
                                    $(selectedElement).val(newSelectedValue).trigger('change');
                                    previousSuperiorValue = newSelectedValue; // update previous value
                                    fetchAllowedLevels(false, newSelectedValue);
                                    const bsModal = bootstrap.Modal.getInstance(modalEl);
                                        if (bsModal) bsModal.hide();

                                        toggleChange({
                                            key:          'change_superior_confirmation',
                                            title:        'Confirm Superior JD Change?',
                                            detailHtml:   `You’re about to change Superior Position from <b>${previousSuperiorText} </b> to <b>${text1} </b>.`,
                                            description:  `Superior Position change may affect the job position's responsibilities and reporting structure.`,
                                            old_value:    previousSuperiorText,
                                            new_value:    text1,
                                            job_title:    "{{ $job->title }}"
                                        });    
                                },
                                onClose: (modal) => {
                                    $(selectedElement).val(previousSuperiorValue).trigger('change');
                                }
                            });

            })
            .on('select2:clear', function() {
                // empty out the Superior‐Headcount dropdowns
                fetchAllowedLevels(false, null);
            });

    // Initial load for stored superior
    fetchAllowedLevels(false, editSupId);
  }
});



</script>


    
@endsection
