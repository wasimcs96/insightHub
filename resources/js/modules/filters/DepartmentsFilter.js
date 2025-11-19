const { buildOptions } = require('../../utils/helpers');

export default class DepartmentsFilter {
    constructor(apiService, stateManager) {
        this.apiService = apiService;
        this.stateManager = stateManager;
        this.endpoint = '/admin/ajax/organization-chart-filter/departments';
        this.listElement = null;
        this.blockElement = null;
        this.currentItems = [];
    }

    init() {
        this.listElement = document.querySelector('[data-list="department"]');
        this.blockElement = document.querySelector('[data-key="department"]');
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

    async load(companyIds, buIds = [], searchTerm = '') {
        if (!this.listElement) return;

        this.listElement.innerHTML = '<div class="p-2 text-muted">Loading…</div>';

        try {
            const data = await this.apiService.post(this.endpoint, {
                company_ids: companyIds,
                bu_ids: buIds,
                q: searchTerm
            });
            
            this.currentItems = Array.isArray(data) ? data : (data.data || []);
            
            // Get current department selections - keep them if valid
            const currentDeptIds = this.stateManager.get('departmentIds');
            
            // Build options with existing valid selections preserved
            buildOptions(this.listElement, this.currentItems, currentDeptIds);
            
        } catch (error) {
            console.error('Failed to load departments:', error);
            buildOptions(this.listElement, [], []);
        }
    }

    handleSelection(selectedIds) {
        this.stateManager.update('departmentIds', selectedIds);
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
}