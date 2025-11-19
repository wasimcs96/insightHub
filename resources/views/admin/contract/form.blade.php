@extends('admin.layout.app')

@section('title', 'Create Section')
@section('content')

    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <div data-kt-swapper="true" data-kt-swapper-mode="{default: 'prepend', lg: 'prepend'}"
                data-kt-swapper-parent="{default: '#kt_app_content_container', lg: '#kt_app_toolbar_container'}"
                class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5 mb-lg-0">
                <h1
                    class="page-heading capitalize d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                    Contract Create
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
                        Contract</li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        Create Create</li>
                </ul>
            </div>
        </div>
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card">
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold fs-3 mb-1">Create Contract</span>
                    </h3>
                </div>
                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="{{ route('admin.assign.contract.employee', $template->id) }}" method="POST"
                                    id="contract_form">
                                    @csrf

                                    {{-- <div class="row mb-3">
                                    <div class="col-lg-6">
                                        <label class="required fw-semibold fs-6 mb-2">Template Name</label>
                                        <input type="text" name="name" class="form-control form-control-solid mb-3 mb-lg-0 @error('name') is-invalid @enderror" placeholder="Template Name" value="{{ old('name', $template->name) }}"/>
                                        @error('name')
                                        <div class="invalid-feedback text-red-500">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="required fw-semibold fs-6 mb-2">Template Description</label>
                                        <textarea name="description" class="form-control form-control-solid mb-3 mb-lg-0 @error('description') is-invalid @enderror" placeholder="Template Description">{{ old('description', $template->description) }}</textarea>
                                        @error('description')
                                        <div class="invalid-feedback text-red-500">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div> --}}

                                    <!-- Employer Details -->
                                    <input type="hidden" name="employee_id" value="{{ $employee->id }}">
                                    <input type="hidden" name="company_id" value="{{ $company->id }}">
                                    <input type="hidden" name="job_id" value="{{ $job->id ?? '' }}">
                                    <input type="hidden" name="job_application_id" value="{{ $jobApplication->id ?? '' }}">



                                    <h4>Employer Details</h4>
                                    <div id="employer-details" class="mb-10">
                                        <div class="row mb-3">
                                            <div class="col-lg-4">

                                                <label class="fw-semibold fs-6 mb-2">Company Name</label>
                                                <input type="text" name="company_name"
                                                    class="form-control form-control-solid mb-3 mb-lg-0"
                                                    value="{{ $company->userCompany->name ?? '' }}" required>
                                            </div>
                                            <div class="col-lg-4">
                                                <label class="fw-semibold fs-6 mb-2">Company Address</label>
                                                <input type="text" name="company_address"
                                                    class="form-control form-control-solid mb-3 mb-lg-0"
                                                    value="{{ $company->userCompany->address ?? '' }}" required>
                                            </div>
                                            <div class="col-lg-4">
                                                <label class="fw-semibold fs-6 mb-2">Company Branch</label>
                                                <input type="text" name="company_branch"
                                                    value="{{ $company->userCompany->name ?? '' }}"
                                                    class="form-control form-control-solid mb-3 mb-lg-0">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-lg-4">
                                                <label class="fw-semibold fs-6 mb-2 required">Contact Person</label>
                                                <input type="text" name="contact_person"
                                                    class="form-control form-control-solid mb-3 mb-lg-0"
                                                    value="{{ old('contact_person') }}" required>
                                                <div class="invalid-feedback">This field is required.</div>
                                            </div>
                                            <div class="col-lg-4">
                                                <label class="fw-semibold fs-6 mb-2">Contact Phone Number</label>
                                                <input type="text" name="contact_phone_number"
                                                    value="{{ $company->userCompany->mobile_number ?? '' }}"
                                                    class="form-control form-control-solid mb-3 mb-lg-0" required>
                                            </div>
                                            <div class="col-lg-4">
                                                <label class="fw-semibold fs-6 mb-2">Contact Email</label>
                                                <input type="email" name="contact_email"
                                                    value="{{ $company->userCompany->email ?? '' }}"
                                                    class="form-control form-control-solid mb-3 mb-lg-0" required>
                                            </div>
                                        </div>
                                        @foreach ($template->fields as $field)
                                            @if ($field->group_id == 'employer-details')
                                                <div class="row mb-3" id="field-{{ $loop->index }}">
                                                    <div class="col-lg-6">
                                                        <label
                                                            class="fw-semibold fs-6 mb-2">{{ Str::title(str_replace('_', ' ', $field->field_name)) }}</label>
                                                        <input type="hidden"
                                                            name="optional_fields[{{ $loop->index }}][key]"
                                                            value="{{ $field->field_name }}">
                                                        <input type="hidden"
                                                            name="optional_fields[{{ $loop->index }}][type]"
                                                            value="{{ $field->field_type }}">
                                                        <input type="hidden"
                                                            name="optional_fields[{{ $loop->index }}][group_id]"
                                                            value="employer-details">
                                                        <input type="{{ $field->field_type }}"
                                                            class="form-control form-control-solid mb-3 mb-lg-0"
                                                            name="optional_fields[{{ $loop->index }}][value]">
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <button type="button" class="btn btn-danger mt-4"
                                                            onclick="removeField(this, '{{ $field->field_name }}', 'employer-details')">Remove</button>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>

                                    <!-- Employee Details -->
                                    <h4>Employee Details</h4>
                                    <div id="employee-details" class="mb-10">
                                        <div class="row mb-3">
                                            <div class="col-lg-4">
                                                <label class="fw-semibold fs-6 mb-2">Full Name</label>
                                                <input type="text" name="full_name"
                                                    value="{{ $employee->name ?? '' }}"
                                                    class="form-control form-control-solid mb-3 mb-lg-0" required>
                                            </div>
                                            <div class="col-lg-4">
                                                <label class="fw-semibold fs-6 mb-2">Position/Job Title</label>

                                                <input type="text" name="position" value="{{ $job->title ?? '' }}"
                                                    readonly class="form-control form-control-solid mb-3 mb-lg-0" required>
                                            </div>
                                            <div class="col-lg-4">
                                                <label class="fw-semibold fs-6 mb-2">Department</label>
                                                <input type="text" name="department"
                                                    value="{{ $job->OrgDepartment->name ?? '' }}" readonly
                                                    class="form-control form-control-solid mb-3 mb-lg-0">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-lg-4">
                                                <label class="fw-semibold fs-6 mb-2">Date of Birth</label>
                                                <input type="date" name="birth_date"
                                                    value="{{ $employee->birth_date ?? '' }}"
                                                    class="form-control form-control-solid mb-3 mb-lg-0">
                                            </div>
                                            <div class="col-lg-4">
                                                <label class="fw-semibold fs-6 mb-2">Gender</label>
                                                {{-- <input type="text" name="gender"
                                                    value="@if (isset($employee) && $employee->gender == 0) Male @elseif($employee->gender == 1)Female @else Other @endif"
                                                    class="form-control form-control-solid mb-3 mb-lg-0"> --}}
                                                <select id="gender"
                                                    class="form-control form-control-solid mb-3 mb-lg-0" name="gender">
                                                    <option value="0"
                                                        @if (!empty($employee) && $employee->gender == '0') selected @endif>
                                                        Male</option>
                                                    <option value="1"
                                                        @if (!empty($employee) && $employee->gender == '1') selected @endif>
                                                        Female</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-4">
                                                <label class="fw-semibold fs-6 mb-2">Civil Status</label>
                                                {{-- <input type="text" name="civil_status"
                                                    value="{{ config('constants.MARITAL_STATUSES.' . $employee->marital_status) }}"
                                                    class="form-control form-control-solid mb-3 mb-lg-0"> --}}
                                                <select id="marital_status"
                                                    class="form-control form-control-solid mb-3 mb-lg-0"
                                                    name="marital_status">
                                                    <option value="">Select Civil Status</option>
                                                    @foreach (config('constants.MARITAL_STATUSES') as $key => $ms)
                                                        <option value="{{ $key }}"
                                                            @if (!empty($employee) && $employee->marital_status == $key) Selected @endif>
                                                            {{ $ms }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-lg-4">
                                                <label class="fw-semibold fs-6 mb-2">Address</label>
                                                <input type="text" name="home_address"
                                                    value="{{ $employee->home_address ?? '' }}"
                                                    class="form-control form-control-solid mb-3 mb-lg-0">
                                            </div>
                                            <div class="col-lg-4">
                                                <label class="fw-semibold fs-6 mb-2">Phone</label>
                                                <input type="text" name="mobile_number"
                                                    value="{{ $employee->mobile_number ?? '' }}"
                                                    class="form-control form-control-solid mb-3 mb-lg-0">
                                            </div>
                                            <div class="col-lg-4">
                                                <label class="fw-semibold fs-6 mb-2">Email</label>
                                                <input type="email" name="email"
                                                    value="{{ $employee->email ?? '' }}"
                                                    class="form-control form-control-solid mb-3 mb-lg-0" readonly>
                                            </div>
                                            <div class="col-lg-4 mt-3">
                                                <label class="fw-semibold fs-6 mb-2 required">Official Email</label>
                                                <input type="email" name="emp_official_email" value=""
                                                    class="form-control form-control-solid mb-3 mb-lg-0  @error('emp_official_email') is-invalid @enderror">
                                                <div class="invalid-feedback">This field is required.</div>
                                                @error('emp_official_email')
                                                    <div class="invalid-feedback text-red-500">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        @foreach ($template->fields as $field)
                                            @if ($field->group_id == 'employee-details')
                                                <div class="row mb-3" id="field-{{ $loop->index }}">
                                                    <div class="col-lg-6">
                                                        <label
                                                            class="fw-semibold fs-6 mb-2">{{ Str::title(str_replace('_', ' ', $field->field_name)) }}</label>
                                                        <input type="hidden"
                                                            name="optional_fields[{{ $loop->index }}][key]"
                                                            value="{{ $field->field_name }}">
                                                        <input type="hidden"
                                                            name="optional_fields[{{ $loop->index }}][type]"
                                                            value="{{ $field->field_type }}">
                                                        <input type="hidden"
                                                            name="optional_fields[{{ $loop->index }}][group_id]"
                                                            value="employee-details">
                                                        <input type="{{ $field->field_type }}"
                                                            class="form-control form-control-solid mb-3 mb-lg-0"
                                                            name="optional_fields[{{ $loop->index }}][value]">
                                                    </div>
                                                    {{-- <div class="col-lg-6">
                                                    <button type="button" class="btn btn-danger mt-4" onclick="removeField(this, '{{ $field->field_name }}', 'employee-details')">Remove</button>
                                                </div> --}}
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>

                                    <!-- Contract Details -->
                                    <h4>Contract Details</h4>
                                    <div id="contract-details" class="mb-10">
                                        <div class="row mb-3">
                                            <div class="col-lg-6">
                                                <label class="fw-semibold fs-6 mb-2 required">Commencement Date</label>
                                                <input type="date" name="commencement_date"
                                                    class="form-control form-control-solid mb-3 mb-lg-0 @error('commencement_date') is-invalid @enderror"
                                                    value="{{ old('commencement_date') }}" required>
                                                <div class="invalid-feedback">This field is required.</div>
                                                @error('commencement_date')
                                                    <div class="invalid-feedback text-red-500">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            {{-- <div class="col-lg-6">
                                            <label class="fw-semibold fs-6 mb-2">Contract End Date</label>
                                            <input type="date" name="contract_end_date" class="form-control form-control-solid mb-3 mb-lg-0">
                                        </div> --}}
                                            <div class="col-lg-6">
                                                <label class="fw-semibold fs-6 mb-2">Probationary Period (Months)</label>
                                                <input type="number" name="probationary_period"
                                                    class="form-control form-control-solid mb-3 mb-lg-0">
                                            </div>
                                        </div>
                                        <div class="row ">
                                            {{-- <div class="col-lg-6 mb-3">
                                                <label class="fw-semibold fs-6 mb-2">Probationary Period (Months)</label>
                                                <input type="number" name="probationary_period"
                                                    class="form-control form-control-solid mb-3 mb-lg-0">
                                            </div> --}}
                                            <div class="col-lg-6 mb-3">
                                                <label class="fw-semibold fs-6 mb-2">Employment Type</label>
                                                <select class="form-select form-control-solid" name="employment_type">
                                                    @foreach (config('constants.EMPLOYMENT_STATUSES') as $key => $ep)
                                                        <option value="{{ $key }}">{{ $ep }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            @foreach ($template->fields as $field)
                                                @if ($field->group_id == 'contract-details')
                                                    {{-- <div class="row mb-3" id="field-{{ $loop->index }}"> --}}
                                                    <div class="col-lg-6 mb-3">
                                                        <label
                                                            class="fw-semibold fs-6 mb-2">{{ Str::title(str_replace('_', ' ', $field->field_name)) }}</label>
                                                        {{-- <input type="hidden"
                                                            name="optional_fields[{{ $loop->index }}][key]"
                                                            value="{{ $field->field_name }}">
                                                        <input type="hidden"
                                                            name="optional_fields[{{ $loop->index }}][type]"
                                                            value="{{ $field->field_type }}">
                                                        <input type="hidden"
                                                            name="optional_fields[{{ $loop->index }}][group_id]"
                                                            value="contract-details"> --}}
                                                        <input type="{{ $field->field_type }}"
                                                            class="form-control form-control-solid mb-3 mb-lg-0"
                                                            name="{{ $field->field_name }}">
                                                        {{-- </div> --}}
                                                        {{-- <div class="col-lg-6">
                                                    <button type="button" class="btn btn-danger mt-4" onclick="removeField(this, '{{ $field->field_name }}', 'contract-details')">Remove</button>
                                                </div> --}}
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                        {{-- <div class="row mb-3">
                                        <div class="col-lg-2">
                                            <select class="form-control form-control-solid bg-primary text-white" onchange="addSelectedField(this, 'contract-details')">
                                                <option value="" class="bg-white text-black">Add Optional Field</option>
                                                @foreach ($optionalFieldDefinitions['contract-details'] as $key => $field)
                                                    <option value="{{ $key }}" class="bg-white text-black">{{ $field['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div> --}}
                                    </div>

                                    <!-- Job Description and Responsibilities -->
                                    <h4>Job Description and Responsibilities</h4>
                                    <div id="job-description" class="mb-10">
                                        <div class="row mb-3">
                                            <div class="col-lg-6">
                                                <label class="fw-semibold fs-6 mb-2 required">Place of Work</label>
                                                <input type="text" name="place_of_work"
                                                    class="form-control form-control-solid mb-3 mb-lg-0"
                                                    value="{{ old('place_of_work') }}" required>
                                                <div class="invalid-feedback">This field is required.</div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="fw-semibold fs-6 mb-2">Responsibilities</label>

                                                <textarea type="text" name="responsibilities" class="form-control form-control-solid mb-3 mb-lg-0" required
                                                    readonly>{{ $job->description ?? '' }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Compensation and Benefits -->
                                    <h4>Compensation and Benefits</h4>
                                    <div id="compensation-benefits" class="mb-10">
                                        <div class="row mb-3">
                                            <div class="col-lg-6">
                                                <label class="fw-semibold fs-6 mb-2 required">Basic Salary</label>
                                                <input type="number" name="basic_salary"
                                                    class="form-control form-control-solid mb-3 mb-lg-0 @error('basic_salary') is-invalid @enderror"
                                                    value="{{ old('basic_salary') }}" required>
                                                <div class="invalid-feedback">This field is required.</div>
                                                @error('basic_salary')
                                                    <div class="invalid-feedback text-red-500">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="fw-semibold fs-6 mb-2">Pay Frequency</label>
                                                <input type="text" name="pay_frequency" value="Monthly"
                                                    class="form-control form-control-solid mb-3 mb-lg-0" required readonly>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-lg-6 mb-3">
                                                <label class="fw-semibold fs-6 mb-2">Statutary Deductions</label>

                                                <textarea class="form-control form-control-solid mb-3 mb-lg-0" name="statutary_deduction" readonly>The Employee’s salary shall be paid in cash, from which shall be deducted by the Employer to the extent applicable, the Employee’s social security contributions, withholding taxes and other mandatory or agreed deductions. The Employee shall be responsible for the filing and payment of his/her Philippine income taxes.</textarea>
                                            </div>
                                            {{-- <div class="col-lg-6 mb-3">
                                            <label class="fw-semibold fs-6 mb-2">Pag-IBIG</label>
                                            <input type="text" name="pagibig" class="form-control form-control-solid mb-3 mb-lg-0">
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label class="fw-semibold fs-6 mb-2">PhilHealth</label>
                                            <input type="text" name="philhealth" class="form-control form-control-solid mb-3 mb-lg-0">
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="fw-semibold fs-6 mb-2">SSS</label>
                                            <input type="text" name="sss" class="form-control form-control-solid mb-3 mb-lg-0">
                                        </div> --}}
                                            <div class="col-lg-6">
                                                <label class="fw-semibold fs-6 mb-2">Tardiness & Undertime Policy</label>
                                                <textarea class="form-control form-control-solid mb-3 mb-lg-0" name="tardiness_policy" readonly>The Employee is expected to report to work on time and complete the full working hours each day. Any tardiness (arriving late to work) and undertime (leaving work earlier than the scheduled end time without approval) shall be recorded, and a cumulative total of tardiness and undertime in minutes per payroll period shall be computed. For every minute of tardiness and undertime, the Employee shall incur a deduction from their salary equivalent to their hourly rate divided by 60.</textarea>

                                            </div>
                                        </div>
                                        {{-- <div class="row mb-3">
                                        <div class="col-lg-6 mb-3">
                                            <label class="fw-semibold fs-6 mb-2">Bank Name</label>
                                            <input type="text" name="bank_name" class="form-control form-control-solid mb-3 mb-lg-0">
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label class="fw-semibold fs-6 mb-2">Bank Account Number</label>
                                            <input type="text" name="bank_account_number" class="form-control form-control-solid mb-3 mb-lg-0">
                                        </div>
                                    </div> --}}
                                        @foreach ($template->fields as $field)
                                            @if ($field->group_id == 'compensation-benefits')
                                                <div class="row mb-3" id="field-{{ $loop->index }}">
                                                    <div class="col-lg-6">

                                                        @if ($field->field_name == 'overtime_rates')
                                                            <label
                                                                class="fw-semibold fs-6 mb-2">{{ Str::title(str_replace('_', ' ', $field->field_name)) }}</label>
                                                            <textarea name="overtime_rate" class="form-control form-control-control summernote">Overtime pay, if applicable, will be calculated in accordance with the company's overtime pay policy and will comply with the relevant government laws and regulations.</textarea>
                                                        @elseif($field->field_name == 'allowances')
                                                            <label
                                                                class="fw-semibold fs-6 mb-2">{{ Str::title(str_replace('_', ' ', $field->field_name)) }}</label>
                                                            <select class="form-control form-control-solid"
                                                                data-control="select2" data-close-on-select="false"
                                                                name="is_allowance[]" multiple id="allowanceSelect">
                                                                @foreach (config('constants.ALLOWANCE') as $key => $allowance)
                                                                    <option value="{{ $key }}">
                                                                        {{ $allowance }}</option>
                                                                @endforeach
                                                            </select>
                                                            <div id="inputContainer"></div>
                                                        @elseif($field->field_name == 'bonuses_incentives')
                                                            <label
                                                                class="fw-semibold fs-6 mb-2">{{ Str::title(str_replace('_', ' ', $field->field_name)) }}</label>
                                                            <textarea class="form-control form-control-control" name="bonuses_incentive">The Employee may be eligible for various bonuses, including 13th month pay, performance bonus, profit sharing bonus, holiday bonus, and special bonuses such as signing, retention, and referral bonuses. The eligibility criteria, computation, and distribution of these bonuses are detailed in the company’s bonus policy. Please refer to the employee handbook or contact the Human Resources Department for more information.</textarea>
                                                        @elseif($field->field_name == 'benefits')
                                                            <label
                                                                class="fw-semibold fs-6 mb-2">{{ Str::title(str_replace('_', ' ', $field->field_name)) }}</label>
                                                            <select class="form-control form-control-solid"
                                                                data-control="select2" data-close-on-select="false"
                                                                name="benefits[]" multiple id="benefitSelect">
                                                                @foreach (config('constants.BENEFITS') as $key => $allowance)
                                                                    <option value="{{ $key }}">
                                                                        {{ $allowance }}</option>
                                                                @endforeach
                                                            </select>
                                                            <div id="benefitsinputContainer"></div>
                                                        @else
                                                            <label
                                                                class="fw-semibold fs-6 mb-2">{{ Str::title(str_replace('_', ' ', $field->field_name)) }}</label>
                                                            <input type="{{ $field->field_type }}"
                                                                class="form-control form-control-solid mb-3 mb-lg-0"
                                                                name="{{ $field->field_name }}">
                                                        @endif
                                                    </div>
                                                    {{-- <div class="col-lg-6">
                                                    <button type="button" class="btn btn-danger mt-4" onclick="removeField(this, '{{ $field->field_name }}', 'compensation-benefits')">Remove</button>
                                                </div> --}}
                                                </div>
                                            @endif
                                        @endforeach
                                        {{-- <div class="row mb-3">
                                        <div class="col-lg-2">
                                            <select class="form-control form-control-solid bg-primary" onchange="addSelectedField(this, 'compensation-benefits')">
                                                <option value="" class="bg-white">Add Optional Field</option>
                                                @foreach ($optionalFieldDefinitions['compensation-benefits'] as $key => $field)
                                                    <option value="{{ $key }}" class="bg-white">{{ $field['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div> --}}
                                    </div>

                                    <!-- Work Hours and Leave -->
                                    <h4>Work Hours and Leave</h4>
                                    <div id="work-hours-leave" class="mb-10">
                                        <div class="row mb-3">
                                            <div class="col-lg-6">
                                                <label class="fw-semibold fs-6 mb-2">Regular Working Hours</label>
                                                <input type="number" min="0" name="working_hour"
                                                    class="form-control form-control-solid mb-3 mb-lg-0">
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="fw-semibold fs-6 mb-2">Rest Days</label>
                                                <select class="form-control form-control-solid" data-control="select2"
                                                    data-close-on-select="false" id="rest_days" name="rest_days[]"
                                                    multiple>
                                                    @foreach (config('constants.WEEK_DAYS') as $key => $day)
                                                        <option value="{{ $key }}">
                                                            {{ $day }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-lg-6">
                                                <label class="fw-semibold fs-6 mb-2">Holiday Entitlement</label>
                                                <textarea name="holiday_entitlement" class="form-control form-control-solid mb-3 mb-lg-0" readonly>The Employee shall be entitled to holidays in accordance with Philippine law. The list of holidays shall be based on the official public holidays declared by the government of the Philippines, including both regular holidays and special non-working days. If the Employee is required to work on a holiday, they shall be entitled to overtime pay in accordance with the Employer's policy and applicable labor laws.</textarea>
                                            </div>
                                            <div class="col-lg-6">

                                                <label class="fw-semibold fs-6 mb-2">Leave Entitlement</label>
                                                <select class="form-control form-control-solid" data-control="select2"
                                                    data-close-on-select="false" id="leaveSelect"
                                                    name="leave_entitlement[]" multiple>
                                                    {{-- @foreach (config('constants.LEAVES') as $key => $leave) --}}
                                                    @php $leaves = App\Models\MasterLeave::get(); @endphp
                                                    @foreach ($leaves as $key => $leave)
                                                        {{-- {{ dd($leave) }} --}}
                                                        <option value="{{ $leave->id }}">
                                                            {{ $leave->name ?? '' }}</option>
                                                    @endforeach
                                                </select>
                                                <div id="leaveDetails"></div>
                                            </div>

                                        </div>
                                    </div>

                                    <!-- Termination and Resignation -->
                                    <h4>Termination and Resignation</h4>
                                    <div id="termination-resignation" class="mb-10">
                                        <div class="row mb-3">
                                            <div class="col-lg-6">
                                                <label class="fw-semibold fs-6 mb-2">Notice Period (Days)</label>
                                                <input type="number" name="notice_period"
                                                    class="form-control form-control-solid mb-3 mb-lg-0">
                                            </div>
                                        </div>
                                        <div class="row mb-3">

                                            <div class="col-lg-6 mb-3">
                                                <label class="fw-semibold fs-6 mb-2">Grounds for Termination</label>
                                                <textarea name="grounds_for_termination" class="form-control form-control-solid mb-3 mb-lg-0 summernote" readonly>
                                                <p><b>                                                Just Causes:</b> The Employer may terminate this contract for just causes including, but not limited to, serious misconduct, willful disobedience, gross and habitual neglect of duties, fraud or willful breach of trust, commission of a crime or offense, and other analogous causes as defined by Article 297 (formerly Article 282) of the Labor Code.</p><p><b>

                                                    Authorized Causes:</b> The Employer may terminate this contract for authorized causes such as installation of labor-saving devices, redundancy, retrenchment to prevent losses, closure or cessation of operation, and disease as defined by Articles 298 and 299 (formerly Articles 283 and 284) of the Labor Code.</p><p><b>
    
                                                    Other Causes:</b> Termination may also occur due to conditions specified in the employment contract or company policies.
                                                </p>
                                            </textarea>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="fw-semibold fs-6 mb-2">Separation Pay</label>
                                                <textarea name="separation_pay" class="form-control form-control-solid mb-3 mb-lg-0 summernote">Separation pay, if applicable, will be provided in accordance with the company's separation pay policy. Please refer to the employee handbook or contact the Human Resources Department for details.</textarea>
                                            </div>
                                        </div>
                                        @foreach ($template->fields as $field)
                                            @if ($field->group_id == 'termination-resignation')
                                                <div class="row mb-3" id="field-{{ $loop->index }}">
                                                    <div class="col-lg-6">
                                                        <label
                                                            class="fw-semibold fs-6 mb-2">{{ Str::title(str_replace('_', ' ', $field->field_name)) }}</label>
                                                        <input type="hidden"
                                                            name="optional_fields[{{ $loop->index }}][key]"
                                                            value="{{ $field->field_name }}">
                                                        <input type="hidden"
                                                            name="optional_fields[{{ $loop->index }}][type]"
                                                            value="{{ $field->field_type }}">
                                                        <input type="hidden"
                                                            name="optional_fields[{{ $loop->index }}][group_id]"
                                                            value="termination-resignation">
                                                        <input type="text"
                                                            class="form-control form-control-solid mb-3 mb-lg-0"
                                                            name="optional_fields[{{ $loop->index }}][value]">
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <button type="button" class="btn btn-danger mt-4"
                                                            onclick="removeField(this, '{{ $field->field_name }}', 'termination-resignation')">Remove</button>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>

                                    <!-- Other Clauses -->
                                    <h4>Other Clauses</h4>
                                    <div id="other-clauses" class="mb-10">
                                        <div class="row mb-3">
                                            <div class="col-lg-6 mb-3">
                                                <label class="fw-semibold fs-6 mb-2">Confidentiality Agreement</label>
                                                <textarea name="confidentiality_agreement" class="form-control form-control-solid mb-3 mb-lg-0">The Employee agrees to maintain the confidentiality of all proprietary and confidential information of the Employer. The Employee shall not disclose any such information to any third party without the prior written consent of the Employer.</textarea>
                                            </div>
                                            <div class="col-lg-6 mb-3">
                                                <label class="fw-semibold fs-6 mb-2">Non-compete Clause</label>
                                                <textarea name="non_compete_clause" class="form-control form-control-solid mb-3 mb-lg-0">The Employee agrees not to engage in any business activities that compete with the Employer's business during the term of this Contract. The Employee shall refrain from soliciting the Employer's clients or employees during this period.</textarea>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-lg-4">
                                                <label class="fw-semibold fs-6 mb-2">Non-disclosure Agreement</label>
                                                <textarea name="non_disclosure_agreement" class="form-control form-control-solid mb-3 mb-lg-0">The Employee agrees not to disclose any confidential information acquired during the course of their employment with the Employer to any third party, both during and after the term of this Contract.</textarea>
                                            </div>
                                            <div class="col-lg-4">
                                                <label class="fw-semibold fs-6 mb-2">Intellectual Property Rights</label>
                                                <textarea name="intellectual_property_rights" class="form-control form-control-solid mb-3 mb-lg-0">Any intellectual property developed by the Employee during the term of their employment with the Employer shall be the sole and exclusive property of the Employer. The Employee agrees to assign any rights they may have in such intellectual property to the Employer.</textarea>
                                            </div>
                                            <div class="col-lg-4">
                                                <label class="fw-semibold fs-6 mb-2">Dispute Resolution</label>
                                                <textarea name="dispute_resolution" class="form-control form-control-solid mb-3 mb-lg-0">Any disputes arising out of or in connection with this Contract shall be resolved through amicable negotiations. If the dispute cannot be resolved through negotiations, it shall be submitted to mediation. If mediation fails, the dispute shall be settled by arbitration in accordance with the rules of the Philippine Dispute Resolution Center, Inc. (PDRCI).</textarea>
                                            </div>
                                        </div>
                                        @foreach ($template->fields as $field)
                                            @if ($field->group_id == 'other-clauses')
                                                <div class="row mb-3" id="field-{{ $loop->index }}">
                                                    <div class="col-lg-6">
                                                        <label
                                                            class="fw-semibold fs-6 mb-2">{{ Str::title(str_replace('_', ' ', $field->field_name)) }}</label>
                                                        <input type="hidden"
                                                            name="optional_fields[{{ $loop->index }}][key]"
                                                            value="{{ $field->field_name }}">
                                                        <input type="hidden"
                                                            name="optional_fields[{{ $loop->index }}][type]"
                                                            value="{{ $field->field_type }}">
                                                        <input type="hidden"
                                                            name="optional_fields[{{ $loop->index }}][group_id]"
                                                            value="other-clauses">
                                                        <input type="text"
                                                            class="form-control form-control-solid mb-3 mb-lg-0"
                                                            name="optional_fields[{{ $loop->index }}][value]">
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <button type="button" class="btn btn-danger mt-4"
                                                            onclick="removeField(this, '{{ $field->field_name }}', 'other-clauses')">Remove</button>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>

                                    <!-- Acknowledgements -->
                                    <h4>Acknowledgements</h4>
                                    <div id="acknowledgements" class="mb-10">
                                        <div class="row mb-3">
                                            <div class="col-lg-4">
                                                <label class="fw-semibold fs-6 mb-2">Employee Acknowledgement of Company
                                                    Policies</label>
                                                <textarea name="acknowledgement_of_company_policies" class="form-control form-control-solid mb-3 mb-lg-0 summernote">I acknowledge that I have read and understood the company's policies as outlined in the employee handbook and agree to comply with them.</textarea>
                                            </div>
                                            <div class="col-lg-4">
                                                <label class="fw-semibold fs-6 mb-2">Employee Acknowledgement of Receipt of
                                                    Handbook</label>
                                                <textarea name="acknowledgement_of_receipt_of_handbook"
                                                    class="form-control form-control-solid mb-3 mb-lg-0 summernote"></textarea>
                                            </div>
                                            <div class="col-lg-4">
                                                <label class="fw-semibold fs-6 mb-2">Acknowledgement of Understanding Terms
                                                    and Conditions</label>
                                                <textarea name="acknowledgement_of_understanding_terms_and_conditions"
                                                    class="form-control form-control-solid mb-3 mb-lg-0 summernote"><p class="fw-bold">1. Acceptance of Terms</p><p>By accessing and using the services provided by CXS Analytics you acknowledge that you have read, understood, and agree to be bound by these terms and any additional guidelines, policies, or rules applicable to specific services.</p><p class="fw-bold">2. Data Privacy</p><p>We are committed to protecting your personal data in accordance with the Data Privacy Act of 2012 (Republic Act No. 10173). Your data will be collected, used, and processed solely for the purpose of providing our services and improving user experience. For more information, please refer to our Privacy Policy.</p><p class="fw-bold">3. User Responsibilities</p><p>You agree to use our platform for lawful purposes only. You must not: Engage in any activity that disrupts or interferes with our services or network. Use our platform to store, transmit, or distribute any malicious software or illegal content. Violate any applicable local, national, or international law.</p><p class="fw-bold">4. Intellectual Property</p><p>All content, trademarks, logos, and intellectual property on our platform are owned by CXS Analytics or our licensors. You are granted a limited, non-exclusive license to use the platform in accordance with these terms.</p><p class="fw-bold">5. Limitation of Liability</p><p>To the maximum extent permitted by law, CXS Analytics shall not be liable for any indirect, incidental, special, consequential, or punitive damages, or any loss of profits or revenues, whether incurred directly or indirectly, or any loss of data, use, goodwill, or other intangible losses resulting from: Your use or inability to use the platform. Any unauthorized access to or use of our servers. Any bugs, viruses, or other harmful code transmitted to or through our platform.</p><p class="fw-bold">6. Governing Law</p><p>These terms shall be governed by and construed in accordance with the laws of the Philippines. Any disputes arising out of or in connection with these terms shall be subject to the exclusive jurisdiction of the courts in the Philippines.</p><p class="fw-bold">7. Changes to Terms</p><p>We reserve the right to modify these terms at any time. We will notify you of any changes by posting the new terms on our platform. Your continued use of the platform following the posting of changes constitutes your acceptance of the new terms.</p><p class="fw-bold">8. Contact Information</p><p>If you have any questions or concerns about these terms, please contact us at CXS Analytics, info@cxsanalytics.com</p></textarea>
                                            </div>
                                        </div>
                                        @foreach ($template->fields as $field)
                                            @if ($field->group_id == 'acknowledgements')
                                                <div class="row mb-3" id="field-{{ $loop->index }}">
                                                    <div class="col-lg-6">
                                                        <label
                                                            class="fw-semibold fs-6 mb-2">{{ Str::title(str_replace('_', ' ', $field->field_name)) }}</label>
                                                        <input type="hidden"
                                                            name="optional_fields[{{ $loop->index }}][key]"
                                                            value="{{ $field->field_name }}">
                                                        <input type="hidden"
                                                            name="optional_fields[{{ $loop->index }}][type]"
                                                            value="{{ $field->field_type }}">
                                                        <input type="hidden"
                                                            name="optional_fields[{{ $loop->index }}][group_id]"
                                                            value="acknowledgements">
                                                        <input type="text"
                                                            class="form-control form-control-solid mb-3 mb-lg-0"
                                                            name="optional_fields[{{ $loop->index }}][value]">
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <button type="button" class="btn btn-danger mt-4"
                                                            onclick="removeField(this, '{{ $field->field_name }}', 'acknowledgements')">Remove</button>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>

                                    <!-- Signatures and Dates -->
                                    <h4>Signatures and Dates</h4>
                                    <div id="signatures-dates" class="mb-10">
                                        <div class="row mb-3">
                                            <div class="col-lg-6">
                                                <label class="fw-semibold fs-6 mb-2">Employee Signature</label>
                                                <input type="text" name="employee_signature" disabled
                                                    class="form-control form-control-solid mb-3 mb-lg-0">
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="fw-semibold fs-6 mb-2">Date Signed by Employee (Auto
                                                    Generated after signture)</label>
                                                <input type="date" name="date_signed_by_employee"
                                                    class="form-control form-control-solid mb-3 mb-lg-0" disabled>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-lg-6">
                                                <label class="fw-semibold fs-6 mb-2 required">Employer Signature</label>

                                                <div>
                                                    <canvas id="signature-pad" width="400" height="200"
                                                        style="border:1px solid #000;"></canvas>
                                                </div>
                                                <button type="button" id="clear-signature"
                                                    class="btn btn-danger py-1">Clear</button>
                                                <input type="hidden" name="employer_signature" id="signature">
                                                <span id="signature_validation" class="text-danger"></span>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="fw-semibold fs-6 mb-2">Date Signed by Employer(Auto Generated
                                                    after signture)</label>
                                                <input type="date" name="date_signed_by_employer"
                                                    class="form-control form-control-solid mb-3 mb-lg-0" disabled>
                                            </div>
                                        </div>
                                        @foreach ($template->fields as $field)
                                            @if ($field->group_id == 'signatures-dates')
                                                <div class="row mb-3" id="field-{{ $loop->index }}">
                                                    <div class="col-lg-6">
                                                        <label
                                                            class="fw-semibold fs-6 mb-2">{{ Str::title(str_replace('_', ' ', $field->field_name)) }}</label>
                                                        <input type="hidden"
                                                            name="optional_fields[{{ $loop->index }}][key]"
                                                            value="{{ $field->field_name }}">
                                                        <input type="hidden"
                                                            name="optional_fields[{{ $loop->index }}][type]"
                                                            value="{{ $field->field_type }}">
                                                        <input type="hidden"
                                                            name="optional_fields[{{ $loop->index }}][group_id]"
                                                            value="signatures-dates">
                                                        <input type="text"
                                                            class="form-control form-control-solid mb-3 mb-lg-0"
                                                            name="optional_fields[{{ $loop->index }}][value]">
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <button type="button" class="btn btn-danger mt-4"
                                                            onclick="removeField(this, '{{ $field->field_name }}', 'signatures-dates')">Remove</button>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>

                                    {{-- <button type="submit" class="btn btn-primary">Update Template</button> --}}
                                    <button type="button" class="btn btn-primary" id="previewContractBtn">Preview
                                        Contract</button>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- PDF Preview Modal -->
    <div class="modal fade" id="pdfPreviewModal" tabindex="-1" aria-labelledby="pdfPreviewModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pdfPreviewModalLabel">Contract Preview</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <iframe id="pdfFrame" src="" style="width: 100%; height: 80vh;" frameborder="0"></iframe>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
                    <button type="button" id="confirmSubmitBtn" class="btn btn-primary">Submit Contract</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" rel="stylesheet">

@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>

    <script>
        let fieldIndex = {{ isset($template) ? $template->fields->count() : 1 }};

        const optionalFieldDefinitions = @json($optionalFieldDefinitions);

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
                    <input type="text" class="form-control form-control-solid mb-3 mb-lg-0" name="optional_fields[${fieldIndex}][value]">
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
            const selectElement = document.querySelector(`#${sectionId} select`);

            for (let option of selectElement.options) {
                if (option.value === fieldKey) {
                    option.disabled = false;
                    break;
                }
            }

            fieldDiv.remove();
        }

        // Disable already selected options
        document.addEventListener('DOMContentLoaded', () => {
            @isset($template)
                @foreach ($template->fields as $field)
                    document.querySelector(`option[value="{{ $field->field_name }}"]`).disabled = true;
                @endforeach
            @endisset
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 300, // set the height of the editor
                minHeight: null, // set minimum height of editor
                maxHeight: 150, // set maximum height of editor
                focus: true // set focus to editable area after initializing summernote

            });
            // $('.summernote').each(function() {
            //     $(this).summernote('disable');
            // });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#allowanceSelect').select2();

            $('#allowanceSelect').on('select2:select', function(e) {
                var data = e.params.data;
                var inputId = 'input_' + data.id;
                var inputBox = `<div class="input-box" id="${inputId}">
                            <label for="${inputId}_input">${data.text} Amount:</label>
                            <input type="number" name="${data.id}" id="${inputId}_input" class="mb-3 form-control form-control-solid" required placeholder="Enter Amount"/>
                        </div>`;
                $('#inputContainer').append(inputBox);
            });

            $('#allowanceSelect').on('select2:unselect', function(e) {
                var data = e.params.data;
                var inputId = 'input_' + data.id;
                $('#' + inputId).remove();
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#leaveSelect').select2();

            // Fetch leave details from the server as a JSON object
            var leaveDetails = {!! json_encode(App\Models\MasterLeave::get()) !!};
            console.log(leaveDetails);

            $('#leaveSelect').on('select2:select', function(e) {
                var data = e.params.data;
                console.log(data);
                var id = data.id;

                // Find the details for the selected leave ID
                var details = leaveDetails.find(leave => leave.id == id);

                if (details) {
                    let eligibility;
                    let cumulative;
                    let entitlement;

                    // Set eligibility text based on the 'eligibility' field
                    if (details.eligibility === 'M') {
                        eligibility = 'Male Employees';
                    } else if (details.eligibility === 'F') {
                        eligibility = 'Female Employees';
                    } else {
                        eligibility = 'All Employees';
                    }

                    // Set cumulative leave details
                    if (details.cumulative === 1) {
                        cumulative =
                            'Unused leave may accumulate from year to year, subject to company policy.';
                    } else {
                        cumulative = '';
                    }

                    // Set entitlement details based on 'depend_on_job'
                    if (details.depend_on_job === 1) {
                        entitlement =
                            'The employee is entitled to the given paid leaves per calendar year.';
                    } else {
                        entitlement =
                            `The employee is entitled to ${details.days_per_year} days of paid leaves per calendar year.`;
                    }

                    // Generate the HTML for leave details
                    var detailsHtml = `<div class="card card-body leave-details mt-3 p-3" id="leave_${id}">
                                    <h3>${details.name}</h3>
                                    <p><strong>Entitlement:</strong> ${entitlement}</p>
                                    ${details.eligibility ? `<p><strong>Eligibility:</strong> ${eligibility}</p>` : ''}
                                    <p><strong>Purpose:</strong> ${details.purpose}</p>
                                    ${details.additional_benefit ? `<p><strong>Additional Benefit:</strong> ${details.additional_benefit}</p>` : ''}
                                    ${details.carryover ? `<p><strong>Carry Over:</strong> ${details.carryover}</p>` : ''}
                                    ${details.cumulative ? `<p><strong>Cumulative Leave:</strong> ${cumulative}</p>` : ''}
                                </div>`;
                    $('#leaveDetails').append(detailsHtml);

                    // Add an input field if leave depends on the job
                    if (details.depend_on_job == 1) {
                        var vlInputHtml = `<div class="form-group mt-3" id="vlInputBox_${id}">
                                        <label for="paid_leave_count_${id}">${details.name} Count:</label>
                                        <input type="number" class="form-control" required id="paid_leave_count_${id}" name="paid_leave_count[${id}]" placeholder="Enter ${details.name} Count">
                                    </div>`;
                        $('#leaveDetails').append(vlInputHtml);
                    }
                } else {
                    console.error('Details not found for', id);
                }
            });

            $('#leaveSelect').on('select2:unselect', function(e) {
                var data = e.params.data;
                var leaveId = 'leave_' + data.id;
                $('#' + leaveId).remove();

                // Remove the input box for the unselected leave
                $('#vlInputBox_' + data.id).remove();
            });
        });
    </script>


    <script src="{{ asset('signature-pad/js/signature_pad.umd.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            // When the button with data-bs-toggle="modal" is clicked
            $('[data-bs-toggle="modal"]').on('click', function() {
                // Get the contract_id attribute value
                var contractId = $(this).attr('contract_id');
                var jobTitle = $(this).attr('jobtitle');
                console.log(jobTitle);
                // Set the contract_id value to the hidden input in the modal
                $('#contract_id').val(contractId);
                $('#contract_title').text(jobTitle);
            });

            // Initialize signature pad
            // var canvas = document.getElementById('signature-pad');
            // var signaturePad = new SignaturePad(canvas);
            // var clearButton = document.getElementById('clear-signature');
            // var signatureInput = document.getElementById('signature');

            // clearButton.addEventListener('click', function () {
            //     signaturePad.clear();
            // });

            // document.querySelector('#contract_form').addEventListener('submit', function (event) {
            //     if (signaturePad.isEmpty()) {
            //         var valitext = 'Please provide a signature first.';
            //         console.log(valitext);
            //         $('#signature_validation').text(valitext);
            //         event.preventDefault();
            //     } else {
            //         signatureInput.value = signaturePad.toDataURL();
            //     }
            // });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#benefitSelect').select2();

            $('#benefitSelect').on('select2:select', function(e) {
                var data = e.params.data;
                var inputId = 'input_' + data.id;
                var inputBox = `<div class="input-box" id="${inputId}">
                        <label for="${inputId}_input">${data.text} Amount:</label>
                        <input type="number" name="benefits[${data.id}]" id="${inputId}_input" class="mb-3 form-control form-control-solid" placeholder="Enter Amount"/>
                    </div>`;
                $('#benefitsinputContainer').append(inputBox);
            });

            $('#benefitSelect').on('select2:unselect', function(e) {
                var data = e.params.data;
                var inputId = 'input_' + data.id;
                $('#' + inputId).remove();
            });
        });
    </script>
    <script>
        var canvas = document.getElementById('signature-pad');
        var signaturePad = new SignaturePad(canvas);
        var clearButton = document.getElementById('clear-signature');
        var signatureInput = document.getElementById('signature');

        clearButton.addEventListener('click', function() {
            signaturePad.clear();
            $('#signature_validation').text('');
        });
        document.getElementById('previewContractBtn').addEventListener('click', function() {

            let requiredFields = [
                'emp_official_email',
                'commencement_date',
                'place_of_work',
                'basic_salary',
                'contact_person'
            ];

            let hasError = false;
            let firstInvalidField = null;

            requiredFields.forEach(function(field) {
                let input = document.querySelector(`[name="${field}"]`);
                if (input && !input.value.trim()) {
                    input.classList.add('is-invalid');
                    hasError = true;

                    if (!firstInvalidField) {
                        firstInvalidField = input;
                    }
                } else if (input) {
                    input.classList.remove('is-invalid');
                }
            });
            if (hasError) {
                return;
            }

            if (signaturePad.isEmpty()) {
                var valitext = 'Please provide a signature first.';
                console.log(valitext);
                $('#signature_validation').text(valitext);
                return;
            } else {
                signatureInput.value = signaturePad.toDataURL();
            }

            if (hasError && firstInvalidField) {
                firstInvalidField.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
                firstInvalidField.focus();
                return;
            }
            let form = document.getElementById('contract_form');
            let formData = new FormData(form);

            fetch('{{ route('admin.contract.preview') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: formData
                })
                .then(response => response.json())

                .then(data => {
                    if (data.success && data.pdf_url) {

                        document.getElementById('pdfFrame').src = data.pdf_url;

                        // Show the modal
                        var modal = new bootstrap.Modal(document.getElementById('pdfPreviewModal'));
                        modal.show();
                    } else {
                        alert("Failed to generate preview.");
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                    alert("Something went wrong.");
                });
        });

        document.getElementById('confirmSubmitBtn').addEventListener('click', function() {
            document.getElementById('contract_form').submit();
        });
    </script>

@endsection
