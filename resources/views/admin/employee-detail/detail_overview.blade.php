<div class="gy-5 g-xl-10 tab-pane fade show active" id="kt_tab_pane_1" role="tabpanel">
    <div class="row">
        <div class="col-xl-4 mb-5 mb-xl-10">
            <div class="card card-flush h-md-100" dir="ltr">
                <div class="card-header flex-nowrap pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-gray-900">Basic Personal
                            Information​</span>
                    </h3>
                </div>
                <div class="card-body p-9">
                    <div class="row mb-7">
                        <label class="col-lg-6 fw-semibold text-muted">Full Name</label>
                        <div class="col-lg-6">
                            {{-- <span class="fw-bold fs-6 text-gray-800">
                                {{ $user->first_name ?? 'N / A' }} {{ $user->middle_name ?? 'N / A' }}
                                {{ $user->last_name }}</span> --}}
                        <span class="fw-bold fs-6 text-gray-800">
                                {{ $user->name ?? 'N / A' }}</span>
                        </div>
                    </div>
                    <div class="row mb-7">
                        <label class="col-lg-6 fw-semibold text-muted">Gender</label>
                        <div class="col-lg-6">
                            <span class="fw-bold fs-6 text-gray-800">
                                @if ($user->gender == 0)
                                Male
                                @elseif ($user->gender == 1)
                                Female
                                @else
                                N / A
                                @endif
                            </span>
                        </div>
                    </div>
                    <div class="row mb-7">
                        <label class="col-lg-6 fw-semibold text-muted">Date of Birth</label>
                        <div class="col-lg-6">
                            <span class="fw-bold fs-6 text-gray-800">
                                @if ($user->birth_date == '0000-00-00')
                                N / A
                                @else
                                {{ $user->birth_date ?? 'N / A' }}
                                @endif
                            </span>
                        </div>
                    </div>
                    <div class="row mb-7">
                        <label class="col-lg-6 fw-semibold text-muted">Civil Status</label>
                        <div class="col-lg-6">
                            <span class="fw-bold fs-6 text-gray-800">
                                {{ config('constants.MARITAL_STATUSES.' . $user->marital_status ?? 'N / A') }}</span>
                        </div>
                    </div>
                    <div class="row mb-7">
                        <label class="col-lg-6 fw-semibold text-muted">Nationality</label>
                        <div class="col-lg-6">
                            <span class="fw-bold fs-6 text-gray-800">
                                {{ $user->country->name ?? 'N / A' }}</span>
                        </div>
                    </div>

                    <div class="row mb-7">
                        <label class="col-lg-6 fw-semibold text-muted">House/Building Number and Street
                            Name:
                        </label>
                        <div class="col-lg-6">
                            <span
                                class="fw-bold fs-6 text-gray-800">{{ $user->home_address ?? 'N / A' }}</span>
                        </div>
                    </div>
                    <!-- <div class="row mb-7">
                        <label class="col-lg-6 fw-semibold text-muted">Barangay/Subdivision: </label>
                        <div class="col-lg-6">
                            <span
                                class="fw-bold fs-6 text-gray-800">{{ $user->barangay->name ?? 'N / A' }}</span>
                        </div>
                    </div> -->
                    <div class="row mb-7">
                        <label class="col-lg-6 fw-semibold text-muted">City: </label>
                        <div class="col-lg-6">
                            <span
                                class="fw-bold fs-6 text-gray-800">{{ $user->cityName->name ?? 'N / A' }}</span>
                        </div>
                    </div>
                    <div class="row mb-7">
                        <label class="col-lg-6 fw-semibold text-muted">State: </label>
                        <div class="col-lg-6">
                            <span
                                class="fw-bold fs-6 text-gray-800">{{ $user->province->name ?? 'N / A' }}</span>
                        </div>
                    </div>
                    <div class="row mb-7">
                        <label class="col-lg-6 fw-semibold text-muted">Postal Code: </label>
                        <div class="col-lg-6">
                            <span
                                class="fw-bold fs-6 text-gray-800">{{ $user->postal_code ?? 'N / A' }}</span>
                        </div>
                    </div>

                    <div class=" pt-5">
                        <h3 class="card-title align-items-start flex-column mb-5">
                            <span class="card-label fw-bold text-gray-900">Contact Information​</span>
                        </h3>
                    </div>
                    <div class="row mb-7">
                        <label class="col-lg-4 fw-semibold text-muted">Email Address (Official)</label>
                        <div class="col-lg-8 fv-row">
                            <span class="fw-semibold text-gray-800 fs-6">
                                {{ $user->email ?? 'N / A' }}</span>
                        </div>
                    </div>
                    <div class="row mb-7">
                        <label class="col-lg-4 fw-semibold text-muted">Email Address (Personal)</label>
                        <div class="col-lg-8 fv-row">
                            <a>
                                <span class="fw-semibold text-gray-800 fs-6">
                                    {{ $user->secondary_email ?? 'N / A' }}</span>
                            </a>
                        </div>
                    </div>
                    <div class="row mb-7">
                        <label class="col-lg-4 fw-semibold text-muted">
                            Mobile Number
                        </label>
                        <div class="col-lg-8 d-flex align-items-center">
                            <span class="fw-bold fs-6 text-gray-800 me-2">
                                {{ $user->mobile_number ?? 'N / A' }}</span>
                        </div>
                    </div>
                   {{--
                    <div class=" pt-5">
                        <!--begin::Title-->
                        <h3 class="card-title align-items-start flex-column mb-5">
                            <span class="card-label fw-bold text-gray-900">Government Identifications​​</span>

                        </h3>
                        <!--end::Title-->


                    </div> --}}
                    <!--begin::Input group-->
                    {{-- <div class="row mb-7">
                        <!--begin::Label-->
                        <label class="col-lg-6 fw-semibold text-muted">Tax Identification Number (TIN)</label>
                        <!--end::Label-->

                        <!--begin::Col-->
                        <div class="col-lg-6">
                            <a href="#" class="fw-semibold fs-6 text-gray-800 text-hover-primary">
                                {{ $user->tin_number ?? '' }}</a>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <div class="row mb-7">
                        <!--begin::Label-->
                        <label class="col-lg-6 fw-semibold text-muted">Social Security System (SSS) Number</label>
                        <!--end::Label-->

                        <!--begin::Col-->
                        <div class="col-lg-6">
                            <a href="#" class="fw-semibold fs-6 text-gray-800 text-hover-primary">
                                {{ $user->sss_number ?? '' }}</a>
                        </div>
                        <!--end::Col-->
                    </div>
                    <div class="row mb-7">
                        <!--begin::Label-->
                        <label class="col-lg-6 fw-semibold text-muted">Pag-IBIG Fund (HDMF) Number</label>
                        <!--end::Label-->

                        <!--begin::Col-->
                        <div class="col-lg-6">
                            <a href="#" class="fw-semibold fs-6 text-gray-800 text-hover-primary">
                                {{ $user->hdmf_number ?? '' }}</a>
                        </div>
                        <!--end::Col-->
                    </div>
                    --}}
                    {{-- <div class="row mb-7">
                        <!--begin::Label-->
                        <label class="col-lg-6 fw-semibold text-muted">PhilHealth Number</label>
                        <!--end::Label-->

                        <!--begin::Col-->
                        <div class="col-lg-6">
                            <a href="#" class="fw-semibold fs-6 text-gray-800 text-hover-primary">
                                {{ $user->phil_number ?? '' }}</a>
                        </div>
                        <!--end::Col-->
                    </div> --}}
                    {{-- <div class=" pt-5">
                        <h3 class="card-title align-items-start flex-column mb-5">
                            <span class="card-label fw-bold text-gray-900">Government
                                Identifications​​</span>

                        </h3>
                    </div>
                    <div class="row mb-7">
                        <label class="col-lg-6 fw-semibold text-muted">Tax Identification Number
                            (TIN)</label>
                        <div class="col-lg-6">
                            <a href="#"
                                class="fw-semibold fs-6 text-gray-800 text-hover-primary">
                                {{ $user->tin_number ?? '' }}</a>
                </div>
            </div>
            <div class="row mb-7">
                <label class="col-lg-6 fw-semibold text-muted">Social Security System (SSS)
                    Number</label>
                <div class="col-lg-6">
                    <a href="#"
                        class="fw-semibold fs-6 text-gray-800 text-hover-primary">
                        {{ $user->sss_number ?? '' }}</a>
                </div>
            </div>
            <div class="row mb-7">
                <label class="col-lg-6 fw-semibold text-muted">Pag-IBIG Fund (HDMF)
                    Number</label>
                <div class="col-lg-6">
                    <a href="#"
                        class="fw-semibold fs-6 text-gray-800 text-hover-primary">
                        {{ $user->hdmf_number ?? '' }}</a>
                </div>
            </div>
            <div class="row mb-7">
                <label class="col-lg-6 fw-semibold text-muted">PhilHealth Number</label>
                <div class="col-lg-6">
                    <a href="#"
                        class="fw-semibold fs-6 text-gray-800 text-hover-primary">
                        {{ $user->phil_number ?? '' }}</a>
                </div>
            </div> --}}
        </div>
    </div>
</div>
<div class="col-xl-8 mb-xl-10">
    <div class="card card-flush h-lg-100">
        <div class="card-header flex-nowrap pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold text-gray-900">Educational Background​
                </span>
            </h3>
        </div>
        <div class="card-body p-6">
            <div class="row mb-7 col-lg-12 justify-content-between" style="margin-left: 3px;">
                <div class="col-lg-6 row">
                    <label class="col-lg-6 fw-semibold text-muted">Highest Educational
                        Attainment</label>
                    <div class="col-lg-6">
                        <span class="fw-bold fs-6 text-gray-800">
                            {{ $user->education_level_check->name ?? 'N / A' }}</span>
                    </div>
                </div>
                <div class="col-lg-6 row">
                    <label class="col-lg-6 fw-semibold text-muted">Name of
                        School/University​</label>
                    <div class="col-lg-6">
                        <span
                            class="fw-bold fs-6 text-gray-800">{{ $user->higher_learning->name ?? 'N / A' }}</span>
                    </div>
                </div>
                <div class="col-lg-6 row">
                    <label class="col-lg-6 fw-semibold text-muted">Course/Program​</label>
                    <div class="col-lg-6">
                        <span class="fw-bold fs-6 text-gray-800">
                            {{ $user->scope->name ?? 'N / A' }}</span>
                    </div>
                </div>
                <div class="col-lg-6 row">
                    <label class="col-lg-6 fw-semibold text-muted">Year of Graduated</label>
                    <div class="col-lg-6">
                        <span class="fw-bold fs-6 text-gray-800">
                            {{ $user->graduate_year ?? 'N / A' }}</span>
                    </div>
                </div>
            </div>
            <div class="card  mb-xl-8">
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold fs-3 mb-1">Work Experience​</span>
                    </h3>
                </div>
                <div class="card-body py-3">
                    <div class="table-responsive">
                        <table class="table table-row-gray-300 align-middle gs-0 gy-4">
                            <thead>
                                <tr>
                                    <th class="py-5 p-0 w-xxl-95px fw-bold">Previous Employers
                                    </th>
                                    <th class="py-5 p-0 w-xxl-95px fw-bold">Job Titles</th>
                                    <th class="py-5 p-0 w-xxl-95px fw-bold">Start Date</th>
                                    <th class="py-5 p-0 w-xxl-95px fw-bold">End Date</th>
                                    <th class="py-5 p-0 text-center  fw-bold">Duration of
                                        Employment</th>
                                    <th class="py-5 p-0 fw-bold">Key Responsibilties</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user->employments as $employment)
                                <tr>
                                    <td class="fw-bold p-0 text-muted">
                                        {{ $employment->company_name ?? 'N / A' }}
                                    </td>
                                    <td class="fw-bold p-0 text-muted">
                                        {{ $employment->job_title ?? 'N / A' }}
                                    </td>
                                    <td class="fw-bold p-0 text-muted">
                                        {{ $employment->start_date ?? 'N / A' }}
                                    </td>
                                    <td class="fw-bold p-0 text-muted">
                                        @if ($employment->end_date == '0000-00-00')
                                        Currently Working Here
                                        @else
                                        {{ $employment->end_date ?? 'N / A' }}
                                        @endif
                                    </td>
                                    <td class="fw-bold p-0 text-muted text-center">
                                        @if ($employment->year_of_work)
                                        {{ $employment->year_of_work }} {{ $employment->year_of_work == 1 ? 'year' : 'years' }}
                                        @else
                                        N / A
                                        @endif
                                    </td>
                                    <td class="fw-bold p-0 text-muted">
                                        {{ $employment->key_responsiblity ?? 'N / A' }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card  mb-xl-8 overflow-hidden">
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold fs-3 mb-1">Skills and
                            Certification​</span>
                    </h3>
                </div>
                <div class="card-body py-3">
                    <div class="mb-2 p-2">
                        <h5 class="">Relevant Skills</h5>

                        @if(!empty($user->skills) && is_string($user->skills))
                        @php
                        $skills = json_decode($user->skills, true);
                        @endphp

                        @if(is_array($skills))
                        @foreach ($skills as $skill)
                        <div class="badge badge-success">{{ $skill['value']}}</div>
                        @endforeach
                        @else
                        <p>No skills acquirred.</p>
                        @endif
                        @else
                        <p>No skills acquirred.</p>
                        @endisset
                    </div>
                    <div class="mb-2 p-2">
                        <h5 class="">Professional Certifications </h5>
                        @if ($user->professional_certificate)
                        @php
                        $certificates = json_decode(
                        $user->professional_certificate,
                        true,
                        );
                        @endphp
                        @if (is_array($certificates) && count($certificates) > 0)
                        @foreach ($certificates as $skill)
                        <div class="badge badge-success">{{ $skill['value'] }}
                        </div>
                        @endforeach
                        @else
                        <p>No certifications available.</p>
                        @endif
                        @else
                        <p>No certifications available.</p>
                        @endisset
                    </div>
                    <div class="mb-2 p-2">
                        <h5 class="">Traning Program </h5>
                        @if(!empty($user->training_program) && is_string($user->training_program))
                        @php
                        $skills = json_decode($user->training_program, true);
                        @endphp
                        @if(is_array($skills))
                        @foreach ($skills as $skill)
                        <div class="badge badge-success">{{ $skill['value'] }}</div>
                        @endforeach
                        @else
                        <p>No training attended.</p>
                        @endif
                        @else
                        <p>No training attended.</p>
                        @endisset
                    </div>
                </div>
            </div>
            <div class="card  mb-xl-8">
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold fs-3 mb-1">Emergency Contact
                            Information​</span>
                    </h3>
                </div>
                <div class="card-body py-3">
                    <div class="table-responsive">
                        <table class="table table-row-gray-300 align-middle gs-0 gy-4">
                            <thead>
                                <tr>
                                    <th class="py-5 p-0 w-xxl-95px fw-bold">Name of Person</th>
                                    <th class="py-5 p-0 w-xxl-95px fw-bold">Relationship</th>
                                    <th class="py-5 p-0 w-xxl-95px fw-bold">Contact Number</th>
                                    <th class="py-5 p-0 w-xxl-95px fw-bold text-center">Address
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="fw-bold p-0 text-muted">
                                        {{ $user->ec_contact_person_name ?? 'N / A' }}
                                    </td>
                                    <td class="fw-bold p-0 text-muted">
                                        {{ config('constants.RELATION_EMPLOYEE.' . $user->ec_relation_employee, 'N / A') }}
                                    </td>
                                    <td class="fw-bold p-0 text-muted">
                                        {{ $user->ec_contact_person_number ?? 'N / A' }}
                                    </td>
                                    <td class="fw-bold p-0 text-muted text-center">
                                        @php
                                        $allEmpty = empty($user->ec_home_address) &&
                                        empty($user->ecBarangay) &&
                                        empty($user->ecCityName) &&
                                        empty($user->ecProvince) &&
                                        empty($user->ec_postal_code);
                                        @endphp

                                        @if($allEmpty)
                                        N / A
                                        @else
                                        @if($user->ec_home_address)
                                        Address: {{ $user->ec_home_address ?? 'N / A' }} <br>
                                        @endif

                                        @if($user->ecBarangay)
                                        Sub Division/Barangay: {{ $user->ecBarangay->name ?? 'N / A'  }} <br>
                                        @endif

                                        @if($user->ecCityName)
                                        City: {{ $user->ecCityName->name ?? 'N / A'  }} <br>
                                        @endif

                                        @if($user->ecProvince)
                                        Province: {{ $user->ecProvince->name ?? 'N / A' }} <br>
                                        @endif

                                        @if($user->ec_postal_code)
                                        Postal Code: {{ $user->ec_postal_code ?? 'N / A' }} <br>
                                        @endif
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-lg-6 card card-body">
                    <h6>Consent for data processing and sharing as per the Data Privacy Act​
                    </h6>
                </div>
                <div class="col-lg-6 card card-body">
                    <h6>Acknowledgement of company policies and procedures</h6>
                </div>
                <div>
                    <p class="fw-bold mt-2 text-danger">Both to be digitally signed by
                        employees when signing up @ Talent Module</p>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!--begin:: Panel 1-->
</div>