<?php

namespace App\Http\Livewire\Generic;

use function Opis\Closure\{serialize, unserialize};
use Barryvdh\Debugbar\Facades\Debugbar;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class DynamicTable extends Component
{
    use WithPagination;

    const EMPTY_COLUMN_DISPLAY = '-';

    public array $filters = [];

    const SORT_ASC = 'asc';
    const SORT_DESC = 'desc';

    protected $paginationTheme = 'bootstrap';

    public array $paginationOptions = [10, 20, 30, 50];

    public Model|string $model;
    protected LengthAwarePaginator|null $items = null;

    public string|null $searchTerm = null;
    public array $searchableColumns = [];

    public string|null $sortBy = null;
    public string|null $sortDirection = null;

    public array $columns = [];
    public array|string $dataDisplay = [];
    public array|string $headerDisplay = [];

    public array $includeFilter = [];
    public array $excludeFilter = [];
    public array $timeFilter = [];
    public string $timeFilterColumn = 'created_at';

    public array $stickyColumns = [];

    public bool $selectEnabled = false;
    public array $selectedItems = [];
    public bool $showOnlySelected = false;

    public int $paginationLimit = 10;

    public array $exportable = [];

    public array $toolbarComponents = [];

    protected $queryString = [
        'searchTerm' => ['except' => '', 'as' => 'q'],
        'sortBy' => ['except' => null, 'as' => 'sb'],
        'sortDirection' => ['except' => null, 'as' => 'sd'],
        'paginationLimit' => ['except' => 10, 'as' => 'lim'],
        'includeFilter' => ['except' => [], 'as' => 'inc'],
        'excludeFilter' => ['except' => [], 'as' => 'exc'],
        'timeFilter' => ['except' => [], 'as' => 't'],
        // 'selectedItems' => ['except' => [], 'as' => 'sel'], // commented out, worried about url len limit
    ];

    function mount(): void
    {
        $this->model = app($this->model);
    }

    function hydrate(): void
    {
        $this->dataDisplay = unserialize($this->dataDisplay);
        $this->headerDisplay = unserialize($this->headerDisplay);
        $this->evaluateResults();
    }

    function dehydrate(): void
    {
        $this->dataDisplay = serialize($this->dataDisplay);
        $this->headerDisplay = serialize($this->headerDisplay);
    }

    protected function defaultHeaderRenderer(string $columnName): string
    {
        return Str::of($columnName)->replace('_', ' ')->title;
    }

    function renderColumnHeader(string $column): string
    {
        if (isset($this->headerDisplay[$column])) {
            if (is_callable($this->headerDisplay[$column])) {
                return $this->headerDisplay[$column]($column);
            }
            return $this->headerDisplay[$column];
        }
        return $this->defaultHeaderRenderer($column);
    }

    protected function defaultDataRenderer($data): string
    {
        return ($data === null || $data === '') ? self::EMPTY_COLUMN_DISPLAY : trim($data);
    }

    function renderColumnData(string $column, Model $item): string
    {
        if (isset($this->dataDisplay[$column])) {
            return $this->dataDisplay[$column]($item->$column, $item);
        }
        return $this->defaultDataRenderer($item->$column);
    }

    function isStickyColumn(string $column): bool
    {
        return in_array($column, $this->stickyColumns, true);
    }

    function isSortedColumn(string $column): bool
    {
        return $column === $this->sortBy;
    }

    function isSelected(string $id): bool
    {
        return array_key_exists($id, $this->selectedItems);
    }

    function allIsSelected(): bool
    {
        return count($this->selectedItems) >= $this->items->total();
    }

    function isSearchable(): bool
    {
        return count($this->searchableColumns) > 0;
    }

    function isExportableAs(string $format): bool
    {
        return in_array($format, $this->exportable, true);
    }

    function clearSort()
    {
        $this->sortDirection = null;
        $this->sortBy = null;
    }

    function addAttributeIf(bool $condition, string $attribute): string
    {
        if ($condition) {
            return $attribute;
        }
        return '';
    }

    function toggleSortDirection(): void
    {
        switch ($this->sortDirection) {
            case self::SORT_DESC:
                $this->sortDirection = self::SORT_ASC;
                break;

            case self::SORT_ASC:
                $this->clearSort();
                break;

            case null:
                $this->sortDirection = self::SORT_DESC;
                break;
        }
    }

    function sort(string $newSortBy): void
    {
        if ($newSortBy === $this->sortBy) {
            $this->toggleSortDirection();
            return;
        }
        $this->sortBy = $newSortBy;
        $this->sortDirection = self::SORT_DESC;
    }

    function resetConstraints(string|array $fields): void
    {
        $this->reset($fields);
    }

    function mutateSelection(string|null $data = null): void
    {
        $selections = &$this->selectedItems;

        if ($data === null) {
            if ($this->allIsSelected()) {
                $selections = [];
            } else {
                $selections = array_fill_keys($this->makeQuery()->get()->pluck('id')->toArray(), true);
            }
            return;
        }

        if (array_key_exists($data, $selections)) {
            unset($selections[$data]);
        } else {
            $selections[$data] = true;
        }
    }

    function makeQuery(): Builder
    {
        $query = $this->model;

        // sorting
        if ($this->sortBy === null) {
            $query = $query->latest();
        } else {
            $query = $query->orderBy($this->sortBy, $this->sortDirection);
        }

        // searching
        if ($this->isSearchable() && $this->searchTerm !== null) {
            $query = $query->where(function ($q) {
                foreach ($this->searchableColumns as $column) {
                    $q->orWhere($column, 'LIKE', "%{$this->searchTerm}%");
                }
            });
        }

        if (!empty($this->filters)) {
            $query = $query->where(function ($q) {
                foreach ($this->filters as $filter) {
                    if (isset($filter['column'], $filter['operator'], $filter['value'])) {
                        $q->where($filter['column'], $filter['operator'], $filter['value']);
                    }
                }
            });
        }


        // filtering
        if (count($this->includeFilter) > 0) {
            $query = $query->where(function ($q) {
                foreach ($this->includeFilter as $column => $value) {
                    if ($value !== null && $value !== '') {
                        $q->where($column, $value);
                    }
                }
            });
        }
        if (count($this->excludeFilter) > 0) {
            $query = $query->where(function ($q) {
                foreach ($this->excludeFilter as $column => $value) {
                    if ($value !== null && $value !== '') {
                        $q->where($column, '!=', $value);
                    }
                }
            });
        }

        // selected items filter
        if ($this->showOnlySelected) {
            $query = $query->where(function ($q) {
                $q->whereIn('id', array_keys($this->selectedItems));
            });
        }


        // dateTime range filter
        if (count($this->timeFilter) > 0) {
            $query = $query->where(function ($q) {
                $start = $this->timeFilter['start'] ?? Carbon::createFromTime(0, 0, 0)->toDateTimeString();
                $end = $this->timeFilter['end'] ?? Carbon::now()->toDateTimeString();
                $q->whereBetween($this->timeFilterColumn, [$start, $end]);
            });
        }

        return $query;
    }

    function evaluateResults(): void
    {
        $this->items = $this->makeQuery()->paginate($this->paginationLimit);
    }

    function render(): View
    {
        $this->evaluateResults();

        Debugbar::addMessage($this->selectedItems);

        return view('livewire.generic.dynamic-table', [
            'items' => $this->items,
        ]);
    }
}
