<style>
    label {
        color: #071437;
font-size: 12px;
font-weight: 500;
line-height: 16px;
margin-bottom: 5px;
    }

    .form-control {
        color: #071437;
font-size: 12px;
font-weight: 400;
line-height: 16px;
border-radius: 4px;
border: 1px solid #DBDFE9;
    }

    .form-group {
        margin-bottom: 16px;
    }

    .modal-body textarea.form-control::placeholder {
font-family: 'Inter', Helvetica, Arial, sans-serif;
    font-size: 12px !important;
}
</style>
            
            
            <div class="modal-body">
                <form id="addJobPositionForm">
                    <div class="form-group d-flex justify-content-evenly col-lg-12 p-0" style="gap: 16px">
                        <div class="w-100">
                            <label for="modalBusinessUnit">Business Unit</label>
                            <select class="form-control" id="modalBusinessUnit" required>
                                <option value="">Select Business Unit</option>
                                <option value="Business Support Partners">Business Support Partners</option>
                                <!-- Add other options here -->
                            </select>
                            <span id="business_unit_id" class="text-danger"></span>
                        </div>
                        <div class="w-100">
                            <label for="modalDivison">Company/Division</label>
                            <select class="form-control" id="modalDivision" required>
                                <option value="">Select Company/Division</option>
                                <option value="Conti's Specialty Foods, Inc. (CBO)">Conti's Specialty Foods, Inc. (CBO)</option>
                                <!-- Add other options here -->
                            </select>
                            <span id="division_id" class="text-danger"></span>
                        </div>
                        <div class="w-100">
                            <label for="modalDepartment">Department</label>
                            <select class="form-control" id="modalDepartment" required>
                                <option value="">Select Department</option>
                                <!-- Add other options here -->
                            </select>
                            <span id="department_id" class="text-danger"></span> 
                        </div>
                    </div>
                    <div class="form-group d-flex justify-content-evenly col-lg-12 p-0" style="gap: 16px">
                        <div class="w-100">
                            <label for="jobPosition">Job Position</label>
                            <input type="text" class="form-control" id="modalJobPosition" placeholder="Job Position" required>
                            <span id="job_position_name" class="text-danger"></span>
                            
                        </div>
                        <div class="w-100">
                            <label for="positionCode">Position Code</label>
                            <input type="text" class="form-control" id="modalPositionCode" placeholder="Position Code" required oninput="validatePositionCode(event)">
                            <span id="positionCode" class="text-danger"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jobDescription">Job Description</label>
                        <textarea class="form-control" id="modalJobDescription" rows="4" placeholder="Job Description" required></textarea>
                          <span id="jobDescription" class="text-danger"></span> 
                    </div>
                </form>
                <div class="modal-footer justify-content-center p-0 border-0">
                <button type="button" class="btn btn-outline" data-bs-dismiss="modal" style="flex: none;">Cancel</button>
                <button type="button" class="btn btn-primary btn-outline" id="submitJobPosition" style="flex: none; border-color: #f7941d;" data-modal-submit>Add Job Position</button>
                </div>
            </div>
            

