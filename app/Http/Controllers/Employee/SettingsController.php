<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserEmployment;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class SettingsController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('employee.settings');
    }

    public function store(Request $request)
    {

        $user = auth()->user();
        if($request->new_password) {
            $request->validate([
                'new_password' => 'different:current_password',
                'confirm_password' => 'same:new_password',
                'profile_picture' => 'image|mimes:jpeg,png,jpg,gif',
            ]);

            // Check if the current password matches the user's password
            if (!Hash::check($request->current_password, $user->password)) {
                return redirect()->route('employee.settings')->withErrors(['current_password' => 'The current password is incorrect.']);
            }

            // Update password if new password is provided
            if ($request->filled('new_password')) {
                $user->update([
                    'password' => Hash::make($request->new_password),
                ]);
            }
        } else {
            $request->validate([
                'profile_picture' => 'image|mimes:jpeg,png,jpg,gif',
            ]);
        }


        // Update user data
        // $user->update([
        //     'first_name' => $request->first_name,
        //     'last_name' => $request->last_name,
        //     'email' => $request->email,
        // ]);

        // Handle profile picture upload
            // if ($request->hasFile('profile_picture')) {
            //     $currentImagePath = public_path('employee/uploads/profile_pictures/' . $user->profile_picture);
            //     if (File::exists($currentImagePath)) {
            //         File::delete($currentImagePath);
            //     }

            //     $imageName = auth()->user()->first_name.'_'.auth()->user()->last_name.'_'.auth()->user()->id.'.'.$request->profile_picture->extension();

            //     $request->profile_picture->move(public_path('employee/uploads/profile_pictures'), $imageName);
            //     $imagePath = 'employee/uploads/profile_pictures/'.$imageName;
            //     $user->update(['profile_picture' => $imagePath]);

            // }
            if ($request->hasFile('profile_picture')) {
                // Store new avatar in the public folder
                $avatarName ='/media/users/avatars/'.time().'.'.$request->profile_picture->extension();
            
            
                $path = $request->profile_picture->move(public_path('media/users/avatars'), $avatarName);
            
                // Delete old avatar if exists
                try {
                    if ($user->profile_picture) {
                        unlink(public_path( $user->profile_picture));
                    }
                } catch (\Throwable $th) {
                    //throw $th;
                }
            
                // Update user's avatar
                $user->update(['profile_picture' => $avatarName]);
                // dd($user);
                }

        return redirect()->route('employee.settings')->with('success', 'Settings updated successfully.');
    }



    public function help()
    {
        return view('employee.help');
    }

}
