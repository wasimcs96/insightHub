<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionUnit extends Model
{
    use HasFactory;

    protected $fillable = ['department_id', 'department_section_id', 'name', 'status', 'company_id', 'division_id'];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function departmentSection()
    {
        return $this->belongsTo(DepartmentSection::class);
    }

    public function division()
    {
        return $this->belongsTo(Department::class);
    }
}
