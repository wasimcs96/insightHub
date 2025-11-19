<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Helpers\HelperFunctions;
use Carbon\Carbon;
// use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Hash;
use Auth;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    // use SendsPasswordResetEmails;

    public function showLinkRequestForm() {
        return view('auth.passwords.email');
    }

    public function sendOtp(Request $request) {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);

        $user = User::where('email', $request->email)->first();

        if($user) {
            $otp = rand(100000, 999999);
            $user->otp = $otp;
            $user->otp_expires_at = Carbon::now()->addMinutes(15);
            $user->save();
            // Send Email
            $to = $user->email;
            $subject = 'Password Reset OTP';
            $message = 'You have requested to reset your password. Your OTP code is: ' . $otp . '. This OTP is valid for 15 minutes.';
            $mailableClass = 'SendOtpEmail';
            $data = [
                'otp' => $otp
            ];

            HelperFunctions::sendForgetEmail($to, $subject, $message, $mailableClass, $data);
            session(['email' => $user->email]);
            return redirect()->route('password.change.view')->with('success', 'OTP sent successfully');
        } else {
            return redirect()->back()->with('error', 'Provided email does not exist');
        }
    }

    public function changePasswordView() {
        $email = session('email');
        return view('auth.passwords.otp')->with('email', $email);
    }

    // public function changePassword(Request $request) {
    //     // Validate the incoming request data
    //     $validatedData = $request->validate([
    //         'password' => ['required', 'string', 'min:8', 'confirmed'],
    //     ]);

    //     $user = User::where('email', session('email'))->first();
        
    //     if ($user->otp == $request->otp && ($user->otp_expires_at > Carbon::now())) {
            
    //         Auth::login($user);
    //         // Redirect authenticated user to dashboard or any other route
    //         return redirect()->route('employee.dashboard');
            
    //     } else {
    //         return redirect()->back()->with('error', 'Incorrect OTP');
    //     }
        
    // }

    public function changePassword(Request $request) {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'otp' => ['required', 'numeric']
        ]);
    
        $user = User::where('email', session('email'))->first();
    
        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }
    
        // Check OTP and expiration
        if ($user->otp == $request->otp && $user->otp_expires_at > Carbon::now()) {
            // Update the password
            $user->password = Hash::make($request->password);
            $user->otp = null; // Clear OTP after successful use
            $user->otp_expires_at = null; // Clear OTP expiry
            $user->save();
    
            // Log in the user
            Auth::login($user);
    
            // Redirect authenticated user to dashboard or any other route
            return redirect()->route('employee.dashboard')->with('success', 'Password updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Incorrect or expired OTP.');
        }
    }
}
