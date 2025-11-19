<div class="table-container">
    <table class="custom-table" id="employeeTable">
        <thead>
            {{-- <tr>
                <th>
                    <input type="checkbox">
                </th>
                <th>
                    <div class="employee-head">
                        <p>Employee</p>
                        <div class="d-grid position-relative" style="grid-auto-rows: 10px 10px; top: -4px;">
                            <iconify-icon icon="stash:chevron-up-solid" class="info cursor-pointer"></iconify-icon><iconify-icon icon="stash:chevron-down-solid" class="info cursor-pointer"></iconify-icon>
                        </div>
                    </div>
                </th>
                <th>Hiring Status</th>
                <th>Current Location</th>
                <th>Nationality</th>
                <th>Work Authorisation</th>
                <th>Selection Matrix</th>
                <th>Interview Performance</th>
                <th>OMR</th>
                <th>Suitability Rate</th>
                <th>Work Experience</th>
                <th>Education Program</th>
                <th>Education Level</th>
                <th>Expected Monthly Salary (MYR)</th>
            </tr> --}}
        </thead>
        <tbody>
            <!-- Dynamic content will be injected here via AJAX -->
        </tbody>
    </table>
</div>

<div class="d-flex align-items-center p-4 pb-0">
    <div class="d-flex align-items-center">
        <span class="page-text">Rows per page</span>
        <select id="rowsPerPage" class="form-select form-select-sm page-input-box">
            <option selected>10</option>
            <option value="20">20</option>
            <option value="30">30</option>
            <option value="50">50</option>
        </select>
    </div>
    <nav>
        <ul class="pagination mb-0" id="pagination-links">
            <!-- Pagination links will be injected here via AJAX -->
        </ul>
    </nav>
</div>
