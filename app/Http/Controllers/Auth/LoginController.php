<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    protected function signIn(Request $request) {
        return Auth::attempt($this->getCredentials($request), $request->has('remember'));
    }

    protected function getCredentials(Request $request) {
        return [
            'email'    => $request->input('email'),
            'password' => $request->input('password'),
            'confirmed' => true
        ];
    }

    public function login(Request $request) {

        // Validate email and password.
        $this->validate($request, [
            'email'    => 'required|email',
            'password' => 'required|'
        ]);
        $register = false;
        $login = true;
        $forgot = false;
        // login in user if successful
        if ($this->signIn($request)) {
            return redirect('/')->with('success', 'You have successfully signed in.');
        }

        // Else, show error message, and redirect them back to login.
        return redirect('/login-register')->with('status', 'Could not sign you in with those credentials');
    }
}
