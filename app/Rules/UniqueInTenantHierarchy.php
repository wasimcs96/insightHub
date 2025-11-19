<?php
// filepath: /Applications/XAMPP/xamppfiles/htdocs/jc-diamond/app/Rules/UniqueInTenantHierarchy.php
 
namespace App\Rules;
 
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;
 
class UniqueInTenantHierarchy implements Rule
{
    protected $table;
    protected $column;
    protected $parentColumn;
    protected $parentId;
    protected $ignoreId;
    protected $tenantColumn;
    protected $message;
 
    public function __construct(
        string $table,
        string $column = 'name',
        ?string $parentColumn = null,
        ?int $parentId = null,
        ?int $ignoreId = null,
        string $tenantColumn = 'tenant_id',
        string $message = ''
    ) {
        $this->table = $table;
        $this->column = $column;
        $this->parentColumn = $parentColumn;
        $this->parentId = $parentId;
        $this->ignoreId = $ignoreId;
        $this->tenantColumn = $tenantColumn;
        $this->message = $message;
    }
 
    public function passes($attribute, $value)
    {
        $tenantId = app('tenant')->getCurrentTenantId();
        if (!$tenantId) {
            return false;
        }
 
        $query = DB::table($this->table)
            ->where($this->column, $value)
            ->where($this->tenantColumn, $tenantId);
 
        // Add parent scope if specified
        if ($this->parentColumn && $this->parentId) {
            $query->where($this->parentColumn, $this->parentId);
        }
 
        // Ignore current record for updates
        if ($this->ignoreId) {
            $query->where('id', '!=', $this->ignoreId);
        }
 
        return !$query->exists();
    }
 
    public function message()
    {
        return $this->message ?? "The {$this->column} has already been taken within this scope.";
    }
 
    // Fluent methods for chaining
    public static function for(string $table): self
    {
        return new static($table);
    }
 
    public function column(string $column): self
    {
        $this->column = $column;
        return $this;
    }
 
    public function withinParent(string $parentColumn, ?int $parentId): self
    {
        $this->parentColumn = $parentColumn;
        $this->parentId = $parentId;
        return $this;
    }
 
    public function ignore(?int $id): self
    {
        $this->ignoreId = $id;
        return $this;
    }
 
    public function withMessage(string $message): self
    {
        $this->message = $message;
        return $this;
    }
}