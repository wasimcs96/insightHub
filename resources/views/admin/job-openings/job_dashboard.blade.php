<!-- job.index.blade.php -->

@extends('admin.layout.app')

@section('title', 'Setting - Job Descriptions')
@section('styles')
<style>
    a.bg-primary:focus, a.bg-primary:hover, button.bg-primary:focus, button.bg-primary:hover {
    background-color: #000000 !important;
    color: white;
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
                        Job Advertisement Dashboard
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
                            Job Advertisement Dashboard </li>
                        <!--end::Item-->

                    </ul>
                    <!--end::Breadcrumb-->
                    
                </div>
                <!--end::Page title-->
                <div class="card-toolbar">
                    <a href="{{ route('admin.job-openings.create-form') }}" class="btn btn-sm btn-light-primary fs-4">
                        <iconify-icon icon="mdi:plus"></iconify-icon> Create Job Advertisements
                    </a>
                </div>

            </div>
            {{-- 
        <div class="d-flex align-items-center gap-2 gap-lg-3">
            <!--begin::Filter menu-->
            <div class="mx-3">
                <!--begin::Menu toggle-->
                <a href="#" class="btn btn-sm btn-flex btn-secondary fw-bold" data-kt-menu-trigger="click"
                    data-kt-menu-placement="bottom-end">
                    <iconify-icon icon="mingcute:filter-line" class="fa-1x"></iconify-icon>
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
                            <input type="text" class="form-control" name="sector_name" placeholder="Search Sector By Name"> 
                                </div>
                                <!--end::Input-->
                            </div>

                    
                            <!--begin::Actions-->
                            <div class="d-flex justify-content-end">
                                <a href="/admin/dashboard" class="btn btn-sm btn-light btn-active-light-primary me-2"
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
                <div class="row gx-6 gx-xl-9">

                    @foreach ($data as $key => $value)
                        <div class="col-xl-4 mb-xl-8">

                            <!--begin::Statistics Widget 5-->
                            <a href="{{ route('admin.job-openings.index', ['department_id' => $value->id]) }}"
                                class="card bg-primary hoverable card-xl-stretch h-100">
                                <!--begin::Body-->
                                <div class="card-body">
                                    <iconify-icon icon="{{ $value->icon ?? 'arcticons:emoji-department-store' }}"
                                        width="64" height="64"></iconify-icon>

                                    <div class="text-white fw-bold fs-2 mb-2 mt-5">
                                        {{ $value->name ?? '' }}

                                    </div>

                                    <div class="d-flex justify-content-between">
                                        <div class="fw-bold fs-3 mb-2 mt-5">
                                            Job Positions: {{$value->total_job_positions ?? 0}}
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between">
                                        <div class="fw-bold fs-3 mb-2 mt-5">
                                            Total Employee Required: {{$value->total_heads ?? 0}}
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between">
                                        <div class="fw-bold fs-3 mb-2 mt-5">
                                            Total Vacancies: {{$value->total_vacancies ?? 0}}
                                        </div>
                                    </div>
                                    
                                    <div class="d-flex justify-content-between">
                                        <div class="fw-bold fs-3 mb-2 mt-5">
                                            Job Openings Posted: {{ count($value->jobOpenings) }}
                                            {{ $value['count'] }}
                                        </div>
                                       
                                    </div>
                                    

                                    <div class="d-flex justify-content-between">
                                    
                                        <div class="fw-bold fs-3 mt-5">
                                            @php
                                            $totalApplicants = $value->jobOpenings->sum(function ($jobOpening) {
                                                return $jobOpening->job_applications->count();
                                            });
        
                                
                                            @endphp
                                            Total Applicants: {{ $totalApplicants }}
                                            
                                        </div>
                                    </div>

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
@section('styles')
    <style>
        .trimmed-description {
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }
    </style>

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
