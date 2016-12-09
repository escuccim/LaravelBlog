<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }
    
	// this gives the login form the intended page to be used by the login function
	// overrode default function since it doesn't set url.intended unless login was caught by auth middleware
    public function showLoginForm(){
    	if(!session()->has('url.intended')){
    		session()->put('url.intended', url()->previous());
    	}
    	return view('auth.login');
    }

    public function login(Request $request)
    {
    	$this->validateLogin($request);
    
    	// If the class is using the ThrottlesLogins trait, we can automatically throttle
    	// the login attempts for this application. We'll key this by the username and
    	// the IP address of the client making these requests into this application.
    	if ($this->hasTooManyLoginAttempts($request)) {
    		$this->fireLockoutEvent($request);
    
    		return $this->sendLockoutResponse($request);
    	}
    
    	$credentials = $this->credentials($request);
    	$credentials['active'] = 1;
    
    	if ($this->guard()->attempt($credentials, $request->has('remember'))) {
    		return $this->sendLoginResponse($request);
    	}
    
    	// If the login attempt was unsuccessful we will increment the number of attempts
    	// to login and redirect the user back to the login form. Of course, when this
    	// user surpasses their maximum number of attempts they will get locked out.
    	$this->incrementLoginAttempts($request);
    
    	return $this->sendFailedLoginResponse($request);
    }
}
