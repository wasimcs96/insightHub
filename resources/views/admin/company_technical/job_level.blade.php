@push('styles')
    <style>
        .table-container th,
        .table-container td {
            padding: 16px 12px !important;
            text-align: left !important;
            font-size: 14px !important;
            color: #333 !important;
            border-bottom: 1px solid #eee !important;
        }

        .table-container th:nth-child(1),
        .table-container td:nth-child(1),
        .table-container th:nth-child(2),
        .table-container td:nth-child(2),
        {
        overflow: hidden !important;
        text-overflow: ellipsis !important;
        white-space: nowrap !important;
        max-width: 200px !important;
        }

        .table-container th {
            font-weight: 600 !important;
            padding: 22px !important;
            color: #4B5675 !important;
            font-size: 14px !important;
            font-weight: 600 !important;
            line-height: 20px !important;
        }

        .table-container th:nth-child(1),
        .table-container td:nth-child(1) {
            width: 20% !important;
            border-radius: 8px 0px 0px 0px !important;
        }

        .table-container th:nth-child(3),
        .table-container td:nth-child(3),
        .table-container th:nth-child(2),
        .table-container td:nth-child(2) {
            width: 13.5% !important;
        }

        .table-container th:nth-child(4),
        .table-container td:nth-child(4) {
            width: 11% !important;
        }

        /* .table-container th:nth-child(n+3):nth-child(-n+4),
                                            .table-container td:nth-child(n+3):nth-child(-n+4) {
                                                width: 7% !important;
                                                text-align: center !important;
                                            } */

        .table-container th:last-child,
        .table-container td:last-child {
            width: 8% !important;
            border-radius: 0px 8px 0px 0px !important;
            position: relative !important;
            text-align: center !important;

        }

        .table-container .star-header {
            color: #f7941d !important;
            position: relative;
            top: 2px;
        }

        .table-container .checkmark {
            color: #28c76f !important;
            font-size: 16px !important;
            font-weight: bold !important;
        }

        .table-container #profiles-table th:nth-child(1),
        .table-container #profiles-table th:nth-child(2),
        .table-container #profiles-table th:nth-child(3),
        .table-container #profiles-table th:nth-child(4),
        .table-container #profiles-table td:nth-child(5) {
            position: sticky;
            background-color: #DBDFE9 !important;
            text-align: left !important;
            max-width: 200px !important;
            min-width: 200px !important;
            z-index: 1;
            border-right: 1px solid #fff;
        }

        .table-container #profiles-table td:nth-child(1),
        .table-container #profiles-table td:nth-child(2),
        .table-container #profiles-table td:nth-child(3),
        .table-container #profiles-table td:nth-child(4),
        .table-container #profiles-table td:nth-child(5) {
            position: sticky;
            background-color: #fff !important;
            z-index: 1;
            max-width: 200px !important;
            min-width: 200px !important;
        }

        .table-container #profiles-table th:nth-child(1),
        .table-container #profiles-table td:nth-child(1) {
            left: -1px;
        }

        .table-container #profiles-table th:nth-child(2),
        .table-container #profiles-table td:nth-child(2) {
            left: 48px;
        }

        .table-container #profiles-table th:nth-child(3),
        .table-container #profiles-table td:nth-child(3) {
            left: 247px;
            max-width: 100px !important;
            min-width: 100px !important;
        }

        .table-container #profiles-table th:nth-child(5) {
            background-color: #DBDFE9 !important;
            text-align: left !important;
            border-right: 1px solid #fff;
        }

        .table-container #profiles-table th {
            background-color: #fff;
        }

        .table-container #profiles-table td:nth-child(n+3):nth-child(-n+8),
        .table-container #profiles-table td:last-child {
            text-align: left !important
        }

        .table-container #profiles-table th:nth-child(5),
        .table-container #profiles-table td:nth-child(5) {
            max-width: 120px !important;
            min-width: 120px !important;
            left: 544px;
            position: sticky !important;
            z-index: 1;
        }

        .add-skill-btn:disabled {
            border: 1px solid #DBDFE9 !important;
            background: #F1F1F4 !important;
            color: #99A1B7 !important;
        }

        .table-container #profiles-table th:nth-child(4),
        .table-container #profiles-table td:nth-child(4) {
            left: 346px !important;
            max-width: 165px !important;
            min-width: 165px !important;
        }

        .table:not(.table-bordered) tbody tr:last-child td {
            border-bottom: 1px solid #eee !important;
        }

        /* Modal knowledge and abilities styling */
        #level-knowledge p,
        #level-abilities p {
            margin-bottom: 8px;
            line-height: 1.5;
            color: #333;
        }

        #level-knowledge p:last-child,
        #level-abilities p:last-child {
            margin-bottom: 0;
        }
    </style>
@endpush


<div id="joblevel">
    <!-- ===================== HTML ===================== -->
    <form id="matchForm" class="bottom-filter w-100 form-group">
        <!-- 1) Company/Division -->
        <div class="w-100">
            <label for="business_unit_id" class="fw-semibold fs-6 mb-2">Business Unit</label>
            <select id="business_unit_id" class="form-select" data-placeholder="Select Business Unit">
                <option value="">Select Business Unit</option>
            </select>
        </div>

        <div class="w-100">
            <label for="sector" class="fw-semibold fs-6 mb-2">Company/Division</label>
            <select id="sector" class="form-select" data-placeholder="Select Company/Division" disabled>
                <option value="">Select Company/Division</option>
            </select>
        </div>

        <!-- 2) Department (loaded based on group) -->
        <div class="w-100">
            <label for="track" class="fw-semibold fs-6 mb-2">Department</label>
            <select id="track" class="form-select" disabled>
                <option value="">Select Department</option>
            </select>
        </div>
    </form>

    <div id="nocontent_alert">
        <div class="alert alert-warning alert-dismissible fade show " id="job_level_alert" role="alert">
            <iconify-icon icon="mingcute:warning-line" width="24" height="24"
                style="color: #F7941C"></iconify-icon>
            Please select a Company/Division and a Department from the dropdowns above to view the skills matrix.
        </div>
    </div>

    <div id="message_alert"></div>

    <div class=" align-items-center justify-content-between" id="statics-divv" style="display: none">
        <p class="mb-7"><span id="skills-count">Displaying 10 skill columns. </span> <span id="profiles-count">Showing
                3 of 3 job positions for selected Department and Company/Division.</span></p>
        <button class="approve-skill-job-btn border-0" id="approve-skill-job-btn">
            <span id="approve-skill-job-btn-text">Approve Selected <span>(0)</span></span>
        </button>
    </div>

    <!-- 3) Table of Job Profiles for the selected Department -->
    <div id="profiles-container" class="mt-4 table-container" style="display: none; overflow: scroll;">
        <table class="table table-bordered" id="profiles-table" style="table-layout: auto;">
            <thead>
                <tr>
                    <th>
                        <div class="d-flex align-items-center justify-content-center" style="margin-left: 11px;">
                            <label class="custom-checkbox m-0">
                                <input type="checkbox" id="select-all">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </th>
                    <th>Job Position</th>
                    <th>Level</th>
                    <th>Department</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

    <p class="m-0 align-items-center justify-content-center gap-3 scroll-text mt-8" style="display: none"
        id="scrollText">
        Scroll right to view more skills <iconify-icon icon="bi:arrow-right" width="20"
            height="20"></iconify-icon>
    </p>
</div>

<!-- All modals remain the same as in original -->
<!-- Edit Skill Modal -->
<div class="modal fade" id="editSkillModal" tabindex="-1" aria-labelledby="editSkillModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-semibold" id="editSkillModalLabel">Edit Skill: <span>Access Control
                        Management</span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="mb-7">For Job Position: <strong id="modal-profile-name"
                        style="overflow-wrap: anywhere;">Manager, Security</strong></p>
                <input type="hidden" value="" id="modal-pivot-id" />
                <input type="hidden" value="" id="modal-skill-id" />
                <input type="hidden" value="" id="modal-job-id" />
                <input type="hidden" value="" id="modal-skill-name" />
                <div class="mb-7">
                    <label class="form-label fw-medium">Select Proficiency Level</label>
                    <div class="d-flex gap-2 justify-content-center">
                        <button type="button" class="level-btn" data-level="1">1</button>
                        <button type="button" class="level-btn" data-level="2">2</button>
                        <button type="button" class="level-btn" data-level="3">3</button>
                        <button type="button" class="level-btn" data-level="4">4</button>
                        <button type="button" class="level-btn" data-level="5">5</button>
                        <button type="button" class="level-btn" data-level="6">6</button>
                    </div>
                </div>
               <div class="mb-4">
                    <label class="form-label">Level Description</label>
                    <p class="mb-0" id="level-description">
                        Advanced proficiency. Can handle complex tasks and situations. Innovates and optimizes
                        processes. Seen as a subject matter expert.
                    </p>
                </div>
                <div class="mb-4">
                    <label class="form-label">Knowledge</label>
                    <div id="level-knowledge">
                        <p class="mb-0">No knowledge information available for this level.</p>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="form-label">Abilities</label>
                    <div id="level-abilities">
                        <p class="mb-0">No abilities information available for this level.</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0 pt-0 edit-footer-btn" id="edit-footer-btn">
                <button type="button" class="orange-outline flex-none-custom" id="removeSkillBtn">Remove
                    Skill</button>
                <div>
                    <button type="button" class="grey-outline" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="orange-fill" id="saveSkillBtn">Save Changes</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Profile Skill Modal -->
<div class="modal fade" id="deleteProfileSkillLvlModal" tabindex="-1" aria-labelledby="DeleteTechnicalSkillLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                style="position: absolute; right: 15px; top: 10px; z-index: 1;"></button>
            <div class="modal-body text-center pt-4">
                <iconify-icon icon="ep:warning" width="70" height="70"
                    style="color: #FABB6E;"></iconify-icon>
                <h4 class="my-5">Delete Technical Skill?</h4>
                <p class="mx-12 my-5 para">Are you sure you want to delete the technical skill, <b
                        id="deleteSkillName">Skill Name</b>?<br><br> This will remove this skill and its proficiency
                    data from the associated job position, <b id="skillDeleteJobProfileName"
                        style="overflow-wrap: anywhere;"></b>.This action cannot be
                    undone.</p>
                <div class="d-flex align-items-center justify-content-center gap-2">
                    <button class="btn btn-outline m-0" data-bs-dismiss="modal"
                        id="showeditSkillModal">Discard</button>
                    <button class="btn btn-danger text-white m-0" id="deleteProfileSkillLvl"
                        style="background: #F7941C;">Confirm</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Job Level Technical Skill Modal -->
<div class="modal fade" id="DeleteJobLevelTechnicalSkillModal" tabindex="-1"
    aria-labelledby="DeleteTechnicalSkillLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                style="position: absolute; right: 15px; top: 10px; z-index: 1;"></button>
            <div class="modal-body text-center pt-4">
                <iconify-icon icon="ep:warning" width="70" height="70"
                    style="color: #FABB6E;"></iconify-icon>
                <h4 class="my-5">Delete Skill Column?</h4>
                <p class="mx-12 my-5 para">Are you sure you want to delete the skill column <b
                        id="skillToDeleteName"></b>? <br>This will remove this skill and its proficiency data. This
                    action cannot be undone.</p>
                <div class="d-flex align-items-center justify-content-center gap-2">
                    <button class="btn btn-outline m-0" data-bs-dismiss="modal">Discard</button>
                    <button class="btn btn-danger text-white m-0" id="confirmDeleteSkillBtn"
                        style="background: #F7941C;">Confirm</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Approval Confirmation Modal -->
<div class="modal fade" id="approveConfirmationModal" tabindex="-1" aria-labelledby="EditTsfromMSLLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                style="position: absolute; right: 15px; top: 10px; z-index: 1;"></button>
            <div class="modal-body text-center pt-4">
                <iconify-icon icon="ep:warning" width="70" height="70"
                    style="color: #FABB6E;"></iconify-icon>
                <h4 class="my-5">Approve Job Position(s)?</h4>
                <p class="mx-10 my-5">You are about to approve the selected job position(s). By<br> approving the
                    JD(s), you acknowledge that the content is <br> finalised and ready for internal reference.
                    <br><br>Are you sure you want to proceed?
                </p>
                <div class="d-flex align-items-center justify-content-center gap-2">
                    <button class="btn btn-outline m-0" data-bs-dismiss="modal">Cancel</button>
                    <button id="confirmApproveBtn" class="btn btn-apply text-white m-0"
                        style="background: #F7941C;">Confirm</button>
                </div>
            </div>
        </div>
    </div>
</div>


@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // ============= CONFIGURATION =============
            const CONFIG = {
                ROUTES: {
                    BUSINESS_UNITS: '/admin/ajax/business-unit',
                    DIVISIONS: '/admin/ajax/divisions',
                    JOB_PROFILES_BY_DIVISION: '/admin/get/job-profiles-by-division',
                    JOB_PROFILES_BY_DEPARTMENT: '/admin/get/job-profiles-by-department',
                    UPDATE_SKILL: '/admin/company/sector-skills/update-technical-skill-level',
                    APPROVE_PROFILES: '/admin/company/sector-skills/approve-selected-job-profile',
                    DELETE_SKILL: '/admin/sector/skills/company/deleteJobSkills',
                    SEARCH_SKILLS: '{{ route('admin.technical-skill.search') }}',
                    CREATE_SKILL: '{{ route('create.job.family.technical.skill') }}',
                    GET_SKILL_DETAILS: '/admin/get/skill-details'
                },
                CSRF_TOKEN: '{{ csrf_token() }}',
                DEBOUNCE_DELAY: 300
            };

            // ============= UTILITY FUNCTIONS =============
            const Utils = {
                debounce(func, wait) {
                    let timeout;
                    return function executedFunction(...args) {
                        const later = () => {
                            clearTimeout(timeout);
                            func.apply(this, args);
                        };
                        clearTimeout(timeout);
                        timeout = setTimeout(later, wait);
                    };
                },

                showOverlay() {
                    if (typeof showOverlay === 'function') showOverlay();
                },

                hideOverlay() {
                    if (typeof hideOverlay === 'function') hideOverlay();
                },

                sanitizeHTML(str) {
                    const div = document.createElement('div');
                    div.textContent = str;
                    return div.innerHTML;
                }
            };

            // ============= API SERVICE =============
            class ApiService {
                static async fetchData(url, options = {}) {
                    try {
                        Utils.showOverlay();
                        const response = await fetch(url, options);
                        if (!response.ok) {
                            throw new Error(`HTTP error! Status: ${response.status}`);
                        }
                        return await response.json();
                    } catch (error) {
                        console.error('API Error:', error);
                        throw error;
                    } finally {
                        Utils.hideOverlay();
                    }
                }

                static async getBusinessUnits() {
                    return this.fetchData(CONFIG.ROUTES.BUSINESS_UNITS);
                }

                static async getDivisions(businessUnitId) {
                    return this.fetchData(`${CONFIG.ROUTES.DIVISIONS}/${businessUnitId}`);
                }

                static async getJobProfilesByDivision(divisionId) {
                    return this.fetchData(`${CONFIG.ROUTES.JOB_PROFILES_BY_DIVISION}/${divisionId}`);
                }

                static async getJobProfilesByDepartment(departmentId) {
                    return this.fetchData(`${CONFIG.ROUTES.JOB_PROFILES_BY_DEPARTMENT}/${departmentId}`);
                }

                static async updateSkillLevel(data) {
                    return this.fetchData(CONFIG.ROUTES.UPDATE_SKILL, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': CONFIG.CSRF_TOKEN
                        },
                        body: JSON.stringify(data)
                    });
                }

                static async approveProfiles(selectedValues) {
                    return this.fetchData(CONFIG.ROUTES.APPROVE_PROFILES, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': CONFIG.CSRF_TOKEN
                        },
                        body: JSON.stringify({
                            selectedValues
                        })
                    });
                }

                static async deleteSkill(skillId, data) {
                    return this.fetchData(`${CONFIG.ROUTES.DELETE_SKILL}/${skillId}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': CONFIG.CSRF_TOKEN,
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: JSON.stringify(data)
                    });
                }

                static async getSkillDetails(skillId) {
                    return this.fetchData(`${CONFIG.ROUTES.GET_SKILL_DETAILS}/${skillId}`, {
                        method: 'GET',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': CONFIG.CSRF_TOKEN,
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });
                }

                static async createJobFamilySkill(skillId, trackId) {
                    return this.fetchData(CONFIG.ROUTES.CREATE_SKILL, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': CONFIG.CSRF_TOKEN
                        },
                        body: JSON.stringify({
                            skill_id: skillId,
                            track_id: trackId
                        })
                    });
                }
            }

            // ============= VALIDATION SERVICE =============
            class ValidationService {
                static validateSkillData(data) {
                    const errors = [];
                    if (!data.skillId) errors.push('Skill ID is required');
                    if (!data.level || data.level < 1 || data.level > 6) errors.push(
                        'Valid level (1-6) is required');
                    if (data.pivotId === undefined || data.pivotId === null) errors.push(
                    'Pivot ID is required');
                    return {
                        isValid: errors.length === 0,
                        errors
                    };
                }

                static validateProfileSelection(selectedValues) {
                    return selectedValues && selectedValues.length > 0;
                }
            }

            // ============= UI MANAGER =============
            class UIManager {
                static populateSelect(selectElement, options, defaultText, valueKey = 'id', textKey = 'name') {
                    if (!selectElement) return;
                    selectElement.innerHTML = `<option value="">${defaultText}</option>`;
                    if (!Array.isArray(options)) return;

                    const fragment = document.createDocumentFragment();
                    options.forEach(option => {
                        const opt = document.createElement('option');
                        opt.value = option[valueKey];
                        opt.textContent = option[textKey] || option.head_of_division || option.name;
                        fragment.appendChild(opt);
                    });
                    selectElement.appendChild(fragment);
                }

                static showAlert(container, type, message) {
                    if (!container) return;
                    container.innerHTML = `<x-alert :type="'${type}'" :message="'${message}'" />`;
                }

                static updateCounts(skillsCount, profilesCount) {
                    const skillsElement = document.getElementById('skills-count');
                    const profilesElement = document.getElementById('profiles-count');

                    if (skillsElement) {
                        skillsElement.textContent =
                            `Displaying ${skillsCount} skill column${skillsCount !== 1 ? 's' : ''}. `;
                    }
                    if (profilesElement) {
                        profilesElement.textContent =
                            `Showing ${profilesCount} job position${profilesCount !== 1 ? 's' : ''}.`;
                    }
                }

                static toggleElementVisibility(elementId, show, showType = 'block') {
                    const element = document.getElementById(elementId);
                    if (element) {
                        element.style.display = show ? showType : 'none';
                    }
                }

                static clearSelectOptions(selectElement, defaultText) {
                    if (!selectElement) return;
                    selectElement.innerHTML = `<option value="">${defaultText}</option>`;
                    selectElement.disabled = true;
                }
            }

            // ============= TABLE BUILDER =============
            class TableBuilder {
                static buildProfilesTable(skills, profiles) {
                    const tbody = document.querySelector('#profiles-table tbody');
                    const headerRow = document.querySelector('#profiles-table thead tr');

                    if (!tbody || !headerRow) return;

                    requestAnimationFrame(() => {
                        tbody.innerHTML = '';
                        this.resetHeaders(headerRow);
                        this.addSkillHeaders(headerRow, skills);

                        const fragment = document.createDocumentFragment();
                        profiles.forEach(profile => {
                            const row = this.createProfileRow(profile, skills);
                            fragment.appendChild(row);
                        });
                        tbody.appendChild(fragment);

                        this.markEmptySkillColumns(skills, profiles);
                        this.initializeTooltips();
                    });
                }

                static resetHeaders(headerRow) {
                    while (headerRow.children.length > 5) {
                        headerRow.removeChild(headerRow.lastChild);
                    }
                }

                static addSkillHeaders(headerRow, skills) {
                    const fragment = document.createDocumentFragment();
                    skills.forEach(skill => {
                        const th = document.createElement('th');
                        th.classList.add('jobskill-th');
                        th.setAttribute('data-bs-toggle', 'tooltip');
                        th.setAttribute('data-bs-placement', 'top');
                        th.setAttribute('data-bs-title', skill.name);
                        th.setAttribute('skill-name', skill.name);
                        th.innerHTML = this.createSkillHeaderContent(skill);
                        fragment.appendChild(th);
                    });
                    headerRow.appendChild(fragment);
                }

                static createSkillHeaderContent(skill) {
                    return `
                    <div class="d-flex align-items-center justify-content-between w-100">
                        <div class="skill-name" style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                            ${Utils.sanitizeHTML(skill.name)}
                        </div>
                        <div class="th-delete-icon" data-master-skill-id="${skill.id}">
                            <iconify-icon icon="ant-design:delete-twotone" width="16" height="16"></iconify-icon>
                        </div>
                    </div>
                `;
                }

                static createProfileRow(profile, skills) {
                    const tr = document.createElement("tr");

                    tr.appendChild(this.createCheckboxCell(profile));
                    tr.appendChild(this.createProfileNameCell(profile));
                    tr.appendChild(this.createPositionLevelCell(profile));
                    tr.appendChild(this.createDepartmentCell(profile));
                    tr.appendChild(this.createStatusCell(profile));

                    skills.forEach(skill => {
                        tr.appendChild(this.createSkillCell(profile, skill));
                    });

                    return tr;
                }

                static createCheckboxCell(profile) {
                    const td = document.createElement("td");
                    const checkboxWrapper = document.createElement("div");
                    checkboxWrapper.classList.add("form-check");

                    const checkbox = document.createElement("input");
                    checkbox.type = "checkbox";
                    checkbox.classList.add("form-check-input");
                    checkbox.value = profile.job_id;
                    checkbox.disabled = profile.status === 1;

                    checkboxWrapper.appendChild(checkbox);
                    td.appendChild(checkboxWrapper);
                    return td;
                }

                static createProfileNameCell(profile) {
                    const td = document.createElement('td');

                    const div = document.createElement('div'); // wrapper for tooltip + truncate
                    div.classList.add("text-truncate"); // ✅ add truncate class
                    div.setAttribute("data-bs-toggle", "tooltip");
                    div.setAttribute("data-bs-placement", "top");
                    div.setAttribute("title", profile.name || "Unknown");

                    const anchor = document.createElement('a');
                    anchor.href = profile.profile_url || "#";
                    anchor.textContent = profile.name || "Unknown";
                    anchor.target = "_blank";
                    anchor.rel = "noopener noreferrer"; // security best practice
                    anchor.classList.add("text-black");

                    div.appendChild(anchor);
                    td.appendChild(div);

                    // Initialize Bootstrap tooltip for this div
                    if (typeof bootstrap !== "undefined" && bootstrap.Tooltip) {
                        new bootstrap.Tooltip(div);
                    }

                    return td;
                }


                static createPositionLevelCell(profile) {
                    const td = document.createElement('td');
                    td.textContent = profile.management_level;
                    return td;
                }

                static createDepartmentCell(profile) {
                    const td = document.createElement('td');

                    const div = document.createElement('div');
                    div.classList.add("text-truncate"); // ✅ enable truncation
                    div.textContent = profile.department_name || "Not Available";

                    // Tooltip attributes on the div
                    div.setAttribute("data-bs-toggle", "tooltip");
                    div.setAttribute("data-bs-placement", "top");
                    div.setAttribute("title", profile.department_name || "Not Available");

                    td.appendChild(div);

                    // Initialize Bootstrap tooltip
                    if (typeof bootstrap !== "undefined" && bootstrap.Tooltip) {
                        new bootstrap.Tooltip(div);
                    }

                    return td;
                }





                static createStatusCell(profile) {
                    const td = document.createElement("td");
                    const statusSpan = document.createElement("span");
                    statusSpan.textContent = profile.status === 1 ? "APPROVED" : "PENDING";
                    statusSpan.classList.add("badge-status", profile.status === 1 ? "approved" : "pending");
                    td.appendChild(statusSpan);
                    return td;
                }

                static createSkillCell(profile, skill) {
                    const td = document.createElement('td');
                    td.classList.add('editable-cell');
                    td.setAttribute('data-skill-index', skill.id);
                    const skillInfo = profile.skills[skill.id];

                    if (skillInfo) {
                        td.innerHTML = `
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <small><b>(Level ${skillInfo.level})</b></small>
                            <div class="pencil-table-icon" 
                                 data-job-id="${profile.job_id}" 
                                 data-skill-id="${skill.id}" 
                                 data-profile-name="${Utils.sanitizeHTML(profile.name)}" 
                                 data-pivot-id="${skillInfo.pivot_id}" 
                                 data-skill-name="${Utils.sanitizeHTML(skill.name)}" 
                                 data-level="${skillInfo.level}" 
                                 data-description="${Utils.sanitizeHTML(skillInfo.description || '')}">
                                <iconify-icon icon="heroicons:pencil-square" class="fa-1-5"></iconify-icon>
                            </div>
                        </div>
                        <div class="truncate-3-lines" style="white-space: normal;" title="${Utils.sanitizeHTML(skillInfo.description || '')}">
                            ${Utils.sanitizeHTML(skillInfo.description || '')}
                        </div>
                    `;
                        td.style.backgroundColor = "#E7F4FD";
                    } else {
                        td.innerHTML = `
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            -
                            <div class="pencil-table-icon" 
                                 data-job-id="${profile.job_id}" 
                                 data-skill-id="${skill.id}" 
                                 data-profile-name="${Utils.sanitizeHTML(profile.name)}" 
                                 data-pivot-id="0" 
                                 data-skill-name="${Utils.sanitizeHTML(skill.name)}" 
                                 data-level="0" 
                                 data-description="0">
                                <iconify-icon icon="heroicons:pencil-square" class="fa-1-5"></iconify-icon>
                            </div>
                        </div>
                    `;
                    }

                    return td;
                }

                static markEmptySkillColumns(skills, profiles) {
                    skills.forEach((skill) => {
                        const hasProfileWithSkill = profiles.some(profile => profile.skills[skill.id]);
                        if (!hasProfileWithSkill) {
                            const cells = document.querySelectorAll(
                                `td[data-skill-index="${skill.id}"]`);
                            cells.forEach(cell => cell.classList.add('no-profile'));
                        }
                    });
                }

                static initializeTooltips() {
                    const tooltipTriggerList = [].slice.call(document.querySelectorAll(
                        '[data-bs-toggle="tooltip"]'));
                    tooltipTriggerList.forEach(function(el) {
                        if (typeof bootstrap !== 'undefined' && bootstrap.Tooltip) {
                            new bootstrap.Tooltip(el, {
                                delay: {
                                    show: 0,
                                    hide: 100
                                }
                            });
                        }
                    });
                }
            }

            // ============= MODAL MANAGER =============
            class ModalManager {
                static showEditSkillModal(skillData) {
                    const modal = new bootstrap.Modal(document.getElementById('editSkillModal'));
                    modal.show();
                    this.populateEditModal(skillData);
                }

                static populateEditModal(skillData) {
                    const elements = {
                        title: document.querySelector('#editSkillModalLabel'),
                        profileName: document.querySelector('#modal-profile-name'),
                        skillName: document.querySelector('#modal-skill-name'),
                        pivotId: document.querySelector('#modal-pivot-id'),
                        jobId: document.querySelector('#modal-job-id'),
                        skillId: document.querySelector('#modal-skill-id'),
                        levelDescription: document.querySelector('#level-description'),
                        removeBtn: document.getElementById('removeSkillBtn'),
                        footerBtn: document.getElementById('edit-footer-btn')
                    };

                    if (skillData.pivotId > 0) {
                        elements.title.textContent = `Edit Skill: ${skillData.skillName}`;
                        elements.removeBtn.style.display = 'block';
                        elements.footerBtn.style.justifyContent = 'space-between';
                    } else {
                        elements.title.textContent = `Create Skill: ${skillData.skillName}`;
                        elements.removeBtn.style.display = 'none';
                        elements.footerBtn.style.justifyContent = 'center';
                    }

                    elements.profileName.textContent = skillData.profileName;
                    elements.skillName.value = skillData.skillName;
                    elements.pivotId.value = skillData.pivotId;
                    elements.jobId.value = skillData.jobId;
                    elements.skillId.value = skillData.skillId;
                    elements.levelDescription.textContent = skillData.description != 0 ? skillData.description :
                        'Please select a proficiency level.';
                        console.log('skilllllssssssssssss',skillData);
                }

                static updateLevelButtons(skillData, allSkills) {
                    const skill = allSkills.find(s => s.id === parseInt(skillData.skillId));
                    if (!skill) return;

                    const availableLevels = [];
                    for (let i = 1; i <= 6; i++) {
                        if (skill[`level_${i}_description`] && skill[`level_${i}_description`] !== "") {
                            availableLevels.push(i);
                        }
                    }

                    const levelButtons = document.querySelectorAll('.level-btn');
                    levelButtons.forEach(btn => {
                        const level = parseInt(btn.getAttribute('data-level'));
                        btn.disabled = !availableLevels.includes(level);
                        btn.style.display = availableLevels.includes(level) ? 'inline-block' : 'none';
                        btn.classList.remove('active');

                        if (btn.getAttribute('data-level') == skillData.level) {
                            btn.classList.add('active');
                        }
                    });
                }
            }

            // ============= MAIN CONTROLLER =============
            class JobSkillsManager {
                constructor() {
                    this.elements = this.initializeElements();
                    this.state = {
                        allSkills: [],
                        allProfiles: [],
                        currentDivisionId: null,
                        currentSkillId: null,
                        newlyAddSkill: null,
                        selectedValues: []
                    };
                    this.init();
                }

                initializeElements() {
                    return {
                        businessUnitSelect: document.getElementById('business_unit_id'),
                        sectorSelect: document.getElementById('sector'),
                        trackSelect: document.getElementById('track'),
                        profilesContainer: document.getElementById('profiles-container'),
                        profilesTableBody: document.querySelector('#profiles-table tbody'),
                        selectAllCheckbox: document.getElementById('select-all'),
                        approveButton: document.getElementById('approve-skill-job-btn'),
                        approveButtonText: document.getElementById('approve-skill-job-btn-text'),
                        messageAlert: document.getElementById('message_alert'),
                        noContentAlert: document.getElementById('nocontent_alert'),
                        statisticsDiv: document.getElementById('statics-divv'),
                        scrollText: document.getElementById('scrollText')
                    };
                }

                init() {
                    this.loadBusinessUnits();
                    this.attachEventListeners();
                    this.updateApproveButton();
                }

                attachEventListeners() {
                    this.elements.businessUnitSelect.addEventListener('change', (e) => this
                        .handleBusinessUnitChange(e));
                    this.elements.sectorSelect.addEventListener('change', (e) => this.handleSectorChange(e));
                    this.elements.trackSelect.addEventListener('change', (e) => this.handleTrackChange(e));

                    this.elements.selectAllCheckbox.addEventListener('change', (e) => this
                        .handleSelectAllChange(e));
                    this.elements.profilesTableBody.addEventListener('change', (e) => this.handleCheckboxChange(
                        e));
                    this.elements.profilesTableBody.addEventListener('click', Utils.debounce((e) => this
                        .handleTableClick(e), CONFIG.DEBOUNCE_DELAY));

                    const headerRow = document.querySelector('#profiles-table thead tr');
                    if (headerRow) {
                        headerRow.addEventListener('click', (e) => this.handleHeaderClick(e));
                    }

                    this.attachModalEventListeners();
                    this.elements.approveButtonText.addEventListener('click', (e) => this.handleApproveClick(
                    e));
                }

                attachModalEventListeners() {
                    const editModal = document.getElementById('editSkillModal');
                    if (editModal) editModal.addEventListener('click', (e) => this.handleEditModalClick(e));

                    const saveBtn = document.getElementById('saveSkillBtn');
                    if (saveBtn) saveBtn.addEventListener('click', (e) => this.handleSaveSkill(e));

                    const removeBtn = document.getElementById('removeSkillBtn');
                    if (removeBtn) removeBtn.addEventListener('click', (e) => this.handleRemoveSkill(e));

                    const deleteBtn = document.getElementById('deleteProfileSkillLvl');
                    if (deleteBtn) deleteBtn.addEventListener('click', (e) => this.handleDeleteSkillConfirm(e));

                    const showEditBtn = document.getElementById('showeditSkillModal');
                    if (showEditBtn) showEditBtn.addEventListener('click', (e) => this.handleShowEditModal(e));

                    const confirmApproveBtn = document.getElementById('confirmApproveBtn');
                    if (confirmApproveBtn) confirmApproveBtn.addEventListener('click', (e) => this
                        .handleConfirmApprove(e));

                    const confirmDeleteSkillBtn = document.getElementById('confirmDeleteSkillBtn');
                    if (confirmDeleteSkillBtn) confirmDeleteSkillBtn.addEventListener('click', (e) => this
                        .handleConfirmDeleteSkill(e));

                    const addSkillBtn = document.getElementById('AddJobFamilySKill');
                    if (addSkillBtn) addSkillBtn.addEventListener('click', (e) => this.handleAddSkillClick(e));

                    const proceedBtn = document.getElementById('proceedAddSkillBtn');
                    if (proceedBtn) proceedBtn.addEventListener('click', (e) => this.handleProceedAddSkill(e));
                }

                async loadBusinessUnits() {
                    try {
                        const data = await ApiService.getBusinessUnits();
                        UIManager.populateSelect(this.elements.businessUnitSelect, data,
                        'Select Business Unit');
                    } catch (error) {
                        console.error('Failed to load business units:', error);
                        UIManager.showAlert(this.elements.messageAlert, 'danger',
                            'Failed to load business units');
                    }
                }

                async handleBusinessUnitChange(e) {
                    const businessUnitId = e.target.value;
                    UIManager.clearSelectOptions(this.elements.sectorSelect, 'Select Company/Division');
                    UIManager.clearSelectOptions(this.elements.trackSelect, 'Select Department');
                    this.showAddSkillButton(false);

                    this.hideProfilesTable();

                    if (!businessUnitId) return;

                    try {
                        this.elements.sectorSelect.disabled = false;
                        const data = await ApiService.getDivisions(businessUnitId);
                        UIManager.populateSelect(this.elements.sectorSelect, data, 'Select Company/Division',
                            'id', 'head_of_division');
                    } catch (error) {
                        console.error('Failed to load divisions:', error);
                        UIManager.showAlert(this.elements.messageAlert, 'danger', 'Failed to load divisions');
                    }
                }

                async handleSectorChange(e) {
                    const divisionId = e.target.value;
                    UIManager.clearSelectOptions(this.elements.trackSelect, 'Select Department');
                    this.showAddSkillButton(false);
                    this.hideProfilesTable();
                    this.clearAlerts();

                    if (!divisionId) return;

                    this.state.currentDivisionId = divisionId;

                    try {
                        const data = await ApiService.getJobProfilesByDivision(divisionId);
                        await this.processDivisionData(data);
                    } catch (error) {
                        console.error('Failed to load division data:', error);
                        UIManager.showAlert(this.elements.messageAlert, 'danger', 'Failed to load data');
                    }
                }

                async handleTrackChange(e) {
                    const departmentId = e.target.value ?? null;
                    this.hideProfilesTable();
                    this.clearAlerts();
                    if (!departmentId) {
                        // If "All Departments" is selected, re-fetch division data from server
                        if (this.state.currentDivisionId) {
                            try {

                                const data = await ApiService.getJobProfilesByDivision(this.state
                                    .currentDivisionId);
                                await this.processDivisionData(data);
                                this.showAddSkillButton(false);
                            } catch (error) {
                                console.error('Failed to load division data:', error);
                                UIManager.showAlert(this.elements.messageAlert, 'danger',
                                    'Failed to load division data');
                            }
                        }

                        return;
                    }

                    try {
                        const data = await ApiService.getJobProfilesByDepartment(departmentId);
                        await this.processDepartmentData(data);
                    } catch (error) {
                        console.error('Failed to load department data:', error);
                        UIManager.showAlert(this.elements.messageAlert, 'danger',
                            'Failed to load department data');
                    }
                }

                async processDivisionData(data) {
                    if (!data || !Array.isArray(data.allSkills) || !Array.isArray(data.profiles) || !Array
                        .isArray(data.departments)) {
                        console.error('Unexpected data format:', data);
                        return;
                    }

                    // Store division data
                    this.state.allSkills = data.allSkills;
                    this.state.allProfiles = data.profiles;

                    if (data.allSkills.length === 0 && data.profiles.length === 0) {
                        this.showNoContentAlert('No skills or job positions found for this division.');
                        return;
                    }

                    this.clearAlerts();
                    document.getElementById('AddJobFamilySKill').style.display = 'block';

                    // Populate department dropdown
                    this.elements.trackSelect.disabled = false;
                    UIManager.populateSelect(this.elements.trackSelect, data.departments, 'All Departments');

                    // Show all division data
                    UIManager.updateCounts(data.allSkills.length, data.profiles.length);
                    TableBuilder.buildProfilesTable(data.allSkills, data.profiles);

                    this.showProfilesTable();
                    this.scrollToNewSkill();
                }

                async processDepartmentData(data) {
                    if (!data || !Array.isArray(data.allSkills) || !Array.isArray(data.profiles)) {
                        console.error('Unexpected data format:', data);
                        return;
                    }

                    // Update with department-specific data
                    this.state.allSkills = data.allSkills;
                    this.state.allProfiles = data.profiles;

                    if (data.allSkills.length === 0 && data.profiles.length === 0) {
                        this.showNoContentAlert('No skills or job positions found for this department.');

                        return;
                    }

                    this.clearAlerts();
                    this.showAddSkillButton(true);

                    UIManager.updateCounts(data.allSkills.length, data.profiles.length);
                    TableBuilder.buildProfilesTable(data.allSkills, data.profiles);

                    this.showProfilesTable();

                    this.scrollToNewSkill();
                }

                showDivisionData() {
                    if (this.state.allSkills.length === 0 && this.state.allProfiles.length === 0) {
                        return;
                    }

                    UIManager.updateCounts(this.state.allSkills.length, this.state.allProfiles.length);
                    TableBuilder.buildProfilesTable(this.state.allSkills, this.state.allProfiles);
                    this.showProfilesTable();
                }

                showNoContentAlert(message = 'No job positions match the selected criteria.') {
                    this.elements.noContentAlert.innerHTML = `
                    <div class="alert alert-warning alert-dismissible fade show" role="alert" style="border-top-left-radius: 0px; border-bottom-left-radius: 0px; border-left: 6px solid; display: flex; align-items: center;">
                        <iconify-icon icon="ic:round-warning" width="24" height="24" class="mr-4"></iconify-icon>
                        ${message}
                    </div>
                `;
                }

                clearAlerts() {
                    if (this.elements.noContentAlert) {
                        this.elements.noContentAlert.innerHTML = '';
                    }
                    if (this.elements.messageAlert) {
                        this.elements.messageAlert.innerHTML = '';
                    }
                }

                // showAddSkillButton() {
                //     const addSkillBtn = document.getElementById('add-department-skill-btn');
                //     if (addSkillBtn) {
                //         addSkillBtn.removeAttribute('disabled');
                //         addSkillBtn.removeAttribute('data-bs-title');
                //     }
                // }
                showAddSkillButton(enabled) {
                    const addSkillBtn = document.getElementById('add-department-skill-btn');
                    if (!addSkillBtn) return;
                    
                    // Dispose existing tooltip instance
                    const existingTooltip = bootstrap.Tooltip.getInstance(addSkillBtn);
                    if (existingTooltip) {
                        existingTooltip.dispose();
                    }
                    
                    if (enabled) {
                        addSkillBtn.removeAttribute('disabled');
                        addSkillBtn.removeAttribute('data-bs-title');
                        // Remove tooltip toggle when enabled
                        addSkillBtn.removeAttribute('data-bs-toggle');
                    } else {
                        addSkillBtn.setAttribute('disabled', 'true');
                        addSkillBtn.setAttribute('data-bs-title',
                            'Please select department to add technical skill');
                        addSkillBtn.setAttribute('data-bs-toggle', 'tooltip');
                        
                        // Initialize new tooltip for disabled state
                        new bootstrap.Tooltip(addSkillBtn, {
                            placement: 'top',
                            trigger: 'hover'
                        });
                    }
                }


                hideProfilesTable() {
                    UIManager.toggleElementVisibility('profiles-container', false);
                    UIManager.toggleElementVisibility('statics-divv', false);
                    UIManager.toggleElementVisibility('scrollText', false);
                    if (this.elements.profilesTableBody) {
                        this.elements.profilesTableBody.innerHTML = '';
                    }
                }

                showProfilesTable() {
                    UIManager.toggleElementVisibility('profiles-container', true);
                    UIManager.toggleElementVisibility('statics-divv', true, 'flex');
                    UIManager.toggleElementVisibility('scrollText', true, 'flex');
                }

                scrollToNewSkill() {
                    if (this.state.newlyAddSkill) {
                        setTimeout(() => {
                            const newColumn = document.querySelector(
                                `[data-master-skill-id="${this.state.newlyAddSkill}"]`);
                            if (newColumn) {
                                newColumn.scrollIntoView({
                                    behavior: 'smooth',
                                    inline: 'end',
                                    block: 'nearest'
                                });
                            }
                            this.state.newlyAddSkill = null;
                        }, 100);
                    }
                }

                handleSelectAllChange(e) {
                    const checkboxes = this.elements.profilesTableBody.querySelectorAll(
                        'input[type="checkbox"]:not(:disabled)');
                    checkboxes.forEach(checkbox => checkbox.checked = e.target.checked);
                    this.updateApproveButton();
                }

                handleCheckboxChange(e) {
                    if (e.target && e.target.type === 'checkbox' && !e.target.disabled) {
                        this.updateSelectAllCheckbox();
                        this.updateApproveButton();
                    }
                }

                updateSelectAllCheckbox() {
                    const allCheckboxes = this.elements.profilesTableBody.querySelectorAll(
                        'input[type="checkbox"]:not(:disabled)');
                    const checkedCheckboxes = this.elements.profilesTableBody.querySelectorAll(
                        'input[type="checkbox"]:checked:not(:disabled)');

                    this.elements.selectAllCheckbox.checked = allCheckboxes.length === checkedCheckboxes
                        .length && allCheckboxes.length > 0;
                    this.elements.selectAllCheckbox.indeterminate = checkedCheckboxes.length > 0 &&
                        checkedCheckboxes.length < allCheckboxes.length;
                }

                updateApproveButton() {
                    const checkedCheckboxes = this.elements.profilesTableBody.querySelectorAll(
                        'input[type="checkbox"]:checked:not(:disabled)');
                    const selectedCount = checkedCheckboxes.length;
                    this.elements.approveButtonText.textContent = `Approve Selected (${selectedCount})`;
                    this.elements.approveButton.style.display = selectedCount > 0 ? 'inline-block' : 'none';
                }

                handleTableClick(e) {
                    if (e.target?.closest('.pencil-table-icon')) {
                        this.handleEditSkillClick(e);
                    }
                }

                handleEditSkillClick(e) {
                    const button = e.target.closest('.pencil-table-icon');
                    const skillData = {
                        skillId: button.getAttribute('data-skill-id'),
                        skillName: button.getAttribute('data-skill-name'),
                        profileName: button.getAttribute('data-profile-name'),
                        level: button.getAttribute('data-level'),
                        description: button.getAttribute('data-description'),
                        pivotId: button.getAttribute('data-pivot-id'),
                        jobId: button.getAttribute('data-job-id')
                    };

                    this.state.currentSkillId = skillData.skillId;
                    ModalManager.showEditSkillModal(skillData);
                    ModalManager.updateLevelButtons(skillData, this.state.allSkills);
                    
                    // Load knowledge and abilities for the current level
                    this.loadSkillDetailsForLevel(skillData.level);
                }

                handleEditModalClick(e) {
                    if (e.target?.closest('.level-btn')) {
                        this.handleLevelButtonClick(e);
                    }
                }

                async handleLevelButtonClick(e) {
                    const levelButton = e.target.closest('.level-btn');
                    const level = levelButton.getAttribute('data-level');

                    if (!this.state.currentSkillId) {
                        console.error('Current skill ID is not set.');
                        return;
                    }

                    // Update active button state first for immediate feedback
                    document.querySelectorAll('.level-btn').forEach(btn => {
                        btn.classList.remove('active');
                        if (btn.getAttribute('data-level') == level) {
                            btn.classList.add('active');
                        }
                    });

                    // Load skill details for the selected level
                    try {
                        await this.loadSkillDetailsForLevel(level);
                    } catch (error) {
                        console.error('Error fetching skill details:', error);
                        UIManager.showAlert(this.elements.messageAlert, 'danger',
                            'Failed to load skill details. Please try again.');
                    }
                }

                formatAsList(element, text) {
                    // Clear existing content
                    element.innerHTML = '';

                    // Check if text contains semicolons
                    if (text && text.includes(';')) {
                        // Split by semicolon and filter out empty items
                        const items = text.split(';')
                            .map(item => item.trim())
                            .filter(item => item.length > 0);

                        // Create paragraph elements with icons for each item
                        items.forEach((item, index) => {
                            const p = document.createElement('p');
                            p.className = index === items.length - 1 ? 'mb-0 d-flex align-items-center gap-3' : 'mb-2 d-flex align-items-center gap-3';
                            p.style.overflowWrap = 'anywhere';
                            
                            // Create the icon
                            const icon = document.createElement('iconify-icon');
                            icon.setAttribute('icon', 'gg:check-o');
                            icon.setAttribute('width', '16');
                            icon.setAttribute('height', '16');
                            icon.style.color = '#F7941C';
                            icon.style.flexShrink = '0'; // Prevent icon from shrinking
                            
                            // Add icon and text to paragraph
                            p.appendChild(icon);
                            p.appendChild(document.createTextNode(' ' + item));
                            
                            element.appendChild(p);
                        });
                    } else {
                        // If no semicolons, display as plain text in a paragraph
                        const p = document.createElement('p');
                        p.className = 'mb-0';
                        p.textContent = text || 'No information available for this level.';
                        element.appendChild(p);
                    }
                }

                async loadSkillDetailsForLevel(level) {
                    if (!this.state.currentSkillId) {
                        console.error('Current skill ID is not set.');
                        return;
                    }

                    try {
                        // Fetch skill details from API
                        const response = await ApiService.getSkillDetails(this.state.currentSkillId);
                        
                        if (!response.success || !response.skill) {
                            throw new Error('Failed to fetch skill details');
                        }

                        const skill = response.skill;
                        console.log('Loaded skill data for level:', level, skill);

                        // Get description, knowledge, and abilities for the selected level
                        const levelDescription = skill[`level_${level}_description`] ||
                            'No description available for this level';
                        const levelKnowledge = skill[`level_${level}_knowledge`] ||
                            'No knowledge information available for this level';
                        const levelAbilities = skill[`level_${level}_ability`] ||
                            'No abilities information available for this level';

                        // Update description
                        const descriptionElement = document.getElementById('level-description');
                        if (descriptionElement) {
                            descriptionElement.textContent = levelDescription;
                        }

                        // Update knowledge - format as list
                        const knowledgeElement = document.getElementById('level-knowledge');
                        if (knowledgeElement) {
                            this.formatAsList(knowledgeElement, levelKnowledge);
                        }

                        // Update abilities - format as list
                        const abilitiesElement = document.getElementById('level-abilities');
                        if (abilitiesElement) {
                            this.formatAsList(abilitiesElement, levelAbilities);
                        }
                    } catch (error) {
                        console.error('Error loading skill details:', error);
                        // Don't show error alert on initial load, just log it
                    }
                }

                async handleSaveSkill(e) {
                    const selectedLevel = document.querySelector('.level-btn.active')?.getAttribute(
                        'data-level');
                    const pivotId = document.getElementById('modal-pivot-id')?.value;
                    const jobId = document.getElementById('modal-job-id')?.value;

                    const data = {
                        skillId: this.state.currentSkillId,
                        level: selectedLevel,
                        pivotId: pivotId,
                        jobId: jobId
                    };

                    const validation = ValidationService.validateSkillData(data);
                    if (!validation.isValid) {
                        UIManager.showAlert(this.elements.messageAlert, 'danger', validation.errors.join(', '));
                        return;
                    }

                    try {
                        const response = await ApiService.updateSkillLevel(data);
                        if (response.success) {
                            UIManager.showAlert(this.elements.messageAlert, 'success', response.message);
                            this.closeModal('editSkillModal');
                            this.refreshCurrentView();
                        } else {
                            UIManager.showAlert(this.elements.messageAlert, 'danger', 'Failed to save changes');
                        }
                    } catch (error) {
                        console.error('Error saving skill:', error);
                        UIManager.showAlert(this.elements.messageAlert, 'danger',
                            'An error occurred while saving changes');
                    }
                }

                handleRemoveSkill(e) {
                    const skillName = document.getElementById('modal-skill-name')?.value ||
                    'Default Skill Name';
                    const profileName = document.getElementById('modal-profile-name')?.textContent ||
                        'Default Profile Name';

                    document.getElementById('deleteSkillName').textContent = skillName;
                    document.getElementById('skillDeleteJobProfileName').textContent = profileName;

                    this.closeModal('editSkillModal');
                    this.showModal('deleteProfileSkillLvlModal');
                }

                handleShowEditModal(e) {
                    this.showModal('editSkillModal');
                }

                async handleDeleteSkillConfirm(e) {
                    const pivotId = document.getElementById('modal-pivot-id')?.value;

                    const data = {
                        skillId: this.state.currentSkillId,
                        pivotId: pivotId,
                        is_remove: true
                    };

                    try {
                        const response = await ApiService.updateSkillLevel(data);
                        if (response.success) {
                            UIManager.showAlert(this.elements.messageAlert, 'success', response.message);
                            this.closeModal('editSkillModal');
                            this.closeModal('deleteProfileSkillLvlModal');
                            this.refreshCurrentView();
                        } else {
                            UIManager.showAlert(this.elements.messageAlert, 'danger', 'Failed to remove skill');
                        }
                    } catch (error) {
                        console.error('Error removing skill:', error);
                        UIManager.showAlert(this.elements.messageAlert, 'danger',
                            'An error occurred while removing skill');
                    }
                }

                handleApproveClick(e) {
                    const selectedCheckboxes = this.elements.profilesTableBody.querySelectorAll(
                        'input[type="checkbox"]:checked:not(:disabled)');

                    if (!ValidationService.validateProfileSelection(Array.from(selectedCheckboxes))) {
                        UIManager.showAlert(this.elements.messageAlert, 'warning',
                            'Please select at least one job position to approve.');
                        return;
                    }

                    this.state.selectedValues = Array.from(selectedCheckboxes).map(cb => cb.value);
                    this.showModal('approveConfirmationModal');
                }

                async handleConfirmApprove(e) {
                    this.closeModal('approveConfirmationModal');

                    try {
                        const response = await ApiService.approveProfiles(this.state.selectedValues);
                        if (response.success) {
                            const allCheckboxes = this.elements.profilesTableBody.querySelectorAll(
                                'input[type="checkbox"]:not(:disabled)');
                            allCheckboxes.forEach(checkbox => checkbox.checked = false);
                            this.elements.selectAllCheckbox.checked = false;
                            this.updateApproveButton();
                            this.refreshCurrentView();
                            UIManager.showAlert(this.elements.messageAlert, 'success', response.message ||
                                'Profiles approved successfully');
                        } else {
                            UIManager.showAlert(this.elements.messageAlert, 'danger',
                                'Failed to approve selected skills');
                        }
                    } catch (error) {
                        console.error('Error approving profiles:', error);
                        UIManager.showAlert(this.elements.messageAlert, 'danger',
                            'An error occurred while approving skills');
                    }
                }

                handleHeaderClick(e) {
                    const btn = e.target.closest('.th-delete-icon');
                    if (!btn) return;

                    const skillId = btn.getAttribute('data-master-skill-id');
                    const th = btn.closest('th');
                    const skillName = th.getAttribute('skill-name') || `#${skillId}`;
                    const assigned = this.state.allProfiles.filter(p => p.skills && p.skills[skillId]);

                    if (assigned.some(p => p.status === 1)) {
                        UIManager.showAlert(
                            this.elements.noContentAlert,
                            'danger',
                            `The technical skill '${skillName}' cannot be deleted. It's linked to approved job position(s). Set the associated profile(s) to 'Pending' or remove linked proficiency data to proceed.`
                        );
                        return;
                    }

                    this.clearAlerts();
                    document.getElementById('skillToDeleteName').textContent = skillName;
                    this.showModal('DeleteJobLevelTechnicalSkillModal');

                    this.state.skillToDelete = {
                        skillId,
                        skillName,
                        assigned,
                        th
                    };
                }

                async handleConfirmDeleteSkill(e) {
                    if (!this.state.skillToDelete) return;

                    this.closeModal('DeleteJobLevelTechnicalSkillModal');

                    const {
                        skillId,
                        assigned,
                        th
                    } = this.state.skillToDelete;
                    const profileIds = assigned.map(p => p.job_id);
                    const department_id = this.elements.trackSelect.value || null;
                    const division_id = this.state.currentDivisionId;

                    try {
                        const response = await ApiService.deleteSkill(skillId, {
                            skillId,
                            profileIds,
                            department_id,
                            division_id
                        });

                        if (response.status === 'success') {
                            UIManager.showAlert(this.elements.messageAlert, 'success', response.message);
                            th.remove();
                            this.refreshCurrentView();
                        } else {
                            UIManager.showAlert(this.elements.messageAlert, 'danger',
                                `Failed to delete skill: ${response.message || 'unknown error'}`);
                        }
                    } catch (error) {
                        console.error('Error deleting skill:', error);
                        UIManager.showAlert(this.elements.messageAlert, 'danger',
                            'Error deleting skill. Check console for details.');
                    }
                }

                handleAddSkillClick(e) {
                    this.showModal('AddSkillPopup');
                }

                async handleProceedAddSkill(e) {
                    const selectedSkill = $('#selectSkill').val();
                    const currentDepartment = this.elements.trackSelect.value;
                    const currentDivision = this.state.currentDivisionId;

                    if (!selectedSkill) {
                        $('#selectSkillError').show();
                        $('#selectSkill').addClass('error');
                        return;
                    }

                    $('#selectSkillError').hide();
                    $('#selectSkill').removeClass('error');

                    // Use department if selected, otherwise use division
                    const trackId = currentDepartment || currentDivision;

                    try {
                        const response = await ApiService.createJobFamilySkill(selectedSkill, trackId);

                        if (response.success) {
                            this.state.newlyAddSkill = response.skill_id;
                            this.closeModal('AddSkillPopup');
                            console.log('asadfasdfasdfasdfasdf', response.message, this.elements.messageAlert);
                            UIManager.showAlert(this.elements.messageAlert, 'success', response.message);
                            this.refreshCurrentView();
                        } else {
                            document.getElementById('selectSkillError').innerHTML = response.message;
                            $('#selectSkillError').show();
                        }
                    } catch (error) {
                        console.error('Error adding skill:', error);
                        UIManager.showAlert(this.elements.messageAlert, 'danger',
                            'An error occurred while adding the skill');
                    }
                }

                showModal(modalId) {
                    const modal = new bootstrap.Modal(document.getElementById(modalId));
                    modal.show();
                }

                closeModal(modalId) {
                    const modalEl = document.getElementById(modalId);
                    const modal = bootstrap.Modal.getInstance(modalEl);
                    if (modal) modal.hide();
                }

                refreshCurrentView() {
                    // Check if department is selected
                    const departmentId = this.elements.trackSelect.value;
                    if (departmentId) {
                        // Refresh department view
                        this.elements.trackSelect.dispatchEvent(new Event('change'));
                    } else if (this.state.currentDivisionId) {
                        // Refresh division view
                        this.elements.sectorSelect.dispatchEvent(new Event('change'));
                    }
                }

                initializeSkillSelect2() {
                    $('#selectSkill').select2({
                        ajax: {
                            url: CONFIG.ROUTES.SEARCH_SKILLS,
                            dataType: 'json',
                            delay: 250,
                            data: function(params) {
                                return {
                                    q: params.term,
                                    page: params.page || 1
                                };
                            },
                            processResults: function(data, params) {
                                params.page = params.page || 1;
                                return {
                                    results: data.results,
                                    pagination: {
                                        more: data.pagination.more
                                    }
                                };
                            },
                            cache: true
                        },
                        templateResult: function(data) {
                            if (data.loading) return data.text;
                            const isNewSkill = data.text && data.text.includes('(New Skill)');
                            return $(
                                `<span>${data.text} ${isNewSkill ? '<span class="badge bg-warning text-dark ms-2">New</span>' : ''}</span>`
                                );
                        },
                        templateSelection: function(data) {
                            return data.text;
                        },
                        placeholder: 'Search for a skill',
                        minimumInputLength: 1,
                        width: 'resolve',
                        allowClear: true,
                        dropdownParent: $('#AddSkillPopup')
                    });
                }
            }

            // ============= INITIALIZE APPLICATION =============
            const jobSkillsManager = new JobSkillsManager();

            $('#AddSkillPopup').on('shown.bs.modal', function() {
                const sectorSelect = document.getElementById('sector');
                const trackSelect = document.getElementById('track');

                document.getElementById('add_ts_job_family_group').textContent = sectorSelect
                    .selectedOptions[0]?.textContent ?? 'Division';
                document.getElementById('add_ts_job_family').textContent = trackSelect.selectedOptions[0]
                    ?.textContent ?? 'Department';

                jobSkillsManager.initializeSkillSelect2();
            });

            $('#AddSkillPopup').on('hidden.bs.modal', function() {
                $('#selectSkill').val(null).trigger('change');
            });
        });
    </script>
@endpush
