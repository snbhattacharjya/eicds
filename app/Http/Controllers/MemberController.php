<?php

namespace App\Http\Controllers;

use App\Member;
use Illuminate\Http\Request;
use Session;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        'member_name' => 'required|string|max:255',
        'relation' => 'required|string|max:255',
        'aadhaar' => 'required|digits:12',
        'gender' => 'required',
        'dob' => 'date_format:d/m/Y|before:tomorrow',
        'marital_status' => 'required|string',
        'target_id' => 'required|string',
        'disability_id' => 'required|string',
        'anganwadi_resident' => 'required|string',
        'mobile' => 'required|digits:10',
      ]);

      $member =  new Member;
      $member->family_id = $request->family_id;
      $member->name = $request->member_name;
      $member->aadhaar = $request->aadhaar;
      $member->gender = $request->gender;
      $member->dob = date_format(date_create_from_format('d/m/Y',$request->dob),'Y-m-d');
      $member->marital_status = $request->marital_status;
      $member->target_id = $request->target_id;
      $member->disability_id = $request->disability_id;
      $member->anganwadi_resident = $request->anganwadi_resident;
      $member->mobile = $request->mobile;
      $member->relation = $request->relation;
      $member->anganwadi_centre_id = 1;
      $member->active_status = 1;

      $member->save();

      Session::flash('success','Member Added Successfully with ID: '.$member->id);
      return redirect()->route('familydetail.showMembers',['family_id' => $member->family_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\members  $members
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\members  $members
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\members  $members
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Member $member)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\members  $members
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        //
    }
}
