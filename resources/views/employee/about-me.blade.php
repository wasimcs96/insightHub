@extends('employee.layout.app')

@section('title', 'About Me')
@section('styles')
    <style>
        .error {
            color: red !important;
        }
    </style>
@endsection
@section('content')

    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">

        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">



            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                    Dashboard
                </h1>
                <!--end::Title-->


                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="/dashboard" class="text-muted text-hover-primary">
                            @if (auth()->user()->isEmployee())
                                Employee
                            @else
                                Candidate
                            @endif
                        </a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->

                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        About Me </li>
                    <!--end::Item-->

                </ul>
                <!--end::Breadcrumb-->
            </div>


            <!--end::Page title-->

            <!--end::Actions-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <!--end::Toolbar-->
    <div id="kt_app_content" class="app-content  flex-column-fluid ">
        <div id="kt_app_content_container" class="app-container  ">
            <div id="content_layout">

                @if ($errors->any())
                    <div class="alert alert-danger mb-5">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }} <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close" style="float: right;">X</button></li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session('success'))
                    <!-- Check if there's a success message in the session -->
                    <div class="alert alert-success mb-5"> <!-- Display a success alert -->
                        {{ session('success') }} <!-- Display the success message -->
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"
                            style="float: right;">X</button>
                    </div>
                @endif


                <div class="card">
                    <header class="card-header">
                        <h4 class="card-title">About Me</h4>
                    </header>
                    <div class="card-body flex flex-col p-6">

                        <div class="card-text h-full space-y-4">
                            <form action="{{ route('employee.about.me.store') }}" id="job_description_form" method="POST">
                                @csrf
                                <h5 class="mt-4 mb-4">Personal Details</h5>
                                <div class="row mb-5">
                                    <div class="input-area col-xl-3">
                                        <label for="suffix" class="form-label">Suffix</label>
                                        <input id="suffix" type="text" class="form-control" name="suffix"
                                            placeholder="Enter Suffix ex:Sr." value="{{ auth()->user()->suffix ?? '' }}"hc
                                            b>
                                        @error('suffix')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="input-area col-xl-3">
                                        <label for="first_name" class="required form-label">First Name</label>
                                        <input id="first_name" type="text" class="form-control" disabled
                                            name="first_name" placeholder="First Name"
                                            value="{{ auth()->user()->first_name ?? '' }}" required>
                                        @error('first_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="input-area col-xl-3">
                                        <label for="middle_name" class="form-label">Middle Name</label>
                                        <input id="middle_name" type="text" class="form-control" disabled
                                            name="middle_name" placeholder="Middle Name"
                                            value="{{ auth()->user()->middle_name ?? '' }}" required>
                                        @error('middle_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="input-area col-xl-3">
                                        <label for="last_name" class="required form-label">Last Name</label>
                                        <input id="last_name" type="text" class="form-control" disabled name="last_name"
                                            placeholder="Last Name" value="{{ auth()->user()->last_name ?? '' }}" required>
                                        @error('last_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>



                                </div>

                                <div class="row mb-5">
                                    <div class="input-area col-xl-6">
                                        <label for="email" class="required form-label">Email</label>
                                        <input id="email" type="email" class="form-control" disabled name="email"
                                            placeholder="Email" value="{{ auth()->user()->email ?? '' }}" required>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="input-area col-xl-6">
                                        <label for="select" class="form-label">Civil Status</label>
                                        <select id="marital_status" class="form-control" name="marital_status">
                                            <option value="">Select Civil Status</option>
                                            @foreach (config('constants.MARITAL_STATUSES') as $key => $ms)
                                                <option value="{{ $key }}"
                                                    @if (auth()->user()->marital_status == $key) Selected @endif>{{ $ms }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('marital_status')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="row mb-5 ">
                                    <div class="input-area col-xl-3">
                                        <label for="mobile_number" class="form-label">Mobile Number</label>
                                        <input id="mobile_number" type="number" class="form-control"
                                            name="mobile_number" placeholder="Mobile Number"
                                            value="{{ auth()->user()->mobile_number ?? '' }}">
                                        @error('mobile_number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="input-area col-xl-3">
                                        <label for="birth_date" class="form-label">DOB</label>
                                        <input id="birth_date" type="date" class="form-control" name="birth_date"
                                            placeholder="Birth Date" value="{{ auth()->user()->birth_date ?? '' }}">
                                        @error('birth_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="input-area col-xl-3">
                                        <label for="age" class="form-label">Age</label>
                                        <input id="age" type="number" class="form-control" name="age"
                                            placeholder="Age" value="{{ auth()->user()->age ?? '' }}">
                                        @error('age')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="input-area col-xl-3">
                                        <label for="select" class="required form-label">Select Gender</label>
                                        <select id="gender" class="form-control" name="gender">
                                            <option value="0" {{ auth()->user()->gender == '0' ? 'selected' : '' }}>
                                                Male</option>
                                            <option value="1" {{ auth()->user()->gender == '1' ? 'selected' : '' }}>
                                                Female</option>
                                        </select>
                                        @error('gender')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                </div>

                                <div class="row mb-5 ">
                                    <div class="input-area col-xl-3">
                                        <label for="select" class="required form-label">Select Nationality</label>
                                        @php $master_country = App\Models\MasterCountry::get(); @endphp
                                        <select id="national_id" class="form-control" name="national_id" required>
                                            <option value="">Select Nationality</option>
                                            @foreach ($master_country as $mc)
                                                <option value="{{ $mc->id }}"
                                                    {{ auth()->user()->national_id == $mc->id ? 'selected' : '' }}>
                                                    {{ $mc->name ?? '' }}</option>
                                            @endforeach
                                        </select>
                                        @error('national_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    {{-- <div class="input-area col-xl-3">
                                        <label for="national_id" class="form-label">National Id</label>
                                        <input id="national_id" type="text" class="form-control" name="national_id"
                                            placeholder="National Id" value="{{ auth()->user()->national_id ?? '' }}">
                                        @error('national_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div> --}}

                                    <div class="input-area col-xl-3">
                                        <label for="passport_no" class="form-label">Passport No</label>
                                        <input id="passport_no" type="text" class="form-control" name="passport_no"
                                            placeholder="Passport No" value="{{ auth()->user()->passport_no ?? '' }}">
                                        @error('passport_no')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="input-area col-xl-3">
                                        <label for="passport_expiry_date" class="form-label">Passport Expiry
                                            Date</label>
                                        <input id="passport_expiry_date" type="date" class="form-control"
                                            name="passport_expiry_date"
                                            value="{{ auth()->user()->passport_expiry_date ?? '' }}"
                                            placeholder="Passport Expiry Date">
                                        @error('passport_expiry_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                </div>
                                @php

                                    $userItSkills = [];
                                    foreach (auth()->user()->it_skills as $user_it_skill) {
                                        $userItSkills[] = $user_it_skill->it_skill_id;
                                    }

                                @endphp

                               

                                <h5 class="mt-4 mb-0 pt-4">Home Address</h5>
                                <div class="row mb-5 pt-2">
                                    <div class="input-area col-xl-3">
                                        <label for="home_address" class="form-label">House/Building Number and Street
                                            Name</label>
                                        <input id="home_address" type="text" class="form-control" name="home_address"
                                            placeholder="Home Address" value="{{ auth()->user()->home_address ?? '' }}">
                                        @error('home_address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="input-area col-xl-3">
                                        <label for="sub_division" class="form-label">Barangay/Subdivision</label>
                                        <select id="sub_division" class="form-control select2-ajax" name="barangay_id"
                                            data-control="select2" data-hide-search="false">
                                            <option value="">Select Barangay/Subdivision</option>

                                            {{-- @foreach ($barangays as $barangay)
                                                <option value="{{ $barangay->id ?? '' }}"
                                                    {{ auth()->user()->barangay_id == $barangay->id ? 'selected' : '' }}>
                                                    {{ $barangay->name ?? '' }}</option>
                                            @endforeach --}}
                                        </select>

                                        @error('sub_division')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="input-area col-xl-2">
                                        <label for="city" class="form-label">Select City</label>
                                        <select id="city" class="form-control" name="city_id"
                                            data-control="select2" data-hide-search="false">
                                            <option value="">Select City</option>
                                            {{-- @foreach ($cities as $city)
                                                <option value="{{ $city->id ?? '' }}"
                                                    {{ auth()->user()->city_id == $city->id ? 'selected' : '' }}>
                                                    {{ $city->name ?? '' }}</option>
                                            @endforeach --}}
                                        </select>

                                        @error('city_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="input-area col-xl-2">
                                        <label for="province" class="form-label">Select Province</label>
                                        <select id="province" class="form-control" name="province_id"
                                            data-control="select2" data-hide-search="false">
                                            <option value="">Select Province</option>

                                            @foreach ($provinces as $province)
                                                <option value="{{ $province->id ?? '' }}"
                                                    {{ auth()->user()->province_id == $province->id ? 'selected' : '' }}>
                                                    {{ $province->name ?? '' }}</option>
                                            @endforeach
                                        </select>

                                        @error('province')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="input-area col-xl-2">
                                        <label for="postal_code" class="form-label">Postal Code</label>
                                        <input id="postal_code" type="number" class="form-control" name="postal_code"
                                            placeholder="Enter Postal Code"
                                            value="{{ auth()->user()->postal_code ?? '' }}">
                                        @error('postal_code')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="sameAsHomeAddress">
                                    <label class="form-check-label" for="sameAsHomeAddress">
                                        Mailing address same as home address
                                    </label>
                                </div>
                                <h5 class="mt-4 mb-0 pt-4">Mailing Address</h5>
                                <div class="row mb-5 pt-2">
                                    <div class="input-area col-xl-3">
                                        <label for="mailing_address" class="form-label">House/Building Number and Street
                                            Name</label>
                                        <input id="mailing_address" type="text" class="form-control"
                                            name="mailing_address" placeholder="Home Address"
                                            value="{{ auth()->user()->mailing_address ?? '' }}">
                                        @error('mailing_address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="input-area col-xl-3">
                                        <label for="mailing_sub_division" class="form-label">Barangay/Subdivision</label>
                                        <select id="mailing_sub_division" class="form-control select2-ajax"
                                            name="mailing_barangay_id" data-control="select2" data-hide-search="false">
                                            <option value="">Select Barangay/Subdivision</option>

                                            {{-- @foreach ($barangays as $barangay)
                                                <option value="{{ $barangay->id ?? '' }}"
                                                    {{ auth()->user()->mailing_barangay_id == $barangay->id ? 'selected' : '' }}>
                                                    {{ $barangay->name ?? '' }}</option>
                                            @endforeach --}}
                                        </select>

                                        @error('mailing_sub_division')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="input-area col-xl-2">
                                        <label for="mailing_city" class="form-label">Select City</label>
                                        <select id="mailing_city" class="form-control" name="mailing_city_id"
                                            data-control="select2" data-hide-search="false">
                                            <option value="">Select City</option>

                                            {{-- @foreach ($cities as $city)
                                                <option value="{{ $city->id ?? '' }}"
                                                    {{ auth()->user()->mailing_city_id == $city->id ? 'selected' : '' }}>
                                                    {{ $city->name ?? '' }}</option>
                                            @endforeach --}}
                                        </select>

                                        @error('mailing_city_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="input-area col-xl-2">
                                        <label for="mailing_province" class="form-label">Select Province</label>
                                        <select id="mailing_province" class="form-control" name="mailing_province_id"
                                            data-control="select2" data-hide-search="false">
                                            <option value="">Select Province</option>

                                            @foreach ($provinces as $province)
                                                <option value="{{ $province->id ?? '' }}"
                                                    {{ auth()->user()->mailing_province_id == $province->id ? 'selected' : '' }}>
                                                    {{ $province->name ?? '' }}</option>
                                            @endforeach
                                        </select>

                                        @error('province')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    
                                    
                                    <div class="input-area col-xl-2">
                                        <label for="mailing_postal_code" class="form-label">Postal Code</label>
                                        <input id="mailing_postal_code" type="number" class="form-control"
                                            name="mailing_postal_code" placeholder="Enter Postal Code"
                                            value="{{ auth()->user()->mailing_postal_code ?? '' }}">
                                        @error('mailing_postal_code')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                </div>

                                <h5 class="mt-4 mb-0 pt-4">Government Identification</h5>
                                <div class="row mb-5 pt-2">
                                    <div class="input-area col-xl-3">
                                        <label for="tin_number" class="form-label">Tax Identification Number
                                            (TIN)​</label>
                                        <input id="tin_number" type="text" class="form-control" name="tin_number"
                                            placeholder="Enter TIN Number"
                                            value="{{ auth()->user()->tin_number ?? '' }}">
                                        @error('tin_number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="input-area col-xl-3">
                                        <label for="sss_number" class="form-label">Social Security System (SSS)
                                            Number​​</label>
                                        <input id="sss_number" type="text" class="form-control" name="sss_number"
                                            placeholder="Enter SSS Number"
                                            value="{{ auth()->user()->sss_number ?? '' }}">
                                        @error('sss_number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="input-area col-xl-3">
                                        <label for="hdmf_number" class="form-label">Pag-IBIG Fund (HDMF) Number​​</label>
                                        <input id="hdmf_number" type="text" class="form-control" name="hdmf_number"
                                            placeholder="Enter HDMF Number"
                                            value="{{ auth()->user()->hdmf_number ?? '' }}">
                                        @error('hdmf_number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="input-area col-xl-3">
                                        <label for="phil_number" class="form-label">PhilHealth Number​​</label>
                                        <input id="phil_number" type="text" class="form-control" name="phil_number"
                                            placeholder="Enter PhilHealth Number"
                                            value="{{ auth()->user()->phil_number ?? '' }}">
                                        @error('phil_number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>



                                </div>

                                <h5 class="mt-5 mb-2">Skills and Certifications <br> <span class=" fs-6 fw-medium text-danger"> After each entry press "Enter" to create new input</span></h5>
                                <div class="row ">
                                    <div class="input-area col-lg-4">

                                        <div class="mb-5">
                                            <label class="form-label">Relevant Skills​</label>
                                            <input class="form-control " value="{{ auth()->user()->skills ?? '' }}"
                                                name="skills" id="kt_tagify_1" />
                                        </div>
                                    </div>

                                    <div class="input-area col-lg-4">
                                        <div class="mb-5">
                                            <label class="form-label">Professional Certifications</label>
                                            <input class="form-control "
                                                value="{{ auth()->user()->professional_certificate ?? '' }}"
                                                name="professional_certificate" id="kt_tagify_2" />
                                        </div>
                                    </div>

                                    <div class="input-area col-lg-4">
                                        <div class="mb-5">
                                            <label class="form-label">Training Programs Attended​</label>
                                            <input class="form-control "
                                                value="{{ auth()->user()->training_program ?? '' }}"
                                                name="training_program" id="kt_tagify_3" />
                                        </div>
                                        <div id="message" style="display: none; color: red;">You can only select up to 5
                                            options.</div>
                                    </div>

                                </div>



                                <h5 class="mt-4 mb-4">Educational Background</h5>
                                <div class="row mb-5 pb-4">
                                    <div class="input-area col-xl-3">
                                        <label for="select" class="required form-label">Select Education Level</label>
                                        <select id="education_level" class="form-control" name="education_level">
                                            @foreach ($education_levels as $education_level)
                                                <option value="{{ $education_level->id }}" class="dark:bg-slate-700"
                                                    {{ auth()->user()->education_level == $education_level->id ? 'selected' : '' }}>
                                                    {{ $education_level->name ?? '' }}</option>
                                            @endforeach
                                        </select>
                                        @error('education_level')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="input-area col-xl-3">
                                        <label for="select" class="required form-label">Select Higher Learning
                                            Institution</label>
                                        <select id="higher_learning_institution" class="form-control"
                                            name="higher_learning_institution" data-control="select2"
                                            data-hide-search="false" required>
                                            @foreach ($higher_learning_institutions as $higher_learning_institution)
                                                <option value="{{ $higher_learning_institution->id }}"
                                                    class="dark:bg-slate-700"
                                                    {{ auth()->user()->higher_learning_institution == $higher_learning_institution->id ? 'selected' : '' }}>
                                                    {{ $higher_learning_institution->name ?? '' }}</option>
                                            @endforeach
                                        </select>
                                        @error('higher_learning_institution')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="input-area col-xl-3">
                                        <label for="select" class="required form-label">Select Course/Program</label>
                                        <select id="scope_of_study" class="form-control" name="education_program_id">
                                            @foreach ($edu_program as $scope_of_study)
                                                <option value="{{ $scope_of_study->id }}" class="dark:bg-slate-700"
                                                    {{ auth()->user()->education_program_id == $scope_of_study->id ? 'selected' : '' }}>
                                                    {{ $scope_of_study->name ?? '' }}</option>
                                            @endforeach
                                        </select>
                                        @error('scope_of_study')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    {{-- <div class="input-area col-xl-3">
                                        <label for="course_name" class="form-label">Course/Program*</label>
                                        <input id="course_name" type="text" class="form-control" name="course_name"
                                            placeholder="Enter Course name"
                                            value="{{ auth()->user()->course_name ?? '' }}" required>
                                        @error('course_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div> --}}

                                    <div class="input-area col-xl-3">
                                        <label for="graduate_year" class="required form-label">Year of Graduation</label>
                                        <input id="graduate_year" type="number" class="form-control"
                                            name="graduate_year" placeholder="Enter Year of Graduated"
                                            value="{{ auth()->user()->graduate_year ?? '' }}" required>
                                        @error('graduate_year')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>


                                </div>

                                <h5 class="mt-4 mb-4">Experience</h5>
                                <div class="row mb-5 pb-4">

                                    <div class="input-area col-xl-4">
                                        <label for="select" class="form-label">Do you have work experience in
                                            industry</label>
                                        <select id="do_you_have_experience_in_it_sector" class="form-control"
                                            name="do_you_have_experience_in_it_sector">
                                            <option value="0"
                                                {{ auth()->user()->do_you_have_experience_in_it_sector == '0' ? 'selected' : '' }}>
                                                No</option>
                                            <option value="1"
                                                {{ auth()->user()->do_you_have_experience_in_it_sector == '1' ? 'selected' : '' }}>
                                                Yes</option>
                                        </select>
                                        @error('do_you_have_experience_in_it_sector')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="input-area col-xl-4">
                                        <label for="year_of_experience_in_it_sector" class="form-label">Year(s) of
                                            experience in industry</label>
                                        <input id="year_of_experience_in_it_sector" type="number" class="form-control"
                                            name="year_of_experience_in_it_sector"
                                            placeholder="Year Of Experience In IT Sector"
                                            value="{{ auth()->user()->year_of_experience_in_it_sector ?? 0 }}">
                                        @error('year_of_experience_in_it_sector')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="input-area col-xl-4">
                                        <label for="select" class="form-label">Current Sector Of Work</label>

                                        <select id="sector" class="form-control" name="sector_id">
                                            <option value="" class="dark:bg-slate-700">Select Sector</option>
                                            @foreach ($sectors as $sector)
                                                <option value="{{ $sector->id }}" class="dark:bg-slate-700"
                                                    {{ auth()->user()->sector_id == $sector->id ? 'selected' : '' }}>
                                                    {{ $sector->name ?? '' }}</option>
                                            @endforeach
                                        </select>
                                        @error('sector')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                </div>
                                <h5 class="mt-4 mb-4">Work Experience</h5>
                                <div id="employment_div">
                                    @if (auth()->user()->employments()->count() > 0)
                                        @foreach (auth()->user()->employments as $employment)
                                            <div class="row justify-content-end work_Exp">
                                                <div class="input-area col-lg-2">
                                                    <label for="job_title_{{ $loop->index }}" class="form-label">Job
                                                        Title</label>
                                                    <input id="job_title_{{ $loop->index }}" type="text"
                                                        class="form-control"
                                                        name="employments[{{ $loop->index }}][job_title]"
                                                        value="{{ $employment->job_title }}" placeholder="Job Title">
                                                </div>
                                                <div class="input-area col-lg-2">
                                                    <label for="company_name_{{ $loop->index }}"
                                                        class="form-label">Company Name</label>
                                                    <input id="company_name_{{ $loop->index }}" type="text"
                                                        class="form-control"
                                                        name="employments[{{ $loop->index }}][company_name]"
                                                        value="{{ $employment->company_name }}"
                                                        placeholder="Company Name">
                                                </div>
                                                <div class="input-area col-lg-2">
                                                    <label for="start_date_{{ $loop->index }}" class="form-label">Start
                                                        Date</label>
                                                    <input id="start_date_{{ $loop->index }}" type="date"
                                                        class="form-control"
                                                        name="employments[{{ $loop->index }}][start_date]"
                                                        value="{{ $employment->start_date }}">
                                                </div>
                                                <div class="input-area col-lg-2">
                                                    <label for="end_date_{{ $loop->index }}" class="form-label">End
                                                        Date</label>
                                                    <input id="end_date_{{ $loop->index }}" type="date"
                                                        class="form-control"
                                                        name="employments[{{ $loop->index }}][end_date]"
                                                        value="{{ $employment->end_date }}"
                                                        @if ($employment->start_date && $employment->start_date != '0000-00-00' && $employment->end_date == '0000-00-00') disabled @endif>
                                                </div>
                                                <div class="input-area col-lg-2">
                                                    <label for="year_of_work_{{ $loop->index }}"
                                                        class="form-label">Years of Work</label>
                                                    <input id="year_of_work_{{ $loop->index }}" type="text"
                                                        class="form-control"
                                                        name="employments[{{ $loop->index }}][year_of_work]"
                                                        value="{{ $employment->year_of_work }}" readonly>
                                                </div>

                                                <div class="input-area col-lg-2">
                                                    <label for="key_responsiblity_{{ $loop->index }}"
                                                        class="form-label">Key Responsibilities</label>
                                                    <textarea id="key_responsiblity_{{ $loop->index }}" type="checkbox" class="form-control"
                                                        name="employments[{{ $loop->index }}][key_responsiblity]">{{ $employment->key_responsiblity }}</textarea>
                                                </div>
                                                @if ($loop->index < 1)
                                                    <div class="checkbox-area col-lg-2">
                                                        <label for="current_workplace_{{ $loop->index }}"
                                                            class="form-label">Current Workplace</label>
                                                        {{-- <input id="current_workplace_{{$loop->index}}" type="checkbox" class="form-control" name="employments[{{$loop->index}}][current_workplace]"> --}}
                                                        <div class="checkbox-area mt-2">
                                                            <label for="current_workplace_{{ $loop->index }}"
                                                                class="inline-flex items-center cursor-pointer">
                                                                <input type="checkbox"
                                                                    id="current_workplace_{{ $loop->index }}"
                                                                    type="checkbox" class="hidden"
                                                                    name="employments[{{ $loop->index }}][current_workplace]"
                                                                    name="checkbox"
                                                                    @if ($employment->start_date && $employment->start_date != '0000-00-00' && $employment->end_date == '0000-00-00') checked @endif>
                                                                <span
                                                                    class="h-4 w-4 border flex-none border-slate-100 dark:border-slate-800 rounded inline-flex ltr:mr-3 rtl:ml-3 relative transition-all duration-150 bg-slate-100 dark:bg-slate-900">
                                                                    <img src="{{ asset('assets/images/icon/ck-white.svg') }}"
                                                                        alt=""
                                                                        class="h-[10px] w-[10px] block m-auto opacity-0"></span>
                                                                <span
                                                                    class="text-slate-500 dark:text-slate-400 text-sm leading-6">Yes</span>
                                                            </label>
                                                        </div>
                                                        <div class="mt-6 col-lg-2">
                                                            <button class="btn btn-danger remove-employment"
                                                                style="padding: 6px 16px 5px 16px;"
                                                                type="button"><iconify-icon
                                                                    icon="heroicons-outline:trash"
                                                                    class="text-2xl"></iconify-icon></button>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="mt-6 col-lg-2">
                                                        <button class="btn btn-danger remove-employment"
                                                            style="padding: 6px 16px 5px 16px;"
                                                            type="button"><iconify-icon icon="heroicons-outline:trash"
                                                                class="text-2xl"></iconify-icon></button>
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="row justify-content-end work_Exp">
                                            <div class="input-area col-lg-2">
                                                <label for="job_title" class="form-label">Job Title</label>
                                                <input id="job_title" type="text" class="form-control"
                                                    name="employments[0][job_title]" placeholder="Job Title">
                                            </div>
                                            <div class="input-area col-lg-2">
                                                <label for="company_name" class="form-label">Company Name</label>
                                                <input id="company_name" type="text" class="form-control"
                                                    name="employments[0][company_name]" placeholder="Company Name">
                                            </div>
                                            <div class="input-area col-lg-2">
                                                <label for="start_date" class="form-label">Start Date</label>
                                                <input id="start_date" type="date" class="form-control"
                                                    name="employments[0][start_date]">
                                            </div>
                                            <div class="input-area col-lg-2">
                                                <label for="end_date" class="form-label">End Date</label>
                                                <input id="end_date" type="date" class="form-control"
                                                    name="employments[0][end_date]">
                                            </div>
                                            <div class="input-area col-lg-2">
                                                <label for="year_of_work" class="form-label">Years of Work</label>
                                                <input id="year_of_work" type="text" class="form-control"
                                                    name="employments[0][year_of_work]" readonly>
                                            </div>

                                            <div class="input-area col-lg-2">
                                                <label for="key_responsiblity" class="form-label">Key
                                                    Responsibilities</label>
                                                <textarea id="key_responsiblity" class="form-control" name="employments[0][key_responsiblity]"></textarea>
                                            </div>

                                            <div class="checkbox-area col-lg-2">
                                                <label for="current_workplace_0" class="form-label">Current
                                                    Workplace</label>
                                                {{-- <input id="current_workplace_0" type="checkbox" class="form-control" name="employments[0][current_workplace]"> --}}
                                                <div class="checkbox-area mt-2">
                                                    <label for="current_workplace_0"
                                                        class="inline-flex items-center cursor-pointer">
                                                        <input type="checkbox" id="current_workplace_0" type="checkbox"
                                                            class="hidden" name="employments[0][current_workplace]"
                                                            name="checkbox">
                                                        <span
                                                            class="h-4 w-4 border flex-none border-slate-100 dark:border-slate-800 rounded inline-flex ltr:mr-3 rtl:ml-3 relative transition-all duration-150 bg-slate-100 dark:bg-slate-900">
                                                            <img src="{{ asset('assets/images/icon/ck-white.svg') }}"
                                                                alt=""
                                                                class="h-[10px] w-[10px] block m-auto opacity-0"></span>
                                                        <span
                                                            class="text-slate-500 dark:text-slate-400 text-sm leading-6">Yes</span>
                                                    </label>
                                                </div>
                                                <div class="mt-6" style="display:flex; justify-content:flex-start">
                                                    <button class="btn btn-danger remove-employment"
                                                        style="padding:7px 16px 7px 16px" type="button"><iconify-icon
                                                            icon="heroicons-outline:trash"
                                                            class="text-2xl"></iconify-icon></button>
                                                </div>
                                            </div>

                                        </div>
                                    @endif
                                </div>

                                <button class="btn inline-flex justify-center btn-light mb-2" type="button"
                                    id="add_employment" style="float: right">Add Employment</button>

                                <h5 class="mt-20 mb-2">Emergency Contact Information</h5>
                                <div class="row w-100">
                                    <div class="input-area col-lg-4">

                                        <div class="mb-5">
                                            <label class="form-label">Name of Emergency Contact Person​</label>
                                            <input class="form-control " type="text"
                                                value="{{ auth()->user()->ec_contact_person_name ?? '' }}"
                                                name="ec_contact_person_name" />
                                            @error('ec_contact_person')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="input-area col-lg-4">
                                        <div class="mb-5">
                                            <label class="form-label">​Relationship to Employee</label>
                                            <select id="ec_relation_employee" class="form-control"
                                                name="ec_relation_employee">
                                                <option value="">Select ​Relationship to Employee</option>
                                                @foreach (config('constants.RELATION_EMPLOYEE') as $key => $ms)
                                                    <option value="{{ $key }}"
                                                        @if (auth()->user()->ec_relation_employee == $key) Selected @endif>
                                                        {{ $ms }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('ec_relation_employee')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="input-area col-lg-4">

                                        <div class="mb-5">
                                            <label class="form-label">Contact Number ​</label>
                                            <input class="form-control" type="number"
                                                value="{{ auth()->user()->ec_contact_person_number ?? '' }}"
                                                name="ec_contact_person_number" />
                                            @error('ec_contact_person_number')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <h5 class="">Address</h5>
                                    <div class="row mb-5 pt-2">
                                        <div class="input-area col-xl-3">
                                            <label for="ec_home_address" class="form-label">House/Building Number and
                                                Street
                                                Name</label>
                                            <input id="ec_home_address" type="text" class="form-control"
                                                name="ec_home_address" placeholder="Home Address"
                                                value="{{ auth()->user()->ec_home_address ?? '' }}">
                                            @error('ec_home_address')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="input-area col-xl-3">
                                            <label for="ec_barangay_id" class="form-label">Barangay/Subdivision</label>
                                            <select id="ec_barangay_id" class="form-control select2-ajax"
                                                name="ec_barangay_id" data-control="select2" data-hide-search="false">
                                                <option value="">Select Barangay/Subdivision</option>

                                                {{-- @foreach ($barangays as $barangay)
                                                    <option value="{{ $barangay->id ?? '' }}"
                                                        {{ auth()->user()->ec_barangay_id == $barangay->id ? 'selected' : '' }}>
                                                        {{ $barangay->name ?? '' }}</option>
                                                @endforeach --}}
                                            </select>

                                            @error('ec_barangay_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="input-area col-xl-2">
                                            <label for="ec_city_id" class="form-label">Select City</label>
                                            <select id="ec_city_id" class="form-control select2-ajax" name="ec_city_id"
                                                data-control="select2" data-hide-search="false">
                                                <option value="">Select City</option>
                                                {{-- @foreach ($cities as $city)
                                                    <option value="{{ $city->id ?? '' }}"
                                                        {{ auth()->user()->ec_city_id == $city->id ? 'selected' : '' }}>
                                                        {{ $city->name ?? '' }}</option>
                                                @endforeach --}}
                                            </select>

                                            @error('ec_city_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="input-area col-xl-2">
                                            <label for="ec_province" class="form-label">Select Province</label>
                                            <select id="ec_province" class="form-control" name="ec_province"
                                                data-control="select2" data-hide-search="false">
                                                <option value="">Select Province</option>

                                                @foreach ($provinces as $province)
                                                    <option value="{{ $province->id ?? '' }}"
                                                        {{ auth()->user()->ec_province == $province->id ? 'selected' : '' }}>
                                                        {{ $province->name ?? '' }}</option>
                                                @endforeach
                                            </select>

                                            @error('ec_province')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="input-area col-xl-2">
                                            <label for="ec_postal_code" class="form-label">Postal Code</label>
                                            <input id="ec_postal_code" type="number" class="form-control"
                                                name="ec_postal_code" placeholder="Enter Postal Code"
                                                value="{{ auth()->user()->ec_postal_code ?? '' }}">
                                            @error('ec_postal_code')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class=" mt-10">
                                        <h5>LEGAL DISCLOSURES AND CONSENT​</h5>
                                        <div class="row m-1 mt-5">

                                            {{-- <div class="form-check mb-3 col-lg-12">

                                                <input class="form-check-input" type="checkbox" name="consent_data"
                                                    id="consent_data">
                                                <label class="form-check-label text-dark fw-bold" for="consent_data">
                                                    Consent for Data Processing and Sharing​
                                                </label>
                                                @error('consent_data')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div> --}}
                                            <div class="accordion" id="kt_accordion_1">
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="kt_accordion_1_header_1">
                                                        <button class="accordion-button fs-4 fw-semibold" type="button"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#kt_accordion_1_body_1" aria-expanded="true"
                                                            aria-controls="kt_accordion_1_body_1">
                                                            <div class="form-check mb-3 col-lg-12">

                                                                <input class="form-check-input" type="checkbox" name="consent_data"
                                                                    id="consent_data">
                                                                <label class="form-check-label text-dark fw-bold" for="consent_data">
                                                                    Consent for Data Processing and Sharing​
                                                                </label>
                                                                @error('consent_data')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </button>
                                                    </h2>
                                                    <div id="kt_accordion_1_body_1"
                                                        class="accordion-collapse collapse show"
                                                        aria-labelledby="kt_accordion_1_header_1"
                                                        data-bs-parent="#kt_accordion_1">
                                                        <div class="accordion-body">
                                                            <p class="fw-bold">1. Acceptance of Terms</p>
                                                            <p>By accessing and using the services provided by CXS Analytics you acknowledge that you have read, understood, and agree to be bound by these terms and any additional guidelines, policies, or rules applicable to specific services.</p>
                                                            <p class="fw-bold"> 2. Data Privacy</p>
                                                            We are committed to protecting your personal data in accordance with the Data Privacy Act of 2012 (Republic Act No. 10173). Your data will be collected, used, and processed solely for the purpose of providing our services and improving user experience. For more information, please refer to our Privacy Policy.
                                                            <p class="fw-bold"> 3. User Responsibilities</p>
                                                            <p> You agree to use our platform for lawful purposes only. You must not:
                                                            Engage in any activity that disrupts or interferes with our services or network.
                                                            Use our platform to store, transmit, or distribute any malicious software or illegal content.
                                                            Violate any applicable local, national, or international law.</p>
                                                            <p class="fw-bold">  4. Intellectual Property</p>
                                                            <p> All content, trademarks, logos, and intellectual property on our platform are owned by CXS Analytics or our licensors. You are granted a limited, non-exclusive license to use the platform in accordance with these terms.</p>
                                                            <p class="fw-bold">  5. Limitation of Liability</p>
                                                            <p> To the maximum extent permitted by law, CXS Analytics shall not be liable for any indirect, incidental, special, consequential, or punitive damages, or any loss of profits or revenues, whether incurred directly or indirectly, or any loss of data, use, goodwill, or other intangible losses resulting from:
                                                            Your use or inability to use the platform.
                                                            Any unauthorized access to or use of our servers.
                                                            Any bugs, viruses, or other harmful code transmitted to or through our platform.</p>
                                                            <p class="fw-bold">  6. Governing Law</p>
                                                            <p>These terms shall be governed by and construed in accordance with the laws of the Philippines. Any disputes arising out of or in connection with these terms shall be subject to the exclusive jurisdiction of the courts in the Philippines.</p>
                                                            <p class="fw-bold">  7. Changes to Terms</p>
                                                            <p>We reserve the right to modify these terms at any time. We will notify you of any changes by posting the new terms on our platform. Your continued use of the platform following the posting of changes constitutes your acceptance of the new terms.</p>
                                                            <p class="fw-bold"> 8. Contact Information</p>
                                                            <p>If you have any questions or concerns about these terms, please contact us at: CXS Analytics, info@cxsanalytics.com</p>
                                                        </div>
                                                    </div>
                                                </div>

                                    
                                            </div>
                                            {{-- <div class="form-check mb-3 col-lg-6">
                                                <input class="form-check-input" type="checkbox" name="company_policy"
                                                    id="company_policy">
                                                <label class="form-check-label text-dark fw-bold" for="company_policy">
                                                    Acknowledgement of Company Policies and Procedures​
                                                </label>
                                                @error('company_policy')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div> --}}


                                        </div>
                                    </div>


                                </div>

                                <div class="mt-12" style="display:flex; justify-content:center">
                                    <button class="btn btn-success text-white me-3">Submit</button>
                                    <a class="btn btn-danger" href="{{ route('employee.dashboard') }}">Back To
                                        Dashboard</a>

                                </div>
                            </form>

                        </div>

                    </div>
                </div>



            </div>
        </div>
    </div>

@endsection

@section('scripts')
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> --}}
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    <script>
        // The DOM elements you wish to replace with Tagify
        var input1 = document.querySelector("#kt_tagify_1");
        var input2 = document.querySelector("#kt_tagify_2");

        var input3 = document.querySelector("#kt_tagify_3");

        // Initialize Tagify components on the above inputs
        new Tagify(input1);
        new Tagify(input2);
        new Tagify(input3);
    </script>
    <script>
        $("#job_description_form").validate({
            errorElement: "span",
            rules: {
                job_desc: {
                    required: true
                },
                tooltip_email: {
                    required: true,
                    email: true
                }
            },
            messages: {
                job_desc: "Please enter your Job Description",
                tooltip_email: {
                    required: "Enter your email",
                    email: "Enter a valid email"
                }
            }
        });
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let employmentCount = document.querySelectorAll('.work_Exp').length; // Initialize employment count

            function handleCheckboxChange(checkbox, endDateInput) {
                if (checkbox.checked) {
                    endDateInput.disabled = true;
                    endDateInput.value = ''; // Clear end date if current workplace is checked
                } else {
                    endDateInput.disabled = false;
                }
            }

            function validateDatesAndCalculateYearsOfWork() {
                document.querySelectorAll('.work_Exp').forEach((employment, index) => {
                    var startDateInput = employment.querySelector(
                        `[name='employments[${index}][start_date]']`);
                    console.log(startDateInput);
                    var endDateInput = employment.querySelector(
                        `[name='employments[${index}][end_date]']`);
                    var yearsOfWorkInput = employment.querySelector(
                        `[name='employments[${index}][year_of_work]']`);
                    var currentWorkplaceCheckbox = employment.querySelector(
                        `[name='employments[${index}][current_workplace]']`);

                    if (currentWorkplaceCheckbox) {
                        handleCheckboxChange(currentWorkplaceCheckbox, endDateInput);
                        currentWorkplaceCheckbox.addEventListener('change', function() {
                            handleCheckboxChange(currentWorkplaceCheckbox, endDateInput);
                            calculateYearsOfWork
                                (); // Recalculate years of work when checkbox changes
                        });
                    }

                    var calculateYearsOfWork = () => {
                        var startDate = startDateInput && startDateInput.value ? new Date(
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

            document.getElementById('add_employment').addEventListener('click', function() {
                const employmentDiv = document.getElementById('employment_div');
                const index =
                    employmentCount++; // Use the current count as the index for the new employment form

                const newEmploymentHtml = `
            <div class="row justify-content-end work_Exp">
        <div class="input-area col-lg-2 mt-5 pt-3">
            <label for="job_title_${index}" class="form-label">Job Title</label>
            <input id="job_title_${index}" type="text" class="form-control" name="employments[${index}][job_title]" placeholder="Job Title">
        </div>
        <div class="input-area col-lg-2 mt-5 pt-3">
            <label for="company_name_${index}" class="form-label">Company Name</label>
            <input id="company_name_${index}" type="text" class="form-control" name="employments[${index}][company_name]" placeholder="Company Name">
        </div>
        <div class="input-area col-lg-2 mt-5 pt-3">
            <label for="start_date_${index}" class="form-label">Start Date</label>
            <input id="start_date_${index}" type="date" class="form-control" name="employments[${index}][start_date]">
        </div>
        <div class="input-area col-lg-2 mt-5 pt-3">
            <label for="end_date_${index}" class="form-label">End Date</label>
            <input id="end_date_${index}" type="date" class="form-control" name="employments[${index}][end_date]">
        </div>
        <div class="input-area col-lg-2 mt-5 pt-3">
            <label for="year_of_work_${index}" class="form-label">Years of Work</label>
            <input id="year_of_work_${index}" type="text" class="form-control" name="employments[${index}][year_of_work]" readonly>
        </div>
        <div class="input-area col-lg-2">
            <label for="key_responsiblity_${index}" class="form-label">Key Responsibilities</label>
            <textarea id="key_responsiblity_${index}" class="form-control" name="employments[${index}][key_responsiblity]"></textarea>
        </div>
        <div class="mt-6 col-lg-2 mt-5 pt-3" style="display:flex; justify-content:flex-start">
            <button class="btn btn-danger remove-employment" style="padding: 6px 16px 5px 16px;" type="button"><iconify-icon icon="heroicons-outline:trash" class="text-2xl"></iconify-icon></button>
        </div>
        </div>`;
                employmentDiv.insertAdjacentHTML('beforeend', newEmploymentHtml);
                validateDatesAndCalculateYearsOfWork(); // Attach event listeners to the new form
            });

            document.getElementById('employment_div').addEventListener('click', function(event) {
                if (event.target.matches('.remove-employment')) {
                    event.target.closest('.work_Exp').remove();
                    employmentCount = document.querySelectorAll('.work_Exp')
                        .length; // Update count after removal
                    validateDatesAndCalculateYearsOfWork
                        (); // Re-validate and calculate years of work for all remaining forms
                }
            });

            validateDatesAndCalculateYearsOfWork(); // Initial setup to bind events and perform calculations
        });
    </script>

    <script>
        $(document).ready(function() {
            // Initialize Select2 on your select element
            $('#it_skills').select2({
                maximumSelectionLength: 5 // This option automatically limits the number of selectable options
            }).on("select2:selecting", function(e) {
                // Get the number of already selected options
                var selectedOptions = $(this).val();
                if (selectedOptions.length >= 5) {
                    // Prevent adding more than 5 options
                    e.preventDefault();
                    // Display the message
                    $('#message').show();
                }
            }).on("select2:unselecting", function(e) {
                // Hide the message when the selection is within the limit
                $('#message').hide();
            });
        });
    </script>

    <script>
        document.getElementById('birth_date').addEventListener('change', function() {
            var dob = new Date(this.value);
            var today = new Date();
            var age = today.getFullYear() - dob.getFullYear();
            var monthDiff = today.getMonth() - dob.getMonth();
            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < dob.getDate())) {
                age--;
            }
            document.getElementById('age').value = age;
        });
    </script>
    <script>
        $('#sameAsHomeAddress').change(function() {
            if (this.checked) {
                var homeBarangayId = $('#sub_division').val();
                $('#mailing_address').val($('#home_address').val());
                // $('#mailing_city').val($('#city').val()).trigger('change.select2');
                var homeCityId = $('#city').val();
                $('#mailing_province').val($('#province').val()).trigger('change.select2');
                $('#mailing_postal_code').val($('#postal_code').val());



                if (homeBarangayId) {
                    var $mailingSubdivision = $('#mailing_sub_division');
                    // Fetch the text of selected option in home subdivision
                    var homeBarangayText = $('#sub_division option:selected').text();

                    // Dynamically set and create the option if it doesn't exist
                    if (!$mailingSubdivision.find("option[value='" + homeBarangayId + "']").length) {
                        // Option not found, fetch from server or create dynamically
                        var newOption = new Option(homeBarangayText, homeBarangayId, false, false);
                        $mailingSubdivision.append(newOption).trigger('change');
                    }
                    // Set the value and trigger change
                    $mailingSubdivision.val(homeBarangayId).trigger('change.select2');
                }


                if (homeCityId) {
                    var $mailingCity = $('#mailing_city');
                    // Fetch the text of selected option in home subdivision
                    var homeCityText = $('#city option:selected').text();

                    // Dynamically set and create the option if it doesn't exist
                    if (!$mailingCity.find("option[value='" + homeCityId + "']").length) {
                        // Option not found, fetch from server or create dynamically
                        var newOption = new Option(homeCityText, homeCityId, false, false);
                        $mailingCity.append(newOption).trigger('change');
                    }
                    // Set the value and trigger change
                    $mailingCity.val(homeCityId).trigger('change.select2');
                }

            } else {
                $('#mailing_address').val('');
                $('#mailing_sub_division').val('').trigger('change.select2');
                $('#mailing_city').val('').trigger('change.select2');
                $('#mailing_province').val('').trigger('change.select2');
                $('#mailing_postal_code').val('');
            }
        });
    </script>

    <script>
    
        function initSelect2(selector, initialId, initialName) {
            var $select = $(selector);

            // Append the initial option if provided
            if (initialId && initialName) {
                var option = new Option(initialName, initialId, true, true);
                $select.append(option).trigger('change');
            }

            // Initialize Select2 with AJAX support
            $select.select2({
                ajax: {
                    url: '{{ route('barangay.search') }}',
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
            initSelect2('#ec_barangay_id', '{{ auth()->user()->ec_barangay_id }}',
                '{{ auth()->user()->ecBarangay->name ?? '' }}');
            initSelect2('#mailing_sub_division', '{{ auth()->user()->mailing_barangay_id }}',
                '{{ auth()->user()->mailBarangay->name ?? '' }}');
            initSelect2('#sub_division', '{{ auth()->user()->barangay_id }}',
                '{{ auth()->user()->barangay->name ?? '' }}');
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
                url: '{{ route('city.search') }}',
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
            placeholder: 'Search for a City',
            minimumInputLength: 1
        });
    }
    // });

    $(document).ready(function() {
        // Assume these values are passed from the server
        initCitySelect2('#ec_city_id', '{{ auth()->user()->ec_city_id }}',
            '{{ auth()->user()->ecCityName->name ?? '' }}');
            initCitySelect2('#mailing_city', '{{ auth()->user()->mailing_city_id }}',
            '{{ auth()->user()->mailCity->name ?? '' }}');
            initCitySelect2('#city', '{{ auth()->user()->city_id }}',
            '{{ auth()->user()->cityName->name ?? '' }}');
    });
</script>
@endsection
