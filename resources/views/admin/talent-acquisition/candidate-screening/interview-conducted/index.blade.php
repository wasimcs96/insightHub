@extends('admin.layout.app')

@section('title', 'Talent Insights Hub')

@section('styles')

    <style>
        .heading,
        .desc-card .sub-heading {
            color: #000;
            font-size: 32.5px;
            line-height: 39px;
            margin-bottom: 31.5px;
        }

        .grid-section {
            grid-template-columns: 36% 62.3%;
            gap: 20px;
        }

        .sub-heading {
            color: #252F4A;
            font-size: 22.75px;
            line-height: 27.3px;
        }

        .week-button {
            display: flex;
            height: 30px;
            padding: 0px 8px;
            align-items: center;
            border-radius: 4px;
            border: 1px solid #C4CADA;
            background: #FFF;
            color: #071437;
            font-size: 12px;
            line-height: 16px;
        }

        .filter-buttons {
            gap: 8px;
            flex-wrap: wrap;
        }

        .filter-btn {
            display: flex;
            padding: 12px 18px;
            align-items: center;
            gap: 8px;
            border-radius: 80px;
            border: 1px solid #99A1B7;
            background: #FFF;
            color: #78829D;
            font-size: 12px;
            font-weight: 600;
            line-height: 16px;
            max-width: 140px;
            overflow: hidden;
            white-space: nowrap;
            height: 40px;
        }

        .filter-btn span {
            display: flex;
            align-items: center;
            gap: 8px;
            max-width: 100px;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }

        .left-table {
            margin-top: 16px;
            display: flex;
            padding-bottom: 32px;
            flex-direction: column;
            gap: 32px;
            align-self: stretch;
            border-radius: 8px;
            background: #FFF;
            box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.03);
        }

        .table-box {
            padding: 16px;
            gap: 16px;
            border-bottom: 1px solid #F1F1F4;
            background: #FFF;
            cursor: pointer;
        }

        .table-box.active {
            background: #FFF6EA;
        }

        .table-date {
            color: #4B5675;
            font-size: 32.5px;
            font-weight: 500;
            line-height: 39px;
        }

        .table-day {
            color: #4B5675;
            font-size: 12px;
            font-weight: 500;
            line-height: 16px;
        }

        .table-box .line {
            width: 1px;
            height: 40px;
            background: #C4CADA;
            display: block;
        }

        .table-box .name-info {
            width: 100%;
        }

        .table-box .name {
            color: #4B5675;
            font-size: 16.25px;
            font-weight: 500;
            line-height: 22px;
        }

        .table-box .time {
            color: #4B5675;
            font-size: 14px;
            font-weight: 500;
            line-height: 20px;
        }

        .table-box .position {
            color: #78829D;
            font-size: 10px;
            font-weight: 500;
            line-height: 14px;
        }

        .table-box .tag {
            display: flex;
            padding: 3px 7px;
            justify-content: center;
            align-items: center;
            border-radius: 10px;
            font-size: 10px;
            font-weight: 600;
            line-height: normal;
            text-transform: uppercase;
        }

        .table-box .tag.blue,
        .sheet-card .bottom-text .tag.blue {
            color: #1877A0;
            background: #E3F7FF;
        }

        .table-box .tag.purple,
        .sheet-card .bottom-text .tag.purple {
            background: #F2EEFD;
            color: #7F66CA;
        }

        .table-box .tag.teal,
        .sheet-card .bottom-text .tag.teal {
            background: #E2F6F6;
            color: #108585;
        }

        .table-box .tag.green,
        .sheet-card .bottom-text .tag.green {
            background: #DDF5E2;
            color: #196329;
        }

        .table-box .tag.yellow,
        .sheet-card .bottom-text .tag.yellow {
            background: #FFEBB4;
            color: #EB8100;
        }

        .table-box .tag.red,
        .sheet-card .bottom-text .tag.red {
            background: #FFE0DD;
            color: #AA2D22;
        }

        .table-box .tag.orange,
        .sheet-card .bottom-text .tag.orange {
            background: #FDE2C1;
            color: #A56313;
        }

        .table-box .tag.dark-red,
        .sheet-card .bottom-text .tag.red {
            background: #FFE0DD;
            color: #F24130;
        }

        .icon-link {
            color: #C4CADA;
        }

        .na-text {
            color: #78829D;
            font-size: 10px;
            font-weight: 500;
            line-height: 14px;
        }

        .not-selected {
            display: block;
        }

        .not-selected-content {
            display: flex;
            padding: 32px;
            height: 1029px;
            justify-content: center;
            align-items: center;
            gap: 10px;
            align-self: stretch;
            background: #FFF;
            margin-top: 32px;
        }

        .not-selected p {
            color: #99A1B7;
            text-align: center;
            font-size: 17.55px;
            font-weight: 500;
            line-height: 21.06px;
            width: 372px;
        }

        .button-custom {
            padding: 14px 20px;
            gap: 8px;
            border-radius: 4px;
            font-size: 14px;
            font-weight: 600;
            line-height: 20px;
        }

        .btn-orange-outline {
            border: 1px solid #F7941C;
            background: #FFF;
            color: #F7941C;
        }

        .info-card {
            padding: 32px;
            background: #FFF;
        }

        .info-content {
            margin-bottom: 24px;
            width: 90%;
        }

        .info-card .heading,
        .desc-card .heading {
            color: #99A1B7;
            font-size: 13.975px;
            line-height: 20.963px;
            font-weight: 400;
            margin-bottom: 8px;
        }

        .info-card .sub-heading {
            color: #071437;
            font-size: 17.55px;
            font-weight: 500;
            line-height: 21.06px;
        }

        .badge {
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
            height: 24px;
        }

        .join-interview {
            color: #F7941C;
            font-size: 14px;
            font-weight: 400;
            line-height: 22px;
        }

        .desc-card {
            padding: 32px;
            background: #FFF;
        }

        .desc-content .heading {
            color: #1E1E1E;
            font-size: 19.5px;
            font-weight: 700;
            line-height: 23.4px;
            margin-bottom: 12px;
        }

        .desc-content .desc {
            color: #4B5675;
            font-size: 16px;
            font-weight: 400;
            line-height: 22.4px;
            letter-spacing: 0.5px;
        }

        .desc-content .accordion-design {
            height: 69px;
            padding: 19.5px 0px;
            gap: 24px;
            border-bottom: 1px solid #F1F1F4;
            color: #555;
            font-size: 16.25px;
            font-weight: 400;
            line-height: 24px;
            letter-spacing: 0.15px;
        }

        .desc-content .accordion-design .icon {
            color: #1AC2C2;
            width: 23px;
        }

        .desc-content .accordion-button,
        .desc-content .accordion-item {
            height: 69px;
            padding: 19.5px 0px;
            gap: 24px;
            border-bottom: 1px solid #F1F1F4;
            color: #555;
            font-size: 16.25px;
            font-weight: 400;
            line-height: 24px;
            letter-spacing: 0.15px;
        }

        .desc-content .accordion-body {
            border-radius: 8.13px;
            padding: 19.5px 24px;
            background: rgb(226, 246, 246);
        }

        .desc-content .accordion-body ul li {
            color: #4B5675;
            font-size: 14px;
            font-weight: 400;
            line-height: 20px;
        }

        .desc-content .accordion-button {
            padding: 0px;
        }

        .desc-content .accordion-item {
            border: 0;
        }

        .desc-content .accordion-button:not(.collapsed) {
            color: #555;
            box-shadow: none;
            background: none;
        }

        .interview-list {
            color: #F7941C;
            font-size: 14px;
            font-weight: 600;
            line-height: normal;
            text-transform: capitalize;
            margin-bottom: 20px;
            cursor: pointer;
        }

        .conduct-interview .left-side {
            padding: 24px;
            border-radius: 8px;
            border: 1px solid #F1F1F4;
            background: #FFF;
            box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.03);
        }

        .conduct-interview .right-side {
            width: 765.75px;
            padding: 24px;
            background: #FFF;
        }

        .conduct-interview .left-side .custom-button {
            padding: 8px 16px;
            gap: 8px;
            font-size: 12px;
            font-weight: 600;
            line-height: 16px;
            border-radius: 4px;
        }

        .conduct-interview .left-side h4 {
            color: #071437;
            font-size: 22.75px;
            font-weight: 600;
            line-height: 34px;
        }

        .tag-text {
            padding: 16px 0px;
            border-bottom: 1px solid #F1F1F4;
            margin-bottom: 32px;
        }

        .tag-text p {
            color: #4B5675;
            font-size: 16.25px;
            font-weight: 500;
            line-height: 22px;
        }

        .tag-text .tag {
            display: flex;
            padding: 5.6px 11.2px;
            justify-content: center;
            align-items: center;
            border-radius: 56px;
            font-size: 8.4px;
            font-weight: 600;
            line-height: 11.2px;
        }

        .tag-text .tag.green {
            background: #DDF5E2;
            color: #196329;
        }

        .bottom-content {
            margin-bottom: 32px;
        }

        .bottom-content h5 {
            color: #1E1E1E;
            font-size: 19.5px;
            font-weight: 500;
            line-height: 23.4px;
            margin-bottom: 16px;
        }

        .bottom-content .inner-content {
            gap: 16px;
        }

        .bottom-content .inner-content p {
            color: #99A1B7;
            font-size: 13.975px;
            font-weight: 400;
            line-height: 20.963px;
        }

        .bottom-content .inner-content .custom-button {
            display: flex;
            padding: 8px 16px;
            justify-content: center;
            align-items: center;
            gap: 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
            line-height: 16px;
            background: #FFF;
        }

        .bottom-content .inner-content .custom-button.btn-grey-outline {
            border: 1px solid #99A1B7;
            color: #78829D;
        }

        .bottom-content .inner-content .color-dark {
            color: #4B5675;
        }

        .conduct-interview .right-side h4 {
            color: #252F4A;
            font-size: 22.75px;
            font-weight: 500;
            line-height: 27.3px;
            margin-bottom: 32px;
        }

        .selected {
            display: none;
        }

        .conduct-interview .right-side form label,
        .selected .right-side form label {
            color: #1E1E1E;
            font-size: 14px;
            font-weight: 400;
            line-height: 20px;
            letter-spacing: 0.25px;
            margin-bottom: 14px;
        }

        .conduct-interview .right-side form .custom-check-input,
        .selected .right-side form .custom-check-input {
            color: #4B5675;
            font-size: 12px;
            font-weight: 500;
            line-height: 16px;
            margin-bottom: 12px;
        }

        .conduct-interview input[type="radio"],
        .filter-buttons input[type="radio"],
        .selected input[type="radio"],
        .filter-buttons input[type="radio"] {
            appearance: none;
            border: 1px solid #DBDFE9;
            padding: 5px;
            border-radius: 50%;
        }

        .conduct-interview input[type="radio"]:checked,
        .filter-buttons input[type="radio"]:checked,
        .selected input[type="radio"]:checked,
        .filter-buttons input[type="radio"]:checked {
            background-color: #fff;
            border: 3.2px solid #F7941C;
            padding: 3px;
        }

        .filter-buttons input[type="checkbox"]:checked {
            accent-color: #F7941C !important;
        }

        .conduct-interview .custom-button {
            padding: 8px 16px;
            border-radius: 4px;
            text-align: center;
            font-size: 14px;
            font-weight: 500;
            line-height: 20px;
            letter-spacing: 0.1px;
        }

        .conduct-interview .custom-button.btn-orange-fill {
            background: #F7941C;
            color: #FFF;
        }

        .sheet-card {
            padding: 24px;
            border-radius: 8px 8px 0px 0px;
            border-bottom: 1px solid #DBDFE9;
            background: #FFF;
        }

        .sheet-card h4 {
            color: #4B5675;
            font-size: 22.75px;
            font-weight: 700;
            line-height: 27.3px;
        }

        .sheet-card .position {
            color: #4B5675;
            font-size: 16.25px;
            font-weight: 500;
            line-height: 19.5px;
            margin-top: 6px;
        }

        .sheet-card .bottom-text {
            margin-top: 16px;
        }

        .sheet-card .bottom-text p {
            color: #78829D;
            font-size: 12px;
            font-weight: 500;
            line-height: 16px;
        }

        .sheet-card .bottom-text .tag {
            display: flex;
            padding: 5.6px 11.2px;
            justify-content: center;
            align-items: center;
            font-size: 8.4px;
            font-weight: 600;
            line-height: 11.2px;
            border-radius: 56px;
        }

        .sheet-card .bottom-text .line {
            width: 1px;
            height: 24px;
            display: block;
            background-color: #C4CADA;
        }

        .filter-buttons .custom-check-input {
            padding: 12px 8px;
            cursor: pointer;
        }

        .filter-buttons .active-btn {
            border: 1px solid #F7941C;
            background: #FFF6EA;
            color: #F7941C;
            font-weight: 600;
        }

        .filter-buttons .dropdown-menu {
            border-radius: 4px;
            padding: 0;
            border: 1px solid #DBDFE9;
        }

        .filter-buttons .button-div {
            padding: 12px 8px;
            gap: 12px;
            border-top: 1px solid #DBDFE9;
        }

        .filter-buttons .filter {
            display: flex;
            padding: 4px 20px;
            justify-content: center;
            align-items: center;
            border-radius: 14.5px;
            background: #F7941C;
            color: #FFF;
            font-size: 12px;
            font-weight: 600;
            line-height: 16px;
        }

        .filter-buttons .resetBtn {
            color: #5B5B5B;
            text-align: right;
            font-size: 12px;
            font-weight: 500;
            line-height: 16px;
            background-color: white;
        }

        .filter-buttons .custom-check-input:hover {
            background: #FFF6EA;
            border-radius: 4px 4px 0px 0px;
        }

        .filter-buttons .custom-check-input.active {
            background: #FFF6EA;
            border-radius: 4px 4px 0px 0px;
        }

        .filter-buttons .custom-check-input label p {
            font-size: 12px;
            font-weight: 500;
            line-height: 16px;
        }

        .filter-buttons .custom-check-input label p {
            color: #000;
        }

        .filter-buttons .custom-check-input label span {
            color: #99A1B7;
        }
    </style>

    <style>
        .page-text {
            color: #4B5675;
            font-size: 12px;
            font-weight: 400;
            line-height: 16px;
            margin-right: 8px;
        }

        .page-input-box {
            width: 66px;
            border-radius: 4px;
            border: 1px solid #D9D9D9;
            color: #4B5675;
            font-size: 12px;
            font-weight: 500;
            line-height: 16px;
            padding: 8px 16px;
        }


        .pagination .page-item .page-link {
            border: none;
            color: #78829D;
            font-weight: 500;
            line-height: 20px;
            font-size: 14px;
            font-weight: 500;
            padding: 6px 12px;
        }

        .pagination .page-item.active .page-link {
            background-color: #F7941C;
            color: #FFF;
            border-radius: 4px;
            font-weight: 600;
        }

        .pagination .page-item.disabled .page-link {
            color: #C4CADA;
        }

        .pagination .page-item .page-link:hover {
            background-color: #F7941C;
            color: #fff !important;
        }

        .dropdown-toggle {
            border: 1px solid #C4CADA;
            padding: 6px 12px;
            border-radius: 6px;
            background: white;
            color: #6C7486;
            font-size: 14px;
        }

        .filter-number {
            padding: 4px 10px;
            border-radius: 12px;
            background: #FFF;
            color: #78829D;
            text-align: center;
            font-size: 12px;
            font-weight: 500;
            line-height: 16px;
            letter-spacing: 0.5px;
            justify-content: center;
        }

        .week-dropdown {
            border-radius: 4px;
            border: 1px solid #C4CADA;
            background: #FFF;
        }

        .week-dropdown .dropdown-item {
            padding: 12px 8px;
            color: #071437;
            font-size: 12px;
            font-weight: 400;
            line-height: 16px;
        }
    </style>

    <style>
        .modal-div .modal-title {
            color: #071437;
            font-size: 19.5px;
            font-weight: 500;
            line-height: 23.4px;
        }

        .modal-div .modal-body p {
            color: #071437;
            font-size: 14px;
            font-weight: 500;
            line-height: 20px;
            text-align: left;
        }

        .modal-div .modal-footer button {
            font-size: 14px;
            font-weight: 600;
            line-height: 20px;
            padding: 14px 20px;
        }

        .modal-div .btn-apply {
            background: #F7941C;
            color: #FFF;
            font-size: 14px;
            font-weight: 600;
            line-height: 20px;
            flex: 1 0 0;
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
                    Candidate Screening
                </h2>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="/admin/dashboard" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">Talent Acquisition</li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">Candidate Screening</li>
                </ul>
            </div>
        </div>
    </div>

    <div id="kt_app_content" class="app-content  flex-column-fluid position-lg-relative">
        <div id="interviewConducted" class="app-container container-xxl w-100">
            @include('admin.talent-acquisition.candidate-screening.interview-conducted.interview-information')
        </div>
    </div>



    <div class="modal fade" tabindex="-1" id="contract-issue">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Select Contract Template</h3>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <iconify-icon icon="radix-icons:cross-1" class="ki-cross fs-1"></iconify-icon>
                    </div>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.contract.template.select') }}" id="templateform" method="post">
                        @csrf
                        <input type="hidden" name="application_id" id="offerLetterapplication_id" value="" required />
    
                        @php $templates = App\Models\ContractTemplate::get(); @endphp
    
                        <div class="fv-row mb-8">
                            <label class="form-label mb-3">Select Contract Template</label>
                            <select class="form-control" name="template_id">
                                @foreach ($templates as $template)
                                    <option value="{{ $template->id ?? '' }}">{{ $template->name ?? '' }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback" id="description_error"></div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="document.getElementById('templateform').submit();">
                        Create Contract
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('scripts')

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".accordion-design").forEach((accordionHeader) => {
                accordionHeader.addEventListener("click", function() {
                    let plusIcon = this.querySelector(".plus-icon");
                    let minusIcon = this.querySelector(".minus-icon");
                    let target = document.querySelector(this.getAttribute("data-bs-target"));

                    if (target.classList.contains("show")) {
                        target.addEventListener("hidden.bs.collapse", function() {
                            plusIcon.classList.remove("d-none");
                            minusIcon.classList.add("d-none");
                        }, {
                            once: true
                        });
                    } else {
                        plusIcon.classList.add("d-none");
                        minusIcon.classList.remove("d-none");

                        target.addEventListener("hidden.bs.collapse", function() {
                            plusIcon.classList.remove("d-none");
                            minusIcon.classList.add("d-none");
                        }, {
                            once: true
                        });
                    }
                });
            });
        });
    </script>

    <script>
        document.querySelectorAll('.dropdown-menu').forEach(menu => {
            menu.querySelectorAll('.custom-check-input').forEach(div => {
                div.addEventListener('click', function() {
                    let radio = this.querySelector('input[type="radio"]');
                    let targetButton = document.getElementById(radio.getAttribute("data-target"));

                    if (radio) {
                        radio.checked = true;
                        menu.querySelectorAll('.custom-check-input').forEach(item => item.classList
                            .remove('active'));
                        this.classList.add('active');
                        if (targetButton) {
                            targetButton.querySelector("span").textContent = radio.value;
                            targetButton.classList.add("active-btn");
                        }
                    }
                });
            });
        });
        document.querySelectorAll('.resetBtn').forEach(button => {
            button.addEventListener('click', function() {
                let menu = this.closest('.dropdown-menu');
                let targetButton = document.getElementById(this.getAttribute("data-target"));

                if (!menu || !targetButton) return;

                let checkboxes = menu.querySelectorAll('input[type="checkbox"]');
                let radios = menu.querySelectorAll('input[type="radio"]');

                if (checkboxes.length > 0) {
                    checkboxes.forEach(checkbox => checkbox.checked = false);
                    menu.querySelectorAll('.custom-check-input').forEach(item => item.classList.remove(
                        'active'));
                    updateCheckboxDropdownText(menu, targetButton);
                }

                if (radios.length > 0 && checkboxes.length === 0) {
                    radios.forEach(radio => radio.checked = false);
                    menu.querySelectorAll('.custom-check-input').forEach(item => item.classList.remove(
                        'active'));
                    targetButton.querySelector("span").textContent = targetButton.getAttribute(
                        "data-default-text");
                    targetButton.classList.remove("active-btn");
                }
            });
        });



        document.querySelectorAll('.dropdown-menu').forEach(menu => {
            menu.querySelectorAll('.custom-check-input').forEach(div => {
                div.addEventListener('click', function(event) {
                    let checkbox = this.querySelector('input[type="checkbox"]');
                    let targetButton = document.getElementById(checkbox.getAttribute(
                        "data-target"));
                    if (checkbox) {
                        if (event.target.tagName !== "INPUT") {
                            checkbox.checked = !checkbox.checked;
                        }
                        this.classList.toggle('active', checkbox.checked);
                        updateCheckboxDropdownText(menu, targetButton);
                    }
                });
            });

            menu.querySelector('.resetBtn')?.addEventListener('click', function() {
                let targetButton = document.getElementById(this.getAttribute("data-target"));

                menu.querySelectorAll('input[type="checkbox"]').forEach(checkbox => checkbox.checked =
                    false);
                menu.querySelectorAll('.custom-check-input').forEach(item => item.classList.remove(
                    'active'));

                if (targetButton) {
                    targetButton.querySelector("span").textContent = targetButton.getAttribute(
                        "data-default-text");
                    targetButton.classList.remove("active-btn");
                }
            });
        });

        function updateCheckboxDropdownText(menu, targetButton) {
            let selectedOptions = [...menu.querySelectorAll('input[type="checkbox"]:checked')].map(cb => cb.value);

            if (targetButton && menu.querySelector('input[type="checkbox"]')) {
                if (selectedOptions.length === 1) {
                    targetButton.querySelector("span").textContent = selectedOptions[0];
                } else if (selectedOptions.length > 1) {
                    targetButton.querySelector("span").innerHTML =
                        `<span class="filter-number">${selectedOptions.length}</span> Job Position`;
                } else {
                    targetButton.querySelector("span").textContent = targetButton.getAttribute("data-default-text");
                }

                targetButton.classList.toggle("active-btn", selectedOptions.length > 0);
            }
        }
    </script>

<script>
    function updateDropdown(element, value) {
        const dropdown = element.closest(".dropdown"); // Find the closest dropdown container
        const textElement = dropdown.querySelector(".selectedText"); // Find the span inside the button
        if (textElement) {
            textElement.textContent = value; // Update the text
        }
    }
</script>


    {{-- <script>
        document.addEventListener("DOMContentLoaded", function () {
            const leftTable = document.querySelector(".left-table"); // Parent container
            const selectedDiv = document.querySelector(".selected");
            const notSelectedDiv = document.querySelector(".not-selected");

            if (!leftTable) {
                console.error("Error: .left-table container not found!");
                return;
            }

            leftTable.addEventListener("click", function (event) {
                const clickedBox = event.target.closest(".table-box"); // Find the closest .table-box

                if (!clickedBox) {
                    console.log("Clicked outside .table-box");
                    return;
                }

                // Show the selected interview details
                selectedDiv.style.display = "block";
                notSelectedDiv.style.display = "none";

                // Remove active class from all table-box elements
                document.querySelectorAll(".table-box").forEach(el => el.classList.remove("active"));

                // Add active class to the clicked .table-box
                clickedBox.classList.add("active");

                // Log interview ID to check if it's working
                console.log("Selected Interview ID:", clickedBox.getAttribute("data-id"));
            });
        });

    </script> --}}

    <style>
        .table-box.active {
            background: #FFF6EA;
        }
    </style>


    {{-- <script>
        document.getElementById("conductInterviewBtn").addEventListener("click", function() {
            document.getElementById("interviewConducted").style.display = "none";
            document.getElementById("interviewConducted").style.display = "none";

            document.getElementById("conductInterview").style.display = "block";
        });

        document.getElementById("backToList").addEventListener("click", function() {
            document.getElementById("interviewConducted").style.display = "block";

            document.getElementById("conductInterview").style.display = "none";
            document.getElementById("interviewConducted").style.display = "none";
        });

        document.getElementById("viewResultBtn").addEventListener("click", function() {
            document.getElementById("interviewConducted").style.display = "none";
            document.getElementById("conductInterview").style.display = "none";

            const interviewConducted = document.getElementById("interviewConducted");
            interviewConducted.classList.remove("d-none");
            interviewConducted.style.display = "block";
        });
    </script> --}}

    {{-- <script>
        $(document).ready(function() {

                    // Declare a variable to store the selected date
        let selectedDate = new Date();
        let selectedRange = 'today'; // Can be 'today', 'week', 'month'

        // Function to update the displayed date and load job applications
        function updateDateDisplay() {
            const formattedDate = selectedDate.toLocaleDateString('en-GB', { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' });
            $('#selectedDate').text(`${selectedRange === 'today' ? 'Today' : ''} ${formattedDate}`);
            loadJobApplications(1); // Trigger data load based on updated date
        }

        // Update the dropdown text for selected range
        function updateDropdown(element, range) {
            selectedRange = range.toLowerCase();
            const dropdown = element.closest(".dropdown"); // Find the closest dropdown container
            const textElement = dropdown.querySelector(".selectedText"); // Find the span inside the button
            if (textElement) {
                textElement.textContent = range; // Update the text
            }
            updateDateDisplay();
        }

        // Change date on left and right arrow click
        $('#leftArrow').click(function () {
            if (selectedRange === 'today') {
                selectedDate.setDate(selectedDate.getDate() - 1); // Move to yesterday
            } else if (selectedRange === 'week') {
                selectedDate.setDate(selectedDate.getDate() - 7); // Move to previous week
            } else if (selectedRange === 'month') {
                selectedDate.setMonth(selectedDate.getMonth() - 1); // Move to previous month
            }
            updateDateDisplay();
        });

        $('#rightArrow').click(function () {
            if (selectedRange === 'today') {
                selectedDate.setDate(selectedDate.getDate() + 1); // Move to tomorrow
            } else if (selectedRange === 'week') {
                selectedDate.setDate(selectedDate.getDate() + 7); // Move to next week
            } else if (selectedRange === 'month') {
                selectedDate.setMonth(selectedDate.getMonth() + 1); // Move to next month
            }
            updateDateDisplay();
        });


            // Function to load job applications with filters and pagination
            function loadJobApplications(page = 1) {
                showOverlay();

                // Collect filter values
                let perPage = $('#rowsPerPage').val(); // Rows per page
                let departmentId = $('input[name="departmentFilter"]:checked').data('id'); // Get the department filter value
                let jobPositionId = $('input[name="jobPositionFilter"]:checked').data('id'); // Get the job position filter value
                let interviewMode = $('input[name="interviewTypeFilter"]:checked').data('id'); // Get the interview type filter value

                 // Get selected date range (today, this week, or this month)
                const dateString = selectedDate.toISOString().split('T')[0]; // Get date in YYYY-MM-DD format
                let startDate = dateString;
                let endDate = dateString;

                if (selectedRange === 'week') {
                    const startOfWeek = new Date(selectedDate);
                    startOfWeek.setDate(selectedDate.getDate() - selectedDate.getDay()); // First day of the week
                    const endOfWeek = new Date(selectedDate);
                    endOfWeek.setDate(selectedDate.getDate() + (6 - selectedDate.getDay())); // Last day of the week
                    startDate = startOfWeek.toISOString().split('T')[0];
                    endDate = endOfWeek.toISOString().split('T')[0];
                } else if (selectedRange === 'month') {
                    const startOfMonth = new Date(selectedDate.getFullYear(), selectedDate.getMonth(), 1); // First day of the month
                    const endOfMonth = new Date(selectedDate.getFullYear(), selectedDate.getMonth() + 1, 0); // Last day of the month
                    startDate = startOfMonth.toISOString().split('T')[0];
                    endDate = endOfMonth.toISOString().split('T')[0];
                }

                $.ajax({
                    url: '/admin/talent-acquisition/candidate-screening/upcoming-interview', // Your route
                    method: 'GET',
                    data: {
                        page: page,
                        per_page: perPage,
                        department_id: departmentId, // Send department filter
                        job_position_id: jobPositionId, // Send job position filter
                        interview_mode: interviewMode, // Send interview type filter
                        start_date: startDate, // Send the start date for filtering
                        end_date: endDate, // Send the end date for filtering
                    },
                    success: function(response) {
                        // Update the table with new job applications
                        $('div.left-table').html(response.html);  // Replace the table content
                        hideOverlay();
                    },
                    error: function(xhr) {
                        console.log('Error:', xhr);  // Log error in case of failure
                        hideOverlay();
                    }
                });
            }

            // Load job applications on page change
            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();
                let page = $(this).attr('href').split('page=')[1]; // Get the page number from the URL
                loadJobApplications(page); // Load job applications for the clicked page
            });

            // Load job applications on rows per page change
            $(document).on('change', '#rowsPerPage', function() {
                let perPage = $(this).val(); // Get selected rows per page
                loadJobApplications(1, perPage); // Reload job applications from page 1 with the selected rows per page
            });

             // Trigger the filter logic when "Apply" button is clicked
            $('#departFilter').on('click', function() {
                loadJobApplications(1); // Reload job applications from the first page when the apply button is clicked
            });

            // Reset filters
            $('#departReset').on('click', function() {
                $('input[name="departmentFilter"]').prop('checked', false); // Reset department filter
                loadJobApplications(1); // Reload job applications from the first page
            });

            $('#jobFilter').on('click', function() {
                loadJobApplications(1); // Reload job applications from the first page when the apply button is clicked
            });

            // Reset filters
            $('#jobReset').on('click', function() {
                $('input[name="jobPositionFilter"]').prop('checked', false); // Reset job position filter
                loadJobApplications(1); // Reload job applications from the first page
            });

            $('#typeFilter').on('click', function() {
                loadJobApplications(1); // Reload job applications from the first page when the apply button is clicked
            });

            // Reset filters
            $('#typeReset').on('click', function() {
                $('input[name="interviewTypeFilter"]').prop('checked', false); // Reset interview type filter
                loadJobApplications(1); // Reload job applications from the first page
            });

            // Update dropdown when "Today", "This Week", or "This Month" is selected
            $(document).on('click', '.dropdown-item', function (e) {
                const selectedRange = $(this).text(); // Get the selected range text (Today, This Week, or This Month)
                updateDropdown(this, selectedRange);
            });

            // Initial load
            updateDateDisplay();
        });
    </script> --}}

    {{-- <script>
        $(document).ready(function() {
            // Declare a variable to store the selected date and range
            let selectedDate = new Date(); // Default is Today
            let selectedRange = 'today'; // Can be 'today', 'week', 'month'
    
            // Function to update the displayed date and load job applications
            function updateDateDisplay() {
                const formattedDate = selectedDate.toLocaleDateString('en-GB', { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' });
                $('#selectedDate').text(`${formattedDate}`);
                loadJobApplications(1); // Trigger data load based on updated date
            }
    
            // Update the dropdown text for selected range
            function updateDropdown(element, range) {
                selectedRange = range.toLowerCase();
                const dropdown = element.closest(".dropdown"); // Find the closest dropdown container
                const textElement = dropdown.querySelector(".selectedText"); // Find the span inside the button
                if (textElement) {
                    textElement.textContent = range; // Update the text
                }
                updateDateDisplay();
            }
    
            // Change date on left and right arrow click
            $('#leftArrow').click(function () {
                if (selectedRange === 'today') {
                    selectedDate.setDate(selectedDate.getDate() - 1); // Move to yesterday
                } else if (selectedRange === 'week') {
                    selectedDate.setDate(selectedDate.getDate() - 7); // Move to previous week
                } else if (selectedRange === 'month') {
                    selectedDate.setMonth(selectedDate.getMonth() - 1); // Move to previous month
                }
                updateDateDisplay();
            });
    
            $('#rightArrow').click(function () {
                if (selectedRange === 'today') {
                    selectedDate.setDate(selectedDate.getDate() + 1); // Move to tomorrow
                } else if (selectedRange === 'week') {
                    selectedDate.setDate(selectedDate.getDate() + 7); // Move to next week
                } else if (selectedRange === 'month') {
                    selectedDate.setMonth(selectedDate.getMonth() + 1); // Move to next month
                }
                updateDateDisplay();
            });

            // Update dropdown when "Today", "This Week", or "This Month" is selected
            $(document).on('click', '.dropdown-item', function (e) {
                const selectedRange = $(this).text(); // Get the selected range text (Today, This Week, or This Month)
                updateDropdown(this, selectedRange);
            });
    
            // Function to load job applications with filters and pagination
            function loadJobApplications(page = 1) {
                showOverlay();
    
                // Collect filter values
                let perPage = $('#rowsPerPage').val(); // Rows per page
                let departmentId = $('input[name="departmentFilter"]:checked').data('id'); // Get the department filter value
                let jobPositionId = $('input[name="jobPositionFilter"]:checked').data('id'); // Get the job position filter value
                let interviewMode = $('input[name="interviewTypeFilter"]:checked').data('id'); // Get the interview type filter value
    
                // Get selected date range (today, this week, or this month)
                const dateString = selectedDate.toISOString().split('T')[0]; // Get date in YYYY-MM-DD format
                let startDate = dateString;
                let endDate = dateString;
    
                // If the range is 'week', calculate the week start and end
                if (selectedRange === 'week') {
                    const startOfWeek = new Date(selectedDate);
                    startOfWeek.setDate(selectedDate.getDate() - selectedDate.getDay()); // First day of the week
                    const endOfWeek = new Date(selectedDate);
                    endOfWeek.setDate(selectedDate.getDate() + (6 - selectedDate.getDay())); // Last day of the week
                    startDate = startOfWeek.toISOString().split('T')[0];
                    endDate = endOfWeek.toISOString().split('T')[0];
                }
                // If the range is 'month', calculate the month start and end
                else if (selectedRange === 'month') {
                    const startOfMonth = new Date(selectedDate.getFullYear(), selectedDate.getMonth(), 1); // First day of the month
                    const endOfMonth = new Date(selectedDate.getFullYear(), selectedDate.getMonth() + 1, 0); // Last day of the month
                    startDate = startOfMonth.toISOString().split('T')[0];
                    endDate = endOfMonth.toISOString().split('T')[0];
                }
    
                $.ajax({
                    url: '/admin/talent-acquisition/candidate-screening/upcoming-interview', // Your route
                    method: 'GET',
                    data: {
                        page: page,
                        per_page: perPage,
                        department_id: departmentId, // Send department filter
                        job_position_id: jobPositionId, // Send job position filter
                        interview_mode: interviewMode, // Send interview type filter
                        start_date: startDate, // Send the start date for filtering
                        end_date: endDate, // Send the end date for filtering
                    },
                    success: function(response) {
                        // Update the table with new job applications
                        $('div.left-table').html(response.html);  // Replace the table content
                        hideOverlay();
                    },
                    error: function(xhr) {
                        console.log('Error:', xhr);  // Log error in case of failure
                        hideOverlay();
                    }
                });
            }
    
            // Load job applications on page change
            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();
                let page = $(this).attr('href').split('page=')[1]; // Get the page number from the URL
                loadJobApplications(page); // Load job applications for the clicked page
            });
    
            // Load job applications on rows per page change
            $(document).on('change', '#rowsPerPage', function() {
                let perPage = $(this).val(); // Get selected rows per page
                loadJobApplications(1, perPage); // Reload job applications from page 1 with the selected rows per page
            });
    
            // Trigger the filter logic when "Apply" button is clicked
            $('#departFilter').on('click', function() {
                loadJobApplications(1); // Reload job applications from the first page when the apply button is clicked
            });
    
            // Reset filters
            $('#departReset').on('click', function() {
                $('input[name="departmentFilter"]').prop('checked', false); // Reset department filter
                loadJobApplications(1); // Reload job applications from the first page
            });
    
            $('#jobFilter').on('click', function() {
                loadJobApplications(1); // Reload job applications from the first page when the apply button is clicked
            });
    
            // Reset filters
            $('#jobReset').on('click', function() {
                $('input[name="jobPositionFilter"]').prop('checked', false); // Reset job position filter
                loadJobApplications(1); // Reload job applications from the first page
            });
    
            $('#typeFilter').on('click', function() {
                loadJobApplications(1); // Reload job applications from the first page when the apply button is clicked
            });
    
            // Reset filters
            $('#typeReset').on('click', function() {
                $('input[name="interviewTypeFilter"]').prop('checked', false); // Reset interview type filter
                loadJobApplications(1); // Reload job applications from the first page
            });
    
            // Initial load
            updateDateDisplay();
        });
    </script> --}}

    {{-- <script>
        $(document).ready(function() {
            // Declare a variable to store the selected date and range
            let selectedDate = new Date(); // Default is Today
            let selectedRange = 'today'; // Can be 'today', 'week', 'month'
    
            // Function to update the displayed date and load job applications
            function updateDateDisplay() {
                const formattedDate = selectedDate.toLocaleDateString('en-GB', { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' });
                console.log(formattedDate);
                $('#selectedDate').text(`${formattedDate}`);
                loadJobApplications(1); // Trigger data load based on updated date
            }
    
            // Update the dropdown text for selected range
            function updateDropdown(element, range) {
                selectedRange = range.toLowerCase();
                const dropdown = element.closest(".dropdown"); // Find the closest dropdown container
                const textElement = dropdown.querySelector(".selectedText"); // Find the span inside the button
                if (textElement) {
                    textElement.textContent = range; // Update the text
                }
                updateDateDisplay();
            }
    
            // Change date on left and right arrow click
            $('#leftArrow').click(function () {
                console.log(selectedRange);
                if (selectedRange === 'today') {
                    selectedDate.setDate(selectedDate.getDate() - 1); // Move to yesterday
                } else if (selectedRange === 'this week') {
                    selectedDate.setDate(selectedDate.getDate() - 7); // Move to previous week
                } else if (selectedRange === 'this month') {
                    selectedDate.setMonth(selectedDate.getMonth() - 1); // Move to previous month
                }
                updateDateDisplay();
            });
    
            $('#rightArrow').click(function () {
                if (selectedRange === 'today') {
                    selectedDate.setDate(selectedDate.getDate() + 1); // Move to tomorrow
                } else if (selectedRange === 'this week') {
                    selectedDate.setDate(selectedDate.getDate() + 7); // Move to next week
                } else if (selectedRange === 'this month') {
                    selectedDate.setMonth(selectedDate.getMonth() + 1); // Move to next month
                }
                updateDateDisplay();
            });

            // Update dropdown when "Today", "This Week", or "This Month" is selected
            $(document).on('click', '.dropdown-item', function (e) {
                const selectedRange = $(this).text(); // Get the selected range text (Today, This Week, or This Month)
                updateDropdown(this, selectedRange);
            });
    
            // Function to load job applications with filters and pagination
            function loadJobApplications(page = 1) {
                showOverlay();
    
                // Collect filter values
                let perPage = $('#rowsPerPage').val(); // Rows per page
                let departmentId = $('input[name="departmentFilter"]:checked').data('id'); // Get the department filter value
                let jobPositionId = $('input[name="jobPositionFilter"]:checked').data('id'); // Get the job position filter value
                let interviewMode = $('input[name="interviewTypeFilter"]:checked').data('id'); // Get the interview type filter value
                let performanceLevels = [];
                $('input[name="interviewPerformanceType"]:checked').each(function () {
                    performanceLevels.push($(this).val());
                });

                let selectionMatrix = [];
                $('input[name="selectionMatrixFilter"]:checked').each(function () {
                    selectionMatrix.push($(this).data('id')); // Get the data-id instead of the value
                });

                 // Convert the selected date to a string in 'YYYY-MM-DD' format
                const dateString = selectedDate.toISOString().split('T')[0];
    
                $.ajax({
                    url: '/admin/talent-acquisition/candidate-screening/interview-conduct', // Your route
                    method: 'GET',
                    data: {
                        page: page,
                        per_page: perPage,
                        department_id: departmentId, // Send department filter
                        job_position_id: jobPositionId, // Send job position filter
                        interview_mode: interviewMode, // Send interview type filter
                        performance_levels: performanceLevels.join(','),
                        selection_matrix: selectionMatrix.join(','),
                        date: dateString // Send the selected date to the server
                    },
                    success: function(response) {
                        // Update the table with new job applications
                        $('div.left-table').html(response.html);  // Replace the table content
                        hideOverlay();
                    },
                    error: function(xhr) {
                        console.log('Error:', xhr);  // Log error in case of failure
                        hideOverlay();
                    }
                });
            }
    
            // Load job applications on page change
            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();
                let page = $(this).attr('href').split('page=')[1]; // Get the page number from the URL
                loadJobApplications(page); // Load job applications for the clicked page
            });
    
            // Load job applications on rows per page change
            $(document).on('change', '#rowsPerPage', function() {
                let perPage = $(this).val(); // Get selected rows per page
                loadJobApplications(1, perPage); // Reload job applications from page 1 with the selected rows per page
            });
    
            // Trigger the filter logic when "Apply" button is clicked
            $('#departFilter').on('click', function() {
                loadJobApplications(1); // Reload job applications from the first page when the apply button is clicked
            });
    
            // Reset filters
            $('#departReset').on('click', function() {
                $('input[name="departmentFilter"]').prop('checked', false); // Reset department filter
                loadJobApplications(1); // Reload job applications from the first page
            });
    
            $('#jobFilter').on('click', function() {
                loadJobApplications(1); // Reload job applications from the first page when the apply button is clicked
            });
    
            // Reset filters
            $('#jobReset').on('click', function() {
                $('input[name="jobPositionFilter"]').prop('checked', false); // Reset job position filter
                loadJobApplications(1); // Reload job applications from the first page
            });
    
            $('#typeFilter').on('click', function() {
                loadJobApplications(1); // Reload job applications from the first page when the apply button is clicked
            });
    
            // Reset filters
            $('#typeReset').on('click', function() {
                $('input[name="interviewTypeFilter"]').prop('checked', false); // Reset interview type filter
                loadJobApplications(1); // Reload job applications from the first page
            });

            $('#performanceFilter').on('click', function () {
                loadJobApplications(1);
            });

            $('#performanceReset').on('click', function () {
                $('input[name="interviewPerformanceType"]').prop('checked', false);
                loadJobApplications(1);
            });

            $('#matricsFilter').on('click', function () {
                loadJobApplications(1);
            });

            $('#matricsReset').on('click', function () {
                $('input[name="selectionMatrixFilter"]').prop('checked', false);
                loadJobApplications(1);
            });
    
            // Initial load
            updateDateDisplay();
        });
    </script> --}}

    <script>
        $(document).ready(function() {
            // Declare a variable to store the selected date and range
            let selectedDate = new Date(); // Default is Today
            let selectedRange = 'today'; // Can be 'today', 'week', 'month'
    
             // Format YYYY-MM-DD
            function formatDate(date) {
                return date.toISOString().split('T')[0];
            }

            // Compute start and end date based on selected range
            function getDateRange() {
                let startDate, endDate;
                const tempDate = new Date(selectedDate);

                if (selectedRange === 'today') {
                    startDate = endDate = formatDate(tempDate);
                } else if (selectedRange === 'this week') {
                    const day = tempDate.getDay(); // 0=Sun...6=Sat
                    const diffToMonday = tempDate.getDate() - day + (day === 0 ? -6 : 1);
                    startDate = new Date(tempDate.setDate(diffToMonday));
                    endDate = new Date(startDate);
                    endDate.setDate(endDate.getDate() + 6);
                    startDate = formatDate(startDate);
                    endDate = formatDate(endDate);
                } else if (selectedRange === 'this month') {
                    startDate = new Date(tempDate.getFullYear(), tempDate.getMonth(), 1);
                    endDate = new Date(tempDate.getFullYear(), tempDate.getMonth() + 1, 0);
                    startDate = formatDate(startDate);
                    endDate = formatDate(endDate);
                }

                return { startDate, endDate };
            }

            // Update date display and reload data
            function updateDateDisplay() {
                const { startDate, endDate } = getDateRange();
                let displayText = '';

                if (startDate === endDate) {
                    const dateObj = new Date(startDate);
                    displayText = dateObj.toLocaleDateString('en-GB', {
                        weekday: 'long', day: 'numeric', month: 'long', year: 'numeric'
                    });
                } else {
                    const startObj = new Date(startDate);
                    const endObj = new Date(endDate);
                    displayText = `${startObj.toLocaleDateString('en-GB')} - ${endObj.toLocaleDateString('en-GB')}`;
                }

                $('#selectedDate').text(displayText);
                loadJobApplications(1);
            }

            // Change selected range from dropdown
            function updateDropdown(element, range) {
                selectedRange = range.toLowerCase();

                // Always reset anchor to actual today when a new range is selected
                selectedDate = new Date();

                const dropdown = element.closest(".dropdown");
                const textElement = dropdown.querySelector(".selectedText");

                if (textElement) {
                    textElement.textContent = range;
                }

                updateDateDisplay();
            }

            // Left arrow = previous range
            $('#leftArrow').click(function () {
                if (selectedRange === 'today') {
                    selectedDate.setDate(selectedDate.getDate() - 1);
                } else if (selectedRange === 'this week') {
                    selectedDate.setDate(selectedDate.getDate() - 7);
                } else if (selectedRange === 'this month') {
                    selectedDate.setMonth(selectedDate.getMonth() - 1);
                }
                updateDateDisplay();
            });

            // Right arrow = next range
            $('#rightArrow').click(function () {
                if (selectedRange === 'today') {
                    selectedDate.setDate(selectedDate.getDate() + 1);
                } else if (selectedRange === 'this week') {
                    selectedDate.setDate(selectedDate.getDate() + 7);
                } else if (selectedRange === 'this month') {
                    selectedDate.setMonth(selectedDate.getMonth() + 1);
                }
                updateDateDisplay();
            });

            // Range change from dropdown
            $(document).on('click', '.dropdown-item', function (e) {
                const selectedText = $(this).text();
                updateDropdown(this, selectedText);
            });
    
            // Function to load job applications with filters and pagination
            function loadJobApplications(page = 1) {
                showOverlay();
                const { startDate, endDate } = getDateRange();
    
                // Collect filter values
                let perPage = $('#rowsPerPage').val(); // Rows per page
                let departmentId = $('input[name="departmentFilter"]:checked').data('id'); // Get the department filter value
                let jobPositionId = $('input[name="jobPositionFilter"]:checked').data('id'); // Get the job position filter value
                let interviewMode = $('input[name="interviewTypeFilter"]:checked').data('id'); // Get the interview type filter value
                let performanceLevels = [];
                $('input[name="interviewPerformanceType"]:checked').each(function () {
                    performanceLevels.push($(this).val());
                });

                let selectionMatrix = [];
                $('input[name="selectionMatrixFilter"]:checked').each(function () {
                    selectionMatrix.push($(this).data('id')); // Get the data-id instead of the value
                });

                 // Convert the selected date to a string in 'YYYY-MM-DD' format
                const dateString = selectedDate.toISOString().split('T')[0];
    
                $.ajax({
                    url: '/admin/talent-acquisition/candidate-screening/interview-conduct', // Your route
                    method: 'GET',
                    data: {
                        page: page,
                        per_page: perPage,
                        department_id: departmentId, // Send department filter
                        job_position_id: jobPositionId, // Send job position filter
                        interview_mode: interviewMode, // Send interview type filter
                        performance_levels: performanceLevels.join(','),
                        selection_matrix: selectionMatrix.join(','),
                        start_date: startDate,
                        end_date: endDate
                    },
                    success: function(response) {
                        // Update the table with new job applications
                        $('div.left-table').html(response.html);  // Replace the table content
                        hideOverlay();
                    },
                    error: function(xhr) {
                        console.log('Error:', xhr);  // Log error in case of failure
                        hideOverlay();
                    }
                });
            }
    
            // Load job applications on page change
            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();
                let page = $(this).attr('href').split('page=')[1]; // Get the page number from the URL
                loadJobApplications(page); // Load job applications for the clicked page
            });
    
            // Load job applications on rows per page change
            $(document).on('change', '#rowsPerPage', function() {
                let perPage = $(this).val(); // Get selected rows per page
                loadJobApplications(1, perPage); // Reload job applications from page 1 with the selected rows per page
            });
    
            // Trigger the filter logic when "Apply" button is clicked
            $('#departFilter').on('click', function() {
                loadJobApplications(1); // Reload job applications from the first page when the apply button is clicked
            });
    
            // Reset filters
            $('#departReset').on('click', function() {
                $('input[name="departmentFilter"]').prop('checked', false); // Reset department filter
                loadJobApplications(1); // Reload job applications from the first page
            });
    
            $('#jobFilter').on('click', function() {
                loadJobApplications(1); // Reload job applications from the first page when the apply button is clicked
            });
    
            // Reset filters
            $('#jobReset').on('click', function() {
                $('input[name="jobPositionFilter"]').prop('checked', false); // Reset job position filter
                loadJobApplications(1); // Reload job applications from the first page
            });
    
            $('#typeFilter').on('click', function() {
                loadJobApplications(1); // Reload job applications from the first page when the apply button is clicked
            });
    
            // Reset filters
            $('#typeReset').on('click', function() {
                $('input[name="interviewTypeFilter"]').prop('checked', false); // Reset interview type filter
                loadJobApplications(1); // Reload job applications from the first page
            });

            $('#performanceFilter').on('click', function () {
                loadJobApplications(1);
            });

            $('#performanceReset').on('click', function () {
                $('input[name="interviewPerformanceType"]').prop('checked', false);
                loadJobApplications(1);
            });

            $('#matricsFilter').on('click', function () {
                loadJobApplications(1);
            });

            $('#matricsReset').on('click', function () {
                $('input[name="selectionMatrixFilter"]').prop('checked', false);
                loadJobApplications(1);
            });
    
            // Initial load
            updateDateDisplay();
        });
    </script>



<script>
    document.addEventListener("DOMContentLoaded", function () {
    const leftTable = document.querySelector(".left-table");
    const selectedDiv = document.querySelector(".selected");
    const notSelectedDiv = document.querySelector(".not-selected");

    if (!leftTable) {
        console.error("Error: .left-table container not found!");
        return;
    }

    leftTable.addEventListener("click", function (event) {
        const clickedBox = event.target.closest(".table-box");
        showOverlay();

        if (!clickedBox) {
            console.log("Clicked outside .table-box");
            return;
        }

        document.querySelectorAll(".table-box").forEach(el => el.classList.remove("active"));
        clickedBox.classList.add("active");

        selectedDiv.style.display = "block";
        notSelectedDiv.style.display = "none";

        const applicationId = clickedBox.getAttribute('data-id');

        fetchInterviewInfo(applicationId);
    });
});

function fetchInterviewInfo(applicationId) {
    fetch(`/admin/talent-acquisition/candidate-screening/interview-conduct-data/${applicationId}`)
        .then(response => response.ok ? response.json() : response.text().then(text => { throw new Error(text); }))
        .then(data => {
            if (!data.success) throw new Error(data.message);
            updateInterviewInfo(data);
            hideOverlay();
        })
        .catch(error => {
            console.error('Error fetching interview details:', error);
            hideOverlay();
        });
}

function updateInterviewInfo(data) {
    document.getElementById("candidateName").innerText = data.candidate_name;
    document.getElementById("appliedPosition").innerText = data.job_position;
    document.getElementById("interviewPerformanceTag").innerText = data.interview_performance_description;
    
        // Add this
        const selectionMatrixLevels = {
        0: "Data Not Available",
        1: "Reject",
        2: "Review",
        3: "Consider Further",
        4: "Hire",
    };

    const selectionMatrixTag = document.getElementById("selectionMatrixTag");
    const level = data.selection_matrix_level ?? 0;
    selectionMatrixTag.innerText = selectionMatrixLevels[level];



    const interviewQuestionsContainer = document.getElementById("interviewQuestions");
    interviewQuestionsContainer.innerHTML = "";

    // Define the available options from config
    const options = {
        1: "Needs Improvement",
        3: "Meets Expectations",
        5: "Exceeds Expectations"
    };

    data.interview_questions.forEach((question, index) => {
        let questionHTML = `
            <div class="mb-5">
                <label>${question.question_number}. ${question.title}</label>`;

        // Check which option should be selected based on the marks
        let selectedScore = question.marks; 

        Object.entries(options).forEach(([score, label], idx) => {
            let optionScore = question[`option_${idx + 1}_score`]; // option_1_score, option_2_score, etc.
            let checked = optionScore == selectedScore ? "checked" : "";

            questionHTML += `
                <div class="d-flex gap-3 align-items-center custom-check-input">
                    <input type="radio" name="question_${question.question_id}" value="${optionScore}" ${checked} disabled>
                    ${label}
                </div>`;
        });

        questionHTML += `</div>`;
        interviewQuestionsContainer.innerHTML += questionHTML;
    });

    // Add a single comment field at the end
    document.getElementById("additionalComment").value = data.comment;
    document.getElementById("additionalComment").readOnly = true;

    document.getElementById("goToHiringPipeline").onclick = function () {
        if (data.job_opening_id) {
            const url = `/admin/talent-acquisition/job-advertisement/detail/${data.job_opening_id}?page=hiring-pipeline`;
            window.open(url, '_blank'); // Open in a new tab
        } else {
            alert("Job Opening ID not available.");
        }
    };

    document.getElementById("issueContractBtn").onclick = function () {
        const applicationId = data.application_id ?? null;
        const applicantName = data.candidate_name ?? "";

        if (!applicationId) {
            alert("Application ID not found.");
            return;
        }

        // Set data-userid attribute dynamically
        const button = document.getElementById("issueContractBtn");
        button.setAttribute("data-userid", applicationId);

        // Also set it in the hidden input field
        document.getElementById("offerLetterapplication_id").value = applicationId;

        // Optional: show name
        const applicantNameField = document.getElementById("candidateNameInModal");
        if (applicantNameField) {
            applicantNameField.innerText = applicantName;
        }

        // Open the modal
        const contractModal = new bootstrap.Modal(document.getElementById("contract-issue"));
        contractModal.show();
    };



}




</script>



    


@endsection
