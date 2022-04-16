<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
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
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // Custom Login form
    // public function showLoginForm()
    // {
    //     // dd('sdf');
    //     return view("login");
    // }

    // Add mobile number to login
    // public function login(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required',
    //         'password' => 'required',
    //     ]);

    //     $credentials = $request->only('email', 'password');
    //     if (Auth::attempt($credentials)) {

    //         return redirect()->route('admin-dashboard');
    //     }

    //     return redirect("login")->withSuccess('Oppes! You have entered invalid credentials');
    // }

    protected function redirectTo()
    {
        if (Auth::user()->role_id == 1) {
            session(['url.intended' => '/admin/dashboard']);
        }
        // else 
        // {
        //     // if (Auth::user()->first_login == 1)
        //     // {
        //     //     $total_cart =Cart::where('user_id',Auth::id())->count();
        //     //     if ($total_cart > 0) {
        //     //         session(['url.intended' => route('checkout')]);
        //     //     }
        //     //     else
        //     //     {
        //     //         session(['url.intended' => route('home')]);
        //     //     }

        //     // } 
        //     // else 
        //     // {
        //     //     session(['url.intended' => route('change-password')]);

        //     // }
        // }
        if (isset($_COOKIE['url'])) 
        {
            session(['url.intended' => $_COOKIE['url']]);
            setcookie('url', 'content', 1);
        }
    }
}
