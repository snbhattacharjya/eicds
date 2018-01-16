<?php

namespace App\Http\Controllers;

use App\PregnancyDeliveryRecord;
use Illuminate\Http\Request;
use App\Member;
use Session;
use App\MedicalProcedure;
use App\PregnancyAntenatalCheckup;
use Illuminate\Support\Facades\Auth;

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
            ['anganwadi_centre_id', '=', Auth::user()->area->area_id],
          ])
          ->whereIn('target_id', [1])
          ->get();
        return view('pregnancydelivery.index',['members' => $members]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(int $member_id)
    {
        $member = Member::find($member_id);
        return view('pregnancydelivery.create',['member' => $member]);
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
        'pregnancy_order' => 'required|numeric',
        'anganwanwadi_registration_date' => 'date_format:d/m/Y|before:tomorrow',
        'lmp_date' => 'date_format:d/m/Y|before:tomorrow',
        'edd_date' => 'date_format:d/m/Y',
        //'delivery_date' => 'date_format:d/m/Y|before:tomorrow',
        //'anganwadi_reported_date' => 'date_format:d/m/Y|before:tomorrow',
      ]);

      $member =  Member::find($request->member_id);
      $pd_record = new PregnancyDeliveryRecord;
      $pd_record->pregnancy_order = $request->pregnancy_order;
      $pd_record->family_id = $member->family_id;
      $pd_record->member_id = $member->id;
      $pd_record->target_type_id = $member->target_id;

      $age = date_diff(date_create($member->dob), date_create(date("Y-m-d")))->y;

      $pd_record->age = $age;
      $pd_record->anganwadi_resident = $member->anganwadi_resident;
      $pd_record->lmp_date = date_format(date_create_from_format('d/m/Y',$request->lmp_date),'Y-m-d');
      $pd_record->edd_date = date_format(date_create_from_format('d/m/Y',$request->edd_date),'Y-m-d');

      if(isset($request->delivery_date)){
        $pd_record->delivery_date = date_format(date_create_from_format('d/m/Y',$request->delivery_date),'Y-m-d');
      }

      if(isset($request->anganwadi_reported_date)){
        $pd_record->anganwadi_reported_date = date_format(date_create_from_format('d/m/Y',$request->anganwadi_reported_date),'Y-m-d');
      }

      $pd_record->anganwadi_registration_date = date_format(date_create_from_format('d/m/Y',$request->anganwadi_registration_date),'Y-m-d');
      $pd_record->anganwadi_centre_id = Auth::user()->area->area_id;

      $pd_record->save();
      Session::flash('success','Pregnancy Delivery Record Added Successfully with ID: '.$pd_record->id);
      return redirect()->route('pregnancydelivery.show',['member' => $member->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PregnancyDeliveryRecord  $pregnancyDeliveryRecord
     * @return \Illuminate\Http\Response
     */
    public function show(int $member_id)
    {
        $member = Member::find($member_id);
        $pd_records = PregnancyDeliveryRecord::where([
          ['member_id', '=', $member_id],
          //['anganwadi_centre_id', '=', Auth::user()->area->area_id],
        ])->get();

        return view('pregnancydelivery.show',['member' => $member, 'pd_records' => $pd_records]);
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
    public function destroy(int $pd_record_id)
    {
        //dd($pregnancyDeliveryRecord);
        $pregnancyDeliveryRecord = PregnancyDeliveryRecord::find($pd_record_id);
        $pregnancyDeliveryRecord->delete();
        Session::flash('success','Pregnancy Delivery Record Deleted Successfully with ID: '.$pregnancyDeliveryRecord->id);
        return redirect()->route('pregnancydelivery.show',['member' => $pregnancyDeliveryRecord->member_id]);
    }

    public function showMedicalProcedure(int $pd_record_id)
    {
        $pd_record = PregnancyDeliveryRecord::find($pd_record_id);
        $member = Member::find($pd_record->member_id);
        $procedures = MedicalProcedure::all();
        return view('pregnancydelivery.show_medical_procedure',['member' => $member, 'pd_record' => $pd_record, 'procedures' => $procedures]);
    }

    public function showAnteNatalCheckup(int $pd_record_id)
    {
        $pd_record = PregnancyDeliveryRecord::find($pd_record_id);
        $member = Member::find($pd_record->member_id);

        return view('pregnancydelivery.show_antenatal_checkup',['member' => $member, 'pd_record' => $pd_record]);
    }

    public function showNewBorn(int $pd_record_id)
    {
        $pd_record = PregnancyDeliveryRecord::find($pd_record_id);
        $member = Member::find($pd_record->member_id);

        return view('pregnancydelivery.show_new_born',['member' => $member, 'pd_record' => $pd_record]);
    }
}
