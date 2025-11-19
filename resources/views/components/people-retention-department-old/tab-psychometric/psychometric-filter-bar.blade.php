<style>
    .employee-position-search {
        width: 25% !important;
    }
</style>


{{-- <div class="employee-directory-filter-bar">
    <div class="employee-filter">
        <h4 >Filter</h4>
        <div class="position-level">
            <div class="dropdown-button-container">
                <button class="dropdown-button">Position Level</button>
                <i class="bi bi-chevron-down"></i>
            </div>
            <div class="dropdown-content">
                <div class="employee-checkbox-container-level">
                    <input value="1" type="radio" class="filter-checkboxEmployee" data-level="1" onchange="updateFiltersEmployee()">
                    <label>Level 1</label>
                </div>
                <div class="buttons">
                    <button class="cancel-btn">Cancel</button>
                    <button class="filter-btn">Filter</button>
                </div>
            </div>
        </div>
        <div class="position-level">
            <div class="dropdown-button-container">
                <button class="dropdown-button">Job Position</button>
                <i class="bi bi-chevron-down"></i>
            </div>
            <div class="dropdown-content">
                <div class="employee-checkbox-container-level">
                    <input value="1" type="radio" class="filter-checkboxEmployee" data-level="1" onchange="updateFiltersEmployee()">
                    <label>Level 1</label>
                </div>
                <div class="buttons">
                    <button class="cancel-btn">Cancel</button>
                    <button class="filter-btn">Filter</button>
                </div>
            </div>
        </div>
        <div class="position-level">
            <div class="dropdown-button-container">
                <button class="dropdown-button">Assessment Completion</button>
                <i class="bi bi-chevron-down"></i>
            </div>
            <div class="dropdown-content">
                <div class="employee-checkbox-container-level">
                    <input value="1" type="radio" class="filter-checkboxEmployee" data-level="1" onchange="updateFiltersEmployee()">
                    <label>Level 1</label>
                </div>
                <div class="buttons">
                    <button class="cancel-btn">Cancel</button>
                    <button class="filter-btn">Filter</button>
                </div>
            </div>
        </div>
    </div>
    <div class="employee-wrap" style="margin-left: 10px; margin-bottom:3px;">
        <div class="employee-search">
            <input type="text" class="employee-searchTerm" placeholder="Search Employee" id="searchEmployeeInput">
            <button type="button" class="employee-searchButton" onclick="filterEmployees()">
                <i class="fa fa-search"></i>
            </button>
        </div>
    </div>
</div> --}}

<div class="filter-buttons d-flex align-items-center mb-14" data-tab="individual">
    <h4>Filter</h4>
    <div class="dropdown">
        <button class="filter-btn" type="button" id="IPRPositionLevel" data-bs-toggle="dropdown"
            data-default-text="Position Level" aria-expanded="false">
            <span>Position Level</span> <iconify-icon icon="tabler:chevron-down" width="16"
                height="16"></iconify-icon>
        </button>
        <div class="dropdown-menu mt-4" style="width: 202px;">
            <div class="d-flex gap-3 align-items-center custom-check-input">
                <input class="interview-option" type="radio" name="IPRPositionLevelFilter" value="Level 1"
                    data-target="IPRPositionLevel">
                <label class="form-check-label d-flex align-items-center justify-content-between w-100">
                    <p class="m-0">Level 1</p> <span>10</span>
                </label>
            </div>
            <div class="d-flex gap-3 align-items-center custom-check-input">
                <input class="interview-option" type="radio" name="IPRPositionLevelFilter" value="Level 2"
                    data-target="IPRPositionLevel">
                <label class="form-check-label d-flex align-items-center justify-content-between w-100">
                    <p class="m-0">Level 2</p> <span>4</span>
                </label>
            </div>
            <div class="d-flex gap-3 align-items-center custom-check-input">
                <input class="interview-option" type="radio" name="IPRPositionLevelFilter" value="Level 3"
                    data-target="IPRPositionLevel">
                <label class="form-check-label d-flex align-items-center justify-content-between w-100">
                    <p class="m-0">Level 3</p> <span>2</span>
                </label>
            </div>
            <div class="d-flex justify-content-end gap-4 align-items-center button-div">
                <button class="resetBtn border-0" data-target="IPRPositionLevel">Reset</button>
                <button class="filter border-0">Filter</button>
            </div>
        </div>
    </div>
    <div class="dropdown">
        <button class="filter-btn" type="button" id="IPRJobPosition" data-bs-toggle="dropdown"
            data-default-text="Job Position" aria-expanded="false">
            <span>Job Position</span> <iconify-icon icon="tabler:chevron-down" width="16"
                height="16"></iconify-icon>
        </button>
        <div class="dropdown-menu mt-4" style="width: 202px;">
            <div class="d-flex gap-3 align-items-center custom-check-input">
                <input class="interview-option" type="radio" name="IPRJobPositionFilter"
                    value="Group Head of Network Management Center" data-target="IPRJobPosition">
                <label class="form-check-label d-flex align-items-center justify-content-between w-100">
                    <p class="m-0">Group Head of Network Management Center</p> <span>1</span>
                </label>
            </div>
            <div class="d-flex gap-3 align-items-center custom-check-input">
                <input class="interview-option" type="radio" name="IPRJobPositionFilter" value="Head of Ops Delivery"
                    data-target="IPRJobPosition">
                <label class="form-check-label d-flex align-items-center justify-content-between w-100">
                    <p class="m-0">Head of Ops Delivery</p> <span>6</span>
                </label>
            </div>
            <div class="d-flex gap-3 align-items-center custom-check-input">
                <input class="interview-option" type="radio" name="IPRJobPositionFilter"
                    value="Head of Dispatch & Ops Projects" data-target="IPRJobPosition">
                <label class="form-check-label d-flex align-items-center justify-content-between w-100">
                    <p class="m-0">Head of Dispatch & Ops Projects</p> <span>9</span>
                </label>
            </div>
            <div class="d-flex justify-content-end gap-4 align-items-center button-div">
                <button class="resetBtn border-0" data-target="IPRJobPosition">Cancel</button>
                <button class="filter border-0">Filter</button>
            </div>
        </div>
    </div>

    <div class="dropdown">
        <button class="filter-btn" type="button" id="AssessmentCompletion" data-bs-toggle="dropdown"
            data-default-text="Assessment Completion" aria-expanded="false">
            <span>Assessment Completion</span> <iconify-icon icon="tabler:chevron-down" width="16"
                height="16"></iconify-icon>
        </button>
        <div class="dropdown-menu mt-4" style="width: 202px;">
            <div class="d-flex gap-3 align-items-center custom-check-input">
                <input class="interview-option" type="radio" name="AssessmentCompletionFilter"
                    value="All Assessments Completed" data-target="AssessmentCompletion">
                <label class="form-check-label d-flex align-items-center justify-content-between w-100">
                    <p class="m-0">All Assessments Completed</p> <span>90</span>
                </label>
            </div>
            <div class="d-flex gap-3 align-items-center custom-check-input">
                <input class="interview-option" type="radio" name="AssessmentCompletionFilter" value="Incomplete Assessments"
                    data-target="AssessmentCompletion">
                <label class="form-check-label d-flex align-items-center justify-content-between w-100">
                    <p class="m-0">Incomplete Assessments</p> <span>10</span>
                </label>
            </div>
            <div class="d-flex justify-content-end gap-4 align-items-center button-div">
                <button class="resetBtn border-0" data-target="AssessmentCompletion">Cancel</button>
                <button class="filter border-0">Filter</button>
            </div>
        </div>
    </div>
    <div class="employee-search employee-position-search">
        <input type="text" class="employee-searchTerm" placeholder="Search Employee" id="searchEmployeeInput">
        <button type="button" class="employee-searchButton" onclick="filterEmployees()">
            <i class="fa fa-search"></i>
        </button>
    </div>
</div>