<div class="offcanvas offcanvas-end" tabindex="-1" id="filterSidebarCandidate" aria-labelledby="filterSidebarLabelCandidate">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="filterSidebarLabelCandidate">Filter Candidates</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <form id="filterFormCandidate">
            <input type="hidden" name="tab" value="candidate">
            <div class="mb-3">
                <label class="form-label fw-bold" for="businessUnit">Business Unit</label>
                <select id="businessUnitCandidate" name="business_unit[]" data-control="select2" class="form-select" multiple>
                    @foreach($businessUnits as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold" for="division">Division</label>
                <select id="divisionCandidate" name="division[]" data-control="select2" class="form-select" multiple>
                    @foreach($divisions as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="form-label fw-bold" for="department">Department</label>
                <select id="departmentCandidate" name="department[]" data-control="select2" class="form-select" multiple>
                    @foreach($departments as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="form-label fw-bold" for="jobPosition">Job Position</label>
                <select class="form-select" id="jobPositionCandidate" data-control="select2" name="job_position[]" multiple>
                    @foreach($jobPositions as $id => $title)
                        <option value="{{ $id }}">{{ $title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="form-label fw-bold" for="hiringStatus">Hiring Status</label>
                <select class="form-select" id="hiringStatusCandidate" data-control="select2" name="hiring_status" multiple>
                    @foreach(config('helpers.application_status') as $key => $label)
                        <option value="{{ $key }}">{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div class="offcanvas-header d-flex justify-content-end gap-6">
                <button type="reset" class="custom-btn grey-outline bg-white" data-bs-dismiss="modal">Reset</button>
                <button type="submit" class="custom-btn orange-fill">Filter</button>
            </div>
        </form>
    </div>
</div>