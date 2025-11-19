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
            padding: 24px 24px 24px 8px !important;
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
                padding: 45px 70px 50px 70px;
            }
        }
        .error{
    color: red;
    font-weight: 500;

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
                        Job Management
                    </h1>
                    <!--end::Title-->


                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="#" class="text-muted text-hover-primary">
                                Home </a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->

                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            JD Master List </li>
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
            <div id="kt_app_content_container" class="app-container  container-xxl ">
                <form action="{{ route('jobs.store') }}"  id="job_description_form" method="post">
                    @csrf
                    <input type="hidden" name="jd_from" value="4">
                    <input type="hidden" name="riasec" value="{{ $job->top3riasec }}">
                    <input type="hidden" name="title" value="{{ $job->title }}">
                    <input type="hidden" name="level" value="{{ $job->level }}">
                    <input type="hidden" name="status" value="2">

                <div class="card  shadow-sm mb-4">
                    <div class="bg-primary card-header">
                        <h3 class="card-title text-white"><iconify-icon icon="prime:sparkles"
                                class="fs-2x mr-2"></iconify-icon>Create Job Description</h3>

                    </div>
                    
                    <div class="card-body px-2 py-5">
                      
                            <div class="form-group d-flex justify-content-evenly col-lg-12 p-0">
                                <div class="col-lg-4">
                                  
                                    <label for="sector" class="fw-semibold fs-6 mb-2">Sector</label>
                                    <input type="hidden" name="sector_id" value="{{ $job->department_id  ?? ''}}">
                                    <input id="sector" value="{{ $sector ?? '' }}" class="form-select" placeholder="Select the Sector" readonly>

                                </div>

                                <div class="col-lg-4">
                                    <label for="track" class="fw-semibold fs-6 mb-2">Track</label>
                                    

                                    <input id="track" class="form-select" name="track" placeholder="Select the Track" value="{{ $track ?? '' }}" readonly>
                                </div>

                                <div class="col-lg-4">
                                    <label for="job_role" class="fw-semibold fs-6 mb-2">Role</label>

                                    <input id="job_role" name="job_role" class="form-select" value="{{ $job->title ?? '' }}" placeholder="Select the Role" readonly>

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
                    <div class="card-body padding-card">
                        <div class="mb-5">
                            <label for="job_role_desc" class="form-label">Job Role Description</label>
                            <textarea class="form-control" rows="8" cols="80" id="job_role_desc" name="description"
                                data-kt-autosize="true">{{ $job->description ?? '' }}</textarea>
                        </div>
                        <div class="mb-5 row">
                            <div class="fv-row  fv-plugins-icon-container col-lg-6">
                                <label for="level-jo" class="fw-semibold fs-6 mb-2 required">Position Level</label>
                                <select id="level-job" class="form-control form-control mb-3 mb-lg-0 " onchange="updatePositionCode()"  name="level_job">
                                    <option value=""class="dark:bg-slate-700">Select Position Level</option>
                                      
                                    <option value="1" {{ $job->level == 1 ? 'selected' : '' }}  class="dark:bg-slate-700">Level 1</option>
                                    <option value="2" {{ $job->level == 2 ? 'selected' : '' }}  class="dark:bg-slate-700">Level 2</option>
                                    <option value="3" {{ $job->level == 3 ? 'selected' : '' }}  class="dark:bg-slate-700">Level 3</option>
                                    <option value="4"  {{ $job->level == 4 ? 'selected' : '' }} class="dark:bg-slate-700">Level 4 </option>
                                    <option value="5" {{ $job->level == 5 ? 'selected' : '' }} class="dark:bg-slate-700">Level 5 </option>
                                    <option value="6" {{ $job->level == 6 ? 'selected' : '' }}  class="dark:bg-slate-700">Level 6 </option>
                                    <option value="7" {{ $job->level == 7 ? 'selected' : '' }}  class="dark:bg-slate-700">Level 7</option>
                                    <option value="8" {{ $job->level == 8 ? 'selected' : '' }} class="dark:bg-slate-700">Level 8 </option>
                                    <option value="9" {{ $job->level == 9 ? 'selected' : '' }} class="dark:bg-slate-700">Level 9 </option>
                                    <option value="10" {{ $job->level == 10 ? 'selected' : '' }} class="dark:bg-slate-700">Level 10 </option>
                                    <option value="11" {{ $job->level == 11 ? 'selected' : '' }} class="dark:bg-slate-700">Level 11 </option>
                                    <option value="12" {{ $job->level == 12 ? 'selected' : '' }} class="dark:bg-slate-700">Level 12 </option>
                                    <option value="13" {{ $job->level == 13 ? 'selected' : '' }} class="dark:bg-slate-700">Level 13</option>
                                    
                            </select>

                            </div>
                        
                            <div class="fv-row fv-plugins-icon-container col-lg-6">
                               
                                <label for="position_code" class="fw-semibold fs-6 mb-2 required">Position Code</label>
                                <input id="position_code" type="text" value="{{ $job->code ?? ''}}" class="form-control  mb-lg-0" name="position_code"
                                    placeholder="Position Code">

                            </div>
                        </div>
                        <div class="mb-5 row">
                            <div class="fv-row  fv-plugins-icon-container col-lg-12">
                                <label for="department" class="fw-semibold fs-6 mb-2 required">Department</label>

                                <select id="department" class="form-control form-control mb-3 mb-lg-0 select-department"
                                    name="org_department" required>
                                    <option value="" class="dark:bg-slate-700">Select Department</option>
                                    @foreach ($orgDepartments as $key2 => $value2)
                                        <option value="{{ $value2->id }}" class="dark:bg-slate-700"
                                            {{ $job->org_department == $value2->id ? 'selected' : '' }}>
                                            {{ $value2->name ?? '-' }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-5 row">
                            <div class="fv-row mb-7 fv-plugins-icon-container col-lg-12">
                                <label for="headcount" class="fw-semibold fs-6 mb-2 required">No. of Headcount</label>
                                <input id="headcount" type="number" min="1" class="form-control  mb-lg-0"  name="heads"
                                        placeholder="Number of heads" value="{{ $job->heads }}" >

                            </div>
                        </div>

                    </div>

                </div>

                <div class="card  shadow-sm mb-4">
                    <div class="card-header">
                        <h3 class="card-title">Critical Work Functions</h3>

                    </div>
                    <div class="card-body padding-card">

                        <div class="critical-functions-container">
                            @foreach ($job->criticalFunctions as $index => $function)
                                <div class="critical-function row mb-3">
                                    <div class="col-lg-12">
                                        <div class="d-flex gap-5 mb-3">
                                            <button type="button"
                                                class="remove-function btn btn-outline btn-outline-primary d-flex justify-content-center"
                                                title="Remove function"><iconify-icon icon="gg:trash"
                                                    class="fa-1-5"></iconify-icon></button>

                                            <input type="hidden" name="functions[{{ $index }}][id]"
                                                value="{{ $function->id }}">

                                            <input type="text" class="form-control input-style"
                                                name="functions[{{ $index }}][title]"
                                                placeholder="Critical Work Function" value="{{ $function->description }}"
                                                required>
                                        </div>
                                        <select class="form-control function-keys input-style select2 mb-3 col-lg-11"
                                            style="float:right" name="functions[{{ $index }}][keys][]"
                                            multiple="multiple">
                                            @foreach ($function->cwfKeys as $key)
                                                <option value="{{ $key->name }}" selected>
                                                    {{ $key->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <button type="button" id="add_new_function" class="add-function mt-5" style="background:#F7941C"><iconify-icon icon="stash:plus-solid"
                                style="font-size: 20px"></iconify-icon> Add New
                            Function</button>
                        <div id="validationMessage" style="color: red; display: none;">Atlest one Critical Work Function
                            is required.</div>
                    </div>

                </div>

                <div class="card  shadow-sm mb-4">
                    <div class="card-header">
                        <h3 class="card-title"> Technical Skills</h3>

                    </div>
                    <div class="card-body padding-card">

                        <div id="skills-container" class="row mb-3 skills-container">

                            @foreach ($job->technicalSkills as $index => $skill)
                                <div class="technical-skill row mb-8">
                                    <div class="fv-row mb-2 fv-plugins-icon-container col-lg-9 d-flex gap-7">
                                        <button type="button"
                                            class="btn btn-outline btn-outline-primary d-flex justify-content-center remove-skill">
                                            <iconify-icon icon="gg:trash" class="fa-1-5"></iconify-icon>
                                        </button>

                                        <select id="skill[{{ $index }}]]"
                                            class="form-control form-control mb-3 mb-lg-0"
                                            name="technicalSkills[{{ $index }}][id]">

                                            <option value="{{ $skill->id }}" class="dark:bg-slate-700">
                                                {{ $skill->name . '(' . $skill->sector_name . '-' . $skill->sub_sector_name . ')' }}
                                            </option>
                                        </select>
                                    </div>
                                    <div
                                        class="fv-row mb-2 fv-plugins-icon-container d-flex col-lg-3 btn-vl-container justify-content-end">
                                        {{-- <select id="level[{{ $index + 1 }}]"
                                            class="form-select col-lg-7 col-md-10 btn-level mb-3 mb-lg-0 rounded-right border-right-0"
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
                                        </select> --}}
                                        <select id="level[{{ $index + 1 }}]"
                                            class="form-select col-lg-7 col-md-10 btn-level mb-3 mb-lg-0 rounded-right border-right-0"
                                            name="technicalSkills[{{ $index }}][level]">
                                            
                                            @if (!empty($skill->level_6_description))
                                                <option value="6" {{ $skill->pivot->level == 6 ? 'selected' : '' }} class="dark:bg-slate-700">Level 6</option>
                                            @endif

                                            @if (!empty($skill->level_5_description))
                                                <option value="5" {{ $skill->pivot->level == 5 ? 'selected' : '' }} class="dark:bg-slate-700">Level 5</option>
                                            @endif

                                            @if (!empty($skill->level_4_description))
                                                <option value="4" {{ $skill->pivot->level == 4 ? 'selected' : '' }} class="dark:bg-slate-700">Level 4</option>
                                            @endif

                                            @if (!empty($skill->level_3_description))
                                                <option value="3" {{ $skill->pivot->level == 3 ? 'selected' : '' }} class="dark:bg-slate-700">Level 3</option>
                                            @endif

                                            @if (!empty($skill->level_2_description))
                                                <option value="2" {{ $skill->pivot->level == 2 ? 'selected' : '' }} class="dark:bg-slate-700">Level 2</option>
                                            @endif

                                            @if (!empty($skill->level_1_description))
                                                <option value="1" {{ $skill->pivot->level == 1 ? 'selected' : '' }} class="dark:bg-slate-700">Level 1</option>
                                            @endif

                                        </select>
                                        <button type="button" id="selectTechLevelButton{{ $index }}"
                                            class="align-content-center align-items-center border-left-0 btn-outline-primary btn-view d-flex justify-content-center rounded-1 rounded-left"
                                            data-bs-toggle="modal" data-bs-target="#techskillmodal"
                                            onclick="technicalpopulateModal('{{ $index }}', '{{ App\Helpers\MainHelper::escapeSpecialCharacters(json_encode($skill)) }}', '{{ $skill->name }}', '{{ $skill->pivot->level }}')">
                                            View Level
                                            <iconify-icon icon="iconamoon:search-bold" class="fa-1-5 ml-2"></iconify-icon>
                                        </button>
                                    </div>
                                    <div class="col-md-12 d-flex justify-content-end">
                                        {{-- 
                                        <input type="text" class="form-control col-lg-11"
                                            placeholder="Enter skill description"
                                            name="technicalSkills[${index}][description]"
                                            value="${skill?.description || ''}" readonly> --}}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" id="add_new_skill" class="btn btn-primary">Add New Skill</button>
                        <div id="techvalidationmessage" style="color: red; display: none;">Atlest One Technical Skill is
                            required.</div>
                    </div>

                </div>

                <div class="card  shadow-sm mb-4">
                    <div class="card-header">
                        <h3 class="card-title"> General Skills & Competencies</h3>

                    </div>

                 

                        <div class="card-body padding-card">

                            <div class="row mb-3">
                                @foreach ($job->skills as $index => $skill)
                                    @php $master_skill = App\Models\MasterSkill::where('name',$skill->title)->first(); @endphp


                                    <div class="technical-skill row mb-8">
                                        <div class="fv-row mb-2 fv-plugins-icon-container col-lg-9 d-flex gap-7">
                                            {{-- <button type="button"
                                                class="btn btn-outline btn-outline-primary d-flex justify-content-center remove-skill">
                                                <iconify-icon icon="gg:trash" class="fa-1-5"></iconify-icon>
                                            </button> --}}
                                            <input type="hidden" name="skills[{{ $index }}][id]"
                                                value="{{ $skill->id }}">


                                            <select id="skill[0]" class="form-control form-control mb-3 mb-lg-0 "
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
                                        <div
                                            class="fv-row mb-2 fv-plugins-icon-container d-flex col-lg-3 btn-vl-container justify-content-end">


                                            <select id="level[{{ $index + 1 }}]"
                                                class="form-select col-lg-7 btn-level mb-3 mb-lg-0 rounded-right"
                                                name="skills[{{ $index }}][level]">
                                                <option value="3" {{ $skill->level == 3 ? 'selected' : '' }}
                                                    class="dark:bg-slate-700">Level 3</option>
                                                <option value="2" {{ $skill->level == 2 ? 'selected' : '' }}
                                                    class="dark:bg-slate-700">Level 2</option>
                                                <option value="1" {{ $skill->level == 1 ? 'selected' : '' }}
                                                    class="dark:bg-slate-700">Level 1</option>
                                            </select>



                                            <button type="button" id="selectLevelButton{{ $index }}"
                                                class="align-content-center align-items-center border-left-0 btn-outline-primary btn-view d-flex justify-content-center rounded-1 rounded-left"
                                                data-bs-toggle="modal" data-bs-target="#genericSkillModal"
                                                onclick="populateModal('{{ $index }}', '{{ App\Helpers\MainHelper::escapeSpecialCharacters(json_encode($master_skill)) }}', '{{ $master_skill->name ?? '' }}', '{{ $skill->level }}')">
                                                View Level
                                                <iconify-icon icon="iconamoon:search-bold"
                                                    class="fa-1-5 ml-2"></iconify-icon>
                                            </button>
                                        </div>
                                        {{-- <div class="col-md-12 d-flex justify-content-end">
                                            
                                            <input type="text" class="form-control col-lg-11" readonly  placeholder="Enter skill description" name="genericSkills[${index}][description]" value="${skill?.level_1 || ''}">
                                        </div> --}}
                                    </div>
                                @endforeach

                                {{-- @if ($job->skills->count() < 5)

                                    @for ($i = $index + 1; $i < 5; $i++)
                                        <div class="row mb-3">
                                            <div class="fv-row mb-5 fv-plugins-icon-container col-lg-5">

                                                <select id="skill[{{ $i }}]"
                                                    onchange="skillChanged({{ $i }}, this.value)"
                                                    class="form-control form-control-solid mb-3 mb-lg-0 col-lg-6"
                                                    name="skills[{{ $i }}][title]">
                                                    <option value="">Select Generic Skill</option>
                                                    @foreach ($masterSkills as $key => $value)
                                                        <option value="{{ $value->name }}" class="dark:bg-slate-700">
                                                            {{ $value->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="fv-row mb-5 fv-plugins-icon-container col-lg-5">
                                                <select id="level[{{ $i }}]"
                                                    class="form-control form-control-solid mb-3 mb-lg-0 col-lg-6"
                                                    name="skills[{{ $i }}][level]">
                                                    <option value="3" class="dark:bg-slate-700">Level 3</option>
                                                    <option value="2" class="dark:bg-slate-700">Level 2</option>
                                                    <option value="1" class="dark:bg-slate-700">Level 1</option>
                                                </select>
                                            </div>
                                            <div class="fv-row mb-3 fv-plugins-icon-container col-lg-2">

                                                <button type="button" id="selectLevelButton4" class="btn btn-primary"
                                                    data-bs-toggle="modal" data-bs-target="#genericSkillModal"
                                                    onclick="populateModal('4', '1', 'title', 'level_1', 'level_2', 'level_3', 'selectedlevel')">
                                                    Select Level
                                                </button>
                                            </div>
                                        </div>
                                    @endfor

                                @endif --}}
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
                            <select class="form-select" data-control="select2" data-placeholder="Select the Sector">
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
                    <div class="card-body">

                        <div class="mb-8 col-lg-4 d-flex">
                            <button type="submit" id="submit-button"
                                class="align-items-center btn btn-primary d-flex justify-content-center">
                                {{-- <iconify-icon icon="flowbite:plus-outline"></iconify-icon> --}}
                                Submit
                            </button>


                            {{-- <a href="{{ url()->full() }}"
                                class="align-items-center btn btn-danger ml-3 d-flex justify-content-center">
                                <iconify-icon icon="gg:trash"></iconify-icon>
                                Discard
                            </a> --}}
                            <a href="javascript:void(0);" 
                                onclick="discardChanges()" 
                                class="align-items-center btn btn-danger ml-3 d-flex justify-content-center">
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

                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary save-btn" data-bs-dismiss="modal"
                        onclick="updateSkillLevel(this)">Save changes</button> --}}

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
                    {{-- <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                 
                    <button type="button" class="btn btn-primary save-btn" data-bs-dismiss="modal"
                        onclick="updateTechSkillLevel(this)">Save changes</button> --}}

                </div>
            </div>
        </div>
    </div>
    {{-- Technical Skill Modal End --}}
@endsection

{{-- @section('scripts') --}}
@section('scripts')

    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script> --}}

    {{-- <script>
        // The DOM elements you wish to replace with Tagify
        var input1 = document.querySelector("#kt_tagify_1");
        var input2 = document.querySelector("#kt_tagify_2");

        var input3 = document.querySelector("#kt_tagify_3");

        // Initialize Tagify components on the above inputs
        new Tagify(input1);
        new Tagify(input2);
        new Tagify(input3);
    </script> --}}
    <script>
        $(document).ready(function() {
            var technicalSkills = @json($technicalSkills);

            $('#technicalSkills').select2();
            $('#job_description_form').submit(function(event) {
                console.log('sdfsfd');
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

                console.log(isValid, "==============ISVALIDCHEDCK-1");

                if (job_role === '') {
                    $('#job_role').next('.error').remove();
                    $('#job_role').after('<span class="error">Job Role is required</span>');
                    isValid = false;
                } else {
                    $('#job_role').next('.error').remove();
                }

                console.log(isValid, "==============ISVALIDCHEDCK-2");

                if (job_desc === '') {
                    $('#job_desc').next('.error').remove();
                    $('#job_desc').after('<span class="error">Job Description is required</span>');
                    isValid = false;
                } else {
                    $('#job_desc').next('.error').remove();
                }

                console.log(isValid, "==============ISVALIDCHEDCK-3");


                // Check uniqueness of position code
                if (isValid) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('check-position-code') }}",
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            position_code: position_code,
                            position_update: "1",
                            job_id: "{{ $job->id }}"
                        },
                        async: false,
                        success: function(response) {
                            console.log(!response.isUnique, "=============");
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

                console.log(isValid, "==============ISVALIDCHEDCK-4");


                if ($('.critical-functions-container').find('.critical-function').length === 0) {
                    $('#validationMessage').show();
                    isValid = false;
                } else {
                    $('#validationMessage').hide();
                }

                console.log(isValid, "==============ISVALIDCHEDCK-5");

                if ($('.skills-container').find('.technical-skill').length === 0) {
                    $('#techvalidationmessage').show();
                    isValid = false;
                } else {
                    $('#techvalidationmessage').hide();
                }

                console.log(isValid, "==============ISVALIDCHEDCK-6");

                // Validate generic skills
                var selectedSkills = [];
                var skillsValid = true;
                var firstInvalidSkillElement = null;
                $('select[name^="skills["][name$="[title]"]').each(function() {
                var skillValue = $(this).val();
                var parentDiv = $(this).closest('.technical-skill'); // Get the parent div
                if (skillValue !== "") {
                    if (selectedSkills.includes(skillValue)) {
                        // Remove any previous error message
                        parentDiv.find('.error').remove();
                        // Append the error message to the end of the parent div
                        parentDiv.append('<span class="error">Duplicate Skill Selected</span>');
                        skillsValid = false;
                        if (!firstInvalidSkillElement) {
                            firstInvalidSkillElement = $(this);
                        }
                    } else {
                        selectedSkills.push(skillValue);
                        // Remove any previous error message
                        parentDiv.find('.error').remove();
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

                console.log(isValid, "==============ISVALIDCHEDCK-7");


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

                console.log(isValid, "==============ISVALIDCHEDCK-8", technicalSkillsValid,
                    selectedTechnicalSkills.length);



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
                    class: 'form-control form-control mb-3 mb-lg-0 select-skill',
                    onchange: `TechSkillChanged('${index}',this.value)`,
                    'data-control': 'select2',
                    'data-hide-search': 'false',
                    'required': true
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
                    class: 'form-control form-select mb-3 mb-lg-0'
                });

                // Options for levels
                for (var level = 1; level <= 6; level++) {
                    levelSelect.append($('<option>', {
                        value: level,
                        text: 'Level ' + (level)
                    }));
                }

                var skillRow = $('<div>', {
                    class: 'technical-skill row mb-8'
                });

                var removeButton = $('<button>', {
                    type: 'button',
                    class: 'btn btn-outline btn-outline-primary d-flex justify-content-center remove-skill',
                   
                }).append('<iconify-icon icon="gg:trash" class="fa-1-5"></iconify-icon>');

                var skillCol = $('<div>', {
                    class: 'fv-row fv-plugins-icon-container col-lg-9 d-flex gap-7'
                }).append(removeButton).append(skillSelect);

                var popupButton = $('<button>', {
                    type: 'button',
                    id: `selectTechLevelButton${index}`, // Replace `index` with the appropriate variable
                    class: 'btn btn-outline btn-outline-primary btn-view d-flex justify-content-center rounded-1',
                    'data-bs-toggle': 'modal',
                    'data-bs-target': '#techskillmodal',
                    text: 'View Level',
                    onclick: `technicalpopulateModal('${index}')`
                }).append('<iconify-icon icon="iconamoon:search-bold" class="fa-1-5 ml-2"></iconify-icon>');

                var levelCol = $('<div>', {
                    class: 'fv-row fv-plugins-icon-container d-flex col-lg-3 btn-vl-container justify-content-end'
                }).append(levelSelect).append(popupButton);

              

                // var removeCol = $('<div>', {
                //     class: 'col-lg-1'
                // }).append(removeButton);


             

                // var popupbuttoncol = $('<div>', {
                //     class: 'col-lg-3'
                // }).append(popupButton).append(removeButton);



                skillRow.append(skillCol, levelCol);

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
                        <div class="col-lg-12">
                            <div class="d-flex gap-5 mb-3">
                                <button type="button" class="remove-function btn btn-outline btn-outline-primary d-flex justify-content-center" title="Remove function"><iconify-icon icon="gg:trash" class="fa-1-5"></iconify-icon></button>
                                <input type="hidden" name="functions[${newIndex}][id]" value="new">
                                <input type="text" class="form-control input-style" name="functions[${newIndex}][title]" placeholder="Enter new critical work function" value="" required>
                            </div>
                            <select class="form-control input-style select2 mb-3 col-lg-11" style="float:right" id="function_keys_${newIndex}" name="functions[${newIndex}][keys][]" multiple="multiple">
                            
                            </select>
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
            console.log('technicalskill', skillName)
            showOverlay(); 

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
                    hideOverlay();

                },
                error: function(error) {
                    hideOverlay();

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
            let modalBody = $('#genericSkillModal .modalbody');
            // console.log(selected_level);
            // console.log(level_2);
            modalBody.empty(); // Clear existing modal content

            $('#genericSkillModal .modal-title').text(skillTitle);
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

            $('#genericSkillModal .save-btn').data('skill-id', index); // Set skill ID on save button for later
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
                `<li class="d-flex fs-xxl-9 align-items-center py-2"><span class="bullet me-5"></span>${item.trim()}</li>`
            ).join(
                '');
        }

        function updateSkillLevel(button) {

            let skillId = $(button).data('skill-id');
            let selectedLevel = $('#genericSkillModal .modal-body input:checked').val();

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
                showOverlay(); 

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
                        hideOverlay();

                    },
                    error: function() {
                        hideOverlay();

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
    // Define a mapping between position levels and position codes
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
        const selectedLevel = {{ $job->level ?? 'null' }};
        if (selectedLevel) {
            const positionCodeInput = document.getElementById('position_code');
            const positionCode = positionCodes[selectedLevel] || '';
            positionCodeInput.value = positionCode;
        }
    };
</script>
<script>
    function discardChanges() {
            window.location.href = document.referrer;
    }
</script>
@endsection
