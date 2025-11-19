const { updateSection, updateHeaderCount, buildOptions } = require('../utils/helpers');

export default class FilterManager {
    constructor(filters, stateManager, apiService) {
        this.filters = filters;
        this.stateManager = stateManager;
        this.apiService = apiService;
        this.endpoint = '/admin/ajax/organization-chart-filter/headcount-codes';
    }

    init() {
        this.attachEventListeners();
    }

    attachEventListeners() {
        const self = this;
        
        // Handle dropdown clicks
        document.addEventListener('click', function(e) {
            self.handleDropdownClick(e);
        });
        
        // Handle filter blocks
        const filterBlocks = document.querySelectorAll('.filter-block');
        filterBlocks.forEach(function(block) {
            self.attachBlockHandlers(block);
        });

        // Listen for assessment filter changes (event bridge)
        window.addEventListener('assessmentFiltersUpdated', (e) => {
            try {
                console.log('FilterManager: received assessmentFiltersUpdated event', e.detail && e.detail.state ? { stateSnapshot: e.detail.state } : null);
                updateHeaderCount(this.stateManager);
            } catch (err) {
                console.warn('FilterManager: failed to update header count on assessmentFiltersUpdated', err);
            }
        });
        // Listen for vacancy status updates
        window.addEventListener('vacancyStatusUpdated', (e) => {
            try {
                console.log('FilterManager: received vacancyStatusUpdated event', e.detail && e.detail.state ? { stateSnapshot: e.detail.state } : null);
                updateHeaderCount(this.stateManager);
            } catch (err) {
                console.warn('FilterManager: failed to update header count on vacancyStatusUpdated', err);
            }
        });
        // Listen for position levels updates
        window.addEventListener('positionLevelsUpdated', (e) => {
            try {
                console.log('FilterManager: received positionLevelsUpdated event', e.detail && e.detail.state ? { stateSnapshot: e.detail.state } : null);
                updateHeaderCount(this.stateManager);
            } catch (err) {
                console.warn('FilterManager: failed to update header count on positionLevelsUpdated', err);
            }
        });

        // Clear all button
        const footerClear = document.getElementById('footer-clear');
        if (footerClear) {
            footerClear.addEventListener('click', function() {
                self.clearAll();
            });
        }

        // Apply filters button
        const applyButton = document.getElementById('apply-filters-button');
        if (applyButton) {
            applyButton.addEventListener('click', function() {
                self.applyFilters();
            });
        }

        // Section clear buttons
        const sectionClearButtons = document.querySelectorAll('.section-clear');
        sectionClearButtons.forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                const block = e.target.closest('.filter-block');
                if (block) {
                    self.onReset(block);
                }
            });
        });
    }

    handleDropdownClick(e) {
        const box = e.target.closest('[data-select="box"]');
        if (box) {
            // Don't open disabled dropdowns
            if (box.classList.contains('disabled')) {
                return;
            }
            
            const wrap = box.closest('.select-wrapper');
            const dropdown = wrap?.querySelector('.dropdown');
            if (!dropdown) return;
            
            const isOpen = dropdown.style.display === 'block';
            
            // Close all dropdowns
            const allDropdowns = document.querySelectorAll('.dropdown');
            allDropdowns.forEach(function(dd) {
                dd.style.display = 'none';
            });
            
            // Toggle current dropdown
            dropdown.style.display = isOpen ? 'none' : 'block';
            return;
        }
        
        // Close dropdowns when clicking outside
        if (!e.target.closest('.dropdown')) {
            const allDropdowns = document.querySelectorAll('.dropdown');
            allDropdowns.forEach(function(dd) {
                dd.style.display = 'none';
            });
        }
    }

    attachBlockHandlers(block) {
        const self = this;
        const dropdown = block.querySelector('.dropdown');
        const key = block.dataset.key;
        
        if (dropdown) {
            // Use a non-async handler so we can immediately close the dropdown
            // and then run the apply logic asynchronously. This ensures the
            // dropdown is hidden straight away and any dependent dropdowns
            // can enter their loading state without waiting for network calls.
            dropdown.addEventListener('click', function(e) {
                const action = e.target.getAttribute('data-action');
                if (action === 'apply') {
                    // Close current dropdown immediately for instant UX feedback
                    try {
                        dropdown.style.display = 'none';
                    } catch (err) {
                        // ignore
                    }

                    // Trigger apply asynchronously so loading placeholders
                    // from the child filters are visible immediately
                    self.onApply(block).catch(err => console.error('FilterManager: onApply error', err));
                    return;
                }
                if (action === 'reset') {
                    self.onResetDropdown(block);
                }
            });
        }

        // Search functionality
        const searchBox = block.querySelector('.search-box');
        if (searchBox) {
            searchBox.addEventListener('input', function(e) {
                const term = e.target.value.toLowerCase();
                const options = block.querySelectorAll('.options-list .checkbox-option');
                options.forEach(function(opt) {
                    const text = opt.innerText.toLowerCase();
                    opt.style.display = text.includes(term) ? '' : 'none';
                });
            });
        }
    }

    async onApply(block) {
        const key = block.dataset.key;
        
        switch (key) {
        case 'bu':
                const buIds = this.filters.businessUnits.getSelectedIds();
                
                // Update BU selection
                this.filters.businessUnits.handleSelection(buIds);

                // Immediately update BU UI (tags/count) so selection feedback is instant
                try { 
                    // update section directly and also allow filter module to refresh
                    updateSection(block); 
                    updateHeaderCount(this.stateManager);
                    if (this.filters.businessUnits && typeof this.filters.businessUnits.handleSelectionUpdateUI === 'function') {
                        this.filters.businessUnits.handleSelectionUpdateUI(buIds);
                    }
                } catch (err) { /* ignore */ }

                if (buIds.length === 0) {
                    // No BUs selected, must clear all dependent filters
            await this.cascadeResetFromBU();
                } else {
                    // Show loading state on companies immediately (department will load only after company selection)
                    this.showDependentLoading('company');

                    try {
                        // Load companies for new BU selection
                        await this.filters.companies.load(buIds);
                        
                        // Validate and preserve existing company selections
                        await this.validateCompanySelections(buIds);
                        
                        // Validate and preserve existing department selections
                        await this.validateDepartmentSelections();
                    } finally {
                        // Restore company trigger
                        this.hideDependentLoading('company');
                    }
                }
                
                await this.filters.positionLevels.load();
                break;
                
            case 'company':
                const companyIds = this.filters.companies.getSelectedIds();
                
                // Update company selection
                this.filters.companies.handleSelection(companyIds);
                // Immediately refresh company UI (tags/count) so selection feedback
                // is visible while dependent departments are loading.
                try {
                    if (this.filters.companies && typeof this.filters.companies.handleSelectionUpdateUI === 'function') {
                        this.filters.companies.handleSelectionUpdateUI(companyIds);
                    }
                } catch (err) { /* ignore */ }
                
                if (companyIds.length === 0) {
                    // No companies selected, clear departments
                    this.filters.departments.resetComplete();
                } else {
                    const buIds = this.stateManager.get('buIds');

                    // Show loading on department trigger immediately
                    this.showDependentLoading('department');
                    try {
                        await this.filters.departments.load(companyIds, buIds);
                        // Validate existing department selections
                        await this.validateDepartmentSelections();
                    } finally {
                        this.hideDependentLoading('department');
                    }
                }
                
                await this.filters.positionLevels.load();
                break;
                
            case 'department':
                const deptIds = this.filters.departments.getSelectedIds();
                this.filters.departments.handleSelection(deptIds);
                await this.filters.positionLevels.load();
                break;
                
            case 'assessment':
                // Assessment filter doesn't need special handling since it manages its own state
                // The filter tags are handled internally by AssessmentFilter
                break;
                
            case 'vacancy':
                // When vacancy status changes, reload position levels with new vacancy filter
                await this.filters.positionLevels.load();
                break;
        }
        
        updateSection(block);
        updateHeaderCount(this.stateManager);
    }

    showDependentLoading(key) {
        try {
            const block = document.querySelector(`[data-key="${key}"]`);
            if (!block) return;
            // Show loading inline in the select trigger so the dropdown does NOT open
            const box = block.querySelector('[data-select="box"]');
            if (box) {
                // Prefer .select-text (custom selects) but also support .selected-label (simple selects)
                const selText = box.querySelector('.select-text') || box.querySelector('.selected-label');
                if (selText) {
                    // Save original HTML so we can restore icons+text
                    if (!box.dataset.origHtml) box.dataset.origHtml = selText.innerHTML;
                    selText.innerHTML = '<span class="filter-loading-text">Loading…</span>';
                }
                // Visually indicate loading/disabled state
                box.classList.add('loading', 'disabled');
                box.setAttribute('aria-busy', 'true');
            } else {
                // Fallback: update the options list if trigger not found
                const list = block.querySelector('.options-list');
                if (list) {
                    list.dataset._wasLoading = '1';
                    list.innerHTML = '<div class="p-2 text-muted">Loading…</div>';
                }
            }
        } catch (err) {
            console.warn('FilterManager: showDependentLoading error', err);
        }
    }

    hideDependentLoading(key) {
        try {
            const block = document.querySelector(`[data-key="${key}"]`);
            if (!block) return;
            const box = block.querySelector('[data-select="box"]');
            if (box) {
                const selText = box.querySelector('.select-text') || box.querySelector('.selected-label');
                if (selText) {
                    const orig = box.dataset.origHtml;
                    if (orig) {
                        selText.innerHTML = orig;
                        delete box.dataset.origHtml;
                    }
                }
                box.classList.remove('loading');
                box.classList.remove('disabled');
                box.removeAttribute('aria-busy');
            } else {
                const list = block.querySelector('.options-list');
                if (list && list.dataset._wasLoading) {
                    // If we set a fallback loading marker, clear it
                    list.innerHTML = '';
                    delete list.dataset._wasLoading;
                }
            }
        } catch (err) {
            console.warn('FilterManager: hideDependentLoading error', err);
        }
    }

    async validateCompanySelections(validBuIds) {
        // Get currently selected companies
        const currentCompanyIds = this.stateManager.get('companyIds');
        
        if (currentCompanyIds.length === 0) {
            return; // Nothing to validate
        }
        
        try {
            // Fetch valid companies for the new BU selection
            const data = await this.apiService.post(
                '/admin/ajax/organization-chart-filter/company-division',
                { bu_ids: validBuIds }
            );
            
            const validCompanies = Array.isArray(data) ? data : (data.data || []);
            const validCompanyIds = validCompanies.map(c => c.id);
            
            // Keep only companies that are still valid
            const retainedCompanyIds = currentCompanyIds.filter(id => 
                validCompanyIds.includes(id)
            );
            
            // Update state only if some companies were removed
            if (retainedCompanyIds.length !== currentCompanyIds.length) {
                this.stateManager.update('companyIds', retainedCompanyIds);
                
                // Update the UI to reflect the change
                const companyBlock = document.querySelector('[data-key="company"]');
                if (companyBlock) {
                    // Re-check the valid checkboxes
                    const checkboxes = companyBlock.querySelectorAll('input[type="checkbox"]');
                    checkboxes.forEach(cb => {
                        const cbId = parseInt(cb.value);
                        cb.checked = retainedCompanyIds.includes(cbId);
                    });
                    updateSection(companyBlock);
                }
            }
        } catch (error) {
            console.error('Error validating company selections:', error);
        }
    }

    async validateDepartmentSelections() {
        const currentDeptIds = this.stateManager.get('departmentIds');
        const companyIds = this.stateManager.get('companyIds');
        const buIds = this.stateManager.get('buIds');
        
        if (currentDeptIds.length === 0 || companyIds.length === 0) {
            return; // Nothing to validate or no companies selected
        }
        
        try {
            // Fetch valid departments for current company selection
            const data = await this.apiService.post(
                '/admin/ajax/organization-chart-filter/departments',
                {
                    company_ids: companyIds,
                    bu_ids: buIds
                }
            );
            
            const validDepartments = Array.isArray(data) ? data : (data.data || []);
            const validDeptIds = validDepartments.map(d => d.id);
            
            // Keep only departments that are still valid
            const retainedDeptIds = currentDeptIds.filter(id => 
                validDeptIds.includes(id)
            );
            
            // Update state only if some departments were removed
            if (retainedDeptIds.length !== currentDeptIds.length) {
                this.stateManager.update('departmentIds', retainedDeptIds);
                
                // Update the UI
                const deptBlock = document.querySelector('[data-key="department"]');
                if (deptBlock) {
                    const checkboxes = deptBlock.querySelectorAll('input[type="checkbox"]');
                    checkboxes.forEach(cb => {
                        const cbId = parseInt(cb.value);
                        cb.checked = retainedDeptIds.includes(cbId);
                    });
                    updateSection(deptBlock);
                }
            }
        } catch (error) {
            console.error('Error validating department selections:', error);
        }
    }

    async cascadeResetFromBU() {
        // Reset companies
        this.filters.companies.resetSelections();
        this.filters.companies.clearItems();
        
        // Reset departments  
        this.filters.departments.resetComplete();
        
        // Update state
        this.stateManager.update('companyIds', []);
        this.stateManager.update('departmentIds', []);
        
        // Update UI for dependent filters
        const companyBlock = document.querySelector('[data-key="company"]');
        const deptBlock = document.querySelector('[data-key="department"]');
        
        if (companyBlock) updateSection(companyBlock);
        if (deptBlock) updateSection(deptBlock);
    }

    async onRemoveSingleItem(block, itemId) {
        const key = block.dataset.key;
        
        switch (key) {
            case 'company':
                // Get current selections
                const currentCompanyIds = this.stateManager.get('companyIds');
                
                // Remove the specific item
                const newCompanyIds = currentCompanyIds.filter(id => id !== itemId);
                
                // Update state without cascading
                this.stateManager.update('companyIds', newCompanyIds);
                
                // Only validate departments if needed
                if (newCompanyIds.length > 0) {
                    await this.validateDepartmentSelections();
                } else {
                    // No companies left, clear departments
                    this.filters.departments.resetComplete();
                    const deptBlock = document.querySelector('[data-key="department"]');
                    if (deptBlock) updateSection(deptBlock);
                }
                
                await this.filters.positionLevels.load();
                break;
                
            case 'bu':
                const currentBuIds = this.stateManager.get('buIds');
                const newBuIds = currentBuIds.filter(id => id !== itemId);
                
                this.stateManager.update('buIds', newBuIds);
                
                if (newBuIds.length === 0) {
                    await this.cascadeResetFromBU();
                } else {
                    // Reload and validate dependent selections
                    await this.filters.companies.load(newBuIds);
                    await this.validateCompanySelections(newBuIds);
                    await this.validateDepartmentSelections();
                }
                
                await this.filters.positionLevels.load();
                break;
                
            case 'department':
                const currentDeptIds = this.stateManager.get('departmentIds');
                const newDeptIds = currentDeptIds.filter(id => id !== itemId);
                
                this.stateManager.update('departmentIds', newDeptIds);
                await this.filters.positionLevels.load();
                break;
        }
        
        updateSection(block);
        updateHeaderCount(this.stateManager);
    }

    onResetDropdown(block) {
        // Only reset selections in the dropdown, don't remove items
        const checkboxes = block.querySelectorAll('.options-list input[type="checkbox"]');
        checkboxes.forEach(cb => cb.checked = false);
        
        // Clear search box if exists
        const searchBox = block.querySelector('.search-box');
        if (searchBox) searchBox.value = '';
        
        // Show all options (in case some were hidden by search)
        const options = block.querySelectorAll('.options-list .checkbox-option');
        options.forEach(opt => opt.style.display = '');
    }

    onReset(block) {
        const key = block.dataset.key;
        
        switch (key) {
            case 'bu':
                this.filters.businessUnits.resetSelections();
                this.cascadeResetFromBU();
                break;
                
            case 'company':
                this.filters.companies.resetSelections();
                // Only reset departments, don't touch BU
                this.filters.departments.resetComplete();
                const deptBlock = document.querySelector('[data-key="department"]');
                if (deptBlock) updateSection(deptBlock);
                break;
                
            case 'department':
                this.filters.departments.resetSelections();
                break;
                
            case 'vacancy':
                this.filters.vacancyStatus.reset();
                break;
                
            case 'levels':
                this.filters.positionLevels.reset();
                break;
                
            case 'assessment':
                this.filters.assessment.reset();
                break;
        }
        
        updateSection(block);
        updateHeaderCount(this.stateManager);
        
        if (['bu', 'company', 'department'].includes(key)) {
            this.filters.positionLevels.load();
        }
    }

    clearAll() {
        // Reset all filter selections without removing items
        this.filters.businessUnits.resetSelections();
        this.filters.companies.resetSelections();
        this.filters.departments.resetSelections();
        this.filters.positionLevels.reset();
        this.filters.vacancyStatus.reset();
        // Assessment filter may be hidden or not initialized; clear state defensively
        try {
            if (this.filters.assessment && typeof this.filters.assessment.reset === 'function') {
                this.filters.assessment.reset();
            } else if (this.stateManager) {
                this.stateManager.update('assessmentFilters', []);
                // Emit legacy event for compatibility
                try { window.dispatchEvent(new CustomEvent('assessmentFiltersUpdated', { detail: { state: this.stateManager.getState() } })); } catch (e) {}
            }
        } catch (err) {
            console.warn('FilterManager.clearAll: failed to reset assessment filter module', err);
            if (this.stateManager) {
                this.stateManager.update('assessmentFilters', []);
            }
        }
        
        // Clear dependent filter items
        this.filters.companies.clearItems();
        this.filters.departments.clearItems();
        
        // Clear all UI sections
        const self = this;
        const filterBlocks = document.querySelectorAll('.filter-block');
        filterBlocks.forEach(function(block) {
            updateSection(block);
        });
        
        updateHeaderCount(this.stateManager);
        
        // Apply with empty filters
        this.applyFilters();
    }

    async applyFilters() {
        if (typeof showOverlay === 'function') showOverlay();
        
        const payload = this.stateManager.getPayload();
        
        // Update filters JSON display if exists
        const jsonDisplay = document.getElementById('filters-json');
        if (jsonDisplay) {
            jsonDisplay.textContent = JSON.stringify(payload, null, 2);
        }
        
        console.log('Applying filters:', payload);
        
        try {
            const data = await this.apiService.post(this.endpoint, payload);
            
            // Update global request data if available
            if (typeof requestData !== 'undefined') {
                requestData.selectedHeadcountCodes = data.headcount_codes;
                requestData.assessmentFilters = data.assessment_filters;
                requestData.assessment_matches = data.assessment_matches;
            }
            
            // Load organization details if available
            if (data.organizationData && typeof loadOrganizationDetails === 'function') {
                loadOrganizationDetails(data.organizationData);
            }
            
            // Update position levels
            if (data.positionLevels) {
                this.filters.positionLevels.updateLevelCounts(data.positionLevels);
            }
            
            // Handle org chart rendering if functions exist
            if (typeof isEditMode !== 'undefined' && typeof renderOrgChart === 'function') {
                if (!isEditMode && typeof originalOrgChart !== 'undefined') {
                    await renderOrgChart(originalOrgChart);
                } else if (typeof editedOrgChart !== 'undefined') {
                    await renderOrgChart(editedOrgChart);
                }
            }
            
            // Reveal path and focus if function exists
            if (typeof revealPathAndFocusMultiple === 'function' && data.headcount_codes) {
                await revealPathAndFocusMultiple(data.headcount_codes);
            }
            
            // Close offcanvas
            this.closeOffcanvas();
            
        } catch (error) {
            console.error('Apply filters error:', error);
        } finally {
            if (typeof hideOverlay === 'function') hideOverlay();
        }
    }

    closeOffcanvas() {
        const offcanvasEl = document.getElementById('offcanvasRight');
        if (offcanvasEl && window.bootstrap) {
            const inst = window.bootstrap.Offcanvas.getInstance(offcanvasEl) || 
                         window.bootstrap.Offcanvas.getOrCreateInstance(offcanvasEl);
            inst?.hide();
        }
    }
}