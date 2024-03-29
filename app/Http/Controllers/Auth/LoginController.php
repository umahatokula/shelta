<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * process login
     *
     * @return response()
     */
    public function login(Request $request) {
        $validated = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($validated)) {

            if (auth()->user()->use_2fa) {

                auth()->user()->generateCode();

                return redirect()->route('2fa.index');
                
            }
            
            // return redirect()->route('home');
            return redirect()->intended('home');
            
        }

        session()->flash('error', 'You have entered invalid credentials');
        return redirect()->route('login');
    }

    

    public function logout(Request $request) {

        $isClient = auth()->user()->hasRole('client');

        Auth::logout();

        \Session::forget('user_2fa');

        // if ($isClient) {
        //     return redirect()->route('clients.login');
        // }

        return redirect('/login');

    }

}
