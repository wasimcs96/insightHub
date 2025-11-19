                <!-- BEGIN: Header -->
                <div class="z-[9]" id="app_header">
                    <div class="app-header z-[999] bg-white dark:bg-slate-800 shadow-sm dark:shadow-slate-700">
                        <div class="flex justify-between items-center h-full">
                            <div class="flex items-center md:space-x-4 space-x-4 rtl:space-x-reverse vertical-box">

                                <a href="index-2.html" class="mobile-logo xl:hidden inline-block">
                                    {{-- @if(session()->get('user') == 'upsi') --}}
                                    <img src="{{asset('images/CXS-Logo.png')}}" class="w-12 black_logo" alt="logo">
                                    {{-- <img src="{{asset('assets/images/upsi-logo.png.png')}}" class="white_logo" alt="logo"> --}}
                                    {{-- @else
                                    <img src="{{asset('assets/images/CXS-full-Tight.png')}}" class="black_logo" alt="logo">
                                    <img src="{{asset('assets/images/CXS-full-Tight.png')}}" class="white_logo" alt="logo">
                                    @endif --}}
                                </a>
                                <button
                                    class="smallDeviceMenuController open-sdiebar-controller hidden xl:hidden md:inline-block">
                                    <iconify-icon
                                        class="leading-none bg-transparent relative text-xl top-[2px] text-slate-900 dark:text-white"
                                        icon="heroicons-outline:menu-alt-3"></iconify-icon>
                                </button>
                                <button
                                    class="sidebarOpenButton text-xl text-slate-900 dark:text-white !ml-0 hidden rtl:rotate-180">
                                    <iconify-icon icon="ph:arrow-right-bold"></iconify-icon>
                                </button>
                                {{-- <button
                                    class="flex items-center xl:text-sm text-lg xl:text-slate-400 text-slate-800 dark:text-slate-300 focus:outline-none focus:shadow-none px-1 space-x-3
                                      rtl:space-x-reverse search-modal"
                                    data-bs-toggle="modal" data-bs-target="#searchModal">
                                    <iconify-icon icon="heroicons-outline:search"></iconify-icon>
                                    <span class="xl:inline-block hidden">Search...
                                    </span>
                                </button> --}}

                            </div>
                            <!-- end vertcial -->
                            <div class="items-center space-x-4 rtl:space-x-reverse horizental-box">
                                <a href="index-2.html" class="leading-0">
                                    <span class="xl:inline-block hidden">
                                        <img src="assets/images/logo/logo.svg" class="black_logo " alt="logo">
                                        <img src="assets/images/logo/logo-white.svg" class="white_logo" alt="logo">
                                    </span>
                                    <span class="xl:hidden inline-block">
                                        <img src="assets/images/logo/logo-c.svg" class="black_logo " alt="logo">
                                        <img src="assets/images/logo/logo-c-white.svg" class="white_logo " alt="logo">
                                    </span>
                                </a>
                                {{-- <button
                                    class="smallDeviceMenuController open-sdiebar-controller hidden md:inline-block xl:hidden">
                                    <iconify-icon
                                        class="leading-none bg-transparent relative text-xl top-[2px] text-slate-900 dark:text-white"
                                        icon="heroicons-outline:menu-alt-3"></iconify-icon>
                                </button>
                                <button
                                    class="items-center xl:text-sm text-lg xl:text-slate-400 text-slate-800 dark:text-slate-300 focus:outline-none focus:shadow-none px-1 space-x-3
                                    rtl:space-x-reverse search-modal inline-flex xl:hidden"
                                    data-bs-toggle="modal" data-bs-target="#searchModal">
                                    <iconify-icon icon="heroicons-outline:search"></iconify-icon>
                                    <span class="xl:inline-block hidden">Search...
                                    </span>
                                </button> --}}

                            </div>
                            <!-- end horizental -->


                            <div class="nav-tools flex items-center lg:space-x-5 space-x-3 rtl:space-x-reverse leading-0">
                                <!-- BEGIN: Language Dropdown  -->

                                <!-- Theme Changer -->
                                <!-- END: Language Dropdown -->





                                <!-- BEGIN: Profile Dropdown -->
                                <!-- Profile DropDown Area -->
                                <div class="md:block hidden w-full">
                                    <button
                                        class="text-slate-800 dark:text-white focus:ring-0 focus:outline-none font-medium rounded-lg text-sm text-center  inline-flex items-center"
                                        type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <div class="lg:h-8 lg:w-8 h-7 w-7 rounded-full flex-1 ltr:mr-[10px] rtl:ml-[10px]">
                                            @if (auth()->user()->profile_picture)

                                            <img src="{{ asset(auth()->user()->profile_picture) }}" onerror="this.src='{{ asset('admin/media/avatars/default-avatar.png') }}'" style="border-radius: 50%; border: 3px solid #ce9e20; " alt=""
                                            class="w-full h-full">
                                            @else
                                            <img src="{{ asset('admin/media/avatars/default-avatar.png') }}" alt=""
                                        class="w-full h-full">

                                                @endif
                                        </div>
                                        <span
                                            class="flex-none text-slate-600 dark:text-white text-sm font-normal items-center lg:flex hidden overflow-hidden text-ellipsis whitespace-nowrap">
                                            {{ auth()->user()->first_name }}
                                        </span>
                                        <svg class="w-[16px] h-[16px] dark:text-white hidden lg:inline-block text-base inline-block ml-[10px] rtl:mr-[10px]"
                                            aria-hidden="true" fill="none" stroke="currentColor" viewbox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </button>
                                    <!-- Dropdown menu -->
                                    <div
                                        class="dropdown-menu z-10 hidden bg-white divide-y divide-slate-100 shadow w-44 dark:bg-slate-800 border dark:border-slate-700 !top-[23px] rounded-md  overflow-hidden">
                                        <ul class="py-1 text-sm text-slate-800 dark:text-slate-200">
                                            {{-- <li>
                                                <a href="index-2.html"
                                                    class="block px-4 py-2 hover:bg-slate-100 dark:hover:bg-slate-600 dark:hover:text-white font-inter text-sm text-slate-600        dark:text-white font-normal">
                                                    <iconify-icon icon="heroicons-outline:user"
                                                        class="relative top-[2px] text-lg ltr:mr-1 rtl:ml-1"></iconify-icon>
                                                    <span class="font-Inter">Dashboard</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="chat.html"
                                                    class="block px-4 py-2 hover:bg-slate-100 dark:hover:bg-slate-600 dark:hover:text-white font-inter text-sm text-slate-600        dark:text-white font-normal">
                                                    <iconify-icon icon="heroicons-outline:chat"
                                                        class="relative top-[2px] text-lg ltr:mr-1 rtl:ml-1"></iconify-icon>
                                                    <span class="font-Inter">Chat</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="email.html"
                                                    class="block px-4 py-2 hover:bg-slate-100 dark:hover:bg-slate-600 dark:hover:text-white font-inter text-sm text-slate-600        dark:text-white font-normal">
                                                    <iconify-icon icon="heroicons-outline:mail"
                                                        class="relative top-[2px] text-lg ltr:mr-1 rtl:ml-1"></iconify-icon>
                                                    <span class="font-Inter">Email</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="todo.html"
                                                    class="block px-4 py-2 hover:bg-slate-100 dark:hover:bg-slate-600 dark:hover:text-white font-inter text-sm text-slate-600        dark:text-white font-normal">
                                                    <iconify-icon icon="heroicons-outline:clipboard-check"
                                                        class="relative top-[2px] text-lg ltr:mr-1 rtl:ml-1"></iconify-icon>
                                                    <span class="font-Inter">Todo</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="settings.html"
                                                    class="block px-4 py-2 hover:bg-slate-100 dark:hover:bg-slate-600 dark:hover:text-white font-inter text-sm text-slate-600        dark:text-white font-normal">
                                                    <iconify-icon icon="heroicons-outline:cog"
                                                        class="relative top-[2px] text-lg ltr:mr-1 rtl:ml-1"></iconify-icon>
                                                    <span class="font-Inter">Settings</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="pricing.html"
                                                    class="block px-4 py-2 hoverbg-slate-100 dark:hover:bg-slate-600 dark:hover:text-white font-inter text-sm text-slate-600        dark:text-white font-normal">
                                                    <iconify-icon icon="heroicons-outline:credit-card"
                                                        class="relative top-[2px] text-lg ltr:mr-1 rtl:ml-1"></iconify-icon>
                                                    <span class="font-Inter">Price</span>
                                                </a>
                                            </li> --}}
                                            <li>
                                                <a href="{{route('logout')}}"
                                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();"  class="block px-4 py-2 hover:bg-slate-100 dark:hover:bg-slate-600 dark:hover:text-white font-inter text-sm text-slate-600        dark:text-white font-normal">
                                                    <iconify-icon icon="heroicons-outline:login"
                                                        class="relative top-[2px] text-lg ltr:mr-1 rtl:ml-1"></iconify-icon>
                                                    <span class="font-Inter">Logout</span>
                                                </a>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                    @csrf
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- END: Header -->
                                <button class="smallDeviceMenuController md:hidden block leading-0">
                                    <iconify-icon class="cursor-pointer text-slate-900 dark:text-white text-2xl"
                                        icon="heroicons-outline:menu-alt-3"></iconify-icon>
                                </button>
                                <!-- end mobile menu -->
                            </div>
                            <!-- end nav tools -->
                        </div>
                    </div>
                </div>

                <!-- BEGIN: Search Modal -->
                <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto inset-0 bg-slate-900/40 backdrop-filter backdrop-blur-sm backdrop-brightness-10"
                    id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
                    <div class="modal-dialog relative w-auto pointer-events-none top-1/4">
                        <div
                            class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white dark:bg-slate-900 bg-clip-padding rounded-md outline-none text-current">
                            <form>
                                <div class="relative">
                                    <button
                                        class="absolute left-0 top-1/2 -translate-y-1/2 w-9 h-full text-xl dark:text-slate-300 flex items-center justify-center">
                                        <iconify-icon icon="heroicons-solid:search"></iconify-icon>
                                    </button>
                                    <input type="text" class="form-control !py-[14px] !pl-10" placeholder="Search"
                                        autofocus>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- END: Search Modal -->
                <!-- END: Header -->
