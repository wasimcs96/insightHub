<!DOCTYPE html>
<html lang="en">
<head>
     <title>{{ env('TAB_NAME') }}</title>
    <meta charset="UTF-8">
    <meta name="description" content="Insight Access Developed by CXS Analytics SDN BHD" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="Insight Access Developed by CXS Analytics SDN BHD" />
    <meta property="og:url" content="https://cxsanalytics.com" />
    <meta property="og:site_name" content="CXS Analytics" />
    <link rel="shortcut icon" href="../assets/media/logos/favicon.ico" />

    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!--end::Fonts-->

    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="{{ asset('admin/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* General Styles */
        body, html {
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
            z-index: 1000; /* Ensure header is above other content */
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

        /* Footer Styles */
        footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: white;
            padding: 10px;
            text-align: left;
            z-index: 1000; /* Ensure footer is above other content */
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
            font-family: Helvetica Neue;
            font-size: 12px;
            padding-left: 50px;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .container-2 .content-item {
                flex: 1 1 calc(33.333% - 20px); /* 3 items per row */
            }
        }

        @media (max-width: 768px) {
            .container-2 .content-item {
                flex: 1 1 calc(50% - 20px); /* 2 items per row */
            }
        }

        @media (max-width: 480px) {
            .container-2 .content-item {
                flex: 1 1 100%; /* 1 item per row */
            }
        }
    </style>
    @yield('styles')
</head>
<body>
    <!-- Header Section -->
    <header >
        <div class="header-container shadow-lg">
            <a href="/dashboard" class="">
            <img src="{{ asset('media/insightaccess.png') }}" alt="Logo" class="logo mb-3">
            </a>
            {{-- <img src="{{ asset('employee/assets/media/avatars/default-avatar.png') }}" alt="Profile Picture" class="profile-pic"> --}}
        </div>
    </header>


    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer Section -->
    <footer class="shadow-lg mb-0">
        <p class="mb-0">&copy; <span id="current-year"></span> CXS Analytics, All Rights Reserved</p>
    </footer>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('admin/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('admin/js/scripts.bundle.js') }}"></script>

    <!-- Script to set the current year in the footer -->
    <script>
        const currentYear = new Date().getFullYear();
        document.getElementById("current-year").textContent = currentYear;
    </script>
    @yield('scripts')

</body>
</html>
