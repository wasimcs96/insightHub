@extends('admin.layout.app')

@section('title', 'Setting - Job Descriptions')
@section('styles')
    <style>
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

        .description-card,
        .critical-work-functions-card,
        .technical-skills-card,
        .general-skills-card,
        .submit-card,
        .role-detail-card {
            display: none;
        }

        .inner-div-jd-desc {
            display: grid;
            grid-template-columns: 32% 32% 32%;
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

        .card-body {
            padding: 24px !important;
        }

        .card-body h6 {
            color: #3E3E3E;
            font-size: 12px;
            font-weight: 600;
            line-height: 16px;
        }

        .card-body div:last-child {
            margin: 0 !important;
        }

        .app-content {
            padding: 45px 187px 190px 187px;
            ;
        }

        .float-lg-left button,
        .submit-card a {
            padding: 14px 20px !important;
            font-size: 14px;
            font-weight: 600;
            line-height: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .badge-light-primary {
            border-radius: 80px !important;
            background: #FFF6EA !important;
            color: #7C4A0E;
            font-size: 12px;
            font-weight: 400;
            line-height: 16px;
            padding: 5px 10px;
            margin-bottom: 6px;
        }

        .skill-content {
            color: #3E3E3E;
            font-size: 14px;
            line-height: 20px;
            line-height: 20px;
            margin-bottom: 24px;

        }

        .skill-desc {
            font-weight: 600;
            margin: 0px 0px 4px 0px;
        }

        .skill-bot {
            font-weight: 400;
        }

        .feedback-btn div.active {
            color: #f7941d;
        }

        .heading-emotions {
            color: #071437;
font-size: 14px;
font-weight: 600;
height: 34px;
border: 0 !important;
        }

        .heading-emotions-desc {
            color: #4B5675;
font-size: 12px;
font-weight: 500;
line-height: 16px;
        }

        .modal-footer {
            padding: 0px 24px 24px 24px;
            border: none;
        }

        .modal-body {
            padding: 24px 24px 24px 24px;
        }

        .emotions-div label {
            cursor: pointer;
border: 2px solid #F1F1F4;
        }

        .emotions-div label:hover {
border: 2px solid #F7941C;
        }

        .icon_wrapper {
            border: none !important;
        }

        .form-check-input[type=radio] {
            border-radius: 4px;
        }

        input[type="radio"] {
            accent-color: #F7941C !important;
            width: 24px;
            height: 24px;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border: 2px solid #DBDFE9;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.2s, border-color 0.2s;
        }

        input[type="radio"]:checked {
            background-color: #F7941C;
            border: 4px solid #fff;
            box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
        }

        .form-check-input:checked[type=radio] {
            --bs-form-check-bg-image: none;
        }

        @media (max-width: 1281px) {
            .app-content {
                padding: 45px 70px 50px 70px;
            }
        }
        .btn-check {
            position: absolute;
            opacity: 0;
        }

        .btn-check + label {
            cursor: pointer;
        }

        .feedback-label {
            border: 2px solid transparent;
            border-radius: 8px;
            padding: 10px;
            cursor: pointer;
            transition: border-color 0.3s;
        }

        .feedback-label.selected {
            border-color: #F7941C; /* Highlight color */
        }

        .feedback-label:hover {
            border-color: #6c757d; /* Optional hover effect */
        }

    </style>
@endsection
@section('content')
    <div class="d-flex flex-column flex-column-fluid">

        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">

            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">



                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                        Job Create
                    </h1>
                    <!--end::Title-->


                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="#" class="text-muted text-hover-primary">
                                Dashboard </a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted"> - Settings - Job Descriptions - View Job Description </li>
                        <!--end::Item-->

                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->

            </div>

            <!--end::Actions-->
            <!--end::Toolbar container-->
        </div>

        <div id="kt_app_content" class="app-content  flex-column-fluid ">


            <!--begin::Content container-->
            <div id="kt_app_content_container">

                <div class="card  shadow-sm mb-4">
                    <div class="bg-primary card-header">
                        <h3 class="card-title text-light"><iconify-icon icon="prime:sparkles"
                                class="fs-2x mr-2"></iconify-icon>Generate New JD</h3>

                    </div>
                    <div class="card-body">
                        <form action="" action="post">
                            @csrf
                            <div class="form-group col-lg-12 p-0">
                                <div class="mb-5">
                                    <label for="sector" class="fw-semibold fs-6 mb-2">Job Role</label>
                                    <input class="form-control" name="job_role" placeholder="Enter Job Role">
                                </div>
                                <div class="mb-5">
                                    <label for="sector" class="fw-semibold fs-6 mb-2">Job Description</label>
                                    <textarea class="form-control" placeholder="Enter Job Description" name="job_description" rows="8" cols="50"></textarea>
                                </div>
                            </div>
                            <div class="float-lg-left">
                                <button type="submit" class="btn btn-primary"><iconify-icon icon="ci:arrows-reload-01"
                                        style="font-size: 18px;"></iconify-icon>Generate New JD</button>
                            </div>
                        </form>
                    </div>

                </div>

                <div class="card role-detail-card shadow-sm mb-5">
                    <div class="card-header">
                        <h3 class="card-title">About Job Description</h3>
                    </div>
                    <div class="card-body py-5">
                        <div class="inner-div-jd-desc">
                            <div>
                                <p class="fw-semibold mb-1">Sector</p>
                                <p class="sector_title"></p>
                            </div>
                            <div>
                                <p class="fw-semibold mb-1">Job Role</p>
                                <p class="job_role_title"></p>
                            </div>
                            <div>
                                <p class="fw-semibold mb-1">Related Job Role in the skills framework</p>
                                <p class="related_job_role_title"></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card description-card shadow-sm mb-4">
                    <div class="card-header">
                        <h3 class="card-title">Job Description</h3>
                    </div>
                    <div class="card-body py-5"></div>
                </div>

                <div class="card critical-work-functions-card shadow-sm mb-4">
                    <div class="card-header">
                        <h3 class="card-title">Critical Work Functions</h3>
                    </div>
                    <div class="card-body py-5"></div>
                </div>

                <div class="card technical-skills-card shadow-sm mb-4">
                    <div class="card-header">
                        <h3 class="card-title">Technical Skills</h3>
                    </div>
                    <div class="card-body py-5"></div>
                </div>

                <div class="card general-skills-card shadow-sm mb-4">
                    <div class="card-header">
                        <h3 class="card-title">General Skills & Competencies</h3>
                    </div>
                    <div class="card-body py-5"></div>
                </div>

                <div class="card submit-card shadow-sm mb-4">

                    <div class="card-body  py-5">

                        <div class="mb-0 d-flex col-lg-12 p-0">
                            {{-- <a href="#"
                                class="align-items-center mr-3 btn-jd-submit btn btn-primary d-flex justify-content-center"
                                id="save_company_jd">
                                <iconify-icon icon="lucide:save" class="fa-1-5 mr-2"></iconify-icon>
                                Save to Company JD
                            </a> --}}

                            {{-- <form id="saveCompanyJDForm" action="/admin/ai/llm/save/companyJd" method="POST" style="display: inline;">
                                @csrf
                                <input type="hidden" name="redisKey" id="redisKeyInput" value=""> <!-- Hidden field for Redis key -->
                                <button type="submit" class="align-items-center mr-3 btn-jd-submit btn btn-primary d-flex justify-content-center" id="save_company_jd">
                                    <iconify-icon icon="lucide:save" class="fa-1-5 mr-2"></iconify-icon>
                                    Save to Company JD
                                </button>
                            </form> --}}

                            {{-- <form id="saveCompanyJDForm" style="display: inline;">
                                @csrf
                                <input type="hidden" name="redisKey" id="redisKeyInput" value=""> <!-- Hidden field for Redis key -->
                                <button type="button" class="align-items-center mr-3 btn-jd-submit btn btn-primary d-flex justify-content-center" id="save_company_jd">
                                    <iconify-icon icon="lucide:save" class="fa-1-5 mr-2"></iconify-icon>
                                    Save to Company JD
                                </button>
                            </form> --}}

                            <button type="button" class="align-items-center mr-3 btn-jd-submit btn btn-primary d-flex justify-content-center" id="openJDModal">
                                <iconify-icon icon="lucide:save" class="fa-1-5 mr-2"></iconify-icon>
                                Save to Company JD
                            </button>

                            <a href="/admin/ai/jd/response/edit" id="edit-url"
                                class="aalign-items-center btn-jd-submit btn btn-outline btn-outline-primary d-flex justify-content-center mr-4">
                                <iconify-icon icon="lucide:edit-3" class="fa-1-5 mr-2"></iconify-icon>
                                Edit
                            </a>

                            <div class="d-flex align-items-center gap-3 feedback-btn" style="color: #3E3E3E;">
                                <div class="thumbs-up" data-bs-toggle="modal" data-bs-target="#feedbackModal" id="thumbs-up">
                                    <iconify-icon icon="ic:round-thumb-up" class="cursor-pointer" width="28" height="28" data-bs-toggle="tooltip" data-bs-placement="top" title="Good Result"></iconify-icon>
                                </div>
                                <div class="thumbs-down" data-bs-toggle="modal" data-bs-target="#feedbackModal" id="thumbs-down">
                                    <iconify-icon data-bs-toggle="modal" data-bs-target="#feedbackModal" id="thumbs-down" icon="ri:thumb-down-line" class="cursor-pointer" width="26" height="26" data-bs-toggle="tooltip" data-bs-placement="top" title="Bad Result"></iconify-icon>
                                </div>
                                <p class="m-0 fs-6">How is this result?</p>
                            </div>

                        </div>
                    </div>

                </div>
                <!-- Thumbs Up Modal -->
                <div class="modal fade" id="feedbackModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="feedbackModalLabel">Feedback</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <h6>Rate the accuracy of the results<span style="color: #F24130">*</span></h6>
                                <form id="feedback-form">
                                    <!-- Feedback Options -->
                                    <div class="row text-center mb-8 gap-5 m-auto emotions-div">
                                    
                                        <div class="col p-0">
                                            <input type="radio" class="btn-check" name="accuracy" id="accurate" value="5" autocomplete="off">
                                            <label class="gap-5 d-flex flex-column feedback-label card p-5 h-100" for="accurate">
                                                <div class="heading-emotions">Accurate</div>
                                                <div class="icon_wrapper">
                                                    <img src="{{ asset('images/feedback-modal/LOL.png') }}" alt="Accurate" />
                                                </div>
                                                <small class="heading-emotions-desc">The results met my expectations</small>
                                            </label>
                                        </div>
                                        <div class="col p-0">
                                            <input type="radio" class="btn-check" name="accuracy" id="partiallyAccurate" value="4" autocomplete="off">
                                            <label class="gap-5 d-flex flex-column feedback-label card p-5 h-100" for="partiallyAccurate">
                                              <div class="heading-emotions">Partially Accurate</div>
                                              <div class="icon_wrapper"><img src="{{ asset('images/feedback-modal/Happy.png') }}"  value="3" alt="Partially Accurate" /></div>
                                              <small class="heading-emotions-desc">The results were somewhat relevant but need improvement</small>
                                            </label>
                                          </div>
                                          <div class="col p-0">
                                            <input type="radio" class="btn-check" name="accuracy" id="notAccurate" value="3" autocomplete="off">
                                            <label class="gap-5 d-flex flex-column feedback-label card p-5 h-100" for="notAccurate">
                                              <div class="heading-emotions">Not Accurate</div>
                                              <div class="icon_wrapper"><img src="{{ asset('images/feedback-modal/Neutral.png') }}"  alt="Not Accurate" /></div>
                                              <small class="heading-emotions-desc">The results were not relevant to my query</small>
                                            </label>
                                          </div>
                                          <div class="col p-0">
                                            <input type="radio" class="btn-check" name="accuracy" id="confusing" value="2" autocomplete="off">
                                            <label class="gap-5 d-flex flex-column feedback-label card p-5 h-100" for="confusing">
                                              <div class="heading-emotions">Confusing</div>
                                              <div class="icon_wrapper"><img src="{{ asset('images/feedback-modal/Boring.png') }}"  alt="Confusing" /></div>
                                              <small class="heading-emotions-desc">The results were unclear or difficult to understand</small>
                                            </label>
                                          </div>
                                          <div class="col p-0">
                                            <input type="radio" class="btn-check" name="accuracy" id="incomplete" value="1" autocomplete="off">
                                            <label class="gap-5 d-flex flex-column feedback-label card p-5 h-100" for="incomplete">
                                              <div class="heading-emotions">Incomplete</div>
                                              <div class="icon_wrapper"><img src="{{ asset('images/feedback-modal/Help.png') }}"  alt="Incomplete" /></div>
                                              <small class="heading-emotions-desc">The results were insufficient or missing key elements</small>
                                            </label>
                                          </div>
                                        <!-- Repeat for other options -->
                                    </div>
                                    <div class="mb-8">
                                        <label for="comments" class="form-label">Share additional comments to help us improve</label>
                                        <textarea class="form-control" id="comments" rows="3" placeholder="I think it’s very helpful!"></textarea>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-primary" id="submit-feedback">Submit Feedback</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bootstrap Modal -->
                <div class="modal fade" id="JDModal" tabindex="-1" aria-labelledby="JDModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="JDModalLabel">Save Company JD</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="saveCompanyJDForm">
                                    @csrf
                                    <input type="hidden" name="redisKey" id="redisKeyInput" value=""> <!-- Hidden field for Redis key -->
                                    @php 
                                        $orgDepartments = App\Models\Department::where('company_id', auth()->user()->id)
                                        ->where('status', 1)
                                        ->get();   
                                    @endphp
                                    <!-- Select Box -->
                                    <div class="row">
                                    <div class="form-group">
                                        <div class="fv-row  fv-plugins-icon-container">
                                            <label for="department" class="fw-semibold fs-6 mb-2 required">Department</label>
                                            {{-- <input id="department" type="text" class="form-control  mb-lg-0" name="department"
                                                placeholder="Select an Option"> --}}
                                                <select id="department" class="form-control form-control mb-3 mb-lg-0 select-department"
                                                name="org_department" required>
                                                <option value="" class="dark:bg-slate-700">Select Department</option>
                                                @foreach ($orgDepartments as $key2 => $value2)
                                                    <option value="{{ $value2->id }}" class="dark:bg-slate-700">
                                                        {{ $value2->name ?? '-' }}</option>
                                                @endforeach
                                            </select>
            
                                        </div>
                                    </div>
                                </div>

                                {{-- <div class="row">
        
                                    <div class="fv-row mb-3 fv-plugins-icon-container col-lg-6">
                                        <label for="heads" class="fw-semibold fs-6 mb-2">Select Position Level*</label>
                                        <select id="level-job" class="form-control mb-3" name="level" onchange="updatePositionCode()">
                                            <option value="1" class="dark:bg-slate-700">Level 1 </option>
                                            <option value="2" class="dark:bg-slate-700">Level 2 </option>
                                            <option value="3" class="dark:bg-slate-700">Level 3 </option>
                                            <option value="4" class="dark:bg-slate-700">Level 4 </option>
                                            <option value="5" class="dark:bg-slate-700">Level 5 </option>
                                            <option value="6" class="dark:bg-slate-700">Level 6 </option>
                                            <option value="7" class="dark:bg-slate-700">Level 7 </option>
                                            <option value="8" class="dark:bg-slate-700">Level 8 </option>
                                            <option value="9" class="dark:bg-slate-700">Level 9 </option>
                                            <option value="10" class="dark:bg-slate-700">Level 10 </option>
                                            <option value="11" class="dark:bg-slate-700">Level 11 </option>
                                            <option value="12" class="dark:bg-slate-700">Level 12 </option>
                                            <option value="13" class="dark:bg-slate-700">Level 13 </option>
                                        </select>
                                    </div>
                                    <div class="fv-row mb-7 fv-plugins-icon-container col-lg-6">
                                        <label for="position_code" class="fw-semibold fs-6 mb-2">Position Code*</label>
                                        <input id="position_code" type="text" min="1" class="form-control mb-3 mb-lg-0"
                                            name="position_code" placeholder="Position Code" required>
                
                                    </div>
                
                                </div> --}}
                                @php
                                        $existingJobs = \App\Models\Job::where('is_primary', 0)->get();
                                @endphp

                                <div class="row">
                                    <div class="fv-row mb-7 fv-plugins-icon-container col-lg-6">
                                        <label for="superior" class="fw-semibold fs-6 mb-2">Select Immediate Superior</label>
                                        <select id="superior" class="form-control mb-3 mb-lg-0" data-placeholder="Select Superior"
                                            data-control="select2" data-hide-search="false" name="superior">
                                            <option value="" class="dark:bg-slate-700">Select Immediate Superior</option>
                                            @foreach ($existingJobs as $key => $value)
                                                <option value="{{ $value->id }}" class="dark:bg-slate-700">{{ $value->title ?? '-' }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="fv-row mb-7 fv-plugins-icon-container col-lg-6">
                                        <label for="subordinates" class="fw-semibold fs-6 mb-2 required">Select Immediate Subordinates</label>
                                        <select id="subordinates" class="form-select mb-3 mb-lg-0" data-control="select2"
                                            data-close-on-select="false" name="subordinates[]" data-placeholder="Select Subordinates"
                                            multiple required>
                                            <option value="" class="dark:bg-slate-700">Select Immediate Subordinates</option>
                                            @foreach ($existingJobs as $key => $value)
                                                <option value="{{ $value->id }}" class="dark:bg-slate-700">{{ $value->title ?? '-' }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="fv-row mb-7 row fv-plugins-icon-container col-lg-12 p-0">
                                    @php
                                        $education_levels = \App\Models\MasterEducationLevel::all();
                                        $higher_learning_institutions = \App\Models\MasterHigherLearningInstitution::all();
                                        $edu_program = \App\Models\MasterScopeOfStudy::all();
                                    @endphp
                                    <div class="input-area col-xl-4">
                                        <label for="select" class="form-label required">Select Education Level</label>
                                        <select id="education_level" class="form-control" name="education_level" required>
                                            <option value="" class="dark:bg-slate-700">Select Education Level</option>
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
                                        <label for="select" class="form-label required">Select Scope of Study</label>
                                        <select id="scope_of_study" class="form-control" name="scope_of_study" required>
                                            <option value="" class="dark:bg-slate-700">Select Scope of Study</option>
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
                                        <label for="secondary_scope_of_study" class="fw-semibold fs-6 mb-2 required">Secondary Scope of
                                            Study</label>
                                        <select id="secondary_scope_of_study" class="form-select mb-3 mb-lg-0"
                                            data-control="select2" data-close-on-select="false" name="secondary_scope_of_study[]"
                                            data-placeholder="Enter Secondary Scope of Study" multiple required>
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
                                                id="kt_tagify_1" name="professional_certificate" />
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

                                <div class="row">
                                        <div class="fv-row mb-3 fv-plugins-icon-container col-lg-6" style="padding: 0px">
                                            <label for="headcount" class="fw-semibold fs-6 mb-2 required">No. of Headcount</label>
                                            <input id="headcount" type="text" min="1" class="form-control  mb-lg-0" name="heads"
                                                placeholder="Number of heads" required>
            
                                        </div>

                                        <div class="fv-row mb-7 fv-plugins-icon-container col-lg-6">
                                            <label for="job_role_desc" class="fw-semibold fs-6 mb-2">Select Status</label>
                                            <select id="status" name="status" class="form-control mb-3 mb-lg-0" required
                                                data-control="select2" data-placeholder="Select the Sector">
                                                <option></option>
                                                <option value="2" class="dark:bg-slate-700" selected>Approved</option>
                                                <option value="1" class="dark:bg-slate-700">Pending</option>
                                            </select>
                                        </div>
                                </div>

                                    <button type="button" id="submitJDForm" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Content container-->
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script>
        var jdGenartorUniqueId = "";
        document.querySelector('button[type="submit"]').addEventListener('click', function(e) {
            e.preventDefault(); // Prevent the default form submission

            // Retrieve input values
            const jobRoleInput = document.querySelector('input[name="job_role"]').value.trim();
            const jobDescriptionInput = document.querySelector('textarea[name="job_description"]').value.trim();

            // Clear any existing error messages
            document.querySelectorAll('.error-message').forEach(el => el.remove());

            // Validation
            let isValid = true;

            if (!jobRoleInput) {
                isValid = false;
                const error = document.createElement('p');
                error.classList.add('text-danger', 'error-message');
                error.innerText = 'Job Role is required.';
                document.querySelector('input[name="job_role"]').after(error);
            }

            if (!jobDescriptionInput) {
                isValid = false;
                const error = document.createElement('p');
                error.classList.add('text-danger', 'error-message');
                error.innerText = 'Job Description is required.';
                document.querySelector('textarea[name="job_description"]').after(error);
            }

            // If validation fails, stop further execution
            if (!isValid) {
                return;
            }
            showOverlay(); // Show overlay before the request starts
            // Make the API call if validation passes
            fetch('/admin/ai/jd/generator', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    body: JSON.stringify({
                        job_role: jobRoleInput,
                        job_description: jobDescriptionInput
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.data) {
                        sessionStorage.setItem('ajaxResponse', JSON.stringify(data.data));
                        // Assuming API returns data with JD details
                        console.log('JD generated successfully:', data.data);
                        console.log('llm output', data.data.llmOutput.description);
                        let jobDescription = '';
                        if (data.data.llmOutput.description != 'Not Available') {
                            jobDescription = data.data.llmOutput.description;
                        } else {
                            jobDescription = data.data.description;
                        }
                        // Show the generated data on the page (adjust based on actual API response)
                        jdGenartorUniqueId = data.data.jobGenerationId;

                        document.querySelector('.description-card').style.display = 'block';
                        document.querySelector('.description-card .card-body').innerHTML =
                            `<p>${jobDescription}</p>`;

                        // Update other sections as needed
                        const criticalWorkFunctionsHTML = data.data.critical_functions
                            .map(cwf => `
                    <div style="margin-bottom: 24px">
                        <h6 class="mb-3">${cwf.cwf_description}</h6>
                        ${cwf.cwf_keys.keytasks.map(task => `<span class="badge badge-light-primary">${task}</span>`).join(' ')}
                    </div>
                `).join('');
                        document.querySelector('.critical-work-functions-card .card-body').innerHTML =
                            criticalWorkFunctionsHTML;
                        document.querySelector('.critical-work-functions-card').style.display = 'block';

                        // Populate Technical Skills
                        const technicalSkillsHTML = data.data.technical_skills
                            .map(skill => {
                                const level = skill.preferred_level; // Preferred level (e.g., "4")
                                const knowledgeKey = `level_${level}_knowledge`;
                                const abilityKey = `level_${level}_ability`;
                                return `
                            <div class="skill-content">
                                <h5 class="align-items-center d-flex flex-nowrap skill-desc">${skill.name}<iconify-icon icon="ic:sharp-star" class="ml-2 mr-2 " style="color:#F7941D"></iconify-icon>${skill.preferred_level}</h5>
                                <p class="skill-bot">${skill.description}</p>
                                
                            </div>
                        `;
                            }).join('');
                        document.querySelector('.technical-skills-card .card-body').innerHTML =
                            technicalSkillsHTML;
                        document.querySelector('.technical-skills-card').style.display = 'block';

                        // Populate General Skills & Competencies
                        const generalSkillsHTML = data.data.soft_skills
                            .map(skill => {
                                const preferredLevel = getPreferredLevel(skill.preferred_level);
                                const level = preferredLevel // Preferred level (e.g., "basic", "advanced")
                                const knowledgeKey = `level_${level}_knowledge`;
                                const abilityKey = `level_${level}_ability`;
                                const levelDescriptor = `level_${level}`;

                                console.log('Level Descriptor', levelDescriptor);
                                console.log('Preferred Level', preferredLevel);

                                return `
                            <div class="skill-content">
                                <h5 class="skill-desc">${skill.competency}<iconify-icon icon="ic:sharp-star" class="ml-2 mr-2 " style="color:#F7941D"></iconify-icon>${level}</h5>
                                <p class="skill-bot">${skill.description || ''}</p>
                                </div>`;
                            }).join('');

                        document.querySelector('.sector_title').textContent = data.data.sector_name;
                        document.querySelector('.job_role_title').textContent = data.data.title;
                        document.querySelector('.related_job_role_title').textContent = data.data.title;


                        document.querySelector('.general-skills-card .card-body').innerHTML = generalSkillsHTML;

                        document.querySelector('.general-skills-card').style.display = 'block';
                        document.querySelector('.role-detail-card').style.display = 'block';

                        document.querySelector('.submit-card').style.display = 'block';

                        var editLink = document.getElementById('edit-url');
                        // var jdLink = document.getElementById('save_company_jd');

                
                // Define the dynamic value to append (e.g., jobId)
                var jobId = data.data.job_id; // Replace with your dynamic value
                var trackName = data.data.sub_sector_name;
                var sectorName = data.data.sector_name;
                var redis = data.data.redis_key;
                sessionStorage.setItem('redisKey', redis);
                document.getElementById('redisKeyInput').value = redis;

                // Directly set the href value
                // editLink.href = '/admin/setting/job-description/create/' + jobId + '/'+ trackName + '/'+ sectorName + '?specificKey=ai-genrater&redisKey=' + encodeURIComponent(redis);
                editLink.href = '/admin/ai/llm/create' + '?redisKey=' + encodeURIComponent(redis);
                // jdLink.href = '/admin/ai/llm/save/companyJd' + '?redisKey=' + encodeURIComponent(redis);

                    } else {
                        console.error('Error:', data.error || 'Unexpected error occurred.');
                        alert('Failed to generate JD. Please try again later.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An unexpected error occurred. Please try again later.');
                })
                .finally(() => {
                    // Hide the loader after the request is complete (whether successful or not)
                    hideOverlay(); // Hide overlay when the request completes
                });
        });

        
        function getPreferredLevel(level) {
            switch (level?.toLowerCase()) {
                case 'basic':
                    return 1;
                case 'intermediate':
                    return 2;
                case 'advanced':
                    return 3;
                default:
                    return 1; // Return empty string if no match
            }
        }
    
        // document.getElementById('save_company_jd').addEventListener('click', function(e) {
        //     e.preventDefault(); // Prevent default behavior

        //     // Show success Swal alert
        //     Swal.fire({
        //         icon: 'success',
        //         title: 'Saved to Company JD',
        //         text: 'The Job Description has been successfully saved to the Company JD.',
        //         confirmButtonText: 'OK'
        //     }).then((result) => {
        //         if (result.isConfirmed) {
        //             // Redirect to the desired URL on confirm button click
        //             window.location.href = '/admin/ai/jd/generator/create'; // Replace with your URL
        //         }
        //     });
        // });
    
       $(document).ready(function() {
        document.querySelectorAll('input[name="accuracy"]').forEach((radio) => {
            radio.addEventListener('change', function () {
                // Remove 'selected' class from all labels
                document.querySelectorAll('.feedback-label').forEach((label) => {
                    label.classList.remove('selected');
                });

                // Add 'selected' class to the associated label
                const selectedLabel = document.querySelector(`label[for="${this.id}"]`);
                if (selectedLabel) {
                    selectedLabel.classList.add('selected');
                }
            });
        });

        // Remove 'selected' class when the modal is closed
        $('#feedbackModal').on('hidden.bs.modal', function () {
            document.querySelectorAll('.feedback-label').forEach((label) => {
                label.classList.remove('selected');
            });
            // Reset the radio buttons
            document.querySelectorAll('input[name="accuracy"]').forEach((radio) => {
                radio.checked = false;
            });
        });

        // Remove 'selected' class when the "Submit Feedback" button is clicked
        $('#submit-feedback').on('click', function () {
            document.querySelectorAll('.feedback-label').forEach((label) => {
                label.classList.remove('selected');
            });
            // Optionally hide the modal after feedback is submitted
            $('#feedbackModal').modal('hide');
        });

        let feedbackType = ''; 
        $(".thumbs-up, .thumbs-down").click(function() {
            feedbackType = $(this).hasClass('thumbs-up') ? 'thumbs-up' : 'thumbs-down';
            // Clear previous form data
            $("#feedback-form")[0].reset();
            $("#comments").val('');

            // Remove 'active' class from both buttons and add to the clicked one
            $(".thumbs-up, .thumbs-down").removeClass('active');
            $(this).addClass('active');

            // Show the modal
            $('#feedbackModal').modal('show');
        });
        jdGenartorUniqueId = "bfc9e8cb-638b-447f-8a94-d6dfcd28aecb";
        //Check GIT CHerry
        // Handle form submission
        $('#submit-feedback').click(function() {
            let selectedAccuracy = $("input[name='accuracy']:checked");
            if (selectedAccuracy.length > 0 && jdGenartorUniqueId) {
                let feedbackRating = selectedAccuracy.attr('id'); // Selected radio button ID
                let feedbackLabel = $(`label[for="${feedbackRating}"]`); // Fetch associated label
                let feedbackDescription = feedbackLabel.find('.heading-emotions-desc').text().trim(); // Get description text
                let additionalFeedback = $('#comments').val();

                // Create the payload
                const payload = {
                    job_generation_id: jdGenartorUniqueId,
                    thumbs_up: feedbackType === 'thumbs-up' ? 1 : 0,
                    thumbs_down: feedbackType === 'thumbs-down' ? 1 : 0,
                    feedback_rating: feedbackRating,
                    feedback: feedbackDescription,
                    additional_feedback: additionalFeedback,
                };
                showOverlay()
                // Make the AJAX request
                $.ajax({
                    url: '/admin/sendFeedbackRating', // Update with your route
                    method: 'POST',
                    data: JSON.stringify(payload),
                    contentType: 'application/json',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // Laravel CSRF token
                    },
                    success: function(response) {
                        hideOverlay();
                        // alert('Feedback submitted successfully!');
                        toastr.success('Feedback submitted successfully!','Status')
                        $('#feedbackModal').modal('hide');
                        // Update the text of the paragraph
                        $('.feedback-btn p').text('Your Feedback is submitted');
                    },
                    error: function() {
                        alert('An error occurred. Please try again.');
                        hideOverlay();
                    }
                });
            } else {
                alert('Please select an accuracy rating!');
            }
    });
});


document.getElementById('submit-feedback').addEventListener('click', function (e) {
    e.preventDefault(); // Prevent default behavior

    // Retrieve input values
    const jobRole = document.querySelector('input[name="job_role"]').value.trim();
    const jobDescription = document.querySelector('textarea[name="job_description"]').value.trim();
    const selectedFeedbackRating = document.querySelector('input[name="accuracy"]:checked');
    const additionalComment = document.getElementById('comments').value.trim();
    const feedbackType = document.querySelector('.thumbs-up.active') ? 1 : 0; // 1 for thumbs-up, 0 for thumbs-down

    // Validate input fields
    let isValid = true;
    document.querySelectorAll('.error-message').forEach(el => el.remove()); // Remove old error messages

    if (!jobRole) {
        isValid = false;
        const error = document.createElement('p');
        error.classList.add('text-danger', 'error-message');
        error.innerText = 'Job Role is required.';
        document.querySelector('input[name="job_role"]').after(error);
    }

    if (!jobDescription) {
        isValid = false;
        const error = document.createElement('p');
        error.classList.add('text-danger', 'error-message');
        error.innerText = 'Job Description is required.';
        document.querySelector('textarea[name="job_description"]').after(error);
    }

    if (!selectedFeedbackRating) {
        isValid = false;
        alert('Please select a feedback rating.');
    }

    if (!isValid) {
        return; // Stop further execution if validation fails
    }

    // Prepare data payload
    const payload = {
        role: jobRole,
        description: jobDescription,
        sector: sessionStorage.getItem('ajaxResponse') ? JSON.parse(sessionStorage.getItem('ajaxResponse')).sector_name : null,
        sub_sector: sessionStorage.getItem('ajaxResponse') ? JSON.parse(sessionStorage.getItem('ajaxResponse')).sub_sector_name : null,
        json: sessionStorage.getItem('ajaxResponse'),
        feedback: feedbackType,
        feedback_rating: selectedFeedbackRating.value,
        feedback_comment: additionalComment,
    };
    showOverlay()

    // Make AJAX POST request
    fetch('/admin/feedback/store', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: JSON.stringify(payload),
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                hideOverlay();
                // Optionally reset the form and close the modal
                // toastr.success('Feedback submitted successfully!','Status')
                document.getElementById('feedback-form').reset();
                document.querySelector('.thumbs-up').classList.remove('active');
                document.querySelector('.thumbs-down').classList.remove('active');
                $('#feedbackModal').modal('hide');
                // $('.feedback-btn p').text('Your Feedback is submitted');
            } else {
                alert(data.message || 'Failed to submit feedback. Please try again.');
                hideOverlay();
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An unexpected error occurred. Please try again later.');
        });
});

// $(document).ready(function () {
//     // Event listener for the "Save to Company JD" button
//     $('#save_company_jd').on('click', function (e) {
//         e.preventDefault();

//         // Retrieve the Redis key from sessionStorage
//         const redisKey = sessionStorage.getItem('redisKey');

//         if (!redisKey) {
//             alert('Redis key not found. Please generate the Job Description first.');
//             return;
//         }

//         // Set the Redis key into the hidden input field (optional if not sending via form data)
//         $('#redisKeyInput').val(redisKey);

//         // Prepare the data to be sent via AJAX
//         const formData = {
//             redisKey: redisKey,
//             _token: $('input[name="_token"]').val() // CSRF token for Laravel security
//         };
//         showOverlay()

//         // Make the AJAX POST request
//         $.ajax({
//             url: '/admin/ai/llm/save/companyJd', // Your Laravel route
//             method: 'POST',
//             data: formData,
//             success: function (response) {
//                 if (response.success) {
//                     hideOverlay();
//                     toastr.success('Job created successfully!', 'Success'); // Using toastr for notifications
//                 } else {
//                     hideOverlay();
//                     toastr.error('Job creation failed. Please try again.', 'Error');
//                 }
//             },
//             error: function (xhr, status, error) {
//                 console.error('Error:', error);
//                 toastr.error('An unexpected error occurred.', 'Error');
//             }
//         });
//     });
// });



// $(document).ready(function () {
//     // Open modal when clicking the "Save to Company JD" button
//     $("#openJDModal").click(function () {
//         $("#JDModal").modal("show");
//     });

//     // Handle modal submit button click
//     $("#submitJDForm").click(function () {
//         var redisKey = $("#redisKeyInput").val();
//         var department = $("#department").val();
//         var heads = $("#headcount").val();

//         // Validate fields
//         if (!selectedOption || !inputText) {
//             alert("Please fill in all fields.");
//             return;
//         }

//         // Prepare form data
//         var formData = {
//             _token: $('input[name="_token"]').val(), // CSRF token
//             redisKey: redisKey,
//             department: department,
//             heads: heads
//         };

//         showOverlay()

//         // AJAX request
//         $.ajax({
//             url: "/admin/ai/llm/save/companyJd", // Change to your API endpoint
//             type: "POST",
//             data: formData,
//             success: function (response) {
//                 alert("Data saved successfully!");
//                 if (response.success) {
//                     hideOverlay();
//                     $("#JDModal").modal("hide"); // Hide modal after success
//                     toastr.success('Job created successfully!', 'Success'); // Using toastr for notifications
//                 } else {
//                     hideOverlay();
//                     $("#JDModal").modal("hide"); // Hide modal after success
//                     toastr.error('Job creation failed. Please try again.', 'Error');
//                 }
//             },
//             error: function (xhr, status, error) {
//                 alert("Something went wrong. Please try again.");
//                 console.log(xhr.responseText);
//             }
//         });
//     });
// });

    $(document).ready(function () {
        // Open modal when clicking the "Save to Company JD" button
        $("#openJDModal").click(function () {
            $("#JDModal").modal("show");
        });

        $('#JDModal').modal({
            backdrop: 'static',  // Prevent closing when clicking outside
            keyboard: false      // Prevent closing with 'Esc' key
        });

        // Close modal when clicking the close button
        $('.close').on('click', function () {
            $('#JDModal').modal('hide');
        });

        // Ensure redisKey is set when receiving data
        function setRedisKey(data) {
            if (data && data.data && data.data.redis_key) {
                var redis = data.data.redis_key;
                sessionStorage.setItem('redisKey', redis);
                $("#redisKeyInput").val(redis); // Correctly setting the hidden field
            } else {
                console.error("Redis key not found in data:", data);
            }
        }

        // Handle modal submit button click
        $("#submitJDForm").on('click', function (e) {
            e.preventDefault();
            let isValid = true;

            // Loop through all required fields in the form
            $('#saveCompanyJDForm [required]').each(function () {
                if ($(this).val() === '') {
                    isValid = false;
                    let fieldLabel = $(this).closest('.fv-row, .form-group, .input-area').find('label').text().trim();
                    toastr.error(fieldLabel + ' is required');
                    $(this).focus();
                    return false; // Exit loop on first invalid field
                }
            });

            const subordinates = $("#subordinates").val();
            if (!subordinates || subordinates.length === 0) {
                isValid = false;
                toastr.error('Select Immediate Subordinates is required');
                $("#subordinates").focus();
                return;
            }

            const secondaryScope = $("#secondary_scope_of_study").val();
            if (!secondaryScope || secondaryScope.length === 0) {
                isValid = false;
                toastr.error('Secondary Scope of Study is required');
                $("#secondary_scope_of_study").focus();
                return;
            }

            if (!isValid) {
                return;
            }
            showOverlay();
            var redisKey = $("#redisKeyInput").val();
            var department = $("#department").val();
            var heads = $("#headcount").val();
            var status = $("#status").val();
            // var level = $("#level-job").val();
            // var positionCode = $("#position_code").val();
            var immediateSuperior = $("#superior").val();
            var immediateSubordinates = $("#subordinates").val();
            var educationLevel = $("#education_level").val();
            var scopeStudy = $("#scope_of_study").val();
            var secondaryScopeStudy = $("#secondary_scope_of_study").val();
            var professionalCertificates = $("#kt_tagify_1").val();
            var relevantTraining = $("#kt_tagify_2").val();
            var workExperience = $("#work_experience").val();
            // Validate fields
            if (!department || !heads) {
                alert("Please fill in all fields.");
                return;
            }

            // Prepare form data
            var formData = {
                _token: $('input[name="_token"]').val(), // CSRF token
                redisKey: redisKey,
                department: department,
                heads: heads,
                status: status,
                // level: level,
                // positionCode: positionCode,
                immediateSuperior: immediateSuperior,
                immediateSubordinates: immediateSubordinates,
                educationLevel: educationLevel,
                scopeStudy: scopeStudy,
                secondaryScopeStudy: secondaryScopeStudy,
                professionalCertificates: professionalCertificates,
                relevantTraining: relevantTraining,
                workExperience: workExperience,

            };

            // AJAX request
            $.ajax({
                url: "/admin/ai/llm/save/companyJd", // Change to your API endpoint
                type: "POST",
                data: formData,
                success: function (response) {
                    if (response.success) {
                        hideOverlay();
                        $("#JDModal").modal("hide"); // Hide modal after success
                        toastr.success('Job created successfully!', 'Success'); // Using toastr for notifications
                        window.location.href = response.redirectUrl;
                    } else {
                        hideOverlay();
                        toastr.error('Job creation failed. Please try again.', 'Error');
                    }
                },
                error: function (xhr, status, error) {
                    hideOverlay();
                    alert("Something went wrong. Please try again.");
                    console.log(xhr.responseText);
                }
            });
        });
    });



    </script>

{{-- <script>
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

        positionCodeInput.value = positionCodes[selectedLevel];
    }
</script> --}}

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
@endsection
