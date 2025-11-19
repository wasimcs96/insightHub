<!DOCTYPE html>

<html lang="en">
<!--begin::Head-->

<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <title>CXS - Talent Management</title>
    <meta charset="utf-8" />
    <meta name="description" content="CXS | InsightAccess" />
    <meta name="keywords" content="CXS | InsightAccess" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content=" CXS | InsightAccesss" />
    <meta property="og:url" content="{{ env('APP_URL') }}">
    <meta property="og:site_name" content="CXS | InsightAccess" />
    <link rel="canonical" href="sign-in.html" />
    <link rel="shortcut icon" href="{{asset('media/logos/favicon.ico') }}" />

    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <!--end::Fonts-->



    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="{{ asset('admin/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->

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
    <!--end::Theme mode setup on page load-->
    <!--Begin::Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5FS8GGP" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!--End::Google Tag Manager (noscript) -->

    <!--begin::Root-->
  <!-- [if IE]> <p class="browserupgrade">
            You are using an <strong>outdated</strong> browser. Please
            <a href="https://browsehappy.com/">upgrade your browser</a> to improve
            your experience and security.
        </p> <![endif] -->

        <div class="loginwrapper">
            <div class="lg-inner-column">
              <div class="left-column relative z-[1]">
                <div class="max-w-[520px] pt-20 ltr:pl-20 rtl:pr-20">
                    <a href="http://cxsanalytics.com/">
                        <img src="{{ asset('images/cxs_logo.webp')}}" alt="" class="mb-10 dark_logo inline-block dark:hidden" style="
                        max-width: 126px;
                    ">
                        {{-- <img src="{{ asset('admin/assets/images/logo/logo-white.svg')}}" alt="" class="mb-10 white_logo hidden dark:inline-block"> --}}
                      </a>
                      <h4>
                        Talent Matching and Development
                        <span class="text-slate-800 dark:text-slate-400 font-bold">
                                        Platform
                                    </span>
                      </h4>
                </div>
                <div class="absolute left-0 2xl:bottom-[-160px] bottom-[-130px] h-full w-full z-[-1]">
                    <img src="{{ asset('admin/assets/images/auth/ils1.svg')}}" alt="" class=" h-full w-full object-contain">

                </div>
              </div>
              <div class="right-column relative">
                <div class="inner-content h-full flex flex-col bg-white dark:bg-slate-800">
                  <div class="auth-box2 flex flex-col justify-center h-full">
                    <div class="mobile-logo text-center mb-6 lg:hidden block">
                      <a href="index-2.html">
                        <img src="assets/images/logo/logo.svg" alt="" class="mx-auto">
                        <img src="assets/images/logo/logo-white.svg" alt="" class="mx-auto">
                      </a>
                    </div>
                    <div class="text-center 2xl:mb-10 mb-5">
                      <h4 class="font-medium mb-4">{{ __('Reset Password') }}</h4>
                      {{-- <div class="text-slate-500 dark:text-slate-400 text-base">
                        Reset Password with Dashcode.
                      </div> --}}
                    </div>
                    @if (session('status'))
                    <div class="font-normal text-base text-slate-500 dark:text-slate-400 text-center px-2 bg-slate-100 dark:bg-slate-600 rounded
                                        py-3 mb-4 mt-10">
                                        {{ session('status') }}
                    </div>
                    @endif

                    <!-- BEGIN: Forgot Password Form -->
                    {{-- <form class="space-y-4" method="POST" action="{{ route('password.email') }}"> --}}
                      <form class="space-y-4" method="POST" action="{{ route('password.otp') }}">
                        @csrf
                      <div class="fromGroup">
                        <label class="block capitalize form-label">{{ __('Email Address') }}</label>
                        <div class="relative ">
                          <input id="email" type="email" name="email" class="form-control py-2 @error('email') is-invalid @enderror" placeholder="Enter your Email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                          @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger-500">{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                      </div>
                      <button class="btn btn-dark block w-full text-center">{{ __('Send Password Reset Link') }}</button>
                    </form>
                    <!-- END: Forgot Password Form -->

                    {{-- <div class="md:max-w-[345px] mx-auto font-normal text-slate-500 dark:text-slate-400 2xl:mt-12 mt-8 uppercase text-sm">
                      Forget It,
                      <a href="index-2.html" class="text-slate-900 dark:text-white font-medium hover:underline">
                        Send me Back
                      </a>
                      to The Sign In
                    </div> --}}
                  </div>
                  <div class="auth-footer text-center">
                    Copyright 2024, CXS Analytics. All Rights Reserved.
                  </div>
                </div>
              </div>
            </div>
          </div>
  <!-- scripts -->
    <!--begin::Javascript-->
    <script>
        var hostUrl = "../../../assets/index.html";
    </script>

    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    <script src="../../../assets/plugins/global/plugins.bundle.js"></script>
    <script src="../../../assets/js/scripts.bundle.js"></script>
    <!--end::Global Javascript Bundle-->


    <!--begin::Custom Javascript(used for this page only)-->
    <script src="../../../assets/js/custom/authentication/sign-in/general.js"></script>
    <!--end::Custom Javascript-->
    <!--end::Javascript-->
</body>
<!--end::Body-->

</html>
