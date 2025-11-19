@extends('admin.layout.app')

@section('title', 'Edit Job Advertisement')

@section('content')
<div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">

    <!--begin::Toolbar container-->
    <div id="kt_app_toolbar_container" class="app-container  container-fluid d-flex flex-stack ">


        <!--begin::Page title-->
        <div data-kt-swapper="true" data-kt-swapper-mode="{default: 'prepend', lg: 'prepend'}"
            data-kt-swapper-parent="{default: '#kt_app_content_container', lg: '#kt_app_toolbar_container'}"
            class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5 mb-lg-0">
            <!--begin::Title-->
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                Job Advertisement Edit
            </h1>
            <!--end::Title-->


            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">

                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">
                    <a href="/admin/dashboard" class="text-muted text-hover-primary">
                        Dashboard </a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <!--end::Item-->

                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">
                    <a href="{{ route('admin.job-openings.index') }}" class="text-muted text-hover-primary">
                        Job Advertisement List </a></li>
                <!--end::Item-->
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <!--end::Item-->

                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">
                    Job Advertisement Edit </li>
            </ul>
            <!--end::Breadcrumb-->
        </div>
       
        <!--end::Action group-->
    </div>
    <!--end::Toolbar container-->
</div>
<div id="kt_app_content" class="app-content  flex-column-fluid ">

    <div id="kt_app_content_container" class="app-container  w-100 ">
        <div class="card mb-5 mb-xl-8">
            <!--begin::Header-->
            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">Edit Job Advertisement- {{ $jobOpening->job_title ?? '' }}</h3>
                <div class="card-toolbar">
                    <a href="{{ route('admin.job-openings.index', ['department_id' => session('job_opening_department_id')]) }}" class="btn btn-sm btn-light-primary">
                        <iconify-icon icon="material-symbols:arrow-back"></iconify-icon> Back To Job Advertisement Dashboard
                    </a>
                </div>
            </div>
            <!--end::Header-->

            <!--begin::Body-->
            <div class="card-body py-3">
                <form class="my-auto pb-5" action="{{ route('admin.job-openings.update', $jobOpening->id) }}" method="POST" enctype="multipart/form-data" novalidate="novalidate" id="kt_create_account_form">
                    @csrf
                    @method('PUT')

                    <!-- Example for Dropdown (Companies, Departments, etc.) -->
                    <!-- Repeat structure for other single relation fields like company, department, position -->
                    {{-- @if($isSubsidiary) --}}
                        <div class="fv-row mb-8">
                            <label for="department_id" class="form-label">Select Department</label>
                            <select class="form-select" id="department_id" name="department_id">
                                <option value="">Select Department</option>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}" {{ (old('department_id', $jobOpening->department_id) == $department->id) ? 'selected' : '' }}>
                                        {{ $department->head_of_department }}
                                    </option>
                                @endforeach
                            </select>
                            @error('department_id')
                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    <div data-field="department_id" data-validator="notEmpty">
                                        {{ $message }}
                                    </div>
                                </div>
                            @enderror
                        </div>
                    {{-- @else
                        <div class="fv-row mb-8">
                            <label for="department_id" class="form-label">Select Department</label>
                            <select class="form-select" id="department_id" name="department_id">
                                <option value="">Select Department</option>
                            </select>
                            @error('department_id')
                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    <div data-field="department_id" data-validator="notEmpty">
                                        {{ $message }}
                                    </div>
                                </div>
                            @enderror
                        </div>
                    @endif --}}
                    
                    
                    <div class="fv-row mb-8">
                        <label for="job_id" class="form-label">Job Title</label>
                        <select class="form-select" id="job_id" name="job_id">
                            @if ($jobOpening->position_id)
                                <option value="{{ $jobOpening->position_id }}" selected>{{ $jobOpening->job_title }}</option>
                            @else
                                <option value="">Select Job Title</option>
                            @endif

                        </select>
                        @error('job_id')
                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                <div data-field="job_id" data-validator="notEmpty">
                                    {{ $message }}
                                </div>
                            </div>
                        @enderror
                    </div>
                    <input type="hidden" class="form-control" id="job_title" name="job_title" value="{{ old('job_title', $jobOpening->job_title) }}" required>

                    {{-- <div class="fv-row mb-8">
                        <label for="job_title" class="form-label">Job Title</label>
                        @error('job_title')
                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                <div data-field="job_title" data-validator="notEmpty">
                                    {{ $message }}
                                </div>
                            </div>
                        @enderror
                    </div> --}}

                    <div class="fv-row mb-8">
                        <label for="job_skills" class="form-label">Job Skills</label>
                        <select class="form-select" id="job_skills" disabled name="job_skills[]" data-control="select2" data-close-on-select="false"
                        data-placeholder="Select an option" data-allow-clear="true" multiple="multiple">
                            @foreach ($master_job_skills as $skill)
                            <option value="{{ $skill->id }}" {{ (collect(old('job_skills', $selected_job_skills))->contains($skill->id)) ? 'selected' : '' }}>
                                {{ $skill->title }}
                            </option>
                            @endforeach
                        </select>
                        @error('job_skills[]')
                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                <div data-field="job_skills[]" data-validator="notEmpty">
                                    {{ $message }}
                                </div>
                            </div>
                        @enderror
                    </div>

                    <div class="fv-row mb-8">
                        <label for="job_technical_skills" class="form-label">Technical Skills</label>
                        <select class="form-select" id="job_technical_skills" disabled name="job_technical_skills[]" data-control="select2" data-close-on-select="false"
                        data-placeholder="Select an option" data-allow-clear="true" multiple="multiple">
                            @foreach ($job_technical_skills as $techSkill)
                            <option value="{{ $techSkill->id }}" {{ (collect(old('job_technical_skills', $selected_job_technical_skills))->contains($techSkill->id)) ? 'selected' : '' }}>
                                {{ $techSkill->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('job_technical_skills[]')
                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                <div data-field="job_technical_skills[]" data-validator="notEmpty">
                                    {{ $message }}
                                </div>
                            </div>
                        @enderror
                    </div>

                    <!--begin::Input group for Total Vacancies-->
                    <div class="fv-row mb-8">
                        <label class="form-label mb-3">Total Vacancies (Position headcounts - Total employees employed on this position)</label>
                        <input type="text" placeholder="Total Vacancies" name="vacanciesDisabled" value="{{ old('vacancies', $jobOpening->vacancies) }}" autocomplete="vacancies" class="form-control bg-transparent" id="vacanciesDisabled" disabled/>
                        <input type="text" value="0" name="vacancies" id="vacancies" hidden>
                        @error('vacancies')
                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                <div data-field="vacancies" data-validator="notEmpty">
                                    {{ $message }}
                                </div>
                            </div>
                        @enderror
                    </div>

                    <h5 class="mt-4 mb-4">Job Qualification</h5>
                    <div class="fv-row mb-7 row">
                        <div class="col-lg-4">
                            <label class="form-label">Select Education Level</label>
                            <select class="form-select" name="education_level_id" id="education_level_id">
                                @foreach($education_levels as $education_level)
                                    <option value="{{ $education_level->id }}" {{ (old('education_level_id', $jobOpening->education_level_id) == $education_level->id) ? 'selected' : '' }}>{{ $education_level->name }}</option>
                                @endforeach
                            </select>
                            @error('education_level_id')
                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    <div data-field="education_level_id" data-validator="notEmpty">
                                        {{ $message }}
                                    </div>
                                </div>
                            @enderror
                        </div>

                        <div class="col-lg-4">
                            <label class="form-label">Select Education Program</label>
                            <select class="form-select" name="education_program_id">
                                @foreach($education_programs as $education_program)
                                    <option value="{{ $education_program->id }}" {{ (old('education_program_id', $jobOpening->education_program_id) == $education_program->id) ? 'selected' : '' }}>{{ $education_program->name }}</option>
                                @endforeach
                            </select>
                            @error('education_program_id')
                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    <div data-field="education_program_id" data-validator="notEmpty">
                                        {{ $message }}
                                    </div>
                                </div>
                            @enderror
                        </div>
                           
                        <div class="col-lg-4">
                            <label class="form-label mb-3">Work Experience (In Years)</label>
                            <input type="number" placeholder="Work Experience" name="work_experience" value="{{ old('work_experience', $jobOpening->work_experience) }}" autocomplete="work_experience" class="form-control bg-transparent" id="work_experience"/>
                            @error('work_experience')
                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    <div data-field="work_experience" data-validator="notEmpty">
                                        {{ $message }}
                                    </div>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="fv-row mb-7 row">
                        <div class="col-lg-4">
                            <label for="country" class="form-label">Select Job Country</label>
                            <select id="country" class="form-select" name="country_id" data-control="select2" data-close-on-select="false" data-placeholder="Select an option" data-allow-clear="false" onchange="handleCountryChange()">
                                <option value="">Select Country</option>
                                @foreach($countries as $country)
                                    <option value="{{ $country->id }}" {{ (old('country_id', $jobOpening->country_id) == $country->id) ? 'selected' : '' }}>{{ $country->name }}</option>
                                @endforeach
                            </select>
                            @error('country_id')
                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    <div data-field="countries" data-validator="notEmpty">
                                        {{ $message }}
                                    </div>
                                </div>
                            @enderror
                        </div>

                        <div class="col-lg-4" id="stateContainer">
                            <label for="state_id" class="form-label">Select State</label>
                            <select id="state_id" class="form-control form-control-solid mb-3 mb-lg-0" name="state_id" data-control="select2" data-hide-search="false">
                                <option value="">Select State</option>
                                {{-- @foreach ($states as $state)
                                    <option value="{{ $state->id }}" {{ (old('state_id', $jobOpening->state_id) == $state->id) ? 'selected' : '' }}>
                                        {{ $state->name }}
                                    </option>
                                @endforeach --}}
                            </select>
                            @error('state_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-lg-4" id="cityContainer">
                            <label for="city_id" class="form-label">Select City</label>
                            <select id="city_id" class="form-control form-control-solid mb-3 mb-lg-0" name="city_id" data-control="select2" data-hide-search="false">
                                <option value="">Select City</option>
                                {{-- @foreach ($cities as $city)
                                    <option value="{{ $city->id }}" {{ (old('city_id', $jobOpening->city_id) == $city->id) ? 'selected' : '' }}>
                                        {{ $city->name }}
                                    </option>
                                @endforeach --}}
                            </select>
                            @error('city_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-lg-2" id="barangayContainer" style="display: none;">
                            <label for="sub_division" class="form-label">Barangay/Subdivision</label>
                            <select id="sub_division" class="form-control select2-ajax" name="barangay_id" data-control="select2" data-hide-search="false">
                                <option value="">Select Barangay/Subdivision</option>
                               
                            </select>
                            @error('sub_division')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-xl-2" id="cittyContainer" style="display: none;">
                            <label for="city" class="form-label">Select City</label>
                            <select id="city" class="form-control form-control-solid mb-3 mb-lg-0" name="city_id" data-control="select2" data-hide-search="false">
                                <option value="">Select City</option>
                                {{-- @foreach ($cities as $city)
                                    <option value="{{ $city->id }}" {{ (old('city_id', $jobOpening->city_id) == $city->id) ? 'selected' : '' }}>
                                        {{ $city->name }}
                                    </option>
                                @endforeach --}}
                            </select>
                            @error('city_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-xl-2" id="provinceContainer" style="display: none;">
                            <label for="province" class="form-label">Select Province</label>
                            <select id="province" class="form-control form-control-solid mb-3 mb-lg-0" name="province_id" data-control="select2" data-hide-search="false">
                                <option value="">Select Province</option>
                                @foreach ($provinces as $province)
                                    <option value="{{ $province->id }}" {{ (old('province_id', $jobOpening->province_id) == $province->id) ? 'selected' : '' }}>
                                        {{ $province->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('province')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-xl-2" id="postalCodeContainer" style="display: none;">
                            <label for="postal_code" class="form-label">Postal Code</label>
                            <input id="postal_code" type="number" class="form-control form-control-solid mb-3 mb-lg-0" name="postal_code" placeholder="Enter Postal Code" value="{{ old('postal_code', $jobOpening->postal_code ?? '') }}">
                            @error('postal_code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    {{-- <div class="fv-row mb-7 row">
                        <div class="col-lg-4">
                            <label class="form-label mb-3">Salary (It will not be shown to candidate)</label>
                            <input type="number" placeholder="Salary" name="salary" value="{{ old('salary', $jobOpening->salary) }}" autocomplete="salary" class="form-control bg-transparent"/>
                            @error('salary')
                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    <div data-field="salary" data-validator="notEmpty">
                                        {{ $message }}
                                    </div>
                                </div>
                            @enderror
                        </div>
                    </div> --}}

                    <div class="fv-row mb-7 row">
                        <div class="col-lg-5">
                            <label class="form-label mb-3">Salary Lower Bound (It will not be shown to candidate)</label>
                            <input type="number" placeholder="Salary" name="salary_lower_bound"
                                 value="{{ old('salary_lower_bound', $jobOpening->salary_lower_bound) }}" autocomplete="salary_lower_bound"
                                class="form-control bg-transparent" />
                            @error('salary_lower_bound')
                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    <div data-field="salary_lower_bound" data-validator="notEmpty">
                                        {{ $message }}
                                    </div>
                                </div>
                            @enderror
                        </div>
                    
                        <div class="col-lg-1 d-flex align-items-center justify-content-center">
                            <span>To</span>
                        </div>
                    
                        <div class="col-lg-5">
                            <label class="form-label mb-3">Salary Upper Bound (It will not be shown to candidate)</label>
                            <input type="number" placeholder="Salary" name="salary_upper_bound"
                            value="{{ old('salary_upper_bound', $jobOpening->salary_upper_bound) }}" autocomplete="salary_upper_bound"
                                class="form-control bg-transparent" />
                            @error('salary_upper_bound')
                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    <div data-field="salary_upper_bound" data-validator="notEmpty">
                                        {{ $message }}
                                    </div>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <!-- CKEditor for Job Role Description -->
                    <div class="fv-row mb-8">
                        <label for="jobRoleDescription" class="form-label">Job Role Description</label>
                        <textarea class="form-control" id="jobRoleDescription" name="job_role_description">{{ old('job_role_description', $jobOpening->job_role_description) }}</textarea>
                        @error('job_role_description')
                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                <div data-field="job_role_description" data-validator="notEmpty">
                                    {{ $message }}
                                </div>
                            </div>
                        @enderror
                    </div>

                    <div class="fv-row mb-8">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status">
                            <option value="1" {{ (old('status', $jobOpening->status) == 1) ? 'selected' : '' }}>Active</option>
                            <option value="2" {{ (old('status', $jobOpening->status) == 2) ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                <div data-field="status" data-validator="notEmpty">
                                    {{ $message }}
                                </div>
                            </div>
                        @enderror
                    </div>

                    <div class="fv-row mb-8">
                        <label for="employmentType" class="form-label">Employment Type</label>
                        <select class="form-select" id="employmentType" name="employment_type">
                            @foreach (config('constants.EMPLOYMENT_STATUSES') as $key => $ep)
                            <option value="{{ $key }}" @if($key == $jobOpening->employment_type) selected="selected" @endif>{{ $ep }}</option>
                            @endforeach
                        </select>
                        @error('employment_type')
                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                <div data-field="employment_type" data-validator="notEmpty">
                                    {{ $message }}
                                </div>
                            </div>
                        @enderror
                    </div>

                    <!-- CKEditor for Overview of Company -->
                    <div class="fv-row mb-8">
                        <label for="overviewOfCompany" class="form-label">Overview of Company</label>
                        <textarea class="form-control" id="overviewOfCompany" name="overview_of_company">{{ old('overview_of_company', $jobOpening->overview_of_company) }}</textarea>
                        @error('overview_of_company')
                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                <div data-field="overview_of_company" data-validator="notEmpty">
                                    {{ $message }}
                                </div>
                            </div>
                        @enderror
                    </div>
                    
                    <button type="submit" class="btn btn-primary" style="float: right">Update Job Advertisement</button>
                </form>
            </div>
            <!--end::Body-->
        </div>
    </div>

</div>
@endsection

@section('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/classic/ckeditor.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        
        const departmentSelect = document.getElementById('department_id');
        const positionSelect = document.getElementById('job_id');
        const initialCompanyId = '{{ $jobOpening->company_id ?? "" }}';
        const initialDepartmentId = '{{ $jobOpening->department_id ?? "" }}';
        const initialPositionId = '{{ $jobOpening->position_id ?? "" }}';
    
       
        const routes = {
            departments:"/admin/job-opening/departments/" + ":companyId",
            positions:"/admin/job-opening/positions/" + ":departmentId",
            positionDetails: "/admin/job-opening/get-details-by-position/" + ":positionId"
        };
    
        if (initialCompanyId) {
            populateDepartments(initialCompanyId, initialDepartmentId, function() {
                if (initialDepartmentId) {
                    // populatePositions(initialDepartmentId, initialPositionId);
                    updatePositionDetails(initialPositionId);
                }
            });
        }
    
        // companySelect.onchange = function() {
        //     populateDepartments(this.value);
        // };
    
        departmentSelect.onchange = function() {
            populatePositions(this.value);
        };

        positionSelect.onchange = function() {
            updatePositionDetails(this.value);
        };
    
        function populateDepartments(companyId, preselectId = null, callback = () => {}) {
            let url = routes.departments.replace(':companyId', companyId);
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    departmentSelect.innerHTML = `<option value="">Select Department</option>`;
                    data.forEach(department => {
                        const isSelected = preselectId == department.id ? 'selected' : '';
                        departmentSelect.innerHTML += `<option value="${department.id}" ${isSelected}>${department.name}</option>`;
                    });
                    departmentSelect.disabled = false;
                    callback();
                });
        }
    
        // Function to dynamically populate positions based on the selected department
        function populatePositions(departmentId, preselectId = null) {
            let url = `/admin/jobs/by_org_department?department_id=${departmentId}`;
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    positionSelect.innerHTML = `<option value="">Select Job</option>`;
                    Object.keys(data).forEach(id => {
                        const isSelected = preselectId == id ? 'selected' : '';
                        positionSelect.innerHTML += `<option value="${id}" ${isSelected}>${data[id]}</option>`;
                    });
                    positionSelect.disabled = false;
                });
        }

        function updatePositionDetails(positionId) {
            let url = routes.positionDetails.replace(':positionId', positionId);
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('jobRoleDescription').value = data.description || '';
                    document.getElementById('job_title').value = data.title || '';

                    // Update Job Skills
                    const jobSkillsSelect = document.getElementById('job_skills');
                    jobSkillsSelect.innerHTML = '';  // Clear existing options
                    data.job_skills.forEach(skill => {
                        let option = new Option(skill.title, skill.id, true, true); // Select by default
                        jobSkillsSelect.appendChild(option);
                    });
                    $(jobSkillsSelect).select2(); // Re-initialize select2
                    $(jobSkillsSelect).trigger('change'); // Notify select2 of the update

                    // Update Technical Skills
                    const technicalSkillsSelect = document.getElementById('job_technical_skills');
                    technicalSkillsSelect.innerHTML = '';  // Clear existing options
                    data.technical_skills.forEach(skill => {
                        let option = new Option(skill.name, skill.id, true, true); // Select by default
                        technicalSkillsSelect.appendChild(option);
                    });
                    $(technicalSkillsSelect).select2(); // Re-initialize select2
                    $(technicalSkillsSelect).trigger('change'); // Notify select2 of the update

                    document.getElementById('vacancies').value = data.vacancies || 0;
                    document.getElementById('vacanciesDisabled').value = data.vacancies || 0
                    document.getElementById('work_experience').value = data.work_experience || 0;

                     // Auto-select education level
                    const educationLevelSelect = document.getElementById('education_level_id');
                    educationLevelSelect.value = data.education_level || ''; // Set the selected value
                    $(educationLevelSelect).trigger('change'); // Notify select2 of the update if using select2
                })
                .catch(error => console.error('Error loading position details:', error));
        }
    });

 
</script>

<script>
    function handleCountryChange() {
        var countrySelect = document.getElementById("country");
        var selectedCountry = countrySelect.options[countrySelect.selectedIndex].text;
        var stateContainer = document.getElementById("stateContainer");
        var cityContainer = document.getElementById("cityContainer");
        var barangayContainer = document.getElementById("barangayContainer");
        var postalCodeContainer = document.getElementById("postalCodeContainer");
        var provinceContainer = document.getElementById("provinceContainer");
        var cittyContainer = document.getElementById("cittyContainer");

        if (selectedCountry === "Philippines") {
            stateContainer.style.display = "none";
            cityContainer.style.display = "none";
            barangayContainer.style.display = "block";
            provinceContainer.style.display = "block";
            postalCodeContainer.style.display = "block";
            cittyContainer.style.display = "block";

            // Disable non-Philippines city_id
            document.getElementById("city_id").disabled = true;
            document.getElementById("city").disabled = false;
        } else {
            stateContainer.style.display = "block";
            cityContainer.style.display = "block";
            barangayContainer.style.display = "none";
            postalCodeContainer.style.display = "none";
            cittyContainer.style.display = "none";
            provinceContainer.style.display = "none";

            // Disable Philippines-specific city_id
            document.getElementById("city_id").disabled = false;
            document.getElementById("city").disabled = true;

            // Clear Philippines-specific fields
            document.getElementById("sub_division").value = "";
            document.getElementById("province").value = "";
            document.getElementById("postal_code").value = "";
            document.getElementById("city").value = "";
        }
    }

    // Initialize the form on page load
    window.onload = function() {
        handleCountryChange();
    };

</script>

<script>
    jQuery(document).ready(function() {
        jQuery('#country').change(function() {
            let cid = jQuery(this).val();
            jQuery.ajax({
                url: '{{ route('getState') }}',
                type: 'post',
                data: {
                    cid: cid,
                    _token: '{{ csrf_token() }}'
                },
                success: function(result) {
                    jQuery('#state_id').html(result);
                    jQuery('#city_id').html(
                    '<option value="">Select City</option>'); // Clear city dropdown
                }
            });
        });

        jQuery('#state_id').change(function() {
            let sid = jQuery(this).val();
            jQuery.ajax({
                url: '{{ route('getCity') }}',
                type: 'post',
                data: {
                    sid: sid,
                    _token: '{{ csrf_token() }}'
                },
                success: function(result) {
                    jQuery('#city_id').html(result);
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }

            });
        });
    });
</script>

{{-- for philipine country add --}}
<script>
    function initSelect2(selector, initialId, initialName) {
        var $select = $(selector);

        // Append the initial option if provided
        if (initialId && initialName) {
            var option = new Option(initialName, initialId, true, true);
            $select.append(option).trigger('change');
        }

        console.log('asdf');

        // Initialize Select2 with AJAX support
        $select.select2({
            ajax: {
                url: '{{ route('admin.barangay') }}',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term, // search term
                        id: params.id // you can pass id directly if needed
                    };
                },
                processResults: function(data, params) {
                    return {
                        results: data.results,
                        pagination: {
                            more: data.pagination.more
                        }
                    };
                },
                cache: true
            },
            placeholder: 'Search for a barangay/subdivision',
            minimumInputLength: 1
        });
    }
    // });

    $(document).ready(function() {
        // Assume these values are passed from the server
      
        initSelect2('#sub_division', '{{ $jobOpening->barangay_id ?? '' }}',
            '{{ $jobOpening->barangay->name ?? '' }}');
    });
</script>


<script>
    function initCitySelect2(selector, initialId, initialName) {
        var $select = $(selector);

        // Append the initial option if provided
        if (initialId && initialName) {
            var option = new Option(initialName, initialId, true, true);
            $select.append(option).trigger('change');
        }

        // Initialize Select2 with AJAX support
        $select.select2({
            ajax: {
                url: '{{ route('admin.city') }}',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term, // search term
                        id: params.id
                        // you can pass id directly if needed
                    };
                },
                processResults: function(data, params) {
                    return {
                        results: data.results,
                        pagination: {
                            more: data.pagination.more
                        }
                    };
                },
                cache: true
            },
            placeholder: 'Search for a City',
            minimumInputLength: 1
        });
    }
    // });

    $(document).ready(function() {
        // Assume these values are passed from the server
     
        initCitySelect2('#city', '{{ $jobOpening->city_id ?? '' }}',
            '{{ $jobOpening->city->name ?? '' }}');
    });
</script>

@endsection
