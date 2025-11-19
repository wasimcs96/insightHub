<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessKey extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = ['key', 'origins', 'https', 'ips', 'supplier_id'];

    /**
     * @var string[]
     */
    protected $casts = [
        'origins' => AsArrayObject::class,
        'ips' => AsArrayObject::class
    ];
}
