@extends('employee.layout.app')

@section('title', 'Survey')
@section('content')




    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">

        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">



            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                    Dashboard
                </h1>
                <!--end::Title-->


                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="/dashboard" class="text-muted text-hover-primary">
                            @if(auth()->user()->isEmployee())
                            Employee
                        @else
                        Candidate
                    @endif  </a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->

                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        Technnical Assessment </li>
                    <!--end::Item-->

                </ul>
                <!--end::Breadcrumb-->
            </div>


            <!--end::Page title-->

            <!--end::Actions-->
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
                    <h2 class="capitalize"> Technical Assessment List</h2>
                </div>
                <!--begin::Card title-->

                <!--begin::Card toolbar-->
                <div class="card-toolbar">
                    <!--begin::Toolbar-->
                    <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                        <!--begin::Filter-->
                        {{-- <button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click"
                            data-kt-menu-placement="bottom-end">
                            <i class="ki-duotone ki-filter fs-2"><span class="path1"></span><span
                                    class="path2"></span></i> Filter
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
                            <div class="px-7 py-5" data-kt-user-table-filter="form">
                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <label class="form-label fs-6 fw-semibold">Role:</label>
                                    <select class="form-select form-select-solid fw-bold" data-kt-select2="true"
                                        data-placeholder="Select option" data-allow-clear="true"
                                        data-kt-user-table-filter="role" data-hide-search="true">
                                        <option></option>
                                        <option value="Administrator">Administrator</option>
                                        <option value="Analyst">Analyst</option>
                                        <option value="Developer">Developer</option>
                                        <option value="Support">Support</option>
                                        <option value="Trial">Trial</option>
                                    </select>
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <label class="form-label fs-6 fw-semibold">Two Step
                                        Verification:</label>
                                    <select class="form-select form-select-solid fw-bold" data-kt-select2="true"
                                        data-placeholder="Select option" data-allow-clear="true"
                                        data-kt-user-table-filter="two-step" data-hide-search="true">
                                        <option></option>
                                        <option value="Enabled">Enabled</option>
                                    </select>
                                </div>
                                <!--end::Input group-->

                                <!--begin::Actions-->
                                <div class="d-flex justify-content-end">
                                    <button type="reset"
                                        class="btn btn-light btn-active-light-primary fw-semibold me-2 px-6"
                                        data-kt-menu-dismiss="true" data-kt-user-table-filter="reset">Reset</button>
                                    <button type="submit" class="btn btn-primary fw-semibold px-6"
                                        data-kt-menu-dismiss="true" data-kt-user-table-filter="filter">Apply</button>
                                </div>
                                <!--end::Actions-->
                            </div>
                            <!--end::Content-->
                        </div> --}}
                        <!--end::Menu 1-->
                        <!--end::Filter-->

                        <!--begin::Export-->
                        {{-- <button type="button" class="btn btn-light-primary me-3 d-flex align-items-center" data-bs-toggle="modal"
                            data-bs-target="#kt_modal_export_users">
                            <iconify-icon icon="uil:import" class="fa-1-5"></iconify-icon> Import
                        </button> --}}
                        <!--end::Export-->

                        <!--begin::Add user-->
                
                        
                        <!--end::Add user-->
                    </div>
                    <!--end::Toolbar-->

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

             
                    <!--end::Add user-->
               
                <!--begin::Table-->
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
                    <thead>
                        <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                            {{-- <th class="w-10px pe-2">
                                <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                    <input class="form-check-input" type="checkbox" data-kt-check="true"
                                        data-kt-check-target="#kt_table_users .form-check-input" value="1" />
                                </div>
                            </th> --}}
                            <th class="min-w-20px text-center">Title</th>

                            <th class="min-w-20px text-center">Questions</th>


                            {{-- <th class="min-w-20px text-center">Description</th>

                            <th class="min-w-20px text-center">Status</th> --}}
                

                            <th class="min-w-20px text-center">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="text-gray-600 fw-semibold">
                        @foreach($technicalAss as $value)

                      
                        <tr>

                            <td class="text-center">
                             {{-- {{$value->job->title}} --}}
                            </td>

                            <td class="text-center">
                                {{ $value->question_count }}

                               </td>

                            {{-- <td class="text-center">
                                {{$value->description}}
                               </td> --}}
                          
                           {{-- @php $technicalResult = App\Models\TechnicalQuestionUserResponse::where('user_id',auth()->user()->id)->where('id',$value->id)->count();@endphp
                       
                            <td class="text-center">
                                    @if ($technicalResult > 0)
                                    Completed
                                @else
                                    Not Completed
                                @endif
                            </td> --}}
                            {{-- <td> {{$value->description}}</td> --}}
                           


                          
                            <td class="text-center">    
                            

                                {{-- @if (!$technicalQuestionUserResponse) <!-- Only show button if not completed --> --}}
                                <a href="{{ route('employee.technicalAss.start', $value->job_id) }}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                    <i class="fas fa-play fa-1-5" style="font-size: 1.5em; color: #007bff;"></i>
                                </a>
                                {{-- @endif --}}
                            </td>


                        
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
                <!--end::Table-->
                {{-- {{ $survey->links() }} --}}
               
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







