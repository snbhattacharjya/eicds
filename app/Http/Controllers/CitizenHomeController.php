<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Traits\Dashboard;
use App\Member;
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
        $members = Member::where('family_id',Auth::user()->family_id)->get();
        return view('citizen.familydetails',['members' => $members]);
    }

    public function snp()
    {
        $records = DB::table('supplementary_food_distributions')
                   ->join('supplementary_distribution_food_types','supplementary_food_distributions.id','=','supplementary_distribution_food_types.distribution_id')
                   ->join('supplementary_food_types','supplementary_distribution_food_types.food_type_id','=','supplementary_food_types.id')
                   ->join('members','supplementary_food_distributions.member_id','=','members.id')
                   ->where('members.family_id',Auth::user()->family_id)
                   ->select('members.name as member_name','supplementary_food_types.type_name','supplementary_food_distributions.ration_given_quantity','supplementary_food_distributions.ration_given_date')
                   ->get();
        return view('citizen.snp',['records' => $records]);
    }

    public function pregnancy()
    {
        $records = DB::table('supplementary_food_distributions')
                 ->join('supplementary_distribution_food_types','supplementary_food_distributions.id','=','supplementary_distribution_food_types.distribution_id')
                 ->join('supplementary_food_types','supplementary_distribution_food_types.food_type_id','=','supplementary_food_types.id')
                 ->join('members','supplementary_food_distributions.member_id','=','members.id')
                 ->where('members.family_id',Auth::user()->family_id)
                 ->select('members.name as member_name','supplementary_food_types.type_name','supplementary_food_distributions.ration_given_quantity','supplementary_food_distributions.ration_given_date')
                 ->get();
        return view('citizen.pregnancy',['records' => $records]);
    }

    public function immunization()
    {
        $records = DB::table('supplementary_food_distributions')
                 ->join('supplementary_distribution_food_types','supplementary_food_distributions.id','=','supplementary_distribution_food_types.distribution_id')
                 ->join('supplementary_food_types','supplementary_distribution_food_types.food_type_id','=','supplementary_food_types.id')
                 ->join('members','supplementary_food_distributions.member_id','=','members.id')
                 ->where('members.family_id',Auth::user()->family_id)
                 ->select('members.name as member_name','supplementary_food_types.type_name','supplementary_food_distributions.ration_given_quantity','supplementary_food_distributions.ration_given_date')
                 ->get();
        return view('citizen.immunization',['records' => $records]);
    }

    public function vitamina()
    {
        $records = DB::table('supplementary_food_distributions')
                 ->join('supplementary_distribution_food_types','supplementary_food_distributions.id','=','supplementary_distribution_food_types.distribution_id')
                 ->join('supplementary_food_types','supplementary_distribution_food_types.food_type_id','=','supplementary_food_types.id')
                 ->join('members','supplementary_food_distributions.member_id','=','members.id')
                 ->where('members.family_id',Auth::user()->family_id)
                 ->select('members.name as member_name','supplementary_food_types.type_name','supplementary_food_distributions.ration_given_quantity','supplementary_food_distributions.ration_given_date')
                 ->get();
        return view('citizen.vitamina',['records' => $records]);
    }

    public function weightrecords()
    {
        $records = DB::table('supplementary_food_distributions')
                 ->join('supplementary_distribution_food_types','supplementary_food_distributions.id','=','supplementary_distribution_food_types.distribution_id')
                 ->join('supplementary_food_types','supplementary_distribution_food_types.food_type_id','=','supplementary_food_types.id')
                 ->join('members','supplementary_food_distributions.member_id','=','members.id')
                 ->where('members.family_id',Auth::user()->family_id)
                 ->select('members.name as member_name','supplementary_food_types.type_name','supplementary_food_distributions.ration_given_quantity','supplementary_food_distributions.ration_given_date')
                 ->get();
        return view('citizen.weightrecords');
    }

    public function preschool()
    {
        $records = DB::table('pre_school_education_records')
                 ->join('activity_pre_schools', function ($join) {
                        $join->on('pre_school_education_records.anganwadi_centre_id', '=', 'activity_pre_schools.anganwadi_centre_id');
                        $join->on('pre_school_education_records.attendance_date', '=', 'activity_pre_schools.preschool_date');
                 })
                 ->join('pre_school_activities','activity_pre_schools.activity_id','=','pre_school_activities.id')
                 ->join('members','pre_school_education_records.member_id','=','members.id')
                 ->where('members.family_id',Auth::user()->family_id)
                 ->select('members.name as member_name','pre_school_education_records.attendance_date','pre_school_activities.activity_name')
                 ->get();
        return view('citizen.preschool',['records' => $records]);
    }

    public function migrations()
    {
        $records = DB::table('family_migrations')
                 ->join('members','family_migrations.member_id','=','members.id')
                 ->where('members.family_id',Auth::user()->family_id)
                 ->select('members.name as member_name','family_migrations.type','family_migrations.remarks','family_migrations.created_at')
                 ->get();
        return view('citizen.migrations',['records' => $records]);
    }
}
