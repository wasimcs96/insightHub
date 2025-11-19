@extends('admin.layout.app')

@section('title', 'Comparison')
@section('styles')
<style>
/* new css */
.dashboard {
    display: grid;
    grid-template-columns: max-content auto;
    gap: 20px;
    max-width: 100%;
    /* margin: 20px auto; */
    padding: 20px;
}

.dashboard-header {
    grid-column: 1 / -1;
    font-size: 24px;
    font-weight: bold;
    color: #333;
    margin-bottom: 20px;
    text-align: left;
}

.sidebar {
    font-size: 16px;
    font-weight: bold;
    color: #333;
    padding-right: 10px;
    text-align: right;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding-bottom: 30px;
}

.cards {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 20px;
}

.cardd {
    background: #F9FAFF;
    border-radius: 36px;
    box-shadow: 0 2px 4px rgb(184 192 230 / 37%);
    padding: 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 27px;
}

.cardd img {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    margin-bottom: 10px;
}

.match-rate,
.predictive-score,
.cognitive,
.riasec,
.reliability,
.retention-risk {
    text-align: center;
    margin-bottom: 10px;
}

.match-rate span,
.predictive-score span {
    font-size: 22px;
    font-weight: bold;
    color: #4c51bf;
}

.demographics {
    font-size: 14px;
    margin-bottom: 10px;
    text-align: center;
    background: #cccbef78;
    border-radius: 30px;
    padding: 10px 6px;
    width: 170px;
}

.demographics div:not(:last-child) {
    margin-bottom: 4px;
}
.dim_title{
    font-weight: 600;
font-size: 1.1rem;
}
</style>
@endsection
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
                Comparison
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
                    Comparison </li>
                <!--end::Item-->

            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
        <!--begin::Action group-->
        <!--begin::Toolbar end-->
        <form class="d-flex align-items-center overflow-auto" action="" method="GET">
                <span class="fs-7 fw-bold text-gray-700 flex-shrink-0 pe-4 d-none d-md-block">Select Users:</span>
                <!--end::Label-->
                <!--begin::Select-->
                <select class="form-select form-select-sm form-select-solid me-6" data-control="select2" data-close-on-select="false" data-allow-clear="true" data-placeholder="Select Users" data-hide-search="true" name="request_user_ids[]" id="user_id" multiple="multiple">

                    @foreach($users as $user)
                       <option value="{{ $user->id }}" @if(request('request_user_ids') && in_array($user->id, request('request_user_ids'))) selected @endif>{{ $user->name }}</option>
                    @endforeach
                </select>
                <!--end::Select-->

                <div class="bullet bg-secondary h-35px w-1px mx-6"></div>

                <!--begin::Actions-->
                <div class="d-flex align-items-center">
                    <button type="submit" class="btn btn-sm btn-icon btn-light-primary me-3" data-bs-toggle="tooltip"
                        data-bs-placement="top" title="Filter" >
                        <iconify-icon icon="mingcute:filter-line" class="fa-2x"></iconify-icon>
                    </button>

                    <a href="{{ url()->current() }}" class="btn btn-sm btn-icon btn-light me-3" data-bs-toggle="tooltip"
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
        <div class="card">
            <div class="dashboard">
                <div class="dashboard-header">Compare (Analytics) for {{ $job_title ?? '' }}</div>
                @if($data)
                <div class="sidebar">
                    <div style="margin-top: 165px;">Suitability Rate</div>
                    <div style="height: 160px;display: flex;align-items: center; justify-content: flex-end;">
                        Demographics
                    </div>
                    <div>Performance Predictive Rate</div>
                    <div>Cognitive Test Result</div>
                    <div>RIASEC (Top 3)</div>
                    <div>Ocean Reliability</div>
                    <div>Growth Potential</div>
                    <div>Flight Risk</div>
                    <div>Workplace Alignment Forecast</div>
                    <div>Status</div>
                </div>
                @else
                <div class="sidebar">
                    <h6>Please select users from top right to proceed further</h6>
                </div>

                @endif
                <div class="cards">
                    <!-- Card 1 -->
                    @foreach($data as $user_id => $single)
                        <div class="cardd" @if($single['job_opening_application_status'] == 10) style="background: darkseagreen; margin-top: 48px;" @else style="margin-top: 48px;" @endif>

                            @php
                            $bookmarked = App\Models\SavedCandidates::where('candidate_id', $user_id)->where('user_id', auth()->user()->id)->first();
                                if ($bookmarked) {
                                    $isBookmarked = 1;
                                } else {
                                    $isBookmarked = 0;
                                }
                            @endphp
                            
                            <a href="{{ route('admin.analytical.advance-compare', ['job_opening_id' => $single['job_opening_id'], 'candidate_id' => $user_id]) }}" class="bg-gray-300 cursor-pointer compare_bookmark bookmark-button" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Advance Compare"  ><iconify-icon icon="bx:git-compare"></iconify-icon></a>

                            <a href="{{ route('admin.job-opening.applicant-details', ['job_opening_application_id' => $single['job_opening_application_id'], 'id' => $single['job_opening_external_user_id']]) }}">
                                <img src="{{ asset($single['profile_picture']) }}" onerror="this.src='{{ asset('admin/media/avatars/default-avatar.png') }}'"  alt="Talent Avatar">
                            </a>


                            <div class="match-rate cursor-pointer" data-bs-toggle="tooltip"
                            data-bs-placement="top"

                            @if(isset($single['match_rate']) && $single['match_rate'] > 70)
                            title="Candidates exhibit strong alignment with the job's core responsibilities and values, suggesting immediate engagement and satisfaction, and a likelihood of long-term success."
                            @elseif(isset($single['match_rate']) && $single['match_rate'] > 30 && $single['match_rate']<70)
                            title="Candidates show compatibility with key job aspects but may need development or support to fully align with certain role specifics or organizational culture."
                            @else
                            title="There is a significant mismatch between the candidate's profile and job requirements, potentially leading to lower job satisfaction and performance without intervention."
                            @endif

                            ><span>{{ $single['match_rate'] ?? ''}}%</span></div>


                            <div class="demographics">
                                <div class="dim_title cursor-pointer" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Name of Talent">{{ $single['name'] ?? 'N/A'}}</div>
                                <div class="dim_title cursor-pointer" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Gender of Talent">{{ $single['gender'] == 1 ? 'Female' : 'Male' ?? ''}}</div>
                                <div class="dim_title cursor-pointer" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Age of Talent">{{ $single['age'] ?? 'N/A'}}</div>
                                <div class="dim_title cursor-pointer" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Education Level of Talent">{{ $single['education_level']->name?? 'N/A'}}</div>
                                <div class="dim_title cursor-pointer" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Work Experience of Talent">{{ $single['work_experience'] ?? 'N/A'}}</div>
                            </div>


                            <div class="predictive-score cursor-pointer" data-bs-toggle="tooltip"
                            data-bs-placement="top"  title="Individual's capacity for consistent and reliable performance, ability to meet expectations and deliver results effectively.">
                                <span>{{ $single['predictive_performance_result'] ?? ''}}</span>
                            </div>


                            <div class="cognitive dim_title cursor-pointer">Level:{{ $single['cognitive_ability_result'] ?? '0'}}</div>



                                @if(isset($single['top_3_riasec']))
                                @php
                                $description = DB::table('master_top_3_riasec_descriptions')
                                ->where('top_3_riasec', $single['top_3_riasec'])
                                ->value('description');
                                @endphp
                                @else
                                @php $description = ''; @endphp
                                @endif
                            <div class="riasec dim_title cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $description ?? '0' }}">{{ $single['top_3_riasec'] ?? '0'}}</div>




                            <div class="reliability dim_title cursor-pointer"  data-bs-toggle="tooltip" data-bs-placement="top"

                            @if(isset($single['ocean_reliability_result']) && $single['ocean_reliability_result'] == 'Moderate')
                                title="Moderate OCEAN reliability suggests a mix of reliability and inconsistency in results."
                            @elseif (isset($single['ocean_reliability_result']) && $single['ocean_reliability_result'] == 'Low')
                            title="Low OCEAN reliability indicates results that are generally inconsistent and less reliable."
                            @else
                            title="High OCEAN reliability signifies consistently reliable and dependable results."
                            @endif


                            >{{ $single['ocean_reliability_result'] ?? 'High'}}</div>


                        <div class="growth_potential dim_title cursor-pointer" data-bs-toggle="tooltip"
                            data-bs-placement="top" @if(isset($single['growth_potential_result']) && $single['growth_potential_result'] == 'High') title="High-potential employees excel in adaptability, learning, and leadership. They respond well to accelerated development opportunities, such as cross-functional projects and leadership training, often being candidates for succession planning and strategic organizational roles."
                            @else
                            title="Employees at this level are dependable and consistent in their current roles. They benefit from focused skill enhancement and may evolve into broader roles over time with dedicated training and mentorship. They are foundational to maintaining the status quo and operational success." @endif>
                            {{ $single['growth_potential_result'] ?? '0' }}
                        </div>

                            <div class="retention-risk dim_title cursor-pointer"  data-bs-toggle="tooltip" data-bs-placement="top"

                             @if(isset($single['flight_risk_result']['flight_risk_level']) && $single['flight_risk_result']['flight_risk_level'] == 'High')

                            title="Candidates with a high flight risk may have a history of frequent job changes without significant tenure, indicating a higher likelihood of leaving the organization soon after joining."

                            @elseif(isset($single['flight_risk_result']['flight_risk_level']) && $single['flight_risk_result']['flight_risk_level'] == 'Low')

                            title="Candidates with a low flight risk often demonstrate strong alignment with the company’s values and long-term career goals, indicating a higher likelihood of retention after hiring."

                            @else

                            title="Candidates at a moderate flight risk may show concerns about role stability or growth opportunities during interviews, suggesting they could consider leaving if their expectations are not met."

                            @endif
                            style="margin-top: 10px;margin-bottom: 0px;"  >{{ $single['flight_risk_result']['flight_risk_level'] ?? 'Moderate'}}
                        </div>
                        <div class="retention-risk dim_title cursor-pointer"  data-bs-toggle="tooltip" data-bs-placement="top"

                            @if(isset($single['organizational_fit_forecast_result']) && $single['organizational_fit_forecast_result'] == 'high')

                           title="Candidates with a high flight risk may have a history of frequent job changes without significant tenure, indicating a higher likelihood of leaving the organization soon after joining."

                           @elseif(isset($single['organizational_fit_forecast_result']) && $single['organizational_fit_forecast_result'] == 'low')

                           title="Candidates with a low flight risk often demonstrate strong alignment with the company’s values and long-term career goals, indicating a higher likelihood of retention after hiring."

                           @else

                           title="Candidates at a moderate flight risk may show concerns about role stability or growth opportunities during interviews, suggesting they could consider leaving if their expectations are not met."

                           @endif
                           style="margin-top: 10px;margin-bottom: 0px;"  >{{ ucfirst($single['organizational_fit_forecast_result']) ?? 'Moderate' }} Risk
                        </div>


                            <div class="retention-risk dim_title" style="margin-top: 10px;margin-bottom: 0px;">
                                {{-- <form action="{{ route('admin.job-opening.update-status', $single['job_opening_application_id']) }}" method="POST">
                                    @csrf
                                    <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="status" onchange="this.form.submit()">
                                        @foreach(config('helpers.application_status') as $statusKey => $statusValue)
                                            <option value="{{ $statusKey }}" @if($single['job_opening_application_status'] == $statusKey) selected @endif
                                            @if($single['job_opening_application_status'] == 10) disabled @endif>{{ $statusValue }}
                                            </option>
                                        @endforeach
                                    </select>

                                </form> --}}
                                {{-- <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="status" onchange="handleStatusChange(this, {{ $single['job_opening_application_id'] }})">
                                    @foreach(config('helpers.application_status') as $statusKey => $statusValue)
                                        <option value="{{ $statusKey }}" @if($single['job_opening_application_status'] == $statusKey) selected @endif
                                        @if($single['job_opening_application_status'] == 10) disabled @endif>{{ $statusValue }}
                                        </option>
                                    @endforeach
                                </select> --}}
                                <!-- Begin Form -->
                                <form action="{{ route('admin.job-opening.update-status', $single['job_opening_application_id']) }}" method="POST">
                                    @csrf
                                    {{-- <input type="text" name="external_user_id" value="{{ $jobOpeningApplication->external_user_id }}"  hidden> onchange="this.form.submit()" @if($jobOpeningApplication->status == 10) disabled @endif --}}
                                    <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="status" @if($single['job_opening_application_id'] == 10) disabled @endif>
                                        @foreach(config('helpers.application_status') as $statusKey => $statusValue)
                                            <option value="{{ $statusKey }}" @if($single['job_opening_application_status'] == $statusKey) selected @endif >{{ $statusValue }}</option>
                                        @endforeach
                                    </select>
                                </form>
                                <!-- End Form -->
                                
                            </div>

                        </div>
                    @endforeach

                </div>

            </div>


        </div>
    </div>

</div>
<!-- Delete Confirmation Modal -->

<!-- Interview Details Modal (ensure this is outside your main content but inside your Blade layout) -->
<div class="modal fade" id="interviewDetailsModal" tabindex="-1" role="dialog" aria-labelledby="interviewDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="interviewDetailsModalLabel">Interview Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="interviewDetailsForm" action="" method="POST">
                    @csrf
                    <input type="hidden" name="status" value="5" hidden>
                    <div class="mb-3">
                        <label for="interview_date" class="form-label">Interview Date</label>
                        <input type="date" class="form-control" id="interview_date" name="interview_date" required>
                    </div>
                    <div class="mb-3">
                        <label for="interviewer_name" class="form-label">Interviewer Name</label>
                        <input type="text" class="form-control" id="interviewer_name" name="interviewer_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="interview_mode" class="form-label">Interview Mode</label>
                        <select class="form-select" id="interview_mode" name="interview_mode">
                            <option value="1">Physical</option>
                            <option value="2">Online</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Save details</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Hiring Modal -->
<div class="modal fade" id="hiringModal" tabindex="-1" role="dialog" aria-labelledby="hiringModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="hiringModalLabel">Company Email of Employee</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="hiringForm" action="" method="POST">
            @csrf
            <input type="hidden" name="status" value="10" hidden>
            <div class="mb-3">
              <label for="email" class="form-label">Company Email of Employee</label>
              <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <button type="submit" class="btn btn-primary">Save details</button>
          </form>
        </div>
      </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    function bookmarkUser(userId) {
        console.log('bookmark', userId);
        $.ajax({
            url: '/admin/candidate/add-to-bookmark/' + userId,
            type: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                alert(response.message);
                // Update button style
                $('#bookmarkButton_' + userId).removeClass('unbookmarked').addClass('bookmarked');
                // Update onclick attribute
                $('#bookmarkButton_' + userId).attr('onclick', 'unbookmarkUser(' + userId + ')');
                $('#bookmarkButton_' + userId).attr('data-bs-original-title', 'UnShortlist Candidate');

            },
            error: function(xhr) {
                alert('Error bookmarking user: ' + xhr.statusText);
            }
        });
    }

    function unbookmarkUser(userId) {
        console.log('unbookmarkUser', userId);
        $.ajax({
            url: '/admin/candidate/remove-bookmark/' + userId,
            type: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                alert(response.message);
                // Update button style
                $('#bookmarkButton_' + userId).removeClass('bookmarked').addClass('unbookmarked');
                // Update onclick attribute
                $('#bookmarkButton_' + userId).attr('onclick', 'bookmarkUser(' + userId + ')');
                $('#bookmarkButton_' + userId).attr('data-bs-original-title', 'Shortlist Candidate');
            },
            error: function(xhr) {
                alert('Error unbookmarking user: ' + xhr.statusText);
            }
        });
    }

    function handleStatusChange(selectElement, applicationId) {
        var selectedStatus = selectElement.value;
        var form = selectElement.closest('form');

        // Check if the selected status is '5' which is for interview
        if (selectedStatus === '5') {
            // Set form action for updating status with application ID
            $('#interviewDetailsForm').attr('action', '/admin/job-opening/update-status/' + applicationId);

            // Show the modal
            $('#interviewDetailsModal').modal('show');
        } else if (this.value === '10') {
            // Set form action dynamically based on selected application
            // document.getElementById('hiringForm').action = form.action;
            $('#hiringForm').attr('action', '/admin/job-opening/update-status/' + applicationId);
            $('#hiringModal').modal('show'); // Show the modal
          } else {
            // Submit the form for other statuses
            form.submit();
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
      const statusSelectors = document.querySelectorAll('select[name="status"]');
    
      statusSelectors.forEach(selector => {
        selector.addEventListener('change', function (event) {
          const form = this.closest('form');
          if (this.value === '5') { // Check if status is 'Interview Scheduled'
            // Set form action dynamically based on selected application
            document.getElementById('interviewDetailsForm').action = form.action;
            $('#interviewDetailsModal').modal('show'); // Show the modal
          } else if (this.value === '10') {
            // Set form action dynamically based on selected application
            document.getElementById('hiringForm').action = form.action;
            $('#hiringModal').modal('show'); // Show the modal
          } else {
            form.submit(); // Submit form for other status changes
          }
        });
      });
    });

</script>



@endsection
