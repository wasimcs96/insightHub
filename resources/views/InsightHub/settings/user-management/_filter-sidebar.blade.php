<!-- filepath: c:\Users\CXS\jc-diamond\resources\views\InsightHub\settings\user-management\_filter-sidebar.blade.php -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="filterSidebar" aria-labelledby="filterSidebarLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="filterSidebarLabel">Filter</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <form id="filterForm">
            <input type="hidden" name="tab" value="employee">
            <div class="mb-3">
                <label class="form-label fw-bold" for="businessUnit">Business Unit</label>
                <select id="businessUnit" name="business_unit[]" data-control="select2" class="form-select" multiple>
                    @foreach($businessUnits as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold" for="division">Division</label>
                <select id="division" name="division[]" data-control="select2" class="form-select" multiple>
                    @foreach($divisions as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="form-label fw-bold" for="department">Department</label>
                <select id="department" name="department[]" data-control="select2" class="form-select" multiple>
                    @foreach($departments as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="form-label fw-bold" for="jobPosition">Job Position</label>
                <select id="jobPosition" name="job_position[]" data-control="select2" class="form-select" multiple>
                    @foreach($jobPositions as $id => $title)
                        <option value="{{ $id }}">{{ $title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="form-label fw-bold" for="onboardingEmail">Onboarding Email Status</label>
                <select id="onboardingEmail" name="onboarding_status[]" data-control="select2" class="form-select" multiple>
                    <option value="0">Pending</option>
                    <option value="1">Sent</option>
                </select>
            </div>
            <div class="offcanvas-header d-flex justify-content-end gap-6">
                <button type="reset" class="custom-btn grey-outline bg-white" data-bs-dismiss="offcanvas">Reset</button>
                <button type="submit" class="custom-btn orange-fill">Filter</button>
            </div>
        </form>
    </div>
</div>