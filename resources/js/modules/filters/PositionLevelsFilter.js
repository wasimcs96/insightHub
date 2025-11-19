export default class PositionLevelsFilter {
    constructor(apiService, stateManager) {
        this.apiService = apiService;
        this.stateManager = stateManager;
        this.endpoint = '/admin/ajax/organization-chart-filter/position-levels';
        this.containerElement = null;
        this.showMoreBtn = null;
        this.isShowingAll = false;
    }

    init() {
        this.containerElement = document.getElementById('position-levels-container');
        this.initShowMoreButton();
        this.attachCheckboxHandlers();
    }

    initShowMoreButton() {
        const showMoreWrapper = document.getElementById('show-more-levels');
        if (!showMoreWrapper) return;

        this.showMoreBtn = showMoreWrapper.querySelector('.show-more-btn');
        if (!this.showMoreBtn) return;

        this.showMoreBtn.addEventListener('click', () => {
            this.toggleShowMore();
        });
    }

    toggleShowMore() {
        const items = document.querySelectorAll('.position-level-item');
        const hiddenItems = Array.from(items).slice(5);

        if (!this.isShowingAll) {
            hiddenItems.forEach(el => {
                el.style.removeProperty('display');
                el.style.setProperty('display', 'flex', 'important');
            });
            this.showMoreBtn.textContent = 'Show Less';
            this.isShowingAll = true;
        } else {
            hiddenItems.forEach(el => {
                el.style.removeProperty('display');
                el.style.setProperty('display', 'none', 'important');
            });
            this.showMoreBtn.textContent = 'Show More';
            this.isShowingAll = false;
        }
    }

    attachCheckboxHandlers() {
        const self = this;
        document.addEventListener('change', function(e) {
            if (e.target.classList.contains('level-checkbox')) {
                self.handleCheckboxChange();
            }
        });
    }

    handleCheckboxChange() {
        const checkedLevels = document.querySelectorAll('.level-checkbox:checked');
        const levels = Array.from(checkedLevels).map(cb => cb.value);
        this.stateManager.update('levels', levels);
        this.updateCount();
        // Notify header count update and other listeners
        try {
            if (window.updateHeaderCount) {
                window.updateHeaderCount(this.stateManager);
            }
        } catch (err) {
            console.warn('PositionLevelsFilter: updateHeaderCount direct call failed', err);
        }
        try {
            console.log('PositionLevelsFilter: dispatching positionLevelsUpdated', { levels });
            window.dispatchEvent(new CustomEvent('positionLevelsUpdated', { detail: { state: this.stateManager.getState() } }));
        } catch (err) {
            console.warn('PositionLevelsFilter: failed to dispatch positionLevelsUpdated', err);
        }
    }

    updateCount() {
        const countSpan = document.getElementById('total-filter-level-count');
        if (countSpan) {
            const levels = this.stateManager.get('levels');
            countSpan.textContent = '(' + levels.length + ')';
        }
    }

    async loadDefaults() {
        try {
            const payload = this.stateManager.getPayload();
            const data = await this.apiService.post(this.endpoint, payload);
            this.updateLevelCounts(data.levels || []);
        } catch (error) {
            console.error('Position levels fetch failed:', error);
            this.updateLevelCounts([]);
        }
    }

    async load() {
        try {
            const payload = this.stateManager.getPayload();
            const data = await this.apiService.post(this.endpoint, payload);
            this.updateLevelCounts(data.levels || []);
        } catch (error) {
            console.error('Position levels fetch failed:', error);
            this.updateLevelCounts([]);
        }
    }

    updateLevelCounts(levelData) {
        // Reset all counts to 0 first
        const countElements = document.querySelectorAll('[data-level-count]');
        countElements.forEach(function(element) {
            element.textContent = '0';
        });
        
        // Update with actual data
        if (levelData && Array.isArray(levelData)) {
            levelData.forEach(function(level) {
                const levelNumber = level.level || level.levelNumber || level.id;
                const levelCount = level.count || level.total_count || 0;
                
                const countElement = document.querySelector('[data-level-count="' + levelNumber + '"]');
                if (countElement) {
                    countElement.textContent = levelCount;
                }
            });
        }
    }

    reset() {
        const checkboxes = document.querySelectorAll('.level-checkbox');
        checkboxes.forEach(cb => cb.checked = false);
        this.stateManager.update('levels', []);
        this.updateCount();
        this.resetShowMore();
    }

    resetShowMore() {
        const items = document.querySelectorAll('.position-level-item');
        items.forEach(function(el, i) {
            if (i < 5) {
                el.style.removeProperty('display');
                el.style.setProperty('display', 'flex', 'important');
            } else {
                el.style.removeProperty('display');
                el.style.setProperty('display', 'none', 'important');
            }
        });

        if (this.showMoreBtn) {
            this.showMoreBtn.textContent = 'Show More';
            this.isShowingAll = false;
        }
    }
}