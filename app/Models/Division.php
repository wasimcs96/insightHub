<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\BelongsToTenant;

class Division extends Model
{
    use HasFactory;
    use BelongsToTenant;



    protected $fillable = [
        'business_unit_id',
        'head_of_division',
        'status',
        'company_id',
        'tenant_id',
    ];

    public function company()
    {
        return $this->belongsTo('App\Models\User', 'company_id', 'id');
    }

    public function business_unit()
    {
        return $this->belongsTo(BusinessUnit::class);
    }

    public function department()
    {
        return $this->hasMany(Department::class);
    }

    public function section()
    {
        return $this->hasManyThrough(DepartmentSection::class, Department::class);
    }

    public function units()
    {
        return $this->hasManyThrough(SectionUnit::class, Department::class, DepartmentSection::class);
    }

    public function tenant()
        {
            return $this->belongsTo(Tenant::class);
        }

        public static function getValidationRules($businessUnitId = null, $ignoreId = null): array
        {
            return [
                'name' => [
                    'required',
                    'string',
                    'max:255',
                    \App\Rules\UniqueInTenantHierarchy::for('divisions')
                        ->column('name')
                        ->withinParent('business_unit_id', $businessUnitId)
                        ->ignore($ignoreId)
                        ->withMessage('Division name must be unique within this business unit.')
                ],
                'business_unit_id' => 'required|exists:business_units,id',
                'head_of_division' => 'nullable|string|max:255',
                'status' => 'nullable|string|in:active,inactive'
            ];
        }
}
