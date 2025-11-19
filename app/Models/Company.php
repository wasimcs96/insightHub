<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $connection = 'mongodb';

    protected $collection = 'core_model_organization';
}
