@extends('admin.layout.app')

@section('title', 'Talent Acquisition')

@section('styles')

    <style>
        @media (min-width: 992px) {
            .app-content {
                padding-top: 22px;
            }}
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
            position: absolute;
            right: 60px;
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
            padding: 12px 18px;
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

        .filter-content .btn-outline.outline .btn-outline.outline {
            border: 1px solid #F7941C !important;
            color: #F7941C;
        }

        .filter-content .btn-apply-disable {
            border: 1px solid #DBDFE9;
            background: #F1F1F4;
            color: #99A1B7;
        }
    </style>

@endsection

@section('content')

    <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">
        <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">
            <div data-kt-swapper="true" data-kt-swapper-mode="{default: 'prepend', lg: 'prepend'}"
                data-kt-swapper-parent="{default: '#kt_app_content_container', lg: '#kt_app_toolbar_container'}"
                class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5 mb-lg-0">
                <h2 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                    Edit Job Advertisement
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
                    <li class="breadcrumb-item text-muted">Job Board</li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted"> Edit Job Advertisement</li>
                </ul>
            </div>
        </div>
    </div>


    <div id="kt_app_content" class="app-content  flex-column-fluid position-lg-relative">
        <div id="kt_app_content_container" class="app-container  container-xxl  w-100">
            <a href="{{ route('admin.talent-acquisition.job-board.create-edit-job-advertisement.create-job-advertisement-page') }}"><button class="p-0 border-0 d-flex align-items-center bg-transparent gap-2" style="color: #F7941C;"><iconify-icon icon="tabler:arrow-left" width="16"
                height="16"></iconify-icon> Back to Previous Page</button></a>
            <h1 class="text-dark fw-semibold lh-base m-0 my-6" style="font-size: 32.5px;">
                Edit Job Advertisement
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
            flatpickr("#startDate", {
                dateFormat: "d M Y",
                defaultDate: "17 Dec 2024"
            });

            flatpickr("#endDate", {
                dateFormat: "d M Y",
                defaultDate: "27 Dec 2025"
            });
        });
    </script>

    <script>
        document.getElementById("tagInput").addEventListener("keypress", function(event) {
            if (event.key === "Enter") {
                event.preventDefault();
                addTag();
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
        document.getElementById("addField").addEventListener("click", function() {
            // Clone the existing document-card
            let originalCard = document.querySelector(".document-card");
            let newCard = originalCard.cloneNode(true);

            // Remove any existing input values from the cloned card
            newCard.querySelector("input[type='text']").value = "";

            // Generate unique names for radio inputs to avoid selection conflicts
            let randomId = Math.floor(Math.random() * 10000);
            newCard.querySelectorAll("input[type='radio']").forEach((radio, index) => {
                radio.name = `documentType${randomId}-${index}`;
            });

            newCard.style.marginTop = "16px"; // Adjust as needed

            // Attach remove event to the close button
            newCard.querySelector(".close-btn").addEventListener("click", function() {
                this.parentElement.remove();
            });

            // Append the new card to the container
            document.getElementById("documentContainer").appendChild(newCard);
        });

        // Remove document card when close button is clicked
        document.querySelector(".close-btn").addEventListener("click", function() {
            this.parentElement.remove();
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

@endsection
