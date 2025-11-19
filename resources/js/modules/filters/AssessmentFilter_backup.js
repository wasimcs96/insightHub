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
            if (existingFilters && existingFilters.length > 0) {
                this.selectedFilters = existingFilters;
            }
            
            // Only initialize if data was loaded successfully
            if (this.types.length > 0 && this.levels.length > 0) {
                this.initCustomSelects();
                this.renderTags();
                this.updateAddButtonState();
                this.updateCount();
            } else {
                console.error('Assessment Filter: Failed to load configuration data');
            }
        } catch (error) {
            console.error('Failed to initialize AssessmentFilter:', error);
        }
    }

    async loadConfig() {
        try {
            console.log('Assessment Filter: Starting to load config...');
            
            // Load static JSON config files
            const [typesResponse, levelsResponse] = await Promise.all([
                fetch('/js/config/assessment_types.json'),
                fetch('/js/config/result_levels.json')
            ]);
            
            console.log('Assessment Filter: Response status - Types:', typesResponse.status, 'Levels:', levelsResponse.status);
            
            if (!typesResponse.ok || !levelsResponse.ok) {
                throw new Error(`Failed to load configuration files - Types: ${typesResponse.status}, Levels: ${levelsResponse.status}`);
            }
            
            const [typesData, levelsData] = await Promise.all([
                typesResponse.json(),
                levelsResponse.json()
            ]);
            
            this.types = typesData || [];
            this.levels = levelsData || [];
            
            console.log('Assessment Filter: Successfully loaded types:', this.types.length, 'items');
            console.log('Assessment Filter: Successfully loaded levels:', this.levels.length, 'items');
            console.log('Assessment Filter: Types:', this.types);
            console.log('Assessment Filter: Levels:', this.levels);
            
        } catch (error) {
            console.error('Assessment Filter: Failed to load config:', error);
            // Fallback to empty arrays
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

        // Setup add button click handler
        if (this.addButton) {
            this.addButton.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                this.handleAddFilter();
            });
        }

        // Setup tag removal handlers
        if (this.tagsContainer) {
            this.tagsContainer.addEventListener('click', (e) => {
                if (e.target.closest('.remove-tag')) {
                    const removeBtn = e.target.closest('.remove-tag');
                    const id = removeBtn.dataset.id;
                    this.removeFilter(id);
                }
            });
        }

        // Setup Clear All handler
        const clearAllLink = document.querySelector('.assessment-clear-all');
        if (clearAllLink) {
            clearAllLink.addEventListener('click', (e) => {
                e.preventDefault();
                this.clearAllFilters();
            });
        }
    }

    clearAllFilters() {
        this.selectedFilters = [];
        this.stateManager.update('assessmentFilters', this.selectedFilters);
        this.renderTags();
        this.updateAddButtonState();
        this.updateCount();
        this.updateHeaderCount();
        console.log('Assessment Filter: All filters cleared');
    }

    setupCustomSelect(selectElement, onChange) {
        const trigger = selectElement.querySelector('.select-trigger');
        const optionsContainer = selectElement.querySelector('.select-options');
        const options = selectElement.querySelectorAll('.option');
        
        console.log('Assessment Filter: setupCustomSelect', {
            selectElement: !!selectElement,
            trigger: !!trigger,
            optionsContainer: !!optionsContainer,
            options: options.length,
            isDisabled: selectElement.classList.contains('disabled')
        });
        
        if (!trigger || !optionsContainer) {
            console.error('Assessment Filter: Missing required custom select elements');
            return;
        }
        
        // Remove existing event listeners by cloning elements
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
        this.setupOptionsHandlers(optionsContainer, newTrigger, onChange);

        // Close dropdown when clicking outside
        document.addEventListener('click', (e) => {
            if (!selectElement.contains(e.target)) {
                selectElement.classList.remove('active');
            }
        });
                
                // Update selected state
                options.forEach(opt => opt.classList.remove('selected'));
                if (value) {
                    option.classList.add('selected');
                }
                
                // Update the trigger display with icon and text
                const selectText = selectElement.querySelector('.select-text');
                if (value && option.querySelector('svg')) {
                    // Clone the icon and text (for assessment types)
                    const icon = option.querySelector('svg').cloneNode(true);
                    const textOnly = text.trim();
                    selectText.innerHTML = '';
                    selectText.appendChild(icon);
                    selectText.appendChild(document.createTextNode(' ' + textOnly));
                } else if (value && option.querySelector('.level-indicator')) {
                    // For level dropdown with indicators - get text without the indicator
                    const indicator = option.querySelector('.level-indicator').cloneNode(true);
                    const textOnly = option.textContent.replace(option.querySelector('.level-indicator').textContent, '').trim();
                    selectText.innerHTML = '';
                    selectText.appendChild(indicator);
                    selectText.appendChild(document.createTextNode(' ' + textOnly));
                } else {
                    selectText.textContent = text;
                }
                
                // Close dropdown
                selectElement.classList.remove('active');
                
                // Store selected value on the dropdown element
                selectElement.selectedValue = value;
                
                // Call onChange callback
                onChange(value, text);
            });
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', () => {
            selectElement.classList.remove('active');
        });
    }

    setupOptionsHandlers(selectElement, onChange) {
        const options = selectElement.querySelectorAll('.option');
        
        // Remove existing event listeners to prevent duplicates
        options.forEach(option => {
            option.replaceWith(option.cloneNode(true));
        });
        
        // Get updated options after cloning
        const newOptions = selectElement.querySelectorAll('.option');
        
        // Handle option selection
        newOptions.forEach(option => {
            option.addEventListener('click', (e) => {
                e.stopPropagation();
                
                const value = option.dataset.value;
                const text = option.textContent.trim();
                
                // Update selected state
                newOptions.forEach(opt => opt.classList.remove('selected'));
                if (value) {
                    option.classList.add('selected');
                }
                
                // Update the trigger display with icon and text
                const selectText = selectElement.querySelector('.select-text');
                if (value && option.querySelector('svg')) {
                    // Clone the icon and text (for assessment types)
                    const icon = option.querySelector('svg').cloneNode(true);
                    const textOnly = text.trim();
                    selectText.innerHTML = '';
                    selectText.appendChild(icon);
                    selectText.appendChild(document.createTextNode(' ' + textOnly));
                } else if (value && option.querySelector('.level-indicator')) {
                    // For level dropdown with indicators - get text without the indicator
                    const indicator = option.querySelector('.level-indicator').cloneNode(true);
                    const textOnly = option.textContent.replace(option.querySelector('.level-indicator').textContent, '').trim();
                    selectText.innerHTML = '';
                    selectText.appendChild(indicator);
                    selectText.appendChild(document.createTextNode(' ' + textOnly));
                } else {
                    selectText.textContent = text;
                }
                
                // Close dropdown
                selectElement.classList.remove('active');
                
                // Store selected value on the dropdown element
                selectElement.selectedValue = value;
                
                // Call onChange callback
                onChange(value, text);
            });
        });
    }

    resetCustomSelect(selectElement, placeholder) {
        if (!selectElement) return;
        
        selectElement.selectedValue = null;
        const selectText = selectElement.querySelector('.select-text');
        if (selectText) {
            selectText.innerHTML = '';
            selectText.textContent = placeholder;
        }
        selectElement.querySelectorAll('.option').forEach(opt => opt.classList.remove('selected'));
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
        
        // Handle standard HTML select element
        if (this.typeDropdown.tagName === 'SELECT') {
            console.log('Assessment Filter: Populating standard select with types:', this.types.length);
            
            // Clear existing options except the first (placeholder)
            const firstOption = this.typeDropdown.options[0];
            this.typeDropdown.innerHTML = '';
            if (firstOption) {
                this.typeDropdown.appendChild(firstOption);
            }
            
            // Add available types
            const availableTypes = this.types.filter(t => !selectedTypeIds.includes(t.id));
            availableTypes.forEach(type => {
                const option = document.createElement('option');
                option.value = type.id;
                option.textContent = type.label;
                this.typeDropdown.appendChild(option);
            });
            
            console.log('Assessment Filter: Added', availableTypes.length, 'type options');
            return;
        }
        
        // Handle custom select elements (fallback)
        const optionsContainer = this.typeDropdown.querySelector('.select-options');
        
        if (!optionsContainer) {
            console.error('Assessment Filter: Could not find .select-options container');
            return;
        }
        
        const availableTypes = this.types.filter(t => !selectedTypeIds.includes(t.id));
        
        optionsContainer.innerHTML = availableTypes
            .map(t => `
                <div class="option" data-value="${t.id}">
                    <svg><use xlink:href="#${t.icon}"></use></svg>
                    ${t.label}
                </div>
            `).join('');
        
        // Re-setup the custom select after content change
        this.setupCustomSelect(this.typeDropdown, (value, text) => {
            this.typeDropdown.selectedValue = value;
            this.updateAddButtonState();
        });
    }

    populateLevelDropdown() {
        if (!this.levelDropdown) return;
        
        // Handle standard HTML select element
        if (this.levelDropdown.tagName === 'SELECT') {
            console.log('Assessment Filter: Populating standard select with levels:', this.levels.length);
            
            // Clear existing options except the first (placeholder)
            const firstOption = this.levelDropdown.options[0];
            this.levelDropdown.innerHTML = '';
            if (firstOption) {
                this.levelDropdown.appendChild(firstOption);
            }
            
            // Add all levels
            this.levels.forEach(level => {
                const option = document.createElement('option');
                option.value = level.id;
                option.textContent = level.label;
                this.levelDropdown.appendChild(option);
            });
            
            console.log('Assessment Filter: Added', this.levels.length, 'level options');
            return;
        }
        
        // Handle custom select elements (fallback)
        const optionsContainer = this.levelDropdown.querySelector('.select-options');
        
        if (!optionsContainer) {
            console.error('Assessment Filter: Could not find level .select-options container');
            return;
        }
        
        optionsContainer.innerHTML = this.levels
            .map(l => `
                <div class="option" data-value="${l.id}">
                    <span class="level-indicator ${l.iconClass}">
                        <i class="${l.icon}"></i>
                    </span>
                    ${l.label}
                </div>
            `).join('');
        
        // Re-setup the custom select after content change
        this.setupCustomSelect(this.levelDropdown, (value, text) => {
            this.levelDropdown.selectedValue = value;
            this.updateAddButtonState();
        });
    }

    attachHandlers() {
        if (!this.typeDropdown || !this.levelDropdown || !this.addButton || !this.tagsContainer) return;
        
        this.typeDropdown.addEventListener('change', () => this.updateAddButtonState());
        this.levelDropdown.addEventListener('change', () => this.updateAddButtonState());
        this.addButton.addEventListener('click', () => this.handleAddFilter());
        
        // Handle tag removal with event delegation for both click and keyboard
        this.tagsContainer.addEventListener('click', (e) => {
            if (e.target.closest('.remove-tag')) {
                const removeBtn = e.target.closest('.remove-tag');
                const id = parseInt(removeBtn.dataset.id);
                this.removeFilter(id);
            }
        });
        
        this.tagsContainer.addEventListener('keydown', (e) => {
            if ((e.key === 'Enter' || e.key === ' ') && e.target.closest('.remove-tag')) {
                e.preventDefault();
                const removeBtn = e.target.closest('.remove-tag');
                const id = parseInt(removeBtn.dataset.id);
                this.removeFilter(id);
            }
        });
    }

    updateAddButtonState() {
        if (!this.typeDropdown || !this.levelDropdown || !this.addButton) return;
        
        // Get selected values from DOM elements
        const selectedTypeOption = this.typeDropdown.querySelector('.option.selected');
        const selectedLevelOption = this.levelDropdown.querySelector('.option.selected');
        
        const typeSelected = selectedTypeOption ? selectedTypeOption.dataset.value : null;
        const levelSelected = selectedLevelOption ? selectedLevelOption.dataset.value : null;
        
        console.log('Assessment Filter: Update button state - Type:', typeSelected, 'Level:', levelSelected);
        
        // Enable/disable level dropdown based on type selection
        if (typeSelected) {
            this.levelDropdown.classList.remove('disabled');
        } else {
            this.levelDropdown.classList.add('disabled');
            // Reset level selection when type is cleared
            this.resetCustomSelect(this.levelDropdown, 'Select Results Level');
        }
        
        // Only enable Add button when both are selected and under max filters
        const canAdd = typeSelected && levelSelected && this.selectedFilters.length < MAX_FILTERS;
        
        this.addButton.disabled = !canAdd;
        this.addButton.setAttribute('aria-disabled', !canAdd);
        
        if (canAdd) {
            this.addButton.classList.remove('disabled');
        } else {
            this.addButton.classList.add('disabled');
        }
    }



    handleAddFilter() {
        console.log('Assessment Filter: Add filter clicked');
        if (this.selectedFilters.length >= MAX_FILTERS) {
            console.log('Assessment Filter: Maximum filters reached');
            return;
        }
        
        // Get selected values from dropdown elements
        const typeValue = this.typeDropdown.selectedValue;
        const levelValue = this.levelDropdown.selectedValue;
        
        console.log('Assessment Filter: Selected type:', typeValue, 'Selected level:', levelValue);
        
        if (!typeValue || !levelValue) {
            console.log('Assessment Filter: Invalid selections');
            return;
        }

        // Convert to integers for proper comparison
        const typeId = parseInt(typeValue);
        const levelId = parseInt(levelValue);
        
        // Check for duplicate Assessment Result Type
        const existingType = this.selectedFilters.find(f => parseInt(f.type.id) === typeId);
        if (existingType) {
            console.log('Assessment Filter: Duplicate type detected, skipping');
            alert('This Assessment Results Type has already been selected. Each type can only be chosen once.');
            return;
        }
        
        // Get data from JSON configs
        const typeData = this.types.find(t => t.id === typeId);
        const levelData = this.levels.find(l => l.id === levelId);
        
        if (!typeData || !levelData) {
            console.error('Assessment Filter: Could not find type or level data');
            console.error('Looking for typeId:', typeId, 'levelId:', levelId);
            console.error('Available types:', this.types.map(t => `${t.id}:${t.label}`));
            console.error('Available levels:', this.levels.map(l => `${l.id}:${l.label}`));
            return;
        }
        
        const filter = {
            type: { 
                id: typeId, 
                label: typeData.label,
                iconHtml: `<svg><use xlink:href="#${typeData.icon}"></use></svg>`
            },
            level: { 
                id: levelId, 
                label: levelData.label,
                indicatorHtml: `<span class="level-indicator ${levelData.iconClass}"><i class="${levelData.icon}"></i></span>`
            }
        };
        
        console.log('Assessment Filter: Adding filter', filter);
        
        this.selectedFilters.push(filter);
        this.stateManager.update('assessmentFilters', this.selectedFilters);
        
        // Reset dropdowns and refresh options
        this.resetCustomSelect(this.typeDropdown, 'Select Assessment Results Type');
        this.resetCustomSelect(this.levelDropdown, 'Select Results Level');
        
        // Refresh dropdowns to hide selected types
        this.populateTypeDropdown();
        
        this.renderTags();
        this.updateAddButtonState();
        this.updateCount();
        this.updateHeaderCount();
        
        console.log('Assessment Filter: Filter added successfully, total filters:', this.selectedFilters.length);
    }

    removeFilter(typeId) {
        console.log('Assessment Filter: Removing filter with type ID:', typeId);
        this.selectedFilters = this.selectedFilters.filter(f => parseInt(f.type.id) !== parseInt(typeId));
        this.stateManager.update('assessmentFilters', this.selectedFilters);
        
        // Refresh dropdowns to show removed type as available
        this.populateTypeDropdown();
        
        this.renderTags();
        this.updateAddButtonState();
        this.updateCount();
        this.updateHeaderCount();
    }

    renderTags() {
        if (!this.tagsContainer) return;
        
        this.tagsContainer.innerHTML = this.selectedFilters.map(f => {            
            return `<div class="assessment-tag" aria-label="${f.type.label} ${f.level.label}">
                <div class="assessment-tag-content">
                    ${f.type.iconHtml || ''}
                    <span class="assessment-tag-text">${f.type.label}:</span>
                </div>
                <div class="assessment-tag-level">
                    ${f.level.indicatorHtml || ''}${f.level.label}
                </div>
                <button class="assessment-tag-remove remove-tag" data-id="${f.type.id}" aria-label="Remove ${f.type.label}" title="Remove filter">
                    ×
                </button>
            </div>`;
        }).join('');
        
        // Update Clear All visibility
        const clearAllLink = document.querySelector('.assessment-clear-all');
        if (clearAllLink) {
            clearAllLink.style.display = this.selectedFilters.length > 0 ? 'inline' : 'none';
        }

        // Update description text
        if (this.mutedText) {
            if (this.selectedFilters.length > 0) {
                this.mutedText.textContent = `Only 3 filters can be active at a time, and each Assessment Results Type can be chosen once.`;
            } else {
                this.mutedText.textContent = 'Only 3 filters can be active at a time, and each Assessment Results Type can be chosen once.';
            }
        }
    }

    updateCount() {
        const countSpan = this.blockElement?.querySelector('.assessment-count');
        if (countSpan) {
            countSpan.textContent = `(${this.selectedFilters.length})`;
        }
    }

    updateHeaderCount() {
        // Call the updateHeaderCount helper function via the global filter manager
        if (typeof window.orgChartFilter !== 'undefined' && 
            window.orgChartFilter.filterManager && 
            window.orgChartFilter.stateManager) {
            
            // Get the updateHeaderCount from helpers via the existing utils
            const state = window.orgChartFilter.stateManager.getState();
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
    }

    updateCount() {
        const countSpan = this.blockElement?.querySelector('.assessment-count');
        if (countSpan) {
            countSpan.textContent = `(${this.selectedFilters.length})`;
        }
    }

    getSelectedIds() {
        return this.selectedFilters.map(f => ({ type: f.type.id, level: f.level.id }));
    }

    handleSelection(selectedFilters) {
        this.selectedFilters = selectedFilters || [];
        this.stateManager.update('assessmentFilters', this.selectedFilters);
        this.renderDropdowns();
        this.renderTags();
        this.updateAddButtonState();
        this.updateCount();
        this.updateHeaderCount();
    }

    reset() {
        this.selectedFilters = [];
        this.stateManager.update('assessmentFilters', []);
        
        // Reset dropdowns to default values
        if (this.typeDropdown) this.typeDropdown.value = '';
        if (this.levelDropdown) this.levelDropdown.value = '';
        
        this.renderDropdowns();
        this.renderTags();
        this.updateAddButtonState();
        this.updateCount();
        this.updateHeaderCount();
    }

    resetSelections() {
        this.reset();
    }
}
