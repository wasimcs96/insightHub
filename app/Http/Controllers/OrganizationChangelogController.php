<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OwenIt\Auditing\Models\Audit;

class OrganizationChangelogController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.organization-structure.changelog', [
            'model' => Audit::class,
        ]);
    }
}
