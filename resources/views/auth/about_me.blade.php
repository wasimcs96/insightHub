@extends('avenger.layouts.app')

@section('title', 'About Me | Update your details | ' . env('APP_NAME'))
@section('description',
    "Discover a comprehensive About Me page, showcasing personal, location, and education details,
    job preferences, employment history, skills, and documents. Gain insight into [Your Name]'s background, expertise, and
    aspirations.")
@section('keywords',
    'About Me, Personal Info, Location Info, Education Info, Job Preference, Employment History &
    Skills, Documents')
@section('styles')

    <style>
        .sign-up-form {
            min-height: 80vh;
            padding: 48px;
        }

        .sign-up-form .nav-pills .nav-link {
            color: #99A1B7;
            font-size: 13.975px;
            font-weight: 500;
            display: flex;
            gap: 16px;
            align-items: center;
            padding: 0px;
        }

        .sign-up-form .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            background-color: transparent;
            color: #4B5675;
            font-weight: 700;
        }

        .sign-up-form .nav-pills .nav-link .circle-gray {
            border: 2px solid #DBDFE9;
            width: 24px;
            height: 24px;
            display: block;
            background: #fff;
            border-radius: 50%;
        }

        .sign-up-form .nav-pills .nav-link .circle-gray.active {
            background: #F7941C;
        }

        .sign-up-form .line-horizontal {
            width: 2px;
            height: 25px;
            display: block;
            background: #DBDFE9;
            margin: 4px 0px 4px 11px;
        }

        .sign-up-form .nav-pills {
            padding: 16px 0px;
        }

        .sign-up-form .tab-content {
            padding: 16px;
            width: 100%;

        }

        .sign-up-form .top-content h3 {
            color: #4B5675;
            font-size: 22.75px;
            font-weight: 700;
            line-height: 27.3px;
            margin: 0;
        }

        .sign-up-form .top-content p {
            color: #99A1B7;
            font-size: 16px;
            font-weight: 400;
            line-height: 24px;
            margin: 0;
        }

        .sign-up-form label {
            color: #071437;
            font-size: 12px;
            font-weight: 500;
            line-height: 16px;
        }

        .sign-up-form .input-grey {
            border-radius: 4px;
            background: #F1F1F4;
            border: 1px solid #DBDFE9;
        }

        /* .sign-up-form input,
                        .sign-up-form select {
                            border-radius: 4px;
                            border: 1px solid #DBDFE9;
                            display: flex;
                            height: 40px;
                            padding: 0px 12px;
                            align-items: center;
                            align-self: stretch;
                            color: #4B5675;
                            font-size: 12px;
                            font-weight: 400;
                            line-height: 16px;
                        } */

        .sign-up-form .d-grid {
            grid-template-columns: 28% 72%;
        }

        .sign-up-form .right-section {
            padding: 48px;
            border-radius: 8px;
            background: #FFF;
            box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.03);
        }

        .back-btn a:hover {
            color: #F7941C;
        }
    </style>

@endsection

<!--begin::Authentication - Sign-in -->
@section('content')
    <div class="d-flex align-items-center justify-content-center sign-up-form">
        <div class="container d-grid">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                @php
                    $steps = [
                        'personal-info' => 'Personal Info',
                        'location-info' => 'Location Info',
                        'education-info' => 'Education Info',
                        'job-preference' => 'Job Specification',
                        'employment-history-and-skills' => 'Employment History & Skills',
                        'upload-documents' => 'Documents',
                    ];
                @endphp

                @foreach ($steps as $id => $label)
                    {{-- {{ dd($step) }} --}}
                    <button class="nav-link @if ($id == $step) active @endif" id="{{ $id }}-tab"
                        data-bs-toggle="pill" data-bs-target="#{{ $id }}" type="button" role="tab"
                        aria-controls="{{ $id }}"
                        aria-selected="@if ($id == $step) true @else false @endif">
                        <span class="circle-gray @if ($id == $step) active @endif"></span>{{ $label }}
                    </button>
                    @if (!$loop->last)
                        <div class="line-horizontal"></div>
                    @endif
                @endforeach
            </div>

            <div class="right-section">
                <div class="tab-content p-0" id="v-pills-tabContent">
                    <div class="tab-pane fade @if ($step == 'personal-info') show active @endif" id="personal-info"
                        role="tabpanel">
                        <div class="top-content">
                            <h3>Personal Info</h3>
                            <p>Update your personal information</p>
                            <form action="{{ route('user.about.me.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="step" value="1">
                                <div class="row mb-5">
                                    <div class="col-md-6">
                                        <label>First Name</label>
                                        <input type="text" class="form-control" name="first_name"
                                            value="{{ auth()->user()->first_name }}" placeholder="First Name">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Last Name</label>
                                        <input type="text" class="form-control" name="last_name"
                                            value="{{ auth()->user()->last_name }}" placeholder="Last Name">
                                    </div>
                                </div>
                                <div class="mb-5">
                                    <label>Email</label>
                                    <input type="email" class="form-control" value="{{ auth()->user()->email }}" disabled>
                                </div>

                                <div class="mb-5">
                                    <label>Nationality</label>

                                    <select class="form-select" name="nationality" id="nationality" data-control="select2"
                                        data-hide-search="false">
                                        <option value="">Select a Country</option>
                                    </select>
                                    @error('nationality')
                                        <div
                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                            <div data-field="nationality" data-validator="notEmpty">
                                                {{ $message }}
                                            </div>
                                        </div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <label>Mobile Phone Number</label>
                                    <div class="mb-5 col-lg-2">


                                        <select class="form-select" name="country_code">
                                            <option value="">Select Country Code </option>
                                            @foreach (config('helpers.country_code') as $key => $country_code)
                                                <option value="{{ $key ?? '' }}"
                                                    @if (auth()->user()->country_code == $key) selected @endif>
                                                    {{ $country_code ?? '' }}
                                                </option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="mb-5 col-lg-10">
                                        {{-- <label>Mobile</label> --}}
                                        <input type="text" class="form-control" name="mobile"
                                            value="{{ auth()->user()->mobile_number }}" placeholder="e.g 289911914"
                                            disabled>
                                    </div>
                                </div>
                                <button type="submit" class="custom-btn btn-orange-fill cursor-pointer float-right">Next:
                                    Location Info</button>
                            </form>
                        </div>
                    </div>

                    <div class="tab-pane fade @if ($step == 'location-info') show active @endif" id="location-info"
                        role="tabpanel">
                        <div class="top-content">
                            <h3>Location Information</h3>
                            <p>Update your location information</p>
                            <form action="{{ route('user.about.me.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="step" value="2">
                                <div class="row mb-5">
                                    <div class="col-md-6">
                                        @php
                                            $countries = \App\Models\MasterCountry::all();
                                        @endphp
                                        <label>Country</label>
                                        <select class="form-select" name="country_id">
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}"
                                                    @if (auth()->user()->country_id == $country->id || $country->id == 135) selected @endif>
                                                    {{ $country->name ?? '' }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label>State</label>
                                        <select class="form-select" name="state_id">
                                            {{-- @foreach ($states as $state)
                                                <option value="{{ $state->id }}" @if (auth()->user()->state_id == $state->id) selected @endif>{{ $state->name }}</option>
                                            @endforeach --}}
                                        </select>
                                    </div>

                                </div>
                                <div class="row mb-5">
                                    <div class="col-md-6">
                                        <label>City</label>
                                        <select class="form-select" name="city_id">
                                            {{-- @foreach ($cities as $city)
                                                <option value="{{ $city->id }}" @if (auth()->user()->city_id == $city->id) selected @endif>{{ $city->name }}</option>
                                            @endforeach --}}
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Postcode</label>
                                        <input type="text" class="form-control" name="postal_code"
                                            value="{{ auth()->user()->postal_code }}" placeholder="Your Postcode">
                                    </div>

                                </div>
                                <div class="mb-5">
                                    <label>Address</label>
                                    <input type="text" class="form-control" name="address"
                                        value="{{ auth()->user()->address }}" placeholder="Your Address">
                                </div>


                                <div class="d-flex justify-content-end gap-2 back-btn">
                                    <a href="{{ url('/user/about-me/1') }}"
                                        class="custom-btn btn-orange-outline cursor-pointer">
                                        Back
                                        </a>

                                    <button type="submit" class="custom-btn btn-orange-fill cursor-pointer">Next:
                                        Education
                                        Info</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane fade @if ($step == 'education-info') show active @endif" id="education-info"
                        role="tabpanel" aria-labelledby="education-info-tab" tabindex="0">
                        <div class="top-content">
                            <h3>Education Information</h3>
                            <p>Update your education information</p>
                            <form class="mt-5" action="{{ route('user.about.me.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="step" value="3">

                                @php
                                    $education_levels = \App\Models\MasterEducationLevel::all();
                                    $education_years = \App\Models\MasterEducationYear::all();
                                    $education_institutions = \App\Models\MasterHigherLearningInstitution::all();
                                    $education_programs = \App\Models\MasterEducationProgram::all();
                                @endphp


                                <div class="row mb-5">
                                    <div class="col-md-6">
                                        <label>Education Level</label>
                                        <select class="form-select" name="education_level_id">
                                            <option value="" selected>Select Education Level</option>
                                            @foreach ($education_levels as $education_level)
                                                <option value="{{ $education_level->id }}"
                                                    @if (auth()->user()->education_level == $education_level->id) selected @endif>
                                                    {{ $education_level->name ?? '' }}</option>
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
                                    <div class="col-md-6">
                                        <label>Year of Graduation</label>
                                        <input type="year" class="form-control" name="education_year_id"
                                            placeholder="Year of Graduation"
                                            value="{{ auth()->user()->graduate_year ?? '' }}" placeholder="Example:2024">
                                        @error('education_year_id')
                                            <div
                                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                <div data-field="education_year_id" data-validator="notEmpty">
                                                    {{ $message }}
                                                </div>
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-5">
                                    <label>Institution</label>
                                    <select class="form-select" id="education_institution_id"
                                        name="education_institution_id" data-control="select2" data-hide-search="false">
                                        <option selected>Select Institution</option>
                                        @foreach ($education_institutions as $education_institution)
                                            <option value="{{ $education_institution->id }}"
                                                @if (isset(auth()->user()->higher_learning_institution) &&
                                                        auth()->user()->higher_learning_institution == $education_institution->id) selected @endif>
                                                {{ $education_institution->name ?? '' }}</option>
                                        @endforeach
                                    </select>
                                    @error('education_institution_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-5">
                                    <label>Program</label>
                                    <select class="form-select" name="education_program_id" data-control="select2"
                                        data-hide-search="false">
                                        <option selected>Select Program</option>
                                        @foreach ($education_programs as $education_program)
                                            <option value="{{ $education_program->id }}"
                                                @if (auth()->user()->education_program_id == $education_program->id) selected @endif>
                                                {{ $education_program->name ?? '' }}</option>
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
                                <div class="d-flex justify-content-end gap-2 back-btn">
                                    <a href="{{ url('/user/about-me/2') }}"
                                        class="custom-btn btn-orange-outline cursor-pointer">
                                        Back
                                        </a>
                                    <button type="submit" class="custom-btn btn-orange-fill cursor-pointer">Next: Job
                                        Preference</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="tab-pane fade @if ($step == 'job-preference') show active @endif" id="job-preference"
                        role="tabpanel" aria-labelledby="job-preference-tab" tabindex="0">
                        <div class="top-content">
                            <h3>Job Specification</h3>
                            <p>Update your job Specification</p>
                            <form class="mt-5" action="{{ route('user.about.me.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="step" value="4">
                                @php
                                    $selected_preferred_locations = \App\Models\UserJobPreferredLocation::where(
                                        'user_id',
                                        auth()->user()->id,
                                    )
                                        ->pluck('city_id')
                                        ->toArray();
                                    $preferred_cities = \App\Models\MasterCity::whereIn(
                                        'id',
                                        $selected_preferred_locations,
                                    )->get();
                                @endphp

                                {{-- {{ dd($preferred_cities) }} --}}
                                <div class="row">
                                    <div class="mb-5 col-lg-6">
                                        <label>Work Experience (Years)</label>
                                        {{-- <input type="text" class="form-control" id="have_work_experience"
                                            placeholder="Work Experience (For ex. 1.5)" name="job_work_experience"
                                            value="{{ auth()->user()->year_of_experience_in_it_sector ?? old('job_work_experience') }}"
                                            autocomplete="job_work_experience" step="0.01" min="0"> --}}



                                        <select class="form-select" name="job_work_experience" data-control="select2"
                                            data-hide-search="false">
                                            @foreach (config('helpers.work_experience') as $key => $work_experience)
                                                <option value="{{ $key ?? '' }}"
                                                    @if (auth()->user()->year_of_experience_in_it_sector == $key) selected @endif>
                                                    {{ $work_experience ?? '' }}
                                                </option>
                                            @endforeach
                                        </select>



                                        @error('job_work_experience')
                                            <div
                                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                <div data-field="job_work_experience" data-validator="notEmpty">
                                                    {{ $message }}
                                                </div>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-5 col-lg-6">
                                        <label class="mb-4">Do you have valid work authorisation?</label>
                                        <div class="row">
                                            <div class="form-check form-check-custom form-check-solid col-lg-2">
                                                <input class="form-check-input" type="radio" name="work_authorisation"
                                                    @if (auth()->user()->work_authorisation == 1) checked @endif value="1"
                                                    id="flexRadioDefault" />
                                                <label class="form-check-label ml-5" for="flexRadioDefault">
                                                    Yes
                                                </label>
                                            </div>
                                            <div class="form-check form-check-custom form-check-solid col-lg-2">
                                                <input class="form-check-input" type="radio" name="work_authorisation"
                                                    @if (auth()->user()->work_authorisation == 2) checked @endif value="2"
                                                    id="flexRadioDefault" />
                                                <label class="form-check-label ml-5" for="flexRadioDefault">
                                                    No
                                                </label>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="mb-5">
                                    <label>Your Preferred Working Locations</label>
                                    <select class="form-select" name="job_preferred_locations[]" data-control="select2"
                                        data-close-on-select="false" data-placeholder="Search City & Select"
                                        data-allow-clear="true" multiple="multiple">
                                        @foreach ($preferred_cities as $city)
                                            <option value="{{ $city->id }}" selected="selected">
                                                {{ $city->name ?? '' }}</option>
                                        @endforeach
                                    </select>
                                    @error('job_preferred_locations')
                                        <div
                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                            <div data-field="job_preferred_locations" data-validator="notEmpty">
                                                {{ $message }}
                                            </div>
                                        </div>
                                    @enderror
                                </div>
                                @php $job_opening = App\Models\JobOpening::where('status', 2)->get(); @endphp
                                @php $jobOpeningid = session()->get('job_opening_id'); @endphp
                                <div class="mb-5">
                                    <label>Preferred Job</label>
                                    <select class="form-select" name="job_id">
                                        <option value="">Select Preferred Job </option>
                                        @foreach ($job_opening as $job)
                                            <option value="{{ $job->id ?? '' }}"
                                                @if ($job->id == $jobOpeningid) selected @endif>
                                                {{ $job->job_title ?? '' }}</option>
                                        @endforeach
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
                                <div class="d-flex justify-content-end gap-2 back-btn">
                                    <a href="{{ url('/user/about-me/3') }}"
                                        class="custom-btn btn-orange-outline cursor-pointer">
                                        Back
                                        </a>
                                    <button type="submit" class="custom-btn btn-orange-fill cursor-pointer">Next:
                                        Employment History & Skills</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="tab-pane fade @if ($step == 'employment-history-and-skills') show active @endif"
                        id="employment-history-and-skills" role="tabpanel" aria-labelledby="employment-history-tab"
                        tabindex="0">
                        @php
                            $genericSkills = App\Models\MasterSkill::get();

                        @endphp


                        <div class="top-content">
                            <h3>Employment History & Skills</h3>
                            <p>Update your skills & employment history (leave blank if you don't have one)</p>
                            <form class="mt-5" action="{{ route('user.about.me.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="step" value="5">
                                <div id="employment-container">

                                    @if (auth()->user()->employments()->count() > 0)
                                        @foreach (auth()->user()->employments as $employment)
                                            @php

                                                $selected_job_skills = \App\Models\UserJobSkill::where(
                                                    'user_id',
                                                    auth()->user()->id,
                                                )
                                                    ->where('employment_id', $employment->id)
                                                    ->pluck('job_skill_id')
                                                    ->toArray();
                                                $selected_job_technical_skills = \App\Models\UserJobTechnicalSkill::where(
                                                    'user_id',
                                                    auth()->user()->id,
                                                )
                                                    ->where('employment_id', $employment->id)
                                                    ->pluck('job_technical_skill_id')
                                                    ->toArray();
                                            @endphp
                                            <div class="employment-entry mt-5">
                                                <div class="d-flex justify-content-end my-5">
                                                    <button type="button"
                                                        class="custom-btn btn-grey-outline cursor-pointer remove-employment py-4">
                                                        <iconify-icon icon="mi:delete" width="16"
                                                            height="16"></iconify-icon> Delete Employment
                                                    </button>
                                                </div>
                                                <div class="mb-5">
                                                    <label>Job Title</label>
                                                    <input type="text" class="form-control"
                                                        name="employments[{{ $loop->index }}][job_title]"
                                                        value="{{ $employment->job_title }}" placeholder="Job Title">
                                                </div>
                                                
                                                <div class="row">
                                                    <div class="mb-5 col-lg-6">
                                                        <label>Company Name</label>
                                                        <input type="text" class="form-control"
                                                            name="employments[{{ $loop->index }}][company_name]"
                                                            value="{{ $employment->company_name }}"
                                                            placeholder="Company Name">
                                                    </div>

                                                    <div class="mb-5 col-lg-6">
                                                        <label>Company Location</label>
                                                        <input type="text" class="form-control"
                                                            name="employments[{{ $loop->index }}][location]"
                                                            value="{{ $employment->location }}"
                                                            placeholder="Company Location">
                                                    </div>
                                                  
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label>Start Date</label>
                                                        <input type="date" class="form-control"
                                                            name="employments[{{ $loop->index }}][start_date]"
                                                            value="{{ $employment->start_date }}">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>End Date</label>
                                                        <input type="date" class="form-control"
                                                            name="employments[{{ $loop->index }}][end_date]"
                                                            value="{{ $employment->end_date }}"
                                                            @if ($employment->start_date && $employment->end_date == '1970-01-01') disabled @endif>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Years of Work</label>
                                                        <input type="number" class="form-control"
                                                            name="employments[{{ $loop->index }}][year_of_work]"
                                                            value="{{ $employment->year_of_work }}" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-check mt-5">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="employments[{{ $loop->index }}][current_workplace]"
                                                        @if ($employment->end_date == '1970-01-01') checked @endif>
                                                    <label class="form-check-label"> Yes, I currently work here</label>
                                                </div>
                                                <div class="mb-5 mt-5">
                                                    <label>Soft skills involved</label>
                                                    <select class="form-select"
                                                        name="employments[{{ $loop->index }}][job_skills][]"
                                                        data-control="select2" data-close-on-select="false"
                                                        data-placeholder="Select an option" data-allow-clear="true"
                                                        multiple="multiple">
                                                        @foreach ($genericSkills as $genericSkill)
                                                            <option value="{{ $genericSkill->id }}"
                                                                @if (in_array($genericSkill->id, $selected_job_skills ?? '')) selected @endif>
                                                                {{ $genericSkill->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-5">
                                                    <label>Technical skills involved</label>
                                                    <select multiple class="items-select form-control select2-ajax"
                                                        name="employments[{{ $loop->index }}][job_technical_skills][]"
                                                        data-control="select2" data-hide-search="false">
                                                        <option value="">Select Your Technical Skills</option>
                                                    </select>
                                                </div>
                                                <div class="row mb-5">
                                                    <div class="col-md-6">
                                                        <label>Certificate of Employment</label>
                                                        <input type="file" class="form-control"
                                                            name="employments[{{ $loop->index }}][certificate_of_employment]"
                                                            accept="application/pdf">
                                                        @if (isset($employment->certificate_of_employment))
                                                            <a href="{{ asset($employment->certificate_of_employment) }}"
                                                                target="_blank">Uploaded Certificate</a>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>Clearance Certificate</label>
                                                        <input type="file" class="form-control"
                                                            name="employments[{{ $loop->index }}][clearance_certificate]"
                                                            accept="application/pdf">
                                                        @if (isset($employment->clearance_certificate))
                                                            <a href="{{ asset($employment->clearance_certificate) }}"
                                                                target="_blank">Uploaded Certificate</a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <p id="employment_not_found">No employment history found. Add new employment
                                            details.</p>
                                    @endif
                                </div>
                                <div class="d-flex justify-content-end mt-4">
                                    <button type="button" class="custom-btn btn-grey-outline cursor-pointer"
                                        id="add-employment">+ Add Employment</button>
                                </div>
                                <div class="d-flex justify-content-end gap-2 mt-5 back-btn">
                                    <a href="{{ url('/user/about-me/4') }}"
                                        class="custom-btn btn-orange-outline cursor-pointer">
                                        Back
                                        </a>
                                    <button type="submit" class="custom-btn btn-orange-fill cursor-pointer">Next:
                                        Documents</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="tab-pane fade @if ($step == 'upload-documents') show active @endif"
                        id="upload-documents" role="tabpanel" aria-labelledby="documents-tab" tabindex="0">
                        <div class="top-content">
                            <h3>Upload Documents</h3>
                            <p>Upload your documents</p>
                            <div class="container mt-5">
                                <form class="my-auto pb-5" action="{{ route('user.about.me.store') }}" method="POST"
                                    novalidate="novalidate" enctype="multipart/form-data">

                                    <input type="hidden" name="step" value="6">

                                    @csrf
                                    <h4 class="fw-bolder fs-5" style="color: #4B5675;">Official Documents</h4>
                                    <div class="mb-5">
                                        <label>CV / Resume</label>
                                        <input type="file" class="form-control"
                                            value="{{ auth()->user()->cv_resume ?? old('cv_resume') }}" name="cv_resume"
                                            accept="application/pdf" onchange="checkFileSize(this)"
                                            >
                                        @error('cv_resume')
                                            <div
                                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                <div data-field="cv_resume" data-validator="notEmpty">
                                                    {{ $message }}
                                                </div>
                                            </div>
                                        @enderror
                                        @if (auth()->user()->cv_resume)
                                            <!-- Hidden field for the already uploaded file -->
                                            <input type="hidden" name="existing_cv_resume"
                                                value="{{ auth()->user()->cv_resume ?? '' }}">
                                            <a href="{{ asset(auth()->user()->cv_resume) }}" target="_blank">Uploaded CV
                                                / Resume</a>
                                        @endif
                                        <!--end::CV / Resume-->
                                    </div>
                                    <div class="mb-5">
                                        <label>Education Transcript</label>
                                        <input type="file" class="form-control" 
                                            value="{{ auth()->user()->education_transcript ?? old('education_transcript') }}"
                                            name="education_transcript" accept=".pdf" onchange="checkFileSize(this)">
                                        @error('education_transcript')
                                            <div
                                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                <div data-field="education_transcript" data-validator="notEmpty">
                                                    {{ $message }}
                                                </div>
                                            </div>
                                        @enderror
                                        @if (auth()->user()->education_transcript)
                                            <!-- Hidden field for the already uploaded file -->
                                            <input type="hidden" name="existing_education_transcript"
                                                value="{{ auth()->user()->education_transcript ?? '' }}">
                                            <a href="{{ asset(auth()->user()->education_transcript) }}"
                                                target="_blank">Uploaded Education Transcript</a>
                                        @endif
                                    </div>

                                    <div class="mb-5">
                                        <label>Education Certificate</label>
                                        <input type="file" class="form-control" 
                                            name="education_certificate" accept=".pdf, .jpeg, .jpg, .png"
                                            onchange="checkFileSize(this)"
                                            value="{{ auth()->user()->education_certificate ?? old('education_certificate') }}">

                                        @error('education_certificate')
                                            <div
                                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                <div data-field="education_certificate" data-validator="notEmpty">
                                                    {{ $message }}
                                                </div>
                                            </div>
                                        @enderror
                                        @if (auth()->user()->education_certificate)
                                            <!-- Hidden field for the already uploaded file -->
                                            <input type="hidden" name="existing_education_certificate"
                                                value="{{ auth()->user()->education_certificate ?? '' }}">
                                            <a href="{{ asset(auth()->user()->education_certificate) }}"
                                                target="_blank">Uploaded Education Certificate</a>
                                        @endif
                                        <!--end::Education Certificate-->
                                    </div>
                                    <h4 class="fw-bolder fs-5" style="color: #4B5675;">Additional Documents</h4>
                                    <div id="additional-docs"></div>
                                    <button type="button" id="add-file-button"
                                        class="custom-btn btn-grey-outline cursor-pointer py-3 mt-4">
                                        <span>+ Add File</span>
                                    </button>
                                    <div class="d-flex justify-content-end gap-2 mt-5 back-btn">
                                        <a href="{{ url('/user/about-me/5') }}"
                                        class="custom-btn btn-orange-outline cursor-pointer">
                                        Back
                                        </a>
                                        <button type="submit" class="custom-btn btn-orange-fill cursor-pointer">Sign
                                            Up</button>
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
<!--end::Authentication - Sign-in-->

@section('scripts')

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const navLinks = document.querySelectorAll(".nav-link");

            navLinks.forEach((link) => {
                link.addEventListener("click", function() {
                    document.querySelectorAll(".circle-gray").forEach((span) => {
                        span.classList.remove("active");
                    });
                    const span = this.querySelector(".circle-gray");
                    if (span) {
                        span.classList.add("active");
                    }
                });
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".date-picker").forEach(function(el) {
                flatpickr(el, {
                    dateFormat: "d M Y",
                    defaultDate: el.getAttribute("data-default-date") || null
                });
            });
        });
    </script>

    <script>
        function initializeDatePickers(container) {
            container.querySelectorAll(".date-picker").forEach(function(el) {
                flatpickr(el, {
                    dateFormat: "d M Y",
                    defaultDate: el.getAttribute("data-default-date") || null
                });
            });
        }
    </script>

    {{-- <script>
        $(document).ready(function() {
            $("#add-file-button").click(function() {
                let fileInput = `<div class="mb-5 d-flex align-items-center additional-file gap-4">
                            <input type="file" class="form-control" >
                            <button type="button" class="custom-btn btn-grey-outline cursor-pointer remove-file py-3"><iconify-icon icon="charm:cross" width="16" height="16"></iconify-icon></button>
                        </div>`;
                $("#additional-docs").append(fileInput);
            });

            $(document).on("click", ".remove-file", function() {
                $(this).closest(".additional-file").remove();
            });
        });
    </script> --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const countrySelect = $('select[name="country_id"]');
            const stateSelect = $('select[name="state_id"]');
            const citySelect = $('select[name="city_id"]');

            const userCountryId = {{ auth()->user()->country_id ?? '0' }};
            const userStateId = {{ auth()->user()->state_id ?? '0' }};
            const userCityId = {{ auth()->user()->city_id ?? '0' }};
            console.log(userCountryId, userStateId, userCityId);

            // Initialize Select2 on all selects
            countrySelect.select2();
            stateSelect.select2();
            citySelect.select2();

            // Function to update states dropdown
            function updateStates(countryId) {
                fetch(`/get-states?country_id=${countryId}`)
                    .then(response => response.json())
                    .then(data => {
                        let options = data.states.map(state =>
                            `<option value="${state.id}" ${state.id == userStateId ? 'selected' : ''}>${state.name}</option>`
                        ).join('');
                        stateSelect.html(options).trigger(
                            'change.select2'); // Update Select2 after updating options
                        updateCities(stateSelect.val()); // Automatically update cities for the selected state
                    });
            }

            // Function to update cities dropdown
            function updateCities(stateId) {
                console.log(stateId);
                fetch(`/get-cities?state_id=${stateId}`)
                    .then(response => response.json())
                    .then(data => {
                        let options = data.cities.map(city =>
                            `<option value="${city.id}" ${city.id == userCityId ? 'selected' : ''}>${city.name}</option>`
                        ).join('');
                        citySelect.html(options).trigger(
                            'change.select2'); // Update Select2 after updating options
                    });
            }

            // Event listener for country change
            countrySelect.on('change', function() {
                updateStates(this.value);
            });

            // Event listener for state change
            stateSelect.on('change', function() {
                updateCities(this.value);
            });

            // Initialize the states and cities on page load
            if (countrySelect.val()) {
                updateStates(countrySelect.val());
            }
        });
    </script>


    <script>
        function initSelect2(selector, selectedValues) {
            var $select = $(selector);

            // Initialize Select2 with AJAX support
            $select.select2({
                ajax: {
                    url: '/technical-skill/search',
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader('x-api-key',
                            '{{ env('API_KEY') }}'); // Replace with your header key and value
                    },
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: params.term, // search term
                            page: params.page || 1 // you can pass id directly if needed
                        };
                    },
                    processResults: function(data, params) {
                        params.page = params.page || 1;
                        return {
                            results: data.results,
                            pagination: {
                                more: data.pagination.more
                            }
                        };
                    },
                    cache: true
                },
                placeholder: 'Search Your Job Technical Skills',
                minimumInputLength: 1
            });

            // Pre-select values
            if (selectedValues.length > 0) {
                $.ajax({
                    url: '/technical-skill/search',
                    type: 'GET',
                    data: {
                        ids: selectedValues.join(',')
                    },
                    success: function(data) {
                        data.results.forEach(function(item) {
                            var option = new Option(item.text, item.id, true, true);
                            $select.append(option).trigger('change');
                        });
                    }
                });
            }
        }

        $(document).ready(function() {
            // These values are passed from the server
            var selectedValues = @json($selected_job_technical_skills ?? '');
            initSelect2('.items-select', selectedValues);
        });


        function initSelectSoftSkills(selector, selectedValues) {
            var $select = $(selector);

            // Initialize Select2 for soft skills without AJAX
            $select.select2({
                placeholder: 'Select Soft Skills',
                data: [] // No AJAX, just use static data in HTML
            });

            // Pre-select values
            if (selectedValues.length > 0) {
                selectedValues.forEach(function(value) {
                    var option = new Option(value.text, value.id, true, true);
                    $select.append(option).trigger('change');
                });
            }
        }
    </script>



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const workExperienceSelect = document.getElementById('have_work_experience');
            const employmentHistorySkillsDiv = document.getElementById('employment-container');
            console.log('asdfsd', employmentHistorySkillsDiv);

            function toggleEmploymentFields() {
                if (workExperienceSelect.value) {
                    employmentHistorySkillsDiv.style.display = 'block';
                } else {
                    employmentHistorySkillsDiv.style.display = 'none';
                }
            }

            workExperienceSelect.addEventListener('change', toggleEmploymentFields);

            // Initial check
            toggleEmploymentFields();
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let employmentCount = document.querySelectorAll('.employment-entry')
                .length; // Initialize employment count

            function handleCheckboxChange(checkbox, endDateInput) {
                if (checkbox.checked) {
                    endDateInput.disabled = true;
                    endDateInput.value = ''; // Clear end date if current workplace is checked
                } else {
                    endDateInput.disabled = false;
                }
            }

            function validateDatesAndCalculateYearsOfWork() {
                document.querySelectorAll('.employment-entry').forEach((employment, index) => {
                    const startDateInput = employment.querySelector(
                        `[name='employments[${index}][start_date]']`);
                    const endDateInput = employment.querySelector(
                        `[name='employments[${index}][end_date]']`);
                    const yearsOfWorkInput = employment.querySelector(
                        `[name='employments[${index}][year_of_work]']`);
                    const currentWorkplaceCheckbox = employment.querySelector(
                        `[name='employments[${index}][current_workplace]']`);

                    if (currentWorkplaceCheckbox) {
                        handleCheckboxChange(currentWorkplaceCheckbox, endDateInput);
                        currentWorkplaceCheckbox.addEventListener('change', function() {
                            handleCheckboxChange(currentWorkplaceCheckbox, endDateInput);
                            calculateYearsOfWork
                                (); // Recalculate years of work when checkbox changes
                        });
                    }

                    const calculateYearsOfWork = () => {
                        const startDate = startDateInput && startDateInput.value ? new Date(
                            startDateInput.value) : null;
                        let endDate = endDateInput && endDateInput.value ? new Date(endDateInput
                                .value) :
                            new Date(); // Use today's date if end date is not set or if current workplace is checked

                        // Check if the end date is before the start date
                        if (startDate && endDate && startDate > endDate) {
                            alert("End date must be greater than start date.");
                            endDateInput.value = ''; // Clear the invalid end date
                            yearsOfWorkInput.value = ''; // Clear years of work
                            return; // Exit the function to prevent further calculation
                        }

                        if (startDate && endDate && startDate <= endDate) {
                            const millisecondsPerYear = 1000 * 60 * 60 * 24 * 365.25;
                            const yearsOfWork = (endDate - startDate) / millisecondsPerYear;
                            yearsOfWorkInput.value = yearsOfWork.toFixed(2);
                        } else {
                            yearsOfWorkInput.value = ''; // Clear years of work if dates are invalid
                        }
                    };

                    startDateInput.addEventListener('change', calculateYearsOfWork);
                    endDateInput.addEventListener('change', calculateYearsOfWork);

                    calculateYearsOfWork(); // Initial calculation for each employment entry
                });
            }

            document.getElementById('add-employment').addEventListener('click', function() {
                const employmentDiv = document.getElementById('employment-container');
                // const employmentNotFound = document.getElementById('employment_not_found').style.display='none';
                const index =
                    employmentCount++; // Use the current count as the index for the new employment form

                const newEmploymentHtml = `
                            <div class="mb-4 employment-entry">
                                <div class="d-flex justify-content-end my-5">
                                                    <button type="button" class="custom-btn btn-grey-outline cursor-pointer remove-employment py-4">
                                                        <iconify-icon icon="mi:delete" width="16" height="16"></iconify-icon> Delete Employment
                                                    </button>
                                                </div>
                                <div class=" mb-8">
                                    <label for="job_title_${index}" class="form-label">Job Title</label>
                                    <input id="job_title_${index}" type="text" class="form-control" name="employments[${index}][job_title]" placeholder="Job Title">
                                </div>
                                <div class="mb-8">
                                    <label for="company_name_${index}" class="form-label">Company Name</label>
                                    <input id="company_name_${index}" type="text" class="form-control" name="employments[${index}][company_name]" placeholder="Company Name">
                                </div>
                                <div class="row">

                                    <div class="col-md-4 mb-8">
                                        <label for="start_date_${index}" class="form-label">Start Date</label>
                                        <input id="start_date_${index}" type="date" class="form-control" name="employments[${index}][start_date]">
                                    </div>
                                    <div class="col-md-4 mb-8">
                                        <label for="end_date_${index}" class="form-label">End Date</label>
                                        <input id="end_date_${index}" type="date" class="form-control" name="employments[${index}][end_date]">
                                    </div>
                                    <div class="col-md-4 mb-8">
                                        <label for="year_of_work_${index}" class="form-label">Years of Work</label>
                                        <input id="year_of_work_${index}" type="text" class="form-control" name="employments[${index}][year_of_work]" readonly>
                                    </div>
                                </div>
                               <div class="form-check mb-5">
                                            <input class="form-check-input w-auto" type="checkbox"
                                                style="height: 20px; padding: 9px;" name="employments[${index}][current_working]">
                                            <label class="form-check-label"> Yes, I currently work here</label>
                                </div>

                                   <div class="mb-5 mt-5">
                                    <label>Soft skills involved</label>
                                    <select class="form-select" name="employments[${index}][job_skills][]"
                                        data-control="select2" data-close-on-select="false"
                                        data-placeholder="Select an option" data-allow-clear="true"
                                        multiple="multiple" id="job_skills_${index}">
                                        @foreach ($genericSkills as $genericSkill)
                                            <option value="{{ $genericSkill->id }}">
                                                {{ $genericSkill->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                    <div class="mb-5">
                                        <label>Technical skills involved</label>
                                        <select multiple class="items-select form-control select2-ajax"
                                            name="employments[${index}][job_technical_skills][]" data-control="select2"
                                            data-hide-search="false" id="job_technical_skills_${index}">
                                            <option value="">Select technical skills involved</option>
                                        </select>
                                    </div>
                                <div class="row">
                                
                                <div class="col-lg-6 mb-8">
                                
                                    <label for="certificate_of_employment${index}" class=" fs-5 fw-semibold mb-2">Certificate of Employment</label>
                                    
                                    <input type="file" id="certificate_of_employment${index}"  class="form-control" accept="application/pdf"
                                        placeholder="Upload PDF" onchange="checkFileSize(this)" name="employments[${index}][certificate_of_employment]" />
                                 
                                </div>
                               
                                <div class="col-lg-6 mb-8">

                                    <label for="clearance_certificate${index}" class=" fs-5 fw-semibold mb-2">Clearance Certificate</label>
                                    
                                    <input id="clearance_certificate${index}" type="file" class="form-control" onchange="checkFileSize(this)"  accept="application/pdf"
                                        placeholder="Upload Cover Letter" name="employments[${index}][clearance_certificate]" />

                                </div>
                                </div>
                                 
                            </div>`;
                employmentDiv.insertAdjacentHTML('beforeend', newEmploymentHtml);

                initSelectSoftSkills(`#job_skills_${index}`,
                    []); // No AJAX for soft skills // Initialize Select2 for job skills field
                initSelect2(`#job_technical_skills_${index}`, []);

                validateDatesAndCalculateYearsOfWork(); // Attach event listeners to the new form
            });



            document.addEventListener('click', function(event) {
                if (event.target.closest('.remove-employment')) {
                    let employmentEntries = document.querySelectorAll('.employment-entry');
                    event.target.closest('.employment-entry').remove();
                    if (employmentEntries.length <= 0) {
                        document.getElementById('employment_not_found').style.display = 'block';
                    } else {
                        document.getElementById('employment_not_found').style.display = 'none';
                    }
                }
            });

            validateDatesAndCalculateYearsOfWork(); // Initial setup to bind events and perform calculations
        });
    </script>
    <script>
        function checkFileSize(input) {
            if (input.files && input.files[0]) {
                const fileSize = input.files[0].size / 1024 / 1024; // in MB
                if (fileSize > 2) {
                    alert("File size exceeds 2MB. Please select a smaller file.");
                    input.value = ''; // Clear the file input
                }
            }
        }
    </script>

    <script>
        $(document).ready(function() {
            $('select[name="job_preferred_locations[]"]').select2({
                ajax: {
                    url: '/get-cities', // Your endpoint here
                    dataType: 'json',
                    delay: 250, // Wait 250ms before triggering the request
                    data: function(params) {
                        return {
                            searchTerm: params.term // search term
                        };
                    },
                    processResults: function(data) {
                        // Transforms the top-level key of the response object from 'items' to 'results'
                        return {
                            results: data.cities.map(city => ({
                                id: city.id, // Assuming your JSON contains 'id' keys
                                text: city.name // Assuming your JSON contains 'text' keys
                            }))
                        };
                    },
                    cache: true
                },
                placeholder: 'Search for a location',
                minimumInputLength: 1, // User must type at least 1 character
                allowClear: true,
                closeOnSelect: false
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#add-file-button').click(function() {
                addFileInput();
            });

            function addFileInput(file = {}) {
                var fileInputDiv = $('<div>', {
                    class: 'file-input-group row file_input_row'
                });

                var fileInput = $('<input>', {
                    type: 'file',
                    name: 'education_certificates[]',
                    accept: '.pdf, .jpeg, .jpg, .png',
                    placeholder: 'Upload Education Certificate',
                    class: 'form-control bg-transparent',
                    change: function() {
                        checkFileSize(this);
                    }
                });

                var nameInput = $('<input>', {
                    type: 'text',
                    name: 'file_names[]',
                    placeholder: 'Enter file name',
                    class: 'form-control bg-transparent',
                    value: file.file_name || ''
                });

                if (file.file_path) {
                    var existing_doc = $('<a>', {
                        href: file.file_path,
                        target: '_blank'
                    }).text('Uploaded Document');
                } else {
                    var existing_doc = '';
                }
                var fileIdInput = $('<input>', {
                    type: 'hidden',
                    name: 'file_ids[]',
                    value: file.id || ''
                });
                var filePathInput = $('<input>', {
                    type: 'hidden',
                    name: 'file_paths[]',
                    value: file.file_path || ''
                });
                var removeButton = $('<button>', {
                    type: 'button',
                    class: 'remove-file btn-danger btn',
                });

                var icon = $('<iconify-icon>', {
                    icon: 'iconamoon:trash-light',
                    class: 'iconify-icon fa-1-5'
                });

                removeButton.append(icon);

                fileInputDiv.append(
                    $('<div>', {
                        class: 'fv-row mb-5 fv-plugins-icon-container col-lg-6'
                    }).append(fileInput).append(existing_doc),
                    $('<div>', {
                        class: 'fv-row mb-5 fv-plugins-icon-container col-lg-4'
                    }).append(nameInput),
                    $('<div>', {
                        class: 'fv-row mb-5 fv-plugins-icon-container col-lg-2'
                    }).append(removeButton),
                    fileIdInput, // Add the hidden fileId input field here
                    filePathInput
                );

                $('#additional-docs').append(fileInputDiv);
            };

            function checkFileSize(input) {
                var file = input.files[0];
                if (file.size > 2 * 1024 * 1024) { // 2 MB
                    alert('File size must be less than 2 MB');
                    input.value = '';
                }
            }

            $('#additional-docs').on('click', '.remove-file', function() {
                var fileId = $(this).closest('.file_input_row').find('input[name="file_ids[]"]').val();
                console.log(fileId);
                if (fileId) {
                    $('#additional-docs').append(
                        '<input type="hidden" name="deleted_file_ids[]" value="' + fileId + '">');
                }
                $(this).closest('.file_input_row').remove();
            });

            // Prepopulate existing files
            @php $files = auth()->user()->userDocuments; @endphp

            @if (!empty($files))
                @foreach ($files as $file)

                    addFileInput({
                        id: '{{ $file->id }}',
                        file_name: '{{ $file->file_name }}',
                        file_path: '{{ asset($file->file_path) }}'
                    });
                @endforeach
            @endif
        });
    </script>
    <script>
        $(document).ready(function() {
            let userCountryId = "{{ auth()->user()->national_id ?? '' }}"; // Get user's country ID

            $.ajax({
                url: "{{ route('auth.about.me.get.countries') }}",
                type: "GET",
                dataType: "json",
                success: function(response) {
                    if (response.countries) {
                        let nationalityDropdown = $("#nationality");
                        nationalityDropdown.empty(); // Clear existing options
                        nationalityDropdown.append(
                            '<option value="">Select a Country</option>'); // Default option

                        $.each(response.countries, function(key, country) {
                            let isSelected = (country.id == userCountryId) ? "selected" : "";
                            nationalityDropdown.append(
                                `<option value="${country.id}" ${isSelected}>${country.name}</option>`
                            );
                        });

                        // If using Select2, reinitialize it
                        nationalityDropdown.select2();
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching countries:", error);
                }
            });
        });
    </script>


@endsection
