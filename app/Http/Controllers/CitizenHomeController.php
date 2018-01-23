<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\Dashboard;

class CitizenHomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    use Dashboard;
    public function __construct()
    {
        $this->middleware('auth:citizen');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $type = strtolower(Auth::user()->type);
        $charts = $this->getDashboard($type,$type == 'central' ? '' : Auth::user()->area->area_id);
        return view('dashboard.'.$type,['charts' => $charts]);
    }
}
