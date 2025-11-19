<?php

namespace App\Http\Controllers\InsightHub;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubsidiariesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the InsightHub dashboard for admin and company users.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Check if user is admin or company
        if (!auth()->user()->isAdmin() && !auth()->user()->isCompany()) {
            abort(403, 'Unauthorized access to InsightHub');
        }

        $user = auth()->user();
        
        // You can add any additional data you want to pass to the view here
        $data = [
            'user' => $user,
            'title' => 'InsightHub Subsidiaries',
            // Add more data as needed
        ];

        return view('InsightHub.subsidiaries.index', $data);
    }
}