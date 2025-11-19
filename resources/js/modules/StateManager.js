export default class StateManager {
    constructor() {
        this.state = {
            buIds: [],
            companyIds: [],
            departmentIds: [],
            levels: [],
            vacancy_status: '',
            user_id: null,
            selectedHeadcountCodes: [],
            assessmentFilters: [],
            // Allow pages to opt-in to edit-mode via a global config
            isEditMode: (window?.orgChartConfig?.isEditMode) || (window?.isEditMode) || false
        };
        
        // Make state globally accessible if needed
        window.filterState = this.state;
    }

    update(key, value) {
        this.state[key] = value;
        this.notifyChange(key);
    }

    updateMultiple(updates) {
        Object.keys(updates).forEach(key => {
            this.state[key] = updates[key];
        });
        this.notifyChange('multiple');
    }

    get(key) {
        return this.state[key];
    }

    getState() {
        return { ...this.state };
    }

    notifyChange(key) {
        // Create custom event for IE11 compatibility
        const event = document.createEvent('CustomEvent');
        event.initCustomEvent('filterStateChanged', true, true, {
            key,
            state: this.state
        });
        window.dispatchEvent(event);
        // If assessment filters changed, also emit assessmentFiltersUpdated for backward compatibility
        if (key === 'assessmentFilters') {
            try {
                console.log('StateManager: dispatching assessmentFiltersUpdated via notifyChange', { assessmentFilters: this.state.assessmentFilters });
                window.dispatchEvent(new CustomEvent('assessmentFiltersUpdated', { detail: { state: this.getState() } }));
            } catch (err) {
                console.warn('StateManager: failed to dispatch assessmentFiltersUpdated', err);
            }
        }
        // Emit event when isEditMode changes so other modules can lazily initialize
        if (key === 'isEditMode') {
            try {
                window.dispatchEvent(new CustomEvent('isEditModeUpdated', { detail: { isEditMode: this.state.isEditMode } }));
                console.log('StateManager: dispatched isEditModeUpdated', this.state.isEditMode);
            } catch (err) {
                console.warn('StateManager: failed to dispatch isEditModeUpdated', err);
            }
        }
    }

    reset() {
        // preserve isEditMode when resetting filters so UI mode isn't lost
        const preserveIsEdit = this.get('isEditMode') || false;
        this.state = {
            buIds: [],
            companyIds: [],
            departmentIds: [],
            levels: [],
            vacancy_status: '',
            user_id: null,
            selectedHeadcountCodes: [],
            assessmentFilters: [],
            isEditMode: preserveIsEdit
        };
        this.notifyChange('reset');
    }

    getPayload() {
        return {
            business_unit_ids: this.state.buIds,
            company_ids: this.state.companyIds,
            department_ids: this.state.departmentIds,
            position_levels: this.state.levels,
            vacancy_status: this.state.vacancy_status,
            user_id: this.state.user_id,
            assessment_filters: this.state.assessmentFilters
        };
    }
}