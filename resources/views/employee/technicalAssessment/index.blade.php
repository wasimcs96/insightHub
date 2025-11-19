@extends('admin.layout.app')

@section('title', 'Technica Assessment Dashboard')
@section('styles')


    <style>
        .empty-state {
            margin-top: 28px;
            display: flex;
            height: 440px;
            padding: 24px;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            border-radius: 8px;
            border: 1px solid #ECF0F3;
            background: #F5F7F8;
        }

        .empty-state p {
            color: #727790;
            text-align: center;
            font-size: 20px;
            font-weight: 600;
        }

        .circle {
            width: 160px;
            height: 160px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            position: relative;
        }

        .circle-completed {
            border: 10px solid #f7931e;

        }

        .circle-incompleted {
            border: 10px solid #a5a5a5;

        }

        .circle span {
            font-size: 18px;
            color: #f7931e;
            font-weight: 700;
        }

        .circle p {
            font-size: 12px;
            color: #666;
            position: absolute;
            bottom: -20px;
            width: 100%;
            text-align: center;
        }

        .custom-card {
            padding: 28px 28px 29px 28px;
            border-radius: 8px;
            border: 1.5px solid #ECF0F3;
            background: #FFF;
        }
    </style>
@endsection

@section('content')




    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">

        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">



            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                    Technical Assessment
                </h1>
                <!--end::Title-->


                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        Dashboard
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
    <div id="kt_app_content" class="app-content  flex-column-fluid">
        <div id="kt_app_content_container" class="app-container  container-xxl">

            @if ($job && $job->technicalQuestions->count() > 0)
                <div class="row mb-5 ms-0 me-0 justify-content-center mt-0">
                    <!-- begin::Assessment Chart Section -->
                    <div class="row g-5 g-xl-8 d-flex mb-9 upper-cards"
                        style="justify-content: space-between; flex-wrap: wrap;  margin-bottom: 2.25rem !important">
                        <!-- begin:chart1 (Personality & Motivation) -->
                        <div class="custom-card mt-0 rounded-20px shadow-sm">
                            {{-- {{ dd(auth()->user()->getJobPositionNameAttribute()) }} --}}
                            <h3 class="card-title d-flex justify-content-center m-auto" style="font-size: 24px;">
                                {{ $job->title ?? '' }} Technical Assessment
                                {{-- @if (auth()->user()->is_personality_motivation_completed == 1)
                                <a href="/quiz/five-factor/results" type="button" class="fs-7" style="color: #f7931e;">
                                    Show result
                                </a>
                            @endif --}}
                            </h3>
                            <div class="card-toolbar">
                            </div>
                            <div class="card-body mt-11 p-0">
                                <div
                                    class="circle @if (auth()->user()->is_technical_assessment_completed == 1) circle-completed  @else circle-incompleted @endif">
                                    @if (auth()->user()->is_technical_assessment_completed == 1)
                                        <span class="text-center">Completed</span>
                                    @else
                                        <a href="/technicalAssessment/start/{{ $job->id }}" class="text-center text-primary fw-medium">Start
                                            Assessment</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- end:chart 1 (Personality & Motivation) -->


                    </div>
                </div>
            @else
                <div class="empty-state">
                    {{-- {{ dd(auth()->user()->getJobPositionNameAttribute()) }} --}}
                    <p class="m-0 w-75">No technical assessment is available for your job position at this time.
                    </p>
                </div>
            @endif

        </div>
    </div>
    <!--end::Content-->


    <!--begin::Modal - Adjust Balance-->

    <!--end::Modal - New Card-->


@endsection
@section('scripts')
    <script src="{{ asset('admin/js/custom/apps/user-management/users/list/table.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script type="text/javascript">
        $('.show_confirm').click(function(event) {
            var form = $('#form-' + $(this).attr('custom1'));
            var name = $(this).data("name");



            event.preventDefault();
            swal({
                    title: `Are you sure you want to delete this department?`,
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
                            $('#flexSwitchCheckChecked_' + departmentId).next('label').text(
                                status.charAt(0).toUpperCase() + status.slice(1));
                            toastr.success('Successfully Updated', 'Status')
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
