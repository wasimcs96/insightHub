<div class="sidebar-wrapper group w-0 hidden xl:w-[248px] xl:block">
    <div id="bodyOverlay"
        class="w-screen h-screen fixed top-0 bg-slate-900 bg-opacity-50 backdrop-blur-sm z-10 hidden"></div>
    <div class="logo-segment">
        <a class="flex items-center" href="/dashboard">


            <img src="{{asset('images/CXS-Logo.png')}}" width="50px" class="black_logo" alt="logo">
            {{-- <img src="assets/images/logo/logo-c-white.svg" class="white_logo" alt="logo"> --}}
            <span
                class="ltr:ml-3 rtl:mr-3 text-xl font-Inter font-bold text-slate-900 dark:text-white"> CXS</span>
        </a>
        <!-- Sidebar Type Button -->
        <div id="sidebar_type" class="cursor-pointer text-slate-900 dark:text-white text-lg">
            <iconify-icon class="sidebarDotIcon extend-icon text-slate-900 dark:text-slate-200"
                icon="fa-regular:dot-circle"></iconify-icon>
            <iconify-icon class="sidebarDotIcon collapsed-icon text-slate-900 dark:text-slate-200"
                icon="material-symbols:circle-outline"></iconify-icon>
        </div>
        <button class="sidebarCloseIcon text-2xl inline-block md:hidden">
            <iconify-icon class="text-slate-900 dark:text-slate-200"
                icon="clarity:window-close-line"></iconify-icon>
        </button>
    </div>
    <div id="nav_shadow"
        class="nav_shadow h-[60px] absolute top-[80px] nav-shadow z-[1] w-full transition-all duration-200 pointer-events-none  opacity-0">
    </div>
    <div class="sidebar-menus bg-white dark:bg-slate-800 py-2 px-4 h-[calc(100%-80px)] z-50" id="sidebar_menus">
        <ul class="sidebar-menu">
            <li class="sidebar-menu-title">MENU</li>
            <li class="{{ (request()->is('dashboard')) ? 'active' : '' }}">
                <a href="/dashboard" class="navItem">
                  <span class="flex items-center">
                    <iconify-icon class="nav-icon" icon="carbon:dashboard"></iconify-icon>
                    <span>Dashboard</span>
                  </span>
                </a>
              </li>
              <li class="{{ (request()->is('about-me')) ? 'active' : '' }}">
                <a href="/about-me" class="navItem">
                  <span class="flex items-center">
                    <iconify-icon class=" nav-icon" icon="heroicons-outline:identification"></iconify-icon>
                    <span>About Me</span>
                  </span>
                </a>
              </li>

              <li class="{{ (request()->is('settings')) ? 'active' : '' }}">
                <a href="/settings" class="navItem">
                  <span class="flex items-center">
                    <iconify-icon class=" nav-icon" icon="mdi:gear"></iconify-icon>
                    <span>Settings</span>
                  </span>
                </a>
              </li>

              <li class="{{ (request()->is('learning-management-system')) ? 'active' : '' }}">
                <a href="/learning-management-system" class="navItem">
                  <span class="flex items-center">
                    <iconify-icon class=" nav-icon" icon="mdi:book-outline"></iconify-icon>
                    <span>LMS </span>
                  </span>
                </a>
              </li>

              <li class="{{ (request()->is('job_portal')) ? 'active' : '' }}">
                <a href="#" class="navItem">
                  <span class="flex items-center">
                    {{-- <iconify-icon class=" nav-icon" icon="mdi:book-outline"></iconify-icon> --}}
                    <iconify-icon class=" nav-icon" icon="ri:search-line"></iconify-icon>
                    <span>Performance Management (Coming Soon)</span>
                  </span>
                </a>
              </li>
            {{-- <li class="{{ (request()->is('admin/report*')) ? 'active' : '' }}">
                <a href="#" class="navItem">
                    <span class="flex items-center">
                        <iconify-icon class=" nav-icon" icon="heroicons-outline:chart-bar-square"></iconify-icon>
                        <span>Select Report</span>
                    </span>
                    <iconify-icon class="icon-arrow" icon="heroicons-outline:chevron-right"></iconify-icon>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{route('individual.report')}}" class="{{ (request()->is('admin/report/individual*')) ? 'active' : '' }}">Individual Report</a>
                    </li>
                    <li>
                        <a href="{{route('ocean.riasec.report')}}" class="{{ (request()->is('admin/report/ocean/riasec*')) ? 'active' : '' }}">Ocean and Riasec Report</a>
                    </li>
                    <li>
                        <a href="{{route('population.report')}}" class="{{ (request()->is('admin/report/population*')) ? 'active' : '' }}">Population Report
                        </a>
                    </li>

                </ul>
            </li> --}}
        </ul>
        <!-- Upgrade Your Business Plan Card Start -->
        {{-- <div class="bg-slate-900 mb-10 mt-24 p-4 relative text-center rounded-2xl text-white"
            id="sidebar_bottom_wizard">
            <img src="{{asset('admin/assets/images/svg/rabit.svg')}}" alt="" class="mx-auto relative -mt-[73px]">
            <div class="max-w-[160px] mx-auto mt-6">
                <div class="widget-title font-Inter mb-1">Prototype</div>
                <div class="text-xs font-light font-Inter">
                   Comming soon with more and advance features
                </div>
            </div>
            <div class="mt-6">
                <button
                    class="bg-white hover:bg-opacity-80 text-slate-900 text-sm font-Inter rounded-md w-full block py-2 font-medium">
                    Thank you
                </button>
            </div>
        </div> --}}
        <!-- Upgrade Your Business Plan Card Start -->
    </div>
</div>
