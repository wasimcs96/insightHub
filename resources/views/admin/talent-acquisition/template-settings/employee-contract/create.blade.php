@extends('admin.layout.app')

@section('title', 'Create Employee Contract Template')
@section('content')

<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
        <div data-kt-swapper="true" data-kt-swapper-mode="{default: 'prepend', lg: 'prepend'}"
            data-kt-swapper-parent="{default: '#kt_app_content_container', lg: '#kt_app_toolbar_container'}"
            class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5 mb-lg-0">
            <h1 class="page-heading capitalize d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                Template Create
            </h1>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <li class="breadcrumb-item text-muted">
                    <a href="/admin/dashboard" class="text-muted text-hover-primary">
                        Dashboard </a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">
                    <a href="/admin/mydepartment/department_sections" class="capitalize text-muted text-hover-primary">
                        Settings
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">
                    Contract Template</li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">
                    Create Template</li>
            </ul>
        </div>
    </div>
</div>

<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">
        <div class="card">
            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold fs-3 mb-1">Create Template</span>
                </h3>
            </div>
            <div class="card-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ route('admin.talent-acquisition.template-settings.employee-contract.store') }}" method="POST">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-lg-6">
                                        <label class="required fw-semibold fs-6 mb-2">Template Name</label>
                                        <input type="text" name="name"
                                            class="form-control form-control-solid mb-3 mb-lg-0 @error('name') is-invalid @enderror"
                                            placeholder="Template Name" value="{{ old('name') }}"/>
                                        @error('name')
                                        <div class="invalid-feedback text-red-500">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="required fw-semibold fs-6 mb-2">Template Description</label>
                                        <textarea name="description"
                                            class="form-control form-control-solid mb-3 mb-lg-0 @error('description') is-invalid @enderror"
                                            placeholder="Template Description">{{ old('description') }}</textarea>
                                        @error('description')
                                        <div class="invalid-feedback text-red-500">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Employer Details -->
                                <h4>Employer Details</h4>
                                <div id="employer-details" class="mb-3">
                                    <div class="row mb-3">
                                        <div class="col-lg-4">
                                            <div class="form-control form-control-solid mb-3 mb-lg-0">Company Name</div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-control form-control-solid mb-3 mb-lg-0">Company Address</div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-control form-control-solid mb-3 mb-lg-0">Company Branch</div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-4">
                                            <div class="form-control form-control-solid mb-3 mb-lg-0">Contact Person</div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-control form-control-solid mb-3 mb-lg-0">Contact Phone Number</div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-control form-control-solid mb-3 mb-lg-0">Contact Email</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Employee Details -->
                                <h4>Employee Details</h4>
                                <div id="employee-details" class="mb-3">
                                    <div class="row mb-3">
                                        <div class="col-lg-4">
                                            <div class="form-control form-control-solid mb-3 mb-lg-0">Full Name</div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-control form-control-solid mb-3 mb-lg-0">Position/Job Title</div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-control form-control-solid mb-3 mb-lg-0">Department</div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-4">
                                            <div class="form-control form-control-solid mb-3 mb-lg-0">Date of Birth</div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-control form-control-solid mb-3 mb-lg-0">Gender</div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-control form-control-solid mb-3 mb-lg-0">Civil Status</div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-4">
                                            <div class="form-control form-control-solid mb-3 mb-lg-0">Address</div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-control form-control-solid mb-3 mb-lg-0">Phone</div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-control form-control-solid mb-3 mb-lg-0">Email</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Contract Details -->
                                <h4>Contract Details</h4>
                                <div id="contract-details" class="mb-3">
                                    <div class="row mb-3">
                                        <div class="col-lg-6">
                                            <div class="form-control form-control-solid mb-3 mb-lg-0">Commencement Date</div>
                                        </div>
                                        {{-- <div class="col-lg-6">
                                            <div class="form-control form-control-solid mb-3 mb-lg-0">Contract End Date</div>
                                        </div> --}}
                                        <div class="col-lg-6">
                                            <div class="form-control form-control-solid mb-3 mb-lg-0">Probationary Period (Months)</div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        
                                        <div class="col-lg-6">
                                            <div class="form-control form-control-solid mb-3 mb-lg-0">Employment Type</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg-2 contract-details">
                                        <select class="form-control form-control-solid bg-primary text-white" onchange="addSelectedField(this, 'contract-details')">
                                            <option value="" class="bg-white text-black">Add Optional Field</option>
                                            <option value="contract_end_date" class="bg-white text-black">Contract End Date</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Job Description and Responsibilities -->
                                <h4>Job Description and Responsibilities</h4>
                                <div id="job-description" class="mb-3">
                                    <div class="row mb-3">
                                        <div class="col-lg-6">
                                            <div class="form-control form-control-solid mb-3 mb-lg-0">Place of Work</div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-control form-control-solid mb-3 mb-lg-0">Responsibilities</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Compensation and Benefits -->
                                <h4>Compensation and Benefits</h4>
                                <div id="compensation-benefits" class="mb-3">
                                    <div class="row mb-3">
                                        <div class="col-lg-6">
                                            <div class="form-control form-control-solid mb-3 mb-lg-0">Basic Salary</div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-control form-control-solid mb-3 mb-lg-0">Pay Frequency</div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-6 mb-3">
                                            <div class="form-control form-control-solid mb-3 mb-lg-0">Pag-IBIG</div>
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <div class="form-control form-control-solid mb-3 mb-lg-0">PhilHealth</div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-control form-control-solid mb-3 mb-lg-0">SSS</div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-control form-control-solid mb-3 mb-lg-0">Tardiness & Undertime Policy</div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-6 mb-3">
                                            <div class="form-control form-control-solid mb-3 mb-lg-0">Bank Name</div>
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <div class="form-control form-control-solid mb-3 mb-lg-0">Bank Account Number</div>
                                        </div>
                                    </div>
                                   
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg-2 compensation-benefits">
                                        <select class="form-control form-control-solid bg-primary" onchange="addSelectedField(this, 'compensation-benefits')">
                                            <option value="" class="bg-white">Add Optional Field</option>
                                            <option value="overtime_rates" class="bg-white">Overtime Rates (if applicable)</option>
                                            <option value="allowances" class="bg-white">Allowances</option>
                                            <option value="bonuses_incentives" class="bg-white">Bonuses and Incentives</option>
                                            <option value="benefits" class="bg-white">Benefits</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- Work Hours and Leave -->
                                <h4>Work Hours and Leave</h4>
                                <div id="work-hours-leave" class="mb-3">
                                    <div class="row mb-3">
                                        <div class="col-lg-6">
                                            <div class="form-control form-control-solid mb-3 mb-lg-0">Regular Working Hours</div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-control form-control-solid mb-3 mb-lg-0">Rest Days</div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-6">
                                            <div class="form-control form-control-solid mb-3 mb-lg-0">Holiday Entitlement</div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-control form-control-solid mb-3 mb-lg-0">Leave Entitlement</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Termination and Resignation -->
                                <h4>Termination and Resignation</h4>
                                <div id="termination-resignation" class="mb-3">
                                    <div class="row mb-3">
                                        <div class="col-lg-6">
                                            <div class="form-control form-control-solid mb-3 mb-lg-0">Notice Period</div>
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <div class="form-control form-control-solid mb-3 mb-lg-0">Grounds for Termination</div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-control form-control-solid mb-3 mb-lg-0">Separation Pay</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Other Clauses -->
                                <h4>Other Clauses</h4>
                                <div id="other-clauses" class="mb-3">
                                    <div class="row mb-3">
                                        <div class="col-lg-6">
                                            <div class="form-control form-control-solid mb-3 mb-lg-0">Confidentiality Agreement</div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-control form-control-solid mb-3 mb-lg-0">Non-compete Clause</div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-4">
                                            <div class="form-control form-control-solid mb-3 mb-lg-0">Non-disclosure Agreement</div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-control form-control-solid mb-3 mb-lg-0">Intellectual Property Rights</div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-control form-control-solid mb-3 mb-lg-0">Dispute Resolution</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Acknowledgements -->
                                <h4>Acknowledgements</h4>
                                <div id="acknowledgements" class="mb-3">
                                    <div class="row mb-3">
                                        <div class="col-lg-4">
                                            <div class="form-control form-control-solid mb-3 mb-lg-0">Employee Acknowledgement of Company Policies</div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-control form-control-solid mb-3 mb-lg-0">Employee Acknowledgement of Receipt of Handbook</div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-control form-control-solid mb-3 mb-lg-0">Acknowledgement of Understanding Terms and Conditions</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Signatures and Dates -->
                                <h4>Signatures and Dates</h4>
                                <div id="signatures-dates" class="mb-3">
                                    <div class="row mb-3">
                                        <div class="col-lg-6">
                                            <div class="form-control form-control-solid mb-3 mb-lg-0">Employee Signature</div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-control form-control-solid mb-3 mb-lg-0">Date Signed by Employee</div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-6">
                                            <div class="form-control form-control-solid mb-3 mb-lg-0">Employer Signature</div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-control form-control-solid mb-3 mb-lg-0">Date Signed by Employer</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <!-- Back Button -->
                                    <a href="{{ route('admin.talent-acquisition.template-settings.index', ['page' => 'employee-contract']) }}" class="btn btn-secondary">
                                        Back
                                    </a>
                                    <button class="btn btn-primary" type="submit">Create Template</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    let fieldIndex = 1;

    const optionalFieldDefinitions = {
        "employer-details": {
            "company_branch": { name: "Company Branch", type: "text" },
            "contact_person": { name: "Contact Person", type: "text" },
            "contact_information": { name: "Contact Information (Phone, Email)", type: "text" }
        },
        "employee-details": {
            "department": { name: "Department", type: "text" },
            "date_of_birth": { name: "Date of Birth", type: "date" },
            "gender": { name: "Gender", type: "text" },
            "civil_status": { name: "Civil Status", type: "text" },
            "address": { name: "Address", type: "text" },
            "contact_information": { name: "Contact Information (Phone, Email)", type: "text" }
        },
        "contract-details": {
            "contract_end_date": { name: "Contract End Date (months)", type: "date" },
        },
        "job-description": {
            "place_of_work": { name: "Place of Work", type: "text" },
            "responsibilities": { name: "Responsibilities", type: "text" }
        },
        "compensation-benefits": {
            "overtime_rates": { name: "Overtime Rates (if applicable)", type: "text" },
            "allowances": { name: "Allowances", type: "text" },
            "bonuses_incentives": { name: "Bonuses and Incentives", type: "text" },
            "deductions": { name: "Deductions", type: "text" },
            "benefits": { name: "Benefits", type: "text" },
            "payment_method": { name: "Payment Method", type: "text" }
        },
        "work-hours-leave": {
            "regular_working_hours": { name: "Regular Working Hours", type: "text" },
            "rest_days": { name: "Rest Days", type: "text" },
            "holiday_entitlement": { name: "Holiday Entitlement", type: "text" },
            "leave_entitlement": { name: "Leave Entitlement", type: "text" }
        },
        "termination-resignation": {
            "notice_period": { name: "Notice Period", type: "text" },
            "grounds_for_termination": { name: "Grounds for Termination", type: "text" },
            "separation_pay": { name: "Separation Pay", type: "text" }
        },
        "other-clauses": {
            "confidentiality_agreement": { name: "Confidentiality Agreement", type: "text" },
            "non_compete_clause": { name: "Non-compete Clause", type: "text" },
            "non_disclosure_agreement": { name: "Non-disclosure Agreement", type: "text" },
            "intellectual_property_rights": { name: "Intellectual Property Rights", type: "text" },
            "dispute_resolution": { name: "Dispute Resolution", type: "text" }
        },
        "acknowledgements": {
            "acknowledgement_of_company_policies": { name: "Acknowledgement of Company Policies", type: "text" },
            "acknowledgement_of_receipt_of_handbook": { name: "Acknowledgement of Receipt of Handbook", type: "text" },
            "acknowledgement_of_understanding_terms_and_conditions": { name: "Acknowledgement of Understanding Terms and Conditions", type: "text" }
        },
        "signatures-dates": {
            "employee_signature": { name: "Employee Signature", type: "text" },
            "date_signed_by_employee": { name: "Date Signed by Employee", type: "date" },
            "employer_signature": { name: "Employer Signature", type: "text" },
            "date_signed_by_employer": { name: "Date Signed by Employer", type: "date" }
        }
    };

    function addSelectedField(select, sectionId) {
        const selectedFieldKey = select.value;
        const selectedField = optionalFieldDefinitions[sectionId][selectedFieldKey];
        
        if (selectedField) {
            const sectionDiv = document.getElementById(sectionId);
            const newFieldDiv = document.createElement('div');
            newFieldDiv.classList.add('row', 'mb-3');
            newFieldDiv.innerHTML = `
                <div class="col-lg-6">
                    <label class="fw-semibold fs-6 mb-2">${selectedField.name}</label>
                    <input type="hidden" name="optional_fields[${fieldIndex}][key]" value="${selectedFieldKey}">
                    <input type="hidden" name="optional_fields[${fieldIndex}][type]" value="${selectedField.type}">
                    <input type="hidden" name="optional_fields[${fieldIndex}][group_id]" value="${sectionId}">
                    <div class="form-control form-control-solid mb-3 mb-lg-0">${selectedField.type.charAt(0).toUpperCase() + selectedField.type.slice(1)}</div>
                </div>
                <div class="col-lg-6">
                    <button type="button" class="btn btn-danger mt-4" onclick="removeField(this, '${selectedFieldKey}', '${sectionId}')">Remove</button>
                </div>
            `;
            sectionDiv.appendChild(newFieldDiv);
            fieldIndex++;
            select.options[select.selectedIndex].disabled = true; // Disable the selected option
            select.value = ''; // Reset the select box
        }
    }

    function removeField(button, fieldKey, sectionId) {
        const fieldDiv = button.parentElement.parentElement;
        const selectElement = document.querySelector(`.${sectionId} select`);
        // console.log(sectionId);
        for (let option of selectElement.options) {
            if (option.value === fieldKey) {
                option.disabled = false;
                break;
            }
        }
        
        fieldDiv.remove();
    }
</script>
@endsection
