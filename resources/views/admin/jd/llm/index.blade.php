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

        .app-content {
            padding: 45px 187px 225px 187px;
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
            padding: 45px 70px 50px 70px;
        }
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
                            Job Description </li>
                        <!--end::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->

                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            View Job Description </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->

                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            Edit Job Description </li>
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
            <form action="{{ route('admin.ai.llm.store') }}" method="post">
                @csrf
                <input type="hidden" name="jd_from" value="5">
                <input type="hidden" name="riasec" value="{{ $cachedData['top3riasec'] }}">
                <input type="hidden" name="title" value="{{ $cachedData['title'] }}">
                <input type="hidden" name="level" value="{{ $cachedData['level'] }}">
                {{-- <input type="hidden" name="technicalskill" value="{{ json_encode($cachedData['llmOutput']['technical_skills']) }}"> --}}

                <input type="hidden" name="status" value="2">

                <div class="card  shadow-sm mb-4">
                    <div class=" card-header">
                        <h3 class="card-title">About this JD</h3>

                    </div>
                    <div class="card-body">
                        
                            <div class="form-group d-flex justify-content-evenly col-lg-12 p-0">
                                <div class="col-lg-4">
                                    <label for="sector" class="fw-semibold fs-6 mb-2">Sector</label>
                                    <input id="sector" name="sector" class="form-control" placeholder="Select the Sector"
                                        style="
                                    background: #ffffff;
                                "
                                        readonly>

                                </div>

                                <div class="col-lg-4">
                                    <label for="job_role" class="fw-semibold fs-6 mb-2">Job Role</label>

                                    <input id="job_role" name="job_role" class="form-control" placeholder="Job Role"
                                        style="
                                    background: #ffffff;
                                "
                                        readonly>
                                </div>

                                <div class="col-lg-4">
                                    <label for="related_job_role" class="fw-semibold fs-6 mb-2">Related Job Role in the
                                        skills framework</label>

                                    <input id="related_job_role" class="form-control"
                                        style="
                                    background: #ffffff;
                                "
                                        placeholder="Select the Related Job Role" readonly>

                                </div>
                            </div>
                            {{-- <div class="float-lg-right mr-3">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div> --}}

                        <div id="role-details" class="mt-4"></div>

                    </div>

                </div>

                <div class="card  shadow-sm mb-4">
                    <div class="card-header">
                        <h3 class="card-title">General Info</h3>

                    </div>
                    <div class="card-body  py-5">
                        <div class="mb-5">
                            <label for="" class="form-label">Job Role Description</label>
                            <textarea class="form-control" name="description" data-kt-autosize="true" rows="5" cols="50"></textarea>
                        </div>
                        <div class="mb-5 row">
                            <div class="fv-row  fv-plugins-icon-container col-lg-6">
                                <label for="position_level" class="fw-semibold fs-6 mb-2 required">Position Level</label>
                                {{-- <input id="position_level" type="text" class="form-control  mb-lg-0"
                                    name="position_level" placeholder="Position Level"> --}}
                                    <select id="level-job" class="form-control form-control mb-3 mb-lg-0 " onchange="updatePositionCode()"  name="level_job">
                                        <option value=""class="dark:bg-slate-700">Select Position Level</option>
                                          
                                        <option value="1" {{ $cachedData['level'] == 1 ? 'selected' : '' }}  class="dark:bg-slate-700">Level 1</option>
                                        <option value="2" {{ $cachedData['level'] == 2 ? 'selected' : '' }}  class="dark:bg-slate-700">Level 2</option>
                                        <option value="3" {{ $cachedData['level'] == 3 ? 'selected' : '' }}  class="dark:bg-slate-700">Level 3</option>
                                        <option value="4"  {{ $cachedData['level'] == 4 ? 'selected' : '' }} class="dark:bg-slate-700">Level 4 </option>
                                        <option value="5" {{ $cachedData['level'] == 5 ? 'selected' : '' }} class="dark:bg-slate-700">Level 5 </option>
                                        <option value="6" {{ $cachedData['level'] == 6 ? 'selected' : '' }}  class="dark:bg-slate-700">Level 6 </option>
                                        <option value="7" {{ $cachedData['level'] == 7 ? 'selected' : '' }}  class="dark:bg-slate-700">Level 7</option>
                                        <option value="8" {{ $cachedData['level'] == 8 ? 'selected' : '' }} class="dark:bg-slate-700">Level 8 </option>
                                        <option value="9" {{ $cachedData['level'] == 9 ? 'selected' : '' }} class="dark:bg-slate-700">Level 9 </option>
                                        <option value="10" {{ $cachedData['level'] == 10 ? 'selected' : '' }} class="dark:bg-slate-700">Level 10 </option>
                                        <option value="11" {{ $cachedData['level'] == 11 ? 'selected' : '' }} class="dark:bg-slate-700">Level 11 </option>
                                        <option value="12" {{ $cachedData['level'] == 12 ? 'selected' : '' }} class="dark:bg-slate-700">Level 12 </option>
                                        <option value="13" {{ $cachedData['level'] == 13 ? 'selected' : '' }} class="dark:bg-slate-700">Level 13</option>
                                        
                                </select>

                            </div>
                            <div class="fv-row fv-plugins-icon-container col-lg-6">
                                <label for="position_code" class="fw-semibold fs-6 mb-2 required">Position Code</label>
                                <input id="position_code" type="text" class="form-control  mb-lg-0" name="position_code"
                                    placeholder="Position Code">

                            </div>
                        </div>
                        <div class="mb-5 row">
                            <div class="fv-row  fv-plugins-icon-container col-lg-12">
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
                                <label for="subordinates" class="fw-semibold fs-6 mb-2">Select Immediate Subordinates</label>
                                <select id="subordinates" class="form-select mb-3 mb-lg-0" data-control="select2"
                                    data-close-on-select="false" name="subordinates[]" data-placeholder="Select Subordinates"
                                    multiple>
                                    <option value="" class="dark:bg-slate-700">Select Immediate Subordinates</option>
                                    @foreach ($existingJobs as $key => $value)
                                        <option value="{{ $value->id }}" class="dark:bg-slate-700">{{ $value->title ?? '-' }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-5 row">
                            <div class="fv-row mb-7 fv-plugins-icon-container col-lg-12" style="padding: 0px">
                                <label for="headcount" class="fw-semibold fs-6 mb-2 required">No. of Headcount</label>
                                <input id="headcount" type="text" min="1" class="form-control  mb-lg-0" name="heads"
                                    placeholder="Number of heads" required>

                            </div>
                        </div>

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

                <div class="card  shadow-sm mb-4">
                    <div class="card-header">
                        <h3 class="card-title">Critical Work Functions</h3>

                    </div>
                    <div class="card-body  py-5">

                        <div class="critical-functions-container">
                            <!-- Dynamic content will be inserted here -->
                        </div>

                        {{-- <button type="button" id="add_new_function" class="add-function mt-5"
                            style="background:#F7941C"><iconify-icon icon="stash:plus-solid"
                                style="font-size: 20px"></iconify-icon> Add New
                            Function</button> --}}
                        <div id="validationMessage" style="color: red; display: none;">Atlest one Critical Work Function
                            is required.</div>
                    </div>

                </div>

                <div class="card  shadow-sm mb-4">
                    <div class="card-header">
                        <h3 class="card-title"> Technical Skills</h3>

                    </div>
                    <div class="card-body  py-5">

                        <div id="skills-container"></div>
                        {{-- <button type="button" id="add_new_skill" class="add-function mt-5"
                            style="background:#F7941C"><iconify-icon icon="stash:plus-solid"
                                style="font-size: 20px"></iconify-icon> Add New Skill</button> --}}
                        <div id="techvalidationmessage" style="color: red; display: none;">Atlest One Technical Skill is
                            required.</div>
                    </div>

                </div>
                <div class="card  shadow-sm mb-4">
                    <div class="card-header">
                        <h3 class="card-title"> General Skills & Competencies</h3>

                    </div>
                    @php $masterSkills = []; @endphp

                    <div class="card-body py-5">
                        <!-- Generic Skill 1 -->
                        {{-- <div class="row mb-3">
                                <div class="fv-row mb-5 fv-plugins-icon-container col-lg-8">
                                    <input
                                        id="skill[0]"
                                        class="form-control mb-3 mb-lg-0"
                                        name="skills[0][title]"
                                        placeholder="Enter Generic Skill"
                                    />
                                </div>
                                <div class="fv-row mb-5 fv-plugins-icon-container col-lg-4 d-flex">
                                    <select
                                        id="level[0]"
                                        class="form-control form-select mb-3 mb-lg-0 col-lg-6 rounded-right"
                                        name="skills[0][level]"
                                    >
                                        <option value="3">Level 3</option>
                                        <option value="2">Level 2</option>
                                        <option value="1">Level 1</option>
                                    </select>
                                    <button
                                        type="button"
                                        id="selectLevelButton0"
                                        class="btn btn-outline btn-outline-primary border-2 me-5 d-flex justify-content-center align-item-center rounded-left"
                                        data-bs-toggle="modal"
                                        data-bs-target="#kt_modal_2"
                                        onclick="populateModal('0', '1', 'title', 'level_1', 'level_2', 'level_3', 'selectedlevel')"
                                    >
                                        Select Level
                                        <iconify-icon icon="iconamoon:search-bold" class="fa-1-5 ml-2"></iconify-icon>
                                    </button>
                                </div>
                            </div>
                        
                            <!-- Generic Skill 2 -->
                            <div class="row mb-3">
                                <div class="fv-row mb-5 fv-plugins-icon-container col-lg-8">
                                    <input
                                        id="skill[1]"
                                        class="form-control mb-3 mb-lg-0"
                                        name="skills[1][title]"
                                        placeholder="Enter Generic Skill"
                                    />
                                </div>
                                <div class="fv-row mb-5 fv-plugins-icon-container col-lg-4 d-flex">
                                    <select
                                        id="level[1]"
                                        class="form-control form-select mb-3 mb-lg-0 col-lg-6 rounded-right"
                                        name="skills[1][level]"
                                    >
                                        <option value="3">Level 3</option>
                                        <option value="2">Level 2</option>
                                        <option value="1">Level 1</option>
                                    </select>
                                    <button
                                        type="button"
                                        id="selectLevelButton1"
                                        class="btn btn-outline btn-outline-primary border-2 me-5 d-flex justify-content-center align-item-center rounded-left"
                                        data-bs-toggle="modal"
                                        data-bs-target="#kt_modal_2"
                                        onclick="populateModal('1', '1', 'title', 'level_1', 'level_2', 'level_3', 'selectedlevel')"
                                    >
                                        Select Level
                                        <iconify-icon icon="iconamoon:search-bold" class="fa-1-5 ml-2"></iconify-icon>
                                    </button>
                                </div>
                            </div>
                        
                            <!-- Generic Skill 3 -->
                            <div class="row mb-3">
                                <div class="fv-row mb-5 fv-plugins-icon-container col-lg-8">
                                    <input
                                        id="skill[2]"
                                        class="form-control mb-3 mb-lg-0"
                                        name="skills[2][title]"
                                        placeholder="Enter Generic Skill"
                                    />
                                </div>
                                <div class="fv-row mb-5 fv-plugins-icon-container col-lg-4 d-flex">
                                    <select
                                        id="level[2]"
                                        class="form-control form-select mb-3 mb-lg-0 col-lg-6 rounded-right"
                                        name="skills[2][level]"
                                    >
                                        <option value="3">Level 3</option>
                                        <option value="2">Level 2</option>
                                        <option value="1">Level 1</option>
                                    </select>
                                    <button
                                        type="button"
                                        id="selectLevelButton2"
                                        class="btn btn-outline btn-outline-primary border-2 me-5 d-flex justify-content-center align-item-center rounded-left"
                                        data-bs-toggle="modal"
                                        data-bs-target="#kt_modal_2"
                                        onclick="populateModal('2', '1', 'title', 'level_1', 'level_2', 'level_3', 'selectedlevel')"
                                    >
                                        Select Level
                                        <iconify-icon icon="iconamoon:search-bold" class="fa-1-5 ml-2"></iconify-icon>
                                    </button>
                                </div>
                            </div>
                        
                            <!-- Generic Skill 4 -->
                            <div class="row mb-3">
                                <div class="fv-row mb-5 fv-plugins-icon-container col-lg-8">
                                    <input
                                        id="skill[3]"
                                        class="form-control mb-3 mb-lg-0"
                                        name="skills[3][title]"
                                        placeholder="Enter Generic Skill"
                                    />
                                </div>
                                <div class="fv-row mb-5 fv-plugins-icon-container col-lg-4 d-flex">
                                    <select
                                        id="level[3]"
                                        class="form-control form-select mb-3 mb-lg-0 col-lg-6 rounded-right"
                                        name="skills[3][level]"
                                    >
                                        <option value="3">Level 3</option>
                                        <option value="2">Level 2</option>
                                        <option value="1">Level 1</option>
                                    </select>
                                    <button
                                        type="button"
                                        id="selectLevelButton3"
                                        class="btn btn-outline btn-outline-primary border-2 me-5 d-flex justify-content-center align-item-center rounded-left"
                                        data-bs-toggle="modal"
                                        data-bs-target="#kt_modal_2"
                                        onclick="populateModal('3', '1', 'title', 'level_1', 'level_2', 'level_3', 'selectedlevel')"
                                    >
                                        Select Level
                                        <iconify-icon icon="iconamoon:search-bold" class="fa-1-5 ml-2"></iconify-icon>
                                    </button>
                                </div>
                            </div>
                        
                            <!-- Generic Skill 5 -->
                            <div class="row mb-3">
                                <div class="fv-row mb-5 fv-plugins-icon-container col-lg-8">
                                    <input
                                        id="skill[4]"
                                        class="form-control mb-3 mb-lg-0"
                                        name="skills[4][title]"
                                        placeholder="Enter Generic Skill"
                                    />
                                </div>
                                <div class="fv-row mb-5 fv-plugins-icon-container col-lg-4 d-flex">
                                    <select
                                        id="level[4]"
                                        class="form-control form-select mb-3 mb-lg-0 col-lg-6 rounded-right"
                                        name="skills[4][level]"
                                    >
                                        <option value="3">Level 3</option>
                                        <option value="2">Level 2</option>
                                        <option value="1">Level 1</option>
                                    </select>
                                    <button
                                        type="button"
                                        id="selectLevelButton4"
                                        class="btn btn-outline btn-outline-primary border-2 me-5 d-flex justify-content-center align-item-center rounded-left"
                                        data-bs-toggle="modal"
                                        data-bs-target="#kt_modal_2"
                                        onclick="populateModal('4', '1', 'title', 'level_1', 'level_2', 'level_3', 'selectedlevel')"
                                    >
                                        Select Level
                                        <iconify-icon icon="iconamoon:search-bold" class="fa-1-5 ml-2"></iconify-icon>
                                    </button>
                                </div>
                            </div>
                        
                            <!-- Generic Skill 6 -->
                            <div class="row mb-3">
                                <div class="fv-row mb-5 fv-plugins-icon-container col-lg-8">
                                    <input
                                        id="skill[5]"
                                        class="form-control mb-3 mb-lg-0"
                                        name="skills[5][title]"
                                        placeholder="Enter Generic Skill"
                                    />
                                </div>
                                <div class="fv-row mb-5 fv-plugins-icon-container col-lg-4 d-flex">
                                    <select
                                        id="level[5]"
                                        class="form-control form-select mb-3 mb-lg-0 col-lg-6 rounded-right"
                                        name="skills[5][level]"
                                    >
                                        <option value="3">Level 3</option>
                                        <option value="2">Level 2</option>
                                        <option value="1">Level 1</option>
                                    </select>
                                    <button
                                        type="button"
                                        id="selectLevelButton5"
                                        class="btn btn-outline btn-outline-primary border-2 me-5 d-flex justify-content-center align-item-center rounded-left"
                                        data-bs-toggle="modal"
                                        data-bs-target="#kt_modal_2"
                                        onclick="populateModal('5', '1', 'title', 'level_1', 'level_2', 'level_3', 'selectedlevel')"
                                    >
                                        Select Level
                                        <iconify-icon icon="iconamoon:search-bold" class="fa-1-5 ml-2"></iconify-icon>
                                    </button>
                                </div>
                            </div> --}}
                        <div id="generic-skills-container"></div>

                    </div>




                </div>
                <div class="card  shadow-sm mb-4">
                    <div class="card-header">
                        <h3 class="card-title">Review Status</h3>

                    </div>
                    <div class="card-body  py-5">

                        <div class="col-lg-4">
                            <label for="job_role_desc" class="fw-semibold fs-6 mb-2">Select Status</label>
                            <select class="form-select" data-control="select2" data-placeholder="Select Status">
                                <option></option>
                                <option value="1">Approved</option>
                                <option value="2">Rejected</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="card  shadow-sm mb-4">
                    <div class="card-header">
                        <h3 class="card-title"> Submit Job Create?</h3>

                    </div>
                    <div class="card-body  py-5">

                        <div class="mb-8 col-lg-4 gap-3 d-flex submit-job-bot">
                            <button type="submit">
                                {{-- <iconify-icon icon="flowbite:plus-outline"></iconify-icon> --}}
                                Submit
                            </button>

                            <a href="/admin/setting/job-description/create">
                                <iconify-icon icon="gg:trash"></iconify-icon>
                                Discard
                            </a>
                        </div>
                    </div>

                </div>
            </form>
            </div>
            <!--end::Content container-->


        </div>
    </div>

    {{-- Generic Skill Modal Start --}}
    <div class="modal bg-body fade" tabindex="-1" id="genericSkillModal">
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

                {{-- <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary save-btn" data-bs-dismiss="modal"
                        onclick="updateSkillLevel(this)">Save changes</button>

                </div> --}}
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
                    {{-- <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary save-btn" data-bs-dismiss="modal"
                        onclick="updateTechSkillLevel(this)">Save changes</button> --}}

                </div>
            </div>
        </div>
    </div>
    {{-- Technical Skill Modal End --}}
@endsection

@section('scripts')

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
            $('#superior').select2();


            $('#job_description_form').submit(function(event) {
                var job_desc = $('#job_desc').val();
                var heads = $('#heads').val();
                var position_code = $('#position_code').val();
                var job_role = $('#job_role').val();
                var job_role_desc = $('#job_role_desc').val();
                var isValid = true;
                console.log("dbhjsdfhjsdf");



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
            $('#org_department_filter').on('change', function() {
                var departmentId = $(this).val();


                var ajaxUrl = "by_org_department";

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



        // function technicalpopulateModal(index, data, skillTitle, selected_level) {
        //     console.log('technicalpoopupmodal', data);

        //     data = JSON.parse(data);

        //     let modalBody = $('#techskillmodal .modalbody');
        //     // console.log(selected_level);
        //     // console.log(level_2);
        //     modalBody.empty(); // Clear existing modal content


        //     $('#techskillmodal .modal-title').text(skillTitle);
        //     // levels.forEach(level => {
        //     // let selectedLevel = 1 + parseInt(selected_level, 10); 
        //     let selectedLevel = parseInt(selected_level, 10);
        //     console.log('updateed selected', selectedLevel);
        //     for (let i = 1; i <= 6; i++) {
        //         console.log('descriptor', data['level_' + i + '_description']);

        //         let knowledge = data['level_' + i + '_knowledge'] || '';

        //         let ability = data['level_' + i + '_ability'] || '';

        //         if (data['level_' + i + '_description']) {
        //             console.log('in the condition')
        //             modalBody.append(`
    //         <div class="form-check col-lg-2">


    //                 <label class="form-check-label h-100 w-100" for="level_1">
    //                     <div class="col-lg-12 h-100">
    //                             <div class="  card card-stretch card-bordered mb-5 h-100">
    //                                 <div class="card-header align-items-center">
    //                                     <h3 class="card-title">Level ${i}</h3>
    //                                     <input class="form-check-input border-dark" type="radio" value="${i}" id="level_${i}" name="level" ${selectedLevel == i ? 'checked' : ''}>

    //                                 </div>
    //                                 <div class="card-body">
    //                                     <h5 class="fs-6">${data['level_' + i + '_description']}</h5>
    //                                     <div class="p-3">
    //                                         <h4 class="fs-6">Knowledge</h4>
    //                                         <div class="d-flex flex-column">

    //                                         ${createListFromString(knowledge)}
    //                                         </div>

    //                                     </div>
    //                                     <div class="p-3">
    //                                         <h4 class="fs-6">Ability</h4>
    //                                         <div class="d-flex flex-column">
    //                                         ${createListFromString(ability)}

    //                                         </div>
    //                                     </div>
    //                                 </div>

    //                             </div>
    //                     </div>
    //                 </label>
    //             </div>
    //         `);
        //         } else {
        //             modalBody.append(`
    //         <div class="form-check col-lg-2">


    //                 <label class="form-check-label h-100 w-100" for="level_1 ">
    //                     <div class="col-lg-12 h-100">
    //                             <div class="bg-gray-100  card card-stretch card-bordered mb-5 h-100">
    //                                 <div class="card-header align-items-center">
    //                                     <h3 class="card-title">Level ${i}</h3>
    //                                     <input class="form-check-input border-dark" type="radio" value="${i}" id="level_${i}" name="level" ${selectedLevel == i ? 'checked' : ''}>

    //                                 </div>
    //                                 <div class="card-body">
    //                                     <h5></h5>
    //                                     <div class="p-3">


    //                                     </div>
    //                                     <div class="p-3">

    //                                     </div>
    //                                 </div>

    //                             </div>
    //                     </div>
    //                 </label>
    //             </div>
    //         `);
        //         }

        //     }


        //     $('#techskillmodal .save-btn').data('skill-id', index); // Set skill ID on save button for later
        // }



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
            return string.replace(/\\/g, '\\\\') // Escape backslashes
                .replace(/'/g, "\\'") // Escape single quotes
                .replace(/"/g, '\\"') // Escape double quotes
                .replace(/\n/g, '\\n') // Escape newlines
                .replace(/\r/g, '\\r') // Escape carriage returns
                .replace(/\t/g, '\\t'); // Escape tabs
        }


        function createListFromString(input) {
            // Check if input is an array
            if (Array.isArray(input)) {
                return input
                    .filter(item => item.trim() !== '') // Remove empty items
                    .map(item =>
                        `<li class="d-flex align-items-center py-2 fs-xxl-9"><iconify-icon icon="lets-icons:check-fill" class="orange-check me-3"></iconify-icon>${item.trim()}</li>`
                    )
                    .join('');
            }

            // If input is not an array, assume it's a string
            if (typeof input === 'string') {
                return input
                    .split(',') // Split by commas
                    .filter(item => item.trim() !== '') // Remove empty items
                    .map(item =>
                        `<li class="d-flex align-items-center py-2 fs-xxl-9"><iconify-icon icon="lets-icons:check-fill" class="orange-check me-3"></iconify-icon>${item.trim()}</li>`
                    )
                    .join('');
            }

            // If input is neither an array nor a string, return an empty list
            return '';
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
                $('.select-department').prop('required', true);
                formReset();
                $('.existing_dept').hide();
                $('#org_department_filter').prop('required', false);
            } else if (selectedValue == '2') {
                $('.existing_dept').hide();
                $('#riasec-block').hide();
                $('#riasec').prop('required', false);
                $('#org_department_filter').prop('required', false);

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

                $('.existing_selects').show();
                $('.existing_selects').prop('required', true);
            } else {
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
            var options = '<option value="">Please Select Sector First</option>';
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

    <script>
        const technicalSkillsData = {};
        const genericSkillsData = {};
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const sector = urlParams.get('sector');
            const track = urlParams.get('track');
            const role = urlParams.get('role');
            // const ajaxResponse = JSON.parse(sessionStorage.getItem('ajaxResponse'));
            const ajaxResponse = @json($cachedData['llmOutput']);
                if (ajaxResponse) {
                    console.log('Full AJAX Response:', ajaxResponse);
                    console.log('Full AJAX Response data description:', ajaxResponse.description);

                    populateForm(ajaxResponse);
                    // Use the response as needed
                    // document.querySelector('textarea[name="job_description"]').value = ajaxResponse.description || '';
                    // You can also populate other fields from the response
                    // Example:
                    // document.querySelector('.some-other-field').innerText = ajaxResponse.data.someKey || '';
                } else {
                    console.warn('No AJAX response found in session storage.');
                }
                



            // Add event listener for adding new critical work functions
            document.getElementById('add_new_function').addEventListener('click', function() {
                const newIndex = document.querySelectorAll(
                    '.critical-functions-container .critical-function').length;
                addCriticalFunction(newIndex);
            });

            // Event listener for adding new technical skills
            // document.getElementById('add_new_skill').addEventListener('click', function() {
            //     const newIndex = document.querySelectorAll('#skills-container .technical-skill').length;
            //     addTechnicalSkill(newIndex);
            // });

            // Event listener for adding new generic skills
            // document.getElementById('add_new_generic_skill').addEventListener('click', function() {
            //     const newIndex = document.querySelectorAll('#generic-skills-container .generic-skill')
            //         .length;
            //     addGenericSkill(newIndex);
            // });
        });

        function populateForm(data) {
            // Populate Sector, Track, Role
            // console.log('populate form',data.sub_sector_name);
            document.getElementById('sector').value = data.sector_name || '';
            document.getElementById('job_role').value = data.title || '';
            document.getElementById('related_job_role').value = data.title || '';

            // Job Role Description
            document.querySelector('textarea[name="description"]').value = data.description || '';

            // Populate Critical Work Functions
            const criticalFunctionsContainer = document.querySelector('.critical-functions-container');
            criticalFunctionsContainer.innerHTML = '';
            data.critical_functions.forEach((cwf, index) => {
                addCriticalFunction(index, cwf);
            });

            // Populate Technical Skills
            const skillsContainer = document.getElementById('skills-container');
            skillsContainer.innerHTML = '';
            data.technical_skills.forEach((skill, index) => {
                console.log('addTechnicalSkill', skill);
                addTechnicalSkill(index, skill);
            });

            // Populate Generic Skills
            const genericSkillsContainer = document.getElementById('generic-skills-container');
            genericSkillsContainer.innerHTML = '';
            data.soft_skills.forEach((skill, index) => {
                addGenericSkill(index, skill);
            });
        }

        function addCriticalFunction(index, cwf = null) {
            const functionHtml = `
            <div class="critical-function row mb-3">
                <div class="col-lg-12">
                    <div class="d-flex gap-5 mb-3">
                        <button type="button" class="remove-function btn btn-outline btn-outline-primary d-flex justify-content-center" title="Remove function"><iconify-icon icon="gg:trash" class="fa-1-5"></iconify-icon></button>
                        <input type="text" class="form-control input-style" name="functions[${index}][title]" placeholder="Critical Work Function" value="${cwf?.cwf_description || ''}" required>
                    </div>
                    <select class="form-control input-style select2 mb-3 col-lg-11" style="float:right" name="functions[${index}][tasks][]" multiple>
                        ${cwf?.cwf_keys?.keytasks
                            ?.map((task) => `<option value="${task}" selected>${task}</option>`)
                            .join('') || ''}
                    </select>
                </div>
            </div>`;

            const container = document.querySelector('.critical-functions-container');
            container.insertAdjacentHTML('beforeend', functionHtml);

            // Initialize the new select with Select2
            $(`select[name="functions[${index}][tasks][]"]`).select2({
                tags: true,
                placeholder: 'Add tasks',
                createTag: function(params) {
                    return {
                        id: params.term,
                        text: params.term,
                        newOption: true
                    };
                },
            });

            // Add event listener to remove the function
            container
                .querySelector(`.critical-function:nth-child(${index + 1}) .remove-function`)
                .addEventListener('click', function() {
                    this.closest('.critical-function').remove();
                });
        }

        // function addTechnicalSkill(index, skill = null) {

        //     const skillData = JSON.stringify(skill); // Convert the skill object to a JSON string
        //     technicalSkillsData[index] = skill;
        //     console.log('technicalSkillsData', technicalSkillsData);

        //     const escapedSkillData = escapeSpecialCharacters(skillData); // Escape the JSON string
        //     console.log('escapedSkillData', escapedSkillData)
        //     console.log('UnescapedSkillData', skill)

        //     const skillHtml = `
        //     <div class="technical-skill row mb-8">
        //         <div class="fv-row mb-2 fv-plugins-icon-container col-lg-9 d-flex gap-7">
        //             <button type="button" class="btn btn-outline btn-outline-primary d-flex justify-content-center remove-skill">
        //                 <iconify-icon icon="gg:trash" class="fa-1-5"></iconify-icon>
        //             </button>
                
        //             <input type="text" class="form-control input-style " id="technicalSkills[${index}]" name="technicalSkills[${index}][id]" placeholder="Technical Skill" value="${skill?.name || ''}" required readonly>
        //         </div>
        //         <div class="fv-row mb-2 fv-plugins-icon-container d-flex col-lg-3 btn-vl-container justify-content-end">
                    
        //             <select id="level[${index}]" name="technicalSkills[${index}][level]" class="form-select col-lg-7 col-md-10 btn-level mb-3 mb-lg-0 rounded-right">
        //                 ${Array.from({ length: 6 }, (_, i) => 6 - i) 
        //                     .map(level => {
        //                         const descriptionKey = `level_${level}_description`;
        //                         const levelDescription = skill[descriptionKey] || null;

        //                         if (levelDescription) {
        //                             return `<option value="${level}" 
        //                                             ${(skill?.preferred_level) == level ? 'selected' : ''} 
        //                                             class="dark:bg-slate-700">
        //                                         Level ${level}
        //                                     </option>`;
        //                         }
        //                         return ''; // Skip if no description
        //                     })
        //                     .join('')}
        //             </select>
        //         <button 
        //                 type="button" 
        //                 id="selectTechLevelButton${index}" 
        //                 class="btn-view" 
        //                 data-bs-toggle="modal" 
        //                 data-bs-target="#techskillmodal" 
        //                 onclick="technicalpopulateModal(${index})">
        //                 View Level
        //                 <iconify-icon icon="iconamoon:search-bold" class="fa-1-5 ml-2"></iconify-icon>
        //             </button>
        //         </div>
        //         <div class="col-md-12 d-flex justify-content-end">
                
        //             <input type="text" class="form-control col-lg-11" placeholder="Enter skill description" name="technicalSkills[${index}][description]" value="${skill?.description || ''}" readonly>
        //         </div>
        //     </div>`;

        //     const container = document.getElementById('skills-container');
        //     container.insertAdjacentHTML('beforeend', skillHtml);

        //     // Add event listener to remove the skill
        //     container
        //         .querySelector(`.technical-skill:nth-child(${index + 1}) .remove-skill`)
        //         .addEventListener('click', function() {
        //             this.closest('.technical-skill').remove();
        //         });

        //     // Add event listener to remove the description
        //     // container
        //     //     .querySelector(`.technical-skill:nth-child(${index + 1}) .remove-description`)
        //     //     .addEventListener('click', function() {
        //     //         this.closest('.technical-skill').remove();
        //     //     });

        //     // Initialize Select2 for skill dropdown
        //     $(`#skill[${index}]`).select2({
        //         placeholder: 'Search for a skill',
        //     });
        // }

        // function addTechnicalSkill(index, skill = null) {
        //     if (!skill) return;

        //     // Store the complete skill object with all necessary fields
        //     const skillData = {
        //         c_id: skill?.c_id || null,
        //         code: skill?.code || null,
        //         sector_id: skill?.sector_id || null,
        //         sector_name: skill?.sector_name || '',
        //         sub_sector_id: skill?.sub_sector_id || null,
        //         sub_sector_name: skill?.sub_sector_name || '',
        //         name: skill?.name || '',
        //         description: skill?.description || '',
        //         preferred_level: skill?.preferred_level || '',
        //     };

        //     // Loop through levels (1 to 6) and add description, knowledge, and ability if they exist
        //     for (let level = 1; level <= 6; level++) {
        //         if (skill[`level_${level}_description`]) {
        //             skillData[`level_${level}_description`] = skill[`level_${level}_description`];
        //             skillData[`level_${level}_knowledge`] = skill[`level_${level}_knowledge`] || [];
        //             skillData[`level_${level}_ability`] = skill[`level_${level}_ability`] || [];
        //         }
        //     }

        //     // Store the full skill data into the array
        //     technicalSkillsData[index] = skillData;
        //     console.log('Updated technicalSkillsData:', technicalSkillsData);

        //     // Convert to JSON format matching test.txt
        //     const formattedJson = JSON.stringify({ technical_skills: Object.values(technicalSkillsData) }, null, 4);
        //     console.log('Formatted JSON Output:', formattedJson);

        //     // Generate HTML UI (if needed)
        //     const skillHtml = `
        //         <div class="technical-skill row mb-8">
        //             <div class="fv-row mb-2 fv-plugins-icon-container col-lg-9 d-flex gap-7">
        //                 <button type="button" class="btn btn-outline btn-outline-primary d-flex justify-content-center remove-skill">
        //                     <iconify-icon icon="gg:trash" class="fa-1-5"></iconify-icon>
        //                 </button>
        //                 <input type="text" class="form-control input-style" id="technicalSkills[${index}]" 
        //                     name="technicalSkills[${index}][name]" placeholder="Technical Skill" 
        //                     value="${skill?.name || ''}" required readonly>
        //             </div>
        //             <div class="fv-row mb-2 fv-plugins-icon-container d-flex col-lg-3 btn-vl-container justify-content-end">
        //                 <select id="level[${index}]" name="technicalSkills[${index}][preferred_level]" class="form-select">
        //                     ${Array.from({ length: 6 }, (_, i) => 6 - i)
        //                         .map(level => `<option value="${level}" ${skill?.preferred_level == level ? 'selected' : ''}>Level ${level}</option>`)
        //                         .join('')}
        //                 </select>
        //                 <button type="button" id="selectTechLevelButton${index}" class="btn-view" 
        //                     data-bs-toggle="modal" data-bs-target="#techskillmodal" 
        //                     onclick="technicalpopulateModal(${index})">
        //                     View Level
        //                     <iconify-icon icon="iconamoon:search-bold" class="fa-1-5 ml-2"></iconify-icon>
        //                 </button>
        //             </div>
        //             <div class="col-md-12 d-flex justify-content-end">
        //                 <input type="text" class="form-control col-lg-11" 
        //                     placeholder="Enter skill description" 
        //                     name="technicalSkills[${index}][description]" 
        //                     value="${skill?.description || ''}" readonly>
        //             </div>
        //         </div>`;

        //     const container = document.getElementById('skills-container');
        //     container.insertAdjacentHTML('beforeend', skillHtml);

        //     // Remove skill event listener
        //     container.querySelector(`.technical-skill:nth-child(${index + 1}) .remove-skill`)
        //         .addEventListener('click', function() {
        //             this.closest('.technical-skill').remove();
        //         });

        //     // Initialize Select2
        //     $(`#skill[${index}]`).select2({
        //         placeholder: 'Search for a skill',
        //     });
        // }

        function addTechnicalSkill(index, skill = null) {
            if (!skill) return;

            // Store the complete skill object with all necessary fields
            const skillData = {
                c_id: skill?.c_id || null,
                code: skill?.code || null,
                sector_id: skill?.sector_id || null,
                sector_name: skill?.sector_name || '',
                sub_sector_id: skill?.sub_sector_id || null,
                sub_sector_name: skill?.sub_sector_name || '',
                name: skill?.name || '',
                description: skill?.description || '',
                preferred_level: skill?.preferred_level || '',
            };

            // Loop through levels (1 to 6) and add description, knowledge, and ability if they exist
            for (let level = 1; level <= 6; level++) {
                if (skill[`level_${level}_description`]) {
                    skillData[`level_${level}_description`] = skill[`level_${level}_description`];
                    skillData[`level_${level}_knowledge`] = skill[`level_${level}_knowledge`] || [];
                    skillData[`level_${level}_ability`] = skill[`level_${level}_ability`] || [];
                }
            }

            // Store the full skill data into the array
            technicalSkillsData[index] = skillData;
            console.log('Updated technicalSkillsData:', technicalSkillsData);

            // Convert to JSON format matching test.txt
            const formattedJson = JSON.stringify({ technical_skills: Object.values(technicalSkillsData) }, null, 4);
            console.log('Formatted JSON Output:', formattedJson);

            // Generate hidden input fields
            let hiddenInputs = '';

            // Loop through all keys in skillData and create hidden inputs
            Object.keys(skillData).forEach((key) => {
                if (Array.isArray(skillData[key])) {
                    // Handle array data (level_x_knowledge and level_x_ability)
                    skillData[key].forEach((value, i) => {
                        hiddenInputs += `<input type="hidden" name="technicalSkills[${index}][${key}][${i}]" value="${value}">`;
                    });
                } else {
                    // Handle regular string/integer fields
                    hiddenInputs += `<input type="hidden" name="technicalSkills[${index}][${key}]" value="${skillData[key]}">`;
                }
            });

            // Generate HTML UI
            const skillHtml = `
                <div class="technical-skill row mb-8" id="skill-${index}">
                    ${hiddenInputs} <!-- Append all hidden inputs here -->
                    <div class="fv-row mb-2 fv-plugins-icon-container col-lg-9 d-flex gap-7">
                        <button type="button" class="btn btn-outline btn-outline-primary d-flex justify-content-center remove-skill">
                            <iconify-icon icon="gg:trash" class="fa-1-5"></iconify-icon>
                        </button>
                        <input type="text" class="form-control input-style" id="technicalSkills[${index}]" 
                            name="technicalSkills[${index}][name]" placeholder="Technical Skill" 
                            value="${skill?.name || ''}" required readonly>
                    </div>
                    <div class="fv-row mb-2 fv-plugins-icon-container d-flex col-lg-3 btn-vl-container justify-content-end">
                        <select id="level[${index}]" name="technicalSkills[${index}][level]" class="form-select col-lg-7 col-md-10 btn-level mb-3 mb-lg-0 rounded-right">
                            ${Array.from({ length: 6 }, (_, i) => 6 - i) 
                                .map(level => {
                                    const descriptionKey = `level_${level}_description`;
                                    const levelDescription = skill[descriptionKey] || null;

                                    if (levelDescription) {
                                        return `<option value="${level}" 
                                                        ${skill?.preferred_level == level ? 'selected' : ''} 
                                                        class="dark:bg-slate-700">
                                                    Level ${level}
                                                </option>`;
                                    }
                                    return ''; // Skip levels without a description
                                })
                                .join('')}
                        </select>

                        <button type="button" id="selectTechLevelButton${index}" class="btn-view" 
                            data-bs-toggle="modal" data-bs-target="#techskillmodal" 
                            onclick="technicalpopulateModal(${index})">
                            View Level
                            <iconify-icon icon="iconamoon:search-bold" class="fa-1-5 ml-2"></iconify-icon>
                        </button>
                    </div>
                    <div class="col-md-12 d-flex justify-content-end">
                        <input type="text" class="form-control col-lg-11" 
                            placeholder="Enter skill description" 
                            name="technicalSkills[${index}][description]" 
                            value="${skill?.description || ''}" readonly>
                    </div>
                </div>`;
            const container = document.getElementById('skills-container');
            container.insertAdjacentHTML('beforeend', skillHtml);

            // Remove skill event listener
            container.querySelector(`#skill-${index} .remove-skill`)
                .addEventListener('click', function () {
                    this.closest('.technical-skill').remove();
                });

            // Initialize Select2
            $(`#skill[${index}]`).select2({
                placeholder: 'Search for a skill',
            });
        }

        function technicalpopulateModal(index) {
            const data = technicalSkillsData[index];

            // let data = JSON.parse(button.getAttribute('data-skill'));
            console.log('technicalpoopupmodal', data);

            let modalBody = $('#techskillmodal .modalbody');
            // console.log(selected_level);
            // console.log(level_2);
            modalBody.empty(); // Clear existing modal content
            console.log(modalBody);

            $('#techskillmodal .modal-title').text(data.name);
            // levels.forEach(level => {
            let selectedLevel = parseInt(data.preferred_level, 10);
            console.log('updateed selected', selectedLevel);
            for (let i = 1; i <= 6; i++) {
                console.log('descriptor', data['level_' + i + '_description']);

                let knowledge = data['level_' + i + '_knowledge'] || '';

                let ability = data['level_' + i + '_ability'] || '';

                if (data['level_' + i + '_description']) {
                    console.log('in the condition')
                    modalBody.append(`
                    <div class="form-check col-lg-4">
                    
                
                            <label class="form-check-label h-100 w-100" for="level_1">
                                <div class="col-lg-12 h-100">
                                        <div class="card  card-stretch card-bordered mb-5 h-100 card-checked-orange">
                                            <div class="card-header align-items-center header-checked-orange">
                                                <h3 class="card-title">Level ${i} <iconify-icon icon="material-symbols:star" style="margin-left: 5px"></iconify-icon></h3>
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
                } else {
                    modalBody.append(`
                <div class="form-check col-lg-4">
                
            
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


            $('#techskillmodal .save-btn').data('skill-id', index); // Set skill ID on save button for later
        }

        function getPreferredLevel(level) {
            switch (level?.toLowerCase()) {
                case 'basic':
                    return 1;
                case 'intermediate':
                    return 2;
                case 'advanced':
                    return 3;
                default:
                    return ''; // Return empty string if no match
            }
        }

        // function addGenericSkill(index, skill = null) {
        //     console.log(skill);
        //     genericSkillsData[index] = skill;

        //     // Helper function to map preferred_level to numeric value
        //     function getPreferredLevel(level) {
        //         switch (level?.toLowerCase()) {
        //             case 'basic':
        //                 return 1;
        //             case 'intermediate':
        //                 return 2;
        //             case 'advanced':
        //                 return 3;
        //             default:
        //                 return ''; // Return empty string if no match
        //         }
        //     }

        //     const preferredLevel = getPreferredLevel(skill?.preferred_level);
        //     const skillHtml = `
        //     <div class="technical-skill row mb-8">
        //         <div class="fv-row mb-2 fv-plugins-icon-container col-lg-9 d-flex gap-7">
        //             <button type="button" class="btn btn-outline btn-outline-primary d-flex justify-content-center remove-skill">
        //                 <iconify-icon icon="gg:trash" class="fa-1-5"></iconify-icon>
        //             </button>
            
        //             <input type="text" class="form-control input-style " id="genericSkill[${index}]" name="genericSkills[${index}][id]" placeholder="Generic Skill" readonly value="${skill.competency}" required>
        //         </div>
        //         <div class="fv-row mb-2 fv-plugins-icon-container d-flex col-lg-3 btn-vl-container justify-content-end">
        //             <select id="genericLevel[${index}]" name="genericSkills[${index}][level]" class="form-select col-lg-7 btn-level mb-3 mb-lg-0 rounded-right">
        //                 ${[1, 2, 3]
        //                     .map((level) => `<option value="${level}" ${preferredLevel == level ? 'selected' : ''}>Level ${level}</option>`)
        //                     .join('')}
        //             </select>
        //             <button type="button" id="selectGenericLevelButton${index}" data-bs-toggle="modal" data-bs-target="#genericSkillModal" onclick="genericPopulateModal('${index}')">
        //                 View Level
        //                 <iconify-icon icon="iconamoon:search-bold" class="fa-1-5 ml-2"></iconify-icon>
        //             </button>
        //         </div>
        //         <div class="col-md-12 d-flex justify-content-end">
                    
        //             <input type="text" class="form-control col-lg-11" readonly  placeholder="Enter skill description" name="genericSkills[${index}][description]" value="${skill?.level_1 || ''}">
        //         </div>
        //     </div>`;

        //     const container = document.getElementById('generic-skills-container');
        //     container.insertAdjacentHTML('beforeend', skillHtml);

        //     // Add event listener to remove the skill
        //     // container
        //     //     .querySelector(`.generic-skill:nth-child(${index + 1}) .remove-skill`)
        //     //     .addEventListener('click', function() {
        //     //         this.closest('.generic-skill').remove();
        //     //     });

        //     // Add event listener to remove the description
        //     // container
        //     //     .querySelector(`.generic-skill:nth-child(${index + 1}) .remove-description`)
        //     //     .addEventListener('click', function() {
        //     //         this.closest('.generic-skill').remove();
        //     //     });

        //     // Initialize Select2 for skill dropdown
        //     $(`#genericSkill[${index}]`).select2({
        //         placeholder: 'Search for a skill',
        //     });
        // }

        function addGenericSkill(index, skill = null) {
            if (!skill) return;

            // Ensure genericSkillsData[index] stores all necessary fields
            const skillData = {
                job_id: skill?.job_id || null,
                competency: skill?.competency || '',
                description: skill?.description || '',
                preferred_level: skill?.preferred_level || '',
            };

            // Loop through levels (1 to 3) and add description, knowledge, and ability if they exist
            for (let level = 1; level <= 3; level++) {
                if (skill[`level_${level}`]) {
                    skillData[`level_${level}`] = skill[`level_${level}`];
                    skillData[`level_${level}_knowledge`] = skill[`level_${level}_knowledge`] || [];
                    skillData[`level_${level}_ability`] = skill[`level_${level}_ability`] || [];
                }
            }

            // Store the full skill data into the array
            genericSkillsData[index] = skillData;
            console.log('Updated genericSkillsData:', genericSkillsData);

            // Helper function to map preferred_level to numeric value
            function getPreferredLevel(level) {
                switch (level?.toLowerCase()) {
                    case 'basic':
                        return 1;
                    case 'intermediate':
                        return 2;
                    case 'advanced':
                        return 3;
                    default:
                        return ''; // Return empty string if no match
                }
            }

            const preferredLevel = getPreferredLevel(skill?.preferred_level);

            // Generate hidden input fields for form submission
            let hiddenInputs = '';
            Object.keys(skillData).forEach((key) => {
                if (Array.isArray(skillData[key])) {
                    // Handle array data (level_x_knowledge and level_x_ability)
                    skillData[key].forEach((value, i) => {
                        hiddenInputs += `<input type="hidden" name="genericSkills[${index}][${key}][${i}]" value="${value}">`;
                    });
                } else {
                    // Handle regular string/integer fields
                    hiddenInputs += `<input type="hidden" name="genericSkills[${index}][${key}]" value="${skillData[key]}">`;
                }
            });

            // Generate HTML UI
            const skillHtml = `
                <div class="generic-skill row mb-8" id="generic-skill-${index}">
                    ${hiddenInputs} <!-- Append hidden inputs here -->
                    <div class="fv-row mb-2 fv-plugins-icon-container col-lg-9 d-flex gap-7">
                        <button type="button" class="btn btn-outline btn-outline-primary d-flex justify-content-center remove-skill">
                            <iconify-icon icon="gg:trash" class="fa-1-5"></iconify-icon>
                        </button>
                        <input type="text" class="form-control input-style" id="genericSkill[${index}]" 
                            name="genericSkills[${index}][competency]" placeholder="Generic Skill" 
                            value="${skillData.competency}" required readonly>
                    </div>
                    <div class="fv-row mb-2 fv-plugins-icon-container d-flex col-lg-3 btn-vl-container justify-content-end">
                        <select id="genericLevel[${index}]" name="genericSkills[${index}][level]" class="form-select col-lg-7 btn-level mb-3 mb-lg-0 rounded-right">
                            ${[1, 2, 3]
                                .map((level) => `<option value="${level}" ${preferredLevel == level ? 'selected' : ''}>Level ${level}</option>`)
                                .join('')}
                        </select>
                        <button type="button" id="selectGenericLevelButton${index}" data-bs-toggle="modal" data-bs-target="#genericSkillModal" onclick="genericPopulateModal('${index}')">
                            View Level
                            <iconify-icon icon="iconamoon:search-bold" class="fa-1-5 ml-2"></iconify-icon>
                        </button>
                    </div>
                    <div class="col-md-12 d-flex justify-content-end">
                        <input type="text" class="form-control col-lg-11" readonly placeholder="Enter skill description" 
                            name="genericSkills[${index}][description]" value="${skillData.level_1 || skillData.description}">
                    </div>
                </div>`;

            const container = document.getElementById('generic-skills-container');
            container.insertAdjacentHTML('beforeend', skillHtml);

            // Remove skill event listener
            container.querySelector(`#generic-skill-${index} .remove-skill`)
                .addEventListener('click', function () {
                    this.closest('.generic-skill').remove();
                });

            // Initialize Select2 for skill dropdown
            $(`#genericSkill[${index}]`).select2({
                placeholder: 'Search for a skill',
            });
        }


        function genericPopulateModal(index, skillData) {
            const data = genericSkillsData[index];
            const preferredLevel = getPreferredLevel(skillData?.preferred_level);

            // let data = JSON.parse(button.getAttribute('data-skill'));
            console.log('genericpoopupmodal', data);

            // const modalBody = document.querySelector('#genericSkillModal .modalbody');
            // data = JSON.parse(data);
            console.log(data.level_1_knowledge);
            let modalBody = $('#genericSkillModal .modalbody');
            // console.log(selected_level);
            // console.log(level_2);
            modalBody.empty(); // Clear existing modal content

            $('#genericSkillModal .modal-title').text(data.competency);
            // levels.forEach(level => {
            modalBody.append(`
                        <div class="form-check col-lg-4">
                        
                    
                        <label class="form-check-label" for="level_1">
                            <div class="col-lg-12">
                                    <div class="card card-stretch card-bordered mb-5">
                                        <div class="card-header align-items-center">
                                            <h3 class="card-title">Level 1</h3>
                                            <input class="form-check-input border-dark" type="radio" value="1" id="level_1" name="level" ${preferredLevel == 1 ? 'checked' : ''}>

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
                                        <input class="form-check-input border-dark" type="radio" value="2" id="level_2" name="level" ${preferredLevel == 2 ? 'checked' : ''}>


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
                        <input class="form-check-input border-dark" type="radio" value="3" name="level" id="level_3" ${preferredLevel == 3 ? 'checked' : ''}>

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

        // Add Save button event
        const saveButton = document.querySelector('#genericSkillModal .save-btn');
        saveButton.onclick = function() {
            const selectedLevel = document.querySelector(
                '#genericSkillModal input[name="selected_generic_level"]:checked').value;
            document.querySelector(`#genericLevel\\[${index}\\]`).value =
                selectedLevel; // Update the level dropdown
            $('#genericSkillModal').modal('hide'); // Close the modal
        };
    </script>

    <script>
        document.querySelector('form').addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(this);

            // Convert formData to JSON
            const data = {};
            formData.forEach((value, key) => {
                if (key.includes('[]')) {
                    const baseKey = key.replace('[]', '');
                    if (!data[baseKey]) data[baseKey] = [];
                    data[baseKey].push(value);
                } else {
                    data[key] = value;
                }
            });

            // Submit via API
            fetch('/api/save-job-description', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data),
                })
                .then((response) => response.json())
                .then((result) => {
                    alert('Job description saved successfully!');
                    window.location.href = '/admin/job-descriptions';
                })
                .catch((error) => console.error('Error saving job description:', error));
        });
    </script>
    {{-- <script>
        document.getElementById('submit-button').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent default action

            // Show SweetAlert2 popup
            Swal.fire({
                title: 'Confirmation',
                text: 'This JD will be saved under Company JD',
                icon: 'info',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect to a specific URL
                    window.location.href =
                        '/admin/setting/job-description'; // Replace with your desired URL
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

          // Function to update the position code based on selected level
    function updatePositionCode() {
        const levelJob = document.getElementById('level-job');
        const positionCodeInput = document.getElementById('position_code');
        const selectedLevel = levelJob.value;

        // Update the position code input field based on selected level
        positionCodeInput.value = positionCodes[selectedLevel] || '';
    }

    // Set position code when the page loads based on the current level
    window.onload = function() {
        const selectedLevel = {{ $cachedData['level'] ?? 'null' }};
        if (selectedLevel) {
            const positionCodeInput = document.getElementById('position_code');
            const positionCode = positionCodes[selectedLevel] || '';
            positionCodeInput.value = positionCode;
        }
    };
    </script>


    
@endsection
