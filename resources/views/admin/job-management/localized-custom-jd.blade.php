@extends('admin.layout.app')

@section('title', 'reate with AI')

@section('styles')
    <style>
        .create-ai .top-card .card-header {
            padding: 24px;
            border-radius: 8px 8px 0px 0px;
            border: 1px solid #F1F1F4;
            background: #F7941D;
            box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.03);
        }

        .create-ai .top-card .card-header p {
            color: #FFF;
            font-size: 17.55px;
            font-weight: 500;
            line-height: 21.06px;
        }

        .create-ai .top-card .card-inner {
            padding: 24px;
            border-radius: 0px 0px 8px 8px;
            border-right: 1px solid #F1F1F4;
            border-bottom: 1px solid #F1F1F4;
            border-left: 1px solid #F1F1F4;
            background: #FFF;
            box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.03);
        }

        .create-ai .custom-btn {
            padding: 14px 20px;
            border-radius: 4px;
            font-size: 14px;
            font-weight: 600;
            line-height: 20px;
        }

        .create-ai .custom-btn.orange-fill {
            background: #F7941C;
            color: #FFF;
        }

        .create-ai .custom-btn.orange-outline {
            border: 1px solid #F7941C;
            background: #FFF;
            color: #F7941C;
        }

        .create-ai .main-content .heading {
            color: #4B5675;
            font-size: 22.75px;
            font-weight: 500;
            line-height: 27.3px;
            width: 45%;
        }

        .create-ai .creat-jd-manually {
            padding: 24px;
            border-radius: 8px;
            border: 1px solid #DBDFE9;
            background: #FFF;
            margin-top: 30px;
        }

        .create-ai .main-card {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
        }

        .create-ai .main-card .main-card-inner {
            width: 49.2%;
            border-radius: 3.2px;
            border: 1px solid #99A1B7;
            background: #fff;
            box-shadow: 0px 2.4px 3.2px 0px rgba(0, 0, 0, 0.03);
            padding: 19.2px;
            cursor: pointer;
        }

        .create-ai .main-card .main-card-inner:checked {
            border: 3px solid #F9A845;
        }

        .create-ai .button-card {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .create-ai .main-card .main-card-inner .header .sector {
            padding: 4px 12px;
            border-radius: 80px;
            background: #F1F1F4;
            color: #4B5675;
            font-size: 12px;
            font-weight: 600;
            line-height: 16px;
        }

        .create-ai .main-card .main-card-inner .para-clip {
            display: -webkit-box;
            -webkit-line-clamp: 5;
            -webkit-box-orient: vertical;
            overflow: hidden;
            color: #757575;
            font-size: 12px;
            font-weight: 400;
            line-height: 16px;
        }

        .create-ai .main-card .main-card-inner .badge-main-div .heading {
            color: #4B5675;
            font-size: 9.6px;
            font-weight: 600;
            line-height: 12.8px;
        }

        .create-ai .main-card .main-card-inner .badge-main-div .badge-inner-div {
            gap: 6.4px;
            flex-wrap: wrap;
        }

        .star-color {
            color: #FFCD44;
        }

        .badge-div {
            padding: 6.4px 12.8px;
            gap: 3.2px;
            border-radius: 64px;
            font-size: 10px;
            font-weight: 500;
            line-height: 14px;
        }

        .generic-div {
            background: #F2EEFD;
            color: #6652A1;
        }

        .technical-div {
            background: #FFF6EA;
            color: #7C4A0E;
        }

        .btn-more-skills {
            padding: 6.4px 12.8px;
            border-radius: 64px;
            border: 0.8px solid #99A1B7;
            background: #fff;
            color: #99A1B7;
            font-size: 10px;
            font-weight: 500;
            line-height: 14px;
        }

        .jd-badge {
            padding: 4px 12px;
            border-radius: 80px;
            font-size: 12px;
            font-weight: 600;
            line-height: 16px;
        }

        .master-jd-badge {
            background: #E3F7FF;
            color: #1877A0;
        }

        .company-jd-badge {
            background: #FFF0CF;
            color: #A56313;
        }
    </style>

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

        .custom-popup-body .modal-header {
            border-bottom: none;
            padding-bottom: 0px;
        }

        .custom-popup-body .modal-footer {
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

        .popup-proceed-button:disabled {
            border: 1px solid #DBDFE9 !important;
            background: #F1F1F4;
            color: #99A1B7;
        }
    </style>

    <style>
        .form-control:focus,
        .input-group-text:focus {
            box-shadow: none !important;
            border-color: #ced4da !important;
        }

        .create-ai .modal-body {
            padding: 48px;
        }

        .modal-step-form .nav-pills .nav-link {
            background-color: #fff;
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
            background-color: #fff;
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
            width: 39%;
            padding: 16px 0px;
            margin-right: 24px;
        }

        .modal-step-form .tab-content {
            padding: 16px;
            width: 100%;
            border-radius: 8px;
            border: 1px solid #F1F1F4;
        }

        .modal-step-form .tab-content .heading {
            color: #4B5675;
            font-size: 22.75px;
            font-weight: 700;
            line-height: 27.3px;
        }

        .modal-step-form .tab-content .line {
            height: 2px;
            width: 100%;
            background-color: #F1F1F4;
            margin: 16px 0px;
        }

        .modal-step-form .tab-content .para {
            color: #4B5675;
            font-size: 16px;
            font-weight: 400;
            line-height: 24px;
        }

        .modal-sector-text {
            color: #99A1B7;
            font-size: 16px;
            font-weight: 400;
            line-height: 24px;
        }

        .modal-jd-heading {
            color: #4B5675;
            font-size: 32.5px;
            font-weight: 600;
            line-height: 39px;
            margin-bottom: 24px;
        }

        .modal-step-form .accordion-header {
            color: #555;
            font-size: 16.25px;
            font-weight: 400;
            line-height: 24px;
            letter-spacing: 0.15px;
            border-bottom: 1px solid #F1F1F4;
            cursor: pointer;
            /* transition: background 0.3s; */
        }

        .modal-step-form .accordion-header.open {
            padding: 19.5px 24px 0px 24px;
            border-radius: 8.13px 8.13px 0px 0px;
            color: #1E2129;
            font-weight: 700;
        }

        .modal-step-form .critical-accordion .accordion-header.open {
            background: #E2F6F6;
            border-bottom: 1px solid #E2F6F6;
        }

        .modal-step-form .generic-accordion .accordion-header.open {
            background: #F2EEFD;
            border-bottom: 1px solid #F2EEFD;
        }

        .modal-step-form .technical-accordion .accordion-header.open {
            border-bottom: 1px solid #FFF6EA;
            background: #FFF6EA;
        }

        .modal-step-form .accordion-icon {
            display: block;
            width: 24px;
            height: 24px;
        }

        .accordion-icon-on {
            display: none;
        }

        .accordion-header.open .accordion-icon-on {
            display: inline-block !important;
        }

        .accordion-header.open .accordion-icon-off {
            display: none !important;
        }

        .modal-step-form .bg-open-accordion {
            padding: 0px 19.5px 24px;
            border-radius: 0px 0px 8.13px 8.13px;
        }

        .modal-step-form .critical-accordion .bg-open-accordion {
            background: #E2F6F6;
        }

        .modal-step-form .generic-accordion .bg-open-accordion {
            background: #F2EEFD;
        }

        .modal-step-form .technical-accordion .bg-open-accordion {
            background: #FFF6EA;
        }

        .modal-step-form .generic-accordion .star-generic {
            color: #997BF2;
        }

        .modal-step-form .technical-accordion .star-technical {
            color: #F7941D;
        }

        .form-check-input:checked {
            background-color: #F7941D;
            border-color: #F7941D;
        }

        .hide-button {
            display: none !important;
        }
    </style>

@endsection

@section('content')
    <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">
        <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                    Match & Generate JD with AI
                </h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="#" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="/admin/job-management" class="text-muted text-hover-primary">JD Master List</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted" id="breadcrumbText">Match & Generate JD with AI</li>
                </ul>
            </div>
        </div>
    </div>
    <div id="kt_app_content" class="app-content  flex-column-fluid ">
        <div id="kt_app_content_container" class="app-container  container-xxl">
            <section class="create-ai">
                <div class="top-card mb-15">
                    <div class="card-header">
                        <p class="m-0"><iconify-icon icon="f7:sparkles" class="mr-1"
                                width="24" height="24"></iconify-icon> Match & Generate JD with AI</p>
                    </div>

                    <div class="card-inner">
                        <form id="matchForm">
                            <div class="form-group d-flex justify-content-evenly col-lg-12 p-0">
                                <div class="col-lg-4">
                                    <label for="sector" class="fw-semibold fs-6 mb-2">Company/Division</label>
                                    <select id="sector" class="form-select" data-placeholder="Select Company/Division">
                                        <option value="">Select Company/Division</option>
                                    </select>
                                </div>
                    
                                <div class="col-lg-4">
                                    <label for="track" class="fw-semibold fs-6 mb-2">Department</label>
                                    <select id="track" class="form-select" disabled>
                                        <option value="">Select Department</option>
                                    </select>
                                </div>
                    
                                <div class="col-lg-4">
                                    <label for="role" class="fw-semibold fs-6 mb-2">Job Position</label>
                                    <select id="role" class="form-select" disabled>
                                        <option value="">Select Job Position</option>
                                    </select>
                                </div>
                            </div>
                    
                            <div class="form-group mt-5 col-lg-12 p-0">
                                <label for="job_description" class="fw-semibold fs-6 mb-2">Job Description from {{ env('APP_NAME') }}/label>
                                <textarea id="job_description" class="form-control" rows="5"
                                    placeholder="Auto-filled job description..."></textarea>
                            </div>
                    
                            <div class="text-end">
                                <button type="button" class="btn btn-primary" id="customJdBtn">Custom this JD</button>
                            </div>
                        </form>
                    </div>
                    
                </div>
            </section>
        </div>
    </div>
@endsection

@section('scripts')

    {{-- <script>
         document.addEventListener('DOMContentLoaded', function() {
            const sectorSelect = document.getElementById('sector');
            const trackSelect = document.getElementById('track');
            const roleSelect = document.getElementById('role');
            const descriptionBox = document.getElementById('job_description');

            // Dummy Job Data
     

            // Load Department Groups
            fetch('/admin/job-family-groups')
                .then(res => res.json())
                .then(data => {
                    sectorSelect.innerHTML = '<option value="">Select Company/Division</option>';
                    (data || []).forEach(group => {
                        sectorSelect.innerHTML += `<option value="${group.id}">${group.name}</option>`;
                    });
                });

            // Load Job Families
            sectorSelect.addEventListener('change', function() {
                const groupId = this.value;
                trackSelect.innerHTML = '<option value="">Select Department</option>';
                roleSelect.innerHTML = '<option value="">Select Job Position</option>';
                roleSelect.disabled = true;

                if (!groupId) {
                    trackSelect.disabled = true;
                    return;
                }

                trackSelect.disabled = false;
                fetch(`/admin/job-families/${groupId}`)
                    .then(res => res.json())
                    .then(data => {
                        (data || []).forEach(family => {
                            trackSelect.innerHTML +=
                                `<option value="${family.id}">${family.name}</option>`;
                        });
                    });
            });

            // Load Job Profiles
            trackSelect.addEventListener('change', function() {
                const familyId = this.value;
                roleSelect.innerHTML = '<option value="">Select Job Position</option>';
                roleSelect.disabled = true;

                if (!familyId) return;

                roleSelect.disabled = false;
                fetch(`/admin/job-profiles/${familyId}`)
                    .then(res => res.json())
                    .then(data => {
                        roleSelect.disabled = false;
                        data.forEach(profile => {
                            const opt = document.createElement('option');
                            opt.value = profile.id;
                            opt.textContent = profile.name;
                            opt.dataset.desc = profile.description; // stash the description
                            roleSelect.append(opt);
                        });
                    });
            });

            roleSelect.addEventListener('change', function() {
                const selected = this.selectedOptions[0];
                const descText = selected?.dataset.desc || '';
                descriptionBox.value = descText;
            });
        });
    </script> --}}

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sectorSelect = document.getElementById('sector');     // Company/Division
            const trackSelect = document.getElementById('track');       // Department
            const roleSelect = document.getElementById('role');         // Job Position
            const descriptionBox = document.getElementById('job_description'); // JD Textarea
        
            // Load Department Groups on page load
            fetch('/admin/job-family-groups')
                .then(res => res.json())
                .then(data => {
                    sectorSelect.innerHTML = '<option value="">Select Company/Division</option>';
                    (data || []).forEach(group => {
                        sectorSelect.innerHTML += `<option value="${group.id}">${group.name}</option>`;
                    });
                });
        
            // When Company/Division changes
            sectorSelect.addEventListener('change', function () {
                showOverlay();
                const groupId = this.value;
        
                // Reset downstream fields
                trackSelect.innerHTML = '<option value="">Select Department</option>';
                trackSelect.disabled = true;
                roleSelect.innerHTML = '<option value="">Select Job Position</option>';
                roleSelect.disabled = true;
                descriptionBox.value = ''; // Clear description
                descriptionBox.setAttribute('placeholder', '');
        
                if (!groupId) return;
        
                fetch(`/admin/job-families/${groupId}`)
                    .then(res => res.json())
                    .then(data => {
                        trackSelect.disabled = false;
                        (data || []).forEach(family => {
                            trackSelect.innerHTML += `<option value="${family.id}">${family.name}</option>`;
                        });
                        hideOverlay();
                    });
            });
        
            // When Department changes
            trackSelect.addEventListener('change', function () {
                showOverlay();
                const familyId = this.value;
        
                // Reset downstream fields
                roleSelect.innerHTML = '<option value="">Select Job Position</option>';
                roleSelect.disabled = true;
                descriptionBox.value = ''; // Clear description
                descriptionBox.setAttribute('placeholder', '');
        
                if (!familyId) return;
        
                fetch(`/admin/job-profiles/${familyId}`)
                    .then(res => res.json())
                    .then(data => {
                        roleSelect.disabled = false;
                        data.forEach(profile => {
                            const opt = document.createElement('option');
                            opt.value = profile.id;
        
                            let statusLabel = '';
                            if (profile.status == 1) {
                                statusLabel = ' [Approved]';
                            } else if (profile.status == 2) {
                                statusLabel = ' [Pending]';
                            }
        
                            opt.textContent = profile.name + statusLabel;
                            opt.dataset.desc = profile.description || ''; // store description
                            roleSelect.appendChild(opt);
                        });
                        hideOverlay();
                    });
            });
        
            // When Job Position is selected
            roleSelect.addEventListener('change', function () {
                const selected = this.selectedOptions[0];
                let descText = selected?.dataset?.desc || '';

                if (descText && descText !== 'null') {
                    // Clean corrupted characters and remove bullets
                    descText = descText
                        .replace(/â—/g, '')       // Remove junk bullets
                        .replace(/•/g, '')         // Remove actual bullet characters
                        .replace(/â€™/g, "'")      // Fix apostrophes
                        .replace(/â€œ|â€�/g, '"')  // Fix quotes
                        .replace(/â€“/g, '-')      // Fix dashes
                        .replace(/\s+/g, ' ')      // Collapse multiple spaces
                        .trim();

                    descriptionBox.value = descText;
                } else {
                    descriptionBox.value = '';
                    descriptionBox.setAttribute('placeholder', 'No description available for this job profile.');
                }
            });

        });
    </script>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('customJdBtn').addEventListener('click', function () {
            const jobFamilyGroup = document.getElementById('sector').value;
            const jobFamily = document.getElementById('track').value;
            const jobRole = document.getElementById('role').value;
            const jobProfileDescription = document.getElementById('job_description').value;

            const jobFamilyGroupName = document.getElementById('sector').selectedOptions[0].text;
            const jobFamilyName = document.getElementById('track').selectedOptions[0].text;
            const jobRoleName = document.getElementById('role').selectedOptions[0].text;

            // Build query string
            const params = new URLSearchParams({
                job_family_group: jobFamilyGroup,
                job_family: jobFamily,
                job_role: jobRole,
                job_family_group_name: jobFamilyGroupName,
                job_family_name: jobFamilyName,
                job_role_name: jobRoleName,
                job_profile_description: jobProfileDescription
            });

            // Redirect to the GET route with query parameters
            window.location.href = `/admin/job-management/job/create?${params.toString()}`;
        });
    });
</script>


@endsection
