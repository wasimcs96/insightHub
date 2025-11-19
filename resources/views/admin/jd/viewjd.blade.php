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

        .card-body {
            padding: 24px 24px 24px 8px !important;
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
            padding: 24px 24px 8px 24px !important;
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
                        View JD
                    </h1>
                    <!--end::Title-->


                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="/admin/dashboard" class="text-muted text-hover-primary">Home</a>
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

                        {{-- <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            Job Descriptions </li>
                        <!--end::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <!--end::Item--> --}}

                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            View Job Description </li>
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
                        <h3 class="card-title text-light"><iconify-icon icon="prime:sparkles"
                                class="fs-2x mr-2"></iconify-icon>View Job Description</h3>

                    </div>
                    <div class="card-body">
                        <form action="">
                            <div class="form-group d-flex justify-content-evenly col-lg-12 p-0">
                                <div class="col-lg-4">
                                    <label for="sector" class="fw-semibold fs-6 mb-2">Sector</label>
                                    <select id="sector" class="form-select" data-placeholder="Select the Sector">
                                        <option value="">Select Sector</option>
                                    </select>
                                </div>

                                <div class="col-lg-4">
                                    <label for="track" class="fw-semibold fs-6 mb-2">Track</label>
                                    <select id="track" class="form-select" data-placeholder="Select the Track" disabled>
                                        <option value="">Select Track</option>
                                    </select>
                                </div>

                                <div class="col-lg-4">
                                    <label for="role" class="fw-semibold fs-6 mb-2">Role</label>
                                    <select id="role" class="form-select" data-placeholder="Select the Role" disabled>
                                        <option value="">Select Role</option>
                                    </select>
                                </div>
                            </div>
                            {{-- <div class="float-lg-right mr-3">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div> --}}
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
                        <h3 class="card-title">General Skills & Competencies</h3>
                    </div>
                    <div class="card-body"></div>
                </div>

                {{-- <div class="card submit-card shadow-sm mb-4">
                    <div class="card-header">
                        <h3 class="card-title"> Create new JD from this template?</h3>

                    </div>
                    <div class="card-body">

                        <div class="mb-8 col-lg-3">
                            <a id="edit-url" href="/admin/setting/job-description/create/123"
                                class="align-items-center btn-jd-submit btn btn-primary d-flex justify-content-center">
                                <iconify-icon icon="flowbite:plus-outline"></iconify-icon>
                                Create New JD
                            </a>
                        </div>
                    </div>

                </div> --}}
            </div>
            <!--end::Content container-->


        </div>
    </div>
@endsection
@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sectorSelect = document.getElementById('sector');
            const trackSelect = document.getElementById('track');
            const roleSelect = document.getElementById('role');
            const roleDetailsDiv = document.getElementById('role-details');

            // Fetch and populate sectors
            fetch('/admin/job-descriptions/view/get-sectors')
                .then(response => response.json())
                .then(data => {
                    if (data.data) {

                        sectorSelect.innerHTML = '<option>Select Sector</option>'; // Reset options
                        data.data.forEach(sector => {
                            sectorSelect.innerHTML += `<option value="${sector}">${sector}</option>`;
                        });
                    }
                });

            // Fetch tracks when a sector is selected
            sectorSelect.addEventListener('change', function() {
                const sectorId = this.value;
                console.log(sectorId);
                if (sectorId) {
                    trackSelect.disabled = false;
                    roleSelect.disabled = true;
                    roleSelect.innerHTML = '<option></option>';
                    fetch(`/admin/job-descriptions/view/get-tracks-by-sector/${sectorId}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.data) {
                                trackSelect.innerHTML =
                                    '<option>Select Track</option>'; // Reset options
                                data.data.forEach(track => {
                                    trackSelect.innerHTML +=
                                        `<option value="${track}">${track}</option>`;
                                });
                            }
                        });
                } else {
                    trackSelect.disabled = true;
                    roleSelect.disabled = true;
                }
            });

            // Fetch roles when a track is selected
             trackSelect.addEventListener('change', function() {
                const sectorId = sectorSelect.value;
                const trackId = this.value;

                // URL encode the track value to handle slashes (e.g., "Cleaning Operations / Waste Collection")
                const encodedTrackId = encodeURIComponent(trackId);

                if (sectorId && trackId) {
                    roleSelect.disabled = false;
                    fetch(`/admin/job-descriptions/view/get-roles-by-track/${sectorId}/${encodedTrackId}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.data) {
                                roleSelect.innerHTML = '<option>Select Role</option>'; // Reset options
                                data.data.forEach(role => {
                                    roleSelect.innerHTML += `<option value="${role}">${role}</option>`;
                                });
                            }
                        })
                        .catch(error => {
                            console.error('Error fetching roles:', error);
                        });
                } else {
                    roleSelect.disabled = true;
                }
            });


            function populateRoleDetails(response) {
                // Clear existing content
                document.querySelector('.description-card .card-body').innerHTML = '';
                document.querySelector('.critical-work-functions-card .card-body').innerHTML = '';
                document.querySelector('.technical-skills-card .card-body').innerHTML = '';
                document.querySelector('.general-skills-card .card-body').innerHTML = '';

                // Populate Description
                const jobRole = response;
                console.log(response);
                const descriptionHTML = `
                    <h6>Job Role Description</h6>
                    <p>${jobRole.description}</p>
                    <p>Sector: ${jobRole.sector_name} - ${jobRole.sub_sector_name}</p>
                `;
                document.querySelector('.description-card .card-body').innerHTML = descriptionHTML;
                document.querySelector('.description-card').style.display = 'block';

                // Populate Critical Work Functions
                const criticalWorkFunctionsHTML = jobRole.critical_functions
                    .map(cwf => `
            <div class="mb-8">
                <h6 style="margin-bottom: 10px">${cwf.cwf_description}</h6>
                ${cwf.cwf_keys.keytasks.map(task => `<span class="badge badge-light-primary">${task}</span>`).join(' ')}
            </div>
        `).join('');
                document.querySelector('.critical-work-functions-card .card-body').innerHTML =
                    criticalWorkFunctionsHTML;
                document.querySelector('.critical-work-functions-card').style.display = 'block';

                // Populate Technical Skills
                console.log('Technical Skills:', jobRole.technical_skills);
                const technicalSkillsHTML = jobRole.technical_skills
                    .map(skill => {
                        const level = skill.preferred_level; // Preferred level (e.g., "4")
                        const knowledgeKey = `level_${level}_knowledge`;
                        const abilityKey = `level_${level}_ability`;
                        return `
                <div class="mb-8">
                    <h5 class="align-items-center d-flex flex-nowrap">${skill.name}<iconify-icon icon="ic:sharp-star" class="ml-2 mr-2 " style="color:#F7941D"></iconify-icon>${skill.preferred_level}</h5>
                    <p>${skill.description}</p>
                    <div class="border-orange-left">
                    <h6 style="font-size: 12px; line-height: 16px;">Knowledge</h6>
                    <ul>
                        ${(skill[knowledgeKey] || []).map(knowledge => `<li>${knowledge}</li>`).join('')}
                    </ul>
                    </div>
                    <div class="border-orange-left">
                    <h6 style="font-size: 12px; line-height: 16px;">Ability</h6>
                    <ul>
                        ${(skill[abilityKey] || []).map(ability => `<li>${ability}</li>`).join('')}
                    </ul>
                    </div>

                </div>
            `;
                    }).join('');
                document.querySelector('.technical-skills-card .card-body').innerHTML = technicalSkillsHTML;
                document.querySelector('.technical-skills-card').style.display = 'block';

                // Populate General Skills & Competencies
                console.log('General Skills:', jobRole.soft_skills);

                const generalSkillsHTML = jobRole.soft_skills
                    .map(skill => {
                        const preferredLevel = getPreferredLevel(skill.preferred_level);
                        const level = preferredLevel // Preferred level (e.g., "basic", "advanced")
                        const knowledgeKey = `level_${level}_knowledge`;
                        const abilityKey = `level_${level}_ability`;

                        return `
                <div class="mb-8">
                    <h6>${skill.competency}</h6>
                    <p>${skill.description || ''}</p>
                    <div class="border-orange-left">
                    <h6 style="font-size: 12px; line-height: 16px;">Knowledge</h6>
                    <ul>
                        ${(skill[knowledgeKey] || []).map(knowledge => `<li>${knowledge}</li>`).join('')}
                    </ul>
                </div>
                    <div class="border-orange-left">
                    <h6 style="font-size: 12px; line-height: 16px;">Ability</h6>
                    <ul>
                        ${(skill[abilityKey] || []).map(ability => `<li>${ability}</li>`).join('')}
                    </ul>
                </div>
                </div>
            `;
                    }).join('');
                document.querySelector('.general-skills-card .card-body').innerHTML = generalSkillsHTML;
                document.querySelector('.general-skills-card').style.display = 'block';

                // Show submit card
                document.querySelector('.submit-card').style.display = 'block';

              
                // Correctly replace {} in the href
                // var hrefValue = editLink.href;
                
                // editLink.href = hrefValue.replace('123', jobId);
                // console.log('After: ' + editLink.href); 
                var editLink = document.getElementById('edit-url');
                
                // Define the dynamic value to append (e.g., jobId)
                var jobId = jobRole.job_id; // Replace with your dynamic value
                var trackName = jobRole.sub_sector_name;
                var sectorName = jobRole.sector_name;

                // Directly set the href value
                editLink.href = '/admin/setting/job-description/create/' + jobId + '/'+ trackName + '/'+ sectorName;


            }




            // Fetch role details when a role is selected
            // roleSelect.addEventListener('change', function() {
            //     const sectorId = sectorSelect.value;
            //     const trackId = trackSelect.value;
            //     const roleId = this.value;
            //     console.log(sectorId,trackId,roleId);
                


            //     if (sectorId && trackId && roleId) {
            //         showOverlay();
            //         fetch(`/admin/job-descriptions/view/get-role-details/${encodeURIComponent(sectorId)}/${encodeURIComponent(trackId)}/${encodeURIComponent(roleId)}`)
            //             .then(response => response.json())
            //             .then(data => {
            //                 if (data.data) {

            //                     populateRoleDetails(data.data);
            //                 }
            //             }).finally(() => {
            //                 // Hide the loader after the request is complete (whether successful or not)
            //                 hideOverlay(); // Hide overlay when the request completes
            //             });
            //     }
            // });
            roleSelect.addEventListener('change', function() {
                const sectorId = sectorSelect.value;
                const trackId  = trackSelect.value;
                const roleId   = this.value;

                console.log(sectorId, trackId, roleId);

                if (sectorId && trackId && roleId) {
                    showOverlay();

                    let formData = new FormData();
                    formData.append('sector', sectorId);
                    formData.append('track', trackId);
                    formData.append('role', roleId);

                    fetch(`/admin/job-descriptions/view/get-role-details`, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.data) {
                            populateRoleDetails(data.data);
                        }
                    })
                    .finally(() => {
                        hideOverlay();
                    });
                }
            });
        });

        function getPreferredLevel(level) {
            switch (level?.toLowerCase()) {
                case 'basic':
                    return 1;
                case 'intermediate':
                    return 2;
                case 'advanced':
                    return 3;
                default:
                    return ''; // Return empty string if no match
            }
        }
    </script>

    {{-- <script>
        document.querySelector('.btn-jd-submit').addEventListener('click', function(event) {
            event.preventDefault();

            const sector = document.getElementById('sector').value;
            const track = document.getElementById('track').value;
            const role = document.getElementById('role').value;

            if (sector && track && role) {
                // Redirect with minimal data
                window.location.href =
                    `/admin/setting/job-description/create?sector=${sector}&track=${track}&role=${role}`;
            } else {
                alert('Please select Sector, Track, and Role.');
            }
        });
    </script> --}}
@endsection
