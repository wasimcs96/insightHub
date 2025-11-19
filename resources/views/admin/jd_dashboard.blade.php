<!-- job.index.blade.php -->

@extends('admin.layout.app')

@section('title', 'Setting - Job Descriptions')
@section('styles')
    <style>
        .navtab-btn {
            display: flex;
            align-items: center;
            gap: 2px;
            border-radius: 6px;
            border: 1px solid #F7941D;
            background: #FCFCFC;
            height: fit-content;
            margin-right: 11.68px;
        }

        .navtab-btn a,
        .navtab-btn div {
            padding: 8px 16px;
        }

        a.bg-primary:hover {
            background-color: #fff !important;
            color: #f7931e !important;
            border-right: 1px solid #F7931E !important;
        }

        /* a.text-primary:hover,
        a:hover {
            color: #f7931e !important;
        } */

        .trimmed-description {
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }

        .jd-btn {
            color: #78829D;
            font-size: 12px;
            font-style: normal;
            font-weight: 600;
            line-height: 16px;
            height: auto;
            display: flex;
            padding: 8px 16px;
            justify-content: center;
            align-items: center;
            border-radius: 4px;
            border: 1px solid #99A1B7;
            cursor: pointer;
        }

        .new-jd-btn {

            padding: 12px 16px;
            border-radius: 4px;
            border: 1px solid #DBDFE9;
            transform: translate3d(-210px, 130.5px, 0px) !important;
        }

        .new-jd-btn a {
            color: #000;
            font-size: 12px;
            font-weight: 400;
            line-height: 16px;
        }

        .app-content {
            padding-top: 48px;
        }

        .search-box {
            display: flex;
            padding: 10px 12px 10px 38px;
            align-items: center;
            border-radius: 4px;
            border: 1px solid #DBDFE9;
            background: #FFF;
            color: #99A1B7;
            font-size: 12px;
            font-style: normal;
            font-weight: 400;
            line-height: 16px;
            height: fit-content;
        }

        .card-body {
            border-radius: 8.125px;
            background: #FFF;
        }

        .card-heading {
            color: #000;
            font-size: 19.5px;
            font-weight: 400;
            line-height: 24px;
            letter-spacing: 0.15px;
        }

        .card-number {
            color: #000;
            font-size: 28px;
            font-weight: 400;
            line-height: 24px;
            letter-spacing: 0.15px;
        }

        .card-number span {
            color: #4B5675;
            font-size: 16px;
            line-height: 24px;
            letter-spacing: 0.15px;
        }
    </style>
    <style>
        .navtab-btn {
            display: flex;
            border: 1px solid #F7941D;
            border-radius: 6px;
            overflow: hidden;
        }
    
        .navtab-btn .tab-link {
            text-align: center;
            padding: 8px 16px;
            color: #F7941D;
            background-color: #fff;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 12px;
            line-height: 16px;
        }
    
        .navtab-btn .tab-link.active-tab {
            background-color: #F7941D;
            color: #fff;
        }
    
        .search-wrapper {
            height: 32px;
            display: flex;
        }
    
        .search-input {
            width: 270px;
            padding: 0px 12px;
            border-radius: 4px 0px 0px 4px;
            border: 1px solid #C4CADA;
            border-right: 0;
            background: #FFF;
            color: #99A1B7;
            font-size: 12px;
            font-weight: 400;
        }
    
        .search-icon {
            display: flex;
            padding: 0px 8px;
            align-items: center;
            border-radius: 0px 4px 4px 0px;
            border: 1px solid #C4CADA;
            background: #FFF;
            color: #99A1B7;
        }
    
        .btn-view-jd {
            border: 1px solid #ced4da;
            color: #6c757d;
            background-color: white;
        }
    
        .btn-view-jd i {
            margin-right: 4px;
        }
    
        input:focus-visible {
            outline: none !important;
            box-shadow: none !important;
        }
    
        .custom-btn {
            height: 35px;
            padding: 8px 16px;
            background: #F7941C;
            justify-content: center;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
            width: fit-content;
        }
    
        .custom-btn.orange-fill,
        .orange-fill-popup {
            background: #F7941C;
            color: #FFF;
        }
    
        .orange-outline-popup {
            border: 1px solid #F7941C !important;
            background: #FFF;
            color: #F7941C;
        }
    
        .disable-grey-popup {
            border: 1px solid #DBDFE9 !important;
            background: #F1F1F4;
            color: #99A1B7;
        }
    
        .grey-outline-popup {
            border: 1px solid #99A1B7 !important;
            background: #FFF;
            color: #78829D;
    
        }
    
        .btn-view-jd {
            padding: 8px 16px;
            border-radius: 4px;
            border: 1px solid #99A1B7;
            background: #FFF;
            color: #78829D;
            font-size: 12px;
            font-weight: 600;
            line-height: 16px;
        }
    
        .line-h {
            width: 1px;
            height: 32px;
            background: #DDD;
        }
    
        .dropdown-menu.show {
            /* transform: translate3d(1063px, 205.5px, 0px) !important; */
            width: 164px;
            border-radius: 8px;
            border: 1px solid #D9D9D9;
            box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.03);
            padding: 8px;
        }
    
        .dropdown-item {
            display: flex;
            padding: 12px 16px;
            align-items: flex-start;
            gap: 4px;
            border-radius: 8px;
            color: #1E1E1E;
            font-size: 12px;
            font-style: normal;
            font-weight: 400;
            line-height: 16px;
        }
    
        .empty-state {
            display: flex;
            height: 70vh;
            padding: 118px 232px;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 16px;
            border-radius: 8px;
            background: #F1F1F4;
            box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.03);
            margin-top: 28px;
        }
    
        .empty-state p {
            color: #4B5675;
            text-align: center;
            font-size: 19.5px;
            font-weight: 500;
            line-height: 23.4px;
        }
    
        .sector-main {
            margin-top: 28px;
            display: flex;
            align-items: center;
            gap: 28px 31px;
            flex-wrap: wrap;
        }
    
        .sector-box {
            min-width: 397px;
            margin: auto;
            display: flex;
            padding: 26px 29.25px;
            flex-direction: column;
            align-items: flex-start;
            border-radius: 8.125px;
            background: #FFF;
            box-shadow: 0px 2px 8px 0px rgba(0, 0, 0, 0.1);
        }
    
        .sector-box:hover {
            background: #FFF6EA;
        }
    
        .sector-box img {
            margin-bottom: 16.25px;
        }
    
        .sector-box h4 {
            margin-bottom: 22.75px;
        }
    
        .modal-header {
            border-bottom: none;
            padding-bottom: 0px;
        }
    
        .modal-footer {
            border-top: none;
            padding-top: 0px;
        }
    
        .modal-footer button {
            flex: 1 0 0;
            padding: 14px 20px;
            border: none;
            border-radius: 4px;
        }
    
        .custom-popup-body h4 {
            margin: 16px auto 13px auto;
            color: #4B5675;
            font-size: 22.75px;
            font-weight: 700;
            line-height: 27.3px;
        }
    
        .custom-popup-body p {
            color: #4B5675;
            font-size: 14px;
            font-style: normal;
            font-weight: 400;
            line-height: 20px;
            margin-bottom: 16px;
        }
    
        .manually-radio {
            position: relative;
        }
    
        .manually-radio input[type="radio"] {
            display: none;
        }
    
        .manually-radio input[type="radio"]:checked+.manually-modal-inner {
            border: 2px solid #F7941C !important;
        }
    
        .manually-modal-inner {
            border-radius: 16px;
            border: 2px solid #F1F1F4;
            padding: 16px;
            flex: 1 0 0;
            min-width: 32%;
            height: 150px;
            cursor: pointer;
        }
    
        .manually-modal-inner:hover {
            border: 2px solid #F7941C;
        }
    
        .manually-modal-inner .line {
            height: 2px;
            width: 100%;
            display: block;
            background-color: #F1F1F4;
        }
    </style>
@endsection
@section('content')

    <div class="d-flex flex-column flex-column-fluid">

        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">

            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">



                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                        Job Management
                    </h1>
                    <!--end::Title-->


                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="#" class="text-muted text-hover-primary">
                                Home </a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->

                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            Job Management </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->

                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            JD Master List </li>
                        <!--end::Item-->

                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
                <div class="d-flex ">
                    <div class="d-flex navtab-btn">
                        <a href="{{ route('jobs.savedJobs', ['saved_job' => 1]) }}"
                            class="tab-link {{ Route::currentRouteName() == 'jobs.savedJobs' ? '' : '' }}">
                            Company JDs
                        </a>
                                                <a href="{{ route('jobs.index', ['saved_job' => 0]) }}"
                            class="tab-link {{ Route::currentRouteName() == 'jobs.index' ? 'active-tab' : '' }}">
                            JD Master List
                        </a>
                    </div>

                </div>
            </div>

            {{-- <div class="d-flex align-items-center gap-2 gap-lg-3">
            <!--begin::Filter menu-->
            <div class="mx-3">
                <!--begin::Menu toggle-->
                <a href="#" class="btn btn-sm btn-flex btn-secondary fw-bold" data-kt-menu-trigger="click"
                    data-kt-menu-placement="bottom-end">
                    <iconify-icon icon="mingcute:filter-line" class="fa-1x" style="color: #78829D"></iconify-icon>
                    Filter
                </a>
                <!--end::Menu toggle-->

                <!--begin::Menu 1-->
                <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true"
                    id="kt_menu_65e95fe68ac03">
                    <!--begin::Header-->
                    <div class="px-7 py-5">
                        <div class="fs-5 text-gray-900 fw-bold">Filter Options</div>
                    </div>
                    <!--end::Header-->

                    <!--begin::Menu separator-->
                    <div class="separator border-gray-200"></div>
                    <!--end::Menu separator-->


                    <!--begin::Form-->
                    <div class="px-7 py-5">
                        <!--begin::Input group-->
                        <form action="">

                            <!--end::Input group-->

                            <div class="mb-10">
                                <!--begin::Label-->
                                <label class="form-label fw-semibold">Name:</label>
                                <!--end::Label-->

                                <!--begin::Input-->
                                <div>
                            <input type="text" class="form-control" name="sector_name" value="{{ request('sector_name') }}" placeholder="Search Sector By Name"> 
                                </div>
                                <!--end::Input-->
                            </div>

                    
                            <!--begin::Actions-->
                            <div class="d-flex justify-content-end">
                                <a href="/admin/setting/job-description" class="btn btn-sm btn-light btn-active-light-primary me-2"
                                    data-kt-menu-dismiss="true">Reset</a>

                                <button type="submit" class="btn btn-sm btn-primary"
                                    data-kt-menu-dismiss="true">Apply</button>
                            </div>
                        </form>
                        <!--end::Actions-->
                    </div>
                    <!--end::Form-->
                </div>
                <!--end::Menu 1-->
            </div>
            <!--end::Filter menu-->


        </div> --}}
            <!--end::Actions-->
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->

        <!--begin::Content-->
        <div id="kt_app_content" class="app-content  flex-column-fluid ">


            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container  container-xxl ">
                <!--begin::Stats-->
                <div class="d-flex justify-content-between">
                    <h1 class="m-0">Sectors</h1>
                    <div class="d-flex align-items-center gap-5">

                        <form data-kt-search-element="form"
                            class="search-wrapper " autocomplete="off">
                            <input type="text" class="search-input" placeholder="Search Sector"  name="sector_name"
                            value="{{ request('sector_name') }}">
                            <button class="search-icon" type="submit">
                                <iconify-icon icon="iconamoon:search-bold" width="16" height="16"></iconify-icon>
                            </button>
                        </form>

                        <div class="line-h"></div>
                        <a href="/admin/setting/job-description/view" class="btn-view-jd d-flex align-items-center gap-2">
                                <iconify-icon icon="f7:sparkles" class="mr-1" width="16" height="16"></iconify-icon>
                                View JD
                            </a>
                    </div>
                </div>
                <div class="row gx-6 gx-xl-9 mt-8">

                    @foreach ($data as $key => $value)
                        <div class="col-xl-4">

                            <!--begin::Statistics Widget 5-->
                            <a href="{{ route('admin.jobdescriptions', ['department' => $value['id'], 'saved_job' => request('saved_job')]) }}"
                                class="sector-box card-xl-stretch mb-xl-8">
                                <!--begin::Body-->
                                <div>

                                    @if (isset($value['icon']) && $value['icon'] != '')
                                        <img src="{{ $value['icon'] }}" width="64" height="64">
                                    @else
                                        <iconify-icon icon="arcticons:emoji-department-store" width="64"
                                            height="64"></iconify-icon>
                                    @endif
                                    <div class="card-heading fs-2 mt-5">
                                        {{ $key }}

                                    </div>

                                    <div class="card-number fs-2 mb-2 mt-7">

                                        {{ $value['count'] }} <span> total JDs</span></div>

                                </div>
                                <!--end::Body-->
                            </a>
                            <!--end::Statistics Widget 5-->
                        </div>
                    @endforeach



                </div>
                <!--end::Stats-->
            </div>
            <!--end::Content container-->


        </div>
        <!--end::Content-->

    </div>


@endsection

@section('scripts')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            var maxLength = 100; // maximum number of characters to show initially

            // Using event delegation
            $(document).on('click', '.view-more', function(event) {
                event.preventDefault();
                var $description = $(this).closest('.description');
                var $fullDescription = $description.find('.full-description');
                var $trimmedDescription = $description.find('.trimmed-description');

                $trimmedDescription.toggle();
                $fullDescription.toggle();

                $(this).text(function(_, text) {
                    return text === "View More" ? "View Less" : "View More";
                });
            });

            $('.description').each(function() {
                var $description = $(this);
                var $fullDescription = $description.find('.full-description');
                var $trimmedDescription = $description.find('.trimmed-description');

                var fullText = $fullDescription.text();
                var trimmedText = fullText.substring(0, maxLength).trim();

                $trimmedDescription.text(trimmedText + '...');
                $fullDescription.hide();
            });
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script type="text/javascript">
        $('.show_confirm').click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                    title: `Are you sure you want to delete this record?`,
                    text: "If you delete this, it will be gone forever.",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
        });
    </script>
@endsection
