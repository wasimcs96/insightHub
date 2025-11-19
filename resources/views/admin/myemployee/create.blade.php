@extends('admin.layout.app')

@section('title', 'Users')
@section('styles')
{{-- <style>
    .image-input-placeholder {
        background-image: url({{asset("admin/media/svg/files/blank-image.svg")
    }
    });
    }

    [data-bs-theme="dark"] .image-input-placeholder {
        background-image: url({{asset("admin/media/svg/files/blank-image-dark.svg")
    }
    });
    }
</style> --}}
@endsection
@section('content')
<div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">

    <!--begin::Toolbar container-->
    <div id="kt_app_toolbar_container" class="app-container  container-fluid d-flex flex-stack ">


        <!--begin::Page title-->
        <div data-kt-swapper="true" data-kt-swapper-mode="{default: 'prepend', lg: 'prepend'}"
            data-kt-swapper-parent="{default: '#kt_app_content_container', lg: '#kt_app_toolbar_container'}"
            class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5 mb-lg-0">
            <!--begin::Title-->
            <h1
                class="page-heading capitalize d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                Employee
            </h1>
            <!--end::Title-->


            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">

                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">
                    <a href="/admin/dashboard" class="text-muted text-hover-primary">
                        Home </a>
                </li>
                <!--end::Item-->
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <!--end::Item-->

                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">
                    <a href="/admin/dashboard" class="text-muted text-hover-primary">
                        Organization Structure </a>
                </li>
                <!--end::Item-->
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <!--end::Item-->

                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">
                    <a href="/admin/myemployee" class="capitalize text-muted text-hover-primary">
                        Employee
                    </a>
                </li>
                <!--begin::Item-->
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <!--end::Item-->

                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">
                     {{ !empty($user) ? 'Edit' : 'Create' }} User</li>
                <!--end::Item-->

            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
        <!--begin::Action group-->
        <!--begin::Toolbar end-->

        <!--end::Toolbar end-->
        <!--end::Action group-->
    </div>
    <!--end::Toolbar container-->
</div>

<!--begin::Content-->
<div id="kt_app_content" class="app-content  flex-column-fluid ">


    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container  container-xxl ">
        <div class="card">
            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold fs-3 mb-1">{{ !empty($user) ? 'Edit Employee' : 'Create Employee'
                        }}</span>

                    {{-- <span class="text-muted mt-1 fw-semibold fs-7">Over 500 new products</span> --}}
                </h3>

            </div>
            <div class="card-body">

                <form class="form" action="/admin/myemployee/{{ !empty($user) ? $user->id . '/update' : 'store' }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    <!--begin::Scroll-->

                    <div class=" ">
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="d-block fw-semibold fs-6 mb-5">Avatar</label>
                            <!--end::Label-->


                            <!--begin::Image placeholder-->

                            <!--end::Image placeholder-->
                            <!--begin::Image input-->
                            <div class="image-input image-input-outline image-input-placeholder"
                                data-kt-image-input="true">
                                <!--begin::Preview existing avatar-->
                                <div class="image-input-wrapper w-125px h-125px" @if (!empty($user)&&isset($user->
                                    profile_picture)) style="background-image: url('{{ asset($user->profile_picture)
                                    }}');"
                                    @else
                                    style="background-image: url('{{ asset('images/default-user.svg') }}');"
                                    @endif>
                                </div>
                                <!--end::Preview existing avatar-->

                                <!--begin::Label-->
                                <label
                                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                    data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                    <iconify-icon icon="heroicons-outline:pencil-alt" class="fa-1-5"></iconify-icon>
                                    <!--begin::Inputs-->
                                    <input type="file" name="avatar" accept=".png, .jpg, .jpeg"
                                        value="{{ old('avatar') }}" />
                                    <input type="hidden" name="avatar_remove" />
                                    <!--end::Inputs-->
                                </label>
                                <!--end::Label-->

                                <!--begin::Cancel-->
                                <span
                                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                    data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                                    <iconify-icon icon="iconoir:cancel" class="fa-1-5">
                                    </iconify-icon>
                                </span>
                                <!--end::Cancel-->

                                <!--begin::Remove-->
                                <span
                                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" id="remove-avatar-btn"
                                    data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                                    <iconify-icon icon="iconoir:cancel" class="fa-1-5">
                                    </iconify-icon>

                                </span>
                                <!--end::Remove-->
                            </div>
                            <!--end::Image input-->

                            <!--begin::Hint-->
                            <div class="form-text  @error('avatar') is-invalid @enderror">Allowed file types: png,
                                jpg, jpeg.</div>
                            @error('avatar')
                            <div class="invalid-feedback text-red-500">
                                {{ $message }}
                            </div>
                            @enderror
                            <!--end::Hint-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->

                        <h5 class="mt-4 mb-4">Personal Details</h5>
                        <div class="fv-row mb-7 row">


                            <div class="input-area col-xl-3">
                                <label for="suffix" class="form-label">Suffix</label>
                                <input id="suffix" type="text" class="form-control form-control-solid mb-3 mb-lg-0" name="suffix"
                                    placeholder="Enter Suffix ex:Sr." value="{{ $user->suffix ?? '' }}"hc
                                    b>
                                @error('suffix')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-3">
                                <label class="required fw-semibold fs-6 mb-2">First
                                    Name</label>
                                <!--end::Label-->

                                <!--begin::Input-->
                                <input type="text" name="first_name"
                                    class="form-control form-control-solid mb-3 mb-lg-0 @error('first_name') is-invalid @enderror"
                                    value="{{ !empty($user) ? $user->first_name : old('first_name') }}" placeholder="First Name" />
                                @error('first_name')
                                <div class="invalid-feedback text-red-500">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="input-area col-xl-3">
                                <label for="middle_name" class="form-label">Middle Name</label>
                                <input id="middle_name" type="text" class="form-control form-control-solid mb-3 mb-lg-0" 
                                    name="middle_name" placeholder="Middle Name"
                                    value="{{ $user->middle_name ?? '' }}">
                                @error('middle_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-3">
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-2">Last
                                    Name</label>
                                <!--end::Label-->

                                <!--begin::Input-->
                                <input type="text" name="last_name"
                                    class="form-control form-control-solid mb-3 mb-lg-0 @error('last_name') is-invalid @enderror"
                                    placeholder="Last Name" value="{{ !empty($user) ? $user->last_name : old('last_name') }}" />

                                @error('last_name')
                                <div class="invalid-feedback text-red-500">
                                    {{ $message }}
                                </div>
                                @enderror
                                <!--end::Input-->
                            </div>
                        
                        </div>

                        
                        <div class="row mb-5">
                            <div class="col-lg-6">

                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-2">Email</label>
                                <!--end::Label-->

                                <!--begin::Input-->
                                <input type="email" name="email"
                                    class="form-control form-control-solid mb-3 mb-lg-0 @error('email') is-invalid @enderror"
                                    placeholder="example@domain.com" value="{{ !empty($user) ? $user->email : old('email') }}" />
                                @error('email')
                                <div class="invalid-feedback text-red-500">
                                    {{ $message }}
                                </div>
                                @enderror
                                <!--end::Input-->
                            </div>
                            <!--end::Input-->
                            <div class="input-area col-xl-6">
                                <label for="select" class="form-label">Civil Status</label>
                                <select id="marital_status" class="form-control form-control-solid mb-3 mb-lg-0" name="marital_status">
                                    <option value="">Select Civil Status</option>
                                    @foreach (config('constants.MARITAL_STATUSES') as $key => $ms)
                                        <option value="{{ $key }}"
                                            @if ( !empty($user) && $user->marital_status == $key) Selected @endif>{{ $ms }}
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
                                <input id="mobile_number" type="number" class="form-control form-control-solid mb-3 mb-lg-0"
                                    name="mobile_number" placeholder="Mobile Number"
                                    value="{{ !empty($user) ? $user->mobile_number : old('mobile_number') }}">
                                @error('mobile_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="input-area col-xl-3">
                                <label for="birth_date" class="form-label">DOB</label>
                                <input id="birth_date" type="date" class="form-control form-control-solid mb-3 mb-lg-0" name="birth_date"
                                    placeholder="Birth Date" value="{{!empty($user) ? $user->birth_date : old('birth_date')  }}">
                                @error('birth_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="input-area col-xl-3">
                                <label for="age" class="form-label">Age</label>
                                <input id="age" type="number" class="form-control form-control-solid mb-3 mb-lg-0" name="age"
                                    placeholder="Age" value="{{ !empty($user) ? $user->age : old('age') }}">
                                @error('age')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="input-area col-xl-3">
                                <label for="select" class="required form-label">Select Gender</label>
                                <select id="gender" class="form-control form-control-solid mb-3 mb-lg-0" name="gender">
                                    <option value="0" @if(!empty($user) &&  $user->gender == '0') selected @endif>
                                        Male</option>
                                    <option value="1" @if(!empty($user) &&  $user->gender == '1') selected @endif>
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
                                <select id="country_id" class="form-control form-control-solid mb-3 mb-lg-0" name="country_id" required>
                                    <option value="">Select Nationality</option>
                                    @foreach ($master_country as $mc)
                                        <option value="{{ $mc->id }}"
                                            @if(!empty($user) && $user->country_id == $mc->id) selected @endif>
                                            {{ $mc->name ?? '' }}</option>
                                    @endforeach
                                </select>
                                @error('country_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="input-area col-xl-3">
                                <label for="national_id" class="form-label">National Id</label>
                                <input id="national_id" type="text" class="form-control form-control-solid mb-3 mb-lg-0" name="national_id"
                                    placeholder="National Id" value="{{  !empty($user) ? $user->national_id : old('national_id') }}">
                                @error('national_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="input-area col-xl-3">
                                <label for="passport_no" class="form-label">Passport No</label>
                                <input id="passport_no" type="text" class="form-control form-control-solid mb-3 mb-lg-0" name="passport_no"
                                    placeholder="Passport No" value="{{  !empty($user) ? $user->passport_no : old('passport_no') }}">
                                @error('passport_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="input-area col-xl-3">
                                <label for="passport_expiry_date" class="form-label">Passport Expiry
                                    Date</label>
                                <input id="passport_expiry_date" type="date" class="form-control form-control-solid mb-3 mb-lg-0"
                                    name="passport_expiry_date"
                                    value="{{ !empty($user) ? $user->passport_expiry_date : old('passport_expiry_date') }}"
                                    placeholder="Passport Expiry Date">
                                @error('passport_expiry_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>
                        <h5 class="mt-4 mb-4">Employment Details</h5>
                        {{-- <div class="fv-row mb-7 row">
                            <div class="col-md-6 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Sector</label>

                                <select class="form-select form-select-solid" id="sector" data-control="select2"
                                    data-hide-search="true" data-placeholder="Select a Sector" name="sector_id">
                                    <option value="">Select Sector...</option>

                                @foreach($sectors as $sector)
                                <option value="{{ $sector->id }}" @if(!empty($user) && $user->sector_id == $sector->id) selected="selected" @endif>{{ $sector->name ?? '' }}</option>
                                @endforeach
                                </select>
                            </div>


                            <div class="col-md-6 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Position</label>

                                <select class="form-select form-select-solid" id="positions" data-control="select2"
                                    data-hide-search="true" data-placeholder="Select a Position" name="position_id">
                                    @foreach($positions as $position)
                                    <option value="{{ $position->id }}" @if(!empty($user) && $user->position_id == $position->id) selected @endif>{{ $position->title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!--end::Input-->
                        </div> --}}

                        {{-- <div class="fv-row mb-7 row">
                            <div class="col-lg-4">
                                <label class="required fs-6 fw-semibold mb-2">Department</label>
                                <select class="form-select form-select-solid" id="department" name="department_id">
                                    <option value="">Select Department...</option>
                                    @foreach($departments as $department)
                                        <option value="{{ $department->id }}" {{ !empty($user) && $user->department_id == $department->id ? 'selected' : '' }}>
                                            {{ $department->head_of_department }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-4">
                                <label class="required fs-6 fw-semibold mb-2">Section</label>
                                <select class="form-select form-select-solid" id="section" name="section_id">
                                    <option value="">Select Section...</option>
                                    @foreach($sections as $section)
                                    <option value="{{ $section->id }}" {{ !empty($user) && $user->section_id == $section->id ? 'selected' : '' }}>
                                        {{ $section->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-4">
                                <label class="required fs-6 fw-semibold mb-2">Unit</label>
                                <select class="form-select form-select-solid" id="unit" name="unit_id">
                                    <option value="">Select Unit...</option>
                                    @foreach($units as $unit)
                                    <option value="{{ $unit->id }}" {{ !empty($user) && $user->unit_id == $unit->id ? 'selected' : '' }}>
                                        {{ $unit->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div> --}}



                        <!--end::Input group-->

                        <!--begin::Input group-->


                         <div class="fv-row mb-7 row">
                            {{-- @if(isset($user) && $user->isCompany()|| $user->isAdmin()) --}}
                            <!-- <div class="col-lg-4 fv-row">
                                <label class=" fs-6 fw-semibold mb-2">Team</label>

                                <select class="form-select form-select-solid" id="team" data-control="select2"
                                    data-hide-search="true" data-placeholder="Select a Team" name="team_id">
                                    {{-- <option value="{{  $user->team_id ?? '' }}" selected>{{$user->team->name ?? 'Select Team' }}</option> --}}

                                </select>
                            </div> -->
                            {{-- @else
                            @php
                            $teams = App\Models\Team::where('department_id',$user->id)->get();
                            @endphp

                            <div class="col-lg-4 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Team</label>

                                <select class="form-select form-select-solid"  data-control="select2"
                                    data-hide-search="true" data-placeholder="Select a Team" name="team_id">
                                    <option value="">Select Team...</option>

                                @foreach($teams as $team)
                                <option value="{{ $team->id }}" @if(!empty($user) && $user->team_id == $team->id) selected="selected" @endif>{{ $team->name ?? '' }}</option>
                                @endforeach
                                </select>
                            </div>

                            @endif --}}

                            @if(!empty($user))
                            <div class="col-lg-4 fv-row">
                                <label class="fs-6 fw-semibold mb-2">Sections</label>
                                <select class="form-select form-select-solid" id="section_id" name="section_id"
                                    data-placeholder="Select a Section">
                                    <option value="" disabled>Select a Section</option>
                                    @foreach ($sections as $section)
                                        <option value="{{ $section->id }}" 
                                            {{ $section->id == $user->section_id ? 'selected' : '' }}>
                                            {{ $section->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @endif
                            <div class="col-lg-4">
                                <label for="emp_status" class=" fs-6 fw-semibold mb-2">Employment Status</label>
                                <select class="form-select form-select-solid" id="emp_status" name="emp_status">
                                    <option value="">Select Employment Status...</option>
                                    @foreach(config('constants.EMPLOYMENT_STATUSES') as $key => $emp)
                                        <option value="{{ $key }}" {{ !empty($user) && $user->employment_status == $key ? 'selected' : '' }}>
                                            {{ $emp }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-lg-4">
                                <label class=" fs-6 fw-semibold mb-2">Date of Hire</label>
                                <input class="form-control form-control-solid mb-3 mb-lg-0" type="date" name="date_of_hire" value="{{ $user->date_of_hire ?? '' }}">
                            </div>
                 
                        </div> 


                        {{-- about me start --}}

                        @php

                            $userItSkills = [];
                            if(!empty($user)){
                            foreach ( $user->it_skills as $user_it_skill) {
                                $userItSkills[] = $user_it_skill->it_skill_id;
                            }
                        }


                        @endphp

                       

                        <h5 class="mt-4 mb-0 pt-4">Home Address</h5>
                        <div class="row mb-5 pt-2">
                            <div class="input-area col-xl-3">
                                <label for="home_address" class="form-label">House/Building Number and Street
                                    Name</label>
                                <input id="home_address" type="text" class="form-control form-control-solid mb-3 mb-lg-0" name="home_address"
                                    placeholder="Home Address" value="{{ $user->home_address ?? '' }}">
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

                                 
                                </select>

                                @error('sub_division')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message ?? ''}}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="input-area col-xl-2">
                                <label for="city" class="form-label">Select City</label>
                                <select id="city" class="form-control form-control-solid mb-3 mb-lg-0" name="city_id"
                                    data-control="select2" data-hide-search="false">
                                    <option value="">Select City</option>
                                    {{-- @foreach ($cities as $city)
                                        <option value="{{ $city->id ?? '' }}" @if(!empty($user) &&  $user->city_id == $city->id ) selected @endif>
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
                                <select id="province" class="form-control form-control-solid mb-3 mb-lg-0" name="province_id"
                                    data-control="select2" data-hide-search="false">
                                    <option value="">Select Province</option>

                                    @foreach ($provinces as $province)
                                        <option value="{{ $province->id ?? '' }}"
                                            @if(!empty($user) &&   $user->province_id == $province->id  ) selected @endif>
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
                                <input id="postal_code" type="number" class="form-control form-control-solid mb-3 mb-lg-0" name="postal_code"
                                    placeholder="Enter Postal Code"
                                    value="{{ $user->postal_code ?? '' }}">
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
                                <input id="mailing_address" type="text" class="form-control form-control-solid mb-3 mb-lg-0"
                                    name="mailing_address" placeholder="Home Address"
                                    value="{{ $user->mailing_address ?? '' }}">
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

                                 
                                </select>

                                @error('mailing_sub_division')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message ?? ''}}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="input-area col-xl-2">
                                <label for="mailing_city" class="form-label">Select City</label>
                                <select id="mailing_city" class="form-control form-control-solid mb-3 mb-lg-0" name="mailing_city_id"
                                    data-control="select2" data-hide-search="false">
                                    <option value="">Select City</option>

                                    {{-- @foreach ($cities as $city)
                                        <option value="{{ $city->id ?? '' }}"
                                            @if(!empty($user) &&  $user->mailing_city_id == $city->id  ) selected @endif>
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
                                <select id="mailing_province" class="form-control form-control-solid mb-3 mb-lg-0" name="mailing_province_id"
                                    data-control="select2" data-hide-search="false">
                                    <option value="">Select Province</option>

                                    @foreach ($provinces as $province)
                                        <option value="{{ $province->id ?? '' }}"
                                            @if(!empty($user) &&   $user->mailing_province_id == $province->id  ) selected @endif>
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
                                <input id="mailing_postal_code" type="number" class="form-control form-control-solid mb-3 mb-lg-0"
                                    name="mailing_postal_code" placeholder="Enter Postal Code"
                                    value="{{ $user->mailing_postal_code ?? '' }}">
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
                                <input id="tin_number" type="text" class="form-control form-control-solid mb-3 mb-lg-0" name="tin_number"
                                    placeholder="Enter TIN Number"
                                    value="{{ $user->tin_number ?? '' }}">
                                @error('tin_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="input-area col-xl-3">
                                <label for="sss_number" class="form-label">Social Security System (SSS)
                                    Number​​</label>
                                <input id="sss_number" type="text" class="form-control form-control-solid mb-3 mb-lg-0" name="sss_number"
                                    placeholder="Enter SSS Number"
                                    value="{{ $user->sss_number ?? '' }}">
                                @error('sss_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="input-area col-xl-3">
                                <label for="hdmf_number" class="form-label">Pag-IBIG Fund (HDMF) Number​​</label>
                                <input id="hdmf_number" type="text" class="form-control form-control-solid mb-3 mb-lg-0" name="hdmf_number"
                                    placeholder="Enter HDMF Number"
                                    value="{{ $user->hdmf_number ?? '' }}">
                                @error('hdmf_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="input-area col-xl-3">
                                <label for="phil_number" class="form-label">PhilHealth Number​​</label>
                                <input id="phil_number" type="text" class="form-control form-control-solid mb-3 mb-lg-0" name="phil_number"
                                    placeholder="Enter PhilHealth Number"
                                    value="{{ $user->phil_number ?? '' }}">
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
                                    <input class="form-control " value="{{ $user->skills ?? '' }}"
                                        name="skills" id="kt_tagify_1" />
                                </div>
                            </div>

                            <div class="input-area col-lg-4">
                                <div class="mb-5">
                                    <label class="form-label">Professional Certifications</label>
                                    <input class="form-control "
                                        value="{{ $user->professional_certificate ?? '' }}"
                                        name="professional_certificate" id="kt_tagify_2" />
                                </div>
                            </div>

                            <div class="input-area col-lg-4">
                                <div class="mb-5">
                                    <label class="form-label">Training Programs Attended​</label>
                                    <input class="form-control "
                                        value="{{ $user->training_program ?? '' }}"
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
                                <select id="education_level" class="form-control form-control-solid mb-3 mb-lg-0" name="education_level">
                                    @foreach ($education_levels as $education_level)
                                        <option value="{{ $education_level->id }}" class="dark:bg-slate-700"
                                            @if(!empty($user) && $user->education_level == $education_level->id  ) selected @endif>
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
                                <select id="higher_learning_institution" class="form-control form-control-solid mb-3 mb-lg-0"
                                    name="higher_learning_institution" data-control="select2"
                                    data-hide-search="false" required>
                                    {{-- @foreach ($higher_learning_institutions as $higher_learning_institution)
                                        <option value="{{ $higher_learning_institution->id }}"
                                            class="dark:bg-slate-700"
                                            @if(!empty($user) &&  $user->higher_learning_institution == $higher_learning_institution->id  ) selected @endif>
                                            {{ $higher_learning_institution->name ?? '' }}</option>
                                    @endforeach --}}
                                </select>
                                @error('higher_learning_institution')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="input-area col-xl-3">
                                <label for="select" class="required form-label">Select Course/Program</label>
                                <select id="scope_of_study" class="form-control form-control-solid mb-3 mb-lg-0" name="scope_of_study">
                                    @foreach ($scope_of_studies as $scope_of_study)
                                        <option value="{{ $scope_of_study->id }}" class="dark:bg-slate-700"
                                            @if(!empty($user) && $user->scope_of_study == $scope_of_study->id) selected @endif>
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
                                <input id="course_name" type="text" class="form-control form-control-solid mb-3 mb-lg-0" name="course_name"
                                    placeholder="Enter Course name"
                                    value="{{ $user->course_name ?? '' }}" required>
                                @error('course_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div> --}}

                            <div class="input-area col-xl-3">
                                <label for="graduate_year" class="required form-label">Year of Graduation</label>
                                <input id="graduate_year" type="number" class="form-control form-control-solid mb-3 mb-lg-0"
                                    name="graduate_year" placeholder="Enter Year of Graduated"
                                    value="{{ $user->graduate_year ?? '' }}" required>
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
                                <select id="do_you_have_experience_in_it_sector" class="form-control form-control-solid mb-3 mb-lg-0"
                                    name="do_you_have_experience_in_it_sector">
                                    <option value="0"
                                    @if(!empty($user) && $user->do_you_have_experience_in_it_sector == '0'  ) selected @endif>
                                        No</option>
                                    <option value="1"
                                    @if(!empty($user) && $user->do_you_have_experience_in_it_sector == '1'  ) selected @endif>
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
                                <input id="year_of_experience_in_it_sector" type="number" class="form-control form-control-solid mb-3 mb-lg-0"
                                    name="year_of_experience_in_it_sector"
                                    placeholder="Year Of Experience In IT Sector"
                                    value="{{ $user->year_of_experience_in_it_sector ?? 0 }}">
                                @error('year_of_experience_in_it_sector')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="input-area col-xl-4">
                                <label for="select" class="form-label">Current Sector Of Work</label>

                                <select id="sector" class="form-control form-control-solid mb-3 mb-lg-0" name="sector_id">
                                    <option value="" class="dark:bg-slate-700">Select Sector</option>
                                    @foreach ($sectors as $sector)
                                        <option value="{{ $sector->id }}" class="dark:bg-slate-700"
                                            @if(!empty($user) && $user->sector_id == $sector->id  ) selected @endif>
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
                            @if (!empty($user) &&$user->employments()->count() > 0)
                                @foreach ($user->employments as $employment)
                                    <div class="row justify-content-end work_Exp">
                                        <div class="input-area col-lg-2">
                                            <label for="job_title_{{ $loop->index }}" class="form-label">Job
                                                Title</label>
                                            <input id="job_title_{{ $loop->index }}" type="text"
                                                class="form-control form-control-solid mb-3 mb-lg-0"
                                                name="employments[{{ $loop->index }}][job_title]"
                                                value="{{ $employment->job_title }}" placeholder="Job Title">
                                        </div>
                                        <div class="input-area col-lg-2">
                                            <label for="company_name_{{ $loop->index }}"
                                                class="form-label">Company Name</label>
                                            <input id="company_name_{{ $loop->index }}" type="text"
                                                class="form-control form-control-solid mb-3 mb-lg-0"
                                                name="employments[{{ $loop->index }}][company_name]"
                                                value="{{ $employment->company_name }}"
                                                placeholder="Company Name">
                                        </div>
                                        <div class="input-area col-lg-2">
                                            <label for="start_date_{{ $loop->index }}" class="form-label">Start
                                                Date</label>
                                            <input id="start_date_{{ $loop->index }}" type="date"
                                                class="form-control form-control-solid mb-3 mb-lg-0"
                                                name="employments[{{ $loop->index }}][start_date]"
                                                value="{{ $employment->start_date }}">
                                        </div>
                                        <div class="input-area col-lg-2">
                                            <label for="end_date_{{ $loop->index }}" class="form-label">End
                                                Date</label>
                                            <input id="end_date_{{ $loop->index }}" type="date"
                                                class="form-control form-control-solid mb-3 mb-lg-0"
                                                name="employments[{{ $loop->index }}][end_date]"
                                                value="{{ $employment->end_date }}"
                                                @if ($employment->start_date && $employment->start_date != '0000-00-00' && $employment->end_date == '0000-00-00') disabled @endif>
                                        </div>
                                        <div class="input-area col-lg-2">
                                            <label for="year_of_work_{{ $loop->index }}"
                                                class="form-label">Years of Work</label>
                                            <input id="year_of_work_{{ $loop->index }}" type="text"
                                                class="form-control form-control-solid mb-3 mb-lg-0"
                                                name="employments[{{ $loop->index }}][year_of_work]"
                                                value="{{ $employment->year_of_work }}" readonly>
                                        </div>

                                        <div class="input-area col-lg-2">
                                            <label for="key_responsiblity_{{ $loop->index }}"
                                                class="form-label">Key Responsibilities</label>
                                            <textarea id="key_responsiblity_{{ $loop->index }}" type="checkbox" class="form-control form-control-solid mb-3 mb-lg-0"
                                                name="employments[{{ $loop->index }}][key_responsiblity]">{{ $employment->key_responsiblity }}</textarea>
                                        </div>
                                        @if ($loop->index < 1)
                                            <div class="checkbox-area col-lg-2">
                                                <label for="current_workplace_{{ $loop->index }}"
                                                    class="form-label">Current Workplace</label>
                                                {{-- <input id="current_workplace_{{$loop->index}}" type="checkbox" class="form-control form-control-solid mb-3 mb-lg-0" name="employments[{{$loop->index}}][current_workplace]"> --}}
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
                                        <input id="job_title" type="text" class="form-control form-control-solid mb-3 mb-lg-0"
                                            name="employments[0][job_title]" placeholder="Job Title">
                                    </div>
                                    <div class="input-area col-lg-2">
                                        <label for="company_name" class="form-label">Company Name</label>
                                        <input id="company_name" type="text" class="form-control form-control-solid mb-3 mb-lg-0"
                                            name="employments[0][company_name]" placeholder="Company Name">
                                    </div>
                                    <div class="input-area col-lg-2">
                                        <label for="start_date" class="form-label">Start Date</label>
                                        <input id="start_date" type="date" class="form-control form-control-solid mb-3 mb-lg-0"
                                            name="employments[0][start_date]">
                                    </div>
                                    <div class="input-area col-lg-2">
                                        <label for="end_date" class="form-label">End Date</label>
                                        <input id="end_date" type="date" class="form-control form-control-solid mb-3 mb-lg-0"
                                            name="employments[0][end_date]">
                                    </div>
                                    <div class="input-area col-lg-2">
                                        <label for="year_of_work" class="form-label">Years of Work</label>
                                        <input id="year_of_work" type="text" class="form-control form-control-solid mb-3 mb-lg-0"
                                            name="employments[0][year_of_work]" readonly>
                                    </div>

                                    <div class="input-area col-lg-2">
                                        <label for="key_responsiblity" class="form-label">Key
                                            Responsibilities</label>
                                        <textarea id="key_responsiblity" class="form-control form-control-solid mb-3 mb-lg-0" name="employments[0][key_responsiblity]"></textarea>
                                    </div>

                                    <div class="checkbox-area col-lg-2">
                                        <label for="current_workplace_0" class="form-label">Current
                                            Workplace</label>
                                        {{-- <input id="current_workplace_0" type="checkbox" class="form-control form-control-solid mb-3 mb-lg-0" name="employments[0][current_workplace]"> --}}
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
                                        value="{{ $user->ec_contact_person_name ?? '' }}"
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
                                    <select id="ec_relation_employee" class="form-control form-control-solid mb-3 mb-lg-0"
                                        name="ec_relation_employee">
                                        <option value="">Select ​Relationship to Employee</option>
                                        @foreach (config('constants.RELATION_EMPLOYEE') as $key => $ms)
                                            <option value="{{ $key }}"
                                                @if (!empty($user) && $user->ec_relation_employee == $key) Selected @endif>
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
                                    <input class="form-control form-control-solid mb-3 mb-lg-0" type="number"
                                        value="{{ $user->ec_contact_person_number ?? '' }}"
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
                                    <input id="ec_home_address" type="text" class="form-control form-control-solid mb-3 mb-lg-0"
                                        name="ec_home_address" placeholder="Home Address"
                                        value="{{ $user->ec_home_address ?? '' }}">
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

                                        
                                    </select>

                                    @error('ec_barangay_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message  ?? ''}}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="input-area col-xl-2">
                                    <label for="ec_city_id" class="form-label">Select City</label>
                                    <select id="ec_city_id" class="form-control form-control-solid mb-3 mb-lg-0" name="ec_city_id"
                                        data-control="select2" data-hide-search="false">
                                        <option value="">Select City</option>
                                        {{-- @foreach ($cities as $city)
                                            <option value="{{ $city->id ?? '' }}"
                                                @if(!empty($user) && $user->ec_city_id == $city->id  ) selected @endif>
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
                                    <select id="ec_province" class="form-control form-control-solid mb-3 mb-lg-0" name="ec_province"
                                        data-control="select2" data-hide-search="false">
                                        <option value="">Select Province</option>

                                        @foreach ($provinces as $province)
                                            <option value="{{ $province->id ?? '' }}"
                                                @if(!empty($user) &&  $user->ec_province == $province->id  ) selected @endif>
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
                                    <input id="ec_postal_code" type="number" class="form-control form-control-solid mb-3 mb-lg-0"
                                        name="ec_postal_code" placeholder="Enter Postal Code"
                                        value="{{ $user->ec_postal_code ?? '' }}">
                                    @error('ec_postal_code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>
                         


                        </div>

                        {{-- about me end --}}
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row">
                            <div class="mb-10 fv-row col-lg-6 mt-5" data-kt-password-meter="true">
                                <!--begin::Wrapper-->
                                <div class="mb-1 ">
                                    <!--begin::Label-->
                                    <label class="form-label fw-semibold fs-6 mb-2">
                                        Password
                                    </label>
                                    <!--end::Label-->

                                    <!--begin::Input wrapper-->
                                    <div class="position-relative mb-3">
                                        <input class="form-control form-control-lg form-control-solid " type="password"
                                            placeholder="" name="password" autocomplete="new-password" />

                                        <span
                                            class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                            data-kt-password-meter-control="visibility">

                                            <i class="ki-eye-slash">
                                                <iconify-icon icon="ph:eye-slash"
                                                    class=" ki-duotone ki-eye-slash fa-1-5">
                                                </iconify-icon>
                                            </i>
                                            <i class=" d-none ">
                                                <iconify-icon icon="mdi:eye-outline" class="ki-duotone ki-eye fa-1-5">
                                                </iconify-icon>
                                            </i>
                                        </span>

                                    </div>
                                    <!--end::Input wrapper-->

                                    <!--begin::Meter-->
                                    <div class="d-flex align-items-center mb-3"
                                        data-kt-password-meter-control="highlight">
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                                        </div>
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                                        </div>
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                                        </div>
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px">
                                        </div>
                                    </div>
                                    <!--end::Meter-->
                                </div>
                                <!--end::Wrapper-->

                                <!--begin::Hint-->
                                <div class="text-muted">
                                    Use 8 or more characters with a mix of letters, numbers & symbols.
                                </div>
                                <!--end::Hint-->
                            </div>
                            <!--end::Input group--->
                            <!--begin::Input group--->
                            <div class="fv-row mb-10 col-lg-6 mt-5">
                                <label class="form-label fw-semibold fs-6 mb-2">Confirm Password</label>

                                <input
                                    class="form-control form-control-lg form-control-solid  @error('password') is-invalid @enderror"
                                    type="password" placeholder="" name="password_confirmation" autocomplete="new-password" />
                                @error('password')
                                <div class="invalid-feedback text-red-500">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <!--end::Input group--->
                    </div>
                    <!--end::Scroll-->

                    <!--begin::Actions-->
                    <div class="text-center pt-10">
                        {{-- <button type="reset" class="btn-closes btn btn-light me-3" data-bs-dismiss="modal">

                            Discard
                        </button> --}}

                        <button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">
                            <span class="indicator-label">
                                Submit
                            </span>
                            <span class="indicator-progress">
                                Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
            </div>
        </div>

    </div>
</div>


@endsection
@section('scripts')
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
{{-- <script>
    $(document).ready(function() {
        $('#company').change(function() {
            var companyId = $(this).val();
            $.ajax({
                url: '/admin/departments/' + companyId,
                type: 'GET',
                success: function(response) {
                    $('#department').empty();
                    $('#positions').empty();

                    $.each(response, function(key, value) {
                        $('#department').append('<option value="' + key + '">' + value + '</option>');
                    });
                }
            });
        });
    });
</script> --}}

<script>
    $(document).ready(function() {
        $('#sector').change(function() {
            var sectorId = $(this).val();
            console.log(sectorId);
            $.ajax({
                url: '/admin/postions/' + sectorId,
                type: 'GET',
                success: function(response) {
                    $('#positions').empty();
                    $.each(response, function(key, value) {
                        $('#positions').append('<option value="' + key + '">' + value + '</option>');
                    });
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#department').change(function() {

            var departId = $(this).val();
            console.log(departId);
            $.ajax({
                url: '/admin/getteams/' + departId,
                type: 'GET',
                success: function(response) {
                    $('#team').empty();
                    $.each(response, function(key, value) {
                        $('#team').append('<option value="' + key + '">' + value + '</option>');
                    });
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#department').change(function() {
            var departmentId = $(this).val();
            if (departmentId) {
                $.ajax({
                    url: '/admin/get-sections/' + departmentId,
                    type: 'GET',
                    success: function(response) {
                        $('#section').empty();
                        $('#section').append('<option value="">Select Section...</option>');
                        $.each(response, function(key, value) {
                            $('#section').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    }
                });
            } else {
                $('#section').empty();
                $('#section').append('<option value="">Select Section...</option>');
            }
            $('#unit').empty();
            $('#unit').append('<option value="">Select Unit...</option>');
        });

        $('#section').change(function() {
            var sectionId = $(this).val();
            if (sectionId) {
                $.ajax({
                    url: '/admin/get-units/' + sectionId,
                    type: 'GET',
                    success: function(response) {
                        $('#unit').empty();
                        $('#unit').append('<option value="">Select Unit...</option>');
                        $.each(response, function(key, value) {
                            $('#unit').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    }
                });
            } else {
                $('#unit').empty();
                $('#unit').append('<option value="">Select Unit...</option>');
            }
        });
    });
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
        <input id="job_title_${index}" type="text" class="form-control form-control-solid mb-3 mb-lg-0" name="employments[${index}][job_title]" placeholder="Job Title">
    </div>
    <div class="input-area col-lg-2 mt-5 pt-3">
        <label for="company_name_${index}" class="form-label">Company Name</label>
        <input id="company_name_${index}" type="text" class="form-control form-control-solid mb-3 mb-lg-0" name="employments[${index}][company_name]" placeholder="Company Name">
    </div>
    <div class="input-area col-lg-2 mt-5 pt-3">
        <label for="start_date_${index}" class="form-label">Start Date</label>
        <input id="start_date_${index}" type="date" class="form-control form-control-solid mb-3 mb-lg-0" name="employments[${index}][start_date]">
    </div>
    <div class="input-area col-lg-2 mt-5 pt-3">
        <label for="end_date_${index}" class="form-label">End Date</label>
        <input id="end_date_${index}" type="date" class="form-control form-control-solid mb-3 mb-lg-0" name="employments[${index}][end_date]">
    </div>
    <div class="input-area col-lg-2 mt-5 pt-3">
        <label for="year_of_work_${index}" class="form-label">Years of Work</label>
        <input id="year_of_work_${index}" type="text" class="form-control form-control-solid mb-3 mb-lg-0" name="employments[${index}][year_of_work]" readonly>
    </div>
    <div class="input-area col-lg-2">
        <label for="key_responsiblity_${index}" class="form-label">Key Responsibilities</label>
        <textarea id="key_responsiblity_${index}" class="form-control form-control-solid mb-3 mb-lg-0" name="employments[${index}][key_responsiblity]"></textarea>
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

        console.log('asdf');

        // Initialize Select2 with AJAX support
        $select.select2({
            ajax: {
                url: '{{ route('admin.barangay.search') }}',
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
                url: '{{ route('admin.city.search') }}',
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
            placeholder: 'Select City',
            minimumInputLength: 1
        });
    }
    // });

    $(document).ready(function() {
        // Assume these values are passed from the server
        initCitySelect2('#ec_city_id', '{{ $user->ec_city_id ?? ''}}',
            '{{ $user->ecCityName->name ?? '' }}');
            initCitySelect2('#mailing_city', '{{ $user->mailing_city_id ?? ''}}',
            '{{ $user->mailCity->name ?? '' }}');
            initCitySelect2('#city', '{{ $user->city_id ?? ''}}',
            '{{ $user->cityName->name ?? '' }}');
    });
</script>


<script>
    
    function initHLInstitutionSelect2(selector, initialId, initialName) {
        var $select = $(selector);

        // Append the initial option if provided
        if (initialId && initialName) {
            var option = new Option(initialName, initialId, true, true);
            $select.append(option).trigger('change');
        }

        // Initialize Select2 with AJAX support
        $select.select2({
            ajax: {
                url: '{{ route('admin.higherinstitution.search') }}',
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
            placeholder: 'Select Higher Learning Institution',
            minimumInputLength: 1
        });
    }
    // });

    $(document).ready(function() {
        // Assume these values are passed from the server
        initHLInstitutionSelect2('#higher_learning_institution', '{{ $user->higher_learning_institution ?? ''}}',
            '{{ $user->higher_learning->name ?? '' }}');
            
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const removeBtn = document.getElementById("remove-avatar-btn");
        const avatarWrapper = document.querySelector(".image-input-wrapper");

        removeBtn.addEventListener("click", function (event) {
    event.stopPropagation(); // Prevent event bubbling
    if (!confirm("Are you sure you want to remove this avatar?")) return;

    fetch(`/admin/myemployee/{{ $user->id ?? '' }}/remove-avatar`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update UI
            avatarWrapper.style.backgroundImage = "url('{{ asset('images/default-user.svg') }}')";
            alert(data.message);
        } else {
            alert('Failed to remove avatar.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Something went wrong while removing avatar.');
    });
});

    });
</script>
@endsection
