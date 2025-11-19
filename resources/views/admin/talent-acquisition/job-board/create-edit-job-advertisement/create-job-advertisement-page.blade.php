@extends('admin.layout.app')

@section('title', 'Talent Acquisition')

@section('styles')

    <style>
        .form-control:focus,
        .input-group-text:focus {
            box-shadow: none !important;
            border-color: #ced4da !important;
        }

        .modal-step-form .nav-pills .nav-link {
            color: #99A1B7;
            font-size: 13.975px;
            font-weight: 500;
            display: flex;
            gap: 16px;
            align-items: center;
            padding: 0px;
        }

        .modal-step-form .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            background-color: transparent;
            color: #4B5675;
            font-weight: 700;
        }

        .modal-step-form .nav-pills .nav-link .circle-gray {
            border: 2px solid #DBDFE9;
            width: 24px;
            height: 24px;
            display: block;
            background: #fff;
            border-radius: 50%;
        }

        .modal-step-form .nav-pills .nav-link .circle-gray.active {
            background: #F7941C;
        }

        .modal-step-form .line-horizontal {
            width: 2px;
            height: 25px;
            display: block;
            background: #DBDFE9;
            margin: 4px 0px 4px 11px;
        }

        .modal-step-form .nav-pills {
            width: 28%;
            padding: 16px 0px;
            margin-right: 24px;
            position: sticky;
            top: 140px;
        }

        .modal-step-form .tab-content {
            width: 100%;
        }

        .modal-step-form .top-content {
            padding: 30px;
            border-radius: 8px 8px 0px 0px;
            border-bottom: 1px solid #F1F1F4;
            background: #FFF;
            box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.03);
        }

        .modal-step-form .top-content h3 {
            color: #071437;
            font-size: 22.75px;
            font-weight: 700;
            line-height: 27.3px;
        }

        .modal-step-form .top-content p {
            color: #4B5675;
            font-size: 14.95px;
            font-weight: 400;
            line-height: 22.425px;
            margin: 0;
        }

        .modal-step-form label {
            color: #071437;
            font-size: 12px;
            font-weight: 500;
            line-height: 16px;
        }

        .modal-step-form .input-grey {
            border-radius: 4px;
            background: #F1F1F4;
            border: 1px solid #DBDFE9;
        }

        .modal-step-form input,
        .modal-step-form select, .select {
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
        }

        .modal-step-form form>div,
        .jp-body {
            /* max-height: 45vh;
            overflow: scroll; */
            padding: 24px 30px 30px 30px;
            border-radius: 0px 0px 8px 8px;
            border-bottom: 1px solid #F1F1F4;
            background: #FFF;
            box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.03);
            margin: auto;
        }

        .workflow-bottom {
            margin: 24px 0px 11.5px 0px;
        }

        .workflow-bottom p {
            width: 200px;
            color: #99A1B7;
        }

        .workflow-bottom h5 {
            color: #4B5675;
            font-size: 13.975px;
            font-weight: 500;
            line-height:
        }

        .workflow-bottom h5 span {
            font-size: 19.5px;
            font-weight: 700;
            line-height: 23.4px;
        }

        .workflow-bottom .green {
            color: #2AA443;
        }

        .workflow-bottom .red {
            color: #F24130;
        }

        .red-bottom-text {
            color: #F24130 !important;
            font-size: 10px !important;
            margin: 0;
            width: 208px;
            line-height: normal !important;
        }

        .document-card input[type="radio"] {
            appearance: none;
            border: 1px solid #DBDFE9;
            padding: 8px;
            border-radius: 50%;
        }

        input[type="radio"]:checked {
            background-color: #F7941C;
        }

        input[type="checkbox"] {
            accent-color: #F7941C !important;
            border: 1px solid #DBDFE9;
            width: 15px;
            height: 15px;
            border-radius: 4px;
            cursor: pointer;
            margin: auto 0;
        }

        input[type="checkbox"]:checked {
            background-color: #F7941C;
            border: 1px solid #F7941C;
        }

        .optional {
            font-style: italic;
            color: #99A1B7;
            font-weight: 400;
        }

        .optional-bottom {
            color: #4B5675 !important;
            font-size: 10px !important;
            font-weight: 400 !important;
            line-height: 16px !important;
            margin-bottom: 8px;
        }

        .tag-container {
            display: flex;
            flex-wrap: wrap;
            gap: 4px 12px;
            align-items: center;
        }

        .tag {
            color: #4B5675;
            font-size: 12px;
            font-weight: 500;
            line-height: 16px;
            letter-spacing: 0.5px;
            display: flex;
            padding: 8px 16px;
            align-items: center;
            gap: 4px;
            border-radius: 80px;
            background: #F1F1F4;
            height: 32px;
        }

        .tag .remove-tag {
            background: none;
            border: none;
            cursor: pointer;
            color: #6C7280;
            font-size: 20px;
            padding: 0;
        }

        .tag-input {
            border: none;
            outline: none;
            flex-grow: 1;
            min-width: 120px;
            background: transparent;
        }

        .document-card {
            border-radius: 8px;
            padding: 20px !important;
            position: relative;
            border: 1px solid #C4CADA !important;
        }

        .document-card .close-btn {
            position: absolute;
            top: 10px;
            right: 16px;
            font-size: 22px;
            cursor: pointer;
            color: #78829D;
        }

        .review-card {
            padding: 16px 16px 32px 16px;
            border-radius: 8px;
            box-shadow: 0px 1px 4px 0px #0C0C0D10;
        }

        .review-card .accordion-item {
            border: 0;
        }

        .review-card .accordion-item .accordion-header {
            display: flex;
            align-items: center;
            gap: 8px;
            align-self: stretch;
            border-bottom: 1px solid #F3F3F3;
            background-color: #fff;
            padding-bottom: 16px;
            padding-right: 20px;
        }

        .review-card .accordion-body {
            padding: 24px 32px 0px 32px;
        }

        .review-card .accordion-item .accordion-button:not(.collapsed),
        .review-card .accordion-item .accordion-button {
            padding: 0;
            border-bottom: none;
            background-color: #fff;
            box-shadow: none;
            color: #292929;
            font-size: 19.5px;
            font-weight: 500;
            line-height: 23.4px;
        }

        .accordion-body h4 {
            color: #071437;
            font-size: 14px;
            font-weight: 500;
            line-height: 20px;
        }

        .accordion-body p {
            color: #78829D !important;
            font-size: 14px !important;
            font-weight: 500 !important;
            line-height: 20px !important;
        }

        .review-card .accordion-item .accordion-header .edit-button {
            padding: 8px 16px;
            justify-content: center;
            gap: 8px;
            border-radius: 4px;
            border: 1px solid #99A1B7;
            background: #FFF;
            position: relative;
            right: 40px;
            z-index: 10;
            color: #78829D;
            font-size: 12px;
            font-weight: 600;
            line-height: 16px;
            height: 32px;
        }

        .jp-header {
            padding: 24px 24px 24px 48px;
            border-radius: 8px 8px 0px 0px;
            border: 1px solid #F1F1F4;
            box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.03);
        }

        .jp-header h4 {
            color: #071437;
            font-size: 22.75px;
            font-weight: 500;
            line-height: 27.3px;
            margin-bottom: 8px;
        }

        .jp-header p {
            color: #99A1B7 !important;
            font-size: 13.975px !important;
            font-weight: 500 !important;
            line-height: 16.77px !important;
        }

        .jp-body {
            padding: 48px;
            border-radius: 0px 0px 8px 8px;
            border-right: 1px solid #F1F1F4;
            border-bottom: 1px solid #F1F1F4;
            border-left: 1px solid#F1F1F4;
            background: #FFF;
            box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.03);
            gap: 26px;
        }

        .jp-sidebar {
            width: 36%;
        }

        .jp-left-side {
            width: 62%;
        }

        .jp-left-side h5 {
            color: #071437;
            font-size: 19.5px;
            font-weight: 500;
            line-height: 23.4px;
        }

        .jp-left-side p {
            color: #4B5675 !important;
            font-size: 16px !important;
            font-weight: 400 !important;
            line-height: 25px !important;
        }

        .jp-left-side .accordion-button,
        .jp-left-side .accordion-item {
            padding: 16px;
            border-radius: 8px;
            font-size: 16.25px;
            font-weight: 500;
            border: 0;
            line-height: 19.5px;
        }

        .jp-left-side .accordion-body {
            padding: 20px 0px 0px;
        }

        .jp-left-side .accordion-body ul li {
            color: #4B5675;
            font-size: 14px;
            font-weight: 400;
            line-height: 20px;
        }

        .jp-left-side .accordion-button {
            padding: 0px;
        }

        .jp-left-side .accordion-item {
            border: 1px solid #DBDFE9;
        }

        .jp-left-side .accordion-button:not(.collapsed) {
            color: #071437;
            box-shadow: none;
            background: none;
        }

        .jp-sidebar .box {
            padding: 24px;
            border-radius: 8px;
            background: #FAFAFB;
        }

        .jp-sidebar h4 {
            color: #071437;
            font-size: 16.25px;
            font-weight: 500;
            line-height: 19.5px;
        }

        .jp-sidebar p {
            color: #4B5675 !important;
            font-size: 14px !important;
            font-weight: 400 !important;
            line-height: 22px !important;
        }

        .jp-sidebar h5 {
            color: #4B5675;
            font-size: 14px;
            font-weight: 700;
            line-height: 22px;
        }

        .jp-sidebar button {
            display: flex;
            padding: 14px 20px;
            justify-content: center;
            align-items: center;
            border-radius: 4px;
        }

        .jp-sidebar .btn-apply {
            background: #F7941C;
            color: #FFF;
            font-size: 14px;
            font-weight: 600;
            line-height: 20px;
            flex: 1 0 0;
        }

        .jp-sidebar .btn-outline {
            display: flex;
            width: 48px;
            height: 48px;
            justify-content: center;
            align-items: center;
            border: 1px solid #99A1B7 !important;
            background: #FFF;
        }

        .filter-content button {
            display: flex;
            padding: 12px 18px !important;
            justify-content: center;
            align-items: center;
            gap: 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
            line-height: 16px;
        }

        .filter-content .btn-outline {
            border: 1px solid #99A1B7;
            background: #FFF;
            color: #78829D;
        }

        .filter-content .btn-apply {
            background: #F7941C;
            color: #fff;
        }

        .filter-content .btn-outline.outline {
            border: 1px solid #F7941C !important;
            color: #F7941C;
            font-size: 12px;
            font-weight: 600;
            line-height: 16px;
            padding: 12px 18px !important;
        }

        .filter-content .btn-apply-disable {
            border: 1px solid #DBDFE9;
            background: #F1F1F4;
            color: #99A1B7;
        }

        .after-align .accordion-button::after {
            position: relative;
            right: -88px;
    }

    .tagify__tag, .select2-container--bootstrap5 .select2-selection--multiple:not(.form-select-sm):not(.form-select-lg) .select2-selection__choice {
        border-radius: 80px !important;
        background: #F1F1F4 !important;
        padding: 4px 12px !important;
        flex-direction:row !important;
        height: 22px;
    }

    .select2-container--bootstrap5 .select2-selection--multiple:not(.form-select-sm):not(.form-select-lg) .select2-selection__choice {
        flex-direction:row-reverse !important;
     }

    .tagify .tagify__tag .tagify__tag-text, .select2-container--bootstrap5 .select2-selection--multiple:not(.form-select-sm):not(.form-select-lg) .select2-selection__choice .select2-selection__choice__display {
        color:#4B5675 !important;
        font-size: 10px !important;
        font-weight: 500 !important;
        line-height: 14px !important;
    }

    .select2-container--bootstrap5 .select2-selection--multiple:not(.form-select-sm):not(.form-select-lg) .select2-selection__choice .select2-selection__choice__display {
        margin-left: 0px;
        margin-right: 17.15px;
    }

    .tagify__tag__removeBtn:hover+div::before {
        box-shadow: none;
        transition: none;
    }
    </style>
<link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')

    <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">
        <input type="hidden" name="editMode" value="{{ $editMode ? 'true' : 'false' }}">
        <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">
            <div data-kt-swapper="true" data-kt-swapper-mode="{default: 'prepend', lg: 'prepend'}"
                data-kt-swapper-parent="{default: '#kt_app_content_container', lg: '#kt_app_toolbar_container'}"
                class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5 mb-lg-0">
                <h2 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                    {{ request()->has('reuse') 
                            ? 'Reuse Job Advertisement' 
                            : ($editMode ? 'Edit Job Advertisement' : 'Create Job Advertisement') }}
                </h2>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="/admin/dashboard" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted text-hover-primary">
                        Talent
                        Acquisition
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="/admin/talent-acquisition/job-board" class="text-muted text-hover-primary">Job Board</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        {{ request()->has('reuse') 
                            ? 'Reuse Job Advertisement' 
                            : ($editMode ? 'Edit Job Advertisement' : 'Create Job Advertisement') }}
                    </li>                </ul>
            </div>
        </div>
    </div>


    <div id="kt_app_content" class="app-content  flex-column-fluid position-lg-relative">
        <div id="kt_app_content_container" class="app-container  container-xxl  w-100">
            <h1 class="text-dark fw-semibold lh-base m-0 mb-6" style="font-size: 32.5px;">
                {{ request()->has('reuse') 
                            ? 'Reuse Job Advertisement' 
                            : ($editMode ? 'Edit Job Advertisement' : 'Create Job Advertisement') }}
            </h1>
            @include('admin.talent-acquisition.job-board.create-edit-job-advertisement.create-job-advertisement')
        </div>

    </div>
@endsection


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
            var tagInput = document.getElementById("tagInput");
            if (tagInput) {
                tagInput.addEventListener("keypress", function(event) {
                    if (event.key === "Enter") {
                        event.preventDefault();
                        addTag();
                    }
                });
            }
        });


        function addTag() {
            let input = document.getElementById("tagInput");
            let tagContainer = document.getElementById("tagContainer");

            if (input.value.trim() !== "") {
                let tag = document.createElement("div");
                tag.className = "tag";
                tag.innerHTML = `${input.value} <button class="remove-tag" onclick="removeTag(this)">&times;</button>`;
                tagContainer.insertBefore(tag, input);
                input.value = "";
            }
        }

        function removeTag(button) {
            button.parentElement.remove();
        }
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var addFieldButton = document.getElementById("addField");
            var documentContainer = document.getElementById("documentContainer");
            
            if (addFieldButton && documentContainer) {
                addFieldButton.addEventListener("click", function() {
                    // Check if the document card exists in the DOM
                    let originalCard = document.querySelector(".document-card");
                    if (originalCard) {
                        let newCard = originalCard.cloneNode(true);

                        // Remove any existing input values from the cloned card
                        let input = newCard.querySelector("input[type='text']");
                        if (input) {
                            input.value = "";
                        }

                        // Generate unique names for radio inputs to avoid selection conflicts
                        let randomId = Math.floor(Math.random() * 10000);
                        newCard.querySelectorAll("input[type='radio']").forEach((radio, index) => {
                            radio.name = `documentType${randomId}-${index}`;
                        });

                        newCard.style.marginTop = "16px"; // Adjust as needed

                        // Attach remove event to the close button
                        let closeButton = newCard.querySelector(".close-btn");
                        if (closeButton) {
                            closeButton.addEventListener("click", function() {
                                this.parentElement.remove();
                            });
                        }

                        // Append the new card to the container
                        documentContainer.appendChild(newCard);
                    }
                });
            }
        });


        document.addEventListener("DOMContentLoaded", function() {
            // Attach event listener to all close buttons
            document.querySelectorAll(".close-btn").forEach(function(closeButton) {
                closeButton.addEventListener("click", function() {
                    // Remove the card that contains the clicked close button
                    this.closest(".document-card").remove();
                });
            });
        });

    </script>

    <script>
        function updateExperience(element) {
            document.getElementById("dropdownSelectedExperience").innerText = element.innerText;
        }
    </script>

    <script>
        function updateEmploymentType(element) {
            document.getElementById("dropdownEmploymentType").innerText = element.innerText;
        }
    </script>


<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.min.js"></script>

<script>
    $(document).ready(function() {
        const editMode = document.querySelector('input[name="editMode"]')?.value === 'true';
        const draftMode = document.querySelector('input[name="draftMode"]')?.value === 'true';

        const dropdown = $('.multi-select-dropdown').select2({
            tags: true,
            placeholder: "Enter Secondary Scope of Study",
            allowClear: true,
            tokenSeparators: [','],
            createTag: function(params) {
                var term = $.trim(params.term);
                if (term === '') return null;
                return {
                    id: `0|${term}`,
                    text: term
                };
            }
        });

        // Handle Enter key for new tags
        dropdown.on('keydown', function(e) {
            if (e.key === 'Enter') {
                var searchTerm = $(this).data('select2').dropdown.$search.val();
                if (searchTerm.trim().length > 0) {
                    var newOption = new Option(searchTerm, `0|${searchTerm}`, true, true);
                    $(this).append(newOption).trigger('change');
                    $(this).data('select2').dropdown.$search.val('');
                    return false;
                }
            }
        });

        // If in edit/draft mode, force-select all options from $secondaryScope
        if (editMode || draftMode) {
            const selectedOptions = {!! json_encode($secondaryScope) !!};

            // Clear previous selections
            dropdown.val(null).trigger('change');

            // Select all options that exist in $secondaryScope
            selectedOptions.forEach(option => {
                const optionValue = `${option.id} | ${option.name}`;
                const optionExists = dropdown.find(`option[value="${optionValue}"]`).length > 0;

                if (optionExists) {
                    dropdown.find(`option[value="${optionValue}"]`).prop('selected', true);
                } else {
                    // If the option doesn't exist, add it (for custom tags)
                    dropdown.append(new Option(option.name, optionValue, true, true));
                }
            });

            dropdown.trigger('change');
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        const relevantProfessionalCertificates = document.querySelector('input[name="relevant_professional_certificates"]');
        const relevantTrainingProgram = document.querySelector('input[name="relevant_training_program"]');

        if (relevantProfessionalCertificates) {
            const existingDataProfessional = relevantProfessionalCertificates.value ? JSON.parse(relevantProfessionalCertificates.value) : [];
            relevantProfessionalCertificates.value = '';

            const relevantProfessionalCertificateTagify = new Tagify(relevantProfessionalCertificates, {
                whitelist: [],
                dropdown: { enabled: 0 },
                duplicates: false,
                placeholder: "Type and press Enter to add a training program",
            });

            if (existingDataProfessional.length > 0) {
                relevantProfessionalCertificateTagify.addTags(existingDataProfessional);
            }

            relevantProfessionalCertificateTagify.on('add', function(e) {
                if (e.detail.data && e.detail.data.value) {
                    console.log("Added:", e.detail.data.value);
                } else {
                    console.log('Data or value not found:', e.detail);
                }
            });

            relevantProfessionalCertificateTagify.on('remove', function(e) {
                if (e.detail.data && e.detail.data.value) {
                    console.log("Removed:", e.detail.data.value);
                } else {
                    console.log('Data or value not found:', e.detail);
                }
            });
        }

        if (relevantTrainingProgram) {
            const existingDataTraining = relevantTrainingProgram.value ? JSON.parse(relevantTrainingProgram.value) : [];
            relevantTrainingProgram.value = '';
            
            
            const relevantTrainingProgramTagify = new Tagify(relevantTrainingProgram, {
                whitelist: [],
                dropdown: { enabled: 0 },
                duplicates: false,
                placeholder: "Type and press Enter to add a training program",
            });

            if (existingDataTraining.length > 0) {
                relevantTrainingProgramTagify.addTags(existingDataTraining);
            }

            relevantTrainingProgramTagify.on('add', function(e) {
                if (e.detail.data && e.detail.data.value) {
                    console.log("Added:", e.detail.data.value);
                } else {
                    console.log('Data or value not found:', e.detail);
                }
            });

            relevantTrainingProgramTagify.on('remove', function(e) {
                if (e.detail.data && e.detail.data.value) {
                    console.log("Removed:", e.detail.data.value);
                } else {
                    console.log('Data or value not found:', e.detail);
                }
            });
        }
    });

    $(document).ready(function() {
    // Initialize Select2 with tags option
    $('#secondaryScopeOfStudy').select2({
        placeholder: "Select or type to add more",
        width: '100%',
        tags: true,  // Enable tags
        tokenSeparators: [',', ' ', ';'],  // Allows typing words separated by spaces or commas
    });

    // Capture the Enter key press
    $('#secondaryScopeOfStudy').on('keypress', function (e) {
        if (e.which === 13) {  // 13 is the Enter key
            var term = $(this).val().trim();  // Get the current value in the input field
            if (term) {
                // Create a new option with id = 0 and the entered term as name
                // Format the value as "0|term" (without space around the |)
                var newOption = new Option('0|' + term, '0|' + term, true, true);  // Format: 0|term
                $('#secondaryScopeOfStudy').append(newOption).trigger('change');
                $(this).val('');  // Clear the input field after adding the tag
            }
        }
    });
});





    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('jobQualificationsForm');
        const submitButton = form.querySelector('button[type="submit"]');
        // const experienceInput = document.getElementById('experienceRangeInput');
        const experienceInput = document.getElementById('dropdownSelectedExperience');
        const dropdownItems = document.querySelectorAll('.dropdown-item');
        const dropdownButton = document.getElementById('dropdownSelectedExperience');

        // Ensure the dropdown button is available
        if (!dropdownButton) {
            console.error('Dropdown button not found!');
            return;
        }

        // Check the form state and enable/disable the submit button
        // function checkForm() {
            if (experienceInput.value.trim()) {
                console.log("I am in")
                submitButton.disabled = false;  // Enable submit button
            } else {
                submitButton.disabled = true;   // Disable submit button
            }
        // }

        // Update the experience input and dropdown button text
        // function updateExperience(range) {
        //     experienceInput.value = range;

        //     switch (range) {
        //         case 'no_experience':
        //             dropdownButton.textContent = 'No Experience';
        //             break;
        //         case 'less_than_1_year':
        //             dropdownButton.textContent = 'Less than 1 Year';
        //             break;
        //         case '1_2_years':
        //             dropdownButton.textContent = '1-2 Years';
        //             break;
        //         case '3_5_years':
        //             dropdownButton.textContent = '3-5 Years';
        //             break;
        //         case '6_8_years':
        //             dropdownButton.textContent = '6-8 Years';
        //             break;
        //         case '9_10_years':
        //             dropdownButton.textContent = '9-10 Years';
        //             break;
        //         case 'more_than_10_years':
        //             dropdownButton.textContent = 'More than 10 Years';
        //             break;
        //         default:
        //             dropdownButton.textContent = 'Select Experience';
        //     }

        //     console.log('Experience updated');
        //     checkForm();  // Check form state whenever experience is updated
        // }

        // Attach event listeners to dropdown items
        dropdownItems.forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                const range = this.getAttribute('onclick').match(/'(.*?)'/)[1];
                // updateExperience(range);  // Update experience based on dropdown selection
            });
        });

        // Initial form state check
        // checkForm();  // Ensure button state is checked on page load
    });


    function updateEmploymentTypeData(element, value) {
        document.getElementById('dropdownEmploymentType').innerText = element.innerText;

        document.getElementById('employmentTypeValue').value = value;
    }

    function cancelEdit() {
        const urlParams = new URLSearchParams(window.location.search);
        const jobId = urlParams.get('jobId') || '';
        const jobOpeningId = urlParams.get('jobOpeningId') || '';

        const hasEditTrue = urlParams.get('edit') === 'true';
        const hadReuseTrue = urlParams.get('reuse') === 'true';
        const hadCreatetrue = urlParams.get('create') === 'true';

        let redirectUrl = '/admin/talent-acquisition/job-board/create-job-advertisement?step=7';

        if (jobId) {
            redirectUrl += `&jobId=${jobId}`;
        }

        if (jobOpeningId) {
            redirectUrl += `&jobOpeningId=${jobOpeningId}`;
        }

        if (hasEditTrue) {
            redirectUrl += `&edit=true`;
        }
        if (hadReuseTrue) {
            redirectUrl += `&reuse=true`;
        }
        if (hadCreatetrue) {
            redirectUrl += `&create=true`;
        }

        window.location.href = redirectUrl;
    }

    async function saveDraft(formId) {
        const form = document.getElementById(formId);
        const formData = new FormData(form);

        const urlParams = new URLSearchParams(window.location.search);
        let currentStep = parseInt(urlParams.get('step'));
        let isValid = true;

        const requiredFields = [
            { id: 'employmentTypeValue', message: 'Employment Type is required' },
            { id: 'jobLocation', message: 'Job Location is required' },
            { id: 'startDate', message: 'Start Date is required' },
            { id: 'endDate', message: 'End Date is required' },
            { id: 'currency', message: 'Currency is required' },
            { id: 'minSalary', message: 'Minimum Salary is required' },
            { id: 'maxSalary', message: 'Maximum Salary is required' },
            { id: 'country', message: 'Country is required' },
            { id: 'state', message: 'State is required' },
            { id: 'city', message: 'City is required' },
            { id: 'expiredDate', message: 'Expired Date is required' },
            { id: 'educationProgram', message: 'Education Program is required'},
            { id: 'experienceRangeInput', message: 'Experience Range is required'}
        ];

        if (formId !== "vacancyDetailsForm") {
            requiredFields.forEach(field => {
                const inputElement = document.getElementById(field.id);
                const errorElement = document.getElementById(`${field.id}-error`);

                if (!inputElement || !errorElement) return;

                if (!inputElement.value.trim()) {
                    errorElement.textContent = field.message;
                    isValid = false;
                } else {
                    errorElement.textContent = '';
                }
            });

            if (!isValid) {
                return;
            }
        }

        if (isNaN(currentStep)) {
            currentStep = 1;
        }

        formData.append('form_id', formId);
        formData.append('step', currentStep);

        try {
            const response = await fetch("{{ route('admin.talent-acquisition.job-board.save-draft') }}", {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                }
            });

            const data = await response.json();

            console.log(data);

            if (data.success) {
                showOverlay();
                window.location.href = '/admin/talent-acquisition/job-board';
            } else {
                return;
            }
        } catch (error) {
            console.error('Error:', error);
            alert('An error occurred while saving the draft.');
        }
    }

    async function submitForm(event) {
        event.preventDefault();

        const form = event.target;
        const formData = new FormData(form);
        let isValid = true;

        document.querySelectorAll('.error-message').forEach(el => el.textContent = '');

        const requiredFields = [
            { id: 'employmentTypeValue', message: 'Employment Type is required'},
            { id: 'jobLocation', message: 'Job Location is required'},
            { id: 'startDate', message: 'Start Date is required'},
            { id: 'endDate', message: 'End Date is required'},
            { id: 'currency', message: 'Currency is required'},
            { id: 'minSalary', message: 'Minimum Salary is required'},
            { id: 'maxSalary', message: 'Maximum Salary is required'},
            { id: 'country', message: 'Country is required'},
            { id: 'state', message: 'State is required'},
            { id: 'city', message: 'City is required'},
            { id: 'educationProgram', message: 'Education Program is required'},
            { id: 'experienceRangeInput', message: 'Experience Range is required'}

        ];

        requiredFields.forEach(field => {
            const inputElement = document.getElementById(field.id);
            const errorElement = document.getElementById(`${field.id}-error`);

            if (!inputElement || !errorElement) return;

            if (!inputElement.value.trim()) {
                errorElement.textContent = field.message;
                isValid = false;
            }
        });


        const dynamicSets = document.querySelectorAll('[id^="set"]');
        dynamicSets.forEach(set => {
            const setId = set.id.replace('set', '');

            const docNameInput = set.querySelector(`input[name="document_name_${setId}"]`);
            const docNameErrorId = `document_name_${setId}-error`;
            let docNameError = document.getElementById(docNameErrorId);

            if (!docNameError) {
                docNameError = document.createElement('div');
                docNameError.className = 'error-message text-danger mt-1';
                docNameError.id = docNameErrorId;
                docNameInput.insertAdjacentElement('afterend', docNameError);
            }

            if (!docNameInput.value.trim()) {
                docNameError.textContent = 'Document name is required';
                isValid = false;
            } else {
                docNameError.textContent = '';
            }

            const radioInputs = set.querySelectorAll(`input[name="parent_${setId}"]`);
            const oneRadioChecked = Array.from(radioInputs).some(r => r.checked);
            const radioErrorId = `parent_${setId}_error`;
            let radioError = document.getElementById(radioErrorId);

            if (!radioError) {
                radioError = document.createElement('div');
                radioError.className = 'error-message text-danger mt-1';
                radioError.id = radioErrorId;
                radioInputs[radioInputs.length - 1].insertAdjacentElement('afterend', radioError);
            }

            if (!oneRadioChecked) {
                radioError.textContent = 'Please select an option (Website Link or File Type)';
                isValid = false;
            } else {
                radioError.textContent = '';
            }

            const fileTypeSelected = set.querySelector(`#parent2_set${setId}`)?.checked;
            if (fileTypeSelected) {
                const checkboxes = set.querySelectorAll(`input[name="child_${setId}[]"]`);
                const oneChecked = Array.from(checkboxes).some(cb => cb.checked);
                const fileTypeErrorId = `child_${setId}_group_error`;

                let fileTypeError = document.getElementById(fileTypeErrorId);
                if (!fileTypeError) {
                    fileTypeError = document.createElement('div');
                    fileTypeError.className = 'error-message text-danger mt-1';
                    fileTypeError.id = fileTypeErrorId;
                    checkboxes[checkboxes.length - 1].insertAdjacentElement('afterend', fileTypeError);
                }

                if (!oneChecked) {
                    fileTypeError.textContent = 'Please select at least one file type';
                    isValid = false;
                } else {
                    fileTypeError.textContent = '';
                }
            }
        });

        if (!isValid) {
            return;
        }

        try {
            showOverlay();
            console.log('afterroverlay')
            const response = await fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content'),
                    'Accept': 'application/json'
                }
            });

            const data = await response.json();
            console.log(data);

            const editMode = formData.get('editMode') === 'true';
            const fromPrevious = formData.get('fromPrevious') === 'true' || new URLSearchParams(window.location.search).get('fromPrevious') === '1';
            const draftMode = formData.get('draftMode') === 'true';
            const urlParams = new URLSearchParams(window.location.search);
          
            let currentStep = parseInt(urlParams.get('step'));
            let jobId = parseInt(urlParams.get('jobId'));


            const currentUrl = new URL(window.location.href);
            const searchParams = currentUrl.searchParams;

            const editModeSearch = searchParams.get('edit') === 'true';
            const reuseMode = searchParams.get('reuse') === 'true';
            const createMode = searchParams.get('create') === 'true';
            const draftMode1 = searchParams.get('draft') === 'true';

            const nextStep = currentStep + 1;

            if (data.success) {
                if (data.jobOpeningId) {

                    let targetStep;
                    
                    if (fromPrevious) {
                        targetStep = nextStep;
                    }
                    else if (draftMode) {
                        targetStep = nextStep;
                    }
                    else if (editMode) {
                        targetStep = 7;
                    }
                    else {
                        targetStep = nextStep;
                    }

                    if (isNaN(currentStep)) {
                        currentStep = 1;
                        targetStep = 2;
                    }

                    let url = `/admin/talent-acquisition/job-board/create-job-advertisement?step=${targetStep}&jobId=${jobId}&jobOpeningId=${data.jobOpeningId}`;
                    
                    if (editModeSearch && reuseMode) {
                        url += '&edit=true&reuse=true';
                    } else if (createMode || draftMode1) {
                        url += '&create=true';
                    } else if (createMode && editModeSearch) {
                        url += '&create=true';
                    } else {
                        url += '&edit=true';
                    }

                    console.log('Redirecting to:', url); 
                    window.location.href = url;
                }
            } else {
                console.log(data);
                    if (data.errors) {
                        Object.keys(data.errors).forEach(key => {
                            const errorElement = document.getElementById(`${key}-error`);
                            if (errorElement) {
                                errorElement.textContent = data.errors[key][0];
                            }
                        });
                    }
            }
        } catch (error) {
            console.error('Error:', error);
            alert('An error occurred while saving data.');
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const tabContent = document.getElementById('v-pills-tabContent');
        const saveDraftModal = new bootstrap.Modal(document.getElementById('SaveAsDraft'));
        const discardConfirmModal = new bootstrap.Modal(document.getElementById('ConfirmationDiscardDraft'));
        const cancelEditModal = new bootstrap.Modal(document.getElementById('CancelEditConfirmation'));
        let clickedLink = null;

        const urlParams = new URLSearchParams(window.location.search);
        const isEditMode = urlParams.get('edit') === 'true';

        // 👇 Add logout button interception
        const logoutButton = document.getElementById('custom-logout-button');
        logoutButton?.addEventListener('click', function (event) {
            event.preventDefault();

            const forms = tabContent.querySelectorAll('form');
            clickedLink = { href: '{{ route("logout") }}' }; // Treat like an anchor

            if (isEditMode) {
                cancelEditModal.show();
            } else {
                saveDraftModal.show();
                if (forms.length > 0) {
                    forms[0].scrollIntoView({ behavior: 'smooth' });
                }
            }
        });

        // ✅ Global link handler for non-logout links
        document.addEventListener('click', function(event) {
            const forms = tabContent.querySelectorAll('form');
            let isInsideAnyForm = false;

            forms.forEach(form => {
                if (form.contains(event.target)) {
                    isInsideAnyForm = true;
                }
            });

            if (!isInsideAnyForm) {
                let target = event.target;
                while (target && target !== document) {
                    if (target.tagName === 'A' &&
                        target.getAttribute('href') !== '#' &&
                        !target.classList.contains('ignore-save-draft') &&
                        target.id !== 'custom-logout-button') { // Skip logout here, it's handled above

                        event.preventDefault();
                        event.stopPropagation();

                        clickedLink = target;

                        if (isEditMode) {
                            cancelEditModal.show();
                        } else {
                            saveDraftModal.show();
                            if (forms.length > 0) {
                                forms[0].scrollIntoView({ behavior: 'smooth' });
                            }
                        }
                        return;
                    }
                    target = target.parentNode;
                }
            }
        });

        document.querySelector('#SaveAsDraft .btn-outline')?.addEventListener('click', function() {
            this.blur(); 
            saveDraftModal.hide();
            setTimeout(() => {
                discardConfirmModal.show();
            }, 50);
        });

        document.querySelector('#ConfirmationDiscardDraft .btn-outline')?.addEventListener('click', function() {
            this.blur();
            discardConfirmModal.hide();
        });

        document.querySelector('#ConfirmationDiscardDraft .btn-apply')?.addEventListener('click', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const jobOpeningId = urlParams.get('jobOpeningId');
            const step1 = urlParams.get('step');
            const create = urlParams.get('create');

            this.blur();
            discardConfirmModal.hide();

            const modalElement = document.getElementById('ConfirmationDiscardDraft');
            const handler = function() {
                modalElement.removeEventListener('hidden.bs.modal', handler);
                showOverlay();

                // 👇 Handle logout redirect if it's the logout case
                if (clickedLink && clickedLink.href === '{{ route("logout") }}') {
                    document.getElementById('logout-form').submit();
                    return;
                }

                if(step1 == 1 && create == 'true') {
                    window.location.href = '/admin/talent-acquisition/job-board';
                }

                if (jobOpeningId) {
                    fetch(`/job-openings-delete/${jobOpeningId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept': 'application/json',
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        hideOverlay(); 
                        if (data.success) {
                            window.location.href = '/admin/talent-acquisition/job-board';
                        } else {
                            alert('Failed to delete the job opening.');
                        }
                    })
                    .catch(error => {
                        hideOverlay(); 
                        console.error('Error:', error);
                        alert('An error occurred.');
                    });
                }
            };

            modalElement.addEventListener('hidden.bs.modal', handler);
        });

        document.querySelector('#SaveAsDraft .btn-apply')?.addEventListener('click', function () {
            this.blur(); 
            const urlParams = new URLSearchParams(window.location.search);
            let currentStep = parseInt(urlParams.get('step')) || 1;

            if (currentStep === 7) {
                saveDraftWithStatusUpdate();
            } else {
                let formId;
                switch (currentStep) {
                    case 1: formId = 'vacancyDetailsForm'; break;
                    case 2: formId = 'jobDetailsForm'; break;
                    case 3: formId = 'jobQualificationForm'; break;
                    case 4: formId = 'jobSkillsForm'; break;
                    case 5: formId = 'otherDetailsForm'; break;
                    case 6: formId = 'hiringWorkflowForm'; break;
                    default: formId = 'vacancyDetailsForm';
                }
                saveDraft(formId); 
            }
        });

        async function saveDraftWithStatusUpdate() {
            const urlParams = new URLSearchParams(window.location.search);
            const jobOpeningId = urlParams.get('jobOpeningId');

            try {
                const response = await fetch("/admin/talent-acquisition/job-board/update-status", {
                    method: 'POST',
                    body: JSON.stringify({
                        jobOpeningId: jobOpeningId,
                        status: 5,
                    }),
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    }
                });

                const data = await response.json();

                if (data.success) {
                    window.location.href = '/admin/talent-acquisition/job-board';                
                } else {
                    alert('Failed to update job opening status.');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('An error occurred while updating the status.');
            }
        }

        document.querySelector('#CancelEditConfirmation .btn-outline')?.addEventListener('click', function() {
            this.blur(); 
            cancelEditModal.hide();
        });

        document.querySelector('#CancelEditConfirmation .btn-apply')?.addEventListener('click', function() {
            this.blur(); 
            cancelEditModal.hide();
            if (clickedLink) {
                if (clickedLink.href === '{{ route("logout") }}') {
                    document.getElementById('logout-form').submit();
                } else {
                    window.location.href = clickedLink.href;
                }
            }
        });
    });


    let setCount =
        {{ ($draftMode || $editMode) && $jobApplicationDocument->isNotEmpty() ? $jobApplicationDocument->count() : 0 }};

    function addNewSet() {
        setCount++;
        const form = document.getElementById("documentContainer");

        // Check if the documentContainer exists
        if (!form) {
            console.error('documentContainer element not found!');
            return;  // Exit the function if the element does not exist
        }

        const newSet = document.createElement("div");
        newSet.id = `set${setCount}`;
        newSet.innerHTML = `
            <div class="document-card position-relative">
                <span class="close-btn position-absolute top-0 end-0 p-2" style="cursor: pointer;" onclick="removeSet(${setCount})">&times;</span>
                <label class="form-label">Document Name</label>
                <input type="text" name="document_name_${setCount}" validation="document_name_${setCount}" class="form-control col-md-6 required-input" placeholder="Enter Document Name">
                <div class="error-message text-danger mt-1" id="document_name_${setCount}-error"></div>
                <div class="mt-3 d-flex gap-3 align-items-center">
                    <input type="hidden" name="document_required_${setCount}" value="0">
                    <input type="checkbox" checked name="document_required_${setCount}" value="1">
                    <label class="form-label required-label">This document is required for applicants to submit</label>
                </div>
                <div class="mt-3">
                    <div class="d-flex gap-2 align-items-center">
                        <input class="h-auto parent" type="radio" name="parent_${setCount}" id="parent1_set${setCount}" value="website-link" onclick="handleRadioClick(${setCount}, 'parent1')">
                        <label class="form-label m-0">Website Link</label>
                    </div>
                    <div class="d-flex gap-2 align-items-center mt-3">
                        <input class="h-auto parent required-input" type="radio" name="parent_${setCount}" validation="parent2_set${setCount}" id="parent2_set${setCount}" value="parent2" onclick="handleRadioClick(${setCount}, 'parent2')">
                        
                        <label class="form-label m-0">File Type</label>
                    </div>
                    <div class="error-message text-danger mt-1" id="parent_${setCount}_error"></div>
                    <div class="mt-2 ms-3" id="childOptions_set${setCount}">
                        <div class="d-flex gap-2 align-items-center mt-1">
                            <input class="h-auto child required-input" type="checkbox" name="child_${setCount}[]" validation="child1_set${setCount}" id="child1_set${setCount}" value=".pdf" disabled>
                        
                            <label class="form-label m-0">PDF (.pdf)</label>
                        </div>
                        <div class="d-flex gap-2 align-items-center mt-2">
                            <input class="h-auto child required-input" type="checkbox" name="child_${setCount}[]" validation="child2_set${setCount}" id="child2_set${setCount}" value=".doc" disabled>
                            
                            <label class="form-label m-0">Word Documents (.doc, .docx)</label>
                        </div>
                        <div class="d-flex gap-2 align-items-center mt-2">
                            <input class="h-auto child required-input" type="checkbox" name="child_${setCount}[]" validation="child3_set${setCount}" id="child3_set${setCount}" value=".png" disabled>
                        
                            <label class="form-label m-0">PNG (.png)</label>
                        </div>
                        <div class="d-flex gap-2 align-items-center mt-2">
                            <input class="h-auto child required-input" type="checkbox" name="child_${setCount}[]" validation="child4_set${setCount}" id="child4_set${setCount}" value=".jpg" disabled>
                        
                            <label class="form-label m-0">JPG (.jpg, .jpeg)</label>
                        </div>
                        <div class="error-message text-danger mt-2" id="child_${setCount}_group_error"></div>
                    </div>
                </div>
            </div>
        `;
        form.appendChild(newSet);  // Append the new set
    }


    function removeSet(setId) {
        const setToRemove = document.getElementById(`set${setId}`);
        if (setToRemove) {
            setToRemove.remove();
        }
    }

    function handleRadioClick(setId, parentId) {
        const parentRadioButtons = document.querySelectorAll(`#set${setId} .parent`);
        const childRadioButtons = document.querySelectorAll(`#set${setId} .child`);

        for (const radio of parentRadioButtons) {
            radio.disabled = false;
        }

        if (parentId === 'parent1') {
            for (const radio of childRadioButtons) {
                radio.checked = false;
                radio.disabled = true;
            }
        } else {
            for (const radio of childRadioButtons) {
                radio.disabled = false;
            }
        }
    }

    document.addEventListener('change', function(event) {
        if (event.target.classList.contains('child')) {
            const parentId = event.target.name.replace('child', 'parent');
            const parentRadio = document.querySelector(`input[name="${parentId}"][value="parent2"]`);

            if (parentRadio) {
                parentRadio.checked = true;
            }
        }
    });

    document.addEventListener("DOMContentLoaded", function() {
        // List of form IDs to attach event listeners to
        const formIds = [
            'jobDetailsForm',
            'jobQualificationsForm',
            'jobSkillsForm',
            'otherDetailsForm',
            'hiringWorkflowForm',
            'vacancyDetailsForm'  // Added the vacancyDetailsForm here
        ];

        formIds.forEach(function(formId) {
            var form = document.getElementById(formId);
            if (form) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();  // Prevent the default form submission
                    submitForm(this);    // Call submitForm with the form as context
                });
            }
        });
    });


    window.onload = addNewSet;
</script>

<script>
    
    window.editMode = "{{ $editMode ? 'true' : 'false' }}";
    window.draftMode = "{{ $draftMode ? 'true' : 'false' }}";

    window.selectedCountryId = "{{ ($editMode || $draftMode) ? $jobOpeningData->country_id : '' }}";
    window.selectedStateId = "{{ ($editMode || $draftMode) ? $jobOpeningData->state_id : '' }}";
    window.selectedCityId = "{{ ($editMode || $draftMode) ? $jobOpeningData->city_id : '' }}";
</script>

<script>
    // Wait for DOM to load
document.addEventListener("DOMContentLoaded", function() {
    const educationProgram = document.getElementById("educationProgram");
    const experienceRange = document.getElementById("dropdownSelectedExperience");
    const submitBtn = document.getElementById("jobSkillsSubmitButton");

    // Function to check if both fields are selected
    function checkFields() {
        if (educationProgram.value && experienceRange.value) {
            submitBtn.disabled = false;  // Enable submit button
        } else {
            submitBtn.disabled = true;  // Keep submit button disabled
        }
    }

    // Listen for changes on both fields
    educationProgram.addEventListener("change", checkFields);
    experienceRange.addEventListener("change", checkFields);

    // Initial check in case values are already present when page loads
    checkFields();
});

</script>
@endsection
