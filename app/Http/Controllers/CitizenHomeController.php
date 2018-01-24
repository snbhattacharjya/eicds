<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        return view('citizen.home');
    }

    public function familydetails()
    {
        return view('citizen.familydetails');
    }

    public function snp()
    {
        return view('citizen.snp');
    }

    public function pregnancy()
    {
        return view('citizen.pregnancy');
    }

    public function immunization()
    {
        return view('citizen.immunization');
    }

    public function vitamina()
    {
        return view('citizen.vitamina');
    }

    public function weightrecords()
    {
        return view('citizen.weightrecords');
    }

    public function preschool()
    {
        return view('citizen.preschool');
    }

    public function migrations()
    {
        return view('citizen.migrations');
    }
}
