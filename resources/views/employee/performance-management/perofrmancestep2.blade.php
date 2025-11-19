@extends('employee.layout.app')

@section('title', 'Roles')

@section('styles')
<style>
    .displayNone {
        display: none;
    }

    .report-message-container {
        text-align: center;
        /* Centers the text */
        padding: 50px;
        /* Adds space around the content */
        color: #6c757d;
        /* Sets the text color */
        font-family: Arial, sans-serif;
        /* Sets the font style */
    }

    .report-message-container h2 {
        margin-bottom: 16px;
        /* Space below the header */
        font-size: 24px;
        /* Sets the font size for the header */
    }

    .report-message-container p {
        margin-bottom: 24px;
        /* Space below the paragraph */
        font-size: 16px;
        /* Sets the font size for the paragraph */
    }

    .report-link-button {
        display: inline-block;
        /* Makes the link a block-level element */
        padding: 10px 20px;
        /* Adds padding inside the button */
        font-size: 16px;
        /* Sets the font size for the button */
        color: #f7941d;
        /* Sets the text color for the button */
        border: 1px solid #f7941d;
        /* Sets the background color for the button */
        border-radius: 22px;
        /* Rounds the corners of the button */
        text-decoration: none;
        /* Removes the underline from the link */
        transition: background-color 0.3s ease;
        /* Adds a transition effect when hovering or focusing */
    }


    .step-bar-wrapper {
        font-size: 0;
        background: #fff;
        text-align: center;
        padding: 50px 0 0;
        /* box-shadow:5px 5px 24px 0px rgba(0, 0, 0, 0.2); */
        width: 100%;
        margin: 30px auto 0;
        position: relative;
        z-index: 10;
        border-radius: 10px
    }

    /* .form-check-custom {
                padding-left: 67px !important;
            } */

    a {
        color: #5c399e;
        /* change primary color */
    }

    .step-wrapper {
        padding: 0;
        margin: 0;
        font-size: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        counter-reset: step;
        tr
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
        background-image: -webkit-gradient(linear, left top, left bottom, from(rgba(247, 247, 247, 0.5)), to(rgba(231, 231, 231, .01)));
        background-image: -webkit-linear-gradient(top, rgba(247, 247, 247, 0.5), rgba(231, 231, 231, .01));
        background-image: -moz-linear-gradient(top, rgba(247, 247, 247, 0.5), rgba(231, 231, 231, .01));
        background-image: -ms-linear-gradient(top, rgba(247, 247, 247, 0.5), rgba(231, 231, 231, .01));
        background-image: -o-linear-gradient(top, rgba(247, 247, 247, 0.5), rgba(231, 231, 231, .01));
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
        background-image: -webkit-gradient(linear, left top, left bottom, from(rgba(247, 247, 247, 0.5)), to(rgba(231, 231, 231, .01)));
        background-image: -webkit-linear-gradient(top, rgba(247, 247, 247, 0.5), rgba(231, 231, 231, .01));
        background-image: -moz-linear-gradient(top, rgba(247, 247, 247, 0.5), rgba(231, 231, 231, .01));
        background-image: -ms-linear-gradient(top, rgba(247, 247, 247, 0.5), rgba(231, 231, 231, .01));
        background-image: -o-linear-gradient(top, rgba(247, 247, 247, 0.5), rgba(231, 231, 231, .01));
    }

    a.button span {
        color: #fff;
        font-size: 16px;
    }

    .skill-container {
        background-color: #fff;
        /* White background for the skill container */
        padding: 20px;
        /* Padding inside the skill container */
        border-radius: 8px;
        /* Rounded corners */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        /* Subtle shadow */
        margin-bottom: 20px;
        /* Space between each skill container */
    }

    .skill-row {
        display: flex;
        /* Uses flexbox for layout */
        align-items: center;
        /* Centers items vertically */
        margin-bottom: 15px;
        /* Space between rows */
    }


    .rating {
        display: flex;
        /* Aligns radio buttons in a row */
    }



    .rating input[type="radio"]:checked+label {
        background-color: #FFFAEB !important;
        color: #B54708 !important;
        /* Orange color when selected */
    }


    .remarks {
        border: 1px solid #ccc;
        /* Border for the remarks input */
        border-radius: 4px;
        /* Rounded corners for the input */
        padding: 5px 10px;
        /* Padding inside the input */
        flex: 1;
        /* Allows input to expand */
    }

    .checkbox_tech:checked {
        background-color: #f7941d;
    }
</style>
<style>
    /* Styling for the container holding the buttons */
    .button-container {
        position: fixed;
        /* Fixed positioning to make it stick */
        bottom: 0;
        /* Align to the bottom of the page */
        left: 0;
        /* Align to the left side of the page */
        width: 100%;
        /* Full width */
        background-color: #ffffff;
        /* Light grey background */
        text-align: center;
        /* Center the buttons inside the container */
        border-top: 1px dashed #DBDFE9;
        z-index: 40;
    }

    /* Styling for each button */
    .sticky-button {
        padding: 3px 18px;
        /* Padding around text */
        margin: 10px;
        /* Space between buttons */
        font-size: 16px;
        /* Font size */
        cursor: pointer;
        /* Cursor to pointer to indicate it's clickable */
    }
</style>
@endsection
@section('content')
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                Dashboard
            </h1>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <li class="breadcrumb-item text-muted">
                    <a href="/admin/dashboard" class="text-muted text-hover-primary">
                        Performance Management
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">
                    Review
                </li>
            </ul>
        </div>
    </div>
</div>
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">
        <div class="d-flex flex-column flex-lg-row mb-17">
            <div class="flex-lg-row-fluid">
                <form action="{{ route('performance.management.performanceStepThree') }}" id="step3form" method="POST">
                    @csrf
                    <div class="flex-lg-row-fluid card card-body">
                        <h4 class="fs-3 text-gray-800 w-bolder mb-6 mt-4">KPI Review</h4>
                        @foreach ($skills['kpi'] as $index => $kpi)
                        <input type="hidden" value="{{ $kpi['id'] }}" name="kpi_ids[{{ $index }}]">
                        <input type="hidden" value="{{ $kpi['object'] }}" name="kpi_objects[]">
                        <input type="hidden" value="{{ $kpi_type }}" name="kpi_type">
                        <div class="skill-row justify-content-between mb-8 mt-8">
                            <div class="rating justify-content-around col-lg-12">
                                <div class="col-lg-2">
                                    <label for="{{ $kpi['object'] }}_label_{{ $index }}" class="fw-bold text-gray-800 fs-5">{{ $kpi['object'] }}</label>
                                </div>
                                @for ($i = 1; $i <= 4; $i++) <div class="d-flex flex-column-reverse form-check form-check-custom form-check-warning form-check-solid">
                                    <input class="mt-10 form-check-input checkbox_kpi" type="radio" id="{{ $kpi['object'] }}_rate{{ $index }}_{{ $i }}" name="kpi_levels[{{ $index }}]" value="{{ $i }}" @if ($i==1) checked @endif />
                                    <label for="{{ $kpi['object'] }}_rate{{ $index }}_{{ $i }}" class="fs-5 fw-bold">{{ $i }}</label>
                            </div>
                            @endfor
                            <div class="col-lg-3">
                                <p class="fs-5 fw-semibold">Remark</p>
                                <textarea type="text" name="kpi_achievements[{{ $index }}]" placeholder="Remarks..." class="remarks form-control form-control-solid" data-kt-autosize="true"></textarea>
                            </div>
                        </div>
                    </div>
                    @endforeach
            </div>
            <div class="separator separator-dashed"></div>
            <div class="flex-lg-row-fluid card card-body mt-5">
    <h4 class="fs-3 text-gray-800 w-bolder mb-6 mt-4">Technical Skills Review</h4>
    @php
        $maxLevel = 6; // Set a default value for maxLevel
    @endphp
    @foreach ($skills['technicalSkills'] as $index => $skill)
        <input type="hidden" value="{{ $skill['title'] }}" name="technical_skills[]">
        <div class="skill-row justify-content-between mb-8 mt-8">
            <div class="rating justify-content-around col-lg-12">
                <div class="col-lg-2">
                    <label for="{{ $skill['title'] }}" class="fw-bold text-gray-800 fs-5">{{ $skill['title'] }}</label>
                </div>
                @for ($i = 1; $i <= $maxLevel; $i++)
                    @php
                        $checkedLevel = isset($technicalSkillsReviewsDetails[$index]) ? $technicalSkillsReviewsDetails[$index]->level : null;
                        $isChecked = $checkedLevel == $i;
                    @endphp
                    <div class="d-flex flex-column-reverse form-check form-check-custom form-check-warning form-check-solid">
                        <input class="mt-10 form-check-input checkbox_tech" type="radio" id="{{ $skill['title'] }}_rate{{ $i }}" name="technical_levels[{{ $skill['title'] }}]" value="{{ $i }}" @if ($isChecked) checked @endif />
                        <label for="{{ $skill['title'] }}_rate{{ $i }}" class="fs-5 fw-bold">{{ $i }}</label>
                    </div>
                @endfor
                <div class="col-lg-3">
                    <p class="fs-5 fw-semibold">Remark</p>
                    <textarea type="text" name="technical_remarks[{{ $skill['title'] }}]" placeholder="Remarks..." class="remarks form-control form-control-solid" data-kt-autosize="true">
@if (isset($technicalSkillsReviewsDetails[$index]))
    {{ $technicalSkillsReviewsDetails[$index]->remark }}
@endif
</textarea>
                </div>
            </div>
        </div>
                <div class="separator separator-dashed"></div>
                @endforeach
            </div>

            <div class="flex-lg-row-fluid card card-body mt-5">
                <h4 class="fs-3 text-gray-800 w-bolder mb-6 mt-4">Soft Skills Review</h4>
                @php
                            $maxLevel = 2; // Change maxLevel to 2
                            $levelLabels = ['Basic', 'Intermediate', 'Advanced']; // Remove keys from $levelLabels
                        @endphp

                @foreach ($skills['softSkills'] as $index => $skill)

                <input type="hidden" value="{{ $skill['title'] }}" name="soft_skills[]">
                <div class="skill-row justify-content-between mb-8 mt-8">
                    <div class="rating justify-content-around col-lg-12">
                        <div class="col-lg-2">
                            <label for="{{ $skill['title'] }}" class="fw-bold text-gray-800 fs-5">{{ $skill['title'] }}</label>
                        </div>
                        @for ($i = 0; $i <= $maxLevel; $i++)
                        <div class="d-flex flex-column-reverse form-check form-check-custom form-check-warning form-check-solid">
                            <input class="mt-10 form-check-input checkbox_soft" type="radio" id="{{ $skill['title'] }}_rate{{ $i }}" name="soft_levels[{{ $skill['title'] }}]" value="{{ $i }}"{{ $i == $skill['level'] ? 'checked' : '' }} />
                            <label for="{{ $skill['title'] }}_rate{{ $i }}" class="fs-5 fw-bold w-100" style="border-radius: 16px; padding: 0px 10px 1px 10px; color: #344054;">
                                {{ $i }}
                            </label>
                    </div>
                    @endfor
                    <div class="col-lg-3">
                        <p class="fs-5 fw-semibold">Remark</p>
                        <textarea type="text" name="soft_remarks[{{ $skill['title'] }}]" placeholder="Remarks..." class="remarks form-control form-control-solid" data-kt-autosize="true">
                        @if (isset($softSkillsReviewsDetails[$index]))
                            {{ $softSkillsReviewsDetails[$index]->remark }}
                        @endif
                    </textarea>
                    </div>
                </div>
            </div>
            <div class="separator separator-dashed"></div>
            @endforeach
        </div>

    </div>
</div>


</div>
</div>
<div class="button-container">
    <div class="d-flex justify-content-between">
        <a class="sticky-button fs-2 d-flex align-items-center" style="color:#f7941d" onclick="goBack()"><iconify-icon icon="ic:round-arrow-back-ios"></iconify-icon>Back</a>
        <button onclick="document.getElementById('step3form').submit();" class="sticky-button btn btn-primary">Submit</button>
    </div>
</div>
</form>
@endsection
@section('scripts')
<script>
    function technicalpopulateModal(index, data, skillTitle, selected_level) {
        // console.log('technicalpoopupmodal', data);

        data = JSON.parse(data);
        // console.log(data.level_4_knowledge);
        let modalBody = $('#techskillmodal .modalbody');
        // console.log(selected_level);
        // console.log(level_2);
        modalBody.empty(); // Clear existing modal content
        // console.log(modalBody);

        $('#techskillmodal .modal-title').text(skillTitle);
        // levels.forEach(level => {
        let selectedLevel = parseInt(selected_level, 10);
        console.log('updateed selected', selectedLevel);
        for (let i = 1; i <= 6; i++) {
            // console.log('descriptor', data['level_' + i + '_description']);

            let knowledge = data['level_' + i + '_knowledge'] || '';

            let ability = data['level_' + i + '_ability'] || '';

            if (data['level_' + i + '_description']) {
                // console.log('in the condition')
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
                
            
                        <label class="form-check-label h-100 w-100" for="level_1 ">
                            <div class="col-lg-12 h-100">
                                    <div class="bg-gray-100 card card-stretch card-bordered mb-5 h-100">
                                        <div class="card-header align-items-center">
                                            <h3 class="card-title">Level ${i}</h3>
                                            <input class="form-check-input border-dark" disabled type="radio" value="${i-1}" id="level_${i}" name="level" ${selectedLevel == i ? 'checked' : ''}>

                                        </div>
                                        <div class="card-body">
                                            <h5></h5>
                                            <div class="p-3">
                                             
                                            
                                            </div>
                                            <div class="p-3">
                                               
                                            </div>
                                        </div>
                                    
                                    </div>
                            </div>
                        </label>
                    </div>
                `);
            }

        }


        // modalBody.append(`

        $('#techskillmodal .save-btn').data('skill-id', index); // Set skill ID on save button for later
    }
</script>
@endsection