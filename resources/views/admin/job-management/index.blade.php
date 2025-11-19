@extends('admin.layout.app')

@section('title', 'Job Management')

@section('styles')
    <style>
        .navtab-btn {
            display: flex;
            border: 1px solid #F7941D;
            border-radius: 6px;
            overflow: hidden;
        }

        .navtab-btn .tab-link {
            text-align: center;
            padding: 8px 16px;
            color: #F7941D;
            background-color: #fff;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 12px;
            line-height: 16px;
        }

        .navtab-btn .tab-link.active-tab {
            background-color: #F7941D;
            color: #fff;
        }

        .search-wrapper {
            height: 32px;
            display: flex;
        }

        .search-input {
            width: 270px;
            padding: 0px 12px;
            border-radius: 4px 0px 0px 4px;
            border: 1px solid #C4CADA;
            border-right: 0;
            background: #FFF;
            color: #99A1B7;
            font-size: 12px;
            font-weight: 400;
        }

        .search-icon {
            display: flex;
            padding: 0px 8px;
            align-items: center;
            border-radius: 0px 4px 4px 0px;
            border: 1px solid #C4CADA;
            background: #FFF;
            color: #99A1B7;
        }

        .btn-view-jd {
            border: 1px solid #ced4da;
            color: #6c757d;
            background-color: white;
        }

        .btn-view-jd i {
            margin-right: 4px;
        }

        input:focus-visible {
            outline: none !important;
            box-shadow: none !important;
        }

        .custom-btn {
            height: 35px;
            padding: 8px 16px;
            background: #F7941C;
            justify-content: center;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
            width: fit-content;
        }

        .custom-btn.orange-fill,
        .orange-fill-popup {
            background: #F7941C;
            color: #FFF;
        }

        .orange-outline-popup {
            border: 1px solid #F7941C !important;
            background: #FFF;
            color: #F7941C;
        }

        .disable-grey-popup {
            border: 1px solid #DBDFE9 !important;
            background: #F1F1F4;
            color: #99A1B7;
        }

        .grey-outline-popup {
            border: 1px solid #99A1B7 !important;
            background: #FFF;
            color: #78829D;

        }

        .btn-view-jd {
            padding: 8px 16px;
            border-radius: 4px;
            border: 1px solid #99A1B7;
            background: #FFF;
            color: #78829D;
            font-size: 12px;
            font-weight: 600;
            line-height: 16px;
        }

        .line-h {
            width: 1px;
            height: 32px;
            background: #DDD;
        }

        .dropdown-menu.show {
            transform: translate3d(1063px, 205.5px, 0px) !important;
            width: 11%;
            border-radius: 8px;
            border: 1px solid #D9D9D9;
            box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.03);
            padding: 8px;
        }

        .dropdown-item {
            display: flex;
            padding: 12px 16px;
            align-items: flex-start;
            gap: 4px;
            border-radius: 8px;
            color: #1E1E1E;
            font-size: 12px;
            font-style: normal;
            font-weight: 400;
            line-height: 16px;
        }

        .empty-state {
            display: flex;
            height: 70vh;
            padding: 118px 232px;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 16px;
            border-radius: 8px;
            background: #F1F1F4;
            box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.03);
            margin-top: 28px;
        }

        .empty-state p {
            color: #4B5675;
            text-align: center;
            font-size: 19.5px;
            font-weight: 500;
            line-height: 23.4px;
        }

        .sector-main {
            margin-top: 28px;
            display: flex;
            align-items: center;
            gap: 28px 31px;
            flex-wrap: wrap;
        }

        .sector-box {
            min-width: 397px;
            margin: auto;
            display: flex;
            padding: 26px 29.25px;
            flex-direction: column;
            align-items: flex-start;
            border-radius: 8.125px;
            background: #FFF;
            box-shadow: 0px 2px 8px 0px rgba(0, 0, 0, 0.1);
        }

        .sector-box:hover {
            background: #FFF6EA;
        }

        .sector-box img {
            margin-bottom: 16.25px;
        }

        .sector-box h4 {
            margin-bottom: 22.75px;
        }

        .modal-header {
            border-bottom: none;
            padding-bottom: 0px;
        }

        .modal-footer {
            border-top: none;
            padding-top: 0px;
        }

        .modal-footer button {
            flex: 1 0 0;
            padding: 14px 20px;
            border: none;
            border-radius: 4px;
        }

        .custom-popup-body h4 {
            margin: 16px auto 13px auto;
            color: #4B5675;
            font-size: 22.75px;
            font-weight: 700;
            line-height: 27.3px;
        }

        .custom-popup-body p {
            color: #4B5675;
            font-size: 14px;
            font-style: normal;
            font-weight: 400;
            line-height: 20px;
            margin-bottom: 16px;
        }

        .manually-radio {
            position: relative;
        }

        .manually-radio input[type="radio"] {
            display: none;
        }

        .manually-radio input[type="radio"]:checked+.manually-modal-inner {
            border: 2px solid #F7941C !important;
        }

        .manually-modal-inner {
            border-radius: 16px;
            border: 2px solid #F1F1F4;
            padding: 16px;
            flex: 1 0 0;
            min-width: 32%;
            height: 150px;
            cursor: pointer;
        }

        .manually-modal-inner:hover {
            border: 2px solid #F7941C;
        }

        .manually-modal-inner .line {
            height: 2px;
            width: 100%;
            display: block;
            background-color: #F1F1F4;
        }
    </style>
@endsection

@section('content')
    <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">
        <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                    Job Management
                </h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="#" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted" id="breadcrumbText">Company JDs</li>
                </ul>
            </div>
            <div class="navtab-btn">
                <a href="#" id="companyJDsTab" class="tab-link active-tab">Company JDs</a>
                <a href="#" id="jdMasterListTab" class="tab-link">JD Master List</a>
            </div>
        </div>
    </div>
    <div id="kt_app_content" class="app-content  flex-column-fluid ">
        <div id="kt_app_content_container" class="app-container  container-xxl">
            <div id="tabContent" class="pb-9">
                <div id="companyContent">
                    <div class="d-flex justify-content-between">
                        <h1 class="m-0">Departments</h1>
                        <div class="d-flex align-items-center gap-5">
                            <div class="search-wrapper">
                                <input type="text" class="search-input" placeholder="Search Department">
                                <button class="search-icon">
                                    <iconify-icon icon="iconamoon:search-bold" width="16" height="16"></iconify-icon>
                                </button>
                            </div>
                            <button
                            class="btn custom-btn orange-fill d-flex gap-2 align-items-center"
                            type="button"
                            id="createJDDropdown"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                            >
                                <iconify-icon icon="stash:plus-solid" width="16" height="16"></iconify-icon>
                                <span>Create New JD</span>
                                <iconify-icon icon="fluent:chevron-down-12-filled" width="16" height="16"></iconify-icon>
                            </button>

                            
                            <div class="dropdown-menu" aria-labelledby="createJDDropdown">
                                <a href="javascript:void(0);" class="dropdown-item redirect-link"
                                    data-url="{{ route('admin.job-management.createJd', ['type' => 'Ai']) }}">
                                    Create with AI
                                    <iconify-icon icon="f7:sparkles" width="16" height="16" style="color: #78829D;"></iconify-icon>
                                </a>
                                <a class="dropdown-item" data-bs-toggle="modal" href="#CreateJDManually">
                                    Create Manually
                                    <iconify-icon icon="prime:pencil" width="16" height="16" style="color: #78829D;"></iconify-icon>
                                </a>
                            </div>
                            <div class="line-h"></div>
                            <button class="btn-view-jd d-flex align-items-center gap-2">
                                <iconify-icon icon="f7:sparkles" class="mr-1" width="16"
                                    height="16"></iconify-icon> View JD
                            </button>
                        </div>
                    </div>
                    <div class="empty-state">
                        <p>
                            You haven’t added any company JDs yet. <br>
                            Click “Create New JD” to get started.
                        </p>
                        <div class="custom-btn orange-fill d-flex gap-2 align-items-center" data-bs-toggle="modal"
                            data-bs-target="#createNewJD">
                            <iconify-icon type="button" icon="stash:plus-solid" width="16"
                                height="16"></iconify-icon>
                            <span type="button">
                                Create New JD
                            </span>
                            <div class="modal fade" id="createNewJD" tabindex="-1" aria-labelledby="createNewJDLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body py-0">
                                            <div class="custom-popup-body text-center m-auto w-75">
                                                <iconify-icon icon="iconoir:question-mark-circle" width="70"
                                                    height="70" style="color: #F8BB86;"></iconify-icon>
                                                <h4>How would you like to get started with your JD?</h4>
                                                <p>You can create a job description manually or let AI help generate one for
                                                    you. Choose the approach that best suits your workflow.</p>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button"
                                                class="d-flex gap-2 align-items-center justify-content-center fs-6 orange-outline-popup"
                                                onclick="openCreateJDManuallyModal()">
                                                Create Manually
                                                <iconify-icon icon="prime:pencil" width="16"
                                                    height="16"></iconify-icon>
                                            </button>
                                            <button type="button"
                                                class="d-flex gap-2 align-items-center justify-content-center fs-6 orange-fill-popup">Create
                                                with AI
                                                <iconify-icon icon="f7:sparkles" width="16"
                                                    height="16"></iconify-icon></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="CreateJDManually" tabindex="-1"
                            aria-labelledby="CreateJDManuallyLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body py-0">
                                        <div class="custom-popup-body text-center m-auto">
                                            <iconify-icon icon="jam:alert" width="70" height="70"
                                                style="color: #F8BB86;"></iconify-icon>
                                            <h4 class="w-50">How would you like to create your JD Manually?</h4>
                                            <p>Please choose one of the following methods:</p>
                                            <form>
                                                <div class="d-flex align-items-center justify-content-center gap-4 mb-5">
                                                    <label class="manually-radio">
                                                        <input type="radio" name="jdOption" value="custom">
                                                        <div class="d-flex flex-column gap-3 manually-modal-inner">
                                                            <p class="m-0 text-left fw-bold">Custom JD</p>
                                                            <div class="line"></div>
                                                            <p class="m-0 text-left">Start from a blank page and build
                                                                the job description manually</p>
                                                        </div>
                                                    </label>
                                                    <label class="manually-radio">
                                                        <input type="radio" name="jdOption" value="master">
                                                        <div class="d-flex flex-column gap-3 manually-modal-inner">
                                                            <p class="m-0 text-left fw-bold">Based on Master JD</p>
                                                            <div class="line"></div>
                                                            <p class="m-0 text-left">Use an existing job description as
                                                                a template from Master JD</p>
                                                        </div>
                                                    </label>
                                                    <label class="manually-radio">
                                                        <input type="radio" name="jdOption" value="company">
                                                        <div class="d-flex flex-column gap-3 manually-modal-inner">
                                                            <p class="m-0 text-left fw-bold">Based on Company JD</p>
                                                            <div class="line"></div>
                                                            <p class="m-0 text-left">Use an existing job description
                                                                previously created by your organization</p>
                                                        </div>
                                                    </label>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="modal-footer justify-content-center">
                                        <button type="button" class="fs-6 grey-outline-popup flex-grow-0 px-14"
                                            data-bs-dismiss="modal">Cancel</button>

                                        <button type="button"
                                            class="text-center fs-6 disable-grey-popup flex-grow-0 px-14" disabled
                                            style="display: block;">Proceed</button>

                                        <button type="button"
                                            class="text-center fs-6 orange-fill-popup flex-grow-0 px-14"
                                            style="display: none;">Proceed</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="jdMasterContent" style="display: none;">
                    <div class="d-flex justify-content-between">
                        <h1 class="m-0">Sectors</h1>
                        <div class="d-flex align-items-center gap-5">
                            <div class="search-wrapper">
                                <input type="text" class="search-input" placeholder="Search Sector">
                                <button class="search-icon">
                                    <iconify-icon icon="iconamoon:search-bold" width="16"
                                        height="16"></iconify-icon>
                                </button>
                            </div>
                            <div class="line-h"></div>
                            <button class="btn-view-jd d-flex align-items-center gap-2">
                                <iconify-icon icon="f7:sparkles" class="mr-1" width="16"
                                    height="16"></iconify-icon> View JD
                            </button>
                        </div>
                    </div>
                    <div class="sector-main">
                        <div class="sector-box">
                            <img src="/admin/media/svg/job-management/sectors-svg/accountancy.png" alt="Accountancy">
                            <h4>Accountancy</h4>
                            <p class="m-0">43 <span>total JDs</span></p>
                        </div>
                        <div class="sector-box">
                            <img src="/admin/media/svg/job-management/sectors-svg/aerospace.png" alt="Accountancy">
                            <h4>Aerospace</h4>
                            <p class="m-0">43 <span>total JDs</span></p>
                        </div>
                        <div class="sector-box">
                            <img src="/admin/media/svg/job-management/sectors-svg/agrifood.png" alt="Accountancy">
                            <h4>Agrifood</h4>
                            <p class="m-0">43 <span>total JDs</span></p>
                        </div>
                        <div class="sector-box">
                            <img src="/admin/media/svg/job-management/sectors-svg/air-transport.png" alt="Accountancy">
                            <h4>Air Transport</h4>
                            <p class="m-0">43 <span>total JDs</span></p>
                        </div>
                        <div class="sector-box">
                            <img src="/admin/media/svg/job-management/sectors-svg/bio-pharmaceuticals-manufacturing.png"
                                alt="Accountancy">
                            <h4>BioPharmaceuticals Manufaturing</h4>
                            <p class="m-0">43 <span>total JDs</span></p>
                        </div>
                        <div class="sector-box">
                            <img src="/admin/media/svg/job-management/sectors-svg/built-environment.png"
                                alt="Accountancy">
                            <h4>Built Environment</h4>
                            <p class="m-0">43 <span>total JDs</span></p>
                        </div>
                        <div class="sector-box">
                            <img src="/admin/media/svg/job-management/sectors-svg/design.png" alt="Accountancy">
                            <h4>Design</h4>
                            <p class="m-0">43 <span>total JDs</span></p>
                        </div>
                        <div class="sector-box">
                            <img src="/admin/media/svg/job-management/sectors-svg/early-childhood-care-and-education.png"
                                alt="Accountancy">
                            <h4>Early Childhood Care and Education</h4>
                            <p class="m-0">43 <span>total JDs</span></p>
                        </div>
                        <div class="sector-box">
                            <img src="/admin/media/svg/job-management/sectors-svg/electronics.png" alt="Accountancy">
                            <h4>Electronics</h4>
                            <p class="m-0">43 <span>total JDs</span></p>
                        </div>
                        <div class="sector-box">
                            <img src="/admin/media/svg/job-management/sectors-svg/energy-and-chemicals.png"
                                alt="Accountancy">
                            <h4>Energy and Chemicals</h4>
                            <p class="m-0">43 <span>total JDs</span></p>
                        </div>
                        <div class="sector-box">
                            <img src="/admin/media/svg/job-management/sectors-svg/energy-and-power.png" alt="Accountancy">
                            <h4>Energy and Power</h4>
                            <p class="m-0">43 <span>total JDs</span></p>
                        </div>
                        <div class="sector-box">
                            <img src="/admin/media/svg/job-management/sectors-svg/engineering-services.png"
                                alt="Accountancy">
                            <h4>Engineering Services</h4>
                            <p class="m-0">43 <span>total JDs</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        const tabs = document.querySelectorAll('.tab-link');
        const breadcrumbText = document.getElementById('breadcrumbText');
        const companyContent = document.getElementById('companyContent');
        const jdMasterContent = document.getElementById('jdMasterContent');

        tabs.forEach(tab => {
            tab.addEventListener('click', function(e) {
                e.preventDefault();
                tabs.forEach(t => t.classList.remove('active-tab'));
                this.classList.add('active-tab');
                breadcrumbText.textContent = this.textContent;
                if (this.id === 'companyJDsTab') {
                    companyContent.style.display = 'block';
                    jdMasterContent.style.display = 'none';
                } else if (this.id === 'jdMasterListTab') {
                    companyContent.style.display = 'none';
                    jdMasterContent.style.display = 'block';
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const secondModalEl = document.getElementById('CreateJDManually');
            const proceedBtn = secondModalEl.querySelector('.orange-fill-popup');
            const disabledBtn = secondModalEl.querySelector('.disable-grey-popup');

            function resetModalState() {
                const radioButtons = secondModalEl.querySelectorAll('input[name="jdOption"]');
                radioButtons.forEach(radio => radio.checked = false);

                proceedBtn.disabled = true;
                proceedBtn.style.display = 'none';
                disabledBtn.style.display = 'block';
            }

            function setupRadioListeners() {
                const radioButtons = secondModalEl.querySelectorAll('input[name="jdOption"]');
                radioButtons.forEach(radio => {
                    radio.addEventListener('change', () => {
                        proceedBtn.disabled = false;
                        proceedBtn.style.display = 'block';
                        disabledBtn.style.display = 'none';
                    });
                });
            }

            // Re-initialize every time modal is shown
            secondModalEl.addEventListener('shown.bs.modal', () => {
                resetModalState();
                setupRadioListeners();
            });

            // Also reset when modal is hidden (extra safe)
            secondModalEl.addEventListener('hidden.bs.modal', () => {
                resetModalState();
            });
        });

        function openCreateJDManuallyModal() {
            const firstModalEl = document.getElementById('createNewJD');
            const secondModalEl = document.getElementById('CreateJDManually');

            const firstModal = bootstrap.Modal.getInstance(firstModalEl) || new bootstrap.Modal(firstModalEl);
            const secondModal = bootstrap.Modal.getOrCreateInstance(secondModalEl);

            firstModal.hide();
            secondModal.show();
        }
    </script>







@endsection
