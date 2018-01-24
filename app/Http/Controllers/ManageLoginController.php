<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\State;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class ManageLoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use AuthenticatesUsers;

    protected $redirectTo = '/login/manage';

    public function username()
    {
        return 'aadhaar';
    }

    public function login(Request $request)
    {
        $this->attemptLogin($request);

        return $this->sendLoginResponse($request);
    }


    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        return;

    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return;
    }

    protected function attemptLogin(Request $request)
    {
          return $this->guard()->attempt(
              $this->credentials($request), $request->filled('remember')
          );
    }

    public function index()
    {
        $states = State::whereIn('id',[3,11,14,25,31,36])->get();
        return view('managelogin',['states' => $states]);
    }

    public function loginCentral(Request $request)
    {
        $this->logout($request);
        $user = User::where('type','Central')->first();
        $request->merge(['aadhaar' => $user->aadhaar, 'password' => 'secret']);
        $this->login($request);
        return redirect()->route('managelogin.index');
    }

    public function loginState(Request $request)
    {
        $this->logout($request);
        $user = DB::table('users')
                ->join('area_user','users.id','=','area_user.user_id')
                ->where([
                  ['users.type','=','State'],
                  ['area_user.user_type','=','State'],
                  ['area_user.area_id','=',$request->state]
                ])
                ->select('users.*')
                ->first();
        $request->merge(['aadhaar' => $user->aadhaar, 'password' => 'secret']);
        $this->login($request);
        return redirect()->route('managelogin.index');
    }

    public function loginDistrict(Request $request)
    {
        $this->logout($request);
        $user = DB::table('users')
                ->join('area_user','users.id','=','area_user.user_id')
                ->where([
                  ['users.type','=','District'],
                  ['area_user.user_type','=','District'],
                  ['area_user.area_id','=',$request->district]
                ])
                ->select('users.*')
                ->first();
        $request->merge(['aadhaar' => $user->aadhaar, 'password' => 'secret']);
        $this->login($request);
        return redirect()->route('managelogin.index');
    }

    public function loginProject(Request $request)
    {
        $this->logout($request);
        $user = DB::table('users')
                ->join('area_user','users.id','=','area_user.user_id')
                ->where([
                  ['users.type','=','Project'],
                  ['area_user.user_type','=','Project'],
                  ['area_user.area_id','=',$request->project]
                ])
                ->select('users.*')
                ->first();
        $request->merge(['aadhaar' => $user->aadhaar, 'password' => 'secret']);
        $this->login($request);
        return redirect()->route('managelogin.index');
    }

    public function loginSector(Request $request)
    {
        $this->logout($request);
        $user = DB::table('users')
                ->join('area_user','users.id','=','area_user.user_id')
                ->where([
                  ['users.type','=','Sector'],
                  ['area_user.user_type','=','Sector'],
                  ['area_user.area_id','=',$request->sector]
                ])
                ->select('users.*')
                ->first();
        $request->merge(['aadhaar' => $user->aadhaar, 'password' => 'secret']);
        $this->login($request);
        return redirect()->route('managelogin.index');
    }

    public function loginCentre(Request $request)
    {
        $this->logout($request);
        $user = DB::table('users')
                ->join('area_user','users.id','=','area_user.user_id')
                ->where([
                  ['users.type','=','Center'],
                  ['area_user.user_type','=','Center'],
                  ['area_user.area_id','=',$request->center]
                ])
                ->select('users.*')
                ->first();
        $request->merge(['aadhaar' => $user->aadhaar, 'password' => 'secret']);
        $this->login($request);
        return redirect()->route('managelogin.index');
    }

    public function loginCitizen(Request $request)
    {
        $this->logout($request);
        $password = bcrypt(mt_rand(1234,5678));
        DB::table('citizens')
                ->where('aadhaar','397568560883')
                ->update(['password' => $password]);

        $request->merge(['aadhaar' => '397568560883', 'password' => $password, 'type' => 'citizen']);
        $this->login($request);
        return redirect()->route('managelogin.index');
    }

}
