<style>
    .error-message {
        color: red;
        font-size: 10px;
        margin-top: 10px;
        font-weight: bold;
        margin-left: 5px;
    }

</style>

<div class="" id="vacancy-details" aria-labelledby="vacancy-details-tab" tabindex="0">
    <div class="top-content">
        <h3>Vacancy Details</h3>
        <p>Please enter the required vacancy details in the designated fields.</p>
    </div>
    @php
        $action = route('admin.talent-acquisition.job-board.create-vacancy-details');
        if ($editMode) {
            $action = route('admin.talent-acquisition.job-board.update-vacancy-details');
        } else if ($draftMode){
            $action = route('admin.talent-acquisition.job-board.update-vacancy-details');
        }
    @endphp

    <form id="vacancyDetailsForm" method="POST" action="{{ $action }}" onsubmit="submitForm(event)">               
        <input type="hidden" name="orgDepartmentId" id="orgDepartmentId" value="{{ $jobsData->org_department }}">
        <input type="hidden" name="jobId" id="jobId" value="{{ $jobsData->id }}">
        <input type="hidden" name="education_level" id="education_level" value="{{ $jobsData->education_level }}">
        <input type="hidden" name="editMode" value="{{ $editMode ? 'true' : 'false' }}">
        <input type="hidden" name="draftMode" value="{{ $draftMode ? 'true' : 'false' }}">

        @if ($editMode || $draftMode)
            <input type="hidden" name="jobOpeningId" value="{{ $jobOpeningId }}">
        @endif
        <div class="row g-3">
            <div class="{{ $jobsData->education_level ? 'col-md-6' : 'col-md-4' }}">
                <label for="jobTitle">Job Title</label>
                <input type="text" name="jobTitle" class="form-control input-grey" id="jobTitle"
                    value="{{ $draftMode || $editMode ? $jobOpeningData->job_title : ($jobsData->title ?? '') }}" readonly="readonly">
            </div>

            <div class="{{ $jobsData->education_level ? 'col-md-6' : 'col-md-4' }}">
                <label for="totalVacancies">Total Vacancies</label>
                <input type="number" name="totalVacancies" class="form-control input-grey" id="totalVacancies"
                value="{{ $draftMode || $editMode ? $jobOpeningData->vacancies : ($jobsData->vacancy ?? '') }}" readonly="readonly">            
            </div>

            @if (is_null($jobsData->education_level))
                <div class="col-md-4">
                    <label for="educationLevel">Education Level</label>
                    <select class="form-select previous-job-btn" id="educationLevel" name="education_level">
                        <option value="">Select Education Level</option>
                        @foreach(config('helpers.education_level') as $key => $value)
                            <option value="{{ $key }}">
                                {{ $value }}
                            </option>
                        @endforeach
                    </select>
                    <div id="educationLevel-error" class="error-message text-danger mt-1"></div>
                </div>
            @endif

            {{-- <div class="col-md-6 mt-5">
                <label for="employmentType">Employment Type</label>
                <div class="dropdown w-100">
                    <div class="form-select select previous-job-btn text-start" type="button" data-bs-toggle="dropdown" 
                         aria-expanded="false" id="dropdownEmploymentType">
                        {{ $draftMode || $editMode ? ucfirst(str_replace('_', ' ', array_search($jobOpeningData->employment_type, config('helpers.employment_type')))) : 'Select Employment Type' }}
                    </div>
                    <ul class="dropdown-menu w-100 mt-2">
                        @foreach(config('helpers.employment_type') as $type => $value)
                            <li>
                                <a class="dropdown-item" href="#" onclick="updateEmploymentTypeData(this, {{ $value }})">
                                    {{ ucfirst(str_replace('_', ' ', $type)) }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <div id="employmentTypeValue-error" class="error-message"></div>
                </div>
                <input type="hidden" id="employmentTypeValue" name="employmentType" class="validate"
                       value="{{ $draftMode || $editMode ? $jobOpeningData->employment_type : '' }}" />
            </div> --}}
            <div class="col-md-6 mt-5">
                <label for="dropdownEmploymentType">Employment Type</label>
                <select class="form-select" id="dropdownEmploymentType" name="employmentType" class="validate">
                    <option value="">Select Employment Type</option>
                    @foreach(config('helpers.employment_type') as $type => $value)
                        <option value="{{ $value }}" {{ ($draftMode || $editMode) && $jobOpeningData->employment_type == $value ? 'selected' : '' }}>
                            {{ ucfirst(str_replace('_', ' ', $type)) }}
                        </option>
                    @endforeach
                </select>
                <div id="employmentTypeValue-error" class="error-message"></div>
            </div>
            
            <div class="col-md-6 mt-5">
                <label for="jobLocation">Work Location</label>
                <select class="form-select" id="jobLocation" name="jobLocation" class="validate">
                    <option value="">Select Job Location</option>
                    @foreach(config('helpers.job_location_type') as $key => $value)
                        <option value="{{ $value }}" {{ ($draftMode || $editMode) && $jobOpeningData->job_location_type == $value ? 'selected' : '' }}>
                            {{ ucfirst($key) }}
                        </option>
                    @endforeach
                </select>
                <div id="jobLocation-error" class="error-message"></div>
            </div>
    
            <div class="row mt-5">
                <div class="col-md-4"> 
                    <label for="country">Country</label>
                    <select class="form-select" id="country" name="country_id">
                        <option value="">Select Country</option>
                       @foreach($locationData as $countryData)
                            <option value="{{ $countryData->id }}" 
                                {{ (($draftMode || $editMode) && $jobOpeningData->country_id == $countryData->id) || ((!$draftMode || !$editMode) && $countryData->id == 135) ? 'selected' : '' }}>
                                {{ $countryData->name }}
                            </option>
                        @endforeach

                    </select>
                    <div id="country-error" class="error-message"></div>
                </div>

                <div class="col-md-4">
                    <label for="state">State</label>
                    <select class="form-select" id="state" name="state_id">
                        <option value="">Select State</option>
                        @if ((($draftMode || $editMode) && isset($states)))
                            @foreach($states as $state)
                                {{-- <option value="{{ $state->id }}" 
                                    {{ $jobOpeningData->state_id == $state->id ? 'selected' : '' }}>
                                    {{ $state->name }}
                                </option> --}}
                                <option value="{{ $state->id }}"
                                    {{ (string)$state->id === (string)($jobOpeningData->state_id ?? '') ? 'selected' : '' }}>
                                    {{ $state->name }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                    <div id="state-error" class="error-message"></div>
                </div>
                
                <div class="col-md-4"> 
                    <label for="city">City</label>
                    <select class="form-select" id="city" name="city_id">
                        <option value="">Select City</option>
                        @if ((($draftMode || $editMode) && isset($cities)))
                            @foreach($cities as $city)
                                {{-- <option value="{{ $city->id }}" 
                                    {{ $jobOpeningData->city_id == $city->id ? 'selected' : '' }}>
                                    {{ $city->name }}
                                </option> --}}
                                <option value="{{ $city->id }}"
                                    {{ (string)$city->id === (string)($jobOpeningData->city_id ?? '') ? 'selected' : '' }}>
                                    {{ $city->name }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                    <div id="city-error" class="error-message"></div>
                </div>
            
            </div>
            
            <div class="col-md-6 mt-5">
                <label for="startDate">Application Period</label>
                <div class="input-group">
                    <input type="date" id="startDate" name="startDate" class="form-control date-input bg-white border-end-0 validate"
                        value="{{ ($draftMode || $editMode) ? $jobOpeningData->application_period_start_date : date('Y-m-d') }}"
                        min="{{ date('Y-m-d') }}">
                    <span class="input-group-text bg-white">
                        <iconify-icon icon="uil:calender" width="16" height="16"></iconify-icon>
                    </span>
                </div>
            </div>
            
            <div class="col-md-6 mt-5">
                <label for="endDate">Expiry Date</label>
                <div class="input-group">
                    <input type="date" id="endDate" name="endDate" class="form-control date-input bg-white border-end-0 validate"
                        min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                        placeholder="YYYY-MM-DD"> <!-- Added placeholder -->
                    <span class="input-group-text bg-white">
                        <iconify-icon icon="uil:calender" width="16" height="16"></iconify-icon>
                    </span>
                </div>
                <div id="endDate-error" class="error-message"></div>
            </div>
            
            <div class="col mt-5">
                <label>Monthly Salary Range</label>
                <div class="input-group" style="gap: 10px;">
                    <select class="form-select mr-4 col-md-3 validate" id="currency" name="currency">
                        <option value="">Select Currency</option>
                        @foreach($currencies as $currency)
                            @php
                                $isSelected = (($draftMode || $editMode) 
                                    && isset($jobOpeningData->currency_short_name) 
                                    && trim($jobOpeningData->currency_short_name) == trim($currency->currency_short_name)) 
                                    || ((!$draftMode && !$editMode) 
                                    && trim($currency->currency_short_name) == "PHP");
                            @endphp
                            <option value="{{ $currency->currency_short_name }} | {{ $currency->currency_long_name }}" 
                                {{ $isSelected ? 'selected' : '' }}>
                                {{ $currency->currency_short_name }} - {{ $currency->currency_long_name }}
                            </option>
                        @endforeach
                    </select>             
                    <div id="currency-error" class="error-message"></div>       
                    <div class="max-container col-md-4">
                        <input type="number" class="form-control validate" name="minSalary" id="minSalary" placeholder="Min Amount"
                        value="{{ ($draftMode || $editMode) ? $jobOpeningData->salary_lower_bound : '' }}" min="1" step="1" oninput="validatePositiveNumber(this)">
                        <div id="minSalary-error" class="error-message"></div> 
                    </div>          
                    <span class="d-flex align-items-center mx-2">-</span>
                    <div class="min-container col-md-4">
                        <input type="number" class="form-control validate" name="maxSalary" id="maxSalary" placeholder="Max Amount"
                        value="{{ ($draftMode || $editMode) ? $jobOpeningData->salary_upper_bound : '' }}" min="1" step="1" oninput="validatePositiveNumber(this)">
                        <div id="maxSalary-error" class="error-message"></div>    
                    </div>     
                </div>
            </div>
        </div>
        <div class="filter-content mt-6 display submit-button">
            <div class="d-flex justify-content-between">
                <div class="d-flex gap-2 ml-auto ">
                    @if($editMode)
                        <button class="btn btn-outline" type="button" onclick="cancelEdit()">Cancel</button>
                    @else
                        <button class="btn btn-outline" type="button" onclick="saveDraft('vacancyDetailsForm')">Save Draft</button>
                    @endif                    
                    <button class="btn btn-apply d-flex align-items-center gap-2" type="submit" disabled>
                        {{ (request()->has('fromPrevious') && $editMode) ? 'Next: Job Details' : ($editMode ? 'Confirm Edit' : 'Next: Job Details') }}
                        <iconify-icon icon="tabler:arrow-right" width="16" height="16"></iconify-icon>
                    </button>
                </div>
            </div>
        </div>
    </form>
    
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>

    window.editMode = "{{ $editMode ? 'true' : 'false' }}";
    window.draftMode = "{{ $draftMode ? 'true' : 'false' }}";

    // Set selected IDs based on which mode is active
    window.selectedCountryId = "{{ ($editMode || $draftMode) ? $jobOpeningData->country_id : '' }}";
    window.selectedStateId = "{{ ($editMode || $draftMode) ? $jobOpeningData->state_id : '' }}";
    window.selectedCityId = "{{ ($editMode || $draftMode) ? $jobOpeningData->city_id : '' }}";

    $(document).ready(function() {
        // Function to populate states based on country
        function populateStates(country_id) {
            if (country_id) {
                $.ajax({
                    url: '/admin/get-states/' + country_id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#state').empty();
                        $('#state').append('<option value="">Select State</option>');

                        if (data.states.length > 0) {
                            $.each(data.states, function(key, value) {
                                $('#state').append('<option value="' + value.id + '">' + value.name + '</option>');
                            });
                        }

                        // If in edit or draft mode, set the selected state
                        if (window.editMode === 'true' || window.draftMode === 'true') {
                            $('#state').val(window.selectedStateId);
                            // Populate cities based on the selected state
                            populateCities(window.selectedStateId);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error: " + status + error);
                        $('#state').empty();
                        $('#state').append('<option value="">Error loading states</option>');
                    }
                });
            } else {
                $('#state').empty();
                $('#state').append('<option value="">Select State</option>');
                $('#city').empty();
                $('#city').append('<option value="">Select City</option>');
            }
        }

        // Function to populate cities based on state
        function populateCities(state_id) {
            if (state_id) {
                $.ajax({
                    url: '/admin/get-cities/' + state_id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#city').empty();
                        $('#city').append('<option value="">Select City</option>');

                        if (data.cities.length > 0) {
                            $.each(data.cities, function(key, value) {
                                $('#city').append('<option value="' + value.id + '">' + value.name + '</option>');
                            });
                        }

                        // If in edit or draft mode, set the selected city
                        if (window.editMode === 'true' || window.draftMode === 'true') {
                            $('#city').val(window.selectedCityId);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error: " + status + error);
                        $('#city').empty();
                        $('#city').append('<option value="">Error loading cities</option>');
                    }
                });
            } else {
                $('#city').empty();
                $('#city').append('<option value="">Select City</option>');
            }
        }

        // Initial population
        if (window.editMode === 'true' || window.draftMode === 'true') {
            if (window.selectedCountryId) {
                $('#country').val(window.selectedCountryId);
                populateStates(window.selectedCountryId);
            }
        } else {
            $('#country').val(135); // Default country ID
            populateStates(135); // Populate states for default country
        }

        // Event listener for country change
        $('#country').change(function() {
            var country_id = $(this).val();
            populateStates(country_id);
            $('#city').empty();
            $('#city').append('<option value="">Select City</option>');
        });

        // Event listener for state change
        $('#state').change(function() {
            var state_id = $(this).val();
            populateCities(state_id);
        });
    });


    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('vacancyDetailsForm');
        const submitButton = form.querySelector('button[type="submit"]');
        const requiredFields = form.querySelectorAll('.validate:not([type="hidden"])');

        function checkForm() {
            let allFilled = true;
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    allFilled = false;
                }
            });

            submitButton.disabled = !allFilled;
        }

        requiredFields.forEach(field => {
            field.addEventListener('input', checkForm);
            field.addEventListener('change', checkForm);
        });

        checkForm();
    });

    document.addEventListener("DOMContentLoaded", function() {

        const today = new Date().toISOString().split('T')[0];

        const startDatePicker = flatpickr("#startDate", {
            dateFormat: "Y-m-d",
            defaultDate: document.getElementById("startDate").value || today, 
            minDate: today, 
            disableMobile: true, 
            onChange: function(selectedDates, dateStr) {

                const endDatePicker = flatpickr("#endDate");
                endDatePicker.set("minDate", new Date(selectedDates[0].getTime() + 86400000)); 
            }
        });

        const endDatePicker = flatpickr("#endDate", {
            dateFormat: "Y-m-d",
            minDate: new Date(new Date().getTime() + 86400000).toISOString().split('T')[0], 
            disableMobile: true,
        });
    });

    function validatePositiveNumber(input) {
        if (input.value < 1) {
            input.value = "";
        }
    }
    
    document.addEventListener("DOMContentLoaded", function () {
        const minSalary = document.getElementById("minSalary");
        const maxSalary = document.getElementById("maxSalary");
    
        minSalary.addEventListener("input", function () {
            if (maxSalary.value && parseInt(minSalary.value) >= parseInt(maxSalary.value)) {
                maxSalary.value = minSalary.value;
            }
            maxSalary.setAttribute("min", minSalary.value);
        });
    });
</script>

