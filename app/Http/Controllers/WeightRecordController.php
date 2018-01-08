<?php

namespace App\Http\Controllers;

use App\WeightRecord;
use Illuminate\Http\Request;
use App\Member;
use Session;

class WeightRecordController extends Controller
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
          ['anganwadi_centre_id', '=', 1],
        ])
        ->whereIn('target_id', [3])
        ->get();
      return view('weightrecord.index',['members' => $members]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(int $member_id)
    {
      $member = Member::find($member_id);
      return view('weightrecord.create',['member' => $member]);
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
        'weight' => 'required|numeric',
        'weight_change' => 'required|numeric',
        'weight_status' => 'required|string',
        'reported_date' => 'date_format:d/m/Y|before:tomorrow',
      ]);

      $member =  Member::find($request->member_id);
      $wt_record = new WeightRecord;
      $wt_record->weight = $request->weight;
      $wt_record->weight_change = $request->weight_change;
      $wt_record->weight_status = $request->weight_status;
      $wt_record->family_id = $member->family_id;
      $wt_record->member_id = $member->id;
      $wt_record->target_type_id = $member->target_id;

      $age = date_diff(date_create($member->dob), date_create_from_format('d/m/Y',$request->reported_date))->y;

      $wt_record->age = $age;
      $wt_record->anganwadi_resident = $member->anganwadi_resident;
      $wt_record->reported_date = date_format(date_create_from_format('d/m/Y',$request->reported_date),'Y-m-d');

      $wt_record->anganwadi_centre_id = 1;

      $wt_record->save();
      Session::flash('success','Weight Record Added Successfully with ID: '.$wt_record->id);
      return redirect()->route('weightrecord.show',['member' => $member->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\WeightRecord  $weightRecord
     * @return \Illuminate\Http\Response
     */
    public function show(int $member_id)
    {
      $member = Member::find($member_id);
      $wt_records = WeightRecord::where([
        ['member_id', '=', $member_id],
        ['anganwadi_centre_id', '=', 1],
      ])->get();

      return view('weightrecord.show',['member' => $member, 'wt_records' => $wt_records]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\WeightRecord  $weightRecord
     * @return \Illuminate\Http\Response
     */
    public function edit(WeightRecord $weightRecord)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\WeightRecord  $weightRecord
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WeightRecord $weightRecord)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WeightRecord  $weightRecord
     * @return \Illuminate\Http\Response
     */
    public function destroy(WeightRecord $weightRecord)
    {
        //
    }
}
