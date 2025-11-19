@extends('admin.layout.app')

@section('title', 'Users')
@section('styles')
<style>
    .image-input-placeholder {
        background-image: url({{asset("admin/media/svg/files/blank-image.svg")}});
    }

    [data-bs-theme="dark"] .image-input-placeholder {
        background-image: url({{asset("admin/media/svg/files/blank-image-dark.svg")}});
    }

    .import{
        margin-left: 11px;
    }

    .search-actions{
        margin-right: 12px;
    }
</style>
@endsection
@section('content')
@if (session('success'))
    <div id="success-message" class="alert alert-success">
        {{ session('success') }}
    </div>
@endif


<div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">

    <!--begin::Toolbar container-->
    <div id="kt_app_toolbar_container" class="app-container  container-fluid d-flex flex-stack ">


        <!--begin::Page title-->
        <div data-kt-swapper="true" data-kt-swapper-mode="{default: 'prepend', lg: 'prepend'}"
            data-kt-swapper-parent="{default: '#kt_app_content_container', lg: '#kt_app_toolbar_container'}"
            class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5 mb-lg-0">
            <!--begin::Title-->
            <h1 class="page-heading capitalize d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                Descriptor 
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
                <li class="breadcrumb-item capitalize text-muted">
                    Descriptor</li>
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

<!--begin::Content-->
<div id="kt_app_content" class="app-content  flex-column-fluid ">


    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container  ">
        <!--begin::Card-->
        <div class="card">
            <!--begin::Card header-->
            <div class="card-header border-0 pt-6">
                <!--begin::Card title-->
                <div class="card-title">
                    <h2 class="capitalize"> Descriptor List</h2>
                </div>
                <!--begin::Card title-->

                <!--begin::Card toolbar-->
                <div class="card-toolbar">

                <!-- <div class="search-actions mt-3">
                        <form action="{{route('descriptors.index')}}" method="GET">
                            <div class="input-group mb-3">
                                <input type="text" name="search" class="form-control" placeholder="Search Name" value="{{ request('search') }}">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">Search</button>
                                </div>
                            </div>
                        </form>
        
                     
                    </div> -->
                    <!--begin::Toolbar-->
                    <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                        <!--begin::Filter-->
                         <button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click"
                            data-kt-menu-placement="bottom-end">
                            <iconify-icon icon="mingcute:filter-line" class="fa-1x"></iconify-icon>
                            Filter
                        </button>
                        <!--begin::Menu 1-->
                        <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true">
                            <!--begin::Header-->
                            <div class="px-7 py-5">
                                <div class="fs-5 text-gray-900 fw-bold">Filter Options</div>
                            </div>
                            <!--end::Header-->

                            <!--begin::Separator-->
                            <div class="separator border-gray-200"></div>
                            <!--end::Separator-->

                            <!--begin::Content-->
                            <form method="GET" action="{{ route('descriptors.index') }}">
        <div class="px-7 py-5" data-kt-user-table-filter="form"">
            <!-- Assessment Type -->
                <!-- Name -->
            <div class="mb-10">
                <label class="form-label fs-6 fw-semibold">Name</label>
                <input type="text" name="name" value="{{ request('name') }}" class="form-control" placeholder="Search by Name">
            </div>

                       <!-- Result Type -->
                       <div class="mb-10">
                <label class="form-label fs-6 fw-semibold">Result Type</label>
                <select name="result_type" class="form-select form-select-solid fw-bold" data-kt-select2="true">
                    <option value="">Select Result Type</option>
                    <option value="domains" {{ request('result_type') == 'domains' ? 'selected' : '' }}>Domains</option>
                    <option value="all_facets" {{ request('result_type') == 'all_facets' ? 'selected' : '' }}>All Facets</option>
                    <option value="job_match_rate" {{ request('result_type') == 'job_match_rate' ? 'selected' : '' }}>Job Match Rate</option>

                    <option value="cognitive_assessment" {{ request('result_type') == 'cognitive_assessment' ? 'selected' : '' }}>Cognitive Assessment</option>
                    <option value="technical_assessment" {{ request('result_type') == 'technical_assessment' ? 'selected' : '' }}>Technical Assessment</option>
                    <option value="growth_potential" {{ request('result_type') == 'growth_potential' ? 'selected' : '' }}>Growth Potential</option>
                    <option value="organization_fit_forecast" {{ request('result_type') == 'organization_fit_forecast' ? 'selected' : '' }}>Organization Fit Forecast</option>
                    <option value="flight_risk" {{ request('result_type') == 'flight_risk' ? 'selected' : '' }}>Flight Risk</option>
                    <option value="soft_skills" {{ request('result_type') == 'soft_skills' ? 'selected' : '' }}>Soft Skills</option>
                    <option value="ccs" {{ request('result_type') == 'ccs' ? 'selected' : '' }}>CCS</option>
                </select>
            </div>
            
            <div class="mb-10">
                <label class="form-label fs-6 fw-semibold">Assessment Type</label>
                <select name="assessment_type" class="form-select form-select-solid fw-bold" data-kt-select2="true">
                    <option value="">Select Assessment Type</option>
                    <option value="ocean" {{ request('assessment_type') == 'ocean' ? 'selected' : '' }}>OCEAN</option>
                    <option value="riasec" {{ request('assessment_type') == 'riasec' ? 'selected' : '' }}>RIASEC</option>
                    <option value="cognitive" {{ request('assessment_type') == 'cognitive' ? 'selected' : '' }}>Cognitive</option>
                </select>
            </div>  

            <!-- User Type -->
            <div class="mb-10">
                <label class="form-label fs-6 fw-semibold">User Type</label>
                <select name="user_type" class="form-select form-select-solid fw-bold" data-kt-select2="true">
                    <option value="">Select User Type</option>
                    <option value="employee" {{ request('user_type') == 'employee' ? 'selected' : '' }}>Employee</option>
                    <option value="candidate" {{ request('user_type') == 'candidate' ? 'selected' : '' }}>Candidate</option>
                </select>
            </div>

            <!-- Is Descriptor -->
            <!-- <div class="mb-10">
                <label class="form-label fs-6 fw-semibold">Is Descriptor</label>
                <select name="is_descriptor" class="form-select form-select-solid fw-bold" data-kt-select2="true">
                    <option value="">Select</option>
                    <option value="1" {{ request('is_descriptor') == '1' ? 'selected' : '' }}>Checked</option>
                    <option value="0" {{ request('is_descriptor') == '0' ? 'selected' : '' }}>Unchecked</option>
                </select>
            </div> -->

            <!-- Submit and Reset -->
            <div class="col-md-12 d-flex justify-content-end">
                <button type="reset" class="btn btn-light me-2" onclick="window.location='{{ route('descriptors.index') }}'">Reset</button>
                <button type="submit" class="btn btn-primary">Apply</button>
            </div>
        </div>
    </form>
                            <!--end::Content-->
                        </div> 
                        <!--end::Menu 1-->
                        <!--end::Filter-->

                        <!--begin::Export-->
                        {{-- <button type="button" class="btn btn-light-primary me-3 d-flex align-items-center" data-bs-toggle="modal"
                            data-bs-target="#kt_modal_export_users">
                            <iconify-icon icon="uil:import" class="fa-1-5"></iconify-icon> Import
                        </button> --}}
                        <!--end::Export-->

                        <!--begin::Add user-->
                   
                        <a href="{{route('descriptors.create')}}" class="btn btn-primary d-flex align-items-center">
                            <iconify-icon icon="charm:plus"></iconify-icon>
                             Add Descriptor
                        </a> 
                        
                        <!--end::Add user-->
                    </div>
                    <!--end::Toolbar-->
                    <a href="{{route('descriptors.file')}}" class="btn btn-primary d-flex align-items-center import">
                          
                        Import
                   </a> 
                    <!--begin::Group actions-->
                    <div class="d-flex justify-content-end align-items-center d-none"
                        data-kt-user-table-toolbar="selected">
                        <div class="fw-bold me-5">
                            <span class="me-2" data-kt-user-table-select="selected_count"></span> Selected
                        </div>

                        <button type="button" class="btn btn-danger" data-kt-user-table-select="delete_selected">
                            Delete Selected
                        </button>
                    </div>
                    <!--end::Group actions-->


                </div>
                <!--end::Card toolbar-->
            </div>
            <!--end::Card header-->

            <!--begin::Card body-->
            <div class="card-body py-4">
                <!--begin::Table-->
                <table class="table align-middle table-row-dashed fs-6 gy-5 text-center" id="kt_table_users">
                    <thead>
                        <tr class="text-muted fw-bold fs-7 text-uppercase gs-0">
                   <th class="min-w-20px text-center">Name</th>
                   <th class="min-w-20px text-center">Assessment Type</th>
                   <th class="min-w-20px text-center">Result Type</th>
                   <th class="min-w-20px text-center">User Type</th>
                   <th class="min-w-20px text-center">Code</th>
                   <th class="min-w-20px text-center">Job Requirment Level</th>
                   <th class="min-w-20px text-center">Population Score Level</th>
                   <th class="min-w-20px text-center">Analysis</th>
                   <th class="min-w-20px text-center">User Score Level</th>
                   <th class="min-w-20px text-center">Analysis Population</th>
                   <th class="min-w-20px text-center">Job Requirement Level Description</th>
                   <th class="min-w-20px text-center">User Score Level Description</th>
                   <th class="min-w-20px text-center">Population Score Level Description</th>

                    <th class="min-w-20px text-center">Action</th>

                        </tr>
                    </thead>
                    <tbody class="text-gray-600 fw-semibold">
                        @foreach($descriptor as $value)
                        <tr>
                            <td class="text-center">{{ $value->name }}</td>
                            <td class="text-center">{{ $value->assessment_type }}</td>
                            <td class="text-center">{{ $value->result_type }}</td>
                            <td class="text-center">{{ $value->user_type }}</td>
                            <td class="text-center">{{ $value->code }}</td>
                            <td class="text-center">{{ $value->job_requirement_level ?? '-' }}</td>
                            <td class="text-center">{{ $value->population_score_level ?? '-' }}</td>
                            <td class="text-center">{{ $value->analysis ?? '-' }}</td>
                            

                            <td class="text-center">
    {{ config('helpers.user_score_level')[$value->user_score_level] ?? 'Data Not Available' }}
</td>
                            <td class="text-center">{{ $value->analysis_population ?? '-' }}</td>
                            <td class="text-center">{{ $value->job_requirement_level_description ?? '-' }}</td>
                            <td class="text-center">{{ $value->user_score_level_description ?? '-' }}</td>
                            <td class="text-center">{{ $value->population_score_level_description ?? '-' }}</td>

                            
                            <td class="text-center">
                                <a href="{{ route('descriptors.edit', $value->id) }}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                    <iconify-icon icon="heroicons-outline:pencil-alt" class="fa-1-5"></iconify-icon>
                                </a>
                                <form action="{{ route('descriptors.destroy', $value->id) }}" id="form-{{ $value->id }}" class="d-inline" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm mb-1 show_confirm" custom1="{{ $value->id }}">
                                        <iconify-icon icon="iconamoon:trash-light" class="fa-1-5"></iconify-icon>
                                    </button>
                                </form>           
                            </td>
                        </tr>
                    @endforeach
    
                    </tbody>
                </table>
                <!--end::Table-->
            </div>
            <div class="card-footer">
                {{ $descriptor->links() }} <!-- Pagination links -->
            </div>
            
            <!--end::Card body-->
        </div>
        <!--end::Card-->
    </div>
    <!--end::Content container-->
</div>
<!--end::Content-->


   <!--begin::Modal - Adjust Balance-->

<!--end::Modal - New Card-->


@endsection
@section('scripts')
<script src="{{asset('admin/js/custom/apps/user-management/users/list/table.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script type="text/javascript">
    $('.show_confirm').click(function(event) {
        var form = $('#form-'+ $(this).attr('custom1'));
        var name = $(this).data("name");



        event.preventDefault();
        swal({
                title: `Are you sure you want to delete this department?`
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
<script>
    $(document).ready(function() {
        $('.status-toggle').change(function() {
            var departmentId = $(this).data('id');
            var status = $(this).is(':checked') ? '1' : '0';
            $.ajax({
                url: '/admin/mydepartment/' + departmentId + '/status',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    status: status
                },
                success: function(response) {
                    if (response.success) {
                        $('#flexSwitchCheckChecked_' + departmentId).next('label').text(status.charAt(0).toUpperCase() + status.slice(1));
                        toastr.success('Successfully Updated','Status')
                    } else {
                        alert('Failed to update status.');
                    }
                }
            });
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var successMessage = document.getElementById('success-message');
        if (successMessage) {
            setTimeout(function() {
                successMessage.style.display = 'none';
            }, 5000); // Hide after 5 seconds
        }
    });
</script>

@endsection



