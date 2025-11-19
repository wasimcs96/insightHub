@extends('admin.layout.app')

@section('title', 'Create A Job Advertisement')

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
                Job Advertisement Create
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
                    Job Advertisement Create </li>
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
                    <h3 class="card-title align-items-start flex-column">Create A Job Advertisement</h3>
                    <div class="card-toolbar">
                        <a href="{{ route('admin.job-openings.index', ['department_id' => session('job_opening_department_id')]) }}" class="btn btn-sm btn-primary">
                            <iconify-icon icon="material-symbols:arrow-back"></iconify-icon> Back To Job Advertisement
                            Dashboard
                        </a>
                    </div>
                </div>
                <!--end::Header-->
              
                <!--begin::Body-->
                <div class="card-body py-3">
                    <!--begin::Form-->
                    <form class="my-auto pb-5" action="{{ route('admin.job-openings.create') }}" method="POST"
                        novalidate="novalidate" id="kt_create_job_form">
                        @csrf
                        <div class="">
                            <!--begin::Wrapper-->
                            <div class="w-100">

                                <!-- Company ID Dropdown -->
                                {{-- @if ($isParent)
                                <div class="fv-row mb-8">
                                    <label class="form-label">Company</label>
                                    <select class="form-select" id="company_id" name="company_id">
                                        <!-- Dynamically populate this dropdown -->
                                        <option value="">Select Company</option>
                                        <option value="{{ auth()->user()->id }}">Parent Company</option>
                                        @foreach ($companies as $company)
                                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('company_id')
                                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                            <div data-field="company_id" data-validator="notEmpty">
                                                {{ $message }}
                                            </div>
                                        </div>
                                    @enderror
                                </div>
                            @elseif($isSubsidiary)
                                <input type="text" id="company_id" name="company_id" value="{{ auth()->user()->id }}" hidden="hidden" hidden>
                            @else
                                <input type="text" id="company_id" name="company_id" value="{{ auth()->user()->company_id }}" hidden="hidden" hidden>
                            @endif --}}

                                <!-- Department ID Dropdown -->
                                {{-- @if (!$isParent) --}}
                                <div class="fv-row mb-8">
                                    
                                    <label class="form-label">Department</label>
                                    <select class="form-select" id="department_id" name="department_id">
                                        <!-- Dynamically populate this dropdown -->
                                        <option value="">Select Department</option>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}" 
                                                {{ session('job_opening_department_id') == $department->id ? 'selected' : '' }}>
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
                                    <label class="form-label">Department</label>
                                    <select class="form-select" id="department_id" name="department_id">
                                        <!-- Dynamically populate this dropdown -->
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

                                <!-- Position ID Dropdown -->
                                <div class="fv-row mb-8">
                                    <label class="form-label">Job Title</label>
                                    <select class="form-select" id="job_id" name="job_id">
                                        <!-- Dynamically populate this dropdown -->
                                        <option value="">Select Job Title</option>
                                        {{-- @foreach ($jobs as $job)
                                            <option value="{{ $job->id }}">{{ $job->title }}</option>
                                        @endforeach --}}
                                    </select>
                                    @error('job_id')
                                        <div
                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                            <div data-field="job_id" data-validator="notEmpty">
                                                {{ $message }}
                                            </div>
                                        </div>
                                    @enderror
                                </div>

                                <input type="hidden" name="job_title" id="job_title" value=>

                                <!--begin::Input group for Job Title-->
                                {{-- <div class="fv-row mb-8">
                                <label class="form-label mb-3">Job Title</label>
                                <input type="text" placeholder="Job Title" name="job_title" id="job_title" value="{{ old('job_title') }}" autocomplete="job_title" class="form-control bg-transparent"/>
                                @error('job_title')
                                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                        <div data-field="job_title" data-validator="notEmpty">
                                            {{ $message }}
                                        </div>
                                    </div>
                                @enderror
                            </div> --}}

                                <div class="fv-row mb-8">
                                    <label for="exampleFormControlInput1" class="form-label">Select Job Skills</label>
                                    <select class="form-select" disabled name="job_skills[]" id="job_skills" data-control="select2"
                                        data-close-on-select="false" data-placeholder="Select an option"
                                        data-allow-clear="true" multiple="multiple">
                                        {{-- @foreach ($job_skills as $job_skill)
                                      <option value="{{ $job_skill->id }}" >{{ $job_skill->title }}</option>
                                    @endforeach --}}
                                    </select>
                                    @error('job_skills[]')
                                        <div
                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                            <div data-field="job_skills[]" data-validator="notEmpty">
                                                {{ $message }}
                                            </div>
                                        </div>
                                    @enderror
                                </div>

                                <div class="fv-row mb-8">
                                    <label for="exampleFormControlInput1" class="form-label">Select Technical Skills</label>
                                    <select class="form-select" disabled name="job_technical_skills[]" id="job_technical_skills"
                                        data-control="select2" data-close-on-select="false"
                                        data-placeholder="Select an option" data-allow-clear="true" multiple="multiple">
                                        {{-- @foreach ($job_technical_skills as $job_technical_skill)
                                        <option value="{{ $job_technical_skill->id }}" >{{ $job_technical_skill->name }}</option>
                                    @endforeach --}}
                                    </select>
                                    @error('job_technical_skills[]')
                                        <div
                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                            <div data-field="job_technical_skills[]" data-validator="notEmpty">
                                                {{ $message }}
                                            </div>
                                        </div>
                                    @enderror
                                </div>

                                <!--begin::Input group for Total Vacancies-->
                                <div class="fv-row mb-8">
                                    <label class="form-label mb-3">Total Vacancies (Position headcounts - Total employees
                                        employed on this position)</label>
                                    <input type="text" placeholder="Total Vacancies" name="vacanciesDisabled" value="0"
                                        autocomplete="vacancies" class="form-control bg-transparent" id="vacanciesDisabled" disabled/>
                                    <input type="text" value="0" name="vacancies" id="vacancies" hidden>
                                    @error('vacancies')
                                        <div
                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                            <div data-field="vacancies" data-validator="notEmpty">
                                                {{ $message }}
                                            </div>
                                        </div>
                                    @enderror
                                </div>

                                <h5 class="mt-4 mb-4">Job Qualification</h5>
                                <div class="fv-row mb-7 row">
                                    <div class="col-lg-4">
                                        <label class="form-label">Select Education Levels</label>
                                        <select class="form-select" name="education_level_id" id="education_level_id">
                                            @foreach ($education_levels as $education_level)
                                                <option value="{{ $education_level->id }}">{{ $education_level->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('education_level_id')
                                            <div
                                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                <div data-field="education_level_id" data-validator="notEmpty">
                                                    {{ $message }}
                                                </div>
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col-lg-4">
                                        <label class="form-label">Select Education Programs</label>
                                        <select class="form-select" name="education_program_id">
                                            @foreach ($education_programs as $education_program)
                                                <option value="{{ $education_program->id }}">
                                                    {{ $education_program->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('education_program_id')
                                            <div
                                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                <div data-field="education_program_id" data-validator="notEmpty">
                                                    {{ $message }}
                                                </div>
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col-lg-4">
                                        <label class="form-label mb-3">Work Experience (In Years)</label>
                                        <input type="number" placeholder="Work Experience" id="work_experience"
                                            name="work_experience" value="{{ old('work_experience') }}"
                                            autocomplete="work_experience" class="form-control bg-transparent" />
                                        @error('work_experience')
                                            <div
                                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
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
                                        <select id="country" class="form-select" name="country_id"
                                            data-control="select2" data-close-on-select="false"
                                            data-placeholder="Select an option" data-allow-clear="false"
                                            onchange="handleCountryChange()">
                                            <option value="">Select Country</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('country_id')
                                            <div
                                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                <div data-field="countries" data-validator="notEmpty">
                                                    {{ $message }}
                                                </div>
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col-lg-4" id="stateContainer">
                                        <label for="state_id" class="form-label">Select State</label>
                                        <select id="state_id" class="form-control form-control-solid mb-3 mb-lg-0"
                                            name="state_id" data-control="select2" data-hide-search="false">
                                            <option value="">Select State</option>
                                            {{-- @foreach ($states as $state)
                                                    <option value="{{ $state->id ?? '' }}" @if (!empty($user) && $user->state_id == $state->id) selected @endif>
                                                        {{ $state->name ?? '' }}</option>
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
                                        <select id="city_id" class="form-control form-control-solid mb-3 mb-lg-0"
                                            name="city_id" data-control="select2" data-hide-search="false">
                                            <option value="">Select City</option>
                                            {{-- @foreach ($cities as $city)
                                                    <option value="{{ $city->id ?? '' }}" @if (!empty($user) && $user->city_id == $city->id) selected @endif>
                                                        {{ $city->name ?? '' }}</option>
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
                                        <select id="sub_division" class="form-control select2-ajax" name="barangay_id"
                                            data-control="select2" data-hide-search="false">
                                            <option value="">Select Barangay/Subdivision</option>
                                        </select>

                                        @error('sub_division')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message ?? '' }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-xl-2" id="cittyContainer" style="display: none;">
                                        <label for="city" class="form-label">Select City</label>
                                        <select id="city" class="form-control form-control-solid mb-3 mb-lg-0"
                                            name="city_id" data-control="select2" data-hide-search="false">
                                            <option value="">Select City</option>
                                            {{-- @foreach ($cities as $city)
                                                    <option value="{{ $city->id ?? '' }}" @if (!empty($user) && $user->city_id == $city->id) selected @endif>
                                                        {{ $city->name ?? '' }}</option>
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
                                        <select id="province" class="form-control form-control-solid mb-3 mb-lg-0"
                                            name="province_id" data-control="select2" data-hide-search="false">
                                            <option value="">Select Province</option>
                                            @foreach ($provinces as $province)
                                                <option value="{{ $province->id ?? '' }}"
                                                    @if (!empty($user) && $user->province_id == $province->id) selected @endif>
                                                    {{ $province->name ?? '' }}</option>
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
                                        <input id="postal_code" type="number"
                                            class="form-control form-control-solid mb-3 mb-lg-0" name="postal_code"
                                            placeholder="Enter Postal Code" value="{{ $user->postal_code ?? '' }}">
                                        @error('postal_code')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>


                                {{-- <div class="row mb-5 pt-2">
                             
            
                                    </div> --}}

                                <div class="fv-row mb-7 row">
                                    <div class="col-lg-5">
                                        <label class="form-label mb-3">Salary Lower Bound (It will not be shown to candidate)</label>
                                        <input type="number" placeholder="Salary" name="salary_lower_bound"
                                            value="{{ old('salary_lower_bound') }}" autocomplete="salary_lower_bound"
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
                                            value="{{ old('salary_upper_bound') }}" autocomplete="salary_upper_bound"
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
                                    


                                <!--begin::Input group for Job Role Description-->
                                <div class="fv-row mb-8 py-5">
                                    <label class="form-label mb-3">Job Role Description</label>
                                    <textarea name="job_role_description" id="job_role_description" class="form-control">{{ old('job_role_description') }}</textarea>
                                    @error('job_role_description')
                                        <div
                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                            <div data-field="job_role_description" data-validator="notEmpty">
                                                {{ $message }}
                                            </div>
                                        </div>
                                    @enderror
                                </div>



                                <!-- Select Status Dropdown -->
                                <div class="fv-row mb-8">
                                    <label class="form-label">Select Status</label>
                                    <select class="form-select" name="status">
                                        <option value="1">Active</option>
                                        <option value="2">InActive</option>
                                    </select>
                                    @error('status')
                                        <div
                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                            <div data-field="status" data-validator="notEmpty">
                                                {{ $message }}
                                            </div>
                                        </div>
                                    @enderror
                                </div>

                                <!-- User Type Dropdown -->
                                {{-- <div class="fv-row mb-8">
                                <label class="form-label">User Type</label>
                                <select class="form-select" name="user_type">
                                    <option value="1">Internal</option>
                                    <option value="2">External</option>
                                </select>
                                @error('user_type')
                                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                        <div data-field="user_type" data-validator="notEmpty">
                                            {{ $message }}
                                        </div>
                                    </div>
                                @enderror
                            </div> --}}

                                <!-- Employment Type Dropdown -->

                                <div class="fv-row mb-8">
                                    <label class="form-label">Employment Type</label>
                                    <select class="form-select" name="employment_type">
                                        @foreach (config('constants.EMPLOYMENT_STATUSES') as $key => $ep)
                                            <option value="{{ $key }}">{{ $ep }}</option>
                                        @endforeach
                                    </select>
                                    @error('employment_type')
                                        <div
                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                            <div data-field="employment_type" data-validator="notEmpty">
                                                {{ $message }}
                                            </div>
                                        </div>
                                    @enderror
                                </div>

                                <!--begin::Input group for Salary-->
                                {{-- <div class="fv-row mb-8">
                              
                            </div> --}}

                                <!--begin::Input group for Work Experience-->
                                {{-- <div class="fv-row mb-8">
                             
                            </div> --}}

                                <!-- Overview of Company -->
                                <div class="fv-row mb-8 py-5">
                                    <label class="form-label">Overview of Company</label>
                                    <textarea name="overview_of_company" id="overview_of_company" class="form-control">{{ old('overview_of_company') }}</textarea>
                                    @error('overview_of_company')
                                        <div
                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                            <div data-field="overview_of_company" data-validator="notEmpty">
                                                {{ $message }}
                                            </div>
                                        </div>
                                    @enderror
                                </div>


                            </div>
                            <!--end::Wrapper-->
                        </div>

                        <!--begin::Actions-->
                        <div class="d-flex flex-stack pt-15">
                            <div>
                                <button type="submit" class="btn btn-lg btn-primary"
                                    style="float: right">Submit</button>
                            </div>
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--begin::Body-->
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/classic/ckeditor.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>


    <script>
        document.getElementById('job_id').addEventListener('change', function() {
            var selectedJobId = this.value;
            if (selectedJobId) {
                updatePositionDetails(selectedJobId);
            }
        });

        function updatePositionDetails(positionId) {
            let url = "/admin/job-opening/get-details-by-position/" + positionId;
            console.log(url);
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    // Update Job Role Description in CKEditor
                    document.getElementById('job_role_description').value = data.description || '';
                    document.getElementById('job_title').value = data.title || '';
                    
                    // Update Job Skills
                    const jobSkillsSelect = document.getElementById('job_skills');
                    jobSkillsSelect.innerHTML = ''; // Clear existing options
                    data.job_skills.forEach(skill => {
                        console.log(skill);
                        let option = new Option(skill.title, skill.id, true, true); // Select by default
                        jobSkillsSelect.appendChild(option);
                    });
                    $(jobSkillsSelect).select2(); // Re-initialize select2
                    $(jobSkillsSelect).trigger('change'); // Notify select2 of the update

                    // Update Technical Skills
                    const technicalSkillsSelect = document.getElementById('job_technical_skills');
                    technicalSkillsSelect.innerHTML = ''; // Clear existing options
                    data.technical_skills.forEach(skill => {
                        let option = new Option(skill.name, skill.id, true, true); // Select by default
                        technicalSkillsSelect.appendChild(option);
                    });
                    $(technicalSkillsSelect).select2(); // Re-initialize select2
                    $(technicalSkillsSelect).trigger('change'); // Notify select2 of the update

                    document.getElementById('vacancies').value = data.vacancies || 0;
                    document.getElementById('vacanciesDisabled').value = data.vacancies || 0;
                    document.getElementById('work_experience').value = data.work_experience || 0;

                    // Auto-select education level
                    const educationLevelSelect = document.getElementById('education_level_id');
                    educationLevelSelect.value = data.education_level || ''; // Set the selected value
                    $(educationLevelSelect).trigger('change'); // Notify select2 of the update if using select2
                })
                .catch(error => console.error('Error loading position details:', error));
        }

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
            initSelect2('#ec_barangay_id', '{{ $user->ec_barangay_id ?? '' }}',
                '{{ $user->ecBarangay->name ?? '' }}');
            initSelect2('#mailing_sub_division', '{{ $user->mailing_barangay_id ?? '' }}',
                '{{ $user->mailBarangay->name ?? '' }}');
            initSelect2('#sub_division', '{{ $user->barangay_id ?? '' }}',
                '{{ $user->barangay->name ?? '' }}');
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
            initCitySelect2('#ec_city_id', '{{ $user->ec_city_id ?? '' }}',
                '{{ $user->ecCityName->name ?? '' }}');
            initCitySelect2('#mailing_city', '{{ $user->mailing_city_id ?? '' }}',
                '{{ $user->mailCity->name ?? '' }}');
            initCitySelect2('#city', '{{ $user->city_id ?? '' }}',
                '{{ $user->cityName->name ?? '' }}');
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


        // Initialize the form on page load
        window.onload = function() {
            handleCountryChange();
        };


        // Initialize the form on page load
        window.onload = function() {
            handleCountryChange();
        };
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var departmentSelect = document.getElementById('department_id');
            var jobSelect = document.getElementById('job_id');
    
            // If department is auto-selected from session, trigger the change event
            if (departmentSelect.value) {
                loadJobsByDepartment(departmentSelect.value);
            }
    
            // When the department is changed manually
            departmentSelect.addEventListener('change', function() {
                loadJobsByDepartment(this.value);
            });
    
            function loadJobsByDepartment(departmentId) {
                // Clear the current options in the job select box
                jobSelect.innerHTML = '<option value="">Select Job Title</option>';
    
                if (departmentId) {
                    fetch(`/admin/jobs/by_org_department?department_id=${departmentId}`)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok ' + response.statusText);
                            }
                            return response.json();
                        })
                        .then(data => {
                            Object.keys(data).forEach(id => {
                                var option = document.createElement('option');
                                option.value = id;
                                option.textContent = data[id];
                                jobSelect.appendChild(option);
                            });
                        })
                        .catch(error => console.error('Error fetching jobs:', error));
                }
            }
        });
    </script>
    
@endsection
