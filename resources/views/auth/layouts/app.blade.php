<!DOCTYPE html>

<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <title>{{ env('TAB_NAME') }}</title>
    <meta charset="utf-8" />
    <meta name="description" content="Discover your potential with InsightAccess" />
    <meta name="keywords" content="Discover your potential with InsightAccess" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="{{ env('APP_NAME') }}" />
    <meta property="og:url" content="{{ env('APP_URL') }}">
    <meta property="og:site_name" content="{{ env('APP_NAME') }}" />
    <link rel="canonical" href="sign-in.html" />
    <link rel="shortcut icon" href="{{asset('media/logos/favicon.ico') }}" />

    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <!--end::Fonts-->



    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="{{ asset('admin/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
    <style>
    
        .airasia_bg {
            background-color: #ee2e24 !important;
        }
    </style>
    @yield('styles')
    <!--begin::Google tag-->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-37564768-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
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

<body id="kt_body" class="app-blank">
    <!--begin::Theme mode setup on page load-->
    <script>
        var defaultThemeMode = "light";
	var themeMode;

	if ( document.documentElement ) {
		if ( document.documentElement.hasAttribute("data-bs-theme-mode")) {
			themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
		} else {
			if ( localStorage.getItem("data-bs-theme") !== null ) {
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
        <!--begin::Root-->
            <div class="d-flex flex-column flex-root" id="kt_app_root">
                @yield('content')
            </div>

        <!--end::Root-->

        <!--begin::Javascript-->
        <!--begin::Global Javascript Bundle(mandatory for all pages)-->
            <script src="https://code.iconify.design/iconify-icon/2.0.0/iconify-icon.min.js"></script>
            <script src="{{ asset('admin/plugins/global/plugins.bundle.js') }}"></script>
            <script src="{{ asset('admin/js/scripts.bundle.js') }}"></script>
        <!--end::Global Javascript Bundle-->
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
             @yield('scripts')

        <!--end::Javascript-->
    </body>
    <!--end::Body-->
</html>
