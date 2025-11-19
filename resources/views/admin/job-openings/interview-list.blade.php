@extends('admin.layout.app')

@section('title', 'Interview List')

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
                Interview List
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
                    Interview List </li>
                <!--end::Item-->

            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
        <!--begin::Action group-->
        <!--begin::Toolbar end-->
        <form class="d-flex align-items-center overflow-auto" action="">

                <span class="fs-7 fw-bold text-gray-700 flex-shrink-0 pe-4 d-none d-md-block">Job Advertisement:</span>
                <!--end::Label-->

                <!--begin::Select-->
                <select class="form-select form-select-sm w-125px form-select-solid me-6" data-control="select2"
                    data-placeholder="Select Job Advertisement" data-hide-search="true" name="job_opening" id="job_opening">
                        <option selected="selected" value=""
                            class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                            Select Job Advertisement
                        </option>
                        @foreach($jobOpenings as $id => $jobOpening)

                            <option @if (request('job_opening')==$id) selected @endif value="{{ $id }}"
                                class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                                {{ $jobOpening ?? '' }}
                            </option>
                        @endforeach
                        

                </select>
                <!--end::Select-->


                {{-- <div class="bullet bg-secondary h-35px w-1px mx-6"></div>
                <span class="fs-7 fw-bold text-gray-700 flex-shrink-0 pe-4 d-none d-md-block">Department:</span>
                <!--end::Label-->
                <!--begin::Select-->
                <select class="form-select form-select-sm w-125px form-select-solid me-6" data-control="select2"
                    data-placeholder="Select Department" data-hide-search="true" name="department_id" id="department_id">
                        <option selected="selected" value=""
                            class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                            Select Department
                        </option>
                        @foreach($departments as $key => $department)
                            <option @if (request('department_id')==$key) selected @endif value="{{ $key }}"
                               class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                               {{ $department }}
                            </option>
                        @endforeach

                </select>
                <!--end::Select--> --}}


                <div class="bullet bg-secondary h-35px w-1px mx-6"></div>



                <!--begin::Actions-->
                <div class="d-flex align-items-center">
                    <button type="submit" class="btn btn-sm btn-icon btn-light-primary me-3" data-bs-toggle="tooltip"
                        data-bs-placement="top" title="Filter">
                        <iconify-icon icon="mingcute:filter-line" class="fa-2x"></iconify-icon>
                    </button>

                    <a href="/admin/job-opening/interview-list" class="btn btn-sm btn-icon btn-light me-3" data-bs-toggle="tooltip"
                        data-bs-placement="top" title="Reset">
                        <iconify-icon icon="bx:reset" class="fa-2x"></iconify-icon>
                    </a>
                    {{-- <button class="btn btn-sm btn-icon btn-light-success " value="export" data-bs-toggle="tooltip"
                        data-bs-placement="top" title="Reset">
                        <iconify-icon icon="clarity:export-line" class="fa-2x"> </iconify-icon>
                    </button> --}}
                </div>
                <!--end::Actions-->
        </form>
        <!--end::Toolbar end-->
        <!--end::Action group-->
    </div>
    <!--end::Toolbar container-->
</div>

<div id="kt_app_content" class="app-content  flex-column-fluid ">

    <div id="kt_app_content_container" class="app-container  w-100 ">
        <div class="card mb-5 mb-xl-8">
            <!--begin::Header-->
            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold fs-3 mb-1">Interview Listings</span>
                </h3>
            </div>
            <!--end::Header-->

            <!--begin::Body-->
            <div class="card-body py-3">
                <!--begin::Table container-->
                <div class="table-responsive">
                    @if(!$interviewLists)
                        <h5 class="text-center">Please select a job advertisement to get the interview list.</h5>
                    @else
                        <!--begin::Table-->
                        <table class="table align-middle gs-0 gy-4">
                            <!--begin::Table head-->
                            <thead>
                                <tr class="fw-bold text-muted bg-light">
                                    <th class="min-w-125px text-center">Name</th>
                                    <th class="min-w-125px text-center">Email</th>
                                    {{--<th class="min-w-125px text-center">Position Level</th>
                                     <th class="min-w-125px text-center">Match Rank</th>
                                    <th class="min-w-125px text-center">Match Rate</th> --}}
                                    <th class="min-w-125px text-center">Interview Date</th>
                                    <th class="min-w-125px text-center">Interview Mode</th>
                                    <th class="min-w-125px text-center">Interviewer</th>
                                    {{-- <th class="min-w-125px text-center">Interview Completion</th> --}}
                                    <th class="min-w-125px text-center">Interview Score</th>
                                    <th class="min-w-125px text-center">Interview Performance</th>
                                    <th class="min-w-125px text-center">Action</th>
                                </tr>
                            </thead>
                            <!--end::Table head-->

                            <!--begin::Table body-->
                            @if($interviewLists)
                                <tbody>
                                    @foreach($interviewLists as $interviewList)
                                        <tr>

                                            <td>
                                                <span class="text-gray-900 text-center fw-bold text-hover-primary d-block mb-1 fs-6">{{ $interviewList->user->name ?? ''}}</span>
                                            </td>

                                            <td>
                                                <span class="text-gray-900 text-center fw-bold text-hover-primary d-block mb-1 fs-6">{{ $interviewList->user->email ?? ''}}</span>
                                            </td>

                                            {{-- <td>
                                                <span class="text-gray-900 text-center fw-bold text-hover-primary d-block mb-1 fs-6">
                                                    {{ $interviewList->user->job_position->level ?? '' }}
                                                </span>
                                            </td>

                                             <td>
                                                <span class="text-gray-900 text-center fw-bold text-hover-primary d-block mb-1 fs-6">{{ $interviewList->match_rank ?? 0}}</span>
                                            </td>

                                            <td>
                                                <span class="text-gray-900 text-center fw-bold text-hover-primary d-block mb-1 fs-6">{{ $interviewList->match_rate ?? ''}}</span>
                                            </td> --}}

                                            <td>
                                                <span class="text-gray-900 text-center fw-bold text-hover-primary d-block mb-1 fs-6">{{ $interviewList->interview_date ?? ''}}</span>
                                            </td>

                                            <td>
                                                <span class="text-gray-900 text-center fw-bold text-hover-primary d-block mb-1 fs-6">{{ config('helpers.interview_mode')[$interviewList->interview_mode] ?? ''}}</span>
                                            </td>

                                            <td>
                                                <span class="text-gray-900 text-center fw-bold text-hover-primary d-block mb-1 fs-6">{{ $interviewList->interviewer_name ?? ''}}</span>
                                            </td>
                                            {{-- <td>
                                                <select class="form-select form-select-sm" name="interview_completion" onchange="handleInterviewCompletionChange(event, {{ $interviewList->id }})" data-interview-id="{{ $interviewList->id }}">
                                                    <option value="0" {{ $interviewList->interview_completion == '0' ? 'selected' : '' }}>No</option>
                                                    <option value="1" {{ $interviewList->interview_completion == '1' ? 'selected' : '' }}>Yes</option>
                                                </select>
                                                
                                            </td> --}}

                                            <td>
                                                <span class="text-gray-900 text-center fw-bold text-hover-primary d-block mb-1 fs-6">{{ $interviewList->interview_score ?? ''}}</span>
                                            </td>

                                            <td>
                                                <span class="text-gray-900 text-center fw-bold text-hover-primary d-block mb-1 fs-6">
                                                    {{ config('helpers.interview_performance')[$interviewList->interview_performance] ?? ''}}
                                                </span>
                                            </td>

                                            <td class="text-center">
                                                <a href="{{ route('admin.job-opening.applicant-details',['job_opening_application_id' => $interviewList->id, 'id' => $interviewList->user_id]) }}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                    <iconify-icon icon="fluent:eye-20-regular"></iconify-icon> </a>
                                                <a href="{{ route('admin.job-openings.take-interview',$interviewList->id) }}" class="btn btn-sm btn-primary me-1">
                                                    Conduct Interview
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            <!--end::Table body-->
                            {{ $interviewLists->links() }}
                            @else
                                <p>Please select job to get interview list</p>
                            @endif
                        </table>
                        <!--end::Table-->
                    @endif
                    
                </div>
                

                <!--end::Table container-->
            </div>
            <!--begin::Body-->
        </div>
    </div>

</div>
<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Delete</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Are you sure you want to delete this job opening?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <form id="deleteJobOpeningForm" method="POST" action="">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
          </form>
        </div>
      </div>
    </div>
  </div>
<!-- Interview Score Modal -->
<div class="modal fade" id="interviewScoreModal" tabindex="-1" aria-labelledby="interviewScoreModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="interviewScoreModalLabel">Interview Score Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="range" class="form-range" min="0" max="100" id="interviewScoreRange" name="interview_score">
                <span id="rangeValue">0</span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                {{-- <button type="button" class="btn btn-primary" onclick="submitInterviewScore({{ $interviewList->id }})">Save Changes</button> --}}
                <button type="button" class="btn btn-primary" onclick="submitInterviewScore()">Save</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
{{-- {{dd($labels)}} --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

<script>
    function exportToExcel() {
        // Select the table element
        var table = document.getElementById('table');

        // Convert table to worksheet
        // var ws = XLSX.utils.table_to_sheet(table, {autoWidth: true});
        // Convert table to worksheet
        var ws = XLSX.utils.table_to_sheet(table);

        // Calculate column widths
        var colWidths = [];
        var rows = XLSX.utils.sheet_to_json(ws, {
            header: 1
        });
        rows.forEach(function(row) {
            row.forEach(function(cell, colIndex) {
                var cellText = cell ? cell.toString() : '';
                var cellLength = cellText.length;
                colWidths[colIndex] = (colWidths[colIndex] || 0) < cellLength ? cellLength : (colWidths[colIndex] || 0);
            });
        });

        // Apply calculated column widths to the worksheet
        ws['!cols'] = colWidths.map(function(width) {
            return {
                wch: width
            };
        });

        // Create a workbook and add the worksheet
        var wb = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(wb, ws, 'Sheet1');

        // Save the workbook as a file
        XLSX.writeFile(wb, 'potential_employees.xlsx');
    }

</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
      var deleteModal = document.getElementById('deleteConfirmationModal');
      deleteModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var deleteUrl = button.getAttribute('data-delete-url');
        var form = document.getElementById('deleteJobOpeningForm');
        form.action = deleteUrl;
      });
    });
</script>

<script>
    function copyToClipboard(element) {
        var url = element.getAttribute('data-url'); // Get the URL from the data-url attribute
        navigator.clipboard.writeText(url).then(function() {
            alert('URL copied to clipboard'); // Success feedback
        }, function(err) {
            console.error('Could not copy text: ', err); // Error feedback
        });
    }
</script>
<script>
    // function handleInterviewCompletionChange(event, interviewId) {
    //     const value = event.target.value;
    //     if (value == 1) {
    //         $('#interviewScoreModal').modal('show');
    //         $('#interviewScoreModal').on('shown.bs.modal', function () {
    //             $('#interviewScoreRange').on('input', function () {
    //                 $('#rangeValue').text($(this).val());
    //             });
    //         });
    //     }
    // }
    
    // function submitInterviewScore(interviewId) {
    //     const score = $('#interviewScoreRange').val();
    //     // You need to have a route to handle this POST request
    //     $.post('{{ route("update-interview-score") }}', {
    //         interview_id: interviewId,
    //         interview_score: score,
    //         _token: '{{ csrf_token() }}'
    //     }, function(data) {
    //         $('#interviewScoreModal').modal('hide');
    //         alert(data.message); // Show success message or handle as needed
    //         location.reload();
    //     });
    // }
    function handleInterviewCompletionChange(event, interviewId) {
        const value = event.target.value;
        if (value == 1) {
            $('#interviewScoreModal').modal('show');
            $('#interviewScoreModal').on('shown.bs.modal', function () {
                        // Ensure the modal is updated with the current interview ID
                        $('#interviewScoreModal').data('interviewId', interviewId);

                        $('#interviewScoreRange').on('input', function () {
                            $('#rangeValue').text($(this).val());
                        });
                    });
                }
        }
    
        function submitInterviewScore() {
            const interviewId = $('#interviewScoreModal').data('interviewId'); // Get the ID stored in the modal
            const score = $('#interviewScoreRange').val();

            $.post('{{ route("update-interview-score") }}', {
                interview_id: interviewId,
                interview_score: score,
                _token: '{{ csrf_token() }}'
            }, function(data) {
                $('#interviewScoreModal').modal('hide');
                alert(data.message); // Show success message or handle as needed
                location.reload();
            });
        }


</script>
@endsection
