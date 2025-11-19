 window.SearchableDropdown = class {
    constructor(wrapperSelector, fetchUrl, { onSelect = null, onSearch = null, placeholderText = 'Select an employee' } = {}) {
        this.wrapper = document.querySelector(wrapperSelector);
        if (!this.wrapper) return;

        // Configuration options
        this.fetchUrl = fetchUrl;
        this.onSelect = onSelect; // Callback for item selection
        this.onSearch = onSearch; // Callback for search term input
        this.placeholderText = placeholderText;

        // Elements for the dropdown
        this.selectControl = this.wrapper.querySelector('.select-control');
        this.selectValue = this.wrapper.querySelector('.select-value');
        this.dropdown = this.wrapper.querySelector('.select-dropdown');
        this.searchInput = this.wrapper.querySelector('.search-input');
        this.optionsList = this.wrapper.querySelector('.options-list');
        this.dropdownMessage = this.wrapper.querySelector('.dropdown-message');

        this.isOpen = false;
        this.allEmployees = [];
        this.selectedValue = null;

        this.initialize();
    }

    initialize() {
        // Event listeners for interactions
        this.selectControl.addEventListener('click', () => this.toggleDropdown());
        this.searchInput.addEventListener('input', () => this.fetchEmployees(this.searchInput.value));

        // Close the dropdown when clicking outside
        document.addEventListener('click', (event) => {
            if (!this.wrapper.contains(event.target)) {
                this.closeDropdown();
            }
        });

        // Initialize the select element with placeholder text
        this.selectValue.textContent = this.placeholderText;
        this.selectValue.classList.add('placeholder');
    }

    // Fetch employee data dynamically using AJAX
    fetchEmployees(query = '') {
        const newAssignedEmployees = []; // Replace with actual logic for excluding employees
        fetch(this.fetchUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                '_token': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                query: query,
                exclueEmployeesList: newAssignedEmployees,
                _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            })
        })
        .then(response => response.json())
        .then(data => {
            this.allEmployees = data.results;
            this.renderOptions(query); // Re-render options after data is fetched
        })
        .catch(error => console.error('Error fetching employee data:', error));
    }

    // Render the filtered employee options
    renderOptions(searchTerm = '') {
        this.optionsList.innerHTML = ''; // Clear previous options

        if (!searchTerm) {
            this.dropdownMessage.style.display = 'block';
            return;
        }

        this.dropdownMessage.style.display = 'none';
        const filtered = this.allEmployees.filter(employee => {
            if (employee.text && typeof employee.text === 'string') {
                return employee.text.toLowerCase().includes(searchTerm.toLowerCase());
            }
            return false;
        });

        if (filtered.length === 0) {
            const li = document.createElement('li');
            li.className = 'no-options';
            li.textContent = 'No options found';
            this.optionsList.appendChild(li);
        } else {
            filtered.forEach(employee => {
                const li = document.createElement('li');
                li.className = 'option';
                li.textContent = employee.text || 'Unknown Employee'; // Handle missing name
                if (employee.text === this.selectedValue) {
                    li.classList.add('selected');
                }
                li.addEventListener('click', () => this.handleSelectOption(employee));
                this.optionsList.appendChild(li);
            });
        }
    }

    // Handle selecting an option
    handleSelectOption(employee) {
        this.selectedValue = employee.text;
        this.selectValue.textContent = employee.text;
        this.selectValue.classList.remove('placeholder');
        this.closeDropdown();

        // Trigger the onSelect callback if provided
        if (this.onSelect) {
            this.onSelect(employee);
        }
    }

    // Toggle the dropdown open/close
    toggleDropdown() {
        this.isOpen ? this.closeDropdown() : this.openDropdown();
    }

    // Open the dropdown
    openDropdown() {
        this.dropdown.style.display = 'flex';
        this.selectControl.setAttribute('aria-expanded', 'true');
        this.isOpen = true;
        this.searchInput.focus();

        // Check if the search term is already present in allEmployees
        this.renderOptions(this.searchInput.value); // Render options from existing data
    }

    // Close the dropdown
    closeDropdown() {
        this.dropdown.style.display = 'none';
        this.selectControl.setAttribute('aria-expanded', 'false');
        this.isOpen = false;
    }
}