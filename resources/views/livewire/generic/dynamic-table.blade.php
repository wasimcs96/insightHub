@once
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/dynamic-table.css') }}">
    @endpush
@endonce

@once
    @push('scripts')
        <script src="{{ asset('js/components/dynamic-table/dynamic-table.js') }}"></script>
    @endpush
@endonce

<div class="card-body py-4">
    <div class="d-flex flex-column card-toolbar m-4 gap-4">
        <div class="w-100 h-40px d-flex justify-content-between gap-2" data-kt-user-table-toolbar="base">
            @if ($this->isSearchable())
                <div class="px-4 h-2 dt-search-container d-flex align-items-center">
                    <span class="border-0 bg-transparent p-0 me-2 d-flex">
                        <iconify-icon icon="mingcute:search-line" width="16" height="16"
                            style="color: #99A1B7"></iconify-icon>
                    </span>
                    <input type="text" id="searchInput" class="border-0 shadow-none p-0 w-100" placeholder="Search"
                        wire:model.live.debounce.250ms="searchTerm">
                </div>
            @endif

            <div class="ml-auto d-flex gap-4">
                @if ($this->isExportableAs('csv'))
                    @foreach ($this->toolbarComponents as $component)
                        <x-dynamic-component :component="$component" :dynamicTable="$this" />
                    @endforeach
                    <button class="btn btn-secondary" type="button">
                        Export as CSV
                    </button>
                @endif
            </div>
        </div>
        @if ($this->selectEnabled)
            <div class="d-flex flex-column gap-2">
                <h6>Found {{ $this->items->total() }} results</h6>
                <div class="d-flex gap-2">
                    <div class="d-flex align-items-center gap-4">
                        <button class="btn btn-primary" wire:click="$set('showOnlySelected', true)"
                            {{ $this->addAttributeIf($this->showOnlySelected, 'disabled') }}>Show Selected</button>
                        <button class="btn btn-secondary" wire:click="$set('showOnlySelected', false)"
                            {{ $this->addAttributeIf(!$this->showOnlySelected, 'disabled') }}>Show All Data</button>
                        <p class="m-0 fw-medium fs-6" style="color: #252F4A;">{{ count($this->selectedItems) }} selected
                        </p>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <div class="dt-container">
        <table class="dt">
            <thead>
                <tr>
                    @if ($selectEnabled)
                        <th class="dt-sticky-column">
                            <div class="d-flex align-items-center gap-2">
                                <input type="checkbox" id="dt-select-all" wire:click="mutateSelection"
                                    {{ $this->addAttributeIf($this->allIsSelected(), 'checked') }}>
                            </div>
                        </th>
                    @endif

                    @foreach ($columns as $column)
                        <th role="button" @class([
                            'dt-sticky-column' => $this->isStickyColumn($column),
                            'dt-sorted-column' => $this->isSortedColumn($column),
                        ]) wire:click="sort('{{ $column }}')">
                            <div class="d-flex align-items-center gap-2">
                                <span>{!! $this->renderColumnHeader($column) !!}</span>
                                @if ($this->sortBy === $column)
                                    @if ($this->sortDirection === self::SORT_ASC)
                                        <div class="d-flex flex-column flex-shrink-0 filter-icons"
                                            style="font-size: 1.5rem">
                                            <iconify-icon icon="stash:chevron-down-solid"
                                                class="info cursor-pointer"></iconify-icon>
                                        </div>
                                    @else
                                        <div class="d-flex flex-column flex-shrink-0 filter-icons"
                                            style="font-size: 1.5rem">
                                            <iconify-icon icon="stash:chevron-up-solid"
                                                class="info cursor-pointer"></iconify-icon>
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </th>
                    @endforeach
                </tr>
            </thead>

            <tbody>
                @foreach ($items as $item)
                    <tr>
                        @if ($selectEnabled)
                            <td class="dt-sticky-column">
                                <input id="dt-select-{{ $item->id }}" type="checkbox" class="select-row"
                                    wire:click="mutateSelection({{ $item->id }})"
                                    {{ $this->addAttributeIf($this->isSelected($item->id), 'checked') }} />
                            </td>
                        @endif

                        @foreach ($columns as $column)
                            <td @class([
                                'dt-sticky-column' => $this->isStickyColumn($column),
                                'dt-sorted-column' => $this->isSortedColumn($column),
                            ])>{!! $this->renderColumnData($column, $item) !!}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex align-items-center p-4 pb-0">
        <div class="d-flex align-items-center">
            <span class="page-text">Rows per page</span>
            <select class="form-select form-select-sm page-input-box">
                @foreach ($this->paginationOptions as $paginationOption)
                    <option wire:click="$set('paginationLimit', {{ $paginationOption }})"
                        value="{{ $paginationOption }}"
                        {{ $paginationOption === $this->paginationLimit ? 'selected' : '' }}>
                        {{ $paginationOption }}
                    </option>
                @endforeach
            </select>
        </div>

        {{ $items->links() }}
    </div>
</div>
