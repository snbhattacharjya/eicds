<?php

namespace App\Http\Controllers\Citizen;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Member;
use App\Citizen;

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
        $this->middleware('guest:citizen')->except('logout');
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

    public function generateOTP(Request $request)
    {
      //$password = mt_rand(1234,5678);return response()->json(['password' => $password],200);
      $member = Member::where('aadhaar', $request->aadhaar)->first();
      if(count($member) > 0){
        $password = mt_rand(1234,5678);
        $citizen = Citizen::where('aadhaar',$request->aadhaar)->first();
        if(count($citizen) > 0){
          $citizen->password = bcrypt($password);
          $citizen->save();
          return response()->json(['password' => $password],200);
        }
        else{
          $citizen = new Citizen;
          $citizen->id = $member->id;
          $citizen->name = $member->name;
          $citizen->aadhaar = $member->aadhaar;
          $citizen->mobile = $member->mobile;
          $citizen->password = bcrypt($password);
          $citizen->save();
          return response()->json(['password' => $password],200);
        }
      }
      else {
        return response()->json(['password' => 'error'],200);
      }
    }

    protected function guard()
    {
        return Auth::guard('citizen');
    }
}
