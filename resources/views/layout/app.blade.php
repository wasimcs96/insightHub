<!doctype html>
<html lang="en">

<head>
    <title>{{ env('TAB_NAME') }}</title>
    <meta charset="UTF-8">
    <meta name="description" content="{{ env('APP_NAME') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="{{ env('APP_NAME') }}" />
    <meta property="og:url" content="{{ env('APP_URL') }}" />
    <meta property="og:site_name" content="{{ env('APP_NAME') }}" />
    <link rel="shortcut icon" href="../assets/media/logos/favicon.ico" />

    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!--end::Fonts-->

    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="{{ asset('admin/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">


    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="icon" href="{{ asset('images/CXS-Logo.png') }}" type="image/x-icon">

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
    <style>
        /* General Styles */
        body,
        html {
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
            height: 100%;
            overflow-x: hidden;
            background-color: white;
        }

        /* Header Styles */
        .header-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0px 130px;
            background-color: #f8f9fa;
            z-index: 1000;
        }

        .logo {
            height: 40px;
            width: auto;
        }

        .profile-pic {
            height: 60px;
            width: 60px;
            border-radius: 50%;
        }

        .back-btn {
            z-index: 99;
            position: absolute;
            background: black;
            padding: 2px 10px;
            border-radius: 15px;
        }

        /* Footer Styles */
        footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: white;
            padding: 10px;
            text-align: left;
            z-index: 1000;
            /* Ensure footer is above other content */
        }

        footer a {
            color: #F6931D;
            text-decoration: none;
            margin: 0 10px;
        }

        footer a:hover {
            text-decoration: underline;
        }

        footer p {
            /* font-family: Helvetica Neue; */
            font-size: 12px;
            padding-left: 50px;
        }

        .menu-link {
            text-decoration-line: none;
        }

        .menu-title {
            color: #F6931D;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .container-2 .content-item {
                flex: 1 1 calc(33.333% - 20px);
                /* 3 items per row */
            }
        }

        @media (max-width: 768px) {
            .container-2 .content-item {
                flex: 1 1 calc(50% - 20px);
                /* 2 items per row */
            }
        }

        @media (max-width: 480px) {
            .container-2 .content-item {
                flex: 1 1 100%;
                /* 1 item per row */
            }
        }
    </style>
    @yield('style')
    <title>{{ env('TAB_NAME') }}</title>
</head>

<body>


    <div class="row-fluid" id="app">
        <header>
            <div class="header-container shadow-lg">
            <a href="/dashboard" class="">

                <img src="{{ asset('media/insightaccess.png') }}" alt="Logo" class="logo mb-3">
                {{-- <img src="{{ asset('employee/assets/media/avatars/default-avatar.png') }}" alt="Profile Picture" class="profile-pic"> --}}
            </a>
            </div>
        </header>
        @yield('app', 'Default content')

        {{-- <div class="position-fixed bottom-30 right-30 z-index-10000">
                
                <a href="javascript:window.scrollTo(0,0);" class="me-3"><img src="/images/scroll-up.jpeg" width="40"></a>

                <a href="javascript:window.scrollTo(0,document.body.scrollHeight);"><img src="/images/scroll-down.jpeg" width="40"></a> 
                <a href="javascript:window.scrollTo(0,0);" class="me-3"><img src="/images/up-arrow.png" width="40"></a>

                <a href="javascript:window.scrollTo(0,document.body.scrollHeight);"><img src="/images/down-arrow.png" width="40"></a>
                 </div> --}} 

        <!-- Footer Section -->
        <footer class="shadow">
            <p>&copy; <span id="current-year"></span> CXS Analytics, All Rights Reserved</p>
        </footer>
    </div>

    @php
        $checkMode = env('APP_ENV_MODE');
        $keyGA = '';
        $urlGA = 'https://www.googletagmanager.com/gtag/js?id=UA-232164886-1';

        if ($checkMode == 'PRODUCTION') {
            $keyGA = env('GOOGLE_ANYLYTICS_KEY_PRODUCTION');
            Session::put('gaKey', env('GOOGLE_ANYLYTICS_KEY_PRODUCTION'));
            $urlGA = 'https://www.googletagmanager.com/gtag/js?id=' . $keyGA;
        } else {
            $keyGA = env('GOOGLE_ANYLYTICS_KEY_UAT');
            Session::put('gaKey', env('GOOGLE_ANYLYTICS_KEY_UAT'));
            $urlGA = 'https://www.googletagmanager.com/gtag/js?id=' . $keyGA;
        }
    @endphp

    <script src="{{ asset('js/updated-main.js') }}"></script>
    <script async src="{{ $urlGA }}"></script>
    <script>
        sessionStorage.setItem('gaKey', "{{ $keyGA }}");
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', sessionStorage.getItem('gaKey'));
    </script>
    <script>
        /**
         * The following event is sent when the page loads. You could
         * wrap the event in a JavaScript function so the event is
         * sent when the user performs some action.
         */
        function eventCall(label) {
            gtag('event', 'Submit Assessment', {
                'event_category': 'Talent',
                'event_label': label
            });
            window.location.href = "{{ config('app.remote_base_url') }}"

        }
    </script>
    <script>
        $('div:contains("Moderate")').each(function() {
            if ($(this).text() == "Moderate")
                $(this).children().text("{{ __('Moderate') }}");
        });
        $('div:contains("High")').each(function() {
            if ($(this).text() == "High")
                $(this).children().text("{{ __('High') }}");

        });
        $('div:contains("Low")').each(function() {
            if ($(this).text() == "Low")
                $(this).children().text("{{ __('Low') }}");
        });
    </script>

    <script>
        // Prevent going back when the back button is pressed
        history.pushState(null, null, location.href);
        window.onpopstate = function() {
            history.go(1);
        };
    </script>

    <script>
        // This script sets the current year in the footer
        document.getElementById("current-year").textContent = new Date().getFullYear();
    </script>


    {{-- <script>
  let counterElement = 0;

  // Function to update the counter
  function updateCounter() {
    // Get the current counter value
    let currentValue = parseInt(counterElement);

    // Increment the counter value by 1
    currentValue++;

    // Update the counter element with the new value
    counterElement = currentValue;
// console.log(currentValue);
    const timeTakenInput = document.getElementById('timeTakenInput');
    timeTakenInput.value = currentValue;
  }
  document.addEventListener('DOMContentLoaded', function () {
    // Start the counter
    setInterval(updateCounter, 1000); // 1000 milliseconds = 1 second
  });

//   console.log(updateCounter());

  // Example: When the user clicks a "Submit" button or completes the quiz
//   function onSubmitButtonClick() {
//     const timeTaken = updateCounter();


//     // You can then submit the form or process the timeTaken value as needed.
//     // For example: document.getElementById('quizForm').submit();
//   }
</script> --}}
    @stack('script')



</body>

</html>
