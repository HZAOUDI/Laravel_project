<?php

namespace App\Http\Controllers\Auth;

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
    //protected $redirectTo = RouteServiceProvider::HOME;
    public function authenticated(){
        if(Auth::user()->role_as =='1'){  //1 is admin
            return redirect('admin/dashboard')->with('status', 'Bienvenu au dashboard');
        } 
        else if(Auth::user()->role_as =='0'){ //0 is user
            return redirect('/')->with('status', 'Bienvenu au dashboard');
        }
        else{
            return redirect('/login')->with('status', 'Bienvenu au dashboard');
        }
        
    }

    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
