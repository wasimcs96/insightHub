<div class="card mb-10 p-0">
    <div class="card-body profile-card pb-0">
        <!--begin::Details-->
        @if(auth()->user()->role_id == 1)
        <div class="d-flex flex-wrap gap-7 flex-sm-nowrap mb-11">
            <!--begin: Pic-->
            <div>
                <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                    <img src="{{ asset($employee->profile_picture ?? '') }}"
                    onerror="this.onerror=null; this.src='{{ asset('images/default-user.svg') }}';" 
                        alt="image" />
                </div>
            </div>
            <!--end::Pic-->

            <!--begin::Info-->
            <div class="flex-grow-1">
                <!--begin::Title-->
                <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                    <!--begin::User-->
                    <div class="d-flex flex-column gap-4">
                        <!--begin::Name-->
                        <div class="d-flex align-items-center">
                            <a href="#"
                                class="text-gray-900  fs-2 fw-bolder me-1 lh-base">{{ $employee->first_name ?? '' }}
                                {{ $employee->middle_name ?? '' }}
                                {{ $employee->last_name ?? '' }}
                            </a>
                        </div>
                        <!--end::Name-->

                        
                        <!--begin::Info-->
                        <div class="d-flex flex-wrap fw-semibold fs-6 pe-2">
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

                            {{-- <a href="#"
                                class="d-flex align-items-center text-gray-500  me-2 fw-normal">
                                Behavior Fit Rate:
                                {{ config('helpers.behavior_fit_rate_levels')[$level] ?? '' }}
                            </a> --}}

                            {{-- <a href="#"
                                class="d-flex align-items-center text-gray-500  me-2 fw-normal">
                                |
                            </a> --}}

                            <a href="#"
                                class="d-flex flex-column flex-md-row align-items-center text-gray-500  me-2 fw-normal">
                                Job Title : {{ $employee->job_position->title ?? ($employee->job_title ?? '') }}
                            </a>

                            <a href="#"
                                class="d-none d-md-flex align-items-center text-gray-500  me-2 fw-normal ">
                                |
                            </a>

                            <a href="#"
                                class="d-flex align-items-center text-gray-500  me-2 fw-normal">
                                Department: {{ $employee->department->name ?? 'N/A' }} </a>
                        </div>

                        {{-- <div class="d-flex flex-column flex-md-row flex-wrap fw-semibold fs-6 pe-2">
                            <a href="#"
                                class="d-flex align-items-center text-gray-500  me-2 fw-normal">
                                Section: {{ $employee->departmentSection->name ?? 'N/A' }}
                            </a>

                            <a href="#"
                                class="d-none d-md-flex align-items-center text-gray-500  me-2 fw-normal">
                                |
                            </a>

                            <a href="#"
                                class="d-flex align-items-center text-gray-500  me-2 fw-normal">
                                Unit: {{ $employee->sectionUnit->name ?? 'N/A' }} </a>
                        </div> --}}

                        <div class="d-flex flex-column flex-md-row flex-wrap fw-semibold fs-6 pe-2">
                            <a href="#"
                                class="d-flex align-items-center text-gray-500  me-2 fw-normal">
                                   Emp ID: {{ $employee->employee_code ?? 'N/A' }}
                            </a>

                            <a href="#"
                                class="d-none d-md-flex align-items-center text-gray-500  me-2 fw-normal">
                                |
                            </a>
                            <a href="#"
                                class="d-flex align-items-center text-gray-500  me-2 fw-normal">
                                Date of Hire:
                                {{-- {{ \Carbon\Carbon::parse($employee->date_of_hire)->format('F d, Y') ?? 'N/A' }} --}}
                                @if (!($employee->date_of_hire) || ($employee->date_of_hire == '1900-01-01') || ($employee->date_of_hire == '0000-00-00'))
                                    N / A
                                @else
                                {{ \Carbon\Carbon::parse($employee->date_of_hire)->format('F d, Y') ?? 'N/A' }}
                                @endif
                            </a>
                            <a href="#"
                                class="d-none d-md-flex align-items-center text-gray-500  me-2 fw-normal">
                                |
                            </a>
                            <a href="#"
                                class="d-flex align-items-center text-gray-500  me-2 fw-normal">
                                Employment Status:
                                {{ config('constants.EMPLOYMENT_STATUSES.' . $employee->employment_status) ?? 'Full Time' }}
                            </a>
                        </div>
              

                     
                        <!--end::Info-->
                    </div>
                    <!--end::User-->
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
                </div>
                <!--end::Stats-->
            </div>
            <!--end::Info-->
        </div>
        @else
        <div class="d-flex flex-wrap gap-7 flex-sm-nowrap mb-11">
            <!--begin: Pic-->
            <div>
                <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                    <img src="{{ asset($employee->profile_picture ?? '') }}"
                    onerror="this.onerror=null; this.src='{{ asset('images/default-user.svg') }}';" 
                        alt="image" />
                </div>
            </div>
            <!--end::Pic-->

            <!--begin::Info-->
            <div class="flex-grow-1">
                <!--begin::Title-->
                <div class="d-flex justify-content-between align-items-start flex-wrap mb-2 mt-8">
                    <!--begin::User-->
                    <div class="d-flex flex-column gap-4">
                        <!--begin::Name-->
                        <div class="d-flex align-items-center">
                            <a href="#"
                                class="text-gray-900  fs-2 fw-bolder me-1 lh-base">{{ $employee->first_name ?? '' }}
                                {{ $employee->middle_name ?? '' }}
                                {{ $employee->last_name ?? '' }}
                            </a>
                        </div>
                        <!--end::Name-->

                        <div class="d-flex flex-wrap fw-semibold fs-6 pe-2">
                           

                            {{-- <a href="#"
                                class="d-flex align-items-center text-gray-500  me-2 fw-normal">
                                Behavior Fit Rate:N/A
                            </a> --}}
                
                            {{-- <a href="#"
                                class="d-flex align-items-center text-gray-500  me-2 fw-normal">
                                |
                            </a> --}}
                
                            <a href="#"
                                class="d-flex align-items-center text-gray-500  me-2 fw-normal">
                                Email : {{ auth()->user()->email ?? '' }}
                            </a>
                
                            
                        </div>
                
                        <div class="d-flex flex-wrap fw-semibold fs-6 pe-2">
                            <a href="#"
                                class="d-flex align-items-center text-gray-500  me-2 fw-normal">
                                Phone Number: {{ auth()->user()->mobile_number ?? '' }}
                            </a>
                
                           
                        </div>

                     
                        <!--end::Info-->
                    </div>
                    <!--end::User-->
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
                </div>
                <!--end::Stats-->
            </div>
            <!--end::Info-->
        </div>
      
        @endif
        <!--end::Details-->
        <!--begin::Navs-->
        <ul class="nav nav-tabs nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">

            <!--begin::Nav item 2 -->
            <li class="nav-item">
                <a class="nav-link text-active-primary fw-bold fs-6 @if (Route::is('employee.dashboard')) active @endif" href="{{ route('employee.dashboard') }}">
                    Psychometric </a>
            </li>

             <!--begin::Nav item 1 -->
                          
       @if (config('client.' . env('APP_BRANCH') . '.employee_jd_tab'))
             @if(auth()->user()->role_id == 1)
             <li class="nav-item">
                 <a class="nav-link text-active-primary fw-bold fs-6 @if (Route::is('employee.dashboard.jd')) active @endif" href="{{ route('employee.dashboard.jd') }}" role="tabpanel">
                     Job Description </a>
             </li>
             @endif
             @endif

             <!--end::Nav item 1 -->
            <!--end::Nav item 2 -->

            <!--begin::Nav item 3 -->
            {{-- <li class="nav-item">
                <a class="nav-link text-active-primary fw-bold fs-6" data-bs-toggle="tab"
                    href="#kt_tab_pane_operations">Skill Gaps & Intervention</a>
            </li> --}}
            <!--end::Nav item 3 -->
            @if(auth()->user()->role_id == 1)

            <!--start::Nav item 4 -->
            {{-- <li class="nav-item">
                <a class="nav-link text-active-primary fw-bold fs-6 @if (request()->segment(2) === 'career-pathing') active @endif" href="{{ route('employee.dashboard.career-pathing') }}">
                        Career Pathing </a>
            </li>
            <!--end::Nav item 4 -->
            <!--start::Nav item 4 -->
            <li class="nav-item">
                <a class="nav-link text-active-primary fw-bold fs-6 @if (request()->segment(2) === 'development') active @endif"
                    href="{{ route('individual.development.plan') }}">Individual Development Plan (IDP)</a>
            </li>
            <!--end::Nav item 4 -->

            <!--start::Nav item 5 -->
            <li class="nav-item">
             
                    <a class="nav-link text-active-primary fw-bold fs-6 @if (request()->segment(2) === 'performance-management') active @endif"
                        href="{{ route('employee.dashboard.performance-management') }}">Performance Management (KPI)</a>
            </li> --}}
            @else
            <li class="nav-item">
                {{-- <a class="nav-link text-active-primary fw-bold fs-6 @if (request()->segment(3) === 'kpi') active @endif"
                    href="{{ route('employee.dashboard.kpi') }}">Performance Management (KPI)</a> --}}
                    <a class="nav-link text-active-primary fw-bold fs-6 @if (request()->segment(2) === 'job-application') active @endif"
                        href="{{ route('employee.dashboard.job-application') }}">Job Applications</a>
            </li>
            @endif
            <!--end::Nav item 5-->
        </ul>
        <!--end::Navs-->
    </div>
</div>