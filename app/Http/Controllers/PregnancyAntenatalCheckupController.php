<?php

namespace App\Http\Controllers;

use App\PregnancyAntenatalCheckup;
use Illuminate\Http\Request;
use App\PregnancyDeliveryRecord;
use Session;
class PregnancyAntenatalCheckupController extends Controller
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
        'checkup_place' => 'required|string',
        'doctor_name' => 'required|string',
        'checkup_date' => 'date_format:d/m/Y|before:tomorrow',
        'remarks' => 'required|string',
      ]);

      $pd_record = PregnancyDeliveryRecord::find($request->pregnancy_id);
      $checkup = new PregnancyAntenatalCheckup;

      $checkup->family_id = $pd_record->family_id;
      $checkup->member_id = $pd_record->member_id;
      $checkup->target_type_id = $pd_record->target_type_id;

      //$age = date_diff(date_create($member->dob), date_create(date("Y-m-d")))->y;

      $checkup->age = $pd_record->age;
      $checkup->anganwadi_resident = $pd_record->anganwadi_resident;
      $checkup->pregnancy_id = $request->pregnancy_id;
      $checkup->checkup_place = $request->checkup_place;
      $checkup->checkup_date = date_format(date_create_from_format('d/m/Y',$request->checkup_date),'Y-m-d');
      $checkup->doctor_name = $request->doctor_name;
      $checkup->remarks = $request->remarks;
      $checkup->anganwadi_centre_id = 1;

      $checkup->save();
      Session::flash('success','Pregnancy Ante Natal Checkup Added Successfully with ID: '.$checkup->id);
      return redirect()->route('pregnancydelivery.antenatalcheckup',['id' => $pd_record->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PregnancyAntenatalCheckup  $pregnancyAntenatalCheckup
     * @return \Illuminate\Http\Response
     */
    public function show(PregnancyAntenatalCheckup $pregnancyAntenatalCheckup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PregnancyAntenatalCheckup  $pregnancyAntenatalCheckup
     * @return \Illuminate\Http\Response
     */
    public function edit(PregnancyAntenatalCheckup $pregnancyAntenatalCheckup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PregnancyAntenatalCheckup  $pregnancyAntenatalCheckup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PregnancyAntenatalCheckup $pregnancyAntenatalCheckup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PregnancyAntenatalCheckup  $pregnancyAntenatalCheckup
     * @return \Illuminate\Http\Response
     */
    public function destroy(PregnancyAntenatalCheckup $pregnancyAntenatalCheckup)
    {
        //
    }
}
