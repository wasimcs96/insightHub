@extends('admin.layout.app')
@section('title', 'Settings - Weightage')

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
                Settings
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
                    Settings </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">
                    Weightage </li>
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


<div id="kt_app_content" class="app-content  flex-column-fluid ">

    <div id="kt_app_content_container" class="app-container  w-100 ">
        <div class="card mb-5 mb-xl-8 col-lg-6">
            <!--begin::Header-->
            {{-- <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold fs-3 mb-1">Potential Employee Listings</span>


                </h3>

            </div> --}}
            <!--end::Header-->

            <!--begin::Body-->
            <div class="card-body py-3">
                @include('admin.setting.includes.topnav')
                <div class="tab-content" id="pills-tabContentHorizontal">
                    <div class="tab-pane fade show active" id="pills-homeHorizontal" role="tabpanel"
                        aria-labelledby="pills-home-tabHorizontal">
                        <div class="card-text h-full w-xxl-600px">
                            <form class="space-y-4 w-96" action="#" method="POST" id="myForm">
                                @csrf


                                {{-- <div class="input-area relative">
                                    <label for="largeInput" class="form-label">Talent Profile % <iconify-icon
                                            icon="heroicons:exclamation-circle" class="toolTip onTop text-lg"
                                            data-tippy-content="Education Level, Qualifications, Field of Studies, Work Experience">
                                        </iconify-icon></label>
                                    <div class="relative">
                                        <input type="number" name="talent_profile"
                                            value="{{$setting->talent_profile ?? 0}}" class="form-control !pl-9"
                                            id="profile" placeholder="Enter Talent percentage" min="0" disabled>
                                    </div>
                                </div> --}}

                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                    <!--begin::Label-->
                                    <label class="required fw-semibold fs-6 mb-2">Talent Profile %</label>
                                    <!--end::Label-->

                                    <!--begin::Input-->
                                    <input type="number" class="form-control form-control-solid mb-3 mb-lg-0" name="talent_profile" placeholder="Enter Talent percentage" min="0" disabled
                                        value="{{$setting->talent_profile ?? 0}}">
                                    <!--end::Input-->

                                </div>



                                {{-- <div class="input-area relative">
                                    <label for="largeInput" class="form-label">Talent Pillar % <iconify-icon
                                            icon="heroicons:exclamation-circle" class="toolTip onTop text-lg"
                                            data-tippy-content="Based on 8 work competencies"></iconify-icon></label>
                                    <div class="relative">
                                        <input type="number" name="employee_profile"
                                            value="{{$setting->employee_profile ?? 0}}" class="form-control !pl-9"
                                            id="emp_profile" placeholder="Enter employee profile percentage" min="0"
                                            disabled>
                                    </div>
                                </div> --}}

                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                    <!--begin::Label-->
                                    <label class="required fw-semibold fs-6 mb-2">Talent Pillar % </label>
                                    <!--end::Label-->

                                    <!--begin::Input-->
                                    <input type="number" class="form-control form-control-solid mb-3 mb-lg-0" name="employee_profile" placeholder="Enter employee profile percentage" min="0" disabled
                                        value="{{$setting->employee_profile ?? 0}}">
                                    <!--end::Input-->

                                </div>

                                {{-- <div class="input-area relative">
                                    <label for="largeInput" class="form-label">Soft Skills %
                                        <iconify-icon icon="heroicons:exclamation-circle" class="toolTip onTop text-lg"
                                            data-tippy-content="OCEAN, RIASEC, Cognitive Abilities"></iconify-icon>
                                    </label>
                                    <div class="relative">
                                        <input type="number" name="soft_skill" value="{{$setting->soft_skill ?? 0}}"
                                            class="form-control !pl-9" id="softskill"
                                            placeholder="Enter softskill percentage" min="0" disabled>

                                    </div>
                                </div> --}}


                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                    <!--begin::Label-->
                                    <label class="required fw-semibold fs-6 mb-2">Soft Skills %</label>
                                    <!--end::Label-->

                                    <!--begin::Input-->
                                    <input type="number" class="form-control form-control-solid mb-3 mb-lg-0" name="soft_skill"  placeholder="Enter softskill percentage" min="0" disabled
                                        value="{{$setting->soft_skill ?? 0}}">
                                    <!--end::Input-->

                                </div>

                                {{-- <button class="btn inline-flex justify-center btn-dark">Submit</button> --}}
                            </form>
                        </div>


                    </div>


                </div>
            </div>
        </div>
    </div>

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#myForm').submit(function(event) {
            var profile = $('#profile').val();
            var emp_profile = $('#emp_profile').val();
            var softskill = $('#softskill').val();
            var isValid = true;

            // Simple validation checks
            if (profile === '') {

                $('#profile').next('.error').remove();
                $('#profile').after('<span class="error">Talent Profile is required</span>');
                isValid = false;
            } else {
                $('#profile').next('.error').remove();
            }

            if (emp_profile === '') {
                $('#emp_profile').next('.error').remove();
                $('#emp_profile').after('<span class="error">Employee Profile required</span>');
                isValid = false;
            } else {
                $('#emp_profile').next('.error').remove();
            }

            if (softskill === '') {
                $('#softskill').next('.error').remove();
                $('#softskill').after('<span class="error">Soft Skill is required</span>');
                isValid = false;
            } else {
                $('#softskill').next('.error').remove();
            }

            // Prevent the form submission if validation fails
            if (!isValid) {
                event.preventDefault();
            }
        });
    });

</script>

@endsection
