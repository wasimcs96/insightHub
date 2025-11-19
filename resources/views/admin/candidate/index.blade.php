@extends('admin.layout.app')

@section('title', 'Users')
@section('styles')
    <style>
        .image-input-placeholder {
            background-image: url({{ asset('admin/media/svg/files/blank-image.svg') }});
        }

        [data-bs-theme="dark"] .image-input-placeholder {
            background-image: url({{ asset('admin/media/svg/files/blank-image-dark.svg') }});
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
                <h1
                    class="page-heading capitalize d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                    Candidate
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
                    <li class="breadcrumb-item capitalize text-muted">
                        Candidate </li>
                    <!--end::Item-->

                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
            <!--begin::Action group-->
            <!--begin::Toolbar end-->
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <!--begin::Filter menu-->
                <div class="m-0">
                    <!--begin::Menu toggle-->
                    <a href="#" class="btn btn-sm btn-flex btn-secondary fw-bold" data-kt-menu-trigger="click"
                        data-kt-menu-placement="bottom-end">
                        <iconify-icon icon="mingcute:filter-line" class="fa-1x"></iconify-icon>
                        Filter
                    </a>
                    <!--end::Menu toggle-->



                    <!--begin::Menu 1-->
                    <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true"
                        id="kt_menu_65e95fe68ac03">
                        <!--begin::Header-->
                        <div class="px-7 py-5">
                            <div class="fs-5 text-gray-900 fw-bold">Filter Options</div>
                        </div>
                        <!--end::Header-->

                        <!--begin::Menu separator-->
                        <div class="separator border-gray-200"></div>
                        <!--end::Menu separator-->


                        <!--begin::Form-->
                        <div class="px-7 py-5"
                            style="overflow-y: scroll;height: 500px;">
                            <!--begin::Input group-->
                            <form id="filter-form" action="" method="GET">

                                <input type="hidden" name="export" value="0" id="export-input">
                                <input type="hidden" name="is_assessment" value="{{ request('is_assessment') }}"
                                    id="export-input">
                                    
                                <span class="fs-7 fw-bold text-gray-700 flex-shrink-0 pe-4 d-none d-md-block py-2">Search
                                    By Name:</span>
                                <!--end::Label-->

                                <!--begin::Input-->
                                <input type="text" name="name" class="form-control mb-3 mb-lg-0 "
                                    value="{{ request('name') }}" placeholder="Name">

                                <span class="fs-7 fw-bold text-gray-700 flex-shrink-0 pe-4 d-none d-md-block py-2">Search
                                    By Email:</span>
                                <input type="text" name="email" class="form-control mb-3 mb-lg-0"
                                    placeholder="Search by Email" value="{{ request('email') }}">

                                <span class="fs-7 fw-bold text-gray-700 flex-shrink-0 pe-4 d-none d-md-block">Select
                                    Department:</span>

                                <!--begin::Select-->
                                <select class="form-select form-select-solid me-6" data-control="select2"
                                    data-placeholder="Select Department" data-hide-search="true" name="department"
                                    id="department">
                                    <option selected="selected" value=""
                                        class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                                        Select Department</option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}"
                                            class="py-1 inline-block font-Inter font-normal text-sm text-slate-600"
                                            {{ request('department') == $department->id ? 'selected' : '' }}>
                                            {{ $department->head_of_department ?? '' }}</option>
                                    @endforeach

                                </select>




                                <span class="fs-7 fw-bold text-gray-700 flex-shrink-0 pe-4 d-none d-md-block py-2"> Select
                                    Level:</span>
                                <!--end::Label-->

                                <!--begin::Select-->
                                <select class="form-select form-select-solid me-6" data-control="select2"
                                    data-placeholder=" Select Level" data-hide-search="true" name="level" id="level">

                                    <option value="" selected="selected"
                                        class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                                        Select Level
                                    </option>

                                    <option @if (request('level') == '1') selected @endif value="1"
                                        class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                                        Level 1
                                    </option>

                                    <option @if (request('level') == '2') selected @endif value="2"
                                        class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                                        Level 2
                                    </option>

                                    <option @if (request('level') == '3') selected @endif value="3"
                                        class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                                        Level 3
                                    </option>

                                    <option @if (request('level') == '4') selected @endif value="4"
                                        class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                                        Level 4
                                    </option>

                                </select>




                                <span class="fs-7 fw-bold text-gray-700 flex-shrink-0 pe-4 d-none d-md-block py-2"> Select
                                    Potential:</span>
                                <!--end::Label-->

                                <!--begin::Select-->
                                <select class="form-select form-select-solid me-6" data-control="select2"
                                    data-placeholder=" Select Potential" data-hide-search="true" name="potential"
                                    id="potential">

                                    <option value="" selected="selected"
                                        class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                                        Select Potential
                                    </option>

                                    <option @if (request('potential') == '1') selected @endif value="1"
                                        class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                                        High Potential
                                    </option>

                                    <option @if (request('potential') == '2') selected @endif value="2"
                                        class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                                        Average Potential
                                    </option>


                                </select>



                                <span
                                    class="fs-7 fw-bold text-gray-700 flex-shrink-0 pe-4 d-none d-md-block py-2">Age:</span>
                                <!--end::Label-->
                                @php
                                    $employees = \App\Models\User::where('is_personality_motivation_completed', 1)
                                        ->where('is_work_interest_completed', 1)
                                        ->where('is_cognitive_ability_completed', 1)
                                        ->get();
                                @endphp
                                <!--begin::Select-->
                                
                                <select class="form-select form-select-solid me-6" data-control="select2"
                                    data-placeholder="Select Age" data-hide-search="true" name="age" id="age">
                                    <option selected="Selected" value=""
                                        class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                                        Select Age</option>
                                    <option @if (request('age') == '15_20') selected @endif value="15_20"
                                        class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                                        15 - 20 Years
                                    </option>
                                    <option @if (request('age') == '21_25') selected @endif value="21_25"
                                        class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                                        21 - 25 Years</option>
                                    <option @if (request('age') == '26_30') selected @endif value="26_30"
                                        class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                                        26 - 30 Years</option>
                                    <option @if (request('age') == '31_35') selected @endif value="31_35"
                                        class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                                        31 - 35 Years</option>
                                    <option @if (request('age') == '36_40') selected @endif value="36_40"
                                        class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                                        36 - 40 Years</option>
                                    <option @if (request('age') == '40_100') selected @endif value="40_100"
                                        class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                                        40 + Years</option>
                                </select>
                                <!--end::Select-->
                                <!--begin::Separartor-->

                                <!--end::Separartor-->
                                <span
                                    class="fs-7 fw-bold text-gray-700 flex-shrink-0 pe-4 d-none d-md-block py-2">Gender:</span>
                                <!--end::Label-->

                                <!--begin::Select-->
                                <select class="form-select form-select-solid me-6" data-control="select2"
                                    data-placeholder="Select Gender" data-hide-search="true" name="gender"
                                    id="gender">
                                    <option selected="selected" value=""
                                        class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                                        Select Gender</option>
                                    <option @if (request('gender') == '0') selected @endif value="0"
                                        class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                                        Male
                                    </option>
                                    <option @if (request('gender') == 1) selected @endif value="1"
                                        class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                                        Female</option>
                                </select>
                                <!--end::Select-->
                                <!--begin::Label-->
                                <!--begin::Separartor-->

                                <!--end::Separartor-->
                                @php
                                    $education_levels = \App\Models\MasterEducationLevel::all();
                                @endphp
                                <span
                                    class="fs-7 fw-bold text-gray-700 flex-shrink-0 pe-4 d-none d-md-block py-2">Education
                                    Level:</span>
                                <!--end::Label-->

                                <!--begin::Select-->
                                <select class="form-select form-select-solid me-6" data-control="select2"
                                    data-placeholder="Select Education Level" data-hide-search="true"
                                    name="education_level" id="education_level">
                                    <option selected="selected" value=""
                                        class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                                        Select Education Level</option>
                                    @foreach ($education_levels as $education_level)
                                        <option value="{{ $education_level->id }}"
                                            class="py-1 inline-block font-Inter font-normal text-sm text-slate-600"
                                            {{ request('education_level') == $education_level->id ? 'selected' : '' }}>
                                            {{ $education_level->name ?? '' }}</option>
                                    @endforeach

                                </select>


                                <span class="fs-7 fw-bold text-gray-700 flex-shrink-0 pe-4 d-none d-md-block py-2">Work
                                    Experience:</span>
                                <!--end::Label-->

                                <!--begin::Select-->
                                <select class="form-select form-select-solid me-6" data-control="select2"
                                    data-placeholder=" Select Work Experience" data-hide-search="true"
                                    name="work_experience" id="work_experience">
                                    <option value="" selected="selected"
                                        class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                                        Select Work Experience
                                    </option>
                                    <option @if (request('work_experience') == '0_3') selected @endif value="0_3"
                                        class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                                        0 - 3 Years</option>

                                    <option @if (request('work_experience') == '3_5') selected @endif value="3_5"
                                        class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                                        3 - 5 Years
                                    </option>
                                    <option @if (request('work_experience') == '5_100') selected @endif value="5_100"
                                        class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                                        5 + Years
                                    </option>

                                </select>

                                <span
                                    class="fs-7 fw-bold text-gray-700 flex-shrink-0 pe-4 d-none d-md-block py-2">Assessment
                                    Completion Status:</span>
                                <!--end::Label-->

                                <!--begin::Select-->
                                <select class="form-select form-select-solid me-6" data-control="select2"
                                    data-placeholder="Select Assessment Completion Status" data-hide-search="true"
                                    name="assessment_completion" id="assessment_completion">
                                    <option value="" selected="selected"
                                        class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                                        Select Assessment Completion Status
                                    </option>
                                    <option @if (request('assessment_completion') == '0') selected @endif value="0"
                                        class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                                        Not Completed</option>

                                    <option @if (request('assessment_completion') == '1') selected @endif value="1"
                                        class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                                        Completed
                                    </option>


                                </select>

                                <!--begin::Actions-->
                               
                            </form>
                            <!--end::Actions-->
                        </div>
                        <div class="px-7 py-5">
                            <div class="d-flex justify-content-end py-2">
                                <a href="/admin/candidate" class="btn btn-sm btn-light btn-active-light-primary me-2"
                                    data-kt-menu-dismiss="true">Reset</a>

                                <button type="button" onclick="document.getElementById('filter-form').submit();" class="btn btn-sm btn-primary"
                                    data-kt-menu-dismiss="true">Apply</button>


                            </div>
                        </div>
                        <!--end::Form-->
                    </div>
                    <!--end::Menu 1-->
                </div>
                <!--end::Filter menu-->


                <!--begin::Secondary button-->
                <!--end::Secondary button-->

                <!--begin::Primary button-->
           
                <!--end::Primary button-->
            </div>



            <!--end::Toolbar end-->
            <!--end::Action group-->
        </div>
        <!--end::Toolbar end-->
        <!--end::Action group-->
    </div>
    <!--end::Toolbar container-->
    {{-- </div> --}}

    <!--begin::Content-->
    <div id="kt_app_content" class="app-content  flex-column-fluid ">


        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container  ">
            <!--begin::Card-->
            <div class="card">
                <!--begin::Card header-->
                <div class="card-header border-0 pt-6">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <h2 class="capitalize"> Candidate List</h2>
                    </div>
                    <!--begin::Card title-->

                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Toolbar-->
                        <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                           
                            {{-- <button type="button" class="btn btn-light-primary me-3 d-flex align-items-center"
                                id="export-button">
                                <iconify-icon icon="clarity:export-line" class="fa-1x"></iconify-icon> Export
                            </button> --}}
                            <!--end::Export-->



                            <!--begin::Export-->
                            <button type="button" class="btn btn-light-primary me-3 d-flex align-items-center"
                                data-bs-toggle="modal" data-bs-target="#kt_modal_export_users">
                                <iconify-icon icon="uil:import" class="fa-1-5"></iconify-icon> Import
                            </button>
                            <!--end::Export-->

                            <!--begin::Add user-->
                            {{-- <a href="/admin/myemployee/create/" class="btn btn-primary d-flex align-items-center">
                                <iconify-icon icon="charm:plus"></iconify-icon>
                                Add User
                            </a> --}}
                            <!--end::Add user-->
                        </div>
                        <!--end::Toolbar-->

                        <!--begin::Group actions-->
                        <div class="d-flex justify-content-end align-items-center d-none"
                            data-kt-user-table-toolbar="selected">
                            <div class="fw-bold me-5">
                                <span class="me-2" data-kt-user-table-select="selected_count"></span> Selected
                            </div>

                            <button type="button" class="btn btn-danger" data-kt-user-table-select="delete_selected">
                                Delete Selected
                            </button>
                        </div>
                        <!--end::Group actions-->


                    </div>
                    <!--end::Card toolbar-->
                </div>
                <!--end::Card header-->

                <!--begin::Card body-->
                <div class="card-body py-4" style="overflow-x: scroll;">

                    <!--begin::Table-->
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
                        <thead>
                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                {{-- <th class="w-10px pe-2">
                                <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                    <input class="form-check-input" type="checkbox" data-kt-check="true"
                                        data-kt-check-target="#kt_table_users .form-check-input" value="1" />
                                </div>
                            </th> --}}
                                <th class="min-w-125px">User</th>
                                {{-- <th class="min-w-100px">Role</th> --}}
                                <th class="min-w-100px">Company</th>

                                <th class="min-w-100px">Department</th>
                                <th class="min-w-100px">Position</th>
                                {{-- <th class="min-w-100px">Expected Salary</th> --}}


                                <th class="min-w-100px">Age</th>
                                <th class="min-w-100px">City</th>
                                <th class="min-w-100px">About Me</th>
                                <th class="min-w-100px">Ocean</th>
                                <th class="min-w-100px">RIASEC</th>
                                <th class="min-w-100px">Cognitive</th>

                                {{-- <th class="text-center min-w-100px">Actions</th> --}}
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-semibold">
                            @foreach ($users as $user)
                                <tr>
                                    {{-- <td>
                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="1" />
                                </div>
                            </td> --}}
                                    <td class="d-flex align-items-center">
                                        <!--begin:: Avatar -->
                                        <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                            <a href="#">
                                                <div class="symbol-label">
                                                    @if (isset($user->profile_picture) && File::exists(public_path($user->profile_picture)))
                                                        <img src="{{ asset($user->profile_picture) }}"
                                                            alt="{{ $user->name ?? '' }}" class="w-100" />
                                                    @else
                                                        <img src="{{ asset('images/default-user.svg') }}"
                                                            alt="{{ $user->name ?? '' }}" class="w-100" />
                                                    @endif
                                                </div>
                                            </a>
                                        </div>
                                        <!--end::Avatar-->
                                        <!--begin::User details-->
                                        <div class="d-flex flex-column">
                                            <a href="{{ route('admin.candidate.details', ['id' => $user->id]) }}" target="_blank"
                                                class="text-gray-800 text-hover-primary mb-1">{{ $user->first_name ?? '' }}
                                                {{ $user->last_name ?? '' }}</a>
                                            <span>{{ $user->email ?? '' }}</span>
                                        </div>
                                        <!--begin::User details-->
                                    </td>
                                    

                                    <td>{{ $user->company->userCompany->name ?? '' }} </td>

                                    <td>{{ $user->department && $user->department->head_of_department ? $user->department->head_of_department : '' }}
                                    </td>

                                    {{-- <td>{{ $user->job_position->title ?? '' }} </td> --}}

                                    <td>{{ $user->expected_salary ?? '' }} </td>

                                    <td> {{ $user->age ?? 'N/A' }} </td>

                                    <td>
                                        {{ $user->city ?? 'N/A' }}
                                    </td>
                                    <td>
                                        @if ($user->first_time_login == 1)
                                            <div class="badge badge-success fw-bold">
                                                Yes
                                            </div>
                                        @else
                                            <div class="badge badge-danger fw-bold">
                                                No
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($user->is_personality_motivation_completed == 1)
                                            <div class="badge badge-success fw-bold">
                                                Yes
                                            </div>
                                        @else
                                            <div class="badge badge-danger fw-bold">
                                                No
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($user->is_work_interest_completed == 1)
                                            <div class="badge badge-success fw-bold">
                                                Yes
                                            </div>
                                        @else
                                            <div class="badge badge-danger fw-bold">
                                                No
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($user->is_cognitive_ability_completed == 1)
                                            <div class="badge badge-success fw-bold">
                                                Yes
                                            </div>
                                        @else
                                            <div class="badge badge-danger fw-bold">
                                                No
                                            </div>
                                        @endif
                                    </td>

                                    {{-- <td class="text-center">

                                        <a href="/admin/myemployee/send/email/{{ $user->id }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Send Email"
                                            class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 mb-2">

                                            <iconify-icon icon="mdi:email-sent-outline" class="fa-1-5"></iconify-icon>
                                        </a>

                                        <a href="/admin/employee-details/{{ $user->id }}"data-bs-toggle="tooltip" data-bs-placement="top" title="View Detail"
                                            class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 mb-2">
                                            <iconify-icon icon="fluent:eye-20-regular" class="fa-1-5"></iconify-icon>
                                        </a>

                                        <a href="/admin/myemployee/{{ $user->id }}/edit" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit User"
                                            class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 mb-2">
                                            <iconify-icon icon="heroicons-outline:pencil-alt"
                                                class="fa-1-5"></iconify-icon>
                                        </a>

                                        <a href="/admin/myemployee/{{ $user->id }}/delete" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete User"
                                            class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm mb-2">
                                            <iconify-icon icon="iconamoon:trash-light" class="fa-1-5"></iconify-icon>
                                        </a>
                                        
                                        @if($user->position_id != null)
                                        @php $contract = App\Models\Contract::where('employee_id',$user->id)->where('job_id',$user->position_id)->first(); @endphp
                                     
                                        @if(!isset($contract))
                                        
                                        <a data-bs-toggle="modal" data-bs-target="#kt_modal_2" userid="{{ $user->id ?? '' }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Assign Contract"
                                            class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 mb-2" >
                                            <iconify-icon icon="teenyicons:contract-outline"  class="fa-1-5"></iconify-icon>
                                        </a>
                                        @else
                                        <a href="{{ $contract->contract_pdf ?? ''}}" target="_blank" data-bs-toggle="tooltip" data-bs-placement="top" title="View Assigned Contract"
                                            class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 mb-2">
                                            <iconify-icon icon="mdi:contract-sign" class="fa-1-5"></iconify-icon>
                                        </a>
                                        @endif
                                        @endif
                                        
                                    </td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!--end::Table-->
                    {{ $users->appends(request()->query())->links() }}

                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->


    <!--begin::Modal - Adjust Balance-->
    <div class="modal fade" id="kt_modal_export_users" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bold">Import Users</h2>
                    <!--end::Modal title-->

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-close btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                        <iconify-icon icon="clarity:close-line" class="fa-1-5"></iconify-icon>
                    </div>
                    <!--end::Close-->
                </div>
                <!--end::Modal header-->

                <!--begin::Modal body-->
                <div class="modal-body mt-0 mx-5 mx-xl-15 my-7 pt-3 scroll-y">

                    <div class="align-items-center d-flex justify-content-between mb-20">
                        <h2>Download Sample File:</h2> <a href="{{ asset('admin/users.xlsx') }}" download target="_blank"
                            class="btn btn-primary">Download</a>
                    </div>
                    <!--begin::Form-->
                    <form id="kt_modal_export_users_form" class="form" action="/admin/candidate/import"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="fs-6 fw-semibold form-label mb-2">Select CSV File:</label>
                            <!--end::Label-->

                            <!--begin::Input-->
                            <input type="file" name="file" class="fw-bold form-control">

                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->



                        <!--begin::Actions-->
                        <div class="text-center">
                            <a type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">
                                Discard
                            </a>

                            <button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">
                                <span class="indicator-label">
                                    Submit
                                </span>
                                <span class="indicator-progress">
                                    Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                            </button>
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
    <!--end::Modal - New Card-->

    {{-- Offer Template start --}}

    <div class="modal fade" tabindex="-1" id="kt_modal_2">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Select Template</h3>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <iconify-icon icon="radix-icons:cross-1" class="ki-cross fs-1"></iconify-icon>
                    </div>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.contract.template.select') }}" id="templateform" method="post">
                        @csrf
                        <input type="hidden" name="user_id" class="form-control bg-transparent"
                            id="user_id" value="" required />

                        @php $templates = App\Models\ContractTemplate::get();@endphp

                        <div class="fv-row mb-8">
                            <label class="form-label mb-3">Select Contract Template</label>
                            <select class="form-control" name="template_id">
                                @foreach ($templates as $template)
                                    <option value="{{ $template->id ?? '' }}">{{ $template->name ?? '' }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback" id="description_error"></div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary"
                        onclick="document.getElementById('templateform').submit();">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    {{--  Offer Template end --}}

@endsection
@section('scripts')
    <script src="{{ asset('admin/js/custom/apps/user-management/users/list/table.js') }}"></script>
    <script>
        document.getElementById('export-button').addEventListener('click', function() {
            document.getElementById('export-input').value = 1;
            document.getElementById('filter-form').submit();
        });
    </script>

    <script>
        $(document).ready(function() {
    $('[data-bs-target="#kt_modal_2"]').on('click', function() {
        var userId = $(this).attr('userid');
        $('#kt_modal_2 #user_id').val(userId);
    });
});

    </script>

@endsection
