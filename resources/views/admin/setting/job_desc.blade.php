<!-- job.index.blade.php -->

@extends('admin.layout.app')

@section('title', 'Setting - Job Descriptions')

@section('content')

<div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">

    <!--begin::Toolbar container-->
    <div id="kt_app_toolbar_container" class="app-container  container-fluid d-flex flex-stack ">


        <!--begin::Page title-->
        <div data-kt-swapper="true" data-kt-swapper-mode="{default: 'prepend', lg: 'prepend'}"
            data-kt-swapper-parent="{default: '#kt_app_content_container', lg: '#kt_app_toolbar_container'}"
            class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5 mb-lg-0">
            <!--begin::Title-->
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                Settings
            </h1>
            <!--end::Title-->


            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">

                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">
                    <a href="/admin/dashboard" class="text-muted text-hover-primary">
                        Dashboard </a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <!--end::Item-->

                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">
                    Settings </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">
                    Job Description </li>
                <!--end::Item-->

            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
        <!--begin::Action group-->
        <!--begin::Toolbar end-->

        <!--end::Toolbar end-->
        <!--end::Action group-->
    </div>
    <!--end::Toolbar container-->
</div>


<div id="kt_app_content" class="app-content  flex-column-fluid ">

    <div id="kt_app_content_container" class="app-container  w-100 ">
        <div class="card mb-5 mb-xl-8 col-lg-12">
            <div class="card-body flex flex-col p-6">
                <div class="card-text h-full">

                    @include('admin.setting.includes.topnav')
                    <div class="tab-content" id="pills-tabContentHorizontal">
                        <div class="" id="pills-contactHorizontal" role="tabpanel"
                            aria-labelledby="pills-contact-tabHorizontal">
                            <div class="card mb-5 mb-xl-8">
                                <!--begin::Header-->
                                <div class="card-header border-0 pt-5">
                                    <h3 class="card-title align-items-start flex-column">
                                        <span class="card-label fw-bold fs-3 mb-1">Job Descriptions</span>


                                    </h3>
                                    <div class="card-toolbar">
                                        <a href="{{ route('jobs.create') }}" class="align-items-center btn btn-light-primary btn-sm d-flex">
                                            <iconify-icon class="text-xl ltr:mr-2 rtl:ml-2 ml-2" icon="heroicons-outline:plus"></iconify-icon> Create
                                        </a>
                                    </div>
                                </div>
                                <!--end::Header-->

                                <!--begin::Body-->
                                <div class="card-body py-3">
                                    <!--begin::Table container-->
                                    <div class="table-responsive">
                                        <!--begin::Table-->
                                        <table class="table align-middle gs-0 gy-4">
                                            <!--begin::Table head-->
                                            <thead>
                                                <tr class="fw-bold text-muted bg-light">
                                                    <th class="ps-4 min-w-325px rounded-start">Job Title</th>
                                                    <th class="min-w-125px">Job Description</th>
                                                    <th class="min-w-200px text-end rounded-end"></th>
                                                </tr>
                                            </thead>
                                            <!--end::Table head-->

                                            <!--begin::Table body-->
                                            <tbody>
                                                @foreach ($jobs as $job)
                                                <tr>
                                                    <td>

                                                            <div class="d-flex justify-content-start flex-column">
                                                                <a href="{{ route('jobs.edit', $job->id) }}" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">{{ $job->title }}</a>
                                                            </div>

                                                    </td>

                                                    <td>
                                                        <div class="description">
                                                            <!-- Your long description from the database -->
                                                            <p class="full-description">{{ $job->description }}</p>
                                                            <p class="trimmed-description"></p>
                                                            <a href="#" class="color- text-indigo-500 view-more">View More</a>
                                                        </div>
                                                    </td>



                                                    <td class="text-end">
                                                        <a href="{{ route('jobs.edit', $job->id) }}"
                                                            class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                            <iconify-icon icon="heroicons:pencil-square" class="fa-1-5"></iconify-icon>
                                                        </a>
                                                        <form action="{{ route('jobs.destroy', $job->id) }}" class="btn btn-icon " method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                        <button type="submit" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm">
                                                            <iconify-icon icon="heroicons:trash" class="fa-1-5"></iconify-icon>
                                                        </button>
                                                    </form>

                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            <!--end::Table body-->
                                        </table>
                                        <!--end::Table-->
                                    </div>
                                    <!--end::Table container-->
                                </div>
                                <!--begin::Body-->
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

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
