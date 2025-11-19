<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Http;
use App\Models\MasterHigherLearningInstitution;
use App\Models\MasterEducationLevel;
use App\Models\UserEmployment;
use NoCaptcha\Facades\NoCaptcha;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/dashboard';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        // Validate login credentials and reCAPTCHA
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
            // 'g-recaptcha-response' => 'required|captcha', // reCAPTCHA validation
        ]);

        // Attempt login
        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // If login attempt fails
        return $this->sendFailedLoginResponse($request);
    }

    protected function authenticated(Request $request, $user)
    {
        // If first_time_login is 1, redirect to onboarding page
        if ($user->hasRole('employee')&&$user->first_time_login == 1) {
            return redirect()->route('employee.onboarding');
        }elseif($user->hasRole('candidate')){
            return redirect()->route('candidate.dashboard');
        }
        
        // Otherwise, redirect to dashboard
        return redirect()->route('hubcenter.dashboard');
    }

   
}
