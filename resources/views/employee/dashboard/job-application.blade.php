@extends('employee.layout.app')

@section('title', 'Dashboard')

@section('styles')
<style>
    .app-wrapper {
       margin-top: 74px !important;
   }

   .app-content {
       padding-top: 15px !important;
   }

   .app-container {
       padding: 0px !important;
       margin: 0px 186px !important;
   }

   .nav-link {
       padding: 16px !important;
       margin: 0px !important;
   }

   .profile-card {
       padding: 39px 24px 0px !important
   }

   .mb-11 {
       margin-bottom: 36px !important;
   }

   .gap-7 {
       gap: 24px !important;
   }

   .gap-4 {
       gap: 16px !important;
   }

   .psych-inner {
       padding: 30px 40px 45px 40px;
   }

   .table-desc {
       color: #5B5B5B;
       font-size: 12px;
       font-weight: 400;
   }

   .left-table-head {
       color: #5B5B5B;
       font-size: 16px;
       font-weight: 500;
       line-height: normal;
       text-transform: uppercase;
       display: flex;
       align-items: center;
       gap: 5px;
       margin-bottom: 4px;
   }

   .left-table-head p {
       margin-bottom: 5px;
   }

   .left-table-head span {
       color: #F7941C;
       font-weight: 700;
   }

   .line-grey {
       background-color: #e6e6e6;
       position: relative;
       margin-top: 15px;
       width: 100%;
       height: 15px;
       background: #EBEBEB;
   }

   .ocean-grey {
       margin-top: 14.4px;
       height: 21.28px;

   }

   .ocean-orange {
       height: 21.28px !important;
   }

   .line-orange {
       height: 15px;
   }

   .fade-orange {
       background: #FABB6E;
   }

   .dark-orange {
       background: #F7941C;
   }

   .svg-round-icon {
       position: absolute;
       bottom: -0.701px;
       top: 13%;
       transform: translateY(-50%);
   }

   .line {
       border-radius: 7.14px;
   }

   .line-bottom {
       background: #E1E1E1;
       width: 100%;
       height: 1px;
   }

   .tweleve-head {
       color: #5B5B5B;
       font-size: 18px;
       font-weight: 500;
       line-height: normal;
       margin-bottom: 15px;
   }

   .tweleve-desc {
       color: #5B5B5B;
       font-size: 12px;
       font-weight: 600;
       margin-bottom: 8.4px;
   }

   .tweleve-desc img {
       margin-right: 5px;
       position: relative;
       top: 2px;
   }

   .skill-table {
       display: grid;
       gap: 30px;
   }

   .skill-table .table-desc {
       margin: 0;
   }

   .orange-bg {
       padding: 10px 10px 10px 15px;
       background: #FFF6EA;
       border-left: 2px solid #FABB6E;
   }

   .orange-bg .table-desc {
       margin: 0;
   }

   .work-right-head {
       color: #5B5B5B;
       font-size: 18px;
       font-weight: 500;
       line-height: 22px;
   }

   .work-orange {
       color: #F7941C;
       font-size: 36px;
       font-weight: 500;
       line-height: normal;
       margin: 12.8px 0px 6.4px 0px;
   }

   .bg-white {
       border-radius: 8px;
       background: #F1F1F4;
       border: 1px solid #F1F1F4;
       box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.03);
   }

   .inner-table {
       display: grid;
       grid-template-columns: 47% 47%;
       gap: 70px;
   }

   .left-table-head span {
       color: #F7941C;
       font-weight: 700;
   }

   .table-desc {
       color: #5B5B5B;
       font-size: 12px;
       font-weight: 400;
   }

   .right-bot {
       color: #5B5B5B;
       font-size: 12px;
       font-weight: 500;
       line-height: 16px;
       display: table;
       margin: 7px 0px;

   }

   .right-bot span {
       padding: 2.626px 6.795px;
       position: relative;
       left: 7px;
       border-radius: 5.421px;
       background: #F7941C;
       color: #FFF;
       font-size: 9px;
       line-height: 14px;
       font-weight: 600;
       text-transform: uppercase;
   }

   .purple,
   .cyan,
   .orange,
   .spring {
       font-size: 12px;
       font-weight: 600;
       line-height: normal;
   }

   .purple span,
   .cyan span,
   .orange span,
   .green span,
   .spring span {
       border-radius: 8px;
       position: relative;
       font-size: 11px;
       font-weight: 600;
       left: 6.4px;
       padding: 2px 8.6px;
       text-transform: uppercase;
   }

   .purple span {
       background: #E1D8FB;
       color: #7F66CA;
   }

   .cyan span {
       background: #B2ECEC;
       color: #108585;
   }

   .orange span {
       background: #FDE2C1;
       color: #F7941C;
   }

   .spring span {
       color: #F7941C;
       background: #FFEBB4;
   }

   .green span {
       color: #218336;
       background: #BBECC5 !important;
   }
</style>

<style>
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

    .top-learning-text {
        font-family: 'Inter';
        font-style: normal;
        font-weight: 400;
        font-size: 12px;
        line-height: 15px;
        /* identical to box height, or 125% */

        /* Caption grey */
        color: #5B5B5B;


    }

    .right-yellow-border-cont {
        /* Rectangle 126 */

        border-left: 1px solid #FFBD6F;
        /* Light orange highlight */
        background: #FFF6EA;
        height: 17px;
        width: 77px;

    }

    .reading-writing-cont {
        /* Rectangle 126 */
        padding: 10px 15px;
        border-left: 2px solid #FFBD6F;
        /* Light orange highlight */
        background: #FFF6EA;


    }

    .circle.completed span {
        font-size: 36px;
    }

    .circle.completed p {
        font-size: 16px;
        color: #333;
    }

    .assessment-card .circle.completed span {
        color: #f7931e;
    }

    .card-body-riasec {
        box-shadow: none !important;
        border: none !important;
        padding: 0;
        margin: 0;
    }

    @media (max-width: 360px) {
        .circle {
            width: 90px;
            height: 90px;
        }

        .emp_a {
            width: 15px;
            height: 15px;
        }

        .emp_b {
            width: 15px;
            height: 15px;
        }


    }

    .text-active-primary.active {
        color: #f7941d !important;
    }

    @media only screen and (min-width: 350px) and (max-width: 681px) {
            .app-container {
                padding: 0px !important;
                margin: 0px 10px !important;
            }

            .bg-open-accordion {
                padding: 10px !important;
            }

            .app-wrapper {
                margin-top: 0px !important;
            }

            .app-content {
                padding-top: 0px !important;
            }

            .profile-card {
                padding: 39px 16px 0px !important;
            }

            .card-wrapper-main {
                padding: 16px;
                margin-top: 0;
            }

            .card .card-header {
                min-height: 60px;
                padding: 10px;
            }

            .card .card-body {
                padding: 10px;
            }
        }


    @media only screen and (min-width: 992px) and (max-width: 1101px) {
        .app-container {
            padding: 0px !important;
            margin: 0px 10px !important;
        }
    }

    @media only screen and (min-width: 1101px) and (max-width: 1201px) {
        .app-container {
            padding: 0px !important;
            margin: 0px 50px !important;
        }
    }

    @media only screen and (min-width: 1202px) and (max-width: 1351px) {
        .app-container {
            padding: 0px !important;
            margin: 0px 70px !important;
        }
    }

    @media only screen and (min-width: 1352px) and (max-width: 1401px) {
        .app-container {
            padding: 0px !important;
            margin: 0px 120px !important;
        }
    }
</style>
@endsection

@section('content')
    <div id="kt_app_content" class="app-content  flex-column-fluid">
        <div id="kt_app_content_container" class="app-container  ">
            <div class="row g-5 gx-xl-10 mb-5 mb-xl-10 ms-0 me-0 justify-content-center mt-0">
                @include('employee.dashboard.includes.card')
                <!-- begin::Assessment Chart Section -->

                <div class="card mb-5 mb-xl-8 p-0">
                    <!--begin::Header-->
                    <div class="card-header border-0 pt-2 md-pt-5">
                        <h3 class="card-title align-items-start flex-column">List of Application</span>

                            {{-- <span class="text-muted mt-1 fw-semibold fs-7">Over 500 new products</span> --}}
                        </h3>
                        <div class="card-toolbar">
                            {{-- <a href="{{ route('admin.job-opening.compare-index',['job_opening_id' => $jobOpening->id]) }}" class="btn btn-sm btn-light-primary">
                                        <iconify-icon icon="lucide:git-compare"></iconify-icon> Compare
                                    </a> --}}
                        </div>
                    </div>

                    <!--begin::Body-->
                    <div class="card-body py-3">


                        <!--begin::Table container-->
                        <div class="table-responsive">
                            <!--begin::Table-->
                            @if ($jobOpeningApplicatons)
                                <table class="table align-middle gs-0 gy-4">
                                    <!--begin::Table head-->
                                    <thead>
                                        <tr class="fw-bold text-muted bg-light">
                                            <th class="min-w-100px text-center">No</th>
                                            <th class="min-w-125px text-center">List of Job Applied</th>
                                            <th class="min-w-125px text-center">Date Applied</th>
                                            <th class="min-w-125px text-center">Technical Assessment</th>
                                            <th class="min-w-125px text-center">Application Status</th>
                                            <th class="min-w-200px text-center">Status</th>
                                            <th class="min-w-200px text-center">Action</th>

                                        </tr>
                                    </thead>
                                    <!--end::Table head-->

                                    <!--begin::Table body-->
                                    <tbody>

                                        @foreach ($jobOpeningApplicatons as $key => $job)
                                        {{-- {{ dd($job) }} --}}
                                            <tr>

                                                <td>
                                                    <span class="text-gray-900 text-center fw-bold d-block mb-1 fs-6">
                                                        {{ $key + 1 }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span
                                                        class="text-gray-900 text-center fw-bold d-block mb-1 fs-6">{{ $job->jobOpening->job_title ?? '' }}</span>
                                                </td>

                                                <td>
                                                    <span class="text-gray-900 text-center fw-bold  d-block mb-1 fs-6">
                                                        {{ $job->created_at ?? '' }}
                                                    </span>
                                                </td>

                                                <td class="text-center">
                                                    {{-- {{ dd($job) }} --}}
                                                    <span class="text-gray-900 text-center fw-bold  d-block mb-1 fs-6">

                                                        {{-- {{ dd($job) }} --}}
                                                        @if ((auth()->user()->role_name == 'candidate') && (auth()->user()->is_personality_motivation_completed == 1) && (auth()->user()->is_work_interest_completed == 1) && (auth()->user()->is_cognitive_ability_completed == 1)) 
                                                        @if ($job->technical_assessment_completed != 1)
                                                            @if (isset($job->jobOpening->job_position))
                                                                <a
                                                                    href="/job-application/technicalAssessment/start/{{ $job->id }}/{{ $job->jobOpening->job_position->id }}">Start</a>
                                                            @else
                                                                N/A
                                                            @endif
                                                        @else
                                                            Completed
                                                        @endif
                                                        @else
                                                        Please complete Pychometric Assessments first 
                                                        @endif

                                                    </span>
                                                </td>


                                                <td>
                                                    <span
                                                        class="text-gray-900 text-center fw-bold text-hover-primary d-block mb-1 fs-6">
                                                        @if ($job->application_status == 1)
                                                            Applied
                                                        @else
                                                            Withdraw
                                                        @endif
                                                    </span>
                                                </td>
                                                <td class="text-center">
                                                    <!-- Begin Form -->

                                                    <span class="text-gray-900 text-center fw-bold  d-block mb-1 fs-6">
                                                        @foreach (config('helpers.application_status') as $statusKey => $statusValue)
                                                            @if ($job->status == $statusKey)
                                                                {{ $statusValue }}
                                                            @endif
                                                        @endforeach
                                                    </span>

                                                    <!-- End Form -->
                                                </td>

                                                <td class="text-center">

                                                    <div class="d-flex justify-content-center">
                                                        @if ($job->application_status != 0 )
                                                        @if ($job->status == 9)
                                                            <a href="{{ $job->contract->contract_pdf }}"
                                                                target="_blank"
                                                                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                                <iconify-icon
                                                                    icon="fluent:eye-20-regular"></iconify-icon>
                                                            </a>
                                                        @endif

                                                        @if ($job->status == 8)
                                                            <a href="{{ $job->contract->contract_pdf }}"
                                                                target="_blank"
                                                                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                                <iconify-icon
                                                                    icon="fluent:eye-20-regular"></iconify-icon>
                                                            </a>
                                                            <a data-bs-toggle="modal" data-bs-target="#signature_pad"
                                                                contract_id="{{ $job->contract->id ?? '' }}"
                                                                jobtitle='{{ $job->jobOpening->job_title ?? 'Job title' }}'
                                                                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                                <iconify-icon
                                                                    icon="fluent:document-signature-32-regular"></iconify-icon>
                                                            </a>
                                                        @endif
                                                        @endif


                                                        <form
                                                            action="{{ route('admin.application.update-status', $job->id) }}"
                                                            method="POST" id="statusForm-{{ $job->id }}">
                                                            @csrf
                                                            <input type="hidden" name="application_status"
                                                                value="0">
                                                            <button type="button"
                                                                    class="withdrawButton btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                                                                    data-job-id="{{ $job->id ?? '' }}"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#withdrawModal"
                                                                    @if ($job->application_status == 0) disabled style="cursor: no-drop;color: black;" @endif
                                                                    title="Withdraw Application">
                                                                <iconify-icon icon="ph:hand-withdraw-light" class="fs-2"></iconify-icon>
                                                            </button>

                                                        </form>
                                                        {{-- <a href="{{ route('admin.job-opening.send-email',$jobOpeningApplication->id) }}" class="btn btn-sm btn-primary me-1">
                                                        Send Email
                                                    </a> --}}
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach


                                    </tbody>
                                    <!--end::Table body-->
                                </table>

                            @endif
                            <!--end::Table-->

                        </div>



                        <!--end::Table container-->
                    </div>
                    <!--begin::Body-->
                </div>
            </div>
        </div>
        <!--end::Item-->

        <div class="modal fade" id="withdrawModal" tabindex="-1" aria-labelledby="withdrawModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="withdrawModalLabel">Confirm Withdrawal</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to withdraw your application?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" id="confirmWithdrawBtn" class="btn btn-danger">Withdraw</button>
      </div>
    </div>
  </div>
</div>



           <!-- The Modal -->

    <div class="modal fade" tabindex="-1" id="signature_pad">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Signature</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1"><iconify-icon icon="vaadin:close-big"></iconify-icon></i>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body">
                    <form id="signature_form" action="{{ route('contracts.sign.submit') }}" method="POST">
                        @csrf
                        <input type="hidden" name="contract_id" id="contract_id">
                        <h5 id="contract_title">Job Title</h5>
                        {{-- <p>{{ $contract->contract_details }}</p> --}}

                        <label for="signature">Signature:</label>
                        <div>
                            <canvas id="signature-pad" width="400" height="200"
                                style="border:1px solid #000;"></canvas>
                        </div>
                        <button type="button" id="clear-signature" class="btn btn-danger py-1">Clear</button>
                        <input type="hidden" name="signature" id="signature">

                        <button type="submit" class="btn btn-primary py-1">Sign Contract</button>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    {{-- <button type="button" class="btn btn-primary" onclick="document.getElementById('signature_form').submit();">Sign Contract</button> --}}
                </div>
            </div>
        </div>
    </div>
    @endsection

    @section('scripts')
        <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.35.0"></script>
        <script>
            function technicalpopulateModal(key, value, name, level) {
                // Escape and parse data into a readable format
                const parsedValue = JSON.parse(value);

                // Populate modal content dynamically
                const modalBody = document.getElementById('techSkillDetails');
                modalBody.innerHTML = `
            <h5>Name: ${name}</h5>
            <p><strong>Level:</strong> ${level}</p>
            <p><strong>Description:</strong> ${parsedValue.description ?? 'No description available.'}</p>
            
        `;
            }
        </script>
        
    <script src="{{ asset('signature-pad/js/signature_pad.umd.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            // When the button with data-bs-toggle="modal" is clicked
            $('[data-bs-toggle="modal"]').on('click', function() {
                // Get the contract_id attribute value
                var contractId = $(this).attr('contract_id');
                var jobTitle = $(this).attr('jobtitle');
                console.log(jobTitle);
                // Set the contract_id value to the hidden input in the modal
                $('#contract_id').val(contractId);
                $('#contract_title').text(jobTitle);
            });

            // Initialize signature pad
            var canvas = document.getElementById('signature-pad');
            var signaturePad = new SignaturePad(canvas);
            var clearButton = document.getElementById('clear-signature');
            var signatureInput = document.getElementById('signature');

            clearButton.addEventListener('click', function() {
                signaturePad.clear();
            });

            document.querySelector('#signature_form').addEventListener('submit', function(event) {
                if (signaturePad.isEmpty()) {
                    alert('Please provide a signature first.');
                    event.preventDefault();
                } else {
                    signatureInput.value = signaturePad.toDataURL();
                }
            });
        });
    </script>

    <script>
document.addEventListener('DOMContentLoaded', function () {
    let selectedJobId = null;

    // Listen for any withdraw button click
    document.querySelectorAll('.withdrawButton').forEach(button => {
        button.addEventListener('click', function () {
            selectedJobId = this.getAttribute('data-job-id');
        });
    });

    // When user confirms withdrawal
    document.getElementById('confirmWithdrawBtn').addEventListener('click', function () {
        if (selectedJobId) {
            const form = document.getElementById(`statusForm-${selectedJobId}`);
            if (form) {
                form.submit();
            }
        }
    });
});
</script>


    @endsection
