<?php

namespace App\Http\Controllers;

use App\VitaminADoseRecord;
use Illuminate\Http\Request;
use App\Member;
use Session;
use App\VitaminADose;

class VitaminADoseRecordController extends Controller
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
      return view('vitamina.index',['members' => $members]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(int $member_id)
    {
      $member = Member::find($member_id);
      $doses = VitaminADose::all();
      return view('vitamina.create',['member' => $member, 'doses' => $doses]);
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
        'dose_id' => 'required',
        'due_date' => 'date_format:d/m/Y|before:tomorrow',
        'admin_date' => 'date_format:d/m/Y|before:tomorrow',
      ]);

      $doses = VitaminADose::all();

      $member =  Member::find($request->member_id);
      $vitamina_dose_record = new VitaminADoseRecord;
      $vitamina_dose_record->family_id = $member->family_id;
      $vitamina_dose_record->member_id = $member->id;
      $vitamina_dose_record->target_type_id = $member->target_id;

      $age = date_diff(date_create($member->dob), date_create(date("Y-m-d")))->m/12;

      $vitamina_dose_record->age = $age;
      $vitamina_dose_record->dose_id = $request->dose_id;
      $vitamina_dose_record->dose_due_date = date_format(date_create_from_format('d/m/Y',$request->due_date),'Y-m-d');
      $vitamina_dose_record->dose_admin_date = date_format(date_create_from_format('d/m/Y',$request->admin_date),'Y-m-d');
      $vitamina_dose_record->anganwadi_centre_id = 1;

      $vitamina_dose_record->save();
      Session::flash('success','Vitamin A Dose Record Added Successfully with ID: '.$vitamina_dose_record->id);
      return redirect()->route('vitamina.create',['member' => $member->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\VitaminADoseRecord  $vitaminADoseRecord
     * @return \Illuminate\Http\Response
     */
    public function show(VitaminADoseRecord $vitaminADoseRecord)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\VitaminADoseRecord  $vitaminADoseRecord
     * @return \Illuminate\Http\Response
     */
    public function edit(VitaminADoseRecord $vitaminADoseRecord)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\VitaminADoseRecord  $vitaminADoseRecord
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VitaminADoseRecord $vitaminADoseRecord)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\VitaminADoseRecord  $vitaminADoseRecord
     * @return \Illuminate\Http\Response
     */
    public function destroy(VitaminADoseRecord $vitaminADoseRecord)
    {
        //
    }
}
