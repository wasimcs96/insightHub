<style>
    /* Basic Reset & Global Styles */

#root, .form-group {
  width: 100%;
  max-width: 420px;
  background-color: #ffffff;
  padding: 2rem 2.5rem;
  border-radius: 8px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
  border: 1px solid #e9ecef;
}

/* Form Group for label + select */
.form-group {
    display: flex;
    flex-direction: column;
}

label {
    margin-bottom: 0.5rem;
    font-weight: 600;
    font-size: 0.875rem;
    color: #343a40;
}

.required {
    color: #dc3545;
    margin-left: 2px;
}

/* Searchable Select Component */
.searchable-select {
  position: relative;
  width: 100%;
  font-size: 1rem;
}

/* Shared input/button styles */
.select-control, .search-input {
    width: 100%;
    padding: 0.625rem 1rem;
    background-color: #fff;
    border: 1px solid #ced4da;
    border-radius: 6px;
    font-size: 1rem;
    line-height: 1.5;
    color: #495057;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.select-control:focus, .search-input:focus {
    outline: none;
    border-color: #86b7fe;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
}

.select-control {
  cursor: pointer;
  display: flex;
  justify-content: space-between;
  align-items: center;
  user-select: none;
  text-align: left;
}

.select-value.placeholder {
  color: #6c757d;
  background-color: #fff!important;
}

.select-arrow {
border: solid #78829D;
    border-width: 0 1.8px 1.8px 0;
    display: inline-block;
    padding: 0px;
    transform: rotate(45deg);
    transition: transform 0.2s ease;
    margin-right: 3px;
}

.select-control[aria-expanded='true'] .select-arrow {
  transform: translateY(2px) rotate(-135deg);
}

.select-dropdown {
  position: absolute;
  top: calc(100% + 8px);
  left: 0;
  right: 0;
  background-color: #fff;
  border: 1px solid rgba(0,0,0,0.1);
  border-radius: 6px;
  box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.1);
  z-index: 1000;
  overflow: hidden;
  padding: 0.75rem;
  display: flex;
  flex-direction: column;
  gap: 0.75rem;
}

.options-list {
  list-style: none;
  margin: 0;
  padding: 0;
  max-height: 220px;
  overflow-y: auto;
}

.option {
  padding: 0.625rem 1rem;
  cursor: pointer;
  transition: background-color 0.2s ease;
  border-radius: 4px;
}

.option:hover,
.option.highlighted {
  background-color: #e9ecef;
}

.option.selected {
    background-color: #0d6efd;
    color: white;
}

.dropdown-message, .no-options {
    padding: 0.625rem 0.25rem;
    color: #6c757d;
    text-align: left;
    font-size: 0.9rem;
}

.no-options {
    list-style-type: none;
    padding-left: 1rem;
}
</style>

<div class="modal-body d-flex flex-column gap-4 p-4">
    <div class="modal-content-p">
        <p class="mb-2">Select how you’d like to assign an employee to:</p>
        <p class="m-0"><b style="word-break: break-all;">{{ $title ?? '-' }} ({{ $code ?? '-' }})</b></p>
    </div>

    


        {{-- <div class="form-group d-flex align-items-center gap-2 mb-0">
            <input class="form-check-input m-0" type="radio" name="jdModificationOption"
                id="modifyExisting" value="modify">
            <label class="form-check-label d-flex align-items-center gap-2 m-0" for="modifyExisting">
                Choose from existing employees
            </label>
        </div> --}}
        <div class="mt-2 searchable-select" id="existingEmployeeGroup">
            <label for="employee-select-button">Employee <span style="color: #F24130">*</span></label>
             <button type="button" id="employee-select-button" class="select-control" aria-haspopup="listbox" aria-expanded="false">
            <span class="select-value">Select an employee</span>
            <span class="select-arrow"></span>
            </button>
            <div class="select-dropdown" style="display: none;">
                <input type="text" class="search-input" placeholder="Search...">
                <input type="hidden" id="addEmployee">
                <input type="hidden" id="employeeText">

                <p class="dropdown-message">Please enter 1 or more characters</p>
                <ul class="options-list" role="listbox">
                    <!-- Options will be populated by JavaScript -->
                </ul>
            </div>
            <div id="employee-error" class="text-danger" style="display: none;">This field is required.</div>
        </div>
        <div class="mt-2" id="existingEmployeeGroup2">
            <label for="Reason for Adding New Employee">Reason for Adding New Employee <span
                    style="color: #F24130">*</span></label>
            <input type="text" class="form-control" id="reasonForAddingEmplyee" placeholder="Reason for Adding New Employee">
        </div>

    <div class="form-group d-flex radio-div flex-column gap-2" style="display: none!important;">
        <input type="hidden" name="profilePitcureUrl"
                id="profilePitcureUrl" >
        <div class="form-group d-flex align-items-center gap-2 mb-0">
            <input class="form-check-input m-0" type="radio" name="jdModificationOption"
                id="addNewEmployee" value="add">
            <label class="form-check-label d-flex align-items-center gap-2 m-0" for="addNewEmployee">
                Add a new employee
            </label>
        </div>
        <div class="form-group mt-2" style="display: none" id="newEmployeeGroup">
            <label for="Reason for Adding New Employee">Reason for Adding New Employee <span
                    style="color: #F24130">*</span></label>
            <input type="text" class="form-control" placeholder="Reason for Adding New Employee">
        </div>
    </div>
</div>
<div class="modal-footer justify-content-center border-0 pt-0">
    <button type="button" class="cancel-button" data-bs-dismiss="modal">Cancel</button>

    <!-- Active Button that triggers modal -->
    <button type="button" id="activeAssignBtn" class="orange-fill" data-modal-submit>
        Assign Employee
    </button>
</div>