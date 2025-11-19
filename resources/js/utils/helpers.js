// DOM Helper functions
export const $ = (selector, scope = document) => scope.querySelector(selector);
export const $$ = (selector, scope = document) => Array.from(scope.querySelectorAll(selector));

// Debounce function
export function debounce(fn, delay = 300) {
    let timeoutId;
    return (...args) => {
        clearTimeout(timeoutId);
        timeoutId = setTimeout(() => fn(...args), delay);
    };
}

// Build checkbox options
export function buildOptions(listEl, items, selectedIds = []) {
    if (!listEl) return;
    
    if (!items || !items.length) {
        listEl.innerHTML = '<div class="p-2 text-muted">No data available</div>';
        return;
    }
    
    listEl.innerHTML = items.map(item => `
        <label class="checkbox-option">
            <div class="w-100">
                <label class="custom-checkbox m-0">
                    <input type="checkbox" 
                           value="${item.id}" 
                           data-label="${item.name}"
                           ${selectedIds.includes(item.id) ? 'checked' : ''}>
                    <span class="checkmark"></span>
                    ${item.name}
                </label>
            </div>
        </label>
    `).join('');
}

// Enable/Disable filter blocks
export function setEnabled(block, enabled) {
    if (!block) return;
    const selectBox = block.querySelector('[data-select="box"]');
    selectBox?.classList.toggle('disabled', !enabled);
}

// Update section UI
export function updateSection(block) {
    if (!block) return;
    
    const sectionName = block.getAttribute('data-type');
    const key = block.getAttribute('data-key');
    
    // Handle special cases
    if (key === 'vacancy') {
        const vacancySelect = document.getElementById('vacancyStatus');
        const countSpan = block.querySelector('.filter-count');
        if (countSpan) {
            countSpan.textContent = vacancySelect?.value ? '(1)' : '(0)';
        }
        return;
    }
    
    if (key === 'levels') {
        const checkedLevels = document.querySelectorAll('.level-checkbox:checked');
        const countSpan = document.getElementById('total-filter-level-count');
        if (countSpan) {
            countSpan.textContent = `(${checkedLevels.length})`;
        }
        return;
    }
    
    if (key === 'assessment') {
        // Assessment filter handles its own tags and count display
        return;
    }
    
    // Handle regular filter blocks
    const label = block.querySelector('.selected-label');
    const countSpan = block.querySelector('.filter-count');
    const tags = block.querySelector('[data-tags]');
    const checked = block.querySelectorAll('.options-list input[type="checkbox"]:checked');
    
    if (label) {
        label.textContent = `${checked.length} ${sectionName}(s) selected`;
    }
    
    if (countSpan) {
        countSpan.textContent = `(${checked.length})`;
    }
    
    // Update tags
    if (tags) {
        tags.innerHTML = '';
        checked.forEach(cb => {
            const chip = document.createElement('span');
            chip.className = 'tag-custom-chips mr-1 d-flex align-items-center';
            chip.dataset.itemId = cb.value;
            
            // Add the label text
            const labelText = document.createTextNode(cb.dataset.label + ' ');
            chip.appendChild(labelText);
            
            // Create close button
            const closeBtn = document.createElement('span');
            closeBtn.className = 'tag-close-btn cursor-pointer mt-1 ms-1';
            closeBtn.style.cursor = 'pointer';
            closeBtn.dataset.itemId = cb.value;
            closeBtn.dataset.blockKey = key;
            closeBtn.innerHTML = '<iconify-icon icon="maki:cross" width="12" height="12"></iconify-icon>';
            
            chip.appendChild(closeBtn);
            tags.appendChild(chip);
        });
        
        // Attach event listener to the tags container using delegation
        tags.onclick = function(e) {
            if (e.target.closest('.tag-close-btn')) {
                e.stopPropagation();
                const closeBtn = e.target.closest('.tag-close-btn');
                const itemId = parseInt(closeBtn.dataset.itemId);
                
                // Uncheck the corresponding checkbox
                const checkbox = block.querySelector(`input[type="checkbox"][value="${itemId}"]`);
                if (checkbox) {
                    checkbox.checked = false;
                    
                    // Trigger single item removal if filter manager is available
                    if (window.orgChartFilter && window.orgChartFilter.filterManager) {
                        window.orgChartFilter.filterManager.onRemoveSingleItem(block, itemId);
                    } else {
                        // Fallback to updating just the section
                        updateSection(block);
                    }
                }
            }
        };
    }
}

// Update header count
export function updateHeaderCount(stateManager) {
    const state = stateManager.getState();
    const sectionsUsed = [
        state.buIds.length > 0,
        state.companyIds.length > 0,
        state.departmentIds.length > 0,
        state.levels.length > 0,
        state.vacancy_status !== '',
        state.assessmentFilters.length > 0
    ].filter(Boolean).length;
    
    document.querySelectorAll('.total-filter-count').forEach(el => {
        el.textContent = sectionsUsed > 0 ? `(${sectionsUsed})` : '';
    });
}

// Organization details loader
export function loadOrganizationDetails(data) {
    const detailsPanel = document.getElementById('detailsPanel');
    if (!detailsPanel) return;
    
    if (data) {
        detailsPanel.innerHTML = buildDetailsHTML(data);
        attachCollapseListener();
        
        // Show details panel
        const showBtn = document.getElementById('showDetailsBtn');
        // if (showBtn) showBtn.style.display = 'none';
        // detailsPanel.style.display = 'flex';
    } else {
        detailsPanel.innerHTML = '<div class="alert alert-danger">Failed to load data</div>';
    }
}

function buildDetailsHTML(data) {
    return `
        <div class="elements-chart-organization elements-chart-inner">
            <div class="d-flex justify-content-between mb-4 gap-2">
                <h4 data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${data.headerText}">${data.headerText}</h4>
                <p id="collapseBtn" class="m-0 d-flex align-items-center gap-1" type="button"
                    style="color: #F7941C; text-decoration-line: underline; cursor: pointer;">
                    <iconify-icon icon="f7:chevron-left-2" width="14" height="14"></iconify-icon> Collapse
                </p>
            </div>
            <div class="d-flex align-items-center gap-2">
                <div class="tags-elements d-flex align-items-center gap-1">
                    <img src="/admin/media/svg/org-chart-svg/department-chart.svg" alt="department">
                    <p class="m-0">${data.departments}</p>
                </div>
                <div class="tags-elements d-flex align-items-center gap-1">
                    <img src="/admin/media/svg/org-chart-svg/job-position-chart.svg" alt="job-position">
                    <p class="m-0">${data.jobPositions}</p>
                </div>
                <div class="tags-elements d-flex align-items-center gap-1">
                    <img src="/admin/media/svg/org-chart-svg/employee-chart.svg" alt="employee">
                    <p class="m-0">${data.employees}/${data.totalPositions}</p>
                </div>
                <div class="tags-elements d-flex align-items-center gap-1">
                    <img src="/admin/media/svg/org-chart-svg/vacancy-chart.svg" alt="vacancy">
                    <p class="m-0">${data.vacancies}</p>
                </div>
                <div class="tags-elements d-flex align-items-center gap-1">
                    <img src="/admin/media/svg/org-chart-svg/critical-job-position-chart.svg" alt="critical">
                    <p class="m-0">${data.criticalPositions}</p>
                </div>
            </div>
        </div>

        <div class="elements-chart-position elements-chart-inner">
            <div class="d-flex align-items-center justify-content-between">
                <h4 class="d-flex align-items-center gap-3 mb-4">Open Positions</h4>
            </div>
            <div class="row mb-3">
                <p class="m-0 col-8 heading">Job Position</p>
                <p class="col-4 m-0 text-center heading">Vacancy</p>
            </div>
            ${buildOpenPositionsHTML(data.openPositions)}
            ${data.openPositions && data.openPositions.length > 3 ? 
              '<a href="/admin/talent-acquisition/job-board" target="_blank"><p class="m-0 more-details-btn">More Details</p></a>' : ''}
        </div>
    `;
}

function buildOpenPositionsHTML(positions) {
    if (!positions || !positions.length) return '<p class="text-muted">No open positions</p>';
    
    return positions.map(position => {
        const titleLength = position.title ? position.title.length : 0;
        const displayTitle = titleLength > 30 ? position.title.substring(0, 30) + '...' : position.title;
        
        return `
            <div class="row mb-3">
                <div class="col-8">
                    <p class="m-0 content ${position.isCritical ? 'd-flex align-items-center gap-2' : ''}">
                        <span class="job-position-name" 
                              data-full-title="${position.title}" 
                              title="${position.title}">
                            ${displayTitle}
                        </span>
                        ${position.isCritical ? 
                          '<img src="/admin/media/svg/org-chart-svg/critical-job-position-chart.svg" alt="critical">' : ''}
                    </p>
                </div>
                <p class="col-4 m-0 content text-center">${position.vacancy}</p>
            </div>
        `;
    }).join('');
}

function attachCollapseListener() {
    const collapseBtn = document.getElementById('collapseBtn');
    const detailsPanel = document.getElementById('detailsPanel');
    const showBtn = document.getElementById('showDetailsBtn');
    
    if (collapseBtn) {
        collapseBtn.addEventListener('click', () => {
            if (detailsPanel) detailsPanel.style.display = 'none';
            if (showBtn) showBtn.style.display = 'flex';
        });
    }
}