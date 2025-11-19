@extends('layouts.app')
@section('title', env('APP_NAME') . ' | Home')
@section('content')
    <!--begin::How It Works Section-->
    <div class="mb-n10 mb-lg-n20 z-index-2">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Heading-->
            <div class="text-center mb-17">
                <!--begin::Title-->
                <h3 class="fs-2hx text-gray-900 mb-5" id="how-it-works"
                    data-kt-scroll-offset="{default: 100, lg: 150}">How it Works</h3>
                <!--end::Title-->

                <!--begin::Text-->
                <div class="fs-5 text-muted fw-bold">
                    Save thousands to millions of bucks by using single tool <br />
                    for different amazing and great useful admin
                </div>
                <!--end::Text-->
            </div>
            <!--end::Heading-->

            <!--begin::Row-->
            <div class="row w-100 gy-10 mb-md-20">
                <!--begin::Col-->
                <div class="col-md-4 px-5">
                    <!--begin::Story-->
                    <div class="text-center mb-10 mb-md-0">
                        <!--begin::Illustration-->
                        <img src="assets/media/illustrations/sketchy-1/2.png" class="mh-125px mb-9" alt="" />
                        <!--end::Illustration-->

                        <!--begin::Heading-->
                        <div class="d-flex flex-center mb-5">
                            <!--begin::Badge-->
                            <span class="badge badge-circle badge-light-success fw-bold p-5 me-3 fs-3">1</span>
                            <!--end::Badge-->

                            <!--begin::Title-->
                            <div class="fs-5 fs-lg-3 fw-bold text-gray-900">
                                Jane Miller </div>
                            <!--end::Title-->
                        </div>
                        <!--end::Heading-->

                        <!--begin::Description-->
                        <div class="fw-semibold fs-6 fs-lg-4 text-muted">

                            Save thousands to millions of bucks <br />
                            by using single tool for different <br />
                            amazing and great
                        </div>
                        <!--end::Description-->
                    </div>
                    <!--end::Story-->



                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col-md-4 px-5">
                    <!--begin::Story-->
                    <div class="text-center mb-10 mb-md-0">
                        <!--begin::Illustration-->
                        <img src="assets/media/illustrations/sketchy-1/8.png" class="mh-125px mb-9" alt="" />
                        <!--end::Illustration-->

                        <!--begin::Heading-->
                        <div class="d-flex flex-center mb-5">
                            <!--begin::Badge-->
                            <span class="badge badge-circle badge-light-success fw-bold p-5 me-3 fs-3">2</span>
                            <!--end::Badge-->

                            <!--begin::Title-->
                            <div class="fs-5 fs-lg-3 fw-bold text-gray-900">
                                Setup Your App </div>
                            <!--end::Title-->
                        </div>
                        <!--end::Heading-->

                        <!--begin::Description-->
                        <div class="fw-semibold fs-6 fs-lg-4 text-muted">

                            Save thousands to millions of bucks <br />
                            by using single tool for different <br />
                            amazing and great
                        </div>
                        <!--end::Description-->
                    </div>
                    <!--end::Story-->



                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col-md-4 px-5">
                    <!--begin::Story-->
                    <div class="text-center mb-10 mb-md-0">
                        <!--begin::Illustration-->
                        <img src="assets/media/illustrations/sketchy-1/12.png" class="mh-125px mb-9" alt="" />
                        <!--end::Illustration-->

                        <!--begin::Heading-->
                        <div class="d-flex flex-center mb-5">
                            <!--begin::Badge-->
                            <span class="badge badge-circle badge-light-success fw-bold p-5 me-3 fs-3">3</span>
                            <!--end::Badge-->

                            <!--begin::Title-->
                            <div class="fs-5 fs-lg-3 fw-bold text-gray-900">
                                Enjoy Nautica App </div>
                            <!--end::Title-->
                        </div>
                        <!--end::Heading-->

                        <!--begin::Description-->
                        <div class="fw-semibold fs-6 fs-lg-4 text-muted">

                            Save thousands to millions of bucks <br />
                            by using single tool for different <br />
                            amazing and great
                        </div>
                        <!--end::Description-->
                    </div>
                    <!--end::Story-->



                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->


            <!--begin::Product slider-->
            <div class="tns tns-default">
                <!--begin::Slider-->
                <div data-tns="true" data-tns-loop="true" data-tns-swipe-angle="false" data-tns-speed="2000"
                    data-tns-autoplay="true" data-tns-autoplay-timeout="18000" data-tns-controls="true"
                    data-tns-nav="false" data-tns-items="1" data-tns-center="false" data-tns-dots="false"
                    data-tns-prev-button="#kt_team_slider_prev1" data-tns-next-button="#kt_team_slider_next1">

                    <!--begin::Item-->
                    <div class="text-center px-5 pt-5 pt-lg-10 px-lg-10">
                        <img src="assets/media/preview/demos/demo1/light-ltr.png"
                            class="card-rounded shadow mh-lg-650px mw-100" alt="" />
                    </div>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <div class="text-center px-5 pt-5 pt-lg-10 px-lg-10">
                        <img src="assets/media/preview/demos/demo2/light-ltr.png"
                            class="card-rounded shadow mh-lg-650px mw-100" alt="" />
                    </div>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <div class="text-center px-5 pt-5 pt-lg-10 px-lg-10">
                        <img src="assets/media/preview/demos/demo4/light-ltr.png"
                            class="card-rounded shadow mh-lg-650px mw-100" alt="" />
                    </div>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <div class="text-center px-5 pt-5 pt-lg-10 px-lg-10">
                        <img src="assets/media/preview/demos/demo5/light-ltr.png"
                            class="card-rounded shadow mh-lg-650px mw-100" alt="" />
                    </div>
                    <!--end::Item-->

                </div>
                <!--end::Slider-->

                <!--begin::Slider button-->
                <button class="btn btn-icon btn-active-color-primary" id="kt_team_slider_prev1">
                    <i class="ki-duotone ki-left fs-2x"></i> </button>
                <!--end::Slider button-->

                <!--begin::Slider button-->
                <button class="btn btn-icon btn-active-color-primary" id="kt_team_slider_next1">
                    <i class="ki-duotone ki-right fs-2x"></i> </button>
                <!--end::Slider button-->
            </div>
            <!--end::Product slider-->








        </div>
        <!--end::Container-->
    </div>
    <!--end::How It Works Section-->

    <!--begin::Statistics Section-->
		<div class="mt-sm-n10">
			<!--begin::Curve top-->
			<div class="landing-curve landing-dark-color ">
				<svg viewBox="15 -1 1470 48" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path
						d="M1 48C4.93573 47.6644 8.85984 47.3311 12.7725 47H1489.16C1493.1 47.3311 1497.04 47.6644 1501 48V47H1489.16C914.668 -1.34764 587.282 -1.61174 12.7725 47H1V48Z"
						fill="currentColor"></path>
				</svg>
			</div>
			<!--end::Curve top-->

			<!--begin::Wrapper-->
			<div class="pb-15 pt-18 landing-dark-bg">
				<!--begin::Container-->
				<div class="container">
					<!--begin::Heading-->
					<div class="text-center mt-15 mb-18" id="achievements"
						data-kt-scroll-offset="{default: 100, lg: 150}">
						<!--begin::Title-->
						<h3 class="fs-2hx text-white fw-bold mb-5">We Make Things Better</h3>
						<!--end::Title-->

						<!--begin::Description-->
						<div class="fs-5 text-gray-700 fw-bold">
							Save thousands to millions of bucks by using single tool <br />
							for different amazing and great useful admin
						</div>
						<!--end::Description-->
					</div>
					<!--end::Heading-->

					<!--begin::Statistics-->
					<div class="d-flex flex-center">
						<!--begin::Items-->
						<div class="d-flex flex-wrap flex-center justify-content-lg-between mb-15 mx-auto w-xl-900px">

							<!--begin::Item-->
							<div class="d-flex flex-column flex-center h-200px w-200px h-lg-250px w-lg-250px m-3 bgi-no-repeat bgi-position-center bgi-size-contain"
								style="background-image: url('assets/media/svg/misc/octagon.svg')">
								<!--begin::Symbol-->
								<i class="ki-duotone ki-element-11 fs-2tx text-white mb-3"><span
										class="path1"></span><span class="path2"></span><span class="path3"></span><span
										class="path4"></span></i> <!--end::Symbol-->

								<!--begin::Info-->
								<div class="mb-0">
									<!--begin::Value-->
									<div class="fs-lg-2hx fs-2x fw-bold text-white d-flex flex-center">
										<div class="min-w-70px" data-kt-countup="true" data-kt-countup-value="700"
											data-kt-countup-suffix="+">0</div>
									</div>
									<!--end::Value-->

									<!--begin::Label-->
									<span class="text-gray-600 fw-semibold fs-5 lh-0">
										Known Companies </span>
									<!--end::Label-->
								</div>
								<!--end::Info-->
							</div>
							<!--end::Item-->

							<!--begin::Item-->
							<div class="d-flex flex-column flex-center h-200px w-200px h-lg-250px w-lg-250px m-3 bgi-no-repeat bgi-position-center bgi-size-contain"
								style="background-image: url('assets/media/svg/misc/octagon.svg')">
								<!--begin::Symbol-->
								<i class="ki-duotone ki-chart-pie-4 fs-2tx text-white mb-3"><span
										class="path1"></span><span class="path2"></span><span class="path3"></span></i>
								<!--end::Symbol-->

								<!--begin::Info-->
								<div class="mb-0">
									<!--begin::Value-->
									<div class="fs-lg-2hx fs-2x fw-bold text-white d-flex flex-center">
										<div class="min-w-70px" data-kt-countup="true" data-kt-countup-value="80"
											data-kt-countup-suffix="K+">0</div>
									</div>
									<!--end::Value-->

									<!--begin::Label-->
									<span class="text-gray-600 fw-semibold fs-5 lh-0">
										Statistic Reports </span>
									<!--end::Label-->
								</div>
								<!--end::Info-->
							</div>
							<!--end::Item-->

							<!--begin::Item-->
							<div class="d-flex flex-column flex-center h-200px w-200px h-lg-250px w-lg-250px m-3 bgi-no-repeat bgi-position-center bgi-size-contain"
								style="background-image: url('assets/media/svg/misc/octagon.svg')">
								<!--begin::Symbol-->
								<i class="ki-duotone ki-basket fs-2tx text-white mb-3"><span class="path1"></span><span
										class="path2"></span><span class="path3"></span><span class="path4"></span></i>
								<!--end::Symbol-->

								<!--begin::Info-->
								<div class="mb-0">
									<!--begin::Value-->
									<div class="fs-lg-2hx fs-2x fw-bold text-white d-flex flex-center">
										<div class="min-w-70px" data-kt-countup="true" data-kt-countup-value="35"
											data-kt-countup-suffix="M+">0</div>
									</div>
									<!--end::Value-->

									<!--begin::Label-->
									<span class="text-gray-600 fw-semibold fs-5 lh-0">
										Secure Payments </span>
									<!--end::Label-->
								</div>
								<!--end::Info-->
							</div>
							<!--end::Item-->

						</div>
						<!--end::Items-->
					</div>
					<!--end::Statistics-->

					<!--begin::Testimonial-->
					<div class="fs-2 fw-semibold text-muted text-center mb-3">
						<span class="fs-1 lh-1 text-gray-700">“</span>

						When you care about your topic, you’ll write about it in a <br /><span
							class="text-gray-700 me-1">more powerful</span>, emotionally expressive way

						<span class="fs-1 lh-1 text-gray-700">“</span>
					</div>
					<!--end::Testimonial-->

					<!--begin::Author-->
					<div class="fs-2 fw-semibold text-muted text-center">
						<a href="account/security.html" class="link-primary fs-4 fw-bold">Marcus Levy,</a>

						<span class="fs-4 fw-bold text-gray-600">CXS CEO</span>
					</div>
					<!--end::Author-->
				</div>
				<!--end::Container-->
			</div>
			<!--end::Wrapper-->

			<!--begin::Curve bottom-->
			<div class="landing-curve landing-dark-color ">
				<svg viewBox="15 12 1470 48" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path
						d="M0 11C3.93573 11.3356 7.85984 11.6689 11.7725 12H1488.16C1492.1 11.6689 1496.04 11.3356 1500 11V12H1488.16C913.668 60.3476 586.282 60.6117 11.7725 12H0V11Z"
						fill="currentColor"></path>
				</svg>
			</div>
			<!--end::Curve bottom-->
		</div>
		<!--end::Statistics Section-->

        <!--begin::Testimonials Section-->
		<div class="mt-20 mb-n20 position-relative z-index-2">
			<!--begin::Container-->
			<div class="container">
				<!--begin::Heading-->
				<div class="text-center mb-17">
					<!--begin::Title-->
					<h3 class="fs-2hx text-gray-900 mb-5" id="clients" data-kt-scroll-offset="{default: 125, lg: 150}">
						Jobs</h3>
					<!--end::Title-->

					<!--begin::Description-->
					<div class="fs-5 text-muted fw-bold">
						Save thousands to millions of bucks by using single tool <br />
						for different amazing and great useful admin
					</div>
					<!--end::Description-->
				</div>
				<!--end::Heading-->

				<!--begin::Row-->
				<div class="row g-lg-10 mb-10 mb-lg-20">
					<!--begin::Col-->
					<div class="col-lg-4">
						<!--begin::Testimonial-->
						<div
							class="d-flex flex-column justify-content-between h-lg-100 px-10 px-lg-0 pe-lg-10 mb-15 mb-lg-0">
							<!--begin::Wrapper-->
							<div class="mb-7">

								<!--begin::Title-->
								<div class="fs-2 fw-bold text-gray-900 mb-3">
                                       Job 1 Title
								</div>
								<!--end::Title-->

								<!--begin::Feedback-->
								<div class="text-gray-500 fw-semibold fs-4">
									The most well thought out design theme I have ever used. The codes are up to
									tandard. The css styles are very clean.
									In fact the cleanest and the most up to standard I have ever seen.
								</div>
								<!--end::Feedback-->
							</div>
							<!--end::Wrapper-->

							<!--begin::Author-->
							<div class="d-flex align-items-center">
								<!--begin::Avatar-->
								<div class="symbol symbol-circle symbol-50px me-5">
									<img src="assets/media/avatars/300-1.jpg" class="" alt="" />
								</div>
								<!--end::Avatar-->

								<!--begin::Name-->
								<div class="flex-grow-1">
									<a href="#" class="text-gray-900 fw-bold text-hover-primary fs-6">Paul Miles</a>

									<span class="text-muted d-block fw-bold">Development Lead</span>
								</div>
								<!--end::Name-->
							</div>
							<!--end::Author-->
						</div>
						<!--end::Testimonial-->



					</div>
					<!--end::Col-->

					<!--begin::Col-->
					<div class="col-lg-4">
						<!--begin::Testimonial-->
						<div
							class="d-flex flex-column justify-content-between h-lg-100 px-10 px-lg-0 pe-lg-10 mb-15 mb-lg-0">
							<!--begin::Wrapper-->
							<div class="mb-7">

								<!--begin::Title-->
								<div class="fs-2 fw-bold text-gray-900 mb-3">
                                     Job 2 Title
								</div>
								<!--end::Title-->

								<!--begin::Feedback-->
								<div class="text-gray-500 fw-semibold fs-4">

									The most well thought out design theme I have ever used. The codes are up to
									tandard. The css styles are very clean.
									In fact the cleanest and the most up to standard I have ever seen.
								</div>
								<!--end::Feedback-->
							</div>
							<!--end::Wrapper-->

							<!--begin::Author-->
							<div class="d-flex align-items-center">
								<!--begin::Avatar-->
								<div class="symbol symbol-circle symbol-50px me-5">
									<img src="assets/media/avatars/300-2.jpg" class="" alt="" />
								</div>
								<!--end::Avatar-->

								<!--begin::Name-->
								<div class="flex-grow-1">
									<a href="#" class="text-gray-900 fw-bold text-hover-primary fs-6">Janya Clebert</a>

									<span class="text-muted d-block fw-bold">Development Lead</span>
								</div>
								<!--end::Name-->
							</div>
							<!--end::Author-->
						</div>
						<!--end::Testimonial-->



					</div>
					<!--end::Col-->

					<!--begin::Col-->
					<div class="col-lg-4">
						<!--begin::Testimonial-->
						<div
							class="d-flex flex-column justify-content-between h-lg-100 px-10 px-lg-0 pe-lg-10 mb-15 mb-lg-0">
							<!--begin::Wrapper-->
							<div class="mb-7">

								<!--begin::Title-->
								<div class="fs-2 fw-bold text-gray-900 mb-3">
                                     Job 3 Title
								</div>
								<!--end::Title-->

								<!--begin::Feedback-->
								<div class="text-gray-500 fw-semibold fs-4">
									The most well thought out design theme I have ever used. The codes are up to
									tandard. The css styles are very clean.
									In fact the cleanest and the most up to standard I have ever seen.
								</div>
								<!--end::Feedback-->
							</div>
							<!--end::Wrapper-->

							<!--begin::Author-->
							<div class="d-flex align-items-center">
								<!--begin::Avatar-->
								<div class="symbol symbol-circle symbol-50px me-5">
									<img src="assets/media/avatars/300-16.jpg" class="" alt="" />
								</div>
								<!--end::Avatar-->

								<!--begin::Name-->
								<div class="flex-grow-1">
									<a href="#" class="text-gray-900 fw-bold text-hover-primary fs-6">Steave Brown</a>

									<span class="text-muted d-block fw-bold">Development Lead</span>
								</div>
								<!--end::Name-->
							</div>
							<!--end::Author-->
						</div>
						<!--end::Testimonial-->



					</div>
					<!--end::Col-->
				</div>
				<!--end::Row-->

				<!--begin::Highlight-->
				<div class="d-flex flex-stack flex-wrap flex-md-nowrap card-rounded shadow p-8 p-lg-12 mb-n5 mb-lg-n13"
					style="background: linear-gradient(90deg, #20AA3E 0%, #03A588 100%);">
					<!--begin::Content-->
					<div class="my-2 me-5">
						<!--begin::Title-->
						<div class="fs-1 fs-lg-2qx fw-bold text-white mb-2">
							Start With Metronic Today,

							<span class="fw-normal">Speed Up Development!</span>
						</div>
						<!--end::Title-->

						<!--begin::Description-->
						<div class="fs-6 fs-lg-5 text-white fw-semibold opacity-75">
                            Apply for 100+ Jobs
						</div>
						<!--end::Description-->
					</div>
					<!--end::Content-->

					<!--begin::Link-->
					<a href="#Jobs"
						class="btn btn-lg btn-outline border-2 btn-outline-white flex-shrink-0 my-2">See All Jobs</a>
					<!--end::Link-->
				</div>
				<!--end::Highlight-->
			</div>
			<!--end::Container-->
		</div>
		<!--end::Testimonials Section-->
@endsection

{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ env('APP_NAME') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-t{border-top-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.dark\:text-gray-500{--tw-text-opacity:1;color:#6b7280;color:rgba(107,114,128,var(--tw-text-opacity))}}
        </style>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
                        <div class="menu-item px-5">
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();" class="menu-link px-5">
                                Sign Out
                            </a>
                        </div>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">{{ __('Dashboard') }}</div>
            
                            <div class="card-body">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
            
                                {{ __('You are logged in!') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </body>
</html> --}}
