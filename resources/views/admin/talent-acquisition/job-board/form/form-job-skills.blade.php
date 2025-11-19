<div class="" id="job-skills" aria-labelledby="job-skills-tab" tabindex="0">
    <div class="top-content">
        <h3>Job Skills</h3>
        <p>Please review and ensure the listed skills align with the job's responsibilities.</p>
    </div>
    <form method="POST" action="{{ route('admin.talent-acquisition.job-board.create-job-skills') }}" id="jobSkillsForm" onsubmit="submitForm(event)">
        <input type="hidden" name="jobOpeningId" id="jobOpeningId" value="{{ $jobOpeningId }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="row g-3">
            <div class="col-md-12">
                <label class="form-label">Soft Skill</label>
                <div class="d-flex flex-column gap-2">
                    @foreach($jobSoftSkill as $skill)
                        <input type="hidden" name="jobSoftSkills[{{ $skill['id'] }}][id]" value="{{ $skill['id'] }}">
                        <input type="text" class="form-control input-grey" value="{{ $skill['name'] }}" readonly>
                    @endforeach
                </div>
            </div>
            <div class="col-md-12 mt-5">
                <label class="form-label">Technical Skill</label>
                <div class="d-flex flex-column gap-2">
                    @foreach($jobTechnicalSkill as $skill)
                        <input type="hidden" name="jobTechnicalSkills[][tech-id]" value="{{ $skill['tech-id'] }}">
                        <input type="text" class="form-control input-grey" value="{{ $skill['name'] }}" readonly>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="filter-content mt-6 display submit-button">
            <div class="d-flex justify-content-between">
                <div class="d-flex gap-2 ml-auto ">
                    <button class="btn btn-outline" type="button" onclick="saveDraft('jobSkillsForm')">Save Draft</button>
                    <button class="btn btn-apply d-flex align-items-center gap-2" type="submit">Next:
                        Other
                        Details <iconify-icon icon="tabler:arrow-right" width="16" height="16"></iconify-icon></button>
                </div>
            </div>
        </div>
    </form>
</div>