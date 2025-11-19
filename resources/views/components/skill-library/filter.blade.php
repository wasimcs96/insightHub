<div id="offcanvasRight" class="offcanvas offcanvas-end" data-bs-scroll="false">
    <div class="offcanvas-header">
        <div class="d-flex gap-2 align-items-center">
            <h5 class="offcanvas-title">Filters <span class="total-filter-count">(0)</span></h5>
            {{-- <p class="m-0 clear-filters" id="clear-filters-button">Clear filters</p> --}}
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body" style="padding-bottom: 120px;">

        <!-- Business Unit -->
        <div class="filter-block mb-9" data-type="Business Unit" data-key="bu">
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="filter-side-heading mb-5">Business Unit <span class="filter-count">(0)</span></h5>
                <p class="m-0 clear-filters text-decoration-underline section-clear">Clear All</p>
            </div>
            <div class="select-wrapper">
                <div class="select-box" data-select="box">
                    <span class="selected-label">0 Business Unit(s) selected</span>
                    <span class="arrow"><iconify-icon icon="fluent:chevron-down-16-filled" width="16"
                            height="16" style="color: #78829D;"></iconify-icon></span>
                </div>
                <div class="dropdown" style="display:none;">
                    <div class="search-input d-flex align-items-center gap-2 py-4 px-3">
                        <iconify-icon icon="stash:search-solid" width="16" height="16"></iconify-icon>
                        <input type="text" class="search-box border-0" placeholder="Search for Business Unit">
                    </div>
                    <div class="options-list" data-list="bu"></div>
                    <div class="dropdown-footer">
                        <button class="btn-reset" data-action="reset">Reset</button>
                        <button class="btn-filter" data-action="apply">Filter</button>
                    </div>
                </div>
                <div class="selected-tags d-flex flex-wrap gap-2 mt-3" data-tags="true"></div>
            </div>
        </div>

        {{-- <hr> --}}

        <!-- Company/Division -->
        <div class="filter-block mb-9" data-type="Company/Division" data-key="company">
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="filter-side-heading mb-5">Company/Division <span class="filter-count">(0)</span></h5>
                <p class="m-0 clear-filters text-decoration-underline section-clear">Clear All</p>
            </div>
            <div class="select-wrapper">
                <div class="select-box disabled" data-select="box">
                    <span class="selected-label">0 Company/Division(s) selected</span>
                    <span class="arrow"><iconify-icon icon="fluent:chevron-down-16-filled" width="16"
                            height="16" style="color: #78829D;"></iconify-icon></span>
                </div>
                <div class="dropdown" style="display:none;">
                    <div class="search-input d-flex align-items-center gap-2 py-4 px-3">
                        <iconify-icon icon="stash:search-solid" width="16" height="16"></iconify-icon>
                        <input type="text" class="search-box border-0" placeholder="Search For Company/Division">
                    </div>
                    <div class="options-list" data-list="company"></div>
                    <div class="dropdown-footer">
                        <button class="btn-reset" data-action="reset">Reset</button>
                        <button class="btn-filter" data-action="apply">Filter</button>
                    </div>
                </div>
                <div class="selected-tags d-flex flex-wrap gap-2 mt-3" data-tags="true"></div>
            </div>
        </div>

        {{-- <hr> --}}

        <!-- Departments -->
        <div class="filter-block mb-9" data-type="Departments" data-key="department">
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="filter-side-heading mb-5">Departments <span class="filter-count">(0)</span></h5>
                <p class="m-0 clear-filters text-decoration-underline section-clear">Clear All</p>
            </div>
            <div class="select-wrapper">
                <div class="select-box disabled" data-select="box">
                    <span class="selected-label">0 Departments(s) selected</span>
                    <span class="arrow"><iconify-icon icon="fluent:chevron-down-16-filled" width="16"
                            height="16" style="color: #78829D;"></iconify-icon></span>
                </div>
                <div class="dropdown" style="display:none;">
                    <div class="search-input d-flex align-items-center gap-2 py-4 px-3">
                        <iconify-icon icon="stash:search-solid" width="16" height="16"></iconify-icon>
                        <input type="text" class="search-box border-0" placeholder="Search For Departments">
                    </div>
                    <div class="options-list" data-list="department"></div>
                    <div class="dropdown-footer">
                        <button class="btn-reset" data-action="reset">Reset</button>
                        <button class="btn-filter" data-action="apply">Filter</button>
                    </div>
                </div>
                <div class="selected-tags d-flex flex-wrap gap-2 mt-3" data-tags="true"></div>
            </div>
        </div>

        <hr style="margin-bottom: 32px;">

        <div class="filter-block mb-9" data-type="Job Positions" data-key="job_position">
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="filter-side-heading mb-5">Job Positions <span class="filter-count">(0)</span></h5>
                <p class="m-0 clear-filters text-decoration-underline section-clear">Clear All</p>
            </div>
            <div class="select-wrapper">
                <div class="select-box disabled" data-select="box">
                    <span class="selected-label">0 Job Position(s) selected</span>
                    <span class="arrow"><iconify-icon icon="fluent:chevron-down-16-filled" width="16"
                            height="16" style="color: #78829D;"></iconify-icon></span>
                </div>
                <div class="dropdown" style="display:none;">
                    <div class="search-input d-flex align-items-center gap-2 py-4 px-3">
                        <iconify-icon icon="stash:search-solid" width="16" height="16"></iconify-icon>
                        <input type="text" class="search-box border-0" placeholder="Search For Job Positions">
                    </div>
                    <div class="options-list" data-list="job_position"></div>
                    <div class="dropdown-footer">
                        <button class="btn-reset" data-action="reset">Reset</button>
                        <button class="btn-filter" data-action="apply">Filter</button>
                    </div>
                </div>
                <div class="selected-tags d-flex flex-wrap gap-2 mt-3" data-tags="true"></div>
            </div>
        </div>

        <div class="d-flex gap-3 footer-btn">
            <button type="button" class="clear-filter" id="footer-clear">Clear Filters</button>
            <button id="apply-filters-button" class="apply-filters" type="button">Apply Filters</button>
        </div>

        <pre id="filters-json" class="mt-3 bg-light p-2 rounded small d-none" style="max-height:140px;overflow:auto;">{}</pre>
    </div>
</div>

@push('scripts')
    <script>
        function debounce(fn, delay = 300) {
            let t;
            return (...args) => {
                clearTimeout(t);
                t = setTimeout(() => fn(...args), delay);
            };
        }
        (function() {
            // ===== Dummy datasets (no API) =====
            const DUMMY = {
                bu: [{
                        id: 1,
                        name: "Business Support Partners"
                    },
                    {
                        id: 2,
                        name: "Commissary Business Operations"
                    },
                    {
                        id: 3,
                        name: "Store Business Operations - Conti's"
                    },
                    {
                        id: 4,
                        name: "Store Business Operations - Wendy's"
                    },
                    {
                        id: 5,
                        name: "Store Business Operations - Masuma"
                    },
                ],
                companiesByBU: {
                    1: [{
                        id: 6,
                        name: "Conti's BSP"
                    }],
                    2: [{
                        id: 7,
                        name: "Conti's CBO"
                    }],
                    3: [{
                        id: 8,
                        name: "Conti's Specialty Foods, Inc. (SBO-Conti's)"
                    }, {
                        id: 9,
                        name: "Conti's Various Companies"
                    }],
                    4: [{
                        id: 10,
                        name: "Masuma Food Industry Inc."
                    }],
                    5: [{
                        id: 11,
                        name: "Wendy's Group"
                    }],
                },
                departmentsByCompany: {
                    6: [{
                        id: 11,
                        name: 'Delivery'
                    }, {
                        id: 12,
                        name: 'Human Resources'
                    }],
                    7: [{
                        id: 13,
                        name: 'Inventory Management'
                    }],
                    8: [{
                        id: 14,
                        name: 'Operations'
                    }],
                    9: [{
                        id: 15,
                        name: 'Purchasing'
                    }],
                    10: [{
                        id: 16,
                        name: 'Finance'
                    }],
                    11: [{
                        id: 17,
                        name: 'QA'
                    }],
                },
                levelLabels: {
                    '1': 'Level 1',
                    '2': 'Level 2',
                    '3': 'Level 3',
                    '4': 'Level 4',
                    '5': 'Level 5',
                    '6': 'Level 6',
                    '7': 'Level 7',
                    '8': 'Level 8',
                    '9': 'Level 9',
                    '10': 'Level 10'
                },
                levelCounts: {
                    default: {
                        '1': 60,
                        '2': 20,
                        '3': 20,
                        '4': 20,
                        '5': 6,
                        '6': 2,
                        '7': 0,
                        '8': 0,
                        '9': 0,
                        '10': 0
                    },
                    byBU: {
                        1: {
                            '1': 40,
                            '2': 10,
                            '3': 5,
                            '4': 5,
                            '5': 0,
                            '6': 0,
                            '7': 0,
                            '8': 0,
                            '9': 0,
                            '10': 0
                        },
                        2: {
                            '1': 5,
                            '2': 10,
                            '3': 15,
                            '4': 0,
                            '5': 0,
                            '6': 2
                        },
                        3: {
                            '1': 8,
                            '2': 8,
                            '3': 4,
                            '4': 0,
                            '5': 1
                        },
                        4: {
                            '1': 12,
                            '2': 6,
                            '3': 4,
                            '4': 2,
                            '5': 5
                        },
                        5: {
                            '1': 6,
                            '2': 4,
                            '3': 2,
                            '4': 1,
                            '5': 0
                        }
                    }
                }
            };

            // ===== State =====
            const state = {
                buIds: [],
                companyIds: [],
                departmentIds: [],
                jobPositionIds: []
            };

            const $ = (s, scope = document) => scope.querySelector(s);
            const $$ = (s, scope = document) => Array.from(scope.querySelectorAll(s));





            // ---- Build options for a list ----
            function buildOptions(listEl, items, selectedIds = []) {
                if (!listEl) return;
                listEl.innerHTML = (items || []).map(it => `
                    <label class="checkbox-option">
                    <div class="w-100">
                        <label class="custom-checkbox m-0">
                        <input type="checkbox" value="${it.id}" data-label="${it.name}" ${selectedIds.includes(it.id) ? 'checked' : ''}>
                        <span class="checkmark"></span>
                        ${it.name}
                        </label>
                    </div>
                    </label>
                `).join('');
                if (!items || !items.length) {
                    listEl.innerHTML = '<div class="p-2 text-muted">No data</div>';
                }
            }


            const API = {
                bu: '{{ url('/admin/ajax/organization-chart-filter/business-unit') }}',
                company: '{{ url('/admin/ajax/organization-chart-filter/company-division') }}',
                department: '{{ url('/admin/ajax/organization-chart-filter/departments') }}',
                jobPosition: '{{ url('admin/ajax/get-jobs-by-department') }}',

            };

            async function loadBusinessUnits(term = '') {
                const listEl = document.querySelector('[data-list="bu"]');
                if (!listEl) return;
                listEl.innerHTML = '<div class="p-2 text-muted">Loading…</div>';
                try {
                    const url = term ? `${API.bu}?q=${encodeURIComponent(term)}` : API.bu;
                    const res = await fetch(url, {
                        headers: {
                            'Accept': 'application/json'
                        }
                    });
                    if (!res.ok) throw new Error('BU load failed');
                    const data = await res.json(); // [{id,name}]
                    buildOptions(listEl, data.data, state.buIds); // preserve checked
                } catch (e) {
                    console.warn('BU fetch failed, using fallback', e);
                    buildOptions(listEl, DUMMY.bu, state.buIds); // your existing dummy list
                }
            }

            async function loadCompanies(buIds, term = '') {
                const listEl = document.querySelector('[data-list="company"]');
                if (!listEl) return;

                listEl.innerHTML = '<div class="p-2 text-muted">Loading…</div>';
                try {
                    const res = await fetch(API.company, {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            bu_ids: buIds,
                            q: term,
                            _token: '{{ csrf_token() }}'
                        }) // passes selected BU IDs
                    });
                    if (!res.ok) throw new Error('Company/Division load failed');
                    const data = await res.json(); // supports {data:[...]} or [...]
                    const items = Array.isArray(data) ? data : (data.data || []);
                    buildOptions(listEl, items, state
                        .companyIds); // preserves checked (should be none on BU change)
                } catch (e) {
                    console.warn('Company/Division fetch failed:', e);
                    buildOptions(listEl, [], state.companyIds); // empty fallback
                }
            }

            async function loadDepartments(companyIds, buIds = [], term = '') {
                const listEl = document.querySelector('[data-list="department"]');
                if (!listEl) return;

                listEl.innerHTML = '<div class="p-2 text-muted">Loading…</div>';
                try {
                    const res = await fetch(API.department, {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            company_ids: companyIds, // required
                            bu_ids: buIds, // optional, included for context
                            q: term, // optional search term
                            _token: '{{ csrf_token() }}'
                        })
                    });
                    if (!res.ok) throw new Error('Departments load failed');
                    const data = await res.json(); // supports {data:[...]} or [...]
                    const items = Array.isArray(data) ? data : (data.data || []);
                    buildOptions(listEl, items, state.departmentIds);
                } catch (e) {
                    console.warn('Departments fetch failed:', e);
                    buildOptions(listEl, [], state.departmentIds); // empty fallback
                }
            }

            async function loadAllJobPositions(term = '') {
                const listEl = document.querySelector('[data-list="job_position"]');
                if (!listEl) return;

                listEl.innerHTML = '<div class="p-2 text-muted">Loading…</div>';
                try {
                    const res = await fetch(API.jobPosition, {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            q: term,
                            _token: '{{ csrf_token() }}'
                        })
                    });
                    if (!res.ok) throw new Error('Job Positions load failed');
                    const data = await res.json();
                    const items = Array.isArray(data) ? data : (data.data || []);
                    buildOptions(listEl, items, state.jobPositionIds);
                } catch (e) {
                    console.warn('Job Positions fetch failed:', e);
                    buildOptions(listEl, [], state.jobPositionIds);
                }
            }





            // ---- Init BU list ----
            loadBusinessUnits();
            loadAllJobPositions();

            // function updateMutualExclusion() {
            //     const buBlock = document.querySelector('[data-key="bu"]');
            //     const jobPositionBlock = document.querySelector('[data-key="job_position"]');

            //     // Check if we have hierarchy progression (BU -> Company -> Department)
            //     const hasHierarchyProgression = state.buIds.length > 0 &&
            //         (state.companyIds.length > 0 || state.departmentIds.length > 0);

            //     if (state.buIds.length > 0 && !hasHierarchyProgression) {
            //         // BU selected but no hierarchy progression - disable job positions
            //         setEnabled(jobPositionBlock, false);
            //         state.jobPositionIds = [];
            //         $$('.options-list input[type="checkbox"]', jobPositionBlock).forEach(cb => cb.checked = false);
            //         updateSection(jobPositionBlock);
            //     } else if (state.jobPositionIds.length > 0 && state.buIds.length === 0) {
            //         // Job positions selected first without BU - disable BU
            //         setEnabled(buBlock, false);
            //     } else if (hasHierarchyProgression) {
            //         // Hierarchy progression - enable job positions for filtering within hierarchy
            //         setEnabled(jobPositionBlock, true);
            //     } else {
            //         // Nothing selected or cleared - enable both
            //         setEnabled(buBlock, true);
            //         setEnabled(jobPositionBlock, true);
            //     }
            // }

            function updateFieldStates() {
                const buBlock = document.querySelector('[data-key="bu"]');
                const companyBlock = document.querySelector('[data-key="company"]');
                const departmentBlock = document.querySelector('[data-key="department"]');
                const jobPositionBlock = document.querySelector('[data-key="job_position"]');

                // Case 1: Job Position selected first (disables all hierarchy fields)
                if (state.jobPositionIds.length > 0 &&
                    state.buIds.length === 0 &&
                    state.companyIds.length === 0 &&
                    state.departmentIds.length === 0) {

                    setEnabled(buBlock, false);
                    setEnabled(companyBlock, false);
                    setEnabled(departmentBlock, false);
                    setEnabled(jobPositionBlock, true);
                    return;
                }

                // Case 2: Hierarchical flow
                if (state.buIds.length > 0) {
                    // BU selected
                    setEnabled(buBlock, true);
                    setEnabled(companyBlock, true);
                    setEnabled(departmentBlock, false);
                    setEnabled(jobPositionBlock, false);

                    if (state.companyIds.length > 0) {
                        // Company/Division selected
                        setEnabled(departmentBlock, true);

                        if (state.departmentIds.length > 0) {
                            // Department selected - enable Job Position
                            setEnabled(jobPositionBlock, true);
                        }
                    }
                } else {
                    // Initial state: No BU selected
                    setEnabled(buBlock, true);
                    setEnabled(companyBlock, false);
                    setEnabled(departmentBlock, false);
                    setEnabled(jobPositionBlock, true);
                }
            }

            // ---- Dropdown open/close (keeps your CSS/markup) ----
            document.addEventListener('click', (e) => {
                const box = e.target.closest('[data-select="box"]');
                if (box) {
                    const wrap = box.closest('.select-wrapper');
                    const dd = wrap.querySelector('.dropdown');
                    const isOpen = dd.style.display === 'block';
                    $$('.dropdown').forEach(x => x.style.display = 'none');
                    dd.style.display = isOpen ? 'none' : 'block';
                    return;
                }
                if (!e.target.closest('.dropdown')) $$('.dropdown').forEach(x => x.style.display = 'none');
            });

            // ---- Search within each dropdown ----
            $$('.search-box').forEach(inp => {
                inp.addEventListener('input', function() {
                    const term = this.value.toLowerCase();
                    $$('.options-list .checkbox-option', this.closest('.dropdown')).forEach(opt => {
                        opt.style.display = opt.innerText.toLowerCase().includes(term) ? '' :
                            'none';
                    });
                });
            });

            // ---- Helpers to update UI counts/labels/tags ----
            function updateSection(block) {
                if (!block) return;
                const sectionName = block.getAttribute('data-type');
                const label = block.querySelector('.selected-label');
                const countSpan = block.querySelector('.filter-count');
                const tags = block.querySelector('[data-tags]');
                const checked = $$('.options-list input[type="checkbox"]:checked', block);

                if (label) label.textContent = `${checked.length} ${sectionName}(s) selected`;
                if (countSpan) countSpan.textContent = `(${checked.length})`;

                if (tags) {
                    tags.innerHTML = '';
                    checked.forEach(cb => {
                        const chip = document.createElement('span');
                        chip.className = 'tag-custom-chips mr-1 d-flex align-items-center';
                        chip.textContent = cb.dataset.label;
                        const x = document.createElement('span');
                        x.className = 'cursor-pointer mt-1';
                        x.innerHTML = '<iconify-icon icon="maki:cross" width="12" height="12"></iconify-icon>';
                        x.onclick = () => {
                            cb.checked = false;
                            onApply(block);
                        };
                        chip.appendChild(x);
                        tags.appendChild(chip);
                    });
                }
            }

            function updateHeaderCount() {
                console.log('business unit counts', state.buIds.length);
                console.log('company unit counts', state.companyIds.length);
                console.log('department unit counts', state.departmentIds.length);
                console.log('jp unit counts', state.jobPositionIds.length);

                // const sectionsUsed = [
                //     state.buIds.length,
                //     state.companyIds.length,
                //     state.departmentIds.length,
                //     state.jobPositionIds.length
                // ].filter(n => n > 0).length;
                const sectionsUsed =
                    state.buIds.length +
                    state.companyIds.length +
                    state.departmentIds.length +
                    state.jobPositionIds.length;
                console.log(sectionsUsed);

                document.querySelectorAll('.total-filter-count').forEach(el => {
                    if (sectionsUsed > 0) {
                        el.textContent = `(${sectionsUsed})`;
                    } else {
                        el.textContent = '';
                    }
                });
            }

            // ---- Enable/disable dependent select-boxes ----
            function setEnabled(block, enabled) {
                if (!block) return;
                block.querySelector('[data-select="box"]')?.classList.toggle('disabled', !enabled);
            }


            async function loadJobPositions(departmentIds, term = '') {
                console.log('departmenidssss', departmentIds);
                const listEl = document.querySelector('[data-list="job_position"]');
                if (!listEl) return;

                listEl.innerHTML = '<div class="p-2 text-muted">Loading…</div>';
                try {
                    const res = await fetch(API.jobPosition, {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            department_ids: departmentIds,
                            q: term,
                            _token: '{{ csrf_token() }}'
                        })
                    });
                    if (!res.ok) throw new Error('Job Positions load failed');
                    const data = await res.json();
                    const items = Array.isArray(data) ? data : (data.data || []);
                    console.log('profiledata', items)
                    buildOptions(listEl, items, state.jobPositionIds);
                } catch (e) {
                    console.warn('Job Positions fetch failed:', e);
                    buildOptions(listEl, [], state.jobPositionIds);
                }
            }

            // ---- Apply/Reset per-section ----
            function onApply(block) {
                const key = block.dataset.key;
                const checked = $$('.options-list input[type="checkbox"]:checked', block).map(i => parseInt(i.value));

                if (key === 'bu') {
                    state.buIds = checked;
                    // Reset downstream
                    state.companyIds = [];
                    state.departmentIds = [];
                    loadCompanies(state.buIds);
                    buildOptions($('[data-list="department"]'), []);
                    // setEnabled(document.querySelector('[data-key="company"]'), state.buIds.length > 0);
                    // setEnabled(document.querySelector('[data-key="department"]'), false);
                    // Reset dependent UI
                    updateSection(document.querySelector('[data-key="company"]'));
                    updateSection(document.querySelector('[data-key="department"]'));
                    // updateHeaderCount();

                    // updateMutualExclusion();

                }

                if (key === 'company') {
                    state.companyIds = checked;
                    // Reset departments
                    state.departmentIds = [];
                    //const depts = state.companyIds.flatMap(id=> DUMMY.departmentsByCompany[id] || []);
                    //buildOptions($('[data-list="department"]'), depts);

                    loadDepartments(state.companyIds, state.buIds);
                    // setEnabled(document.querySelector('[data-key="department"]'), state.companyIds.length > 0);
                    // Reset department UI
                    updateSection(document.querySelector('[data-key="department"]'));
                    // updateHeaderCount();
                    // updateMutualExclusion();

                }

                // if (key === 'department') {
                //     state.departmentIds = checked;
                // }
                if (key === 'department') {
                    state.departmentIds = checked;
                    // Reset job positions
                 if (state.buIds.length > 0) {
                        state.jobPositionIds = [];
                        if (state.departmentIds.length > 0) {
                            loadJobPositions(state.departmentIds);
                        } else {
                            buildOptions($('[data-list="job_position"]'), []);
                        }
                        updateSection(document.querySelector('[data-key="job_position"]'));
                    }
                }

                if (key === 'job_position') {
                    state.jobPositionIds = checked;
                    // updateHeaderCount();
                    // updateMutualExclusion();

                }

                   updateSection(block);
                   updateHeaderCount();
                   updateFieldStates(); 
                // if (LEVELS_ENABLED) updateLevelCounts();
            }

           function onReset(block) {
    const key = block.dataset.key;
    $$('.options-list input[type="checkbox"]', block).forEach(cb => cb.checked = false);

    if (key === 'bu') {
        state.buIds = [];
        state.companyIds = [];
        state.departmentIds = [];
        // Don't reset job positions - they should remain independent
        buildOptions($('[data-list="company"]'), []);
        buildOptions($('[data-list="department"]'), []);
        
        // Reset dependent UI
        updateSection(document.querySelector('[data-key="company"]'));
        updateSection(document.querySelector('[data-key="department"]'));
    }
    
    if (key === 'company') {
        state.companyIds = [];
        state.departmentIds = [];
        buildOptions($('[data-list="department"]'), []);
        updateSection(document.querySelector('[data-key="department"]'));
    }
    
    if (key === 'department') {
        state.departmentIds = [];
        // Only reset job positions if we're in hierarchy mode
        if (state.buIds.length > 0) {
            state.jobPositionIds = [];
            buildOptions($('[data-list="job_position"]'), []);
            updateSection(document.querySelector('[data-key="job_position"]'));
        }
    }

    if (key === 'job_position') {
        state.jobPositionIds = [];
        // Clear the job position tags
        const tagsEl = block.querySelector('[data-tags]');
        if (tagsEl) tagsEl.innerHTML = '';
        // Reset the selected label
        const labelEl = block.querySelector('.selected-label');
        if (labelEl) labelEl.textContent = '0 Job Position(s) selected';
        // Reset the count
        const countEl = block.querySelector('.filter-count');
        if (countEl) countEl.textContent = '(0)';
        // Rebuild job position options to clear selections
        loadAllJobPositions();
        
        // Apply the cleared filters immediately
        apply();
    }

    updateSection(block);
    updateHeaderCount();
    updateFieldStates(); // Use the new function
}

            // Wire up Apply/Reset buttons per dropdown + per-section clear
            $$('.filter-block').forEach(block => {
                const dd = block.querySelector('.dropdown');
                dd?.addEventListener('click', (e) => {
                    const action = e.target.getAttribute('data-action');
                    if (action === 'apply') {
                        onApply(block);
                        dd.style.display = 'none';
                    }
                    if (action === 'reset') {
                        onReset(block);
                    }
                });
                block.querySelector('.section-clear')?.addEventListener('click', () => onReset(block));
            });

            // ===== Levels (guarded; no-op while commented) =====
            function renderLevels() {
                // if (!LEVELS_ENABLED) return;
                const top = document.querySelector('#levels-top');
                const more = document.querySelector('#levels-more');
                if (!top || !more) return;
                top.innerHTML = '';
                more.innerHTML = '';
                // (You can re-enable full rows when Levels block is un-commented)
            }

            function currentLevelCounts() {
                if (state.buIds.length === 1) {
                    return Object.assign({}, DUMMY.levelCounts.default, DUMMY.levelCounts.byBU[state.buIds[0]] || {});
                }
                return DUMMY.levelCounts.default;
            }

            function updateLevelCounts() {
                // if (!LEVELS_ENABLED) return;
                const counts = currentLevelCounts();
                $$('[data-level-count]').forEach(el => {
                    const lvl = el.getAttribute('data-level-count');
                    el.textContent = counts[lvl] || 0;
                });
            }

            // Level checkbox handler (guarded)

            // Global clear (header + footer)
            function clearAll() {
                // Uncheck all
                $$('input[type="checkbox"]').forEach(cb => cb.checked = false);

                // Reset state
                state.buIds = [];
                state.companyIds = [];
                state.departmentIds = [];
                state.jobPositionIds = [];
                state.levels = [];

                // Clear all option lists to initial state
                buildOptions($('[data-list="company"]'), []);
                buildOptions($('[data-list="department"]'), []);
                
                // Reset to initial field states - BU and Job Position enabled, others disabled
                setEnabled(document.querySelector('[data-key="bu"]'), true);
                setEnabled(document.querySelector('[data-key="company"]'), false);
                setEnabled(document.querySelector('[data-key="department"]'), false);
                setEnabled(document.querySelector('[data-key="job_position"]'), true);
                
                // Reset labels/counts/tags per section
                $$('.filter-block').forEach(block => {
                    const section = block.getAttribute('data-type');

                    const labelEl = block.querySelector('.selected-label');
                    if (labelEl) labelEl.textContent = `0 ${section}(s) selected`;

                    const countEl = block.querySelector('.filter-count');
                    if (countEl) countEl.textContent = '(0)';

                    const tagsEl = block.querySelector('[data-tags]');
                    if (tagsEl) tagsEl.innerHTML = '';
                });

                // Clear search inputs if they exist
                $$('.search-input input').forEach(input => {
                    if (input) input.value = '';
                });

                updateHeaderCount();
                updateFieldStates(); // Ensure field states are consistent
                if (typeof updateLevelCounts === 'function') updateLevelCounts();

                const out = document.getElementById('filters-json');
                if (out) out.textContent = '{}';

                // document.querySelectorAll('.total-filter-count').forEach(el => {
                //   el.textContent = '(0)';
                // });
                loadAllJobPositions();
                apply();
            }


            // document.getElementById('clear-filters-button')?.addEventListener('click', clearAll);
            document.getElementById('footer-clear')?.addEventListener('click', clearAll);
            document.querySelectorAll('.clear-filter').forEach(btn => btn.addEventListener('click', clearAll));

            function closeOffcanvas() {
                const el = document.getElementById('offcanvasRight');
                const inst = bootstrap?.Offcanvas?.getInstance(el) || bootstrap?.Offcanvas?.getOrCreateInstance(el);
                inst?.hide();
            }


            async function apply() {
                //  showOverlay(); 

                const payload = {
                    business_unit_ids: state.buIds,
                    company_ids: state.companyIds,
                    department_ids: state.departmentIds,
                    job_position_ids: state.jobPositionIds
                    // position_levels: state.levels,
                };
                const out = document.getElementById('filters-json');
                if (out) out.textContent = JSON.stringify(payload, null, 2);
                console.log('Apply Filters:', payload);

                if (window.technicalSkillsManager) {
                    window.technicalSkillsManager.updateOffcanvasFilters(payload);
                    // Reload technical skills with new filters
                    window.technicalSkillsManager.loadTechnicalSkills(1);
                }

                closeOffcanvas();

            }

            // Apply Filters -> JSON
            document.getElementById('apply-filters-button')?.addEventListener('click', async () => {
                await apply();
            });

            // Initial state
            // setEnabled(document.querySelector('[data-key="bu"]'), true);
            // setEnabled(document.querySelector('[data-key="company"]'), false);
            // setEnabled(document.querySelector('[data-key="department"]'), false);
            // setEnabled(document.querySelector('[data-key="job_position"]'), true);
            // Initial state - replace the existing initial state setup
            setEnabled(document.querySelector('[data-key="bu"]'), true);
            setEnabled(document.querySelector('[data-key="company"]'), false);
            setEnabled(document.querySelector('[data-key="department"]'), false);
            setEnabled(document.querySelector('[data-key="job_position"]'), true);

            // Call updateFieldStates to ensure consistent initial state
            updateFieldStates();
            // Guarded Levels calls
            // if (LEVELS_ENABLED) {
            //     renderLevels();
            //     updateLevelCounts();
            // }

            document.getElementById('filter-btn').addEventListener('click', (e) => {
                const offcanvasEl = document.getElementById('offcanvasRight');
                const bsOffcanvas = new bootstrap.Offcanvas(offcanvasEl);
                hideOverlay();
                bsOffcanvas.show();
            })

        })();
    </script>
@endpush
