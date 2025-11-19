<div class="mb-0" id="home">
    <div class="bgi-no-repeat bgi-size-contain bgi-position-x-center bgi-position-y-bottom landing-dark-bg"
        style="background-image: url(media/svg/illustrations/landing.svg)">
        <div class="landing-header bg-white" data-kt-sticky="true" data-kt-sticky-name="landing-header"
            data-kt-sticky-offset="{default: '200px', lg: '300px'}" style="height: 64px !important;">
            <div class="container">
                <div class="d-flex align-items-center justify-content-between">
                    <!--begin::Logo-->
                    <div class="d-flex align-items-center flex-equal">
                        <!--begin::Mobile menu toggle-->
                        <button
                            class="btn btn-icon btn-active-color-primary me-3 d-flex d-lg-none justify-content-between"
                            id="kt_landing_menu_toggle">
                            <iconify-icon icon="typcn:th-menu-outline" class="fs-2tx"></iconify-icon>
                        </button>
                        <!--end::Mobile menu toggle-->

                        <!--begin::Logo image-->
                        <a href="/">
                            <img alt="Logo" src="{{ asset('media/insightaccess.png') }}"
                                class="logo-default responsive-logo " style="height: 50px" />
                            <img alt="Logo" src="{{ asset('media/insightaccess.png') }}"
                                class="logo-sticky responsive-logo " style="height: 50px" />
                        </a>
                        <!--end::Logo image-->
                    </div>
                    <!--end::Logo-->

                    <!--begin::Menu wrapper-->
                    <div class="d-lg-block mr-4" id="kt_header_nav_wrapper">
                        <div class="d-lg-block p-5 p-lg-0" data-kt-drawer="true" data-kt-drawer-name="landing-menu"
                            data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
                            data-kt-drawer-width="200px" data-kt-drawer-direction="start"
                            data-kt-drawer-toggle="#kt_landing_menu_toggle" data-kt-swapper="true"
                            data-kt-swapper-mode="prepend"
                            data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav_wrapper'}">

                            <!--begin::Menu-->
                            <div class="menu menu-column flex-nowrap menu-rounded menu-lg-row menu-title-gray-600 menu-state-title-primary nav nav-flush fs-5 fw-semibold"
                                id="kt_landing_menu">
                                <!--begin::Menu item-->
                                <div class="menu-item">
                                    <!--begin::Menu link-->
                                    <a class="menu-link nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
                                        href="{{ route('home') }}">
                                        Home
                                    </a>
                                    <!--end::Menu link-->
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item">
                                    <!--begin::Menu link-->
                                    <a class="menu-link nav-link" href="/#how-it-works"
                                        data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">
                                        How it Works </a>
                                    <!--end::Menu link-->
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item">
                                    <!--begin::Menu link-->
                                    <a class="menu-link nav-link {{ request()->routeIs('all-jobs') ? 'active' : '' }}"
                                        href="{{ route('all-jobs') }}">
                                        Careers
                                    </a>
                                    <!--end::Menu link-->
                                </div>
                            </div>
                            <!--end::Menu-->
                        </div>
                    </div>
                    <!--end::Menu wrapper-->

                    <!--begin::Toolbar-->
                    <div class="text-end ms-1 d-flex gap-2">
                        @if (auth()->user())
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
                                                    <img alt="Logo"
                                                        src="{{ asset(auth()->user()->profile_picture) }}"
                                                        onerror="this.src='{{ asset('images/default-user.svg') }}'" />
                                                @else
                                                    <img alt="Logo"
                                                        src="{{ asset('images/default-user.svg') }}" />
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
                                    </div>
                                    <!--end::Menu item-->

                                    <!--begin::Menu separator-->
                                    <div class="separator my-2"></div>
                                    <!--end::Menu separator-->

                                    <!--begin::Menu item-->
                                    @if (auth()->user()->role_id == 10)
                                        @if (auth()->user()->is_all_steps_completed == 1)
                                            <div class="menu-item px-5">

                                                <a href="{{ route('user.about.me', ['step' => 1]) }}"
                                                    class="menu-link px-5">
                                                    About Me
                                                </a>

                                            </div>
                                            <div class="menu-item px-5">

                                                <a href="{{ route('applications') }}" class="menu-link px-5">
                                                    Applications
                                                </a>

                                            </div>

                                            <div class="menu-item px-5">

                                                <a href="{{ route('bookmark-jobs') }}" class="menu-link px-5">
                                                    Saved Jobs
                                                </a>

                                            </div>
                                        @else
                                            <div class="menu-item px-5">
                                                <a href="{{ route('user.about.me', ['step' => config('helpers.steps_completed')[auth()->user()->steps_completed + 1]]) }}"
                                                    class="menu-link px-5">
                                                    About Me
                                                </a>
                                            </div>
                                        @endif
                                    @elseif(auth()->user()->isAdmin())
                                        <div class="menu-item px-5">
                                            <a href="/admin/dashboard" class="menu-link px-5">
                                                Dashboard
                                            </a>
                                        </div>
                                    @else
                                    @if(auth()->user()->role_id ==8)
                                        <div class="menu-item px-5">
                                            <a href="/dashboard" class="menu-link px-5">
                                                Dashboard
                                            </a>
                                        </div>
                                        @else
                                        <div class="menu-item px-5">
                                            <a href="/dashboard" class="menu-link px-5">
                                                Dashboard
                                            </a>
                                        </div>
                                        @endif
                                        <div class="menu-item px-5">

                                            <a href="{{ route('user.about.me', ['step' => 1]) }}"
                                                class="menu-link px-5">
                                                About Me
                                            </a>

                                        </div>
                                        <div class="menu-item px-5">

                                            <a href="{{ route('applications') }}" class="menu-link px-5">
                                                Applications
                                            </a>

                                        </div>
                                        <div class="menu-item px-5">

                                            <a href="{{ route('bookmark-jobs') }}" class="menu-link px-5">
                                                Saved Jobs
                                            </a>

                                        </div>
                                    @endif
                                    <!--end::Menu item-->
                                    <div class="menu-item px-5">
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();"
                                            class="menu-link px-5">
                                            Sign Out
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                        </form>
                                    </div>

                                </div>
                                <!--end::User account menu-->

                                <!--end::Menu wrapper-->
                            </div>
                        @else
                            <a href="{{ route('register') }}" class="custom-btn btn-orange-fill cursor-pointer">
                                Sign Up
                            </a>
                            <a href="{{ route('login') }}" class="custom-btn btn-orange-outline cursor-pointer">
                                <iconify-icon icon="humbleicons:user" width="20" height="20"
                                    style="color: #F7941C; width: 20px;"></iconify-icon>Log In
                            </a>
                        @endif
                    </div>
                    <!--end::Toolbar-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Header-->
    </div>
    <!--end::Wrapper-->
</div>
