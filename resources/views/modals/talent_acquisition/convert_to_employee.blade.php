<style>
    .convert-employee-modal .modal-body {
        padding: 32px;
        position: relative;
    }

    .convert-employee-modal .close-icon {
        position: absolute;
        right: 20px;
        top: 20px;
        color: #99A1B7;
        cursor: pointer;
        z-index: 1;
    }

    .convert-employee-modal .warning-icon {
        width: 64px;
        height: 64px;
        color: #F8BB86;
        margin-bottom: 20px;
        display: block;
    }

    .convert-employee-modal .modal-title {
color: #4B5675;
text-align: center;
font-size: 22.75px;
font-weight: 700;
line-height: 27.3px;
    }

    .convert-employee-modal .modal-description {
        color: #5E6278;
        font-size: 14px;
        font-weight: 400;
        line-height: 20px;
        margin-bottom: 20px;
        text-align: center;
    }

    .convert-employee-modal .fields-instruction {
        color: #5E6278;
        font-size: 14px;
        font-weight: 400;
        line-height: 20px;
        margin-bottom: 24px;
        text-align: center;
    }

    .convert-employee-modal .form-group {
        margin-bottom: 20px;
        text-align: left;
        position: relative;
    }

    .convert-employee-modal .form-group label {
        display: block;
        color: #181C32;
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .convert-employee-modal .form-control {
        width: 100%;
        padding: 12px 16px;
        border: 1px solid #E1E3EA;
        border-radius: 8px;
        font-size: 14px;
        color: #181C32;
        background-color: #fff;
        height: 48px;
    }

    .convert-employee-modal .form-control::placeholder {
        color: #A1A5B7;
    }

    .convert-employee-modal .form-control:focus {
        border-color: #F7941C;
        outline: none;
        box-shadow: none;
    }

    .convert-employee-modal .form-control.is-invalid {
        border-color: #f1416c;
    }

    .convert-employee-modal .invalid-feedback {
        display: none;
        color: #f1416c;
        font-size: 12px;
        margin-top: 4px;
    }

    .convert-employee-modal .invalid-feedback.show {
        display: block;
    }

    /* Custom Select Styling */
    .convert-employee-modal .custom-select {
        position: relative;
    }

    .convert-employee-modal .custom-select select {
        appearance: none;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
        background-position: right 12px center;
        background-repeat: no-repeat;
        background-size: 16px;
        padding-right: 40px;
    }

    .convert-employee-modal .modal-actions {
        display: flex;
        justify-content: center;
        gap: 16px;
        margin-top: 32px;
    }

    .convert-employee-modal .btn-cancel {
        padding: 12px 24px;
        border: 1px solid #E1E3EA;
        background-color: #fff;
        color: #5E6278;
        font-size: 14px;
        font-weight: 500;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.2s ease;
        min-width: 160px;
    }

    .convert-employee-modal .btn-cancel:hover {
        border-color: #99A1B7;
        background-color: #F9F9F9;
    }

    .convert-employee-modal .btn-confirm {
        padding: 12px 24px;
        border: none;
        background-color: #F7941C;
        color: #fff;
        font-size: 14px;
        font-weight: 500;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.2s ease;
        min-width: 180px;
    }

    .convert-employee-modal .btn-confirm:hover {
        background-color: #E8851A;
    }

    .convert-employee-modal .btn-confirm:disabled {
        background-color: #99A1B7;
        cursor: not-allowed;
    }

    /* Loading state for dropdown */
    .convert-employee-modal .loading-dropdown {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24'%3e%3ccircle cx='12' cy='12' r='10' stroke='%23F7941C' stroke-width='2'/%3e%3cpath fill='%23F7941C' d='M12 2a10 10 0 0 1 10 10h-2a8 8 0 0 0-8-8V2z'/%3e%3canimateTransform attributeName='transform' type='rotate' dur='1s' repeatCount='indefinite' values='0 12 12;360 12 12'/%3e%3c/svg%3e") !important;
        background-size: 16px !important;
        background-position: right 12px center !important;
    }

    /* Modal Dialog Sizing */
    .convert-employee-modal .modal-dialog {
        max-width: 480px;
    }

    .convert-employee-modal .convert-employee-modal .custom-select select {
        color:#99A1B7;
font-size: 12px;
font-weight: 400;
line-height: 16px;
    }
</style>

<div class="modal-body text-center convert-employee-modal">
    <!-- Close Icon -->
    <iconify-icon icon="ic:round-close" width="24" height="24" class="close-icon"
        data-bs-dismiss="modal"></iconify-icon>
    
    <!-- Warning Icon -->
    <iconify-icon icon="simple-line-icons:question" width="70" height="70" class="mb-2"
        style="color: #F8BB86;"></iconify-icon>
    
    <!-- Modal Title -->
    <h4 class="modal-title mb-4">
        Are You Sure You Want to Convert {{ $title }} as Employee?
    </h4>
    
    <!-- Description -->
    <p class="modal-description">
        Please confirm whether you wish to proceed with converting <strong>{{ $title }}</strong> status to an
        official employee. This action may have implications for employment terms, responsibilities, and system access.
    </p>
    
    <!-- Instructions -->
    <p class="fields-instruction">
        Before proceeding, please ensure the following fields are completed:
    </p>

    <!-- Form -->
    <form id="convertToEmployeeForm">
        <!-- Employee ID Field -->
        <div class="form-group">
            <label for="modalEmployeeId">Employee ID</label>
            <input type="text" 
                   class="form-control" 
                   id="modalEmployeeId" 
                   placeholder="Employee ID"
                   required>
            <div class="invalid-feedback" id="employeeIdError"></div>
        </div>

        <!-- Headcount ID Dropdown -->
        <div class="form-group">
            <label for="modalHeadcountId">Headcount ID</label>
            <div class="custom-select">
                <select class="form-control" id="modalHeadcountId" required>
                    <option value="">Select Headcount ID</option>
                    <!-- Options will be populated dynamically -->
                </select>
            </div>
            <div class="invalid-feedback" id="headcountIdError"></div>
        </div>
    </form>

    <!-- Action Buttons -->
    <div class="modal-actions">
        <button class="btn-cancel" data-bs-dismiss="modal" type="button">
            No, keep as candidate
        </button>
        <button type="submit" class="btn-confirm" data-modal-submit>
            Yes, convert to employee
        </button>
    </div>
</div>

