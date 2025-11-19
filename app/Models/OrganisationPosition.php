<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class OrganisationPosition extends Model
{
    use HasFactory;

    protected $table = "organisation_position";

    protected $fillable = [
        'title', 'job_id', 'user_id', 'department_id', 'parent_id', 'superior_id', 'is_open','additional_department_id'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->unique_code = (string) Str::uuid();
        });
    }

        /**
     * Get the user associated with the organisation position.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the job associated with the organisation position.
     */
    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    /**
     * Get the department associated with the organisation position.
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * Get the parent position.
     */
    public function parent()
    {
        return $this->belongsTo(OrganisationPosition::class, 'parent_id');
    }

    /**
     * Get the sub-positions for the organisation position.
     */
    public function subPositions()
    {
        return $this->hasMany(OrganisationPosition::class, 'parent_id');
    }

}
