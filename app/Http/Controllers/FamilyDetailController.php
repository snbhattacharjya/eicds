<?php

namespace App\Http\Controllers;

use App\FamilyDetail;
use App\Category;
use App\DisabilityType;
use App\TargetType;
use App\Member;
use App\FamilyMigration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class FamilyDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $families = FamilyDetail::all();
        return view('familydetail.index',['families' => $families]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $disabilities = DisabilityType::all();
        $targets = TargetType::all();

        return view('familydetail.create',['categories' => $categories, 'disabilities' => $disabilities, 'targets' => $targets]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
          'hof_name' => 'required|string|max:255',
          'category_id' => 'required',
          'minority' => 'required',
          'bpl' => 'required',
          'address' => 'required|string|max:255',
          'village_town_name' => 'required|string|max:255',
          'pincode' => 'required|digits:6',

          //For Member and Migration Table
          'aadhaar' => 'required|digits:12',
          'gender' => 'required',
          'dob' => 'date_format:d/m/Y|before:tomorrow',
          'marital_status' => 'required|string',
          'target_id' => 'required|string',
          'disability_id' => 'required|string',
          'anganwadi_resident' => 'required|string',
          'mobile' => 'required|digits:10',
        ]);

        //DB::transaction(function () {
          $family = new FamilyDetail;
          $family->hof_name = $request->hof_name;
          $family->category_id = $request->category_id;
          $family->minority = $request->minority;
          $family->bpl = $request->bpl;
          $family->address = $request->address;
          $family->village_town_name = $request->village_town_name;
          $family->pincode = $request->pincode;

          $family->save();

          //Member create
          $member =  new Member;
          $member->family_id = $family->id;
          $member->name = $request->hof_name;
          $member->aadhaar = $request->aadhaar;
          $member->gender = $request->gender;
          $member->dob = date_format(date_create_from_format('d/m/Y',$request->dob),'Y-m-d');
          $member->marital_status = $request->marital_status;
          $member->target_id = $request->target_id;
          $member->disability_id = $request->disability_id;
          $member->anganwadi_resident = $request->anganwadi_resident;
          $member->mobile = $request->mobile;
          $member->relation = 'Self';
          $member->anganwadi_centre_id = 1;
          $member->active_status = 1;

          $member->save();

          //Migration create
          $migration = new FamilyMigration;
          $migration->family_id = $family->id;
          $migration->member_id = $member->id;
          $migration->target_id = $request->target_id;
          $migration->anganwadi_centre_id = 1;
          $migration->anganwadi_resident = $request->anganwadi_resident;
          $migration->type = 'IN';
          $migration->remarks = 'New Family';

          $migration->save();
          Session::flash('success','Family Added Successfully with ID: '.$family->id);
          return redirect()->route('familydetail.index');
        //});
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FamilyDetail  $familyDetail
     * @return \Illuminate\Http\Response
     */
    public function show(FamilyDetail $familyDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FamilyDetail  $familyDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(FamilyDetail $familyDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FamilyDetail  $familyDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FamilyDetail $familyDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FamilyDetail  $familyDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(FamilyDetail $familyDetail)
    {
        //
    }

    public function showMembers(int $family_id)
    {
        $categories = Category::all();
        $disabilities = DisabilityType::all();
        $targets = TargetType::all();
        $members = Member::where('family_id',$family_id)->get();
        return view('familydetail.show_members',['members' => $members, 'disabilities' => $disabilities, 'targets' => $targets, 'family_id' => $family_id]);
    }
}
