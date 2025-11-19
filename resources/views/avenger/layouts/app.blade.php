<!DOCTYPE html>

<html lang="en">
<!--begin::Head-->

<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
{{-- <script src="script.js" defer></script> --}}
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
 <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"> --}}
<head>
    <title>{{ env('APP_NAME') }}</title>
    <meta charset="utf-8" />
    <meta name="description" content="
            {{ env('APP_NAME') }}
        " />
    <meta name="keywords" content="
            {{ env('APP_NAME') }}
        " />
        <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="{{ env('APP_NAME') }}" />
    <meta property="og:url" content="{{ env('APP_URL') }}" />
    <meta property="og:site_name" content="{{ env('APP_NAME') }}" />
    <link rel="canonical" href="dark-header.html" />
    <link rel="shortcut icon" href="../assets/media/logos/favicon.ico" />
   
    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <!--end::Fonts-->

    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="{{ asset('admin/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    <style>

  .custom_legends{
    padding: 6px 8px;
    border-radius: 50%;
    color: white;
  }
  .capitalize{
    text-transform: capitalize;
  }
  

    </style>

<style>
    .landing-header .menu-item .menu-link {
        display: flex;
        padding: 8px 16px;
        justify-content: center;
        align-items: center;
        align-self: stretch;
        color: #4B5675;
        font-size: 14px;
        font-weight: 500;
        line-height: 20px;
    }

    .landing-header .menu .menu-link.active {
        border-radius: 8px;
        background: #FAFAFB;
        color: #F7941C;
        text-align: center;
        font-weight: 600;
        height: 58px;
    }

    .custom-btn {
        display: flex;
        padding: 14px 20px;
        justify-content: center;
        align-items: center;
        gap: 8px;
        border-radius: 4px;
        background: #fff;
        font-size: 14px;
        font-weight: 600;
        line-height: 20px;
    }

    .btn-orange-outline {
        border: 1px solid #F7941C;
        color: #F7941C;
    }

    .btn-grey-outline {
        border: 1px solid #99A1B7;
        color: #78829D;
    }

    .btn-orange-fill {
        border: 1px solid #F7941C;
        color: #FFF;
        background-color: #F7941C;
    }

    .footer-text p {
        /* color: #99A1B7;
        font-size: 13.975px;
        font-weight: 500;
        line-height: 16.77px; */
        margin: 0;
    }

    .form-control:focus {
            box-shadow: none;
        }


        .feedback-message {
            display: flex;
            background: #DDF5E2;
            padding: 0px 26px;
            height: 80px;
        }

        .feedback-message p {
            color: #071437;
            font-size: 13.975px;
            line-height: 16.77px;
        }

        .feedback-message .icon {
            color: #78829D;
        }


        .cookie-notice-login {
            transform: translateY(100%);
            transition: transform 0.5s ease-in-out;
        }

        .cookie-notice-login.show {
            transform: translateY(0);
        }



        .cookie-notice-login {
            position: fixed;
            /* Changed from sticky to fixed */
            left: 0;
            bottom: 0;
            width: 100%;
            background: #FFF;
            border-top: 1px solid #DBDFE9;
            box-shadow: 0px -3px 8px rgba(0, 0, 0, 0.1);
            padding: 24px;
            z-index: 9999;
        }

        .cookie-notice-login p {
            padding: 0;
        }

        .cookie-notice-login .top-heading {
            color: #071437;
            font-size: 16.25px;
            font-weight: 700;
            line-height: 19.5px;
        }

        .cookie-notice-login .sub-content {
            color: #071437;
            font-size: 14px;
            font-weight: 400;
            line-height: 20px;
        }

        .cookie-notice-login .customize-text {
            color: #F7941C;
            font-size: 12px;
            font-weight: 600;
            line-height: 16px;
            text-decoration-line: underline;
        }

        .cookie-notice-login .custom-btn button {
            padding: 8px 16px;
            border-radius: 4px;
            border: 1px solid #F7941C;
            font-size: 12px;
            font-weight: 600;
            line-height: 16px;
            width: fit-content;
            float: right;
        }

        .cookie-notice-login .custom-btn .orange-outline {
            background: #fff;
            color: #F7941C;
            margin-right: 8px;
        }

        .cookie-notice-login .custom-btn .orange-fill {
            background: #F7941C;
            color: #fff;
        }

</style>
    <!--end::Global Stylesheets Bundle-->
    @yield('styles')
    @stack('style')

    <!--begin::Google tag-->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-37564768-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());
        gtag('config', 'UA-37564768-1');
    </script>
    <!--end::Google tag-->
    <script>
        // Frame-busting to prevent site from being loaded within a frame without permission (click-jacking)
        if (window.top != window.self) {
            window.top.location.replace(window.self.location.href);
        }
    </script>

</head>
<!--end::Head-->

<!--begin::Body-->

<body id="kt_app_body" data-kt-app-layout="light-header" data-kt-app-header-fixed="true"
data-kt-app-toolbar-enabled="true" data-kt-app-toolbar-fixed="true" class="app-default">
    <!--begin::Theme mode setup on page load-->
    <script>
        var defaultThemeMode = "light";
        var themeMode;

        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
            } else {
                if (localStorage.getItem("data-bs-theme") !== null) {
                    themeMode = localStorage.getItem("data-bs-theme");
                } else {
                    themeMode = defaultThemeMode;
                }
            }

            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }

            document.documentElement.setAttribute("data-bs-theme", themeMode);
        }
    </script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    if (window.location.pathname === "/") {
        setTimeout(function() {
            var noticeWrapper = document.getElementById("cookie-notice");
            var notice = noticeWrapper.querySelector(".cookie-notice-login");
            noticeWrapper.style.display = "block"; // Show the wrapper
            setTimeout(function() {
                notice.classList.add("show"); // Add show class to .cookie-notice-login
            }, 10); // small delay to trigger animation

            // Add event listeners to hide the notice on button clicks
            var acceptBtn = noticeWrapper.querySelector(".orange-fill");
            var necessaryBtn = noticeWrapper.querySelector(".orange-outline");

            acceptBtn.addEventListener("click", function() {
                noticeWrapper.style.display = "none";
            });

            necessaryBtn.addEventListener("click", function() {
                noticeWrapper.style.display = "none";
            });
        }, 3000); // appear after 3 seconds
    }
});
</script>

    <!--end::Theme mode setup on page load-->
    <!--Begin::Google Tag Manager (noscript) -->

    <!--End::Google Tag Manager (noscript) -->

    <div id="page-overlay" class="d-none justify-content-center align-items-center" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); z-index: 99999;">
        <div class="text-center">
          <div class="spinner-border text-light" role="status">
            <span class="visually-hidden">Loading...</span>
          </div>
        </div>
    </div>

    <!--begin::App-->
    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <!--begin::Page-->
        <div class="app-page  flex-column flex-column-fluid " id="kt_app_page">


			@include('avenger.includes.header')



            <!--begin::Wrapper-->
            <div class="flex-column flex-row-fluid " id="kt_app_wrapper">
                <!--begin::Main-->
                <div class="app-main flex-column flex-row-fluid " id="kt_app_main">
                    <!--begin::Content wrapper-->
                    <div class="d-flex flex-column flex-column-fluid">

                        @if(session()->has('alert-success'))
                        <div id="feedbackMessage" class="justify-content-between align-items-center feedback-message alert alert-dismissible">
                            <div></div>
                            {{-- {{ dd(session()->get('job_opening_id')) }} --}}
                           
                            <p class="text-center fw-medium m-0">{{ session('alert-success') }}
                                
                            </p>
                           
                            <iconify-icon icon="iconamoon:close-bold" width="24" height="24" class="cursor-pointer " data-bs-dismiss="alert"
                                id="closeIcon"></iconify-icon>
                        </div>
                        @endif

                        @if(session()->has('alert-error'))
                        <div id="feedbackMessage" class="justify-content-between align-items-center feedback-message alert alert-dismissible mb-0"style="background-color:#ffe8e0">
                            <div></div>
                            {{-- {{ dd(session()->get('job_opening_id')) }} --}}
                           
                            <p class="text-center fw-medium m-0">{{ session('alert-error') }}
                                
                            </p>
                           
                            <iconify-icon icon="iconamoon:close-bold" width="24" height="24" class="cursor-pointer " data-bs-dismiss="alert"
                                id="closeIcon"></iconify-icon>
                        </div>
                        @endif

                        @if(session()->has('alert-info'))
                        <div id="feedbackMessage" class="justify-content-between align-items-center feedback-message alert alert-dismissible mb-0"style="background-color:#e0f5ff">
                            <div></div>
                            {{-- {{ dd(session()->get('job_opening_id')) }} --}}
                           
                            <p class="text-center fw-medium m-0">{{ session('alert-info') }}
                                
                            </p>
                           
                            <iconify-icon icon="iconamoon:close-bold" width="24" height="24" class="cursor-pointer " data-bs-dismiss="alert"
                                id="closeIcon"></iconify-icon>
                        </div>
                        @endif

                        @yield('content')


                    </div>
                    <!--end::Content wrapper-->


                    <!--begin::Footer-->
					@include('avenger.includes.footer')

                    <!--end::Footer-->
                </div>
                <!--end:::Main-->


            </div>
            <!--end::Wrapper-->


        </div>
        <!--end::Page-->
    </div>

    <div id="cookie-notice" style="display: none;">
        <div class="cookie-notice-login">
            <p class="mb-5 top-heading">This website uses cookies</p>
            <p class="mb-5">
                We use cookies to enhance your browsing experience, personalize content, and analyze site usage.
                By clicking "<b>Accept All Cookies</b>," you consent to our use of cookies. You can also manage your
                preferences
                or reject non-essential cookies by clicking "<b><u>Customize Cookies.</u></b>"
            </p>
            <p class="mb-5">
                Learn more about our cookie usage in our
                <a href="/cookie-notice" style="color: #000;"><b><u>Cookie Notice.</u></b></a>
            </p>
            <div class="d-flex align-items-center justify-content-between">
                <a href="/cookie-notice" style="color: #000; cursor: pointer;">
                    <p class="m-0 customize-text">Customize Cookies</p>
                </a>
                <div class="custom-btn">
                    <button type="button" class="orange-fill feedback feedback-msg">Accept All Cookies</button>
                    <button type="button" class="orange-outline">Use necessary cookies only</button>
                </div>
            </div>
        </div>
    </div>
    <!--end::App-->



    <!--end::Modals-->

    <!--begin::Javascript-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    <script src="{{ asset('admin/plugins/global/plugins.bundle.js')}}"></script>
    <script src="{{ asset('admin/js/scripts.bundle.js')}}"></script>
    <!--end::Global Javascript Bundle-->

    <!--end::Javascript-->
    	<!-- Toastr -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

	<script type="text/javascript">
        // Default Configuration
            $(document).ready(function() {
                toastr.options = {
                    'closeButton': true,
                    'debug': false,
                    'newestOnTop': false,
                    'progressBar': false,
                    'positionClass': 'toast-top-right',
                    'preventDuplicates': false,
                    'showDuration': '1000',
                    'hideDuration': '1000',
                    'timeOut': '5000',
                    'extendedTimeOut': '1000',
                    'showEasing': 'swing',
                    'hideEasing': 'linear',
                    'showMethod': 'fadeIn',
                    'hideMethod': 'fadeOut',
                }
            });

            @if(session()->has('success'))
            toastr.options.progressBar = true,
            toastr.options.closeButton = true,
            toastr.success('{{ session('success') }}');
            @endif

            @if(session()->has('error'))
            toastr.options.progressBar = true,
            toastr.options.closeButton = true,
            toastr.error('{{ session('error') }}');
            @endif

            @if(session()->has('errors'))
            toastr.options.progressBar = true,
            toastr.options.closeButton = true,
            @foreach(session('errors')->all() as $error)
            toastr.error('{{ $error }}');
            @endforeach
            @endif
                // toastr.success('You clicked Success toast');


        //     $('#info').click(function(event) {
        //         toastr.info('You clicked Info toast')
        //     });
        //     $('#error').click(function(event) {
        //         toastr.error('You clicked Error Toast')
        //     });
        //     $('#warning').click(function(event) {
        //         toastr.warning('You clicked Warning Toast')
        //     });

        // // Toast Image and Progress Bar
        //     $('#image').click(function(event) {
        //         toastr.options.progressBar = true,
        //         toastr.info('<img src="https://image.flaticon.com/icons/svg/34/34579.svg" style="width:150px;">', 'Toast Image')
        //     });


        // // Toast Position
        //     $('#position').click(function(event) {
        //         var pos = $('input[name=position]:checked', '#positionForm').val();
        //         toastr.options.positionClass = "toast-" + pos;
        //         toastr.options.preventDuplicates = false;
        //         toastr.info('This sample position', 'Toast Position')
        //     });
    </script>
        {{-- @yield('scripts') --}}
    
    <script src="https://code.iconify.design/iconify-icon/2.0.0/iconify-icon.min.js"></script>
    <script>
        function showOverlay() {
            const overlay = document.getElementById('page-overlay');
            overlay.classList.remove('d-none');
            overlay.classList.add('d-flex');
        }

        function hideOverlay() {
            const overlay = document.getElementById('page-overlay');
            overlay.classList.remove('d-flex');
            overlay.classList.add('d-none');
        }
    </script>
    @yield('scripts')
    @stack('script')

</body>
<!--end::Body-->


</html>
