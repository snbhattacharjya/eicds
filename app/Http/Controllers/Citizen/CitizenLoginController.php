<?php

namespace App\Http\Controllers\Citizen;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class CitizenLoginController extends Controller
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
    protected $redirectTo = '/citizen/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'aadhaar';
    }

    public function showLoginForm()
    {
        return view('citizen.login');
    }

    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required|digits:12',
            'password' => 'required|string',
            'g-recaptcha-response' => 'required',
        ]);

        $token = $request->input('g-recaptcha-response');

    }
}
