       <!--begin::Header-->

       <div id="kt_app_header" class="app-header" data-kt-sticky="true" data-kt-sticky-activate="{default: true, lg: true}"
           data-kt-sticky-name="app-header-minimize" data-kt-sticky-offset="{default: '200px', lg: '0'}" data-kt-s 
           class="d-flex gap-3 align-items-center">
           <img alt="Logo" style="height: 40px; margin-top: 10px; margin-right: 14px;"
               src="{{ asset('media/insightaccess.png') }}" class="logo-default responsive-logo " />mation="false">
           <div class="app-container container-xxl d-flex align-items-stretch justify-content-between"
               id="kt_app_header_container">
               <a href="/admin/dashboard">
                   <div class="d-flex gap-3 align-items-center"style="margin-top: 12px;">
                       <img alt="Logo" style="height: 40px;" src="{{ asset('media/insightaccess.png') }}"
                           class="logo-default responsive-logo " />
                   </div>
               </a>
               <div class=" app-header-menu app-header-mobile-drawer align-items-stretch" data-kt-drawer="true"
                   data-kt-drawer-name="app-header-menu" data-kt-drawer-activate="{default: true, lg: false}"
                   data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="end"
                   data-kt-drawer-toggle="#kt_app_header_menu_toggle" data-kt-swapper="true"
                   data-kt-swapper-mode="{default: 'append', lg: 'prepend'}"
                   data-kt-swapper-parent="{default: '#kt_app_body', lg: '#kt_app_header_wrapper'}">
                   <div class="menu menu-rounded menu-column menu-lg-row my-5  my-lg-0 align-items-stretch fw-semibold      px-2 px-lg-0        "
                       id="kt_app_header_menu" data-kt-menu="true">
                   </div>
               </div>
               <div class="app-navbar flex-shrink-0">
                   <div class="app-navbar-item ms-1 ms-md-4">
                       <div class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-35px h-35px"
                           id="kt_activities_toggle">
                           <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"
                               class="menu-link px-5 text-gray-600">
                               <iconify-icon icon="quill:off" class="fa-1-5"></iconify-icon>
                           </a>
                           <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                               @csrf
                           </form>
                       </div>
                   </div>
                   <div class="app-navbar-item ms-1 ms-md-4" id="kt_header_user_menu_toggle">
                       <div class="cursor-pointer symbol symbol-35px"
                           data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent"
                           data-kt-menu-placement="bottom-end">
                           @if (isset(auth()->user()->profile_picture))
                               <img src="{{ asset(auth()->user()->profile_picture) }}" class="rounded-3"
                                   onerror="this.src='{{ asset('images/default-user.svg') }}'" />
                           @else
                               <img src="{{ asset('images/default-user.svg') }}" class="rounded-3" alt="user" />
                           @endif

                       </div>
                       <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px"
                           data-kt-menu="true">
                           {{-- <div class="menu-item px-3">
                               <div class="menu-content d-flex align-items-center px-3">
                                   <div class="symbol symbol-50px me-5">
                                       @if (isset(auth()->user()->profile_picture))
                                           <img alt="Logo" src="{{ asset(auth()->user()->profile_picture) }}"
                                               onerror="this.src='{{ asset('images/default-user.svg') }}'" />
                                       @else
                                           <img alt="Logo" src="{{ asset('images/default-user.svg') }}" />
                                       @endif
                                   </div>
                                   <div class="d-flex flex-column">
                                       <div class="fw-bold d-flex align-items-center fs-5">
                                           {{ auth()->user()->name ?? '' }}
                                       </div>

                                       <a href="" class="fw-semibold text-muted  fs-7 text-break">
                                           {{ auth()->user()->email ?? '' }}</a>
                                   </div>
                               </div>
                           </div> --}}
                           <!--end::Menu item-->

                           <!--begin::Menu separator-->
                           {{-- <div class="separator my-2"></div> --}}
                           <!--end::Menu separator-->

                           <!--begin::Menu item-->
                           <div class="menu-item px-5">
                                @if (auth()->check())
                                    @if (auth()->user()->isDepartment())
                                        <a href="/department/profile/edit" class="menu-link px-5">
                                            My Profile
                                        </a>
                                    @elseif(auth()->user()->isCompany() || auth()->user()->isAdmin())
                                        <a href="/company/profile/edit" class="menu-link px-5">
                                            My Profile
                                        </a>
                                    @else
                                        @if (auth()->user()->role_id != 7)
                                            <a href="/profile/edit" class="menu-link px-5">
                                                My Profile
                                            </a>
                                        @endif
                                    @endif
                                @endif
                            </div>

                           <!--end::Menu item-->

                       </div>
                       <!--end::User account menu-->

                       <!--end::Menu wrapper-->
                   </div>
                   <!--end::User menu-->

                   <!--begin::Header menu toggle-->
                   <div class="app-navbar-item  ms-2 me-n2" title="Show header menu">
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
           <!--end::Header container-->
       </div>
       <div id="kt_app_header" class="app-header " data-kt-sticky="true"
           data-kt-sticky-activate="{default: true, lg: true}" data-kt-sticky-name="app-header-minimize"
           data-kt-sticky-offset="{default: '200px', lg: '0'}" data-kt-sticky-animation="false">

           <!--begin::Header container-->
           <div class="app-container  container-xxl d-flex align-items-stretch justify-content-between "
               style="padding-left: 30px !important; padding-right: 30px !important; margin: 0 auto !important;"
               id="kt_app_header_container">


               <a href="/admin/dashboard">
                   <div class="d-flex gap-3 align-items-center">
                       {{-- <img alt="Logo" style="height: 50px;" src="{{ asset('media/EEI-Corporation-Logo.png') }}"
                    class="logo-default responsive-logo w-auto" /> --}}
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
                               class="menu-item {{ request()->is('insighthub') ? 'here' : '' }}">
                               <a href="/insighthub" class="menu-link">
                                   <span class="menu-title">Hub Center</span>
                               </a>
                           </div>


                           <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                               data-kt-menu-placement="bottom-start"
                               class="menu-item menu-lg-down-accordion menu-sub-lg-down-indention me-0 me-lg-2 {{ request()->is('analytic*') ? 'here' : '' }}">
                               <span class="menu-link">
                                   <span class="menu-title">Analytics</span>
                                   <span class="menu-arrow "></span>
                               </span>
                               <div
                                   class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown px-lg-2 py-lg-4 w-lg-250px">
                                   <div class="menu-item">
                                  
                                        @can('insighthub.analytics.dashboard.view')
                                            <a class="menu-link analytics-link {{ request()->is('analytic/dashboard') ? 'active' : '' }}" href="/analytic/dashboard">
                                                <span class="menu-title">Dashboard</span>
                                            </a>
                                        @endcan
                                   </div>

                                        @can('insighthub.analytics.chatbot.view')

                                   <div class="menu-item">
                                        <a class="menu-link analytics-link {{ request()->is('analytic/chatbot') ? 'active' : '' }}" 
                                           href="/analytic/chatbot"><span class="menu-title">Chatbot</span></a>
                                   </div>
                                        @endcan





                                   <!--end:Menu item-->

                               </div>
                               <!--end:Menu sub-->
                           </div>
                           {{-- @endcan --}}
                           <div class="menu-item {{ request()->is('subsidiaries') ? 'here' : '' }}">
                               <!--begin:Menu link--><a class="menu-link" href="/subsidiaries">
                                   {{-- <iconify-icon icon="tabler:briefcase" width="24" height="24" class="fa-1-5"></iconify-icon> --}}
                                   </span><span class="menu-title">Subsidiaries</span></a>
                               <!--end:Menu link-->
                           </div>


                           {{-- @if (!auth()->user()->role_id == 7) --}}
                           @if (auth()->check() && !auth()->user()->isDepartment()) 
                               <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                                   data-kt-menu-placement="bottom-start"
                                   class="menu-item menu-lg-down-accordion menu-sub-lg-down-indention me-0 me-lg-2">
                                   <!--begin:Menu link--><span class="menu-link"><span
                                           class="menu-title">Settings</span><span
                                           class="menu-arrow"></span></span>
                                   <!--end:Menu link-->
                                   <!--begin:Menu sub-->
                                   <div
                                       class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown px-lg-2 py-lg-4 w-lg-250px">
                                       <div class="menu-item">
                                           <a class="menu-link" href="/insighthub/settings/user-management">
                                               <span class="menu-title">User Management</span>
                                           </a>
                                       </div>


                                       <div class="menu-item">
                                           <a class="menu-link"
                                               href="{{ route('insighthub.role-management.index') }}"><span class="menu-title">Role Management</span></a>
                                       </div>

                                       <div class="menu-item">
                                           <a class="menu-link"
                                               href="{{ route('company-profile.index') }}"><span class="menu-title">General Settings</span></a>
                                       </div>

                                       {{-- <div class="menu-item">
                                           <a class="menu-link"
                                               href="{{ route('account.index') }}"><span class="menu-title">Account Management</span></a>
                                       </div> --}}





                                       <!--end:Menu item-->

                                   </div>
                                   <!--end:Menu sub-->
                               </div>
                           @endif
                           {{-- @endif --}}




                       </div>
                       <!--end::Menu-->
                   </div>
                   <!--end::Menu wrapper-->


                   <!--begin::Navbar-->
                   <div class="app-navbar flex-shrink-0">




                       <div class="app-navbar-item ms-1 ms-md-4">
                           <!--begin::Drawer toggle-->
                           <div class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-35px h-35px"
                               id="kt_activities_toggle">
                               <a href="{{ route('logout') }}" id="custom-logout-button"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                   class="menu-link px-5 text-gray-600">
                                   <iconify-icon icon="quill:off" class="fa-1-5"></iconify-icon>
                               </a>
                           </div>
                           <!--end::Drawer toggle-->
                       </div>
                       <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                           @csrf
                       </form>


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
                               {{-- <div class="menu-item px-3">
                                   <div class="menu-content d-flex align-items-center px-3">
                                       <div class="symbol symbol-50px me-5">
                                           @if (isset(auth()->user()->profile_picture))
                                               <img alt="Logo" src="{{ asset(auth()->user()->profile_picture) }}"
                                                   onerror="this.src='{{ asset('images/default-user.svg') }}'" />
                                           @else
                                               <img alt="Logo" src="{{ asset('images/default-user.svg') }}" />
                                           @endif
                                       </div>
                                       <div class="d-flex flex-column">
                                           <div class="fw-bold d-flex align-items-center fs-5">
                                               {{ auth()->user()->name ?? '' }}
                                           </div>

                                           <a href="" class="fw-semibold text-muted  fs-7 text-break">
                                               {{ auth()->user()->email ?? '' }}</a>
                                       </div>
                                   </div>
                               </div> --}}
                               <!--end::Menu item-->

                               <!--begin::Menu separator-->
                               {{-- <div class="separator my-2"></div> --}}
                               <!--end::Menu separator-->

                               <!--begin::Menu item-->
                               <div class="menu-item px-5">
                                @if (auth()->check())
                                   @if (auth()->user()->isDepartment())
                                       <a href="/department/profile/edit" class="menu-link px-5">
                                           My Profile
                                       </a>
                                   @elseif(auth()->user()->isCompany() || auth()->user()->isAdmin())
                                       <a href="/company/profile/edit" class="menu-link px-5">
                                           My Profile
                                       </a>
                                   @else
                                       @if (auth()->user()->role_id != 7)
                                           <a href="/profile/edit" class="menu-link px-5">
                                               My Profile
                                           </a>
                                       @endif
                                   @endif
                                @endif
                                <div class="menu-item">
                                           <a class="menu-link"
                                               href="{{ route('account.index') }}"><span class="menu-title">Account Management</span></a>
                                       </div>
                               </div>
                               <!--end::Menu item-->

                           </div>
                           <!--end::User account menu-->

                           <!--end::Menu wrapper-->
                       </div>
                       <!--end::User menu-->
                   </div>
               </div>
           </div>
       </div>
