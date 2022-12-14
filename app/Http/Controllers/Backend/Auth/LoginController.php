<?php

namespace App\Http\Controllers\Backend\Auth;

use Symfony\Component\HttpFoundation\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

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
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function showLoginForm()
    {
        return view('Backend.auth.login');
    }

    public function login(Request $request)
    {

        // Validate Login Data
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        // Attempt to login
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {

            session()->flash('success', 'Successully Logged in !');
            return redirect()->route('dashboard');
            // Search using username 

        } elseif (Auth::guard('admin')->attempt(['username' => $request->email, 'password' => $request->password], $request->remember)){
                session()->flash('success', 'Successully Logged in !');
                return redirect()->route('dashboard');
            }
            else{
            // error
            session()->flash('error', 'Invalid email and password');
            return back();
        }
    }

    /**
     * logout admin guard
     *
     * @return void
     */
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
