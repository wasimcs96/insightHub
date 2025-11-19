<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClaimManagementController extends Controller
{
    public function index()
    {
        return view('admin.claim.index');
    }

    public function create()
    {
        return view('admin.claim.create');
    }


}
