<div class="" id="job-details" aria-labelledby="job-details-tab"
            tabindex="0">
            <div class="top-content">
                <h3>Job Details</h3>
                <p>Review the job details to ensure accurate understanding.</p>
            </div>
            <form method="POST" action="{{ route('admin.talent-acquisition.job-board.create-job-details') }}" id="jobDetailsForm" onsubmit="submitForm(event)"> 
                @csrf
                <input type="hidden" name="jobOpeningId" id="jobOpeningId" value="{{ $jobOpeningId }}">
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label">Job Role Description</label>
                        <textarea readonly class="p-3 border rounded input-grey w-100"
                            name="jobRoleDescription"
                            style="font-size: 12px; line-height: 16px; height: 150px; resize: none; color:#4B5675;">{{ $jobsData->description}}
                            </textarea>
                    </div>
                    <div class="col mt-5">
                        <label class="form-label">Critical Work Function</label>
                        <div class="d-flex flex-column gap-2">
                            @foreach($jobCriticalSkill as $skill)
                                <input readonly type="text" class="form-control input-grey" name="criticalWorkFunction[]" id="jobTitle" value="{{ $skill->description }}">
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="filter-content mt-6 display submit-button">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex gap-2 ml-auto ">
                            <button class="btn btn-outline" type="button" onclick="saveDraft('jobDetailsForm')">Save Draft</button>
                            <button class="btn btn-apply d-flex align-items-center gap-2" type="submit">Next:
                                Job
                                Qualification <iconify-icon icon="tabler:arrow-right" width="16" height="16"></iconify-icon></button>
                        </div>
                    </div>
                </div>
            </form>

        </div>