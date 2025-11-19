<?php
// app/Models/OrgChartVersion.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrgChartVersion extends Model
{
    protected $guarded = [
    ];

    protected $casts = [
        'old_structure' => 'array',
        'new_structure' => 'array',
        'changes'       => 'array',
    ];
}
