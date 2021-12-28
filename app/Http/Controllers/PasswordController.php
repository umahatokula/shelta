<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class PasswordController extends Controller
{

    /**
     * showChangePasswordForm
     *
     * @return void
     */
    public function showChangePasswordFormStaff(){
        return view('auth.changepassword');
    }

    /**
     * showChangePasswordForm
     *
     * @return void
     */
    public function showChangePasswordForm(){
        return view('frontend.auth.changepassword');
    }
    
    /**
     * changePassword
     *
     * @return void
     */
    public function changePassword(Request $request){

        $request->validate([
          'current_password' => 'required',
          'password' => 'required|string|min:6|confirmed',
          'password_confirmation' => 'required',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Current password does not match!');
        }

        $user->password = Hash::make($request->password);
        $user->password_change_date = Carbon::now();
        $user->save();

        return back()->with('success', 'Password successfully changed!');

    }
}
