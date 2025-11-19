<div class="w-100">
    <label for="department" class="fw-semibold fs-6 mb-2">Department</label>
    {{-- {{ dd($departments) }} --}}
    
    @if (!empty($selectedDivision) && (empty($departments) || $departments->isEmpty()))
        <div class="custom-dropdown-select" id="department-custom-select">
            <div class="dropdown">
                <div class="form-select d-flex align-items-center justify-content-between" style="cursor: pointer; appearance: none; background-image: none;" id="department-select-trigger">
                    <span class="text-muted">Select Department</span>
                    <i class="bi bi-chevron-down"></i>
                </div>
                <div class="dropdown-list" id="department-dropdown-message" style="display: none; position: absolute; z-index: 1000; border: 1px solid #DBDFE9; border-radius: 4px; background: #FFF; margin-top: 8px; width: 100%;">
                    <div class="p-4 text-center">
                        <p class="mb-3" style="color: #4B5675; font-size: 14px; line-height: 20px;">
                            No departments have been added to this Company/Division yet. Please go to Insight Hub to create one.
                        </p>
                        <a href="{{ route('hubcenter.dashboard') }}" class="btn btn-sm insight-hub-btn" target="_blank" style="padding: 12px 18px; border-radius: 4px; border: 1px solid #F7941C; background: #FFF; color: #F7941C; font-size: 12px; font-weight: 600; text-decoration: none; display: inline-block; transition: all 0.2s;">
                            Go to Insight Hub
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <style>
            .insight-hub-btn:hover {
                background: #F7941C !important;
                color: #FFF !important;
            }
        </style>
        <script>
            (function() {
                const trigger = document.getElementById('department-select-trigger');
                const dropdown = document.getElementById('department-dropdown-message');
                const customSelect = document.getElementById('department-custom-select');
                
                if (trigger && dropdown) {
                    trigger.addEventListener('click', function(e) {
                        e.stopPropagation();
                        if (dropdown.style.display === 'none' || dropdown.style.display === '') {
                            dropdown.style.display = 'block';
                        } else {
                            dropdown.style.display = 'none';
                        }
                    });
                    
                    document.addEventListener('click', function(e) {
                        if (customSelect && !customSelect.contains(e.target)) {
                            dropdown.style.display = 'none';
                        }
                    });
                }
            })();
        </script>
    @else
        <select id="department" class="form-select" wire:model="selectedDepartment" wire:change="$emit('departmentSelected', $event.target.value)" {{ (empty($departments) || $departments->isEmpty()) ? 'disabled' : '' }}>
            <option value="">Select Department</option>
            @foreach ($departments as $department)
                <option value="{{ $department->id }}" {{ $department->id == $selectedDepartment ? 'selected' : '' }}>{{ $department->name }}</option>
            @endforeach
        </select>
    @endif
</div>