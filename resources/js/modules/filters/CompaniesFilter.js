const { buildOptions, setEnabled, updateSection, updateHeaderCount } = require('../../utils/helpers');

export default class CompaniesFilter {
    constructor(apiService, stateManager) {
        this.apiService = apiService;
        this.stateManager = stateManager;
        this.endpoint = '/admin/ajax/organization-chart-filter/company-division';
        this.listElement = null;
        this.blockElement = null;
        this.currentItems = [];
    }

    init() {
        this.listElement = document.querySelector('[data-list="company"]');
        this.blockElement = document.querySelector('[data-key="company"]');
        this.attachSearchHandler();
    }

    attachSearchHandler() {
        const searchBox = this.blockElement?.querySelector('.search-box');
        if (searchBox) {
            searchBox.addEventListener('input', (e) => {
                this.filterItems(e.target.value);
            });
        }
    }

    filterItems(searchTerm) {
        const term = searchTerm.toLowerCase();
        const options = this.listElement?.querySelectorAll('.checkbox-option');
        options?.forEach(opt => {
            const text = opt.innerText.toLowerCase();
            opt.style.display = text.includes(term) ? '' : 'none';
        });
    }

    async load(buIds, searchTerm = '') {
        if (!this.listElement) return;

        this.listElement.innerHTML = '<div class="p-2 text-muted">Loading…</div>';

        try {
            const data = await this.apiService.post(this.endpoint, {
                bu_ids: buIds,
                q: searchTerm
            });
            
            this.currentItems = Array.isArray(data) ? data : (data.data || []);
            
            // Get current company selections - keep them if valid
            const currentCompanyIds = this.stateManager.get('companyIds');
            
            // Build options with existing valid selections preserved
            buildOptions(this.listElement, this.currentItems, currentCompanyIds);
            
        } catch (error) {
            console.error('Failed to load companies:', error);
            buildOptions(this.listElement, [], []);
        }
    }

    handleSelection(selectedIds) {
        this.stateManager.update('companyIds', selectedIds);
        
        // Enable/disable department filter
        const deptBlock = document.querySelector('[data-key="department"]');
        setEnabled(deptBlock, selectedIds.length > 0);
    }

    getSelectedIds() {
        const checkboxes = this.listElement?.querySelectorAll('input[type="checkbox"]:checked');
        return Array.from(checkboxes || []).map(cb => parseInt(cb.value));
    }

    resetSelections() {
        // Only uncheck boxes, keep items
        const checkboxes = this.listElement?.querySelectorAll('input[type="checkbox"]');
        if (checkboxes) {
            checkboxes.forEach(cb => cb.checked = false);
        }
        
        // Clear search box
        const searchBox = this.blockElement?.querySelector('.search-box');
        if (searchBox) searchBox.value = '';
        
        // Show all options
        const options = this.listElement?.querySelectorAll('.checkbox-option');
        options?.forEach(opt => opt.style.display = '');
        
        this.handleSelection([]);
    }

    clearItems() {
        if (this.listElement) {
            buildOptions(this.listElement, [], []);
        }
        this.currentItems = [];
    }

    resetComplete() {
        this.resetSelections();
        this.clearItems();
    }

    reset() {
        this.resetComplete();
    }

    // Allow immediate UI refresh for company selection so tags/counts update
    // without waiting for dependent (department) network loads.
    handleSelectionUpdateUI(selectedIds) {
        try {
            if (!this.blockElement) this.blockElement = document.querySelector('[data-key="company"]');
            if (this.blockElement) updateSection(this.blockElement);
            if (this.stateManager) updateHeaderCount(this.stateManager);
        } catch (err) {
            // ignore
        }
    }
}