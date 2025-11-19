@extends('admin.layout.app')

@section('title', 'Employee Details')
@section('styles')
    <style>
        .description_accordian_left{
         
    text-align: center;
    box-shadow: 0px 0px 7px -4px;
    border-radius: 9px;
    width: max-content;
    padding: 7px;
    margin-left: 238px;

        }
        .description_accordian_right{
         
         text-align: center;
         box-shadow: 0px 0px 7px -4px;
         border-radius: 9px;
         width: max-content;
         padding: 7px;
         margin-left: 238px;
     
             }
        .slider-container {
            display: flex;
            align-items: center;
            /* margin: 17px 0px; */
        }

        .slider-label {
            width: 20%;
            text-align: center;
            font-size: 14px;
        }

        .slider-legend {
            width: 11%;
            text-align: center;
            font-size: 14px;
        }

        .slider-legend_cognitive {
            width: 11%;
            text-align: center;
            font-size: 11px;
            border-radius: 28px;
            padding: 0px;
            color: white;
        }

        .slider-track {
            width: 80%;
            position: relative;
            height: 30px;
            background: #f1f1f1;
            border-radius: 32px;
            margin: 26px 1%;
            max-width: 523px;
        }

        .slider-bar {
            position: absolute;
            top: 50%;
            left: 10%;
            right: 10%;
            height: 4px;
            background: #aaa;
            transform: translateY(-50%);
        }

        .slider-indicator {
            position: absolute;
            top: -20px;
            background: #fff;
            color: #333;
            padding: 2px 5px;
            font-size: 12px;
            border-bottom-right-radius: 50px;
            border-bottom-left-radius: 53px;
            border: 1px solid #aaa;
        }

        .emp_a,
        .emp_b {
            position: absolute;
            top: 1px;
            width: auto;
            height: auto;
            background-color: #005daf;
            border-radius: 50%;
            font-size: smaller;
            color: white;
            padding: 7px 12px;
            /* border-left: 10px solid transparent;
                border-right: 10px solid transparent;
                border-top: 10px solid #00f; */
        }

        .emp_a {
            background-color: #0245A3;
            padding: 15px;
        }

        .emp_b {
            background-color: #1f5476;

        }



        @media (max-width: 768px) {
            .slider-label {
                font-size: 12px;
            }

            .slider-indicator {
                font-size: 10px;
            }

            .emp_a,
            .emp_b {
                position: absolute;
                top: 1px;
                width: auto;
                height: auto;
                background-color: #005daf;
                border-radius: 50%;
                font-size: smaller;
                color: white;
                padding: 5px 11px;
            }

            .emp_a {
                background-color: #0245A3;

            }

            .emp_b {
                background-color: #1f5476;

            }

        }

        @media (min-width: 1024px) {
            .lg\:col-span-6 {
                grid-column: span 6 / span 6;
            }

            .lg\:.col-span-3 {
                grid-column: span 3 / span 3;
            }

            .lg\:.col-span-9 {
                grid-column: span 9 / span 9;
            }
        }

        .col-span-3 {
            grid-column: span 3 / span 3;
        }

        .col-span-9 {
            grid-column: span 9 / span 9;
        }

        .d-flex {
            display: flex;
        }

        .custom_legends {
            padding: 6px 8px;
            border-radius: 50%;
            color: white;
        }

        .hidden_population {
            display: none;
        }

        .modal-backdrop {
            display: none;
        }

        .top_riasec {
            background: #1f5476;
            color: white;
            border-radius: 29px;
        }
    </style>
@endsection

@section('content')
    <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">

        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">



            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                    Dashboard
                </h1>
                <!--end::Title-->


                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="/admin/dashboard" class="text-muted text-hover-primary">
                            Admin </a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    @php
                        $routeName = Route::currentRouteName();
                        if ($routeName == 'admin.candidate.details') {
                            $title = 'Candidate Details';
                        } else {
                            $title = 'Employee Details';
                        }
                    @endphp

                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        {{ $title ?? 'Employee Details' }}
                    </li>
                    <!--end::Item-->

                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
            <!--begin::Actions-->

            <!--end::Actions-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <!--end::Toolbar-->

    <!--begin::Content-->
    <div id="kt_app_content" class="app-content  flex-column-fluid ">


        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container  container-xxl ">
            <div class="card mb-5 mb-xl-10">
                <div class="card-body pt-9 pb-0">
                    <!--begin::Details-->
                    <div class="d-flex flex-wrap flex-sm-nowrap">
                        <!--begin: Pic-->
                        <div class="me-7 mb-4">
                            <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                                <img src="{{ asset($employee->profile_picture ?? '') }}"
                                    onerror="this.src='{{ asset('images/default-user.svg') }}'" alt="image" />
                                {{-- <div
                                    class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-body h-20px w-20px">
                                </div> --}}
                            </div>
                        </div>
                        <!--end::Pic-->

                        <!--begin::Info-->
                        <div class="flex-grow-1">
                            <!--begin::Title-->
                            <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                <!--begin::User-->
                                <div class="d-flex flex-column">
                                    <!--begin::Name-->
                                    <div class="d-flex align-items-center mb-2">
                                        <a href="#"
                                            class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">{{ $employee->first_name ?? '' }} {{ $employee->middle_name ?? '' }}
                                            {{ $employee->last_name ?? ''}}
                                            @if (isset($growth_potential_result) && strtolower($growth_potential_result) == 'very high')
                                            <iconify-icon icon="codicon:verified-filled" class="toolTip onTop ml-2"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="Very High Potential "
                                                style="background: #08d36e; border-radius: 50%;"></iconify-icon>
                                            @elseif (isset($growth_potential_result) && strtolower($growth_potential_result) == 'high')
                                                <iconify-icon icon="codicon:verified-filled" class="toolTip onTop ml-2"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="High Potential"
                                                    style="background: #1E90FF; border-radius: 50%;"></iconify-icon>
                                            @elseif (isset($growth_potential_result) && strtolower($growth_potential_result) == 'moderate')
                                                    <iconify-icon icon="codicon:verified-filled" class="toolTip onTop ml-2"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Moderate Potential"
                                                        style="background: #FFA500; border-radius: 50%;"></iconify-icon>
                                            @elseif (isset($growth_potential_result) && strtolower($growth_potential_result) == 'low')
                                                        <iconify-icon icon="codicon:verified-filled" class="toolTip onTop ml-2"
                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Low Potential"
                                                            style="background: #c4a310; border-radius: 50%;"></iconify-icon>
                                            @else
                                            <iconify-icon icon="solar:verified-check-broken" class="toolTip onTop ml-2"
                                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Very Low"
                                                            style="
                                                background: #9ba9a2; border-radius: 50%;"></iconify-icon>
                                            @endif
                                            {{-- @if ($potential == 3)
                                                <iconify-icon icon="codicon:verified-filled" class="toolTip onTop ml-2"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Super High Potential "
                                                    style="



                                        background: #08d36e;

                                        border-radius: 50%;
                                    "></iconify-icon>
                                            @elseif($potential == 2)
                                                <iconify-icon icon="codicon:verified" class="toolTip onTop ml-2"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title="High Potential "
                                                    style="



                                        background: #16b7f9;

                                        border-radius: 50%;
                                    "></iconify-icon>
                                            @else
                                                <iconify-icon icon="solar:verified-check-broken" class="toolTip onTop ml-2"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Low Potential "
                                                    style="
                                        background: #9ba9a2; border-radius: 50%;
                                    "></iconify-icon>
                                            @endif --}}

                                        </a>
                                        {{-- <a href="#"><i class="ki-duotone ki-verify fs-1 text-primary"><span
                                                    class="path1"></span><span class="path2"></span></i></a> --}}
                                        
                                    </div>
                                    <!--end::Name-->

                                    <!--begin::Info-->
                                    <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
                                        @php
                                            $soft_skill_score = $employee->soft_skill_score;
                                            if ($soft_skill_score > 98) {
                                                $level = 5;
                                            } elseif ($soft_skill_score > 84 && $soft_skill_score <= 98) {
                                                $level = 4;
                                            } elseif ($soft_skill_score >= 16 && $soft_skill_score <= 84) {
                                                $level = 3;
                                            } elseif ($soft_skill_score >= 2 && $soft_skill_score < 16) {
                                                $level = 2;
                                            } elseif ($soft_skill_score > 0 && $soft_skill_score < 2) {
                                                $level = 1;
                                            } else {
                                                $level = 0;
                                            }
                                        @endphp

                                        <a href="#"
                                            class="d-flex align-items-center text-gray-500 text-hover-primary me-2">
                                                Behavior Fit Rate: {{ config('helpers.behavior_fit_rate_levels')[$level] ?? '' }}
                                        </a>

                                        <a href="#"
                                            class="d-flex align-items-center text-gray-500 text-hover-primary me-2">
                                            |
                                        </a>

                                        <a href="#"
                                            class="d-flex align-items-center text-gray-500 text-hover-primary me-2">
                                            Job Title : {{ $employee->job_position->title ?? $employee->job_title ?? '' }}
                                        </a>

                                        <a href="#"
                                            class="d-flex align-items-center text-gray-500 text-hover-primary me-2">
                                            |
                                        </a>
                                        <a href="#"
                                            class="d-flex align-items-center text-gray-500 text-hover-primary me">
                                            Department: {{ $employee->department->name ?? 'N/A' }} </a>


                                    </div>

                                    <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
                                        <a href="#"
                                            class="d-flex align-items-center text-gray-500 text-hover-primary me-2">
                                            Section: {{ $employee->departmentSection->name ?? 'N/A' }}
                                        </a>

                                        <a href="#"
                                            class="d-flex align-items-center text-gray-500 text-hover-primary me-2">
                                            |
                                        </a>
                                        <a href="#"
                                            class="d-flex align-items-center text-gray-500 text-hover-primary me">
                                           Unit: {{ $employee->sectionUnit->name ?? 'N/A' }} </a>


                                    </div>
                                    <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
                                        <a href="#"
                                            class="d-flex align-items-center text-gray-500 text-hover-primary me-2">
                                            Emp ID: #EMP{{ $employee->id  ?? 'N/A' }}
                                        </a>

                                        <a href="#"
                                            class="d-flex align-items-center text-gray-500 text-hover-primary me-2">
                                            |
                                        </a>
                                        <a href="#"
                                            class="d-flex align-items-center text-gray-500 text-hover-primary me">
                                           Date of Hire: {{ \Carbon\Carbon::parse($employee->date_of_hire)->format('F d, Y') ?? 'N/A' }}                                            </a>
                                           <a href="#"
                                           class="d-flex align-items-center text-gray-500 text-hover-primary me-2">
                                           |
                                       </a>
                                           <a href="#"
                                           class="d-flex align-items-center text-gray-500 text-hover-primary me">
                                          Employment Status: {{ config('constants.EMPLOYMENT_STATUSES.'.$employee->employment_status) ?? 'Full Time' }} </a>
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::User-->

                                <!--begin::Actions-->
                                <div class="d-flex my-4">
                                    <a  class="btn  btn-primary me-2" href="/admin/myemployee/{{ $employee->id }}/edit" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="">Edit</a>

                                    <button id="backButton" class="btn  btn-dark me-2" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Go Back">Go Back</button>

                                    {{-- <a class="btn  btn-light me-2" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Print Page" id="printButton">
                                        <iconify-icon icon="mingcute:print-line d-none"></iconify-icon>
                                        <!--begin::Indicator label-->
                                        <span class="indicator-label">
                                            Print</span>
                                        <!--end::Indicator label-->


                                        <!--end::Indicator progress-->
                                    </a> --}}
                                    <a class="btn  btn-light me-2" href="{{ route('admin.employee.details.download_report', $employee->id) }}">
                                        <iconify-icon icon="mingcute:print-line d-none"></iconify-icon>
                                        <!--begin::Indicator label-->
                                        <span class="indicator-label">
                                            Download Report</span>
                                        <!--end::Indicator label-->


                                        <!--end::Indicator progress-->
                                    </a>
                                    {{-- <a href="{{ route('admin.employee.details.download_report', $employee->id) }}"
                                        class="btn  btn-primary me-3" title="Download Report">
                                        <iconify-icon icon="material-symbols:download"></iconify-icon> Download Report
                                    </a> --}}

                                   



                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_1">
                                            Make a HOD
                                        </button>
                                        
                                        <div class="modal fade" tabindex="-1" id="kt_modal_1">
                                            <div class="modal-dialog">
                                            <form action="{{ route('admin.employee.add_to_department')}}" method="POST"  >
                                                    @csrf
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 class="modal-title">Assign HOD</h3>
                                        
                                                        <!--begin::Close-->
                                                        <div class="btn btn-icon  btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                                            <button type="button" class="border-0 bg-transparent" data-bs-dismiss="modal">
                                                                <iconify-icon icon="basil:cancel-outline" class="fa-1-5">
                                                                </iconify-icon>
                                                                <span class="sr-only">Close modal</span>
                                                            </button>
                                                        </div>
                                                        <!--end::Close-->
                                                    </div>
                                        
                                                    <div class="modal-body">
                  

                                                            <input type="hidden" value="{{ $employee->id }}" name="employee_id" hidden>


                                                     
                                                        <!-- Modal body -->
                                                        <div class="p-6 space-y-4">
                                                          

                                                              
                                                            <label class="required fs-6 fw-semibold mb-2">Department</label>
                                                            <select class="form-select form-select-solid" id="department" name="department_id" required>
                                                                <option value="">Select Department...</option>
                                                                @foreach($departments as $department)
                                                                    <option value="{{ $department->id }}" {{ !empty($employee) && $employee->id == $department->user_id ? 'selected' : '' }}>
                                                                        {{ $department->head_of_department }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <!-- Modal footer -->

                                                        
                                                    </div>
                                        
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-success" >Submit</button>
                                                    </div>
                                                </div>
                                            </form>    
                                            </div>
                                        </div>


                                        <div class="modal fade" tabindex="-1" id="assessment_reset">
                                            <div class="modal-dialog">
                                            <form action="{{ route('admin.employee.assessment_reset')}}" method="POST"  >
                                                    @csrf
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 class="modal-title">Assessment Reset</h3>
                                        
                                                        <!--begin::Close-->
                                                        <div class="btn btn-icon  btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                                            <button type="button" class="border-0 bg-transparent" data-bs-dismiss="modal">
                                                                <iconify-icon icon="basil:cancel-outline" class="fa-1-5">
                                                                </iconify-icon>
                                                                <span class="sr-only">Close modal</span>
                                                            </button>
                                                        </div>
                                                        <!--end::Close-->
                                                    </div>
                                        
                                                    <div class="modal-body">
                  

                                                            <input type="hidden" value="{{ $employee->id }}" name="employee_id" hidden>


                                                     
                                                        <!-- Modal body -->
                                                        <div class="p-6 space-y-4">
                                                          

                                                              
                                                            <label class="required fs-6 fw-semibold mb-2">Assessments</label>
                                                            <select class="form-select form-select-solid" id="assessment" name="assessment_id" required>
                                                                <option value="">Select Assessment...</option>
                                                            
                                                                    <option value="1" >
                                                                        Personality & Motivation
                                                                    </option>

                                                                    <option value="2" >
                                                                        Work Interest
                                                                    </option>

                                                                    <option value="3" >
                                                                        Cognitive
                                                                    </option>
                                                            
                                                            </select>
                                                        </div>
                                                        <!-- Modal footer -->

                                                        
                                                    </div>
                                        
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-success" >Submit</button>
                                                    </div>
                                                </div>
                                            </form>    
                                            </div>
                                        </div>


                                    {{-- <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="addToBookmarkModal" tabindex="-1" aria-labelledby="addToBookmarkModalLabel" aria-hidden="true">
                                            <div class="modal-dialog relative w-auto pointer-events-none">
                                                <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding
                                                                rounded-md outline-none text-current">
                                                    <div class="relative bg-white rounded-lg shadow dark:bg-slate-700">
                                                        <!-- Modal header -->
                                                        <form action="{{ route('admin.employee.add_to_department')}}" method="POST" hidden id="addToBookmarkForm">
                                                            @csrf

                                                            <input type="hidden" value="{{ $employee->id }}" name="employee_id" hidden>


                                                        <div class="d-flex items-center justify-content-between p-5 border-b rounded-t dark:border-slate-600 bg-success-500">
                                                            <h3 class="text-base font-medium text-dark capitalize">
                                                               Assign HOD
                                                            </h3>
                                                            <button type="button" class="border-0 bg-transparent" data-bs-dismiss="modal">
                                                                <iconify-icon icon="basil:cancel-outline" class="fa-1-5">
                                                                </iconify-icon>
                                                                <span class="sr-only">Close modal</span>
                                                            </button>
                                                        </div>
                                                        <!-- Modal body -->
                                                        <div class="p-6 space-y-4">
                                                          

                                                              
                                                            <label class="required fs-6 fw-semibold mb-2">Department</label>
                                                            <select class="form-select form-select-solid" id="department" name="department_id" required>
                                                                <option value="">Select Department...</option>
                                                                @foreach($departments as $department)
                                                                    <option value="{{ $department->id }}" {{ !empty($user) && $user->department_id == $department->id ? 'selected' : '' }}>
                                                                        {{ $department->head_of_department }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <!-- Modal footer -->
                                                        <div class="flex float-end items-center justify-end p-6 space-x-2 border-t border-slate-200 rounded-b dark:border-slate-600">
                                                            <button type="submit" class="btn btn-success" >Submit</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>  --}}
                                    <!--begin::Menu-->
                                    {{-- <div class="me-0">
                                        <button class="btn  btn-icon btn-bg-light btn-active-color-primary"
                                            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            <i class="ki-solid ki-dots-horizontal fs-2x"></i>
                                        </button>

                                        <!--begin::Menu 3-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-3"
                                            data-kt-menu="true">
                                            <!--begin::Heading-->
                                            <div class="menu-item px-3">
                                                <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">
                                                    Payments
                                                </div>
                                            </div>
                                            <!--end::Heading-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3">
                                                    Create Invoice
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link flex-stack px-3">
                                                    Create Payment

                                                    <span class="ms-2" data-bs-toggle="tooltip"
                                                        title="Specify a target name for future usage and reference">
                                                        <i class="ki-duotone ki-information fs-6"><span
                                                                class="path1"></span><span class="path2"></span><span
                                                                class="path3"></span></i> </span>
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3">
                                                    Generate Bill
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3" data-kt-menu-trigger="hover"
                                                data-kt-menu-placement="right-end">
                                                <a href="#" class="menu-link px-3">
                                                    <span class="menu-title">Subscription</span>
                                                    <span class="menu-arrow"></span>
                                                </a>

                                                <!--begin::Menu sub-->
                                                <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3">
                                                            Plans
                                                        </a>
                                                    </div>
                                                    <!--end::Menu item-->

                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3">
                                                            Billing
                                                        </a>
                                                    </div>
                                                    <!--end::Menu item-->

                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3">
                                                            Statements
                                                        </a>
                                                    </div>
                                                    <!--end::Menu item-->

                                                    <!--begin::Menu separator-->
                                                    <div class="separator my-2"></div>
                                                    <!--end::Menu separator-->

                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <div class="menu-content px-3">
                                                            <!--begin::Switch-->
                                                            <label
                                                                class="form-check form-switch form-check-custom form-check-solid">
                                                                <!--begin::Input-->
                                                                <input class="form-check-input w-30px h-20px"
                                                                    type="checkbox" value="1" checked="checked"
                                                                    name="notifications" />
                                                                <!--end::Input-->

                                                                <!--end::Label-->
                                                                <span class="form-check-label text-muted fs-6">
                                                                    Recuring
                                                                </span>
                                                                <!--end::Label-->
                                                            </label>
                                                            <!--end::Switch-->
                                                        </div>
                                                    </div>
                                                    <!--end::Menu item-->
                                                </div>
                                                <!--end::Menu sub-->
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3 my-1">
                                                <a href="#" class="menu-link px-3">
                                                    Settings
                                                </a>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu 3-->
                                    </div> --}}
                                    <!--end::Menu-->
                                </div>
                                <!--end::Actions-->
                            </div>
                            <!--end::Title-->

                            <!--begin::Stats-->
                            <div class="d-flex flex-wrap flex-stack">
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-column flex-grow-1 pe-8">
                                    <!--begin::Stats-->
                                    <div class="d-flex flex-wrap">

                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Wrapper-->

                                <!--begin::Progress-->
                                {{-- <div class="d-flex align-items-center w-200px w-sm-300px flex-column mt-3">
                                    <div class="d-flex justify-content-between w-100 mt-auto mb-2">
                                        <span class="fw-semibold fs-6 text-gray-500">Profile
                                            Compleation</span>
                                        <span class="fw-bold fs-6">50%</span>
                                    </div>

                                    <div class="h-5px mx-3 w-100 bg-light mb-3">
                                        <div class="bg-success rounded h-5px" role="progressbar" style="width: 50%;"
                                            aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div> --}}
                                <!--end::Progress-->
                            </div>
                            <!--end::Stats-->
                        </div>
                        <!--end::Info-->
                    </div>
                    <!--end::Details-->

                    <!--begin::Navs-->
                    <ul class="nav nav-tabs nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">
                        <!--begin::Nav item-->
                        <li class="nav-item mt-2">
                            <a class="nav-link text-active-primary ms-0 me-10 py-5 active" data-bs-toggle="tab" href="#kt_tab_pane_1">
                                Overview </a>
                        </li>
                        <!--end::Nav item-->

                        <!--begin::Nav item-->
                        <li class="nav-item mt-2">
                            <a class="nav-link text-active-primary ms-0 me-10 py-5 " data-bs-toggle="tab" href="#kt_tab_pane_2">
                                Psychometric​ </a>
                        </li>
                        <!--end::Nav item-->
                        <li class="nav-item mt-2">
                            {{-- <a class="nav-link text-active-primary ms-0 me-10 py-5 " data-bs-toggle="tab" href="#kt_tab_pane_3">
                                Health Screening </a> --}}
                                <a class="nav-link text-active-primary ms-0 me-10 py-5 " data-bs-toggle="tab" href="">
                                    Health Screening </a>
                        </li>
                        <!--begin::Nav item-->
                        <li class="nav-item mt-2">
                            <a class="nav-link text-active-primary ms-0 me-10 py-5 " href="#">
                                Performance​ </a>
                        </li>
                        <!--end::Nav item-->
                        <!--begin::Nav item-->
                        <li class="nav-item mt-2">
                            <a class="nav-link text-active-primary ms-0 me-10 py-5 " href="#">
                                Skills Review​ </a>
                        </li>
                        <!--end::Nav item-->
                        <!--begin::Nav item-->
                        <li class="nav-item mt-2">
                            <a class="nav-link text-active-primary ms-0 me-10 py-5 " href="#">
                                Training </a>
                        </li>
                        <!--end::Nav item-->
                        <!--begin::Nav item-->
                        <li class="nav-item mt-2">
                            <a class="nav-link text-active-primary ms-0 me-10 py-5 " href="#">
                                Succession Plan​ </a>
                        </li>
                        <li class="nav-item mt-2">
                            <a class="nav-link text-active-primary ms-0 me-10 py-5 " data-bs-toggle="tab" href="#kt_tab_pane_operations">Operations</a>
                        </li>
                        <!--end::Nav item-->
                    </ul>
                    <!--begin::Navs-->
                </div>
            </div>
            <!--begin::Row-->
            <div class="tab-content" id="myTabContent">
            <div class="gy-5 g-xl-10 tab-pane fade show active" id="kt_tab_pane_1" role="tabpanel">
                <!--begin::Col-->
                <div class="row">
                <div class="col-xl-4 mb-5 mb-xl-10">

                    <!--begin::Engage widget 1-->
                    <div class="card card-flush h-md-100" dir="ltr">
                        <div class="card-header flex-nowrap pt-5">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-900">Basic Personal Information​</span>

                            </h3>
                            <!--end::Title-->


                        </div>
                        <!--begin::Body-->
                        <div class="card-body p-9">

                            <div class="row mb-7">
                                <!--begin::Label-->
                                <label class="col-lg-6 fw-semibold text-muted">Full Name</label>
                                <!--end::Label-->

                                <!--begin::Col-->
                                <div class="col-lg-6">
                                    <span class="fw-bold fs-6 text-gray-800"> {{ $employee->first_name ?? '' }} {{ $employee->middle_name ?? '' }}
                                        {{ $employee->last_name }}</span>
                                </div>
                                <!--end::Col-->
                            </div>

                            <div class="row mb-7">
                                <!--begin::Label-->
                                <label class="col-lg-6 fw-semibold text-muted">Gender</label>
                                <!--end::Label-->

                                <!--begin::Col-->
                                <div class="col-lg-6">
                                    <span class="fw-bold fs-6 text-gray-800">
                                        @if($employee->gender == 0) 
                                           Male
                                        @elseif ($employee->gender == 1)
                                           Female
                                        @else
                                            N / A
                                        @endif
                                    </span>
                                </div>
                                <!--end::Col-->
                            </div>

                            <div class="row mb-7">
                                <!--begin::Label-->
                                <label class="col-lg-6 fw-semibold text-muted">Date of Birth</label>
                                <!--end::Label-->

                                <!--begin::Col-->
                                <div class="col-lg-6">
                                    <span class="fw-bold fs-6 text-gray-800"> {{ $employee->birth_date ?? '' }}</span>
                                </div>
                                <!--end::Col-->
                            </div>

                            <div class="row mb-7">
                                <!--begin::Label-->
                                <label class="col-lg-6 fw-semibold text-muted">Civil Status</label>
                                <!--end::Label-->

                                <!--begin::Col-->
                                <div class="col-lg-6">
                                    <span class="fw-bold fs-6 text-gray-800">
                                        {{ config('constants.MARITAL_STATUSES.' . $employee->marital_status) }}</span>
                                </div>
                                <!--end::Col-->
                            </div>

                            <div class="row mb-7">
                                <!--begin::Label-->
                                <label class="col-lg-6 fw-semibold text-muted">Nationality</label>
                                <!--end::Label-->

                                <!--begin::Col-->
                                <div class="col-lg-6">
                                    <span class="fw-bold fs-6 text-gray-800"> {{ $employee->country->name ?? '' }}</span>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--begin::Row-->
                            <div class="row mb-1">
                                <!--begin::Label-->
                                <label class="col-lg-6 fw-semibold text-muted">House/Building Number and Street Name:
                                </label>
                                <!--end::Label-->

                                <!--begin::Col-->
                                <div class="col-lg-6">
                                    <span class="fw-bold fs-6 text-gray-800">{{ $employee->home_address ?? '' }}</span>
                                </div>
                                <!--end::Col-->
                            </div>

                            <div class="row mb-1">
                                <!--begin::Label-->
                                <label class="col-lg-6 fw-semibold text-muted">Barangay/Subdivision: </label>
                                <!--end::Label-->

                                <!--begin::Col-->
                                <div class="col-lg-6">
                                    <span class="fw-bold fs-6 text-gray-800">{{ $employee->barangay->name ?? '' }}</span>
                                </div>
                                <!--end::Col-->
                            </div>
                            <div class="row mb-1">
                                <!--begin::Label-->
                                <label class="col-lg-6 fw-semibold text-muted">City: </label>
                                <!--end::Label-->

                                <!--begin::Col-->
                                <div class="col-lg-6">
                                    <span class="fw-bold fs-6 text-gray-800">{{ $employee->cityName->name ?? '' }}</span>
                                </div>
                                <!--end::Col-->
                            </div>

                            <div class="row mb-1">
                                <!--begin::Label-->
                                <label class="col-lg-6 fw-semibold text-muted">Province: </label>
                                <!--end::Label-->

                                <!--begin::Col-->
                                <div class="col-lg-6">
                                    <span class="fw-bold fs-6 text-gray-800">{{ $employee->province->name ?? '' }}</span>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Row-->
                            <div class="row mb-1">
                                <!--begin::Label-->
                                <label class="col-lg-6 fw-semibold text-muted">Postal Code: </label>
                                <!--end::Label-->

                                <!--begin::Col-->
                                <div class="col-lg-6">
                                    <span class="fw-bold fs-6 text-gray-800">{{ $employee->postal_code ?? '' }}</span>
                                </div>
                                <!--end::Col-->
                            </div>

                            <div class=" pt-5">
                                <!--begin::Title-->
                                <h3 class="card-title align-items-start flex-column mb-5">
                                    <span class="card-label fw-bold text-gray-900">Contact Information​</span>

                                </h3>
                                <!--end::Title-->


                            </div>
                            <!--begin::Input group-->
                            <div class="row mb-7">
                                <!--begin::Label-->
                                <label class="col-lg-4 fw-semibold text-muted">Email Address (Official)</label>
                                <!--end::Label-->

                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <span class="fw-semibold text-gray-800 fs-6"> {{ $employee->email ?? '' }}</span>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <div class="row mb-7">
                                <!--begin::Label-->
                                <label class="col-lg-4 fw-semibold text-muted">Email Address (Personal)</label>
                                <!--end::Label-->

                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <a>
                                        <span class="fw-semibold text-gray-800 fs-6">
                                            {{ $employee->secondary_email ?? '' }}</span>
                                    </a>
                                </div>
                                <!--end::Col-->
                            </div>

                            <!--begin::Input group-->
                            <div class="row mb-7">
                                <!--begin::Label-->
                                <label class="col-lg-4 fw-semibold text-muted">
                                    Mobile Number
                                </label>
                                <!--end::Label-->

                                <!--begin::Col-->
                                <div class="col-lg-8 d-flex align-items-center">
                                    <span class="fw-bold fs-6 text-gray-800 me-2">
                                        {{ $employee->mobile_number ?? '' }}</span>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->

                            <div class=" pt-5">
                                <!--begin::Title-->
                                <h3 class="card-title align-items-start flex-column mb-5">
                                    <span class="card-label fw-bold text-gray-900">Government Identifications​​</span>

                                </h3>
                                <!--end::Title-->


                            </div>
                            <!--begin::Input group-->
                            <div class="row mb-7">
                                <!--begin::Label-->
                                <label class="col-lg-6 fw-semibold text-muted">Tax Identification Number (TIN)</label>
                                <!--end::Label-->

                                <!--begin::Col-->
                                <div class="col-lg-6">
                                    <a href="#" class="fw-semibold fs-6 text-gray-800 text-hover-primary">
                                        {{ $employee->tin_number ?? '' }}</a>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <div class="row mb-7">
                                <!--begin::Label-->
                                <label class="col-lg-6 fw-semibold text-muted">Social Security System (SSS) Number</label>
                                <!--end::Label-->

                                <!--begin::Col-->
                                <div class="col-lg-6">
                                    <a href="#" class="fw-semibold fs-6 text-gray-800 text-hover-primary">
                                        {{ $employee->sss_number ?? '' }}</a>
                                </div>
                                <!--end::Col-->
                            </div>
                            <div class="row mb-7">
                                <!--begin::Label-->
                                <label class="col-lg-6 fw-semibold text-muted">Pag-IBIG Fund (HDMF) Number</label>
                                <!--end::Label-->

                                <!--begin::Col-->
                                <div class="col-lg-6">
                                    <a href="#" class="fw-semibold fs-6 text-gray-800 text-hover-primary">
                                        {{ $employee->hdmf_number ?? '' }}</a>
                                </div>
                                <!--end::Col-->
                            </div>

                            <div class="row mb-7">
                                <!--begin::Label-->
                                <label class="col-lg-6 fw-semibold text-muted">PhilHealth Number</label>
                                <!--end::Label-->

                                <!--begin::Col-->
                                <div class="col-lg-6">
                                    <a href="#" class="fw-semibold fs-6 text-gray-800 text-hover-primary">
                                        {{ $employee->phil_number ?? '' }}</a>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Notice-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Engage widget 1-->

                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xl-8 mb-xl-10">
                    <!--begin::Chart widget 5-->
                    <div class="card card-flush h-lg-100">
                        <!--begin::Header-->
                        <div class="card-header flex-nowrap pt-5">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-900">Educational Background​
                                </span>

                            </h3>
                            <!--end::Title-->


                        </div>
                        <!--end::Header-->

                        <!--begin::Body-->
                        <div class="card-body p-6">
                            <div class="row mb-7 col-lg-12 justify-content-between" style="margin-left: 3px;">
                                <!--begin::Label-->
                                <div class="col-lg-6 row">
                                    <label class="col-lg-6 fw-semibold text-muted">Highest Educational Attainment</label>
                                    <!--end::Label-->

                                    <!--begin::Col-->
                                    <div class="col-lg-6">
                                        <span class="fw-bold fs-6 text-gray-800">
                                            {{ $employee->education_level_check->name ?? '' }}</span>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <div class="col-lg-6 row">
                                    <label class="col-lg-6 fw-semibold text-muted">Name of School/University​</label>
                                    <!--end::Label-->

                                    <!--begin::Col-->
                                    <div class="col-lg-6">
                                        <span class="fw-bold fs-6 text-gray-800">
                                            {{ $employee->higher_learning->name ?? '' }}</span>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <div class="col-lg-6 row">
                                    <label class="col-lg-6 fw-semibold text-muted">Course/Program​</label>
                                    <!--end::Label-->

                                    <!--begin::Col-->
                                    <div class="col-lg-6">
                                        <span class="fw-bold fs-6 text-gray-800">
                                            {{ $employee->program->name ?? '' }}</span>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <div class="col-lg-6 row">
                                    <label class="col-lg-6 fw-semibold text-muted">Year of Graduated</label>
                                    <!--end::Label-->

                                    <!--begin::Col-->
                                    <div class="col-lg-6">
                                        <span class="fw-bold fs-6 text-gray-800">
                                            {{ $employee->graduate_year ?? '' }}</span>
                                    </div>
                                    <!--end::Col-->
                                </div>
                            </div>

                            <!--begin::Tables Widget 3-->
                            <div class="card  mb-xl-8">
                                <!--begin::Header-->
                                <div class="card-header border-0 pt-5">
                                    <h3 class="card-title align-items-start flex-column">
                                        <span class="card-label fw-bold fs-3 mb-1">Work Experience​</span>
                                    </h3>

                                </div>
                                <!--end::Header-->

                                <!--begin::Body-->
                                <div class="card-body py-3">
                                    <!--begin::Table container-->
                                    <div class="table-responsive">
                                        <!--begin::Table-->
                                        <table class="table table-row-gray-300 align-middle gs-0 gy-4">
                                            <!--begin::Table head-->
                                            <thead>
                                                <tr>
                                                    <th class="py-5 p-0 w-xxl-95px fw-bold">Previous Employers</th>
                                                    <th class="py-5 p-0 w-xxl-95px fw-bold">Job Titles</th>
                                                    <th class="py-5 p-0 w-xxl-95px fw-bold">Start Date</th>
                                                    <th class="py-5 p-0 w-xxl-95px fw-bold">End Date</th>
                                                    <th class="py-5 p-0 text-center  fw-bold">Duration of Employment</th>
                                                    <th class="py-5 p-0 fw-bold">Key Responsibilties</th>


                                                </tr>
                                            </thead>
                                            <!--end::Table head-->

                                            <!--begin::Table body-->
                                            <tbody>
                                                @foreach ($employee->employments as $employment)
                                                    <tr>
                                                        <td class="fw-bold p-0 text-muted">
                                                            {{ $employment->company_name ?? '' }} </td>
                                                        <td class="fw-bold p-0 text-muted">
                                                            {{ $employment->job_title ?? '' }}
                                                        </td>
                                                        <td class="fw-bold p-0 text-muted">
                                                            {{ $employment->start_date ?? '' }}</td>
                                                        <td class="fw-bold p-0 text-muted">
                                                            @if ($employment->end_date == '0000-00-00')
                                                                Currently Working Here
                                                            @else
                                                                {{ $employment->end_date ?? '' }}
                                                            @endif
                                                        </td>
                                                        <td class="fw-bold p-0 text-muted text-center">
                                                            {{ $employment->year_of_work ?? '' }} Years</td>
                                                        <td class="fw-bold p-0 text-muted">
                                                            {{ $employment->key_responsiblity ?? '' }}</td>


                                                    </tr>
                                                @endforeach

                                            </tbody>
                                            <!--end::Table body-->
                                        </table>
                                        <!--end::Table-->
                                    </div>
                                    <!--end::Table container-->
                                </div>
                                <!--begin::Body-->
                            </div>
                            <!--end::Tables Widget 3-->

                            <div class="card  mb-xl-8 overflow-hidden">
                                <!--begin::Header-->
                                <div class="card-header border-0 pt-5">
                                    <h3 class="card-title align-items-start flex-column">
                                        <span class="card-label fw-bold fs-3 mb-1">Skills and Certification​</span>
                                    </h3>

                                </div>
                                <!--end::Header-->

                                <!--begin::Body-->
                                <div class="card-body py-3">
                                    <!--begin::Table container-->
                                    <div class="mb-2 p-2">
                                        <h5 class="">Relevant Skills</h5>
                                       
                                        {{-- @if($employee->skills)
                                            @foreach (json_decode($employee->skills, true) as $skill)
                                                <div class="badge badge-success">{{ $skill['value'] }}</div>
                                            @endforeach
                                        @endif --}}
                                        @if(!empty($employee->skills) && is_string($employee->skills))
                                            @php
                                                $skills = json_decode($employee->skills, true);
                                            @endphp

                                            @if(is_array($skills))
                                                @foreach ($skills as $skill)
                                                    <div class="badge badge-success">{{ $skill['value'] }}</div>
                                                @endforeach
                                            @endif
                                        @endif

                                    </div>

                                    <div class="mb-2 p-2">
                                        <h5 class="">Professional Certifications </h5>
                                        @if($employee->professional_certificate)
                                            @php
                                                $certificates = json_decode($employee->professional_certificate, true);
                                            @endphp
                                            @if(is_array($certificates) && count($certificates) > 0)
                                                @foreach ($certificates as $skill)
                                                    <div class="badge badge-success">{{ $skill['value'] }}</div>
                                                @endforeach
                                            @else
                                                <p>No certifications available.</p>
                                            @endif
                                        @else
                                            <p>No certifications available.</p>
                                        @endisset
                                    </div>


                                    <div class="mb-2 p-2">
                                        <h5 class="">Traning Program </h5>
                                        {{-- @if($employee->training_program)

                                            @foreach (json_decode($employee->training_program, true) as $skill)
                                                <div class="badge badge-success">{{ $skill['value'] }}</div>
                                            @endforeach
                                        @endif --}}
                                        @if(!empty($employee->training_program) && is_string($employee->training_program))
                                            @php
                                                $skills = json_decode($employee->training_program, true);
                                            @endphp

                                            @if(is_array($skills))
                                                @foreach ($skills as $skill)
                                                    <div class="badge badge-success">{{ $skill['value'] }}</div>
                                                @endforeach
                                            @endif
                                        @endif
                                    </div>
                                    <!--end::Table container-->
                                </div>
                                <!--begin::Body-->
                            </div>

                            <div class="card  mb-xl-8">
                                <!--begin::Header-->
                                <div class="card-header border-0 pt-5">
                                    <h3 class="card-title align-items-start flex-column">
                                        <span class="card-label fw-bold fs-3 mb-1">Emergency Contact Information​</span>
                                    </h3>

                                </div>
                                <!--end::Header-->

                                <!--begin::Body-->
                                <div class="card-body py-3">
                                    <!--begin::Table container-->
                                    <div class="table-responsive">
                                        <!--begin::Table-->
                                        <table class="table table-row-gray-300 align-middle gs-0 gy-4">
                                            <!--begin::Table head-->
                                            <thead>
                                                <tr>
                                                    <th class="py-5 p-0 w-xxl-95px fw-bold">Name of Person</th>
                                                    <th class="py-5 p-0 w-xxl-95px fw-bold">Relationship</th>
                                                    <th class="py-5 p-0 w-xxl-95px fw-bold">Contact Number</th>
                                                    <th class="py-5 p-0 w-xxl-95px fw-bold text-center">Address</th>



                                                </tr>
                                            </thead>
                                            <!--end::Table head-->

                                            <!--begin::Table body-->
                                            <tbody>


                                                <tr>
                                                    <td class="fw-bold p-0 text-muted">
                                                        {{ $employee->ec_contact_person_name ?? '' }} </td>
                                                    <td class="fw-bold p-0 text-muted">
                                                        {{ config('constants.RELATION_EMPLOYEE.' . $employee->ec_relation_employee) }}
                                                    </td>
                                                    <td class="fw-bold p-0 text-muted">
                                                        {{ $employee->ec_contact_person_number ?? '' }}</td>

                                                    <td class="fw-bold p-0 text-muted text-center">
                                                       {{-- Address:{{ $employee->ec_home_address ? : '' }} <br>
                                                        Sub Division/Barangay:{{ $employee->ecBarangay->name ?? ''}} <br>
                                                        City:{{ $employee->ecCityName->name ?? ''}} <br>
                                                        Province:{{ $employee->ecProvince->name  ?? ''}}<br>
                                                        Postal Code:{{ $employee->ec_postal_code ?? ''}} </td> --}}
                                                        {{ $employee->ec_home_address ?  'Address:'.$employee->ec_home_address : '' }} <br>
                                                        {{ $employee->ecBarangay ?  'Sub Division/Barangay:'.$employee->ecBarangay->name : '' }} <br>
                                                        {{ $employee->ecCityName ?  'City:'.$employee->ecCityName->name : '' }} <br>
                                                        {{ $employee->ecProvince ?  'Province:'.$employee->ecProvince->name : '' }} <br>
                                                        {{ $employee->ec_postal_code ?  ' Postal Code:'.$employee->ec_postal_code : '' }} <br>





                                                </tr>


                                            </tbody>
                                            <!--end::Table body-->
                                        </table>
                                        <!--end::Table-->
                                    </div>
                                    <!--end::Table container-->
                                </div>
                                <!--begin::Body-->
                            </div>

                            <div class="row  ">
                                <div class="col-lg-6 card card-body">
                                    <h6>Consent for data processing and sharing as per the Data Privacy Act​</h6>
                                </div>
                                <div class="col-lg-6 card card-body"> <h6>Acknowledgement of company policies and procedures</h6></div>
                                <div> <p class="fw-bold mt-2 text-danger">Both to be digitally signed by employees when signing up @ Talent Module</p></div>
                            </div>

                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Chart widget 5-->


                </div>
                <!--end::Col-->
            </div>


            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="card h-full tab-pane fade" id="kt_tab_pane_2" role="tabpanel">
                <header class="card-header align-items-center">
                    <h4 class="card-title">Summary of Assessment Results</h4>
                    <div class="d-flex" style="align-items: center;">

                        <div class="ml-3 mx-4">
                            <button type="button" class="btn btn-warning btn-sm"  data-bs-toggle="modal" data-bs-target="#assessment_reset"> Reset Assessment</button>
                        </div>


                        <div class="ml-3 mx-4">
                            <span class="bg_primary_blue custom_legends mx-2">
                                S
                            </span>

                            Self
                        </div>
                        {{-- <div class="ml-3 population_hide hidden_population    mx-4">
                            <span class="bg_primary_navy custom_legends mx-2">
                                P
                            </span>

                            Population
                        </div>
                        <div class="checkbox-area">
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="hidden" name="checkbox" id="population"
                                    value="population">
                                <span
                                    class="h-4 w-4 border flex-none border-slate-100 dark:border-slate-800 rounded inline-flex ltr:mr-3 rtl:ml-3 relative transition-all duration-150 bg-slate-100 dark:bg-slate-900">
                                    <img src="{{ asset('admin/assets/images/icon/ck-white.svg') }}" alt=""
                                        class="h-[10px] w-[10px] block m-auto opacity-0"></span>
                                <span class="text-slate-500 dark:text-slate-400 text-sm leading-6">Population</span>
                            </label>
                        </div> --}}
                    </div>

                </header>
                <div class="card-body p-6">
                    <div class="row">

                        <div class="col-lg-6 mt-5">
                            <div class="card h-full shadow-base2">
                                <header class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                                    <h4 class="card-title">Personality & Motivation</h4>
                                    <span style="float: right;"> 
                                        {{-- Response Consistency Index: {{ $rciResult['rci']['level_description'] ?? 'Consistent' }} --}}
                                        Response Consistency Index: 
                                        @if (($employee->is_personality_motivation_completed == 1) && ($isUserResultExists))
                                           {{ config('helpers.rci_levels')[$rciResult['rci']['level'] ?? 0] ?? '' }}
                                        @else
                                           Data Not Available
                                        @endif
                                    </span>
                                </header>
                                
                                <div class="card-body p-6">
                                    @if (($employee->is_personality_motivation_completed == 1) && ($isUserResultExists))

                                    @php
                                    $allFacetsDescriptionsFromDB = \App\Models\OceanAllFacetsCombination::all();

                                    $allFacetsDescriptions = [];
                                    foreach($allFacetsDescriptionsFromDB as $allFacet) {
                                        $allFacetsDescriptions[$allFacet->facet][$allFacet->ea][$allFacet->eb] = $allFacet->description;
                                    }

                                    function convertScoreToLevel($score) {
                                        $level = 'Moderate';
                                        if($score > 3.75) {
                                            $level = 'High';
                                        } elseif ($score <= 1.25) {
                                            $level = 'Low';
                                        } else {
                                            $level = 'Moderate';
                                        }
                                        return $level;
                                    }

                                    $allFacetsFromDB = \App\Models\MasterAllOceanFacet::all();
                                    $allHighFacets = [];
                                    $allLowFacets = [];

                                    foreach($allFacetsFromDB as $allFac) {
                                        $allHighFacets[$allFac->facet] = $allFac->facet_description;
                                        $allLowFacets[$allFac->facet_low] = $allFac->facet_low_description;
                                    }

                                    function lowerAndReplaceSpace($inputString) {
                                        // Lowercase the letters
                                        $inputString = strtolower($inputString);
                                        // Replace spaces with underscores
                                        $inputString = str_replace(" ", "", $inputString);
                                        return $inputString;
                                    }
                                  
                                    function renderFinalFacetHtml($facet_low, $facet_field_name, $facet, $oceanAllFacetsSingleResult, $oceanAllFacetsOverallResult, $allHighFacets, $allLowFacets, $allFacetsDescriptions, $oceanAllFacetsResult, $slug) {
                                        
                                        // Extracting the property values from objects
                                        $facet_value_a = isset($oceanAllFacetsSingleResult[$facet_field_name]['score']) ? $oceanAllFacetsSingleResult[$facet_field_name]['score'] : 0;
                                        $facet_value_b = isset($oceanAllFacetsEmployeeBResult[$facet_field_name]) ? $oceanAllFacetsEmployeeBResult[$facet_field_name] : 0;
                                        $facet_value_o = isset($oceanAllFacetsOverallResult[$facet_field_name]) ? $oceanAllFacetsOverallResult[$facet_field_name] : 0;
                                        $analyzedDescription = $allFacetsDescriptions[$facet][convertScoreToLevel($facet_value_a)][convertScoreToLevel($facet_value_b)] ?? '';
                                        $percentage = isset($oceanAllFacetsSingleResult[$facet_field_name]['percentage']) ? (int) $oceanAllFacetsSingleResult[$facet_field_name]['percentage'] : 0;

                                        // Use direct PHP concatenation for dynamic content
                                        $facetLowId = lowerAndReplaceSpace($facet_low);
                                        $facetId = lowerAndReplaceSpace($facet);

                                        // Calculate left position for emp_a
                                        $leftPositionA = $facet_value_a / 0.05;
                                        $styleA = $leftPositionA == 100 ? 'style="left: 93%;"' : 'style="left: ' . $leftPositionA . '%;"';

                                        // Calculate left position for emp_b
                                        $leftPositionB = $facet_value_b / 0.05;
                                        $styleB = $leftPositionB == 100 ? 'style="left: 93%;"' : 'style="left: ' . $leftPositionB . '%;"';
                                        $description = $oceanAllFacetsResult[$slug]['description'] ?? '';
                                        $html = '<div class="slider-container">' .
                                            '<div class="slider-label cursor-pointer mt-5" data-bs-toggle="collapse" data-bs-target="#' . $facetLowId . '">' . htmlspecialchars($facet_low) . '<span><iconify-icon icon="iconamoon:arrow-down-2-light"></iconify-icon></span></div>' .
                                            '<div class="slider-track mb-0" style="margin-bottom: 0px;">' .
                                                '<div class="emp_a" ' . $styleA . ' data-bs-toggle="collapse" data-bs-target="#' . $slug . 'Description"></div>' .
                                                '<div class="emp_b population_hide hidden_population" style="left: ' . (($facet_value_o / 5) * 100) . '%;">P</div>' .
                                            '</div>' .
                                            '<div class="slider-label cursor-pointer mt-5" data-bs-toggle="collapse" data-bs-target="#' . $facetId . '">' . htmlspecialchars($facet) . '<span><iconify-icon icon="iconamoon:arrow-down-2-light"></iconify-icon></span></div> ' .
                                        '<div class="btn btn-primary me-2">'. $percentage . '</div></div>' .

                                        '<div class="accordion-item pl-8">' .
                                            '<div id="' . $facetLowId . '" class="accordion-collapse collapse  color-black p-1.5 shadow-deep collapse  br-9 mt-2" aria-labelledby="panelsStayOpen-headingOne">' .
                                                '<div class="accordion-body font13 description_accordian_left">' .
                                                    htmlspecialchars($allLowFacets[$facet_low]) .
                                                '</div>' .
                                            '</div>' .
                                        '</div>' .

                                        '<div class="accordion-item pl-8" >' .
                                            '<div id="' . $facetId . '"  class="accordion-collapse collapse  color-black p-1.5 shadow-deep collapse  br-9 mt-2"  aria-labelledby="panelsStayOpen-headingOne">' .
                                                '<div class="accordion-body font13 text-slate-600 description_accordian_right">' .
                                                    htmlspecialchars($allHighFacets[$facet]) .
                                                '</div>' .
                                            '</div>' .
                                        '</div>'.

                                        '<div class="accordion-item pl-8" >' .
                                            '<div id="' . $slug . 'Description"  class="accordion-collapse collapse  color-black p-1.5 shadow-deep collapse  br-9 mt-2"  aria-labelledby="panelsStayOpen-headingOne">' .
                                                '<div class="accordion-body font13 text-slate-600 description_accordian_right">' .
                                                    htmlspecialchars($description) .
                                                '</div>' .
                                            '</div>' .
                                        '</div>';

                                        return $html;
                                    }
                                @endphp

                                        {{-- <div id="chart"></div> --}}

                                        <div class="">
                                            <div class="row" style="justify-content: end;">
                                                <div class="col-lg-12">
                                                    <button class="btn btn-primary" style="float: right;">Percentile (th)</button>
                                                </div>
                                            </div>
                                            <div class="slider-container" >
                                                <div class="slider-label cursor-pointer"
                                                   data-bs-toggle="collapse" data-bs-target="#pragmatismAccordion">
                                                   Pragmatism <span><iconify-icon icon="iconamoon:arrow-down-2-light"></iconify-icon></span>
                                                </div>
                                                <div class="slider-track">
                                                    <div class="emp_a cursor-pointer" data-bs-toggle="modal"
                                                        data-bs-target="#openness_facets_modal"
                                                        @if (isset($oceanDomainResult['openness-to-experience']) && (($oceanDomainResult['openness-to-experience']['score'] / 0.05) == 100)) style="left: 93%;" @else style="left: {{ ($oceanDomainResult['openness-to-experience']['score'] / 0.05) ?? 0 }}%;" @endif>
                                                    </div>
                                                    {{-- <div class="emp_b population_hide hidden_population"
                                                        @if (isset($oceanOverallResult['Openness to Experience']) &&
                                                                ($oceanOverallResult['Openness to Experience'] / 5) * 100 == 100) style="left: 93%;" @else style="left: {{ ($oceanOverallResult['Openness to Experience'] / 5) * 100 ?? 0 }}%;" @endif>
                                                        P
                                                    </div> --}}
                                                </div>
                                                <div class="slider-label cursor-pointer"
                                                   data-bs-toggle="collapse" data-bs-target="#opennessAccordion">
                                                  Openness <span><iconify-icon icon="iconamoon:arrow-down-2-light"></iconify-icon></span>
                                                </div>
                                                <div class="btn btn-primary me-2">{{(int) $oceanDomainResult['openness-to-experience']['percentage'] ?? 0 }}</div>
                                                
                                            </div>
                                            <div class="accordion-item pl-8">
                                                <div id="pragmatismAccordion" class="accordion-collapse collapse color-black p-1.5 shadow-deep br-9 mt-2" aria-labelledby="panelsStayOpen-headingOne">
                                                    <div class="accordion-body font13 description_accordian">
                                                        {{ $oceanDomainDescriptors->where('slug', 'pragmatism')->first()->analysis ?? ' ' }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item pl-8">
                                                <div id="opennessAccordion" class="accordion-collapse collapse color-black p-1.5 shadow-deep br-9 mt-2" aria-labelledby="panelsStayOpen-headingOne">
                                                    <div class="accordion-body font13 description_accordian">
                                                        {{ $oceanDomainDescriptors->where('slug', 'openness-to-experience')->first()->analysis ?? ' ' }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="slider-container">
                                                <div class="slider-label cursor-pointer"
                                                   data-bs-toggle="collapse" data-bs-target="#lowSelfControlAccordion">Low Self Control
                                                   <span><iconify-icon icon="iconamoon:arrow-down-2-light"></iconify-icon></span>
                                                </div>
                                                <div class="slider-track">
                                                    <div class="emp_a cursor-pointer" data-bs-toggle="modal"
                                                        data-bs-target="#conscientiousness_facets_modal"
                                                        @if (isset($oceanDomainResult['conscientiousness']) && (($oceanDomainResult['conscientiousness']['score'] / 0.05) == 100)) style="left: 93%;" @else style="left: {{ $oceanDomainResult['conscientiousness']['score'] / 0.05 ?? 0 }}%;" @endif>
                                                    </div>
                                                    {{-- <div class="emp_b population_hide hidden_population"
                                                        @if (isset($oceanOverallResult['Conscientiousness']) && ($oceanOverallResult['Conscientiousness'] / 5) * 100 == 100) style="left: 93%;" @else style="left: {{ ($oceanOverallResult['Conscientiousness'] / 5) * 100 ?? 0 }}%;" @endif>
                                                        P
                                                    </div> --}}
                                                </div>
                                                <div class="slider-label cursor-pointer"
                                                data-bs-toggle="collapse" data-bs-target="#highSelfControlAccordion">
                                                High Self Control <span><iconify-icon icon="iconamoon:arrow-down-2-light"></iconify-icon></span>
                                                </div>
                                                <div class="btn btn-primary me-2">{{ (int) $oceanDomainResult['conscientiousness']['percentage'] ?? 0 }}</div>
                                            </div>
                                            <div class="accordion-item pl-8">
                                                <div id="lowSelfControlAccordion" class="accordion-collapse collapse color-black p-1.5 shadow-deep br-9 mt-2" aria-labelledby="panelsStayOpen-headingOne">
                                                    <div class="accordion-body font13 description_accordian">
                                                        {{ $oceanDomainDescriptors->where('slug', 'low-self-control')->first()->analysis ?? ' ' }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item pl-8">
                                                <div id="highSelfControlAccordion" class="accordion-collapse collapse color-black p-1.5 shadow-deep br-9 mt-2" aria-labelledby="panelsStayOpen-headingOne">
                                                    <div class="accordion-body font13 description_accordian">
                                                        {{ $oceanDomainDescriptors->where('slug', 'high-self-control')->first()->analysis ?? ' ' }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="slider-container" >
                                                <div class="slider-label cursor-pointer"
                                                     data-bs-toggle="collapse" data-bs-target="#introversionAccordion">Introversion
                                                    <span><iconify-icon icon="iconamoon:arrow-down-2-light"></iconify-icon></span>
                                                </div>
                                                <div class="slider-track">
                                                    <div class="emp_a cursor-pointer" data-bs-toggle="modal"
                                                        data-bs-target="#extraversion_facets_modal"
                                                        @if (isset($oceanDomainResult['extraversion']) && (($oceanDomainResult['extraversion']['score']/0.05) == 100)) style="left: 93%;" @else style="left: {{ ($oceanDomainResult['extraversion']['score'] / 0.05) ?? 0 }}%;" @endif>
                                                    </div>
                                                    {{-- <div class="emp_b population_hide hidden_population"
                                                        @if (isset($oceanOverallResult['Extraversion']) && ($oceanOverallResult['Extraversion'] / 5) * 100 == 100) style="left: 93%;" @else style="left: {{ ($oceanOverallResult['Extraversion'] / 5) * 100 ?? 0 }}%;" @endif>
                                                        P
                                                    </div> --}}
                                                </div>
                                                <div class="slider-label cursor-pointer"
                                                    data-bs-toggle="collapse" data-bs-target="#extraversionAccordion">Extraversion
                                                    <span><iconify-icon icon="iconamoon:arrow-down-2-light"></iconify-icon></span>
                                                </div>
                                                <div class="btn btn-primary me-2">{{(int) $oceanDomainResult['extraversion']['percentage'] ?? 0 }}</div>
                                            </div>
                                            <div class="accordion-item pl-8">
                                                <div id="introversionAccordion" class="accordion-collapse collapse color-black p-1.5 shadow-deep br-9 mt-2" aria-labelledby="panelsStayOpen-headingOne">
                                                    <div class="accordion-body font13 description_accordian">
                                                        {{ $oceanDomainDescriptors->where('slug', 'introversion')->first()->analysis ?? ' ' }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item pl-8">
                                                <div id="extraversionAccordion" class="accordion-collapse collapse color-black p-1.5 shadow-deep br-9 mt-2" aria-labelledby="panelsStayOpen-headingOne">
                                                    <div class="accordion-body font13 description_accordian">
                                                        {{ $oceanDomainDescriptors->where('slug', 'extraversion')->first()->analysis ?? ' ' }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="slider-container" >
                                                <div class="slider-label cursor-pointer"
                                                data-bs-toggle="collapse" data-bs-target="#independenceAccordion">Independence
                                                    <span><iconify-icon icon="iconamoon:arrow-down-2-light"></iconify-icon></span>
                                                </div>
                                                <div class="slider-track">
                                                    <div class="emp_a cursor-pointer" data-bs-toggle="modal"
                                                data-bs-target="#agreeableness_facets_modal"
                                                        @if (isset($oceanDomainResult['agreeableness']) && (($oceanDomainResult['agreeableness']['score'] / 0.05)== 100)) style="left: 93%;" @else style="left: {{ $oceanDomainResult['agreeableness']['score'] / 0.05 ?? 0 }}%;" @endif>
                                                    </div>
                                                    {{-- <div class="emp_b population_hide hidden_population"
                                                        @if (isset($oceanOverallResult['Agreeableness']) && ($oceanOverallResult['Agreeableness'] / 5) * 100 == 100) style="left: 93%;" @else style="left: {{ ($oceanOverallResult['Agreeableness'] / 5) * 100 ?? 0 }}%;" @endif>
                                                        P
                                                    </div> --}}
                                                </div>
                                                <div class="slider-label cursor-pointer"
                                                data-bs-toggle="collapse" data-bs-target="#agreeablenessAccordion">Agreeableness
                                                    <span><iconify-icon icon="iconamoon:arrow-down-2-light"></iconify-icon></span>
                                                </div>
                                                <div class="btn btn-primary me-2">{{ (int) $oceanDomainResult['agreeableness']['percentage'] ?? 0 }}</div>
                                            </div>
                                            <div class="accordion-item pl-8">
                                                <div id="independenceAccordion" class="accordion-collapse collapse color-black p-1.5 shadow-deep br-9 mt-2" aria-labelledby="panelsStayOpen-headingOne">
                                                    <div class="accordion-body font13 description_accordian">
                                                        {{ $oceanDomainDescriptors->where('slug', 'independence')->first()->analysis ?? ' ' }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item pl-8">
                                                <div id="agreeablenessAccordion" class="accordion-collapse collapse color-black p-1.5 shadow-deep br-9 mt-2" aria-labelledby="panelsStayOpen-headingOne">
                                                    <div class="accordion-body font13 description_accordian">
                                                        {{ $oceanDomainDescriptors->where('slug', 'agreeableness')->first()->analysis ?? ' ' }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="slider-container" >
                                                <div class="slider-label cursor-pointer"
                                                data-bs-toggle="collapse" data-bs-target="#highAnxietyAccordion">High Anxiety
                                                    <span><iconify-icon icon="iconamoon:arrow-down-2-light"></iconify-icon></span>
                                                </div>
                                                <div class="slider-track">
                                                    <div class="emp_a cursor-pointer" data-bs-toggle="modal"
                                                data-bs-target="#emotional_stability_facets_modal"
                                                        @if (isset($oceanDomainResult['emotional-stability']) && (($oceanDomainResult['emotional-stability']['score'] / 0.05) == 100)) style="left: 93%;" @else style="left: {{ $oceanDomainResult['emotional-stability']['score'] / 0.05 ?? 0 }}%;" @endif>
                                                    </div>
                                                    {{-- <div class="emp_b population_hide hidden_population"
                                                        @if (isset($oceanOverallResult['Emotional Stability']) && ($oceanOverallResult['Emotional Stability'] / 5) * 100 == 100) style="left: 93%;" @else style="left: {{ ($oceanOverallResult['Emotional Stability'] / 5) * 100 ?? 0 }}%;" @endif>
                                                        P
                                                    </div> --}}
                                                </div>
                                                <div class="slider-label cursor-pointer"
                                                     data-bs-toggle="collapse" data-bs-target="#lowAnxietyAccordion">Low Anxiety
                                                    <span><iconify-icon icon="iconamoon:arrow-down-2-light"></iconify-icon></span>
                                                </div>
                                                <div class="btn btn-primary me-2">{{ (int) $oceanDomainResult['emotional-stability']['percentage'] ?? 0 }}</div>
                                            </div>
                                            <div class="accordion-item pl-8">
                                                <div id="highAnxietyAccordion" class="accordion-collapse collapse color-black p-1.5 shadow-deep br-9 mt-2" aria-labelledby="panelsStayOpen-headingOne">
                                                    <div class="accordion-body font13 description_accordian">
                                                        {{ $oceanDomainDescriptors->where('slug', 'high-anxiety')->first()->analysis ?? ' ' }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item pl-8">
                                                <div id="lowAnxietyAccordion" class="accordion-collapse collapse color-black p-1.5 shadow-deep br-9 mt-2" aria-labelledby="panelsStayOpen-headingOne">
                                                    <div class="accordion-body font13 description_accordian">
                                                        {{ $oceanDomainDescriptors->where('slug', 'low-anxiety')->first()->analysis ?? ' ' }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="container text-center bg_secondary_green p-5"
                                            style="border-radius: 16px;">
                                            <iconify-icon icon="wpf:statistics" class="text-[2.23rem]">
                                            </iconify-icon>
                                            <h4>Data Not Available </h4>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="card h-full shadow-base2 mt-5">
                                <header class="card-header">
                                    <h4 class="card-title">Critical Core Skills</h4>

                                </header>
                                <div class="card-body p-6">
                                    {{-- {{ dd($workCompetencyResult) }} --}}
                                    @if (($employee->is_personality_motivation_completed == 1) && ($isUserResultExists))
                                        <div class="">
                                            <div class="row" style="justify-content: end;">
                                                <div class="col-lg-12">
                                                    <button class="btn btn-primary" style="float: right;">Percentile (th)</button>
                                                </div>
                                            </div>
                                            @foreach ($ccsResult as $ccs => $result) 
                                                <div class="slider-container">
                                                    <div class="slider-label cursor-pointer"
                                                       data-bs-toggle="collapse" data-bs-target="#{{$result['slug']}}Accordion">
                                                       {{ $result['name'] ?? '' }} <span><iconify-icon icon="iconamoon:arrow-down-2-light"></iconify-icon></span>
                                                    </div>
                                                    <div class="slider-track">
                                                        <div class="emp_a" data-bs-toggle="collapse" data-bs-target="#{{$result['slug']}}UserAccordion"
                                                            @if (isset($result) && ($result['score']) == 100) style="left: 93%;" @else style="left: {{ $result['score'] ?? 0 }}%;" @endif>
                                                        </div>
                                                        {{-- <div class="emp_b population_hide hidden_population"
                                                            style="left: {{ $workCompetencyOverallResult['Critical Thinking'] ?? 0 }}%;">
                                                            P</div> --}}
                                                    
                                                    </div>
                                                    <div class="btn btn-primary me-2">{{ (int) $result['percentage'] ?? 0 }}</div>
                                                    {{-- <div class="slider-label">Openness</div> --}}
                                                </div>
                                                <div class="accordion-item pl-8">
                                                    <div id="{{$result['slug']}}Accordion" class="accordion-collapse collapse color-black p-1.5 shadow-deep br-9 mt-2" aria-labelledby="panelsStayOpen-headingOne">
                                                        <div class="accordion-body font13 description_accordian">
                                                            {{ $ccsDomainDescriptors->where('slug', $result['slug'])->first()->analysis ?? ' ' }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="accordion-item pl-8">
                                                    <div id="{{$result['slug']}}UserAccordion" class="accordion-collapse collapse color-black p-1.5 shadow-deep br-9 mt-2" aria-labelledby="panelsStayOpen-headingOne">
                                                        <div class="accordion-body font13 description_accordian">
                                                            {{ $result['description'] ?? ' ' }}
                                                        </div>
                                                    </div>
                                                </div>

                                            @endforeach
                                        </div>
                                    @else
                                        <div class="container text-center bg_secondary_green p-5"
                                            style="
                                                        border-radius: 16px;">
                                            <iconify-icon icon="wpf:statistics" class="text-[2.23rem]">
                                            </iconify-icon>
                                            <h4>Data Not Available </h4>
                                        </div>
                                    @endif


                                </div>
                            </div>
                            {{-- Learning & Development Plan --}}

                            <div class="card h-full shadow-base2 mt-5">
                                <header class="card-header">
                                    <h4 class="card-title">Learning & Development Plan</h4>

                                </header>
                                
                                <div class="card-body p-6">
                                    {{-- {{ dd($workCompetencyResult) }} --}}
                                    @if (($employee->is_personality_motivation_completed == 1) && ($isUserResultExists))
                                        <div class="">
                                            <h6 class="mt-5">Learning Style</h6>

                                            <div class="slider-container">
                                                <div class="slider-label accordion-button cursor-pointer"
                                                    data-bs-toggle="collapse" data-bs-target="#visualAccordion">
                                                    Visual & Kinesthetic <span>
                                                        <iconify-icon icon="iconamoon:arrow-down-2-light">
                                                        </iconify-icon>
                                                    </span></div>
                                                <div class="slider-track">
                                                    <div class="emp_a"
                                                        @if (isset($learningStyle['visual_kinesthetic_score']) && (($learningStyle['visual_kinesthetic_score'])/0.05) == 100) style="left: 93%;" @else style="left: {{ ($learningStyle['visual_kinesthetic_score'])/0.05 ?? 0 }}%;" @endif>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item pl-8">

                                                <div id="visualAccordion" class="accordion-collapse collapse  color-black"
                                                    aria-labelledby="panelsStayOpen-headingOne">
                                                    <div class="accordion-body font13 text-slate-600">
                                                        <b>Description: </b> <br>
                                                           {{-- Learners with a preference for the combined Visual and Kinesthetic style grasp concepts more effectively through direct interaction with learning materials. They thrive on engaging physically with tasks and benefit from the use of visual aids.  --}}
                                                           {{ $learningAndDevelopmentPlanDescriptors->where('slug', 'visual-kinesthetic')->first()->analysis ?? ' ' }}
                                                        <br>
                                                        <b>Examples:</b> <br>
                                                        <ul>
                                                            <li>Engaging with interactive simulations and physical models.</li>
                                                            <li>Using diagrams, flowcharts, and illustrative videos to understand complex concepts.</li>
                                                            <li>Participating in workshops where they can physically manipulate relevant materials.</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="slider-container">
                                                <div class="slider-label accordion-button cursor-pointer"
                                                    data-bs-toggle="collapse" data-bs-target="#auralAccordion">Aural
                                                    <span>
                                                        <iconify-icon icon="iconamoon:arrow-down-2-light">
                                                        </iconify-icon>
                                                    </span>
                                                </div>
                                                <div class="slider-track">
                                                    <div class="emp_a"
                                                        @if (isset($learningStyle['aural_score']) && (($learningStyle['aural_score'])/0.05) == 100) style="left: 93%;" @else style="left: {{ ($learningStyle['aural_score'])/0.05 ?? 0 }}%;" @endif>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item pl-8">

                                                <div id="auralAccordion" class="accordion-collapse collapse  color-black"
                                                    aria-labelledby="panelsStayOpen-headingOne">
                                                    <div class="accordion-body font13 text-slate-600">
                                                        <b>Description: </b> <br>
                                                        {{-- Aural learners absorb information best when it is presented verbally. They excel in environments where listening and discussion are encouraged and are adept at remembering spoken instructions. --}}
                                                        {{ $learningAndDevelopmentPlanDescriptors->where('slug', 'aural')->first()->analysis ?? ' ' }}
                                                        <br>
                                                        <b>Examples:</b> <br>
                                                        <ul>
                                                            <li>Benefiting from lectures, group discussions, and verbal briefings.</li>
                                                            <li>Using podcasts and audio recordings for learning new content.</li>
                                                            <li>Participating in study groups or team meetings where ideas are discussed aloud.</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="slider-container">
                                                <div class="slider-label accordion-button cursor-pointer"
                                                    data-bs-toggle="collapse" data-bs-target="#readingWritingAccordion">
                                                    Reading & Writing
                                                    <span>
                                                        <iconify-icon icon="iconamoon:arrow-down-2-light">
                                                        </iconify-icon>
                                                    </span>
                                                </div>
                                                <div class="slider-track">
                                                    <div class="emp_a"
                                                        @if (isset($learningStyle['reading_writing_score']) && (($learningStyle['reading_writing_score'])/0.05) == 100) style="left: 93%;" @else style="left: {{ ($learningStyle['reading_writing_score'])/0.05 ?? 0 }}%;" @endif>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item pl-8">

                                                <div id="readingWritingAccordion"
                                                    class="accordion-collapse collapse  color-black"
                                                    aria-labelledby="panelsStayOpen-headingOne">
                                                    <div class="accordion-body font13 text-slate-600">
                                                      <b>Description: </b> <br>
                                                        {{-- Read / Write learners prefer to interact with information through written words. They excel in traditional study methods involving reading and taking detailed notes. --}}
                                                        {{ $learningAndDevelopmentPlanDescriptors->where('slug', 'reading-writing')->first()->analysis ?? ' ' }}
                                                      <br>
                                                      <b>Examples:</b> <br>
                                                      <ul>
                                                          <li>Using textbooks, articles, and written handouts as primary study materials.</li>
                                                          <li>Making comprehensive lists, writing out notes, and summarizing information</li>
                                                          <li>Preferring email and text-based communication for clarity and record-keeping.</li>
                                                      </ul>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="accordion accordion-icon-collapse" id="learning_style_preference_summary_accordion">
                                                <!--begin::Item-->
                                                <div class="mb-5">
                                                    <!--begin::Header-->
                                                    <div class="accordion-header py-3 d-flex" data-bs-toggle="collapse"
                                                        data-bs-target="#learning_style_preference_summary">
                                                        <span class="accordion-icon">
                                                            <iconify-icon icon="ph:plus-fill"
                                                                class="accordion-icon-off fa-1-5"></iconify-icon>
                                                            <iconify-icon icon="ph:minus-fill"
                                                                class="accordion-icon-on fa-1-5"></iconify-icon>
                                                        </span>
                                                        <h3 class="fs-4 fw-semibold mb-0 ms-4">
                                                            Learning Style Summary</h3>
                                                    </div>
                                                    <!--end::Header-->

                                                    <!--begin::Body-->
                                                    <div id="learning_style_preference_summary" class="fs-6 collapse show ps-10"
                                                        data-bs-parent="#learning_style_preference_summary">
                                                        @foreach($learningStyle['learning_style_preference'] as $key => $learning_style_preference)
                                                           {{ $learning_style_preference['learning_style_preference_summary'] ?? '' }} <br>                        
                                                        @endforeach
                                                    </div>
                                                    <!--end::Body-->
                                                </div>
                                                <!--end::Item-->

                                                <!--begin::Item-->

                                                <!--end::Item-->
                                            </div>

                                            {{-- <div class="accordion accordion-icon-collapse" id="training_recommendations_accordion">
                                                <!--begin::Item-->
                                                <div class="mb-5">
                                                    <!--begin::Header-->
                                                    <div class="accordion-header py-3 d-flex" data-bs-toggle="collapse"
                                                        data-bs-target="#training_recommendations">
                                                        <span class="accordion-icon">
                                                            <iconify-icon icon="ph:plus-fill"
                                                                class="accordion-icon-off fa-1-5"></iconify-icon>
                                                            <iconify-icon icon="ph:minus-fill"
                                                                class="accordion-icon-on fa-1-5"></iconify-icon>
                                                        </span>
                                                        <h3 class="fs-4 fw-semibold mb-0 ms-4">
                                                            Training Recommendations and Enhanced Development Insights</h3>
                                                    </div>
                                                    <!--end::Header-->

                                                    <!--begin::Body-->
                                                    <div id="training_recommendations" class="fs-6 collapse show ps-10"
                                                        data-bs-parent="#learning_style_preference_summary">
                                                        <b> <u>Training Recommendations:</u> </b> <br>
                                                        <ul>
                                                            @foreach(explode(';', $learningStyle['training_recommendations']) as $item)
                                                                <li>{{ $item ?? ' ' }}</li>
                                                            @endforeach
                                                        </ul>

                                                        <b> <u>Enhanced Development Insights:</u> </b> <br>
                                                        <ul>
                                                            <li> <b>Role Suitability: </b> {{$learningStyle['enhanced_development_insights_role_suitability'] ?? ''}} </li>
                                                            <li> <b>Action Steps: </b> {{$learningStyle['enhanced_development_insights_action_steps'] ?? ''}} </li>
                                                        </ul>
                                                    </div>
                                                    <!--end::Body-->
                                                </div>
                                                <!--end::Item-->

                                                <!--begin::Item-->

                                                <!--end::Item-->
                                            </div>

                                            <div class="accordion accordion-icon-collapse" id="summary_for_report_accordion">
                                                <!--begin::Item-->
                                                <div class="mb-5">
                                                    <!--begin::Header-->
                                                    <div class="accordion-header py-3 d-flex" data-bs-toggle="collapse"
                                                        data-bs-target="#summary_for_report">
                                                        <span class="accordion-icon">
                                                            <iconify-icon icon="ph:plus-fill"
                                                                class="accordion-icon-off fa-1-5"></iconify-icon>
                                                            <iconify-icon icon="ph:minus-fill"
                                                                class="accordion-icon-on fa-1-5"></iconify-icon>
                                                        </span>
                                                        <h3 class="fs-4 fw-semibold mb-0 ms-4">
                                                            Summary for Report</h3>
                                                    </div>
                                                    <!--end::Header-->

                                                    <!--begin::Body-->
                                                    <div id="summary_for_report" class="fs-6 collapse show ps-10"
                                                        data-bs-parent="#learning_style_preference_summary">
                                                        This section of the report aims to harness the individual's learning style to maximize their job performance and satisfaction. By aligning their natural learning preferences with specific training interventions and workplace practices, the organization can enhance both individual and team productivity. The recommendations provided are designed to be directly applicable, ensuring the individual's professional development is continuously supported and aligned with organizational goals.
                                                    </div>
                                                    <!--end::Body-->
                                                </div>
                                                <!--end::Item-->

                                                <!--begin::Item-->

                                                <!--end::Item-->
                                            </div> --}}
                                        </div>
                                    @else
                                        <div class="container text-center bg_secondary_green p-5"
                                            style="
                                                      border-radius: 16px;">
                                            <iconify-icon icon="wpf:statistics" class="text-[2.23rem]">
                                            </iconify-icon>
                                            <h4>Data Not Available </h4>
                                        </div>
                                    @endif


                                </div>
                            </div>
               

                        </div>

                        {{-- right  --}}
                        <div class="col-lg-6 mt-5">
                            <div class="card h-full shadow-base2">
                                <header class="card-header">
                                    <h4 class="card-title">Work Interest</h4>
                                </header>
                                <div class="card-body p-6">
                                    @if (($employee->is_work_interest_completed == 1) && ($isUserResultExists))
                                        {{-- <div id="riasec" class="align-items-center col-lg-3 d-flex justify-content-center">
                                    </div> --}}
                                        @foreach($riasecDomainResult as $riasec => $result)
                                            <div class="slider-container @if (in_array($result['code'], $riasecTop3Result['array'])) raisec_container @endif my-1">
                                                    <div class="slider-label cursor-pointer"
                                                       data-bs-toggle="collapse" data-bs-target="#{{$result['slug']}}Accordion">
                                                       {{ $result['name'] ?? '' }} <span><iconify-icon icon="iconamoon:arrow-down-2-light"></iconify-icon></span>
                                                    </div>
                                                    <div class="slider-track">
                                                                @if($result['code'] == 'R')
                                                                    <div class="d-flex justify-content-between"
                                                                                style="top: -23px;position: relative;margin-right: 11px;">
                                                                                <div class="slider-legend"
                                                                                    style="background: #ff4639f7; border-radius: 28px;padding: 0px;color: white;">
                                                                                    Low
                                                                                </div>
                                                                                <div class="slider-legend"
                                                                                    style="background: #279d27;border-radius: 28px; color: white;">
                                                                                    High
                                                                                </div>
                                                                    </div>
                                                                @endif
                                                                <div class="emp_a" data-bs-toggle="collapse" data-bs-target="#{{$result['slug']}}UserAccordion"
                                                                    @if (isset($result['percentage']) && $result['percentage'] == 100) style="left: 93%;" @else style="left: {{ $result['percentage'] ?? 0 }}%;" @endif>
                                                                </div>
                                                                {{-- <div class="emp_b population_hide hidden_population"
                                                                    style="left: {{ $workInterestOverallResult['Investigative'] ?? 0 }}%;">
                                                                P
                                                            </div> --}}

                                                    </div>
                                                    {{-- <div class="slider-label">Openness</div> --}}
                                            </div>
                                            <div class="accordion-item pl-8">
                                                <div id="{{$result['slug']}}Accordion" class="accordion-collapse collapse color-black p-1.5 shadow-deep br-9 mt-2" aria-labelledby="panelsStayOpen-headingOne">
                                                    <div class="accordion-body font13 description_accordian">
                                                        {{ $riasecDomainDescriptors->where('slug', $result['slug'])->first()->analysis ?? ' ' }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item pl-8">
                                                <div id="{{$result['slug']}}UserAccordion" class="accordion-collapse collapse color-black p-1.5 shadow-deep br-9 mt-2" aria-labelledby="panelsStayOpen-headingOne">
                                                    <div class="accordion-body font13 description_accordian">
                                                        {{ $result['description'] ?? ' ' }}
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                        <div class="accordion" id="accordionPanelsStayOpenExample">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                                    <button
                                                        class="accordion-button nav-link block font-medium font-Inter text-sm leading-tight capitalize rounded-md  py-3 focus:outline-none focus:ring-0 color-black active"
                                                        type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                                                        aria-controls="panelsStayOpen-collapseOne">
                                                        Top 3 RIASEC -
                                                        {{ $riasecTop3Result['string'] ?? '' }}
                                                    </button>
                                                </h2>
                                                <div id="panelsStayOpen-collapseOne"
                                                    class="accordion-collapse collapse show color-black"
                                                    aria-labelledby="panelsStayOpen-headingOne">
                                                    <div class="accordion-body">
                                                        {{ $riasecTop3Result['description'] ?? '' }}
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                    @else
                                        <div class="container text-center bg_secondary_green p-5"
                                            style="
                                                                border-radius: 16px;">
                                            <iconify-icon icon="wpf:statistics" class="text-[2.23rem]">
                                            </iconify-icon>
                                            <h4>Data Not Available </h4>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="card h-full shadow-base2 mt-5">
                                @php
                                    $level_number = $cognitiveOverallResult['cognitive']['level'] ?? '1';
                                    $level = 'Level: '. config('helpers.cognitive_ability_levels')[$level_number];
                                @endphp

                                <header class="card-header">
                                    <h4 class="card-title">Cognitive Ability</h4>
                                </header>

                                <div class="card-body p-6">
                                    @if (($employee->is_cognitive_ability_completed == 1) && ($isUserResultExists))
                                        <div id="donut" class="align-items-center d-flex justify-content-center"
                                            style="min-height: 267.3px;display: flex;align-items: center;justify-content: center;">
                                        </div>
                                        <div class="col-lg-5"
                                            style="align-items: center;display: flex;flex-direction: column;margin: auto;">
                                            <h1 class="pricing-card-title text-3xl">
                                                {{-- {{ ($totalCorrectForCognitive / 50)*100 }}%
                                            <small class="text-body-secondary fw-light"> Correct
                                                ({{$totalCorrectForCognitive}} / 50)
                                            </small> --}}
                                                {{ $level ?? '1' }}
                                            </h1>

                                        </div>
                                        <div class="mt-5">
                                            <div class="slider-container">
                                                <div class="slider-label">Quantitative Knowledge</div>
                                                <div class="slider-track">
                                                    <div class="d-flex justify-content-between"
                                                        style="top: -28px; position: relative;">
                                                        <div class="slider-legend_cognitive"
                                                            style="
                                                                        background: #ff4639f7;

                                                                    ">
                                                            L0</div>
                                                        <div class="slider-legend_cognitive"
                                                            style="
                                                                        background: #f3e95ff7;

                                                                    ">
                                                            L1</div>
                                                        <div class="slider-legend_cognitive"
                                                            style="
                                                                    background: #d3c611;

                                                                ">
                                                            L2</div>
                                                        <div class="slider-legend_cognitive"
                                                            style="
                                                                        background: #279d27;

                                                                    ">
                                                            L3</div>
                                                    </div>
                                                    <div class="emp_a"
                                                    @if(isset($cognitiveDomainResult) && isset($cognitiveDomainResult['quantitative-knowledge']) && isset($cognitiveDomainResult['quantitative-knowledge']['level']) && 
                                                        ($cognitiveDomainResult['quantitative-knowledge']['level'] / 3 == 1)) 
                                                        style="left: 93%;" 
                                                    @else 
                                                        style="left: {{ isset($cognitiveDomainResult['quantitative-knowledge']['level']) ? ($cognitiveDomainResult['quantitative-knowledge']['level'] / 3) * 100 : 0 }}%;" 
                                                    @endif>
                                                    </div>


                                                </div>
                                                {{-- <div class="slider-label">Openness</div> --}}
                                            </div>
                                            <div class="slider-container">
                                                <div class="slider-label">Comprehensive Knowledge</div>
                                                <div class="slider-track">
                                                    <div class="d-flex justify-content-between"
                                                        style="top: -28px; position: relative;">
                                                    </div>
                                                    <div class="emp_a"
                                                        @if(isset($cognitiveDomainResult) && isset($cognitiveDomainResult['comprehension-knowledge']) && isset($cognitiveDomainResult['comprehension-knowledge']['level']) && 
                                                            ($cognitiveDomainResult['comprehension-knowledge']['level'] / 3 == 1)) 
                                                            style="left: 93%;" 
                                                        @else 
                                                            style="left: {{ isset($cognitiveDomainResult['comprehension-knowledge']['level']) ? ($cognitiveDomainResult['comprehension-knowledge']['level'] / 3) * 100 : 0 }}%;" 
                                                        @endif
                                                            >
                                                    </div>
                                                </div>
                                                {{-- <div class="slider-label">Openness</div> --}}
                                            </div>
                                            <div class="slider-container">
                                                <div class="slider-label">Visual Reasoning</div>
                                                <div class="slider-track">
                                                    <div class="d-flex justify-content-between"
                                                        style="top: -28px; position: relative;">
                                                    </div>
                                                    <div class="emp_a"
                                                        @if(isset($cognitiveDomainResult) && isset($cognitiveDomainResult['visual-reasoning']) && isset($cognitiveDomainResult['visual-reasoning']['level']) && 
                                                            ($cognitiveDomainResult['visual-reasoning']['level'] / 3 == 1)) 
                                                            style="left: 93%;" 
                                                        @else 
                                                            style="left: {{ isset($cognitiveDomainResult['visual-reasoning']['level']) ? ($cognitiveDomainResult['visual-reasoning']['level'] / 3) * 100 : 0 }}%;" 
                                                        @endif    
                                                    >
                                                    </div>
                                                </div>
                                                {{-- <div class="slider-label">Openness</div> --}}
                                            </div>
                                            <div class="slider-container">
                                                <div class="slider-label">Fluid Reasoning</div>
                                                <div class="slider-track">
                                                    <div class="d-flex justify-content-between"
                                                        style="top: -28px; position: relative;">
                                                    </div>
                                                    <div class="emp_a" 
                                                        @if(isset($cognitiveDomainResult) && isset($cognitiveDomainResult['fluid-reasoning']) && isset($cognitiveDomainResult['fluid-reasoning']['level']) && 
                                                            ($cognitiveDomainResult['fluid-reasoning']['level'] / 3 == 1)) 
                                                            style="left: 93%;" 
                                                        @else 
                                                            style="left: {{ isset($cognitiveDomainResult['fluid-reasoning']['level']) ? ($cognitiveDomainResult['fluid-reasoning']['level'] / 3) * 100 : 0 }}%;" 
                                                        @endif 
                                                        >
                                                    </div>
                                                </div>
                                                {{-- <div class="slider-label">Openness</div> --}}
                                            </div>
                                        </div>
                                    @else
                                        <div class="container text-center bg_secondary_green p-5"
                                            style="
                                                        border-radius: 16px;">
                                            <iconify-icon icon="wpf:statistics" class="text-[2.23rem]">
                                            </iconify-icon>
                                            <h4>Data Not Available </h4>
                                        </div>
                                    @endif

                                </div>
                            </div>
                            @if (($employee->is_personality_motivation_completed == 1) && ($isUserResultExists))
                                <div class="card h-full shadow-base2 mt-5">
                                    <header class="card-header">

                                        <h4 class="card-title">Personality Type
                                            ({{ $employee && $employee->personality_type ? ucwords(strtolower($employee->personality_type->personality_name)):'' }})
                                        </h4>

                                    </header>
                                    <div class="card-body p-6">
                                        @if ($employee->is_personality_motivation_completed == 1 && $employee->personality_type)
                                            <!--begin::Accordion-->
                                            <!--begin::Accordion-->
                                            <div class="accordion accordion-icon-collapse" id="kt_accordion_3">
                                                <!--begin::Item-->
                                                <div class="mb-5">
                                                    <!--begin::Header-->
                                                    <div class="accordion-header py-3 d-flex" data-bs-toggle="collapse"
                                                        data-bs-target="#kt_accordion_3_item_1">
                                                        <span class="accordion-icon">
                                                            {{-- <i class="ki-duotone ki-plus-square fs-3 accordion-icon-off"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                                        <i class="ki-duotone ki-minus-square fs-3 accordion-icon-on"><span class="path1"></span><span class="path2"></span></i> --}}
                                                            <iconify-icon icon="ph:plus-fill"
                                                                class="accordion-icon-off fa-1-5"></iconify-icon>
                                                            <iconify-icon icon="ph:minus-fill"
                                                                class="accordion-icon-on fa-1-5"></iconify-icon>
                                                        </span>
                                                        <h3 class="fs-4 fw-semibold mb-0 ms-4">
                                                            {{ $employee->personality_type->type_name }}</h3>
                                                    </div>
                                                    <!--end::Header-->

                                                    <!--begin::Body-->
                                                    <div id="kt_accordion_3_item_1" class="fs-6 collapse show ps-10"
                                                        data-bs-parent="#kt_accordion_3">
                                                        {{ $employee->personality_type->descriptions }}
                                                    </div>
                                                    <!--end::Body-->
                                                </div>
                                                <!--end::Item-->

                                                <!--begin::Item-->

                                                <!--end::Item-->
                                            </div>
                                            <!--end::Accordion-->
                                            <!--end::Accordion-->

                                            <div class="accordion accordion-icon-collapse"
                                                id="kt_accordion_3_communicationDescriptor">
                                                <!--begin::Item-->
                                                <div class="mb-5">
                                                    <!--begin::Header-->
                                                    <div class="accordion-header py-3 d-flex" data-bs-toggle="collapse"
                                                        data-bs-target="#kt_accordion_3_item_1_communicationDescriptor">
                                                        <span class="accordion-icon">
                                                            {{-- <i class="ki-duotone ki-plus-square fs-3 accordion-icon-off"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                                    <i class="ki-duotone ki-minus-square fs-3 accordion-icon-on"><span class="path1"></span><span class="path2"></span></i> --}}
                                                            <iconify-icon icon="ph:plus-fill"
                                                                class="accordion-icon-off fa-1-5"></iconify-icon>
                                                            <iconify-icon icon="ph:minus-fill"
                                                                class="accordion-icon-on fa-1-5"></iconify-icon>
                                                        </span>
                                                        <h3 class="fs-4 fw-semibold mb-0 ms-4">Strengths</h3>
                                                    </div>
                                                    <!--end::Header-->

                                                    <!--begin::Body-->
                                                    <div id="kt_accordion_3_item_1_communicationDescriptor"
                                                        class="fs-6 collapse show ps-10"
                                                        data-bs-parent="#kt_accordion_3_communicationDescriptor">
                                                        {{ $employee->personality_type->strengths_description }}
                                                    </div>
                                                    <!--end::Body-->
                                                </div>
                                                <!--end::Item-->

                                                <!--begin::Item-->
                                                <div class="accordion accordion-icon-collapse"
                                                    id="kt_accordion_3_communicationDescriptor_2">
                                                    <!--begin::Item-->
                                                    <div class="mb-5">
                                                        <!--begin::Header-->
                                                        <div class="accordion-header py-3 d-flex"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#kt_accordion_3_item_1_communicationDescriptor_2">
                                                            <span class="accordion-icon">
                                                                {{-- <i class="ki-duotone ki-plus-square fs-3 accordion-icon-off"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                                    <i class="ki-duotone ki-minus-square fs-3 accordion-icon-on"><span class="path1"></span><span class="path2"></span></i> --}}
                                                                <iconify-icon icon="ph:plus-fill"
                                                                    class="accordion-icon-off fa-1-5"></iconify-icon>
                                                                <iconify-icon icon="ph:minus-fill"
                                                                    class="accordion-icon-on fa-1-5"></iconify-icon>
                                                            </span>
                                                            <h3 class="fs-4 fw-semibold mb-0 ms-4">Weaknesses</h3>
                                                        </div>
                                                        <!--end::Header-->

                                                        <!--begin::Body-->
                                                        <div id="kt_accordion_3_item_1_communicationDescriptor_2"
                                                            class="fs-6 collapse show ps-10"
                                                            data-bs-parent="#kt_accordion_3_communicationDescriptor_2">
                                                            {{ $employee->personality_type->weaknesses_description }}
                                                        </div>
                                                        <!--end::Body-->
                                                    </div>
                                                    <!--end::Item-->

                                                    <!--begin::Item-->

                                                    <!--end::Item-->
                                                </div>
                                                <!--end::Item-->
                                            </div>
                                        @else
                                            <div class="container text-center bg_secondary_green p-5"
                                                style="
                                                        border-radius: 16px;">
                                                <iconify-icon icon="wpf:statistics" class="text-[2.23rem]">
                                                </iconify-icon>
                                                <h4>Data Not Available </h4>
                                            </div>
                                        @endif


                                    </div>
                                </div>
                                <div class="card h-full shadow-base2 mt-5">
                                    <header class="card-header">
                                        <h4 class="card-title">Flight Risk</h4>

                                    </header>
                                    <div class="card-body p-6">
                                        {{-- {{ dd($workCompetencyResult) }} --}}
                                        @if (($employee->is_personality_motivation_completed == 1) && ($isUserResultExists))
                                            <!--begin::Accordion-->
                                            <!--begin::Accordion-->
                                            <div class="accordion accordion-icon-collapse" id="kt_accordion_2">
                                                <!--begin::Item-->
                                                <div class="mb-5">
                                                    <!--begin::Header-->
                                                    <div class="accordion-header py-3 d-flex" data-bs-toggle="collapse"
                                                        data-bs-target="#kt_accordion_3_item_3">
                                                        <span class="accordion-icon">
                                                            {{-- <i class="ki-duotone ki-plus-square fs-3 accordion-icon-off"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                                        <i class="ki-duotone ki-minus-square fs-3 accordion-icon-on"><span class="path1"></span><span class="path2"></span></i> --}}
                                                            <iconify-icon icon="ph:plus-fill"
                                                                class="accordion-icon-off fa-1-5"></iconify-icon>
                                                            <iconify-icon icon="ph:minus-fill"
                                                                class="accordion-icon-on fa-1-5"></iconify-icon>
                                                        </span>
                                                        <h3 class="fs-4 fw-semibold mb-0 ms-4">
                                                            {{ isset($flightRiskResult['flight-risk']['level_description']) ? ucfirst($flightRiskResult['flight-risk']['level_description']) : 'Moderate' }}
                                                        </h3>
                                                    </div>
                                                    <!--end::Header-->

                                                    <!--begin::Body-->
                                                    <div id="kt_accordion_3_item_3" class="fs-6 collapse show ps-10"
                                                        data-bs-parent="#kt_accordion_2">
                                                        {{-- @if (isset($flightRiskResult['flight-risk']['level_description']) && $flightRiskResult['flight-risk']['level_description'] == 'high')
                                                            Employees identified with a high flight risk exhibit signs of
                                                            decreased engagement, such as reduced productivity, lack of
                                                            involvement in team activities, or open exploration of new job
                                                            opportunities.
                                                        @elseif (isset($employee->flight_risk_level) && $employee->flight_risk_level == 'low')
                                                            Employees at a low flight risk level display strong engagement
                                                            and satisfaction with their roles, actively participate in
                                                            organizational activities, and express a commitment to long-term
                                                            career development within the company.
                                                        @else
                                                            Those with a moderate flight risk might express occasional
                                                            dissatisfaction or ambivalence about their career progression,
                                                            job role, or the organizational culture.
                                                        @endif --}}
                                                        {{ $flightRiskResult['flight-risk']['description'] ?? '' }}
                                                    </div>
                                                    <!--end::Body-->
                                                </div>
                                                <!--end::Item-->

                                                <!--begin::Item-->

                                                <!--end::Item-->
                                            </div>
                                            <!--end::Accordion-->
                                            <!--end::Accordion-->
                                        @else
                                            <div class="container text-center bg_secondary_green p-5"
                                                style="
                                                        border-radius: 16px;">
                                                <iconify-icon icon="wpf:statistics" class="text-[2.23rem]">
                                                </iconify-icon>
                                                <h4>Data Not Available </h4>
                                            </div>
                                        @endif


                                    </div>
                                </div>

                                <div class="card h-full shadow-base2 mt-5">
                                    <header class="card-header">
    
                                        <h4 class="card-title">Workplace Alignment Forecast</h4>
    
                                    </header>
                                    <div class="card-body p-6">
                                        {{-- {{ dd($workCompetencyResult) }} --}}
                                        @if (($employee->is_personality_motivation_completed == 1) && ($isUserResultExists))
                                            @php
                                                $organizational_fit_forecast_result = $organizationalFitForecastResult['organizational-fit-forecast']['level_description'] ?? '';
                                            @endphp
                                            <!--begin::Accordion-->
                                            <div class="accordion accordion-icon-collapse" id="kt_accordion_4">
                                                <!--begin::Item-->
                                                <div class="mb-5">
                                                    <!--begin::Header-->
                                                    <div class="accordion-header py-3 d-flex" data-bs-toggle="collapse"
                                                        data-bs-target="#kt_accordion_3_item_4">
                                                        <span class="accordion-icon">
                                                            {{-- <i class="ki-duotone ki-plus-square fs-3 accordion-icon-off"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                                        <i class="ki-duotone ki-minus-square fs-3 accordion-icon-on"><span class="path1"></span><span class="path2"></span></i> --}}
                                                            <iconify-icon icon="ph:plus-fill"
                                                                class="accordion-icon-off fa-1-5"></iconify-icon>
                                                            <iconify-icon icon="ph:minus-fill"
                                                                class="accordion-icon-on fa-1-5"></iconify-icon>
                                                        </span>
                                                        <h3 class="fs-4 fw-semibold mb-0 ms-4">
                                                            {{ ucfirst($organizational_fit_forecast_result) ?? 'Moderate Risk' }}
                                                        </h3>
                                                    </div>
                                                    <!--end::Header-->
    
                                                    <!--begin::Body-->
                                                    <div id="kt_accordion_3_item_4" class="fs-6 collapse show ps-10"
                                                        data-bs-parent="#kt_accordion_4">
                                                        {{-- @if (isset($organizational_fit_forecast_result) && $organizational_fit_forecast_result == 'high risk')
                                                            Employees at a high risk level may exhibit behaviors that can lead
                                                            to discord within teams and affect the overall workplace atmosphere
                                                            negatively.
                                                        @elseif(isset($organizational_fit_forecast_result) && $organizational_fit_forecast_result == 'low risk')
                                                            Employees at a low risk level typically exhibit behaviors that
                                                            support and strengthen team unity and align well with the company's
                                                            cultural values.
                                                        @else
                                                            Employees with a moderate risk level might occasionally display
                                                            behaviors that could impact team dynamics, yet these issues are
                                                            generally manageable with proactive strategies.
                                                        @endif --}}
                                                        {{ $organizationalFitForecastResult['organizational-fit-forecast']['description'] ?? '' }}
                                                    </div>
                                                    <!--end::Body-->
                                                </div>
                                                <!--end::Item-->
    
                                                <!--begin::Item-->
    
                                                <!--end::Item-->
                                            </div>
                                            <!--end::Accordion-->
                                            <!--end::Accordion-->
                                        @else
                                            <div class="container text-center bg_secondary_green p-5"
                                                style="
                                                        border-radius: 16px;">
                                                <iconify-icon icon="wpf:statistics" class="text-[2.23rem]">
                                                </iconify-icon>
                                                <h4>Data Not Available </h4>
                                            </div>
                                        @endif
    
    
                                    </div>
                                </div>

                                <div class="card h-full shadow-base2 mt-5">
                                    <header class="card-header">
                                        <h4 class="card-title">Growth Potential</h4>

                                    </header>

                                    <div class="card-body p-6">
                                        {{-- {{ dd($workCompetencyResult) }} --}}
                                        @if (($employee->is_personality_motivation_completed == 1) && ($isUserResultExists))
                                            @php
                                                $growth_potential_result = $growthPotentialResult['growth-potential']['level_description'] ?? '';
                                            @endphp
                                            <!--begin::Accordion-->
                                            <div class="accordion accordion-icon-collapse" id="kt_accordion_4">
                                                <!--begin::Item-->
                                                <div class="mb-5">
                                                    <!--begin::Header-->
                                                    <div class="accordion-header py-3 d-flex" data-bs-toggle="collapse"
                                                        data-bs-target="#kt_accordion_3_item_4">
                                                        <span class="accordion-icon">
                                                            {{-- <i class="ki-duotone ki-plus-square fs-3 accordion-icon-off"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                                        <i class="ki-duotone ki-minus-square fs-3 accordion-icon-on"><span class="path1"></span><span class="path2"></span></i> --}}
                                                            <iconify-icon icon="ph:plus-fill"
                                                                class="accordion-icon-off fa-1-5"></iconify-icon>
                                                            <iconify-icon icon="ph:minus-fill"
                                                                class="accordion-icon-on fa-1-5"></iconify-icon>
                                                        </span>
                                                        <h3 class="fs-4 fw-semibold mb-0 ms-4">
                                                            {{ ucfirst($growth_potential_result) ?? 'Moderate' }}</h3>
                                                    </div>
                                                    <!--end::Header-->
                                                    
                                                    <!--begin::Body-->
                                                    <div id="kt_accordion_3_item_4" class="fs-6 collapse show ps-10"
                                                        data-bs-parent="#kt_accordion_4">
                                                        {{-- @if (isset($growth_potential_result) && strtolower($growth_potential_result) == 'very high')
                                                           Very High-potential employees are visionaries who not only excel in their current roles but also drive innovation and strategic transformation within the organization. They are natural leaders with exceptional foresight, capable of inspiring and mobilizing teams towards ambitious goals. These individuals thrive in challenging environments and are prime candidates for top executive positions, as they consistently deliver extraordinary results and exhibit a profound impact on the company's long-term success.
                                                        @elseif (isset($growth_potential_result) && strtolower($growth_potential_result) == 'high')
                                                           High-potential employees demonstrate remarkable performance and possess the ability to take on significant responsibilities swiftly. They exhibit strong leadership qualities, strategic thinking, and an exceptional capacity for growth and learning. These employees are ideal for advanced development programs, often transitioning into critical leadership roles and contributing to major organizational initiatives. Their proactive approach and high-level problem-solving skills make them indispensable assets in driving company progress.
                                                        @elseif(isset($growth_potential_result) && strtolower($growth_potential_result) == 'moderate')
                                                           Moderate-potential employees excel in adaptability, learning, and leadership. They respond well to accelerated development opportunities, such as cross-functional projects and leadership training, often being candidates for succession planning and strategic organizational roles. Their enthusiasm for personal and professional growth, combined with their ability to inspire peers, positions them as key contributors to the organization's future success.
                                                        @else
                                                           Employees at this level are dependable and consistent in their current roles. They benefit from focused skill enhancement and may evolve into broader roles over time with dedicated training and mentorship. They are foundational to maintaining the status quo and operational success. With the right support and development, these individuals have the potential to grow and take on more responsibilities within the organization.
                                                        @endif --}}
                                                        {{ $growthPotentialResult['growth-potential']['description'] ?? '' }}
                                                    </div>
                                                    <!--end::Body-->
                                                </div>
                                                <!--end::Item-->

                                                <!--begin::Item-->

                                                <!--end::Item-->
                                            </div>
                                            <!--end::Accordion-->
                                            <!--end::Accordion-->
                                        @else
                                            <div class="container text-center bg_secondary_green p-5"
                                                style="
                                                        border-radius: 16px;">
                                                <iconify-icon icon="wpf:statistics" class="text-[2.23rem]">
                                                </iconify-icon>
                                                <h4>Data Not Available </h4>
                                            </div>
                                        @endif


                                    </div>
                                </div>

                        </div>

                        @endif
                        {{-- right end --}}









                    </div>


                </div>


            </div>

            <div class="card h-full tab-pane fade" id="kt_tab_pane_3" role="tabpanel">
                <p>
                <p>1. **Physical Examination**:
                - General physical check-up
                - Vital signs (blood pressure, heart rate, respiratory rate, temperature)
                - Body Mass Index (BMI)
                </p>
                2. **Laboratory Tests**:
                - Complete Blood Count (CBC)
                - Urinalysis
                - Fecalysis (stool examination)
                - Blood chemistry tests (e.g., fasting blood sugar, cholesterol levels)

                3. **Chest X-ray**:
                - To check for any lung conditions, including tuberculosis (TB), which is a significant concern in the Philippines.

                4. **Electrocardiogram (ECG/EKG)**:
                - To assess heart health, especially for employees in physically demanding jobs or those over a certain age.

                5. **Hearing and Vision Tests**:
                - To ensure that employees meet the sensory requirements of their roles.

                6. **Drug Testing**:
                - Often required to screen for substance abuse.

                7. **Hepatitis Screening**:
                - Particularly for those in the food industry or healthcare sector.

                8. **Pulmonary Function Tests**:
                - Especially important for employees exposed to dust, chemicals, or other respiratory hazards.

                9. **Audiometry**:
                - For employees in noisy environments to check for hearing loss.

                10. **Psychological Assessment**:
                    - Sometimes included to assess mental health and stress levels, especially for high-stress roles.

                11. **Fitness for Duty Tests**:
                    - Specific tests related to the physical demands of the job, such as lifting capacity, endurance, and flexibility tests.

                Employers may customize these screenings based on the nature of the job and the associated health risks. Regular health screenings help in early detection of potential health issues, ensuring a healthier workforce and reducing absenteeism.
                </p>
            </div>

            <div class="card h-full tab-pane fade" id="kt_tab_pane_operations" role="tabpanel">
      
                <header class="card-header align-items-center">
                    <h4 class="card-title">Employee Operations</h4>
                    <div class="d-flex" style="align-items: center;">

                    </div>

                </header>
                <div class="card-body p-6">

                    <div class="row">

                        <div class="col-lg-6 mt-5">
                            <div class="card h-full shadow-base2">
                                <header class="card-header">
                                    <h4 class="card-title">Superior</h4>
                                </header>
                                <div class="card-body p-6">
                                   
                                    <div class="fv-row mb-7 fv-plugins-icon-container col-lg-12">
                                        <form id="superiorForm" action="" method="post">
                                            @csrf
                                        <input type="hidden" name="id" value="{{ $employee->id }}">
                                        <label for="superior" class="fw-semibold fs-6 mb-2">Immediate Superior</label>
                                        <select id="superior" class="form-control form-control-solid mb-3 mb-lg-0" data-placeholder="Select Superior" data-control="select2" data-hide-search="false" name="superior" disabled>
                                            <option value="" class="dark:bg-slate-700">Select Immediate Superior</option>
                                            
                                        </select>
                                        <br/>
                                        <br/>

                                        {{-- <button class="btn btn-primary" type="submit">Save</button> --}}
                                         </form>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <div class="col-lg-6 mt-5">
                            <div class="card h-full shadow-base2">
                                <header class="card-header">
                                    <h4 class="card-title">Job Role</h4>
                                </header>
                                <div class="card-body p-6">
                                   
                                    <div class="fv-row mb-7 fv-plugins-icon-container col-lg-12">
                                        
                                        <label for="department" class="fw-semibold fs-6 mb-2">Select Department</label>
                                        <select id="department_search" class="form-control form-control-solid mb-3 mb-lg-0" data-placeholder="Select Department" data-control="select2" data-hide-search="false" name="department" disabled>
                                            <option value="" class="dark:bg-slate-700">Select Department</option>
                                        </select>
                                      
                                    </div>

                                    <div class="fv-row mb-7 fv-plugins-icon-container col-lg-12">
                                        
                                        <label for="job_search" class="fw-semibold fs-6 mb-2">Select Job Position</label>
                                        <select id="job_search" class="form-control form-control-solid mb-3 mb-lg-0" name="job_search" disabled>
                                            <option value="" class="dark:bg-slate-700">Please select department first.</option>
                                        </select>
                                      
                                    </div>

                                    <div class="fv-row mb-7 fv-plugins-icon-container col-lg-12">
                                        <label for="job_search" class="fw-semibold fs-6 mb-2">Select Position Type</label>
                                        <select id="job_search" class="form-control form-control-solid mb-3 mb-lg-0" name="job_search" disabled>
                                            <option value="" class="dark:bg-slate-700">Select Type</option>
                                            <option value="hod" class="dark:bg-slate-700" {{ $employee->position_type == 'hod' ? 'selected':'' }}>Head of department</option>
                                            <option value="employee" class="dark:bg-slate-700" {{ $employee->position_type == 'employee' ? 'selected':'' }}>Employee</option>
                                        </select>
                                    </div>

                                    {{-- <div class="fv-row mb-7 fv-plugins-icon-container col-lg-12">
                                        <button type="submit" class="btn btn-success">Save</button>
                                    </div>     --}}

                                </div>
                            </div>
                        </div>

                    </div>
                    

                </div>    

            </div>


            <div>
        </div>
        <!--end::Row-->

    </div>



    {{-- all facet modal start --}}
    @if (($employee->is_personality_motivation_completed == 1) && ($isUserResultExists))
        {{-- #Openness To Experience Facets Modal --}}
        <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
            id="openness_facets_modal" tabindex="-1" aria-labelledby="openness_facets_modal" aria-hidden="true">
            <div class="modal-dialog modal-xl relative w-auto pointer-events-none">
                <div
                    class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding
                        rounded-md outline-none text-current">
                    <div class="relative bg-white rounded-lg shadow dark:bg-slate-700">
                        <!-- Modal header -->
                        <div
                            class="d-flex justify-content-between p-5">
                            <h3 class="text-xl font-medium text-dark capitalize">
                                Openness to Experiences
                            </h3>
                            <button type="button"
                                class="border-0 bg-transparent"
                                data-bs-dismiss="modal">
                                <iconify-icon icon="akar-icons:cross" class="fa-1-5"></iconify-icon>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-6 space-y-4">
                            <div class="">
                                <div class="row" style="justify-content: end;">
                                    <div class="col-lg-12">
                                        <button class="btn btn-primary" style="float: right;">Percentile (th)</button>
                                    </div>
                                </div>
                                <h6> {{$oceanDomainResult['openness-to-experience']['description'] ?? ' '}} </h6>
                                {!! renderFinalFacetHtml('Practicality', 'daydreaming','Day Dreaming', $oceanAllFacetsSingleResult, $oceanAllFacetsOverallResult, $allHighFacets, $allLowFacets, $allFacetsDescriptions, $oceanAllFacetsResult, 'daydreaming') !!}
                                {!! renderFinalFacetHtml('Practical Aesthetics', 'aesthetic_appreciation','Aesthetic Appreciation', $oceanAllFacetsSingleResult, $oceanAllFacetsOverallResult, $allHighFacets, $allLowFacets, $allFacetsDescriptions, $oceanAllFacetsResult, 'aesthetic-appreciation') !!}
                                {!! renderFinalFacetHtml('Measured Emotionality', 'feeling_aware','Feeling Aware', $oceanAllFacetsSingleResult, $oceanAllFacetsOverallResult, $allHighFacets, $allLowFacets, $allFacetsDescriptions,$oceanAllFacetsResult, 'feeling-aware') !!}
                                {!! renderFinalFacetHtml('Consistent Reliability', 'explorer','Explorer', $oceanAllFacetsSingleResult, $oceanAllFacetsOverallResult, $allHighFacets, $allLowFacets, $allFacetsDescriptions,$oceanAllFacetsResult, 'explorer') !!}
                                {!! renderFinalFacetHtml('Realistic Pragmatism', 'innovation','Innovation', $oceanAllFacetsSingleResult, $oceanAllFacetsOverallResult, $allHighFacets, $allLowFacets, $allFacetsDescriptions,$oceanAllFacetsResult, 'innovation') !!}
                                {!! renderFinalFacetHtml('Traditional Values', 'open_mindedness','Open Mindedness', $oceanAllFacetsSingleResult, $oceanAllFacetsOverallResult, $allHighFacets, $allLowFacets, $allFacetsDescriptions,$oceanAllFacetsResult, 'open-mindedness') !!}
                                

                            {{--<div class="slider-container">
                                    <div class="slider-label">Practicality</div>
                            
                                    <div class="slider-track">
                                        <div class="emp_a"
                                            @if (isset($oceanAllFacetsEmployeeAResult->daydreaming_avg) &&
                                                    ($oceanAllFacetsEmployeeAResult->daydreaming_avg / 5) * 100 == 100) style="left: 93%;"@else
                                            style="left: {{ ($oceanAllFacetsEmployeeAResult->daydreaming_avg / 5) * 100 ?? 0 }}%;" @endif>
                                        </div>
                                        <div class="emp_b population_hide hidden_population"
                                            style="left: {{ ($oceanAllFacetsOverallResult->daydreaming_avg / 5) * 100 ?? 0 }}%;">
                                            P
                                        </div>
                                    </div>
                                    <div class="slider-label">Daydreaming</div>
                                </div>
                                <div class="slider-container">
                                    <div class="slider-label">Practical Aesthetics</div>
                                    
                                    <div class="slider-track">
                                        <div class="emp_a"
                                            @if (isset($oceanAllFacetsEmployeeAResult->aesthetic_appreciation_avg) &&
                                                    ($oceanAllFacetsEmployeeAResult->aesthetic_appreciation_avg / 5) * 100 == 100) style="left: 93%;"@else
                                            style="left: {{ ($oceanAllFacetsEmployeeAResult->aesthetic_appreciation_avg / 5) * 100 ?? 0 }}%;" @endif>
                                        </div>
                                        <div class="emp_b population_hide hidden_population"
                                            style="left: {{ ($oceanAllFacetsOverallResult->aesthetic_appreciation_avg / 5) * 100 ?? 0 }}%;">
                                            P</div>

                                    </div>
                                    <div class="slider-label">Aesthetic Appreciation</div>
                                </div>
                                <div class="slider-container">
                                    <div class="slider-label">Measured Emotionality</div>

                                    <div class="slider-track">
                                        <div class="emp_a"
                                            @if (isset($oceanAllFacetsEmployeeAResult->feeling_aware_avg) &&
                                                    ($oceanAllFacetsEmployeeAResult->feeling_aware_avg / 5) * 100 == 100) style="left: 93%;"@else
                                            style="left: {{ ($oceanAllFacetsEmployeeAResult->feeling_aware_avg / 5) * 100 ?? 0 }}%;" @endif>
                                        </div>
                                        <div class="emp_b population_hide hidden_population"
                                            style="left: {{ ($oceanAllFacetsOverallResult->feeling_aware_avg / 5) * 100 ?? 0 }}%;">
                                            P</div>
                                    </div>
                                    <div class="slider-label">Feeling Aware</div>

                                </div>
                                <div class="slider-container">
                                    <div class="slider-label">Consistent Reliability</div>
                                    
                                    <div class="slider-track">
                                        <div class="emp_a"
                                            @if (isset($oceanAllFacetsEmployeeAResult->explorer_avg) &&
                                                    ($oceanAllFacetsEmployeeAResult->explorer_avg / 5) * 100 == 100) style="left: 93%;"@else
                                            style="left: {{ ($oceanAllFacetsEmployeeAResult->explorer_avg / 5) * 100 ?? 0 }}%;" @endif>
                                        </div>
                                        <div class="emp_b population_hide hidden_population"
                                            style="left: {{ ($oceanAllFacetsOverallResult->explorer_avg / 5) * 100 ?? 0 }}%;">P
                                        </div>
                                    </div>
                                    <div class="slider-label">Explorer</div>
                                </div>
                                <div class="slider-container">
                                    <div class="slider-label">Realistic Pragmatism</div>

                                    <div class="slider-track">
                                        <div class="emp_a"
                                            @if (isset($oceanAllFacetsEmployeeAResult->innovation_avg) &&
                                                    ($oceanAllFacetsEmployeeAResult->innovation_avg / 5) * 100 == 100) style="left: 93%;"@else
                                            style="left: {{ ($oceanAllFacetsEmployeeAResult->innovation_avg / 5) * 100 ?? 0 }}%;" @endif>
                                        </div>
                                        <div class="emp_b population_hide hidden_population"
                                            style="left: {{ ($oceanAllFacetsOverallResult->innovation_avg / 5) * 100 ?? 0 }}%;">
                                            P
                                        </div>
                                    </div>
                                    <div class="slider-label">Innovation</div>

                                </div>
                                <div class="slider-container">
                                    <div class="slider-label">Traditional Values</div>
                                    
                                    <div class="slider-track">
                                        <div class="emp_a"
                                            @if (isset($oceanAllFacetsEmployeeAResult->open_mindedness_avg) &&
                                                    ($oceanAllFacetsEmployeeAResult->open_mindedness_avg / 5) * 100 == 100) style="left: 93%;"@else
                                            style="left: {{ ($oceanAllFacetsEmployeeAResult->open_mindedness_avg / 5) * 100 ?? 0 }}%;" @endif>
                                        </div>
                                        <div class="emp_b population_hide hidden_population"
                                            style="left: {{ ($oceanAllFacetsOverallResult->open_mindedness_avg / 5) * 100 ?? 0 }}%;">
                                            P</div>
                                    </div>
                                    <div class="slider-label">Open-mindedness</div>
                                </div> --}}
                            </div>
                        </div>
                        <!-- Modal footer -->
                        {{-- <div
                        class="flex items-center justify-end p-6 space-x-2 border-t border-slate-200 rounded-b dark:border-slate-600">
                        <button data-bs-dismiss="modal"
                            class="btn inline-flex justify-center text-white bg-black-500">Accept</button>
                    </div> --}}
                    </div>
                </div>
            </div>
        </div>

        {{-- Conscientiousness Facets Modal --}}
        <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
            id="conscientiousness_facets_modal" tabindex="-1" aria-labelledby="conscientiousness_facets_modal"
            aria-hidden="true">
            <div class="modal-dialog modal-xl relative w-auto pointer-events-none">
                <div
                    class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding
            rounded-md outline-none text-current">
                    <div class="relative bg-white rounded-lg shadow dark:bg-slate-700">
                        <!-- Modal header -->
                        <div
                            class="d-flex justify-content-between p-5">
                            <h3 class="text-xl font-medium text-dark capitalize">
                                Conscientiousness
                            </h3>
                            <button type="button"
                            class="border-0 bg-transparent"
                            data-bs-dismiss="modal">
                            <iconify-icon icon="akar-icons:cross" class="fa-1-5"></iconify-icon>
                            <span class="sr-only">Close modal</span>
                        </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-6 space-y-4">
                            <div class="">
                                <div class="row" style="justify-content: end;">
                                    <div class="col-lg-12">
                                        <button class="btn btn-primary" style="float: right;">Percentile (th)</button>
                                    </div>
                                </div>
                                <h6> {{$oceanDomainResult['conscientiousness']['description'] ?? ' '}} </h6>
                                {!! renderFinalFacetHtml('Humble Capability', 'self_confidence','Self Confidence', $oceanAllFacetsSingleResult,$oceanAllFacetsOverallResult, $allHighFacets, $allLowFacets, $allFacetsDescriptions, $oceanAllFacetsResult, 'self-confidence') !!}
                                {!! renderFinalFacetHtml('Flexibility', 'tidiness','Tidiness', $oceanAllFacetsSingleResult,$oceanAllFacetsOverallResult, $allHighFacets, $allLowFacets, $allFacetsDescriptions, $oceanAllFacetsResult, 'tidiness') !!}
                                {!! renderFinalFacetHtml('Autonomy', 'responsibility','Responsibility', $oceanAllFacetsSingleResult,$oceanAllFacetsOverallResult, $allHighFacets, $allLowFacets, $allFacetsDescriptions, $oceanAllFacetsResult, 'responsibility') !!}
                                {!! renderFinalFacetHtml('Contentment', 'drive_to_achieve','Drive To Achieve', $oceanAllFacetsSingleResult,$oceanAllFacetsOverallResult, $allHighFacets, $allLowFacets, $allFacetsDescriptions, $oceanAllFacetsResult, 'drive-to-achieve') !!}
                                {!! renderFinalFacetHtml('Spontaneity', 'willpower','Will Power', $oceanAllFacetsSingleResult,$oceanAllFacetsOverallResult, $allHighFacets, $allLowFacets, $allFacetsDescriptions, $oceanAllFacetsResult, 'willpower') !!}
                                {!! renderFinalFacetHtml('Impulsiveness', 'careful_thinking','Careful Thinking', $oceanAllFacetsSingleResult,$oceanAllFacetsOverallResult, $allHighFacets, $allLowFacets, $allFacetsDescriptions, $oceanAllFacetsResult, 'careful-thinking') !!}
                                
                                {{-- <div class="slider-container">
                                    <div class="slider-label">Humble Capability</div>
                                    
                                    <div class="slider-track">
                                        <div class="emp_a"
                                            @if (isset($oceanAllFacetsEmployeeAResult->self_confidence_avg) &&
                                                    ($oceanAllFacetsEmployeeAResult->self_confidence_avg / 5) * 100 == 100) style="left: 93%;"@else
                                            style="left: {{ ($oceanAllFacetsEmployeeAResult->self_confidence_avg / 5) * 100 ?? 0 }}%;" @endif>
                                        </div>
                                        <div class="emp_b population_hide hidden_population"
                                            style="left: {{ ($oceanAllFacetsOverallResult->self_confidence_avg / 5) * 100 ?? 0 }}%;">
                                            P</div>
                                    </div>
                                    <div class="slider-label">Self-Confidence</div>
                                </div>
                                <div class="slider-container">
                                    <div class="slider-label">Flexibility</div>
                                    <div class="slider-track">
                                        <div class="emp_a"
                                            @if (isset($oceanAllFacetsEmployeeAResult->tidiness_avg) &&
                                                    ($oceanAllFacetsEmployeeAResult->tidiness_avg / 5) * 100 == 100) style="left: 93%;"@else
                                            style="left: {{ ($oceanAllFacetsEmployeeAResult->tidiness_avg / 5) * 100 ?? 0 }}%;" @endif>
                                        </div>
                                        <div class="emp_b population_hide hidden_population"
                                            style="left: {{ ($oceanAllFacetsOverallResult->tidiness_avg / 5) * 100 ?? 0 }}%;">P
                                        </div>

                                    </div>
                                    <div class="slider-label">Tidiness</div>
                                    
                                </div>
                                <div class="slider-container">
                                    <div class="slider-label">Autonomy</div>

                                    <div class="slider-track">
                                        <div class="emp_a"
                                            @if (isset($oceanAllFacetsEmployeeAResult->responsibility_avg) &&
                                                    ($oceanAllFacetsEmployeeAResult->responsibility_avg / 5) * 100 == 100) style="left: 93%;"@else
                                            style="left: {{ ($oceanAllFacetsEmployeeAResult->responsibility_avg / 5) * 100 ?? 0 }}%;" @endif>
                                        </div>
                                        <div class="emp_b population_hide hidden_population"
                                            style="left: {{ ($oceanAllFacetsOverallResult->responsibility_avg / 5) * 100 ?? 0 }}%;">
                                            P</div>
                                    </div>
                                    <div class="slider-label">Responsibility</div>

                                </div>
                                <div class="slider-container">
                                    <div class="slider-label">Contentment</div>
                                    <div class="slider-track">
                                        <div class="emp_a"
                                            @if (isset($oceanAllFacetsEmployeeAResult->drive_to_achieve_avg) &&
                                                    ($oceanAllFacetsEmployeeAResult->drive_to_achieve_avg / 5) * 100 == 100) style="left: 93%;"@else
                                            style="left: {{ ($oceanAllFacetsEmployeeAResult->drive_to_achieve_avg / 5) * 100 ?? 0 }}%;" @endif>
                                        </div>
                                        <div class="emp_b population_hide hidden_population"
                                            style="left: {{ ($oceanAllFacetsOverallResult->drive_to_achieve_avg / 5) * 100 ?? 0 }}%;">
                                            P</div>
                                    </div>
                                
                                    <div class="slider-label">Drive to Achieve</div>
                                </div>
                                <div class="slider-container">
                                    <div class="slider-label">Spontaneity</div>
                                
                                    <div class="slider-track">
                                        <div class="emp_a"
                                            @if (isset($oceanAllFacetsEmployeeAResult->will_power_avg) &&
                                                    ($oceanAllFacetsEmployeeAResult->will_power_avg / 5) * 100 == 100) style="left: 93%;"@else
                                            style="left: {{ ($oceanAllFacetsEmployeeAResult->will_power_avg / 5) * 100 ?? 0 }}%;" @endif>
                                        </div>
                                        <div class="emp_b population_hide hidden_population"
                                            style="left: {{ ($oceanAllFacetsOverallResult->will_power_avg / 5) * 100 ?? 0 }}%;">
                                            P
                                        </div>
                                    </div>
                                    <div class="slider-label">Willpower</div>
                                </div>
                                <div class="slider-container">
                                    <div class="slider-label">Impulsiveness</div>
                                    
                                    <div class="slider-track">
                                        <div class="emp_a"
                                            @if (isset($oceanAllFacetsEmployeeAResult->careful_thinking_avg) &&
                                                    ($oceanAllFacetsEmployeeAResult->careful_thinking_avg / 5) * 100 == 100) style="left: 93%;"@else
                                            style="left: {{ ($oceanAllFacetsEmployeeAResult->careful_thinking_avg / 5) * 100 ?? 0 }}%;" @endif>
                                        </div>
                                        <div class="emp_b population_hide hidden_population"
                                            style="left: {{ ($oceanAllFacetsOverallResult->careful_thinking_avg / 5) * 100 ?? 0 }}%;">
                                            P</div>
                                    </div>
                                    <div class="slider-label">Careful Thinking</div>
                                </div> --}}
                            </div>
                        </div>
                        <!-- Modal footer -->
                        {{-- <div
                        class="flex items-center justify-end p-6 space-x-2 border-t border-slate-200 rounded-b dark:border-slate-600">
                        <button data-bs-dismiss="modal"
                            class="btn inline-flex justify-center text-white bg-black-500">Accept</button>
                    </div> --}}
                    </div>
                </div>
            </div>
        </div>

        {{-- Extraversion Facets Modal --}}
        <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
            id="extraversion_facets_modal" tabindex="-1" aria-labelledby="extraversion_facets_modal" aria-hidden="true">
            <div class="modal-dialog modal-xl relative w-auto pointer-events-none">
                <div
                    class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding
                    rounded-md outline-none text-current">
                    <div class="relative bg-white rounded-lg shadow dark:bg-slate-700">
                        <!-- Modal header -->
                        <div
                            class="d-flex justify-content-between p-5">
                            <h3 class="text-xl font-medium text-dark capitalize">
                                Extraversion
                            </h3>

                            <button type="button"
                            class="border-0 bg-transparent"
                            data-bs-dismiss="modal">
                            <iconify-icon icon="akar-icons:cross" class="fa-1-5"></iconify-icon>
                            <span class="sr-only">Close modal</span>
                        </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-6 space-y-4">
                            <div class="">
                                <div class="row" style="justify-content: end;">
                                    <div class="col-lg-12">
                                        <button class="btn btn-primary" style="float: right;">Percentile (th)</button>
                                    </div>
                                </div>
                                <h6> {{$oceanDomainResult['extraversion']['description'] ?? ' '}} </h6>
                                {!! renderFinalFacetHtml('Reservedness', 'sociability','Sociability', $oceanAllFacetsSingleResult,$oceanAllFacetsOverallResult, $allHighFacets, $allLowFacets, $allFacetsDescriptions, $oceanAllFacetsResult, 'sociability') !!}
                                {!! renderFinalFacetHtml('Independence', 'crowd_enjoyment','Crowd Enjoyment', $oceanAllFacetsSingleResult,$oceanAllFacetsOverallResult, $allHighFacets, $allLowFacets, $allFacetsDescriptions, $oceanAllFacetsResult, 'crowd-enjoyment') !!}
                                {!! renderFinalFacetHtml('Humility', 'confidence','Confidence', $oceanAllFacetsSingleResult,$oceanAllFacetsOverallResult, $allHighFacets, $allLowFacets, $allFacetsDescriptions, $oceanAllFacetsResult, 'confidence') !!}
                                {!! renderFinalFacetHtml('Calmness', 'energetic_lifestyle','Energetic Lifestyle', $oceanAllFacetsSingleResult,$oceanAllFacetsOverallResult, $allHighFacets, $allLowFacets, $allFacetsDescriptions, $oceanAllFacetsResult, 'energetic-lifestyle') !!}
                                {!! renderFinalFacetHtml('Risk Aversion', 'thrill_seeking','Thrill Seeking', $oceanAllFacetsSingleResult,$oceanAllFacetsOverallResult, $allHighFacets, $allLowFacets, $allFacetsDescriptions, $oceanAllFacetsResult, 'thrill-seeking') !!}
                                {!! renderFinalFacetHtml('Composed Outlook', 'optimism','Optimism', $oceanAllFacetsSingleResult,$oceanAllFacetsOverallResult, $allHighFacets, $allLowFacets, $allFacetsDescriptions, $oceanAllFacetsResult, 'optimism') !!}

                            </div>
                        </div>
                        <!-- Modal footer -->
                        {{-- <div
                        class="flex items-center justify-end p-6 space-x-2 border-t border-slate-200 rounded-b dark:border-slate-600">
                        <button data-bs-dismiss="modal"
                            class="btn inline-flex justify-center text-white bg-black-500">Accept</button>
                    </div> --}}
                    </div>
                </div>
            </div>
        </div>

        {{-- Agreeableness Facets Modal --}}
        <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
            id="agreeableness_facets_modal" tabindex="-1" aria-labelledby="agreeableness_facets_modal" aria-hidden="true">
            <div class="modal-dialog modal-xl relative w-auto pointer-events-none">
                <div
                    class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding
            rounded-md outline-none text-current">
                    <div class="relative bg-white rounded-lg shadow dark:bg-slate-700">
                        <!-- Modal header -->
                        <div
                            class="d-flex justify-content-between p-5">
                            <h3 class="text-xl font-medium text-dark capitalize">
                                Agreeableness
                            </h3>

                            <button type="button"
                            class="border-0 bg-transparent"
                            data-bs-dismiss="modal">
                            <iconify-icon icon="akar-icons:cross" class="fa-1-5"></iconify-icon>
                            <span class="sr-only">Close modal</span>
                        </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-6 space-y-4">
                            <div class="">
                                <div class="row" style="justify-content: end;">
                                    <div class="col-lg-12">
                                        <button class="btn btn-primary" style="float: right;">Percentile (th)</button>
                                    </div>
                                </div>
                                <h6> {{$oceanDomainResult['agreeableness']['description'] ?? ' '}} </h6>
                                {!! renderFinalFacetHtml('Skepticism', 'belief','Belief', $oceanAllFacetsSingleResult,$oceanAllFacetsOverallResult, $allHighFacets, $allLowFacets, $allFacetsDescriptions, $oceanAllFacetsResult, 'belief') !!}
                                {!! renderFinalFacetHtml('Tactfulness', 'honesty','Honesty', $oceanAllFacetsSingleResult,$oceanAllFacetsOverallResult, $allHighFacets, $allLowFacets, $allFacetsDescriptions, $oceanAllFacetsResult, 'honesty') !!}
                                {!! renderFinalFacetHtml('Self-Reliance', 'helpfulness','Helpfulness', $oceanAllFacetsSingleResult,$oceanAllFacetsOverallResult, $allHighFacets, $allLowFacets, $allFacetsDescriptions, $oceanAllFacetsResult, 'helpfulness') !!}
                                {!! renderFinalFacetHtml('Self-Assuredness', 'diplomacy','Diplomacy', $oceanAllFacetsSingleResult,$oceanAllFacetsOverallResult, $allHighFacets, $allLowFacets, $allFacetsDescriptions, $oceanAllFacetsResult, 'diplomacy') !!}
                                {!! renderFinalFacetHtml('Self-Belief', 'humility','Humility', $oceanAllFacetsSingleResult,$oceanAllFacetsOverallResult, $allHighFacets, $allLowFacets, $allFacetsDescriptions, $oceanAllFacetsResult, 'humility') !!}
                                {!! renderFinalFacetHtml('Tough-Mindedness', 'compassion','Compassion', $oceanAllFacetsSingleResult,$oceanAllFacetsOverallResult, $allHighFacets, $allLowFacets, $allFacetsDescriptions, $oceanAllFacetsResult, 'compassion') !!}

                            </div>
                        </div>
                        <!-- Modal footer -->
                        {{-- <div
                        class="flex items-center justify-end p-6 space-x-2 border-t border-slate-200 rounded-b dark:border-slate-600">
                        <button data-bs-dismiss="modal"
                            class="btn inline-flex justify-center text-white bg-black-500">Accept</button>
                    </div> --}}
                    </div>
                </div>
            </div>
        </div>

        {{-- Emotional Stability Facets Modal --}}
        <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
            id="emotional_stability_facets_modal" tabindex="-1" aria-labelledby="emotional_stability_facets_modal"
            aria-hidden="true">
            <div class="modal-dialog modal-xl relative w-auto pointer-events-none">
                <div
                    class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding
            rounded-md outline-none text-current">
                    <div class="relative bg-white rounded-lg shadow dark:bg-slate-700">
                        <!-- Modal header -->
                        <div
                            class="d-flex justify-content-between p-5">
                            <h3 class="text-xl font-medium text-dark capitalize">
                                Emotional Stability
                            </h3>

                            <button type="button"
                            class="border-0 bg-transparent"
                            data-bs-dismiss="modal">
                            <iconify-icon icon="akar-icons:cross" class="fa-1-5"></iconify-icon>
                            <span class="sr-only">Close modal</span>
                        </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-6 space-y-4">
                            <div class="">
                                <div class="row" style="justify-content: end;">
                                    <div class="col-lg-12">
                                        <button class="btn btn-primary" style="float: right;">Percentile (th)</button>
                                    </div>
                                </div>
                                <h6> {{$oceanDomainResult['emotional-stability']['description'] ?? ' '}} </h6>
                                {!! renderFinalFacetHtml('Stress Sensitivity', 'steadiness','Steadiness', $oceanAllFacetsSingleResult,$oceanAllFacetsOverallResult, $allHighFacets, $allLowFacets, $allFacetsDescriptions, $oceanAllFacetsResult, 'steadiness') !!}
                                {!! renderFinalFacetHtml('Irritability', 'tolerance','Tolerance', $oceanAllFacetsSingleResult,$oceanAllFacetsOverallResult, $allHighFacets, $allLowFacets, $allFacetsDescriptions, $oceanAllFacetsResult, 'tolerance') !!}
                                {!! renderFinalFacetHtml('Discouragement', 'positivity','Positivity', $oceanAllFacetsSingleResult,$oceanAllFacetsOverallResult, $allHighFacets, $allLowFacets, $allFacetsDescriptions, $oceanAllFacetsResult, 'positivity') !!}
                                {!! renderFinalFacetHtml('Self-Doubt', 'social_sensitivity','Social Sensitivity', $oceanAllFacetsSingleResult,$oceanAllFacetsOverallResult, $allHighFacets, $allLowFacets, $allFacetsDescriptions, $oceanAllFacetsResult, 'social-sensitivity') !!}
                                {!! renderFinalFacetHtml('Rashness', 'impulse_control','Impulse Control', $oceanAllFacetsSingleResult,$oceanAllFacetsOverallResult, $allHighFacets, $allLowFacets, $allFacetsDescriptions, $oceanAllFacetsResult, 'impulse-control') !!}
                                {!! renderFinalFacetHtml('Stress Prone', 'stress_response','Stress Response', $oceanAllFacetsSingleResult,$oceanAllFacetsOverallResult, $allHighFacets, $allLowFacets, $allFacetsDescriptions, $oceanAllFacetsResult, 'stress-response') !!}
                        
                            </div>
                        </div>
                        <!-- Modal footer -->
                        {{-- <div
                        class="flex items-center justify-end p-6 space-x-2 border-t border-slate-200 rounded-b dark:border-slate-600">
                        <button data-bs-dismiss="modal"
                            class="btn inline-flex justify-center text-white bg-black-500">Accept</button>
                    </div> --}}
                    </div>
                </div>
            </div>
        </div>
    @endif
    {{-- all facet modal end --}}



@endsection


@section('scripts')
    {{-- {{dd($labels)}} --}}
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.35.0"></script>

    <script>
        var options = {
            chart: {
                type: 'donut',
                width: 400, // Set the width of the chart
                height: 300, // Set the height of the chart
            },
            series: [{{ $totalCorrectForCognitive }}, {{ $totalWrongForCognitive }},
                {{ $totalNonAttemptedForCognitive }}
            ],
            labels: ['Correct', 'Wrong', 'Missed'],
            colors: ['#8DB171', '#CE9E20', '#1F5476'],
            xaxis: {
                categories: [1991, 1992, 1993, 1994, 1995, 1996, 1997, 1998, 1999]
            },

            legend: {
                position: 'bottom', // Set the position of the legend to 'bottom'
            },
        }

        var chart = new ApexCharts(document.querySelector("#donut"), options);

        chart.render();
    </script>

  

    {{-- Script for print  --}}
    <script>
        document.getElementById('printButton').addEventListener('click', function() {
            window.print();
        });
    </script>

    <script>
        var addToBookmarkButton = document.getElementById('addToBookmarkButton');
        if (addToBookmarkButton) {
            addToBookmarkButton.addEventListener('click', function() {
                document.getElementById('addToBookmarkForm').submit();
            });
        }

        var removeBookmarkButton = document.getElementById('removeBookmarkButton');
        if (removeBookmarkButton) {
            removeBookmarkButton.addEventListener('click', function() {
                document.getElementById('removeBookmarkForm').submit();
            });
        }
    </script>

    <script>
        document.getElementById("population").addEventListener("change", function() {
            var elements = document.getElementsByClassName("population_hide");
            var raisec_ele = document.getElementsByClassName("raisec_container");
            for (var i = 0; i < elements.length; i++) {
                if (this.checked) {
                    elements[i].classList.remove("hidden_population");

                } else {
                    elements[i].classList.add("hidden_population");

                }
            }



            for (var i = 0; i < raisec_ele.length; i++) {
                if (this.checked) {
                    raisec_ele[i].classList.add("top_riasec");

                } else {
                    raisec_ele[i].classList.remove("top_riasec");

                }
            }
        });
    </script>
    <script>
        document.getElementById('backButton').addEventListener('click', function() {
            history.back();
        });
    </script>

    <script>
        $(document).ready(function() {
        function initSelect2(selector,initialId,initialName) {

            var $select = $(selector);

            // Append the initial option if provided
            if (initialId && initialName) {
                var option = new Option(initialName, initialId, true, true);
                $select.append(option).trigger('change');
            }

            $(selector).select2({
                
                ajax: {
                    url: '{{ route("admin.users-filter.search") }}', // Change to your actual API endpoint
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: params.term, // search term
                            user_id:"{{ $employee->id }}"
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
        var skillSelect = $('#superior')

        initSelect2(skillSelect,"{{ $employee->superior_id }}","{{ $employee && $employee->superior ? $employee->superior->name:'' }}");
        
    });
    </script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script>
$(document).ready(function() {
    $('#superiorForm').on('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission


        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to submit the selected superior for the employee?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, submit it!'
        }).then((result) => {
            if (result.isConfirmed) {

                var formData = $(this).serialize(); // Serialize the form data

                $.ajax({
                    url: '{{ route("admin.users-filter.superior.save") }}', // Replace with your route
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        Swal.fire(
                            'Submitted!',
                            'The superior for the employee has been submitted successfully.',
                            'success'
                        );
                    },
                    error: function(xhr, status, error) {
                        Swal.fire(
                            'Error!',
                            'An error occurred while submitting the superior for the employee: ' + error,
                            'error'
                        );
                    }
                });

            }})

    });
});
</script>



<script>
    $(document).ready(function() {
    function initSelect2(selector,initialId,initialName,position_id) {

        var $select = $(selector);

        // Append the initial option if provided
        if (initialId && initialName) {
            var option = new Option(initialName, initialId, true, true);
            $select.append(option).trigger('change');
            if (position_id) {

            $.ajax({
                url: "/admin/jobs/by_org_department"
                , method: 'GET'
                , data: {
                    department_id: initialId
                }
                , success: function(response) {
                    // Update job descriptions dropdown options based on response
                    var selectedVar = '';
                    var options = '<option value="">Select Job Position</option>';
                    $.each(response, function(key, value) {
                        var selectedVar = '';
                        if (key == position_id) {
                            selectedVar = 'selected';
                        }
                        options += '<option value="' + key + '"'+selectedVar+'>' + value + '</option>';
                    });
                    $('#job_search').html(options);
                }
                , error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
                
            }
        }

        $(selector).select2({
            
            ajax: {
                url: '{{ route("admin.departments-filter.search") }}', // Change to your actual API endpoint
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term, // search term
                        user_id:"{{ $employee->id }}"
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
            placeholder: 'Search for a department',
            minimumInputLength: 1
        });
    }
    var skillSelect = $('#department_search')

    initSelect2(skillSelect,"{{ $employee->department_id }}","{{ $employee && $employee->department ? $employee->department->name:'' }}","{{ $employee->position_id }}");
    
});
</script>

<script>
    $(document).ready(function() {
        $('#department_search').on('change', function() {
            var departmentId = $(this).val();

            var ajaxUrl = "/admin/jobs/by_org_department";

        if (departmentId) {
            $.ajax({
                url: ajaxUrl
                , method: 'GET'
                , data: {
                    department_id: departmentId
                }
                , success: function(response) {
                    // Update job descriptions dropdown options based on response
                    var options = '<option value="">Select Job Position</option>';
                    $.each(response, function(key, value) {
                        options += '<option value="' + key + '">' + value + '</option>';
                    });
                    $('#job_search').html(options);
                }
                , error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
        });
    });
</script>

@endsection
