<!DOCTYPE html>

<html lang="en">
<!--begin::Head-->

{{-- <script src="script.js" defer></script> --}}

<head>

    {{-- <title>{{ env('APP_NAME') }}</title> --}}
    <title>{{ env('TAB_NAME') }}</title>
    <meta charset="utf-8" />
    <meta name="description" content="
            {{ env('APP_NAME') }}
        " />
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

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
    <link href="{{ asset('admin/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    @livewireStyles
    @stack('styles')

    <style>
        .custom_legends {
            padding: 6px 8px;
            border-radius: 50%;
            color: white;
        }

        .capitalize {
            text-transform: capitalize;
        }

        .alert-dismissible {
            padding: 24px;
        }

        .alert-success {
            border: 1px solid #BBECC5;
            background: #DDF5E2;
            color: #071437;
        }

        .alert {
            border-radius: 8px;
            font-size: 13.975px;
            font-weight: 500;
            line-height: 16.77px;
            margin-bottom: 28px;
        }

        .alert-dismissible .close {
            font-size: 2.5rem !important;
            font-weight: 300 !important;
             color: #78829D;
             border: 0px;
             background:none;
             float: right;
        }

        .dropdown-btn.disabled {
            color: #78829D;
            background-color: #DBDFE9;
            border-color: #C8C8C9;
            pointer-events: none;
        }
        .form-control:disabled, .form-select:disabled, .select2-container--bootstrap5 .select2-selection--single[aria-disabled="true"] {
            color: #78829D;
            background-color: #DBDFE9;
            border-color: #C8C8C9;
        }

        

        .form-control,
        .form-select,
        textarea.form-control {
            border-radius: 4px !important;
        }

        .tagify:not(.form-control-sm):not(.form-control-lg) {
            padding: .775rem 1rem;
            white-space: normal !important;
            word-break: break-word !important;
            overflow-wrap: anywhere;
            /* max-width: 100%; */
        }

        .tagify.form-control {
            /* overflow: scroll; */
            /* overflow-x: scroll; */
            overflow-y: hidden;
            flex-direction: column-reverse;
            justify-content: center;
            align-items: flex-start;
        }

        .tagify__tag__removeBtn:hover+div>span {
            opacity: 1;
        }

        .tagify__tag>div::before, .tagify__tag__removeBtn:hover+div::before {
            box-shadow: none !important;
        }

        .tagify__tag__removeBtn:hover {
                --tag-remove-btn-bg--hover: #000;
        }

        .tagify {
                --tag-bg: #FFF6EA !important;
        }

        .tagify__tag {
            display: flex;
    flex-direction: row-reverse;
    background: #f3f8fd !important;
        }

        .tagify__tag__removeBtn {
            margin: 0px !important;
        }

        .tagify .tagify__tag .tagify__tag-text {
            color: #7C4A0E !important;
        }

        .tagify__tag.tagify--noAnim, .tagify__tag {
               background-color: #FFF6EA !important;

}

textarea.form-control {
    height: auto;
}

textarea.form-control::placeholder {
font-family: 'Inter', Helvetica, Arial, sans-serif;
    font-size: 14.3px !important;
}

.menu-link.analytics-link.active {
    background-color: #F7941D !important;
    color: #fff !important;
    border-radius: 6px;
}

.menu-link.analytics-link.active .menu-title {
    color: #fff !important;
}


        /* .form-select {
        height: 40px !important;
        } */
    </style>
    <!--end::Global Stylesheets Bundle-->
    @yield('styles')
    <!--begin::Google tag-->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-37564768-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'UA-37564768-1');
    </script>
    <script>
        // Ensure any tooltip triggers have a non-null title/data-bs-title before Bootstrap initializes
        (function() {
            function normalizeTooltipTitles() {
                try {
                    document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(function(el) {
                        let title = el.getAttribute('data-bs-title');
                        if (title === null || title === undefined) {
                            // Prefer existing title attribute if present
                            const native = el.getAttribute('title');
                            if (native === null || native === undefined || native === 'null') {
                                el.setAttribute('data-bs-title', 'Not Available');
                            } else {
                                el.setAttribute('data-bs-title', native);
                            }
                        } else {
                            // Make sure it's a string
                            if (typeof title !== 'string' || title.trim() === '' || title.trim() === 'null') {
                                el.setAttribute('data-bs-title', 'Not Available');
                            }
                        }
                        // Remove native title to avoid double tooltips
                        if (el.hasAttribute('title')) el.removeAttribute('title');
                    });
                } catch (e) {
                    // fail silently
                    console.warn('normalizeTooltipTitles error', e);
                }
            }

            // Run early
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', normalizeTooltipTitles);
            } else {
                normalizeTooltipTitles();
            }
        })();
    </script>
    <script>
        // Compatibility: coerce null title option for Bootstrap Tooltip to avoid type check errors
        (function() {
            try {
                if (typeof bootstrap !== 'undefined' && bootstrap.Tooltip && bootstrap.Tooltip.prototype) {
                    const origGetConfig = bootstrap.Tooltip.prototype._getConfig;
                    bootstrap.Tooltip.prototype._getConfig = function(config) {
                        try {
                            if (config && config.title === null) config.title = '';
                            // also ensure data attributes producing null are normalized
                            if (!config && this && this._element) {
                                const attr = this._element.getAttribute('data-bs-title');
                                if (attr === null || attr === 'null') {
                                    this._element.setAttribute('data-bs-title', 'Not Available');
                                }
                            }
                        } catch (e) {
                            // ignore
                        }
                        return origGetConfig.call(this, config);
                    };
                }
            } catch (e) {
                console.warn('bootstrap tooltip patch failed', e);
            }
        })();
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

    <div id="page-overlay" class="d-none justify-content-center align-items-center"
        style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); z-index: 99999;">
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


            @include('insighthub.includes.header')


            <!--begin::Wrapper-->
            <div class="app-wrapper  flex-column flex-row-fluid " id="kt_app_wrapper">
                <!--begin::Main-->
                <div class="app-main flex-column flex-row-fluid " id="kt_app_main">
                    <!--begin::Content wrapper-->
                    <div class="d-flex flex-column flex-column-fluid">
                        @if (session()->has('alert-success'))
                            <div id="feedbackMessage"
                                class="justify-content-between align-items-center feedback-message alert alert-dismissible">
                                <div></div>
                                {{-- {{ dd(session()->get('job_opening_id')) }} --}}

                                <p class="text-center fw-medium m-0">{{ session('alert-success') }}

                                </p>

                                <iconify-icon icon="iconamoon:close-bold" width="24" height="24"
                                    class="cursor-pointer " data-bs-dismiss="alert" id="closeIcon"></iconify-icon>
                            </div>
                        @endif
                        @yield('content')


                    </div>
                    <!--end::Content wrapper-->


                    <!--begin::Footer-->
                    @include('admin.includes.footer')
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
    <script src="{{ asset('js/app.js') }}"></script>
    <!--end::Modals-->

    <!--begin::Javascript-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    <script src="{{ asset('admin/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('admin/js/scripts.bundle.js') }}"></script>
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

        @if (session()->has('success'))
            {{-- Skip the top-right toastr on the Email Templates index because that page shows an inline banner --}}
            @unless(request()->routeIs('insighthub.settings.email-templates.index'))
                (function(){
                    try {
                        if (window.__serverFeedback) return;
                    } catch (e) {
                    }

                    toastr.options.progressBar = true;
                    toastr.options.closeButton = true;
                    toastr.success('{{ session('success') }}');
                })();
            @endunless
        @endif

        @if (session()->has('error'))
            toastr.options.progressBar = true,
                toastr.options.closeButton = true,
                toastr.error('{{ session('error') }}');
        @endif

        @if (session()->has('errors'))
            toastr.options.progressBar = true,
                toastr.options.closeButton = true,
                @foreach (session('errors')->all() as $error)
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
            document.body.style.cursor = 'wait';
        }

        function hideOverlay() {
            const overlay = document.getElementById('page-overlay');
            overlay.classList.remove('d-flex');
            overlay.classList.add('d-none');
            document.body.style.cursor = 'default';
        }
    </script>

    <script src="{{ asset('js/modal/NewModalManager.js') }}"></script>
    <script src="{{ asset('js/SearchableDropdown.js') }}"></script>

    @yield('scripts')
    <!-- Link the ModalManager.js file -->
    @stack('scripts')

    @livewireScripts

    <!-- Tagify links -->
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css">
</body>
<!--end::Body-->


</html>
