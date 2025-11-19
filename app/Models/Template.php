<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    use HasFactory;

    protected $fillable = [
        'tenant_id',
        'module_id',
        'action_key',
        'title',
        'description',
        'email_content',
        'subject',
        'body',
        'placeholders',
        'type',
        'updated_by',
    ];

    protected $casts = [
        'placeholders' => 'array', // Cast JSON automatically to PHP array
    ];

    /**
     * Relationship: Template updated by a user
     */
    public function updatedByUser()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function module()
    {
        return $this->belongsTo(Module::class, 'module_id');
    }
}
