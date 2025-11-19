<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Quiz;
use App\Models\User;

use App;
use App\Services\ApiService;
use Session;
use Auth;

class LoginController extends Controller
{
  public function loginForm()
  {

    return view('auth.login');
  }

  public function login(Request $request)
  {
    $rules = [
      'email' => 'required',
      'password' => 'required|min:6',
      'terms' => 'accepted',
    ];

    $this->validate($request, $rules);
    App::setlocale($request->language);
    session(['locale' => $request->language]);

    $response =  $this->mynextlogin($request);

    if ($response->status == 1) {
      // dd('sadf');
      $tokenReference = $response->data->token;
      session([config('app.token_name') => $tokenReference]);
      session(['user_id' => $response->data->id]);
      return redirect()->route('cognitive-ability-assessment-intro');
    } else {
      return redirect()->back()
        ->withInput()
        ->with('error', 'Invalid Credentails Please check or register on .');
    }
  }

  public function mynextlogin($request)
  {
    // dd($request->all());

    // $api = env('MYNEXT_URL')."/auth/api/talent/check-user-existence-for-lms/";
    // $env = env("APP_ENV_MODE");
    // if ($env == 'UAT'){
    //   $api = "https://api-uat-mynext.cxsanalytics.com/auth/api/talent/check-user-existence-for-lms/";
    // }
    // else {
    //   $api = "https://api.mynext.my/auth/api/talent/check-user-existence-for-lms/";
    // }
    // $api = env('MYNEXT_Login')."/auth/api/talent/check-user-existence-for-lms/";
    $api = "https://api.mynext.my/auth/api/talent/check-user-existence-for-lms/";

    $data = [
      'username' => $request->email,
      'password' => $request->password,
    ];
    // dd($data);
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => $api,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30000,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => json_encode($data),
      CURLOPT_HTTPHEADER => array(
        // Set here requred headers
        "accept: */*",
        "accept-language: en-US,en;q=0.8",
        "content-type: application/json",
      ),
      // Disable SSL verification
      CURLOPT_SSL_VERIFYPEER => false,
      CURLOPT_SSL_VERIFYHOST => false,
    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

    $response = json_decode($response);


    return $response;
  }

  public function AdminLoginForm()
  {

    return view('admin.auth.login');
  }


  public function AdminLogin(Request $request)
  {
    $username = 'admin@cxs.com'; // Replace with your admin username
    $password = 'Cxs@1234'; // Replace with your admin password

    $upsiuser = 'admin@upsi.com';
    $upsipass = 'Upsi@1234';
    $credentials = $request->only('email', 'password');

    if ($credentials['email'] === $username && $credentials['password'] === $password) {
      // Admin credentials are valid, set the session and redirect to admin dashboard or any admin page
      $request->session()->put('admin', true);
      $request->session()->put('user', 'admin');
      return redirect()->route('admin.dashboard'); // Replace 'admin.dashboard' with your admin dashboard route name
    }

    if ($credentials['email'] === $upsiuser && $credentials['password'] === $upsipass) {
      // Admin credentials are valid, set the session and redirect to admin dashboard or any admin page
      $request->session()->put('admin', true);
      $request->session()->put('user', 'upsi');
      return redirect()->route('admin.dashboard'); // Replace 'admin.dashboard' with your admin dashboard route name
    }
    // dd('asdfasd');
    // Invalid admin credentials, redirect back with an error message
    return redirect()->back()
      ->withInput()
      ->with('error', 'Invalid Credentails Please check or register on .');
  }

  public function logout()
  {

    // dd("ss");
    session()->put('admin', false);
    session()->forget('user');
    Session::flush();
    session()->forget('question_no');
    session()->forget('new_question_set');
    session()->forget('question_Ids');
    session()->forget('from_quiz_is_completed_middleware');
    
    Auth::logout();

    // dd(session('admin'));
    return redirect()->route('login');
  }

  public function Talentlogout()
  {

    // dd();
    session()->forget('user_id');
    session()->forget('question_no');
    session()->forget('from_quiz_is_completed_middleware');
    
    // dd(session('admin'));
    // return redirect()->back();
    return redirect()->route('login');
  }



  public function LMS_Login(Request $request)
  {
      // $email = $request->query('email');
      // $mobile = $request->query('mobile');
      // $name = $request->query('full_name');

     $user = User::where('email','admin@cxs.com')->first();

      // if(!isset($user)){
      // $user = User::create([
      //     'email'=>$request->email,
      //     'full_name'=>$request->full_name,
      //     'role_name'=>'user',
      //     'role_id'=>1,
      //     'mobile'=>$request->mobile,
      //     'password'=>Hash::make('chrome_lms'),
      //     'created_at' => time(),
      //     'avatar'=> env('CHROME_URL').$request->avatar,
      // ]);
      // }

     $response =  Auth::attempt(['email' => $user->email, 'password' => '123456']);

     return redirect('/admin/dashboard');
  }
  
  // JC Specific Code
  public function jcDirectInsightAccessLogin(Request $request) {
    $user = User::where('email','admin@jc.com')->first();
    $response =  Auth::attempt(['email' => $user->email, 'password' => '2sRSER$SE^YTF']);

    return redirect('/admin/dashboard');
  }


}
