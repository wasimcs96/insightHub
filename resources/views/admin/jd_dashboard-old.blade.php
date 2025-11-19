<!-- job.index.blade.php -->

@extends('admin.layout.app')

@section('title', 'Setting - Job Descriptions')

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
                        JD Master List </li>
                    <!--end::Item-->

                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->

            <div>
                <a href="{{ route('jobs.index',['saved_job'=>0]) }}" class="btn btn-sm fw-bold btn-primary {{ Route::currentRouteName() == 'jobs.index' ? 'active' : '' }}">
                    JD Master List
                </a>
                
                <a href="{{ route('jobs.savedJobs',['saved_job'=>1]) }}" class="btn btn-sm fw-bold btn-primary {{ Route::currentRouteName() == 'jobs.savedJobs' ? 'active' : '' }}">
                    Company JDs
                </a>
                
                <a href="{{ route('jobs.create') }}" class="btn btn-sm fw-bold btn-primary {{ Route::currentRouteName() == 'jobs.create' ? 'active' : '' }}">
                    Create New JD
                </a>

                

            </div>
        </div>

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


            <!--begin::Secondary button-->
            <!--end::Secondary button-->

            <!--begin::Primary button-->
            {{-- <a href="#" class="btn btn-sm fw-bold btn-primary" data-bs-toggle="modal"
            data-bs-target="#kt_modal_create_app">
            Create </a> --}}
            <!--end::Primary button-->
        </div>
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
        
                        @foreach($data as $key => $value)
                        
                    
                        <div class="col-xl-4">
        
                            <!--begin::Statistics Widget 5-->
                            <a href="{{ route('admin.jobdescriptions',['department'=>$value['id'],'saved_job'=>request('saved_job')]) }}" class="card bg-primary hoverable card-xl-stretch mb-xl-8">
                                <!--begin::Body-->
                                <div class="card-body">
                                  
                                    @if(isset($value['icon']) && $value['icon'] != "" )
                                    <img src="{{ $value['icon'] }}" width="64" height="64">
                                    @else
                                    <iconify-icon icon="arcticons:emoji-department-store" width="64" height="64"></iconify-icon>

                                    @endif
                                    <div class="text-white fw-bold fs-2 mb-2 mt-5">
                                        {{ $key }}
        
                                    </div>
        
                                    <div class="fw-bold fs-2 mb-2 mt-5">
        
                                        {{ $value['count'] }}</div>
        
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
                title: `Are you sure you want to delete this record?`
                , text: "If you delete this, it will be gone forever."
                , icon: "warning"
                , buttons: true
                , dangerMode: true
            , })
            .then((willDelete) => {
                if (willDelete) {
                    form.submit();
                }
            });
    });

</script>
@endsection
