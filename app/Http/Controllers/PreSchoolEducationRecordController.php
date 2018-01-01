<?php

namespace App\Http\Controllers;

use App\PreSchoolEducationRecord;
use Illuminate\Http\Request;
use Session;
use App\Member;
use App\PreSchoolActivity;
use App\ActivityPreSchool;

class PreSchoolEducationRecordController extends Controller
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
        return view('preschooleducation.index',['members' => $members]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(int $member_id)
    {
        $member = Member::find($member_id);
        $activities = PreSchoolActivity::all();
        $preschool_dates = ActivityPreSchool::select('preschool_date')->distinct()->get();
        return view('preschooleducation.create',['member' => $member, 'activities' => $activities, 'preschool_dates' => $preschool_dates]);
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
          'attendance_date' => 'date_format:d/m/Y|before:tomorrow',
        ]);

        $member =  Member::find($request->member_id);
        $preschool = new PreSchoolEducationRecord;
        $preschool->family_id = $member->family_id;
        $preschool->member_id = $member->id;
        $preschool->target_type_id = $member->target_id;
        $preschool->anganwadi_resident = $member->anganwadi_resident;

        $age = date_diff(date_create($member->dob), date_create(date("Y-m-d")))->m/12;

        $preschool->age = $age;
        $preschool->attendance_date = date_format(date_create_from_format('d/m/Y',$request->attendance_date),'Y-m-d');
        $preschool->anganwadi_centre_id = 1;

        $preschool->save();
        Session::flash('success','Preschool Education Record Added Successfully with ID: '.$preschool->id);
        return redirect()->route('preschooleducation.create',['member' => $member->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PreSchoolEducationRecord  $preSchoolEducationRecord
     * @return \Illuminate\Http\Response
     */
    public function show(PreSchoolEducationRecord $preSchoolEducationRecord)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PreSchoolEducationRecord  $preSchoolEducationRecord
     * @return \Illuminate\Http\Response
     */
    public function edit(PreSchoolEducationRecord $preSchoolEducationRecord)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PreSchoolEducationRecord  $preSchoolEducationRecord
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PreSchoolEducationRecord $preSchoolEducationRecord)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PreSchoolEducationRecord  $preSchoolEducationRecord
     * @return \Illuminate\Http\Response
     */
    public function destroy(PreSchoolEducationRecord $preSchoolEducationRecord)
    {
        //
    }
}
