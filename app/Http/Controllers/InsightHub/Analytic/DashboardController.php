<?php

namespace App\Http\Controllers\InsightHub\Analytic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
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

    public function index()
    {
        // Check if user is admin or company
        if (!auth()->user()->isAdmin() && !auth()->user()->isCompany()) {
            abort(403, 'Unauthorized access to InsightHub Analytics Dashboard');
        }

        $user = auth()->user();
        
        // You can add any additional data you want to pass to the view here
        $data = [
            'user' => $user,
            'title' => 'InsightHub Analytics Dashboard',
            // Add more data as needed
        ];

        return view('InsightHub.Analytic.dashboard', $data);
    }
    
}