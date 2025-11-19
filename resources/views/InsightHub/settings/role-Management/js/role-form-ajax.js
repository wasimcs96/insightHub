/**
 * Role Management - Form Handler with Full AJAX
 * Handles create, edit, and duplicate role forms
 */

(function() {
    'use strict';

    // State management
    let selectedPermissions = new Set();
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Initialize on DOM load
    document.addEventListener('DOMContentLoaded', function() {
        initializeForm();
        initializeExpandCollapse();
        initializePermissionToggles();
        initializeFormSubmission();
        initializeCancelButton();
        loadInitialPermissions();
    });

    /**
     * Initialize form
     */
    function initializeForm() {
        const form = document.getElementById('roleForm');
        if (!form) return;

        // Prevent default form submission
        form.addEventListener('submit', function(e) {
            e.preventDefault();
        });
    }

    /**
     * Load initial permissions (for edit/duplicate)
     */
    function loadInitialPermissions() {
        document.querySelectorAll('.granular-permission:checked').forEach(checkbox => {
            selectedPermissions.add(parseInt(checkbox.value));
        });
    }

    /**
     * Initialize expand/collapse all
     */
    function initializeExpandCollapse() {
        const expandBtn = document.getElementById('expandAllBtn');
        if (!expandBtn) return;

        expandBtn.addEventListener('click', function() {
            const isExpanded = this.dataset.expanded === 'true';
            
            if (isExpanded) {
                collapseAll();
                this.dataset.expanded = 'false';
                this.innerHTML = '<iconify-icon icon="bi:arrows-expand" width="20" height="20"></iconify-icon> Expand All';
            } else {
                expandAll();
                this.dataset.expanded = 'true';
                this.innerHTML = '<iconify-icon icon="bi:arrows-collapse" width="20" height="20"></iconify-icon> Collapse All';
            }
        });
    }

    /**
     * Expand all accordions
     */
    function expandAll() {
        document.querySelectorAll('.accordion-button.collapsed').forEach(button => {
            button.click();
        });
    }

    /**
     * Collapse all accordions
     */
    function collapseAll() {
        document.querySelectorAll('.accordion-button:not(.collapsed)').forEach(button => {
            button.click();
        });
    }

    /**
     * Initialize permission toggle switches
     */
    function initializePermissionToggles() {
        // Master "Access" toggles for each section
        document.querySelectorAll('.master-access-toggle').forEach(toggle => {
            toggle.addEventListener('change', function() {
                handleMasterToggle(this);
            });
            
            // Initialize state
            handleMasterToggle(toggle, true);
        });

        // Granular permission checkboxes
        document.querySelectorAll('.granular-permission').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                handleGranularChange(this);
            });
        });

        // "All" checkboxes (select all permissions in a row)
        document.querySelectorAll('.permission-all').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                handleAllToggle(this);
            });
        });
    }

    /**
     * Handle master toggle change
     */
    function handleMasterToggle(toggle, initialization = false) {
        const container = toggle.closest('.permission-section');
        if (!container) return;

        const isChecked = toggle.checked;
        const granularCheckboxes = container.querySelectorAll('.granular-permission');
        const allCheckboxes = container.querySelectorAll('.permission-all');
        
        // Enable/disable all checkboxes
        granularCheckboxes.forEach(checkbox => {
            checkbox.disabled = !isChecked;
            if (!isChecked && !initialization) {
                checkbox.checked = false;
                selectedPermissions.delete(parseInt(checkbox.value));
            }
        });

        allCheckboxes.forEach(checkbox => {
            checkbox.disabled = !isChecked;
            if (!isChecked && !initialization) {
                checkbox.checked = false;
            }
        });

        updatePermissionCount();
    }

    /**
     * Handle "All" toggle change
     */
    function handleAllToggle(checkbox) {
        const row = checkbox.closest('.permission-row');
        if (!row) return;

        const isChecked = checkbox.checked;
        const granularCheckboxes = row.querySelectorAll('.granular-permission:not([disabled])');
        
        granularCheckboxes.forEach(cb => {
            cb.checked = isChecked;
            if (isChecked) {
                selectedPermissions.add(parseInt(cb.value));
            } else {
                selectedPermissions.delete(parseInt(cb.value));
            }
        });

        updatePermissionCount();
    }

    /**
     * Handle granular permission change
     */
    function handleGranularChange(checkbox) {
        const permissionId = parseInt(checkbox.value);
        
        if (checkbox.checked) {
            selectedPermissions.add(permissionId);
        } else {
            selectedPermissions.delete(permissionId);
            
            // Uncheck "All" checkbox if any granular is unchecked
            const row = checkbox.closest('.permission-row');
            if (row) {
                const allCheckbox = row.querySelector('.permission-all');
                if (allCheckbox) {
                    allCheckbox.checked = false;
                }
            }
        }

        // Update "All" checkbox state
        updateAllCheckboxState(checkbox);
        updatePermissionCount();
    }

    /**
     * Update "All" checkbox state based on granular checkboxes
     */
    function updateAllCheckboxState(checkbox) {
        const row = checkbox.closest('.permission-row');
        if (!row) return;

        const allCheckbox = row.querySelector('.permission-all');
        if (!allCheckbox) return;

        const granularCheckboxes = Array.from(row.querySelectorAll('.granular-permission:not([disabled])'));
        const allChecked = granularCheckboxes.length > 0 && granularCheckboxes.every(cb => cb.checked);
        
        allCheckbox.checked = allChecked;
    }

    /**
     * Update permission count display
     */
    function updatePermissionCount() {
        const countEl = document.getElementById('permissionCount');
        if (countEl) {
            countEl.textContent = selectedPermissions.size;
        }
    }

    /**
     * Initialize form submission
     */
    function initializeFormSubmission() {
        const submitBtn = document.getElementById('submitBtn');
        if (!submitBtn) return;

        submitBtn.addEventListener('click', function(e) {
            e.preventDefault();
            submitForm();
        });
    }

    /**
     * Submit form via AJAX
     */
    function submitForm() {
        // Get form data
        const roleName = document.getElementById('roleName').value.trim();
        const roleDescription = document.getElementById('roleDescription').value.trim();
        
        // Validate
        if (!validateForm(roleName)) {
            return;
        }

        // Get form action and method
        const form = document.getElementById('roleForm');
        const action = form.getAttribute('action');
        const method = form.dataset.method || 'POST';

        // Prepare data
        const formData = {
            name: roleName,
            description: roleDescription,
            permissions: Array.from(selectedPermissions)
        };

        // Show loading state
        setSubmitButtonLoading(true);

        // Submit via AJAX
        fetch(action, {
            method: method,
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify(formData)
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(err => Promise.reject(err));
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                showSuccess(data.message);
                
                // Redirect after short delay
                setTimeout(() => {
                    window.location.href = '{{ route("insighthub.role-management.index") }}';
                }, 1500);
            } else {
                showError(data.message || 'An error occurred');
                setSubmitButtonLoading(false);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            
            if (error.message) {
                showError(error.message);
            } else if (error.errors) {
                // Validation errors
                const firstError = Object.values(error.errors)[0];
                showError(Array.isArray(firstError) ? firstError[0] : firstError);
            } else {
                showError('An error occurred while saving the role');
            }
            
            setSubmitButtonLoading(false);
        });
    }

    /**
     * Validate form
     */
    function validateForm(roleName) {
        // Clear previous errors
        clearErrors();

        let isValid = true;

        // Validate role name
        if (!roleName) {
            showFieldError('roleName', 'Role name is required.');
            isValid = false;
        }

        // Optional: Check if at least one permission is selected
        // if (selectedPermissions.size === 0) {
        //     showError('Please select at least one permission.');
        //     isValid = false;
        // }

        return isValid;
    }

    /**
     * Show field error
     */
    function showFieldError(fieldId, message) {
        const field = document.getElementById(fieldId);
        if (!field) return;

        field.classList.add('is-invalid');
        
        // Create or update error message
        let errorEl = field.parentElement.querySelector('.invalid-feedback');
        if (!errorEl) {
            errorEl = document.createElement('div');
            errorEl.className = 'invalid-feedback';
            field.parentElement.appendChild(errorEl);
        }
        errorEl.textContent = message;
        errorEl.style.display = 'block';
    }

    /**
     * Clear all errors
     */
    function clearErrors() {
        document.querySelectorAll('.is-invalid').forEach(el => {
            el.classList.remove('is-invalid');
        });
        document.querySelectorAll('.invalid-feedback').forEach(el => {
            el.style.display = 'none';
        });
    }

    /**
     * Set submit button loading state
     */
    function setSubmitButtonLoading(loading) {
        const submitBtn = document.getElementById('submitBtn');
        const submitText = document.getElementById('submitText');
        const submitSpinner = document.getElementById('submitSpinner');
        
        if (!submitBtn) return;

        if (loading) {
            submitBtn.disabled = true;
            if (submitText) submitText.style.display = 'none';
            if (submitSpinner) submitSpinner.style.display = 'inline-block';
        } else {
            submitBtn.disabled = false;
            if (submitText) submitText.style.display = 'inline';
            if (submitSpinner) submitSpinner.style.display = 'none';
        }
    }

    /**
     * Initialize cancel button
     */
    function initializeCancelButton() {
        const cancelBtn = document.getElementById('cancelBtn');
        if (!cancelBtn) return;

        cancelBtn.addEventListener('click', function(e) {
            e.preventDefault();
            
            if (confirm('Are you sure you want to cancel? Any unsaved changes will be lost.')) {
                window.location.href = '{{ route("insighthub.role-management.index") }}';
            }
        });
    }

    /**
     * Show success message
     */
    function showSuccess(message) {
        showToast(message, 'success');
    }

    /**
     * Show error message
     */
    function showError(message) {
        showToast(message, 'error');
    }

    /**
     * Show toast notification
     */
    function showToast(message, type = 'success') {
        // Check if toastr is available
        if (typeof toastr !== 'undefined') {
            toastr[type](message);
            return;
        }

        // Fallback toast
        const toast = document.createElement('div');
        toast.className = `toast-notification toast-${type}`;
        toast.textContent = message;
        toast.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 16px 24px;
            background: ${type === 'success' ? '#DDF5E2' : '#FFEBE9'};
            color: ${type === 'success' ? '#19622A' : '#C5221F'};
            border-radius: 8px;
            border: 1px solid ${type === 'success' ? '#BBECC5' : '#FFB4AB'};
            z-index: 9999;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            font-size: 14px;
            max-width: 400px;
        `;
        
        document.body.appendChild(toast);
        
        setTimeout(() => {
            toast.remove();
        }, 5000);
    }

    /**
     * Real-time validation
     */
    document.getElementById('roleName')?.addEventListener('input', function() {
        if (this.value.trim()) {
            this.classList.remove('is-invalid');
            const errorEl = this.parentElement.querySelector('.invalid-feedback');
            if (errorEl) errorEl.style.display = 'none';
        }
    });

})();