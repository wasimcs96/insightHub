<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OnboardingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Show the onboarding page for first-time users.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        
        // Check if user is first time login
        if ($user->first_time_login != 1) {
            return redirect('/dashboard');
        }
        $data = [
            'user' => $user,
            'step_1_completed' => true,
            'step_2_completed' => false,
        ];

        return view('InsightHub.employee.onboarding.index', $data);
    }
}
