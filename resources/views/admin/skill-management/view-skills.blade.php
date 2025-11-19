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

        /* .tab-main {
                            margin: 0px 187px 68px 187px;
                            } */

        .tabs-star-head {
            border-bottom: 1px solid #dbdfe9;
            margin-bottom: 16px;
        }

        .tabs-star-head ul {
            display: flex;
            justify-content: flex-start;
            margin-top: 16px;
            margin-bottom: 0;
            padding-left: 0;
        }

        .tabs-star-head ul li {
            display: flex;
            padding: 12px;
            justify-content: center;
            align-items: center;
            gap: 4px;
            color: #99a1b7;
            font-size: 17.55px;
            font-weight: 400;
            line-height: 23.4px;
            cursor: pointer;
        }

        .tabs-star-head ul li.active {
            border-bottom: 3px solid #f7941c;
            color: #000;
            font-weight: 500;
            line-height: 21.06px;
        }

        .tabs-desc.active {
            display: block;
        }

        .tabs-desc {
            display: none;
        }

        .tab-header {
            border-radius: 8px 8px 0px 0px;
            border: 1px solid #f1f1f4;
            background: #fff;
            box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.03);
            color: #071437;
            font-size: 17.55px;
            font-weight: 500;
            line-height: 21.06px;
            padding: 24px;
        }

        .tab-content {
            border-radius: 0px 0px 8px 8px;
            border-width: 0px 1px 1px 1px;
            border-color: #f1f1f4;
            border-style: solid;
            background: #fff;
            box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.03);
            padding: 24px;
            display: grid;
            gap: 24px;
        }

        .tab-desc-inner ul {
            padding-left: 26px;
        }

        .tab-desc-inner ul li {
            list-style: disc;
        }

        .inner-desc-p,
        .tab-desc-inner ul li {
            color: #3e3e3e;
            font-size: 12px;
            font-weight: 400;
            line-height: 16px;
        }

        .tab-desc-inner>p {
            color: #3e3e3e;
            font-size: 12px;
            font-weight: 600;
            line-height: 16px;
        }

        .tabs-star-head ul li.active .star {
            color: #F3AC60
        }

        /* .active > .star{
                color: #F3AC60
            } */
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
                        Skill Management
                    </h1>
                    <!--end::Title-->


                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="#" class="text-muted text-hover-primary">
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
                            Skill Master List </li>
                        <!--end::Item-->

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
                                class="fs-2x mr-2"></iconify-icon>View Skill</h3>

                    </div>
                    <div class="card-body px-2 py-5">
                        <form action="">
                            <div class="form-group d-flex justify-content-evenly col-lg-12 p-0">
                                <div class="col-lg-4" style="padding: 0px 15px;">
                                    <label for="sector" class="fw-semibold fs-6 mb-2">Sector</label>
                                    <select id="sector" class="form-select" data-placeholder="Select the Sector">
                                        <option value="">Select Sector</option>
                                    </select>
                                </div>

                                <div class="col-lg-4" style="padding: 0px 15px;">
                                    <label for="track" class="fw-semibold fs-6 mb-2">Category</label>
                                    <select id="track" class="form-select" data-placeholder="Select the Track" disabled>
                                        <option value="">Select the Category</option>
                                    </select>
                                </div>

                                <div class="col-lg-4" style="padding: 0px 15px;">
                                    <label for="skill" class="fw-semibold fs-6 mb-2">Skill</label>
                                    <div class="d-flex">
                                        <select id="type" name="skill_type" class="w-50 form-select rounded-right"
                                            data-placeholder="Select the skill type">
                                            <option value="any">All Skills</option>
                                            <option value="ccs">Soft</option>
                                            <option value="tsc">Technical</option>
                                        </select>

                                        <select id="skill" name="skill" class="w-100 form-select rounded-left"
                                            data-placeholder="Select the Role" disabled>
                                            <option value="">Select Skill</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="float-lg-right mr-3">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div> --}}
                        </form>
                    </div>

                </div>
                <div class="tab-main">
                    <div class="tabs-star-head">
                        <ul>
                            {{-- <li class="active" data-tab="tab1">Level 1 <iconify-icon icon="material-symbols:star"
                                    class="star"></iconify-icon></li>
                            <li data-tab="tab2">Level 2 <iconify-icon icon="material-symbols:star"
                                    class="star"></iconify-icon></li> --}}
                        </ul>
                    </div>
                    {{-- <div id="tab1" class="tabs-desc active">
                        <div class="tab-header">
                            Airside Driving
                        </div>
                        <div class="tab-content">
                            <div class="tab-desc-inner">
                                <p>Description</p>
                                <span class="inner-desc-p">Operate vehicles to transport materials and equipment at the
                                    airside work areas</span>
                            </div>
                            <div class="tab-desc-inner">
                                <p>Knowledge</p>
                                <ul>
                                    <li>Airside signals, signs and markings</li>
                                    <li>Airport layout plans</li>
                                    <li>Standards for airside vehicle serviceability</li>
                                    <li>Airside safety and compliance requirements</li>
                                </ul>
                            </div>
                            <div class="tab-desc-inner">
                                <p>Abilities</p>
                                <ul>
                                    <li>Perform checks on motor vehicles for serviceability before driving</li>
                                    <li>Drive motor vehicles to reach work areas without incidents and/or accidents</li>
                                    <li>Contact relevant authorities in the event of motor vehicle incidents and/or
                                        accidents</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div id="tab2" class="tabs-desc">
                        <div class="tab-header">
                            Airside Driving 2
                        </div>
                        <div class="tab-content">
                            <div class="tab-desc-inner">
                                <p>Description</p>
                                <span class="inner-desc-p">Operate vehicles to transport materials and equipment at the
                                    airside work areas</span>
                            </div>
                            <div class="tab-desc-inner">
                                <p>Knowledge</p>
                                <ul>
                                    <li>Airside signals, signs and markings</li>
                                    <li>Airport layout plans</li>
                                    <li>Standards for airside vehicle serviceability</li>
                                    <li>Airside safety and compliance requirements</li>
                                </ul>
                            </div>
                            <div class="tab-desc-inner">
                                <p>Abilities</p>
                                <ul>
                                    <li>Perform checks on motor vehicles for serviceability before driving</li>
                                    <li>Drive motor vehicles to reach work areas without incidents and/or accidents</li>
                                    <li>Contact relevant authorities in the event of motor vehicle incidents and/or
                                        accidents</li>
                                </ul>
                            </div>
                        </div>
                    </div> --}}
                    <div class="content"></div>
                </div>
            </div>
            <!--end::Content container-->
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        const tabButtons = document.querySelectorAll(".tabs-star-head ul li");
        const tabContents = document.querySelectorAll(".tabs-desc");

        tabButtons.forEach((button) => {
            button.addEventListener("click", () => {
                tabButtons.forEach((btn) => btn.classList.remove("active"));
                button.classList.add("active");

                tabContents.forEach((content) => content.classList.remove("active"));
                const tabId = button.getAttribute("data-tab");
                document.getElementById(tabId).classList.add("active");

                tabButtons.forEach((btn) => {
                    const img = btn.querySelector("img");
                    if (img) {
                        img.src = btn.classList.contains("active") ?
                            "/public/star.svg" :
                            "/public/star-grey.svg";
                    }
                });
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sectorSelect = document.getElementById('sector');
            const trackSelect = document.getElementById('track');
            const skillTypeSelect = document.getElementById('type');
            const roleSelect = document.getElementById('skill');

            // Fetch and populate sectors
            fetch('/admin/job-descriptions/view/get-sectors')
                .then(response => response.json())
                .then(data => {
                    if (data.data) {
                        sectorSelect.innerHTML = '<option value="">Select Sector</option>'; // Reset options
                        data.data.forEach(sector => {
                            sectorSelect.innerHTML += `<option value="${sector}">${sector}</option>`;
                        });
                    }
                });

            // Fetch tracks when a sector is selected
            sectorSelect.addEventListener('change', function() {
    const sectorId = this.value;

    if (sectorId) {
        trackSelect.disabled = false;
        roleSelect.disabled = true;
        roleSelect.innerHTML = '<option value="">Select Skill</option>';

        fetch(`/admin/job-descriptions/view/get-tracks-by-sector/${sectorId}`)
            .then(response => response.json())
            .then(data => {
                if (data.data && Array.isArray(data.data)) {
                    trackSelect.innerHTML = '<option value="">Select Category</option>';

                    data.data.forEach(track => {
                        const option = document.createElement('option');
                        option.value = track;

                        // Truncate if longer than 23 characters
                        option.textContent = track.length > 47 ? track.slice(0, 47) + '...' : track;

                        // Add tooltip with full track name
                        option.title = track;

                        trackSelect.appendChild(option);
                    });
                }
            });
    } else {
        trackSelect.disabled = true;
        roleSelect.disabled = true;
    }
});


            // Fetch skills when a category (track) is selected and filter by skill type
            trackSelect.addEventListener('change', function() {
                const sectorId = sectorSelect.value;
                const trackId = this.value;
                const skillType = skillTypeSelect.value;

                if (sectorId && trackId) {
                    roleSelect.disabled = false;
                    showOverlay(); 
                    fetchSkills(sectorId, trackId, skillType);
                } else {
                    roleSelect.disabled = true;
                }
            });

            // Update skills when the skill type changes
            skillTypeSelect.addEventListener('change', function() {
                const sectorId = sectorSelect.value;
                const trackId = trackSelect.value;
                const skillType = this.value;

                if (sectorId && trackId) {
                    showOverlay(); 
                    fetchSkills(sectorId, trackId, skillType);
                }
            });

            // Fetch skills based on sector, track, and skill type
            function fetchSkills(sectorId, trackId, skillType) {
                fetch(`/admin/job-descriptions/view/get-skills-by-sector/${sectorId}/${skillType}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.data && Array.isArray(data.data)) {
                            roleSelect.innerHTML = '<option value="">Select Skill</option>';

                            data.data.forEach(skill => {
                                const option = document.createElement('option');
                                option.value = skill;

                                option.textContent = skill.length > 23 ? skill.slice(0, 23) + '...' : skill;

                                option.title = skill;

                                roleSelect.appendChild(option);
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching skills:', error);
                    })
                    .finally(() => {
                        hideOverlay();
                    });
            }

            // Fetch role details when a skill is selected
            roleSelect.addEventListener('change', function() {
                const sectorId = sectorSelect.value;
                const trackId = trackSelect.value;
                const skillType = skillTypeSelect.value;
                const skillName = this.value;

                if (sectorId && trackId && skillType && skillName) {
                    showOverlay(); 
                    
                    // Build query parameters
                    const params = new URLSearchParams({
                        sector: sectorId,
                        skill: skillName,
                        track: trackId,
                        skillType: skillType
                    });
                    
                    fetch(`/admin/job-descriptions/view/get-skill-details?${params.toString()}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.data) {
                                console.log(data.data)
                                populateRoleDetails(data.data);
                            }
                        }).finally(() => {
                    // Hide the loader after the request is complete (whether successful or not)
                    hideOverlay(); // Hide overlay when the request completes
                });
                }
            });



            function populateRoleDetails(response) {
                // Clear existing content for fresh data
                const tabsHead = document.querySelector('.tabs-star-head ul');
                const tabMain = document.querySelector('.content');
                tabsHead.innerHTML = '';
                tabMain.innerHTML = '';

                // Get the first technical and soft skills
                const skill = response.technical_skills[0];
                const soft_skill = response.soft_skills[0];

                console.log('Response soft skill:', soft_skill);
                console.log('Response technical skill:', skill);
                let firstActiveTabSet = false; // Track if the first active tab is set
                // Handle technical skills
                if (skill) {
                    for (let i = 1; i <= 6; i++) {
                        const levelKey = `level_${i}`;
                        const hasData = skill[`${levelKey}_description`] && skill[`${levelKey}_knowledge`] && skill[
                            `${levelKey}_ability`];

                        if (!hasData) continue; // Skip this level if no data

                        // const isActive = i === 1 ? 'active' : ''; // First tab with data is active

                        const isActive = !firstActiveTabSet ? 'active' : ''; // Set the first level with data as active
                        if (!firstActiveTabSet) firstActiveTabSet = true; // Mark the first active tab as set
                        // Create the tab header
                        const tabHeader = `
                <li class="${isActive}" data-tab="tab${i}">
                    Level ${i} <iconify-icon icon="material-symbols:star" class="star"></iconify-icon>
                </li>
                `;
                            tabsHead.insertAdjacentHTML('beforeend', tabHeader);

                        // Create the tab content
                        const tabContent = `
                <div id="tab${i}" class="tabs-desc ${isActive}">
                    <div class="tab-header">${skill.name} - Level ${i}</div>
                    <div class="tab-content">
                        <div class="tab-desc-inner">
                            <p>Description</p>
                            <span class="inner-desc-p">${skill[`${levelKey}_description`]}</span>
                        </div>
                        <div class="tab-desc-inner">
                            <p>Knowledge</p>
                            <ul>
                                ${(skill[`${levelKey}_knowledge`] || [])
                                    .map(knowledge => `<li>${knowledge}</li>`)
                                    .join('')}
                            </ul>
                        </div>
                        <div class="tab-desc-inner">
                            <p>Abilities</p>
                            <ul>
                                ${(skill[`${levelKey}_ability`] || [])
                                    .map(ability => `<li>${ability}</li>`)
                                    .join('')}
                            </ul>
                        </div>
                    </div>
                </div>
                `;
                            tabMain.insertAdjacentHTML('beforeend', tabContent);
                        }
                    }

                // Handle soft skills
                if (soft_skill) {
                    for (let i = 1; i <= 6; i++) {
                        const levelKey = `level_${i}`;
                        const hasData = soft_skill[`${levelKey}`] && soft_skill[`${levelKey}_knowledge`] &&
                            soft_skill[`${levelKey}_ability`];

                        if (!hasData) continue; // Skip this level if no data

                        // const isActive = i === 1 && !skill ? 'active' :
                        // ''; // First tab with data is active (if no technical skills)

                        const isActive = !firstActiveTabSet ? 'active' : ''; // Set the first level with data as active
                        if (!firstActiveTabSet) firstActiveTabSet = true; // Mark the first active tab as set
                        // Create the tab header
                        const tabHeader = `
                <li class="${isActive}" data-tab="tab${i}">
                    Level ${i} <iconify-icon icon="material-symbols:star" class="star"></iconify-icon>
                </li>
             `;
                        tabsHead.insertAdjacentHTML('beforeend', tabHeader);

                        // Create the tab content
                        const tabContent = `
                <div id="tab${i}" class="tabs-desc ${isActive}">
                    <div class="tab-header">${soft_skill.competency} - Level ${i}</div>
                    <div class="tab-content">
                        <div class="tab-desc-inner">
                            <p>Description</p>
                            <span class="inner-desc-p">${soft_skill[`${levelKey}`]}</span>
                        </div>
                        <div class="tab-desc-inner">
                            <p>Knowledge</p>
                            <ul>
                                ${(soft_skill[`${levelKey}_knowledge`] || [])
                                    .map(knowledge => `<li>${knowledge}</li>`)
                                    .join('')}
                            </ul>
                        </div>
                        <div class="tab-desc-inner">
                            <p>Abilities</p>
                            <ul>
                                ${(soft_skill[`${levelKey}_ability`] || [])
                                    .map(ability => `<li>${ability}</li>`)
                                    .join('')}
                            </ul>
                        </div>
                    </div>
                </div>
                 `;
                        tabMain.insertAdjacentHTML('beforeend', tabContent);
                    }
                }

                // Add event listeners to tabs for switching
                const tabs = document.querySelectorAll('.tabs-star-head li');
                tabs.forEach(tab => {
                    tab.addEventListener('click', function() {
                        // Remove active class from all tabs and tab content
                        tabs.forEach(t => t.classList.remove('active'));
                        document.querySelectorAll('.tabs-desc').forEach(desc => desc.classList
                            .remove('active'));

                        // Add active class to the selected tab and corresponding content
                        const tabId = this.dataset.tab;
                        this.classList.add('active');
                        document.getElementById(tabId).classList.add('active');
                    });
                });
            }





        });
    </script>



@endsection
