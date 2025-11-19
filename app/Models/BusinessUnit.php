<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\BelongsToTenant;

class BusinessUnit extends Model
{
    use HasFactory;

    use BelongsToTenant;

    protected $table = 'business_units';

    // Specify which attributes can be mass assignable
    protected $fillable = [
        'name', 
        'status', 
        'company_id',
        'tenant_id'
    ];

    public function company()
    {
        return $this->belongsTo('App\Models\User', 'company_id', 'id');
    }

    public function division()
    {
        return $this->hasMany(Division::class);
    }

        public function tenant()
        {
            return $this->belongsTo(Tenant::class);
        }
}
