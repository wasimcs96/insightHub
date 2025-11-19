<!-- job.index.blade.php -->

@extends('admin.layout.app')

@section('title', 'Setting - Job Descriptions')



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
                    @php
                        $title = 'Job Descriptions';

                        try {
                            if (request('department')) {
                                $var1 = \App\Models\Department::where('id', request('department'))->first();
                                if ($var1) {
                                    $title = $var1->name;
                                }
                            }
                        } catch (e) {
                        }

                    @endphp
                    @if (request('department'))
                        {{ $title }}
                    @else
                        Job Descriptions
                    @endif
                </h1>
                <!--end::Title-->


                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
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

                    {{-- <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        JD Master List </li>
                    <!--end::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <!--end::Item--> --}}

                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('jobs.savedJobs') }}" class="text-muted text-hover-primary">
                        JD Company List 
                        </a>
                    </li>



                    @if (request('org_department'))
                        @php
                        $name = '';
                        $department_name = \App\Models\Department::where('id',request('org_department'))->first();
                        if ($department_name) {
                            $name = $department_name->name;
                        }
                        @endphp
                       
                        @if ($name != '')
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-500 w-5px h-2px"></span>
                            </li>
                            <li class="breadcrumb-item text-muted">
                                <a href="#" class="text-muted text-hover-primary">
                                {{ $name ?? '-' }}
                                </a>
                            </li>
                        @endif

                    @endif
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
            <!--begin::Action group-->
            <!--begin::Toolbar end-->
            <div class="d-flex align-items-center gap-2 gap-lg-3">



                <!--begin::Secondary button-->
                <!--end::Secondary button-->
                <a href="{{ route('jobs.index', ['saved_job' => 0]) }}" class="btn btn-sm fw-bold btn-primary">
                    JD Master List </a>
                <a href="{{ route('jobs.savedJobs', ['saved_job' => 1]) }}" class="btn btn-sm fw-bold btn-primary">
                    Company JDs </a>
                <!--begin::Primary button-->
                <a href="{{ route('jobs.create') }}" class="btn btn-sm fw-bold btn-primary">
                    Create </a>
                <!--end::Primary button-->
            </div>

            <!--end::Toolbar end-->
            <!--end::Action group-->
        </div>
        <!--end::Toolbar container-->
    </div>


    <div id="kt_app_content" class="app-content  flex-column-fluid ">



        <div id="kt_app_content_container" class="app-container">


            <div class="row gx-6 gx-xl-9">


                @foreach ($data as $key8 => $level)
                    <div class="col-xl-2" style="width: 12.5% !important;">

                        @php
                            $currentUrlParams = request()->query(); // Get current query parameters
                            $currentUrlParams['level'] = $key8; // Set or replace the 'level' parameter
                        @endphp


                        <!--begin::Statistics Widget 5-->
                        <a href="{{ route('admin.saved.jobdescriptions', $currentUrlParams) }}"
                            class="card bg-primary hoverable card-xl-stretch mb-xl-8">
                            <!--begin::Body-->
                            <div class="card-body">
                                <iconify-icon icon="carbon:skill-level" width="32" height="32"
                                    style="color: white"></iconify-icon>

                                <div class="text-white fw-bold fs-2 mb-2 mt-5">
                                    {{ $level['title'] }}

                                </div>

                                <div class="fw-bold fs-2 mb-2 mt-5">
                                    Jobs - {{ $level['count'] }} </div>

                            </div>
                            <!--end::Body-->
                        </a>
                        <!--end::Statistics Widget 5-->
                    </div>
                @endforeach
            </div>


            <!--begin::FAQ card-->
            <div class="card">
                <!--begin::Body-->
                <div class="card-body p-lg-15">
                    <!--begin::Layout-->
                    <div class="d-flex flex-column flex-lg-row">
                        <!--begin::Sidebar-->
                        <div class="flex-column flex-lg-row-auto w-100 w-lg-275px mb-10 me-lg-20">
                            <form action="">
                                <!--begin::Search blog-->
                                <div class="mb-16">
                                    <h4 class="text-gray-900 mb-7">Search Job</h4>

                                    <!--begin::Input group-->
                                    <div class="d-flex">
                                        <input type="text" class="form-control " placeholder="Search for jobs..."
                                            name="search" value="{{ request('search') }}" />
                                        <input type="hidden" class="form-control " name="department"
                                            value="{{ request('department') }}" />
                                        <input type="hidden" class="form-control " name="org_department"
                                            value="{{ request('org_department') }}" />

                                        <input type="hidden" class="form-control " name="saved_job"
                                            value="{{ request('saved_job') }}" />

                                        <button type="submit"
                                            class="btn btn-primary mx-1 d-flex justify-content-center align-items-centers"
                                            data-kt-menu-dismiss="true"><iconify-icon icon="mingcute:search-3-line"
                                                class="fa-1-5" style="color: black"></iconify-icon></button>
                                        @php
                                            // Fetch only the 'department' parameter from the current request, discard others
                                            $specificUrlParams = [
                                                'department' => request('department'),
                                                'saved_job' => request('saved_job'),
                                                'org_department' => request('org_department'),
                                            ]; // Retains only 'department'
                                        @endphp
                                        <a href="{{ route('admin.saved.jobdescriptions', $specificUrlParams) }}"
                                            class="btn btn-sm btn-light btn-active-light-primary me-2 mx-1 d-flex justify-content-center align-items-center"
                                            data-kt-menu-dismiss="true"><iconify-icon icon="system-uicons:reset-alt"
                                                class="fa-2x" style="color: black"></iconify-icon></a>

                                    </div>
                                    <!--end::Input group-->
                                </div>
                                <!--end::Search blog-->
                            </form>


                            <!--begin::Catigories-->
                            <div class="mb-15">
                                <h4 class="text-gray-900 mb-7">Jobs</h4>

                                <!--begin::Menu-->
                                <div
                                    class="menu menu-rounded menu-column menu-title-gray-700 menu-state-title-primary menu-active-bg-light-primary fw-semibold">

                                    @foreach ($jobs as $key => $job)
                                        @php
                                            $currentUrlParams = request()->query(); // Get current query parameters
                                            $currentUrlParams['selected_job'] = $job->id; // Set or replace the 'level' parameter
                                            $currentUrlParams['search'] = request('search'); // Set or replace the 'level' parameter
                                        @endphp

                                        <!--begin::Item-->
                                        <div class="menu-item mb-1">
                                            <!--begin::Link-->
                                            <a href="{{ route('admin.saved.jobdescriptions', $currentUrlParams) }}"
                                                class="menu-link py-3 {{ request('selected_job') == $job->id ? 'active' : ($key == 0 && !request('selected_job') ? 'active' : '') }}">
                                                {{ $job->title ?? 'NA' }} 
                                                @if($job->saved_job == 1)
                                                    @if($job->status == 1)
                                                      - *Pending*
                                                    @else
                                                      - *Approved*
                                                    @endif
                                                @endif
                                            </a>
                                            <!--end::Link-->
                                        </div>
                                        <!--end::Item-->
                                    @endforeach

                                </div>
                                <!--end::Menu-->
                            </div>
                            <!--end::Catigories-->







                        </div>
                        <!--end::Sidebar-->

                        <!--begin::Content-->
                        <div class="flex-lg-row-fluid">
                            @if ($selectedJob && isset($selectedJob))




                                <!--begin::Extended content-->
                                <div class="mb-13">
                                    <!--begin::Content-->
                                    <div class="mb-15">
                                        <!--begin::Title-->
                                        <div class="d-flex justify-content-between">
                                            <div class="d-flex">
                                                <h4 class="fs-2x text-gray-800 w-bolder mb-6">
                                                    {{ $selectedJob->title ?? 'NA' }}

                                                </h4>
                                                <div class="align-items-baseline d-flex ml-3 mx-4">

                                                @if ($selectedJob->is_primary == "0")
                                                    <a href="{{ route('jobs.edit', $selectedJob->id) }}"
                                                        class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 mx-2">
                                                        <iconify-icon icon="heroicons:pencil-square"
                                                            class="fa-1-5"></iconify-icon>
                                                    </a>
                                                    <form action="{{ route('jobs.destroy', $selectedJob->id) }}"
                                                        id="form-{{ $selectedJob->id }}" class="btn btn-icon " method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" custom1="{{ $selectedJob->id }}"
                                                            class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm mb-1 show_confirm">
                                                            <iconify-icon icon="heroicons:trash"
                                                                class="fa-1-5"></iconify-icon>
                                                        </button>
                                                    </form>
                                                @endif

                                              
                                                    <a href="/admin/export/jobdescriptions/{{ $selectedJob->id }}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 mx-2 " title="Export"><iconify-icon icon="clarity:export-solid" class="fa-1-5"></iconify-icon></a>
                                                                                                   
                                                </div>
                                            </div>
                                            <div>
                                                @if($selectedJob->saved_job == 1)
                                                    @if($selectedJob->status == 1)
                                                        <span class="badge badge-warning fs-3 mr-2 mb-2"> 
                                                            Pending
                                                        </span>
                                                    @else
                                                        <span class="badge badge-success fs-3 mr-2 mb-2"> 
                                                            Approved
                                                        </span>
                                                    @endif
                                                @endif
                                                <span class="badge badge-success fs-3"> Head
                                                    Counts:{{ $selectedJob->heads ?? 0 }}</span>
                                                <span class="badge badge-success fs-3">
                                                    Employees:{{ $employeesCount ?? 0 }}</span>
                                            </div>
                                        </div>
                                        <!--end::Title-->

                                        <!--begin::Text-->
                                        <p class="fw-semibold fs-4 text-gray-600 mb-2">
                                            {{ $selectedJob->description ?? 'NA' }}

                                        </p>
                                        <!--end::Text-->
                                    </div>
                                    <!--end::Content-->
                                    @if($job->is_primary == 0)

                                    <div class="mb-0">
                                        <!--begin::Title-->
                                        <h3 class="text-gray-800 w-bolder mb-4">
                                            Job Qualifications
                                        </h3>
                                        <p class="fw-semibold fs-4 text-gray-600 mb-2">
                                           <span class="text-gray-800">Education Level:</span> {{ $selectedJob->educationLevel->name ?? ''}}

                                        </p>
                                        <p class="fw-semibold fs-4 text-gray-600 mb-2">
                                            <span class="text-gray-800">Scope of Study:</span> {{ $selectedJob->scopeStudy->name ?? ''}}
                                         </p>

                                         <p class="fw-semibold fs-4 text-gray-600 mb-2">
                                            @php
                                                $secondaryscopeArray = json_decode($selectedJob->jobSecondaryScopeOfStudies, true) ?? [];
                                                $secondaryscopes = [];
                                                foreach ($secondaryscopeArray as $secondaryscope) {
                                                    if (is_array($secondaryscope) ) {
                                                    

                                                        $secondaryscopes[] = $secondaryscope['title'];
                                                        
                                                    }
                                                }
                                            @endphp
                                        
                                       
                                        
                                            <span class="text-gray-800">Secondary Scope of Study:</span> {{ implode(' | ', $secondaryscopes) }}
                                         </p>


                                         <p class="fw-semibold fs-4 text-gray-600 mb-2">
                                            @php
                                            $certificatesArray = json_decode($selectedJob->professional_certificate, true) ?? [];
                                            $certificates = [];
                                            foreach ($certificatesArray as $certificate) {
                                                if (is_array($certificate) && isset($certificate['value'])) {
                                                    $certificates[] = $certificate['value'];
                                                }
                                            }
                                        @endphp
                                        
                                            <span class="text-gray-800">Relevant Professional Certificates:</span> {{ implode(' | ', $certificates) }}
                                         </p>

                                         <p class="fw-semibold fs-4 text-gray-600 mb-2">
                                            @php
                                            $relevant_trainingArray = json_decode($selectedJob->relevant_training, true) ?? [];
                                            $relevant_trainings = [];
                                            foreach ($relevant_trainingArray as $relevant_training) {
                                                if (is_array($relevant_training) && isset($relevant_training['value'])) {
                                                    $relevant_trainings[] = $relevant_training['value'];
                                                }
                                            }
                                            @endphp
                                            <span class="text-gray-800">Relevant Training Programs:</span> {{ implode(' | ', $relevant_trainings) }}
                                         </p>

                                         <p class="fw-semibold fs-4 text-gray-600 mb-8">
                                            <span class="text-gray-800">Experience in Relevant Sector:</span> {{ $selectedJob->work_experience ?? ''}} Years
                                         </p>

                                    </div>
                                    @endif
                                    <!--begin::Item-->
                                    <div class="mb-0">
                                        <!--begin::Title-->
                                        <h3 class="text-gray-800 w-bolder mb-4">
                                            Critical Work Functions
                                        </h3>
                                        <!--end::Title-->

                                        <!--begin::Accordion-->


                                        <!--begin::Section-->
                                        <div class="m-0">


                                            <!--end::Icon-->


                                            <!--end::Heading-->
                                            <div class="accordion accordion-icon-collapse col-lg-10" id="kt_accordion_3">
                                                <!--begin::Item-->
                                                @foreach ($selectedJob->criticalFunctions as $key3 => $value3)
                                                    <div class="mb-5">
                                                        <!--begin::Header-->
                                                        <div class="accordion-header collapsed py-3 d-flex"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#kt_accordion_3_item_{{ $key3 }}">
                                                            <span class="accordion-icon">

                                                                <iconify-icon icon="noto-v1:plus"
                                                                    class="accordion-icon-off fs-3 me-3"></iconify-icon>

                                                                <iconify-icon icon="noto-v1:minus"
                                                                    class="accordion-icon-on fs-3 me-3"></iconify-icon>


                                                            </span>
                                                            {{ $value3->description ?? '' }}
                                                        </div>
                                                        <!--end::Header-->

                                                        <!--begin::Body-->
                                                        <div id="kt_accordion_3_item_{{ $key3 }}"
                                                            class="fs-6 collapse  ps-10" data-bs-parent="#kt_accordion_3">


                                                            @foreach ($value3->cwfKeys as $key)
                                                                <div class="badge badge-primary">{{ $key->name ?? '' }}
                                                                </div>
                                                            @endforeach

                                                        </div>
                                                        <!--end::Body-->
                                                    </div>
                                                @endforeach

                                            </div>



                                            <!--begin::Separator-->
                                            {{-- <div class="separator separator-dashed"></div> --}}
                                            <!--end::Separator-->
                                        </div>
                                        <!--end::Section-->



                                        <!--end::Accordion-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="mb-15">
                                        <!--begin::Title-->
                                        <h3 class="text-gray-800 w-bolder mb-4">
                                            Generic Skills
                                        </h3>
                                        <!--end::Title-->

                                        <!--begin::Accordion-->


                                        @foreach ($selectedJob->skills as $index => $skill)
                                            <!--begin::Section-->
                                            <div class="m-0">
                                                <!--begin::Heading-->
                                                <div class="d-flex align-items-center justify-content-between  collapsible py-3 toggle  mb-0"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#kt_job_{{ $index }}">
                                                    <!--begin::Icon-->

                                                    <!--end::Icon-->

                                                    <!--begin::Title-->
                                                    <h4 class="text-gray-700 fw-bold cursor-pointer mb-0">

                                                        <div
                                                            class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                                            <iconify-icon icon="ion:chevron-collapse" width="1.2em"
                                                                height="1.2em"></iconify-icon>
                                                        </div>
                                                        {{ $skill->title ?? 'NA' }}

                                                        {{-- <iconify-icon icon="vaadin:level-right" width="1.2rem" height="1.2rem"  style="color: black"></iconify-icon> --}}



                                                    </h4>

                                                    <h4 class="text-gray-700 fw-bold cursor-pointer mb-0">
                                                        {{ 'Level ' . $skill->level }}</h4>
                                                    <!--end::Title-->
                                                </div>
                                                <!--end::Heading-->

                                                <!--begin::Body-->
                                                <div id="kt_job_{{ $index }}"
                                                    class="collapse {{ $index == 0 ? 'show' : '' }} fs-6 ms-1">


                                                    <div class="mb-4 text-gray-600 fw-semibold fs-6 ps-10">
                                                        @foreach ($masterSkills as $key1 => $value1)
                                                            {{ $skill->title == $value1->name ? $value1->description : '' }}
                                                        @endforeach
                                                    </div>

                                                    <!--begin::Text-->

                                                    <!--end::Text-->
                                                </div>
                                                <!--end::Content-->


                                                <!--begin::Separator-->
                                                <div class="separator separator-dashed"></div>
                                                <!--end::Separator-->
                                            </div>
                                            <!--end::Section-->
                                        @endforeach



                                        <!--end::Accordion-->
                                    </div>
                                    <!--end::Item-->

                                    <!--begin::Item-->
                                    <div class="mb-15">
                                        <h3 class="text-gray-800 w-bolder mb-4">
                                            Technical Skills

                                        </h3>
                                        @foreach ($selectedJob->technicalSkills as $key4 => $value4)
                                            <div class="m-0">
                                                <!--begin::Heading-->
                                                <div onclick="technicalpopulateModal('{{ $key4 }}', '{{ App\Helpers\MainHelper::escapeSpecialCharacters(json_encode($value4)) }}', '{{ $value4->name }}', '{{ $value4->pivot->level }}')"
                                                 data-bs-toggle="modal"
                                                data-bs-target="#techskillmodal"
                                                    class="d-flex align-items-center justify-content-between   py-3 toggle  mb-0">
                                                    <!--begin::Icon-->

                                                    <!--end::Icon-->

                                                    <!--begin::Title-->
                                                    <h4 class="text-gray-700 fw-bold cursor-pointer mb-0">

                                                        <div 
                                                            class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                                            <iconify-icon icon="ion:chevron-collapse" width="1.2em"
                                                                height="1.2em"></iconify-icon>
                                                        </div>
                                                        {{ $value4->name ?? 'NA' }}

                                                        {{-- <iconify-icon icon="vaadin:level-right" width="1.2rem" height="1.2rem"  style="color: black"></iconify-icon> --}}



                                                    </h4>

                                                    <h4 class="text-gray-700 fw-bold cursor-pointer mb-0">
                                                        {{ 'Level ' . $value4->pivot->level }}</h4>
                                                    <!--end::Title-->
                                                </div>

                                                <div class="separator separator-dashed"></div>
                                            </div>
                                        @endforeach


                                    </div>
                                    <!--end::Item-->


                                    @if ($selectedJob->org_department != null && $selectedJob->org_department > 0)
                                        <div class="mb-0">
                                            <!--begin::Title-->
                                            <h3 class="text-gray-800 w-bolder mb-4">
                                                {{-- Employees --}}
                                            </h3>
                                            <!--end::Title-->

                                            {{-- <form action="{{ route('job.employee.save') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="job_id" value="{{ $selectedJob->id }}">
                                                <input type="hidden" name="department"
                                                    value="{{ $selectedJob->org_department }}">

                                                <!--begin::Section-->
                                                <div class="m-0">
                                                    <div class="fv-row mb-7 fv-plugins-icon-container col-lg-12">
                                                        <label for="employees" class="fw-semibold fs-6 mb-2">Select
                                                            Employees</label>
                                                        <select id="employees"
                                                            class="form-select form-select-solid mb-3 mb-lg-0"
                                                            data-employees='@json($selectedJob->employees->pluck('name', 'id')->toArray())'
                                                            data-control="select2" data-close-on-select="false"
                                                            name="employees[]" data-placeholder="Select Employees"
                                                            multiple>
                                                            <option value="" class="dark:bg-slate-700">Select
                                                                Employees</option>

                                                        </select>
                                                    </div>
                                                </div>
                                                <div>
                                                    <button type="submit"
                                                        class="btn btn-sm fw-bold btn-success">Save</button>
                                                </div>
                                            </form> --}}
                                        </div>
                                    @endif


                                </div>
                                <!--end::Extended content-->
                            @endif
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Layout-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::FAQ card-->
        </div>

    </div>


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
        .trimmed-description {
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }
    </style>

@endsection
@section('scripts')

    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    <script>
        $(document).ready(function() {
            var maxLength = 100; // maximum number of characters to show initially

            // Using event delegation
            $(document).on('click', '.view-more', function(event) {
                event.preventDefault();
                var $description = $(this).closest('.description');
                var $fullDescription = $description.find('.full-description');
                var $trimmedDescription = $description.find('.trimmed-description');

                $trimmedDescription.toggle();
                $fullDescription.toggle();

                $(this).text(function(_, text) {
                    return text === "View More" ? "View Less" : "View More";
                });
            });

            $('.description').each(function() {
                var $description = $(this);
                var $fullDescription = $description.find('.full-description');
                var $trimmedDescription = $description.find('.trimmed-description');

                var fullText = $fullDescription.text();
                var trimmedText = fullText.substring(0, maxLength).trim();

                $trimmedDescription.text(trimmedText + '...');
                $fullDescription.hide();
            });
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script type="text/javascript">
        $('.show_confirm').click(function(event) {
            var form = $('#form-' + $(this).attr('custom1'));
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                    title: `Are you sure you want to delete this job?`,
                    text: "If you delete this, it will be gone forever.",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
        });

        $('.show_confirm_save').click(function(event) {
            var form = $('#ajax-form');
            event.preventDefault();
            swal({
                    title: `Are you sure you want to save this job?`,
                    text: "",
                    icon: "success",
                    buttons: true,
                    dangerMode: false,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
        });

        $('.show_confirm_remove').click(function(event) {
            var form = $('#ajax-form');
            event.preventDefault();
            swal({
                    title: `Are you sure you want to remove this job from saved list?`,
                    text: "",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
        });
    </script>

    <script>
        function initSelect2(selector) {
            var $select = $(selector);

            var data = $select.data('employees');
            // Append the initial option if provided

            if (data) {
                Object.entries(data).forEach((element, index) => {
                    var option = new Option(element[1], element[0], true, true);
                    $select.append(option).trigger('change');
                });

            }

            // Initialize Select2 with AJAX support
            $select.select2({
                ajax: {
                    url: '{{ route('job.search') }}',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: params.term
                        };
                    },
                    processResults: function(data, params) {
                        return {
                            results: data.results,
                            pagination: {
                                more: data.pagination.more
                            }
                        };
                    },
                    cache: true
                },
                placeholder: 'Select Employess',
                minimumInputLength: 1
            });
        }
        // });

        $(document).ready(function() {
            // Assume these values are passed from the server

            initSelect2('#employees');
        });
    </script>


    <script>
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
                <div class="form-check col-lg-2">
                
            
                        <label class="form-check-label h-100 w-100" for="level_1">
                            <div class="col-lg-12 h-100">
                                    <div class="card card-stretch card-bordered mb-5 h-100">
                                        <div class="card-header align-items-center">
                                            <h3 class="card-title">Level ${i}</h3>
                                            <input class="form-check-input border-dark" type="radio" disabled value="${i-1}" id="level_${i}" name="level" ${selectedLevel == i ? 'checked' : ''}>

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
                                        <h3 class="card-title ">Level ${i}</h3>
                                        <input class="form-check-input border-dark" disabled type="radio" value="${i-1}" id="level_${i}" name="level" ${selectedLevel == i ? 'checked' : ''}>

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

@endsection
