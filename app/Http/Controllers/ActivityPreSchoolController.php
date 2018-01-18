<?php

namespace App\Http\Controllers;

use App\ActivityPreSchool;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Auth;

class ActivityPreSchoolController extends Controller
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
        'activity_id' => 'required|string|max:255',
        'preschool_date' => 'date_format:d/m/Y|before:tomorrow',
      ]);
      $activity_preschool = new ActivityPreSchool;
      $activity_preschool->preschool_date = date_format(date_create_from_format('d/m/Y',$request->preschool_date),'Y-m-d');
      $activity_preschool->activity_id = $request->activity_id;
      $activity_preschool->anganwadi_centre_id = Auth::user()->area->area_id;
      $activity_preschool->save();

      Session::flash('success', 'New PreSchool Day Added Successfully on: '.$activity_preschool->preschool_date);
      return redirect()->route('preschooleducation.create',['member' => $request->member_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ActivityPreSchool  $activityPreSchool
     * @return \Illuminate\Http\Response
     */
    public function show(ActivityPreSchool $activityPreSchool)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ActivityPreSchool  $activityPreSchool
     * @return \Illuminate\Http\Response
     */
    public function edit(ActivityPreSchool $activityPreSchool)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ActivityPreSchool  $activityPreSchool
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ActivityPreSchool $activityPreSchool)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ActivityPreSchool  $activityPreSchool
     * @return \Illuminate\Http\Response
     */
    public function destroy(ActivityPreSchool $activityPreSchool)
    {
        //
    }
}
