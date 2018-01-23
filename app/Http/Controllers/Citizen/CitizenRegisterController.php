<?php

namespace App\Http\Controllers\Citizen;

use App\ExternalCitizen;
use App\Citizen;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\State;
use App\Member;

class CitizenRegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'aadhaar' => 'required|digits:12|unique:external_citizens',
            'mobile' => 'required|digits:10|unique:external_citizens',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return ExternalCitizen::create([
            'name' => $data['name'],
            'aadhaar' => $data['aadhaar'],
            'mobile' => $data['mobile'],
            'project_id' => $data['project'],
        ]);
    }
    public function register(Request $request)
    {
      $member = Member::where('aadhaar',$request->aadhaar)->get();
      if($member->count() > 0){
        return view('citizen.message',['message' => 'Member with Aadhaar already exists. Please login with your Aadhaar and OTP.']);
      }
      else{
        $this->validator($request->all())->validate();
        $this->create($request->all());
        return view('citizen.message',['message' => 'Thank you for your registration. Your details has been forwarded to the concerned Project Officer. Officer approval is required for your next login.']);
      }
    }
    public function showRegistrationForm()
    {
        $states = State::all();
        return view('citizen.register',['states' => $states]);
    }
}
