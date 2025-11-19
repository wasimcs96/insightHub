       <!--begin::Header-->
       @php
           use App\Models\MasterGeneralSetting;

           $logo = MasterGeneralSetting::where('name', 'logo')->first();
       @endphp
       @php
           use Illuminate\Support\Facades\Storage;
           $logoPath = $logo?->value;
       @endphp

       @php
           $roleId = auth()->user()->role_id ?? null;
       @endphp


       <div id="kt_app_header" class="app-header " data-kt-sticky="true" data-kt-sticky-activate="{default: true, lg: true}"
           data-kt-sticky-name="app-header-minimize" data-kt-sticky-offset="{default: '200px', lg: '0'}"
           data-kt-sticky-animation="false">

           <!--begin::Header container-->
           <div class="app-container  container-xxl d-flex align-items-stretch justify-content-between "
               style="padding-left: 30px !important; padding-right: 30px !important; margin: 0 auto !important;"
               id="kt_app_header_container">

               <!--begin::Logo-->
               {{-- <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0 me-lg-15">
                    <a href="/admin/dashboard">
                        <img alt="Logo" src="{{ asset('media/insightaccess.png') }}"
                            class="h-20px h-lg-50px app-sidebar-logo-default" />
                    </a>
                </div> --}}


               <a href="/admin/dashboard">
                   <div class="d-flex gap-3 align-items-center">
                       {{-- <img alt="Logo" style="height: 50px;" src="{{ asset('media/EEI-Corporation-Logo.png') }}"
                    class="logo-default responsive-logo w-auto" /> --}}
                       @if ($logoPath && Storage::disk('public')->exists($logoPath))
                           <img class="logo-default responsive-logo w-auto" src="{{ asset('storage/' . $logoPath) }}"
                               alt="Logo" style="height: 50px;">
                       @endif
                       <img alt="Logo" style="height: 40px; margin-top: 10px; margin-right: 14px;"
                           src="{{ asset('media/insightaccess.png') }}" class="logo-default responsive-logo " />
                   </div>
               </a>
               <!--end::Logo-->

               <!--begin::Header wrapper-->
               <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1"
                   id="kt_app_header_wrapper">

                   <!--begin::Menu wrapper-->
                   <div class=" app-header-menu app-header-mobile-drawer align-items-stretch" data-kt-drawer="true"
                       data-kt-drawer-name="app-header-menu" data-kt-drawer-activate="{default: true, lg: false}"
                       data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="end"
                       data-kt-drawer-toggle="#kt_app_header_menu_toggle" data-kt-swapper="true"
                       data-kt-swapper-mode="{default: 'append', lg: 'prepend'}"
                       data-kt-swapper-parent="{default: '#kt_app_body', lg: '#kt_app_header_wrapper'}">
                       <!--begin::Menu-->
                       <div class="menu menu-rounded menu-column menu-lg-row my-5  my-lg-0 align-items-stretch fw-semibold      px-2 px-lg-0        "
                           id="kt_app_header_menu" data-kt-menu="true">
                           <!--begin:Menu item-->

                           <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                               data-kt-menu-placement="bottom-start"
                               class="menu-item menu-lg-down-accordion menu-sub-lg-down-indention me-0 me-lg-2 {{ request()->is('dashboard*') ? 'here show' : '' }}">
                               <!--begin:Menu link-->
                               <span class="menu-link">
                                   <span class="menu-title">Dashboards</span>
                                   {{-- <span class="menu-arrow"></span> --}}
                               </span>
                               <!--end:Menu link-->

                               <!--begin:Menu sub-->
                               <div
                                   class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown px-lg-2 py-lg-4 w-lg-200px">
                                   <!-- Psychometric Assessment -->
                                   <div class="menu-item">
                                       <a href="/dashboard"
                                           class="menu-link {{ request()->is('dashboard/psychometric') ? 'active' : '' }}">
                                           <span class="menu-icon">
                                               <i class="bi bi-bar-chart"></i>
                                           </span>
                                           <span class="menu-title">Psychometric Assessment</span>
                                       </a>
                                   </div>

                                   <!-- Technical Assessment - Always visible for all employees -->
                                   <div class="menu-item">
                                       <a href="{{ route('technical.assessment.dashboard') }}" class="menu-link">
                                           <span class="menu-icon">
                                               <i class="bi bi-cpu"></i>
                                           </span>
                                           <span class="menu-title">Technical Assessment</span>
                                       </a>
                                   </div>
                               </div>
                               <!--end:Menu sub-->
                           </div>



                           @can('talentcore.talentacquisition.view')
                               <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                                   data-kt-menu-placement="bottom-start"
                                   class="menu-item menu-lg-down-accordion menu-sub-lg-down-indention me-0 me-lg-2">
                                   <!--begin:Menu link--><span class="menu-link"><span class="menu-title">Talent
                                           Acquisition</span>
                                       <span class="menu-arrow d-lg-none"></span>
                                   </span>
                                   <!--end:Menu link-->
                                   <!--begin:Menu sub-->
                                   <div
                                       class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown px-lg-2 py-lg-4 w-lg-250px">

                                       <div class="menu-item">
                                           <a class="menu-link" href="/admin/talent-acquisition/job-board"><span
                                                   class="menu-icon">
                                                   <iconify-icon icon="carbon:report" width="24"
                                                       height="24"></iconify-icon>
                                               </span><span class="menu-title">Job Board</span></a>

                                       </div>


                                       <div data-kt-menu-trigger="{default:'click', lg: 'hover'}"
                                           data-kt-menu-placement="right-start" class="menu-item menu-lg-down-accordion">
                                           <!--begin:Menu link--><span class="menu-link"><span class="menu-icon">
                                                   <iconify-icon icon="majesticons:users-line" width="24"
                                                       height="24"></iconify-icon>
                                               </span><span class="menu-title">Candidate Screening</span><span
                                                   class="menu-arrow"></span></span>
                                           <!--end:Menu link-->
                                           <!--begin:Menu sub-->
                                           <div
                                               class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-active-bg px-lg-2 py-lg-4 w-lg-225px">
                                               <!--begin:Menu item-->
                                               <!--begin:Menu item-->
                                               <div class="menu-item">
                                                   <a class="menu-link"
                                                       href="/admin/talent-acquisition/candidate-screening/upcoming-interview">

                                                       <span class="menu-icon"> <iconify-icon
                                                               icon="fluent:people-chat-24-regular" width="24"
                                                               height="24"></iconify-icon></span>

                                                       <span class="menu-title">Upcoming Interview</span>
                                                   </a>

                                               </div>
                                               <div class="menu-item">
                                                   <!--begin:Menu link-->
                                                   <a class="menu-link"
                                                       href="{{ route('admin.talent-acquisition.candidate-screening.interview-conduct.index') }}">
                                                       <span class="menu-icon"><iconify-icon
                                                               icon="fluent:people-chat-24-regular" width="24"
                                                               height="24"></iconify-icon></span>

                                                       <span class="menu-title">Interview Conducted</span></a>
                                               </div>

                                           </div>
                                           <!--end:Menu sub-->
                                       </div>

                                       {{-- <div class="menu-item">
                                               <!--begin:Menu link--><a class="menu-link"
                                                   href="/admin/talent-acquisition/advanced-comparison"><span
                                                       class="menu-icon">
                                                       <iconify-icon icon="pajamas:comparison" width="24"
                                                           height="24"></iconify-icon>
                                                   </span><span class="menu-title">Advanced Comparison</span></a>
                                               <!--end:Menu link-->
                                           </div> --}}

                                       <div class="menu-item">
                                           <a class="menu-link" href="{{ route('admin.interview-question.index') }}"><span
                                                   class="menu-icon">
                                                   <iconify-icon icon="wpf:survey" width="24"
                                                       height="24"></iconify-icon>

                                               </span><span class="menu-title">Interview Questions</span></a>
                                       </div>


                                       @if (!auth()->user()->isDepartment())
                                           @if (!auth()->user()->isDepartment())
                                               <div class="menu-item">

                                                   <a class="menu-link"
                                                       href="{{ route('admin.talent-acquisition.template-settings.index', ['page' => 'employee-contract']) }}"><span
                                                           class="menu-icon">
                                                           <iconify-icon icon="material-symbols:display-settings-outline"
                                                               width="24" height="24"></iconify-icon>
                                                       </span><span class="menu-title">Template & Settings</span>
                                                   </a>

                                               </div>
                                           @endif
                                       @endif

                                       <!--end:Menu item-->

                                   </div>
                                   <!--end:Menu sub-->
                               </div>
                           @endcan

                           @can('talentcore.talentmanagement.view')
                               <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                                   data-kt-menu-placement="bottom-start"
                                   class="menu-item menu-lg-down-accordion menu-sub-lg-down-indention me-0 me-lg-2">
                                   <span class="menu-link"><span class="menu-title">Talent
                                           Management</span><span class="menu-arrow d-lg-none"></span></span>
                                   <!--end:Menu link-->
                                   <!--begin:Menu sub-->
                                   <div
                                       class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown px-lg-2 py-lg-4 w-lg-250px">
                                       <!--begin:Menu item-->


                                       <div class="menu-item">
                                           <!--begin:Menu link--><a class="menu-link" href="/admin/talent/insight"><span
                                                   class="menu-icon">
                                                   <iconify-icon icon="ic:baseline-insights" width="24"
                                                       height="24"></iconify-icon>
                                               </span><span class="menu-title">Talent Insights</span></a>
                                           <!--end:Menu link-->
                                       </div>

                                       <div class="menu-item">
                                           <!--begin:Menu link--><a class="menu-link"
                                               href="/admin/talent-management/advanced-comparison"><span
                                                   class="menu-icon">
                                                   <iconify-icon icon="pajamas:comparison" width="24"
                                                       height="24"></iconify-icon>
                                               </span><span class="menu-title">Advanced Comparison</span></a>
                                           <!--end:Menu link-->
                                       </div>

                                       {{-- <div class="menu-item">
                                            <!--begin:Menu link--><a class="menu-link" href="/admin/myemployee/department-wise?department_id=63"><span class="menu-icon">
                                                
                                                    <iconify-icon icon="material-symbols:list"></iconify-icon>
                                                </span><span class="menu-title">PRD Listing</span></a>

                                            <!--end:Menu link-->
                                        </div> --}}

                                       <!--end:Menu item-->
                                   </div>
                                   <!--end:Menu sub-->
                               </div>
                           @endcan


                           @can('talentcore.jobmanagement.view')
                               <div class="menu-item">
                                   <!--begin:Menu link--><a class="menu-link" href="/admin/jobs/index">
                                       {{-- <iconify-icon icon="tabler:briefcase" width="24" height="24" class="fa-1-5"></iconify-icon> --}}
                                       </span><span class="menu-title">Job Management</span></a>
                                   <!--end:Menu link-->
                               </div>
                           @endcan
                           @can('talentcore.technicalskilllibrary.view')
                               <div class="menu-item">
                                   <!--begin:Menu link--><a class="menu-link"
                                       href="/admin/company/sector-skills?tab=joblevel"><span class="menu-title">Technical
                                           Skills Library</span></a>
                                   <!--end:Menu link-->
                               </div>
                           @endcan
                           @can('talentcore.settings.view')

                               <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                                   data-kt-menu-placement="bottom-start"
                                   class="menu-item menu-lg-down-accordion menu-sub-lg-down-indention me-0 me-lg-2">
                                   <!--begin:Menu link--><span class="menu-link"><span
                                           class="menu-title">Settings</span><span
                                           class="menu-arrow d-lg-none"></span></span>
                                   <!--end:Menu link-->
                                   <!--begin:Menu sub-->
                                   <div
                                       class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown px-lg-2 py-lg-4 w-lg-250px">
                                       <!--begin:Menu item-->



                                       <div data-kt-menu-trigger="{default:'click', lg: 'hover'}"
                                           data-kt-menu-placement="right-start" class="menu-item menu-lg-down-accordion">
                                           <!--begin:Menu link--><span class="menu-link"><span class="menu-icon">
                                                   {{-- <iconify-icon icon="hugeicons:hierarchy-square-02" width="24" height="24" class="fa-1-5"></iconify-icon> --}}
                                                   <iconify-icon icon="hugeicons:hierarchy-square-02" width="24"
                                                       height="24"></iconify-icon>
                                               </span><span class="menu-title">Organization Structure</span><span
                                                   class="menu-arrow"></span></span>
                                           <!--end:Menu link-->
                                           <!--begin:Menu sub-->
                                           <div
                                               class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-active-bg px-lg-2 py-lg-4 w-lg-225px">
                                               <!--begin:Menu item-->


                                               <!--end:Menu item-->
                                               <!--begin:Menu item-->
                                               @if (auth()->user()->role_id != 7)

                                                   @if (auth()->user()->isCompany() || auth()->user()->isAdmin())
                                                       <div class="menu-item">
                                                           <!--begin:Menu link--><a class="menu-link"
                                                               href="/admin/business"><span class="menu-icon">
                                                                   <iconify-icon icon="mdi:building" width="24"
                                                                       height="24" class="fa-1-5"></iconify-icon>
                                                               </span><span class="menu-title">Business
                                                                   Units</span></a>
                                                           <!--end:Menu link-->
                                                       </div>
                                                       <div class="menu-item">
                                                           <a class="menu-link" href="/admin/division">
                                                               <span class="menu-icon">
                                                                   <iconify-icon icon="mdi:building" width="24"
                                                                       height="24" class="fa-1-5"></iconify-icon>
                                                               </span>
                                                               <span class="menu-title">Companies/Divisions</span></a>
                                                           <!--end:Menu link-->
                                                       </div>
                                                       <div class="menu-item">
                                                           <!--begin:Menu link--><a class="menu-link"
                                                               href="/admin/mydepartment"><span class="menu-icon">

                                                                   <iconify-icon icon="mdi:building" width="24"
                                                                       height="24" class="fa-1-5"></iconify-icon>
                                                               </span><span class="menu-title">Departments</span></a>
                                                           <!--end:Menu link-->
                                                       </div>

                                                       @if (config('client.' . env('APP_BRANCH') . '.custom_org_menu'))
                                                           <div class="menu-item">
                                                               <!--begin:Menu link-->
                                                               <a class="menu-link"
                                                                   href="{{ route('department_sections.index') }}">
                                                                   <span class="menu-icon">
                                                                       <iconify-icon icon="mdi:building" width="24"
                                                                           height="24"></iconify-icon>
                                                                   </span>
                                                                   <span class="menu-title">Sections</span>
                                                               </a>
                                                               <!--end:Menu link-->
                                                           </div>

                                                           <div class="menu-item">
                                                               <!--begin:Menu link-->
                                                               <a class="menu-link"
                                                                   href="{{ route('section_units.index') }}">
                                                                   <span class="menu-icon">
                                                                       <iconify-icon icon="mdi:building" width="24"
                                                                           height="24"></iconify-icon>
                                                                   </span>
                                                                   <span class="menu-title">Units</span>
                                                               </a>
                                                               <!--end:Menu link-->
                                                           </div>

                                                           <div class="menu-item">
                                                               <!--begin:Menu link--><a class="menu-link"
                                                                   href="{{ route('admin.teams.index') }}"><span
                                                                       class="menu-icon">
                                                                       <iconify-icon
                                                                           icon="streamline-ultimate:human-resources-hierarchy-1"
                                                                           width="24" height="24"></iconify-icon>
                                                                   </span><span class="menu-title">Teams</span></a>
                                                               <!--end:Menu link-->
                                                           </div>
                                                       @endif
                                                   @endif
                                                   {{-- @can('user_management_read') --}}
                                                   <!--end:Menu item-->
                                                   @if (auth()->user()->role_id != 12)
                                                       {{-- <div class="menu-item">
                                                               <!--begin:Menu link--><a class="menu-link"
                                                                   href="{{ route('admin.teams.index') }}"><span
                                                                       class="menu-icon">
                                                                       <iconify-icon icon="streamline-ultimate:human-resources-hierarchy-1" width="24" height="24" class="fa-1-5"></iconify-icon>
                                                                   </span><span class="menu-title">Teams</span></a>
                                                               <!--end:Menu link-->
                                                           </div> --}}


                                                       {{-- <div class="menu-item">
                                                                <!--begin:Menu link--><a class="menu-link" href="/admin/position"><span class="menu-icon">
                                                                        <iconify-icon icon="mdi:company" class="fa-1-5"></iconify-icon>
                                                                    </span><span
                                                                        class="menu-title">Positions</span></a>
                                                                <!--end:Menu link-->
                                                            </div> --}}
                                                       <!--begin:Menu item-->




                                                       @if (auth()->user()->role_id == 2 && config('client.' . env('APP_BRANCH') . '.custom_org_menu'))
                                                           <div class="menu-item">
                                                               <!--begin:Menu link--><a class="menu-link"
                                                                   href="/admin/myemployee/manager"><span
                                                                       class="menu-icon">
                                                                       <iconify-icon icon="hugeicons:manager"
                                                                           width="24" height="24"></iconify-icon>
                                                                   </span><span class="menu-title">PM &
                                                                       CM</span></a>
                                                               <!--end:Menu link-->
                                                           </div>
                                                       @endif
                                                   @endif
                                               @endif

                                               {{-- @endcan --}}


                                               <!--end:Menu item-->
                                               <!--begin:Menu item-->


                                               <!--end:Menu item-->
                                               <!--begin:Menu item-->

                                           </div>
                                           <!--end:Menu sub-->
                                       </div>

                                       <div class="menu-item">
                                           <!--begin:Menu link--><a class="menu-link" href="/admin/myemployee"><span
                                                   class="menu-icon">

                                                   <iconify-icon icon="ph:users-three" width="24"
                                                       height="24"></iconify-icon>
                                               </span><span class="menu-title">Employee List</span></a>
                                           <!--end:Menu link-->
                                       </div>

                                       <div class="menu-item">
                                           <a class="menu-link" href="/admin/organizational-structure"><span
                                                   class="menu-icon">
                                                   <iconify-icon icon="hugeicons:hierarchy-square-02" width="24"
                                                       height="24" class="fa-1-5"></iconify-icon>
                                               </span><span class="menu-title">Chart</span></a>
                                       </div>




                                       {{-- @endcan --}}

                                       {{-- @if (auth()->user()->role_id != 12)
                                               <div class="menu-item">
                                                   <!--begin:Menu link--><a class="menu-link"
                                                       href="/admin/jobs/index"><span class="menu-icon">
                                                          <iconify-icon icon="tabler:briefcase" width="24" height="24" class="fa-1-5"></iconify-icon>
                                                       </span><span class="menu-title">Job Management</span></a>
                                                   <!--end:Menu link-->
                                               </div>
                                           @endif --}}
                                       {{-- <div class="menu-item">
                                               <!--begin:Menu link--><a class="menu-link"
                                                   href="/admin/company/sector-skills?tab=joblevel"><span
                                                       class="menu-icon">
                                                       <iconify-icon icon="ion:library-outline" width="24" height="24" class="fa-1-5"></iconify-icon>
                                                   </span><span class="menu-title">Technical Skills Library</span></a>
                                               <!--end:Menu link-->
                                           </div> --}}
                                       @can('user_management_read')
                                           {{-- <div class="menu-item">
                                                   <a class="menu-link" href="/admin/meta-settings"><span
                                                           class="menu-icon">
                                                           <iconify-icon icon="tdesign:chart-combo" width="24" height="24" class="fa-1-5"></iconify-icon>
                                                       </span><span class="menu-title">PMS Management</span></a>
                                               </div> --}}
                                           {{-- <div data-kt-menu-trigger="{default:'click', lg: 'hover'}"
                                                   data-kt-menu-placement="right-start"
                                                   class="menu-item menu-lg-down-accordion">
                                                   <!--begin:Menu link--><span class="menu-link"><span class="menu-icon">

                                                           <iconify-icon icon="tabler:tools" width="24"
                                                               height="24"></iconify-icon>
                                                       </span><span class="menu-title">Admin Tools</span><span
                                                           class="menu-arrow"></span></span>
                                                   <!--end:Menu link-->
                                                   <!--begin:Menu sub-->
                                                   <div
                                                       class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown px-lg-2 py-lg-4 w-lg-250px">
                                                       <div class="menu-item">
                                                           <a class="menu-link" href="{{ route('survey.index') }}"><span
                                                                   class="menu-icon">
                                                                   <iconify-icon icon="ri:survey-line" width="24"
                                                                       height="24" class="fa-1-5"></iconify-icon>
                                                               </span><span class="menu-title">Survey</span></a>
                                                       </div>

                                                       <div class="menu-item">
                                                           <a class="menu-link"
                                                               href="{{ route('technicalAss.index') }}"><span
                                                                   class="menu-icon">
                                                                   <iconify-icon
                                                                       icon="material-symbols:edit-document-outline-rounded"
                                                                       width="24" height="24"
                                                                       class="fa-1-5"></iconify-icon>
                                                               </span><span class="menu-title">Technical
                                                                   Assessment</span></a>
                                                       </div>
                                                   </div>
                                               </div> --}}

                                           {{-- <div class="menu-item">
                                                   <a class="menu-link" href="{{ route('leave.index') }}"><span
                                                           class="menu-icon">
                                                          <iconify-icon icon="mdi:calendar-outline" width="24" height="24" class="fa-1-5"></iconify-icon>

                                                       </span><span class="menu-title">Leave Management</span></a>
                                               </div>

                                               <div class="menu-item">
                                                   <a class="menu-link" href="{{ route('allowance.index') }}"><span
                                                           class="menu-icon">
                                                           <iconify-icon icon="tdesign:money" width="24" height="24" class="fa-1-5"></iconify-icon>

                                                       </span><span class="menu-title">Allowance Management</span></a>
                                               </div> --}}

                                           <!-- <div class="menu-item">
                                                                                        <a class="menu-link" href="{{ route('descriptors.index') }}"><span
                                                                                                class="menu-icon">
                                                                                                <iconify-icon icon="eos-icons:job" class="fa-1-5"></iconify-icon>

                                                                                            </span><span class="menu-title">Master Descriptors</span></a>
                                                                                    </div> -->

                                           {{-- <div class="menu-item">
                                                   <a class="menu-link" href="{{ route('general_setting.index') }}"><span
                                                           class="menu-icon">
                                                           <iconify-icon icon="lets-icons:setting-line" width="24"
                                                               height="24" class="fa-1-5"></iconify-icon>

                                                       </span><span class="menu-title">General Settings</span></a>
                                               </div> --}}
                                       @endcan


                                   </div>
                                   <!--end:Menu sub-->
                               </div>

                           @endcan
                       </div>
                       <!--end::Menu-->
                   </div>
                   <!--end::Menu wrapper-->


                   <!--begin::Navbar-->
                   <div class="app-navbar flex-shrink-0">



                       <!--begin::User menu-->
                       <div class="app-navbar-item ms-1 ms-md-4" id="kt_header_user_menu_toggle">
                           <!--begin::Menu wrapper-->
                           <div class="cursor-pointer symbol symbol-35px"
                               data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent"
                               data-kt-menu-placement="bottom-end">
                               @if (isset(auth()->user()->profile_picture))
                                   <img src="{{ asset(auth()->user()->profile_picture) }}" class="rounded-3"
                                       onerror="this.src='{{ asset('images/default-user.svg') }}'" />
                               @else
                                   <img src="{{ asset('images/default-user.svg') }}" class="rounded-3"
                                       alt="user" />
                               @endif

                           </div>

                           <!--begin::User account menu-->
                           <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px"
                               data-kt-menu="true">
                               <!--begin::Menu item-->
                               <div class="menu-item px-3">
                                   <div class="menu-content d-flex align-items-center px-3">
                                       <!--begin::Avatar-->
                                       <div class="symbol symbol-50px me-5">
                                           @if (isset(auth()->user()->profile_picture))
                                               <img alt="Logo" src="{{ asset(auth()->user()->profile_picture) }}"
                                                   onerror="this.src='{{ asset('images/default-user.svg') }}'" />
                                           @else
                                               <img alt="Logo" src="{{ asset('images/default-user.svg') }}" />
                                           @endif
                                       </div>
                                       <!--end::Avatar-->

                                       <!--begin::Username-->
                                       <div class="d-flex flex-column">
                                           <div class="fw-bold d-flex align-items-center fs-5">
                                               {{ auth()->user()->name ?? '' }}
                                               {{-- <span class="badge badge-light-success fw-bold fs-8 px-2 py-1 ms-2">Pro</span> --}}
                                           </div>

                                           <a href="" class="fw-semibold text-muted  fs-7 text-break">
                                               {{ auth()->user()->email ?? '' }}</a>
                                       </div>

                                       <!--end::Username-->
                                   </div>
                                   <li>
                                       <a class="dropdown-item py-2" href="{{ route('hubcenter.dashboard') }}"
                                           target="_blank">
                                           <i class="bi bi-arrow-left-circle me-2"></i> Route back to Insight Hub
                                       </a>
                                   </li>
                                   <li>
                                       <hr class="dropdown-divider my-0">
                                   </li>
                                   <li>
                                       <form method="POST" action="{{ route('logout') }}">
                                           @csrf
                                           <button type="submit" class="dropdown-item py-2 text-danger">
                                               <i class="bi bi-box-arrow-right me-2"></i> Logout
                                           </button>
                                       </form>
                                   </li>
                               </div>
                               <!--end::Menu item-->



                           </div>
                           <!--end::User account menu-->

                           <!--end::Menu wrapper-->
                       </div>
                       <!--end::User menu-->

                       <!--begin::Header menu toggle-->
                       <div class="app-navbar-item d-lg-none ms-2 me-n2" title="Show header menu">
                           <div class="btn btn-flex btn-icon btn-active-color-primary w-30px h-30px"
                               id="kt_app_header_menu_toggle">

                               <iconify-icon icon="lets-icons:menu" class="fa-1-5"></iconify-icon>
                           </div>
                       </div>
                       <!--end::Header menu toggle-->

                       <!--begin::Aside toggle-->
                       <!--end::Header menu toggle-->
                   </div>
                   <!--end::Navbar-->
               </div>
               <!--end::Header wrapper-->
           </div>
           <!--end::Header container-->
       </div>

       <!--end::Header-->
