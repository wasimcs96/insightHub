    @once
        @push('scripts')
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    const today = new Date().toISOString().split('T')[0];

                    const startDatePicker = flatpickr("#ocf-startDate", {
                        dateFormat: "Y-m-d",
                        // minDate: new Date(new Date().getTime() + 86400000).toISOString().split('T')[0],
                        disableMobile: true,
                        onChange: function(selectedDates, dateStr) {
                            const endDatePicker = flatpickr("#ocf-endDate");
                            endDatePicker.set("minDate", new Date(selectedDates[0].getTime() + 86400000));
                        }
                    });

                    const endDatePicker = flatpickr("#ocf-endDate", {
                        dateFormat: "Y-m-d",
                        // defaultDate: document.getElementById("startDate").value || today,
                        defaultDate: today,
                        maxDate: today,
                        disableMobile: true,
                    });
                });
            </script>
        @endpush
    @endonce

    <button class="btn btn-secondary" type="button" data-bs-toggle="offcanvas" data-bs-target="#ocf-offcanvas"
        aria-controls="ocf-offcanvas">
        Filters &amp; sort
    </button>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="ocf-offcanvas">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">Filters &amp; Sort</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <form class="d-flex justify-content-between offcanvas-body pt-2" onsubmit="(e => e.preventDefault())(event)">
            <div class="w-100 form-group d-flex flex-column justify-content-between">
                <div>
                    <label class="w-100">
                        <div class="d-flex justify-content-between">
                            <h4>Sort By</h4>
                            <a class="text-small cursor-pointer" wire:click="resetConstraints(['sortBy','sortDirection'])">Reset to default</a>
                        </div>
                        <select class="form-control"
                            onchange="(e => {
                            @this.set('sortBy', e.target.selectedOptions[0].dataset['column'], true)
                            @this.set('sortDirection', e.target.selectedOptions[0].dataset['direction'], true)
                            })(event)">
                            <option value=""
                                {{ $this->addAttributeIf($this->sortBy === null && $this->sortDirection === null, 'selected') }}>
                                Default</option>
                            <option value="1" data-column="created_at" data-direction="{{ self::SORT_DESC }}"
                                {{ $this->addAttributeIf($this->sortBy === 'created_at' && $this->sortDirection === self::SORT_DESC, 'selected') }}>
                                Most Recent</option>
                            <option value="2" data-column="created_at" data-direction="{{ self::SORT_ASC }}"
                                {{ $this->addAttributeIf($this->sortBy === 'created_at' && $this->sortDirection === self::SORT_ASC, 'selected') }}>
                                Oldest</option>
                        </select>
                    </label>

                    <hr class="my-10" />

                    <div class="d-flex flex-column gap-5">
                        <div class="d-flex justify-content-between">
                            <h3>Filters</h3>
                            <a class="text-small cursor-pointer" wire:click="resetConstraints(['includeFilter','timeFilter'])">Reset to default</a>
                        </div>

                        <label>
                            <h4>Change Type</h4>
                            <select wire:model.defer="includeFilter.change_type" class="form-control">
                                <option value="">All</option>
                                @foreach ($types as $type)
                                    <option value="{{ $type }}">{{ $type }}</option>
                                @endforeach
                            </select>
                        </label>

                        <label>
                            <h4>Change By</h4>
                            <select wire:model.defer="includeFilter.change_by" class="form-control">
                                <option value="">All</option>
                                @foreach ($usernames as $username)
                                    {{-- could be optimized with lazy loading --}}
                                    <option value="{{ $username }}">{{ $username }}</option>
                                @endforeach
                            </select>
                        </label>

                        <label>
                            <h4>Source</h4>
                            <select wire:model.defer="includeFilter.source" class="form-control">
                                <option value="">All</option>
                                @foreach ($sources as $source)
                                    <option value="{{ $source }}">{{ $source }}</option>
                                @endforeach
                            </select>
                        </label>

                        <div>
                            <h4>Date Range</h4>
                            <div class="d-flex gap-4">
                                <div class="">
                                    <div class="input-group">
                                        <input type="date" id="ocf-startDate"
                                            class="form-control date-input bg-white border-end-0" required
                                            placeholder="Start Date" wire:model.defer="timeFilter.start"
                                            {{-- value="{{ $draftMode || $editMode ? $jobOpeningData->application_period_start_date : date('Y-m-d') }}" --}} min="{{ date('Y-m-d') }}">
                                        <span class="input-group-text bg-white">
                                            <iconify-icon icon="uil:calender" width="16"
                                                height="16"></iconify-icon>
                                        </span>
                                    </div>
                                </div>

                                <div class="">
                                    <div class="input-group">
                                        <input type="date" id="ocf-endDate"
                                            class="form-control date-input bg-white border-end-0" required
                                            min="{{ date('Y-m-d', strtotime('+1 day')) }}" placeholder="End Date"
                                            wire:model.defer="timeFilter.end">
                                        <!-- Added placeholder -->
                                        <span class="input-group-text bg-white">
                                            <iconify-icon icon="uil:calender" width="16"
                                                height="16"></iconify-icon>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex w-100 gap-2">
                    <button class="btn btn-secondary flex-grow-1" data-bs-dismiss="offcanvas" aria-label="Close" type="reset">
                        Cancel
                    </button>
                    <button class="btn btn-secondary flex-grow-1" type="submit" wire:click="$refresh">
                        Apply
                    </button>
                </div>
            </div>

        </form>
    </div>
