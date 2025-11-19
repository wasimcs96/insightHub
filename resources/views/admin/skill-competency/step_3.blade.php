@extends('admin.layout.app')

@section('title', 'Roles')

@section('styles')
<style>
    .displayNone {
        display: none;
    }

    .report-message-container {
        text-align: center;
        padding: 50px;
        color: #6c757d;
        font-family: Arial, sans-serif;
    }

    .report-message-container h2 {
        margin-bottom: 16px;
        font-size: 24px;
    }

    .report-message-container p {
        margin-bottom: 24px;
        font-size: 16px;
    }

    .report-link-button {
        display: inline-block;
        padding: 10px 20px;
        font-size: 16px;
        color: #f7941d;
        border: 1px solid #f7941d;
        border-radius: 22px;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }

    .step-bar-wrapper {
        font-size: 0;
        background: #fff;
        text-align: center;
        padding: 50px 0 0;
        width: 100%;
        margin: 30px auto 0;
        position: relative;
        z-index: 10;
        border-radius: 10px
    }

    a {
        color: #5c399e;
    }

    .step-wrapper {
        padding: 0;
        margin: 0;
        font-size: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        counter-reset: step;
    }

    .step-wrapper li {
        width: 120px;
    }

    .step-wrapper li>a:before {
        content: '';
        width: 36px;
        height: 36px;
        display: block;
        font-size: 16px;
        font-weight: 700;
        background-color: transparent;
        border-radius: 100%;
        z-index: 1;
        position: absolute;
        text-align: center;
    }

    .step-wrapper li>a:after {
        content: counter(step);
        counter-increment: step;
        width: 36px;
        line-height: 36px;
        display: block;
        font-size: 16px;
        color: #bbb;
        font-weight: 700;
        background-color: transparent;
        border-radius: 100%;
        z-index: 1;
        position: absolute;
        text-align: center;
    }

    .step-wrapper li.completed>a:after {
        content: '\2713';
        color: currentColor;
    }

    .step-wrapper li:first-of-type a:before,
    .step-wrapper li:first-of-type a:after {
        margin-left: -42px;
    }

    .step-wrapper li:last-of-type>a:before,
    .step-wrapper li:last-of-type>a:after {
        margin-left: 39px;
    }

    .step-wrapper li.completed>a:before {
        background: #fff;
        color: #c4c4c4;
        -webkit-box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.15);
        box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.15);
    }

    .step-wrapper li.active>a:before {
        background-color: #f7941d;
        -webkit-box-shadow: 0px 0px 0px 0px rgba(0, 0, 0, 0.15), inset 0px 0px 0px 0px rgba(0, 0, 0, 0.15), 0px 0px 9px 0px #f7941d;
        background-image: -webkit-gradient(linear, left top, left bottom, from(rgba(247, 247, 247, 0.5)), to(rgba(231, 231, 231, .01)));
        background-image: -webkit-linear-gradient(top, rgba(247, 247, 247, 0.5), rgba(231, 231, 231, .01));
    }

    .step-wrapper li.active>a:after {
        color: #fff;
    }

    .step-wrapper li span {
        display: block;
        width: 100%;
        text-align: center;
        margin-bottom: 15px;
    }

    .step-wrapper li span a {
        font-size: 14px;
        font-weight: 700;
    }

    .step-wrapper li:not(.active):not(.completed) span a {
        color: #bbb;
    }

    .step-wrapper li>a {
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: hidden;
        height: 48px
    }

    .step-wrapper li:first-of-type>a {
        padding-left: 40px;
    }

    .step-wrapper li:last-of-type>a {
        padding-right: 40px;
    }

    .step-wrapper li>a svg {
        height: 48px;
        min-height: 48px;
        width: auto;
        position: absolute;
        display: inline-block;
        stroke-width: 0;
        transition: all 300ms ease-in-out;
    }

    .step-wrapper li>a svg {
        filter: url(#inset-shadow);
    }

    a.button {
        margin: 50px 15px;
        display: inline-block;
        border-radius: 4px;
        width: 100px;
        height: 50px;
        text-align: center;
        line-height: 50px;
        background-color: currentColor;
        -webkit-box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.15), inset 0px 0px 0px 2px rgba(0, 0, 0, 0.15), 0px 0px 21px 0px currentColor;
        box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.15), inset 0px 0px 0px 2px rgba(0, 0, 0, 0.15), 0px 0px 21px 0px currentColor;
        background-image: -webkit-gradient(linear, left top, left bottom, from(rgba(247, 247, 247, 0.5)), to(rgba(231, 231, 231, .01)));
    }

    a.button span {
        color: #fff;
        font-size: 16px;
    }

    .skill-container {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }

    .skill-row {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }

    .rating {
        display: flex;
    }

    .rating label {
        width: 22px;
        height: 22px;
        border-radius: 50%;
        background-color: #eee;
        display: inline-block;
        padding: 0px 6px;
        position: relative;
    }

    .rating input[type="radio"]:checked+label {
        background-color: #FFFAEB !important;
        color: #B54708 !important;
    }

    .remarks {
        border: 1px solid #ccc;
        border-radius: 4px;
        padding: 5px 10px;
        flex: 1;
    }

    .checkbox_tech:checked {
        background-color: #f7941d;
    }

    .button-container {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        background-color: #ffffff;
        text-align: center;
        border-top: 1px dashed #DBDFE9;
        z-index: 40;
    }

    .sticky-button {
        padding: 3px 18px;
        margin: 10px;
        font-size: 16px;
        cursor: pointer;
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
                    <a href="/admin/dashboard" class="text-muted text-hover-primary">
                        Admin </a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <!--end::Item-->

                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">
                    Compare </li>
                <!--end::Item-->

            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
        <!--begin::Actions-->

        <!--end::Actions-->
    </div>
    <!--end::Toolbar container-->
</div>
<!--end::Toolbar-->
<div id="kt_app_content" class="app-content  flex-column-fluid ">

    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container ">

        @include('admin/skill-competency.topnav')


        <div class="d-flex flex-column flex-lg-row mb-17">
            <!--begin::Sidebar-->
            <div class="flex-lg-row-auto w-100 w-lg-275px w-xxl-350px me-0 me-lg-10">

                <!--begin::Careers about-->
                <div class="card bg-light ">
                    <!--begin::Body-->
                    <div class="card-body">
                        <!--begin::Top-->
                        <div class="mb-7">
                            <!--begin::Title-->
                            <h2 class="fs-1 text-gray-800 w-bolder mb-6">
                                Employee Detail
                            </h2>
                            <!--end::Text-->
                        </div>
                        <!--end::Top-->


                        <!--begin::Item-->
                        <div class="mb-8">
                            <!--begin::Title-->
                            <!--end::Title-->

                            <!--begin::Section-->
                            <div class="my-2">
                                <!--begin::Row-->
                                @if (isset($data['users']) && count($data['users']) > 0)
                                @foreach ($data['users'] as $userData)
                                <div class=" align-items-center mb-5">
                                    <div class="text-dark-600 color-dark fw-semibold fs-4">Name</div>

                                    <div class="text-gray-600 fw-semibold fs-3">{{ $userData['name'] }}</div>

                                    <!--end::Label-->
                                </div>
                                @endforeach
                                @endif
                                <!--end::Row-->
                                <div class=" align-items-center mb-3 pt-4">
                                    <div class="text-dark-600 color-dark fw-semibold fs-4">Department</div>

                                    <div class="text-gray-600 fw-semibold fs-3">{{ $department->name ?? '' }}</div>

                                    <!--end::Label-->
                                </div>
                            </div>
                            <!--end::Section-->
                        </div>
                        <!--end::Item-->

                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Careers about-->

            </div>
            <!--begin::Content-->
            <div class="flex-lg-row-fluid ">
                <form action="{{ route('admin.skill-competencies.stepFour', $id) }}" id="step3form" method="POST">
                    <div class="flex-lg-row-fluid card card-body">

                        <h4 class="fs-3 text-gray-800 w-bolder mb-6 mt-4">Technical Skills</h4>

                        <input type="hidden" name="department_id" value="{{ $department->id ?? '' }}">
                        <input type="hidden" name="id" value="{{ $id ?? '' }}">
                        @csrf
                        @php
                        $maxLevel = 6; // Set a default value for maxLevel
                        @endphp
                        @foreach ($userData['technical_skills'] as $index => $skill)

                        <input type="hidden" value="{{ $skill['name'] }}" name="technical_skills[]">
                        <div class="skill-row justify-content-between mb-8 mt-8">
           
                            <div class="col-lg-2" data-bs-toggle="modal" data-bs-target="#techskillmodal" onclick="technicalpopulateModal('{{ $index }}', '{{ App\Helpers\MainHelper::escapeSpecialCharacters(json_encode($skill)) }}', '{{ $skill['name'] }}', '{{ $skill['pivot']['level'] }}')">
                                <label for="{{ $skill['name'] }}" class="fw-bold text-gray-800 fs-5">{{ $skill['name'] }}</label>
                            </div>
                            <div class="rating justify-content-around col-lg-7">
                                @for ($i = 1; $i <= $maxLevel; $i++) <div class="d-flex flex-column-reverse form-check form-check-custom form-check-warning form-check-solid">
                                    <input class="mt-10 form-check-input checkbox_tech" type="radio" id="technical_skill_{{ $skill['id'] }}_rate{{ $i }}" name="technical_levels[{{ $skill['name'] }}]" value="{{ $i }}" @if ($i==$skill['pivot']['level']) checked @endif />
                                    <label for="technical_skill_{{ $skill['id'] }}_rate{{ $i }}" class="fs-5 fw-bold">{{ $i }}</label>
                            </div>
                            @endfor

                        </div>
                        <div class="col-lg-3">
                            <p class="fs-5 fw-semibold">Remark</p>
                            <textarea type="text" name="technical_remarks[{{ $skill['name'] }}]" placeholder="Remarks..." class="remarks form-control form-control form-control-solid" data-kt-autosize="true">{{ $skill['remarks'] ?? '' }}</textarea>
                        </div>
                    </div>
                    <div class="separator separator-dashed"></div>
                    @endforeach


                    <div class="separator separator-dashed"></div>
            </div>

            <div class="flex-lg-row-fluid card card-body mt-5">
    <h4 class="fs-3 text-gray-800 w-bolder mb-6 mt-4">Soft Skills</h4>
    @php
        $maxLevel = 3;
        $levelLabels = ['Basic', 'Intermediate', 'Advanced'];
    @endphp

    @foreach ($userData['skills'] as $index => $skill)

        <input type="hidden" value="{{ $skill['id'] }}" name="soft_skills[]">
        <div class="skill-row justify-content-between mb-8 mt-8">
            <div class="col-lg-2">
            <label for="soft_skill_{{ $skill['id'] }}" class="fw-bold text-gray-800 fs-5">{{ $skill['title'] }}</label>
            </div>
            <div class="rating justify-content-around col-lg-7">
                @for ($i = 1; $i <= $maxLevel; $i++)
                    @if(isset($levelLabels[$i - 1]))
                        <div class="d-flex flex-column-reverse form-check form-check-custom form-check-warning form-check-solid" style="padding-left: 67px !important;">
                            <input class="mt-10 form-check-input checkbox_soft" type="radio" id="soft_skill_{{ $skill['title'] }}_rate{{ $i }}" name="soft_levels[{{ $skill['title'] }}]" value="{{ $i }}" {{ $i == $skill['level'] ? 'checked' : '' }} />
                            <label for="soft_skill_{{ $skill['title'] }}_rate{{ $i }}" class="fs-5 fw-bold w-100" style="border-radius: 16px;padding: 0px 10px 1px 10px;color:#344054">
                                {{ $levelLabels[$i - 1] }}
                            </label>
                        </div>
                    @endif
                @endfor
            </div>
            <div class="col-lg-3">
                <p class="fs-5 fw-semibold">Remark</p>
                <textarea type="text" name="soft_remarks[{{ $skill['title'] }}]" placeholder="Remarks..." class="remarks form-control form-control form-control-solid" data-kt-autosize="true">{{ $skill['remarks'] ?? '' }}</textarea>
            </div>
        </div>
    @endforeach
</div>

        </div>
        </form>
    </div>
</div>
<!--end::Content-->


<!--end::Sidebar-->
</div>
<!--end::Layout-->



</div>
</div>
{{-- footer --}}
<div class="button-container">
    <div class="d-flex justify-content-between">
        <a class="sticky-button fs-2 d-flex align-items-center" style="color:#f7941d" onclick="goBack()"><iconify-icon icon="ic:round-arrow-back-ios"></iconify-icon>Back</a>
        <button id="submitFormButton" class="sticky-button btn btn-primary">Submit</button>
    </div>
</div>

{{-- Technical Skill Modal Start --}}
<div class="modal bg-body fade" tabindex="-1" id="techskillmodal">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content shadow-none">
            <div class="modal-header">
                <h5 class="modal-title">Communication</h5>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <iconify-icon icon="line-md:close" class="fs-2x"></iconify-icon>
                </div>
            </div>

            <div class="modal-body">
                <div class="row g-5 modalbody">
                    <div class="col-lg-4">
                        <div class="card card-stretch card-bordered mb-5">
                            <div class="card-header">
                                <h3 class="card-title">Level 1</h3>
                            </div>
                            <div class="card-body">
                                Description Not Found
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card card-stretch card-bordered mb-5">
                            <div class="card-header">
                                <h3 class="card-title">Level 2</h3>
                            </div>
                            <div class="card-body">
                                Description Not Found
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card card-stretch card-bordered mb-5">
                            <div class="card-header">
                                <h3 class="card-title">Level 3</h3>
                            </div>
                            <div class="card-body">
                                Description Not Found
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
{{-- Technical Skill Modal End --}}
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $('#employees').select2({
            maximumSelectionLength: 5,
            placeholder: "Select Employees",
            allowClear: true
        });

        $('#departments').select2({
            maximumSelectionLength: 2,
            placeholder: "Select Department",
            allowClear: true
        });
    });

    function goBack() {
        history.back();
    }

    function technicalpopulateModal(index, data, skillTitle, selected_level) {
        data = JSON.parse(data);
        let modalBody = $('#techskillmodal .modalbody');
        modalBody.empty();
        $('#techskillmodal .modal-title').text(skillTitle);
        let selectedLevel = parseInt(selected_level, 10);

        for (let i = 1; i <= 6; i++) {
            let knowledge = data['level_' + i + '_knowledge'] || '';
            let ability = data['level_' + i + '_ability'] || '';

            if (data['level_' + i + '_description']) {
                modalBody.append(`
                    <div class="form-check col-lg-2">
                        <label class="form-check-label h-100 w-100" for="level_1">
                            <div class="col-lg-12 h-100">
                                <div class="card card-stretch card-bordered mb-5 h-100">
                                    <div class="card-header align-items-center">
                                        <h3 class="card-title">Level ${i}</h3>
                                        <input class="form-check-input border-dark" disabled type="radio" value="${i-1}" id="level_${i}" name="level" ${selectedLevel == i ? 'checked' : ''}>
                                    </div>
                                    <div class="card-body">
                                        <h5>${data['level_' + i + '_description']}</h5>
                                        <div class="p-3">
                                            <h4>Knowledge</h4>
                                            <div class="d-flex flex-column">
                                                ${createListFromString(knowledge)}
                                            </div>
                                        </div>
                                        <div class="p-3">
                                            <h4>Ability</h4>
                                            <div class="d-flex flex-column">
                                                ${createListFromString(ability)}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </label>
                    </div>
                `);
            } else {
                modalBody.append(`
                    <div class="form-check col-lg-2">
                        <label class="form-check-label h-100 w-100" for="level_1">
                            <div class="col-lg-12 h-100">
                                <div class="bg-gray-100 card card-stretch card-bordered mb-5 h-100">
                                    <div class="card-header align-items-center">
                                        <h3 class="card-title">Level ${i}</h3>
                                        <input class="form-check-input border-dark" disabled type="radio" value="${i-1}" id="level_${i}" name="level" ${selectedLevel == i ? 'checked' : ''}>
                                    </div>
                                    <div class="card-body"></div>
                                </div>
                            </div>
                        </label>
                    </div>
                `);
            }
        }
    }

    function createListFromString(str) {
        return str.split(';').filter(item => item.trim() !== '').map(item =>
            `<li class="d-flex align-items-center py-2"><span class="bullet me-5"></span>${item.trim()}</li>`).join('');
    }

    $('#submitFormButton').click(function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: "Once you click the Submit button, you will not be able to make any changes or submit again",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, submit it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#step3form').submit();
            }
        });
    });
</script>
@endsection
