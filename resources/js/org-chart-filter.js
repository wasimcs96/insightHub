// Use require instead of import for Laravel Mix compatibility
const ApiService = require('./modules/ApiService').default;
const StateManager = require('./modules/StateManager').default;
const BusinessUnitsFilter = require('./modules/filters/BusinessUnitsFilter').default;
const CompaniesFilter = require('./modules/filters/CompaniesFilter').default;
const DepartmentsFilter = require('./modules/filters/DepartmentsFilter').default;
const PositionLevelsFilter = require('./modules/filters/PositionLevelsFilter').default;
const VacancyStatusFilter = require('./modules/filters/VacancyStatusFilter').default;
const AssessmentFilter = require('./modules/filters/AssessmentFilter').default;
const UserSearch = require('./modules/search/UserSearch').default;
const FilterManager = require('./modules/FilterManager').default;
const { setEnabled, loadOrganizationDetails, updateHeaderCount } = require('./utils/helpers');

class OrgChartFilter {
    constructor() {
        // Initialize core services
        this.apiService = new ApiService();
        this.stateManager = new StateManager();
        
        // Initialize filters
        this.filters = {
            businessUnits: new BusinessUnitsFilter(this.apiService, this.stateManager),
            companies: new CompaniesFilter(this.apiService, this.stateManager),
            departments: new DepartmentsFilter(this.apiService, this.stateManager),
            positionLevels: new PositionLevelsFilter(this.apiService, this.stateManager),
            vacancyStatus: null, // Will be initialized after positionLevels
            assessment: new AssessmentFilter(this.apiService, this.stateManager)
        };
        
        // Initialize vacancy status filter with position levels reference
        this.filters.vacancyStatus = new VacancyStatusFilter(
            this.apiService, 
            this.stateManager, 
            this.filters.positionLevels
        );
        
        // Initialize search
        this.userSearch = new UserSearch(this.apiService, this.stateManager);
        
        // Initialize filter manager
        this.filterManager = new FilterManager(this.filters, this.stateManager, this.apiService);
        
        // Initialize everything
        this.init();
    }

    async init() {
        console.log('Initializing Org Chart Filter...');
        
        // Initialize all modules
        Object.values(this.filters).forEach(filter => {
            if (typeof filter.init === 'function') {
                filter.init();
            }
        });
        
        this.userSearch.init();
        this.filterManager.init();

        // If page is already in edit mode, ensure assessment block is visible and initialized
        try {
            const isEdit = this.stateManager.get('isEditMode');
            console.log('OrgChartFilter: startup isEditMode=', isEdit);
            if (isEdit) {
                const block = document.querySelector('[data-key="assessment"]');
                if (block) {
                    block.removeAttribute('hidden');
                    block.classList.remove('d-none', 'hidden', 'visually-hidden');
                    block.style.removeProperty('display');
                }

                if (!this.filters.assessment) {
                    this.filters.assessment = new AssessmentFilter(this.apiService, this.stateManager);
                }
                if (this.filters.assessment && typeof this.filters.assessment.init === 'function') {
                    await this.filters.assessment.init();
                }
            }
        } catch (err) {
            console.warn('OrgChartFilter: failed to initialize assessment on startup', err);
        }
        
        // Load initial data
        await this.loadInitialData();
        
        // Setup initial state
        this.setupInitialState();
        
        // Attach global event listeners
        this.attachGlobalEventListeners();
        
        // Make available globally for external access
        window.orgChartFilter = this;
        window.loadOrganizationDetails = loadOrganizationDetails;
        
        console.log('Org Chart Filter initialized successfully');
    }

    async loadInitialData() {
        try {
            // Load business units
            await this.filters.businessUnits.load();
            
            // Load default position levels
            await this.filters.positionLevels.loadDefaults();
        } catch (error) {
            console.error('Error loading initial data:', error);
        }
    }

    setupInitialState() {
        // Disable company and department filters initially
        const companyBlock = document.querySelector('[data-key="company"]');
        const deptBlock = document.querySelector('[data-key="department"]');
        
        setEnabled(companyBlock, false);
        setEnabled(deptBlock, false);
        
        // Initialize details panel
        const showBtn = document.getElementById('showDetailsBtn');
        const detailsPanel = document.getElementById('detailsPanel');
        
        if (showBtn) showBtn.style.display = 'flex';
        if (detailsPanel) detailsPanel.style.display = 'none';
    }

    attachGlobalEventListeners() {
        // Filter button (open offcanvas)
        const filterBtn = document.getElementById('filter-btn');
        if (filterBtn) {
            filterBtn.addEventListener('click', () => {
                const offcanvasEl = document.getElementById('offcanvasRight');
                if (offcanvasEl && window.bootstrap) {
                    const bsOffcanvas = new window.bootstrap.Offcanvas(offcanvasEl);
                    if (typeof hideOverlay === 'function') hideOverlay();
                    bsOffcanvas.show();
                }
            });
        }

        // Show details button
        const showDetailsBtn = document.getElementById('showDetailsBtn');
        if (showDetailsBtn) {
            showDetailsBtn.addEventListener('click', async () => {
                const detailsPanel = document.getElementById('detailsPanel');

                // If the details panel is empty, run applyFilters() first to populate data
                try {
                    const isEmpty = !detailsPanel || !detailsPanel.innerHTML || detailsPanel.innerHTML.trim() === '';
                    if (isEmpty && typeof this.applyFilters === 'function') {
                        // show a spinner while loading
                        if (detailsPanel) {
                            detailsPanel.innerHTML = '<div class="p-4 text-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>';
                            detailsPanel.style.display = 'flex';
                        }

                        await this.applyFilters();
                        // applyFilters will call loadOrganizationDetails if data returned; if not, keep whatever it returned
                    }
                } catch (err) {
                    console.warn('OrgChartFilter: applyFilters before showing details failed', err);
                    // fallthrough to show panel even if apply failed
                }

                if (showDetailsBtn) showDetailsBtn.style.display = 'none';
                if (detailsPanel) detailsPanel.style.display = 'flex';
            });
        }

        // Edit Structure button: enable edit mode and show assessment filter
        const editBtn = document.getElementById('editStructureBtn');
        if (editBtn) {
            editBtn.addEventListener('click', async (e) => {
                try {
                    // Update state
                    if (this.stateManager && typeof this.stateManager.update === 'function') {
                        this.stateManager.update('isEditMode', true);
                        console.log('OrgChartFilter: isEditMode set to true via Edit button');
                    } else {
                        window.isEditMode = true;
                    }

                    // Clear all filters when entering edit mode
                    try {
                        if (this.filterManager && typeof this.filterManager.clearAll === 'function') {
                            this.filterManager.clearAll();
                        }
                    } catch (err) {
                        console.warn('OrgChartFilter: failed to clear filters on edit', err);
                    }

                    // Safely show assessment block (avoid forcing ancestors or using !important)
                    // As part of enabling edit-mode, ensure the assessment block is hidden (edit mode shouldn't show assessment filters)
                    const block = document.querySelector('[data-key="assessment"]');
                    if (block) {
                        block.classList.add('d-none');
                        block.setAttribute('hidden', 'true');
                        // remove any inline display so CSS governs layout
                        block.style.removeProperty('display');
                    }

                    // Ensure AssessmentFilter instance exists and initialize it once
                    if (!this.filters) this.filters = {};
                    if (!this.filters.assessment) {
                        this.filters.assessment = new AssessmentFilter(this.apiService, this.stateManager);
                        try {
                            if (typeof this.filters.assessment.init === 'function') {
                                await this.filters.assessment.init();
                            }
                        } catch (initErr) {
                            console.warn('OrgChartFilter: assessment.init() failed', initErr);
                        }
                    }

                    // Refresh header counts/UI without re-initializing FilterManager
                    try {
                        updateHeaderCount(this.stateManager);
                    } catch (uhcErr) {
                        console.warn('OrgChartFilter: updateHeaderCount failed', uhcErr);
                    }
                } catch (err) {
                    console.warn('OrgChartFilter: failed to enable edit mode via Edit button', err);
                }
            });
        }

        // Listen for state changes
        window.addEventListener('filterStateChanged', (e) => {
            console.log('Filter state changed:', e.detail.state);
        });
    }

    // Public methods for external access
    getState() {
        return this.stateManager.getState();
    }

    async applyFilters() {
        return this.filterManager.applyFilters();
    }

    clearAll() {
        return this.filterManager.clearAll();
    }
}

// Initialize when DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => {
        new OrgChartFilter();
    });
} else {
    // DOM is already loaded
    new OrgChartFilter();
}