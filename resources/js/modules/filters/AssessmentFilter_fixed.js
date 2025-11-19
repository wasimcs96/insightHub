const MAX_FILTERS = 3;

export default class AssessmentFilter {
    constructor(apiService, stateManager) {
        this.apiService = apiService;
        this.stateManager = stateManager;
        this.selectedFilters = [];
        this.types = [];
        this.levels = [];
        this.typeDropdown = null;
        this.levelDropdown = null;
        this.addButton = null;
        this.tagsContainer = null;
        this.blockElement = null;
        this.mutedText = null;
    }

    async init() {
        this.blockElement = document.querySelector('[data-key="assessment"]');
        this.typeDropdown = this.blockElement?.querySelector('[data-dropdown="type"]');
        this.levelDropdown = this.blockElement?.querySelector('[data-dropdown="level"]');
        this.addButton = this.blockElement?.querySelector('[data-action="add-filter"]');
        this.tagsContainer = this.blockElement?.querySelector('[data-tags="assessment"]');
        this.mutedText = this.blockElement?.querySelector('.assessment-description');
        
        console.log('Assessment Filter: DOM elements found:', {
            blockElement: !!this.blockElement,
            typeDropdown: !!this.typeDropdown,
            levelDropdown: !!this.levelDropdown,
            addButton: !!this.addButton,
            tagsContainer: !!this.tagsContainer,
            typeDropdownTag: this.typeDropdown?.tagName,
            levelDropdownTag: this.levelDropdown?.tagName
        });
        
        try {
            await this.loadConfig();
            
            // Load any existing assessment filters from state
            const existingFilters = this.stateManager.get('assessmentFilters');
            if (existingFilters && Array.isArray(existingFilters)) {
                this.selectedFilters = existingFilters;
            }
            
            this.initCustomSelects();
            this.attachHandlers();
            this.renderTags();
            this.updateCount();
            
        } catch (error) {
            console.error('Assessment Filter: Initialization failed:', error);
        }
    }

    async loadConfig() {
        try {
            const [typesResponse, levelsResponse] = await Promise.all([
                fetch('/js/config/assessment_types.json'),
                fetch('/js/config/result_levels.json')
            ]);

            if (!typesResponse.ok || !levelsResponse.ok) {
                throw new Error('Failed to fetch configuration files');
            }

            const typesData = await typesResponse.json();
            const levelsData = await levelsResponse.json();
            
            this.types = typesData.assessment_types || [];
            this.levels = levelsData.result_levels || [];
            
            console.log('Assessment Filter: Config loaded successfully:', {
                types: this.types.length,
                levels: this.levels.length
            });
            
        } catch (error) {
            console.error('Assessment Filter: Failed to load config:', error);
            this.types = [];
            this.levels = [];
        }
    }

    initCustomSelects() {
        console.log('Assessment Filter: initCustomSelects - Types loaded:', this.types.length, 'Levels loaded:', this.levels.length);
        
        // Check if data is loaded
        if (this.types.length === 0 || this.levels.length === 0) {
            console.warn('Assessment Filter: Data not loaded yet, skipping initialization');
            return;
        }
        
        // Check if dropdowns exist
        console.log('Assessment Filter: Type dropdown found:', !!this.typeDropdown);
        console.log('Assessment Filter: Level dropdown found:', !!this.levelDropdown);
        
        // Initialize type dropdown first with existing HTML structure
        if (this.typeDropdown) {
            console.log('Assessment Filter: Setting up type dropdown, tagName:', this.typeDropdown.tagName);
            this.setupCustomSelect(this.typeDropdown, (value, text) => {
                console.log('Assessment Filter: Type selected:', value, text);
                this.typeDropdown.selectedValue = value;
                this.updateAddButtonState();
            });
        }

        // Initialize level dropdown
        if (this.levelDropdown) {
            console.log('Assessment Filter: Setting up level dropdown, tagName:', this.levelDropdown.tagName);
            this.setupCustomSelect(this.levelDropdown, (value, text) => {
                console.log('Assessment Filter: Level selected:', value, text);
                this.levelDropdown.selectedValue = value;
                this.updateAddButtonState();
            });
        }
        
        // Populate dropdowns after setting up handlers
        this.renderDropdowns();
    }

    setupCustomSelect(selectElement, onChange) {
        const trigger = selectElement.querySelector('.select-trigger');
        const optionsContainer = selectElement.querySelector('.select-options');
        
        console.log('Assessment Filter: setupCustomSelect', {
            selectElement: !!selectElement,
            trigger: !!trigger,
            optionsContainer: !!optionsContainer,
            isDisabled: selectElement.classList.contains('disabled')
        });
        
        if (!trigger || !optionsContainer) {
            console.error('Assessment Filter: Missing required custom select elements');
            return;
        }
        
        // Remove existing event listeners by cloning trigger
        const newTrigger = trigger.cloneNode(true);
        trigger.parentNode.replaceChild(newTrigger, trigger);
        
        // Handle trigger click
        newTrigger.addEventListener('click', (e) => {
            if (selectElement.classList.contains('disabled')) {
                console.log('Assessment Filter: Select is disabled, ignoring click');
                return;
            }
            
            console.log('Assessment Filter: Trigger clicked, toggling dropdown');
            e.stopPropagation();
            
            // Close other selects
            document.querySelectorAll('.custom-select').forEach(sel => {
                if (sel !== selectElement) sel.classList.remove('active');
            });
            
            selectElement.classList.toggle('active');
            console.log('Assessment Filter: Dropdown is now', selectElement.classList.contains('active') ? 'open' : 'closed');
        });

        // Handle option selection
        const options = optionsContainer.querySelectorAll('.option');
        options.forEach(option => {
            option.addEventListener('click', (e) => {
                e.stopPropagation();
                
                const value = option.dataset.value;
                const text = option.textContent.trim();
                
                console.log('Assessment Filter: Option selected:', value, text);
                
                // Update trigger text
                const selectText = newTrigger.querySelector('.select-text');
                if (selectText) {
                    // Handle different types of options (with icons, indicators, etc.)
                    if (value && option.querySelector('svg')) {
                        // For type dropdown with icons
                        const icon = option.querySelector('svg').cloneNode(true);
                        const textOnly = option.textContent.trim();
                        selectText.innerHTML = '';
                        selectText.appendChild(icon);
                        selectText.appendChild(document.createTextNode(' ' + textOnly));
                    } else if (value && option.querySelector('.level-indicator')) {
                        // For level dropdown with indicators
                        const indicator = option.querySelector('.level-indicator').cloneNode(true);
                        const textOnly = option.textContent.replace(option.querySelector('.level-indicator').textContent, '').trim();
                        selectText.innerHTML = '';
                        selectText.appendChild(indicator);
                        selectText.appendChild(document.createTextNode(' ' + textOnly));
                    } else {
                        selectText.textContent = text;
                    }
                }
                
                // Close dropdown
                selectElement.classList.remove('active');
                
                // Store selected value on the dropdown element
                selectElement.selectedValue = value;
                
                // Call onChange callback
                if (onChange) {
                    onChange(value, text);
                }
            });
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', (e) => {
            if (!selectElement.contains(e.target)) {
                selectElement.classList.remove('active');
            }
        });
    }

    setupOptionsHandlers(optionsContainer, selectElement, onChange) {
        const options = optionsContainer.querySelectorAll('.option');
        
        options.forEach(option => {
            option.addEventListener('click', (e) => {
                e.stopPropagation();
                
                const value = option.dataset.value;
                const text = option.textContent.trim();
                
                // Update select display
                const selectText = selectElement.querySelector('.select-text');
                if (selectText) {
                    selectText.textContent = text;
                }
                
                // Close dropdown
                selectElement.parentElement.classList.remove('active');
                
                // Store value
                selectElement.selectedValue = value;
                
                // Call callback
                if (onChange) {
                    onChange(value, text);
                }
            });
        });
    }

    closeAllDropdowns() {
        document.querySelectorAll('.custom-select').forEach(select => {
            select.classList.remove('active');
        });
    }

    resetCustomSelect(selectElement, placeholder) {
        const selectText = selectElement.querySelector('.select-text');
        if (selectText) {
            selectText.textContent = placeholder;
        }
        selectElement.selectedValue = '';
        selectElement.classList.remove('active');
    }

    renderDropdowns() {
        if (!this.typeDropdown || !this.levelDropdown) return;
        
        // Populate type dropdown
        this.populateTypeDropdown();
        
        // Populate level dropdown  
        this.populateLevelDropdown();
    }

    populateTypeDropdown() {
        if (!this.typeDropdown) return;
        
        const selectedTypeIds = this.selectedFilters.map(f => parseInt(f.type.id));
        
        // Handle custom select elements
        const optionsContainer = this.typeDropdown.querySelector('.select-options');
        
        if (!optionsContainer) {
            console.error('Assessment Filter: Could not find .select-options container');
            return;
        }
        
        const availableTypes = this.types.filter(t => !selectedTypeIds.includes(t.id));
        
        optionsContainer.innerHTML = availableTypes
            .map(t => `
                <div class="option" data-value="${t.id}">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                        <use href="#${t.icon}"></use>
                    </svg>
                    ${t.label}
                </div>
            `).join('');
        
        console.log('Assessment Filter: Added', availableTypes.length, 'type options');
        
        // Re-setup the custom select after content change
        this.setupCustomSelect(this.typeDropdown, (value, text) => {
            this.typeDropdown.selectedValue = value;
            this.updateAddButtonState();
        });
    }

    populateLevelDropdown() {
        if (!this.levelDropdown) return;
        
        // Handle custom select elements
        const optionsContainer = this.levelDropdown.querySelector('.select-options');
        
        if (!optionsContainer) {
            console.error('Assessment Filter: Could not find level .select-options container');
            return;
        }
        
        optionsContainer.innerHTML = this.levels
            .map(l => `
                <div class="option" data-value="${l.id}">
                    <span class="level-indicator" style="color: ${l.color};">${l.indicator}</span>
                    ${l.label}
                </div>
            `).join('');
        
        console.log('Assessment Filter: Added', this.levels.length, 'level options');
        
        // Re-setup the custom select after content change
        this.setupCustomSelect(this.levelDropdown, (value, text) => {
            this.levelDropdown.selectedValue = value;
            this.updateAddButtonState();
        });
    }

    attachHandlers() {
        if (this.addButton) {
            this.addButton.addEventListener('click', () => {
                this.handleAddFilter();
            });
        }

        // Clear all handler
        const clearAllBtn = this.blockElement?.querySelector('.assessment-clear-all');
        if (clearAllBtn) {
            clearAllBtn.addEventListener('click', (e) => {
                e.preventDefault();
                this.reset();
            });
        }

        // Section clear handler
        const sectionClearBtn = this.blockElement?.querySelector('.section-clear');
        if (sectionClearBtn) {
            sectionClearBtn.addEventListener('click', () => {
                this.reset();
            });
        }
    }

    updateAddButtonState() {
        if (!this.addButton) return;
        
        const hasType = this.typeDropdown?.selectedValue;
        const hasLevel = this.levelDropdown?.selectedValue;
        const canAdd = this.selectedFilters.length < MAX_FILTERS;
        
        const isEnabled = hasType && hasLevel && canAdd;
        
        if (isEnabled) {
            this.addButton.disabled = false;
            this.addButton.classList.remove('disabled');
        } else {
            this.addButton.disabled = true;
            this.addButton.classList.add('disabled');
        }
        
        // Enable/disable level dropdown based on type selection
        if (this.levelDropdown) {
            if (hasType) {
                this.levelDropdown.classList.remove('disabled');
            } else {
                this.levelDropdown.classList.add('disabled');
                this.resetCustomSelect(this.levelDropdown, 'Select Results Level');
            }
        }
    }

    handleAddFilter() {
        console.log('Assessment Filter: handleAddFilter called');
        
        const selectedTypeValue = this.typeDropdown?.selectedValue;
        const selectedLevelValue = this.levelDropdown?.selectedValue;
        
        console.log('Assessment Filter: Selected values:', { 
            type: selectedTypeValue, 
            level: selectedLevelValue 
        });
        
        if (!selectedTypeValue || !selectedLevelValue) {
            console.error('Assessment Filter: Missing selection values');
            return;
        }
        
        // Find type and level data
        const typeData = this.types.find(t => t.id == selectedTypeValue);
        const levelData = this.levels.find(l => l.id == selectedLevelValue);
        
        if (!typeData || !levelData) {
            console.error('Assessment Filter: Could not find type or level data');
            return;
        }
        
        // Create filter object
        const filter = {
            type: typeData,
            level: levelData,
            id: `${typeData.id}_${levelData.id}`
        };
        
        // Add to selected filters
        this.selectedFilters.push(filter);
        
        // Update state
        this.stateManager.set('assessmentFilters', this.selectedFilters);
        
        // Reset dropdowns
        this.resetCustomSelect(this.typeDropdown, 'Select Assessment Results Type');
        this.resetCustomSelect(this.levelDropdown, 'Select Results Level');
        
        // Update UI
        this.renderDropdowns();
        this.renderTags();
        this.updateCount();
        this.updateAddButtonState();
        
        console.log('Assessment Filter: Filter added successfully');
    }

    removeFilter(typeId) {
        this.selectedFilters = this.selectedFilters.filter(f => f.type.id !== parseInt(typeId));
        
        // Update state
        this.stateManager.set('assessmentFilters', this.selectedFilters);
        
        // Update UI
        this.renderDropdowns();
        this.renderTags();
        this.updateCount();
        this.updateAddButtonState();
    }

    renderTags() {
        if (!this.tagsContainer) return;
        
        if (this.selectedFilters.length === 0) {
            this.tagsContainer.innerHTML = '';
            return;
        }
        
        this.tagsContainer.innerHTML = this.selectedFilters.map(filter => `
            <div class="assessment-tag">
                <div class="assessment-tag-content">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                        <use href="#${filter.type.icon}"></use>
                    </svg>
                    <span class="assessment-tag-text">${filter.type.label}</span>
                </div>
                <div class="assessment-tag-level">
                    <span class="level-indicator" style="color: ${filter.level.color};">${filter.level.indicator}</span>
                    <span>${filter.level.label}</span>
                </div>
                <button class="assessment-tag-remove" onclick="window.assessmentFilter?.removeFilter(${filter.type.id})" aria-label="Remove filter">×</button>
            </div>
        `).join('');
        
        // Show/hide clear all button
        const clearAllBtn = this.blockElement?.querySelector('.assessment-clear-all');
        if (clearAllBtn) {
            clearAllBtn.style.display = this.selectedFilters.length > 0 ? 'block' : 'none';
        }
    }

    updateCount() {
        // Update filter count in header
        const countElement = this.blockElement?.querySelector('.assessment-count');
        if (countElement) {
            countElement.textContent = `(${this.selectedFilters.length})`;
        }
        
        // Update header count if needed
        this.updateHeaderCount();
    }

    updateHeaderCount() {
        // Find and update any header count displays
        const headerCounts = document.querySelectorAll('.total-filter-count');
        headerCounts.forEach(element => {
            const totalFilters = this.selectedFilters.length;
            element.textContent = totalFilters > 0 ? `(${totalFilters})` : '';
        });
    }

    // Interface methods for external components
    getSelectedFilters() {
        return this.selectedFilters;
    }

    hasFilters() {
        return this.selectedFilters.length > 0;
    }

    updateCount() {
        const countElement = this.blockElement?.querySelector('.assessment-count');
        if (countElement) {
            countElement.textContent = `(${this.selectedFilters.length})`;
        }
    }

    getSelectedIds() {
        return this.selectedFilters.map(f => f.id);
    }

    handleSelection(selectedFilters) {
        this.selectedFilters = selectedFilters;
        this.renderTags();
        this.updateCount();
        this.renderDropdowns();
    }

    reset() {
        this.selectedFilters = [];
        
        // Update state
        this.stateManager.set('assessmentFilters', []);
        
        // Reset UI
        this.renderTags();
        this.updateCount();
        this.renderDropdowns();
        this.resetSelections();
    }

    resetSelections() {
        if (this.typeDropdown) {
            this.resetCustomSelect(this.typeDropdown, 'Select Assessment Results Type');
        }
        if (this.levelDropdown) {
            this.resetCustomSelect(this.levelDropdown, 'Select Results Level');
        }
        this.updateAddButtonState();
    }
}
