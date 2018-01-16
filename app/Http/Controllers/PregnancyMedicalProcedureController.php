<?php

namespace App\Http\Controllers;

use App\PregnancyMedicalProcedure;
use Illuminate\Http\Request;
use App\Member;
use App\PregnancyDeliveryRecord;
use Session;
use Illuminate\Support\Facades\Auth;

class PregnancyMedicalProcedureController extends Controller
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
        'procedure_date' => 'date_format:d/m/Y|before:tomorrow',
        'remarks' => 'required|string',
      ]);

      $pd_record = PregnancyDeliveryRecord::find($request->pregnancy_id);
      $medical = new PregnancyMedicalProcedure;

      $medical->family_id = $pd_record->family_id;
      $medical->member_id = $pd_record->member_id;
      $medical->target_type_id = $pd_record->target_type_id;

      //$age = date_diff(date_create($member->dob), date_create(date("Y-m-d")))->y;

      $medical->age = $pd_record->age;
      $medical->anganwadi_resident = $pd_record->anganwadi_resident;
      $medical->pregnancy_id = $request->pregnancy_id;
      $medical->procedure_id = $request->procedure_id;
      $medical->procedure_date = date_format(date_create_from_format('d/m/Y',$request->procedure_date),'Y-m-d');
      $medical->remarks = $request->remarks;
      $medical->anganwadi_centre_id = Auth::user()->area->area_id;

      $medical->save();
      Session::flash('success','Pregnancy Medical Procedure Added Successfully with ID: '.$medical->id);
      return redirect()->route('pregnancydelivery.medicalprocedure',['id' => $pd_record->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PregnancyMedicalProcedure  $pregnancyMedicalProcedure
     * @return \Illuminate\Http\Response
     */
    public function show(PregnancyMedicalProcedure $pregnancyMedicalProcedure)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PregnancyMedicalProcedure  $pregnancyMedicalProcedure
     * @return \Illuminate\Http\Response
     */
    public function edit(PregnancyMedicalProcedure $pregnancyMedicalProcedure)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PregnancyMedicalProcedure  $pregnancyMedicalProcedure
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PregnancyMedicalProcedure $pregnancyMedicalProcedure)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PregnancyMedicalProcedure  $pregnancyMedicalProcedure
     * @return \Illuminate\Http\Response
     */
    public function destroy(PregnancyMedicalProcedure $pregnancyMedicalProcedure)
    {
        //
    }
}
