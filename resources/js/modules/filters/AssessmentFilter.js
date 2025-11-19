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
        
        // Debug stateManager
        console.log('Assessment Filter: Constructor - stateManager:', !!stateManager);
        console.log('Assessment Filter: Constructor - stateManager methods:', stateManager ? Object.getOwnPropertyNames(Object.getPrototypeOf(stateManager)) : 'undefined');
        // Listen for edit mode changes to initialize lazily if needed
        try {
            window.addEventListener('isEditModeUpdated', (e) => {
                if (e?.detail?.isEditMode) {
                    // If block not yet initialized, attempt init
                    if (!this.blockElement) {
                        // Defer to next tick to allow DOM to be present
                        setTimeout(() => {
                            try {
                                this.init();
                            } catch (err) {
                                console.warn('Assessment Filter: lazy init failed', err);
                            }
                        }, 50);
                    }
                }
            });
        } catch (err) {
            // ignore
        }
    }

    async init() {
        this.blockElement = document.querySelector('[data-key="assessment"]');
        if (!this.blockElement) {
            console.warn('Assessment Filter: DOM block [data-key="assessment"] not found - skipping init');
            return; // Abort init if the DOM block is not present (JS will init later when available)
        }
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
            
            // Expose to window for any legacy onclick handlers
            window.assessmentFilter = this;
            
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
            
            console.log(levelsData,"2222222222222222222222222222222222222222222222222222222222222222222222222222");
            
            // The JSON files contain arrays directly
            this.types = Array.isArray(typesData) ? typesData : (typesData.assessment_types || []);
            this.levels = Array.isArray(levelsData) ? levelsData : (levelsData.result_levels || []);
            
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
            console.log('Assessment Filter: Setting up type dropdown');
            this.setupCustomSelect(this.typeDropdown, (value, text) => {
                console.log('Assessment Filter: Type selected:', value, text);
                this.typeDropdown.selectedValue = value;
                // Reset and repopulate Results Level dropdown when type changes
                this.resetCustomSelect(this.levelDropdown, 'Select Results Level');
                this.populateLevelDropdown();
                this.updateAddButtonState();
            });
        }

        // Initialize level dropdown
        if (this.levelDropdown) {
            console.log('Assessment Filter: Setting up level dropdown');
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
        console.log('Assessment Filter: setupCustomSelect', {
            selectElement: !!selectElement,
            tagName: selectElement?.tagName,
            classes: selectElement?.className,
            isDisabled: selectElement?.classList.contains('disabled')
        });
        
        // Handle custom select elements (the main approach for this project)
        const trigger = selectElement.querySelector('.select-trigger');
        const optionsContainer = selectElement.querySelector('.select-options');
        
        if (!trigger || !optionsContainer) {
            console.error('Assessment Filter: Missing required custom select elements', {
                trigger: !!trigger,
                optionsContainer: !!optionsContainer,
                selectElement: selectElement?.outerHTML?.substring(0, 200)
            });
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

        // Store the onChange callback for later use when options are populated
        selectElement._onChangeCallback = onChange;

        // Close dropdown when clicking outside
        document.addEventListener('click', (e) => {
            if (!selectElement.contains(e.target)) {
                selectElement.classList.remove('active');
            }
        });
    }

    setupOptionsHandlers(selectElement) {
        const optionsContainer = selectElement.querySelector('.select-options');
        const trigger = selectElement.querySelector('.select-trigger');
        const onChange = selectElement._onChangeCallback;
        
        if (!optionsContainer || !trigger || !onChange) {
            console.error('Assessment Filter: Missing required elements for option handlers');
            return;
        }
        
        const options = optionsContainer.querySelectorAll('.option');
        console.log('Assessment Filter: Setting up handlers for', options.length, 'options');
        
        options.forEach(option => {
            option.addEventListener('click', (e) => {
                e.stopPropagation();
                
                const value = option.dataset.value;
                const text = option.textContent.trim();
                
                console.log('Assessment Filter: Option clicked:', value, text);
                
                // Update trigger text
                const selectText = trigger.querySelector('.select-text');
                if (selectText) {
                    // Handle different types of options (with icons, indicators, etc.)
                    if (value && option.querySelector('iconify-icon')) {
                        // For type dropdown with iconify icons
                        const icon = option.querySelector('iconify-icon').cloneNode(true);
                        const textOnly = option.textContent.trim();
                        selectText.innerHTML = '';
                        selectText.appendChild(icon);
                        selectText.appendChild(document.createTextNode(' ' + textOnly));
                    } else if (value && option.querySelector('.level-indicator')) {
                        // For level dropdown with indicators
                        const indicator = option.querySelector('.level-indicator').cloneNode(true);
                        const textNodes = [];
                        option.childNodes.forEach(node => {
                            if (node.nodeType === Node.TEXT_NODE && node.textContent.trim()) {
                                textNodes.push(node.textContent.trim());
                            }
                        });
                        const textOnly = textNodes.join(' ');
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
                onChange(value, text);
            });
        });
    }

    closeAllDropdowns() {
        document.querySelectorAll('.custom-select').forEach(select => {
            select.classList.remove('active');
        });
    }

    resetCustomSelect(selectElement, placeholder) {
        if (!selectElement) return;
        
        // Handle custom select element
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
        const availableTypes = this.types.filter(t => !selectedTypeIds.includes(t.id));
        
        console.log('Assessment Filter: Populating type dropdown with', availableTypes.length, 'types:', availableTypes);
        
        // Handle custom select elements (main approach)
        const optionsContainer = this.typeDropdown.querySelector('.select-options');
        
        if (!optionsContainer) {
            console.error('Assessment Filter: Could not find .select-options container');
            return;
        }
        
        // Create options with proper icons using Iconify
        optionsContainer.innerHTML = availableTypes
            .map(t => `
                <div class="option" data-value="${t.id}">
                    <iconify-icon icon="${t.icon}" width="16" height="16"></iconify-icon>
                    ${t.label}
                </div>
            `).join('');
        
        console.log('Assessment Filter: Added', availableTypes.length, 'type options with icons');
        
        // Setup option handlers after populating content
        this.setupOptionsHandlers(this.typeDropdown);
    }

    populateLevelDropdown() {
        if (!this.levelDropdown) return;

        // Get selected type id from the type dropdown
        let selectedTypeId = null;
        if (this.typeDropdown && this.typeDropdown.selectedValue) {
            selectedTypeId = parseInt(this.typeDropdown.selectedValue);
        }

        console.log("======================================");
        
        console.log(selectedTypeId);
        
        // Filter levels based on selected type id
        let filteredLevels = this.levels;
        console.log('Assessment Filter: All levels:', this.levels);
        
        if (selectedTypeId) {
            filteredLevels = this.levels.filter(l => Array.isArray(l.assessmentTypeIds) && l.assessmentTypeIds.includes(selectedTypeId));
        }

        console.log('Assessment Filter: Populating level dropdown with', filteredLevels.length, 'levels for type', selectedTypeId, filteredLevels);

        // Handle custom select elements (main approach)
        const optionsContainer = this.levelDropdown.querySelector('.select-options');

        if (!optionsContainer) {
            console.error('Assessment Filter: Could not find level .select-options container');
            return;
        }

        // Create options with proper icons and colors
        optionsContainer.innerHTML = filteredLevels
            .map(l => `
                <div class="option" data-value="${l.id}">
                    <span class="level-indicator">
                        <iconify-icon icon="${l.icon}" width="14" height="14" class="${l.iconClass}"></iconify-icon>
                    </span>
                    ${l.label}
                </div>
            `).join('');

        console.log('Assessment Filter: Added', filteredLevels.length, 'level options with icons');

        // Setup option handlers after populating content
        this.setupOptionsHandlers(this.levelDropdown);
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
        
        // Get selected values from custom selects
        const hasType = this.typeDropdown?.selectedValue;
        const hasLevel = this.levelDropdown?.selectedValue;
        const canAdd = this.selectedFilters.length < MAX_FILTERS;
        const isEnabled = hasType && hasLevel && canAdd;
        
        console.log('Assessment Filter: updateAddButtonState', {
            hasType,
            hasLevel,
            canAdd,
            isEnabled,
            typeValue: this.typeDropdown?.selectedValue,
            levelValue: this.levelDropdown?.selectedValue
        });
        
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
        
        // Get selected values from custom selects
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
        this.stateManager.update('assessmentFilters', this.selectedFilters);
        
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
        this.stateManager.update('assessmentFilters', this.selectedFilters);
        
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
        
        this.tagsContainer.innerHTML = this.selectedFilters.map((filter, index) => `
            <div class="assessment-tag" data-filter-id="${filter.type.id}">
                <iconify-icon icon="${filter.type.icon}" width="14" height="14"></iconify-icon>
                <span class="assessment-tag-text">${filter.type.label}</span>
                <span class="level-indicator">
                    <iconify-icon icon="${filter.level.icon}" width="10" height="10" class="${filter.level.iconClass}"></iconify-icon>
                </span>
                <span class="assessment-tag-level">${filter.level.label}</span>
                <button class="assessment-tag-remove" data-type-id="${filter.type.id}" aria-label="Remove filter">×</button>
            </div>
        `).join('');
        
        // Add event listeners for remove buttons after rendering
        this.attachRemoveButtonListeners();
        
        // Show/hide clear all button
        const clearAllBtn = this.blockElement?.querySelector('.assessment-clear-all');
        if (clearAllBtn) {
            clearAllBtn.style.display = this.selectedFilters.length > 0 ? 'block' : 'none';
        }
    }

    attachRemoveButtonListeners() {
        if (!this.tagsContainer) return;
        
        const removeButtons = this.tagsContainer.querySelectorAll('.assessment-tag-remove');
        removeButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                e.stopPropagation();
                const typeId = button.getAttribute('data-type-id');
                if (typeId) {
                    this.removeFilter(parseInt(typeId));
                }
            });
        });
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
        this.stateManager.update('assessmentFilters', []);
        
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
