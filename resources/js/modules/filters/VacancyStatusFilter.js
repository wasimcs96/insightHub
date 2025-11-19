export default class VacancyStatusFilter {
    constructor(apiService, stateManager, positionLevelsFilter = null) {
        this.apiService = apiService;
        this.stateManager = stateManager;
        this.positionLevelsFilter = positionLevelsFilter;
        this.selectElement = null;
        this.blockElement = null;
    }

    init() {
        this.selectElement = document.getElementById('vacancyStatus');
        this.blockElement = document.querySelector('[data-key="vacancy"]');
        this.attachChangeHandler();
    }

    attachChangeHandler() {
        const self = this;
        if (this.selectElement) {
            this.selectElement.addEventListener('change', function(e) {
                self.handleChange(e.target.value);
            });
        }
    }

    handleChange(value) {
        this.stateManager.update('vacancy_status', value);
        this.updateCount();
        // Update header count directly and dispatch event for other listeners
        try {
            if (window.updateHeaderCount) {
                window.updateHeaderCount(this.stateManager);
            }
        } catch (err) {
            console.warn('VacancyStatusFilter: updateHeaderCount direct call failed', err);
        }
        try {
            window.dispatchEvent(new CustomEvent('vacancyStatusUpdated', { detail: { state: this.stateManager.getState() } }));
        } catch (err) {
            console.warn('VacancyStatusFilter: failed to dispatch vacancyStatusUpdated', err);
        }
        
        // Trigger position levels to reload with new vacancy filter
        if (this.positionLevelsFilter) {
            this.positionLevelsFilter.load();
        }
    }

    updateCount() {
        const countSpan = this.blockElement?.querySelector('.filter-count');
        if (countSpan) {
            const status = this.stateManager.get('vacancy_status');
            countSpan.textContent = status ? '(1)' : '(0)';
        }
    }

    reset() {
        if (this.selectElement) {
            this.selectElement.value = '';
        }
        this.stateManager.update('vacancy_status', '');
        this.updateCount();
        try {
            if (window.updateHeaderCount) {
                window.updateHeaderCount(this.stateManager);
            }
        } catch (err) {
            console.warn('VacancyStatusFilter: updateHeaderCount direct call failed', err);
        }
        try {
            window.dispatchEvent(new CustomEvent('vacancyStatusUpdated', { detail: { state: this.stateManager.getState() } }));
        } catch (err) {
            console.warn('VacancyStatusFilter: failed to dispatch vacancyStatusUpdated', err);
        }
    }

    getValue() {
        return this.selectElement?.value || '';
    }
}