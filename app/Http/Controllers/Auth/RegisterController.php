<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Auth;
use Illuminate\Http\Request;
use App\Helpers\HelperFunctions;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    // use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application's registration form.
     *
     * @return \Illuminate\View\View
     */
    
    public function showRegistrationForm()
    {
        return view('auth.register'); // Make sure the view path matches your view file location
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    // public function register(Request $request)
    // {
    //     // Validate the incoming request data
    //     $validatedData = $request->validate([
    //         'first_name' => ['required', 'string', 'max:255'],
    //         'last_name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'email:rfc,dns', 'max:255', 'unique:users'],
    //         'country_code' => ['required', 'string'],
    //         'mobile_number' => ['required', 'string', 'max:255', 'unique:users'],
    //         'password' => ['required', 'string', 'min:8', 'confirmed'],
    //     ]);

    //     $otp = rand(100000, 999999);
        
    //     $user = User::create([
    //         'first_name' => $request->first_name,
    //         'last_name' => $request->last_name,
    //         'name' => trim($request->first_name . ' ' . $request->last_name),
    //         'email' => $request->email,
    //         'role_name'=>'user',
    //         'role_id'=>10,
    //         'country_code' => $request->country_code,
    //         'mobile_number' => $request->mobile_number,
    //         'password' => Hash::make($request->password),
    //         'otp' => $otp,
    //         'otp_expires_at' => Carbon::now()->addMinutes(15),
    //     ]);
    //     session(['email' => $user->email]);
    //     // Send Email
    //     $to = $user->email;
    //     $subject = 'OTP Email';
    //     $message = 'This is the otp email';
    //     $mailableClass = 'SendOtpEmail';
    //     $data = [
    //         'otp' => $otp
    //     ];

    //     HelperFunctions::sendEmail($to, $subject, $message, $mailableClass, $data);
    //     return redirect()->route('auth.otp')->with('success', 'You have registered successfully');
    // }
    // Example usage in the controller
    public function register(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email:rfc,dns', 'max:255', 'unique:users'],
            'country_code' => ['required', 'string'],
            'mobile_number' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    
        // Generate OTP
        $otp = rand(100000, 999999);
        
        // Create the user
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'name' => trim($request->first_name . ' ' . $request->last_name),
            'email' => $request->email,
            'role_name'=>'user',
            'role_id'=>10,
            'country_code' => $request->country_code,
            'mobile_number' => $request->mobile_number,
            'password' => Hash::make($request->password),
            'otp' => $otp,
            'otp_expires_at' => Carbon::now()->addMinutes(15),
            'company_id'=>3
        ]);
        session(['email' => $user->email]);
    
        // Prepare email data
        $to = $user->email;
        $templateType = 'OTP';  // Template type based on your database
        $data = [
            'OTP' => $otp,  // Pass OTP here
            'Employee First Name' => $user->first_name ?? '',
            'Employee Middle Name' => $user->middle_name ?? '',
            'Employee Last Name' => $user->last_name ?? '',
            'email' => $user->email,
        ];

        $data['Company Name'] = $user->company->userCompany->name ?? env('APP_NAME');
        $data['Company Phone Number'] = $user->company->userCompany->mobile_number ?? env('APP_NAME');
        $data['Employee Full Name'] = $user->name;
        $data['X'] = now()->diffInMinutes($user->otp_expires_at);


    
    
        // Send email using the sendEmail method
        HelperFunctions::sendEmail($to, $templateType, $data);
    
        return redirect()->route('auth.otp')->with('success', 'You have registered successfully');
    }
    
    
    


    public function verifyOtpView()
    {
        return view('auth.otp');
    }

    public function verifyOTP(Request $request)
    {   
        $user = User::where('email', $request->email)->first();
        
        // Access each code value from the request and concatenate them
        $otp = $request->input('code_1') .
            $request->input('code_2') .
            $request->input('code_3') .
            $request->input('code_4') .
            $request->input('code_5') .
            $request->input('code_6');
        
        if ($user->otp == $otp && $user->otp_expires_at > Carbon::now()) {
            Auth::login($user);
            // Redirect authenticated user to dashboard or any other route
            // return redirect()->route('user.about.me',['step' => config('helpers.register_steps_completed')[$user->steps_completed+1]]);
            return redirect()->route('user.about.me',['step' => 1]);
       
        } else {
            return redirect()->back()->with('error', 'Incorrect OTP');
        }
    }

    public function resendOtp(Request $request) {
        $otp = rand(100000, 999999);
        $user = User::where('email', session('email'))->first();
        $user->otp = $otp;
        $user->otp_expires_at = Carbon::now()->addMinutes(15);
        $user->save();
        // Send Email
        $to = $user->email;
        $subject = 'OTP Email';
        $message = 'This is the otp email';
        $mailableClass = 'SendOtpEmail';
        $data = [
            'otp' => $otp
        ];

        HelperFunctions::sendEmail($to, $subject, $message, $mailableClass, $data);
        return redirect()->route('auth.otp')->with('success', 'OTP Resent Successfully');
    }

}
