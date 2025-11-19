<!DOCTYPE html>

<html lang="zxx" dir="ltr" class="light">




<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <title>@yield('title')</title>
    <link rel="icon" type="image/png" href="{{asset('images/CXS-Logo.png')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&amp;display=swap"
        rel="stylesheet">
    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" href="{{ asset('employee/assets/css/rt-plugins.css') }}">
    <link rel="stylesheet" href="{{ asset('employee/assets/css/app.css') }}">
    <!-- End : Theme CSS -->
    @yield('style')
<style>
    .text-center{
        text-align: center !important;
    }
    .color-black{
        color: black !important;
    }
    </style>
    <!-- Start : theme-store js -->
    <!-- End : theme-store js -->

</head>

<body class=" font-inter dashcode-app" id="body_class">
    <!-- [if IE]> <p class="browserupgrade"> You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security. </p> <![endif] -->
    <main class="app-wrapper">
        <!-- BEGIN: Sidebar -->
        <!-- BEGIN: Sidebar -->
        @include('employee.includes.sidebar')
        <!-- End: Sidebar -->
        <!-- End: Sidebar -->
        <!-- BEGIN: Settings -->

        <!-- BEGIN: Settings -->


        <!-- End: Settings -->
        <div class="flex flex-col justify-between min-h-screen">
            <div>
                <!-- BEGIN: Header -->
                @include('employee.includes.header')

                @yield('content')
            </div>

            <!-- BEGIN: Footer For Desktop and tab -->
            @include('employee.includes.footer')
            <!-- END: Footer For Desktop and tab -->


        </div>
    </main>
    <!-- scripts -->

    <script src="{{asset('employee/assets/js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('employee/assets/js/rt-plugins.js')}}"></script>
    <script src="{{asset('employee/assets/js/app.js')}}"></script>
    @yield('scripts')
</body>



</html>
