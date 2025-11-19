<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GetUserDataController extends Controller
{
    public function getUserData()
{
    $results = DB::table('users as x')
        ->select([
            'x.id', 
            'x.name', 
            'x.email', 
            'dv.head_of_division as Division', 
            'ds.name as DepartmentName', 
            'j.title as PositionName'
        ])
        ->leftJoin('departments as ds', 'ds.id', '=', 'x.department_id')
        ->leftJoin('jobs as j', 'x.position_id', '=', 'j.id')
        ->leftJoin('divisions as dv', 'dv.id', '=', 'ds.division_id')
        ->where('x.company_id', 3)
        ->whereIn('x.role_name', ['employee', 'candidate'])
        ->whereNull('x.technical_assessment_completed')
        ->where('ds.division_id', 7)
        ->get();

    // Dump and die the results
    dd($results);
}
}
