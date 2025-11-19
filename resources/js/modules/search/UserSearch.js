import { debounce } from '../../utils/helpers';

export default class UserSearch {
    constructor(apiService, stateManager) {
        this.apiService = apiService;
        this.stateManager = stateManager;
        this.endpoint = '/admin/ajax/search-users';
        
        this.input = null;
        this.dropdown = null;
        this.clearBtn = null;
        
        this.currentPage = 1;
        this.lastKeyword = '';
        this.hasMorePages = false;
        this.abortController = null;
    }

    init() {
        this.input = document.getElementById('searchInput');
        this.dropdown = document.getElementById('dropdownList');
        this.clearBtn = document.getElementById('clearBtn');
        
        if (this.input) {
            this.attachEventHandlers();
        }
    }

    attachEventHandlers() {
        // Debounced search
        const debouncedSearch = debounce((keyword) => {
            this.fetchResults(keyword);
        }, 300);

        this.input.addEventListener('input', (e) => {
            debouncedSearch(e.target.value);
        });

        this.input.addEventListener('focus', () => {
            if (this.input.value.trim() && this.dropdown) {
                this.dropdown.classList.remove('d-none');
            }
            if (this.clearBtn) {
                this.clearBtn.classList.toggle('d-none', this.input.value === '');
            }
        });

        if (this.clearBtn) {
            this.clearBtn.addEventListener('click', () => this.clear());
        }

        // Click outside to close
        document.addEventListener('click', (e) => {
            if (!e.target.closest('.search-dropdown') && 
                !e.target.closest('#dropdownList') && 
                this.dropdown) {
                this.dropdown.classList.add('d-none');
            }
        });
    }

    async fetchResults(keyword, append = false) {
        if (this.abortController) {
            this.abortController.abort();
        }

        if (!keyword.trim()) {
            this.hideDropdown();
            return;
        }

        this.abortController = new AbortController();

        if (!append) {
            this.dropdown.innerHTML = '<div class="dropdown-item">Searching...</div>';
            this.currentPage = 1;
        }

        this.lastKeyword = keyword;
        if (this.clearBtn) {
            this.clearBtn.classList.remove('d-none');
        }

        try {
            const result = await this.apiService.getWithAbort(
                `${this.endpoint}?keyword=${encodeURIComponent(keyword)}&page=${this.currentPage}`,
                {}
            );

            this.renderResults(result, append);
        } catch (error) {
            if (error.name !== 'AbortError') {
                console.error('Search error:', error);
                this.dropdown.innerHTML = '<div class="dropdown-item">Error loading results</div>';
            }
        }
    }

    renderResults(result, append) {
        if (!append) {
            this.dropdown.innerHTML = '';
        }

        // Remove existing show more button if appending
        const oldShowMore = this.dropdown.querySelector('.show-more');
        if (oldShowMore) {
            oldShowMore.remove();
        }

        // Add user items
        result.data.forEach(user => {
            this.dropdown.appendChild(this.createUserItem(user));
        });

        // Add show more button if there are more results
        if (result.has_more) {
            this.dropdown.appendChild(this.createShowMoreButton());
        }

        this.hasMorePages = result.has_more;
        this.dropdown.classList.remove('d-none');
    }

    createUserItem(user) {
        const item = document.createElement('div');
        item.className = 'dropdown-item';
        item.textContent = user.name;
        item.dataset.userId = user.id;
        item.dataset.userName = user.name;
        item.dataset.headcountCode = user.headcount_code;
        
        item.addEventListener('click', () => {
            this.selectUser(user);
        });
        
        return item;
    }

    createShowMoreButton() {
        const btn = document.createElement('div');
        btn.className = 'dropdown-item show-more';
        btn.style.textAlign = 'center';
        btn.style.cursor = 'pointer';
        btn.textContent = 'Show More';
        
        btn.addEventListener('click', () => {
            this.currentPage += 1;
            this.fetchResults(this.lastKeyword, true);
        });
        
        return btn;
    }

    async selectUser(user) {
        this.input.value = user.name;
        this.stateManager.update('user_id', user.id);
        this.hideDropdown();
        
        if (this.clearBtn) {
            this.clearBtn.classList.remove('d-none');
        }

        // Update request data if available
        if (typeof requestData !== 'undefined') {
            requestData.user_id = user.id;
        }

        // Trigger org chart actions if functions exist
        if (typeof revealPathAndFocusSingle === 'function' && user.headcount_code) {
            await revealPathAndFocusSingle([user.headcount_code], { strictReset: true });
        }

        // Trigger apply if the function exists
        if (window.orgChartFilter && typeof window.orgChartFilter.filterManager.applyFilters === 'function') {
            await window.orgChartFilter.filterManager.applyFilters();
        }

        if (typeof zoomToNode === 'function' && user.headcount_code) {
            await zoomToNode(user.headcount_code);
        }
    }

    clear() {
        this.input.value = '';
        this.stateManager.update('user_id', null);
        this.currentPage = 1;
        this.hideDropdown();
        
        if (this.clearBtn) {
            this.clearBtn.classList.add('d-none');
        }

        if (typeof requestData !== 'undefined') {
            requestData.user_id = null;
        }

        // Trigger apply
        if (window.orgChartFilter && typeof window.orgChartFilter.filterManager.applyFilters === 'function') {
            window.orgChartFilter.filterManager.applyFilters();
        }
    }

    hideDropdown() {
        if (this.dropdown) {
            this.dropdown.classList.add('d-none');
            this.dropdown.innerHTML = '';
        }
        if (this.clearBtn && !this.input.value) {
            this.clearBtn.classList.add('d-none');
        }
    }
}