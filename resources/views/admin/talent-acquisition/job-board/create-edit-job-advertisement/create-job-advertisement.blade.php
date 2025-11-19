{{-- create-job-advertisement.blade.php --}}
@php
    \Log::debug('ParentView SecondaryScope:', $secondaryScope);
@endphp

<style>
    .submit-button {
        background: none !important;
        border-bottom: none !important;
        box-shadow: none !important;
    }

    .select2-search__field,
    .tagify__input {
        font-size: 12px !important;
        font-weight: 400 !important;
    }

    .text-danger {
        color: red;
    }

    .disabled-link {
        pointer-events: none;
        opacity: 0.5;
        cursor: not-allowed;
    }
</style>


<div>
    <div class="d-flex align-items-start modal-step-form">
        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a href="{{ route('admin.talent-acquisition.job-board.create-edit-job-advertisement.create-job-advertisement-page', ['step' => 1]) }}"
                class="nav-link {{ $step == 1 ? 'active' : ($step != 1 ? 'disabled-link' : '') }}"
                id="vacancy-details-tab" role="tab" aria-selected="true">
                <span class="circle-gray {{ $step == 1 ? 'active' : '' }}"></span>Vacancy Details
            </a>
            <div class="line-horizontal"></div>
            <a href="{{ route('admin.talent-acquisition.job-board.create-edit-job-advertisement.create-job-advertisement-page', ['step' => 2]) }}"
                class="nav-link {{ $step == 2 ? 'active' : ($step != 2 ? 'disabled-link' : '') }}" id="job-details-tab"
                role="tab" aria-selected="false">
                <span class="circle-gray {{ $step == 2 ? 'active' : '' }}"></span>Job Details
            </a>
            <div class="line-horizontal"></div>
            <a href="{{ route('admin.talent-acquisition.job-board.create-edit-job-advertisement.create-job-advertisement-page', ['step' => 3]) }}"
                class="nav-link {{ $step == 3 ? 'active' : ($step != 3 ? 'disabled-link' : '') }}"
                id="job-qualifications-tab" role="tab" aria-selected="false">
                <span class="circle-gray {{ $step == 3 ? 'active' : '' }}"></span>Job Qualifications
            </a>
            <div class="line-horizontal"></div>
            <a href="{{ route('admin.talent-acquisition.job-board.create-edit-job-advertisement.create-job-advertisement-page', ['step' => 4]) }}"
                class="nav-link {{ $step == 4 ? 'active' : ($step != 4 ? 'disabled-link' : '') }}" id="job-skills-tab"
                role="tab" aria-selected="false">
                <span class="circle-gray {{ $step == 4 ? 'active' : '' }}"></span>Job Skills
            </a>
            <div class="line-horizontal"></div>
            <a href="{{ route('admin.talent-acquisition.job-board.create-edit-job-advertisement.create-job-advertisement-page', ['step' => 5]) }}"
                class="nav-link {{ $step == 5 ? 'active' : ($step != 5 ? 'disabled-link' : '') }}"
                id="other-details-tab" role="tab" aria-selected="false">
                <span class="circle-gray {{ $step == 5 ? 'active' : '' }}"></span>Other Details
            </a>
            <div class="line-horizontal"></div>
            <a href="{{ route('admin.talent-acquisition.job-board.create-edit-job-advertisement.create-job-advertisement-page', ['step' => 6]) }}"
                class="nav-link {{ $step == 6 ? 'active' : ($step != 6 ? 'disabled-link' : '') }}"
                id="hiring-workflow-tab" role="tab" aria-selected="false">
                <span class="circle-gray {{ $step == 6 ? 'active' : '' }}"></span>Hiring Workflow
            </a>
            <div class="line-horizontal"></div>
            <a href="{{ route('admin.talent-acquisition.job-board.create-edit-job-advertisement.create-job-advertisement-page', ['step' => 7]) }}"
                class="nav-link {{ $step == 7 ? 'active' : ($step != 7 ? 'disabled-link' : '') }}"
                id="review-details-tab" role="tab" aria-selected="false">
                <span class="circle-gray {{ $step == 7 ? 'active' : '' }}"></span>Review Details
            </a>
            @php
                $stepLabels = [
                    1 => 'Vacancy Details',
                    2 => 'Job Details',
                    3 => 'Job Qualifications',
                    4 => 'Job Skills',
                    5 => 'Other Details',
                    6 => 'Hiring Workflow',
                    7 => 'Review Details',
                ];

                $previousStep = $step > 1 ? $step - 1 : null;
                $jobId = request()->get('jobId');
                $jobOpeningId = request()->get('jobOpeningId');
            @endphp

            @if ($previousStep && request()->has('reuse'))
                <div class="filter-content display" style="margin-top: 105px">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.talent-acquisition.job-board.create-edit-job-advertisement.create-job-advertisement-page', [
                                'step' => $previousStep,
                                'jobId' => $jobId,
                                'jobOpeningId' => $jobOpeningId,
                                'edit' => 'true',
                                'fromPrevious' => 1,
                                'reuse' => 'true'
                            ]) }}" 
                            class="btn btn-outline outline ignore-save-draft">
                            Previous: {{ $stepLabels[$previousStep] }}
                        </a>
                    </div>
                </div>
            @elseif ($previousStep && request()->has('create'))
                <div class="filter-content display" style="margin-top: 105px">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.talent-acquisition.job-board.create-edit-job-advertisement.create-job-advertisement-page', [
                                'step' => $previousStep,
                                'jobId' => $jobId,
                                'jobOpeningId' => $jobOpeningId,
                                'edit' => 'true',
                                'fromPrevious' => 1,
                                'create' => 'true'
                            ]) }}" 
                            class="btn btn-outline outline ignore-save-draft">
                            Previous: {{ $stepLabels[$previousStep] }}
                        </a>
                    </div>
                </div>
            @elseif ($previousStep)
                <div class="filter-content display" style="margin-top: 105px">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.talent-acquisition.job-board.create-edit-job-advertisement.create-job-advertisement-page', [
                                'step' => $previousStep,
                                'jobId' => $jobId,
                                'jobOpeningId' => $jobOpeningId,
                                'edit' => 'true',
                                'fromPrevious' => 1
                            ]) }}" 
                            class="btn btn-outline outline ignore-save-draft">
                            Previous: {{ $stepLabels[$previousStep] }}
                        </a>
                    </div>
                </div>
            @endif

        </div>
        <div class="tab-content" id="v-pills-tabContent">
            @if ($step == 1)
                @include('admin.talent-acquisition.job-board.form.form-vacancy-details')
            @elseif ($step == 2)
                @include('admin.talent-acquisition.job-board.form.form-job-details')
            @elseif ($step == 3)
                @include('admin.talent-acquisition.job-board.form.form-job-qualification')
            @elseif ($step == 4)
                @include('admin.talent-acquisition.job-board.form.form-job-skills')
            @elseif ($step == 5)
                @include('admin.talent-acquisition.job-board.form.form-other-details')
            @elseif ($step == 6)
                @include('admin.talent-acquisition.job-board.form.form-hiring-workflow')
            @elseif ($step == 7)
                @include('admin.talent-acquisition.job-board.form.form-review-details')
            @endif
        </div>
    </div>
</div>

<div class="modal fade" id="SaveAsDraft" tabindex="-1" aria-labelledby="SaveAsDraftLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-div">
            <button 
                type="button" 
                class="p-0 border-0 bg-white" 
                data-bs-dismiss="modal" 
                aria-label="Close"
                style="position: absolute; top: 16px; right: 16px; z-index: 10;"
                >
                <img src="{{ asset('/admin/media/svg/shapes/cancel.svg') }}" alt="cancel">
            </button>
            <div class="modal-body py-0 pt-5 text-center">
                <iconify-icon icon="simple-line-icons:exclamation" width="70" height="70" class="my-5"
                    style="color: #FF6355;"></iconify-icon>
                <p class="fw-bolder fs-1 lh-1 text-center" style="color: #4B5675;">Do You Want to Save Your Draft Before Leaving?</p>
                <p class="m-0 text-center" style="color: #4B5675;">You have unsaved changes. Do you want to save your draft before leaving, or discard your changes?</p>
            </div>
            <div class="modal-footer modal-footer d-block border-0">
                <div class="filter-content d-flex justify-content-between gap-2">
                    <button class="btn btn-outline" data-bs-dismiss="modal" style="flex: 1 0 0;">No, discard It</button>
                    <button class="btn btn-apply" style="flex: 1 0 0;">
                        Yes, save draft
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ConfirmationDiscardDraft" tabindex="-1" aria-labelledby="ConfirmationDiscardDraftLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-div">
            <button 
                type="button" 
                class="p-0 border-0 bg-white" 
                data-bs-dismiss="modal" 
                aria-label="Close"
                style="position: absolute; top: 16px; right: 16px; z-index: 10;"
                >
                <img src="{{ asset('/admin/media/svg/shapes/cancel.svg') }}" alt="cancel">
            </button>
            <div class="modal-body py-0 pt-5 text-center">
                <iconify-icon icon="simple-line-icons:exclamation" width="70" height="70" class="my-5"
                    style="color: #FF6355;"></iconify-icon>
                <p class="fw-bolder fs-1 lh-1 text-center" style="color: #4B5675;">Are You Sure You Want to Discard this Draft?</p>
                <p class="m-0 text-center" style="color: #4B5675;">If you discard your draft, your changes will be lost permanently. This action cannot be undone. Do you want to proceed?</p>
            </div>
            <div class="modal-footer modal-footer d-block border-0">
                <div class="filter-content d-flex justify-content-between gap-2">
                    <button class="btn btn-outline" data-bs-dismiss="modal" style="flex: 1 0 0;">Cancel</button>
                    <button class="btn btn-apply" style="flex: 1 0 0; background: #F24130 !important;">
                        Discard Draft
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="CancelEditConfirmation" tabindex="-1" aria-labelledby="CancelEditConfirmationLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-div">
            <button 
                type="button" 
                class="p-0 border-0 bg-white" 
                data-bs-dismiss="modal" 
                aria-label="Close"
                style="position: absolute; top: 16px; right: 16px; z-index: 10;"
                >
                <img src="{{ asset('/admin/media/svg/shapes/cancel.svg') }}" alt="cancel">
            </button>
            <div class="modal-body py-0 pt-5 text-center">
                <iconify-icon icon="simple-line-icons:exclamation" width="70" height="70" class="my-5"
                    style="color: #FF6355;"></iconify-icon>
                <p class="fw-bolder fs-1 lh-1 text-center" style="color: #4B5675;">Are You Sure You Want to Cancel Editing?</p>
                <p class="m-0 text-center" style="color: #4B5675;">Are you sure you want to cancel editing this job advertisment? Any unsaved changes will be lost</p>
            </div>
            <div class="modal-footer modal-footer d-block border-0">
                <div class="filter-content d-flex justify-content-between gap-2">
                    <button class="btn btn-outline" data-bs-dismiss="modal" style="flex: 1 0 0;">No, keep editing</button>
                    <button class="btn btn-apply" style="flex: 1 0 0; background: #F24130 !important;">
                        Yes, cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
