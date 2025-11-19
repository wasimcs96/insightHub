<!DOCTYPE html>

<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    {{-- <title>{{ env('APP_NAME') }}</title> --}}
    <title>{{ env('TAB_NAME') }}</title>
    <meta charset="utf-8" />
    <meta name="description" content="Empowering Talent.
        " />
    <meta name="keywords" content="Impowering Talent" />
        <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="PHCTD-Impowering Talent" />
    <meta property="og:url" content="/" />
    <meta property="og:site_name" content="PHCTD-Impowering Talent" />
    <link rel="canonical" href="/" />
    {{-- <link rel="shortcut icon" href="{{ asset('images/phili-logo.png') }}" /> --}}

    @php
    $favicon = \App\Models\MasterGeneralSetting::where('name', 'favicon')->first();
@endphp
@if ($favicon && $favicon->value)
<link rel="shortcut icon"
      href="{{ $favicon && $favicon->value ? asset('storage/' . $favicon->value) : asset('media/default-favicon.ico') }}"
      type="image/x-icon">
@endif

    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <!--end::Fonts-->

    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="{{ asset('employee/assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('employee/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
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
    <!--end::Global Stylesheets Bundle-->
    @yield('styles')
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
    <!--end::Theme mode setup on page load-->
    <!--Begin::Google Tag Manager (noscript) -->

    <!--End::Google Tag Manager (noscript) -->


    <!--begin::App-->
    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <!--begin::Page-->
        <div class="app-page  flex-column flex-column-fluid " id="kt_app_page">


            @include('employee.includes.header')


            <!--begin::Wrapper-->
            <div class="app-wrapper  flex-column flex-row-fluid " id="kt_app_wrapper">
                <!--begin::Main-->
                <div class="app-main flex-column flex-row-fluid " id="kt_app_main">
                    <!--begin::Content wrapper-->
                    <div class="d-flex flex-column flex-column-fluid">

                @yield('content')

            </div>
            <!--end::Content wrapper-->


            <!--begin::Footer-->
            @include('employee.includes.footer')
            <!--end::Footer-->
        </div>
        <!--end:::Main-->


    </div>
    <!--end::Wrapper-->


</div>
<!--end::Page-->
</div>
<!--end::App-->



<div id="global-modal-container"></div>
<!--end::Modals-->

<!--begin::Javascript-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!--begin::Global Javascript Bundle(mandatory for all pages)-->
<script src="{{ asset('employee/assets/plugins/global/plugins.bundle.js')}}"></script>
<script src="{{ asset('employee/assets/js/scripts.bundle.js')}}"></script>
<!--end::Global Javascript Bundle-->

<!--end::Javascript-->
<!-- Toastr -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
  <script src="{{ asset('js/modal/NewModalManager.js') }}"></script>
    <script src="{{ asset('js/SearchableDropdown.js') }}"></script>
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
    toastr.error('{{ session('errors') }}');
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


<script src="https://code.iconify.design/iconify-icon/2.0.0/iconify-icon.min.js"></script>

  
@yield('scripts')
</body>
<!--end::Body-->


</html>
