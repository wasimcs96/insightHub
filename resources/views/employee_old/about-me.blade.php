@extends('employee.layout.app')

@section('title', 'About Me')

@section('content')
    <div class="content-wrapper transition-all duration-150 xl:ltr:ml-[248px] xl:rtl:mr-[248px]" id="content_wrapper">
        <div class="page-content">
            <div id="content_layout">
                <!-- BEGIN: Breadcrumb -->
                <div class="mb-5">
                    <ul class="m-0 p-0 list-none">
                        <li class="inline-block relative top-[3px] text-base text-primary-500 font-Inter ">
                            <a href="/dashboard">
                                <iconify-icon icon="heroicons-outline:home"></iconify-icon>
                                <iconify-icon icon="heroicons-outline:chevron-right"
                                    class="relative text-slate-500 text-sm rtl:rotate-180"></iconify-icon>
                            </a>
                        </li>
                        <li class="inline-block relative text-sm text-primary-500 font-Inter ">
                            Employee
                            <iconify-icon icon="heroicons-outline:chevron-right"
                                class="relative top-[3px] text-slate-500 rtl:rotate-180"></iconify-icon>
                        </li>
                        <li class="inline-block relative text-sm text-slate-500 font-Inter dark:text-white">
                            About Me
                        </li>

                    </ul>
                </div>
                <!-- END: BreadCrumb -->
                @if ($errors->any())
                    <div class="alert alert-danger mb-5">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }} <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="float: right;">X</button></li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if(session('success')) <!-- Check if there's a success message in the session -->
                    <div class="alert alert-success mb-5"> <!-- Display a success alert -->
                        {{ session('success') }} <!-- Display the success message -->
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="float: right;">X</button>
                    </div>
                @endif
                <div class="space-y-6">

                    <div class="card">
                        <div class="card-body flex flex-col p-6">
                            <header
                                class="flex mb-5 items-center border-b border-slate-100 dark:border-slate-700 pb-5 -mx-6 px-6">
                                <div class="flex-1">
                                    <div class="card-title text-slate-900 dark:text-white">About Me</div>
                                </div>
                            </header>
                            <div class="card-text h-full space-y-4">
                                <form action="{{ route('employee.about.me.store') }}" id="job_description_form" method="POST">
                                    @csrf
                                    <h5 class="mt-4 mb-4">Personal Details</h5>
                                    <div class="gap-4 grid grid-cols-3 lg:grid-cols-3 md:grid-cols-3 mb-1">
                                        <div class="input-area">
                                            <label for="first_name" class="form-label">First Name*</label>
                                            <input id="first_name" type="text" class="form-control" name="first_name"
                                                placeholder="First Name" value="{{ auth()->user()->first_name ?? ''}}" required>
                                            @error('first_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="input-area">
                                            <label for="last_name" class="form-label">Last Name*</label>
                                            <input id="last_name" type="text" class="form-control"
                                                name="last_name" placeholder="Last Name" value="{{ auth()->user()->last_name ?? ''}}" required>
                                            @error('last_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="input-area">
                                            <label for="email" class="form-label">Email*</label>
                                            <input id="email" type="email" class="form-control"
                                                name="email" placeholder="Email" value="{{ auth()->user()->email ?? ''}}" required>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                    </div>

                                    <div class="gap-4 grid grid-cols-4 lg:grid-cols-4 md:grid-cols-4 mb-4">
                                        <div class="input-area">
                                            <label for="mobile_number" class="form-label">Mobile Number*</label>
                                            <input id="mobile_number" type="number" class="form-control"
                                                name="mobile_number" placeholder="Mobile Number" value="{{ auth()->user()->mobile_number ?? ''}}" required>
                                            @error('mobile_number')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="input-area">
                                            <label for="birth_date" class="form-label">DOB*</label>
                                            <input id="birth_date" type="date" class="form-control" name="birth_date"
                                                placeholder="Birth Date" value="{{ auth()->user()->birth_date ?? ''}}" required>
                                            @error('birth_date')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="input-area">
                                            <label for="age" class="form-label">Age*</label>
                                            <input id="age" type="number" class="form-control" name="age"
                                                placeholder="Age" value="{{ auth()->user()->age
                                                 ?? ''}}" required>
                                            @error('age')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="input-area">
                                            <label for="select" class="form-label">Select Gender*</label>
                                            <select id="gender" class="form-control" name="gender">
                                                <option value="0" {{ auth()->user()->gender == '0' ? 'selected' : '' }}>Male</option>
                                                <option value="1" {{ auth()->user()->gender == '1' ? 'selected' : '' }}>Female</option>
                                            </select>
                                            @error('gender')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                    </div>

                                    <div class="gap-4 grid grid-cols-3 lg:grid-cols-3 md:grid-cols-3 mb-4">
                                        <div class="input-area">
                                            <label for="national_id" class="form-label">National Id*</label>
                                            <input id="national_id" type="text" class="form-control" name="national_id"
                                                placeholder="National Id" value="{{ auth()->user()->national_id ?? ''}}" required>
                                            @error('national_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="input-area">
                                            <label for="passport_no" class="form-label">Passport No*</label>
                                            <input id="passport_no" type="text" class="form-control" name="passport_no"
                                                placeholder="Passport No" value="{{ auth()->user()->passport_no ?? ''}}" required>
                                            @error('passport_no')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="input-area">
                                            <label for="passport_expiry_date" class="form-label">Passport Expiry
                                                Date*</label>
                                            <input id="passport_expiry_date" type="date" class="form-control"
                                                name="passport_expiry_date" value="{{ auth()->user()->passport_expiry_date ?? ''}}" placeholder="Passport Expiry Date" required>
                                            @error('passport_expiry_date')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                    </div>
                                    @php
                                       $education_levels = \App\Models\MasterEducationLevel::all();
                                       $higher_learning_institutions = \App\Models\MasterHigherLearningInstitution::all();
                                       $scope_of_studies = \App\Models\MasterScopeOfStudy::all();
                                       $sectors = \App\Models\MasterSector::all();
                                       $itSkills = \App\Models\MasterItSkill::all();
                                       $userItSkills = [];
                                       foreach(auth()->user()->it_skills as $user_it_skill) {
                                           $userItSkills[] = $user_it_skill->it_skill_id;
                                       }
                                       $cities = \App\Models\MasterCity::all();
                                    @endphp
                                    <div class="gap-4 grid grid-cols-3 lg:grid-cols-3 md:grid-cols-3 mb-1">
                                        <div class="input-area">
                                            <label for="select" class="form-label">Select City*</label>
                                            <select id="city" class="form-control" name="city">
                                                @foreach($cities as $city)
                                                   <option value="{{ $city->name ?? '' }}" {{ auth()->user()->city == $city->name ? 'selected' : '' }}>{{ $city->name ?? '' }}</option>
                                                @endforeach
                                            </select>
                                            
                                            @error('city')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="input-area">
                                            <label for="home_address" class="form-label">Home Address*</label>
                                            <input id="home_address" type="text" class="form-control" name="home_address"
                                                placeholder="Home Address" value="{{ auth()->user()->home_address ?? ''}}" required>
                                            @error('home_address')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="input-area">
                                            <label for="mailing_address" class="form-label">Mailing Address*</label>
                                            <input id="mailing_address" type="text" class="form-control"
                                                name="mailing_address" placeholder="Mailing Address" value="{{ auth()->user()->mailing_address ?? ''}}" required>
                                            @error('mailing_address')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="checkbox-area mt-2">
                                                <label class="inline-flex items-center cursor-pointer">
                                                    <input type="checkbox" class="hidden" name="checkbox">
                                                    <span
                                                        class="h-4 w-4 border flex-none border-slate-100 dark:border-slate-800 rounded inline-flex ltr:mr-3 rtl:ml-3 relative transition-all duration-150 bg-slate-100 dark:bg-slate-900">
                                                        <img src="{{ asset('assets/images/icon/ck-white.svg') }}"
                                                            alt=""
                                                            class="h-[10px] w-[10px] block m-auto opacity-0"></span>
                                                    <span class="text-slate-500 dark:text-slate-400 text-sm leading-6">Same
                                                        As Home Address</span>
                                                </label>
                                            </div>
                                        </div>

                                    </div>
                                     
                                    <h5 class="mt-4 mb-4">IT Skills</h5>
                                    <div class="gap-4 grid grid-cols-1 lg:grid-cols-1 md:grid-cols-1 mb-4">
                                        <div class="input-area">
                                            <div>
                                                <label for="it_skills" class="form-label">Select Top 5 IT Skills</label>
                                                <select name="it_skills[]" id="it_skills" class="select2 form-control w-full mt-2 py-2" multiple>
                                                     @foreach($itSkills as $itSkill)
                                                         <option value="{{ $itSkill->id }}" @if(in_array($itSkill->id, $userItSkills)) selected @endif class="inline-block font-Inter font-normal text-sm text-slate-600">{{ $itSkill->name ?? '' }}</option>
                                                     @endforeach
                
                                                </select>
                                            </div>
                                        </div>
                                        <div id="message" style="display: none; color: red;">You can only select up to 5 options.</div>
                                    </div>

                                    <h5 class="mt-4 mb-4">Educational Background</h5>
                                    <div class="gap-4 grid grid-cols-3 lg:grid-cols-3 md:grid-cols-3 mb-4">
                                        <div class="input-area">
                                            <label for="select" class="form-label">Select Education Level*</label>
                                            <select id="education_level" class="form-control" name="education_level">
                                                @foreach($education_levels as $education_level)
                                                   <option value="{{ $education_level->id }}" class="dark:bg-slate-700" {{ auth()->user()->education_level == $education_level->id ? 'selected' : '' }}>{{ $education_level->name ?? '' }}</option>
                                                @endforeach
                                            </select>
                                            @error('education_level')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="input-area">
                                            <label for="select" class="form-label">Select Higher Learning Institution*</label>
                                            <select id="higher_learning_institution" class="form-control"
                                                name="higher_learning_institution">
                                                @foreach($higher_learning_institutions as $higher_learning_institution)
                                                   <option value="{{ $higher_learning_institution->id }}" class="dark:bg-slate-700" {{ auth()->user()->higher_learning_institution == $higher_learning_institution->id ? 'selected' : '' }}>{{ $higher_learning_institution->name ?? '' }}</option>
                                                @endforeach
                                            </select>
                                            @error('higher_learning_institution')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="input-area">
                                            <label for="select" class="form-label">Select Scope Of Study*</label>
                                            <select id="scope_of_study" class="form-control" name="scope_of_study">
                                                @foreach($scope_of_studies as $scope_of_study)
                                                   <option value="{{ $scope_of_study->id }}" class="dark:bg-slate-700" {{ auth()->user()->scope_of_study == $scope_of_study->id ? 'selected' : '' }}>{{ $scope_of_study->name ?? '' }}</option>
                                                @endforeach
                                            </select>
                                            @error('scope_of_study')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                    </div>

                                    <h5 class="mt-4 mb-4">BPO Experience</h5>
                                    <div class="gap-4 grid grid-cols-3 lg:grid-cols-3 md:grid-cols-3 mb-1">

                                        <div class="input-area">
                                            <label for="select" class="form-label">Do you have work experience in BPO industry*</label>
                                            <select id="do_you_have_experience_in_it_sector" class="form-control" name="do_you_have_experience_in_it_sector">
                                                <option value="0" {{ auth()->user()->do_you_have_experience_in_it_sector == '0' ? 'selected' : '' }}>No</option>
                                                <option value="1" {{ auth()->user()->do_you_have_experience_in_it_sector == '1' ? 'selected' : '' }}>Yes</option>
                                            </select>
                                            @error('do_you_have_experience_in_it_sector')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="input-area">
                                            <label for="year_of_experience_in_it_sector" class="form-label">Year(s) of experience in BPO industry*</label>
                                            <input id="year_of_experience_in_it_sector" type="number" class="form-control" name="year_of_experience_in_it_sector"
                                                placeholder="Year Of Experience In IT Sector" value="{{ auth()->user()->year_of_experience_in_it_sector ?? 0 }}" required>
                                            @error('year_of_experience_in_it_sector')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="input-area">
                                            <label for="select" class="form-label">Current Sector Of Work</label>
                                            
                                            <select id="sector" class="form-control" name="sector_id">
                                                <option value="" class="dark:bg-slate-700" >Select Sector</option>
                                                @foreach($sectors as $sector)
                                                   <option value="{{ $sector->id }}" class="dark:bg-slate-700" {{ auth()->user()->sector_id == $sector->id ? 'selected' : '' }}>{{ $sector->name ?? '' }}</option>
                                                @endforeach
                                            </select>
                                            @error('sector')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                    </div>
                                    <h5 class="mt-4 mb-4">Employment History</h5>
                                    <div id="employment_div">
                                        @if(auth()->user()->employments()->count() > 0)
                                            @foreach(auth()->user()->employments as $employment)
                                                <div class="gap-4 grid grid-cols-6 lg:grid-cols-6 md:grid-cols-6 mb-4">
                                                    <div class="input-area">
                                                        <label for="job_title_{{$loop->index}}" class="form-label">Job Title</label>
                                                        <input id="job_title_{{$loop->index}}" type="text" class="form-control" name="employments[{{$loop->index}}][job_title]" value="{{ $employment->job_title }}" placeholder="Job Title">
                                                    </div>
                                                    <div class="input-area">
                                                        <label for="company_name_{{$loop->index}}" class="form-label">Company Name</label>
                                                        <input id="company_name_{{$loop->index}}" type="text" class="form-control" name="employments[{{$loop->index}}][company_name]" value="{{ $employment->company_name }}" placeholder="Company Name">
                                                    </div>
                                                    <div class="input-area">
                                                        <label for="start_date_{{$loop->index}}" class="form-label">Start Date</label>
                                                        <input id="start_date_{{$loop->index}}" type="date" class="form-control" name="employments[{{$loop->index}}][start_date]" value="{{ $employment->start_date }}">
                                                    </div>
                                                    <div class="input-area">
                                                        <label for="end_date_{{$loop->index}}" class="form-label">End Date</label>
                                                        <input id="end_date_{{$loop->index}}" type="date" class="form-control" name="employments[{{$loop->index}}][end_date]" value="{{ $employment->end_date }}" @if($employment->start_date && $employment->start_date != '0000-00-00' && $employment->end_date == '0000-00-00') disabled @endif>
                                                    </div>
                                                    <div class="input-area">
                                                        <label for="year_of_work_{{$loop->index}}" class="form-label">Years of Work</label>
                                                        <input id="year_of_work_{{$loop->index}}" type="text" class="form-control" name="employments[{{$loop->index}}][year_of_work]" value="{{ $employment->year_of_work }}" readonly>
                                                    </div>
                                                    @if($loop->index < 1)
                                                    <div class="checkbox-area">
                                                        <label for="current_workplace_{{$loop->index}}" class="form-label">Current Workplace</label>
                                                        {{-- <input id="current_workplace_{{$loop->index}}" type="checkbox" class="form-control" name="employments[{{$loop->index}}][current_workplace]"> --}}
                                                        <div class="checkbox-area mt-2">
                                                            <label for="current_workplace_{{$loop->index}}" class="inline-flex items-center cursor-pointer">
                                                                <input type="checkbox" id="current_workplace_{{$loop->index}}" type="checkbox" class="hidden" name="employments[{{$loop->index}}][current_workplace]" name="checkbox" @if($employment->start_date && $employment->start_date != '0000-00-00' && $employment->end_date == '0000-00-00') checked @endif>
                                                                <span
                                                                    class="h-4 w-4 border flex-none border-slate-100 dark:border-slate-800 rounded inline-flex ltr:mr-3 rtl:ml-3 relative transition-all duration-150 bg-slate-100 dark:bg-slate-900">
                                                                    <img src="{{ asset('assets/images/icon/ck-white.svg') }}"
                                                                        alt=""
                                                                        class="h-[10px] w-[10px] block m-auto opacity-0"></span>
                                                                <span class="text-slate-500 dark:text-slate-400 text-sm leading-6">Yes</span>
                                                            </label>
                                                        </div>
                                                        <div class="mt-6" style="display:flex; justify-content:flex-start">
                                                            <button class="btn btn-danger remove-employment" style="padding:0px 16px 0px 16px" type="button"><iconify-icon icon="heroicons-outline:trash" class="text-2xl"></iconify-icon></button>
                                                        </div>
                                                    </div>
                                                    @else 
                                                    <div class="mt-6" style="display:flex; justify-content:flex-start">
                                                        <button class="btn btn-danger remove-employment" style="padding:0px 16px 0px 16px" type="button"><iconify-icon icon="heroicons-outline:trash" class="text-2xl"></iconify-icon></button>
                                                    </div>
                                                    @endif
                                                </div> 
                                                
                                            @endforeach
                                        @else
                                            <div class="gap-4 grid grid-cols-6 lg:grid-cols-6 md:grid-cols-6 mb-4">
                                                <div class="input-area">
                                                    <label for="job_title" class="form-label">Job Title</label>
                                                    <input id="job_title" type="text" class="form-control" name="employments[0][job_title]" placeholder="Job Title">
                                                </div>
                                                <div class="input-area">
                                                    <label for="company_name" class="form-label">Company Name</label>
                                                    <input id="company_name" type="text" class="form-control" name="employments[0][company_name]" placeholder="Company Name">
                                                </div>
                                                <div class="input-area">
                                                    <label for="start_date" class="form-label">Start Date</label>
                                                    <input id="start_date" type="date" class="form-control" name="employments[0][start_date]">
                                                </div>
                                                <div class="input-area">
                                                    <label for="end_date" class="form-label">End Date</label>
                                                    <input id="end_date" type="date" class="form-control" name="employments[0][end_date]">
                                                </div>
                                                <div class="input-area">
                                                    <label for="year_of_work" class="form-label">Years of Work</label>
                                                    <input id="year_of_work" type="text" class="form-control" name="employments[0][year_of_work]" readonly>
                                                </div>
                                                {{-- <div class="input-area">
                                                    <label for="current_workplace_0" class="form-label">Current Workplace</label>
                                                    <input id="current_workplace_0" type="checkbox" class="form-control" name="employments[0][current_workplace]">
                                                </div> --}}
                                                <div class="checkbox-area">
                                                    <label for="current_workplace_0" class="form-label">Current Workplace</label>
                                                    {{-- <input id="current_workplace_0" type="checkbox" class="form-control" name="employments[0][current_workplace]"> --}}
                                                    <div class="checkbox-area mt-2">
                                                        <label for="current_workplace_0" class="inline-flex items-center cursor-pointer">
                                                            <input type="checkbox" id="current_workplace_0" type="checkbox" class="hidden" name="employments[0][current_workplace]" name="checkbox">
                                                            <span
                                                                class="h-4 w-4 border flex-none border-slate-100 dark:border-slate-800 rounded inline-flex ltr:mr-3 rtl:ml-3 relative transition-all duration-150 bg-slate-100 dark:bg-slate-900">
                                                                <img src="{{ asset('assets/images/icon/ck-white.svg') }}"
                                                                    alt=""
                                                                    class="h-[10px] w-[10px] block m-auto opacity-0"></span>
                                                            <span class="text-slate-500 dark:text-slate-400 text-sm leading-6">Yes</span>
                                                        </label>
                                                    </div>
                                                    <div class="mt-6" style="display:flex; justify-content:flex-start">
                                                        <button class="btn btn-danger remove-employment" style="padding:0px 16px 0px 16px" type="button"><iconify-icon icon="heroicons-outline:trash" class="text-2xl"></iconify-icon></button>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        @endif
                                    </div>
                                    <button class="btn inline-flex justify-center btn-light mb-2" type="button" id="add_employment" style="float: right">Add Employment</button>
                                    
                                    <div class="mt-12" style="display:flex; justify-content:center">
                                        <button class="btn bg_secondary_green text-white mr-3">Submit</button>
                                        <a class="btn btn-danger" href="{{ route('employee.dashboard')}}">Back To Dashboard</a>

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
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> --}}
{{-- <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script> --}}

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
        let employmentCount = document.querySelectorAll('.grid-cols-6').length; // Initialize employment count
    
        function handleCheckboxChange(checkbox, endDateInput) {
            if (checkbox.checked) {
                endDateInput.disabled = true;
                endDateInput.value = ''; // Clear end date if current workplace is checked
            } else {
                endDateInput.disabled = false;
            }
        }
    
        function validateDatesAndCalculateYearsOfWork() {
            document.querySelectorAll('.grid-cols-6').forEach((employment, index) => {
                const startDateInput = employment.querySelector(`[name='employments[${index}][start_date]']`);
                const endDateInput = employment.querySelector(`[name='employments[${index}][end_date]']`);
                const yearsOfWorkInput = employment.querySelector(`[name='employments[${index}][year_of_work]']`);
                const currentWorkplaceCheckbox = employment.querySelector(`[name='employments[${index}][current_workplace]']`);
    
                if (currentWorkplaceCheckbox) {
                    handleCheckboxChange(currentWorkplaceCheckbox, endDateInput);
                    currentWorkplaceCheckbox.addEventListener('change', function() {
                        handleCheckboxChange(currentWorkplaceCheckbox, endDateInput);
                        calculateYearsOfWork(); // Recalculate years of work when checkbox changes
                    });
                }
    
                const calculateYearsOfWork = () => {
                    const startDate = startDateInput && startDateInput.value ? new Date(startDateInput.value) : null;
                    let endDate = endDateInput && endDateInput.value ? new Date(endDateInput.value) : new Date(); // Use today's date if end date is not set or if current workplace is checked
    
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
            const index = employmentCount++; // Use the current count as the index for the new employment form
    
            const newEmploymentHtml = `
            <div class="gap-4 grid grid-cols-6 lg:grid-cols-6 md:grid-cols-6 mb-4">
        <div class="input-area">
            <label for="job_title_${index}" class="form-label">Job Title</label>
            <input id="job_title_${index}" type="text" class="form-control" name="employments[${index}][job_title]" placeholder="Job Title">
        </div>
        <div class="input-area">
            <label for="company_name_${index}" class="form-label">Company Name</label>
            <input id="company_name_${index}" type="text" class="form-control" name="employments[${index}][company_name]" placeholder="Company Name">
        </div>
        <div class="input-area">
            <label for="start_date_${index}" class="form-label">Start Date</label>
            <input id="start_date_${index}" type="date" class="form-control" name="employments[${index}][start_date]">
        </div>
        <div class="input-area">
            <label for="end_date_${index}" class="form-label">End Date</label>
            <input id="end_date_${index}" type="date" class="form-control" name="employments[${index}][end_date]">
        </div>
        <div class="input-area">
            <label for="year_of_work_${index}" class="form-label">Years of Work</label>
            <input id="year_of_work_${index}" type="text" class="form-control" name="employments[${index}][year_of_work]" readonly>
        </div>
        <div class="mt-6" style="display:flex; justify-content:flex-start">
            <button class="btn btn-danger remove-employment" style="padding:0px 16px 0px 16px" type="button"><iconify-icon icon="heroicons-outline:trash" class="text-2xl"></iconify-icon></button>
        </div>
    </div>`;
            employmentDiv.insertAdjacentHTML('beforeend', newEmploymentHtml);
            validateDatesAndCalculateYearsOfWork(); // Attach event listeners to the new form
        });
    
        document.getElementById('employment_div').addEventListener('click', function(event) {
            if (event.target.matches('.remove-employment')) {
                event.target.closest('.grid-cols-6').remove();
                employmentCount = document.querySelectorAll('.grid-cols-6').length; // Update count after removal
                validateDatesAndCalculateYearsOfWork(); // Re-validate and calculate years of work for all remaining forms
            }
        });
    
        validateDatesAndCalculateYearsOfWork(); // Initial setup to bind events and perform calculations
    });
</script>
    
<script>
    $(document).ready(function() {
        // Initialize Select2 on your select element
        $('#it_skills').select2({
            maximumSelectionLength: 5  // This option automatically limits the number of selectable options
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
    
@endsection