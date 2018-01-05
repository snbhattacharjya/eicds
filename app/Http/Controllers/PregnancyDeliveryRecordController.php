<?php

namespace App\Http\Controllers;

use App\PregnancyDeliveryRecord;
use Illuminate\Http\Request;
use App\Member;
use Session;
class PregnancyDeliveryRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = Member::where([
            ['active_status', '=', 1],
            ['target_id', '=', 3],
            ['anganwadi_centre_id', '=', 1],
          ])->get();
        return view('pregnancydelivery.index',['members' => $members]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $member = Member::find($member_id);
        //$vaccinations = Vaccination::all();
        return view('immunization.create',['member' => $member, 'vaccinations' => $vaccinations]);
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
        'vaccination_id' => 'required',
        'due_date' => 'date_format:d/m/Y|before:tomorrow',
        'admin_date' => 'date_format:d/m/Y|before:tomorrow',
      ]);

      $vaccinations = Vaccination::all();

      $member =  Member::find($request->member_id);
      $immunization = new ImmunizationRecord;
      $immunization->family_id = $member->family_id;
      $immunization->member_id = $member->id;
      $immunization->target_type_id = $member->target_id;

      $age = date_diff(date_create($member->dob), date_create(date("Y-m-d")))->m/12;

      $immunization->age = $age;
      $immunization->vaccination_id = $request->vaccination_id;
      $immunization->vaccination_due_date = date_format(date_create_from_format('d/m/Y',$request->due_date),'Y-m-d');
      $immunization->vaccination_admin_date = date_format(date_create_from_format('d/m/Y',$request->admin_date),'Y-m-d');
      $immunization->anganwadi_centre_id = 1;

      $immunization->save();
      Session::flash('success','Immunization Record Added Successfully with ID: '.$immunization->id);
      return redirect()->route('immunization.create',['member' => $member->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PregnancyDeliveryRecord  $pregnancyDeliveryRecord
     * @return \Illuminate\Http\Response
     */
    public function show(PregnancyDeliveryRecord $pregnancyDeliveryRecord)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PregnancyDeliveryRecord  $pregnancyDeliveryRecord
     * @return \Illuminate\Http\Response
     */
    public function edit(PregnancyDeliveryRecord $pregnancyDeliveryRecord)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PregnancyDeliveryRecord  $pregnancyDeliveryRecord
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PregnancyDeliveryRecord $pregnancyDeliveryRecord)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PregnancyDeliveryRecord  $pregnancyDeliveryRecord
     * @return \Illuminate\Http\Response
     */
    public function destroy(PregnancyDeliveryRecord $pregnancyDeliveryRecord)
    {
        //
    }
}
