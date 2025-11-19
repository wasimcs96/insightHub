const { buildOptions, setEnabled, updateSection, updateHeaderCount } = require('../../utils/helpers');

export default class BusinessUnitsFilter {
    constructor(apiService, stateManager) {
        this.apiService = apiService;
        this.stateManager = stateManager;
        this.endpoint = '/admin/ajax/organization-chart-filter/business-unit';
        this.listElement = null;
        this.blockElement = null;
        this.currentItems = [];
    }

    init() {
        this.listElement = document.querySelector('[data-list="bu"]');
        this.blockElement = document.querySelector('[data-key="bu"]');
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

    async load(searchTerm = '') {
        if (!this.listElement) return;

        this.listElement.innerHTML = '<div class="p-2 text-muted">Loading…</div>';

        try {
            const params = searchTerm ? { q: searchTerm } : {};
            const data = await this.apiService.get(this.endpoint, params);
            this.currentItems = data.data || [];
            buildOptions(this.listElement, this.currentItems, this.stateManager.get('buIds'));
        } catch (error) {
            console.error('Failed to load business units:', error);
            this.listElement.innerHTML = '<div class="p-2 text-danger">Failed to load data</div>';
        }
    }

    handleSelection(selectedIds) {
        this.stateManager.update('buIds', selectedIds);
        
        // Enable/disable dependent filters
        const companyBlock = document.querySelector('[data-key="company"]');
        const deptBlock = document.querySelector('[data-key="department"]');
        
        setEnabled(companyBlock, selectedIds.length > 0);
        
        // Department block stays enabled if companies are selected
        const companyIds = this.stateManager.get('companyIds');
        setEnabled(deptBlock, companyIds.length > 0);
    }

    // Ensure UI reflects selection immediately
    handleSelectionUpdateUI(selectedIds) {
        try {
            if (this.blockElement) {
                updateSection(this.blockElement);
                updateHeaderCount(this.stateManager);
            }
        } catch (err) {
            console.warn('BusinessUnitsFilter: failed to update UI', err);
        }
    }

    getSelectedIds() {
        const checkboxes = this.listElement?.querySelectorAll('input[type="checkbox"]:checked');
        return Array.from(checkboxes || []).map(cb => parseInt(cb.value));
    }

    resetSelections() {
        // Only uncheck boxes, don't remove items
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

    reset() {
        this.resetSelections();
        this.currentItems = [];
    }
}