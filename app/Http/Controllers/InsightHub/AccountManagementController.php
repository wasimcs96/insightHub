<?php

namespace App\Http\Controllers\InsightHub;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UpdateAccountRequest;
use Illuminate\Support\Facades\Hash;

class AccountManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); 
    }

      
    public function index()
{
    $user = auth()->user(); 

    return view('InsightHub.settings.account-Management.index', compact('user'));
}

    
   public function edit()
{
    $user = auth()->user();
    return view('InsightHub.settings.account-Management.edit', compact('user'));
}


    
    public function update(UpdateAccountRequest $request)
    {
        $user = $request->user();

        $user->update($request->only(['first_name', 'last_name', 'email', 'mobile_number']));

        return redirect()->route('account.index')->with('success', 'Account Information updated successfully.');
    }

    public function showChangePasswordForm()
{
    $user = auth()->user();
    return view('InsightHub.settings.account-Management.change-password', compact('user'));
}

    
  public function changePassword(ChangePasswordRequest $request)
{
    $user = $request->user();

    if (! Hash::check($request->input('current_password'), $user->password)) {
        return back()->withErrors(['current_password' => 'Current password is incorrect.']);
    }

    $user->password = Hash::make($request->input('password'));
    $user->save();

    return redirect()->route('account.index')->with('success', 'Password changed successfully.');
}

}
