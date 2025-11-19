@extends('admin.layout.app')

@section('title', 'Setting - Job Descriptions')
@section('styles')
    <style>
        .navtab-btn {
            border: 1px solid #f7941d;
            border-radius: 6px;
        }

        a.bg-primary:hover {
            background-color: #000000 !important;
            color: white;
        }

        .trimmed-description {
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }

        .description-card,
        .critical-work-functions-card,
        .technical-skills-card,
        .general-skills-card,
        .submit-card {
            display: none;
        }

        .card .card-header {
            padding: 24px;
        }

        .card .card-header .card-title {
            margin: 0;
        }

        .card-body .col-lg-4 {
            padding-right: 0;
            padding-left: 16px;
        }

        .description-card .card-body,
        .critical-work-functions-card .card-body,
        .technical-skills-card .card-body,
        .general-skills-card .card-body {
            padding: 24px !important;
        }

        .technical-skills-card .card-body,
        .general-skills-card .card-body {
            padding: 24px !important;
        }

        .card-body h6,
        .card-body h5 {
            color: #071437;
            font-size: 14px;
            font-style: normal;
            font-weight: 600;
            line-height: 20px;
            margin-bottom: 4px;
        }

        .card-body p {
            color: #4B5675;
            font-size: 14px;
            font-style: normal;
            font-weight: 400;
            line-height: 20px;
            margin-bottom: 16px;
        }

        .card-body p:last-child {
            margin: 0px;
        }

        .badge-light-primary {
            border-radius: 80px !important;
            background: #FFF6EA !important;
            color: #7C4A0E;
            font-size: 12px;
            font-weight: 400;
            line-height: 16px;
            padding: 5px 10px;
            margin-bottom: 6px;
                text-align: left;
    text-wrap: auto;
        }

        .border-orange-left {
            padding: 0px 16px;
            border-left: 4px solid #FCCF98;
        }

        .border-orange-left ul {
            padding-left: 16px;
            margin-bottom: 16px
        }

        .border-orange-left ul li {
            color: #3E3E3E;
            font-size: 12px;
            font-weight: 400;
            line-height: 16px;
        }

        .card-body div:last-child {
            margin: 0 !important;
        }

        .skill-bot {
            font-weight: 400;
        }

        .skill-desc {
            font-weight: 600;
            margin: 0px 0px 4px 0px;
        }

        /* .app-content {
            padding: 45px 187px 190px 187px;
            ;
        } */

        /* @media (max-width: 1281px) {
            .app-content {
                padding: 45px 70px 50px 70px;
            }
        } */
    </style>
    <style>
        .custom-dropdown-select .dropdown {
      position: relative;
    }
 
    .custom-dropdown-select .dropdown-list {
        position: relative;
        top: 17px;
        left: 0;
        right: 0;
        z-index: 99;
        border-top: none;
        max-height: 280px;
        overflow-y: auto;
        display: none;
        border-radius: 4px;
        border: 1px solid #DBDFE9;
        background: #FFF;
    }
 
    .custom-dropdown-select .dropdown-items-container {
    overflow-y: auto;
    flex: 1 1 auto;  
    }
 
    .custom-dropdown-select .add-job-btn {
    position: sticky;
    bottom: 0;
    padding: 12px 12px 20px 12px;
    z-index: 10;
    background: #fff;
    }
 
    .custom-dropdown-select .add-job-btn button {
    padding: 12px 18px;
    gap: 8px;
    border-radius: 4px;
    border: 1px solid #F7941C;
    background: #FFF;
    color:#F7941C;
    font-size: 12px;
    font-weight: 600;
    line-height: 16px;
    cursor: pointer;
    box-sizing: border-box;
    background-clip: padding-box;
    transition: background 0.2s;
    width: 100%;
    display: flex;
    }
 
 
    .custom-dropdown-select .add-job-btn button:hover {
    background: #F7941C;
    color: #fff;
    }
 
    .custom-dropdown-select .dropdown-item {
    padding: 12px 20px;
    cursor: pointer;
    display: flex;
    gap: 8px;
    align-items: center;
    color: #000;
    font-size: 12px;
    font-weight: 400;
    line-height: 16px;
    }
 
    .custom-dropdown-select .dropdown-item:hover {
      background-color: #FFF6EA;
      border-radius: 0px;
    }
 
    .custom-dropdown-select .pill {
    padding: 6px 12px;
    border-radius: 80px;
    text-align: center;
    font-size: 10px;
    font-weight: 600;
    line-height: 14px;
    margin-right: 8px;
    }
 
    .custom-dropdown-select .pill.localised {
    background:#F2EEFD;
    color: #6652A1;
    }
 
    .custom-dropdown-select .pill.pending {
    background:#FFEBB4;
    color: #EB8100;
    }
 
    .custom-dropdown-select .pill.approved {
    background:#DDF5E2;
    color: #196329;
    }
            .dropdown-list {
            display: none;
        }

        .dropdown-list.active {
            display: block;
        }

        </style>
@endsection
@section('content')
    <div class="d-flex flex-column flex-column-fluid">

        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">

            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">



                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                       {{ $type == 'company-jd' ? 'Based on Company JD' : 'Based on Master JD' }}
                    </h1>
                    <!--end::Title-->


                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="/admin/dashboard" class="text-muted text-hover-primary">
                                Home </a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->

                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="/admin/jobs/index" class="text-muted text-hover-primary">Job Management</a>
                        </li>
                        <!--end::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->

                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                             <a href="{{ route('jobs.savedJobs', ['saved_job' => 1]) }}" class="text-muted text-hover-primary">Company JDs</a> </li>
                        <!--end::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->

                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            {{ $type == 'company-jd' ? 'Based on Company JD' : 'Based on Master JD' }} </li>
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->

            </div>

            <!--end::Actions-->
            <!--end::Toolbar container-->
        </div>

        <div id="kt_app_content" class="app-content  flex-column-fluid ">


            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container  container-xxl ">

                <div class="card  shadow-sm mb-4">
                    <div class="bg-primary card-header">
                        <h3 class="card-title text-light">{{ $type == 'company-jd' ? 'Select a Company JD' : 'Select a Master JD' }}</h3>

                    </div>
                    <div class="card-body">


                        <form id="matchForm">
                            <input type="hidden" value="{{ $type }}" name="type" id="type">
                            

                                @if ($type == 'company-jd')
                                    {{-- <div class="col-lg-4">
                                        <label for="sector" class="fw-semibold fs-6 mb-2">Company/Division</label>
                                        <select id="job_family_group" class="form-select" data-placeholder="Select Company/Division">
                                            <option value="">Select Company/Division</option>
                                        </select>
                                    </div> --}}
                                    <div class="form-group d-flex justify-content-evenly col-lg-12 pr-0" style="gap: 24px">
                                        <livewire:business-unit-select />

                                        <livewire:division-select />
                                        <livewire:department-select />
                                    </div>

                                    {{-- <div class="col-lg-4">
                                        <label for="track" class="fw-semibold fs-6 mb-2">Department</label>
                                        <select id="job_family" class="form-select" disabled>
                                            <option value="">Select Department</option>
                                        </select>
                                    </div>
                        
                                    <div class="col-lg-4">
                                        <label for="role" class="fw-semibold fs-6 mb-2">Job Position</label>
                                        <select id="job_profile" class="form-select" disabled>
                                            <option value="">Select Job Position</option>
                                        </select>
                                    </div> --}}
                                    <div class="form-group d-flex justify-content-evenly col-lg-12 pr-0 mt-5" style="gap: 24px;margin-top: 1.25rem !important;">
                                    <livewire:job-select />
                                    </div>
                                @else
                                <div class="form-group d-flex justify-content-evenly col-lg-12" style="gap: 24px">
                                    <div class="w-100">
                                        <label for="sector" class="fw-semibold fs-6 mb-2">Sector</label>
                                        <select id="sector" class="form-select" data-placeholder="Select Sector">
                                            <option value="">Select Sector</option>
                                        </select>
                                    </div>

                                    <div class="w-100">
                                        <label for="role" class="fw-semibold fs-6 mb-2">Role</label>
                                        <select id="role" class="form-select" disabled>
                                            <option value="">Select Role</option>
                                        </select>
                                    </div>
                                    </div>
                                @endif

                            
                        </form>

                    </div>

                </div>

                <div class="card description-card shadow-sm mb-4">
                    <div class="card-header">
                        <h3 class="card-title">Description</h3>
                    </div>
                    <div class="card-body"></div>
                </div>

                <div class="card critical-work-functions-card shadow-sm mb-4">
                    <div class="card-header">
                        <h3 class="card-title">Critical Work Functions</h3>
                    </div>
                    <div class="card-body"></div>
                </div>

                <div class="card technical-skills-card shadow-sm mb-4">
                    <div class="card-header">
                        <h3 class="card-title">Technical Skills</h3>
                    </div>
                    <div class="card-body"></div>
                </div>

                <div class="card general-skills-card shadow-sm mb-4">
                    <div class="card-header">
                        <h3 class="card-title">Generic Skills</h3>
                    </div>
                    <div class="card-body"></div>
                </div>

                {{-- <div class="card submit-card shadow-sm mb-4">
                    <div class="card-header">
                        <h3 class="card-title"> Create new JD from this template?</h3>

                    </div>
                    <div class="card-body">

                        <div class="mb-8" style="width: fit-content;">
                            <a id="edit-url" href="#"
                                class="align-items-center btn-jd-submit btn btn-primary d-flex justify-content-center">
                                Select This JD as a Base
                            </a>
                        </div>
                    </div>

                </div> --}}

                <div class="submit-card my-8">
                    <div class="d-flex align-items-center justify-content-end gap-3">
                        <div style="width: fit-content;">
                            <a href="#"
                                class="align-items-center btn-jd-submit btn btn-outline d-flex justify-content-center" style="color: #78829D;" onclick="window.history.back()">
                                Cancel
                            </a>
                        </div>
                        <div style="width: fit-content;">
                            <a id="edit-url" href="#"
                                class="align-items-center btn-jd-submit btn btn-primary d-flex justify-content-center">
                                Select This JD as a Base
                            </a>
                        </div>
                        </div>
                </div>
            </div>
            <!--end::Content container-->


        </div>
    </div>
@endsection
@section('scripts')

    <script>
        // Declare globally so all functions can access it
        let latestJobData = null;
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const type = document.getElementById('type').value;

            // Common function to populate role details
            function populateRoleDetails(apiResponse) {
                const job = apiResponse.data?.data ?? apiResponse.data ?? apiResponse;
                latestJobData = job;
                // console.log("hjdfjhdsagfsdjhgsd", job);
                const qs = selector => document.querySelector(selector);
                const showCard = sel => qs(sel).style.display = 'block';

                ['.description-card', '.critical-work-functions-card', '.technical-skills-card',
                    '.general-skills-card'
                ]
                .forEach(card => qs(`${card} .card-body`).innerHTML = '');

                qs('.description-card .card-body').innerHTML =
                    `<h6>Job Role Description</h6><p>${job.description || '—'}</p>`;
                showCard('.description-card');

                // const cwfHtml = (job.critical_functions || []).map(cf => {
                //     const keys = (cf.cwf_keys || []).map(k =>
                //         `<span class="badge badge-light-primary mr-1">${k.name}</span>`
                //     ).join('');
                //     return `<div class="mb-4"><h6>${cf.description}</h6>${keys}</div>`;
                // }).join('') || '<p>No critical functions defined.</p>';
                // qs('.critical-work-functions-card .card-body').innerHTML = cwfHtml;
                // showCard('.critical-work-functions-card');

                const cwfHtml = (job.critical_functions || []).map(cf => {
                    const keys = (cf.cwf_keys?.keytasks || []).map(k =>
                        `<span class="badge badge-light-primary mr-1">${k}</span>`
                    ).join('');
                    return `<div class="mb-4"><h6>${cf.cwf_description}</h6>${keys}</div>`;
                }).join('') || '<p>No critical functions defined.</p>';

                qs('.critical-work-functions-card .card-body').innerHTML = cwfHtml;
                showCard('.critical-work-functions-card');


                const techHtml = (job.technical_skills || []).map(skill => {
                    const lvl = skill.preferred_level ?? skill.level ?? 1;
                    return `<div class="mb-4">
                                <h5 class="align-items-center d-flex flex-nowrap skill-desc"> ${skill.name}
                                    <iconify-icon icon="ic:sharp-star" class="ml-2 mr-2" style="color:#F7941D"></iconify-icon>${lvl}
                                </h5>
                                <p class="skill-bot">${skill.description || '—'}</p>
                            </div>`;
                }).join('') || '<p>No technical skills available.</p>';
                qs('.technical-skills-card .card-body').innerHTML = techHtml;
                showCard('.technical-skills-card');

                const genHtml = (job.soft_skills || []).map(skill => {
                    const lvl = skill.level || 1;
                    return `<div class="mb-4">
                                <h5 class="align-items-center d-flex flex-nowrap skill-desc">${skill.competency}
                                    <iconify-icon icon="ic:sharp-star" class="ml-2 mr-2" style="color:#F7941D"></iconify-icon>${lvl}
                                </h5>
                                <p class="skill-bot">${skill.description || ''}</p>
                            </div>`;
                }).join('') || '<p>No general skills available.</p>';
                qs('.general-skills-card .card-body').innerHTML = genHtml;
                showCard('.general-skills-card');

                // const editLink = document.getElementById('edit-url');
                // if (editLink) {
                //     const jId = job.id;
                //     const sector = encodeURIComponent(job.sector || '');
                //     editLink.href = `/admin/setting/job-description/create/${jId}/${sector}`;
                // }

                showCard('.submit-card');
            }

            // Handle non-company-jd logic
            if (type !== 'company-jd') {
                const sectorSelect = document.getElementById('sector');
                const roleSelect = document.getElementById('role');

                fetch('/admin/job-management/get-sector')
                    .then(response => response.json())
                    .then(responseData => {
                        const data = responseData.data;
                        if (data) {
                            sectorSelect.innerHTML = '<option>Select Sector</option>';
                            Object.entries(data).forEach(([key, value]) => {
                                sectorSelect.innerHTML += `<option value="${key}">${value}</option>`;
                            });
                        }
                    });

                sectorSelect.addEventListener('change', function() {
                    showOverlay();
                    const sectorId = sectorSelect.value;
                    if (sectorId && type) {
                        roleSelect.disabled = false;
                        fetch(`/admin/job-management/get-job-role/${type}/${sectorId}`)
                            .then(response => response.json())
                            .then(responseData => {
                                const data = responseData.data;
                                if (data) {
                                    roleSelect.innerHTML = '<option>Select Role</option>';
                                    Object.entries(data).forEach(([key, value]) => {
                                        roleSelect.innerHTML +=
                                            `<option value="${key}">${value}</option>`;
                                    });
                                    hideOverlay();
                                }
                            });
                    } else {
                        roleSelect.disabled = true;
                    }
                });

                roleSelect.addEventListener('change', function() {
                    const roleId = this.value;
                    const sectorId = sectorSelect.value;
                    if (roleId && sectorId) {
                        showOverlay();
                        fetch(`/admin/job-management/get-job-role-detail/${roleId}`)
                            .then(response => response.json())
                            .then(data => {
                                if (data.data) populateRoleDetails(data);
                            }).finally(() => hideOverlay());
                    }
                });

            } else {
                // company-jd logic
                const businessUnit = document.getElementById('business_unit');
                const jobFamilyGroup = document.getElementById('division');
                const jobFamily = document.getElementById('department');
                const jobProfile = document.getElementById('job_role');

                jobProfile.addEventListener('change', function() {
                    const jobFamilyGroup = document.getElementById('division').value;
                    const jobFamily = document.getElementById('department').value;
                    const businessUnit = document.getElementById('business_unit').value;

                    const jobRole = this.value;


                    if (jobFamilyGroup && jobFamily && jobRole) {
                        showOverlay();

                        fetch(`/admin/job-management/get-job-by-family`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                },
                                body: JSON.stringify({
                                    business_unit_id:businessUnit,
                                    job_family_group: jobFamilyGroup,
                                    job_family: jobFamily,
                                    job_role: jobRole
                                })
                            })
                            .then(res => res.json())
                            .then(data => {
                                console.log(data);
                                if (data.success && data.data) {
                                    populateRoleDetails(data.data); // Reuse your existing render logic
                                } else {
                                    alert('Job role not found.');
                                }
                            })
                            .catch(err => {
                                console.error('Error fetching job data:', err);
                            })
                            .finally(() => hideOverlay());
                    }
                });

            }
        });

        // Optional helper (already present in your code)
        function getPreferredLevel(level) {
            switch (level?.toLowerCase()) {
                case 'basic':
                    return 1;
                case 'intermediate':
                    return 2;
                case 'advanced':
                    return 3;
                default:
                    return '';
            }
        }
    </script>


 
    <script>
        function createNewJDFromTemplate() {
            const type = $('#type').val(); // Master or Company JD

            if (!latestJobData) {
                alert('Job data not available. Please try again.');
                return;
            }
            let jobFamilyGroup = '',
                jobFamily = '',
                jobProfile = '',
                businessUnit='';

            businessUnit = document.getElementById('business_unit')?.value || '';
            jobFamilyGroup = document.getElementById('division')?.value || '';
            jobFamily = document.getElementById('department')?.value || '';
            jobProfile = document.getElementById('job_role')?.value || '';

            const cacheKey = `job_detail_${latestJobData.job_id || Date.now()}_${type}`;

            $.ajax({
                url: '/admin/cache-job-data',
                type: 'POST',
                data: {
                    cache_key: cacheKey,
                    job_data: JSON.stringify({
                        ...latestJobData,
                        jd_type: type, // 👈 append the type into the data
                        business_unit_id:businessUnit,
                        selected_job_family_group: jobFamilyGroup,
                        selected_job_family: jobFamily,
                        selected_job_profile: jobProfile
                    }),
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function() {
                    window.location.href =
                        `/admin/job-management/create-jd?cache_key=${encodeURIComponent(cacheKey)}`;
                },
                error: function() {
                    alert('Failed to cache job data. Please try again.');
                }
            });
        }

        // Trigger on click
        $(document).on('click', '#edit-url', function(e) {
            e.preventDefault();

            createNewJDFromTemplate();
        });
    </script>

    
@endsection
