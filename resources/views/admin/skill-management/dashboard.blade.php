@extends('admin.layout.app')

@section('title', 'Setting - Job Descriptions')
@section('styles')
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

        .btn-view-skill {
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

        input:focus-visible {
            outline: none !important;
            box-shadow: none !important;
        }

        .search-input {
            width: 270px;
            border-radius: 4px;
            border: 1px solid #C4CADA;
            background: #FFF;
            color: #99A1B7;
            font-size: 12px;
            font-weight: 400;
            height: 32px;
        }

        .sector-main {
            margin: 28px 0px;
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
            color: #000;
        }

        .sector-box p {
            color: #000;
            font-size: 28px;
            font-weight: 400;
            line-height: 24px;
            letter-spacing: 0.15px;
        }

        .sector-main a {
            color: #000;
        }

        .sector-box p span {
            color: #4B5675;
            font-size: 16px;
        }

        .trimmed-description {
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }
    </style>
@endsection
@section('content')

    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">
            <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                    <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                        Technical Skills Management
                    </h1>
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="#" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">Technical Skills Master List</li>
                    </ul>
                </div>
                <div class="d-flex align-items-center gap-5">
                    <div class="navtab-btn">
                        <a href="{{ url('/admin/company/sector-skills') }}"
                            class="tab-link {{ request()->is('/admin/company/sector-skills') ? 'active-tab' : '' }}">
                            Company Technical Skills
                        </a>

                        <a href="{{ url('admin/skill-management/dashboard') }}"
                            class="tab-link {{ request()->is('admin/skill-management/dashboard') ? 'active-tab' : '' }}">
                            Technical Skills Master List
                        </a>
                    </div>

                    <div class="line-h"></div>
                    <a href="/admin/skill-management/search"><button class="btn-view-skill d-flex align-items-center">
                            <iconify-icon icon="f7:sparkles" class="mr-1" width="16" height="16"></iconify-icon>
                            View
                            Skill
                        </button></a>
                </div>
            </div>
        </div>

        <div id="kt_app_content" class="app-content  flex-column-fluid ">
            <div id="kt_app_content_container" class="app-container  container-xxl ">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="m-0">Sectors</h1>
                    <form data-kt-search-element="form" class="d-none d-lg-block mb-5 mb-lg-0 position-relative"
                        autocomplete="off">
                        <input type="hidden">
                        <iconify-icon icon="stash:search-solid"
                            class=" fs-2 text-gray-500 position-absolute top-50 translate-middle-y ms-4"></iconify-icon>
                        <input type="text" class="search-input pl-5" name="sector_name"
                            value="{{ request('sector_name') }}" placeholder="Search Sector By Name" style="padding-left: 40px;">
                        <span class="position-absolute top-50 end-0 translate-middle-y lh-0 d-none me-5"
                            data-kt-search-element="spinner">
                            <span class="spinner-border h-15px w-15px align-middle text-gray-500"></span>
                        </span>
                        <span
                            class="btn btn-flush btn-active-color-primary position-absolute top-50 end-0 translate-middle-y lh-0 d-none me-4"
                            data-kt-search-element="clear">
                            <i class="ki-duotone ki-cross fs-2 me-0"><span class="path1"></span><span
                                    class="path2"></span></i> </span>
                    </form>
                </div>
                <div class="sector-main">
                    @foreach ($data as $key => $value)
                        <a href="{{ route('admin.skills_management.sector.skills', $value['id']) }}" class="sector-box">
                            <div>
                                @if (isset($value['icon']) && $value['icon'] != '')
                                    <img src="{{ $value['icon'] }}" width="64" height="64">
                                @else
                                    <iconify-icon icon="arcticons:emoji-department-store" width="64"
                                        height="64" style="color: #F7941D;"></iconify-icon>
                                @endif
                                <h4>
                                    {{ $key }}
                                </h4>
                                <p class="m-0">
                                    {{$value['count']}} <span>Total Technical Skills</span></p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            var maxLength = 100;
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
    