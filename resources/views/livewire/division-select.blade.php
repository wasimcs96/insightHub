<div class="w-100">
    <label for="division" class="fw-semibold fs-6 mb-2">Company/Division</label>

    @if (!empty($selectedBusinessUnit) && (empty($divisions) || $divisions->isEmpty()))
        <div class="custom-dropdown-select" id="division-custom-select">
            <div class="dropdown">
                <div class="form-select d-flex align-items-center justify-content-between" style="cursor: pointer; appearance: none; background-image: none;" id="division-select-trigger">
                    <span class="text-muted">Select Company/Division</span>
                    <i class="bi bi-chevron-down"></i>
                </div>
                <div class="dropdown-list" id="division-dropdown-message" style="display: none; position: absolute; z-index: 1000; border: 1px solid #DBDFE9; border-radius: 4px; background: #FFF; margin-top: 8px; width: 100%;">
                    <div class="p-4 text-center">
                        <p class="mb-3" style="color: #4B5675; font-size: 14px; line-height: 20px;">
                            No company/divisions have been added to this Business Unit yet. Please go to Insight Hub to create one.
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
                const trigger = document.getElementById('division-select-trigger');
                const dropdown = document.getElementById('division-dropdown-message');
                const customSelect = document.getElementById('division-custom-select');
                
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
        <select id="division" class="form-select" wire:model="selectedDivision" wire:change="$emit('divisionSelected', $event.target.value)" {{ (empty($divisions) || $divisions->isEmpty()) ? 'disabled' : '' }}>
            <option value="">Select Company/Division</option>
            @foreach ($divisions as $division)
                <option value="{{ $division->id }}" {{ $division->id == $selectedDivision ? 'selected' : '' }}>{{ $division->head_of_division ?? '' }}</option>
            @endforeach
        </select>
    @endif
</div>