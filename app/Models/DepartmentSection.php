<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartmentSection extends Model
{
    use HasFactory;

    protected $fillable = ['department_id', 'name', 'status','company_id', 'division_id'];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function sectionUnits()
    {
        return $this->hasMany(SectionUnit::class, 'department_section_id');
    }

    public function division()
    {
        return $this->belongsTo(Department::class);
    }
}
